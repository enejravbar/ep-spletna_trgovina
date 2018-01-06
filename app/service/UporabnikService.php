<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 23:39
 */

require_once "app/models/Uporabniki.php";
require_once "app/models/PotrditevRegistracije.php";
require_once "app/models/Email.php";
require_once "app/service/EmailService.php";
require_once "app/service/LogService.php";
require_once "app/models/StatusUporabnik.php";
require_once "app/models/Posta.php";

class UporabnikService {

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

    public static function prijaviStranko($input){
        $uporabnik = self::preveriPrijavoUporabnika($input);
        if($uporabnik == null){
            return false;
        } else {
            $_SESSION["trenutni_uporabnik"] = $uporabnik;
            return true;
        }
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
                throw new InvalidArgumentException("Napaka pri posodabljanju izdelka!");
            }
        }
    }

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

    public static function potrdiUporabnika($kljuc){
        $potrditev = PotrditevRegistracije::getByKey(["kljuc" => $kljuc]);

        Uporabniki::spremeniPotrjen(["status" => StatusUporabnik::getByName(["name" => "aktiven"])["id"], "id" => $potrditev["uporabnik"]]);

        LogService::info("", "Potrditev registracije", "Uporabnik" . $potrditev["uporabnik"] . " je potrdil registracijo!");

        PotrditevRegistracije::delete(["id" => $potrditev["id"]]);
    }

    public static function izbrisiUporabnika($id){
        if(self::jeNepotrjen($id)){
            $rows = PotrditevRegistracije::deleteByUporabnik(["id" => $id]);
        }
        $rowsAffected = Uporabniki::delete(["id" => $id]);
        echo "VRSTIC: " . $rowsAffected;
        if($rowsAffected <= 0){
            throw new InvalidArgumentException("Napaka pri brisanju uporabnika!");
        }
    }

    private static function jeNepotrjen($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        return $uporabnik["status"] == StatusUporabnik::getByName(["name" => "nepotrjen"])["id"];
    }

    private static function jeAktiven($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        return $uporabnik["status"] == StatusUporabnik::getByName(["name" => "aktiven"])["id"];
    }

    public static function vrniUporabnikaSSeznamomPost($id){
        $uporabnik = Uporabniki::get(["id" => $id]);
        unset($uporabnik["geslo"]);
        $poste = Posta::getAll();
        return ["uporabnik" => $uporabnik, "poste" => $poste];
    }

}