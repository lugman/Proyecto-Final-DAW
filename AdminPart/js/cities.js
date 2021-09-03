$(function(){
  var num = 1;
  var id="";
  var objInsertar=[];
  var enviar={};



$(".ModCat").on("click",function(){

  $("#catIToMod").val("");
  $.ajax({
    url:"php/cities.php",
    type:"GET",
    dataType:"json",
    data:{
      funcion: "traer",
      Id:$(".Ciudades").val()
    },
    success:function(data){
      if(data.length>0){
        $("#modificar").modal('show');
        $("#catIToMod").val(data[0].Nombre);
        $("#catIToMod").attr("data-ide",data[0].Id);

      }else{
        alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
      }
    },
    error:function(){
      alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
    }
  });

});

$("#ConfirMod").on("click",function(){
  $.ajax({
    url:"php/cities.php?funcion=modificar",
    type:"POST",
    dataType:"json",
    data:{
      val :$("#catIToMod").val(),
      Id:$("#catIToMod").data("ide")
    },
    success:function(data){
      if(data.Res=="OK"){
        $("#modificar").modal('hide');
        location.reload();
      }else{
        alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
      }
    },
    error:function(){
      alert("No ha podido acceder a esta categoría ,por favor contacte con el administrador.");
    }
  });
  $('#modificar').modal('hide');
});
$("#CancelMod").on("click",function(){

  $("#catIToMod").val("");
  $('#modificar').modal('hide');
});

$("body").on("click",".insertar",function(event){
  $('#insertar').modal('show');
  $("#catInsert").val("");
});

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

$("body").on("click",".borrarCat",function(event){
  if(confirm("¿Seguro que desea borrar está ciudad?")){
    $.ajax({
      url:"php/cities.php?funcion=eliminar",
      type:"POST",
      dataType:"json",
      data:{
        Id:$(".Ciudades").val()
      },
      success:function(data){
        if(data.Res=="OK"){
          alert("Se ha Borrado con exito");
          location.reload();
        }else{
          alert("No ha borrado: "+data.Descripcion);
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
  }
});

$("#ConformInsert").on("click",function(){
    enviar.elements=objInsertar;
    $.ajax({
      url:"php/cities.php?funcion=insertar",
      type:"POST",
      dataType:"json",
      data:{
        val:$("#catInsert").val()
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

});
$("#CancelInsert").on("click",function(){
  $(".insMomentCat").empty();
  $("#catInsert").val("");
   objInsertar=[];
   enviar={};
  $('#insertar').modal('hide');
});







});
