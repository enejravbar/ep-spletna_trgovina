<?php

require_once "ViewUtil.php";
require_once "app/models/Izdelki.php";
require_once "app/service/IzdelekService.php";
require_once "app/service/SlikaService.php";
require_once "app/service/PrijavaService.php";
require_once "app/service/LogService.php";
require_once "app/service/KategorijaService.php";

class IzdelekVir {

    public static function getStatuseIzdelkov() {
        try {
            echo ViewUtil::renderJSON(Izdelki::getStatuseIzdelkov(), 200);
        } catch (Exception $e) {
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 500);
        }
    }

    // GET /izdelki
    public static function getAll(){
        try {
            if(isset($_GET["q"])) {
                $query = $_GET["q"];
                $izdelki = IzdelekService::isciPoQueryju($query);
            } else if (isset($_GET["kategorija"])) {
                $kategorijaId = $_GET["kategorija"];
                $izdelki = KategorijaService::vrniVseIzdelkePoKategoriji($kategorijaId);
            } else {
                $izdelki = IzdelekService::pridobiVseIzdelke();
            }
            echo ViewUtil::renderJSON(["izdelki" => $izdelki], 200);
        } catch (Exception $e) {
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 500);
        }
    }

    public static function getAllAll() {
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                echo ViewUtil::renderJSON(["izdelki" => IzdelekService::pridobiVseIzdelkeZaUpravljanje()], 200);
            } catch(Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 500);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Nimaš zadostnih pravic!"], 401);
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

    // GET /izdelki/index
    public static function getForIndex() {
        try {
            echo ViewUtil::renderJSON([
                "zadnji" => IzdelekService::dobiZadnjihNIzdelkov(3),
                "ocenjeni" => IzdelekService::dobiNNajboljeOcenjenihIzdelkov(3)
            ], 200);
        } catch(Exception $e) {
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    // PUT /izdelki/:id
    public static function posodobi($id){
        if(PrijavaService::uporabnikJeProdajalec()){
            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Izdelki::pridobiPravila());
            //var_dump($data);
            if(ViewUtil::checkValues($data)){
                $data["id"] = $id;
                try{
                    IzdelekService::posodobiIzdelek($data);
                    LogService::info("prodajalec", "IZDELEK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je posodobil izdelek $id");
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
                LogService::info("prodajalec", "IZDELEK", "Prodajalec " .
                    PrijavaService::vrniIdTrenutnegaUporabnika() . " je izbrisal izdelek $id");
                echo ViewUtil::renderJSON(null, 204);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function aktivirajIzdelek($id) {
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                IzdelekService::aktivirajIzdelek($id);
                echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch(Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 500);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Nimate zadostnih pravic!"], 401);
        }
    }

    public static function deaktivirajIzdelek($id) {
        if(PrijavaService::uporabnikJeProdajalec()) {
            try {
                IzdelekService::deaktivirajIzdelek($id);
                echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch(Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 500);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Nimate zadostnih pravic!"], 401);
        }
    }

    // POST /izdelki
    public static function shrani(){
        if(PrijavaService::uporabnikJeProdajalec()) {
            $data = filter_input_array(INPUT_POST, Izdelki::pridobiPravila());
            $SLIKE = array();

            if(isset($_FILES["files"])) {
                $FILES = $_FILES["files"];
                foreach ($FILES["name"] as $key => $value) {
                    array_push($SLIKE, [
                        "name" => $FILES["name"][$key],
                        "size" => $FILES["size"][$key],
                        "type" => $FILES["type"][$key],
                        "tmp_name" => $FILES["tmp_name"][$key],
                        "error" => $FILES["error"][$key]
                    ]);
                }
            }
            if(ViewUtil::checkValues($data)){
                try {
                    $novi_izdelek = IzdelekService::shraniIzdelek($data, $SLIKE);
                    LogService::info("prodajalec", "IZDELEK", "Prodajalec " .
                        PrijavaService::vrniIdTrenutnegaUporabnika() . " je shranil izdelek " . $novi_izdelek["id"]);
                    echo ViewUtil::renderJSON($novi_izdelek, 201);
                } catch(InvalidArgumentException $e){
                    echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 415);
                } catch(Exception $ex){
                    echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 500);
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
                LogService::info("prodajalec", "IZDELEK-SLIKA", "Prodajalec " .
                    PrijavaService::vrniIdTrenutnegaUporabnika() . " je izbrisal sliko $id_slike");
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

                $SLIKE = array();

                if(isset($_FILES["files"])) {
                    $FILES = $_FILES["files"];
                    foreach ($FILES["name"] as $key => $value) {
                        array_push($SLIKE, [
                            "name" => $FILES["name"][$key],
                            "size" => $FILES["size"][$key],
                            "type" => $FILES["type"][$key],
                            "tmp_name" => $FILES["tmp_name"][$key],
                            "error" => $FILES["error"][$key]
                        ]);
                    }
                }

                for($i = 0; $i < count($SLIKE); $i++){
                    SlikaService::shraniSlikoIzdelka($SLIKE[$i], $id_izdelka);
                }

                LogService::info("prodajalec", "IZDELEK", "Prodajalec " .
                    PrijavaService::vrniIdTrenutnegaUporabnika() . " je dodal sliko izdelku $id_izdelka");
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
