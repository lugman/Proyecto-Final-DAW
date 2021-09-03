<?php
date_default_timezone_set("Europe/Madrid");

echo     "UPDATE anuncios JOIN membresia ON membresia.Id=anuncios.cod_membresia SET anuncios.Fecha_modificacion='$fechaNOW' ".
  "WHERE membresia.Tipo=2 AND anuncios.Fecha_modificacion < DATE_SUB('".date('Y-m-d H:i:s', time())."', INTERVAL 4 HOUR)";





 ?>
