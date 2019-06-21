<?php

require_once 'include.php';
require_once 'vendor/autoload.php';
require_once 'classes/api.class.php';


if ($_SESSION['access_token']) {
    $api = new YoutubeApi();
    $api->auth();
    $api->logout();
} else {
    
}

header('Location: /index.php');