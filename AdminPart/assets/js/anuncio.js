$(function() {
  $('.banner').unslider({
     autoplay: false,
     arrows: {
	      //  Unslider default behaviour
	  prev: '<a class="unslider-arrow prev btn font35 rightBut"><i class="fas fa-arrow-alt-circle-left"></i></a>',
	  next: '<a class="unslider-arrow next btn font35 leftBut"><i class="fas fa-arrow-alt-circle-right"></i></a>'
  }
  });


  $("#ConfBloqueo").on("click",function(){
    $("#Bloqueo").modal("hide");
    $.ajax({
      url:'php/peticiones/denuncia.php',
      type:'post',
      dataType:'json',
      data:{
        bloquear:"anuncio",
        Id:$("#IdAnuncio").val(),
        Email:$("#EmailUsuario").val(),
        Desc:$("#descBloq").val()
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Bloqueado con éxito. ");
        }else{
          $().toastmessage('showErrorToast', "No se ha podido Bloquear.");
        }
      }
    });
  });

  $("#ConfDenuncia").on("click",function(){
    $("#Denunciar").modal("hide");
    $.ajax({
      url:'php/peticiones/denuncia.php',
      type:'post',
      dataType:'json',
      data:{
        Tipo:"anuncio",
        Id:$("#IdAnuncio").val(),
        Email:$("#EmailUsuario").val(),
        Causa:$("#causa").val(),
        Desc:$("#desc").val()
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Denuncia presentada con éxito. ");
        }else{
          $().toastmessage('showErrorToast', "No se ha podido presentar  la denuncia,por favor inténtelo  más tarde.");
        }
      }
    });
  });

$("#GuardarClasificacion").on("click",function(){
  var valor =$(".stars input[name='star']:checked").val();
  if(valor!=undefined){
    $.ajax({
      url:'php/peticiones/comentarios.php',
      type:'post',
      dataType:'json',
      data:{
        Id:$("#IdAnuncio").val(),
        val:valor
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Valoración completada. ");
        }
      }
    });
  }else{
    $().toastmessage('showWarningToast', "No se ha seleccionado clasificación.");
  }
});
$("#Comentar").on("click",function(){
  var valor =$(".commentarioTEXT").val();
  if(valor.length > 5){
    $.ajax({
      url:'php/peticiones/comentarios.php',
      type:'post',
      dataType:'json',
      data:{
        Id:$("#IdAnuncio").val(),
        comment:valor
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Valoración completada. ");
        }
      }
    });
  }else{
    $().toastmessage('showWarningToast', "Demasiado corto.");
  }
});



});
