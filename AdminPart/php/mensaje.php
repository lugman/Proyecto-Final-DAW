<?php
if(file_exists ( '../PHPMailer/PHPMailerAutoload.php' )){
  require '../PHPMailer/PHPMailerAutoload.php';
}else {
  require '../../PHPMailer/PHPMailerAutoload.php';
}
//Pruebas
// require 'PHPMailer/PHPMailerAutoload.php';
function correo($direccion,$titulo,$HTML,$noHTML){
  $mail = new PHPMailer;
  $mail->CharSet = 'UTF-8';


  $mail->SMTPDebug = 3;
  $headers = "Content-Type: text/html; charset=UTF-8";

  $mail->setFrom('inforeofertas@gmail.com', 'Re-ofertas');
  $mail->addAddress($direccion);

  $mail->isHTML(true);

  $mail->Subject = $titulo;
  $mail->Body    = $HTML;
  $mail->AltBody = $noHTML;

  if($mail->send())
  {
    return "true";
  }
  else
  {
   return "false";
  }
}


// if (correo()) {
//   echo "Ok";
// }else {
//   echo "ERR";
// }




?>
