<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/includes/constants.php');

function includeHeader() {
    return '
    <header>

        <div class="fictive-element"></div>

        <div class="title-section">
            <h1>
                <a class="btn" href="'.HOME_PATH.'">
                    <img src="/ressources/images/title.png" alt="Pokédex">
                </a>
            </h1>
        </div>
        
        <div class="nav-section">
            <button id="nav-btn" class="btn">
                <img src="/ressources/icons/user-icon-hollow-black.png" alt="Menu utilisateur">
            </button>
            <nav class="" id="nav-menu">
                <ul>
                    <li>
                        <a class="btn menu-btn" href="'.HOME_PATH.'">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a class="btn menu-btn" href="'.WIP_PATH.'">
                            Connexion
                        </a>
                    </li>
                    <li>
                        <a class="btn menu-btn" href="'.WIP_PATH.'">
                            Mon Pokédex
                        </a>
                    </li>
                    <li>
                        <a class="btn menu-btn" href="'.ABOUT_PATH.'">
                            À propos
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

    </header>
    ';
}