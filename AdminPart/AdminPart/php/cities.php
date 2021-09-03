<?php
include("conexion.php");
if(isset($_GET["funcion"])){

switch ($_GET["funcion"]) {
  case 'insertar':
  insertar($conexion,$_POST["val"]);
  break;
case 'modificar':
  modificar($conexion,$_POST["Id"],$_POST["val"]);
  break;
case 'eliminar':
  eliminar($conexion,$_POST["Id"]);
  break;
case 'traer':
    traer($conexion,$_GET["Id"]);
break;
}
}
function traer($con,$val){
  $sentencia = "SELECT * FROM `ciudades` WHERE Id=".$val;
  // print_r($sentencia);
  $query = mysqli_query($con,$sentencia);
  if (mysqli_num_rows($query) > 0 ) {
    echo json_encode([mysqli_fetch_assoc($query)]);
  }else {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No Encontrado."));
  }

}
function insertar($con,$val){
  $consult = "INSERT INTO `ciudades`( `Nombre`) VALUES ('$val')";
  $query = mysqli_query($con,$consult);
  if ($query) {
    echo json_encode(array("Res"=>"OK"));
  }else {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No insertado con exito"));
  }

}
function modificar($con,$id,$val){
  $sentecia = "UPDATE `ciudades` SET `Nombre`='".$val."' WHERE `Id`=".$id;
  $query = mysqli_query($con,$sentecia);
  if ($query) {
    echo json_encode(array("Res"=>"OK"));
  }else {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No modificado con exito"));
  }

}
function eliminar($con,$id){
  $sentencia = "SELECT * FROM `usuario` WHERE cod_ciudad=".$id;
  $query = mysqli_query($con,$sentencia);
  if (mysqli_num_rows($query) > 0 ) {
    echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No Se puede borrar existen usuarios que dependen de esta ciudad"));
  }else {
    $sentencia = "SELECT * FROM `anuncios` WHERE cod_ciudad=".$id;
    $query = mysqli_query($con,$sentencia);
    if (mysqli_num_rows($query) > 0 ) {
      echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No Se puede borrar existen anuncios que dependen de está ciudad"));
    }else {
      $sentencia = "DELETE FROM `ciudades` WHERE Id=".$id;
      $query = mysqli_query($con,$sentencia);
      if ($query) {
        echo json_encode(array("Res"=>"OK"));
      }else {
        echo json_encode(array("Res"=>"ERROR","Descripcion"=>"No Borrado con exito"));
      }
    }
}

}


 ?>
