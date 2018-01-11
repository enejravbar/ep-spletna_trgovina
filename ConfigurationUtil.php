<?php

class ConfigurationUtil {

    const CONFIGURATION_FILE = "conf.ini";

    private static function readConf(){
        $ini =  parse_ini_file(self::CONFIGURATION_FILE);
        if($ini["email_auth"] == 1){
            $ini["email_auth"] = true;
        }
        return $ini;
    }

    public static function getConfs(){
        return self::readConf();
    }

    public static function getConfByKey($key){
        $ini =  self::readConf();
        return $ini[$key];
    }

}