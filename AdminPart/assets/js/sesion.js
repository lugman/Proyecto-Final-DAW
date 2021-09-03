var NombreUsuario;
function PonerCookie(){
  setCookie('tiendaaviso','1',365);
  document.getElementById("barraaceptacion").style.display="none";
}
$("document").ready(function() {
//Cookies
if(getCookie('tiendaaviso')=="1"){}else{
  document.getElementById("barraaceptacion").style.display="block";
}


  var usuario = $("#Email");
  var recordarCon = $("#RememberMe");
  var contra = $("#Contrasenia");

  // Funciones a cargar:
  comprobar_sesion();


  // contraseña.val(getCookie("contrasenia"));


  // Entrar en cuenta
  $("#Entrar_sesion").on("click", function(event) {
    event.preventDefault();
// Le pasamos usuario, contraseña y si queremos recordar la contraseña.
    entrar(usuario.val(), contra.val(),$(recordarCon).is(':checked'));
  });
  // Salir de la cuenta
  $("#Salir_session span").on("click", function(event) {
    event.preventDefault();
    salir();
  });

  function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
  }


});

// Entrar en cuenta
function entrar(user, contra,recordar) {
  $.ajax({
    url: "php/peticiones/entrar.php",
    type: "POST",
    dataType: "json",
    data: {
      "Email": user,
      "Contrasenia": contra,
      "remember": recordar
    },
    beforeSend: function() {
     // setting a timeout
     $("body").addClass("block1");
 },
    success:function(data){
      $("body").removeClass('block1');
      if (data.Res == "OK") {

        $().toastmessage('showSuccessToast', "Inicio de sesión correcto.");
        $('.ErrLogin').addClass('hidden');
        $("body").append("<div class='block1'></div>");
          setTimeout(function(){
            window.location="index.php";
          }, 500);

      } else if (data.Res == "NO") {
        $('.ErrLogin').removeClass('hidden');
        }
        else if (data.Res == "Bloq"){
          $().toastmessage('showErrorToast', "Esta cuenta esta bloqueada.");
          $().toastmessage('showWarningToast', "contacte con inforeofertas@gmail.com.");
        }
      comprobar_sesion();
    },
    error: function(err) {
      console.error("Respuesta entrar");
      errorServ(err, "Entar.js: entrar()");
    }
  });
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
// Salir de cuenta
function salir() {
  $.ajax({
    url: "php/peticiones/salir.php",
    type: "POST",
    dataType: "json",
    beforeSend: function() {
     // setting a timeout
     $("body").addClass("block1");
   },
    success:function(data){
    $("body").removeClass("block1");
      if (data.Res == "OK") {
        $().toastmessage('showSuccessToast', "Sesión cerrada con exito.");
        window.location = "index.php";
        comprobar_sesion();
      } else {
        $().toastmessage('showErrorToast', "No se ha podido cerrar sesión vuelva intentarlo.");
        console.error("No se ha podido cerrar session...");
      }
    },
    error: function(err) {
      errorServ(err, "Entar.js: salir()");
    }
  });
}


// Saber si esta la session iniciada
function comprobar_sesion() {
  console.log("Comprobar login");
  $.ajax({
    url: "php/peticiones/comprobar_sesion.php",
    type: "POST",
    dataType: "json",
    success: function(data) {
      if (data.Res == "OK") {
        NombreUsuario = data.Nombre;
      }
    },
    error: function(err) {
      console.log("Error sucedido en la peticion ajax, Funcion que falla comprobar_sesion()");
      errorServ(err, "sesion.js: comprobar_sesion()");
    }
  });
}
