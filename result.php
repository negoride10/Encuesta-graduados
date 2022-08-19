<?php
require 'vendor/autoload.php';
require 'Helpers/OspinaMysqlHelper.php';

/* Recibir el ID del (parámetro get)*/
$id = getIdFromRequest();

/* Consultar ese ID en las DB*/
$mysql = OspinaMysqlHelper::newMysqlObject('encuesta_graduados', 'local');

//Building the query
$sql = "SELECT * FROM form_answers WHERE id=$id";
$queryBuilder = \Ospina\SmartQueryBuilder\SmartQueryBuilder::table('form_answers');
$query = $queryBuilder->select(['*'])
    ->where('id', '=', $id);
$finalquery = $query->getQuery();

//Execute the query
$result = $mysql->makeQuery($finalquery);
$finalResult = $result->fetch_all(MYSQLI_ASSOC);
dd($finalResult);

/* Obtener los campos necesarios (cedula, correo, respuestas)*/



/* Parsear las respuestas*/



/* Construir front*/



/* Enviar datos al front para renderizar*/




//En este espacio comienzan las funciones a ejecutar - Modo refactor es el método Optimizar el código)

function getIdFromRequest(){
    return $_GET['id'];
}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}