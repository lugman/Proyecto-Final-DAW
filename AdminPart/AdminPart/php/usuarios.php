<?php
require "conexion.php";

  $consult = "SELECT DISTINCT usuario.Id,usuario.Nombre,usuario.Apellidos,usuario.Email,verificacion.DNI as DNI,
  usuario.Fecha,usuario.rol FROM `usuario` JOIN rol_usuario ON rol_usuario.Id=usuario.rol
  JOIN verificacion ON verificacion.Id=usuario.cod_verificiacacion WHERE rol_usuario.Id != 2 GROUP BY usuario.Id";
  $query = mysqli_query($conexion,$consult);

  if (mysqli_num_rows($query) > 0 )
  {
    $carac =[];
    while ($fila2 = mysqli_fetch_assoc($query))
    {
      // print_r($fila2);
      // die();
       $usuario = [];
        $usuario[0]=$fila2["Id"];
        $usuario[1]=$fila2["Nombre"];
        $usuario[2]=$fila2["Apellidos"];
        $usuario[3]=$fila2["Email"];
        $usuario[4]=$fila2["DNI"];
        $usuario[5]=$fila2["Fecha"];
        $usuario[6]=$fila2["rol"];
        $carac []= $usuario;
    }
    echo json_encode(array('data' =>$carac));
  }
  else
  {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No se ha podido borrar con exito"));
  }





 ?>
