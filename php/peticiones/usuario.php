<?php
require "conexion.php";
function mis_datos($conexion){
  $consulta ='SELECT * FROM `usuario` WHERE Id='.$_SESSION["Id"];
  // Realizamos la consulta.
  $respuesta = mysqli_query($conexion,$consulta);
return  mysqli_fetch_array($respuesta);
}

 ?>
