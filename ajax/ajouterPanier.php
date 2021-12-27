<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(isset($_POST['panier'])){
    $panier = json_decode($_POST['panier']);
    session_start();
    $_SESSION['panier'] = $panier;
    echo "<pre>";
    var_dump($_SESSION['panier']);
    echo "</pre>";
}