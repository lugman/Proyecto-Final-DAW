<?php
include("conexion.php");

$sql = "SELECT * FROM restablecer WHERE token = '{$_POST["token"]}'";
$resultado = mysqli_query($conexion,$sql);

if( mysqli_num_rows($resultado)> 0 ){


   $usuario = mysqli_fetch_array($resultado);
   $sql = "DELETE FROM `restablecer` WHERE id=".$usuario["id"];
   $resultado = mysqli_query($conexion,$sql);
   if( $usuario['usuario'] == $_POST["idUser"] ){
          $sql='UPDATE `usuario` SET Contrasenia="'.md5($_POST["contra"]).'" WHERE Email="'.$_POST["Email"].'"';
          // print($slq);
          $resultado = mysqli_query($conexion,$sql);
          if ($resultado) {
            echo json_encode(array('Res' =>"OK"));
          }else {
            echo json_encode(array('Res' =>"ERROR"));
          }
   }
}else {
  echo json_encode(array('Res' =>"ERROR"));
}

 ?>
