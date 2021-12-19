<?php
$sth2 = $bdd->prepare("SELECT * FROM categorie");
$sth2->execute();
$categories = $sth2->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- AJOUTER UN PRODUIT -->
<div class="modal fade" id="staticBackdrop">

    <div class="modal-dialog modal-lg">

        <div class="modal-content">

            <div class="modal-header bg-info">

                <h5 class="modal-title text-white">Ajouter un produit</h5>

                <button class="btn-close" data-bs-dismiss="modal">

                    <span>&times;</span>

                </button>

            </div>

            <div class="modal-body">

                <form action="upload_prod.php" method="post" enctype="multipart/form-data">

                    <div class="form-group">

                        <label for="title" class="form-label">Titre</label>

                        <input id="titre" name="titre" type="text" class="form-control">

                        <p class="text-danger">

                            <?php

                            // $erreurtitre = "";
                            // $erreurtailletitre = "";

                            // echo $erreurtitre;
                            // echo $erreurtailletitre;

                            ?>

                        </p>

                    </div>

                    <div class="form-group">

                        <label for="ref" class="form-label">Référence</label>

                        <input name="reference" id="reference" type="text" class="form-control">

                    </div>

                    <div class="form-group">

                        <label for="category" class="form-label mt-4">Catégorie</label>

                        <select id="id_categorie" name="id_categorie" class="form-control">

                            <?php foreach ($categories as $categorie) : ?>

                            <option id="id_categorievalue" value="<?php echo $categorie['id_categorie'] ?>">
                                <?php echo $categorie['lib_cat'] ?></option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                    <div class="form-group">

                        <label class="form-label mt-4">Prix HT</label>

                        <input type="number" class="form-control" name="prix_ht" step="0.01" id="prix_ht">


                    </div>

                    <div class="form-group">

                        <label class="form-label mt-4">Prix TTC</label>

                        <input type="number" class="form-control" name="prix_ttc" step="0.01" id="prix_ttc">

                    </div>

                    <div class="form-group">

                        <label for="formFile" class="form-label mt-4">Choisir un fichier</label>

                        <input type="hidden" name="MAX_FILE_SIZE" value="100000">

                        <input class="form-control" type="file" name="image" id="image">

                    </div>

                    <div class="form-group">

                        <label for="body" class="form-label mt-4">Description</label>

                        <textarea id="description" name="description" class="form-control"></textarea>

                    </div>

                    <div class="modal-footer">

                        <button id="create_prod" name="create_prod" type="submit" class="btn btn-info"
                            data-dismiss="modal">Ajouter</button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
<div id="miroir"></div>
<script>
var button = document.getElementById('create_prod');
var id_categorie = document.getElementById('id_categorie');
var id_categorievaleur = "";

id_categorie.addEventListener('change', function() {
    id_categorievaleur = this.value;
});

button.addEventListener("click", function(e) {
    var miroir = document.getElementById("miroir");
    miroir.innerHTML = CKEDITOR.instances['description'].getData();



    xhr.onload = () => {

        if (xhr.status >= 200 && xhr.status < 300) {
            //Transformation d'objet JSON en javascript
            const reponse = JSON.parse(xhr.responseText);
            console.log(reponse);
        }

    }


    //Méthode d'envoie en AJAX
    xhr.open('POST', "ajax_prod.php");

    //Transformation d'objet javascript en JSON
    xhr.send(JSON.stringify({
            titre: document.getElementById("titre").value,
            reference: document.getElementById("reference").value,
            id_categorie: id_categorievaleur,
            prix_ht: document.getElementById("prix_ht").value,
            prix_ttc: document.getElementById("prix_ttc").value,
            image: document.getElementById("image").image,
            description: miroir.innerText
        }

    ));

});
</script>