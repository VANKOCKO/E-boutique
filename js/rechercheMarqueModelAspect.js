$(function(){
    // recherche en fonction de la categorie 
     var listesDesMarques = []
     $("#listcategorieBis > .box > .check > input").on('change',function(){
            console.log($(this).val())
            listesDesMarques.push($(this).val())   
            $.ajax({
                url:"../ajax/rechercheCategorie.php",
                method:"POST",
                data : {
                    rechercheCategorie :$(this).val() 
                }
            }).done(function(res){
                if(JSON.parse(res) != ""){
                      $(".listproduit").empty()
                      for(let i=0;i<JSON.parse(res).length;i++){
                        var listproduit = $(".listproduit")
                        var section =$("<section id='s2'></section>")
                        var d2 = $("<div id='d2'></div>")
                        var d3 = $("<div id='d3'></div>")
                        var article=$("<article></article>")
                        var img_prod =$("<img id='img_prod' alt='imageproduit'/>")
                        var d4 =$("<div id='d4'></div>")
                        var d5 =$("<div id='d5'></div>")
                        var h2 = $("<h2></h2>")
                        h2.html(JSON.parse(res)[i].prix_ttc)
                        d5.append(h2)
                        var btn = $("<button class='ajtpanier' name='ajout_panier' type='submit'>AJOUTER AU PANIER</button>")
                        var firstChild = $("<div id='firstChild'></div>")
                        var description = $("<div></div>")
                        var imgproduit = $(" <input hidden class='imgproduit' name='img'>")
                        imgproduit.attr('value',"../admin/"+JSON.parse(res)[i].image)
                        var titreproduit = $(" <input hidden class='titreproduit' name='titreref'>")
                        titreproduit.attr('value',JSON.parse(res)[i].titre)
                        var prixhtproduit = $(" <input hidden class='prixhtproduit' name='prix_ht'>")
                        prixhtproduit.attr('value',JSON.parse(res)[i].prix_ht)
                        var prixttcproduit = $(" <input hidden class='prixttcproduit' name='prix_ttc'>")
                        prixttcproduit.attr('value',JSON.parse(res)[i].prix_ttc)
                        btn.append(imgproduit)
                        btn.append(titreproduit)
                        btn.append(prixhtproduit)
                        btn.append(prixttcproduit)
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
                  }
            })
     })
     // recherche en fonction de la marque 
     var listesDesMarques = []
     $("#listeDesMarques > .box > .check > input").on('change',function(){
            listesDesMarques.push($(this).val())   
            $.ajax({
                url:"../ajax/rechercheMarqueModelAspect.php",
                method:"POST",
                data : {
                    listesDesMarques : JSON.stringify(listesDesMarques)
                }
            }).done(function(res){
                console.log(res)
            })
     })
})


