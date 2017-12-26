<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 20:06
 */

require_once "Mail.php";
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
            "Subject" => $sporocilo->getZadeva()
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

        //poslji sporocilo
        $mail = $smtp->send($sporocilo->getPrejemnik(), $headers, $sporocilo->getVsebina());

        //handle errors
        if(PEAR::isError($mail)){
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }

    }

}