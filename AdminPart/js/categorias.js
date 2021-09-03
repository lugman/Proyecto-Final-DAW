$(function(){
  // Numero utilizado para borrar selecciones descndientes.
  var num = 1;
  // Variable utilizada para identificar catgoria.
  var id="";
  // Variable utilizada para meter elementos en el modal y luego pasarlos para.
  //insertarlos como categorias.
  var objInsertar=[];
  var enviar={};



  //Ver Categorias descendientes
  $("body").on("click",".verSubcategorias",function(event){
    // Accciones necesarias.
    var  numeroElemnto = $(this).data("num");
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

    // Fin ver descendientes.

  // Borrar selecs categorias descendientes al selecionar padre.
  $("body").on("change",".CategoriaClass select",function(event){
    console.log($(this).data("num"));
    // Accciones necesarias.
    var  numeroElemnto = $(this).data("num");
    $(".CategoriaClass").each(function(index,element){
      var currentNum = $(element).data("num");

      if(parseInt(currentNum) > parseInt(numeroElemnto)){
        $(element).remove();
      }
    });
  });
  // ----Fin borrar descendientes----

  // Modificar categoría.
  // Modificar modal.
  $("body").on("click",".ModCat",function(event){
    if($(event.target).parent().parent().find("select").val()!="NO"){

      id=$(event.target).parent().parent().find("select").val();
      $("#catIToMod").val("");
      $.ajax({
        url:"php/funciones.php",
        type:"GET",
        dataType:"json",
        data:{
          get_function: "traer_categoria",
          Id:id
        },
        success:function(data){
          if(data.length>0){
            $("#modificar").modal('show');
            $("#catIToMod").val(data[0].Nombre);
          }else{
            alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
          }
        },
        error:function(){
          alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
        }
      });
    }else{
      alert("Seleccione la categoría a modificar.");
    }
  });
  // Confirmar modificación.
  $("#ConfirMod").on("click",function(){
    $.ajax({
      url:"php/updateCat.php",
      type:"POST",
      dataType:"json",
      data:{
        name :$("#catIToMod").val(),
        Id:id
      },
      success:function(data){
        console.log("-------------Modificacción.---------------");
          alert(data.Desc);
          if(data.Res=="OK"){
            console.log(data.Desc);
            location.reload();
          }else{
            console.error(data.Desc);
          }
      },
      error:function(){
        alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
      }
    });
    $('#modificar').modal('hide');
  });
  // Cancelar modificación.
  $("#CancelMod").on("click",function(){
    $("#catIToMod").val("");
    $('#modificar').modal('hide');
  });
  //----------------Fin Modificación----------------------.

  // Insertar  Nueva.
  // Modal insertar
  $("body").on("click",".insertar",function(event){
    console.log($(this).parent().parent().find("select").get(0));


    $('#insertar').modal('show');
    $("#catInsert").val("");
    $(".insMomentCat").empty();
    objInsertar=[];
    enviar={};
    enviar.num=$(this).parent().parent().data("num");
    if(enviar.num==0){
      enviar.num="NULL"
    }else{
      enviar.num=$(this).parent().parent().data("padre");
    }
    console.log("Objeto a enviar:");
    console.log(enviar);

  });
  // Añadir a la lista del modal catgorías a insertar.
    $("#btnIntroducir").on("click",function(){
      var nombreInt = $("#catInsert").val();
      console.log(nombreInt);
      console.log(objInsertar);
      if(nombreInt.length >= 2){
        objInsertar.push(nombreInt);
      }
      else{
        alert("Demasiado corto");
      }
      console.log(objInsertar);
      $(".insMomentCat").empty();
      $(objInsertar).each(function(index,element){
        $(".insMomentCat").append("<li>"+element+"</li>");
      });
    });
  // ---------------------Fin añadir a lista modal-------------.
  //Confirmar Inserción.
  $("#ConformInsert").on("click",function(){
    if(objInsertar.length > 0){
      enviar.elements=objInsertar;
      $.ajax({
        url:"php/insertCat.php",
        type:"POST",
        dataType:"json",
        data:{
          enviar
        },
        success:function(data){
          if(data.Res=="OK"){
            alert("Se ha Insertado con exito");
            location.reload();
          }else{
            alert("No ha Insertar con exito,porfavor contacte con el administrador");
          }
        },
        error:function(){
          alert("No ha Insertar con exito,porfavor contacte con el administrador");
        }
      }).done(function(){
        console.log("Fin Inserción");
        $(".insMomentCat").empty();
        $("#catInsert").val("");
        objInsertar=[];
        enviar={};

      });

      $('#insertar').modal('hide');
    }else{
      alert("No se han añadido elementos a insertar");
    }
  });
  //Cancelar inserción
  $("#CancelInsert").on("click",function(){
    $(".insMomentCat").empty();
    $("#catInsert").val("");
    objInsertar=[];
    enviar={};
    $('#insertar').modal('hide');
  });
//------------------------Fin Insertar--------------------

// Insertar Descendiente.
// MISMO MODAL QUE  INSERTAR
//Modal insertar descendiente.
  $("body").on("click",".InsertCatDes",function(event){
    if($(event.target).parent().find("select").val()!="NO"){
      console.log($(event.target).parent().find("select").val());
      $('#insertar').modal('show');
      $("#catInsert").val("");
      $(".insMomentCat").empty();
      objInsertar=[];
      enviar={};

      enviar.num=$(event.target).parent().find("select").val();

      console.log("Objeto a enviarDes:");
      console.log(enviar);
    }else{
      alert("Seleccione una categoria");
    }
  });
  // ---------------------Fin insertar descendiente--------------------------------.


// Borra Categoría.
  $("body").on("click",".borrarCat",function(event){
    if(confirm("¿Esta seguro que desea borra está categoría.?")){
    if($(event.target).parent().parent().find("select").val()!="NO"){
      console.log($(event.target).parent().parent().find("select").val());
      objInsertar=[];
      enviar={};
      enviar.num=$(event.target).parent().parent().find("select").val();
      console.log("Objeto a Borrar:");
      console.log(enviar);
      $.ajax({
        url:"php/deleteCat.php",
        type:"POST",
        dataType:"json",
        data:{
          enviar
        },
        success:function(data){
          if(data.Res=="OK"){
            alert("Se ha Borrado con exito");
            location.reload();
          }else{
            alert("No ha Borrar ,por favor compruebe que no hay categorías o carcatersticas que dependan de está.");
          }
        },
        error:function(){
          alert("No ha Borrar con exito,porfavor contacte con el administrador");
        }
      }).done(function(){
        console.log("Fin Borrrado");
        objInsertar=[];
        enviar={};
      });
    }else{
      objInsertar=[];
      enviar={};
      alert("Seleccione una categoria");
    }
  }
  });
// --------Fin Borrar categgoría-------






  function subcategoria_mostrar(data){

    var varSelect="";
    varSelect +='<div class="CategoriaClass col-12" data-padre="'+data[0].cod_padre+'" data-num="'+num+'">';
    varSelect +='  <div class="">';
    varSelect +='    <button type="button" name="button" class="insertar btn btn-success ml-2"  >Insertar categoría</button>';
    varSelect +='    <button type="button" name="button" class="ModCat btn btn-warning ml-2">Modificar</button>';
    varSelect +='    <button type="button" name="button" class="borrarCat btn btn-danger ml-2">Borrar</button>';
    varSelect +='  </div>';
    varSelect +='  <button type="button" name="button" class="InsertCatDes btn btn-info ml-2" data-num="">Insertar subcategoría</button>';
    varSelect +='  <div class="col-6 row">';
    varSelect +='';
    varSelect +='<select  name="categorias" class="categoriasSelec col-7 form-control" data-num="'+num+'">';
    varSelect +='  <option value="NO">Selecciona categoría</option>';

    // Bucle select.
    for (var i = 0; i < data.length; i++) {
      varSelect +='  <option value="'+data[i].Id+'">'+data[i].Nombre+'</option>';
    }
    //Fin bucle.
    varSelect +='</select>';
    varSelect +='<a type="button" name="button" class="verSubcategorias btn col col-3" data-num="'+num+'">↓</a>';
    varSelect +='</div>';
    varSelect +='</div>';
    $(varSelect).insertAfter(".CategoriaClass:last");

    // Aumentamos numero clase div.
    num++;
  }

});
