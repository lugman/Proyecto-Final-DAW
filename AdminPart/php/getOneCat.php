<?php
  require "conexion.php";

  if (isset($_POST["id"])) {

    $consult = "SELECT categorias.Id,categorias.Nombre,categorias.cod_padre FROM `categorias` WHERE categorias.Id=".$_POST["id"];

    $query = mysqli_query($conexion,$consult);
    if (mysqli_num_rows($query) > 0 )
      echo json_encode($query->fetch_assoc());
    }else {
      echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No se ha podido borrar con exito"));
    }
  }else {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No datos POST"));
    exit();
  }


 ?>
