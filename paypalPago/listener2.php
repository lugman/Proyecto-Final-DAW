<?php
// use PHPMailer\PHPMailer\PHPMailer;
// require "PHPMailer/PHPMailer.php";
// require "PHPMailer/Exception.php";
  if($_SERVER["REQUEST_METHOD"] != "POST") {
    header("location: index.php");
    exit();
  }


  $ch = curl_init();
  curl_setopt($ch,CURLOPT_URL,"https://ipnpb.sandbox.paypal.com/cgi-bin/webscr");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "cmd=_notify-validate&" . http_build_query($_POST));
  $response = curl_exec($ch);
  curl_close($ch);

  file_put_contents("text.txt",$response);

  if ($response == "VERIFIED" && $_POST['receiver_email'] == "re-ofertas@gmail.com") {
    $handle = fopen("test.txt","w");
    fwrite($handle, "POST------------------- \r\n");
    foreach ($_POST as $key => $value) {
        fwrite($handle, "$key => $value \r\n");
    }
    fwrite($handle, "GETS------------------- \r\n");
    foreach ($_GET as $key => $value) {
        fwrite($handle, "$key => $value \r\n");
    }
    fclose($handle);
    $cEmail = $_POST['payer_email'];
    $cEmail = "lugman@gmail.com";
    $name = $_POST['first_name'] . " " . $_POST['last_name'];
    $mail = new PHPMailer();

    $mail->setFrom("re-ofertas@gmail.com", "Re-ofertas");
    $mail->addAddress($cEmail, $name);
    $mail->Subject = "Membresía adquirida con exito";
    $mail->Body = "Gracias por confiar en nosotros y esperamos que cumpla sus objetivos.
Un saludo Re-ofertas.    ";

    $mail->send();


  }
?>
