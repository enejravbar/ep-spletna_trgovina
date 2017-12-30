<?php

require_once "Mail.php";
require_once "Mail/mime.php";
require_once "app/models/Email.php";
require_once "ConfigurationUtil.php";
require_once "ViewUtil.php";

class EmailService {

    public static function posljiEmail($sporocilo){
        //ce niso parametri pravi, vrze exception
        if(!is_a($sporocilo, "Email")){
            throw new Exception("Napačen tip sporočila! Mora biti tipa Email.php");
        }

        //priprava headerjev
        $sender = $sporocilo->getPosiljatelj();
        $receiver = $sporocilo->getPrejemnik();
        $headers = array(
            "From" => "<$sender>",
            "To" => "<$receiver>",
            "Subject" => $sporocilo->getZadeva(),
            "Content-Type" => "text/html; charset=UTF-8"
        );

        //nastavitev konfiguracije e-mail streznika
        $conf = ConfigurationUtil::getConfs();
        $smtp = Mail::factory("smtp", array(
            "host" => $conf["email_host"],
            "port" => $conf["email_port"],
            "auth" => $conf["email_auth"],
            "username" => $conf["email_username"],
            "password" => $conf["email_password"]
        ));
        if (PEAR::isError($smtp)) {
            echo $smtp->getMessage() . "\n" . $smtp->getUserInfo() . "\n";
            die();
        }

        $mime = new Mail_mime(PHP_EOL);
        $mime->setTXTBody($sporocilo->getVsebina());
        $mime->setHTMLBody($sporocilo->getVsebina());

        $mime_params = array(
            "text_charset" => "UTF-8",
            "html_charset" => "UTF-8",
            "head_charset" => "UTF-8"
        );

        $body = $mime->get($mime_params);
        $headers = $mime->headers($headers);

        //poslji sporocilo
        $mail = $smtp->send($sporocilo->getPrejemnik(), $headers, $body);

        //handle errors
        if(PEAR::isError($mail)){
            throw new Exception("Napaka pri posiljanju emaila!");
        } else {
            return true;
        }

    }

}