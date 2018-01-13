<?php

require_once "ViewUtil.php";
require_once "app/models/Narocila.php";
require_once "app/models/Kosarice.php";
require_once "app/models/NarociloIzdelki.php";
require_once "app/models/Izdelki.php";
require_once "app/service/PrijavaService.php";

class OddajNarocilo {

    public static function oddajNarocilo() {
        if (PrijavaService::uporabnikJeStranka()) {
            try {
                $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
                $kosarica = Kosarice::dobiKosaricoUporabnika(["id_uporabnika" => $uporabnik["id"]]);

                $id_narocila = Narocila::insert(["kupec" => $uporabnik["id"], "datum" => date("Y-m-d H:i:s"), "status" => 1]);

                foreach ($kosarica as $izdelek_kos) {
                    $izdelek = Izdelki::get(["id" => $izdelek_kos["id"]]);

                    NarociloIzdelki::insert(["id_narocila" => $id_narocila, "ime" => $izdelek["ime"], "opis" => $izdelek["opis"], "cena" => $izdelek["cena"], "kolicina" => $izdelek_kos["kolicina"]]);
                }
                echo ViewUtil::renderJSON(["status" => "uspeh"], 200);
            } catch (Exception $e) {
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }
}