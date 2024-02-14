<?php

error_reporting(E_ALL);
ini_set('ignore_repeated_errors', TRUE);
ini_set('display_errors', FALSE);
ini_set('log_errors', TRUE);

ini_set("error_log", "c://xampp/htdocs/expenses/php-error.log");
error_log("Inicio de Aplicacion web");

require_once("libs/app.php");
$app = new App();
