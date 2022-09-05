<?php

//Autoload the real autoloader

require_once '../../vendor/autoload.php';
require_once '../../Helpers/Sessions.php';
require_once '../../Helpers/Auth.php';

use Dotenv\Dotenv;

//Prepare dotenv
$dotenv = Dotenv::createUnsafeImmutable(__DIR__ . '/../../');
$dotenv->load();