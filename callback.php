<?php
require 'vendor/autoload.php';
require 'Helpers/OspinaMysqlHelper.php';
//parse the request
$request = parseRequest();
//Get identification number an email
$identification_number = getIdentificationNumberFromRequest($request);
$email = getEmailFromRequest($request);
$answer = getAnswersFromRequestAsJsonText($request);

//Check if is graduated
$isGraduated = verifyIfIsGraduated($identification_number);

//Generate query
$smartQueryBuilder = \Ospina\SmartQueryBuilder\SmartQueryBuilder::table('form_answers');
$smartQueryBuilder->insert([
    'email' => $email,
    'identification_number' => $identification_number,
    'is_graduated' => $isGraduated,
    'answer' => $answer,
    'created_at' => date('Y-m-d H:i:s'),
]);

$query = $smartQueryBuilder->getQuery();

$connection = OspinaMysqlHelper::newMysqlObject('form_egresados', 'local');
$mysqlResponse = $connection->makeQuery($query);
dd($mysqlResponse);
function getEmailFromRequest($request)
{
    return $request->code_user;
}

function getAnswersFromRequestAsJsonText($request)
{
    return json_encode($request->answers,JSON_UNESCAPED_UNICODE);
}


function verifyIfIsGraduated(string $identification_number): bool
{

    return true;
    $endpoint = 'https://academia.unibague.edu.co/atlante/esegresado.php';
    $curl = new \Ospina\CurlCobain\CurlCobain($endpoint);
    $curl->setQueryParamsAsArray([
        'consulta' => 'Consultar',
        'documento' => $identification_number,
    ]);
    $response = $curl->makeRequest();

    return json_decode($response, true);
}

function getIdentificationNumberFromRequest($request)
{
    $identificationNumberQuestionName = 'Número de identificación';
    return $request->answers[$identificationNumberQuestionName];
}

function parseRequest()
{
    return (object)[
        "code_user" => "juan.ospina@unibague.edu.co",
        "answers" => [
            "Número de identificación" => "1234644399",
            "Preguna 1" => "Opción 1",
            "Pregunta abierta" => "asasasas"
        ],
        "form_id" => "1dO_iwTu3KaMB-dsjyu3Tf2uuWrvDfxSb-E_zB4oW8KY",
        "questions" => [
            "Preguna 1" => "MULTIPLE_CHOICE",
            "Pregunta abierta" => "PARAGRAPH_TEXT"
        ]
    ];

}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}