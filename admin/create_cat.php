<?php

error_reporting(E_ALL);
require('../connexion.php');

if ($_POST) {
    if (isset($_POST['lib_cat']) && !empty($_POST['lib_cat'])) {

        // On inclut la connexion à la base
        require_once('../connexion.php');

        // On nettoie les données
        $categorie = strip_tags($_POST['lib_cat']);

        // On prépare la requête
        $sth = $bdd->prepare("INSERT INTO categorie(lib_cat) VALUES (:lib_cat)");

        // On accroche les paramètres
        $sth->bindValue(':lib_cat', $categorie);

        // On execute la requête
        $sth->execute();

        // On envoie un message de confirmation
        $_SESSION['create_cat'] = '<div class="row">
                                        <div class="alert alert-dismissible alert-success mx-auto mt-5 col-md-10">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <p class="mb-0">Catégorie ajouté avec succès !</p>
                                        </div>
                                    </div>';

        // On déconnecte la connexion à la base
        require_once('../close.php');

        // On renvoi vers la page catégorie
        header('Location: categorie.php');
    } else {
        // Sinon on envoie un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        // On renvoi vers la page index
        header('Location: index.php');
    }
}

?>

<!-- AJOUTER UNE CATEGORIE -->
<div class="modal fade" id="addCategoryModal">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-success text-white">

                <h5 class="modal-title">Ajouter une catégorie</h5>

                <button class="btn-close" data-bs-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <form action="" method="post">

                <div class="modal-body">

                    <div class="form-group">

                        <label for="title" class="form-label">Titre</label>

                        <input type="text" id="lib_cat" name="lib_cat" class="form-control">

                    </div>

                </div>

                <div class="modal-footer">

                    <button id="create_cat" name="create_cat" class="btn btn-success" data-dismiss="modal">Ajouter</button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    var button = document.getElementById('create_cat');

    //Méthode d'envoie en AJAX 
    var xhr = new XMLHttpRequest();

    button.addEventListener("click", function(e) {

        xhr.onload = () => {

            if (xhr.status >= 200 && xhr.status < 300) {
                //Transformation d'objet JSON en javascript
                const reponse = JSON.parse(xhr.responseText);
                console.log(reponse);
            }

        }

        //Méthode d'envoie en AJAX
        xhr.open('POST', "ajax_cat.php");

        //Transformation d'objet javascript en JSON
        xhr.send(JSON.stringify({
            lib_cat: document.getElementById("lib_cat").value
        }));

    });
</script>