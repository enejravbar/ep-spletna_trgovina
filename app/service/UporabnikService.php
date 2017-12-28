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

class UporabnikService {

    private static function generateConfirmationString(){
        return substr(md5(rand()), 0, 10);
    }

    public static function dodajUporabnika($podatki){
        $uporabnik = Uporabniki::insert([
            "vloga" => 1,
            "ime" => "Janez",
            "priimek" => "Janaa",
            "email" => "miha_jamsek@windowslive.com",
            "geslo" => "hahshsh",
            "naslov" => 1,
            "potrjen" => 0
        ]);
        var_dump($uporabnik);

        LogService::info("", "Registracija", "uporabnik $uporabnik je bil registriran!");

        $potrditveni_kljuc = "-1";

        do {
            $potrditveni_kljuc = self::generateConfirmationString();
        } while($potrditveni_kljuc != null);

        PotrditevRegistracije::insert([
            "kljuc" => $potrditveni_kljuc,
            "uporabnik" => $uporabnik
        ]);

        $potrditveni_email = new Email("miha_jamsek@windowslive.com",
            "Dobrodosel!",
            "app/views/confirmation-email.php",
            ["kljuc" => $potrditveni_kljuc]);

        try{
            EmailService::posljiEmail($potrditveni_email);
        } catch(Exception $e){
            echo "NAPAKA! " . $e;
        }

    }

    public static function potrdiUporabnika($kljuc){
        $potrditev = PotrditevRegistracije::getByKey(["kljuc" => $kljuc]);

        Uporabniki::spremeniPotrjen(["potrjen" => 1, "id" => $potrditev["uporabnik"]]);

        LogService::info("", "Potrditev registracije", "Uporabnik" . $potrditev["uporabnik"] . " je potrdil registracijo!");

        PotrditevRegistracije::delete(["id" => $potrditev["id"]]);
    }

}