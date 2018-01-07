<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 7.1.2018
 * Time: 1:14
 */

require_once "app/models/Kosarice.php";


class KosaricaService {

    public static function vrniVsebinoKosarice($id_stranke) {
        return Kosarice::dobiKosaricoUporabnika(["id_uporabnika" => $id_stranke]);
    }

    public static function dodajIzdelekVKosarico($podatki) {
        $id_zapisa = Kosarice::insert([
            "id_uporabnika" => $podatki["id_uporabnika"],
            "id_izdelka" => $podatki["id_izdelka"],
            "kolicina" => $podatki["kolicina"]
        ]);
        if($id_zapisa == 0){
            throw new InvalidArgumentException("Napaka pri dodajanju v kosarico!");
        }
    }

    public static function spremeniKolicinoIzdelkaVKosarici($podatki) {
        Kosarice::updateKolicino([
            "id_uporabnika" => $podatki["id_uporabnika"],
            "id_izdelka" => $podatki["id_izdelka"],
            "kolicina" => $podatki["kolicina"]
        ]);
    }

    public static function izbrisiIzdelekIzKosarice($podatki) {
        Kosarice::delete([
            "id_uporabnika" => $podatki["id_uporabnika"],
            "id_izdelka" => $podatki["id_izdelka"]
        ]);
    }

    public static function izprazniKosarico($id_stranke) {
        Kosarice::izprazni(["id" => $id_stranke]);
    }

}