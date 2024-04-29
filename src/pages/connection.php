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
        includeHead(CONNECTION_STYLE_PATH);
        $mysqli = connectionDB();
        openBody();

    ?>

    <div class="connection-wrapper">
        <section class="form-section">
            <div class="title-and-form-container">
                <h2 class="login-title">
                    Connectez vous
                    <?php
                        $redirect = "index";

                        if(isset($_GET["err"])) {
                            if($_GET["err"] == 2) {
                                echo '<div class="incorrect">Connectez vous pour accéder à votre Pokédex</div>';
                                $redirect = "pokedex";
                            }
                        }
                    ?>
                </h2>
                <form method="post" action="login.php?redirect=<?php echo $redirect?>">
                    <div class="all-inputs-container">
                        <div class="input-container">
                            <label for="username">Nom d'utilisateur</label>
                            <input id="username" name="username" type="text" required>
                        </div>
                        <div class="input-container">
                            <label for="password">Mot de passe</label>
                            <input id="password" name="password" type="password" required>
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
                        <input class="btn submit-btn" type="submit" value="Se connecter">
                    </div>
                </form>
            </div>
            <div class="forgot-container">
                <a class="btn forgot-btn" href="<?php echo WIP_PATH ?>">Mot de passe oublié ?</a>
            </div>
        </section>
    </div>

    <?php

        closeDB($mysqli);
        closeBody();
    ?>


</html>