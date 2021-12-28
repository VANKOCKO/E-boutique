<?php
require('../connexion.php');
if(isset($_POST['rechercheCategorie']) ) {
    $categorie = $_POST['rechercheCategorie'];
    $sth = $bdd->prepare("SELECT id_categorie FROM categorie where lib_cat = $categorie ");
    $sth->execute();
    $id_categorie = $sth->fetchAll(PDO::FETCH_ASSOC); 
    echo ($produits);
}
?>
