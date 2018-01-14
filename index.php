<?php

require_once "ViewUtil.php";
require_once "Usmerjevalniki.php";

session_start();

define("BASE_URL", $_SERVER["SCRIPT_NAME"] . "/");
define("IMAGES_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/images/");
define("ROOT_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php"));
define("CSS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/css/");
define("JS_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/js/");
define("LIB_URL", rtrim($_SERVER["SCRIPT_NAME"], "index.php") . "static/libraries/");

$path = isset($_SERVER["PATH_INFO"]) ? trim($_SERVER["PATH_INFO"], "/") : "";

// definicija usmerjevalnikov:
$urls = Usmerjevalniki::getRouters();

// izvedba usmerjevalnikov:
Usmerjevalniki::handleRouters($urls, $path);
// ce se usmerjevalnik ne pometcha, potem sprozi exception:
ViewUtil::redirect(BASE_URL);
// ViewUtil::displayError(new InvalidArgumentException("No controller matched!"), true);
