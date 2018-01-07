<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 31.12.2017
 * Time: 0:13
 */

require_once "app/models/Entiteta.php";

class StatusUporabnik extends Entiteta {

    const AKTIVEN = "aktiven";
    const NEAKTIVEN = "neaktiven";
    const NEPOTRJEN = "nepotrjen";

    public static function getIdAktiven(){
        return self::getIdByName(["name" => self::AKTIVEN]);
    }

    public static function getIdNeaktiven(){
        return self::getIdByName(["name" => self::NEAKTIVEN]);
    }

    public static function getIdNepotrjen(){
        return self::getIdByName(["name" => self::NEPOTRJEN]);
    }

    public static function getIdByName($name){
        $status = parent::query("SELECT * FROM status_uporabniki WHERE naziv = :name", $name);
        if(count($status) == 1){
            return $status[0]["id"];
        } else {
            throw new InvalidArgumentException("Ne najdem ustreznega statusa!");
        }
    }

    public static function get(array $id) {
        $status = parent::query("SELECT * FROM status_uporabniki WHERE id = :id", $id);
        if(count($status) == 1){
            return $status[0];
        } else {
            throw new InvalidArgumentException("Ne najdem ustreznega statusa!");
        }
    }

    public static function getByName(array $name){
        $status = parent::query("SELECT * FROM status_uporabniki WHERE naziv = :name", $name);
        if(count($status) == 1){
            return $status[0];
        } else {
            throw new InvalidArgumentException("Ne najdem ustreznega statusa!");
        }
    }

    public static function getAll() {
        return parent::query("SELECT * FROM status_uporabniki");
    }

    public static function insert(array $params) {
        return 0;
    }

    public static function update(array $params) {
        return 0;
    }

    public static function delete(array $id) {
        return 0;
    }
}