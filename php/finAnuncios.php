<?php
$IP = $_SERVER['REMOTE_ADDR'];
if($IP=="185.224.137.115") {
include("conexion.php");
date_default_timezone_set("Europe/Madrid");  
$sql  =  "UPDATE anuncios JOIN membresia ON anuncios.cod_membresia=membresia.Id JOIN registro_membresia ON";
$sql .= " registro_membresia.Id=membresia.cod_registro SET membresia.Tipo=1 WHERE registro_membresia.Fecha_fin <= '".date('Y-m-d H:i:s', time())."'";
mysqli_query($conexion,$sql);
}
 ?>
