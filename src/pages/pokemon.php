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
require_once(DOCUMENT_ROOT .  '/src/scripts/displayPokedex.php');

require_once(DOCUMENT_ROOT .  '/src/static/head.php');
require_once(DOCUMENT_ROOT .  '/src/static/header.php');
require_once(DOCUMENT_ROOT .  '/src/static/body.php');
require_once(DOCUMENT_ROOT .  '/src/static/footer.php');




?>
<!DOCTYPE html>

<html lang="fr">
    

    <?php
        includeHead(POKEMON_STYLE_PATH);
        $mysqli = connectionDB();
        openBody();


        // Checking if the parameter exists
        if(!isset($_GET['id_pokemon'])) {
            header('Location: ' .HOME_PATH. '');
            exit();
        } else{
            $id_pokemon = $_GET['id_pokemon'];
        }

        
        // Get the information from the database
        $pokemon = getPokemon($mysqli, $id_pokemon);

    ?>

    <div class="pokemon-wrapper">
        <div class="left"></div>

        <div class="middle"></div>

        <div class="right"></div>
    </div>

    <?php

        closeBody();
    ?>


</html>