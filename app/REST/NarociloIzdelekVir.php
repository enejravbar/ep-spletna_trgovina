<?php

require_once "ViewUtil.php";
require_once "app/models/NarociloIzdelki.php";

class NarociloIzdelekVir {

    public static function dobiIzdelkeNarocila($id_narocila) {
        $data = NarociloIzdelki::dobiIzdelkeIzNarocila(["id_narocila" => $id_narocila]);
    }
}