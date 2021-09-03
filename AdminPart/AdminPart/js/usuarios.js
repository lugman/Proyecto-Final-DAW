$(document).ready(function() {
  var id=undefined;
    $('#example').DataTable( {
        "ajax": "php/usuarios.php"
    });

    $('#example tbody').on( 'click', 'tr', function () {
      $('#example').find("tr").removeClass('selected');
       $(this).toggleClass('selected');
       id=$(this).find("td:first").text();
     });

     $("#VerUs").on("click",function(){
       if(id==undefined){
         alert("No has seleccionado usuario");
       }else{
         window.open("http://reofertas.esy.es/index.php?page=usuario&Id="+id,'_blank');
       }
     });
     $("#BorrarUs").on("click",function(){
       if(id==undefined){
         alert("No has seleccionado usuario");
       }else{
         if(confirm("¿Seguro que desea eliminar este usuario?")){
           $.ajax({
             url:"php/borraUsuario.php",
             type:"POST",
             dataType:"json",
             data:{
               id:id
             },
             success:function(data){
                 alert(data.Res+": "+data.Desc);
                 if(data.Res=="OK"){
                   window.reload();
                 }
             }
           });
         }
       }
     });
} );
