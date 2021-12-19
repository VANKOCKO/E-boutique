<?php
// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
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

<?php include 'header.php' ?>

<!-- HEADER -->
<header id="main-header" class="py-3 bg-info">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">

                <h1><i class="fas fa-pencil-alt"></i> Produits</h1>

            </div>

        </div>

    </div>

</header>

<?php if (isset($_SESSION['update_prod'])) : ?>

    <?php
    echo $_SESSION['update_prod'];
    unset($_SESSION['update_prod']);
    ?>

<?php endif ?>

<?php if (isset($_SESSION['create_prod'])) : ?>

    <?php
    echo $_SESSION['create_prod'];
    unset($_SESSION['create_prod']);
    ?>

<?php endif ?>

<?php if (isset($_SESSION['delete_prod'])) : ?>

    <?php
    echo $_SESSION['delete_prod'];
    unset($_SESSION['delete_prod']);
    ?>

<?php endif ?>

<!-- BARRE DE RECHERCHE -->
<section id="search" class="py-4 mb-4">

    <div class="container">

        <div class="row">

            <div class="col-md-6 ms-auto">

                <form method="GET" action="">

                    <div class="input-group">

                        <input type="search" name="s" class="form-control">

                        <div class="input-group-append">

                            <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

<!-- PRODUITS -->
<section id="produits">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h4>Produits</h4>

                    </div>

                    <table class="table table-striped">

                        <thead class="table-info">

                            <tr>

                                <th>#</th>

                                <th>Titre</th>

                                <th> </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            // if ($allprod->rowCount() > 0) {
                            //     while ($prod = $allprod->fetch()) {
                            //         echo "<tr>
                            //                     <td>" . $prod['titre'] . "</td>
                            //                 </tr>";
                            //     }
                            // }

                            ?>

                            <?php foreach ($produits as $produit) : ?>

                                <tr>

                                    <td><?= $produit['id_produit']; ?></td>

                                    <td><?= $produit['titre']; ?></td>

                                    <td>

                                        <a href="details_prod.php?id=<?= $produit['id_produit'] ?>" class="btn btn-secondary">
                                            <i class="fas fa-angle-double-right"></i> Details
                                        </a>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                    <!-- PAGINATION -->
                    <nav class="ml-4">

                        <ul class="pagination">

                            <li class="page-item disabled">

                                <a href="#" class="page-link">Précédent</a>

                            </li>

                            <li class="page-item active">

                                <a href="#" class="page-link  bg-info">1</a>

                            </li>

                            <li class="page-item">

                                <a href="#" class="page-link">2</a>

                            </li>

                            <li class="page-item">

                                <a href="#" class="page-link">3</a>

                            </li>

                            <li class="page-item">

                                <a href="#" class="page-link">Suivant</a>

                            </li>

                        </ul>

                    </nav>

                </div>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php' ?>