<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 19:14
 */

require_once("ViewUtil.php");
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