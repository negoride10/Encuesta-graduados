<?php
session_start();
$_SESSION['auth'] = false;
$_SESSION['username'] = '';
header("Location: /index.php");
