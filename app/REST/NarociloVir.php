<?php

require_once "ViewUtil.php";
require_once "app/models/Narocila.php";
require_once "app/models/NarociloIzdelki.php";
require_once "app/models/Kosarice.php";
require_once "app/models/Izdelki.php";
require_once "app/service/PrijavaService.php";

class NarociloVir {

    public static function dobiNarocilaKupca() {
        if (PrijavaService::uporabnikJeStranka()) {
            try {
                $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                $narocila = Narocila::dobiNarocilaKupca(["id_kupca" => $uporabnik["id"]]);
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
                    Narocila::update(["id" => $id_narocila, "status" => 2]);
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
                    Narocila::update(["id" => $id_narocila, "status" => 4]);
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
                    Narocila::update(["id" => $id_narocila, "status" => 3]);
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

    public static function oddajNarocilo() {
        if (PrijavaService::uporabnikJeStranka()) {
            try {
                $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                $kosarica = Kosarice::dobiKosaricoUporabnika(["id_uporabnika" => $uporabnik["id"]]);

                if (count($kosarica) <= 0) {
                  echo ViewUtil::renderJSON(["status" => "kosarica je prazna"], 404);
                  return;
                }

                $id_narocila = Narocila::insert(["kupec" => $uporabnik["id"], "status" => 1]);

                foreach ($kosarica as $izdelek_kos) {
                    $izdelek = Izdelki::get(["id" => $izdelek_kos["id"]]);

                    NarociloIzdelki::insert(["id_narocila" => $id_narocila, "ime" => $izdelek["ime"], "opis" => $izdelek["opis"], "cena" => $izdelek["cena"], "kolicina" => $izdelek_kos["kolicina"]]);
                }
                Kosarice::izprazni($uporabnik);
                echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }
}
