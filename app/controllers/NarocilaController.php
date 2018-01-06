<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:23
 */

require_once "ViewUtil.php";

class NarocilaController {

    public static function prikaziNarocila() {
        echo ViewUtil::render("app/views/stranka/narocila/seznam-narocil.php");
    }

    public static function prikaziEnoNarocilo(){
        echo ViewUtil::render("app/views/stranka/narocila/podrobnost-narocila.php");
    }

}