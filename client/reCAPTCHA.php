<?php

// On vérifie que tous les champs sont remplis
if(!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['sujet']) && !empty($_POST['message'])){

    $secret = "6LeHnvscAAAAAD2Be-Y1rDE_T5MjhcP4hHzmrArb";
    $response = htmlspecialchars($_POST['g-recaptcha-response']);
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";

    $get = file_get_contents($request);
    $decode = json_decode($get, true);

    if($decode['success'])
        echo "Ok";
    else 
        echo "Error";

}