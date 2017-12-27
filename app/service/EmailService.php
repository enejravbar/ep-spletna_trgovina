<?php

require_once "app/models/Email.php";
require_once "ConfigurationUtil.php";

class EmailService {

    public static function posljiEmail($sporocilo){

        if(!is_a($sporocilo, "Email")){
            throw new Exception("Napačen tip sporočila! Mora biti tipa Email.php");
        }

        $sender = $sporocilo->getPosiljatelj();
        $receiver = $sporocilo->getPrejemnik();

        $headers = array(
            "From" => "<$sender>",
            "To" => "<$receiver>",
            "Subject" => $sporocilo->getZadeva()
        );

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

        $mail = $smtp->send($sporocilo->getPrejemnik(), $headers, $sporocilo->getVsebina());

        if(PEAR::isError($mail)){
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }

    }

}