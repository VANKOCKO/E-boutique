<?php
error_reporting(E_ALL);
require('../connexion.php');

// On récupère les données de la barre de recherche
// if (isset($_GET['s']) and !empty(($_GET['s']))) {
//     $recherche = htmlspecialchars($_GET['s']);
//     $allprod = $bdd->prepare('SELECT titre FROM produit WHERE titre LIKE "%' . $recherche . '%" ORDER BY id_produit DESC');
// }

// Récupérer le produit dans la table des produits
$sth = $bdd->prepare("SELECT * FROM produit");
$sth->execute();
$produits = $sth->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../img/Black_Favicon.jpg" />
    <link rel="stylesheet" href="../css/contact.css">

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

        <!-- Début de ma barre de naviguation -->
        <nav>

            <div id="accueil">

                <i class="bi bi-house"></i>

                <a id="a1" href="../index.php">Accueil</a>

            </div>

            <div id="eboutique">

                <i class="bi bi-shop"></i>

                <a id="a2" href="eboutique.php">E-Boutique</a>

            </div>

            <div id="seconnecter">

                <i class="bi bi-person"></i>

                <a id="a3" href="seconnecter.php">Se connecter</a>

            </div>

            <div id="panier">

                <i class="bi bi-bucket"></i>

                <a id="a4" href="panier.php">Panier</a>

            </div>

            <div id="contact">

                <i class="bi bi-envelope"></i>

                <a id="a5" href="contact.php">Contact</a>

            </div>

        </nav><!-- Fin de ma barre de naviguation -->

        <!-- Barre de recherche -->
        <div id="searchbar">

            <input type="text">

            <i id="loupe" class="bi bi-search"></i>

        </div>

        <!-- Menu burger -->
        <button id="burger">

            <span id="bar"></span>

        </button>

    </header>
    <!--Fin de mon en-tête-->

    <!-- Formulaire de contact + google map -->
    <section id="s1">
        <section id="s2">
            <h5>Formulaire de contact</h5>
            <form action="reCAPTCHA.php" method="post" id="demo-form">
                <div class="d">
                    <label>Prénom</label>
                    <input class="i" type="text" name="prenom">
                </div>
                <div class="d">
                    <label>Nom</label>
                    <input class="i" type="text" name="nom">
                </div>
                <div class="d">
                    <label>Email</label>
                    <input class="i" type="text" name="email">
                </div>
                <div class="d">
                    <label>Sujet</label>
                    <input class="i" type="text" name="sujet">
                </div>
                <div class="d">
                    <label>Message</label>
                    <textarea class="i" name="message" rows="3"></textarea>
                </div>
                <div class="d">
                <div class="d">
                <button 
                        id="e"
                        name="envoyer" 
                        type="submit"
                        class="g-recaptcha" 
                        data-sitekey="6LeHnvscAAAAALgv981pnPJHVfsuRIOWvUvWomjX" 
                        data-callback='onSubmit' 
                        data-action='submit'>Envoyer</button>
                </div>
            </form>
        </section>
        <section id="s3">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2594.0253139148613!2d5.597591615081855!3d49.44623856708999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47eac3b3b56703dd%3A0xb37e2301cd812d7b!2s5%20Rue%20Mar%C3%A9chal%20Joffre%2C%2054260%20Longuyon!5e0!3m2!1sfr!2sfr!4v1631014189925!5m2!1sfr!2sfr" width="600" height="450" style="border:#baba;" allowfullscreen="" loading="lazy"></iframe>
        </section>
    </section>

    <!--Début de mon bas de page-->
    <footer>

        <p> INFOZONE | 5 Rue du Maréchal Joffre, 54260 Longuyon | TEL : +33 6 19 30 87 57</p>

        <p> © 2021 INFOZONE - <a href="#">TOUS DROITS RÉSERVÉS</a> - <a href="#">MENTIONS LÉGALES</a></p>

    </footer>
    <!--Fin de mon bas de page-->

    <script>
        function onSubmit(token) {
        document.getElementById("demo-form").submit();
    }
    </script>
    <script src="https://www.google.com/recaptcha/api.js"></script>

</body>
<!--Fin de ma page Web-->

</html>