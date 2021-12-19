<?php
error_reporting(E_ALL);
require '../connexion.php';

?>

<?php include 'header.php' ?>

<!-- HEADER -->
<header id="main-header">

    <div class="container-fluid py-4">

        <div class="row">

            <div class="col-md-6">

                <h1><i class="fas fa-cog"></i>TABLEAU DE BORD</h1>

            </div>

        </div>

    </div>

</header>

<?php if (isset($_SESSION['erreur'])) : ?>

    <?php
    echo $_SESSION['erreur'];
    unset($_SESSION['erreur']);
    ?>

<?php endif ?>

<!-- ACTIONS -->
<section id="actions" class="py-2 mb-4">

    <div class="container">

        <div class="row">

            <div class="col-md-3 py-2">

                <button class="btn btn-info btn-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    <i class="fas fa-plus"></i> Ajouter produit
                </button>

            </div>

            <div class="col-md-3 py-2">

                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                    <i class="fas fa-plus"></i> Ajouter catégorie
                </button>

            </div>

            <div class="col-md-3 py-2">

                <button class="btn btn-warning btn-block" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-plus"></i> Ajouter utilisateur
                </button>

            </div>

        </div>

    </div>

</section>

<!-- DERNIERS PRODUITS -->
<section id="produits">

    <div class="container">

        <div class="row">

            <div class="col-md-9">

                <div class="card">

                    <div class="card-header">

                        <h4>Derniers postes</h4>

                    </div>

                    <table class="table table-striped">

                        <thead class="table-dark">

                            <tr>

                                <th>#</th>

                                <th>Titre</th>

                                <th></th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php

                            // On prépare la requête et on l'exécute
                            $sth = $bdd->prepare("SELECT * 
                                                  FROM produit 
                                                  WHERE id_produit > 5
                                                  ORDER BY id_produit DESC
                                                ");
                            $sth->execute();

                            // On créé une boucle pour afficher les données tant qu'il y en a
                            while ($resultat = $sth->fetch(PDO::FETCH_ASSOC)) {

                                $id_produit = $resultat['id_produit'];
                                $titre = $resultat['titre'];

                            ?>

                                <tr>

                                    <td><?php echo $resultat['id_produit']; ?></td>

                                    <td><?php echo $resultat['titre']; ?></td>

                                    <td>

                                        <a href="details_prod.php?id=<?php echo $id_produit ?>" class="btn btn-secondary">
                                            <i class="fas fa-angle-double-right"></i> Details
                                        </a>

                                    </td>

                                </tr>

                            <?php

                            } //fin while

                            ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card text-center bg-info mb-3">

                    <div class="card-body">

                        <h3 class="text-white">Produits</h3>

                        <h4 class="display-4 text-white">
                            <i class="fas fa-pencil-alt text-white"></i> 6
                        </h4>

                        <a href="produit.php" class="btn btn-outline-light btn-sm">Voir</a>

                    </div>

                </div>

                <div class="card text-center bg-success text-white mb-3">

                    <div class="card-body">

                        <h3 class="text-white">Categories</h3>

                        <h4 class="display-4 text-white">
                            <i class="fas fa-folder text-white"></i> 4
                        </h4>

                        <a href="categorie.php" class="btn btn-outline-light btn-sm">Voir</a>

                    </div>

                </div>

                <div class="card text-center bg-warning text-white mb-3">

                    <div class="card-body">

                        <h3 class="text-white">Utilisateurs</h3>

                        <h4 class="display-4 text-white">
                            <i class="fas fa-users text-white"></i> 4
                        </h4>

                        <a href="utilisateur.php" class="btn btn-outline-light btn-sm">Voir</a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- MODALS -->

<?php include 'create_prod.php' ?>

<?php include 'create_cat.php' ?>

<?php include 'create_user.php' ?>

<!-- BAS DE PAGE -->

<?php include 'footer.php' ?>