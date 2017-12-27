<?php

require_once "ViewUtil.php";
require_once "app/models/Izdelki.php";


class IzdelekVir {

    //GET /izdelki
    public static function getAll(){
        echo ViewUtil::renderJSON(Izdelki::getAll());
    }

    public static function get($id){
        try {
            echo ViewUtil::renderJSON(Izdelki::get(["id" => $id]));
        } catch (InvalidArgumentException $e){
            echo ViewUtil::renderJSON($e->getMessage(), 404);
        }
    }

}