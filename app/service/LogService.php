<?php

require_once "app/models/DB_connection.php";
require_once "ConfigurationUtil.php";

class LogService {

    const ADMIN_FILE = "log-admin.txt";
    const PRODAJALEC_FILE = "log-sales.txt";
    const OTHER_FILE = "log-general.txt";

    //$log = ""/admin/prodajalec
    public static function info($log, $tag, $message){
        $zapis = "[INFO] " . date("Y-m-d H:i:s") . "   " . $tag . ": " . $message . PHP_EOL;
        switch($log){
            case "admin":
                self::zapisiVDatoteko(self::ADMIN_FILE, $zapis);
                break;
            case "prodajalec":
                self::zapisiVDatoteko(self::PRODAJALEC_FILE, $zapis);
                break;
            default:
                self::zapisiVDatoteko(self::OTHER_FILE, $zapis);
                break;
        }
    }

    public static function warning($log, $tag, $message){
        $zapis = "[WARNING] " . date("Y-m-d H:i:s") . "   " . $tag . ": " . $message . PHP_EOL;
        switch($log){
            case "admin":
                self::zapisiVDatoteko(self::ADMIN_FILE, $zapis);
                break;
            case "prodajalec":
                self::zapisiVDatoteko(self::PRODAJALEC_FILE, $zapis);
                break;
            default:
                self::zapisiVDatoteko(self::OTHER_FILE, $zapis);
                break;
        }
    }

    public static function error($log, $tag, $message){
        $zapis = "[ERROR] " . date("Y-m-d H:i:s") . "   " . $tag . ": " . $message . PHP_EOL;
        switch($log){
            case "admin":
                self::zapisiVDatoteko(self::ADMIN_FILE, $zapis);
                break;
            case "prodajalec":
                self::zapisiVDatoteko(self::PRODAJALEC_FILE, $zapis);
                break;
            default:
                self::zapisiVDatoteko(self::OTHER_FILE, $zapis);
                break;
        }
    }

    private static function zapisiVDatoteko($datoteka, $sporocilo){

        $pot = ConfigurationUtil::getConfByKey("log_root_dir") . "/" . $datoteka;

        file_put_contents($pot, $sporocilo, FILE_APPEND | LOCK_EX);
    }

}