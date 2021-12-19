<?php

function debug($variable)
{
    echo "<pre>";
    print_r($variable);
    echo "</pre>";
}

function str_random($length)
{
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function logged_only()
{
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['auth'])) {
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder a cette page";
        header("Location:seconnecter.php");
        exit();
    }
}