$(function() {
  $("#EnviarContcato").one("click",function(){
    if(comp()){
    $.ajax({
      url:'php/peticiones/contacto.php',
      type:'post',
      dataType:'json',
      data:{
        Nombre:$("#fname").val(),
        Apellidos:$("#lname").val(),
        Titulo:$("#email").val(),
        Descripcion:$("#message").val()
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Mensaje Enviado. ");
        }
      }
    });
  }
  });
  function comp(){
    var comp=true;
    if(!(($("#fname").val().length > 2)&&($("#email").val().length>3)&&($("#message").val().length>6))){
      comp=false;
    }
    if(comp){
      return true
    }else{
      $().toastmessage('showErrorToast', "Por favor rellena los datos del formulario.");
      return false;
    }
  }


});
