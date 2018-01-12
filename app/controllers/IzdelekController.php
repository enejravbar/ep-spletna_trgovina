<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:34
 */

require_once "ViewUtil.php";

class IzdelekController {

    public static function prikaziPodrobnostIzdelka($id){
        echo ViewUtil::render("app/views/izdelki/podrobnost-izdelka.php", ["id" => $id]);
    }

    public static function prikaziSeznamIzdelkov() {
        $query = $_GET["q"];
        echo ViewUtil::render("app/views/izdelki/seznam-izdelkov.php", ["query" => $query]);
    }

}