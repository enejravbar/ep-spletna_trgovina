<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.12.2017
 * Time: 13:46
 */

require_once "ConfigurationUtil.php";
require_once "app/models/Izdelki.php";
require_once "app/service/FileService.php";

class IzdelekService {

    public static function pridobiVseIzdelke(){
        return Izdelki::getAll();
    }

    public static function pridobiEnIzdelek($id){
        return Izdelki::get(["id" => $id]);
    }

    public static function posodobiIzdelek($podatki){
        $rowAffected = Izdelki::update([
            "kategorija" => $podatki["kategorija"],
            "ime" => $podatki["ime"],
            "opis" => $podatki["opis"],
            "cena" => $podatki["cena"],
            "status" => $podatki["status"],
            "slika_url" => $podatki["slika_url"],
            "id" => $podatki["id"]
        ]);
        if($rowAffected <= 0){
            throw new InvalidArgumentException("Napaka pri posodabljanju izdelka!");
        }
    }

    public static function izbrisiIzdelek($id){
        $rowAffected = Izdelki::delete(["id" => $id]);
        if($rowAffected <= 0){
            throw new InvalidArgumentException("Napaka pri brisanju izdelka!");
        }
    }

    public static function shraniIzdelek($podatki, $SLIKA){
        $IMG_ROOT = ConfigurationUtil::getConfByKey("images_root_dir");
        $pot_do_slike = $IMG_ROOT . $SLIKA["name"];

        FileService::naloziSliko($SLIKA);

        $new_id = Izdelki::insert([
            "kategorija" => $podatki["kategorija"],
            "ime" => $podatki["ime"],
            "opis" => $podatki["opis"],
            "cena" => $podatki["cena"],
            "status" => $podatki["status"],
            "slika_url" => $pot_do_slike
        ]);
        if($new_id == 0){
            throw new InvalidArgumentException("Napaka pri vstavljanju izdelka!");
        }
        return self::pridobiEnIzdelek($new_id);
    }

}