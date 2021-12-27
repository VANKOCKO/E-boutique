<?php

$servername = "localhost";
$username = "root";
$passeword = "";

// on essaie de se connecter
try {
    // sous WAMP
    $bdd = new PDO("mysql:host=$servername;dbname=infozoneeboutiquedb", $username, $passeword, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES "UTF8"'));

    // on définit le mode d'erreur de PDO sur Exception
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

// on récupère les exceptions si une exception est lancée et on affiche ses informations
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
