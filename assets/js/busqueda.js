var minValor,maxValor,ordenar;
var categoria,caracteristicas,ciudad,poblacion,fecha1,fecha2,palabras;
var tipoUs= "Sin";

var numeroVermas=1;
var arrayMas=[];

$("document").ready(function(){


$(".VerMasAnuncios").on("click",function(){
  pasar={};
  pasar.ides =arrayMas[numeroVermas].toString();
  pasar.tipo ="vermas2";
  pasar.ordenar  = ordenar;
  cargarAnuncios(Conexion("php/peticiones/anuncios.php",pasar));
  numeroVermas++;
  console.log(numeroVermas);
  console.log(arrayMas);
  if(!(arrayMas.length > numeroVermas)){
    $(".VerMasAnuncios").hide();
  }
});

// ----------------------------------------Elementos a Cargar.-------------------------------

    minValor=1;
    maxValor=100000;
    ordenar="Fecha_modificacion";
    categoria="";
    caracteristicas="";
    ciudad="";
    poblacion="";
    fecha1="";
    fecha2="";
    palabras="";


    pasar = {};
    pasar.funcion = "ciudades";
    var citiesArr = Conexion("php/peticiones/funciones.php",pasar);
    $(citiesArr).each(function(index,element){
    var item = "<option value='"+element.Id+"'>"+element.Nombre+"</option>";
    $("#seleccion_cit_busc").append(item);
    });

// Slector Precio.
    $( "#slider-range" ).slider({
      range: true,
      min:1,
      step: 1,
      max:100000,
      values: [ minValor, maxValor ],
      slide: function( event, ui ) {
        $( "#amount" ).val(  ui.values[ 0 ]+ "€"+ " - " + ui.values[ 1 ]+"€" );
        minValor= ui.values[ 0 ];
        maxValor= ui.values[ 1 ];
      }
    });
    $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 )+"€"+
      " - " + $( "#slider-range" ).slider( "values", 1 )+"€" );


// Fechas.
      $( ".calendar" ).datepicker({
            dateFormat: 'dd/mm/yy ',
            firstDay: 1
        });
        $( ".calendar2" ).datepicker({
              dateFormat: 'dd/mm/yy',
              firstDay: 1
          });
        $(document).on('click', '.date-picker .input', function(e){
          var $me = $(this),
          $parent = $me.parents('.date-picker');
          $parent.toggleClass('open');
        });

      $(".filtrarAnuncios,#buscar").on("click",function(){
        $(".ContAnuncios").html('<div class="text-center LoaderGIf"><img src="assets/images/loader.gif" width="110px" alt=""></div>');
        numeroVermas=1;

          ciudad = $("#seleccion_cit_busc").val();
          if(ciudad == "all"){
            ciudad="";
          }
          poblacion = $("#seleccion_Poblacion").val();
          palabras = $("#palabras").val();
          //Categorías
        categoria=[];

        $($(".categoriasSelec").get().reverse()).each(function(index,element) {
          console.log($(element).val());
          if($(element).val()!="NO"){
            categoria.push($(element).val());
            categoria=$(element).val();
            return false;
          }
        });
        if(categoria.length==0){
          categoria="";
        }
        //----
        //Cacarcterísticas
          caracteristicas =[];

           $(".CarSelcc").each(function(index,element){
             if($(element).val()!="NO"){
               caracteristicas.push($(element).val());
             }
           });
           if(caracteristicas.length==0){
             caracteristicas="";
           }
          caracteristicas = caracteristicas;
//--------------------------------------------------

          pasar = {};
          pasar.tipo ="filtrar" ;
          pasar.max = maxValor;
          pasar.min  = minValor;
          pasar.ordenar  = ordenar;

          pasar.categoria=categoria;

          pasar.caracteristicas=caracteristicas;
          pasar.ciudad=ciudad;
          pasar.poblacion=poblacion;
          pasar.fecha1=fecha1;
          pasar.fecha2=fecha2;
          pasar.palabras=palabras;
          console.log(pasar);
          cargarAnuncios(Conexion("php/peticiones/anuncios.php",pasar));
          pasar.tipo ="vermas1" ;
          arrayMas=Conexion("php/peticiones/anuncios.php",pasar);
          if(arrayMas.length < 1 ) {
            $(".ContAnuncios").append("<h3 text-center>No se han encontrado Anuncios con estos Datos. :(</h3>");
            $(".VerMasAnuncios").hide();
          }else{
            console.log("show");
            $(".VerMasAnuncios").show();
          }

          $(".LoaderGIf").remove();

        });
