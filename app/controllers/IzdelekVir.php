<?php

require_once "ViewUtil.php";
require_once "app/models/Izdelki.php";
require_once "app/service/IzdelekService.php";
require_once "app/service/SlikaService.php";

class IzdelekVir {

    // GET /izdelki
    public static function getAll(){
        echo ViewUtil::renderJSON(IzdelekService::pridobiVseIzdelke(), 200);
    }

    // GET /izdelki/:id
    public static function get($id){
        try {
            $izdelek = IzdelekService::pridobiEnIzdelek($id);
            $slike = SlikaService::pridobiSlikeIzdelka($id);
            echo ViewUtil::renderJSON(["izdelek" => $izdelek, "slike" => $slike], 200);
        } catch (InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
        }
    }

    // PUT /izdelki/:id
    public static function posodobi($id){
        $_PUT = [];
        parse_str(file_get_contents("php://input"), $_PUT);
        $data = filter_var_array($_PUT, Izdelki::pridobiPravila());

        if(ViewUtil::checkValues($data)){
            $data["id"] = $id;
            try{
                IzdelekService::posodobiIzdelek($data);
                echo ViewUtil::renderJSON($data, 200);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            }
        } else {
            echo ViewUtil::renderJSON(["napaka" => "Manjkajoci podatki!"], 400);
        }
    }

    // DELETE /izdelki/:id
    public static function izbrisi($id){
        try {
            IzdelekService::izbrisiIzdelek($id);
            echo ViewUtil::renderJSON(null, 204);
        } catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 404);
        }
    }

    // POST /izdelki
    public static function shrani(){
        $data = filter_input_array(INPUT_POST, Izdelki::pridobiPravila());

        $SLIKE = array();
        for($i = 1; $i <= $data["st_slik"]; $i++){
            array_push($SLIKE, $_FILES["slika" . $i]);
        }

        if(ViewUtil::checkValues($data)){
            try {
                $novi_izdelek = IzdelekService::shraniIzdelek($data, $SLIKE);
                echo ViewUtil::renderJSON($novi_izdelek, 201);
            } catch(InvalidArgumentException $e){
                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
            } catch(Exception $ex){
                echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
            }
        }
    }

}