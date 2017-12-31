<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 31.12.2017
 * Time: 15:42
 */

require_once "ViewUtil.php";
require_once "app/service/KategorijaService.php";

class KategorijaVir {

    public static function pridobiVse(){
        try {
            echo ViewUtil::renderJSON(KategorijaService::vrniVseKategorije(), 200);
        }catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

    public static function pridobiVseIzdelkeIzKategorije($id){
        try {
            echo ViewUtil::renderJSON(KategorijaService::vrniVseIzdelkePoKategoriji($id), 200);
        }catch(InvalidArgumentException $e){
            echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
        }
    }

}