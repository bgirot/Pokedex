<?php

function displayPokedex($pokedex) {
    echo '<ul class = "pokedex-wrapper">';

    foreach($pokedex as $key => $value) {
        echo '<li class="pokemon-card">';

        echo '<span class="pokemon-id"> # ' .$value["id_pokemon"]. '</span>';
        echo '<img src=" '.$value["image_path"].' " alt=" '.$value["nom"].' ">';
        echo '<span class="pokemon-name">'.$value["nom"].'</span>';
        
        echo '</li>';
    }

    echo '</ul>';
}