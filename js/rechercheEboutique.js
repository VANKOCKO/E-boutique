$(function(){
    $.ajax({
             url : '../ajax/AfficheTousLesProduit.php',
             method : 'GET'
         }).done(function(res){
              for(let i=0;i<JSON.parse(res).length;i++){
                    var listproduit = $(".listproduit")
                    var section =$("<section id='s2'></section>")
                    var d2 = $("<div id='d2'></div>")
                    var d3 = $("<div id='d3'></div>")
                    var article=$("<article></article>")
                    var img_prod =$("<img id='img_prod' alt='imageproduit'/>")
                    var d4 =$("<div id='d4'></div>")
                    var d5 =$("<div id='d5'></div>")
                    var btn = $("<button class='ajtpanier' name='ajout_panier' type='submit'>AJOUTER AU PANIER</button>")
                    var firstChild = $("<div id='firstChild'></div>")
                    var description = $("<div></div>")
                    d5.append(btn)
                    d3.append(img_prod)
                    d3.append(d4)
                    d3.append(d5)
                    d4.append(firstChild)
                    d4.append(description)
                    article.append(d3)
                    d2.append(article)
                    section.append(d2)
                    listproduit.append(section)
                    img_prod.attr("src","../admin/"+JSON.parse(res)[i].image)
                    firstChild.html(JSON.parse(res)[i].titre)
                    description.html(JSON.parse(res)[i].description)
                  }
                var produitPanier = []
                $(".ajtpanier").on("click", function()
                {    
                    console.log($(this))
                    var infoproduitSelectionnees = []
                   // infoproduitSelectionnees.push(imgproduit,titreproduit,prixhtproduit,prixttcproduit);
                   // produitPanier.push(infoproduitSelectionnees)
                   // $(".qtitePanier").text(produitPanier.length)
                   // console.log(produitPanier)
                    $.ajax(
                        {
                            method: "POST",
                            url:"../ajax/ajouterPanier.php",
                            data: { panier : JSON.stringify(produitPanier) }
                        }
                      )
                       .done(function( msg ) {
                                  console.log(msg)
                    });
                })
    })
    $("#myRange").change(function(){
         $("#valeurRange").text($(this).val())   
         $.ajax({
             url : '../ajax/recherchePrix.php',
             method : 'post',
             data : {
                     recherchePrix : $(this).val()
             }
         }).done(function(res){
              
              if(JSON.parse(res) != ""){
                  for(let i=0;i<JSON.parse(res).length;i++){
                    $("#first-child").html(JSON.parse(res)[i].titre)
                    console.log(JSON.parse(res)[i].titre)
                  }
              }  
    })
})


})