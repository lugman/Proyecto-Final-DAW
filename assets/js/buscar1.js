$(function(){
  //Rellenar Select Categorias mediante una función.
  var pasar = {};
  pasar = {};
  pasar.funcion = "categorias";

  //Buscar categorias.
  var categoriasArr = Conexion("php/peticiones/funciones.php",pasar);

  $(categoriasArr).each(function(index,element){
    $("#seleccion_cat").append("<option value='"+element.Id+"'>"+element.Nombre+"</option>");
  });
  //Rellenar Select Ciudades mediante una función.
  pasar = {};
  pasar.funcion = "ciudades";
  var citiesArr = Conexion("php/peticiones/funciones.php",pasar);
  $(citiesArr).each(function(index,element){
  var item = "<option value='"+element.Id+"'>"+element.Nombre+"</option>";
  $("#seleccion_cit").append(item);

  });

  $("#buscarIdice").on("click", function() {
    window.location = "index.php?page=buscar&args=busqueda&cat="+$("#seleccion_cat").val()+"&cit="+$("#seleccion_cit").val()+"&pal="+$("#palabras").val();
  });
  $(".IconosCategorias .col").on("click",function(){
      window.location = "index.php?page=buscar&args=categorias&cat="+$(this).data("cat");
  });


  function BuscarAnuncio(path, paramsJson) {
      var form = document.createElement("form");
      form.setAttribute("method", "post");
      form.setAttribute("action", path);

      var hiddenField = document.createElement("input");
      hiddenField.setAttribute("type", "hidden");
      hiddenField.setAttribute("name", "args");
      hiddenField.setAttribute("value", paramsJson);

      form.appendChild(hiddenField);

      document.body.appendChild(form);

      form.submit();
  }

});
