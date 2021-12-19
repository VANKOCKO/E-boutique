<?php

// On démarre une session
if (!isset($_SESSION)) {
    session_start();
}
error_reporting(E_ALL);
require '../connexion.php';

/********** Vérifier si l'ID existe, par exemple update.php? Id = 1 obtiendra le contact avec l'ID de 1 ***********/
if (isset($_GET['id'])) {

    if (!empty($_POST)) {

        //verif upload
        $dossier = 'upload/';
        $fichier = basename($_FILES['image']['name']);
        $taille_maxi = 100000;
        $taille = filesize($_FILES['image']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['image']['name'], '.');

        //Début des vérifications de sécurité...
        if (!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
        }
        if ($taille > $taille_maxi) {
            $erreur = 'Le fichier est trop gros...';
        }
        if (!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            //On formate le nom du fichier ici...
            $fichier = strtr(
                $fichier,
                'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
                'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy'
            );
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
            {
                echo 'Upload effectué avec succès !' . '<br>';
                $urlimg = $dossier . $_FILES['image']['name'];
                // header("Location: index.php");
            } else //Sinon (la fonction renvoie FALSE).
            {
                echo 'Echec de l\'upload !';
            }
        } else {
            echo $erreur;
        }
        //fin verif upload

        // Cette partie est similaire à upload_prod.php, mais à la place nous mettons à jour un enregistrement et n'insérons pas
        $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
        $reference = isset($_POST['reference']) ? strip_tags($_POST['reference']) : '';
        $prix_ht = isset($_POST['prix_ht']) ? strip_tags($_POST['prix_ht']) : '';
        $prix_ttc = isset($_POST['prix_ttc']) ? strip_tags($_POST['prix_ttc']) : '';
        $urlimg = isset($urlimg) ? strip_tags($urlimg) : '';
        $filename = isset($image['image']) ? strip_tags($_POST['image']) : '';
        $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
        $id_categorie = isset($_POST['id_categorie']) ? strip_tags($_POST['id_categorie']) : '';

        // Mettre à jour l'enregistrement
        $sth = $bdd->prepare("UPDATE produit SET titre = ?, reference = ?,prix_ht = ?, prix_ttc = ?, image = ?, description = ?, id_categorie = ? WHERE id_produit = ?");

        $sth->bindValue(':titre', $titre);
        $sth->bindValue(':reference', $reference);
        $sth->bindValue(':prix_ht', $prix_ht);
        $sth->bindValue(':prix_ttc', $prix_ttc);
        $sth->bindValue(':image', $urlimg);
        $sth->bindValue(':description', $description);
        $sth->bindValue(':id_categorie', $id_categorie);

        $sth->execute([$titre, $reference, $prix_ht, $prix_ttc, $urlimg, $description, $id_categorie, $_GET['id']]);


        // Récupérez la catégorie dans le tableau des catégories
        $sth2 = $bdd->prepare("SELECT lib_cat FROM categorie WHERE id_categorie = :id_categorie");
        $sth2->bindValue(":id_categorie", $id_categorie);
        $sth2->execute();
        $categories = $sth2->fetch(PDO::FETCH_ASSOC);

        // Afficher le nom de la catégorie qui est dans un tableau 
        $nom_categorie = $categories["lib_cat"];

        if (!$categories) {
            exit('la catégorie n\'existe pas!');
        }

        // Envoi message de confirmation
        $_SESSION['update_prod'] = '<div class="row">
                                        <div class="alert alert-dismissible alert-info mx-auto mt-5 col-md-10">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <p class="mb-0">Produit modifié avec succès !</p>
                                        </div>
                                    </div>';

        header('Location: produit.php');
    }
} else {
    exit('Aucun produit spécifié !');
}
