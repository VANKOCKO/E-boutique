<?php

// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');

// Préparez l'instruction SQL et récupérez les enregistrements de notre table utilisateur
$sth = $bdd->prepare('SELECT * FROM utilisateur');
$sth->execute();
$users = $sth->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'header.php' ?>

<!-- HEADER -->
<header id="main-header" class="py-3 bg-warning text-white">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">

                <h1><i class="fas fa-users"></i> Utilisateurs</h1>

            </div>

        </div>

    </div>

</header>

<?php if (isset($_SESSION['update_user'])) : ?>

<?php
    echo $_SESSION['update_user'];
    unset($_SESSION['update_user']);
    ?>

<?php endif ?>

<?php if (isset($_SESSION['delete_user'])) : ?>

<?php
    echo $_SESSION['delete_user'];
    unset($_SESSION['delete_user']);
    ?>

<?php endif ?>

<!-- BARRE DE RECHERCHE -->
<section id="search" class="py-3 mb-4">

    <div class="container">

        <div class="row">

            <div class="col-md-6 ms-auto">

                <div class="input-group">

                    <input type="text" class="form-control">

                    <div class="input-group-append">

                        <button class="btn btn-warning"><i class="fas fa-search"></i></button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- UTILISATEURS -->
<section id="users">

    <div class="container">

        <div class="row">

            <div class="col">

                <div class="card">

                    <div class="card-header">

                        <h4>Utilisateurs</h4>

                    </div>

                    <table class="table table-striped">

                        <thead class="table-warning">

                            <tr>

                                <th>#</th>

                                <th>Prénom</th>

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($users as $user) : ?>

                            <tr>

                                <td><?= $user['id_utilisateur'] ?></td>

                                <td><?= $user['prenom'] ?></td>

                                <td>

                                    <a href="details_user.php?id=<?= $user['id_utilisateur'] ?>"
                                        class="btn btn-secondary">
                                        <i class="fas fa-angle-double-right"></i> Details
                                    </a>

                                </td>

                            </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php' ?>