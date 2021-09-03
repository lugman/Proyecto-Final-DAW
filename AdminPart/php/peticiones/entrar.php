<?php

 //----------------- Comprovamos que venga usuario si viene realizamos la comprovacion si no devolvemos respuesta Error.-----------------
  if (isset($_POST["Email"]))
    {
      //Llamamos a el metodo entrar.
      $respuesta = entrar($_POST["Email"],$_POST["Contrasenia"]);
      //Imprimimos en formato JSON resultado de la función entrar;
      echo json_encode($respuesta);
    }
    else
    {
          // Respuesta error.
    echo json_encode(array('Res' => "Error: No se han recibido datos de POST"));
    }
          //--------------------- Fin comprovacion.-----------------------------------------------------------------------------------------------------------------------------------


    function entrar($usu,$contra)
    {
      include("conexion.php");
      session_start();


            //Realizamos la estructura de la consulta de usuario.
            //Pedimos los datos de ese usuario para poder comprobar y en caso de ser valido utilizar esos datos.
      $consulta_sql = 'SELECT Id,Nombre,Email,Contrasenia,rol FROM `usuario` WHERE BINARY Email="'.$usu.'"';
            //Y la realizamos.

      $query = mysqli_query($conexion,$consulta_sql);
      if ($query->num_rows >0)
       {


      // Traemos   el usuario y lo convertimos en un array asociativo con en que trabajar.
        $usuario = mysqli_fetch_array($query);
      //Recogermos la contraseña.
        $contraBD = $usuario["Contrasenia"];

        $consulta_bloqueo_sql = 'SELECT * FROM `bloquear_usuario` WHERE cod_usuario='.$usuario["Id"];
        $query_bloq = mysqli_query($conexion,$consulta_bloqueo_sql);
        // Hacemos la comprovación de esa contraseña traida de  la tabla con la que nos ha pasado el usuario.
        if (mysqli_num_rows($query_bloq) > 0) {
          return array('Res' => "Bloq");
        }else {



        // Si se cumple iniciamos session con los datos del usuario.
        // ----------------------------------------------------------------------------
        if (md5($contra)==$contraBD)
        {
                  // Iniciamos session.
                  // Establecemos una variable de sesión con el nombre login para posteriores comprovaciones.
          $_SESSION["login"]=true;
          $_SESSION["Nombre"]=$usuario["Nombre"];

                  //Comprovamos si este usuario es  Administrador  y lo indicamos a las variablesw de sesión.
          if ($usuario["rol"]==2) {
            $_SESSION["Admin"]=true;
            $_SESSION["Gest"]=true;
          }else if ($usuario["rol"]==3){
            $_SESSION["Admin"]=false;
            $_SESSION["Gest"]=true;
          }else if ($usuario["rol"]==1){
            $_SESSION["Admin"]=false;
            $_SESSION["Gest"]=false;
          }

                    // Rellenamos variable de sesión con la Id de usuario para identificarlo por esta id.
            $_SESSION["Id"]=$usuario["Id"];
                  // Y tambien del nombre.

                  // Por fín devolvemos la respuesta a quien nos ha llamdo
          return array(
                  'Res'    => "OK",
                  'Nombre' => $_SESSION["Nombre"],
                  'Id'     =>  $_SESSION["Id"]
                );
          }//Fin if (password_verify($contra,$contraBD))
          else
          {
        // Si no se cumplen las contraseñas lo indicamos y no iniciamos session. No indicamos en que falla por seguridad.
          return array('Res' => "NO","Descripcion"=>"Datos no coinciden con los que se establecio en el registro.");

        }
      }
        // ---------------------------------------------------------------------------------------------------------------------------------------
    }
    //Fin    if ($query->num_rows >0)
    // Si no se cumplen el usuario con el indicado.   No indicamos en que falla por seguridad.
      return array('Res' => "NO","Descripcion"=>"Datos no coinciden con los que se establecio en el registro.");

    }
    //Fin entrar();
 ?>
