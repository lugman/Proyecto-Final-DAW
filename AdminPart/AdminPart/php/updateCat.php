<?php
require "conexion.php";
if (isset($_POST["Id"])) {
  $consult = 'UPDATE `categorias` SET `Nombre`="'.$_POST["name"].'" WHERE Id='.$_POST["Id"];

  $query = mysqli_query($conexion,$consult);
  if ($query) {
    echo json_encode(array("Res"=>"OK","Desc"=>"Se ha modificado con éxito."));
  }else {
    echo json_encode(array("Res"=>"ERROR","Desc"=>"No se ha podido modificar con éxito."));
  }
}else {
  echo json_encode(array("Res"=>"ERROR","Desc"=>"No se ha podido modificar con éxito."));
  exit();
}

 ?>
