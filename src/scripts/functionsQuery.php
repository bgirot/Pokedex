<?php

function getPokedex($mysqli) {
    $sql_input = "SELECT id_pokemon, nom, numero FROM pokemon";

    $result = readDB($mysqli, $sql_input);

    $imagePath = "/ressources/images/pokemons/pokemon_sugimori/";

    foreach($result as $key => $value) {
        $result[$key] = array_merge($result[$key], array("image_path" => $imagePath . $key + 1 . ".png"));
    }


    return $result;
}