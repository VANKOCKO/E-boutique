<?php
require '../connexion.php';
require 'functions.php';
$id_client = $_GET['id'];
$token = $_GET['token'];

$req = $bdd->prepare('SELECT * FROM client WHERE id_client = ?');
$req->execute([$id_client]);
$client = $req->fetch();

if ($client && $client['confirmation_token'] == $token) {
    session_start();
    $bdd->prepare("UPDATE client SET confirmation_token = NULL,confirmation_date= NOW() WHERE id_client= ?")->execute([$id_client]);
    $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
    $_SESSION['auth'] = $client;
    header("Location:livraison.php");
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    header("Location:compte_panier.php");
}