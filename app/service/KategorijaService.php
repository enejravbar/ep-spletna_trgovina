<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 31.12.2017
 * Time: 15:42
 */

require_once "app/models/Kategorija.php";
require_once "app/models/Izdelki.php";

class KategorijaService {

    public static function vrniVseKategorije(){
        return Kategorija::getAll();
    }

    public static function vrniVseIzdelkePoKategoriji($id){
        return Izdelki::dobiIzdelkeIzKategorije(["kategorija" => $id]);

    }

}