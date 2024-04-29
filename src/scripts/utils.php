<?php

function switchEvolution($pokemon, $direction) {

    $next_pokemon_id = null;
    
    // If the up arrow is clicked
    if($direction == "up") {

        if(empty($pokemon["pre_evolutions"]) && !empty($pokemon["evolutions"])) {
            $number_of_evolutions = count($pokemon["evolutions"]);
            $next_pokemon_id = $pokemon["evolutions"][$number_of_evolutions - 1]["id_pokemon_evolue"];
        } else if(!empty($pokemon["pre_evolutions"])){
            $next_pokemon_id = $pokemon["pre_evolutions"][0]["id_pokemon_base"];
        }
    
    // If the down arrow is clicked
    } else {
        
        if(empty($pokemon["evolutions"]) && !empty($pokemon["pre_evolutions"])) {
            $number_of_pre_evolutions = count($pokemon["pre_evolutions"]);
            $next_pokemon_id = $pokemon["pre_evolutions"][$number_of_pre_evolutions - 1]["id_pokemon_base"];
        } else if(!empty($pokemon["evolutions"])) {
            $next_pokemon_id = $pokemon["evolutions"][0]["id_pokemon_evolue"];
        }

    }

    return $next_pokemon_id;
    
}