<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:34
 */

require_once "ViewUtil.php";

class IzdelekController {

    public static function prikaziPodrobnostIzdelka(){
        echo ViewUtil::render("app/views/izdelki/podrobnost-izdelka.php");
    }

}