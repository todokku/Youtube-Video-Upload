<?php

require_once "include.php";
require_once 'classes/api.class.php';

$api = new YoutubeApi();
if (isset($_SESSION['access_token'])) {
    $api->auth();
    require_once 'view/upload.view.php';
} else {

    if (isset($_GET['code']) && $code = $_GET['code'])
        $api->redirectAfterLogin($_GET['code']);
    else {
        echo "henüz giriş yapmadığınızdan <br> youtube giriş ekranına yönlendiriliyorsunuz..";
        $api->login();
    }
}
