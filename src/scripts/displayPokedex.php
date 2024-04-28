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
        ';

        if(isset($_SESSION["is_connected"])) {
            if ($_SESSION["is_connected"]){
                echo '
                
                <div class="dresseur-stats-container">
                    <div class="dresseur-stat seen">
                        <img src="' .SEEN_ICON_PATH. '" alt="Icone vue"></img>
                        <span class="stat">
                            ' .$value["stats"]["0"]["nbVue"]. '
                            <div class="stat-description">Pokémon vu ' .$value["stats"]["0"]["nbVue"]. ' fois</div>
                        </span>
                    </div>

                    <div class="dresseur-stat caught">
                        <img src="' .CAUGHT_ICON_PATH. '" alt="Icone vue"></img>
                        <span class="stat">
                            '.$value["stats"]["0"]["nbAttrape"].'
                            <div class="stat-description">Pokémon attrapé ' .$value["stats"]["0"]["nbAttrape"]. ' fois</div>
                        </span>
                    </div>
                </div>

                ';
            }
        }

        echo'
            </div>
            
        </li>

        ';
    }

    echo '</ul>';
}