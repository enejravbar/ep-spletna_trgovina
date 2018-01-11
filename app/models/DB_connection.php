<?php

require_once "ConfigurationUtil.php";

class DB_connection {

    private static $instance = null;

    public static function getInstance(){
        $conf = ConfigurationUtil::getConfs();

        if(!self::$instance){
            $config = "mysql:host=" . $conf["db_host"] . ";dbname=" . $conf["db_schema"];
            $options = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_PERSISTENT => true,
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            );
            self::$instance = new PDO($config, $conf["db_user"], $conf["db_pass"], $options);
        }
        return self::$instance;
    }
}