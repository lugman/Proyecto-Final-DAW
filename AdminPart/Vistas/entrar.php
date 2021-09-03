<div class="login_container">
	<div class="row">
		<div class="col-md-12">
			<div class="wrap">
				<p class="form-title ">
					Iniciar session</p>
					<form class="login loginEntrar">
						<input type="text" value="<?php  echo (isset($_COOKIE["usuario"])  ? $_COOKIE["usuario"] : ''); ?>" placeholder="Email" id="Email" />
						<input type="password" value="<?php echo (isset($_COOKIE['contrasenia'])?   $_COOKIE['contrasenia'] :""); ?>" placeholder="Contraseña" id="Contrasenia"/>
						<h4 class="hidden ErrLogin text-red">Se ha producido un erro al entrar.</h4>
						<h5 class="hidden ErrLogin text-red">Porfavor comprueve su usuario y su contraseña.</h5>
						<a class="ntra btn btn-success btn-sm" id="Entrar_sesion" >Entrar</a>
						<div class="remember-forgot">
							<div class="row colo_fondo">
								<div class="col-md-12 text-center ">
									<a class="btn " data-toggle="modal" data-target="#recordar">Has olvidado la contraseña</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div class="modal fade" id="recordar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<h3 class="modal-title" id="">Cambiar contraseña.</h3>
					</div>
					<div class="modal-body">
						<label>Introduzca el correo con en que se registro.</label><br>
						<label><h4>Correo</h4></label>
						<input type="email" class="form-control" id="emailRecodar" name="" value="">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" id="recordarButton">Recordar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/js/recordar.js"></script>
