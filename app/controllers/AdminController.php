<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:29
 */

require_once "ViewUtil.php";
require_once "app/service/PrijavaService.php";

class AdminController {

    public static function prikaziSeznamProdajalcev(){
        if(PrijavaService::uporabnikJeAdmin()){
            echo ViewUtil::render("app/views/admin/prodajalci/pregled-prodajalcev.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziDodajanjeProdajalcev(){
        if(PrijavaService::uporabnikJeAdmin()){
            echo ViewUtil::render("app/views/admin/prodajalci/dodaj-prodajalca.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziUrejanjeProdajalcev($id){
        if(PrijavaService::uporabnikJeAdmin()){
            echo ViewUtil::render("app/views/admin/prodajalci/uredi-prodajalca.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

}