<?php

require_once "app/models/Entiteta.php";

class Uporabniki extends Entiteta {

    public static function dobiUporabnikaGledeNaEmail(array $email) {
        $uporabnik = parent::query("SELECT * FROM uporabniki WHERE email = :email", $email);
        if(count($uporabnik) == 1){
            return $uporabnik[0];
        } else {
            return null;
        }
    }

    public static function dobiStrankoGledeNaEmail(array $email) {
        $uporabnik = parent::query("SELECT * FROM uporabniki WHERE email = :email AND vloga = 3", $email);
        if(count($uporabnik) == 1){
            return $uporabnik[0];
        } else {
            return null;
        }
    }

    public static function getOneByVloga($params) {
        $uporabnik = parent::query("SELECT id, vloga, ime, priimek, email, naslov, posta, telefon, status" .
        " FROM uporabniki WHERE id = :id AND vloga = :vloga", $params);
        if(count($uporabnik) == 1){
            return $uporabnik[0];
        } else {
            throw new InvalidArgumentException("Stranka z podanim id ne obstaja!");
        }
    }

    public static function getByVloga($params) {
        $stmt = parent::getConnection()->prepare("SELECT id, vloga, ime, priimek, email, naslov, " .
            "posta, telefon, status FROM uporabniki WHERE vloga = :vloga");
        $stmt->bindParam(":vloga", $params["vloga"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function countByVloga($params) {
        $stmt = parent::getConnection()->prepare("SELECT count(*) as st_zadetkov, " .
            "CEIL(count(*) / :limit) as st_strani FROM uporabniki WHERE vloga = :vloga");
        $stmt->bindParam(":limit", $params["limit"], PDO::PARAM_INT);
        $stmt->bindParam(":vloga", $params["vloga"], PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
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
        return parent::query("SELECT id, vloga, ime, priimek, email, naslov, posta, telefon, status FROM uporabniki");
    }

    public static function insert(array $params) {
        return parent::modify(
            "INSERT INTO uporabniki(vloga, ime, priimek, email, geslo, naslov, posta, telefon, status) " .
                "VALUES(:vloga, :ime, :priimek, :email, :geslo, :naslov, :posta, :telefon, :status)",
            $params
        );
    }

    public static function updateStrankaBrezGesla(array $params) {
        return parent::modify_update("UPDATE uporabniki SET ime = :ime, priimek = :priimek," .
        " email = :email, naslov = :naslov, telefon = :telefon, posta = :posta WHERE id = :id", $params);
    }

    public static function updateStrankaZGeslom(array $params) {
        return parent::modify_update("UPDATE uporabniki SET ime = :ime, priimek = :priimek," .
            " email = :email, geslo = :geslo, naslov = :naslov, telefon = :telefon, posta = :posta WHERE id = :id", $params);
    }

    public static function updateOsebjeBrezGesla(array $params) {
        return parent::modify_update("UPDATE uporabniki SET ime = :ime, priimek = :priimek," .
            " email = :email WHERE id = :id", $params);
    }

    public static function updateOsebjeZGeslom(array $params) {
        return parent::modify_update("UPDATE uporabniki SET ime = :ime, priimek = :priimek," .
            " email = :email, geslo = :geslo WHERE id = :id", $params);
    }

    public static function update(array $params) {
        return parent::modify_update(
            "UPDATE uporabniki SET vloga = :vloga, ime = :ime, priimek = :priimek, ".
            "email = :email, geslo = :geslo, naslov = :naslov, telefon = :telefon, posta = :posta, ".
            "status = :status WHERE id = :id",
            $params
        );
    }

    public static function updateNoPassword(array $params){
        return parent::modify_update(
            "UPDATE uporabniki SET vloga = :vloga, ime = :ime, priimek = :priimek, ".
            "email = :email, naslov = :naslov, posta = :posta, ".
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

    public static function pravilaZaStranke() {
        return [
            "ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "priimek" => FILTER_SANITIZE_SPECIAL_CHARS,
            "email" => FILTER_VALIDATE_EMAIL,
            "geslo1" => FILTER_SANITIZE_SPECIAL_CHARS,
            "geslo2" => FILTER_SANITIZE_SPECIAL_CHARS,
            "naslov" => FILTER_SANITIZE_SPECIAL_CHARS,
            "telefon" => FILTER_SANITIZE_SPECIAL_CHARS,
            "posta" => FILTER_VALIDATE_INT,
            "captchaVerification" => []
        ];
    }

    public static function pravilaZaProdajalce() {
        return [
            "ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "priimek" => FILTER_SANITIZE_SPECIAL_CHARS,
            "email" => FILTER_VALIDATE_EMAIL,
            "geslo1" => FILTER_SANITIZE_SPECIAL_CHARS,
            "geslo2" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

    public static function pravilaZaAdmina() {
        return [
            "ime" => FILTER_SANITIZE_SPECIAL_CHARS,
            "priimek" => FILTER_SANITIZE_SPECIAL_CHARS,
            "email" => FILTER_VALIDATE_EMAIL,
            "geslo1" => FILTER_SANITIZE_SPECIAL_CHARS,
            "geslo2" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

    public static function pravilaZaPrijavo() {
        return [
          "email" => FILTER_VALIDATE_EMAIL,
          "geslo" => FILTER_SANITIZE_SPECIAL_CHARS
        ];
    }

    public static function updateStatus(array $params) {
        return parent::modify_update("UPDATE uporabniki SET status = :status WHERE id = :id", $params);
    }

}