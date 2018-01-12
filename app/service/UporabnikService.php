<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 23:39
 */

require_once "app/models/Uporabniki.php";
require_once "ConfigurationUtil.php";
require_once "app/models/PotrditevRegistracije.php";
require_once "app/models/Email.php";
require_once "app/service/EmailService.php";
require_once "app/service/LogService.php";
require_once "app/models/StatusUporabnik.php";
require_once "app/models/VlogaUporabnik.php";
require_once "app/models/Posta.php";
require_once "app/service/PrijavaService.php";

class UporabnikService {

    // skupno
    public static function izbrisiUporabnika($id){
        if(self::jeNepotrjen($id)){
            $rows = PotrditevRegistracije::deleteByUporabnik(["id" => $id]);
            if($rows != 1) {
                throw new InvalidArgumentException("Napaka pri brisanju uporabnika!");
            }
        }
        $rowsAffected = Uporabniki::delete(["id" => $id]);
        if($rowsAffected != 1){
            throw new InvalidArgumentException("Napaka pri brisanju uporabnika!");
        }
    }

    private static function jeNepotrjen($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        return $uporabnik["status"] == StatusUporabnik::getIdNepotrjen();
    }

    private static function jeAktiven($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        return $uporabnik["status"] == StatusUporabnik::getIdAktiven();
    }

    public static function aktivirajUporabnika($id) {
        $rowsAffected = Uporabniki::updateStatus(["id" => $id, "vloga" => StatusUporabnik::getIdAktiven()]);
        if($rowsAffected != 1) {
            throw new InvalidArgumentException("Napaka pri aktivaciji uporabnika!");
        }
    }

    public static function deaktivirajUporabnika($id) {
        $rowsAffected = Uporabniki::updateStatus(["id" => $id, "vloga" => StatusUporabnik::getIdNeaktiven()]);
        if($rowsAffected != 1) {
            throw new InvalidArgumentException("Napaka pri deaktivaciji uporabnika!");
        }
    }

    // stranke
    public static function vrniVseStranke($stran = 1, $limit = null) {
        $limit = ($limit == null)? (int)ConfigurationUtil::getConfByKey("query_stranke_limit") : (int)$limit;
        $offset = $limit * ($stran - 1);
        $rez = array();
        $rez["uporabniki"] = Uporabniki::getByVloga(["vloga" => VlogaUporabnik::getIdStranka(),
            "offset" => $offset, "limit" => $limit]);
        $rez["stevec"] = Uporabniki::countByVloga(["vloga" => VlogaUporabnik::getIdStranka(),
            "limit" => $limit])[0];
        return $rez;
    }

    public static function vrniStranko($id) {
        return Uporabniki::getOneByVloga(["id" => $id, "vloga" => VlogaUporabnik::getIdStranka()]);
    }

    public static function prijaviStranko($input){
        $uporabnik = self::preveriPrijavoStranke($input);
        if($uporabnik == null){
            return false;
        } else {
            $_SESSION["trenutni_uporabnik"] = $uporabnik;
            return true;
        }
    }

    public static function dodajStranko($podatki) {
        $origin_password = $podatki["geslo1"];

        $uporabnik = Uporabniki::insert([
            "vloga" => VlogaUporabnik::getIdStranka(),
            "ime" => $podatki["ime"],
            "priimek" => $podatki["priimek"],
            "email" => $podatki["email"],
            "geslo" => password_hash($podatki["geslo1"], PASSWORD_DEFAULT),
            "naslov" => $podatki["naslov"],
            "telefon" => $podatki["telefon"],
            "posta" => $podatki["posta"],
            "status" => StatusUporabnik::getIdNepotrjen()
        ]);

        $id_prodajalca = PrijavaService::uporabnikJeProdajalec()? PrijavaService::vrniTrenutnegaUporabnika() : null;
        if($id_prodajalca == null){
            LogService::info("", "Registracija", "Stranka " . $podatki["email"] . " se je registrirala!");
        } else {
            $id_prodajalca = $id_prodajalca["id"];
            $sporocilo = "Prodajalec z id: " . $id_prodajalca .
                ", je registriral stranko " . $podatki["email"] . "!";
            LogService::info("prodajalec", "Registracija", $sporocilo);
        }

        $potrditveni_kljuc = self::generateConfirmationString();

        PotrditevRegistracije::insert([
            "kljuc" => $potrditveni_kljuc,
            "uporabnik" => $uporabnik
        ]);

        $potrditveni_email = new Email($podatki["email"],
            "Dobrodošel!",
            "app/views/email/confirmation-email.php",
            ["kljuc" => $potrditveni_kljuc,
                "ime" => $podatki["ime"],
                "email" => $podatki["email"],
                "geslo" => $origin_password
            ]);

        EmailService::posljiEmail($potrditveni_email);

        $vrni_uporabnika = Uporabniki::get(["id" => $uporabnik]);
        unset($vrni_uporabnika["geslo"]);
        return $vrni_uporabnika;
    }

