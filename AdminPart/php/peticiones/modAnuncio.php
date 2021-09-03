<?php
require("conexion.php");
include("../subirArchivo.php");

$imagen1="";
$imagen2="";
$imagen3="";
$imagen4="";

$ant1=$_POST["anterior1"];
$ant2=$_POST["anterior2"];
$ant3=$_POST["anterior3"];
$ant4=$_POST["anterior4"];


  if (isset($_FILES["imagen1"]) && $_FILES["imagen1"]["name"] != "") {
    if ($ant1!="") {
      unlink ("../../uploads/anuncios/".$ant1);
      $subir = subir_imagen("imagen1","anuncios");
      $sql = "UPDATE `fotos` SET `Nombre`='{$subir["img"]}' WHERE Nombre='$ant1'";
      // printf($sql);
      $queryFotos = mysqli_query($conexion,$sql);
    }else {
      $subir = subir_imagen("imagen1","anuncios");
      $queryFotos = 'INSERT INTO `fotos` ( `cod_anuncio`, `Nombre`) VALUES ('.$_POST["Id"].',"'.$subir["img"].'")';
      // printf($queryFotos);
      $queryFotos = mysqli_query($conexion,$queryFotos);
    }
  }
  if (isset($_FILES["imagen2"]) && $_FILES["imagen2"]["name"] != "") {
    if ($ant2!="") {
      unlink ("../../uploads/anuncios/".$ant2);
      $subir = subir_imagen("imagen2","anuncios");
      $sql = "UPDATE `fotos` SET `Nombre`='{$subir["img"]}' WHERE Nombre='$ant2'";
      // printf($sql);
      $queryFotos = mysqli_query($conexion,$sql);
    }else {
      $subir = subir_imagen("imagen2","anuncios");
      $queryFotos = 'INSERT INTO `fotos` ( `cod_anuncio`, `Nombre`) VALUES ('.$_POST["Id"].',"'.$subir["img"].'")';
      // printf($queryFotos);
      $queryFotos = mysqli_query($conexion,$queryFotos);
    }
  }
  if (isset($_FILES["imagen3"]) && $_FILES["imagen3"]["name"] != "") {
    if ($ant3!="") {
      unlink ("../../uploads/anuncios/".$ant3);
      $subir = subir_imagen("imagen3","anuncios");
      $sql = "UPDATE `fotos` SET `Nombre`='{$subir["img"]}' WHERE Nombre='$ant3'";
      $queryFotos = mysqli_query($conexion,$sql);
    }else {
      $subir = subir_imagen("imagen3","anuncios");
      $queryFotos = 'INSERT INTO `fotos` ( `cod_anuncio`, `Nombre`) VALUES ('.$_POST["Id"].',"'.$subir["img"].'")';
      $queryFotos = mysqli_query($conexion,$queryFotos);
    }
  }
  if (isset($_FILES["imagen4"]) && $_FILES["imagen4"]["name"] != "") {
    if ($ant4!="") {
      unlink ("../../uploads/anuncios/".$ant4);
      $subir = subir_imagen("imagen3","anuncios");
      $sql = "UPDATE `fotos` SET `Nombre`='{$subir["img"]}' WHERE Nombre='$ant4'";
      $queryFotos = mysqli_query($conexion,$sql);
    }else {
      $subir = subir_imagen("imagen4","anuncios");
      $queryFotos = 'INSERT INTO `fotos` ( `cod_anuncio`, `Nombre`) VALUES ('.$_POST["Id"].',"'.$subir["img"].'")';
      $queryFotos = mysqli_query($conexion,$queryFotos);
    }
  }

//
// echo "<pre>";
// print_r($_FILES);
// echo "</pre>";
$sql_anuncio="";
$sql_anuncio.= "UPDATE `anuncios`SET";
$sql_anuncio.= " `Nombre`='{$_POST["titulo"]}'";
$sql_anuncio.= " ,`Descripcion`='{$_POST["descripcion"]}'";
$sql_anuncio.= " ,`cod_ciudad`={$_POST["ciudad"]}";
$sql_anuncio.= " ,`Precio`={$_POST["precio"]}";
$sql_anuncio.= " ,`Extra`='{$_POST["extra"]}'";
$sql_anuncio.= " ,`Poblacion`='{$_POST["poblacion"]}'";
$sql_anuncio.= " WHERE Id={$_POST["Id"]}";
if (mysqli_query($conexion,$sql_anuncio)) {
echo json_encode(array("Res"=>"OK"));
}


 ?>
