<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/includes/constants.php');

session_start();

function includeHeader() {
    if (isset($_SESSION["is_connected"]) && $_SESSION["is_connected"] === true) {
        $co_or_deco = '<a class="btn menu-btn" href="'.DISCONNECTION_PATH.'">
                           Déconnexion
                       </a>';
        $user_icon = CONNECTED_USER_ICON_PATH . $_SESSION["id_user"] . '.png';
        $pokedex_link = EDIT_PATH;
    } else{
        $co_or_deco = '<a class="btn menu-btn" href="'.CONNECTION_PATH.'">
                           Connexion
                       </a>';
        $user_icon = USER_ICON_PATH;
        $pokedex_link = CONNECTION_PATH . "?err=2";
    }


    return '
    <header>

        <div class="fictive-element"></div>

        <div class="title-section">
            <h1>
                <a class="btn" href="'.HOME_PATH.'">
                    <img src="' .TITLE_PATH. '" alt="Pokédex">
                </a>
            </h1>
        </div>
        
        <div class="nav-section">
            <button id="nav-btn" class="btn">
                <img src=' .$user_icon. ' alt="Menu utilisateur">
            </button>
            <nav class="" id="nav-menu">
                <ul>
                    <li>
                        <a class="btn menu-btn" href="'.HOME_PATH.'">
                            Accueil
                        </a>
                    </li>
                    <li>
                        <a class="btn menu-btn" href="'.ABOUT_PATH.'">
                            À propos
                        </a>
                    </li>
                    <li>
                        <a class="btn menu-btn" href="' .$pokedex_link. '">
                            Mon Pokédex
                        </a>
                    </li>
                    <li>
                        ' .$co_or_deco. '
                    </li>

                </ul>
            </nav>
        </div>

    </header>
    ';
}