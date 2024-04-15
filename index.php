<?php

// Affichage des erreurs côté PHP et côté MYSQLI

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Imports
require_once("./src/includes/constants.php");

require_once("./src/static/head.php");
require_once("./src/static/header.php");
require_once("./src/static/body.php");
require_once("./src/static/footer.php");


?>
<!DOCTYPE html>

<html lang="fr">
    

    <?php
        includeHead();
        includeBody();
    ?>


</html>