    public static function posodobiStranko($podatki) {
        if($podatki["geslo1"] != "" && $podatki["geslo2"] != "") {
            if($podatki["geslo1"] == $podatki["geslo2"]) {
                $rowAffected = Uporabniki::updateStrankaZGeslom([
                    "id" => $podatki["id"],
                    "ime" => $podatki["ime"],
                    "priimek" => $podatki["priimek"],
                    "email" => $podatki["email"],
                    "geslo" => password_hash($podatki["geslo1"], PASSWORD_DEFAULT),
                    "naslov" => $podatki["naslov"],
                    "posta" => $podatki["posta"],
                    "telefon" => $podatki["telefon"]
                ]);
            } else {
                throw new InvalidArgumentException("Gesli se ne ujemata!");
            }
        } else if ($podatki["geslo1"] == "" && $podatki["geslo2"] == "") {
            $rowAffected = Uporabniki::updateStrankaBrezGesla([
                "id" => $podatki["id"],
                "ime" => $podatki["ime"],
                "priimek" => $podatki["priimek"],
                "email" => $podatki["email"],
                "naslov" => $podatki["naslov"],
                "posta" => $podatki["posta"],
                "telefon" => $podatki["telefon"]
            ]);
        } else {
            throw new InvalidArgumentException("Eno od gesel manjka!");
        }
        if($rowAffected != 1){
            throw new InvalidArgumentException("Napaka pri posodabljanju stranke!");
        } else {
            $uporabnik = Uporabniki::get(["id" => $podatki["id"]]);
            unset($uporabnik["geslo"]);
            unset($uporabnik["status"]);
            unset($uporabnik["vloga"]);
            return $uporabnik;
        }
    }

    public static function potrdiUporabnika($kljuc){
        $potrditev = PotrditevRegistracije::getByKey(["kljuc" => $kljuc]);

        Uporabniki::spremeniPotrjen(["status" => StatusUporabnik::getIdAktiven(), "id" => $potrditev["uporabnik"]]);

        LogService::info("", "Potrditev registracije", "Uporabnik " . $potrditev["uporabnik"] . " je potrdil registracijo!");

        PotrditevRegistracije::delete(["id" => $potrditev["id"]]);
    }

    // prodajalci
    public static function vrniVseProdajalce($stran = 1, $limit = null) {
        $limit = ($limit == null)? (int)ConfigurationUtil::getConfByKey("query_prodajalci_limit") : (int)$limit;

        $offset = $limit * ($stran - 1);
        $rez = array();
        $rez["uporabniki"] = Uporabniki::getByVloga(["vloga" => VlogaUporabnik::getIdProdaja(),
            "offset" => $offset, "limit" => $limit]);
        $rez["stevec"] = Uporabniki::countByVloga(["vloga" => VlogaUporabnik::getIdProdaja(),
            "limit" => $limit])[0];
        return $rez;
    }

    public static function vrniProdajalca($id) {
        return Uporabniki::getOneByVloga(["id" => $id, "vloga" => VlogaUporabnik::getIdProdaja()]);
    }

    public static function prijaviOsebje($input){
        $cert = $_SESSION["certifikat"];
        if($cert == null){
            return false;
        }

        $uporabnik = self::preveriPrijavoUporabnika($input);
        if($uporabnik == null){
            return false;
        } else {
            if($cert["email"] == $uporabnik["email"]){
                if($cert["vloga"] == "Prodaja" && VlogaUporabnik::getIdByName(["name" => "prodajalec"]) == $uporabnik["vloga"]){
                    $_SESSION["trenutni_uporabnik"] = $uporabnik;
                    return true;
                } else if($cert["vloga"] == "Admin" && VlogaUporabnik::getIdByName(["name" => "administrator"]) == $uporabnik["vloga"]){
                    $_SESSION["trenutni_uporabnik"] = $uporabnik;
                    return true;
                } else {
                    return false;
                }
            }
            return false;
        }
    }

