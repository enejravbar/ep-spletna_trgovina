<?php

require_once "ViewUtil.php";
require_once "app/models/NarociloIzdelki.php";
require_once "app/models/Narocila.php";

class NarociloIzdelekVir {

    public static function dobiIzdelkeNarocila($id_narocila) {
        if (Narocila::preveriPravice(["id_narocila" => $id_narocila, "uporabnik_id" => -1])) {
            try {
                //echo $id_narocila;
                $narocilo["izdelki"] = NarociloIzdelki::dobiIzdelkeIzNarocila(["id_narocila" => $id_narocila]);
                //var_dump($narocilo["izdelki"]);
                $narocilo["podrobnosti"] = Narocila::get(["id_narocila" => $id_narocila]);
                //var_dump($narocilo["podrobnosti"]);
                $narocilo["vrednost"] = Narocila::getVrednostNarocila(["id" => $id_narocila]);
                //var_dump($narocilo["vrednost"]);
                echo ViewUtil::renderJSON($narocilo, 200);
            } catch (InvalidArgumentException $e1) {
                echo ViewUtil::renderJSON(["napaka" => $e1->getMessage()], 404);
            } catch (Exception $e2) {
                //echo ViewUtil::renderJSON(["napaka" => $e2->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }
}
