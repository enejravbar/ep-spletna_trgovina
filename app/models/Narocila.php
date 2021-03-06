<?php

require_once "app/models/Entiteta.php";
require_once "app/service/PrijavaService.php";

class Narocila extends Entiteta {

    public static function dobiNarocilaKupca(array $params) {
        return parent::query("SELECT * FROM narocila WHERE kupec = :id_kupca ORDER BY datum DESC", $params);
    }

    public static function dobiNarocilaPoStatusu(array $params) {
        return parent::query("SELECT * FROM narocila WHERE status = :status ORDER BY datum DESC", $params);
    }

    public static function preveriPravice(array $params) {
        // vrne true, če ima prijavljen uporabnik pravice, za gledanje podrobnosti naročila z nekim id-jem
        // torej če je kupec tega naročila prijavljen, ali pa je prijavljen prodajalec
        $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
        if ($uporabnik["vloga"] == 2)
            return true;
        else {
            //var_dump($params);
            $params["uporabnik_id"] = $uporabnik["id"];
            //var_dump($params);
            $data = parent::query("SELECT * FROM narocila WHERE id = :id_narocila AND kupec = :uporabnik_id", $params);
            if (count($data) == 1)
                return true;
            else
                return false;
        }
    }

    public static function getVrednostNarocila(array $params) {
        return parent::query("select ROUND(sum(cena * kolicina), 2) as suma from narocilo_izdelki where id_narocila = :id", $params)[0]["suma"];
    }

    public static function get(array $params)
    {
        $narocilo = parent::query("SELECT * FROM narocila WHERE id = :id_narocila", $params);
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
            "INSERT INTO narocila(kupec, datum, status) VALUES(:kupec, NOW(), :status)",
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

    public static function updateStatus(array $params) {
        return parent::modify_update("UPDATE narocila SET status = :status WHERE id = :id", $params);
    }

    public static function delete(array $id)
    {
        return parent::modify_update("DELETE FROM narocila WHERE id = :id", $id);
    }

}
