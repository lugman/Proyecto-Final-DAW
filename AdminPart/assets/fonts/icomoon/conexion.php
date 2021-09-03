<?php
  $conexion = mysqli_connect("localhost","root","","re-ofertas");
  mysqli_set_charset($conexion, "utf8");
  if (mysqli_connect_errno()){
    echo "Error al conectarse".mysqli_connect_error();
  }
 ?>
