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

    <section id="s3">
        <img src="../img/Black_Favicon.jpg">
        <p>Il s'emblerait que vous n'ayez toujours pas commandé sur Infozone</p>
        <button><a href="../eboutique.php">Acheter un produit</a></button>
    </section>

</section>

<?php require 'footer.php'; ?>