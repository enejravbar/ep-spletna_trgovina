<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 30.12.2017
 * Time: 17:25
 */

require_once "app/service/FileService.php";
require_once "app/models/Slika.php";

class SlikaService {

    public static function pridobiSliko($id){
        return Slika::get(["id" => $id]);
    }

    public static function shraniSlikoIzdelka($SLIKA, $ID_IZDELKA){
        $LOKACIJA = ConfigurationUtil::getConfByKey("images_root_dir");
        $novi_id_slike = Slika::pridobiStevilkoSlike(["izdelek_id" => $ID_IZDELKA]);

        $ime_slike = "izdelek" . $ID_IZDELKA . "-" . $novi_id_slike;

        FileService::naloziSliko($SLIKA, $ime_slike);

        $imageFileType = strtolower(pathinfo(basename($SLIKA["name"]), PATHINFO_EXTENSION));

        $target_file = $LOKACIJA . $ime_slike . "." . $imageFileType;

        $ime_slike = $ime_slike . "." . $imageFileType;

        Slika::insert(["naziv" => $ime_slike, "lokacija" => $target_file, "ext" => $imageFileType, "izdelek" => $ID_IZDELKA]);
    }

    public static function pridobiSlikeIzdelka($id){
        return Slika::pridobiSlikeIzdelka(["id_izdelka" => $id]);
    }

    public static function izbrisiSliko($id){
        $slika = Slika::get(["id" => $id]);
        FileService::izbrisiDatoteko($slika["lokacija"]);
        Slika::delete(["id" => $id]);
    }

}