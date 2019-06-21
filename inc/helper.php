<?php

if (!defined("_SRC")) {
    echo "global değişkenleri dahil ediniz..";
    die();
}

function postedToArray()
{
    $items = [];
    foreach ($_POST as $key => $value) {
        $items[$key] = post($key);
    }
    return $items;
}

function get($par)
{
    if (!isset($_GET[$par])) return;
    return $_GET[$par];
}

function post($par)
{
    if (!isset($_POST[$par])) return false;

    if (is_array($_POST[$par])) {
        $array = [];
        foreach ($_POST[$par] as $key => $value) {
            array_push($array, htmlspecialchars(trim($value)));
        }
        return $array;
    }

    $input = $_POST[$par];
    $validated = htmlspecialchars(trim($input));
    return $validated;
}

function dd($error)
{
    var_dump($error);
    die();
}
