<?php

require_once "ViewUtil.php";
require_once "app/models/Narocila.php";

class NarociloVir {

    private static $prijavljen;

    function __construct() {
        $this -> prijavljen = ViewUtil::prijavljenUser(3);
    }

    public static function dobiNarocilaKupca() {
        $data = Narocila::dobiNarocilaKupca(["id" => self::$prijavljen["id"]]);
    }

    public static function dobiNeobdelanaNarocila() {
        $data = Narocila::dobiNarocilaPoStatusu(["status" => 1]);
    }

    public static function dobiPotrjenaNarocila() {
        $data = Narocila::dobiNarocilaPoStatusu(["status" => 2]);
    }

    public static function potrdiNarocilo($id_narocila) {
        Narocila::update(["id" => $id_narocila, "status" => 2]);
    }

    public static function prekliciNarocilo($id_narocila) {
        Narocila::update(["id" => $id_narocila, "status" => 3]);
    }
}