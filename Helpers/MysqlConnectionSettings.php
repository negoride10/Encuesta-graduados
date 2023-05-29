<?php

class MysqlConnectionSettings

{
    public $host;
    public $user;
    public $password;

    public function __construct(string $environment = 'local')
    {

        $this->host = 'localhost';
        $this->user = 'root';
        if ($environment === 'local') {
            $this->password = '';
        } else {
            $this->password = ')Qf`4MS4>77h<dzt';
        }
    }

}

