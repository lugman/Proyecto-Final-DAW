<?php
if((isset($_SESSION["Admin"]) && $_SESSION["Admin"]) || (isset($_SESSION["Gest"]) && $_SESSION["Gest"])){}else {
  die('<p class="h2 text-center">Esta acción requiere que inicies sesión.<a class="btn" href="index.php?page=entrar">Iniciar sessión</a></p>');
  }
  require "php/peticiones/usuario.php";
  $usuario = mis_datos($conexion);
  ?>
  <div class="row">
    <div class="col col-md-3 col-sm-12 " style="padding:0px;">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
          <img src='<?php echo ($usuario["Foto"]!=""?"uploads/usuarios/".$usuario["Foto"]:"assets/images/default-user.png");?>' class="img-responsive" alt="">
        </div>

        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
            <?php echo $usuario["Nombre"]; ?>
          </div>
        </div>
        <div class="profile-usermenu">
          <ul class="nav Opciones">
            <li class="active datoss">
              <a href="#">
                Datos Perfil
              </a>
            </li>
            <li class="verificarmee">
              <a href="#" target="">
                Verificación Usuarios
              </a>
            </li>
            <li class="anunciosA">
              <a href="#" >
                Anuncios
              </a>
            </li>
            <li class="usuarios">
              <a href="#" >
                Usuarios
              </a>
            </li>

            <?php if ($_SESSION["Admin"]) {    ?>
              <li  style="background-color: rgb(171, 133, 0); ">
                <a href="AdminPart/gestionCar.php" target="" style="color:black!important;">
                  <strong>Administrar portal</strong>
                </a>
              </li>
            <?php } ?>
          </ul>
        </div>
        <!-- END MENU -->
      </div>
    </div>
    <div class="col col-md-9 col-sm-12" style="padding:0px;">
      <div class="datosPerfil">
        <div class="cuerpoRegistro">
          <div class=" contenedor_registro ModBackground">
            <div class="row">
              <div class="col-md-12 ">
                <form class="form-horizontal" role="form"  method="post" id="Registrar_Usuario" data-toggle="validator" enctype="multipart/form-data">
                  <fieldset>
                    <h3 class="text-center h3 cabecera_registro"></h3>
                    <div class="form-group">
                      <label class="col-md-4 control-label"  for="Nombre">Nombre</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user">
                            </i>
                          </div>
                          <input id="Nombre" name="Nombre" value="<?php echo $usuario["Nombre"]; ?>" maxlength="50" type="text" placeholder="Nombre Completo" class="form-control input-md" required>
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Apellidos">Apellidos</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-user">
                            </i>
                          </div>
                          <input id="Apellidos"  maxlength="50" value="<?php echo $usuario["Apellidos"]; ?>" name="Apellidos" type="text" placeholder="Apellidos" class="form-control input-md" required>
                        </div>
                        <div class="help-block with-errors"></div>

                      </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" maxlength="150" for="Email Address">Correo Electrónico</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fas fa-at"></i>
                          </div>
                          <input id="Email" name="Email"  value="<?php echo $usuario["Email"]; ?>" type="text" placeholder="Email" class="form-control input-md"  data-error="Introduce una direccion de correo valida" >
                        </div>
                        <div class="help-block with-errors"></div>

                      </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Phone number ">Telefono Principal</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-phone"></i> +34
                          </div>
                          <input id="Telefono1" maxlength="9"  value="<?php echo $usuario["Telefono_1"]; ?>" pattern="^[9|6|7][0-9]{8}$" name="Telefono1" data-minlength="9" validate="true" type="tel" placeholder="Teléfono Principal" class="form-control input-md" ata-error="Numero telefono no valido" >
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Phone number ">Telefono Secundario</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-phone"></i> +34
                          </div>
                          <input id="Telefono2" maxlength="9" value="<?php echo $usuario["Telefono_2"]; ?>" name="Telefono2" pattern="^[9|6|7][0-9]{8}$" type="tel" placeholder="Teléfono secundario" class="form-control input-md">
                        </div>
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Ciudad">Ciudad</label>
                      <div class="col-md-5">
                        <div class="Ciudad_selec_reg" data-ciudad="<?php echo $usuario["cod_ciudad"]; ?>">

                        </div>
                      </div>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label" data-maxlength="" for="Población">Población</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-street-view"></i>
                          </div>
                          <input id="Poblacion" name="Poblacion" value="<?php echo $usuario["Poblacion"]; ?>" type="text" placeholder="Población" class="form-control input-md">
                        </div>
                      </div>
                      <div class="help-block with-errors"></div>

                    </div>

                    <!-- File Button -->
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="Upload photo">Foto Perfil</label>
                      <div class="col-md-5">
                        <div class="input-group">
                          <input id="Foto" name="Foto" pattern=".(gif|jpeg|jpg|png)$i"  data-error="Formato no valido" class="input-file form-control " type="file">
                        </div>
                        <h5 id="tam">Formatos aceptados de imagen .gif .jpeg .jpg .png y con un tamaño no superior a 10KB</h5>
                      </div>
                      <div class="help-block with-errors foto-error"></div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-4  col-md-offset-4">
                        <h5 class="h4 ">Cambiar contraseña</h5>
                      </div>
                    </div>
                    <div class="form-group">

                      <div class="form-group">
                        <label class="col-md-4 control-label"  maxlength="50" for="Contraseña">Nueva Contraseña</label>
                        <div class="col-md-5">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fas fa-unlock-alt">
                              </i>
                            </div>
                            <input id="Contraseña_registro" name="Contra" pattern="(?=\w*\d)(?=\w*[A-z])\S{6,50}$" type="password" data-error="Contraseña no valida, La contraseña deve incluir 6 caracteres y contener numeros y letras" data-minlength="6" placeholder="Contraseña" class="form-control input-md" >
                          </div>
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-4 control-label" for="Contraseña">Repite contraseña</label>
                        <div class="col-md-5">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fas fa-unlock-alt">
                              </i>
                            </div>
                            <input id="Contraseña2_registro" data-match="#Contraseña_registro"   data-match-error="Las contraseñs no coinciden" type="password" placeholder="Repite contraseña" class="form-control input-md" >
                          </div>
                          <div class="help-block with-errors"></div>
                        </div>

                      </div>

                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" ></label>
                      <div class="col-md-5">
                        <div class="form-group">
                          <input type="submit" class="btn env Modificar" id="reg" value="Modificar"/>
                        </div>
                      </div>
                    </div>

                  </fieldset>
                </form>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  Verificacion -->
    <div class="Verificarme">
      <div class="container">
        <div class="">
          <ul class="pagination pagination-lg centered FlexRow jcC ">
            <li class="page-item active Porv">
              <a class="page-link " href="#" tabindex="1">Por Verfificar</a>
            </li>
            <li class="page-item VerV"><a class="page-link" href="#">Verificados</a></li>
            <li class="page-item NVer"><a class="page-link" href="#">No Aceptados</a></li>
          </ul>
        </div>

        <div class="container">
          <ul class="conDnis">

          </ul>
        </div>
      </div>

      <div class="modal fade modalImagen" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="width:80%; left: 10%;">
        <div class="modal-dialog modal-lg" style="width:100%;">
          <div class="modal-content padding_10" style="width:100%;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="text-center"></h3>
            <div class="FlexRow jcC padding_10" style="text-align:center;">
              <img src="" alt="" style="width:500px;">
            </div>
            <div class=" FlexRow jcC padding_10">
              <h5>Mensaje de rechazo</h5>
              <div style="width:100%;padding:10px;"></div>
              <input type="text" class="form-control" style="width:400px;" id="MensajeDNI" value="">
              <div style="width:100%;padding:10px;"></div>
              <button type="button" name="button" style="width:200px;"  class="btn btn-success verificarDNI">Verificar</button>
              <button type="button" name="button" style="width:200px;"  class="btn btn-danger  rechazarDNI">Rechazar</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade modalImagen2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="width:80%; left: 10%;">
        <div class="modal-dialog modal-lg" style="width:100%;">
          <div class="modal-content padding_10" style="width:100%;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="text-center"></h3>
            <div class="FlexRow jcC padding_10" style="text-align:center;">
              <img src="" alt="" style="width:500px;">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="anunciosC">

      <div class="">
        <ul class="pagination pagination-lg centered FlexRow jcC ">
          <li class="page-item active AnDen">
            <h3 class="bg-grey page-linktext-center padding_10">Anuncios Denunciados</h3>
          </li>
        </ul>
        <div class="container">
          <ul class="conAnD">

          </ul>
        </div>

      </div>
    </div>
    <div class="usuariosC">
      <li class="page-item active AnDen">
        <h3 class="bg-grey page-link text-center padding_10">Usuarios Denunciados</h3>
      </li>
      <div class="container">
        <ul class="conUsD">

        </ul>
      </div>
      </div>
    </div>
  </div>
  <script src="assets/js/verificarDNI.js"></script>
  <script type="text/javascript" src="assets/js/perfil.js"></script>
