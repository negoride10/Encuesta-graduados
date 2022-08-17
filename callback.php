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
    'answers' => $answer,
    'created_at' => date('Y-m-d H:i:s'),
]);

$query = $smartQueryBuilder->getQuery();
$connection = OspinaMysqlHelper::newMysqlObject('encuesta_graduados', 'local');
$mysqlResponse = $connection->makeQuery($query);
dd($mysqlResponse);


function getEmailFromRequest($request)
{
    return $request->code_user;
}

function getAnswersFromRequestAsJsonText($request)
{
    return json_encode($request->answers, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE);
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
    return $request->answers->$identificationNumberQuestionName;
}

/**
 * @throws JsonException
 */
function parseRequest()
{

    $data = file_get_contents('./data.json');
    //$data = file_get_contents('php//input');
    return json_decode($data, false, 512, JSON_THROW_ON_ERROR);

}

function dd($var)
{
    header('Content-Type: application/json;charset=utf-8');
    echo json_encode($var);
    die();
}