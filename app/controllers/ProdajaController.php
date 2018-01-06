<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:30
 */

require_once "ViewUtil.php";

class ProdajaController {

    public static function prikaziSeznamIzdelkov(){
        echo ViewUtil::render("app/views/prodaja/izdelki/pregled-izdelkov.php");
    }

    public static function prikaziDodajanjeIzdelkov(){
        echo ViewUtil::render("app/views/prodaja/izdelki/dodaj-izdelek.php");
    }

    public static function prikaziUrejanjeIzdelkov(){
        echo ViewUtil::render("app/views/prodaja/izdelki/uredi-izdelek.php");
    }

    public static function prikaziSeznamNarocil(){
        echo ViewUtil::render("app/views/prodaja/narocila/pregled-narocil.php");
    }

    public static function prikaziPodrobnostNarocil(){
        echo ViewUtil::render("app/views/prodaja/narocila/podrobnost-narocila.php");
    }

    public static function prikaziDodajanjeStrank(){
        echo ViewUtil::render("app/views/prodaja/stranke/dodaj-stranko.php");
    }

    public static function prikaziUrejanjeStrank(){
        echo ViewUtil::render("app/views/prodaja/stranke/uredi-stranko.php");
    }

    public static function prikaziSeznamStrank(){
        echo ViewUtil::render("app/views/prodaja/stranke/pregled-strank.php");
    }

}