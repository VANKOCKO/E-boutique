<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');
$msg = '';

// Vérifiez que l'ID du produit existe
if (isset($_GET['id'])) {

    // Confirmation avant suppression
    if (isset($_GET['confirm'])) {

        if ($_GET['confirm'] == "yes") {
            // Assurez-vous que l'utilisateur confirme avant la suppression 
            $sth = $bdd->prepare("DELETE FROM produit WHERE id_produit = ?");
            $sth->bindValue(':id_produit', $id_produit);
            $sth->execute([$_GET['id']]);
            $msg = "Vous avez supprimé le produit !";

            // Envoi message de confirmation
            $_SESSION['delete_prod'] = '<div class="row">
                                            <div class="alert alert-dismissible alert-info mx-auto mt-5 col-md-10">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <p class="mb-0">Produit supprimé avec succès !</p>
                                            </div>
                                        </div>';

            header('Location: produit.php');
        } else {
            header('Location: produit.php');
            exit;
        }
    }
} else {
    exit('id non spécifié!');
}