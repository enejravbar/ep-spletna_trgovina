<?php

require_once "ViewUtil.php";
require_once "app/models/Uporabniki.php";

class UporabnikVir {

    public static function dodajUporabnika(){
        $data = filter_input_array(INPUT_POST, Uporabniki::getRules());

        if(ViewUtil::checkValues($data)){
            try {
                $uporabnik = UporabnikService::dodajUporabnika($data);
                echo ViewUtil::renderJSON($uporabnik, 201);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            } catch (Exception $ex){
                echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
            }
        }
    }

    public static function aktivirajUporabnika($id_uporabnika) {
        Uporabniki::update(["id" => $id_uporabnika, "status" => 1]);
    }

    public static function deaktivirajUporabnika($id_uporabnika) {
        Uporabniki::update(["id" => $id_uporabnika, "status" => 2]);
    }


}