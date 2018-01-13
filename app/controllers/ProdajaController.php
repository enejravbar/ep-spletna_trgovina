<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 12:30
 */

require_once "ViewUtil.php";
require_once "app/service/PrijavaService.php";

class ProdajaController {

    public static function prikaziSeznamIzdelkov(){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/izdelki/pregled-izdelkov.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziDodajanjeIzdelkov(){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/izdelki/dodaj-izdelek.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziUrejanjeIzdelkov($id){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/izdelki/uredi-izdelek.php", ["id" => $id]);
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziSeznamNarocil(){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/narocila/pregled-narocil.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziPodrobnostNarocil($id){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/narocila/podrobnost-narocila.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziDodajanjeStrank(){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/stranke/dodaj-stranko.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziUrejanjeStrank($id){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/stranke/uredi-stranko.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

    public static function prikaziSeznamStrank(){
        if(PrijavaService::uporabnikJeProdajalec()){
            echo ViewUtil::render("app/views/prodaja/stranke/pregled-strank.php");
        } else {
            ViewUtil::redirect(BASE_URL);
        }
    }

}