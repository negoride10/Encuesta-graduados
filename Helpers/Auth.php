<?php

function verifyIsAuthenticated()
{
    $redirectUri = '/pending.php';
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
    $redirectUri = '/pending.php';
    header("Location: $redirectUri");
    die();
}