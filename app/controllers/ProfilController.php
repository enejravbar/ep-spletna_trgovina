<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:27
 */

require_once "ViewUtil.php";
require_once "app/service/PrijavaService.php";

class ProfilController {

    public static function PrikaziUrejanjeProfila(){

        if(PrijavaService::uporabnikJePrijavljen()){
            echo ViewUtil::render("app/views/profil/profil-uporabnika.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }

    }

}