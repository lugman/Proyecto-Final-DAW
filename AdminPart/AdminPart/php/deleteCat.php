<?php
require "conexion.php";
if (isset($_POST["enviar"])) {


  $consult ="SELECT * FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id WHERE categoria_anuncio.cod_categoria=".$_POST["enviar"]["num"];
  $query = mysqli_query($conexion,$consult);

  if (mysqli_num_rows($query) > 0) {
    echo json_encode(array("Res"=>"EX"));
  }else {

      $consult = "DELETE FROM `categorias` WHERE categorias.Id =".$_POST["enviar"]["num"];
      $query = mysqli_query($conexion,$consult);

    if ($query) {
      echo json_encode(array("Res"=>"OK","Desc"=>"Eliminación finalizada con éxito."));
    }else {
      echo json_encode(array("Res"=>"ERROR","Desc"=>"No se ha podido borrar con exito,porfavor comprueve que no disponga datos que dependan de el."));
    }

  }
}

 ?>
