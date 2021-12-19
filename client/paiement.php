<?php
error_reporting(E_ALL);
require('../connexion.php');
require('functions.php');

session_start();
$id_client=$_SESSION['auth']['id_client'];

        

?>

<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../img/Black_Favicon.jpg" />
    <link rel="stylesheet" href="../css/paiement.css">
    <link rel="stylesheet" href="../css/stripe.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

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

    <!-- retour+inscription flex -->
    <section id="s1">

            <a href="livraison.php"><i id="retour" class="bi bi-chevron-left"></i></a>

            <!-- Inscription -->
            <section class="s">
                <div class="ibancaire">
                    <div id="radio">
                        <input type="radio" checked="checked">
                        <label>Carte bancaire</label>
                    </div>
                    <div id="imgbancaire">
                        <img id="cb" src="../img/cb.jpg" alt="cartebancaire">
                        <img id="mastercard" src="../img/mastercard.png" alt="mastercard">
                        <img id="visa" src="../img/visa.png" alt="visa">
                        <img id="paypal" src="../img/paypal.png" alt="paypal">
                    </div>
                </div>
                <!-- Erreur -->
                <?php if (!empty($erreurs)) :  ?>
                <div id="alert">
                    <p>Vous n'avez pas rempli le formulaire correctement</p>
                    <ul>
                        <?php foreach ($erreurs as $erreur) : ?>
                        <li><?= $erreur ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>

                <!-- <form action="confirmation.php" method="post" id="payment-form">
                    <div class="d">
                        <input class="i StripeElement StripeElement--empty" type="text" name="prenom" placeholder="Prénom du titulaire de la carte">
                    </div>
                    <div class="d">
                        <input class="i" type="text" name="nom" placeholder="Nom du titulaire de la carte">
                    </div>
                    <div class="d">
                        <i class="bi bi-credit-card"></i>
                        <input class="i StripeElement StripeElement--empty" type="text" id="card-element" name="nom" placeholder="Numéro de carte">
                    </div>
                    <div class="d">
                        <div id="card-element">
                         </div>
                    </div>
                    <button>Valider et payer</button>
                </form>
                 -->

                 <div class="container">
                     
                    <form action="confirmation.php" method="post" id="payment-form">
                        <div class="">
                            <div class="form-row">
                                <div class="col-6"><input type="text" name="first_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Prénom"> </div>
                                <div class="col-6"><input type="text" name="last_name" class="form-control mb-3 StripeElement StripeElement--empty" placeholder="Nom"></div>
                            </div>  
                            <div class="form-row">
                                    <div id="card-element" class="form-control">
                                    <!-- a Stripe Element will be inserted here. -->
                                    </div>
                            </div>  
                            <div class="form-row">
                                <div class="form-group">
                                    <!-- Used to display form errors -->
                                    <div id="card-errors " role="alert">
                                    </div> 
                                </div>     
                            </div>  
                            <div class="form-row">
                                <div class="form-group">
                                  <button class="c">Continuer</button>  
                                </div>     
                            </div>  
                        </div>
                    
                
                    </form>
                </div>

            </section>
            <!--Fin section inscription-->

            <section id="totalttcexpfac">

                <!-- Container pour le prix -->
                <div id="totalttc">
                    <p>total ttc</p>
                    <strong><?=  $_SESSION['totalPanier'] ?>€<sup>99</sup></strong>
                    <form method="post" action="livraison.php">    
                        <input hidden name="prix_ttc" value="<?= $_SESSION['prix_ttc']; ?>">
                        <button type="submit">passer commande</button>
                    </form>
                </div> <!-- fin container prix -->

                <section id="s2">
                <div class="expfac">
                    <div>
                        <h2>Expédier à Alyssia Drissi</h2>
                        <p>Alyssia Drissi</p>
                        <p>22 rue de Montréal</p>
                        <p>France</p>
                        <div id="tel">
                            <i class="bi bi-phone"></i>
                            <p>0632995409</p>
                        </div>
                    </div>
                    <i class="bi bi-pen"></i>
                </div>
                <div class="expfac">
                    <div>
                        <h2>Facturer à Alyssia Drissi</h2>
                        <p>22 rue de Montréal</p>
                        <p>54260 Longuyon</p>
                        <p>France</p>
                    </div>
                    <i class="bi bi-pen"></i>
                </div>
                <p class="cgucgv">Satisfait ou remboursé <u>30 jours</u></p>
                <p class="cgucgv">En passant commande vous acceptez nos <u>conditions générales d'utilisation</u>, nos <u>conditions générales de vente</u> et notre <u>politique de protection des données</u></p>
            </section>

        </section>

    </section>
    <!--Fin section retour+inscription flex-->

 
<!-- CDN JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- API Stripe -->
<script src="https://js.stripe.com/v3/"></script>

<!-- Traitement Stripe -->
<script src="../js/charge.js"></script>


</body>
</html>