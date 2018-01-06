<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 5.1.2018
 * Time: 20:00
 */

require_once "ViewUtil.php";
require_once "app/service/UporabnikService.php";
require_once "app/models/Uporabniki.php";

class LoginController {

    public static function prikaziPrijavnoStran(){
        echo ViewUtil::render("app/views/prijava/stranke-prijava.php");
    }

    public static function prikaziRegistracijskoStran(){
        echo ViewUtil::render("app/views/prijava/stranke-registracija.php");
    }

    public static function prikaziPrijavnoStranZaOsebje(){

        $cert_data = self::getCertData();

        $vloga = self::getFromCertByKey($cert_data, "OU");
        $ime = self::getFromCertByKey($cert_data, "CN");

        echo ViewUtil::render("app/views/prijava/osebje-prijava.php", ["email" => $ime]);

    }

    public static function prijaviStranko(){
        $data = filter_input_array(INPUT_POST, Uporabniki::getLoginRules());
        if(ViewUtil::checkValues($data)){
            $prijavljen = UporabnikService::prijaviStranko($data);
            if($prijavljen){
                echo ViewUtil::renderJSON(["prijavljen" => true], 200);
            } else {
                echo ViewUtil::renderJSON([
                    "napaka" => "Napačen elektronski naslov in/ali geslo!",
                    "prijavljen" => false], 401);
            }
        } else {
            echo ViewUtil::renderJSON([
                "napaka" => "Manjkajo podatki za prijavo!",
                "prijavljen" => false], 401);
        }
    }

    public static function registrirajStranko(){
        //TODO:
    }

    public static function odjaviUporabnika(){
        unset($_SESSION["trenutni_uporabnik"]);
        session_destroy();
        ViewUtil::redirect(BASE_URL);
    }

    private static function getFromCertByKey($cert_data, $key){
        if(is_array($cert_data['subject'][$key])){
            return $cert_data['subject'][$key][0];
        } else {
            return $cert_data['subject'][$key];
        }
    }

    private static function getCertData(){
        $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");

        if($client_cert == null){
            die("Napaka! Certifikat ni nastavljen!");
        }
        return openssl_x509_parse($client_cert);
    }

}