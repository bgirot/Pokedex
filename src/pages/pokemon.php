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
require_once(DOCUMENT_ROOT .  '/src/scripts/utils.php');

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

            $pokedex = getPokedex($mysqli);

            // If the pokemon isn't in the pokdex
            // Not the best solution cauz the id doesn't necessarly matches the number of pokemons in the pokdex
            if($id_pokemon > count($pokedex)) {
                header ('Location: '.HOME_PATH.'');
                exit(); 
            }
        }

        
        // Get the information from the database
        $pokemon = getPokemon($mysqli, $id_pokemon);
        $allTypes = getAllTypes($mysqli);
        // echo '<pre>';
        // print_r($allTypes);
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
                <div id="move-btn" class="type btn">
                    <span>Capacités</span>
                    <img src="<?php echo SWORD_PATH ?>" alt="Icone attaque">
                    <div id="move-menu" class="moves-container inactive">
                        <div class="table-header">
                            <div class="fictive-element"></div>
                            <div class="caption">Capacités de <?php echo $pokemon["infos"]["0"]["nom"] ?></div>
                            <button id="move-close" class="close-btn btn">
                                <img src="<?php echo CROSS_PATH ?>" alt="Bouton Croix">
                            </button>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Capacité</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">PP</th>
                                    <th scope="col">Puissance</th>
                                    <th scope="col">Précision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 

                                    foreach($pokemon["moves"] as $key => $value) {
                                        if($value["puissance_capacite"] == null) {
                                            $puissance = 0;
                                        } else {
                                            $puissance = $value["puissance_capacite"];
                                        }

                                        echo '<tr>';
                                        echo '<th scope="row">' .$value["libelle_capacite"]. '</th>';
                                        echo '<td>' .$allTypes[$value["id_type"]]. '</td>';
                                        echo '<td>' .$value["pp_capacite"]. '</td>';
                                        echo '<td>' .$puissance. '</td>';
                                        echo '<td>' .$value["precision_capacite"]. '</td>';
                                        echo '</tr>';
                                    }
                                
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <span class="description"><?php echo $pokemon["infos"]["0"]["description"] ?></span>

            <?php
                if(isset($_SESSION["is_connected"])) {
                    if ($_SESSION["is_connected"]){
                        $stats = getStats($mysqli, $pokemon["infos"]["0"]["id_pokemon"], $_SESSION["id_user"]);
                        $nb_vue = $stats[0]["nbVue"];
                        $nb_attrape = $stats[0]["nbAttrape"];

                        echo '
                        
                        <div class="dresseur-stats-container">
                            <div class="dresseur-stat seen">
                                <img src="' .SEEN_ICON_PATH. '" alt="Icone vue"></img>
                                <span class="stat">
                                    ' .$nb_vue. '
                                    <div class="stat-description seen">Pokémon vu ' .$nb_vue. ' fois</div>
                                </span>
                            </div>
        
                            <div class="dresseur-stat caught">
                                <img src="' .CAUGHT_ICON_PATH. '" alt="Icone vue"></img>
                                <span class="stat">
                                    '.$nb_attrape.'
                                    <div class="stat-description">Pokémon attrapé ' .$nb_attrape. ' fois</div>
                                </span>
                            </div>
                        </div>
        
                        ';
                    }
                }
            ?>

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
                        $reversed_pre_evolutions = array_reverse($pokemon["pre_evolutions"]);   // So that the order is correct
                        foreach($reversed_pre_evolutions as $key => $value) {
                            if($key == 0) {
                                echo '<div class="img-evolution inactive"><div class="img-wrapper"><div class="level">Niveau 1 requis</div><img src="' .POKEMON_SUGIMORI_PATH. $value["id_pokemon_base"]. '.png" alt="Pokémon ' .$value["nom"]. '"></img></div></div>';
                            } else {
                                echo '<div class="img-evolution inactive"><div class="img-wrapper"><div class="level">Niveau ' .$reversed_pre_evolutions[$key - 1]["niveau"]. ' requis</div><img src="' .POKEMON_SUGIMORI_PATH. $value["id_pokemon_base"]. '.png" alt="Pokémon ' .$value["nom"]. '"></img></div></div>';
                            }

                            
                        }
                        echo '<div class="img-evolution active"><div class="img-wrapper"><img src="' .POKEMON_SUGIMORI_PATH. $pokemon["infos"]["0"]["id_pokemon"]. '.png" alt="Pokémon ' .$pokemon["infos"]["0"]["nom"]. '"></img></div></div>';
                        foreach($pokemon["evolutions"] as $key => $value) {
                            echo '<div class="img-evolution inactive"><div class="img-wrapper"><div class="level">Niveau ' .$value["niveau"]. ' requis</div><img src="' .POKEMON_SUGIMORI_PATH. $value["id_pokemon_evolue"]. '.png" alt="Pokémon ' .$value["nom"]. '"></img></div></div>';
                        }
                    ?>
                </div>
                <div class="arrows">
                    <?php
                        $href_up = switchEvolution($pokemon, "up");
                        $href_down = switchEvolution($pokemon, "down");

                        if($href_up == null) {
                            $href_up = "";
                        } else {
                            $href_up = POKEMON_PATH . '?id_pokemon=' . $href_up;
                        }

                        if($href_down == null) {
                            $href_down = "";
                        } else {
                            $href_down = POKEMON_PATH . '?id_pokemon=' . $href_down;
                        }
                        
                    ?>
                    <a class="btn arrow up" <?php echo 'href="' .$href_up. '"' ?>>
                        <?php echo '<img src="' .ARROW_PATH. '" alt="Flèche vers le haut"></img>' ?>
                    </a>
                    <a class="btn arrow down" <?php echo 'href="' .$href_down. '"' ?>>
                        <?php echo '<img src="' .ARROW_PATH. '" alt="Flèche vers le bas"></img>' ?>
                    </a>
                </div>
            </div>
        </section>
    </div>

    <?php
        closeDB($mysqli);
        closeBody();
    ?>


</html>