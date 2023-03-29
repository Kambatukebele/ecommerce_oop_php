<?php

session_start();

// $ABSOLUTE_PATH = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . "/";

define("ROOT", "http://localhost:8080/");
define("ASSETS", "assets");

include "../app/init.php";
$app = new App();
