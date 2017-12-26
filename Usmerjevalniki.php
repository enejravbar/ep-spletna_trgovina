<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 19:31
 */

require_once "ViewUtil.php";
require_once "app/service/EmailService.php";
require_once "app/service/LogService.php";

class Usmerjevalniki {

    public static function getRouters(){
        return [
            "/^$/" => function() {
                IndexController::index();
            },
            "/^api\/izdelki\/(\d+)$/" => function($method, $id = null){
                switch($method){
                    case "PUT":
                        IzdelekVir::get($id);
                        break;
                    case "DELETE":
                        IzdelekVir::get($id);
                        break;
                    default:
                        IzdelekVir::get($id);
                        break;
                }
            },
            "/^api\/izdelki$/" => function($method){
                switch($method) {
                    case "POST":
                        IzdelekVir::getAll();
                        break;
                    default:
                        IzdelekVir::getAll();
                        break;
                }
            },
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
            "" => function() {

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