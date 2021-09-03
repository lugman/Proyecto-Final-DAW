var minValor,maxValor,ordenar;

$("document").ready(function(){


$(".filtrarAnuncios2").on("click",function(){
          $(".ContAnuncios").text("");
          ordenar = $("#orderType2").val();

          pasar.favs=ides;
          pasar.order=ordenar;
          pasar.tipo="favoritos";
          cargarAnuncios(Conexion("php/peticiones/anuncios.php",pasar));
  });
  $(".Limpiar").on("click",function(){
    setCookie('favoritos',"",0);
    location.reload();
  });

//ordenar
$("#orderType").on("change",function(event){
  ordenar  = $(event.target).val();
});
$("body").on("change",".categoriasSelec",function(){
  categoria=[];

$($(".categoriasSelec").get().reverse()).each(function(index,element) {
  if($(element).val()!="NO"){
    categoria.push($(element).val());
    console.log($(element).val());
    categoria=$(element).val();
    return false;
  }
});
if(categoria.length==0){
  categoria="";
}
});
$("body").on("change",".CarSelcc",function(){
  console.log($('body').find(".CarSelcc").length);
  caracteristicas =[];

     $(".CarSelcc").each(function(index,element){
       if($(element).val()!="NO"){
         caracteristicas.push($(element).val());
       }
     });
       caracteristicas = caracteristicas;
});
// ------------------------Eventos------------------------------------..

//
$(".calendar").on("change",function(){
  var $me = $(this),
      $selected = $me.val(),
      $parent = $me.parents('.date-picker');
      fecha1=$.datepicker.formatDate( "yy-mm-dd", $me.datepicker( "getDate" ))+" 00:00:00";
      $parent.toggleClass('open');
      $parent.find('.result').children('span').html($selected);
});
$(".calendar2").on("change",function(){
  var $me = $(this),
      $selected = $me.val(),
      $parent = $me.parents('.date-picker');
      fecha2=$.datepicker.formatDate( "yy-mm-dd", $me.datepicker( "getDate" ))+" 23:00:00";

      $parent.toggleClass('open');
      $parent.find('.result').children('span').html($selected);
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
//----------------Traer parametros-----------------------------
var anuncios = getCookie("favoritos");
var pasar ={};
if(anuncios != "" && anuncios !=undefined && anuncios !=null){
  var ides ="";
  $(JSON.parse(anuncios)).each(function(index,element){
    if(index>0){
      ides+=","+element.Id;
    }else{
      ides+=element.Id;
    }
  });
    pasar.favs=ides;
    pasar.order="Fecha_modificacion";
    pasar.tipo="favoritos";
    cargarAnuncios(Conexion("php/peticiones/anuncios.php",pasar));
}


// -------------------Traer Anuncios---------------------------------.

var favs = getCookie("favoritos");
$("body").on("click",".fav[data-id]",function(event){
   favs = getCookie("favoritos");

  var self = $(this);


  console.log(favs);
  if(favs != "" && favs !=undefined && favs !=null){
    favs = JSON.parse(favs);
    favs2 =[];
    var ex = false;
    $(favs).each(function(inndex,element){
      console.log($(self).data("id")==element.Id);

      if(parseInt($(self).data("id"))==element.Id){
        ex=true;
        $(self).html('<i class="far fa-heart text-red"></i>').hide().fadeIn(1000);

      }else{
        favs2.push(element);
      }
    });
    if(ex==false){
      $(self).html('<i class="fas fa-heart text-red"></i>').hide().fadeIn(1000);

      favs2.push({"Id":$(self).data("id")});
    }
    setCookie('favoritos',JSON.stringify(favs2),25);
  }else{
    var arr=[];
    arr.push({"Id":$(this).data("id")});
    setCookie('favoritos',JSON.stringify(arr),25);
  }
});

  function cargarAnuncios(anuncios){

    if(anuncios.length > 0 ) {

      $(anuncios).each(function(index,element){
        var anuncio="";

        anuncio += '<div class="col col-md-12 col-sm-12 Anuncio">';
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
        anuncio += '  <div class="col col-sm-12 usRow">';
        anuncio += '    <div class="row ">';
        anuncio += '      <div class="col col-sm-12">';
        anuncio += '        <!-- Usuario -->';
        anuncio += '        <div class="col-sm-12 " style="position=absolute;bottom=10px;position:  absolute;bottom:  10px;">';
        anuncio += '          <div class="row"><a href="index.php?page=usuario&Id='+element.cod_usuario+'"> ';
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
        anuncio += '            </a></div>';
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



      $(".ContAnuncios").append(anuncio);
    });
  }else{

    $(".ContAnuncios").append("<h3 text-center>No se han encontrado Anuncios con estos Datos :(</h3>");
  }

}
});
