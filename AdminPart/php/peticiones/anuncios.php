<?php

//------------
// anuncion.php
// Clase peticiones varias sobre Anuncios.
//------------
//Incluimos configuración de la  conexion.
      require("conexion.php");
      session_start();

//Comprovamos que vienen parametros GET.
      if (isset($_GET["tipo"]))
       {
//Tipo de petición que queremos realizar.
        switch($_GET["tipo"])
        {
      // Primera busqueda Principal  ---> ventana busqueda.
          case "busqueda":
          busqueda($conexion,$_GET["palabras"],$_GET["categorias"],$_GET["ciudades"]);
          break;

        // Busqueda Por categoria iconos  ---> ventana busqueda.
          case "busqueda_cat":
          busqueda_cat($conexion,$_GET["categorias"]);
          break;
          // Busqueda Anuncios usuario .

          case "misAnuncios":
          misAnuncios($conexion);
          break;

          case "filtrar":
          filtrar($conexion,$_GET["ciudad"],$_GET["categoria"],$_GET["caracteristicas"],$_GET["poblacion"],$_GET["fecha1"],$_GET["fecha2"],
          $_GET["palabras"],$_GET["max"],$_GET["min"],$_GET["ordenar"]);
          break;

          case "vermas1":
          vermas($conexion,$_GET["ciudad"],$_GET["categoria"],$_GET["caracteristicas"],$_GET["poblacion"],$_GET["fecha1"],$_GET["fecha2"],
          $_GET["palabras"],$_GET["max"],$_GET["min"],$_GET["ordenar"]);
          break;

          case "vermas2":
          vermas2($conexion,$_GET["ides"],$_GET["ordenar"]);
          break;

          case "favoritos":
          favoritos($conexion,$_GET["favs"],$_GET["order"]);
          break;

          case "usuario":
          usuario($conexion,$_GET["Id"]);
          break;

        }
      }

      // &ciudad =2&categoria=14&poblacion=&fecha1=&fecha2=&palabras=&max=500&mix=1&ordenar=fecha

      else
      // Si no vienen parametros GET.
       {

         echo json_encode(array('Res' =>"ERROR" , "Descripcion" => "Parametros GET no encontrados","Parametros_Buscados"=>'$_GET["tipo"]' ));

       }

       function favoritos($con,$ides,$order){

         $consulta = "";
         $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
         $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
         $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion,";
         $consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia` ";
         $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
         $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";


         $consulta .= " WHERE";
         $consulta .= "  anuncios.Id IN ($ides) ";
        $consulta .= " AND (cod_estado=1  OR cod_estado=2)";

         if($order=="Fecha_modificacion"){
           $consulta .= " ORDER BY anuncios.Fecha_modificacion DESC LIMIT 20";
         }else if($order=="Precio"){
           $consulta .= " ORDER BY Precio LIMIT 20";
         }

         $respuesta = mysqli_query($con,$consulta);

         $respuesta_json=[];
         while($elemento = mysqli_fetch_assoc($respuesta))
         {
           //Foto
           $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
           $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";

           $resFotos = mysqli_query($con,$consultaFotos);
           $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

           //Usuario
           $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
           $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
           $resUsu = mysqli_query($con,$sqlUsuario);
           $resUsu=mysqli_fetch_array($resUsu);
           $elemento["NombreUs"]=$resUsu["Nombre"];
           $elemento["Telf"]=$resUsu["tlf"];
           $elemento["fotoUs"]=$resUsu["FotoUs"];

           if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
             $elemento["verf"]="SI";
           }else {
             $elemento["verf"]="NO";
           }


           $respuesta_json[]=$elemento;
}
       // Respuesta en JSON.
          echo json_encode($respuesta_json);

        }
        function vermas2($conexion,$ides,$ordenar){

          $consulta = "";
          $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
          $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
          $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion,";
          $consulta .= " `cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia` ";
          $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
          $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
          $consulta .= " WHERE";
          $consulta .= "  anuncios.Id IN(".$ides.")";

          if($ordenar=="Fecha_modificacion"){
            $consulta .= " ORDER BY anuncios.Fecha_modificacion DESC";
          }else if($ordenar=="Precio"){
            $consulta .= " ORDER BY Precio";
          }
          // print($consulta);
          // die();

          $respuesta = mysqli_query($conexion,$consulta);

          //Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
          $respuesta_json=[];
          while($elemento = mysqli_fetch_assoc($respuesta))
          {
            //Foto
            $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
            $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";
            $resFotos = mysqli_query($conexion,$consultaFotos);
            $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

            //Usuario
            $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
            $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
            $resUsu = mysqli_query($conexion,$sqlUsuario);
            $resUsu=mysqli_fetch_array($resUsu);
            $elemento["NombreUs"]=$resUsu["Nombre"];
            $elemento["Telf"]=$resUsu["tlf"];
            $elemento["fotoUs"]=$resUsu["FotoUs"];

            if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
              $elemento["verf"]="SI";
            }else {
              $elemento["verf"]="NO";
            }


            $respuesta_json[]=$elemento;
          }

          // Respuesta en JSON.
          echo json_encode($respuesta_json);
        }
        function vermas($conexion,$ciudad,$categorias,$carcateristicas,$poblacion,$fecha1,$fecha2,$palabras,$max,$min,$ordenar){
          $ides="";
          if ($carcateristicas!="") {
            $num=0;
            $caracteristicas_sql = "SELECT car.cod_anuncio FROM `caracteristica_anuncio` car";

            $caracteristicas_sql2="";
            foreach ($carcateristicas as $value) {
              if ($num==0) {
                $caracteristicas_sql2 .=" WHERE  car.cod_caracteristica=".$value;
              }else{
                $caracteristicas_sql .=" JOIN caracteristica_anuncio car$num ON car.cod_anuncio=car$num.cod_anuncio";
                $caracteristicas_sql2.="  AND car".$num.".cod_caracteristica=".$value;
              }
              $num++;
            }


            $caracteristicas_sql .= $caracteristicas_sql2;


            $caracteristicas_sql.=" GROUP BY car.cod_anuncio";
            $result = mysqli_query($conexion,$caracteristicas_sql);
            $count =0 ;
            while ($ide = mysqli_fetch_array($result)) {
              if($count==0){
                $ides = $ide["cod_anuncio"];
              }else{
                $ides .= ",".$ide["cod_anuncio"];
              }
             }

          }



          $consulta = "";
          $consulta .= "SELECT DISTINCT anuncios.Id";
          $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
          $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
          $consulta .= " WHERE";
          $consulta .= "  Poblacion LIKE '%$poblacion%'";
          $consulta .= ($carcateristicas!=""?" AND anuncios.Id IN(".$ides.")":"");

          $consulta .= ($categorias!=""?" AND categoria_anuncio.cod_categoria = $categorias":"");

          $consulta .= ($ciudad!=""?" AND cod_ciudad=$ciudad":"");
          $consulta .= " AND (Descripcion LIKE '%$palabras%' OR anuncios.Nombre LIKE '%$palabras%')";
          $consulta .= ($fecha1!=""?" AND  Fecha_modificacion >='$fecha1'":"");
          $consulta .= ($fecha2!=""?" AND  Fecha_modificacion <='$fecha2'":"");
          $consulta .= " AND  Precio >= $min";
          $consulta .= " AND  Precio <= $max";
             $consulta .= " AND (cod_estado=1  OR cod_estado=2)";

          if($ordenar=="Fecha_modificacion"){
            $consulta .= " ORDER BY anuncios.Fecha_modificacion DESC";
          }else if($ordenar=="Precio"){
            $consulta .= " ORDER BY Precio ";
          }
          // print_r($consulta);
          // die();
   // print($consulta);
   //          die();
          $respuesta = mysqli_query($conexion,$consulta);

          //Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
          $respuesta_json=[];
          $ides=[];
          $count = 0;
          while($elemento = mysqli_fetch_assoc($respuesta))
          {
            if($count<20){
              $ides[]=$elemento["Id"];
              $count++;
            }else{
              $respuesta_json[]=$ides;
              $ides=[];
              $count=1;
              $ides[]=$elemento["Id"];
            }
          }
          $respuesta_json[]=$ides;

          // Respuesta en JSON.
          echo json_encode($respuesta_json);

        }
       function filtrar($conexion,$ciudad,$categorias,$carcateristicas,$poblacion,$fecha1,$fecha2,$palabras,$max,$min,$ordenar){


         $ides="";
         if ($carcateristicas!="") {
           $num=0;
           $caracteristicas_sql = "SELECT car.cod_anuncio FROM `caracteristica_anuncio` car";

           $caracteristicas_sql2="";
           foreach ($carcateristicas as $value) {
             if ($num==0) {
               $caracteristicas_sql2 .=" WHERE  car.cod_caracteristica=".$value;
             }else{
               $caracteristicas_sql .=" JOIN caracteristica_anuncio car$num ON car.cod_anuncio=car$num.cod_anuncio";
               $caracteristicas_sql2.="  AND car".$num.".cod_caracteristica=".$value;
             }
             $num++;
           }


           $caracteristicas_sql .= $caracteristicas_sql2;


           $caracteristicas_sql.=" GROUP BY car.cod_anuncio";
           $result = mysqli_query($conexion,$caracteristicas_sql);
           $count =0 ;
           while ($ide = mysqli_fetch_array($result)) {
             if($count==0){
               $ides = $ide["cod_anuncio"];
             }else{
               $ides .= ",".$ide["cod_anuncio"];
             }
            }

         }



         $consulta = "";
         $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
         $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
         $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion,";
         $consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia` ";
         $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
         $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
         $consulta .= " WHERE";
         $consulta .= "  Poblacion LIKE '%$poblacion%'";
         $consulta .= ($carcateristicas!=""?" AND anuncios.Id IN(".$ides.")":"");

         $consulta .= ($categorias!=""?" AND categoria_anuncio.cod_categoria = $categorias":"");

         $consulta .= ($ciudad!=""?" AND cod_ciudad=$ciudad":"");
         $consulta .= " AND (Descripcion LIKE '%$palabras%' OR anuncios.Nombre LIKE '%$palabras%')";
         $consulta .= ($fecha1!=""?" AND  Fecha_modificacion >='$fecha1'":"");
         $consulta .= ($fecha2!=""?" AND  Fecha_modificacion <='$fecha2'":"");
         $consulta .= " AND  Precio >= $min";
         $consulta .= " AND  Precio <= $max";
          $consulta .= " AND (cod_estado=1  OR cod_estado=2)";

         if($ordenar=="Fecha_modificacion"){
           $consulta .= " ORDER BY anuncios.Fecha_modificacion DESC LIMIT 20";
         }else if($ordenar=="Precio"){
           $consulta .= " ORDER BY Precio LIMIT 20";
         }

// print($consulta);
//          die();
         $respuesta = mysqli_query($conexion,$consulta);

         //Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
         $respuesta_json=[];
         while($elemento = mysqli_fetch_assoc($respuesta))
         {
           //Foto
           $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
           $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";
           $resFotos = mysqli_query($conexion,$consultaFotos);
           $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

           //Usuario
           $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
           $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
           $resUsu = mysqli_query($conexion,$sqlUsuario);
           $resUsu=mysqli_fetch_array($resUsu);
           $elemento["NombreUs"]=$resUsu["Nombre"];
           $elemento["Telf"]=$resUsu["tlf"];
           $elemento["fotoUs"]=$resUsu["FotoUs"];

           if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
             $elemento["verf"]="SI";
           }else {
             $elemento["verf"]="NO";
           }


           $respuesta_json[]=$elemento;
         }

         // Respuesta en JSON.
         echo json_encode($respuesta_json);

       }


  function busqueda($conexion,$palabras,$categoria,$ciudad){
    // sleep(10);

    $consulta  ="";
    $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
    $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
    $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion,";
    $consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia`";
    $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
    $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
    $consulta .= "WHERE";
    $consulta .= "  (anuncios.Nombre LIKE '%".$palabras."%' OR Descripcion  LIKE  '%".$palabras."%')";
    $consulta .= ($ciudad!=""?" AND anuncios.cod_ciudad=$ciudad":"");
    $consulta .= ($categoria!="NO"?" AND categoria_anuncio.cod_categoria=$categoria":"");
    $consulta .= " AND (cod_estado=1  OR cod_estado=2)";
    $consulta .=" ORDER BY anuncios.Fecha_modificacion DESC LIMIT 20";



  $respuesta = mysqli_query($conexion,$consulta);
//Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
  $respuesta_json=[];
  while($elemento = mysqli_fetch_assoc($respuesta))
  {
    //Foto
    $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
    $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";
    $resFotos = mysqli_query($conexion,$consultaFotos);
    $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

    //Usuario
    $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
    $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
    $resUsu = mysqli_query($conexion,$sqlUsuario);
    $resUsu=mysqli_fetch_array($resUsu);
    $elemento["NombreUs"]=$resUsu["Nombre"];
    $elemento["Telf"]=$resUsu["tlf"];
    $elemento["fotoUs"]=$resUsu["FotoUs"];

    if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
      $elemento["verf"]="SI";
    }else {
      $elemento["verf"]="NO";
    }


    $respuesta_json[]=$elemento;
}


// Respuesta en JSON.
   echo json_encode($respuesta_json);

 }



 function busqueda_cat($conexion,$categoria){
   $consulta  ="";
   $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
   $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
   $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion,";
   $consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia`";
   $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
   $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
   $consulta .= " WHERE categoria_anuncio.cod_categoria=".$categoria;
   $consulta .= " AND (cod_estado=1  OR cod_estado=2)";

   $consulta .= " ORDER BY anuncios.Fecha_modificacion DESC LIMIT 20";


  $respuesta = mysqli_query($conexion,$consulta);
//Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
  $respuesta_json=[];
  while($elemento = mysqli_fetch_assoc($respuesta))
  {
    //Foto
    $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
    $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";
    $resFotos = mysqli_query($conexion,$consultaFotos);
    $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

    //Usuario
    $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
    $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
    $resUsu = mysqli_query($conexion,$sqlUsuario);
    $resUsu=mysqli_fetch_array($resUsu);
    $elemento["NombreUs"]=$resUsu["Nombre"];
    $elemento["Telf"]=$resUsu["tlf"];
    $elemento["fotoUs"]=$resUsu["FotoUs"];

    if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
      $elemento["verf"]="SI";
    }else {
      $elemento["verf"]="NO";
    }


    $respuesta_json[]=$elemento;
}