    public static function dodajProdajalca($podatki) {
        $origin_password = $podatki["geslo"];

        $uporabnik = Uporabniki::insert([
            "vloga" => VlogaUporabnik::getIdProdaja(),
            "ime" => $podatki["ime"],
            "priimek" => $podatki["priimek"],
            "email" => $podatki["email"],
            "geslo" => password_hash($podatki["geslo"], PASSWORD_DEFAULT),
            "status" => StatusUporabnik::getIdAktiven()
        ]);
        LogService::info("admin", "Registracija", "Prodajalec " . $podatki["email"] .
            " je bil registriran!");

        $vrniUporabnika = Uporabniki::get(["id" => $uporabnik]);
        unset($vrniUporabnika["geslo"]);
        $vrniUporabnika["dodeljenoGeslo"] = $origin_password;
        return $vrniUporabnika;
    }

    public static function posodobiProdajalca($podatki) {
        if($podatki["geslo1"] != "" && $podatki["geslo2"] != "") {
            if($podatki["geslo1"] == $podatki["geslo2"]) {
                $rowAffected = Uporabniki::updateOsebjeZGeslom([
                    "id" => $podatki["id"],
                    "ime" => $podatki["ime"],
                    "priimek" => $podatki["priimek"],
                    "email" => $podatki["email"],
                    "geslo" => password_hash($podatki["geslo1"], PASSWORD_DEFAULT)
                ]);
            } else {
                throw new InvalidArgumentException("Gesli se ne ujemata!");
            }
        } else if ($podatki["geslo1"] == "" && $podatki["geslo2"] == "") {
            $rowAffected = Uporabniki::updateOsebjeBrezGesla([
                "id" => $podatki["id"],
                "ime" => $podatki["ime"],
                "priimek" => $podatki["priimek"],
                "email" => $podatki["email"]
            ]);
        } else {
            throw new InvalidArgumentException("Eno od gesel manjka!");
        }
        if($rowAffected != 1){
            throw new InvalidArgumentException("Napaka pri posodabljanju prodajalca!");
        } else {
            $uporabnik = Uporabniki::get(["id" => $podatki["id"]]);
            unset($uporabnik["geslo"]);
            unset($uporabnik["status"]);
            unset($uporabnik["vloga"]);
            return $uporabnik;
        }
    }

    // admin
    public static function posodobiAdmina($podatki) {
        if($podatki["geslo1"] != "" && $podatki["geslo2"] != "") {
            if($podatki["geslo1"] == $podatki["geslo2"]) {
                $rowAffected = Uporabniki::updateOsebjeZGeslom([
                    "id" => $podatki["id"],
                    "ime" => $podatki["ime"],
                    "priimek" => $podatki["priimek"],
                    "email" => $podatki["email"],
                    "geslo" => password_hash($podatki["geslo1"], PASSWORD_DEFAULT)
                ]);
            } else {
                throw new InvalidArgumentException("Gesli se ne ujemata!");
            }
        } else if ($podatki["geslo1"] == "" && $podatki["geslo2"] == "") {
            $rowAffected = Uporabniki::updateOsebjeBrezGesla([
                "id" => $podatki["id"],
                "ime" => $podatki["ime"],
                "priimek" => $podatki["priimek"],
                "email" => $podatki["email"]
            ]);
        } else {
            throw new InvalidArgumentException("Eno od gesel manjka!");
        }
        if($rowAffected != 1){
            throw new InvalidArgumentException("Napaka pri posodabljanju admina!");
        } else {
            $uporabnik = Uporabniki::get(["id" => $podatki["id"]]);
            unset($uporabnik["geslo"]);
            unset($uporabnik["status"]);
            unset($uporabnik["vloga"]);
            return $uporabnik;
        }
    }





    public static function vrniVse(){
        return Uporabniki::getAllSafe();
    }

    public static function vrniVseZGeslom(){
        return Uporabniki::getAll();
    }

    public static function vrniEnega($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        unset($uporabnik["geslo"]);
        return $uporabnik;
    }

    public static function pridobiZEmailom($email){
        return Uporabniki::dobiUporabnikaGledeNaEmail(["email" => $email]);
    }

    public static function pridobiZEmailomStranko($email){
        return Uporabniki::dobiStrankoGledeNaEmail(["email" => $email]);
    }

