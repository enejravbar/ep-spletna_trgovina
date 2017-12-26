<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 23:46
 */

require_once "app/models/Entiteta.php";

class PotrditevRegistracije extends Entiteta {


    public static function get(array $id) {
        return parent::query("SELECT * FROM potrditev_registracije WHERE id = :id", $id);
    }

    public static function getByKey(array $key){
        return parent::query("SELECT * FROM potrditev_registracije WHERE kljuc = :kljuc", $key);
    }

    public static function getAll() {
        return parent::query("SELECT * FROM potrditev_registracije");
    }

    public static function insert(array $params) {
        return parent::modify(
            "INSERT INTO potrditev_registracije(kljuc, uporabnik) VALUES(:kljuc, :uporabnik)",
            $params
        );
    }

    public static function update(array $params) {
        return parent::modify("UPDATE potrditev_registracije SET kljuc = :kljuc WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify("DELETE FROM potrditev_registracije WHERE id = :id", $id);
    }
}