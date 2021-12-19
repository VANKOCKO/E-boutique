<?php
// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require '../connexion.php';

/********** Vérifier si l'ID existe, par exemple update.php? Id = 1 obtiendra le contact avec l'ID de 1 ***********/
if (isset($_GET['id'])) {

    if (!empty($_POST)) {

        // Cette partie est similaire à create_cat.php, mais à la place nous mettons à jour un enregistrement et n'insérons pas
        $lib_cat = isset($_POST['lib_cat']) ? strip_tags($_POST['lib_cat']) : '';

        // Mettre à jour l'enregistrement
        $sth = $bdd->prepare("UPDATE categorie SET lib_cat = ? WHERE id_categorie = ?");
        $sth->bindValue(':lib_cat', $lib_cat);
        $sth->execute([$lib_cat, $_GET['id']]);

        // Envoi message de confirmation
        $_SESSION['update_cat'] = '<div class="row">
                                        <div class="alert alert-dismissible alert-success mx-auto mt-5 col-md-10">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <p class="mb-0">Catégorie modifié avec succès !</p>
                                        </div>
                                    </div>';

        header('Location: categorie.php');
    }

    // Récupérer la categorie dans le tableau des categories
    $sth = $bdd->prepare("SELECT * FROM categorie WHERE id_categorie = ?");
    $sth->execute([$_GET['id']]);
    $categorie = $sth->fetch(PDO::FETCH_ASSOC);

    if (!$categorie) {
        exit('la categorie n\'existe pas!');
    }
} else {
    exit('Aucune categorie spécifié !');
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
<div class="container">

    <div class="row">

        <div class="col">

            <div class="card">

                <div class="card-header">

                    <h4>Détails</h4>

                </div>

                <form method="POST" action="">

                    <div class="card-body">

                        <div class="form-group">

                            <label for="category" class="form-label mt-4">Catégorie</label>

                            <input type="text" value="<?php echo $categorie['lib_cat']; ?>" name="lib_cat" class="form-control mb-4">

                        </div>

                    </div>

                    <div class="card-footer">

                        <input hidden value="<?= $categorie['id_categorie'] ?>" name="id_categorie">

                        <button name="update" type="submit" class="btn btn-success">
                            <i class="fas fa-check"></i> Modifier
                        </button>

                        <a href="delete_cat.php?id=<?= $categorie['id_categorie'] ?>" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm">
                            <i class="fas fa-trash"></i> Supprimer
                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<!-- MODAL CONFIRMATION SUPPRESSION -->
<div class="modal fade" id="confirm">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">Supprimer une catégorie</h5>

                <button class="btn-close" data-bs-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <p>Êtes-vous sûr de vouloir supprimer la catégorie #<?= $categorie['id_categorie'] ?>?</p>

            </div>

            <div class="modal-footer">

                <a href="delete_cat.php?id=<?= $categorie['id_categorie'] ?>&confirm=yes" class="btn btn-primary">OUI</a>

                <a href="delete_cat.php?id=<?= $categorie['id_categorie'] ?>&confirm=no" class="btn btn-secondary" data-bs-dismiss="modal">NON</a>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php' ?>