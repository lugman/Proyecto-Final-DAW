<?php
$email = $_POST['email'];
include("conexion.php");

if( $email != "" ){

   $sql = " SELECT * FROM users WHERE email = '$email' ";
   $resultado = $conexion->query($sql);

   if($resultado->num_rows > 0){
      $usuario = $resultado->fetch_assoc();
      $linkTemporal = generarLinkTemporal( $usuario['id'], $usuario['username'] );

      if($linkTemporal){

        enviarEmail( $email, $linkTemporal );

        $respuesta = array("Res" => "OK");
      }
   }
   else
   {
     $respuesta = array("Res" => "ERROR en correo");
   }
}
else
{
  $respuesta = array("Res" => "NO Email");
}

 echo json_encode( $respuesta );


function generarLinkTemporal($idusuario, $username){
   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
   $token = sha1($cadena);


   $sql = "INSERT INTO tblreseteopass (idusuario, username, token, creado) VALUES($idusuario,'$username','$token',NOW());";

   $resultado = $conexion->query($sql);
   if($resultado){
      $enlace = $_SERVER["SERVER_NAME"].'/pass/restablecer.php?idusuario='.sha1($idusuario).'&token='.$token;
      return $enlace;
   }
   else
      return FALSE;
}

function enviarEmail( $email, $link ){
   file_put_contents("mensaje.txt", $link);
}

 ?>
