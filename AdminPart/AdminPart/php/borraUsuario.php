<?php
require "conexion.php";

if (isset($_POST["id"])) {
$sql_traer_foto="SELECT verificacion.Id as verf,usuario.Foto,verificacion.DNI FROM `usuario` JOIN verificacion ON".
" verificacion.Id=usuario.cod_verificiacacion WHERE usuario.Id=".$_POST["id"];

$query = mysqli_query($conexion,$sql_traer_foto);

while ($fila = $query->fetch_assoc()) {
  if($fila["Foto"]!=""){
  if (file_exists ("../../uploads/usuarios/".$fila["Foto"])) {
  unlink("../../uploads/usuarios/".$fila["Foto"]);
  }
  }
  if($fila["DNI"]!=""){
  if (file_exists ("../../uploads/DNI/pendiente/".$fila["DNI"])) {
   unlink("../../uploads/DNI/pendiente/".$fila["Foto"]);
  }
  if (file_exists ("../../uploads/DNI/rechazado/".$fila["DNI"])) {
   unlink("../../uploads/DNI/rechazado/".$fila["Foto"]);
  }
  if (file_exists ("../../uploads/DNI/verificado/".$fila["DNI"])) {
   unlink("../../uploads/DNI/verificado/".$fila["Foto"]);
  }
}

$query_fotosUsAnuncio  = "SELECT fotos.Nombre AS Nombre  FROM fotos JOIN anuncios ON anuncios.Id=fotos.cod_anuncio WHERE anuncios.cod_usuario=".$_POST["id"];
$fotosAnuncio = mysqli_query($conexion,$query_fotosUsAnuncio);
while ($fila = $fotosAnuncio->fetch_assoc()) {
  if (file_exists ("../../uploads/anuncios/".$fila["Nombre"])) {
  unlink("../../uploads/anuncios/".$fila["Nombre"]);
  }
}




$sql_eliminarMenb ="DELETE FROM `verificacion` WHERE id =".$fila["verf"];
mysqli_query($conexion,$sql_eliminarMenb);
}






  // $consult ;
  $consult ="DELETE FROM `usuario` WHERE Id=".$_POST["id"];


  $query = mysqli_query($conexion,$consult);
  if ($query) {
    echo json_encode(array("Res"=>"OK","Desc"=>"Eliminación finalizada con éxito."));
  }else {
    echo json_encode(array("Res"=>"ERROR","Desc"=>"No se ha podido borrar con exito,porfavor comprueve que no hallan datos que dependan de el."));
  }
}else {
  echo json_encode(array("Res"=>"ERROR","Desc"=>"No datos POST"));
}
exit();


 ?>
