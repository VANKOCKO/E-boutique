<?php
error_reporting(E_ALL);
require('functions.php');
require('../connexion.php');

logged_only();
$id_client=$_SESSION['auth']['id_client'];

if (isset($_POST['livraison'])) {

    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $societe = $_POST['societe'];
    $adresse = $_POST['adresse'];
    $complement_adresse = $_POST['complement_adresse'];
    $ville = $_POST['ville'];
    $cp = $_POST['cp'];
    $pays = $_POST['pays'];
    $tel = $_POST['tel'];


    $sth = $bdd->prepare("INSERT INTO adresse_livraison(prenom,nom,societe,adresse,complement_adresse,ville,cp,pays,tel,id_client) 
                          VALUES (:prenom,:nom,:societe,:adresse,:complement_adresse,:ville,:cp,:pays,:tel,:id_client)");

    $sth->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $sth->bindParam(':nom', $nom, PDO::PARAM_STR);
    $sth->bindParam(':societe', $societe, PDO::PARAM_STR);
    $sth->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $sth->bindParam(':complement_adresse', $complement_adresse, PDO::PARAM_STR);
    $sth->bindParam(':ville', $ville, PDO::PARAM_STR);
    $sth->bindParam(':cp', $cp, PDO::PARAM_STR);
    $sth->bindParam(':pays', $pays, PDO::PARAM_STR);
    $sth->bindParam(':tel', $tel, PDO::PARAM_STR);
    $sth->bindParam(':id_client', $id_client, PDO::PARAM_INT);

    $sth->execute();

    // On renvoi vers la page de paiement
    header('Location: paiement.php');

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
    <link rel="stylesheet" href="../css/livraison.css">

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

    <?php if (isset($_SESSION['flash'])) : ?>
    <?php foreach ($_SESSION['flash'] as $type => $message) : ?>

    <?php if ($type == "success") : ?>
    <p id="couleur-success">
        <?= $message ?>
    </p>
    <?php else : ?>
    <p id="couleur-danger">
        <?= $message ?>
    </p>
    <?php endif ?>
    <?php endforeach; ?>
    <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- retour+inscription flex -->
    <section id="s1">

        <a href="compte_panier.php"><i id="retour" class="bi bi-chevron-left"></i></a>

        <!-- <section id="cinfo">
            <h5>Confirmer votre adresse de livraison</h5>
            <h6>Voici la dernière adresse enregistrée par Infozone</h6>
            <div id="info">
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
                <p id="edit">Modifier cette adresse</p>
            </div>
            <div id="check">
                <input type="checkbox">Même adresse de facturation
            </div>
            <div class="d">
                <a href="paiement.php"><button id="c" class="c" name="inscription" type="submit">Continuer</button></a>
            </div>
        </section>

        container en column du total ttc + expédier et facturer à 
        <section id="totalttcexpfac">

             Container pour le prix -->
            <!--
            <div id="totalttc">
                <p>total ttc</p>
                <strong>1013€<sup>99</sup></strong>
                <a href="paiement.php"><button type="submit">passer commande</button></a>
            </div> fin container prix -->
            

            <!-- Information de livraison pour les clients qui ont renseigné au des informations de livraisons
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
            </section> Fin section information de livraison client 

        </section> 
        -->

        <!-- Formulaire de livraison pour les clients qui n'ont pas renseigné d'information de livraison -->
        <section class="s">
            <h5>À quel adresse souhaitez-vous recevoir cette commande ?</h5>
            <form method="post">
                <div class="d">
                    <label>Prénom</label>
                    <input class="i" type="text" name="prenom">
                </div>
                <div class="d">
                    <label>Nom</label>
                    <input class="i" type="text" name="nom">
                </div>
                <div class="d">
                    <label>Société - optionnel</label>
                    <input class="i" type="text" name="societe">
                </div>
                <div class="d">
                    <label>Numéro et nom de la voie</label>
                    <input class="i" type="text" name="adresse">
                </div>
                <div class="d">
                    <label>Complément d'adresse - Facultatif</label>
                    <input class="i" type="text" name="complement_adresse">
                </div>
                <div class="d">
                    <label>Ville</label>
                    <input class="i" type="text" name="ville">
                </div>
                <div class="d">
                    <label>Code Postal</label>
                    <input class="i" type="text" name="cp">
                </div>
                <div class="d">
                    <label>Pays</label>
                    <select name="pays">
                        <option value="France">France</option>
                    </select>
                </div>
                <div class="d">
                    <label>Numéro de téléphone</label>
                    <div id="tel">
                        <select id="indicatif">
                            <option>+33</option>
                        </select>
                        <input class="i" type="text" name="tel">
                    </div>
                </div>
                <div id="check">
                    <input type="checkbox">Même adresse de facturation
                </div>
                <div class="d">
                    <button id="c" class="c" name="livraison" type="submit">Continuer</button>
                </div>
            </form>
        </section>
        <!--Fin section livraison -->

        <section id="font">
            <!-- Container pour le prix -->
            <div id="totalttc">
                <p>total ttc</p>
                <strong><?=  $_SESSION['totalPanier'] ?>€<sup>99</sup></strong>
                <form method="post" action="livraison.php">    
                    <button type="submit">passer commande</button>
                </form>
            </div> <!-- fin container prix -->
        </section>

    </section>
    <!--Fin section retour+inscription flex-->