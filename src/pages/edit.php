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
        includeHead(EDIT_STYLE_PATH);
        $mysqli = connectionDB();
        openBody();

        $pokedexDresseur = getPokedexDresseur($mysqli, $_SESSION["id_user"]);

    ?>

    <div class="edit-wrapper">

        <section class="form-section">

            <form id="edit-form" method="post" action="">
                <h2 class="edit-title">
                    Modifier un Pokémon
                </h2>

                <div class="all-inputs-container">
                    <div class="pokemon-input-container">
                        <div class="pokemon-input">
                            <img src="<?php echo EDIT_ICON_PATH ?>" alt="Bouton éditer">
                            <input id="pokemon-input" class="pokemon-input" list="Pokemon" onchange='pokemonSwitch(<?php echo json_encode($pokedexDresseur) ?>)' onmouseover="focus();" onkeydown="if(event.keyCode===13) {event.preventDefault(); document.getElementById('seen').focus();}">
                            <datalist id="Pokemon">
                            <?php
                                foreach($pokedexDresseur as $key => $value) {
                                    echo '<option value="' .$value["nom"]. '"></option>';
                                }
                            ?>
                            </datalist>
                        </div>
                        <div class="pokemon-img-wrapper">
                            <div class="pokemon-img-container">
                                <img id="pokemon-img" src="/ressources/images/pokemons/unknown-pokemon.png" alt="Test">
                                <div class="shadow"></div>
                            </div>
                        </div>

                        
                    </div>
                    
                    <div class="stats-input-wrapper">
                        <div class="stats-inputs-container">
                            <img src="<?php echo SEEN_ICON_PATH ?>" alt="Icone vu">

                            <div class="stat-input">
                                <button id="seen-minus" class="btn minus-btn" type="button" onclick="plusMinusHandler(this.id)">-</button>
                                <input id="seen" name="seen" type="number" value="0" required>
                                <button id="seen-plus" class="btn plus-btn" type="button" onclick="plusMinusHandler(this.id)">+</button>
                            </div>
                        </div>

                        <div class="stats-inputs-container">
                            <img src="<?php echo CAUGHT_ICON_PATH ?>" alt="Icone vu">

                            <div class="stat-input">    
                                <button id="caught-minus" class="btn minus-btn" type="button" onclick="plusMinusHandler(this.id)">-</button>
                                <input id="caught" name="caught" type="number" value="0" required>
                                <button id="caught-plus" class="btn plus-btn" type="button" onclick="plusMinusHandler(this.id)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="submit">
                    <input class="btn submit-btn" type="submit" value="Valider">
                </div>
            </form>

        </section>

    </div>

    <?php

        closeDB($mysqli);
        closeBody();
    ?>


</html>