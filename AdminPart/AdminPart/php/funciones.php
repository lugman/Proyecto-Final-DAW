<?php
include("conexion.php");
if (isset($_GET["get_function"])) {
  switch ($_GET["get_function"]) {
    case 'traer_categorias':
      $categorias = traer_categorias($conexion);
      $carac =[];
      while ($fila2 = $categorias->fetch_assoc()) {
      $carac []=array('text' => $fila2["Nombre"] ,'Id' => $fila2["Id"] );
      }
      echo json_encode($carac);
      break;
    case 'traer_sub_categorias':
      $sub_categorias = traer_sub_categorias($conexion,$_GET["Id"]);
      $arr = [];
      while ($fila = $sub_categorias->fetch_assoc()) {
      $arr []=$fila;
      }
      echo json_encode($arr);
      break;
    case 'traer_categoria':
    $categorias = traer_categoria($conexion,$_GET["Id"]);
    $carac =[];
    while ($fila2 = $categorias->fetch_assoc()) {
    $carac []=$fila2;
    }
    echo json_encode($carac);
    break;
    case 'traer_tipos':
    $categorias = traer_tipos($conexion);
    $carac =[];
    while ($fila2 = $categorias->fetch_assoc()) {
    $carac []=$fila2["Nombre"];
    }
    echo json_encode($carac);
    break;
  }
}
function traer_categorias($con){
  $consulta = "SELECT `Id`, `Nombre`, `cod_padre` FROM `categorias` WHERE cod_padre IS NULL"." ORDER BY Nombre";
  $query = mysqli_query($con,$consulta);
  return $query;
}
function traer_categoria($con,$id){
  $consulta = "SELECT `Id`, `Nombre`, `cod_padre` FROM `categorias` WHERE Id=".$id." ORDER BY Nombre";
  $query = mysqli_query($con,$consulta);
  return $query;
}
function traer_sub_categorias($con,$num){
  $consulta = "SELECT `Id`, `Nombre`, `cod_padre` FROM `categorias` WHERE cod_padre=".$num." ORDER BY Nombre";
  $query = mysqli_query($con,$consulta);
  return $query;
}
function traer_tipos($con){
  $consulta = "SELECT `Nombre` FROM `tipo_caracteristica`"." ORDER BY Nombre";
  $query = mysqli_query($con,$consulta);
  return $query;
}



 ?>
