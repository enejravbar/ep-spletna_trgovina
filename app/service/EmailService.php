<?php
/**
 * Created by PhpStorm.
 * User: miha
 * Date: 26.12.2017
 * Time: 20:06
 */

require_once "Mail.php";
require_once "app/models/Email.php";
require_once "ConfigurationUtilp.php";

class EmailService {

    public static function posljiEmail($sporocilo){

        if(!is_a($sporocilo, "Email")){
            return false;
        }

        $headers = array(
            "From" => $sporocilo->getPosiljatelj(),
            "To" => $sporocilo->getPrejemnik(),
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

        $mail = $smtp->send($sporocilo->getPosiljatelj(), $headers, $sporocilo->getVsebina());

        if(PEAR::isError($mail)){
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }

    }

}