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

class PrijavaVir {

    public static function prijaviUporabnika(){
        $data = filter_input_array(INPUT_POST, Uporabniki::getLoginRules());

        $uporabnik = UporabnikService::preveriPrijavoUporabnika($data);

        if($uporabnik == null){
            //prijava ni uspela
            echo ViewUtil::renderJSON(["napaka" => "Napačen e-mail in/ali geslo!"], 400);
        } else {
            //prijava je uspela
            echo ViewUtil::renderJSON($uporabnik, 200);
        }

    }

}