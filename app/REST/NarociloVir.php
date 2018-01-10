<?php

require_once "ViewUtil.php";
require_once "app/models/Narocila.php";
require_once "app/service/PrijavaService.php";

class NarociloVir {

    private static $prijavljen;

    function __construct() {
        $this -> prijavljen = ViewUtil::prijavljenUser(3);
    }

    public static function dobiNarocilaKupca() {
        try {
            $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
            $narocila = Narocila::dobiNarocilaKupca(["id" => $uporabnik["id"]]);
            echo ViewUtil::renderJSON($narocila, 200);
        } catch (Exception $e) {
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    public static function dobiNeobdelanaNarocila() {
        if (PrijavaService::uporabnikJeProdajalec()) {
            try {
                $narocila = Narocila::dobiNarocilaPoStatusu(["status" => 1]);
                echo ViewUtil::renderJSON($narocila, 200);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function dobiPotrjenaNarocila() {
        if (PrijavaService::uporabnikJeProdajalec()) {
            try {
                $narocila = Narocila::dobiNarocilaPoStatusu(["status" => 2]);
                echo ViewUtil::renderJSON($narocila, 200);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function potrdiNarocilo($id_narocila) {
        if (PrijavaService::uporabnikJeProdajalec()) {
            try {
                Narocila::update(["id" => $id_narocila, "status" => 2]);
                echo ViewUtil::renderJSON(["status" => "uspeh"]);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    public static function prekliciNarocilo($id_narocila) {
        if (PrijavaService::uporabnikJeProdajalec()) {
            try {
                Narocila::update(["id" => $id_narocila, "status" => 3]);
                echo ViewUtil::renderJSON(["status" => "uspeh"]);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }
}