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

class UporabnikService {

    private static function pridobiZEmailom($email){
        return Uporabniki::dobiUporabnikaGledeNaEmail(["email" => $email]);
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
            "Dobrodosel!",
            "app/views/confirmation-email.php",
            ["kljuc" => $potrditveni_kljuc,
             "ime" => $podatki["ime"],
             "email" => $podatki["email"],
             "geslo" => $origin_password
            ]);

        EmailService::posljiEmail($potrditveni_email);

        return Uporabniki::get(["id" => $uporabnik]);
    }

    public static function potrdiUporabnika($kljuc){
        $potrditev = PotrditevRegistracije::getByKey(["kljuc" => $kljuc]);

        Uporabniki::spremeniPotrjen(["potrjen" => 1, "id" => $potrditev["uporabnik"]]);

        LogService::info("", "Potrditev registracije", "Uporabnik" . $potrditev["uporabnik"] . " je potrdil registracijo!");

        PotrditevRegistracije::delete(["id" => $potrditev["id"]]);
    }

}