$(function(){
var IdUsuarioParaBorrar;
var EmailParaBorrar;
  $("#ConfDenuncia").on("click",function(){
    $("#Denunciar").modal("hide");

    $.ajax({
      url:'php/peticiones/denuncia.php',
      type:'post',
      dataType:'json',
      data:{
        Tipo:"usuario",
        Id:$("#IdAnuncio").val(),
        Causa:$("#causa").val(),
        Desc:$("#desc").val(),
        Email:EmailParaBorrar
        
      },
      success: function(data){
        if(data.Res=="OK"){
          $().toastmessage('showSuccessToast', "Denuncia presentada con éxito.");
        }else{
          $().toastmessage('showErrorToast', "No se ha podido presentar  la denuncia,por favor inténtelo  más tarde.");
        }
      }
    });
  });




$("#Desbloqueo").on("click",function(){

  $.ajax({
    url:'php/peticiones/denuncia.php',
    type:'post',
    dataType:'json',
    data:{
      bloquear:"Desusuario",
      Id:IdUsuarioParaBorrar,
      Email:EmailParaBorrar
    },
    success: function(data){
      if(data.Res=="OK"){
        $().toastmessage('showSuccessToast', "Desbloqueado con éxito. ");
      }else{
        $().toastmessage('showErrorToast', "No se ha podido Desbloquear.");
      }
    }
  });
  });

  $("#ConfBloqueo").on("click",function(){
    $("#Bloqueo").modal("hide");
    $.ajax({
      url:'php/peticiones/denuncia.php',
      type:'post',
      dataType:'json',
      data:{
        bloquear:"usuario",
        Id:IdUsuarioParaBorrar,
        Email:EmailParaBorrar,
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

  function setCookie(cname, cvalue, exdays) {
      var d = new Date();
      d.setTime(d.getTime() + (exdays*24*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }
  function getCookie(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();
  }
  var getUrlParameter = function getUrlParameter(sParam) {
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;
  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');
      if (sParameterName[0] === sParam) {
        return sParameterName[1] === undefined ? true : sParameterName[1];
      }
  }
  };

  var pasar={};
  pasar.funcion = "usuario";
  pasar.Id =getUrlParameter("Id");

  var citiesArr = Conexion("php/peticiones/funciones.php",pasar);

  console.log(citiesArr[0]);

  $("#IdUs").text(citiesArr[0].Nombre);
  $("#EmailUs").text(citiesArr[0].Email);
  if(citiesArr[0].DNI_VF=="1"&&citiesArr[0].Email_VF=="1"){
    $(".NoVerificadoUusarioPerf").remove();
  }else{
    $(".VerificadoUusarioPerf").remove();
  }
  $("#FotoUs").attr("src",(citiesArr[0].Foto!=""?"uploads/usuarios/"+citiesArr[0].Foto:"assets/images/default-user.png"));
  $("#PoblacionUs").text(citiesArr[0].Poblacion);
  $("#CiudadUs").text(citiesArr[0].Ciudad);
  $("#Telefono_1").text(citiesArr[0].Telefono_1);
  $("#Telefono_2").text((citiesArr[0].Telefono_2!=""?citiesArr[0].Telefono_2:"No disponible."));
  $("#IdAnuncio").val(citiesArr[0].Id);
  $(".load1").remove();
   IdUsuarioParaBorrar=citiesArr[0].Id;
   EmailParaBorrar=citiesArr[0].Email;

  pasar={};
  pasar.tipo ="usuario";
  pasar.Id =getUrlParameter("Id");


  buqueda=pasar;
// Fin

  cargarAnuncios(Conexion("php/peticiones/anuncios.php",buqueda));

  $.ajax({
    url:'php/peticiones/funciones.php',
    type:'GET',
    data:{
      funcion:"clasificacion",
      Id:IdUsuarioParaBorrar
    },
    success: function(data){
      if(data=="NO"){
        $(".clasificacion").append("<p>Sin clasificación</p>");
      }else{

        var strella1 = '<i class="far fa-star" style="color: #decc01;"></i>';
        var strella2 = '<i class="fas fa-star" style="color: #decc01;"></i>';
        for(var i=1;i<6 ;i++){
          if(i<=Math.round(data)){
            $(".clasificacion").append(strella2);
          }else{
            $(".clasificacion").append(strella1);
          }
        }


      }

    }
  });

  function cargarAnuncios(anuncios){
    console.log("..................anuncios.....................");
    console.log(anuncios);
    if(anuncios.length <1 ) {
      $(".ContAnuncios").append("<h3 text-center>No se han encontrado Anuncios con estos Datos. :(</h3>");

    }
    $(anuncios).each(function(index,element){

      var anuncio="";

      anuncio += '<div class="col col-md-12 col-sm-12 Anuncio Anuncio2">';
      anuncio += '  <div class="row">';
      anuncio += '    <div class="col col-sm-12">';
      anuncio += '      <div class="row">';
      anuncio += '        <div class="col col-sm-3 fav" data-id="'+element.Id+'">';
      anuncio += '          <!-- Favoritos -->';

      favs = getCookie("favoritos");
      tipoCor="far";
      if(favs != "" && favs !=undefined && favs !=null){
        favs = JSON.parse(favs);
        $(favs).each(function(inndex,elementFor){
          if(parseInt(elementFor.Id)==element.Id){
            tipoCor="fas";
          }
        });
      }else{
      }
      anuncio += '        <i class="'+tipoCor+' fa-heart text-red"></i>';
      anuncio += '        </div>';
      anuncio += '        <div class="col col-sm-9 ">';
      anuncio += '          <div class="row">';
      anuncio += '            <div class="col col-sm-5">';
      anuncio += '              <!-- Ubicacion -->';
      anuncio +=  element.ciudad+"("+element.Poblacion+")";
      anuncio += '            </div>';
      anuncio += '            <div class="col col-sm-5">';
      anuncio += '              <!-- Fecha -->';
      anuncio +=  element.Fecha_modificacion;
      anuncio += '            </div>';
      anuncio += '          </div>';
      anuncio += '        </div>';
      anuncio += '      </div>';
      anuncio += '    </div>';
      anuncio += '    <div class="col col-md-4 col-sm-12  conImag">';
      anuncio += '      <!-- Foto -->';
if(element.Foto!=""){
  anuncio += '      <img src="uploads/anuncios/'+element.foto+'" alt="">';
}else{
  anuncio += '      <img src="assets/images/default.jpg" alt="">';
}
      anuncio += '';
      anuncio += '    </div>';
      anuncio += '    <div class="col col-md-8 col-sm-12">';
      anuncio += '      <div class="row">';
      anuncio += '        <div class="col col-sm-12">';
      anuncio += '          <!-- Titulo -->';
      anuncio += '          <a href="index.php?page=anuncio&Id='+element.Id+'"><h4 class="text-center titulo">'+element.Nombre+'</h4></a>';
      anuncio += '        </div>';
      anuncio += '      <div class="col col-sm-12 Desc">';
      anuncio += '        <!-- Descripcion -->';
      anuncio += '          <h4 class="">'+element.Descripcion+"..."+'</h4>';
      anuncio += '      </div>';
      anuncio += '    </div>';
      anuncio += '  </div>';
      anuncio += '  <div class="col col-sm-12">';
      anuncio += '    <div class="row ">';
      anuncio += '      <div class="col col-sm-12">';
      anuncio += '        <!-- Usuario -->';
      anuncio += '        <div class="col-sm-12 " style="position=absolute;bottom=10px;position:  absolute;bottom:  10px;">';
      anuncio += '          <div class="row"> ';
      anuncio += '            <div class="col col-sm-5 usuario ">';

      var foto="assets/images/default-user.png";
      if(element.fotoUs!=""){
        foto="uploads/usuarios/"+element.fotoUs;
      }

      anuncio += '              <img src="'+foto+'"  alt="">';
      anuncio += '          <div class="row ">';
      anuncio += '            <div class="col col-sm-12 ">';
      anuncio += '              <h6 ><strong>'+element.NombreUs+'</strong></h6>';
      anuncio += '            </div>';
      anuncio += '            <div class="col col-sm-12">';
      anuncio += '              <h6 >'+element.Telf+'</h6>';
      anuncio += '            </div>';
      anuncio += '            </div>';
      if(element.verf=="SI")
      {
        anuncio += '            <span class="usAnVerf"><img src="assets/images/Verificado.png"> <small>Verificado<small></span>';
      }
      else
      {
        anuncio += '            <span class="usAnVerf"><img src="assets/images/NoVerificado.png"> <small> No Verificado<small></span>';
      }
      anuncio += '            </div>';

      anuncio += '      <div class="col col-md-2 col-md-offset-3 FlexCol">';
      anuncio += '        <!-- Precio -->';
      anuncio += '        <div class="text-center "><div class=" padding_0 precioC">'+element.Precio+"€</div>";
      anuncio += '          <a class="btn btn-primary verA" href="index.php?page=anuncio&Id='+element.Id+'"> Ver Anuncio</a>';
      anuncio += '        </div>';
      anuncio += '      </div>';
      anuncio += '    </div>';
      anuncio += '  </div>';
      anuncio += '</div>';
      anuncio += '</div>';


      $(".anuncioosUsuario").append(anuncio);
    });
    $(".load2Imag").remove();

  }


});
