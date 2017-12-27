<?php

require_once "app/models/Entiteta.php";

class Uporabniki extends Entiteta {

    public static function dobiUporabnikaGledeNaEmail(array $email) {
        return parent::query("SELECT * FROM uporabniki WHERE email = :email", $email);
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

    public static function getAll()
    {
        return parent::query("SELECT * FROM uporabniki ORDER BY id ASC");
    }

    public static function insert(array $params)
    {
        return parent::modify(
            "INSERT INTO uporabniki(vloga, ime, priimek, email, geslo, naslov, potrjen) " .
                "VALUES(:vloga, :ime, :priimek, :email, :geslo, :naslov, :potrjen)",
            $params
        );
    }

    public static function spremeniPotrjen(array $params){
        return parent::modify("UPDATE uporabniki SET potrjen = :potrjen WHERE id = :id", $params);
    }

    public static function update(array $params)
    {
        return parent::modify(
            "UPDATE uporabniki SET vloga = :vloga, ime = :ime, priimek = :priimek, email = :email, geslo = :geslo, naslov = :naslov, status = :status WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id)
    {
        return parent::modify("DELETE FROM uporabniki WHERE id = :id", $id);
    }

}