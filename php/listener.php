<?php
include("mensaje.php");

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


  if ($response == "VERIFIED" && $_POST['receiver_email'] == "re-ofertas@gmail.com") {



    foreach ($_POST as $key => $value) {
    }

  if ($_POST["item_number"] == "Dest")
  {
    $res = Agregar($_POST["custom"],$_POST["item_number"]);
     $env = correo($res["Email"],
     "Membresía adquirida",
     "<h3>Enhorabuena {$res["Nombre"]} {$res["Apellidos"]} acaba de adquirir una membresía de tipo Anuncio principal,
     ahora ademas de verse anuncio en la zona de búsqueda saldrá en orden aleatorio en la zona de principal de la página.</h3>",
     "Enhorabuena {$res["Nombre"]} {$res["Apellidos"]} acaba de adquirir una membresía de tipo Anuncio principal,
     ahora ademas de verse anuncio en la zona de búsqueda saldrá en orden aleatorio en la zona de principal de la página.");

  }
  else if($_POST["item_number"] == "Auto")
  {
    $res = Agregar($_POST["custom"],$_POST["item_number"]);
    $env = correo($res["Email"],
    "Membresía adquirida",
    "<h3>Enhorabuena {$res["Nombre"]} {$res["Apellidos"]} acaba de adquirir una membresía de tipo Auto renovación,
    ahora su anuncio se renovara en un plazo de máximo  4 horas y así conseguirá que la gente se entere de que tu anuncio esta aún en venta sin que usted tenga que renovarlo manualmente.</h3>",
    "Enhorabuena {$res["Nombre"]} {$res["Apellidos"]} acaba de adquirir una membresía de tipo tipo Auto renovación,
    ahora su anuncio se renovara en un plazo de máximo  4 horas y así conseguirá que la gente se entere de que tu anuncio esta aún en venta sin que usted tenga que renovarlo manualmente.");
 }



}
    function Agregar($idAnuncio,$tipo){
      include("conexion.php");
      $sql = "SELECT membresia.Id as membresia,registro_membresia.Id as registro FROM";
      $sql .=" anuncios JOIN membresia ON membresia.Id=anuncios.cod_membresia JOIN registro_membresia";
      $sql .=" ON membresia.cod_registro=registro_membresia.Id WHERE anuncios.Id=".$idAnuncio;

      $consultaDatosUs = "SELECT DISTINCT usuario.Nombre,usuario.Apellidos,usuario.Email FROM `anuncios` JOIN usuario";
      $consultaDatosUs .=" ON usuario.Id=anuncios.cod_usuario WHERE anuncios.Id =".$idAnuncio;

      // print_r($sql);
      if ($consulta = mysqli_query($conexion,$sql)) {
        $codes = mysqli_fetch_array($consulta);
        switch ($tipo) {
          case 'Dest':
          Destacar($codes["registro"],$codes["membresia"]);
          return mysqli_fetch_array(mysqli_query($conexion,$consultaDatosUs));
          break;
          case 'Auto':
          Autorenovacion($codes["registro"],$codes["membresia"]);
          return mysqli_fetch_array(mysqli_query($conexion,$consultaDatosUs));
          break;
        }
      }
    }


    function Autorenovacion($idRegistro,$IdMembresia){
      date_default_timezone_set("Europe/Madrid");
      include("conexion.php");
      $fechaInicio =  date('Y-m-d H:i:s', time());
      $fechaFin=   date('Y-m-d H:i:s', time()+60*60*24*4);
      $fecha="UPDATE `registro_membresia` SET `Fecha_inicio`='$fechaInicio',`Fecha_fin`='$fechaFin' WHERE Id=".$idRegistro;
      $autorenovacion = "UPDATE `membresia` SET `Tipo`=2 WHERE Id=".$IdMembresia;
      if (mysqli_query($conexion,$fecha)) {
        if (mysqli_query($conexion,$autorenovacion)) {
          echo json_encode(array("Res"=>"OK"));
        }
      }
    }

  function Destacar($idRegistro,$IdMembresia){
    date_default_timezone_set("Europe/Madrid");    
    include("conexion.php");
    $fechaInicio =   date('Y-m-d H:i:s', time());
    $fechaFin =   date('Y-m-d H:i:s', time()+60*60*24*2);
    $fecha="UPDATE `registro_membresia` SET `Fecha_inicio`='$fechaInicio',`Fecha_fin`='$fechaFin' WHERE Id=".$idRegistro;
    $destacado = "UPDATE `membresia` SET `Tipo`=3 WHERE Id=".$IdMembresia;
    if (mysqli_query($conexion,$fecha)) {
      if (mysqli_query($conexion,$destacado)) {
        echo json_encode(array("Res"=>"OK"));
      }
    }
  }
?>
