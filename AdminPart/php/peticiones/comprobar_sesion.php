<?php
// Comprovar si la sesión esta activa y con que usuario.
include("conexion.php");

session_start();

 if (isset($_SESSION["login"]))
  {
    $consulta_bloqueo_sql = 'SELECT * FROM `bloquear_usuario` WHERE cod_usuario='.$_SESSION["Id"];
    $query_bloq = mysqli_query($conexion,$consulta_bloqueo_sql);
    if (mysqli_num_rows($query_bloq) > 0) {
      echo json_encode(array('Res' => "NO"));
      $_SESSION["Login"] = "";
      $_SESSION["Id"] = "";
      $_SESSION["Nombre"] = "";
      $_SESSION = array();
      session_destroy();
      exit();
    }
    // Si  hay una sesión iniciada devolbemos el id del usuario su nombre y la respuesta de que si.
    $Us =  [];
    // Respuesta.
    $Us["Res"]  = "OK";
    // Información sobre el usuari.
    $Us["Id"]  = $_SESSION["Id"];
    $Us["Nombre"]  = $_SESSION["Nombre"];
    echo  json_encode($Us);
  }
  else
  {
    echo json_encode(array('Res' => "NO"));
  }
 ?>
