<?php if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL); ?>

<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../img/Black_Favicon.jpg">

    <!-- FontAwesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
    <link rel="stylesheet" href="../css/bootstrap.css">

    <!-- Titre de mon URL -->
    <title>Infozone</title>

</head>

<!-- Début de ma page Web -->

<body style="height: 100vh;">

    <!--Début de mon en-tête-->
    <header>

        <!-- Début de ma barre de naviguation -->
        <nav class="navbar navbar-expand-lg navbar-dark p-0" style="background-color: black;">

            <div class="container-fluid">

                <a href="index.php"><img class="navbar-brand" src="../img/Black_Logo.jpg" style="width: 11rem;"></a>

                <ul class="navbar-nav ml-auto">

                    <li class="nav-item">

                        <a href="#" class="nav-link">

                            <i class="fas fa-user"></i> Bienvenue <?= $_SESSION['pren_session']; ?>
                        </a>

                    </li>

                    <li class="nav-item">

                        <a href="login.php" class="nav-link">

                            <i class="fas fa-user-times"></i> Se déconnecter

                        </a>

                    </li>
                </ul>

            </div>

        </nav><!-- Fin de ma barre de naviguation -->

    </header>
    <!--Fin de mon en-tête-->