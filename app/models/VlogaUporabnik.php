<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 6.1.2018
 * Time: 14:01
 */

require_once "app/models/Entiteta.php";

class VlogaUporabnik extends Entiteta {

    const ADMIN = "administrator";
    const STRANKA = "stranka";
    const PRODAJA = "prodajalec";

    public static function getIdProdaja(){
        return self::getIdByName(["name" => self::PRODAJA]);
    }

    public static function getIdAdmin(){
        return self::getIdByName(["name" => self::ADMIN]);
    }

    public static function getIdStranka(){
        return self::getIdByName(["name" => self::STRANKA]);
    }

    public static function getIdByName(array $name){
        $status = parent::query("SELECT * FROM vloge WHERE naziv = :name", $name);
        if(count($status) == 1){
            return $status[0]["id"];
        } else {
            throw new InvalidArgumentException("Ne najdem ustreznega statusa!");
        }
    }

    public static function get(array $id) {
        // TODO: Implement get() method.
        return null;
    }

    public static function getAll() {
        // TODO: Implement getAll() method.
        return array();
    }

    public static function insert(array $params) {
        // TODO: Implement insert() method.
        return 0;
    }

    public static function update(array $params) {
        // TODO: Implement update() method.
        return 0;
    }

    public static function delete(array $id) {
        // TODO: Implement delete() method.
        return 0;
    }
}