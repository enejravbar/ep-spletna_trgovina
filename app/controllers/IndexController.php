<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 29.11.2017
 * Time: 16:52
 */

require_once "app/models/Izdelki.php";
require_once "ViewUtil.php";

class IndexController {

    public static function index(){
        echo ViewUtil::render("app/views/index-page.php");
    }

}