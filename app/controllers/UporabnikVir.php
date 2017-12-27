<?php

require_once "ViewUtil.php";
require_once "app/models/Uporabniki.php";

class UporabnikVir {

    public static function aktivirajUporabnika($id_uporabnika) {
        Uporabniki::update(["id" => $id_uporabnika, "status" => 1]);
    }

    public static function deaktivirajUporabnika($id_uporabnika) {
        Uporabniki::update(["id" => $id_uporabnika, "status" => 2]);
    }


}