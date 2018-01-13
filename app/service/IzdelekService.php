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
require_once "app/service/SlikaService.php";

class IzdelekService {

    public static function pridobiVseIzdelke(){
        return Izdelki::getAll();
    }

    public static function isciPoQueryju($query) {
        $query = "%" . $query . "%";
        return Izdelki::getAllByQuery(["query" => $query]);
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
            "id" => $podatki["id"]
        ]);
        if($rowAffected <= 0){
            throw new InvalidArgumentException("Napaka pri posodabljanju izdelka!");
        }
        return $rowAffected;
    }

    public static function izbrisiIzdelek($id){
        $rowAffected = Izdelki::delete(["id" => $id]);
        if($rowAffected <= 0){
            throw new InvalidArgumentException("Napaka pri brisanju izdelka!");
        }
    }

    public static function shraniIzdelek($podatki, array $SLIKE){
        $new_id = Izdelki::insert([
            "kategorija" => $podatki["kategorija"],
            "ime" => $podatki["ime"],
            "opis" => $podatki["opis"],
            "cena" => $podatki["cena"],
            "status" => $podatki["status"]
        ]);
        if($new_id == 0){
            throw new InvalidArgumentException("Napaka pri vstavljanju izdelka!");
        }

        for($i = 0; $i < count($SLIKE); $i++){
            SlikaService::shraniSlikoIzdelka($SLIKE[$i], $new_id);
        }


        return self::pridobiEnIzdelek($new_id);
    }

    public static function dobiZadnjihNIzdelkov($n) {
        return Izdelki::getNLatest(["n" => $n]);
    }

    public static function dobiNNajboljeOcenjenihIzdelkov($n) {
        return Izdelki::getNBestrated(["n" => $n]);
    }
}