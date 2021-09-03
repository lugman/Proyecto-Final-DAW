<?php
include("conexion.php");
if (isset($_GET["tipo_funcion"])){
  switch ($_GET["tipo_funcion"]) {
    case 'traer':
      traer($conexion);
      break;
    case 'traer_no_usadas':
      traer_no_usadas($conexion);
      break;
    case 'borrar':
      borrar($conexion,$_POST["Id"]);
        break;
    case 'modificar':
      modificar($conexion,$_POST["nom"],$_POST["id"]);
    break;
  }
}

function traer($con){
  $sql= "SELECT `Id`, `Nombre` FROM `tipo_caracteristica`";
  echo json_encode(mysqli_fetch_all(mysqli_query($con,$sql),MYSQLI_ASSOC));
}
function traer_no_usadas($con){
  $sql= "SELECT Id, Nombre FROM `tipo_caracteristica` WHERE Id NOT IN (SELECT `cod_tipo` FROM `caracteristicas`)";
  echo json_encode(mysqli_fetch_all(mysqli_query($con,$sql),MYSQLI_ASSOC));
}
function borrar($con,$id){
  $sql="DELETE FROM `tipo_caracteristica` WHERE Id=".$id;
  if (mysqli_query($con,$sql)) {
    echo json_encode(array("Res"=>"OK"));
  }else {
    echo json_encode(array("Res"=>"ERROR"));
  }
}
function modificar($con,$nom,$id){
  $sql="UPDATE `tipo_caracteristica` SET `Nombre`='$nom' WHERE Id=".$id;

  if (mysqli_query($con,$sql)) {
    echo json_encode(array("Res"=>"OK"));
  }else {
    echo json_encode(array("Res"=>"ERROR"));
  }
}
 ?>
 <!-- $query = mysqli_query($conexion,$sqltipo);

 if (mysqli_num_rows($query) > 0) {

 }else {
   $sqltipo = "INSERT INTO `tipo_caracteristica`( `Nombre`) VALUES ('$tipo')";
   $query = mysqli_query($conexion,$sqltipo);

 } -->
