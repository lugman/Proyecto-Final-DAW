<?php
require "conexion.php";
if (isset($_POST["items"])) {



  $tipo = $_POST["tipo"];
  $NombreTipo = $_POST["tipo"];

  $sqltipo = "SELECT * FROM `tipo_caracteristica` WHERE `Nombre` LIKE lower('$tipo')";

  $query = mysqli_query($conexion,$sqltipo);
  if (mysqli_num_rows($query) > 0) {
    $tipo = mysqli_fetch_array($query)["Id"];
  }else {
    $sqltipo = "INSERT INTO `tipo_caracteristica`( `Nombre`) VALUES ('$tipo')";
    $query = mysqli_query($conexion,$sqltipo);
    $tipo = mysqli_insert_id($conexion);
  }



$items = $_POST["items"];

$res=[];
$response="OK";

foreach ($items as $item) {
  $sql = "UPDATE `caracteristicas` SET `Nombre`='$item[0]',`cod_tipo`=$tipo WHERE Id=".$item[1];

  $query = mysqli_query($conexion,$sql);
  if ($query) {
    $res[]="OK";
    }
}

foreach ($res as $key) {
  if ($key != "OK") {
    $response="ERR";
  }
}

  if ($response=="OK") {
    echo json_encode(array("Res"=>"OK","tipo"=>$NombreTipo,"Desc"=>"Modificación finlizada con éxito."));
  }else {
    echo json_encode(array("Res"=>"ERROR","Desc"=>"No se ha podido Modificar con exito las caracteristicas"));
  }
}else {
  echo json_encode(array("Res"=>"ERROR","Desc"=>"No datos POST"));
  exit();
}

 ?>
