<?php
include("conexion.php");


if (isset($_POST["car"])) {

  $categoria = $_POST["categoria"];
  $caracteristicas = $_POST["car"];

  $tipo = $_POST["tipo"];

  $sqltipo = "SELECT * FROM `tipo_caracteristica` WHERE `Nombre` LIKE lower('$tipo')";

  $query = mysqli_query($conexion,$sqltipo);

  if (mysqli_num_rows($query) > 0) {
    $tipo = mysqli_fetch_array($query)["Id"];
  }else {
    $sqltipo = "INSERT INTO `tipo_caracteristica`( `Nombre`) VALUES ('$tipo')";
    $query = mysqli_query($conexion,$sqltipo);
    $tipo = mysqli_insert_id($conexion);
  }

  $sql = "INSERT INTO `caracteristicas` ( `Nombre`, `cod_tipo`, `cod_padre`, `cod_categoria`) VALUES ";
  $cont = 0;

  foreach ($caracteristicas as $value) {
    if($cont==0)
    {
      $sql .= "( '{$value}', {$tipo}, {$categoria},NULL)";
    }else {
      $sql .= ",( '{$value}', {$tipo},  {$categoria},NULL)";
    }
    $cont++;
  }
// print_r($sql
  $query = mysqli_query($conexion,$sql);
if ($query) {
    echo json_encode(array("Res"=>"OK","Desc"=>"Se han insertado las caracteristícas con éxito."));
}else {
  echo json_encode(array("Res"=>"ERROR","Desc"=>$sql));
}

}
 ?>
