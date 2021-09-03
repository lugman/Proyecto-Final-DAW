<?php
if (!isset($_GET["Id"])) {
  die(json_encode(array('Res'=>"NO")));
}

include("conexion.php");
$consulta = "";
$consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
$consulta .= "Descripcion,Extra,";
$consulta .= "DATE_FORMAT(`Fecha`,'%d-%m-%Y %H:%i ')  as Fecha,";
$consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia`, `Fecha_modificacion`";
$consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
$consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
$consulta .= " WHERE";
$consulta .= "  anuncios.Id=".$_GET["Id"]." and cod_estado != 3";


$respuesta = mysqli_query($conexion,$consulta);

//Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
$anuncio=[];
while($elemento = mysqli_fetch_assoc($respuesta))
{

  $sqlUsuario="SELECT usuario.Id,usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Telefono_2 as tlf2,usuario.Foto as FotoUs,usuario.Email";
  $sqlUsuario.= " FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id WHERE anuncios.Id=".$elemento["Id"];
  $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
  $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id ";
  $consultaCommentario ="SELECT `cod_anuncio`, `Descripcion`, DATE_FORMAT(comentarios.Fecha,'%d-%m-%Y %H:%i ') as Fecha, usuario.Email,usuario.Id as usuario FROM `comentarios`".
  " JOIN usuario ON usuario.Id=comentarios.cod_usuario WHERE cod_anuncio=".$elemento["Id"];

  $resFotos = mysqli_query($conexion,$consultaFotos);
  $consultaCommentario = mysqli_query($conexion,$consultaCommentario);
  $fot=[];
  $comments=[];
  while($photo = mysqli_fetch_assoc($resFotos))
  {
      $fot[]=$photo["Nombre"];
  }
  while($com = mysqli_fetch_assoc($consultaCommentario))
  {
      $comments[]=$com;
  }

  $resUsu = mysqli_query($conexion,$sqlUsuario);
  $resUsu=mysqli_fetch_array($resUsu);


  $elemento["Fotos"]=$fot;
  $elemento["comentarios"]=$comments;
  $elemento["NombreUs"]=$resUsu["Nombre"];
  $elemento["IdUs"]=$resUsu["Id"];
  $elemento["Telf"]=$resUsu["tlf"];
  $elemento["Telf2"]=$resUsu["tlf2"];
  $elemento["fotoUs"]=$resUsu["FotoUs"];
  $elemento["Email"]=$resUsu["Email"];
  $anuncio = $elemento;
}
$consultaUs="SELECT AVG(Valoracion) AS val FROM valoracion join anuncios ON anuncios.Id=valoracion.cod_anuncio WHERE anuncios.Id =".$_GET["Id"];
$resUs = mysqli_fetch_assoc(mysqli_query($conexion,$consultaUs))["val"];
$anuncio["valoracion"]=$resUs;

echo json_encode($anuncio);

  ?>
