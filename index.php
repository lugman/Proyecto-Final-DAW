<?php
// Comienzo general.
include("estructura/cabecera.php");
//Menu
include("estructura/barra_menu.php");

// ----------------Centro.

//Si le indicamos pagina la carga si no carga la por defecto.
if (isset($_GET["page"]))
 {
     include("Vistas/".$_GET["page"].".php");
}
else
 {
  include("Vistas/indice.php");
}


//---------------- Fin centro.
// Parte abajo.
//Footer
include("estructura/pie.html");
 ?>
