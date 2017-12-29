<?php

require_once "ViewUtil.php";
require_once "app/service/EmailService.php";
require_once "app/service/LogService.php";
require_once "app/service/UporabnikService.php";
require_once "app/service/FileService.php";

class Usmerjevalniki {

    public static function getRouters(){
        return [
            //index page
            "/^$/" => function() {
                IndexController::index();
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
            //testni routi
            "/^test_mail$/" => function() {
                $email = new Email(
                    "miha_jamsek@windowslive.com",
                    "Zadeva",
                    "app/views/confirmation-email.php",
                    ["kljuc" => "kljuc123"]
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
            "/^slika$/" => function($method){
                if($method == "POST"){
                    //shrani sliko
                    if(isset($_POST["submit"])){
                        try {
                            FileService::naloziSliko($_FILES["img"]);
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