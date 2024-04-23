<?php

// Affichage des erreurs côté PHP et côté MYSQLI

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Imports
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/includes/constants.php');

require_once(DOCUMENT_ROOT .  '/src/static/head.php');
require_once(DOCUMENT_ROOT .  '/src/static/header.php');
require_once(DOCUMENT_ROOT .  '/src/static/body.php');
require_once(DOCUMENT_ROOT .  '/src/static/footer.php');


?>
<!DOCTYPE html>

<html lang="fr">
    

    <?php
        includeHead(ABOUT_WIP_STYLE_PATH);
        openBody();

    ?>

    <div class="wrapper">

        <div class="container">

            <img src="<?php echo PROJECT_ICON_PATH; ?>" alt="Icone projet">

            <p id="about-title">Projet module BDD-IHM, CUPGE 2 ESIR</p>
        </div>

        <div class="container">
        <p>Auteur: Balthazar GIROT</p>

            <a href="https://github.com/bgirot" class="btn main-btn arrow" target="_blank">
                Contact
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="arrow" x="0px" y="0px" width="11.121px" height="19.414px" viewBox="0 0 11.121 19.414" enable-background="new 0 0 11.121 19.414" xml:space="preserve">
                    <polygon fill="#fff" points="1.414,19.414 0,18 8.293,9.707 0,1.414 1.414,0 11.121,9.707 "/>
                </svg> 
            </a>
        </div>

    </div>


    <?php

        closeBody();
    ?>


</html>