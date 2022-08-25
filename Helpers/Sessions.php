<?php

function flashSession($message)
{
    $_SESSION['pending'] = true;
    $_SESSION['message'] = $message;
}
