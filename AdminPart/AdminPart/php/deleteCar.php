<?php
require "conexion.php";
if (isset($_POST["ids"])) {


  $consult ="SELECT * from anuncios JOIN caracteristica_anuncio ON ".
  "caracteristica_anuncio.cod_anuncio=anuncios.Id WHERE caracteristica_anuncio.cod_caracteristica IN (".implode("', '", $_POST["ids"]).")";
  $query = mysqli_query($conexion,$consult);

  if (mysqli_num_rows($query) > 0) {
    echo json_encode(array("Res"=>"EX"));
  }else {
    $consult = "DELETE FROM `caracteristicas` WHERE Id IN";
    $consult.="('".implode("', '", $_POST["ids"])."') ";
    $query = mysqli_query($conexion,$consult);
    if ($query) {
      echo json_encode(array("Res"=>"OK","Desc"=>"Eliminación finalizada con éxito."));
    }else {
      echo json_encode(array("Res"=>"ERROR","Desc"=>"No se ha podido borrar con exito,porfavor comprueve que no disponga datos que dependan de el."));
    }
  }
  }
 ?>
