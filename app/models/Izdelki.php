<?php

require_once "app/models/Entiteta.php";

class Izdelki extends Entiteta {

    public static function dobiVseSortiraneIzdelke(array $params) {
        return parent::query("SELECT * FROM izdelki ORDER BY :kaj :smer", $params);
    }

    public static function dobiSortiraneIzdelkeIzKategorije(array $params) {
        return parent::query("SELECT * FROM izdelki WHERE kategorija = :kategorija ORDER BY :kaj :smer", $params);
    }

    public static function get(array $id)
    {
        $izdelek = parent::query("SELECT * FROM izdelki WHERE id = :id", $id);
        if (count($izdelek) == 1) {
            return $izdelek[0];
        } else {
            throw new InvalidArgumentException("Izdelek ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM izdelki ORDER BY id ASC");
    }

    public static function insert(array $params)
    {
        return parent::modify(
            "INSERT INTO izdelki(kategorija, ime, opis, cena, status, slika_url) VALUES(:kategorija, :ime, :opis, :cena, :status, :slika_url)",
            $params
        );
    }

    public static function update(array $params)
    {
        return parent::modify_update(
            "UPDATE izdelki SET kategorija = :kategorija, ime = :ime, opis = :opis, cena = :cena, status = :status, slika_url = :slika_url WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id)
    {
        return parent::modify_update("DELETE FROM izdelki WHERE id = :id", $id);
    }

    public static function pridobiPravila(){
        return [
            "kategorija" => FILTER_VALIDATE_INT,
            "ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "opis" => FILTER_SANITIZE_SPECIAL_CHARS,
            "cena" => FILTER_VALIDATE_FLOAT,
            "status" => FILTER_VALIDATE_INT,
            "slika_url" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

}