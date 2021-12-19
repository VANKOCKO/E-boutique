$(function(){
    $("#myRange").change(function(){
         $("#valeurRange").text($(this).val())
         $.ajax({
             url : '../ajax/recherchePrix.php',
             method : 'post',
             data : {
                     recherchePrix : $(this).val()
             }
         }).done(function(res){
             console.log(res)
         })
    })
})