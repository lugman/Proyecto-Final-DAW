<?php
require "conexion.php";
if (isset($_POST["id"])) {

  $sql_traer_fotos="SELECT fotos.Nombre FROM `fotos` JOIN anuncios".
  " ON anuncios.Id=fotos.cod_anuncio WHERE anuncios.Id=".$_POST["id"];
$query = mysqli_query($conexion,$sql_traer_fotos);

while ($fila = $query->fetch_assoc()) {
  if (file_exists ("../../uploads/anuncios/".$fila["Nombre"])) {
  unlink("../../uploads/anuncios/".$fila["Nombre"]);
  }
}


  $consult = "DELETE FROM `anuncios` WHERE Id=".$_POST["id"];


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
