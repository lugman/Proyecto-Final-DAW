<?php
require "conexion.php";

  $consult = "SELECT Id,Nombre,Fecha,Fecha_modificacion,Precio,cod_usuario,cod_estado,cod_membresia FROM `anuncios` ";
  $query = mysqli_query($conexion,$consult);

  if (mysqli_num_rows($query) > 0 )
  {
    $carac =[];
    while ($fila2 = mysqli_fetch_array($query))
    {
    $carac []=$fila2;
    }
    echo json_encode(array('data' =>$carac));
  }
  else
  {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No se ha encontrado resultados"));
  }





 ?>
