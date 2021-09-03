<?php
session_start();
// Incluimos la funcione necesaria para subir archivos.
  include("../subirArchivo.php");
  include("conexion.php");


$sql_borraIMG ="SELECT `Foto`  FROM `usuario` WHERE Id=".$_SESSION["Id"];
$query_foto = mysqli_query($conexion,$sql_borraIMG);
$query_foto=mysqli_fetch_array($query_foto)["Foto"];
if ($query_foto!="") {
  if (file_exists ("../../uploads/usuarios/".$query_foto)) {
    unlink("../../uploads/usuarios/".$query_foto);
    echo "existe";
  }else {
    echo "no existe";
  }
}


$foto="";
$subir = subir_imagen("Foto","usuarios");
print_r($subir);

 if ($subir["Res"]=="OK") {
    $foto=$subir["img"];
 }


//Realizamos el registro  llamando a la funcion y volcamos la respuesta en formato JSON .
    echo json_encode(registar($foto));



function registar($foto){
  //Traemos la configuración de la conexión.
  include("conexion.php");



// Una vez encriptada procedemos a la realización de la consulta.

// Escribimos los campos a insertar
$contra="";
if ($_POST["Contra"]!="") {
  $options = [
      'cost' => 7,
      'salt' => 'kndsfhsSDALd90qrFpToSe'
  ];
  $encriptada = password_hash($_POST["Contra"], PASSWORD_BCRYPT, $options);

  $contra="`Contraseña`=  '".$encriptada."',";
}
//  `Email`='".$_POST["Email"]."',

    $consulta = "UPDATE `usuario`set
`Nombre`='".$_POST["Nombre"]."',
`Apellidos`='".$_POST["Apellidos"]."',
`Telefono_1`='".$_POST["Telefono1"]."',
`Telefono_2`=  '".$_POST["Telefono2"]."',
`Foto`=  '".$foto."',
".$contra."
`cod_ciudad`=".$_POST["cod_ciudad"].",
`Poblacion`='".$_POST["Poblacion"]."'
WHERE Id=".$_SESSION["Id"];
// print_r($campos);
// die();

    $query = mysqli_query($conexion,$consulta);

    if ($query)
     {
// Si resulta exitosa devolvemos la respuesta de OK.
      return array(
      'Res'    => "OK",
      'Descripcion' => "Usuaro Modificado con exito."
      );
    }
    else
    {
 // Si se produce algun error lo responmdemos tambien.
      return array('Res' => "NO");

    }

}

 ?>
