<?php

require_once "app/models/Kosarice.php";


class KosaricaService {

    public static function vrniVsebinoKosarice($id_stranke) {
        return Kosarice::dobiKosaricoUporabnika(["id_uporabnika" => $id_stranke]);
    }

    public static function dodajIzdelekVKosarico($podatki) {
        $izdelek = Kosarice::get([
            "id_uporabnika" => $podatki["id_uporabnika"],
            "id_izdelka" => $podatki["id_izdelka"]
        ]);
        if ($izdelek == null) { // vstavi izdelek v bazo
            Kosarice::insert([
                "id_uporabnika" => $podatki["id_uporabnika"],
                "id_izdelka" => $podatki["id_izdelka"],
                "kolicina" => $podatki["kolicina"]
            ]);
        } else { // povecaj kolicino izdelka za 1
            self::spremeniKolicinoIzdelkaVKosarici([
                "id_uporabnika" => $podatki["id_uporabnika"],
                "id_izdelka" => $podatki["id_izdelka"],
                "sprememba" => 1
            ]);
        }
    }

    public static function spremeniKolicinoIzdelkaVKosarici($podatki) {
        $odgovor = Kosarice::spremeniKolicino($podatki);

        if ($podatki["sprememba"] == -1) {
            $izdelek = Kosarice::get([
                "id_uporabnika" => $podatki["id_uporabnika"],
                "id_izdelka" => $podatki["id_izdelka"]
            ]);
            if ($izdelek["kolicina"] == 0) { // preveri, če je količina prišla na 0. če je ga izbriši iz košarice
                self::izbrisiIzdelekIzKosarice([
                    "id_uporabnika" => $podatki["id_uporabnika"],
                    "id_izdelka" => $podatki["id_izdelka"]
                ]);
            }
        }
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