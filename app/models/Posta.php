<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 1.1.2018
 * Time: 15:50
 */

require_once "app/models/Entiteta.php";

class Posta extends Entiteta {

    public static function getAll(){
        return parent::query("SELECT * FROM posta");
    }

    public static function get(array $id) {
        // TODO: Implement get() method.
    }

    public static function insert(array $params) {
        // TODO: Implement insert() method.
    }

    public static function update(array $params) {
        // TODO: Implement update() method.
    }

    public static function delete(array $id) {
        // TODO: Implement delete() method.
    }
}