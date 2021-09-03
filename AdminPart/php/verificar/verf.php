<?php
include("conexion.php");
session_start();
$sql="SELECT verificacion.DNI_VF,verificacion.DNI,verificacion.Email_VF,verificacion.MensajeDNI FROM `verificacion` JOIN usuario ON usuario.cod_verificiacacion=verificacion.Id WHERE usuario.Id=".$_SESSION["Id"];
$consult= mysqli_query($conexion,$sql);
if (mysqli_num_rows($consult) > 0) {
  $consult=mysqli_fetch_array($consult);
  // echo json_encode($consult["DNI_VF"]);
  // echo json_encode($consult["DNI"]);
  // echo json_encode($consult["Email_VF"]);
  if ($consult["DNI"]=="") {
    if ($consult["DNI_VF"]==0) {
      $estado="PorVerf";
    }
  }else {
    if ($consult["DNI_VF"]==0) {
      $estado="EnProcesoV";
    }else {
      $estado="Verificdo";
    }
  }
  if ($consult["Email_VF"]==0) {
    $estadoE="PorVerf";
  }else {
    $estadoE="Verificdo";
  }
  $res=array(
  'Res' =>"OK",
  'Estado' =>$estado,
  'EstadoEmail'=>$estadoE,
  'mensaje' => $consult["MensajeDNI"]

  );
  echo json_encode($res);
}else {
  echo json_encode(array('Res' =>"ERROR"));
}

 ?>
