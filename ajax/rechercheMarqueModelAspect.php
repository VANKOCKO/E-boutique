<?php 
require('../connexion.php');
if(isset($_POST['listesDesMarques']) ) {
    $categorie = $_POST['rechercheCategorie'];
    $sth = $bdd->prepare("SELECT id_categorie FROM categorie where lib_cat = '$categorie'");
    $sth->execute();
    $id_categories = $sth->fetchAll(PDO::FETCH_ASSOC); 
    $id_categorie=$id_categories[0]['id_categorie'];
    $sth1 = $bdd->prepare("SELECT * from produit where produit.id_categorie  = $id_categorie");
    $sth1->execute();
    $produits = $sth1->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode($produits);
}
?>
