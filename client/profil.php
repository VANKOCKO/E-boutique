<?php
session_start();
require 'functions.php';
logged_only();
?>

<?php require 'header.php'; ?>

<section id="s1">

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

    <h1>Mes commandes</h1>

    <section id="s2">

        <div class="d">
            <a href="compte.php">Mes commandes</a>
        </div>

        <div class="d">
            <a href="profil.php">Mon profil</a>
        </div>

        <?php if (isset($_SESSION['auth'])) : ?>
        <a id="logout" href="logout.php">Déconnexion</a>
        <?php endif;  ?>

    </section>

    <section id="ia">

        <section class="s">

            <div class="ds">

                <h2>Infos</h2>

                <p>Alyssia Drissi</p>
                <p id="mail">alyssia.drissi@gmail.com</p>

                <a id="mdp" href="">Modifier mon mot de passe</a>

            </div>

            <i class="bi bi-pen"></i>

        </section>

        <section class="s">

            <div class="ds">

                <h2>Adresse de facturation</h2>

                <p>Alyssia Drissi</p>
                <p>22 rue de montréal</p>
                <p>54260 Longuyon</p>
                <p>France</p>

            </div>

            <i class="bi bi-pen"></i>

        </section>

    </section>

    <section class="s">

        <div class="ds">

            <h2>Adresse de livraison</h2>

            <p>Alyssia Drissi</p>
            <p>22 rue de montréal</p>
            <p>54260 Longuyon</p>
            <p>France</p>
            <p>0632995409</p>

        </div>

        <i class="bi bi-pen"></i>

    </section>

</section>

<?php require 'footer.php'; ?>