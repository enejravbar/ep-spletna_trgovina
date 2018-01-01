<?php

require_once "ViewUtil.php";
// servisi
require_once "app/service/EmailService.php";
require_once "app/service/LogService.php";
require_once "app/service/UporabnikService.php";
require_once "app/service/FileService.php";
// controllers / viri
require_once "app/controllers/SlikaVir.php";
require_once "app/controllers/IndexController.php";
require_once "app/controllers/IzdelekVir.php";
require_once "app/controllers/PrijavaVir.php";
require_once "app/controllers/UporabnikVir.php";
require_once "app/controllers/KategorijaVir.php";
// debug
require_once "app/models/Slika.php";


class Usmerjevalniki {

    public static function getRouters(){
        return [
            //index page
            "/^$/" => function() {
                IndexController::index();
            },
            // login
            "/^api\/prijava$/" => function($method){
                switch($method){
                    case "POST":
                        PrijavaVir::prijaviUporabnika();
                        break;
                    default:
                        break;
                }
            },
            //uporabniki
            "/^api\/uporabniki$/" => function($method){
                switch($method){
                    case "POST":
                        UporabnikVir::dodajUporabnika();
                        break;
                    default:
                        UporabnikVir::pridobiVse();
                        break;
                }
            },
            "/^api\/uporabniki\/(\d+)$/" => function($method, $id){
                switch($method){
                    case "DELETE":
                        UporabnikVir::izbrisiUporabnika($id);
                        break;
                    case "PUT":
                        UporabnikVir::posodobiUporabnika($id);
                        break;
                    default:
                        UporabnikVir::pridobiEnega($id);
                        break;
                }
            },
            "/^api\/android\/uporabniki\/(\d+)$/" => function($method, $id){
                UporabnikVir::posredujUporabnikaZSeznamomPost($id);
            },
            // izdelki
            "/^api\/izdelki\/(\d+)$/" => function($method, $id = null){
                switch($method){
                    case "PUT":
                        IzdelekVir::posodobi($id);
                        break;
                    case "DELETE":
                        IzdelekVir::izbrisi($id);
                        break;
                    default:
                        IzdelekVir::get($id);
                        break;
                }
            },
            "/^api\/izdelki$/" => function($method){
                switch($method) {
                    case "POST":
                        IzdelekVir::shrani();
                        break;
                    default:
                        IzdelekVir::getAll();
                        break;
                }
            },
            // kategorije
            "/^api\/kategorije$/" => function($method){
                KategorijaVir::pridobiVse();
            },
            "/^api\/kategorije\/(\d+)\/izdelki$/" => function($method, $id){
                KategorijaVir::pridobiVseIzdelkeIzKategorije($id);
            },
            // slike
            "/^api\/slike\/izdelek\/(\d+)$/" => function($method, $id){
                if($method == "POST"){
                    SlikaVir::shraniSliko($id);
                }
            },
            "/^api\/slike\/(\d+)$/" => function($method, $id){
                switch ($method){
                    case "DELETE":
                        SlikaVir::izbrisiSliko($id);
                        break;
                    default:
                        SlikaVir::prikaziSliko($id);
                        break;
                }
            },
            //testni routi
            "/^test_mail$/" => function() {
                $email = new Email(
                    "miha_jamsek@windowslive.com",
                    "Zadeva",
                    "app/views/confirmation-email.php",
                    ["kljuc" => "kljuc123", "ime" => "Janez", "email" => "janez@gmail.com", "geslo" => "abc123"]
                );
                try {
                    EmailService::posljiEmail($email);
                } catch (Exception $e){
                    echo $e;
                }

            },
            "/^test_log$/" => function() {
                LogService::info("", "test", "To je sporocilo za logirat vse");
                LogService::error("prodajalec", "test", "To je sporocilo za logirat prodajalce");
                LogService::warning("admin", "test", "To je sporocilo za logirat admine");
            },
            "/^test_register$/" => function() {
                UporabnikService::dodajUporabnika(null);
            },
            //potrditev uporabnika
            "/^api\/potrdi\/(.+)$/" => function($method, $kljuc){
                UporabnikService::potrdiUporabnika($kljuc);
                ViewUtil::redirect(BASE_URL);
            },
            //test image
            "/^slika\/preview$/" => function(){
                echo ViewUtil::render("app/views/slika-preview.php", [
                    "slika_url" => "data/images/in-flames-desktop.jpg"
                    ]);
            },
            "/^slika\/test$/" => function($method){
                if($method == "POST"){
                    //shrani sliko
                    if(isset($_POST["submit"])){
                        try {
                            FileService::naloziSliko($_FILES["img"], "testna_slika123");
                            echo ViewUtil::renderJSON(["msg" => "Uspeh!"], 200);
                        } catch(InvalidArgumentException $e){
                                echo ViewUtil::renderJSON(["napaka" => $e->getMessage()], 400);
                        } catch(Exception $ex) {
                            echo ViewUtil::renderJSON(["napaka" => $ex->getMessage()], 400);
                        }
                    } else {
                        echo ViewUtil::renderJSON(["napaka" => "tukaj sem"], 400);
                    }
                } else {
                    echo ViewUtil::render("app/views/slika.php");
                }
            },
            "/^test\/izdelek\/(\d+)$/" => function($method, $id) {
                echo Slika::pridobiStevilkoSlike(["izdelek_id" => $id]);
            }



        ];
    }

    public static function handleRouters($routers, $path){
        foreach($routers as $pattern => $controller){
            if(preg_match($pattern, $path, $params)){
                try {
                    $params[0] = $_SERVER["REQUEST_METHOD"];
                    $controller(...$params);
                } catch(InvalidArgumentException $iae){
                    ViewUtil::handleError404();
                } catch(Exception $e) {
                    ViewUtil::displayError($e);
                }

                exit();
            }
        }
    }

}