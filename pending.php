<?php
require 'vendor/autoload.php';
require 'Helpers/OspinaMysqlHelper.php';

use eftec\bladeone\BladeOne;
use Ospina\SmartQueryBuilder\SmartQueryBuilder;


//get queries
$graduatedQuery = getGraduatedQuery();
$notGraduatedQuery = getNotGraduatedQuery();

//Get general connection
$connection = OspinaMysqlHelper::newMysqlObject('encuesta_graduados', 'local');

//make graduated query
$mysqlGraduatedResponse = $connection->makeQuery($graduatedQuery);
$graduatedAnswers = $mysqlGraduatedResponse->fetch_all(MYSQLI_ASSOC);

//make not graduated query
$mysqlNotGraduatedResponse = $connection->makeQuery($notGraduatedQuery);
$notGraduatedAnswers = $mysqlNotGraduatedResponse->fetch_all(MYSQLI_ASSOC);


$blade = new BladeOne(); // MODE_DEBUG allows to pinpoint troubles.

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

/**
 * @return string|null
 */
function getGraduatedQuery(): ?string
{
    $smartQueryBuilder = SmartQueryBuilder::table('form_answers');
    $smartQueryBuilder->select(['*'])->where('is_graduated', '=', 1);
    $query = $smartQueryBuilder->getQuery();
    return $query;
}

/**
 * @return string|null
 */
function getNotGraduatedQuery(): ?string
{
    $smartQueryBuilder = SmartQueryBuilder::table('form_answers');
    $smartQueryBuilder->select(['*'])->where('is_graduated', '=', 0);
    $query = $smartQueryBuilder->getQuery();
    return $query;
}
