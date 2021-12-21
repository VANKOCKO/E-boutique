<?php
require('../connexion.php');
echo $_POST['recherchePrix'];
if(isset($_POST['recherchePrix']) ) {
    $prix = $_POST['recherchePrix'];
    $sth = $bdd->prepare("SELECT * FROM produit where prix_ttc like '%$prix%'");
    $sth->execute();
    $produits = $sth->fetchAll(PDO::FETCH_ASSOC); 
    echo '<pre>';
    print_r($produits);
    echo '</pre>'; 
}
?>