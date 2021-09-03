
function errorServ(men,donde) {
   alert("Se ha producido un error en el servidor: \n "+men.status+" "+men.responseText) ;
   console.error("Error en: "+donde);
}


// Crear  SELECT con datos pasados
(function($) {
$.fn.extend({
  seleccion: function(elementos_selec,elemento_selecionado="all",identificador="",name="") {
    var selec = ""
    selec += '<select id="'+identificador+'" name="'+name+'" class="form-control">';

    $(elementos_selec).each(function(index,element){

        if(elemento_selecionado==element.Id){
          selec += '  <option value="'+element.Id+'" selected>'+element.Nombre+'</option>';
        }else{
          selec += '  <option value="'+element.Id+'">'+element.Nombre+'</option>';
    }
    });
    selec += '</select>';
    $(this).append(selec);
  }
});
}) (jQuery);
