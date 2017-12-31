<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 30.12.2017
 * Time: 23:22
 */

require_once "app/service/SlikaService.php";
require_once "ViewUtil.php";

class SlikaVir {

    // GET /slike/:id
    public static function prikaziSliko($id){
        try {
            $slika = SlikaService::pridobiSliko($id);
            header("Content-Type: image/" . $slika["ext"]);
            readfile($slika["lokacija"]);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    // POST /slike/izdelek/:id
    public static function shraniSliko($id){
        try {
            SlikaService::shraniSlikoIzdelka($_FILES["slika"], $id);
            echo ViewUtil::renderJSON(["sporocilo" => "Uspeh!"], 201);
        } catch (InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        } catch (Exception $ex) {
            echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
        }
    }

    // DELETE /slike/:id
    public static function izbrisiSliko($id){
        try {
            SlikaService::izbrisiSliko($id);
            echo ViewUtil::renderJSON(["sporocilo" => "Uspeh!"], 204);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }


}