<?php

// Affichage des erreurs côté PHP et côté MYSQLI

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Imports
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/includes/constants.php');

require_once(DOCUMENT_ROOT .  '/src/includes/dbConfig.php');
require_once(DOCUMENT_ROOT .  '/src/scripts/dbFunctions.php');
require_once(DOCUMENT_ROOT .  '/src/scripts/functionsQuery.php');


$mysqli = connectionDB();


$username = $_POST["username"];
$password = $_POST["password"];

$login_result = loginResult($mysqli, $username, $password);

if (empty($login_result)) {
    
    closeDB($mysqli);
    header('Location: ./connection.php?err=1');
    exit();

} else {
    session_start();

    $_SESSION["is_connected"] = true;
    $_SESSION["id_user"] = $login_result[0]["id_dresseur"];
    $_SESSION["username"] = $username;

    closeDB($mysqli);
    header('Location: ../../index.php');
    exit();

}