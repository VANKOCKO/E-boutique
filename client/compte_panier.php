<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

error_reporting(E_ALL);

require('../connexion.php');
require 'functions.php';
require './phpmailer/mail.php';
session_start();
// On récupère et vérifie les informations du client pour qu'il puisse se connecter
if (isset($_POST['connexion'])) {
    $req = $bdd->prepare('SELECT * FROM client WHERE (pseudo = :pseudo OR email = :pseudo) AND confirmation_date IS NOT NULL');
    $req->execute([
        'pseudo' => $_POST['email']
    ]);
    $client = $req->fetch();
    if (password_verify($_POST['mdp'], $client['mdp'])) {
        session_start();
        $_SESSION['auth'] = $client;
        $_SESSION['prix_ttc'] = $_POST['prix_ttc'];
        $_SESSION['titreref'] = $_POST['titreref'];
        header("Location: livraison.php");
        exit();
    } else {
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
    }
}

// On récupère et vérifie les informations du client pour qu'il puisse s'inscrire
if (isset($_POST['inscription'])) {
    if (!empty($_POST)) {
        $erreurs = array();
        if (empty($_POST['pseudo'])) {
            $erreurs['pseudo'] = "Votre pseudo n'est pas valide";
        } else {
            $req = $bdd->prepare('SELECT id_client FROM client WHERE pseudo = ?');
            $req->execute([$_POST['pseudo']]);
            $client = $req->fetch();
            if ($client) {
                $erreurs['pseudo'] = 'Ce pseudo est deja pris';
            }
        }
        if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $erreurs['email'] = "Votre email n'est pas valide";
        } else {
            $req = $bdd->prepare('SELECT id_client FROM client WHERE email = ?');
            $req->execute([$_POST['email']]);
            $client = $req->fetch();
            if ($client) {
                $erreurs['email'] = 'Cet email est déjà utilisé pour un autre compte';
            }
        }
        if (empty($_POST['mdp']) || $_POST['mdp'] != $_POST['mdp_confirm']) {
            $erreurs['mdp'] = "Vous devez rentrer un mot de passe valide";
        }
        if (empty($erreurs)) {

            $req = $bdd->prepare("INSERT INTO client SET pseudo = ?, mdp = ? , email = ? , confirmation_token = ?");
            $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);
            $token = str_random(60);
            $req->execute([$_POST['pseudo'], $mdp, $_POST['email'], $token]);
            $id_client = $bdd->lastInsertId();
            envoyerEmail($_POST['email'], 'confirmation de votre compte', "Afin de valider votre compte merci de <a href='\n\nhttp://localhost/infozone/client/confirm_panier.php?id=$id_client&token=$token'>cliquer ici</a>");
            $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte ';
            header("Location:compte_panier.php");
        }
    }
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
    <link rel="stylesheet" href="../css/compte_panier.css">

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

    <a href="panier.php"><i id="retour" class="bi bi-chevron-left"></i></a>

    <?php if (isset($_SESSION['auth'])) : ?>

    <!-- Connexion -->
    <section class="s">
        <h5>Déjà inscrit ?</h5>
        <h6>Entrez votre mot de passe pour retrouver vos informations</h6>

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

        <form method="post">
            <div class="d">
                <label>Pseudo ou email</label>
                <input class="i" type="text" name="email">
            </div>
            <div class="d">
                <label>Mot de passe</label>
                <div class="eye">
                    <input class="i" type="password" name="mdp"><i class="bi bi-eye-slash"></i>
                </div>
            </div>
            <div class="d">
                <small id="mdp"><a href="#">Mot de passe oublié ?</a></small>
                <input hidden name="prix_ttc" value="<?= $prix_ttc ?>">
                <input hidden name="titreref" value="<?= $titreref ?>">
                <button class="c" name="connexion" type="submit">Continuer</button>
            </div>
        </form>
    </section>
    <!--Fin section connexion-->

    <?php else : ?>

    <!-- Inscription -->
    <section class="s">
        <h5>Nouveau chez Infozone ?</h5>
        <h6>Créer votre compte pour suivre et gérer votre commande</h6>

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

        <form method="post">
            <div class="d">
                <label>Pseudo</label>
                <input class="i" type="text" name="pseudo">
            </div>
            <div class="d">
                <label>Email</label>
                <input class="i" type="email" name="email">
            </div>
            <div class="d">
                <label>Mot de passe</label>
                <div class="eye">
                    <input class="i" type="password" name="mdp"><i class="bi bi-eye-slash"></i>
                </div>
                <small>Au moins 8 caractères, dont 1 majuscule, 1 minuscule et 1 chiffre.</small>
            </div>
            <div class="d">
                <label>Confirmer votre mot de passe</label>
                <div class="eye">
                    <input class="i" type="password" name="mdp_confirm"><i class="bi bi-eye-slash"></i>
                </div>
            </div>
            <div id="check">
                <input type="checkbox">Oui, je souhaite recevoir les actualités et les meilleurs deals de
                Infozone par
                email.
            </div>
            <div class="d">
                <p id="cgu">En créant votre compte vous acceptez les conditions générales d'utilisation, les conditions
                    générales de vente et la politique de confidentialité de Infozone et confirmez avoir plus de 16 ans.
                </p>
                <button class="c" name="inscription">Continuer</button>
            </div>
        </form>
    </section>
    <!--Fin section inscription-->

    <?php endif;  ?>

    <section id="font">
        <!-- Container pour le prix -->
        <div id="totalttc">
            <p>total ttc</p>
            <strong><?=  $_SESSION['totalPanier']  ?>€<sup>99</sup></strong>
            <form method="post" action="livraison.php">    
                <input hidden name="prix_ttc" value="<?= $_POST['prix_ttc']; ?>">
                <input hidden name="titreref" value="<?= $_POST['titreref'] ?>">
                <button type="submit">passer commande</button>
            </form>
        </div> <!-- fin container prix -->
    </section>

</section>
<!--Fin section retour+inscription flex-->