<?php
// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');
$msg = '';

// Vérifiez que l'ID de la categorie existe
if (isset($_GET['id'])) {

    // Confirmation avant suppression
    if (isset($_GET['confirm'])) {

        if ($_GET['confirm'] == "yes") {
            // Assurez-vous que l'utilisateur confirme avant la suppression 
            $sth = $bdd->prepare("DELETE FROM categorie WHERE id_categorie = ?");
            $sth->bindValue(':id_categorie', $id_categorie);
            $sth->execute([$_GET['id']]);
            $msg = "Vous avez supprimé la catégorie !";

            // Envoi message de confirmation
            $_SESSION['delete_cat'] = '<div class="row">
                                            <div class="alert alert-dismissible alert-success mx-auto mt-5 col-md-10">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <p class="mb-0">Catégorie supprimé avec succès !</p>
                                            </div>
                                        </div>';

            header('Location: categorie.php');
        } else {
            header('Location: categorie.php');
            exit;
        }
    }
} else {
    exit('id non spécifié!');
}