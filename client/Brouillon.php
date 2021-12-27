<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<main class="listproduit">
          
            <?php foreach ($produits as $produit) : ?>

                <!-- Container principal en column-->
                <section  id="s2">

                    <!--Différents contenus de même catégorie-->
                    <div id="d2">

                        <!--Début des articles-->
                        <article>

                            <div id="d3">

                                <img id="img_prod" src="../admin/<?= $produit['image']; ?>" alt="imageproduit">

                                <div id="d4">

                                    <p id="first-child"><?= $produit['titre'] . " " . $produit['reference']; ?></p>

                                    <p><?= $produit['description'] ?></p>

                                </div>

                                <div id="d5">
                                                    <button class="ajtpanier" name="ajout_panier" type="submit">AJOUTER AU PANIER
                                                           <input hidden class="imgproduit" name="img" value="./admin/<?= $produit['image']; ?>">
                                                           <input hidden class="titreproduit" name="titreref" value="<?= $produit['titre'] . " " . $produit['reference']; ?>">
                                                           <input hidden class="prixhtproduit" name="prix_ht" value="<?= $produit['prix_ht']; ?>">
                                                           <input hidden class="prixttcproduit" name="prix_ttc" value="<?= $produit['prix_ttc']; ?>">
        
                                                    </button>
                                                    
                                                   
                                    <h2><?= $produit['prix_ttc'] ?><sup>99</sup></h2>

                                </div>

                            </div>

                        </article>
                        <!--Fin des articles-->

                    </div> <!-- Fin de section-->

                </section><!-- Fin de section-->

            <?php endforeach; ?>

        </main> <!-- Fin du contenu principal de la page -->