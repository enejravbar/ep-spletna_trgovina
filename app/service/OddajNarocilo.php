<?php

require_once "ViewUtil.php";
require_once "app/models/Narocila.php";
require_once "app/models/Kosarice.php";
require_once "app/models/NarociloIzdelki.php";
require_once "app/models/Izdelki.php";

class OddajNarocilo {

    private static $prijavljen;

    function __construct() {
        $this -> prijavljen = ViewUtil::prijavljenUser(3);
    }

    public static function oddajNarocilo() {
        $kosarica = Kosarice::dobiKosaricoUporabnika(["id_uporabnika" => self::$prijavljen["id"]]);

        //TODO naredi transakcijsko

        $id_narocila = Narocila::insert(["kupec" => self::$prijavljen["id"], "datum" => date("Y-m-d H:i:s"), "status" => 1]);

        foreach ($kosarica as $izdelek_kos) {
            $izdelek = Izdelki::get(["id" => $izdelek_kos["id"]]);

            NarociloIzdelki::insert(["id_narocila" => $id_narocila, "ime" => $izdelek["ime"], "opis" => $izdelek["opis"], "cena" => $izdelek["cena"], "kolicina" => $izdelek_kos["kolicina"]]);
        }
    }
}