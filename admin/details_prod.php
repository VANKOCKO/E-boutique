<?php

// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require '../connexion.php';

// Déclarer la variable qui affiche le nom de la catégorie qui est dans un tableau 
$nom_categorie = "";

// Récupérez la catégorie dans le tableau des catégories
$sth2 = $bdd->prepare("SELECT * FROM categorie");
$sth2->execute();
$categories = $sth2->fetchAll(PDO::FETCH_ASSOC);

if (!$categories) {
    exit('la catégorie n\'existe pas!');
}

// Récupérer l'produit dans le tableau des produits
$sth = $bdd->prepare("SELECT * FROM produit WHERE id_produit = ?");
$sth->execute([$_GET['id']]);
$produit = $sth->fetch(PDO::FETCH_ASSOC);

if (!$produit) {
    exit('le produit n\'existe pas!');
}
?>

<?php include 'header.php' ?>

<!-- ACTIONS -->
<section id="actions" class="py-4 mb-4 bg-light">

    <div class="container">

        <div class="row">

            <div class="col-md-3">

                <a href="index.php" class="btn btn-light btn-block">

                    <i class="fas fa-arrow-left"></i> Retour

                </a>

            </div>

        </div>

    </div>

</section>

<!-- DETAILS -->
<section id="details">

    <div class="container">

        <div class="row">

            <div class="col">

                <div class="card">

                    <div class="card-header">

                        <h4>Détails</h4>

                    </div>

                    <form method="POST">

                        <div class="card-body">

                            <div class="form-group">

                                <label for="title" class="form-label">Titre</label>

                                <input value="<?= $produit['titre']; ?>" type="text" name="titre" class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="ref" class="form-label mt-4">Référence</label>

                                <input value="<?= $produit['reference']; ?>" name="reference" type="text" class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="category" class="form-label mt-4">Catégorie</label>

                                <select name="id_categorie" class="form-control">

                                    <?php foreach ($categories as $categorie) : ?>

                                        <option value="<?= $categorie['id_categorie'] ?>">

                                            <?php

                                            // Si le nom de la catégorie est vide alors afficher la catégorie sinon afficher l

                                            if ($nom_categorie == "") {
                                                echo $categorie['lib_cat'];
                                            } else {
                                                echo $nom_categorie;
                                            }

                                            ?>

                                        </option>

                                    <?php endforeach; ?>

                                </select>

                            </div>

                            <div class="form-group">

                                <label class="form-label mt-4">Prix HT</label>

                                <input value="<?= $produit['prix_ht']; ?>" type="number" class="form-control" name="prix_ht">

                            </div>

                            <div class="form-group">

                                <label class="form-label mt-4">Prix TTC</label>

                                <input value="<?= $produit['prix_ttc']; ?>" type="number" class="form-control" name="prix_ttc">

                            </div>

                            <div class="form-group">

                                <label for="formFile" class="form-label mt-4">Choisir un fichier</label>

                                <input type="hidden" name="MAX_FILE_SIZE" value="100000">

                                <input value="<?= $produit['image']; ?>" class="form-control" type="file" name="image">

                            </div>

                            <div class="form-group">

                                <label for="body" class="form-label mt-4">Description</label>

                                <textarea name="description" class="form-control"><?= $produit['description']; ?></textarea>

                            </div>

                        </div>

                        <div class="card-footer">

                            <input hidden value="<?= $produit['id_produit'] ?>" name="id_produit">

                            <a href="update_prod.php?id=<?= $produit['id_produit'] ?>" class="btn btn-success btn-block" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Modifier
                            </a>

                            <a href="delete_prod.php?id=<?= $produit['id_produit'] ?>" class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#confirm">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- MODAL CONFIRMATION SUPPRESSION -->
<div class="modal fade" id="confirm">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Supprimer un produit</h5>

                <button class="btn-close" data-bs-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <p>Êtes-vous sûr de vouloir supprimer le produit #<?= $produit['id_produit'] ?>?</p>

            </div>

            <div class="modal-footer">

                <a href="delete_prod.php?id=<?= $produit['id_produit'] ?>&confirm=yes" class="btn btn-primary">OUI</a>

                <a href="delete_prod.php?id=<?= $produit['id_produit'] ?>&confirm=no" class="btn btn-secondary" data-bs-dismiss="modal">NON</a>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php' ?>