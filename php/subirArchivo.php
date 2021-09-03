<?php
function subir_imagen($nombreFoto,$ayudaRuta,$cambioNombre=""){

  if (isset($_FILES[$nombreFoto]) && $_FILES[$nombreFoto]['size'] > 0)
   {
    // Lugar
    (!defined('KB')?define('KB', 1024):"");
    (!defined('MB')?define('MB', 1048576):"");


    $direccion = "../../uploads/".$ayudaRuta."/";
    if (!file_exists($direccion)) {
      $direccion = "../uploads/".$ayudaRuta."/";
    }
    //Ruta  a subir
    $nombre_imagen = $_FILES[$nombreFoto]["name"];
    $direccion_subir = $direccion . basename($nombre_imagen);
    $nombre_temporal = $_FILES[$nombreFoto]["tmp_name"];

    $estado = array("Res"=>"OK");
    $imageFileType = strtolower(pathinfo($direccion_subir,PATHINFO_EXTENSION));

    // comprovar si es una imagen o es false
    $check = getimagesize($nombre_temporal);
    if($check === false)
    {
      $estado = array("Res"=>"NO","Descripcion"=>"FALSA");
      return $estado;
    }
    // comprovar si existe
    if($cambioNombre!=""){
      $direccion_subir = $direccion . basename($cambioNombre.".".$imageFileType);
    }else {

    if (file_exists($direccion_subir))
    {
      $nobreDefecto = "imagen.".$imageFileType;
      $indice_imagen = 1;

      $direccion_subir = $direccion . basename($nobreDefecto);
      while(file_exists($direccion_subir))
      {
        $nobreDefecto = "imagen0".$indice_imagen.".".$imageFileType;
        $nombre_imagen = $nobreDefecto;
        $direccion_subir = $direccion . basename($nobreDefecto);
        $indice_imagen++;
      }

    }

  }

    // Tamaño.
    if ($_FILES[$nombreFoto]["size"] > 2*MB) {
      $estado = "GRANDE";
      return $estado;
    }
    // comprovar si el tipo
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
     {
      $estado = array("Res"=>"NO","Descripcion"=>"FORMATO NO ADMITIDO");
      return $estado;
     }

    // Comprovaciones
    if ($estado["Res"] == "OK")
    {
      if (move_uploaded_file($nombre_temporal, $direccion_subir))
       {
         $estado = array("Res"=>"OK","Descripcion"=>"Subida correctamente","img"=>$nombre_imagen);
         return $estado;
        } else
        {
          $estado = array("Res"=>"NO","Descripcion"=>"ERROR AL SUBIR");
          return $estado;
        }
    }
  }
  else
  {
    return $estado = array("Res"=>"NO","Descripcion"=>"VACIO");;
  }
}
?>
