
<div class="container">
  <?php  if((isset($_SESSION["Admin"]) && $_SESSION["Admin"]) || (isset($_SESSION["Gest"]) && $_SESSION["Gest"])){

      ?>
  <button class="btn btn-danger" data-toggle="modal" data-target="#Bloqueo">Bloquear <i class="fas fa-lock"></i></button>
  <button class="btn btn-succes" id="Desbloqueo">Desbloquear <i class="fas fa-lock"></i></button>

<?php } ?>
  <!-- <div class="loader2 load1"></div> -->

  <div class="">
    <div class="row Cont1Us">
      <div class="col col-md-3">
        <img src="assets/images/default-user.png" Id="FotoUs" alt="">
      </div>
      <div class="col col-md-9 profile-userpic">
        <div class="VerificadoUusarioPerf">
          <h2>Usuario Verificado<img class="imgUsuario" src="assets/images/Verificado.png" alt=""></h2>
        </div>
        <div class="NoVerificadoUusarioPerf">
          <h2>Usuario No Verificado<img class="imgUsuario" src="assets/images/NoVerificado.png" alt=""></h2>
        </div>

        <div class="row">
          <div class="col col-md-8">
            <h4><strong>Nombre</strong>: <span Id="IdUs"></span> </h4>
            <h4><strong>Email</strong>: <span Id="EmailUs"></span></h4>
            <h4><strong>Ciudad</strong>: <span Id="CiudadUs"></span></h4>
            <h4><strong>Población</strong>: <span Id="PoblacionUs"></span></h4>
            <h4><strong>Teléfono principal</strong>: <span Id="Telefono_1"></span></h4>
            <h4><strong>Teléfono secundario</strong>: <span Id="Telefono_2"></span></h4>

          </div>
          <div class="col col-md-4">
            <button class="btn btn-danger"  data-toggle="modal" data-target="#Denunciar">Denunciar usuario</button>
            <br>
            <br>
            <br>
            <h4>Puntuación según anuncios</h4>
            <h2 class="clasificacion">

            </h2>


          </div>

        </div>

      </div>
    </div>
  </div>
  <div class="anuncioosUsuario">

    <!-- <img src="assets/images/loader.gif" class="load2Imag" width="50px;" alt=""> -->

  </div>
</div>
<div class="modal fade" id="Denunciar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel">Presentar denuncia</h5>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="" id="IdAnuncio" value="">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Causa</label>
            <select class="form-control" id="causa">
              <option value="Amenaza">Amenaza</option>
              <option value="Falsificador">Falsificador</option>
              <option value="Cuenta falsa">Cuenta falsa</option>
              <option value="Malas formas">Malas formas</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Añadir descripción(opcional):</label>
            <textarea class="form-control" id="desc"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="ConfDenuncia" class="btn btn-primary">Denunciar</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="Bloqueo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title" id="exampleModalLabel"> Bloquear</h5>
      </div>
      <div class="modal-body">
        <form>
          <input type="hidden" name="" id="Id" value="<?= $anuncio["Id"] ?>">
          <div class="form-group">
            <label for="message-text" class="col-form-label">Motivo de bloqueo:</label>
            <textarea class="form-control" id="descBloq"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="ConfBloqueo" class="btn btn-primary">Bloquear</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="assets/js/usuario.js"></script>
