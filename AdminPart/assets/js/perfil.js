$("document").ready(function(){
  $(".misAnuncios").hide();
  $(".Verificarme").hide();
  $(".anunciosC").hide();
  $(".usuariosC").hide();




$("#confirmDniNum").on("click",function(){
  if($("#inputTextDni").val().length>=8){
    $("#inputFileDni").removeAttr("disabled");
  }
});


$("#inputTextDni").on("input",function(e){
  if(!$("#inputFileDni").is(":disabled")){
    $("#inputFileDni").attr("disabled","true");
  }
});
$("#inputFileDni").on("change",function(){
  if($(this).val()!=""){
    $("#comfirmVerificacionDNI").removeClass("disabled");
  }else{
    $("#comfirmVerificacionDNI").addClass("disabled");
  }
});

$("#comfirmVerificacionDNI").on("click",function(ee){
  console.log(ee);
  if(!$(this).hasClass("disabled")){
    // if( $("#inputFileDni").val()!="" && ($("#inputTextDni").val().length>8) ){
        subirDni();
  //   }else{
  //   alert("Datos no validos! \nComprueve sus datos.");
  // }
}
});



function subirDni(){
  var form = $('#formUser')[0];
  var formulario = new FormData(form);

  $.ajax({
    url: "php/verificar/subir.php",
    method: "POST",
    dataType: "html",
       data: formulario,
       cache: false,
       contentType: false,
       processData: false,
       beforeSend:function(){
         $("body").append("<div class='block1'></div>");
       },
  success:function(data){
        $(".verificarDNIcontainer").empty();
        $(".verificarDNIcontainer").html("<h2 style='color:orange;' class='text-center'>Tu DNI esta en proceso de verificación.</h2>");
  },
  error:function(data){
    console.log(data);
  }
}).done(function(data){
  console.log();
  $("body").find(".block1").remove();
});
}








$(".datoss ").on("click",function(e){
  e.preventDefault();
  $(".datosPerfil").show();
  $(".Verificarme").hide();
  $(".misAnuncios").hide();
  $(".usuariosC").hide();
  $(".anunciosC").hide();
  $(".profile-usermenu .active").removeClass("active");
  console.log($(".profile-usermenu .active"));
  $(this).addClass("active");
});
$(".anuncioss").on("click",function(e){
  e.preventDefault();
  $(".datosPerfil").hide();
  $(".Verificarme").hide();
  $(".misAnuncios").show();
  $(".usuariosC").show();

  $(".profile-usermenu .active").removeClass("active");
  $(this).addClass("active");
});

$(".anunciosA").on("click",function(e){
  e.preventDefault();
  $(".datosPerfil").hide();
  $(".Verificarme").hide();
  $(".anunciosC").show();
  $(".usuariosC").hide();

  $(".profile-usermenu .active").removeClass("active");
  $(this).addClass("active");
});
$(".usuarios").on("click",function(e){
  e.preventDefault();
  $(".datosPerfil").hide();
  $(".Verificarme").hide();
  $(".usuariosC").show();
  $(".anunciosC").hide();

  $(".profile-usermenu .active").removeClass("active");
  $(this).addClass("active");
});

$(".testimonios").on("click",function(e){
  e.preventDefault();
  $(".profile-usermenu .active").removeClass("active");
  $(this).addClass("active");
});


$(".verificarmee ").on("click",function(e){
  e.preventDefault();
  var pasar= {};
  $("#volverAEnviar").hide();
  $(".usuariosC").hide();
  $(".anunciosC").hide();

  pasar.funcion = "nada";
  var estaVerf = Conexion("php/verificar/verf.php");
  if(estaVerf.Estado == "PorVerf"){
    console.log("estaVerf");
    $(".Verificarme").show();
    if(estaVerf.mensaje !=""){
      var texto ="<p class='text-center color-red text-red'><strong>Rechazado: "+estaVerf.mensaje+"</strong><p>";

    }
    $("#mensajeDNI ").html(texto);
  }else{
    console.log("No estaVerf");

    $(".verificarDNIcontainer").empty();
    if(estaVerf.Estado == "EnProcesoV"){
      $(".verificarDNIcontainer").html("<h2 style='color:orange;' class='text-center'>Tu DNI esta en proceso de verificación.</h2>");
    }
    if(estaVerf.Estado == "Verificdo"){
      $(".verificarDNIcontainer").html("<h2 style='color:green;' class='text-center'>Tu DNI a sido Verficado.</h2>");
    }
    $(".Verificarme").show();
  }
  if(estaVerf.EstadoEmail == "Verificdo"){
    $(".verificarEMAILcontainer").html("<h2 style='color:green;' class='text-center'>Tu Correo a sido Verficado.</h2>");
  }else {
    var botton = "<h2 style='color:orange;' class='text-center'>Tu Correo esta Por verificar.</h2>"
     botton =$(botton+'<div class="text-center"><a id="volverAenviar" class="btn btn-success boton " style="width:200px;">Volver a enviar</a></div>');
    botton.on("click","#volverAenviar",function(){
      Conexion("php/verificar/reenviaremail.php");
      $(this).remove();
      $().toastmessage('showSuccessToast', "Correo de verificación enviado");
    });
    $(".verificarEMAILcontainer").html(botton);
  }

  $(".misAnuncios").hide();
  $(".datosPerfil").hide();

  $(".profile-usermenu .active").removeClass("active");
  $(this).addClass("active");
});

  var pasar= {};
  pasar.funcion = "ciudades";
  $(".Ciudad_selec_reg").seleccion(Conexion("php/peticiones/funciones.php",pasar),$(".Ciudad_selec_reg").data("ciudad"),"","cod_ciudad");

// Enviar (Crear Usuario)
  $('#Registrar_Usuario').validator().on('submit', function (e) {
  if (e.isDefaultPrevented()) {} else {
    e.preventDefault();
   var form = $('#Registrar_Usuario')[0];
   var formulario = new FormData(form);

   // form = $('#Registrar_Usuario').serialize();

// Funcion Ajax enviar
// Y comprovaciones y demas acciones
   $.ajax({
       url:"php/peticiones/modificar_usuario.php",
       method: "POST",
       dataType: "html",
          data: formulario,
          cache: false,
          contentType: false,
          processData: false,
       beforeSend: function() {
        // setting a timeout
        $("body").append("<div class='block1'></div>");
    },
     success:function(data){
         $("body").find(".block1").remove();
          if(data.Res=="OK"){
            console.log(data.Res=="OK");
            $().toastmessage('showSuccessToast', "Usuario Modificado con exito.");
          }else if (data.Res=="No"||data.Res=="No") {
            alert("No su ha podido registrar con exito.");
            console.log(data.Res+" "+data.Descripcion);
          }
       },
       error:function(err){
         errorServ(err,"Registro.js: linea 15");
       }
   });
  }

    var foto = $("#Foto").val();
    if (/.(gif|jpeg|jpg|png)$/i.test(foto)){
      // Tamaño en MB
        if($("#Foto").get(0).files[0].size < 1048576*2){
          $("#tam").css("color","black");
        }else {
          $("#tam").css("color","red");
          e.preventDefault();
        }
      }else if (foto=="") {} else {
        $("#tam").css("color","red");
        e.preventDefault();
      }
  });

});
