<?php require '../connexion.php'; ?>
<?php require 'functions.php'; ?>
<?php require './phpmailer/mail.php'; ?>

<?php

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
        $_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
        header("Location: compte.php");
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
            envoyerEmail($_POST['email'], 'confirmation de votre compte', "Afin de valider votre compte merci de <a href='\n\nhttp://localhost/infozone/client/confirm.php?id=$id_client&token=$token'>cliquer ici</a>");
            $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte ';
            header("Location:seconnecter.php");
        }
    }
}

?>

<?php require 'header.php'; ?>

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

<!-- connexion+inscription flex -->
<section id="s1">

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
                <button class="c" name="connexion" type="submit">Continuer</button>
            </div>
        </form>
    </section>
    <!--Fin section connexion-->

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
                <button class="c" name="inscription" type="submit">Continuer</button>
            </div>
        </form>
    </section>
    <!--Fin section inscription-->

</section>
<!--Fin section connexion+inscription flex-->

<?php require '../footer.php'; ?>