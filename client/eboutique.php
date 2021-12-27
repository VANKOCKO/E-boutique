<?php
error_reporting(E_ALL);
require('../connexion.php');
// On récupère les données de la barre de recherche
// if (isset($_GET['s']) and !empty(($_GET['s']))) {
//     $recherche = htmlspecialchars($_GET['s']);
//     $allprod = $bdd->prepare('SELECT titre FROM produit WHERE titre LIKE "%' . $recherche . '%" ORDER BY id_produit DESC');
// }


// Récupérer le produit dans la table des produits
$sth = $bdd->prepare("SELECT * FROM produit");
$sth->execute();
$produits = $sth->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="fr">

<!-- head = Partie non visible par l'utilisateur. Interprêtée par le navigateur -->

<head>

    <!-- Caractères -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/jpg" href="../img/Black_Favicon.jpg" />
    <link rel="stylesheet" href="../css/eboutique.css">

    <!--CDN Jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Titre de mon URL -->
    <title>Infozone</title>

</head>
<div id="test">
    
</div>

<!-- Début de ma page Web -->

<body style="height: 100vh;">

    <!-- Début de mon en-tête -->
    <header>

        <!-- Logo principal -->
        <a href="../index.php"><img id="logo" src="../img/Black_Logo.jpg" alt="logo"></a>

        <!-- Début de ma barre de naviguation -->
        <nav>

            <div id="accueil">

                <i class="bi bi-house"></i>

                <a id="a1" href="../index.php">Accueil</a>

            </div>

            <div id="eboutique">

                <i class="bi bi-shop"></i>

                <a id="a2" href="eboutique.php">E-Boutique</a>

            </div>

            <div id="seconnecter">

                <i class="bi bi-person"></i>

                <a id="a3" href="seconnecter.php">Se connecter</a>

            </div>

            <div id="panier">

                <i class="bi bi-bucket"><sup class="qtitePanier"></sup></i>
                <a id="a4" href="panier.php" class="linkpanier">Panier</a>
            </div>

            <div id="contact">

                <i class="bi bi-envelope"></i>

                <a id="a5" href="contact.php">Contact</a>

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

    <div id="d1">

        <!--Titre principal-->
        <h1>Tous les produits</h1>
        
        <!-- Afficher les informations sur le panier ! -->
        <div id="infoPanier" style="display:flex">
            <div>
                <i></i><img src="" alt=""/><p>Ajouté au panier</p>
            </div>
            <div style="display:flex">
                <div>
                    <p style="display: inline">Sous-total du panier ( </p> <p style="display:inline" class="qtitePanier"></p> <p style="display:inline"></p>articles)
                </div>
                <div> 
                                                     <a id="a4" href="panier.php" class="linkpanier">Panier</a>

                </div>
                
            </div>
                
        </div>

        <!--Début de liste déroulante-->
        <select id="select">

            <option>Meilleures ventes</option>

            <option>Prix croissant</option>

            <option>Prix décroissant</option>

        </select>
        <!--Fin de liste déroulante-->

    </div>

    <!-- Aside + Main flex -->
    <section id="s1">

        <!-- Contenu se trouvant dans une barre latérale -->
        <aside>

            <h3>Catégories</h3>

            <div class="card">

                <h6>High-Tech</h6>

                <h6>Toutes les marques</h6>

                <h6>Ordinateurs & Accessoires</h6>

                <h6>Ecran & Moniteur</h6>

                <h6>Imprimante</h6>

                <a class="vp" href="#">Voir plus</a>

            </div>

            <h3>Prix</h3>

            <div class="card">

                <div id="dminmax">

                    <div id="dmin">

                        <label>Min</label>

                        <input class="minmax" placeholder="0" type="number">

                    </div>

                    <div id="dmax">

                        <label>Max</label>

                        <input class="minmax" placeholder="1000" type="number">

                    </div>

                </div>

                <div class="slidecontainer">
                    <input type="range" min="0" max="1000" step="10" value="500" class="slider" id="myRange">
                    <p id="valeurRange"></p>
                </div>

            </div>

            <h3>Marque</h3>

            <div class="card">

                <div class="box">
                    <div class="check">
                        <input class="input-check" type="checkbox" checked><label>Peu importe</label>
                    </div>
                    <div class="check">
                        <input class="input-check" type="checkbox">Apple
                    </div>
                    <div class="check">
                        <input class="input-check" type="checkbox">Samsung
                    </div>
                    <div class="check">
                        <input class="input-check" type="checkbox">Dell
                    </div>
                    <div class="check">
                        <input class="input-check" type="checkbox">HP
                    </div>
                    <div class="check">
                        <input class="input-check" type="checkbox">Lenovo
                    </div>
                </div>

                <a class="vp" href="#">Voir plus</a>

            </div>

            <h3>Modèle</h3>

            <div class="card">

                <div class="box">

                    <div class="check">
                        <input type="checkbox" checked>Peu importe
                    </div>

                    <div class="check">
                        <input type="checkbox">MacBook
                    </div>

                    <div class="check">
                        <input type="checkbox">EliteBook
                    </div>

                    <div class="check">
                        <input type="checkbox">ThinkPad
                    </div>

                    <div class="check">
                        <input type="checkbox">ProDesk
                    </div>

                    <div class="check">
                        <input type="checkbox">ProBook
                    </div>

                </div>

                <a class="vp" href="#">Voir plus</a>

            </div>

            <h3>Aspect</h3>

            <div class="card">

                <div class="box">
                    <div class="check">
                        <input type="checkbox" checked><label>Peu importe</label>
                    </div>
                    <div class="check">
                        <input type="checkbox">Comme neuf
                    </div>
                    <div class="check">
                        <input type="checkbox">Très bon état
                    </div>
                    <div class="check">
                        <input type="checkbox">Bon état
                    </div>
                    <div class="check">
                        <input type="checkbox">État correct
                    </div>
                    <div class="check">
                        <input type="checkbox">Stallone
                    </div>
                </div>

            </div>


        </aside>
        <!--Fin aside-->

        <!--Contenu principal de ma page-->
        
        <main class="listproduit">
          
        </main> <!-- Fin du contenu principal de la page -->
      
    </section>

    <!--Début de mon bas de page-->
    <footer>

        <p> INFOZONE | 5 Rue du Maréchal Joffre, 54260 Longuyon | TEL : +33 6 19 30 87 57</p>

        <p> © 2021 INFOZONE - <a href="#">TOUS DROITS RÉSERVÉS</a> - <a href="#">MENTIONS LÉGALES</a></p>

    </footer>
    <!--Fin de mon bas de page-->
    <script src="../js/jquery.js"></script>
    <script src="../js/rechercheEboutique.js"></script>
    <script src="../js/ajoutPanier.js"></script>
    <script>
        var slider = document.getElementById("myRange");
        var output = document.getElementById("demo");
        output.innerHTML = slider.value; // Display the default slider value

        // Update the current slider value (each time you drag the slider handle)
        slider.oninput = function() {
            output.innerHTML = this.value;
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.btn-menu').on('click', function() {
                $('body').toggleClass('menu-open');
                $('header').css({
                    display: 'flex',
                    'flex-direction': 'column'
                }).html('test').slideDown();
                $('#logo').css({
                    display: 'flex',
                    'flex-direction': 'column'
                }).html('test').slideDown();
                $('nav').css({
                    display: 'flex',
                    'flex-direction': 'column'
                }).html('test').slideDown();
                $('').css({

                }).html('test').slideDown();
                $('').css({

                }).html('test').slideDown();
            });
        })
    </script>

</body>
<!--Fin de ma page Web-->

</html>