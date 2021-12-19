<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="img/Black_Favicon.jpg" />
    <link rel="stylesheet" href="css/style.css">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- PureCookie -->
    <link rel="stylesheet" href="css/purecookie.css"/>

    <!-- Titre de mon URL -->
    <title>Infozone</title>

</head>

<!-- Début de ma page Web -->

<body>

    <!-- Début de mon en-tête -->
    <header>

        <!-- Logo principal -->
        <<img id="logo" src="./img/Black_Logo.jpg" alt="logo"></img></a>

        <!-- Début de ma barre de naviguation -->
        <nav>

            <div id="accueil">

                <i class="bi bi-house"></i>

                <a id="a1" href="#">Accueil</a>

            </div>

            <div id="eboutique">

                <i class="bi bi-shop"></i>

                <a id="a2" href="client/eboutique.php">E-Boutique</a>

            </div>

            <div id="seconnecter">

                <i class="bi bi-person"></i>

                <a id="a3" href="client/seconnecter.php">Se connecter</a>

            </div>

            <div id="panier">

                <i class="bi bi-bucket"></i>

                <a id="a4" href="client/panier.php">Panier</a>

            </div>

            <div id="contact">

                <i class="bi bi-envelope"></i>

                <a id="a5" href="client/contact.php">Contact</a>

            </div>

        </nav><!-- Fin de ma barre de naviguation -->

        <!-- Barre de recherche -->
        <div id="searchbar">

            <input type="text">

            <i id="loupe" class="bi bi-search"></i>

        </div>

        <!-- Menu burger -->
        <button class="btn-menu" type="button">
            <i class="btn-menu__bars" aria-hidden="true"></i>
        </button>

    </header>
    <!--Fin de mon en-tête-->