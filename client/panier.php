<?php
error_reporting(E_ALL);
require('../connexion.php');
require('functions.php');

    session_start();
    $panier = $_SESSION['panier']; 
?>

<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../img/Black_Favicon.jpg" />
    <link rel="stylesheet" href="../css/panier.css">

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
    <?php $totalPanier = 0; ?>
   <?php foreach ($panier as $p) : ?>
   <?php 
       
        $totalPanier += $p[3]; 
        session_start();
        $_SESSION['totalPanier'] = $totalPanier;
   ?>
    <section>
        <article>
            <img src=".<?= $p[0] ?>">
            <div class="dpqt">
                <h2>Désignation</h2>
                <strong><?= $p[1] ?></strong>
                <p>Vendue et expédiée par Infozone</p>
                <p class="stock">EN STOCK</p>
            </div>
            <div class="dpqt">
                <h2>Prix</h2>
                <strong><?= $p[2] ?>€<sup>99</sup></strong>
            </div>
            <div class="dpqt">
                <h2>Quantité</h2>
                <select>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                    <option>6</option>
                    <option>7</option>
                    <option>8</option>
                    <option>9</option>
                    <!-- Transformer en text pour inséré une quantité +10-->
                    <option>10+</option>
                </select>
            </div>
            <div class="dpqt">
                <h2>Total</h2>
                <strong>€<sup>99</sup></strong>
            </div>
        </article>
         <?php endforeach; ?>
        
        <?php //if(isset($_SESSION['panier'])) : ?>
        <?php //session_start(); ?>
            <p id="cgucgv">En passant commande vous acceptez nos Conditions générales d'utilisation, nos conditions
            générales de vente
            et
            notre politique de protection des données</p>
            <div id="totalttc">
                <p>total ttc</p>
                <strong ><?= $totalPanier ?><sup>99</sup></strong>
                <form method="post" action="compte_panier.php">    
                    <button type="submit">passer commande</button>
                </form>
            </div>
        <?php //else : ?>
          <!-- 
                <h1>Votre panier est vide pour le moment ! </h1>
                <p>Vous n'avez pas encore choisie un produit </p>
          --> 
        <?php// endif; ?>     
    </section>
  