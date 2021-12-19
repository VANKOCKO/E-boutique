<?php
// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');

// Récupérer la categorie dans le tableau des categories
$sth = $bdd->prepare("SELECT * FROM categorie");
$sth->execute();
$categories = $sth->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include 'header.php' ?>

<!-- HEADER -->
<header id="main-header" class="py-3 bg-success text-white">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-6">

                <h1><i class="fas fa-folder"></i> Catégories</h1>

            </div>

        </div>

    </div>

</header>

<?php if (isset($_SESSION['update_cat'])) : ?>

    <?php
    echo $_SESSION['update_cat'];
    unset($_SESSION['update_cat']);
    ?>

<?php endif ?>

<?php if (isset($_SESSION['delete_cat'])) : ?>

    <?php
    echo $_SESSION['delete_cat'];
    unset($_SESSION['delete_cat']);
    ?>

<?php endif ?>

<?php if (isset($_SESSION['create_cat'])) : ?>

    <?php
    echo $_SESSION['create_cat'];
    unset($_SESSION['create_cat']);
    ?>

<?php endif ?>

<!-- BARRE DE RECHERCHE -->
<section id="search" class="py-4 mb-4">

    <div class="container">

        <div class="row">

            <div class="col-md-6 ms-auto">

                <div class="input-group">

                    <input type="text" class="form-control">

                    <div class="input-group-append">

                        <button class="btn btn-success"><i class="fas fa-search"></i></button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- CATEGORIES -->
<section id="category">

    <div class="container">

        <div class="row">

            <div class="col-md-12">

                <div class="card">

                    <div class="card-header">

                        <h4>Catégories</h4>

                    </div>

                    <table class="table table-striped">

                        <thead class="table-success">

                            <tr>

                                <th>#</th>

                                <th>Catégorie</th>

                                <th> </th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach ($categories as $categorie) : ?>

                                <tr>

                                    <td><?= $categorie['id_categorie']; ?></td>

                                    <td><?= $categorie['lib_cat']; ?></td>

                                    <td>

                                        <a href="details_cat.php?id=<?= $categorie['id_categorie'] ?>" class="btn btn-secondary">
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