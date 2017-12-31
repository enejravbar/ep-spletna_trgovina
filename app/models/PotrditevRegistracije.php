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
        $polja = parent::query("SELECT * FROM potrditev_registracije WHERE id = :id", $id);
        if(count($polja) == 1){
            return $polja[0];
        } else {
            throw new InvalidArgumentException("Potrditveno polje ne obstaja");
        }
    }

    public static function getByKey(array $key){
        $polja =  parent::query("SELECT * FROM potrditev_registracije WHERE kljuc = :kljuc", $key);
        if(count($polja) == 1){
            return $polja[0];
        } else {
            return null;
        }
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
        return parent::modify_update("UPDATE potrditev_registracije SET kljuc = :kljuc WHERE id = :id", $params);
    }

    public static function delete(array $id) {
        return parent::modify_update("DELETE FROM potrditev_registracije WHERE id = :id", $id);
    }

    public static function deleteByUporabnik(array $id){
        return parent::modify_update("DELETE FROM potrditev_registracije WHERE uporabnik = :id", $id);
    }

}