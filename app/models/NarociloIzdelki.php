<?php

require_once "app/models/Entiteta.php";

class NarociloIzdelki extends Entiteta {

    public static function dobiIzdelkeIzNarocila(array $params) {
        return parent::query("SELECT id, id_narocila, ime, opis, cena, kolicina, ".
        "ROUND((cena*kolicina),2) as skupaj_izdelek, (select s.id from slike s where s.izdelek=n.id limit 1) as thumbnail ".
        "FROM narocilo_izdelki n WHERE id_narocila = :id_narocila", $params);
    }

    public static function get(array $id)
    {
        $narocilo_izdelek = parent::query("SELECT * FROM narocilo_izdelki WHERE id = :id", $id);
        if (count($narocilo_izdelek) == 1) {
            return $narocilo_izdelek[0];
        } else {
            throw new InvalidArgumentException("Izdelek naročila ne obstaja");
        }
    }

    public static function getAll()
    {
        return parent::query("SELECT * FROM narocilo_izdelki ORDER BY id ASC");
    }

    public static function insert(array $params)
    {
        return parent::modify(
            "INSERT INTO narocilo_izdelki(id_narocila, ime, opis, cena, kolicina) VALUES(:id_narocila, :ime, :opis, :cena, :kolicina)",
            $params
        );
    }

    public static function update(array $params)
    {
        return parent::modify_update(
            "UPDATE narocilo_izdelki SET id_narocila = :id_narocila, ime = :ime, opis = :opis, cena = :cena, kolicina = :kolicina WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id)
    {
        return parent::modify_update("DELETE FROM narocilo_izdelki WHERE id = :id", $id);
    }

}
