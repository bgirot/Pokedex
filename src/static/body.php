<?php
require_once("./src/includes/constants.php");
require_once("./src/static/header.php");
require_once("./src/static/footer.php");

function includeBody() {
    echo '
    <body>
        <div class="page-container">

            '.includeHeader().'
        
            <main>
                
            </main>
        
            '.includeFooter().'

        </div>
    </body>
    ';
}