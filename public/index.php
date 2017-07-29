<?php
ini_set('display_errors', 1);
error_reporting(E_ALL^E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
if (phpversion() >= '5.3') {
    define('APP_PATH', dirname(__DIR__));
} else {
    define('APP_PATH', dirname(dirname(__FILE__)));
}

define('VIEW_PATH', APPLICATION_PATH.'/application/views/');
define('WEB_ROOT',  '/');
define('SSN_PASS',  'online');
define('SSN_INFO',  'msr');
define('SSN_VAR',  'hengyang');
define('SSN_LOG',   'log');
define('SSN_SA',    99999);
define('VERSION', '1.0.0');
define('DB_PREFIX',  'blog_');

define('VAL_YES',     1);
define('VAL_NO',      0);
define('VAL_ALL',   100);
define('VAL_NONE', -100);

require_once APP_PATH.'/vendor/autoload.php';

$app = new Yaf_Application(APP_PATH .'/conf/app.ini');

$app->getDispatcher()->catchException(true);
$app
    ->bootstrap()
    ->run();



