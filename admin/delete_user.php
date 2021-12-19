<?php
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');
$msg = '';

// Vérifiez que l'ID du utilisateur existe
if (isset($_GET['id'])) {

    // Confirmation avant suppression
    if (isset($_GET['confirm'])) {

        if ($_GET['confirm'] == "yes") {
            // Assurez-vous que l'utilisateur confirme avant la suppression 
            $sth = $bdd->prepare("DELETE FROM utilisateur WHERE id_utilisateur = ?");
            $sth->bindValue(':id_utilisateur', $id_utilisateur);
            $sth->execute([$_GET['id']]);
            $msg = "Vous avez supprimé le utilisateur !";

            // Envoi message de confirmation
            $_SESSION['delete_user'] = '<div class="row">
                                            <div class="alert alert-dismissible alert-warning mx-auto mt-5col-md-10">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                <p class="mb-0">Utilisateur supprimé avec succès !</p>
                                            </div>
                                        </div>';

            header('Location: utilisateur.php');
        } else {
            header('Location: utilisateur.php');
            exit;
        }
    }
} else {
    exit('id non spécifié!');
}