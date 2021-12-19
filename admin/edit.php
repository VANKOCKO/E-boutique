<?php

error_reporting(E_ALL);
require('../connexion.php');

if (isset($_GET['edit'])) {

    $id_produit = $_POST['id_produit'];
    $titre = $_POST['titre'];
    $reference = $_POST['reference'];
    $categorie = $_POST['lib_cat'];
    $description = $_POST['description'];

    $sth = $bdd->prepare("  UPDATE produit
                            SET id_produit=:id_produit,
                                titre=:titre,
                                reference=:reference,
                                lib_cat=:categorie,
                                description=:description
                            WHERE id_produit=:id_produit
                        ");

    $sth->bindValue(':id_produit', $id_produit);
    $sth->bindValue(':titre', $titre);
    $sth->bindValue(':reference', $reference);
    $sth->bindValue(':lib_cat', $categorie);
    $sth->bindValue(':description', $description);

    $sth->execute();

    echo "Update";
} else {
    echo "No update";
}
