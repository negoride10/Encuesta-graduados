<?php
require 'vendor/autoload.php';
require 'Helpers/OspinaMysqlHelper.php';

use eftec\bladeone\BladeOne;
use Ospina\EasySQL\EasySQL;

//create db object
$graduatedAnswersConnection = new EasySQL('encuesta_graduados', 'local');
$graduatedAnswers = $graduatedAnswersConnection->table('form_answers')->select(['*'])->where('is_graduated', '=', 1)->get();

//create db object
$notGraduatedAnswersConnection = new EasySQL('encuesta_graduados', 'local');
$notGraduatedAnswers = $notGraduatedAnswersConnection->table('form_answers')->select(['*'])->where('is_graduated', '=', 0)->get();

$blade = new BladeOne();
try {
    echo $blade->run("pending", compact('graduatedAnswers', 'notGraduatedAnswers'));
} catch (Exception $e) {
    echo 'Ha ocurrido un error';
}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}
