<?php

require_once "ViewUtil.php";
require_once "app/models/Kosarice.php";
require_once "app/service/KosaricaService.php";
require_once "app/service/PrijavaService.php";

class KosaricaVir {

    public static function dobiKosarico() {
        if(PrijavaService::uporabnikJeStranka()) {
            try {
                $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                $kosarica = KosaricaService::vrniVsebinoKosarice($uporabnik["id"]);
                echo ViewUtil::renderJSON(["kosarica" => $kosarica], 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function spremeniKolicinoIzdelkaVKosarici() { // +1 ali -1
        if(PrijavaService::uporabnikJeStranka()) {

            $_PUT = [];
            parse_str(file_get_contents("php://input"), $_PUT);
            $data = filter_var_array($_PUT, Kosarice::pridobiPravilaSpremembaKolicine());

            $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
            $data["id_uporabnika"] = $uporabnik["id"];

            if(ViewUtil::checkValues($data)) {
                try {
                    KosaricaService::spremeniKolicinoIzdelkaVKosarici($data);
                    echo ViewUtil::renderJSON(["status" => "Uspeh!"], 200);
                } catch (Exception $e) {
                    echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekateri atributi manjkajo!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function dodajIzdelekVKosarico() {
        if(PrijavaService::uporabnikJeStranka()) {
            $data = filter_input_array(INPUT_POST, Kosarice::pridobiPravila());
            $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
            $data["id_uporabnika"] = $uporabnik["id"];

            if(ViewUtil::checkValues($data)) {
                try {
                    KosaricaService::dodajIzdelekVKosarico($data);
                    echo ViewUtil::renderJSON(["status" => "Uspeh!"], 200);
                } catch (Exception $e) {
                    echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
                }
            } else {
                echo ViewUtil::renderJSON(["napaka" => "Nekatere vrednosti manjkajo!"], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function odstraniIzdelekIzKosarice($id_izdelka) {
        if(PrijavaService::uporabnikJeStranka()) {
            try {
                $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                KosaricaService::izbrisiIzdelekIzKosarice([
                    "id_uporabnika" => $uporabnik["id"],
                    "id_izdelka" => $id_izdelka
                ]);
                echo ViewUtil::renderJSON(null, 204);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function izprazniKosarico($id_stranke) {
        if(PrijavaService::uporabnikJeStranka()) {
            try {
                KosaricaService::izprazniKosarico($id_stranke);
                echo ViewUtil::renderJSON(null, 204);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

}
