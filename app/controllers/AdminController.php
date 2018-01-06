<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:29
 */

require_once "ViewUtil.php";

class AdminController {

    public static function prikaziSeznamProdajalcev(){
        echo ViewUtil::render("app/views/admin/prodajalci/pregled-prodajalcev.php");
    }

    public static function prikaziDodajanjeProdajalcev(){
        echo ViewUtil::render("app/views/admin/prodajalci/dodaj-prodajalca.php");
    }

    public static function prikaziUrejanjeProdajalcev(){
        echo ViewUtil::render("app/views/admin/prodajalci/uredi-prodajalca.php");
    }

}