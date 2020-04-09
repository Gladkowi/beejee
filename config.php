<?php
define ('DS', DIRECTORY_SEPARATOR); 
$sitePath = realpath(dirname(__FILE__)) . DS; //$sitePath = realpath(dirname(__FILE__) . DS) . DS;
define ('SITE_PATH', $sitePath); 
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_NAME', 'nvc');
session_start();
