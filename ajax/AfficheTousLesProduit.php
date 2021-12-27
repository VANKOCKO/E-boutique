<?php
require('../connexion.php');
if(isset($_GET) ) {
    $sth = $bdd->prepare("SELECT * FROM produit ");
    $sth->execute();
    $produits = $sth->fetchAll(PDO::FETCH_ASSOC); 
    echo json_encode($produits);
}

?>