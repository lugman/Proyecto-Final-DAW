<?php
// Incluimos configuración conexio.
  include("conexion.php");

// Si recogemos datos POST con nombre usuario.
  if (isset($_POST["Email"]))
   {
// Creamos consulta con el nombre de usuario a combrobar.
    $consulta_existe_usuario='SELECT `Email` FROM `usuario` WHERE BINARY Email = "'.$_POST["Email"].'"';
    // print_r($consulta_existe_usuario);
    // die();
// Ejecutamos la Consulta
    $query =   mysqli_query($conexion,$consulta_existe_usuario);
    // Comprovamos si se han encontrado soluciones.
    if ($query->num_rows > 0)
    {
      // Devolvemos la respuesta oportuna.
      echo json_encode(array("Res"=>"Existe"));
    }
    else
    {
      // Devolvemos la respuesta oportuna.
      echo json_encode(array("Res"=>"NoExiste"));
    }
  }
  else
  {
    // Devolvemos la respuesta de que no se ha podido recibir el usuariopor POST..
     echo json_encode(array("Res"=>"ERROR","Desc"=>"Error al pasar datos por POST"));
  }
 ?>
