<?php

require_once "ViewUtil.php";
require_once "app/models/Izdelki.php";
require_once "app/service/IzdelekService.php";
require_once "app/service/SlikaService.php";
require_once "app/service/PrijavaService.php";

class IzdelekVir {

    // GET /izdelki
    public static function getAll(){
        if(isset($_GET["order"])) {

        }





        try {
            echo ViewUtil::renderJSON(IzdelekService::pridobiVseIzdelke(), 200);
        } catch (Exception $e) {
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    // GET /izdelki/:id
    public static function get($id){
        try {
            $izdelek = IzdelekService::pridobiEnIzdelek($id);
            $slike = SlikaService::pridobiSlikeIzdelka($id);
            echo ViewUtil::renderJSON(["izdelek" => $izdelek, "slike" => $slike], 200);
        } catch (InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
        }
    }

    // PUT /izdelki/:id
    public static function posodobi($id){
        if(PrijavaService::uporabnikJeProdajalec()){
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Izdelki::pridobiPravila());

            if(ViewUtil::checkValues($data)){
                $data["id"] = $id;
                try{
                    IzdelekService::posodobiIzdelek($data);
                    echo ViewUtil::renderJSON($data, 200);
                } catch(InvalidArgumentException $e){
                    echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Manjkajoci podatki!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    // DELETE /izdelki/:id
    public static function izbrisi($id){
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                IzdelekService::izbrisiIzdelek($id);
                echo ViewUtil::renderJSON(null, 204);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    // POST /izdelki
    public static function shrani(){
        if(PrijavaService::uporabnikJeProdajalec()) {
            $data = filter_input_array(INPUT_POST, Izdelki::pridobiPravila());
            $FILES = $_FILES["slika"];
            $SLIKE = array();

            foreach ($FILES["name"] as $key => $value) {
                array_push($SLIKE, [
                    "name" => $FILES["name"][$key],
                    "size" => $FILES["size"][$key],
                    "type" => $FILES["type"][$key],
                    "tmp_name" => $FILES["tmp_name"][$key],
                    "error" => $FILES["error"][$key]
                ]);
            }

            if(ViewUtil::checkValues($data)){
                try {
                    $novi_izdelek = IzdelekService::shraniIzdelek($data, $SLIKE);
                    echo ViewUtil::renderJSON($novi_izdelek, 201);
                } catch(InvalidArgumentException $e){
                    echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
                } catch(Exception $ex){
                    echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekatere vrednosti manjkajo!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function izbrisiSlikoIzdelka($id_slike) {
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                SlikaService::izbrisiSliko($id_slike);
                echo ViewUtil::renderJSON(null, 204);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 500);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function dodajSlikoIzdelka($id_izdelka) {
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                $SLIKA = $_FILES["slika"];
                SlikaService::shraniSlikoIzdelka($SLIKA, $id_izdelka);
                echo ViewUtil::renderJSON(["status" => "Uspeh!"], 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function testirajDodajanjeIzdelka() {
        $data = filter_input_array(INPUT_POST, Izdelki::pridobiPravila());
        $FILES = $_FILES["slika"];
        $SLIKE = array();

        foreach ($FILES["name"] as $key => $value) {
            array_push($SLIKE, [
                "name" => $FILES["name"][$key],
                "size" => $FILES["size"][$key],
                "type" => $FILES["type"][$key],
                "tmp_name" => $FILES["tmp_name"][$key],
                "error" => $FILES["error"][$key]
            ]);
        }

        var_dump($data);
        var_dump($SLIKE);
    }

}