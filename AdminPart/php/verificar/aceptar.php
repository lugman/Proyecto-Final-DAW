<?php
include("conexion.php");
session_start();
// print_r($_POST);
$sql="SELECT verificacion.Id as id,verificacion.DNI_VF,verificacion.DNI,verificacion.Email_VF
FROM `verificacion` JOIN usuario ON usuario.cod_verificiacacion=verificacion.Id WHERE  verificacion.DNI='".$_POST["dni"]."'";
$consult = mysqli_query($conexion,$sql);
// print_r($consult -> fetch_array());
// die();
if (mysqli_num_rows($consult)!=1) {
  echo json_encode(array('Res' =>"ERROR" ,"Desc"=>"Error En la Verificacion de la foto."));
}else {
  $consult = mysqli_fetch_array($consult);
  print_r($consult);
  if ($_POST["verificar"]=="true") {
    $sql="UPDATE `verificacion` SET `DNI_VF`=1 WHERE Id=".$consult["id"];
    $consult = mysqli_query($conexion,$sql);
    $path1 ="../../uploads/DNI/pendiente/".$_POST["foto"];
    $path2 ="../../uploads/DNI/verificado/".$_POST["foto"];
    echo json_encode(array('Res' =>"OK" ,"Desc"=>"Dni Aceptado con exito","cambioDir"=>moverArchivo($path1,$path2)));

  }else {
    $sql="UPDATE `verificacion` SET `DNI`='' , `MensajeDNI`='".$_POST["men"]."' WHERE Id=".$consult["id"];
    $consult = mysqli_query($conexion,$sql);
    if ($consult) {
      $path1 ="../../uploads/DNI/pendiente/".$_POST["foto"];
      $path2 ="../../uploads/DNI/rechazado/".$_POST["foto"];
      echo json_encode(array('Res' =>"OK" ,"Desc"=>"Dni Rechazado con exito","cambioDir"=>moverArchivo($path1,$path2)));
    }
  }
}


function moverArchivo($currentFilePath,$newFilePath){


$fileMoved = rename($currentFilePath, $newFilePath);

if($fileMoved){
    return true;
}else {
  return false;
}

}
 ?>
