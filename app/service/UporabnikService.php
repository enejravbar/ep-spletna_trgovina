<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 23:39
 */

require_once "app/models/Uporabniki.php";
require_once "app/models/PotrditevRegistracije.php";

class UporabnikService {

    private static function generateConfirmationString(){
        return substr(md5(rand()), 0, 10);
    }

    public static function dodajUporabnika($podatki){
        $uporabnik = Uporabniki::insert([
            "vloga" => 1,
            "ime" => "Janez",
            "priimek" => "Janša",
            "email" => "miha_jamsek@windowslive.com",
            "geslo" => "hahshsh",
            "naslov" => "kr en naslov",
            "potrjen" => 0

        ]);
        PotrditevRegistracije::insert([
            "kljuc" => self::generateConfirmationString(),
            "uporabnik" => $uporabnik
        ]);

    }

}