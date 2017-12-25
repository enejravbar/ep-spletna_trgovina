<?php

require_once "app/models/Entiteta.php";

class Izdelki extends Entiteta {

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
        return parent::modify(
            "UPDATE izdelki SET kategorija = :kategorija, ime = :ime, opis = :opis, cena = :cena, status = :status, slika_url = :slika_url WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM izdelki WHERE id = :id", $id);
    }

}