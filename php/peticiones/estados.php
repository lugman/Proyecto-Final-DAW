<?php
    require("conexion.php");
    session_start();

  if ($_POST["modo"]=="anuncio") {
    if ($_SESSION["login"] || $_SESSION["Gest"]) {
      operactionesAnuncio($conexion);
    }else{
      $resid = mysqli_query($conexion,"SELECT anuncios.cod_usuario FROM anuncios WHERE anuncios.Id=".$_POST["Id"]);
      $resid =mysqli_fetch_array($resid)["cod_usuario"];
      if ($_SESSION["Id"]==$resid) {
        operactionesAnuncio($conexion);
      }else {
        exit();
      }
    }
  }
  function operactionesAnuncio($conexion){
    if ($_POST["tipo"]=="borrar") {
      $consulta = "UPDATE `anuncios` SET `cod_estado`=4 WHERE anuncios.Id=".$_POST["Id"];
    }
    if ($_POST["tipo"]=="vender") {
      $consulta = "UPDATE `anuncios` SET `cod_estado`=1 WHERE anuncios.Id=".$_POST["Id"];
    }
    $resid = mysqli_query($conexion,$consulta);
    if ($resid) {
      echo json_encode(array("Res"=>"OK"));
    }else {
      echo json_encode(array("Res"=>"ERROR"));
    }
  }


 ?>
