<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 14:52
 */

require_once "app/models/VlogaUporabnik.php";
require_once "app/models/Uporabniki.php";

class PrijavaService {

    const ADMIN = "administrator";
    const PRODAJA = "prodajalec";
    const STRANKA = "stranka";

    public static function trenutniUporabnikImaVlogo($vloga){
        if(isset($_SESSION["trenutni_uporabnik"])){
            return $_SESSION["trenutni_uporabnik"]["vloga"] == VlogaUporabnik::getIdByName(["name" => $vloga]);
        }
        return false;
    }

    public static function uporabnikJePrijavljen(){
        return isset($_SESSION["trenutni_uporabnik"]);
    }

    public static function uporabnikJeAdmin(){
        return self::trenutniUporabnikImaVlogo(self::ADMIN);
    }

    public static function uporabnikJeProdajalec(){
        return self::trenutniUporabnikImaVlogo(self::PRODAJA);
    }

    public static function uporabnikJeStranka(){
        return self::trenutniUporabnikImaVlogo(self::STRANKA);
    }

    public static function vrniTrenutnegaUporabnika(){
        if(isset($_SESSION["trenutni_uporabnik"])){
            return $_SESSION["trenutni_uporabnik"];
        }
        return null;
    }

    public static function vrniTrenutnegaIzBaze() {
        $id = self::vrniIdTrenutnegaUporabnika();
        return Uporabniki::get(["id" => $id]);
    }

    public static function vrniIdTrenutnegaUporabnika() {
        return self::vrniTrenutnegaUporabnika()["id"];
    }

}