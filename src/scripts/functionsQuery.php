<?php

function getPokedex($mysqli) {
    $sql_input = "SELECT id_pokemon, nom, numero FROM pokemon";

    $result = readDB($mysqli, $sql_input);

    foreach($result as $key => $value) {
        $result[$key] = array_merge($result[$key], array("image_path" => POKEMON_SUGIMORI_PATH . $key + 1 . ".png"));
    }


    return $result;
}


function getPokedexDresseur($mysqli, $id_dresseur) {
    $sql_input = "SELECT id_pokemon, nom, numero FROM pokemon";

    $result = readDB($mysqli, $sql_input);

    foreach($result as $key => $value) {
        $id_pokemon = $value["id_pokemon"];

        $new_sql_input = "SELECT nbVue, nbAttrape
                          FROM pokedex
                          WHERE id_dresseur = $id_dresseur
                          AND id_pokemon = $id_pokemon";
        $new_info = readDB($mysqli, $new_sql_input);
        
        if(empty($new_info)) {
            $new_info = array(0 => array("nbVue" => 0, "nbAttrape" => 0));
        }

        $result[$key] = array_merge($result[$key], array("image_path" => POKEMON_SUGIMORI_PATH . $key + 1 . ".png"));
        $result[$key] = array_merge($result[$key], array("stats" => $new_info));
    }

    return $result;
}


function getStats($mysqli, $id_pokemon, $id_dresseur) {
    $sql_input = "SELECT nbVue, nbAttrape
                  FROM pokedex
                  WHERE id_dresseur = $id_dresseur
                  AND id_pokemon = $id_pokemon";
    
    $result = readDB($mysqli, $sql_input);

    if(empty($result)) {
        $result = array(0 => array("nbVue" => 0, "nbAttrape" => 0));
    }

    return $result;
}


function getAllTypes($mysqli) {
    $sql_input = "SELECT * FROM type";

    $raw_result = readDB($mysqli, $sql_input);

    $result = array();

    foreach ($raw_result as $key => $value) {
        $result[$value["id_type"]] = $value["libelle"];
    }

    return $result;
}


function getPokemon($mysqli, $id_pokemon) {

    // __________SQL inputs__________
    $info_sql_input = "SELECT *
                       FROM pokemon 
                       WHERE id_pokemon = $id_pokemon";

    $types_sql_input = "SELECT e.id_type, t.libelle
                        FROM esttype e INNER JOIN type t
                        WHERE id_pokemon = $id_pokemon
                        AND e.id_type = t.id_type";

    $moves_sql_input = "SELECT l.id_capacite, c.libelle_capacite, c.pp_capacite, c.puissance_capacite, c.precision_capacite, c.id_type
                        FROM lance l INNER JOIN capacite c 
                        WHERE id_pokemon = $id_pokemon
                        AND l.id_capacite = c.id_capacite";

    $evolutions_sql_input = "SELECT e.id_pokemon_evolue, p.nom, e.niveau
                             FROM evolue e INNER JOIN pokemon p
                             WHERE id_pokemon_base = $id_pokemon
                             AND e.id_pokemon_evolue=p.id_pokemon";

    $pre_evolutions_sql_input = "SELECT e.id_pokemon_base, p.nom, e.niveau
                                 FROM evolue e INNER JOIN pokemon p
                                 WHERE id_pokemon_evolue = $id_pokemon
                                 AND e.id_pokemon_base=p.id_pokemon";


    // __________DB Requests__________
    $infos = readDB($mysqli, $info_sql_input);
    $types = readDB($mysqli, $types_sql_input);
    $moves = readDB($mysqli, $moves_sql_input);
    $evolutions = readDB($mysqli, $evolutions_sql_input);
    $pre_evolutions = readDB($mysqli, $pre_evolutions_sql_input);


    // If the pokemon has more than one evolution or pre-evolution
    if (!$evolutions == null) {
        $id_next_evolution = $evolutions[0]["id_pokemon_evolue"];
        
        while (true) {
            $sql_input = "SELECT e.id_pokemon_evolue, p.nom, e.niveau
                          FROM evolue e INNER JOIN pokemon p
                          WHERE id_pokemon_base = $id_next_evolution
                          AND e.id_pokemon_evolue=p.id_pokemon";

            $result = readDB($mysqli, $sql_input);

            if ($result == null) {
                break;
            }

            $evolutions = array_merge($evolutions, $result);
            $id_next_evolution = $result[0]["id_pokemon_evolue"];
        }
    }

    if (!$pre_evolutions == null) {
        $id_next_evolution = $pre_evolutions[0]["id_pokemon_base"];
        
        while (true) {
            $sql_input = "SELECT e.id_pokemon_base, p.nom, e.niveau
                          FROM evolue e INNER JOIN pokemon p
                          WHERE id_pokemon_evolue = $id_next_evolution
                          AND e.id_pokemon_base=p.id_pokemon";

            $result = readDB($mysqli, $sql_input);

            if ($result == null) {
                break;
            }

            $pre_evolutions = array_merge($pre_evolutions, $result);
            $id_next_evolution = $result[0]["id_pokemon_base"];
        }
    }

    // __________Result__________
    $pokemon = array("infos" => $infos, "types" => $types, "moves" => $moves, "evolutions" => $evolutions, "pre_evolutions" => $pre_evolutions);

    return $pokemon;
}


function loginResult($mysqli, $username, $password) {
    $sql_input = "SELECT *
                  FROM dresseur
                  WHERE nom_dresseur = '$username'
                  AND mdp_dresseur = '$password'";

    $result = readDB($mysqli, $sql_input);

    return $result;
}


function updateStats($mysqli, $seen, $caught, $id_pokemon, $id_dresseur, $pokedex_dresseur) {

    // If the pokemon is deleted from the pokedex
    if ($seen == 0 && $caught == 0) {
        $sql_input = "DELETE FROM pokedex
                      WHERE id_pokemon = $id_pokemon
                      AND id_dresseur = $id_dresseur";
        writeDB($mysqli, $sql_input);

    } else {

        $current_seen_stat = $pokedex_dresseur[$id_pokemon - 1]["stats"][0]["nbVue"];
        $current_caught_stat = $pokedex_dresseur[$id_pokemon - 1]["stats"][0]["nbAttrape"];

        if ($current_seen_stat != 0 && $current_caught_stat != 0) {

            $sql_input = "UPDATE pokedex
                        SET nbVue = $seen, nbAttrape = $caught
                        WHERE id_pokemon = $id_pokemon
                        AND id_dresseur = $id_dresseur";
            writeDB($mysqli, $sql_input);

        // If the pokemon is not in the pokedex 
        } else {
            $sql_input = "INSERT INTO pokedex (id_dresseur, id_pokemon, nbVue, nbAttrape)
                        VALUES ($id_dresseur, $id_pokemon, $seen, $caught)";
            writeDB($mysqli, $sql_input);

        }
        
    }

}