<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:27
 */

require_once "ViewUtil.php";

class ProfilController {

    public static function PrikaziUrejanjeProfila(){
        echo ViewUtil::render("app/views/profil/profil-uporabnika.php");
    }

}