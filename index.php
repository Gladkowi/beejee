<?php
error_reporting (E_ALL);
include ('config.php');
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
$dbObject->exec('SET CHARACTER SET utf8');
include (SITE_PATH . DS . 'core' . DS . 'core.php');
$router = new Router();
$router->setPath (SITE_PATH . 'controllers');
$router->start();

