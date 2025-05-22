<?php

define('BASE_PATH', dirname(__DIR__));

require_once BASE_PATH . '/config/session.config.php';
require_once BASE_PATH . '/vendor/autoload.php';

error_reporting(E_ALL);
// ini_set("display_errors",0);
ini_set("display_errors", 1);
ini_set('log_errors', 1);

use App\Core\App;

if (!class_exists(App::class)) {
  echo "App class not autoloaded. Check PSR-4 setup.";
  die;
}

$app = new App();
$app->run();