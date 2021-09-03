<?php
include("../subirArchivo.php");
include("conexion.php");
session_start();
if(isset($_FILES["dniFoto"])){
  if(isset($_POST["dni"])){
    $sql="SELECT verificacion.Id as id,verificacion.DNI_VF,verificacion.DNI,verificacion.Email_VF FROM `verificacion`
    JOIN usuario ON usuario.cod_verificiacacion=verificacion.Id WHERE verificacion.DNI != '{$_POST["dni"]}' AND  usuario.Id=".$_SESSION["Id"];
    $consult= mysqli_query($conexion,$sql);
    if (mysqli_num_rows($consult) > 0 ) {
      $consult=mysqli_fetch_array($consult);

      if ($consult["DNI"]=="") {
        if ($consult["DNI_VF"]==0) {
          $resI = subir_imagen("dniFoto","../../uploads/DNI/pendiente",$_POST["dni"]);
          $sql="UPDATE `verificacion` SET `DNI`='{$_POST["dni"]}' WHERE Id=".$consult["id"];
          $consult= mysqli_query($conexion,$sql);
          if ($consult) {
            $res=array('Res' =>"OK");
            echo json_encode($res);
          }
        }
      }
    }else {
      echo json_encode(array('Res' =>"ERROR"));
    }

  }else {
    echo json_encode(array("Res"=>"ERROR","Desc"=>"No correct data POST"));
  }
}else {
  echo json_encode(array("Res"=>"ERROR","Desc"=>"No correct data FILE"));
}




 ?>
