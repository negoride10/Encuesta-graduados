<?php
session_start();
require 'vendor/autoload.php';
require 'Helpers/Auth.php';

use eftec\bladeone\BladeOne;
use Ospina\EasySQL\EasySQL;

//Check if is auth
verifyIsAuthenticated();

//create db object
$graduatedAnswersConnection = new EasySQL('encuesta_graduados', 'local');
$graduatedAnswers = $graduatedAnswersConnection->table('form_answers')->select(['*'])
    ->where('is_graduated', '=', 1)
    ->isNull('is_confirmed')
    ->get();

//create db object
$notGraduatedAnswersConnection = new EasySQL('encuesta_graduados', 'local');
$notGraduatedAnswers = $notGraduatedAnswersConnection->table('form_answers')->select(['*'])
    ->where('is_graduated', '=', 0)
    ->isNull('is_confirmed')
    ->get();

$blade = new BladeOne();
try {
    $isPending = $_SESSION['pending'] ?? false;
    if ($isPending) {
        //Almacenar variable
        $message = $_SESSION['message'];

        //Limpiar variables antes de renderizar
        $_SESSION['message'] = '';
        $_SESSION['pending'] = false;
        echo $blade->run("pending", compact('graduatedAnswers', 'notGraduatedAnswers', 'message'));
    } else {
        echo $blade->run("pending", compact('graduatedAnswers', 'notGraduatedAnswers'));
    }

} catch (Exception $e) {
    echo 'Ha ocurrido un error';
}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}