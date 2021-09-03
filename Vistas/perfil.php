<?php
include("php/peticiones/usuario.php");
$usuario = mis_datos($conexion);
// print_r($usuario);
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
              Verificarme
            </a>
          </li>
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
                        <input id="Email" name="Email" disabled="true" value="<?php echo $usuario["Email"]; ?>" type="text" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$" placeholder="Email" class="form-control input-md"  data-error="Introduce una direccion de correo valida" required>
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
                        <input id="Telefono1" maxlength="9"  value="<?php echo $usuario["Telefono_1"]; ?>" pattern="^[9|6|7][0-9]{8}$" name="Telefono1" data-minlength="9" validate="true" type="tel" placeholder="Teléfono Principal" class="form-control input-md" ata-error="Numero telefono no valido" required>
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
  <div class="col col-md-9">
    <div class="Verificarme" style="background-color: #d1e2ec; ">
      <h2 class="text-center padding_40"> <span class="textDNI " >Verificar <strong>DNI</strong></span></h2>
      <div id="mensajeDNI"></div>
      <div class="container disabled verificarDNIcontainer">
        <div class="row">
          <div class="col col-md-6 col-md-offset-3 ">
            <form id="formUser" enctype="">
              <label for="" > Introduzca su dni:</label><br>
              <input type="text"  name="dni" value="" id="inputTextDni" class="form-control"><br><button type="button" class="bg-primary btn boton " id="confirmDniNum">Confirmar</button>
              <div class="form-group files color padding_10">
                <h4 class="text-center" style="padding-top:20px;">Seleccione su DNI</h4>
                <input type="file" class="form-control" name="dniFoto" id="inputFileDni" disabled>
                <a class="btn boton bott disabled" id="comfirmVerificacionDNI" style="margin:auto; width: 250px; display: block; background-color:rgb(7, 150, 82); color:rgb(0, 0, 0); margin-top:20px;">Confirmar Verificación.</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      <h2 class="text-center padding_40"> <span class="textDNI " >Verificación  <strong>Correo</strong></span></h2>
      <div class="container disabled verificarEMAILcontainer">
      </div>
      <div class="padding_40">
      </div>
    </div>
  </div>
  <div class="misAnuncios" style="background-color: #d1e2ec;">
    <h3>Mis anuncios</h3>
  </div>
</div>
<script type="text/javascript" src="assets/js/perfil.js"></script>
