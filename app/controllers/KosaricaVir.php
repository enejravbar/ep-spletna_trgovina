<?php

require_once "ViewUtil.php";
require_once "app/models/Kosarice.php";

class KosaricaVir {

    private static $prijavljen;

    function __construct() {
        $this -> prijavljen = ViewUtil::prijavljenUser(3);
    }


    public static function dobiKosarico() {
        $data = Kosarice::dobiKosaricoUporabnika(["id" => self::$prijavljen["id"]]);
    }

    public static function spremeniKolicinoIzdelka($id_izdelka, $kolicina) {
        Kosarice::update(["id_uporabnika" => self::$prijavljen["id"], "id_izdelka" => $id_izdelka, "kolicina" => $kolicina]);
    }

    public static function dodajIzdelek($id_izdelka, $kolicina) {
        Kosarice::insert(["id_uporabnika" => self::$prijavljen["id"], "id_izdelka" => $id_izdelka, "kolicina" => $kolicina]);
    }

    public static function odstraniIzdelek($id_izdelka) {
        Kosarice::delete(["id_uporabnika" => self::$prijavljen["id"], "id_izdelka" => $id_izdelka]);
    }
}