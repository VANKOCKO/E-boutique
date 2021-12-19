/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(function(){
    var produitPanier = []
    $("#d5 > .ajtpanier").on("click", function()
    {      
        var imgproduit = $(this).children(".imgproduit").val()
        var titreproduit = $(this).children(".titreproduit").val()
        var prixhtproduit = parseFloat($(this).children(".prixhtproduit").val())
        var prixttcproduit =  parseFloat($(this).children(".prixttcproduit").val())
        var infoproduitSelectionnees = []
        infoproduitSelectionnees.push(imgproduit,titreproduit,prixhtproduit,prixttcproduit);
        produitPanier.push(infoproduitSelectionnees)
        $(".qtitePanier").text(produitPanier.length)
        console.log(produitPanier)
        $.ajax(
            {
                method: "POST",
                url:"eboutique.php",
                data: { panier : JSON.stringify(produitPanier) }
            }
          )
           .done(function( msg ) {
                      console.log(msg)
        });
    })
    
    
    
})