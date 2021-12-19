<?php
// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');

/********** Vérifier si l'ID existe, par exemple update.php? Id = 1 obtiendra le contact avec l'ID de 1 ***********/
if (isset($_GET['id'])) {

    if (!empty($_POST)) {

        // Cette partie est similaire à create_user.php, mais à la place nous mettons à jour un enregistrement et n'insérons pas
        $prenom = isset($_POST['prenom']) ? strip_tags($_POST['prenom']) : '';
        $email = isset($_POST['email']) ? strip_tags($_POST['email']) : '';
        $role = isset($_POST['role']) ? strip_tags($_POST['role']) : '';
        $mdp = isset($_POST['mdp']) ? strip_tags($_POST['mdp']) : '';

        // Mettre à jour l'enregistrement
        $sth = $bdd->prepare("UPDATE utilisateur SET prenom = ?, email = ?,role = ?, mdp = ? WHERE id_utilisateur = ?");

        $sth->bindValue(':prenom', $prenom);
        $sth->bindValue(':email', $email);
        $sth->bindValue(':role', $role);
        $sth->bindValue(':mdp', password_hash($mdp, PASSWORD_DEFAULT));

        $sth->execute([$prenom, $email, $role, $mdp, $_GET['id']]);

        // Envoi message de confirmation

        $_SESSION['update_user'] = '<div class="row">
                                        <div class="alert alert-dismissible alert-warning mx-auto mt-5 col-md-10">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <p class="mb-0">Utilisateur modifié avec succès !</p>
                                        </div>
                                    </div>';

        header('Location: utilisateur.php');
    }

    // Récupérer l'utilisateur dans le tableau des utilisateurs
    $sth = $bdd->prepare("SELECT * FROM utilisateur WHERE id_utilisateur = ?");
    $sth->execute([$_GET['id']]);
    $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);

    if (!$utilisateur) {
        exit('l\'utilisateur n\'existe pas!');
    }
} else {
    exit('Aucun utilisateur spécifié !');
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

                    <form method="POST" action="">

                        <div class="card-body">

                            <div class="form-group">

                                <label for="title" class="form-label">Prénom</label>

                                <input value="<?= $utilisateur['prenom']; ?>" type="text" name="prenom"
                                    class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="ref" class="form-label mt-4">Email</label>

                                <input value="<?= $utilisateur['email']; ?>" name="email" type="email"
                                    class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="ref" class="form-label mt-4">Role</label>

                                <input value="<?= $utilisateur['role']; ?>" name="role" type="text"
                                    class="form-control">

                            </div>

                            <div class="form-group">

                                <label class="form-label mt-4">Mot de passe</label>

                                <input value="<?= $utilisateur['mdp']; ?>" type="text" class="form-control" name="mdp">

                            </div>

                        </div>

                        <div class="card-footer">

                            <input hidden value="<?= $utilisateur['id_utilisateur'] ?>" name="id_utilisateur">

                            <button name="update" type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Modifier
                            </button>

                            <a href="delete_user.php?id=<?= $utilisateur['id_utilisateur'] ?>"
                                class="btn btn-danger btn-block" data-bs-toggle="modal" data-bs-target="#confirm">
                                <i class="fas fa-trash"></i> Supprimer
                            </a>

                        </div>

                    </form>

                </div>

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

                <h5 class="modal-title">Supprimer un utilisateur</h5>

                <button class="btn-close" data-bs-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <p>Êtes-vous sûr de vouloir supprimer l'utilisateur #<?= $utilisateur['id_utilisateur'] ?>?</p>

            </div>

            <div class="modal-footer">

                <a href="delete_user.php?id=<?= $utilisateur['id_utilisateur'] ?>&confirm=yes"
                    class="btn btn-primary">OUI</a>

                <a href="delete_user.php?id=<?= $utilisateur['id_utilisateur'] ?>&confirm=no" class="btn btn-secondary"
                    data-bs-dismiss="modal">NON</a>

            </div>

        </div>

    </div>

</div>

<?php include 'footer.php' ?>