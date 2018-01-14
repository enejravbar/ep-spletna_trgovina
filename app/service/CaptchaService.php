<?php
require_once "ConfigurationUtil.php";

class CaptchaService {

    public static function preveriCaptcho($response) {
        $url = "https://www.google.com/recaptcha/api/siteverify";
        $data = [
            "secret" => ConfigurationUtil::getConfByKey("captcha_secret"),
            "response" => $response
            ];

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        $result = json_decode($result);

        return $result->{'success'};
    }
}