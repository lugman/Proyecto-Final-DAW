var paso = 1;
var num = 1;
var ciudad="",categoria="",titulo="",descripcion="",cp="";
var imagenes=[];
var Ciudad="Álava";
var Poblacion="";
var ArrImagenes= [];
$("document").ready(function(){
// Ciudades.
  var pasar = {};
  pasar = {};
  pasar.funcion = "ciudades";
  $(".ciudades_paso_1").seleccion(Conexion("php/peticiones/funciones.php",pasar),"all","ciudades_poner_anuncio","cod_ciudad");
// --------------
// cargar categoria Padres.
  pasar = {};
  pasar.funcion = "categorias";
  var categorias = Conexion("php/peticiones/funciones.php",pasar);
categoriaRellenar(categorias);

function  categoriaRellenar(data){
var cat ="";
  cat += '<div class="cat" style="margin-rigth:10px;">';
  cat += '    <div class="categorias_paso_1">';
  cat +='<select  name="cat-'+data[0].Id+'" class="categoriasSelec col-7 form-control" data-num="'+num+'">';
  cat +='  <option value="NO">Todas las categorías</option>';

  // Bucle select.
  for (var i = 0; i < data.length; i++) {

    cat +='  <option value="'+data[i].Id+'">'+data[i].Nombre+'</option>';

  }
  //Fin bucle.
  cat +='</select>';
  cat += '   </div>';
  cat += '</div>';
  cat =$(cat);
  $("#contenedorCategorias").append(cat);
  num++;
}

  // --------------


$("body").on("change",".categoriasSelec",function(event){
  // limpieza div.
  $("body").find(".categoriasSelec").each(function(index,element){
    if(parseInt($(element).data("num")) > parseInt($(event.target).data("num"))){
      $(element).remove();
    }
  });
  // $(event.target).val();
  pasar = {};
  pasar.funcion = "sub_categorias";
  pasar.cat_padre = $(event.target).val();
  var data = Conexion("php/peticiones/funciones.php",pasar);
  if(data.length > 0){
    categoriaRellenar(data);
  }

  $("#contenedorCaracteristicas").empty();
  pasar = {};
  pasar.funcion = "caracteristicas";
  pasar.Id = $(event.target).val();
  var data = Conexion("php/peticiones/funciones.php",pasar);
  if(data.length > 0){
    // $("#contenedorCaracteristicas").html("<h6>características<h6>");

  cargarCaracteristicas(data,1,"","");
  }
});

$("body").on("change",".CarSelcc",function(event){
  // limpieza div.
  $(this).parent().find(".CaracteristicasCont").remove();

  var padre = $(event.target).parent();


  pasar = {};
  pasar.funcion = "sub_caracteristicas";
  pasar.Id = $(event.target).val();

  var data = Conexion("php/peticiones/funciones.php",pasar);

  if(data.length > 0){
    cargarCaracteristicas(data,2,padre,$(event.target).val());
  }
});

// +++++++++++++++++++++++++++++++++Traer sub categorías+++++++++++++++++++++++++++++++++++++++++++++++.

// Cargar características  de la categoría.
function cargarCaracteristicas(datos,mod,cont,catpadre){
  if(datos.length > 0){
    var  medida = 4;
    if(mod!=1){
      medida = 12;
    }

    $(datos).each(function(index,element){
      var carSelect= "";
      carSelect  += '<div class="col col-md-'+medida+' rounded border border-secondary p-2 CaracteristicasCont">';
      carSelect  += '  <label class="text-center " style="display:block; font-weight: bold;" >'+element.Nombre+'</label>';
      carSelect  += '  <select name="car-'+element.select[0].Nombre+'"  class="CarSelcc form-control" data-tipoN="'+element.Nombre+'" data-tipo="'+element.cod_tipo+'">';
      carSelect  += '    <option value="NO" >Todas las características</option>';
      $(element.select).each(function(index2,element2){
        carSelect  += '    <option value="'+element2.Id+'">'+element2.Nombre+'</option>';
      });
      carSelect  += '  </select>';
      carSelect  += '</div>';
      carSelect = $(carSelect);
      if(mod==1){
        $("#contenedorCaracteristicas").append(carSelect);
      }else{
        $(cont).append(carSelect);
      }
    });
  }
}





  //------------ Fin traer Modelos y marcas de las catgorias.----------




  function subcategoria(padre){

    pasar = {};
    pasar.funcion = "sub_categorias";
    pasar.cat_padre = padre;
    // $(".sub_categorias_paso_1").text("");
    // $(".sub2_categorias_paso_1").text("");

    var subCat= Conexion("php/peticiones/funciones.php",pasar);
    if(subCat.length>0){

      $(".sub_categorias_paso_1").seleccion(subCat,"all","categorias_poner_anuncio","cod_sub_categoria");
      pasar = {};
      pasar.funcion = "categorias";
      $(".categorias_paso_1").seleccion(Conexion("php/peticiones/funciones.php",pasar),"all","categorias_poner_anuncio","cod_categoria");

    }else{
      $(".sub_categorias_paso_1").html("No hay subcategorias");
      $(".subText").hide();
      $(".subText2").hide();
    }
  }



// Fin categorias y caracteristicas.

$("#ciudades_poner_anuncio").on("change",function(){
   Ciudad = $(this).find('option:selected').text();
});
$("#poblacion").on("input",function(){
   Poblacion = $(this).val();
});
// ------------------------


  $("#Continuar").on("click",function(){
    switch (paso) {
      case 1:
      if(comprovaciones()){
        ciudad    = $(".ciudades_paso_1").val();
        categoria = $(".categorias_paso_1").val();
        cp = $(".cp_paso_1").val();
        $(".contenedor1").hide();
        $(".contenedor2").show();
        $("#Volver").show();
          paso ++;
      }
      break;
      case 2:
      ciudad    = $(".tit_a").val();
      categoria = $(".desc_a").val();
      $(".contenedor2").hide();
      $(".contenedor3").show();
      paso ++;
      $(this).text("Finalizar");
      previsualizarAnuncio();
      break;
      case 3:
      $("body").append("<div class='block1'></div>");
      $("#form_anuncio").submit();
      $("#Continuar").off();
      break;
    }
  });

function comprovaciones(){
  var comprovaciones = false;
  var poblacion = $("#poblacion");
  var precio = $("#price");
  var nombre = $("#nom");
  var desc = $("#desc");


  if(poblacion.val().length>=3){
    comprovaciones =  true ;
    if(precio.val().length>=1 && parseInt(precio.val())>0 ) {
      comprovaciones =  true ;
      if(nombre.val().length>=8) {
        comprovaciones =  true ;
        if(desc.val().length>=30) {
          if($(".categoriasSelec:first").val() != "NO") {
            comprovaciones =  true ;
          }else{
            $().toastmessage('showWarningToast', "Selecciona una categoría almenos.");
            $("#desc_label").html("Descripción <span style='color:red;'>(demasiada corta)</span>");
            comprovaciones =  false ;
          }
        }else{
          $("#desc_label").html("Descripción <span style='color:red;'>(demasiada corta)</span>");
          comprovaciones =  false ;
        }
      }else{

        $("#nom_label").html("Titulo <span style='color:red;'>(demasiado corto)</span>");
        comprovaciones =  false ;
      }
    }else{
      $("#price_label").css("color","red");
      comprovaciones =  false ;
    }
  }else{
    $("#poblacion_label").css("color","red");
    comprovaciones =  false ;
  }


  return comprovaciones;
}
$("#price").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl/cmd+A
            (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+C
            (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: Ctrl/cmd+X
            (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
        if($(this).val()>0){
          $("#price_label").css("color","black");
        }
    });
$("#nom").on("input",function(){
  if($(this).val().length>=8){
    $("#nom_label").text("Titulo");
  }
});
$("#desc").on("input",function(){
  if($(this).val().length>=30){
    $("#desc_label").text("Titulo");
  }
});
$("#poblacion").on("input",function(){
  if( $(this).val().length >=3 ){
    $("#poblacion_label").css("color","black");
  }
});


  $("#Volver").hide();
  $("#Volver").on("click",function(){
    switch (paso) {
      case 2:
      $(this).hide();
      $(".contenedor2").hide();
      $(".contenedor1").show();
      paso --;
      break;
      case 3:
      $("#Continuar").text("Continuar");
      $(".contenedor3").hide();
      $(".contenedor2").show();
      paso --;
      break;
    }
  });
  });

  // POR BORRAR
  // $("#poner_anuncio").on("click", function() {
  //   var palabras="";
  //
  //   pasar = {};
  //   pasar.funcion = "poner_anuncio";
  //   pasar.nombre = $("#nom").val();
  //   pasar.descripcion  = $("#desc").val();
  //   pasar.adicional = $("#adicional").val();
  //   pasar.precio = $("#price").val();
  //   pasar.categoria = $("#cat2 select").val();
  //   pasar.ciudad = $("#city2 select").val();
  //
  //   var anuncion = Conexion("funciones.php",pasar,"POST");
  //
  // });







function previsualizarAnuncio(){
var imgP ="";
if(ArrImagenes.length > 0){
  imgP=ArrImagenes[0][2];
  // console.log("imagen"+ArrImagenes);
}else{
  imgP="assets/images/Imagen_por_defecto.png";
}


  var anuncio="";






  anuncio += '<div class="col col-md-12 col-sm-12 Anuncio">';

  anuncio += '  <div class="row">';
  anuncio += '    <div class="col col-sm-12">';
  anuncio += '      <div class="row">';
  anuncio += '        <div class="col col-sm-3 fav">';
  anuncio += '          <!-- Favoritos -->';
  tipoCor="far";
  anuncio += '        <i class="'+tipoCor+' fa-heart text-red"></i>';
  anuncio += '        </div>';
  anuncio += '        <div class="col col-sm-9 ">';
  anuncio += '          <div class="row">';
  anuncio += '            <div class="col col-sm-5">';
  anuncio += '              <!-- Ubicacion -->';
  anuncio +=  Ciudad+"("+Poblacion+")";
  anuncio += '            </div>';
  anuncio += '            <div class="col col-sm-5">';
  anuncio += '              <!-- Fecha -->';
  fecha =  new  Date();
  anuncio +=  fecha.getHours()+":"+fecha.getMinutes()+" "+fecha.getDate()+"/"+(fecha.getMonth()+1)+"/"+fecha.getFullYear();
  anuncio += '            </div>';
  anuncio += '          </div>';
  anuncio += '        </div>';
  anuncio += '      </div>';
  anuncio += '    </div>';
  anuncio += '    <div class="col col-md-4 col-sm-12  conImag">';
  anuncio += '      <!-- Foto -->';
  anuncio += '      <img src='+imgP+' alt="">';
  anuncio += '';
  anuncio += '    </div>';
  anuncio += '    <div class="col col-md-8 col-sm-12">';
  anuncio += '      <div class="row">';
  anuncio += '        <div class="col col-sm-12">';
  anuncio += '          <!-- Titulo -->';
  anuncio += '          <a><h4 class="text-center titulo">'+$("#nom").val()+'</h4></a>';
  anuncio += '        </div>';
  anuncio += '      <div class="col col-sm-12 Desc">';
  anuncio += '        <!-- Descripcion -->';
  anuncio += '          <h4 class="">'+$("#desc").val().substr(0,400)+"..."+'</h4>';
  anuncio += '      </div>';
  anuncio += '    </div>';
  anuncio += '  </div>';
  anuncio += '  <div class="col col-sm-12">';
  anuncio += '    <div class="row ">';
  anuncio += '      <div class="col col-sm-12">';
  anuncio += '        <!-- Usuario -->';
  anuncio += '        <div class="col-sm-12 " style="position=absolute;bottom=10px;position:  absolute;bottom:  10px;">';
  anuncio += '          <div class="row"> ';
  anuncio += '            <div class="col col-sm-5 usuario "><a>';

  var foto="assets/images/default-user.png";


  anuncio += '              <img src="'+foto+'"  alt="">';
  anuncio += '          <div class="row ">';
  anuncio += '            <div class="col col-sm-12 ">';
  anuncio += '              <h6 ><strong>'+NombreUsuario+'</strong></h6>';
  anuncio += '            </div>';
  anuncio += '            <div class="col col-sm-12">';
  anuncio += '              <h6 ></h6>';
  anuncio += '            </div></a>';
  anuncio += '            </div>';
  anuncio += '            </div>';

  anuncio += '      <div class="col col-md-2 col-md-offset-3 FlexCol">';
  anuncio += '        <!-- Precio -->';
  anuncio += '        <div class="text-center "><div class=" padding_0 precioC">'+$("#price").val()+"€</div>";
  anuncio += '          <a class="btn btn-primary verA"> Ver Anuncio</a>';
  anuncio += '        </div>';
  anuncio += '      </div>';
  anuncio += '    </div>';
  anuncio += '  </div>';
  anuncio += '</div>';
  anuncio += '</div>';



  $(".ConPrevAnuncio").text("");
  $(".ConPrevAnuncio").append(anuncio);
}


// ++++++++++++++++++++++++++++++Fotos++++++++++++++++++++++++++++++++++++++++++++
$(function(){

  $(".inputFileSubir").on('change',function(event){
    // Escondemos el imput que ha subido la imagen.
      $(this).hide();
    // traemos la imagen.
    var file = event.target.files[0];
      // Se la pasamos a el metodo añadir junto con el elemto imput.

    AñadirImagen(file,$(this));

  });

});


function AñadirImagen(file,inpuFile){
  // Comprovamos que no haya mas de 4 imagenes.
  if((ArrImagenes.length+1)==4){
    $(".poner_foto").append("<h3 class='text-center'>No se pueden subir mas imagenes</h3>");
    }

    var id = ArrImagenes.length;
    $(inpuFile).attr("id","In"+id);

    ArrImagenes.push([id,file,URL.createObjectURL(file),$(inpuFile)]);

  cargarImagenes();
}
function cargarImagenes(){

  $(".imagenes_subidas").html("");
  $(ArrImagenes).each(function(index,element){
    // $(".hiddenInpp"+(index+1)).val(element[3]);

     var HtmlImagen = '';
     HtmlImagen += '<div class="conimagClase">';
     HtmlImagen += '  <img class="imagClase" src="'+element[2]+'"/>';
     HtmlImagen += '  <div class="botones">';
     if(index!=0){
       // HtmlImagen += '    <button type="button" name="button" class="btn btn-info princ"id="'+element[0]+'">Principal</button>';
     }
     // HtmlImagen += '    <button type="button" name="button" class="btn btn-danger borr" id="'+element[0]+'" >Borrar</button>';
     HtmlImagen += '  </div>';
     HtmlImagen += '</div> ';
    var imag = $(HtmlImagen);
    $(".imagenes_subidas").append(imag);

    // $(imag).on("click",".borr",function(){
    //   var id_borrar = $(this).attr("id");
    //   $(".poner_foto h3").remove();
    //
    //   console.log("");
    //   console.log("++++++++++Borar++++++++++++++++");
    //   console.log("Id borrar:" + id_borrar);
    //   console.log("Array:" +ArrImagenes);
    //   console.log("");
    //
    //   $("#In"+id_borrar).show();
    //   $("#In"+id_borrar).val("");
    //
    //   ArrImagenes = Arrayremove(ArrImagenes,id_borrar);
    //   cargarImagenes();
    // });




    $("#BorrarTodas").on("click",function(event){
      event.preventDefault();
      $(".conimagClase").remove();
      $(".inputFileSubir").val("");
      $(".inputFileSubir").show();
      ArrImagenes=[];
    });


    $(imag).on("click",".princ",function(){
      var id_prin = $(this).attr("id");

      console.log("");
      console.log("++++++++++Mover++++++++++++++++");
      console.log("Id mover:" + id_prin);
      console.log("Id 0:" + ArrImagenes[0]);
      console.log("Array:" +ArrImagenes);
      console.log("");

      ArrImagenes = mover(id_prin,ArrImagenes);
      // ArrImagenes = ArrImagenes.move(id_prin, 0);

      cargarImagenes();
    });

  });

}
//
// function Arrayremove(Arrs,id_){
//   var arrayRemplace = [];
//   $(Arrs).each(function (index,element){
//     if(id_!=index){
//       arrayRemplace.push(element);
//     }
//   });
//   return arrayRemplace;
// }


// function mover(identificador, arreglo) {
//   var helpArray =[];
//   $(arreglo).each(function(index,element){
//     if(element[0]==identificador){
//         helpArray.push(element);
//     }
//   });
//   $(arreglo).each(function(index,element){
//     if(element[0]!=identificador){
//       helpArray.push(element);
//     }
//   });
//   return helpArray;
// };













  // Como mostrar imagen sin subi input
  //     var fileName = $file.val().split( '\\' ).pop(),
  //         tmppath = URL.createObjectURL(event.target.files[0]);
