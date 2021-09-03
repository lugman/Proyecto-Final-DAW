<?php
require "conexion.php";
if (isset($_POST["enviar"])) {

  $cod_padre = $_POST["enviar"]["num"];

  $valores="('{$_POST["enviar"]["elements"][0]}',$cod_padre)";
  for ($i = 1 ;count($_POST["enviar"]["elements"]) > $i ;$i++) {
    $valores.= ",('".$_POST["enviar"]["elements"][$i]."', ".$cod_padre.")";
  }
  $consult = "INSERT INTO `categorias` (`Nombre`, `cod_padre`) VALUES $valores";
  // print_r($consult);
  // die();
  $query = mysqli_query($conexion,$consult);
  if ($query) {
    echo json_encode(array("Res"=>"OK"));
  }else {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No insertado con exito"));
  }
}else {
  echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No datos POST"));
  exit();
}

 ?>
