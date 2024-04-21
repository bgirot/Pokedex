<?php
require_once("./src/includes/constants.php");

function includeHeader() {
    return '
        <header>
            
            <div class="fictive-element"></div>

            <div class="title-section">
                <h1>
                    <a class="btn" href="">
                        <img src="'.TITLE_PATH.'" alt="Pokédex">
                    </a>
                </h1>
            </div>
            
            <div class="nav-section">
                <button id="nav-btn" class="btn">
                    <img src="'.USER_ICON_PATH.'" alt="Menu utilisateur">
                </button>
                <nav class="" id="nav-menu">
                    <ul>
                        <li class="btn">Connexion</li>
                        <li class="btn">Mon Pokédex</li>
                        <li class="btn">À propos</li>
                    </ul>
                </nav>
            </div>

        </header>
    ';
}