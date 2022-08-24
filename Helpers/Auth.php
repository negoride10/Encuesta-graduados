<?php

function verifyIsAuthenticated()
{
    if ($_SESSION['auth'] !== true) {
        header("Location: /login.php");
        die();
    }
}