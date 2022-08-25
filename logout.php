<?php
echo 'hola';
die();
session_start();
session_destroy();
header("Location: index.php");
?>

