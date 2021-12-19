<?php
session_start();
error_reporting(E_ALL);
require('../connexion.php');
require_once('functions.php');
require './vendor/autoload.php';
$stripe =   \Stripe\Stripe::setApiKey('sk_test_51IhTs7IPkcUvLWXYWKCX8blJRpOxlpB5d6pW6EKlDLfHgk6vDwe7mtTDP7SxJRmCZMwwOiR0c7z8vPaxSyo9SWOR00q3aCPkml');

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

$first_name = $POST['first_name'];
$last_name = $POST['last_name'];
$token = $POST['stripeToken']; 
$email=$_SESSION['auth']['email'];

// Create Customer In Stripe
$customer = \Stripe\Customer::create(array(
"email" => $email,
"source" => $token
));

// Charge Customer
foreach ($_SESSION['panier'] as $key => $value) {
   $charge = \Stripe\Charge::create(array(
    "amount" => number_format($value[3],2, ',', ' ') * 10,
    "currency" => "eur",
    "description" => $value[1],
    "customer" => $customer->id
  )); 
   
}


?>

<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../img/Black_Favicon.jpg" />
    <link rel="stylesheet" href="../css/confirmation.css">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Titre de mon URL -->
    <title>Infozone</title>

</head>

<!-- Début de ma page Web -->

<body style="height: 100vh;">

    <!-- Début de mon en-tête -->
    <header>

        <!-- Logo principal -->
        <a href="../index.php"><img id="logo" src="../img/Black_Logo.jpg" alt="logo"></a>

        <!-- Début de ma barre de chargement -->
        <nav>

            <div>
                <p>Panier</p>
                <p>Compte</p>
                <p>Livraison</p>
                <p>Paiement</p>
                <p>Confirmation</p>
            </div>

            <progress value="100" max="100"></progress>

        </nav>
        <!--Fin de ma barre de chargement-->

    </header>
    <!--Fin de mon en-tête-->

    <main>

        <section>
            <img src="../img/Black_Favicon.jpg">
            <p>Votre commande a été prise en compte</p>
            <h1>Infozone vous remercie pour votre commande !</h1>
            <div>
                <a href="eboutique.php"><button>Retour e=boutique</button></a>
                <a href="#"><button>Détails commande</button></a>
            </div>
        </section>

    </main>

<?php require 'footer.php'; ?>