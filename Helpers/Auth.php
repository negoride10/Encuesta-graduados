<?php

function verifyIsAuthenticated()
{
    if (!auth()) {
        header("Location: /login.php");
        die();
    }
}

function auth(): bool
{
    if (isset($_SESSION['auth'])) {
        return $_SESSION['auth'] === true;
    }

    return false;
}

function user(): ?object
{
    if (auth()) {
        return (object)[
            'username' => $_SESSION['username'],
            'id' => $_SESSION['id'],
        ];
    }
    return null;
}

function redirectToDefaultRoute()
{
    $redirectUri = '/ready.php';
    header("Location: $redirectUri");
    die();
}