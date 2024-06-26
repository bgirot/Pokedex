<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/includes/constants.php');

require_once(DOCUMENT_ROOT . '/src/static/header.php');
require_once(DOCUMENT_ROOT . '/src/static/footer.php');

function openBody() {
    echo '
    <body>
        <div class="page-container">

            <img class="line" id="top" src="/ressources/images/top.png" alt="top">
            <img class="line" id="bottom" src="/ressources/images/top.png" alt="bottom">
        
        
            <svg id="yellow-blob" class="blob" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#FFDA27" d="M37.6,-58C49.5,-58.2,60.7,-49.8,66.3,-38.7C71.9,-27.6,71.9,-13.8,73.5,0.9C75.2,15.7,78.3,31.4,71.9,41C65.5,50.7,49.4,54.2,35.8,58.6C22.3,63,11.1,68.3,1.9,65C-7.4,61.8,-14.8,50.1,-27.1,45C-39.3,39.8,-56.5,41.1,-67.5,34.7C-78.6,28.3,-83.6,14.2,-80,2.1C-76.3,-10,-64.1,-20,-53.8,-27.7C-43.5,-35.5,-35.2,-40.9,-26.5,-42.7C-17.9,-44.4,-8.9,-42.4,1.9,-45.8C12.8,-49.1,25.6,-57.8,37.6,-58Z" transform="translate(100 100)" />
            </svg>
            <svg id="red-blob" class="blob" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <path fill="#F8391C" d="M63.2,-18.8C71.6,5.5,61.2,37.7,41.6,50.4C21.9,63.1,-7,56.2,-25.8,41.2C-44.5,26.2,-53.2,3,-47.3,-17.9C-41.3,-38.8,-20.6,-57.5,3.4,-58.6C27.4,-59.7,54.7,-43.2,63.2,-18.8Z" transform="translate(100 100)" />
            </svg>

            '.includeHeader().'
        
            <main>
    ';
}

function closeBody(){
    echo '
            </main>
        
            '.includeFooter().'

        </div>
    </body>
    ';
}