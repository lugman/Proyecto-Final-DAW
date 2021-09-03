$(function(){
  $(".AnuciosModIr li a").on("click",function(){
    var categoriasArr = Conexion("php/peticiones/comprobar_sesion.php");

    if(categoriasArr.Res == "NO"){
        $().toastmessage('showWarningToast', "Porfavor inicie sessión para poder haceder a sus anuncios.");
    }else{
      window.location=$(this).data("sitio");
    }
  });

});
