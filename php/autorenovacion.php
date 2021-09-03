<?php
// Agregar(2,"Auto");


function Agregar($idAnuncio,$tipo){
 include("conexion.php");
 $sql = "SELECT membresia.Id as membresia,registro_membresia.Id as registro FROM";
 $sql .=" anuncios JOIN membresia ON membresia.Id=anuncios.cod_membresia JOIN registro_membresia";
 $sql .=" ON membresia.cod_registro=registro_membresia.Id WHERE anuncios.Id=".$idAnuncio;

 // print_r($sql);
 if ($consulta = mysqli_query($conexion,$sql)) {
   $codes = mysqli_fetch_array($consulta);
   switch ($tipo) {
    case 'Dest':
    Destacar($codes["registro"],$codes["membresia"]);
    break;
    case 'Auto':
    Autorenovacion($codes["registro"],$codes["membresia"]);
    break;
   }
 }
}


function Autorenovacion($idRegistro,$IdMembresia){
 include("conexion.php");
 $fechaInicio =   date('Y-m-d', time())." 00:00:00";
 $fechaFin=   date('Y-m-d', time()+60*60*24*4)." 00:00:00";
 $fecha="UPDATE `registro_membresia` SET `Fecha_inicio`='$fechaInicio',`Fecha_fin`='$fechaFin' WHERE Id=".$idRegistro;
 $autorenovacion = "UPDATE `membresia` SET `Tipo`=2 WHERE Id=".$IdMembresia;
 if (mysqli_query($conexion,$fecha)) {
   if (mysqli_query($conexion,$autorenovacion)) {
       echo json_encode(array("Res"=>"OK"));
   }
 }
}


function Destacar($idRegistro,$IdMembresia){
  include("conexion.php");
  $fechaInicio =   date('Y-m-d', time())." 00:00:00";
  $fechaFin =   date('Y-m-d', time()+60*60*24*2)." 00:00:00";
  $fecha="UPDATE `registro_membresia` SET `Fecha_inicio`='$fechaInicio',`Fecha_fin`='$fechaFin' WHERE Id=".$idRegistro;
  $destacado = "UPDATE `membresia` SET `Tipo`=3 WHERE Id=".$IdMembresia;
  if (mysqli_query($conexion,$fecha)) {
    if (mysqli_query($conexion,$destacado)) {
        echo json_encode(array("Res"=>"OK"));
    }
  }
}



 ?>
