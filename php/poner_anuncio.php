<?php
session_start();
require("conexion.php");
date_default_timezone_set("Europe/Madrid");
$fechaNOW =  date('Y-m-d H:i:s', time());
// Ejecutamos la consulta De realizar Inserción.
// Le pasamos  los nombrees de las imagenes que hemos subido.
// echo "<pre>";
$caracteristicas = array();
$categoria  = array();
// print_r($_POST);

foreach ($_POST as $key => $value) {
  if(substr($key, 0, 4 ) == "car-"){
      if ($value!="NO") {
    array_push($caracteristicas,$value);
    }
  }
}
foreach ($_POST as $key => $value) {
    if(substr($key, 0, 4 ) == "cat-"){
        if ($value!="NO") {
      array_push($categoria,$value);
    }
  }
}

$sql_resgistro = "INSERT INTO `registro_membresia`(`Fecha_inicio`, `Fecha_fin`) VALUES ('$fechaNOW','$fechaNOW');";
$queryAnuncio  = mysqli_query($conexion,$sql_resgistro);
$idResgistro   = mysqli_insert_id($conexion);
$sql_membresia = "INSERT INTO `membresia`( `Tipo`, `cod_registro`) VALUES (1,$idResgistro)";
$queryAnuncio  = mysqli_query($conexion,$sql_membresia);
$idMemebresia  = mysqli_insert_id($conexion);

$respuesta="";
$id_us = $_SESSION["Id"];

$sql_anuncio = "INSERT INTO";
$sql_anuncio .="`anuncios` (`Nombre`, `Descripcion`, `Fecha`, `cod_usuario`, `cod_ciudad`, `Precio`, `Extra`, `Poblacion`, `cod_estado`, `cod_membresia`, `Fecha_modificacion`)";
$sql_anuncio .=" VALUES ";

$sql_anuncio .="('{$_POST["titulo"]}', '{$_POST["desc"]}','$fechaNOW', '$id_us', '{$_POST["cod_ciudad"]}', '{$_POST["precio"]}', '{$_POST["extra"]}', '{$_POST["poblacion"]}', '2', $idMemebresia, '$fechaNOW');";
$queryAnuncio = mysqli_query($conexion,$sql_anuncio);
//--------------INSERT--------------------------
if ($queryAnuncio) {
  $respuesta="1,0,0";

$idInsertado = mysqli_insert_id($conexion);


$sqlCaracteristics = [];
if (count($caracteristicas)>0) {
    foreach ($caracteristicas as  $value) {
    $sqlCaracteristics[] = "INSERT INTO `caracteristica_anuncio` (`cod_caracteristica`, `cod_anuncio`) VALUES ('$value', '$idInsertado'); ";
  }
}
$sqlCategorias = [];
if (count($categoria)>0) {
    foreach ($categoria as  $value) {
    $sqlCategorias[] = "INSERT INTO `categoria_anuncio` (`cod_categoria`, `cod_anuncio`) VALUES ('$value', '$idInsertado');";
  }
}
$res = true;
foreach ($sqlCaracteristics as  $value) {
  if (!mysqli_query($conexion,$value)) {
    $res = false;
  }
}
$res2 = true;
foreach ($sqlCategorias as  $value) {
  if (!mysqli_query($conexion,$value)) {
    $res2 = false;
  }
}


  if ($res) {
    $respuesta="1,11,0";
      if (!$res) {
        $respuesta="1,10,0";
      }

        $imagensNombres = RecogerImagen();
        // $idAnuncio = mysqli_insert_id($conexion);
        if( count($imagensNombres) > 0 )
        {
          $queryFotos="";
          $res3 =  true;

          for ($i=0; $i < count($imagensNombres) ; $i++) {
            //Recuperamos la Id de la foto subida.
            // Insertamos los identificadores en la tabla.
            $image = $imagensNombres[$i];

            // $id = mysqli_insert_id($conexion);
            $queryFotos = 'INSERT INTO `fotos` ( `cod_anuncio`, `Nombre`) VALUES ('.$idInsertado.',"'.$image.'")';
            $queryFotos = mysqli_query($conexion,$queryFotos);
            if (!$queryFotos) {
              $res3 =  false;
            }
          }



          if ($queryFotos) {

            $respuesta="1,1,1";

          }else {
            $respuesta="1,1,0";

          }
        }
      }
      else {
        $respuesta="1,0,0";

      }

      }else{
        $respuesta="0,0,0";
      }
     //Recuperamos la Id del anuncio.

      header('Location:  ../index.php?page=mis_anuncios');




function RecogerImagen(){
  //Introducimos el archivo de subir imagenes.
  include("subirArchivo.php");
  //Array donde introducir las imagenes a subir.
  $imagenesArr = [];
// Si  existe se añade si no no.
  (isset($_FILES["imagen1"]) ?   $imagenesArr[]="imagen1" : '');
  (isset($_FILES["imagen2"]) ?   $imagenesArr[]="imagen2" : '');
  (isset($_FILES["imagen3"]) ?   $imagenesArr[]="imagen3" : '');
  (isset($_FILES["imagen4"]) ?   $imagenesArr[]="imagen4" : '');
  //Creamos el array que contendra el nombres de las imagenes subidas.
  $imagenesArrOK=[];
  foreach ($imagenesArr as $val)
  {
    // Devuelve información.
    $subir = subir_imagen($val,"anuncios");
  // si se consigue subir la foto  la añadimos al array imagenes subidas.
    if ($subir["Res"]=="OK") {
      $imagenesArrOK[]=$subir["img"];
    }
  }
  // Devolbemos un array con el nombre de las imagenes subidas
  return $imagenesArrOK;
}

 ?>
