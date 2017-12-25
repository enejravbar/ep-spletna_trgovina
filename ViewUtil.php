<?php

class ViewUtil {

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
}