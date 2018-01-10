<?php

require_once "app/models/Entiteta.php";

class Kosarice extends Entiteta {

    public static function dobiKosaricoUporabnika(array $id_uporabnika) {
        return parent::query("SELECT i.id, k.kolicina, i.ime, i.cena FROM kosarice k ".
            "INNER JOIN izdelki i ON i.id = k.id_izdelka ".
            "WHERE k.id_uporabnika = :id_uporabnika ORDER BY i.id ASC", $id_uporabnika);
    }

    public static function get(array $params)
    {
        $kosarica = parent::query(
            "SELECT * FROM kosarice WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka",
            $params
        );
        if (count($kosarica) == 1) {
            return $kosarica[0];
        } else {
            throw new InvalidArgumentException("Kosarica ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM kosarice ORDER BY id_uporabnika ASC, id_izdelka ASC");
    }

    public static function insert(array $params) {
        return parent::modify(
            "INSERT INTO kosarice(id_uporabnika, id_izdelka, kolicina) ".
            "VALUES(:id_uporabnika, :id_izdelka, :kolicina)",
            $params
        );
    }

    public static function update(array $params)
    {
        return parent::modify_update(
            "UPDATE kosarice SET kolicina WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka",
            $params
        );
    }

    public static function updateKolicino(array $params) {
        return parent::modify_update("UPDATE kosarice SET kolicina = :kolicina ".
            "WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka", $params);
    }

    public static function delete(array $params)
    {
        return parent::modify_update("DELETE FROM kosarice WHERE id_uporabnika = :id_uporabnika AND id_izdelka = :id_izdelka", $params);
    }

    public static function izprazni(array $params) {
        return parent::modify_update("DELETE FROM kosarice WHERE id_uporabnika = :id", $params);
    }

    public static function pridobiPravila() {
        return [
            "id_izdelka" => FILTER_VALIDATE_INT,
            "kolicina" => FILTER_VALIDATE_INT
        ];
    }
}