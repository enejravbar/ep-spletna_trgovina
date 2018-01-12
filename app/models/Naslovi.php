<?php

require_once "app/models/Entiteta.php";

class Naslovi extends Entiteta {

    public static function get(array $id)
    {
        $naslov = parent::query("SELECT * FROM naslovi WHERE id = :id", $id);
        if (count($naslov) == 1) {
            return $naslov[0];
        } else {
            throw new InvalidArgumentException("Naslov ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM naslovi ORDER BY id ASC");
    }

    public static function insert(array $params)
    {
        return parent::modify(
            "INSERT INTO naslovi(postna_st, kraj, ulica, hisna_st) VALUES(:postna_st, :kraj, :ulica, :hisna_st)",
            $params
        );
    }

    public static function update(array $params)
    {
        return parent::modify_update(
            "UPDATE naslovi SET postna_st = :postna_st, kraj = :kraj, ulica = :ulica, hisna_st = :hisna_st WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id)
    {
        return parent::modify_update("DELETE FROM naslovi WHERE id = :id", $id);
    }

}