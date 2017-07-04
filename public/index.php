<?php
ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
if (phpversion() >= '5.3') {
    define('APP_PATH', dirname(__DIR__));
} else {
    define('APP_PATH', dirname(dirname(__FILE__)));
}

require_once APP_PATH.'/vendor/autoload.php';

$app = new Yaf_Application(APP_PATH .'/conf/app.ini');

$app->getDispatcher()->catchException(true);
$app
    ->bootstrap()
    ->run();



