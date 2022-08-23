<?php
include './vendor/autoload.php';

use Ospina\EasySQL\EasySQL;

$request = parseRequest();

$easySQL = new EasySQL('encuesta_graduados', 'local');
$easySQL->table('form_answers')->where('ID', '=', $request->id)->update(
    [
        'is_confirmed' => 0
    ]
);
header("Location: /pending.php");
die();

function parseRequest()
{
    return (object)$_REQUEST;
}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}

