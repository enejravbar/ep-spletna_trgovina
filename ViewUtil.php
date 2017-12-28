<?php

include_once "app/models/Uporabniki.php";

class ViewUtil {

    // simulira prijavljenega uporabnika
    public static function prijavljenUser($vloga) {
        // user z id 1 je admin, z 2 je prodajalec, z 3 je kupec
        return Uporabniki::get(["id" => $vloga]);
    }

    public static function render($file, $variables = array()){
        extract($variables);

        ob_start();
        include($file);
        return ob_get_clean();
    }

    public static function redirect($url){
        header("Location: " . $url);
    }

    public static function handleError404(){
        header("Napaka! Stran ne obstaja!", true, 404);
        $content = sprintf("<!doctype html>\n" .
            "<title>Error 404: Page does not exist</title>\n" .
            "<h1>Error 404: Page does not exist</h1>\n" .
            "<p>The page <i>%s</i> does not exist.</p>", $_SERVER["REQUEST_URI"]);
        echo $content;
    }

    public static function renderJSON($data, $httpResponseCode = 200){
        header("Content-Type: application/json");
        http_response_code($httpResponseCode);
        return json_encode($data);
    }

    public static function displayError($exception, $debug = false) {
        header('An error occurred.', true, 400);

        if ($debug) {
            $hmtl = sprintf("<!doctype html>\n" .
                "<title>Error: An application error.</title>\n" .
                "<h1>Error: An application error</h1>\n" .
                "<p>The page <i>%s</i> returned an error:" .
                "<blockquote><pre>%s</pre></blockquote></p>", $_SERVER["REQUEST_URI"], $exception);
        } else {
            $hmtl = sprintf("<!doctype html>\n" .
                "<title>Error: An application error.</title>\n" .
                "<h1>Error: An application error</h1>\n" .
                "<p>The page <i>%s</i> returned an error.", $_SERVER["REQUEST_URI"]);
        }

        echo $hmtl;
    }
}