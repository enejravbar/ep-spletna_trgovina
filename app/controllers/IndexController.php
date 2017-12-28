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
        $dobljeno = Izdelki::insert(["kategorija" => 1, "ime" => "Samsung Galaxy S8", "opis" => "Dobar telefon", "cena" => 698, "status" => 2, "slika_url" => "app/static/images/s8"]);
        Izdelki::insert(["kategorija" => 1, "ime" => "HTC One", "opis" => "Star telefon", "cena" => 76, "status" => 1, "slika_url" => "app/static/images/htc"]);

        $izdelki = Izdelki::getAll();
        var_dump($izdelki);
        echo ViewUtil::render("app/views/index-page.php", ["izdelki" => $izdelki]);
    }

}