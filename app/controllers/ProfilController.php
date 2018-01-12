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

            if(PrijavaService::uporabnikJeStranka()) {
                echo ViewUtil::render("app/views/profil/profil-stranke.php");
            } else {
                echo ViewUtil::render("app/views/profil/profil-osebje.php");
            }
        } else {
            ViewUtil::redirect(BASE_URL);
        }

    }

}