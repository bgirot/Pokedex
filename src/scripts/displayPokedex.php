<?php

function displayPokedex($pokedex) {
    echo '<ul class = "pokedex-wrapper">';

    foreach($pokedex as $key => $value) {
        echo '<li id="card-' .$value["id_pokemon"]. '" class="pokemon-card">';

        echo '<span class="pokemon-id">#'. $value["id_pokemon"] .'</span>';
        echo '<a class="btn" href=""><img id="img-'.$value["id_pokemon"].'" class="pokemon-img" src="' . $value["image_path"] . '" alt=" '.$value["nom"].'"></a>';
        echo '<span class="pokemon-name">'. $value["nom"] .'</span>';
        echo '<a class="btn see-more-btn" href="">Plus d\'infos</a>';
        

        echo '</li>';
    }

    echo '</ul>';
}