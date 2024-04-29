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

        $pokedex = getPokedex($mysqli);

    ?>

    <div class="edit-wrapper">

        <section class="form-section">

            <form method="post" action="">
                <h2 class="edit-title">
                    Modifier un pokémon
                </h2>

                <div class="all-inputs-container">
                        <div class="pokemon-input-container">
                            <div class="pokemon-input">
                                <img src="<?php echo EDIT_ICON_PATH ?>" alt="Bouton éditer">
                                <input class="pokemon-input" list="Pokemon" onchange="console.log('ok')" value="<?php echo $pokedex[0]["nom"]?>">
                                <datalist id="Pokemon">
                                <?php
                                    foreach($pokedex as $key => $value) {
                                        echo '<option value="' .$value["nom"]. '"></option>';
                                    }
                                ?>
                                </datalist>
                            </div>
                            <img class="pokemon-img" src="/ressources/images/pokemons/pokemon_sugimori/1.png" alt="Test">
                        </div>

                        <div class="stats-inputs-container">
                            <div class="stat-input">
                                <input id="seen" name="seen" type="number" required>
                            </div>

                            <div class="stat-input">
                                <input id="caught" name="caught" type="number" required>
                            </div>
                        </div>

                        <?php
                            if(isset($_GET["err"])) {
                                if($_GET["err"] == 1) {
                                    echo '<div class="incorrect">Nom d\'utilisateur ou mot de passe incorrect</div>';
                                }
                            }
                        ?>
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