<?php
require 'vendor/autoload.php';
require 'Helpers/OspinaMysqlHelper.php';

//Leer y parsear la petición del front (ID)
$requestData = getDatafromPostRequest();
$id = getIdFromRequest();

//Crear un método para volver a sincronizar - Función (verifyIfIsGraduated) arroja 0 o 1
try {
    $response = verifyIfIsGraduated();
} catch (JsonException $e) {
}

//Actualizar DataBase
$mysql = OspinaMysqlHelper::newMysqlObject('encuesta_graduados','local');


//Mostrar en front el usuario actualizado y removido de "No encontrado"


//---------------- Functions-------------------

function getDatafromPostRequest(){

    if (!isset($_POST['id'])){
         echo 'Debe proporcionar un ID válido';
        die();
    }
    if (!isset($_POST['identification_number'])){
        echo 'Debe proporcionar una cédula válida';
        die();
    }
    $id = $_POST['id'];
    $identificationNumber = $_POST['identification_number'];

    $response = (object)[
        'id'=> $id,
        'identificationNumber'=> $identificationNumber,
        ];

    var_dump($response);
    die();
    return $_POST['id'];
}

//Function for read the petitions from Front
function getIdFromRequest(){
    return $_GET['id'];
}

//Function for verify
function verifyIfIsGraduated(string $identification_number): int
{
    $endpoint = 'https://academia.unibague.edu.co/atlante/graduados_siga.php';
    $curl = new \Ospina\CurlCobain\CurlCobain($endpoint);
    $curl->setQueryParamsAsArray([
        'consulta' => 'Consultar',
        'documento' => $identification_number,
    ]);
    $response = $curl->makeRequest();
    return json_decode($response, true, 512, JSON_THROW_ON_ERROR)['data'];
}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}
