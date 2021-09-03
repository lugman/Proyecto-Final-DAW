$("document").ready(function(){

var dnis = Conexion("php/verificar/porVerificarDNI.php");
// var dnis = Conexion("php/verificadosDNI.php");
// var dnis = Conexion("php/NoverificarDNI.php");

$(dnis).each(function(index,element){
  $(".conDnis").append("<li class='imagen-dni'><div class=''><img src='"+element.Foto+"'><h2 data-foto='"+element.FotoConExt+"'>"+element.Nombre+"</h2></div><div><a class='btn btn-success verDni centerButonn'>Ver DNI</a></div></li>");
});

$(".Porv").on("click",function(){
  $(".page-item.active").removeClass("active");
  $(this).addClass("active");
  $(".conDnis").empty();
  $.ajax({
    url:"php/verificar/porVerificarDNI.php",
    dataType:"json",
    success:function(data){
      $(data).each(function(index,element){
        $(".conDnis").append("<li class='imagen-dni'><div class=''><img src='"+element.Foto+"'><h2 data-foto='"+element.FotoConExt+"'>"+element.Nombre+"</h2></div><div><a class='btn btn-success verDni centerButonn'>Ver DNI</a></div></li>");
      });
    }
  });
});

$(".VerV").on("click",function(){
  $(".page-item.active").removeClass("active");
  $(this).addClass("active");
  $(".conDnis").empty();
  $.ajax({
    url:"php/verificar/verificadoDNI.php",
    dataType:"json",
    success:function(data){
      $(data).each(function(index,element){
        $(".conDnis").append("<li class='imagen-dni'><div class=''><img src='"+element.Foto+"'><h2 data-foto='"+element.FotoConExt+"'>"+element.Nombre+"</h2></div><div><a class='btn btn-success verDni2 centerButonn'>Ver DNI</a></div></li>");
      });
    }
  });
});

$(".NVer").on("click",function(){
  $(".page-item.active").removeClass("active");
  $(this).addClass("active");
  $(".conDnis").empty();
  $.ajax({
    url:"php/verificar/rechazadoDNI.php",
    dataType:"json",
    success:function(data){
      $(data).each(function(index,element){
        $(".conDnis").append("<li class='imagen-dni'><div class=''><img src='"+element.Foto+"'><h2 data-foto='"+element.FotoConExt+"'>"+element.Nombre+"</h2></div><div><a class='btn btn-success verDni2 centerButonn'>Ver DNI</a></div></li>");
      });
    }
  });
});

$("body").on("click",".verDni2",function(e){
  console.log(this);
  $(".modalImagen2").modal("show");
  $(".modalImagen2 h3").html("<strong>DNI:</strong> "+$(this).parent().parent().find("h2").text());
  $(".modalImagen2 img").attr("src",$(this).parent().parent().find("img").attr("src"));
});

$("body").on("click",".verDni",function(e){
  console.log(this);
  $(".modalImagen").modal("show");
  $(".modalImagen h3").html("<strong>DNI:</strong> "+$(this).parent().parent().find("h2").text());
  $(".modalImagen img").attr("src",$(this).parent().parent().find("img").attr("src"));
  $(".verificarDNI").attr("data-dni",$(this).parent().parent().find("h2").text());
  $(".verificarDNI").attr("data-foto",$(this).parent().parent().find("h2").data("foto"));
  $(".rechazarDNI").attr("data-foto",$(this).parent().parent().find("h2").data("foto"));
  $(".rechazarDNI").attr("data-dni",$(this).parent().parent().find("h2").text());
});

$(".verificarDNI").on("click",function(){
  var data = {};
  data.verificar="true";
  data.dni=$(this).data("dni");
  data.foto=$(this).data("foto");
  var resP = Conexion("php/verificar/aceptar.php",data,"POST");
  $(".modalImagen").modal("hide");
  $(".page-item.active").removeClass("active");
  $(this).addClass("active");
  $(".conDnis").empty();
  $.ajax({
    url:"php/verificar/porVerificarDNI.php",
    dataType:"json",
    success:function(data){
      $(data).each(function(index,element){
        $(".conDnis").append("<li class='imagen-dni'><div class=''><img src='"+element.Foto+"'><h2 data-foto='"+element.FotoConExt+"'>"+element.Nombre+"</h2></div><div><a class='btn btn-success verDni centerButonn'>Ver DNI</a></div></li>");
      });
    }
  });

});

$(".rechazarDNI").on("click",function(){
    var data = {};

  data.verificar="false";
  data.dni=$(this).data("dni");
  data.foto=$(this).data("foto");
  data.men=$("#MensajeDNI").val();
  var resP = Conexion("php/verificar/aceptar.php",data,"POST");
  $(".modalImagen").modal("hide");
  $(".page-item.active").removeClass("active");
  $(this).addClass("active");
  $(".conDnis").empty();
  $.ajax({
    url:"php/verificar/porVerificarDNI.php",
    dataType:"json",
    success:function(data){
      $(data).each(function(index,element){
        $(".conDnis").append("<li class='imagen-dni'><div class='verDni'><img src='"+element.Foto+"'><h2 data-foto='"+element.FotoConExt+"'>"+element.Nombre+"</h2></div><div><a class='btn btn-success centerButonn'>Ver DNI</a></div></li>");
      });
    }
  });
});

$(".anunciosA").on("click",function(e){
  $(".conAnD").empty();
  $.ajax({
    url:"php/peticiones/denuncia.php",
    dataType:"json",
    data:{
      traer:"anuncios"
    },
    success:function(data){
      $(data).each(function(index,element){
        $(".conAnD").append("<li class='imagen-dni'><div class=''><h2>Numero denuncias: <strong>"+element.denuncias+"</strong></h2><h2>Anuncio "+element.Nombre+"</h2></div><div><a class='btn btn-success 'href='index.php?page=anuncio&Id="+element.Id+"'>Ver Anuncio</a></div></li>");
      });
    }
  });
});
$(".usuarios").on("click",function(e){
  $(".conUsD").empty();
  $.ajax({
    url:"php/peticiones/denuncia.php",
    dataType:"json",
    data:{
      traer:"usuarios"
    },
    success:function(data){
      $(data).each(function(index,element){
        $(".conUsD").append("<li class='imagen-dni'><div class=''><h2>Numero denuncias: <strong>"+element.denuncias+"</strong></h2><h2>Usuario "+element.Email+"</h2></div><div><a class='btn btn-success 'href='index.php?page=usuario&Id="+element.Id+"'>Ver Anuncio</a></div></li>");
      });
    }
  });
});


});
