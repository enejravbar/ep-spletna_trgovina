<?php

require_once "app/models/Entiteta.php";

class Narocila extends Entiteta {

    public static function dobiNarocilaKupca(array $id_kupca) {
        return parent::query("SELECT * FROM narocila WHERE kupec = :$id_kupca ORDER BY datum DESC", $id_kupca);
    }

    public static function dobiNarocilaPoStatusu(array $status) {
        return parent::query("SELECT * FROM narocila WHERE status = :$status ORDER BY datum DESC", $status);
    }

    public static function get(array $id)
    {
        $narocilo = parent::query("SELECT * FROM narocila WHERE id = :id", $id);
        if (count($narocilo) == 1) {
            return $narocilo[0];
        } else {
            throw new InvalidArgumentException("Naročilo ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM narocila ORDER BY id ASC");
    }

    public static function insert(array $params)
    {
        return parent::modify(
            "INSERT INTO narocila(kupec, datum, status) VALUES(:kupec, :datum, :status)",
            $params
        );
    }

    public static function update(array $params)
    {
        return parent::modify_update(
            "UPDATE narocila SET kupec = :kupec, datum = :datum, status = :status WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id)
    {
        return parent::modify_update("DELETE FROM narocila WHERE id = :id", $id);
    }

}