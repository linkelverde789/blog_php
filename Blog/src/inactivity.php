<?php
session_start();

if (!isset($_SESSION["username"]) || !isset($_SESSION["id"])) {
    header('Location: login.html');
    exit();
}

$timeLimit = 300;

if (isset($_SESSION["last_time"]) && (time() - $_SESSION["last_time"] > $timeLimit)) {
    session_unset();
    session_destroy();
    header('Location: logout.html');
    exit();
}
$_SESSION["last_time"] = time();
?>