// Respuesta en JSON.
   echo json_encode($respuesta_json);
}


function misAnuncios($conexion){
  $consulta="";
  $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
  $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
  $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion, Extra,";
  $consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia`, membresia.Tipo as membresia ";
  $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
  $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad JOIN membresia ON membresia.Id=anuncios.cod_membresia ";
  $consulta .= " WHERE cod_usuario ={$_SESSION["Id"]} ";
  $consulta .= " AND (cod_estado=1  OR cod_estado=2 OR cod_estado=3) ORDER BY anuncios.Fecha_modificacion DESC LIMIT 25";

    // print_r($consulta);
    // die();

  $respuesta = mysqli_query($conexion,$consulta);

  //Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
  $respuesta_json=[];
  while($elemento = mysqli_fetch_assoc($respuesta))
  {
    //Foto
    $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
    $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";
    $resFotos = mysqli_query($conexion,$consultaFotos);
    $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

    //Usuario
    $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
    $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
    $resUsu = mysqli_query($conexion,$sqlUsuario);
    $resUsu=mysqli_fetch_array($resUsu);
    $elemento["NombreUs"]=$resUsu["Nombre"];
    $elemento["Telf"]=$resUsu["tlf"];
    $elemento["fotoUs"]=$resUsu["FotoUs"];

    if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
      $elemento["verf"]="SI";
    }else {
      $elemento["verf"]="NO";
    }


    $respuesta_json[]=$elemento;
}
  echo json_encode($respuesta_json);

}
function usuario($conexion,$id){

  $consulta="";
  $consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
  $consulta .= "SUBSTRING(Descripcion, 1, 400) as Descripcion,";
  $consulta .= "DATE_FORMAT(`Fecha_modificacion`,'%d-%m-%Y %H:%i ')  as Fecha_modificacion,";
  $consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia` ";
  $consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
  $consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
  $consulta .= " WHERE cod_usuario ={$id} ";
  $consulta .= " AND (cod_estado=1  OR cod_estado=2) ORDER BY anuncios.Fecha_modificacion DESC LIMIT 25";


  $respuesta = mysqli_query($conexion,$consulta);

  //Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
  $respuesta_json=[];
  while($elemento = mysqli_fetch_assoc($respuesta))
  {
    //Foto
    $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
    $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id LIMIT 1";
    $resFotos = mysqli_query($conexion,$consultaFotos);
    $elemento["foto"]=(mysqli_num_rows($resFotos)>0?mysqli_fetch_array($resFotos)["Nombre"]:"");

    //Usuario
    $sqlUsuario="SELECT DISTINCT  usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Foto as FotoUs";
    $sqlUsuario.= " ,verificacion.DNI_VF,verificacion.Email_VF FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id JOIN verificacion ON verificacion.Id=cod_verificiacacion  WHERE usuario.Id=".$elemento["cod_usuario"];
    $resUsu = mysqli_query($conexion,$sqlUsuario);
    $resUsu=mysqli_fetch_array($resUsu);
    $elemento["NombreUs"]=$resUsu["Nombre"];
    $elemento["Telf"]=$resUsu["tlf"];
    $elemento["fotoUs"]=$resUsu["FotoUs"];

    if ($resUsu["DNI_VF"]&&$resUsu["Email_VF"]) {
      $elemento["verf"]="SI";
    }else {
      $elemento["verf"]="NO";
    }


    $respuesta_json[]=$elemento;
}
  echo json_encode($respuesta_json);

}
 ?>
