<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 5.1.2018
 * Time: 20:01
 */

require_once "ViewUtil.php";

class KosaricaController {

    public static function prikaziKosarico(){
        echo ViewUtil::render("app/views/stranka/kosarica/kosarica.php");
    }

}