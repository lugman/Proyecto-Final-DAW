function Conexion(url,datos="", tipo = "GET",asincrona=false) {
  var respuesta="";
  if (tipo == "GET") {
    $.ajax({
      type: 'GET',
      url: url,
      async: asincrona,
      data: datos,
      dataType: 'json',
      success: function(data) {
        respuesta = data;
      },
      error: function(err) {
        console.error("Error en la consulta get,  Estado: "+err.status);
        console.warn("Respuesta del servido"+err.responseText);
        console.warn("Peticion a realizar"+url+"\n Con los datos:");
        console.info(datos);
      }
    });
  } else if (tipo == "POST") {
    $.ajax({
      type: 'POST',
      url: url,
      async: asincrona,
      data: datos,
      dataType: 'json',
      success: function(data) {
        respuesta =  data;
      },
      error: function(err) {

        console.error("Error en la consulta post ,Estado: "+err.status);
        console.warn("Respuesta del servido"+err.responseText);
        console.warn("Peticion a realizar"+url+"\n Con los datos:");
        console.info(datos);
      }
    });
  }
  return respuesta;
}
