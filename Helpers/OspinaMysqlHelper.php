<?php
//Prepare variables
include_once 'MysqlConnectionSettings.php';

class OspinaMysqlHelper
{
    private mysqli $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public static function verifyConnectionErrors(mysqli $mysqli)
    {
        if ($mysqli->connect_error) {
            $errorCode = $mysqli->connect_errno;
            $msg = $mysqli->connect_error;
            die("Error de conexión. Codigo ${errorCode} : ${msg}");
        }
    }

    public static function newMysqlObject(string $database = 'mantis', string $environment = 'local'): OspinaMysqlHelper
    {
        $settings = new MysqlConnectionSettings($environment);
        $mysqli = new mysqli($settings->host, $settings->user, $settings->password, $database);
        $mysqli->set_charset('utf8'); //VERY IMPORTANTTT
        self::verifyConnectionErrors($mysqli);
        //No errors, return the instance
        return new self($mysqli);
    }

    public function makeQuery(string $query)
    {
        return $this->mysqli->query($query);
    }
}