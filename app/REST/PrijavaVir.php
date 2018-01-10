<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 31.12.2017
 * Time: 0:49
 */

require_once "ViewUtil.php";
require_once "app/models/Uporabniki.php";
require_once "app/service/UporabnikService.php";
require_once "app/service/PrijavaService.php";

class PrijavaVir {

    public static function prijaviUporabnika(){
        $data = filter_input_array(INPUT_POST, Uporabniki::pravilaZaPrijavo());

        $uporabnik = UporabnikService::preveriPrijavoUporabnika($data);

        if($uporabnik == null){
            //prijava ni uspela
            echo ViewUtil::renderJSON(["napaka" => "Napačen e-mail in/ali geslo!"], 400);
        } else {
            //prijava je uspela
            echo ViewUtil::renderJSON($uporabnik, 200);
        }

    }

    public static function pridobiTrenutnegaUporabnika() {
        if(PrijavaService::uporabnikJePrijavljen()) {
            $uporabnik = PrijavaService::vrniTrenutnegaUporabnika();
            if($uporabnik == null) {
                echo ViewUtil::renderJSON(["prijavljen" => false], 200);
            } else {
                echo ViewUtil::renderJSON($uporabnik, 200);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Uporabnik nima zadostnih pravic!"], 401);
        }
    }

}