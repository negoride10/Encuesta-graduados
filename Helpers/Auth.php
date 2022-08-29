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

function user(): ?string
{
    if (auth()) {
        return $_SESSION['username'];
    }
    return null;
}

function redirectToDefaultRoute()
{
    $redirectUri = '/ready.php';
    header("Location: $redirectUri");
    die();
}