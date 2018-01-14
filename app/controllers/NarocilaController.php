<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:23
 */

require_once "ViewUtil.php";
require_once "app/service/PrijavaService.php";

class NarocilaController {

    public static function prikaziNarocila() {
        if(PrijavaService::uporabnikJeStranka()){
            echo ViewUtil::render("app/views/stranka/narocila/seznam-narocil.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziEnoNarocilo($id){
        if(PrijavaService::uporabnikJeStranka()){
            echo ViewUtil::render("app/views/stranka/narocila/podrobnost-narocila.php", ["id" => $id]);
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

}