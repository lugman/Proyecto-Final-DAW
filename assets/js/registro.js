$("document").ready(function(){
  var pasar= {};
  pasar.funcion = "ciudades";
  $(".Ciudad_selec_reg").seleccion(Conexion("php/peticiones/funciones.php",pasar),"all","ciudades_poner_anuncio","cod_ciudad");

// Enviar (Crear Usuario)
  $('#Registrar_Usuario').validator().on('submit', function (e) {
    if(!$("#terminos").is(":checked")){
      e.preventDefault();
      $().toastmessage('showErrorToast', "Acepte los terminos y condiciones.");
    }else {

      if (e.isDefaultPrevented()) {} else if($("#terminos").is(":checked")){

   e.preventDefault();
   var form = $('#Registrar_Usuario')[0];
   var formulario = new FormData(form);
// Funcion Ajax enviar
// Y comprovaciones y demas acciones
   $.ajax({
       url:"php/peticiones/registrar.php",
       type:"post",
       enctype: 'multipart/form-data',
       processData: false,
       contentType: false,
       dataType: "json",
       data:formulario,
       beforeSend: function() {
        // setting a timeout
        $("body").append("<div class='block1'></div>");
    },
       success:function(data){
         $("body").find(".block1").remove();
          if(data.Res=="OK"){
            $().toastmessage('showSuccessToast', "Usuario Registrado con exito.");
              setTimeout(function(){
                window.location="index.php";
              }, 2200);
          }else if (data.Res=="No"||data.Res=="No") {
           $().toastmessage('showErrorToast', "error no se ha podido Registrar con exito");
            alert("No su ha podido registrar con exito.");
            console.log(data.Res+" "+data.Descripcion);
          }
       },
       error:function(err){
         errorServ(err,"Registro.js: linea 15");
       }
   });
  }
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

  $("#Email").on("change",function(){
    $.ajax({
        url:"php/peticiones/comprobar_usuario.php",
        dataType: "json",
        type: "POST",
        data: {
          "Email": $(this).val()
        },
        success:function(data){

          if(data.Res!="ERROR"){
            if (data.Res=="Existe") {
              $(".userr").text("Usuario ya existe");
              $('#reg').attr("disabled","true");
              $(".userr").addClass("text-red");
            }else if (data.Res=="NoExiste") {
              $(".userr").addClass("colorGreen");
              $(".userr").removeClass("text-red");
              $(".userr").text("Usuario disponible");
              $('#reg').removeAttr("disabled");
            }
          }else {
            console.error(data);
          }
        },
        error:function(err){
          errorServ(err,"Registro.js: linea 50");
        }
    });
  });
});
