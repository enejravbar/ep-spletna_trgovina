<?php

require_once "app/models/Entiteta.php";

class Ocene extends Entiteta {

    public static function dobiOceneZaIzdelek(array $id_izdelka) {
        return parent::query("SELECT ocena FROM ocene WHERE id_izdelka = :id_izdelka", $id_izdelka);
    }

    public static function get(array $params)
    {
        $ocena = parent::query(
            "SELECT * FROM ocene WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka",
                $params
            );
        if (count($ocena) == 1) {
            return $ocena[0];
        } else {
            throw new InvalidArgumentException("Ocena ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM ocene ORDER BY id_izdelka ASC, id_uporabnika ASC");
    }

    public static function insert(array $params)
    {
        return parent::modify(
            "INSERT INTO ocene(id_uporabnika, id_izdelka, ocena) VALUES(:id_uporabnika, :id_izdelka, :ocena)",
            $params
        );
    }

    public static function update(array $params)
    {
        return parent::modify_update(
            "UPDATE ocene SET ocena WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka",
            $params
        );
    }

    public static function delete(array $params)
    {
        return parent::modify_update("DELETE FROM ocena WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka", $params);
    }

}