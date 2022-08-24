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
    return $_SESSION['auth'] === true;
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