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
        // echo '<pre>';
        // print_r($pokemon);
        // echo '</pre>';

    ?>

    <div class="pokemon-wrapper">

        <section class="left">

            <div class="name-container">
                <h2 class="name"><?php echo $pokemon["infos"]["0"]["nom"] ?></h2>
                <div class="name-decoration"></div>
            </div>

            <div class="types-container">
                <?php
                    foreach($pokemon["types"] as $key => $value) {
                        echo'<div class="type ' .strtolower($value["libelle"]). '">
                                 <span>Type : ' .$value["libelle"]. '</span>
                                 <img src="' .TYPE_ICONS_PATH. 'type-' .$value["id_type"]. '.svg" alt="Icone type ' .$value["libelle"]. '"></img>
                             </div>';
                    }
                ?>
            </div>

            <span class="description"><?php echo $pokemon["infos"]["0"]["description"] ?></span>

            <div class="fictive-element"></div>

        </section>


        <section class="middle">
            
            <div class="image-and-stats-container">
                <div class="stats-wrapper">
                    <div class="stats-container">
                        <div class="top">
                            <div class="line horizontal"></div>
                            <div class="circle"></div>
                        </div>
                        <div class="stats-center">
                            <span class="height"><?php echo'Taille - ' .$pokemon["infos"]["0"]["taille"]. ' m' ?></span>
                            <div class="line vertical"></div>
                        </div>
                        <div class="bottom">
                            <div class="shapes-container">
                                <div class="line horizontal"></div>
                                <div class="circle"></div>
                            </div>
                            
                            <span class="weight"><?php echo'Poids - ' .$pokemon["infos"]["0"]["poids"]. ' kg' ?></span>
                        </div>
                    </div>
                </div>
                <div class="image-container">
                    <?php echo'<img id="img-pokemon" src="' .POKEMON_SUGIMORI_PATH. $pokemon["infos"]["0"]["id_pokemon"] . '.png" alt="Image de ' .$pokemon["infos"]["0"]["nom"]. '"></img>'?>
                    <div class="shadow"></div>
                </div>
            </div>

            <div class="toggle-container">
                <div class="choice">
                    <input id="normal" name="normal-or-shiny" type="radio" checked="checked" onchange="shinyToNormal()">
                    <label class="btn" for="normal">Normal</label>
                </div>
                <div class="choice">
                    <input id="shiny" name="normal-or-shiny" type="radio" onchange="normalToShiny()">
                    <label class="btn" for="shiny">Shiny</label>
                </div>
            </div>

        </section>


        <section class="right">
            <div class="evolutions-section">
                <h3 class="evolution-line top"></h3>
                <h3 class="evolutions">Évolutions</h3>
                <h3 class="evolution-line bottom"></h3>
            </div>
            <div class="carousel">
                <div class="images">
                    <?php
                        foreach($pokemon["pre_evolutions"] as $key => $value) {
                            echo '<div class="img-evolution inactive"><div class="img-wrapper"><img src="' .POKEMON_SUGIMORI_PATH. $value["id_pokemon_base"]. '.png" alt="Pokémon ' .$value["nom"]. '"></img></div></div>';
                        }
                        echo '<div class="img-evolution active"><div class="img-wrapper"><img src="' .POKEMON_SUGIMORI_PATH. $pokemon["infos"]["0"]["id_pokemon"]. '.png" alt="Pokémon ' .$pokemon["infos"]["0"]["nom"]. '"></img></div></div>';
                        foreach($pokemon["evolutions"] as $key => $value) {
                            echo '<div class="img-evolution inactive"><div class="img-wrapper"><img src="' .POKEMON_SUGIMORI_PATH. $value["id_pokemon_evolue"]. '.png" alt="Pokémon ' .$value["nom"]. '"></img></div></div>';
                        }
                    ?>
                </div>
                <div class="arrows">
                    <button class="btn arrow up">
                        <?php echo '<img src="' .ARROW_PATH. '" alt="arrow up"></img>' ?>
                    </button>
                    <button class="btn arrow down">
                    <?php echo '<img src="' .ARROW_PATH. '" alt="arrow down"></img>' ?>
                    </button>
                </div>
            </div>
        </section>
    </div>

    <?php
        closeBody();
    ?>


</html>