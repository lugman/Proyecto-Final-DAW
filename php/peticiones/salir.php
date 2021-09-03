<?php
// Cerrar sesión.
      session_start();
      $_SESSION["Login"] = "";
      $_SESSION["Id"] = "";
      $_SESSION["Nombre"] = "";
      $_SESSION = array();

      session_destroy();

      if (isset($_SESSION['Login'])){
      echo json_encode(array('Res' => "Error: No se han recibido datos de POST"));
      }

      echo json_encode(array("Res" => "OK"));

 ?>
