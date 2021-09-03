<?php
include("conexion.php");
include("mensaje.php");
date_default_timezone_set("Europe/Madrid");
$fechaNOW =  date('Y-m-d H:i:s', time());

$email = $_POST['email'];


if( $email != "" )
{

   $sql = "SELECT * FROM `usuario` WHERE Email='$email'";
   $resultado = mysqli_query($conexion,$sql);

   if(mysqli_num_rows($resultado)> 0)
   {
      $usuario = mysqli_fetch_assoc($resultado);
      $linkTemporal = generarLinkTemporal($usuario['Id'], $usuario['Email'] ,$conexion);

      if($linkTemporal)
      {

        if (enviarEmail( $email, $linkTemporal )) {
          $respuesta = array("Res" => "OK");
        }else
        {
          $respuesta = array("Res" => "Err");
        }

      }else {
        $respuesta = array("Res" => "ERROR Generar");
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
function generarLinkTemporal($idusuario, $username,$con){
  date_default_timezone_set("Europe/Madrid");

   // Se genera una cadena para validar el cambio de contraseña
   $cadena = $idusuario.$username.rand(1,9999999).date('Y-m-d');
   $token = sha1($cadena);

   $fechaNOW =  date('Y-m-d H:i:s', time());

   $sql = "INSERT INTO restablecer (usuario, email, token, creado) VALUES($idusuario,'$username','$token','$fechaNOW');";
   $resultado = mysqli_query($con,$sql);
   if($resultado){
      $enlace = $_SERVER["SERVER_NAME"].'/restablecer.php?rest='.sha1($idusuario).'&idusuario='.$idusuario.'&token='.$token."&Email=$username";
      return $enlace;
   }
   else
   // echo mysqli_error($con);
      return false;
}

function enviarEmail( $email, $link ){
  $htmlMensaje="";
  $htmlMensaje .= '<html>';
  $htmlMensaje .= ' <head>';
  $htmlMensaje .= '    <title>Restablece tu contraseña</title>';
  $htmlMensaje .= '    <meta charset="utf-8">';
  $htmlMensaje .= '';
  $htmlMensaje .= ' </head>';
  $htmlMensaje .= ' <body>';
  $htmlMensaje .= '   <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>';
  $htmlMensaje .= '   <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>';
  $htmlMensaje .= '   <p>';
  $htmlMensaje .= '     <strong>Enlace para restablecer tu contraseña</strong><br>';
  $htmlMensaje .= '     <a href="'.$link.'"> Restablecer contraseña </a>';
  $htmlMensaje .= '   </p>';
  $htmlMensaje .= ' </body>';
  $htmlMensaje .= '</html>';
   if (correo($email,"Recuperación contraseña",$htmlMensaje,"Dirección para restablecer la contraseña :'.$link.'")) {
    return true;
   }else {
    return false;
  }
}


 ?>
