<?php
include("conexion.php");

if (isset($_GET["get_function"])) {
switch ($_GET["get_function"]) {
  case 'traer_caracteristicas':
    $caracteristicas = traer_caracteristicas($conexion,$_GET["Id"]);
    echo json_encode($caracteristicas);
    break;
  case 'traer_sub_caracteristicas':
      $caracteristicas = traer_sub_caracteristicas($conexion,$_GET["Id"]);
      echo json_encode($caracteristicas);
    break;

}


}else {

  echo json_encode(array('Desc' =>"No datos GET" ,"Res"=>"ERROR"));

}
function traer_caracteristicas($con,$num){
  $arr = [];
  $tipos ="SELECT DISTINCT cod_tipo as tip FROM caracteristicas WHERE cod_categoria=".$num;
  $query_tipo = mysqli_query($con,$tipos);

  if (mysqli_num_rows($query_tipo) > 0 ) {
    while ($tipo = $query_tipo->fetch_assoc()) {
      $arr2=[];
      $consulta = "SELECT caracteristicas.Id as Id,caracteristicas.Nombre as Nombre,cod_tipo,tipo_caracteristica.Nombre as NombreTipo,cod_padre FROM `caracteristicas` JOIN tipo_caracteristica ON tipo_caracteristica.Id = caracteristicas.cod_tipo
      WHERE cod_categoria=$num AND cod_tipo=".$tipo["tip"];
      $query = mysqli_query($con,$consulta);
      while ($fila = $query->fetch_assoc()) {
        $arr2[]=$fila;
      }
      // print_r($arr2);
      $arr[]=array("Nombre" => $arr2[0]["NombreTipo"],"cod_tipo" => $arr2[0]["cod_tipo"],"select" =>$arr2);
    }
  }
  // die();
  return $arr;
}
function traer_sub_caracteristicas($con,$id){
  $arr = [];
  $tipos ="SELECT DISTINCT cod_tipo as tip FROM caracteristicas WHERE cod_padre=".$id;
  $query_tipo = mysqli_query($con,$tipos);

  if (mysqli_num_rows($query_tipo) > 0 ) {
    while ($tipo = $query_tipo->fetch_assoc()) {
      $arr2=[];
      $consulta = "SELECT caracteristicas.Id as Id,caracteristicas.Nombre as Nombre,cod_tipo,tipo_caracteristica.Nombre as NombreTipo,cod_padre FROM `caracteristicas` JOIN tipo_caracteristica ON tipo_caracteristica.Id = caracteristicas.cod_tipo WHERE
       cod_padre=$id AND cod_tipo=".$tipo["tip"];
      $query = mysqli_query($con,$consulta);
      while ($fila = $query->fetch_assoc()) {
        $arr2[]=$fila;
      }
      // print_r($arr2);
      $arr[]=array("Nombre" => $arr2[0]["NombreTipo"],"cod_tipo" => $arr2[0]["cod_tipo"],"select" =>$arr2);
    }
  }
  // die();
  return $arr;
}



 ?>
