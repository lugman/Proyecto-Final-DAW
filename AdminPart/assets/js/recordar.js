$(function(){
  $("#cambiar").on("click",function(e){
    e.preventDefault();
    if(!$(this).hasClass("disabled")){

    $.ajax({
      url:'php/cambiarContra.php',
      type:'post',
      dataType:'json',
      data:{
        contra:$("#cont").val(),
        token:$("#tok").val(),
        idUser:$("#id").val(),
        Email:$("#email").val()
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Contraseña cambiada con éxito");
          $("body").append("<div class='block1'></div>");
            setTimeout(function(){
              window.location = "index.php?page=entrar";
            }, 2200);
        }else{
          $().toastmessage('showErrorToast', "No se ha podido cambiar la contraseña.");
        }
      }
    });
  }
  });


  $("#recordarButton").one("click",function(){
    $("#recordar").modal("hide");
    $.ajax({
      url:'php/enviarLink.php',
      type:'post',
      dataType:'json',
      data:{
        email:$("#emailRecodar").val()
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Email enviado con éxito.");
        }else{
           $().toastmessage('showErrorToast', "No se ha podido enviar el correo. Compruebe que ha escrito bien el correo.");
        }
      }
    });
  });
});
