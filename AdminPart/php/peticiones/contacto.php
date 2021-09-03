<?php
include("../mensaje.php");
// require("conexion.php");
// $nom =  mysqli_real_escape_string($conexion, $_POST["Nombre"] );
// $ape  = mysqli_real_escape_string($conexion, $_POST["Apellidos"] );
// $tit  = mysqli_real_escape_string($conexion, $_POST["Titulo"] );
// $desc = mysqli_real_escape_string($conexion, $_POST["Descripcion"] );
$nom =   $_POST["Nombre"];
$ape  =  $_POST["Apellidos"];
$tit  =  $_POST["Titulo"];
$desc =  $_POST["Descripcion"];

$env = correo("inforeofertas@gmail.com","Comunicación contacto",
"<strong>Nombre: $nom $ape</strong><br><h4>Titulo: $tit</h4<br><p>Mensaje: $desc</p>","");
if ($env) {
echo json_encode(array("Res"=>"OK"));
}else {
echo json_encode(array("Res"=>"ERROR"));
}

 ?>
