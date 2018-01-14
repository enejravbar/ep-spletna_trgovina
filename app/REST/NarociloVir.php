<?php

require_once "ViewUtil.php";
require_once "app/models/Narocila.php";
require_once "app/service/PrijavaService.php";

class NarociloVir {

    public static function dobiNarocilaKupca() {
        if (PrijavaService::uporabnikJeStranka()) {
            try {
                $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                $narocila = Narocila::dobiNarocilaKupca(["id" => $uporabnik["id"]]);
                echo ViewUtil::renderJSON($narocila, 200);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
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
                $narocilo = Narocila::get(["id_narocila" => $id_narocila]);
                if ($narocilo["status"] == 1) {
                    Narocila::updateStatus(["id" => $id_narocila, "status" => 2]);
                    echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
                }
                else {
                    echo ViewUtil::renderJSON(["status" => "ni dovoljeno"], 403);
                }
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
                $narocilo = Narocila::get(["id_narocila" => $id_narocila]);
                if ($narocilo["status"] == 1) {
                    Narocila::updateStatus(["id" => $id_narocila, "status" => 4]);
                    echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
                } else {
                    echo ViewUtil::renderJSON(["status" => "ni dovoljeno"], 403);
                }
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

    // storniraj potrjena
    public static function stornirajNarocilo($id_narocila) {
        if (PrijavaService::uporabnikJeProdajalec()) {
            try {
                $narocilo = Narocila::get(["id_narocila" => $id_narocila]);
                if ($narocilo["status"] == 2) {
                    Narocila::updateStatus(["id" => $id_narocila, "status" => 3]);
                    echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
                } else {
                    echo ViewUtil::renderJSON(["status" => "ni dovoljeno"], 403);
                }
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