<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/includes/constants.php');

function includeHead($stylesheetPath) {

    echo '
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="'.META_DESCRIPTION.'">
        <meta name="keywords" content="'.META_KEYWORDS.'">
        <meta name="author" content="'.META_AUTHOR.'">


        <link rel="stylesheet" href="'.NORMALIZE_PATH.'">
        <link rel="stylesheet" href="'.DEFAULT_STYLE_PATH.'">
        <link rel="stylesheet" href="'.$stylesheetPath.'">

        <script src="'.FRONT_PATH.'"></script>

        <link rel="icon" type="image/x-icon" href="'.LOGO_FILE_PATH.'">
        <title>'.WEBSITE_TITLE.'</title>
    </head>
    ';
}
