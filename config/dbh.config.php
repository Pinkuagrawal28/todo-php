<?php

use App\Service\EnvHandler;

$env = new EnvHandler();

return [
    'host'    => $env->get("host"),
    'port'    => $env->get("port"),
    'db_name' => $env->get("db_name"),
    'user'    => $env->get("user"),
    'pass'    => $env->get("pass"),
    'charset' => $env->get("charset"),
];
