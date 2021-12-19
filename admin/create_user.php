<?php
error_reporting(E_ALL);
require('../connexion.php');

/********** Si le formulaire a été validé ***********/

if ($_POST) {
    if (
        isset($_POST['prenom']) && !empty($_POST['prenom'])
        && isset($_POST['email']) && !empty($_POST['email'])
        && isset($_POST['role']) && !empty($_POST['role'])
        && isset($_POST['mdp']) && !empty($_POST['mdp'])
    ) {
        // On inclut la connexion à la base
        require_once('../connexion.php');

        // On nettoie les données
        $prenom = strip_tags($_POST['prenom']);
        $email = strip_tags($_POST['email']);
        $role = strip_tags($_POST['role']);
        $mdp = strip_tags($_POST['mdp']);

        // On prépare la requête
        $sth = $bdd->prepare('INSERT INTO utilisateur(prenom,email,role,mdp) VALUES (:prenom,:email,:role,:mdp)');

        // On accroche les paramètres et on crypte le mdp
        $sth->bindValue(':prenom', $prenom);
        $sth->bindValue(':email', $email);
        $sth->bindValue(':role', $role);
        $sth->bindValue(':mdp', password_hash($mdp, PASSWORD_DEFAULT));

        // On execute la requête
        $sth->execute();

        // On envoie un message de confirmation
        $_SESSION['create_user'] = '<div class="row">
                                        <div class="alert alert-dismissible alert-warning mx-auto col-md-10">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <p class="mb-0">Utilisateur ajouté avec succès !</p>
                                        </div>
                                    </div>';

        // On déconnecte la connexion à la base
        require_once('../close.php');

        // On renvoi vers la page index
        header('Location: index.php');
    } else {
        // Sinon on envoie un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        // On renvoi vers la page index
        header('Location: index.php');
    }
}

?>

<!-- AJOUTER UN UTILISATEUR -->
<div class="modal fade" id="addUserModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-warning text-white">

                <h5 class="modal-title">Ajouter un utilisateur</h5>

                <button class="btn-close" data-bs-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <form action="" method="post">

                <div class="modal-body">

                    <div class="form-group">

                        <label for="name">Prénom</label>

                        <input type="text" name="prenom" class="form-control">

                    </div>

                    <div class="form-group">

                        <label for="email" class="form-label mt-4">Email</label>

                        <input type="email" name="email" class="form-control">

                    </div>

                    <div class="form-group">

                        <label for="role" class="form-label mt-4">Role</label>

                        <select id="role" name="role" class="form-control">

                            <option id="admin" name="admin">Administrateur</option>

                            <option id="modo" name="modo">Modérateur</option>

                        </select>

                    </div>

                    <div class="form-group">

                        <label for="password" class="form-label mt-4">Mot de passe</label>

                        <input type="password" name="mdp" class="form-control">

                    </div>

                    <div class="form-group">

                        <label for="password2" class="form-label mt-4">Confirmer le mot de passe</label>

                        <input type="password" class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <button class="btn btn-warning" type="submit" data-dismiss="modal">Ajouter</button>

                </div>

            </form>

        </div>

    </div>

</div>