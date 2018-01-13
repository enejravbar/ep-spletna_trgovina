<?php

require_once "app/models/Entiteta.php";

class Izdelki extends Entiteta {

    public static function dobiVseSortiraneIzdelke(array $params) {
        return parent::query("SELECT * FROM izdelki ORDER BY :kaj :smer", $params);
    }

    public static function dobiIzdelkeIzKategorije(array $params) {
        return parent::query("SELECT * FROM izdelki WHERE kategorija = :kategorija", $params);
    }

    public static function get(array $id) {
        $izdelek = parent::query("SELECT *, (select avg(ocena) from ocene where id_izdelka = i.id) as ocena".
            " FROM izdelki i WHERE id = :id", $id);
        if (count($izdelek) == 1) {
            return $izdelek[0];
        } else {
            throw new InvalidArgumentException("Izdelek ne obstaja");
        }
    }

    public static function getAll() {
        return parent::query("SELECT *, (SELECT s.id FROM slike s WHERE s.izdelek=i.id LIMIT 1) as thumbnail ".
            "FROM izdelki i WHERE status != (select id from status_izdelki where naziv = 'neaktiven') ORDER BY id ASC");
    }

    public static function getAllByQuery(array $params) {
        return parent::query("SELECT *, (SELECT s.id FROM slike s WHERE s.izdelek=i.id LIMIT 1) as thumbnail ".
            "FROM izdelki i WHERE status != (select id from status_izdelki where naziv = 'neaktiven')".
            " AND i.ime like :query ORDER BY id ASC", $params);
    }

    public static function getAllByPage(array $params) {
        $stmt = parent::getConnection()->prepare("SELECT *, ".
            "(SELECT s.id FROM slike s WHERE s.izdelek=i.id LIMIT 1) as thumbnail, ".
            "(select avg(ocena) from ocene o where o.id_izdelka = i.id) as ocena FROM izdelki i ORDER BY id ASC " .
            "LIMIT :limit OFFSET :offset");
        $stmt->bindParam(":limit", $params["limit"], PDO::PARAM_INT);
        $stmt->bindParam(":offset", $params["offset"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function countByPages(array $params) {
        $stmt = parent::getConnection()->prepare("SELECT count(*) as st_zadetkov, " .
            "CEIL(count(*) / :limit) as st_strani FROM izdelki ".
            "WHERE status != (select id from status_izdelki where naziv = 'neaktiven')");
        $stmt->bindParam(":limit", $params["limit"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();

    }

    public static function insert(array $params) {
        return parent::modify(
            "INSERT INTO izdelki(kategorija, ime, opis, cena, status, dodan) ".
            "VALUES(:kategorija, :ime, :opis, :cena, :status, NOW())",
            $params
        );
    }

    public static function update(array $params) {
        return parent::modify_update(
            "UPDATE izdelki SET kategorija = :kategorija, ime = :ime, opis = :opis, cena = :cena, status = :status WHERE id = :id",
            $params
        );
    }

    public static function delete(array $id) {
        return parent::modify_update("DELETE FROM izdelki WHERE id = :id", $id);
    }

    public static function pridobiPravila() {
        return [
            "kategorija" => FILTER_VALIDATE_INT,
            "ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "opis" => FILTER_SANITIZE_SPECIAL_CHARS,
            "cena" => FILTER_VALIDATE_FLOAT,
            "status" => FILTER_VALIDATE_INT,
            "st_slik" => FILTER_VALIDATE_INT
        ];
    }

    public static function getNLatest(array $params) {
        $stmt = parent::getConnection()->prepare("select i.*, (select s.id from slike s ".
            "where izdelek = i.id limit 1) as thumbnail from izdelki i ".
            "where status != (select id from status_izdelki where naziv = 'ni na voljo') ".
            "order by dodan desc limit :n");
        $stmt->bindParam(":n", $params["n"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function getNBestrated(array $params) {
        $stmt = parent::getConnection()->prepare("select i.*, (select avg(o.ocena) from ocene o ".
            "where o.id_izdelka = i.id) as avg_ocena, (select s.id from slike s where izdelek = i.id limit 1) as thumbnail ".
            "from izdelki i where status != (select id from status_izdelki where naziv = 'ni na voljo') ".
            "order by avg_ocena desc limit :n");
        $stmt->bindParam(":n", $params["n"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

}