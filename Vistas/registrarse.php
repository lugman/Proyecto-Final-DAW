<div class="cuerpoRegistro">
  <div class="container contenedor_registro">
    <div class="row">
      <div class="col-md-12 ">
        <form class="form-horizontal" role="form"  method="post" id="Registrar_Usuario" data-toggle="validator" enctype="multipart/form-data">
          <fieldset>
            <h3 class="text-center h3 cabecera_registro">Crear cuenta y comienza a vender.</h3>
            <div class="form-group">
              <label class="col-md-4 control-label"  for="Nombre">Nombre
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user">
                    </i>
                  </div>
                  <input id="Nombre" name="Nombre" maxlength="50" type="text" placeholder="Nombre Completo" class="form-control input-md" required>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="Apellidos">Apellidos
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user">
                    </i>
                  </div>
                  <input id="Apellidos"  maxlength="50" name="Apellidos" type="text" placeholder="Apellidos" class="form-control input-md" required>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="Phone number ">Telefono Principal
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i> +34
                  </div>
                  <input id="Telefono1" maxlength="9" pattern="^[9|6|7][0-9]{8}$" name="Telefono1" data-minlength="9" validate="true" type="tel" placeholder="Teléfono Principal" class="form-control input-md" ata-error="Numero telefono no valido" required>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="Phone number ">Telefono Secundario
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i> +34
                  </div>
                  <input id="Telefono2" maxlength="9" name="Telefono2" pattern="^[9|6|7][0-9]{8}$" type="tel" placeholder="Teléfono secundario" class="form-control input-md">
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" for="Ciudad">Ciudad
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>          
              </label>
              <div class="col-md-5">
                <div class="Ciudad_selec_reg">
                </div>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" data-maxlength="" for="Codigo Postal">Poblacion
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-street-view"></i>
                  </div>
                  <input id="CP" name="Poblacion" type="text" placeholder="Población" class="form-control input-md">
                </div>
              </div>
              <div class="help-block with-errors"></div>
            </div>
            <!-- File Button -->
            <div class="form-group">
              <label class="col-md-4 control-label" for="Upload photo">Foto Perfil
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
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
                <h5 class="h4">Datos inicio sessión</h5>
              </div>
            </div>
            <!-- Text input-->
            <div class="form-group">
              <label class="col-md-4 control-label" maxlength="150" for="Email Address">
                Correo Electrónico
                <h5 class="text-white">Estos datos serán mostrados públicamente.</h5>
              </label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fas fa-at"></i>
                  </div>
                  <input id="Email" name="Email" type="text" pattern="^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,4})$" placeholder="Email" class="form-control input-md"  data-error="Introduce una direccion de correo valida" required>
                </div>
                <div class="">
                  <p class="userr"></p>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"  maxlength="50" for="Contraseña">Contraseña</label>
              <div class="col-md-5">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fas fa-unlock-alt">
                    </i>
                  </div>
                  <input id="Contraseña_registro" name="Contra" pattern="(?=\w*\d)(?=\w*[A-z])\S{6,50}$" type="password" data-error="Contraseña no valida, La contraseña deve incluir 6 caracteres y contener numeros y letras" data-minlength="6" placeholder="Contraseña" class="form-control input-md" required>
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
                  <input id="Contraseña2_registro" data-match="#Contraseña_registro"   data-match-error="Las contraseñs no coinciden" type="password" placeholder="Repite contraseña" class="form-control input-md" required>
                </div>
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" ></label>
            <div class="col-md-5">
              <input type="checkbox" name="1" value="" id="terminos" required> <label>
                Acepto los<a style="color:rgb(141, 226, 245);" href="index.php?page=condiciones"> terminos y condiciones der re-pfertas.</a>
              </label>
              <div class="form-group">
                <input type="submit" class="btn env " id="reg" value="Crear"/>
              </div>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="assets/js/registro.js"></script>
