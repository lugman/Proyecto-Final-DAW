<?php
// Incluimos la funcione necesaria para subir archivos.
      include("../subirArchivo.php");
      include("../mensaje.php");


  // creamos una variable foto que se rellenara con la foto a subir si todo va bien.
      $foto="";
  // Realizamos la petición de bubir la imagen.
      $subir = subir_imagen("Foto","usuarios");
  // si se consigue subir la foto machacamos el nombre vacio de la imagen por el de la imagen subida.
      if ($subir["Res"]=="OK") {
        $foto=$subir["img"];
      }


//Realizamos el registro  llamando a la funcion y volcamos la respuesta en formato JSON .
    echo json_encode(registar($foto));



function registar($foto){
  date_default_timezone_set("Europe/Madrid");
  $fechaNOW =  date('Y-m-d H:i:s', time());
  //Traemos la configuración de la conexión.
  include("conexion.php");

    $sqlVerificacionUs = "INSERT INTO `verificacion` (`DNI`, `DNI_VF`, `Email_VF`) VALUES ('', b'0',b'0');";
    $usuarioVerificado =   mysqli_query($conexion,$sqlVerificacionUs);
    $idVerf = mysqli_insert_id($conexion);

//Primero volbemos a comprovar que este usuario no existe.
  $consulta_existe_usuario='SELECT `Email` FROM `usuario` WHERE BINARY Email = "'.$_POST["Email"].'"';
  $query_comprobar =   mysqli_query($conexion,$consulta_existe_usuario);

  // Si esto se cumple.
  if ($query_comprobar->num_rows > 0)
  {

// Respondemos  con error y no realizamos la inserción.
    return  array("Res"=>"ERROR","ERROR"=>"El usuario ya existe");

  }
  else
  {
    // Si no se cumple podríamos  comenzar con la inserción.
    // Primero seria Encriptar la contraseña.

    $encriptada = md5($_POST["Contra"]);

// Una vez encriptada procedemos a la realización de la consulta.

// Escribimos los campos a insertar
    $campos = "Nombre , Apellidos , Email ,  Telefono_1 ,  Telefono_2 ,  Contrasenia  , Foto  , cod_ciudad ,  `cod_verificiacacion`, Poblacion,Fecha";
// Y ponemos los valores que reremos insertar.
    $valores =
    "'".$_POST["Nombre"]."'
    ,
    '".$_POST["Apellidos"]."'
    ,
    '".$_POST["Email"]."'
    ,
    '".$_POST["Telefono1"]."'
    ,
    '".$_POST["Telefono2"]."'
    ,
    '".$encriptada."'
    ,
    '".$foto."'
    ,
    ".$_POST["cod_ciudad"]."
    ,
    $idVerf
    ,
    '".$_POST["Poblacion"]."'".",'$fechaNOW'";
    // echo $$valores;
    // die();

// Creamos la consulta uniendo todo.
    $consulta = "INSERT INTO usuario($campos) VALUES ($valores)";
    // print($consulta);
// Y la lanzamos.
    $query = mysqli_query($conexion,$consulta);
    $idUs = mysqli_insert_id($conexion);

    if ($query)
     {
// Si resulta exitosa devolvemos la respuesta de OK.
      $token = md5(time());
      $emailencript = md5($_POST["Email"]);
      $sql="INSERT INTO `validacionemail`( `EmailToken`, `Token`, `cod_usuario`) VALUES ('$emailencript','$token',$idUs)";
      $query2 = mysqli_query($conexion,$sql);

      $idTOk = mysqli_insert_id($conexion);
      $enlace =$_SERVER["SERVER_NAME"].'/validate.php?cod='.$emailencript.'&token='.$token."&Id=$idTOk";
      enviarEmail($_POST["Email"],$enlace);
      return array(
        'Res'    => "OK",
        'Descripcion' => "Usuaro insertado con exito.",
        'EmailValidacion' =>$query2
      );
    }


    else
    {
 // Si se produce algun error lo responmdemos tambien.
      return array('Res' => "NO");
    }
  }
}
function enviarEmail( $email, $link ){
  $htmlMensaje="";
  $htmlMensaje .= '<p>';
  $htmlMensaje .= ' <span style="color: #3366ff;"><strong>Enhorabuena acaba de registrarse en Re-ofertas con &eacute;xito.</strong></span></p>';
  $htmlMensaje .= ' <p>Por favor confirme nos que es este su correo pinchando en este enlace.';
  $htmlMensaje .= ' <span style="color: #339966;"><a style="color: #339966;" href="'.$link.'">Confirmar que este es mi correo.</a> </span>';
  $htmlMensaje .= '</p>';

correo($email,"Verificar email",$htmlMensaje,"Por favor copie este enlace en el  buscador: $link");
}
 ?>
