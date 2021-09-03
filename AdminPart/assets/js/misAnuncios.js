var pasar={};
var anunciosArr=[];
$(document).ready(function(){
console.log("-------------------Fecha-------------------");
var x;
var m_names = new Array("January", "February", "March",
    "April", "May", "June", "July", "August", "September",
    "October", "November", "December");

var d = new Date();
var twoDaysAgo = d.getDate()+2;  //change day here
var curr_month = d.getMonth();
var curr_year = d.getFullYear();
var x = twoDaysAgo+"-"+(++curr_month)+ "-"+curr_year;
var d = new Date();
$("#tiempo2").text(x);
var twoDaysAgo = d.getDate()+4;  //change day here
var curr_month = d.getMonth();
var curr_year = d.getFullYear();
var x = twoDaysAgo+"-"+(++curr_month)+ "-"+curr_year;
$("#tiempo").text(x);
console.log(x);

  $("body").on("change",".inputFileSubir",function(event){
    //
    $(event.target).prevUntil('span').text($(this).val());
     console.log("sapnnn");
     // console.log(  $(event.target).get(0).prev());
    });


  $("body").on("click","#GuardarCambios",function(){
    if($(".TituloMod").val().length>=8) {
      if($(".DescrMod").val().length>=30) {
        modificarAnuncio();
      }
      else{
          $().toastmessage('showWarningToast', "Descripción muy corta.");
      }
    }else{
        $().toastmessage('showWarningToast', "Titulo muy corto.");
    }
  });
  function modificarAnuncio(){
    var form = $('#formMod')[0];
    var formulario = new FormData(form);

    $.ajax({
      url: "php/peticiones/modAnuncio.php",
      method: "POST",
      dataType: "html",
         data: formulario,
         cache: false,
         contentType: false,
         processData: false,
         dataType:"json",
         beforeSend:function(){
           $("body").append("<div class='block1'></div>");
         },
    success:function(data){
      if(data.Res == "OK"){
          $().toastmessage('showSuccessToast', "Modificado con éxito");
          $(".ContMod *").remove();
          cargarMios();

      }else{
        $().toastmessage('showWarningToast', "No se pudo modificar!.");
      }
    },
    error:function(data){
      console.log(data);
    }
  }).done(function(data){
    console.log();
    $("body").find(".block1").remove();
  });
  }

  function destacarAnuncio(element){
    // console.log(anuncio);
    console.log(element.Id);

    $(".destacarContainer").removeClass("hide");
    $(".nombreAnunDest").text(element.Nombre);
    $(".customAnuncio").val(element.Id);
  }


  function editarAnuncio(element,self){
  $(".ContMod *").remove();
  $(".containerBorraContainer.container").removeClass("containerBorraContainer container");


  var anuncio="";

  anuncio += ' <form id="formMod">';
  anuncio += '<input type="hidden" name="Id"  value="'+element.Id+'">';
  anuncio += '  <div class="row ">';
  anuncio += '    <div class="col col-md-12 BotA">';
  anuncio += '     <a class="btn btn-info botonesE " id="GuardarCambios" data-id="'+element.Id+'" >Guardar</a>';
  anuncio += '     <a class="btn btn-danger  CancelarAnuncio " data-id="'+element.Id+'">Cancelar</a>';
  anuncio += '    </div>';
  anuncio += '  </div>';
  anuncio += '<div class="col col-md-12 col-sm-12 Anuncio ModAnuncio">';
  anuncio += '  <div class="row">';
  anuncio += '      <div class="row">';
  anuncio += '        <div class="col col-sm-3 fav">';
  anuncio += '          <!-- Favoritos -->';
  anuncio += '        </div>';
  anuncio += '        <div class="col col-sm-9 ">';
  anuncio += '          <div class="row">';
  anuncio += '            <div class="col col-sm-7">';
  anuncio += '              <!-- Ubicacion -->';
  anuncio += '         <select name="ciudad" class="form-control inputAjustado">';


  pasar = {};
  pasar.funcion = "ciudades";
  var citiesArr = Conexion("php/peticiones/funciones.php",pasar);








  console.log("edit--------");
  console.log(element);
  $(citiesArr).each(function(index,element1){
      if(element.ciudad==element1.Nombre){
        var item = "<option value='"+element1.Id+"' selected >"+element1.Nombre+"</option>";
      }else{
        var item = "<option value='"+element1.Id+"'>"+element1.Nombre+"</option>";
      }
      anuncio+=item;
  });


    anuncio += '    </select>';
    anuncio +='(<input value="'+element.Poblacion+'" maxlength="60" placeholder="Población"  name="poblacion" class="form-control text-center inputAjustado">)';
    anuncio += '            </div>';
    anuncio += '            <div class="col col-sm-5">';
    anuncio += '              <!-- Fecha -->';
    anuncio +=  element.Fecha_modificacion;
    anuncio += '            </div>';
    anuncio += '          </div>';
    anuncio += '        </div>';
    anuncio += '      </div>';
    anuncio += '    </div>';
    anuncio += '    <div class="col col-sm-4  conImag ">';
    anuncio += '      <!-- Foto -->';
    anuncio += '   <div class="row" >';
    pasar.funcion = "imagenes";
    pasar.Id = element.Id;
    var Fotos = Conexion("php/peticiones/funciones.php",pasar);
    anuncio += '   <div class="col col-sm-12 col-md-12" >';
    anuncio += '      <img src="'+(Fotos[0]!=undefined?"uploads/anuncios/"+Fotos[0]:"assets/images/default.jpg")+'" alt="">';
    anuncio += '   </div>';
    anuncio += '   <div class="col col-sm-12 col-md-12" >';

    anuncio += ' <span>'+(Fotos[0]!=undefined?Fotos[0]:"Actualmente Sin foto")+'</span>'+
    '<input type="hidden" name="anterior1" value="'+(Fotos[0]!=undefined?Fotos[0]:"")+'">'+
    '<input type="file" name="imagen1"  data-identificador="" accept=".jpg, .jpeg, .png, .gif" class="form-control inputFileSubir" value="">';

    anuncio += ' <span>'+(Fotos[1]!=undefined?Fotos[1]:"Actualmente Sin foto")+'</span>'+
    '<input type="hidden" name="anterior2"  value="'+(Fotos[1]!=undefined?Fotos[1]:"")+'">'+
    '<input type="file" name="imagen2"  data-identificador="" accept=".jpg, .jpeg, .png, .gif" class="form-control inputFileSubir" value="">';

    anuncio += ' <span>'+(Fotos[2]!=undefined?Fotos[2]:"Actualmente Sin foto")+'</span>'+
    '<input type="hidden" name="anterior3"  value="'+(Fotos[2]!=undefined?Fotos[2]:"")+'">'+
    '<input type="file" name="imagen3"  data-identificador="" accept=".jpg, .jpeg, .png, .gif" class="form-control inputFileSubir" value="">';

    anuncio += ' <span>'+(Fotos[3]!=undefined?Fotos[3]:"Actualmente Sin foto")+'</span>'+
    '<input type="hidden" name="anterior4"  value="'+(Fotos[3]!=undefined?Fotos[3]:"")+'">'+
    '<input type="file" name="imagen4"  data-identificador="" accept=".jpg, .jpeg, .png, .gif" class="form-control inputFileSubir" value="">';

    anuncio += '   </div>';
    anuncio += '   </div>';
    anuncio += '';
    anuncio += '    </div>';
    anuncio += '    <div class="col col-sm-8">';
    anuncio += '    <div class="col col-sm-12">';
    anuncio += '      <div class="row">';
    anuncio += '        <div class="col col-sm-12">';
    anuncio += '          <!-- Titulo -->';
    anuncio += '          <input value="'+element.Nombre+'"min="8" placeholder="Titulo" maxlength="90" name="titulo" class="form-control text-center TituloMod">';
    anuncio += '        </div>';
    anuncio += '      <div class="col col-sm-12 Desc">';
    anuncio += '        <!-- Descripcion -->';
    anuncio += '          <textarea  name="descripcion" placeholder="Descripción"  maxlength="800"  rows="8" class="form-control DescrMod">'+element.Descripcion+'</textarea>';
    anuncio += '      </div>';
    anuncio += '      <div class="col col-sm-12 Desc">';
    anuncio += '        <!-- Descripcion -->';
    anuncio += '          <textarea name="extra" placeholder="Extra"  maxlength="149" class="form-control">'+element.Extra+'</textarea>';
    anuncio += '      </div>';
    anuncio += '    </div>';
    anuncio += '  </div>';
    anuncio += '  <div class="col col-sm-12">';
    anuncio += '    <div class="row">';
    anuncio += '      <div class="col col-sm-3 ">';
    anuncio += '        <!-- Precio -->';
    anuncio += '          <input type="number" value="'+element.Precio+'" name="precio" min="1" max="999999" name="precio" id="modPrecio" placeholder="€" class="form-control text-center padding_10">';
    anuncio += '        </div>';
    anuncio += '    </div>';
    anuncio += '  </div>';
    anuncio += '</div>';
    anuncio += '</div>';
    anuncio += '</form>';
    var anuncio =$(anuncio);

  $(anuncio).on("click",".CancelarAnuncio",function(){
    // cargarUno($(self));
    $(".ContMod *").remove();
  });
  console.log(self);
  // $(self).replaceWith(anuncio);

  $(".ContMod").append(anuncio);
  }




    function cargarMios(){
      pasar.tipo ="misAnuncios";
      anunciosArr = Conexion("php/peticiones/anuncios.php",pasar);
      console.log("anunciosArr.length_:"+anunciosArr.length);
      $(".UltimoAnuncio").empty();
      $(anunciosArr).each(function(index,element){
              cargarUno(element);
      });
      if(anunciosArr.length==0){
          $(".UltimoAnuncio").append("<h3 class='text-center padding_10'>No dispone de anuncios</h3>");
      }
    }
    function cargarUno(element){

           anuncio="";


           anuncio += '  <div class="row ">';
           anuncio += '    <div class="col col-md-12 BotA">';
           var estado="";
           var palabras="";
           var membresia=false;
           switch(element.cod_estado){
             case "1":
             estado="vendido";
             break;
             case "3":
             estado="bloqueado";
             palabras="<strong class='text-white'>Anuncio bloqueado</strong>";
             break;
             // case "4":
             // estado="Vendido";
             // break;
           }
           if (element.membresia==2 || element.membresia==3) {
             membresia=true;
           }
           console.log(element.Nombre);
           console.log(estado);
           if(estado!="bloqueado"){

             if((membresia==false)){
               if(estado!="vendido"){
               anuncio += '     <a  style="width:250px; margin-right:20px;" class="btn btn-warning  botonesE DestacarAnuncio" data-id="'+element.Id+'">⭐ Destacar ⭐</a>';
             }
            }
             anuncio +=  (estado!="vendido"?'<a class="btn btn-info  botonesE EditarMiAnuncio" data-id="'+element.Id+'">Editar</a>':"");
             anuncio +=  '      <div class="dropdown ">';
             anuncio +=  '        <button class="btn btn-info  botonesE  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
             anuncio +=  '          Cambiar de estado <i class="fas fa-angle-down  hidden-xs" ></i>';
             anuncio +=  '        </button>';
             anuncio +=  '        <div class="dropdown-menu " style="text-align:center;" aria-labelledby="dropdownMenuButton">';
             anuncio +=  (estado!="vendido"?'          <a class="dropdown-item "><a class="btn btn-danger  botonesE VenderMiAnuncio"  data-id="'+element.Id+'" >Vendido</a></a>':"");
             anuncio +=  '          <a class="dropdown-item "><a class="btn btn-danger  botonesE BorrarMiAnuncio"  data-id="'+element.Id+'" >Borrar</a></a>';
             anuncio +=  '        </div>';
             anuncio +=  '      </div>';
             anuncio += '    </div>';
             anuncio += '  </div>';
           }
           console.log(element.Nombre);
           console.log(estado);

           anuncio += '<div class="col col-md-12 col-sm-12 Anuncio  '+estado+'">';
           anuncio += '  <div class="row">';
           anuncio += '    <div class="col col-sm-12">';
           anuncio += '      <div class="row">';
           anuncio += '        <div class="col col-sm-3 fav" data-id="'+element.Id+'">';
           anuncio += '          <!-- Favoritos -->';


           anuncio += '        </div>';
           anuncio += '        <div class="col col-sm-9 ">';
           anuncio += palabras;
           anuncio += '          <div class="row">';
           anuncio += '            <div class="col col-sm-5">';
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
           anuncio += (membresia?'<p class="text-center">⭐ DESTACADO ⭐<p/>':"");
           anuncio += (estado=="vendido"?'<h3 class="text-center text-green"> Vendido <h3/>':"");
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
           anuncio += '            <div class="col col-sm-5 usuario '+estado+'">';

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
          anuncio = $(anuncio);
          $(anuncio).on("click",".EditarMiAnuncio",function(){
            editarAnuncio(element,anuncio);

          $('html, body').animate({
              scrollTop: $(".ContMod").offset().top
          }, 500);


          });
          $(anuncio).find(".BorrarMiAnuncio").click(function(event){
            console.log("click");
            if(confirm("¿Seguro que quiere borrar este anuncio?")){
              pasar = {};
              pasar.modo = "anuncio";
              pasar.Id = $(this).data("id");
              pasar.tipo = "borrar";
              var res = Conexion("php/peticiones/estados.php",pasar,"POST");
              if(res.Res=="OK"){
                $(anuncio).remove();
                $().toastmessage('showSuccessToast', "Borrado con éxito.");
                setTimeout(function(){ location.reload(); }, 500);


              }else{
                $().toastmessage('showWarningToast', "Error al borar!");
              }
            }
          });
          $(anuncio).on("click",".VenderMiAnuncio",function(event){
            // $().remove()
            if(confirm("¿Seguro que quiere cambiar el estado a vendido?")){
              pasar = {};
              pasar.modo = "anuncio";
              pasar.Id = $(this).data("id");
              pasar.tipo = "vender";
              var res = Conexion("php/peticiones/estados.php",pasar,"POST");
              if(res.Res=="OK"){

                $().toastmessage('showSuccessToast', "Cambiado de estado a vendido.");
                  setTimeout(function(){ location.reload(); }, 500);

              }else{
                $().toastmessage('showWarningToast', "Error al borar!");
                // location.reload();
              }
            }
          });

        $(anuncio).on("click",".DestacarAnuncio",function(event){
          destacarAnuncio(element);
            $('html, body').animate({
              scrollTop: $(".destacarContainer").offset().top
            }, 300);

          });
      $(".UltimoAnuncio").append(anuncio);
    }

cargarMios(anunciosArr);



});
