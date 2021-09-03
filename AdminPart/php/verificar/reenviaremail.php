<?php
session_start();
include("conexion.php");
include("../mensaje.php");
$sql="SELECT Email FROM usuario WHERE Id=".$_SESSION["Id"];
$datUs = mysqli_query($conexion,$sql);
$EMAIL = mysqli_fetch_array($datUs);
$EMAIL = $EMAIL["Email"];

$token = md5(time());
$emailencript = md5($EMAIL);

$sql="INSERT INTO `validacionemail`( `EmailToken`, `Token`, `cod_usuario`) VALUES ('$emailencript','$token',{$_SESSION["Id"]})";
$query2 = mysqli_query($conexion,$sql);

$idTOk = mysqli_insert_id($conexion);
$enlace =$_SERVER["SERVER_NAME"].'/validate.php?cod='.$emailencript.'&token='.$token."&Id=$idTOk";
enviarEmail($EMAIL,$enlace);

function enviarEmail( $email, $link ){
  $htmlMensaje="";
  $htmlMensaje .= '<p>';
  $htmlMensaje .= ' <span style="color: #3366ff;"><strong>Enhorabuena acaba de registrarse en Re-ofertas con &eacute;xito.</strong></span></p>';
  $htmlMensaje .= ' <p>Por favor confirme nos que es este su correo pinchando en este enlace.';
  $htmlMensaje .= ' <span style="color: #339966;"><a style="color: #339966;" href="'.$link.'">Confirmar que este es mi correo.</a> </span>';
  $htmlMensaje .= '</p>';
  $env =correo($email,"Verificar email",$htmlMensaje,"Por favor copie este enlace en el  buscador: $link");
  if ($env) {
    echo json_encode(array("Res"=>"OK"));
  }else {
    echo json_encode(array("Res"=>"NO"));
  }
}
 ?>
