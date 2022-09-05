<?php

//Autoload the real autoloader

require_once '../../vendor/autoload.php';
require '../../Helpers/Sessions.php';

use Dotenv\Dotenv;

//Prepare dotenv
$dotenv = Dotenv::createUnsafeImmutable(__DIR__.'/../../');
$dotenv->load();