//ordenar
$("#orderType").on("change",function(event){
  ordenar  = $(event.target).val();
});
// $("body").on("change",".categoriasSelec",function(){
//
// });
$("body").on("change",".CarSelcc",function(){
  console.log($('body').find(".CarSelcc").length);

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
    $(self).html('<i class="fas fa-heart text-red"></i>').hide().fadeIn(1000);

  }
});
// -------------------Traer Anuncios---------------------------------.

// Recogida busqueda Pagina Principal
pasar = {};
if(getUrlParameter("args")=="categorias"){
  pasar.tipo ="busqueda_cat" ;
  pasar.categorias  = getUrlParameter("cat");
  categoria = pasar.categorias ;

  $(".categoriasSelec:first").val(categoria);

}else if (getUrlParameter("args")=="busqueda") {
  pasar.tipo ="busqueda" ;
  pasar.palabras = getUrlParameter("pal");
  palabras = pasar.palabras ;
  pasar.categorias  = getUrlParameter("cat");

  categoria = pasar.categorias ;
  pasar.ciudades = getUrlParameter("cit");
  ciudad = pasar.ciudades ;


  $(".categoriasSelec:first").val(categoria);
  $("#seleccion_cit_busc").val(ciudad);
  $("#palabras:first").val(palabras);

}
buqueda=pasar;
// Fin
  cargarAnuncios(Conexion("php/peticiones/anuncios.php",buqueda));

  ciudad = $("#seleccion_cit_busc").val();
  if(ciudad == "all"){
    ciudad="";
  }
  poblacion = $("#seleccion_Poblacion").val();
  palabras = $("#palabras").val();
  //Categorías
categoria=[];

$($(".categoriasSelec").get().reverse()).each(function(index,element) {
  console.log($(element).val());
  if($(element).val()!="NO"){
    categoria.push($(element).val());
    categoria=$(element).val();
    return false;
  }
});
if(categoria.length==0){
  categoria="";
}
//----
//Cacarcterísticas
  caracteristicas =[];

   $(".CarSelcc").each(function(index,element){
     if($(element).val()!="NO"){
       caracteristicas.push($(element).val());
     }
   });
   if(caracteristicas.length==0){
     caracteristicas="";
   }
  caracteristicas = caracteristicas;
  pasar = {};
  pasar.max = maxValor;
  pasar.min  = minValor;
  pasar.ordenar  = ordenar;
  pasar.categoria=categoria;
  pasar.caracteristicas=caracteristicas;
  pasar.ciudad=ciudad;
  pasar.poblacion=poblacion;
  pasar.fecha1=fecha1;
  pasar.fecha2=fecha2;
  pasar.palabras=palabras;
  pasar.tipo ="vermas1" ;

  arrayMas=Conexion("php/peticiones/anuncios.php",pasar);
  console.log("LENG: "+arrayMas.length);
  if(arrayMas.length  <= 1) {
    $(".VerMasAnuncios").hide();
  }

  function cargarAnuncios(anuncios){

    console.log("..................anuncios.....................");
    console.log(anuncios);


    if(anuncios.length <1 ) {
      $(".ContAnuncios").append("<h3 text-center>No se han encontrado Anuncios con estos Datos. :(</h3>");
      $(".LoaderGIf").remove();
    }
    $(anuncios).each(function(index,element){

      var anuncio="";
      var estado="";
      var palabras="";
      switch(element.cod_estado){
        case "1":
        estado="vendido";
        palabras="<strong class='text-red'>Vendido</strong><br>";
        break;
      }

      anuncio += '<div class="col col-md-12 col-sm-12 Anuncio transitionslow '+estado+'">';
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
if(element.foto!=""){
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
      anuncio += '          <a href="index.php?page=anuncio&Id='+element.Id+'"><h4 class="text-center titulo">'+palabras+element.Nombre+'</h4></a>';
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
      anuncio += '            <div class="col col-sm-5 usuario "><a href="index.php?page=usuario&Id='+element.cod_usuario+'">';

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
      anuncio += '            </div></a>';
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

      $(".LoaderGIf").remove();
    });
  }


});
