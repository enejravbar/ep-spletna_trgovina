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

    public static function pridobiVseIzdelke($stran = 1, $limit = null){
        $limit = ($limit == null)? (int)ConfigurationUtil::getConfByKey("query_izdelki_limit") : (int)$limit;
        $offset = $limit * ($stran - 1);
        $rez = array();
        $rez["izdelki"] = Izdelki::getAllByPage(["offset" => $offset, "limit" => $limit]);
        $rez["stevec"] = Izdelki::countByPages(["limit" => $limit])[0];
        return $rez;
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