<?php

function displayPokedex($pokedex) {
    echo '<ul class = "pokedex-wrapper">';

    foreach($pokedex as $key => $value) {
        echo '
        
        <li id="card-' .$value["id_pokemon"]. '" class="pokemon-card">
            <span class="pokemon-id">#'. $value["id_pokemon"] .'</span>
            <a class="btn pokemon-btn" href="' .POKEMON_PATH. '?id_pokemon=' .$value["id_pokemon"]. '">
                <img id="img-'.$value["id_pokemon"].'" class="pokemon-img" src="' . $value["image_path"] . '" alt=" '.$value["nom"].'" onload="setMainColorToBackground(' .$value["id_pokemon"]. ')">
                <div class="pokemon-shadow"></div>
            </a>
            <div id="card-background-' .$value["id_pokemon"]. '" class="card-bottom">
                <a class="btn see-more-btn" href="' .POKEMON_PATH. '?id_pokemon=' .$value["id_pokemon"]. '">
                    <div id="vertical" class="line"></div>
                    <div id="horizontal" class="line"></div>
                    <span class="see-more-btn-description">Plus d\'infos</span>
                </a>
                <span class="pokemon-name">'. $value["nom"] .'</span>
            </div>
            
        </li>

        ';
    }

    echo '</ul>';
}