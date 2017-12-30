<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 30.12.2017
 * Time: 17:28
 */

require_once "app/models/Entiteta.php";

class Slika extends Entiteta {

    public static function get(array $id) {
        $slika = parent::query("SELECT * FROM slike WHERE id = :id", $id);
        if (count($slika) == 1) {
            return $slika[0];
        } else {
            throw new InvalidArgumentException("Slika ne obstaja");
        }
    }

    public static function pridobiStevilkoSlike(array $id_izdelka){
        $rezultat = parent::query("SELECT CASE count(*) WHEN 0 THEN 1 ELSE count(*) + 1 END as novi_id_slike FROM slike WHERE izdelek = :izdelek_id", $id_izdelka);
        return $rezultat[0]["novi_id_slike"];
    }

    public static function getAll() {
        return parent::query("SELECT * FROM slike ORDER BY id ASC");
    }

    public static function insert(array $params) {
        return parent::modify("INSERT INTO slike(naziv, lokacija, izdelek) VALUES (:naziv, :lokacija, :izdelek)", $params);
    }

    public static function update(array $params) {
        return parent::modify_update("UPDATE slike SET naziv = :naziv, lokacija = :lokacija, izdelek = :izdelek WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify_update("DELETE FROM slike WHERE id = :id", $id);
    }

    public static function pridobiSlikeIzdelka(array $id_izdelka){
        return parent::query("SELECT * FROM slike WHERE izdelek = :id_izdelka", $id_izdelka);
    }
}