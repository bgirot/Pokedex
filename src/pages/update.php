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
session_start();

$seen = $_POST["seen"];
$caught = $_POST["caught"];

$id_dresseur = $_SESSION["id_user"];
$id_pokemon = $_GET["id_pokemon"];
$pokedex_dresseur = getPokedexDresseur($mysqli, $id_dresseur);

updateStats($mysqli, $seen, $caught, $id_pokemon, $id_dresseur, $pokedex_dresseur);


closeDB($mysqli);

header('Location: ' .POKEMON_PATH. '?id_pokemon='.$id_pokemon.' ');
exit();