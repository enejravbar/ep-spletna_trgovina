<?php

require_once "ViewUtil.php";
require_once "app/models/Uporabniki.php";
require_once "app/service/UporabnikService.php";
require_once "app/models/StatusUporabnik.php";

class UporabnikVir {

    public static function pridobiVse(){
        echo ViewUtil::renderJSON(UporabnikService::vrniVse(), 200);
    }

    public static function pridobiEnega($id){
        try {
            echo ViewUtil::renderJSON(UporabnikService::vrniEnega($id), 200);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
        }
    }

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
        Uporabniki::update(["id" => $id_uporabnika, "status" => StatusUporabnik::getByName(["name" => "aktiven"])["id"]]);
    }

    public static function deaktivirajUporabnika($id_uporabnika) {
        Uporabniki::update(["id" => $id_uporabnika, "status" => StatusUporabnik::getByName(["name" => "neaktiven"])["id"]]);
    }

    public static function posodobiUporabnika($id){
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, Uporabniki::getRules());

        if(self::checkPUTValues($data)){
            $data["id"] = $id;
            try {
                UporabnikService::posodobiUporabnika($data);
                echo ViewUtil::renderJSON(UporabnikService::vrniEnega($id), 200);
            }catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
            } catch(Exception $ex){
                echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Missing values!"], 400);
        }
    }

    private static function checkPUTValues($input){
        if(empty($input)){
            return FALSE;
        }
        $result = TRUE;
        foreach ($input as $key => $value){
            if($key != "geslo"){
                $result = $result && $value != false;
            }
        }
        return $result;
    }

    public static function izbrisiUporabnika($id){
        try {
            UporabnikService::izbrisiUporabnika($id);
            echo ViewUtil::renderJSON(null, 204);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
        } catch(Exception $ex){
            echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
        }
    }

    public static function posredujUporabnikaZSeznamomPost($id){
        try {
            echo ViewUtil::renderJSON(UporabnikService::vrniUporabnikaSSeznamomPost($id), 200);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

}