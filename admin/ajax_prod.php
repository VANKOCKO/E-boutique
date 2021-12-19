<?php

error_reporting(E_ALL);
require '../connexion.php';

$requestpayload = file_get_contents("php://input");

//echo $requestpayload;

$produit = json_decode($requestpayload, JSON_FORCE_OBJECT);

//echo(json_encode($produits->description));

$produit = array(
    $titre = $produit->titre,
    $reference = $produit->reference,
    $description = $produit->description,
    $prix_ht = $produit->prix_ht,
    $prix_ttc = $produit->prix_ttc,
    $image = $produit->image,
    $filename = $produit->image,
    $id_categorie = $produit->id_categorie
);

$sth = $bdd->prepare("INSERT INTO produit(titre,reference,description,prix_ht,prix_ttc,image,id_categorie) 
                    VALUES (:titre,:reference,:description,:prix_ht,:prix_ttc,:image,:id_categorie)");

$sth->bindValue(':titre', $titre);
$sth->bindValue(':reference', $reference);
$sth->bindValue(':description', $description);
$sth->bindValue(':prix_ht', $prix_ht);
$sth->bindValue(':prix_ttc', $prix_ttc);
$sth->bindValue(':image', $filename);
$sth->bindValue(':id_categorie', $id_categorie);


$sth->execute();
echo "Ajout dans la table produit grâce à array() et aux marqueurs intérrogatifs";

if (isset($titre)) {
    //Vérification si le champ est vide
    if (empty($titre)) {
        $erreurtitre = "Vous devez remplir le titre du produit";
    }
    //Filtrer le champ
    $titrefiltre = filter_var($titre, FILTER_SANITIZE_STRING);
    echo "Nombre de caractère : " . strlen($titrefiltre) . "<br>";
    //Taille du champ
    if (strlen($titrefiltre) >= 20) {
        $erreurtailletitre = "20 caractères maximum";
    }
}
