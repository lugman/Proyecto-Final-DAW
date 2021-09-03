<?php
session_start();
require("conexion.php");

date_default_timezone_set("Europe/Madrid");
$fechaNOW =  date('Y-m-d H:i:s', time());
if (isset($_SESSION["login"])) {


if (isset($_POST["val"])) {

 $consultaExiste = "SELECT * FROM `valoracion` WHERE cod_anuncio={$_POST["Id"]} AND cod_usuario={$_SESSION["Id"]}";
 $cons = mysqli_query($conexion,$consultaExiste);
  if(mysqli_num_rows($cons) > 0){

    $sql_valoracion="UPDATE `valoracion` SET ";

    $sql_valoracion .="`cod_anuncio`={$_POST["Id"]},`Valoracion`={$_POST["val"]},`Fecha`= '$fechaNOW',`cod_usuario`={$_SESSION["Id"]}".
    " WHERE cod_anuncio={$_POST["Id"]} AND cod_usuario={$_SESSION["Id"]} ";
  }else {

    $sql_valoracion="INSERT INTO `valoracion`(`cod_anuncio`, `Valoracion`, `Fecha`, `cod_usuario`)";
    $sql_valoracion .= " VALUES ({$_POST["Id"]},{$_POST["val"]},'$fechaNOW',{$_SESSION["Id"]})";
  }
  if (mysqli_query($conexion,$sql_valoracion)) {
    echo json_encode(array("Res"=>"OK"));
  }
  // else {
  //   echo mysqli_error($conexion);
  // }
}

if (isset($_POST["comment"])) {
  $sql_usuario ="INSERT INTO `comentarios`(`cod_anuncio`, `Descripcion`, `Fecha`, `cod_usuario`)".
  " VALUES ({$_POST["Id"]},'{$_POST["comment"]}', '$fechaNOW',{$_SESSION["Id"]})";
  // echo $sql_usuario;
  if (mysqli_query($conexion,$sql_usuario)) {
    echo json_encode(array("Res"=>"OK"));
  }
}

  // echo $sql_valoracion;
}


 ?>
