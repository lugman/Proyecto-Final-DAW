<?php
// Incluimos la configuración de la conexión.
require("conexion.php");

// Comprovamos el tipo de petición que queremos realizar.
if (isset($_GET["funcion"])) {

  switch($_GET["funcion"]){
// Funcion traer ciudades.
    case "ciudades":
    ciudades($conexion);
    break;

// Funcion traer Categorías.
    case "categorias":
    categorias($conexion);
    break;

// Funcion traer Sub_categorías.
    case "sub_categorias":
    sub_categorias($conexion,$_GET["cat_padre"]);
    break;
    //Traer modelos
    case "modelos":
    modelos($conexion,$_GET["cat_padre"]);
    break;

//Traer modelos
    case "marcas":
    marcas($conexion,$_GET["cat_padre"]);
    break;

    case "imagenes":
    echo json_encode(imagenes($conexion,$_GET["Id"]));
    break;

    case 'caracteristicas':
      $caracteristicas = traer_caracteristicas($conexion,$_GET["Id"]);
      echo json_encode($caracteristicas);
      break;

    case 'sub_caracteristicas':
        $caracteristicas = traer_sub_caracteristicas($conexion,$_GET["Id"]);
        echo json_encode($caracteristicas);
      break;
    case 'usuario':
          $caracteristicas = usuario($conexion,$_GET["Id"]);
          echo json_encode($caracteristicas);
      break;
    case 'clasificacion':
            $caracteristicas = clasificacion($conexion,$_GET["Id"]);
            echo $caracteristicas;
      break;
  }
}
else
{
  echo json_encode(array("Res" => "ERROR","Descripcion" => "No Se encontraron parametros GET","Tipo_parametros_Buscados" => "funcion"));
}



  function ciudades($conexion)
  {
   $consulta_ciudades = 'SELECT `Id`, `Nombre` FROM `ciudades` ORDER BY Nombre';

   $respuesta = mysqli_query($conexion,$consulta_ciudades);

   $respuesta_json=[];
   while($elemento = mysqli_fetch_assoc($respuesta))
   {
    $respuesta_json[]=$elemento;
   }
   echo json_encode($respuesta_json);
  }

 function categorias($conexion)
 {
   $consulta_categorias = 'SELECT `Id`, `Nombre`, `cod_padre` FROM `categorias` WHERE cod_padre is NULL ORDER BY Nombre';

   $respuesta = mysqli_query($conexion,$consulta_categorias);

   $respuesta_json=[];
   while($elemento = mysqli_fetch_assoc($respuesta))
   {
    $respuesta_json[]=$elemento;
   }
   echo json_encode($respuesta_json);

 }

 function sub_categorias($conexion,$padre)
 {
   $consulta_categorias = 'SELECT * FROM `categorias` WHERE `cod_padre` ='.$padre;


   $respuesta = mysqli_query($conexion,$consulta_categorias);

   $respuesta_json=[];
   while($elemento = mysqli_fetch_assoc($respuesta))
   {
    $respuesta_json[]=$elemento;
   }
   echo json_encode($respuesta_json);

 }

 function modelos($conexion,$padre)
 {
   $consulta_categorias = 'SELECT `Id`, `Nombre`, `cod_categoria` FROM `modelos` WHERE cod_categoria='.$padre;


   $respuesta = mysqli_query($conexion,$consulta_categorias);

   $respuesta_json=[];
   while($elemento = mysqli_fetch_assoc($respuesta))
   {
    $respuesta_json[]=$elemento;
   }
   echo json_encode($respuesta_json);

 }
 function marcas($conexion,$padre)
 {
   $consulta_categorias = 'SELECT marcas.Id as Id ,marcas.Nombre FROM `categorias_marcas` JOIN marcas ON marcas.Id=categorias_marcas.cod_marca WHERE cod_categoria='.$padre;


   $respuesta = mysqli_query($conexion,$consulta_categorias);

   $respuesta_json=[];
   while($elemento = mysqli_fetch_assoc($respuesta))
   {
    $respuesta_json[]=$elemento;
   }
   echo json_encode($respuesta_json);

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
 function imagenes($conexion,$idAnuncio){

   $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
   $consultaFotos.= " WHERE anuncios.Id={$idAnuncio} ORDER by fotos.Id ";

   $resFotos = mysqli_query($conexion,$consultaFotos);

   $arr=[];
   while ($fila = mysqli_fetch_assoc($resFotos)) {
     $arr[]=$fila["Nombre"];
   }
   // print_r($arr2);

 return $arr;
 }
 function usuario($conexion,$idUsuario){

   $consultaUs="SELECT usuario.Id, `Nombre`, `Email`, `Telefono_1`, `Telefono_2`, `Foto`, `cod_ciudad`, `Poblacion`,verificacion.DNI_VF,verificacion.Email_VF ";
   $consultaUs.= " FROM `usuario` JOIN verificacion ON verificacion.Id=usuario.cod_verificiacacion WHERE usuario.Id=$idUsuario";

   $resUs = mysqli_query($conexion,$consultaUs);

   $arr=[];
   while ($fila = mysqli_fetch_assoc($resUs)) {
     $consultaCity="SELECT `Nombre` FROM `ciudades` WHERE Id=".$fila["cod_ciudad"];
     $resCity = mysqli_query($conexion,$consultaCity);
     $fila["Ciudad"]=mysqli_fetch_assoc($resCity)["Nombre"];
     $arr[]=$fila;
   }


   // print_r($arr2);

 return $arr;
 }
 function clasificacion($conexion,$idUsuario){

   $consultaUs="SELECT AVG(Valoracion) as val FROM `valoracion` JOIN anuncios ON anuncios.Id=valoracion.cod_anuncio JOIN usuario
    ON anuncios.cod_usuario=usuario.Id WHERE usuario.Id=$idUsuario";

   $resUs = mysqli_fetch_assoc(mysqli_query($conexion,$consultaUs))["val"];

   return ($resUs==""?"NO":$resUs);
 }

 ?>
