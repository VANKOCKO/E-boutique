<?php
// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require('../connexion.php');

if (isset($_POST['login'])) {

    $mailconnect = strip_tags($_POST['mailconnect']);
    $mdpconnect = strip_tags($_POST['mdpconnect']);

    // Vérification de l'existence de l'utilisateur 
    $sth = $bdd->prepare('SELECT * FROM utilisateur WHERE email=:email');
    $sth->bindValue(':email', $mailconnect);
    $sth->execute();

    // Le paramètre PDO::FETCH_ASSOC indique à PDO de renvoyer le résultat sous forme de tableau associatif
    if ($user = $sth->fetch(PDO::FETCH_ASSOC)) {

        $prenom = $user["prenom"];
        $email = $user["email"];
        $mdp = $user["mdp"];

        if (password_verify($mdpconnect, $mdp)) {
            $_SESSION['pren_session'] = $prenom;
            header('Location: index.php');
        } else echo 'mdp faux';
    } else echo 'identifiant ou mot de passe faux';
}

?>

<?php include 'header_login.php' ?>

<!-- HEADER -->
<header id="main-header" class="p-5 text-center">

    <div class="container">

        <div class="row">

            <h1><i class="fas fa-user"></i> Admin</h1>

        </div>

    </div>

</header>

<!-- LOGIN -->
<section id="login">

    <div class="container">

        <div class="row">

            <div class="col-md-6 mx-auto">

                <form action="" method="post">

                    <div class="card">

                        <div class="card-header">

                            <h4>Connexion</h4>

                        </div>

                        <div class="card-body">

                            <div class="form-group">

                                <label for="email" class="form-label mt-3">Email</label>

                                <input type="text" name="mailconnect" class="form-control">

                            </div>

                            <div class="form-group">

                                <label for="password" class="form-label mt-4">Mot de passe</label>

                                <input type="password" name="mdpconnect" class="form-control mb-3">

                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</section>

<?php include 'footer.php' ?>