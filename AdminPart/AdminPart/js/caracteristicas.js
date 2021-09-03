$(function(){
  var num = 1;
  var caracteristicas = [];
  var caracteristicasInMod = [];
  var cat="";
  var borrarElementos=[];
  var modificarElementos=[];
  var padreCar="";
  var  currentCategory;



  // Ver subcategorías .
  $("body").on("click",".verSubcategorias",function(event){
    // Accciones necesarias.
    var  numeroElemnto = $(this).data("num");
    //Eliminamos las categorias descendientes de la  seleccionada.
    $(".CategoriaClass").each(function(index,element){
      var currentNum = $(element).data("num");
      if(parseInt(currentNum) > parseInt(numeroElemnto)){
        $(element).remove();
      }
    });

    if($(this).parent().parent().find("select").val()!="NO"){
      $.ajax({
        url:"php/funciones.php",
        dataType:"json",
        data: {
          get_function: "traer_sub_categorias",
          Id:$(this).parent().parent().find("select").val()
        },
        success:function(data){
          console.log(data);
          if(data.length > 0 ){
            subcategoria_mostrar(data);
          }
        },
        error:function(){
          alert("Se ha producido un error en el servidor!,Es mejor que dejes lo que estas haciendo para otro momento.");
        }
      });
    }
  });
  // ---------------Fin ver categorías-------------------.

  //Cuando seleccionamos una  categoría.
  $("body").on("change",".CategoSelec",function(event){
    currentCategory = $(this).parent().parent().find("select").val();
    $.ajax({
      url:"php/funciones_car.php",
      dataType:"json",
      data: {
        get_function: "traer_caracteristicas",
        Id:currentCategory
      },
      success:function(data){
        console.log(data);
        $(".ContenedorCaracteristicas").empty();
        cargarCaracteristicas(data,1,"","");
      },
      error:function(){
        alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
      }
    });

    // Accciones necesarias.
    var  numeroElemnto = $(this).data("num");
    $(".CategoriaClass").each(function(index,element){
      var currentNum = $(element).data("num");
      if(parseInt(currentNum) > parseInt(numeroElemnto)){
        $(element).remove();
      }
    });
  });




  //Abrimos el modal de modificar característica.
  $("body").on("click",".ModificarCaracteristica",function(event){
    // Acciones necesarias.
    $("#EditElements").text("");
    $("#newsElements").empty();
    $("#inlineFormInput3").val("");
    caracteristicas=[];
    caracteristicasInMod=[];
    borrarElementos=[];

    //Ponemos el nombre del padre al que hacemos referencia.
    $("#cat_pad3").text($(event.target).data("nombre"));
    //Pnemos  en ei imput el tipo del que se trata.
    $("#ModificarCarac").val($(event.target).data("nombre"));

    //Ponemos en la variable la categoría padre del que se abre esta caracteristíca.
    padreCar=$(event.target).data("catpadre");
    console.log("padreCar:");
    console.log(padreCar);
    //ponemos la variable la caracteristíca de la que desciende.
    cat=$(event.target).parent().parent().find("select").val();
    //Abrimos el modal
    $('#ModificarrModal').modal('show');


    //Seleccionamos el primer elemento  que no sea no seleccionado para sacar el tipo del que son.
    $(event.target).parent().parent().find("select:first option").each(function(index,element){
      // console.log($(element).text());
      if($(element).val()!="NO"){
        caracteristicas.push([$(element).text(),$(element).val()]);
      }
    });

    //Rellenamos los imputs con las opciones del select de caracteritícas.
    $(caracteristicas).each(function(index,element){
      console.log($("#EditElements"));
      $("#EditElements").append("<li><input value='"+element[0]+"' data-itemVal='"+element[1]+"'/>  <a class='btn btn-danger borrCaracItem' data-itemVal='"+element[1]+"' >borrar</a></li> ");
    });

    //Rellenamos el autocomplete
    $.ajax({
      url:"php/funciones.php",
      type:"GET",
      dataType:"json",
      data:{
        get_function: "traer_tipos",
      },
      success:function(data){
        if(data.length>0){
          autocomplete(document.getElementById("ModificarCarac"), data);
        }
      }
    });
    //fin auto.
  });


  // Añadimos elementos a la lista de borrar esperando que se confirmen o se cancele.
  $("body").on("click",".borrCaracItem",function(event){
    borrarElementos.push($(event.target).data("itemval"));
    console.log(borrarElementos);
    $(event.target).parent().remove();
  });

  // Añadimos elementos a la lista de crear esperando que se confirmen o se cancelen.
  $("#newCat3").on("click",function(){
    var newCat = $("#inlineFormInput3").val();
     caracteristicasInMod.push(newCat);
    $("#newsElements").text("");
    $(caracteristicasInMod).each(function(index,element){
      $("#newsElements").append("<li>"+element+"</li>");
    });
  });
  //Cancelamos.
  $("#CancelMod").on("click",function(){
    $('#ModificarrModal').modal('hide');
  });

  //Confrimamos
  $("#ComfMod").on("click",function(){
    if($("#ModificarCarac").val()<2){
      alert("Nombre Demasiado corto.");
    }else{
      if(caracteristicas.length < 1){
        alert("Se necesitan valores para la caracteristíca.");
      }else{
        if(confirm("¿Seguro que desea modificar estas caracteristícas?")){

          //Una vez confirmamos empieza la acción.

          //------------------------------
          //---------       1º        --------
          //------------------------------
          if(borrarElementos.length > 0) {
            console.log("elementos a borrar.");
            console.log("---------------------");
            console.log(borrarElementos);
            $.ajax({
              url:"php/deleteCar.php",
              type:"POST",
              async: false,
              dataType:"json",
              data:{
                ids:borrarElementos
              },
              success:function(data){
                if(data.Res=="OK"){
                  alert(data.Res+": "+data.Desc);
                }else if(data.Res=="ERROR"){
                  alert(data.Res+": "+data.Desc);
                    return;
                  }else if(data.Res=="EX"){
                    alert("No se puede borrar,ya que existen anuncios que dependen de está categoría.");                 
                  }
              }
            });
          }
          //------------------------------
          //---------       2º        --------
          //------------------------------
          var ModValues = [];
          $("#EditElements li").each(function(index,element){
            var nombreItem = $(element).find("input").val();
            var valorItem = $(element).find("input").data("itemval");
            ModValues.push([nombreItem,valorItem]);
          });

          console.log(ModValues);
          vartipCar = $("#ModificarCarac").val();
          if(ModValues.length > 0){
            $.ajax({
              url:"php/ModCar.php",
              type:"POST",
              dataType:"json",
              data:{
                items:ModValues,
                tipo:vartipCar
              },
              success:function(data){
                if(data.Res=="OK"){
                  //------------------------------
                  //---------       3º        --------
                  //------------------------------
                  alert(data.Res+": "+data.Desc);
                  if(caracteristicasInMod.length > 0){
                    var dir="";
                    if(padreCar==""){
                      dir="php/insertCar.php";
                    }else{
                      dir="php/insertSubCar.php";
                      currentCategory=padreCar;
                    }

                    $.ajax({
                      url:dir,
                      type:"POST",
                      dataType:"json",
                      data:{
                        categoria:currentCategory,
                        car:caracteristicasInMod,
                        tipo:data.tipo
                      },
                      success:function(data){
                        alert(data.Res+": "+data.Desc);
                        location.reload();
                      }
                    }).done(function(){
                      location.reload();

                    });
                  }else{
                    location.reload();
                  }
                }else{
                  alert("No se ha podido Modificar con éxito");

                }
              }
            });
          }else{
            location.reload();
          }
        }
      }
    }
  });
  // --------------------Fin modificar caracteriística.---------




//Insertar SUB-caracteristíca.
  $("body").on("click",".InsertarSubCaracteristica",function(event){
    if($(event.target).parent().parent().find("select").val() != "NO"){
      // Acciones necesarias.
      $("#InsertarCarac2").val("");
      $("#mostrarEle2").text("");
      $("#inlineFormInput2").val("");

      $("#cat_pad2").text($(event.target).parent().parent().find("select option:selected:first").text());
      $('#InsertarModal2').modal('show');
      caracteristicas=[];
      cat=$(event.target).parent().parent().find("select").val();
      $.ajax({
        url:"php/funciones.php",
        type:"GET",
        dataType:"json",
        data:{
          get_function: "traer_tipos",
        },
        success:function(data){
          if(data.length>0){
            autocomplete(document.getElementById("InsertarCarac2"), data);
          }
        }
      });
    }else{
      alert("No se ha seleccionado categorria.");
    }
  });
  $("#CancelIns2").on("click",function(){
    $('#InsertarModal2').modal('hide');
  });
  // Añadir a la lista sub categoría.
  $("#newCat").on("click",function(){
    var newCat = $("#inlineFormInput").val();
    caracteristicas.push(newCat);
    $("#mostrarEle").text("");
    $("#inlineFormInput").val("");
    $(caracteristicas).each(function(index,element){
      $("#mostrarEle").append("<li>"+element+"</li>");
    });
  });
  $("#ComfIns2").on("click",function(){
    if($("#InsertarCarac2").val()<2){
      alert("Nombre Demasiado corto.");
    }else{
      if(caracteristicas.length < 1){
        alert("Se necesitan valores para la caracteristíca.");
      }else{
        $.ajax({
          url:"php/insertSubCar.php",
          type:"POST",
          dataType:"json",
          data:{
            categoria:cat,
            car:caracteristicas,
            tipo:$("#InsertarCarac2").val()
          },
          success:function(data){
            alert(data.Res+": "+data.Desc);
            console.log(data);
              location.reload();
          }
        });
        $('#InsertarModal').modal('hide');
      }
      location.reload();
    }
  });
  // ----Fin sinsertar sub característica-----

  //Insertar caracteristíca.
  $("body").on("click","#InsertarCaracteristica",function(){
    if($(".CategoriaClass:last select").val() != "NO"){

      // Acciones necesarias.
      $("#InsertarCarac").val("");
      $("#mostrarEle").text("");
      $("#inlineFormInput").val("");
      caracteristicas=[];
      cat=$(".CategoriaClass:last select").val();
      $.ajax({
        url:"php/funciones.php",
        type:"GET",
        dataType:"json",
        data:{
          get_function: "traer_tipos",
        },
        success:function(data){
          if(data.length>0){
            autocomplete(document.getElementById("InsertarCarac"), data);
          }
          $('#InsertarModal').modal('show');
        }
      });
      $("#cat_pad").text($(".CategoriaClass:last option:selected").text());
    }else{
      alert("No se ha seleccionado categorria.");
    }
  });
  //Cancelar inserción
  $("#CancelIns").on("click",function(){
    $('#InsertarModal').modal('hide');
  });
  //Add item
  $("#newCat2").on("click",function(){
    var newCat = $("#inlineFormInput2").val();
    caracteristicas.push(newCat);
    $("#mostrarEle2").text("");
    $(caracteristicas).each(function(index,element){
      $("#mostrarEle2").append("<li>"+element+"</li>");
    });
  });
  //Confiormar inserción.
  $("#ComfIns").on("click",function(){
    if($("#InsertarCarac").val()<2){
      alert("Nombre Demasiado corto.");
    }else{
      if(caracteristicas.length < 1){
        alert("Se necesitan valores para la caracteristíca.");
      }else{
        $.ajax({
          url:"php/insertCar.php",
          type:"post",
          dataType:"json",
          data:{
            categoria:cat,
            car:caracteristicas,
            tipo:$("#InsertarCarac").val()
          },
          success:function(data){
            alert(data.Res+": "+data.Desc);
            location.reload();
          }
        });
        $('#InsertarModal').modal('hide');
      }
    }
  });
  //-----------------Fin inserccion------------











  // $("body").on("click",".insertar",function(event){
  //   $('#InsertarModal').modal('show');
  // });



// Cuando seleccionamos una caracteristica
  $("body").on("change",".CarSelcc",function(event){
// Acciones necesarias.
  $(this).parent().find(".CaracteristicasCont").remove();



    var padre = $(event.target).parent();
    $.ajax({
      url:"php/funciones_car.php",
      dataType:"json",
      data: {
        get_function: "traer_sub_caracteristicas",
        Id:$(event.target).val()
      },
      success:function(data){
        console.log(data);
        cargarCaracteristicas(data,2,padre,$(event.target).val());
      },
      error:function(){
        alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
      }

    });
  });
// -----------Fin selección característica------------.




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
        carSelect  += '  <label class="text-center " style="display:block; font-weight: bold;" >'+element.Nombre+'<a class="ml-2 btn btn-success InsertarSubCaracteristica">Insertar sub</a><a class="btn btn-warning ModificarCaracteristica" data-nombre="'+element.Nombre+'" data-catPadre="'+catpadre+'">Modificar</a></label>';
        carSelect  += '  <select  class="CarSelcc form-control" data-tipoN="'+element.Nombre+'" data-tipo="'+element.cod_tipo+'">';
        carSelect  += '    <option value="NO" >No seleccionada</option>';
        $(element.select).each(function(index2,element2){
          carSelect  += '    <option value="'+element2.Id+'">'+element2.Nombre+'</option>';
        });
        carSelect  += '  </select>';
        carSelect  += '</div>';
        carSelect = $(carSelect);
        if(mod==1){
          $(".ContenedorCaracteristicas").append(carSelect);
        }else{
          $(cont).append(carSelect);
        }
      });
    }
  }






  function subcategoria_mostrar(data){
    var varSelect="";
    varSelect +='<div class="CategoriaClass col col-12" data-padre="'+data[0].cod_padre+'" data-num="'+num+'">';
    varSelect +='  <div class="row col col-12">';
    varSelect +='<select class="CategoSelec  form-control col col-md-8" name="categorias" id="categoriasSelec" data-num="'+num+'">';
    varSelect +='  <option value="NO">Selecciona categoría</option>';
    // Bucle select.
    for (var i = 0; i < data.length; i++) {

      varSelect +='  <option value="'+data[i].Id+'">'+data[i].Nombre+'</option>';

    }
    //Fin bucle.
    varSelect +='</select>';
    varSelect +=' <a type="button" name="button" class="verSubcategorias btn col col-3" data-num="'+num+'"><span class="glyphicon glyphicon-arrow-down">↓</span></a>';
    varSelect +='</div>';
    varSelect +='</div>';
    $(varSelect).insertAfter(".CategoriaClass:last");
    // ampliamos el numero
    num++;
  }


});
