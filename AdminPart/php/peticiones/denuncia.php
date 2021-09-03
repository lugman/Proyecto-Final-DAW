<?php
require("conexion.php");
include("../mensaje.php");
session_start();

if (isset($_POST["Tipo"])) {

if($_POST["Tipo"]=="anuncio"){

$sql_denuncia_anuncio="INSERT INTO `denuncia_anuncio`(`cod_anuncio`, `Causa`, `Descripcion`)";
$sql_denuncia_anuncio.=" VALUES ({$_POST["Id"]},'{$_POST["Causa"]}','{$_POST["Desc"]}')";
 if (mysqli_query($conexion,$sql_denuncia_anuncio)) {
 echo json_encode(array("Res"=>"OK"));
  correo($_POST["Email"],"Denuncia","Anuncio denunciado, causa: {$_POST["Causa"]} en caso de que sean ciertas las causas son ciertas le bloquearemos la cuenta ante cualquier duda: inforeofertas@gmail.com.","Anuncio denunciado, causa: {$_POST["Causa"]} en caso de que sean ciertas las causas le bloquearemos la cuenta ante cualquier duda: inforeofertas@gmail.com.");
  correo("inforeofertas@gmail.com","Denuncia","Anuncio denunciado Id anuncio={$_POST["Id"]} ,Usuario= {$_POST["Email"]} causa: {$_POST["Causa"]}.","Anuncio denunciado Id anuncio={$_POST["Id"]} ,Usuario= {$_POST["Email"]} causa: {$_POST["Causa"]}.");
}else {
  echo json_encode(array("Res"=>"ERROR"));
}

}else if($_POST["Tipo"]=="usuario"){

  $sql_denuncia_usuario="INSERT INTO `denuncia_usuario`( `cod_usuario`, `Causa`, `Descripcion`)";
  $sql_denuncia_usuario.=" VALUES ({$_POST["Id"]},'{$_POST["Causa"]}','{$_POST["Desc"]}')";

   if (mysqli_query($conexion,$sql_denuncia_usuario)) {
   echo json_encode(array("Res"=>"OK"));
    correo($_POST["Email"],"Denuncia","Usuario denunciado, causa: {$_POST["Causa"]} en caso de que sean ciertas las causas le bloquearemos la cuenta ante cualquier duda: inforeofertas@gmail.com.","Usuario denunciado, causa: {$_POST["Causa"]} en caso de que sean ciertas las causas le bloquearemos la cuenta ante cualquier duda: inforeofertas@gmail.com.");
    correo("inforeofertas@gmail.com","Denuncia","Usuario denunciado {$_POST["Email"]} causa: {$_POST["Causa"]} ","Usuario denunciado {$_POST["Email"]} causa: {$_POST["Causa"]}");
  }else {
    echo json_encode(array("Res"=>"ERROR"));
  }

}
}

if (isset($_GET["traer"])) {
  if($_GET["traer"]=="usuarios"){
    $sql_traer_usuarios="SELECT usuario.Id,usuario.Email,COUNT(*) AS denuncias FROM usuario JOIN denuncia_usuario";
    $sql_traer_usuarios .=" ON usuario.Id=denuncia_usuario.cod_usuario WHERE usuario.Id NOT IN (SELECT cod_usuario FROM bloquear_usuario) GROUP BY denuncia_usuario.cod_usuario ORDER BY denuncias LIMIT 100";
    $consulta = mysqli_query($conexion,$sql_traer_usuarios);
    $us_den=[];
    while ($fila = mysqli_fetch_assoc($consulta)) {
      $us_den[]=$fila;
    }
    echo json_encode($us_den);
    }
    if($_GET["traer"]=="anuncios"){

      $sql_traer_anuncios="SELECT anuncios.Id,anuncios.Nombre,COUNT(*) AS denuncias FROM anuncios JOIN denuncia_anuncio ";
      $sql_traer_anuncios.="ON anuncios.Id=denuncia_anuncio.cod_anuncio WHERE anuncios.cod_estado NOT IN (3,4)   GROUP BY denuncia_anuncio.cod_anuncio ORDER BY denuncias LIMIT 100";
      // printf($sql_traer_anuncios);
      $consulta = mysqli_query($conexion,$sql_traer_anuncios);
      $anuncios_den=[];
      while ($fila = mysqli_fetch_assoc($consulta)) {
        $anuncios_den[]=$fila;
      }
      echo json_encode($anuncios_den);
    }
  }

if (isset($_POST["bloquear"]) && ($_SESSION["Admin"] || $_SESSION["Admin"])) {

  if ($_POST["bloquear"]=="anuncio") {
    $sql_bloqueo="UPDATE `anuncios` SET cod_estado=3 WHERE Id=".$_POST["Id"];
    if (mysqli_query($conexion,$sql_bloqueo)) {
    echo json_encode(array("Res"=>"OK"));
   }else {
     echo json_encode(array("Res"=>"ERROR"));
   }
   echo correo($_POST["Email"],"Anuncio Bloqueado","Anuncio bloqueado, ausa del bloqueo: ".$_POST["Desc"],"Causa del bloqueo: ".$_POST["Desc"]);
   echo correo("inforeofertas@gmail.com","Bloqueado","Bloqueo a usuario {$_POST["Email"]}: ".$_POST["Desc"],"");
  }

if ($_POST["bloquear"]=="usuario") {
   $sql_bloqueoUs="UPDATE `anuncios` SET cod_estado=3 WHERE cod_usuario=".$_POST["Id"];
   mysqli_query($conexion,$sql_bloqueoUs);
   $sql_comments ="DELETE FROM `comentarios` WHERE comentarios.cod_usuario=".$_POST["Id"];
   mysqli_query($conexion,$sql_comments);

   $sql_bloqueo="INSERT INTO `bloquear_usuario`( `cod_usuario`, `Causa`) VALUES";

   $sql_bloqueo.="({$_POST["Id"]},'{$_POST["Desc"]}')";

    if (mysqli_query($conexion,$sql_bloqueo)) {
      echo json_encode(array("Res"=>"OK"));
    }else {
      echo json_encode(array("Res"=>"ERROR"));
    }

    correo($_POST["Email"],"Cuenta Bloqueada","Usuario de reofertas bloqueado Causa del bloqueo: ".$_POST["Desc"],"Causa del bloqueo: ".$_POST["Desc"]);
    correo("inforeofertas@gmail.com","Bloqueado","Usuario de Re-oertas bloqueado Bloqueo a usuario {$_POST["Email"]}: ".$_POST["Desc"],"");
  }

  if ($_POST["bloquear"]=="Desusuario") {

     $sql_bloqueo="DELETE FROM `bloquear_usuario` WHERE";
     $sql_bloqueo.=" bloquear_usuario.cod_usuario={$_POST["Id"]}";
  // echo $sql_bloqueo;
  // die();
      if (mysqli_query($conexion,$sql_bloqueo)) {
        echo json_encode(array("Res"=>"OK"));
      }else {
        echo json_encode(array("Res"=>"ERROR"));
      }

      correo($_POST["Email"],"Cuenta Desbloqueada","Su usuario ha sido desbloqueado.","Su usuario ha sido desbloqueado.");
      correo("inforeofertas@gmail.com","Desbloqueado","Usuario: {$_POST["Email"]} Desbloqueado.","");
    }

}



 ?>
