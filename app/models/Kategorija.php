<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 31.12.2017
 * Time: 15:43
 */
require_once "app/models/Entiteta.php";

class Kategorija extends Entiteta {

    public static function get(array $id) {
        $kategorija =  parent::query("SELECT * FROM kategorije WHERE id = :id", $id);
        if(count($kategorija) == 1){
            return $kategorija;
        } else {
            return null;
        }
    }

    public static function getAll() {
        return parent::query("SELECT * FROM kategorije");
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