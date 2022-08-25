<?php
session_start();
require 'vendor/autoload.php';
require 'Helpers/Auth.php';

use eftec\bladeone\BladeOne;
use Ospina\EasyLDAP\EasyLDAP;

if (auth()) {
    header("Location: /pending.php");
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        handleGetRequest();
        break;
    case 'POST':
        handlePostRequest();
        break;
}
/**
 * @return void
 */
function handleGetRequest()
{
    parseLoginView();
}

/**
 * @return void
 * @throws JsonException
 */
function handlePostRequest()
{
    try {
        $request = parseRequest();
    } catch (RuntimeException $e) {
        //Render the login view again.
        $error = $e->getMessage();
        parseLoginView($error);
    }

    $auth = authenticate($request->username, $request->password);
    //Invalid credentials
    if ($auth === false) {
        $error = 'Los datos que ingresaste no coinciden con nuestro registros';
        parseLoginView($error);
    }
    setSessionObject($request->username);
    header("Location: /pending.php");
}

/**
 * @param $username
 * @param $password
 * @return bool
 * @throws RuntimeException
 */
function authenticate($username, $password): bool
{
    $easyLDAP = new EasyLDAP(false);
    $role = 0; //Functionary
    try {
        $easyLDAP->authenticate($username, $password, $role);
        return true;
    } catch (\Exception $e) {
        return false;
    }
}

function parseLoginView($error = null)
{
    $blade = new BladeOne();
    try {
        if ($error === null) {
            echo $blade->run("login");
        } else {
            echo $blade->run("login", compact('error'));
        }
    } catch (Exception $e) {
        echo 'Ha ocurrido un error renderizando la vista';
    }
    die();
}

function setSessionObject($username)
{
    $_SESSION['auth'] = true;
    $_SESSION['username'] = $username;
}

/**
 * @return object
 * @throws RuntimeException
 */
function parseRequest(): object
{
    if (!$_POST['username']) {
        throw new RuntimeException('Debes introducir un nombre de usuario');
    }
    if (!$_POST['password']) {
        throw new RuntimeException('Debes introducir una contraseña válida');
    }

    return (object)$_REQUEST;

}