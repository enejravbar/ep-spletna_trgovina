<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 19:31
 */

require_once "ViewUtil.php";
require_once "app/service/EmailService.php";

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
            "/^mail$/" => function() {
                EmailService::posljiEmail(new Email("miha_jamsek@windowslive.com", "dds", "dsd"));
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