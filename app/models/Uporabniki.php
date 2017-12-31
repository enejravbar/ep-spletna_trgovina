<?php

require_once "app/models/Entiteta.php";

class Uporabniki extends Entiteta {

    public static function dobiUporabnikaGledeNaEmail(array $email) {
        $uporabnik = parent::query("SELECT * FROM uporabniki WHERE email = :email", $email);
        if(count($uporabnik) == 1){
            return $uporabnik[0];
        } else {
            throw new InvalidArgumentException("Ne najdem uporabnika z emailom: " . $email["email"]);
        }
    }

    public static function get(array $id)
    {
        $uporabnik = parent::query("SELECT * FROM uporabniki WHERE id = :id", $id);
        if (count($uporabnik) == 1) {
            return $uporabnik[0];
        } else {
            throw new InvalidArgumentException("Uporabnik ne obstaja");
        }
    }

    public static function getAll() {
        return parent::query("SELECT * FROM uporabniki ORDER BY id ASC");
    }

    public static function getAllSafe(){
        return parent::query("SELECT id, vloga, ime, priimek, email, naslov, posta, status FROM uporabniki");
    }

    public static function insert(array $params) {
        return parent::modify(
            "INSERT INTO uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, status) " .
                "VALUES(:vloga, :ime, :priimek, :email, :geslo, :naslov, :posta, :status)",
            $params
        );
    }

    public static function update(array $params) {
        return parent::modify_update(
            "UPDATE uporabniki SET vloga = :vloga, ime = :ime, priimek = :priimek, ".
            "email = :email, geslo = :geslo, naslov = :naslov, posta = :posta, ".
            "status = :status WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id){
        return parent::modify_update("DELETE FROM uporabniki WHERE id = :id", $id);
    }

    public static function spremeniPotrjen(array $params){
        return parent::modify("UPDATE uporabniki SET status = :status WHERE id = :id", $params);
    }

    public static function getRules(){
        return [
            "vloga" => FILTER_VALIDATE_INT,
            "ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "priimek" => FILTER_SANITIZE_SPECIAL_CHARS,
            "email" => FILTER_SANITIZE_SPECIAL_CHARS,
            "geslo" => FILTER_SANITIZE_SPECIAL_CHARS,
            "naslov" => FILTER_SANITIZE_SPECIAL_CHARS,
            "posta" => FILTER_VALIDATE_INT
        ];
    }

    public static function getLoginRules(){
        return [
          "email" => FILTER_SANITIZE_SPECIAL_CHARS,
          "geslo" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

}