    public static function posodobiUporabnika($podatki){
        if($podatki["geslo"]){
            $rowAffected = Uporabniki::update([
                "id" => $podatki["id"],
                "vloga" => $podatki["vloga"],
                "ime" => $podatki["ime"],
                "priimek" => $podatki["priimek"],
                "email" => $podatki["email"],
                "geslo" => password_hash($podatki["geslo"], PASSWORD_DEFAULT),
                "naslov" => $podatki["naslov"],
                "posta" => $podatki["posta"],
                "status" => Uporabniki::get(["id" => $podatki["id"]])["status"]
            ]);
            if($rowAffected <= 0){
                throw new InvalidArgumentException("Napaka pri posodabljanju izdelka!");
            }
        } else {
            $rowAffected = Uporabniki::updateNoPassword([
                "id" => $podatki["id"],
                "vloga" => $podatki["vloga"],
                "ime" => $podatki["ime"],
                "priimek" => $podatki["priimek"],
                "email" => $podatki["email"],
                "naslov" => $podatki["naslov"],
                "posta" => $podatki["posta"],
                "status" => Uporabniki::get(["id" => $podatki["id"]])["status"]
            ]);
            if($rowAffected <= 0){
                throw new InvalidArgumentException("Napaka pri posodabljanju uporabnika!");
            }
        }
    }

    public static function dodajUporabnika($podatki){

        $origin_password = $podatki["geslo"];

        $uporabnik = Uporabniki::insert([
            "vloga" => $podatki["vloga"],
            "ime" => $podatki["ime"],
            "priimek" => $podatki["priimek"],
            "email" => $podatki["email"],
            "geslo" => password_hash($podatki["geslo"], PASSWORD_DEFAULT),
            "naslov" => $podatki["naslov"],
            "posta" => $podatki["posta"],
            "status" => StatusUporabnik::getByName(["name" => "nepotrjen"])["id"]
        ]);

        LogService::info("", "Registracija", "uporabnik " . $podatki["email"] . " je bil registriran!");

        $potrditveni_kljuc = self::generateConfirmationString();

        PotrditevRegistracije::insert([
            "kljuc" => $potrditveni_kljuc,
            "uporabnik" => $uporabnik
        ]);

        $potrditveni_email = new Email($podatki["email"],
            "Dobrodošel!",
            "app/views/email/confirmation-email.php",
            ["kljuc" => $potrditveni_kljuc,
             "ime" => $podatki["ime"],
             "email" => $podatki["email"],
             "geslo" => $origin_password
            ]);

        EmailService::posljiEmail($potrditveni_email);

        $vrni_uporabnika = Uporabniki::get(["id" => $uporabnik]);
        unset($vrni_uporabnika["geslo"]);
        return $vrni_uporabnika;
    }






    // android
    public static function vrniUporabnikaSSeznamomPost($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        unset($uporabnik["geslo"]);
        $poste = Posta::getAll();
        return ["uporabnik" => $uporabnik, "poste" => $poste];
    }

    public static function preveriPrijavoStranke($input){
        $uporabnik = self::pridobiZEmailomStranko($input["email"]);
        if($uporabnik == null){
            return null;
        }
        if(password_verify($input["geslo"], $uporabnik["geslo"]) && self::jeAktiven($uporabnik["id"])){
            unset($uporabnik["geslo"]);
            return $uporabnik;
        } else {
            return null;
        }
    }

    public static function preveriPrijavoUporabnika($input){
        $uporabnik = self::pridobiZEmailom($input["email"]);
        if($uporabnik == null){
            return null;
        }
        if(password_verify($input["geslo"], $uporabnik["geslo"]) && self::jeAktiven($uporabnik["id"])){
            unset($uporabnik["geslo"]);
            return $uporabnik;
        } else {
            return null;
        }
    }

    // helper metode
    private static function generateConfirmationString(){
        $potrditveni_kljuc = null;
        do {
            $potrditveni_kljuc = substr(md5(rand()), 0, 10);
            if(PotrditevRegistracije::getByKey(["kljuc" => $potrditveni_kljuc]) != null){
                $potrditveni_kljuc = null;
            }
        } while($potrditveni_kljuc == null);
        return $potrditveni_kljuc;
    }

    public static function preveriDaNiPraznihVrednosti($input) {
        if(empty($input)){
            return FALSE;
        }
        $result = TRUE;
        foreach ($input as $value){
            $result = $result && $value != false;
        }
        return $result;
    }

    public static function preveriDaNiPraznihVrednostiPreskociGeslo($input){
        if(empty($input)){
            return FALSE;
        }
        $result = TRUE;
        foreach ($input as $key => $value){
            if($key == "geslo1" || $key == "geslo2"){
                continue;
            }
            $result = $result && $value != false;
        }
        return $result;
    }





}