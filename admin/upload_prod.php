<?php
// Rapporte toutes les erreurs PHP
error_reporting(E_ALL);

$urlimg = "";

if (isset($_POST['create_prod'])) {

    //verif upload
    $dossier = 'upload/';
    $fichier = basename($_FILES['image']['name']);
    $taille_maxi = 100000;
    $taille = filesize($_FILES['image']['tmp_name']);
    $extensions = array('.PNG', '.gif', '.jpg', '.jpeg');
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

    if (
        isset($_POST['titre']) && !empty($_POST['titre'])
        && isset($_POST['reference']) && !empty($_POST['reference'])
        && isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['prix_ht']) && !empty($_POST['prix_ht'])
        && isset($_POST['prix_ttc']) && !empty($_POST['prix_ttc'])
        && isset($urlimg) && !empty($urlimg)
        && isset($_POST['id_categorie']) && !empty($_POST['id_categorie'])
    ) {
        // On inclut la connexion à la base
        require_once('../connexion.php');

        // On nettoie les données
        $titre = strip_tags($_POST['titre']);
        $reference = strip_tags($_POST['reference']);
        $description = strip_tags($_POST['description']);
        $prix_ht = strip_tags($_POST['prix_ht']);
        $prix_ttc = strip_tags($_POST['prix_ttc']);
        $urlimg = strip_tags($urlimg);
        $id_categorie = strip_tags($_POST['id_categorie']);

        // On prépare la requête
        $sth = $bdd->prepare("INSERT INTO produit(titre,reference,description,prix_ht,prix_ttc,image,id_categorie) 
                        VALUES (:titre,:reference,:description,:prix_ht,:prix_ttc,:image, :id_categorie)");

        // On accroche les paramètres
        $sth->bindValue(':titre', $titre);
        $sth->bindValue(':reference', $reference);
        $sth->bindValue(':description', $description);
        $sth->bindValue(':prix_ht', $prix_ht);
        $sth->bindValue(':prix_ttc', $prix_ttc);
        $sth->bindValue(':image', $urlimg);
        $sth->bindValue(':id_categorie', $id_categorie);

        // On execute la requête
        $sth->execute();

        // On envoie un message de confirmation
        $_SESSION['create_prod'] = '<div class="row">
                                        <div class="alert alert-dismissible alert-warning mx-auto col-md-10">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            <p class="mb-0">Produit ajouté avec succès !</p>
                                        </div>
                                    </div>';

        // On déconnecte la connexion à la base
        require_once('../close.php');

        // On renvoi vers la page produit
        header('Location: produit.php');
    } else {
        // Sinon on envoie un message d'erreur
        $_SESSION['erreur'] = "Le formulaire est incomplet";
        // On renvoi vers la page index
        header('Location: index.php');
    }
}
