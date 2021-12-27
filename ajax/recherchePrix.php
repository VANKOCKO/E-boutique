<?php
require('../connexion.php');
if(isset($_POST['recherchePrix']) ) {
    $prix = $_POST['recherchePrix'];
    $sth = $bdd->prepare("SELECT * FROM produit where prix_ttc like '%$prix%'");
    $sth->execute();
    $produits = $sth->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode($produits);
}
?>