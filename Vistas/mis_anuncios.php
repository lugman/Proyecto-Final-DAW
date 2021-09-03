<?php
if (isset($_SESSION["login"]) && $_SESSION["login"]){}else {
    die('<p class="h2 text-center">Esta acción requiere que inicies sesión.<a class="btn" href="index.php?page=entrar">Iniciar sessión</a></p>');
}
?>
<div class="table-responsive padding_20px" style="    background-color: #242425b3;">
	<h2 class="text-center text-white">¡Acelera tus ventas!</h2>
	<div class="membership-pricing-table">
		<table>
			<tbody><tr>
				<th></th>
				<th class="plan-header plan-header-free">
					<div class="pricing-plan-name">Gratis</div>
					<div class="pricing-plan-price">
						<sup></sup>0<span>.00€</span>
					</div>
				</th>
				<th class="plan-header plan-header-blue">
					<div class="pricing-plan-name">Autorenovación</div>
					<div class="pricing-plan-price">
						<sup></sup>1<span>.5€</span>
					</div>
					<div class="pricing-plan-period">4 Días</div>
				</th>
				<th class="plan-header plan-header-standard">
					<div class="header-plan-inner">
						<!--<span class="plan-head"> </span>-->
						<span class="recommended-plan-ribbon">Recomendado</span>
						<div class="pricing-plan-name">Principal</div>
						<div class="pricing-plan-price">
							<sup></sup>2<span>.0€</span>
						</div>
						<div class="pricing-plan-period">2 Días</div>
					</div>
				</th>
        <tr>
          <td class=" text-white">Visibilidad:</td>
          <td><span class="icon-no glyphicon glyphicon-remove-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>

            <i class="far fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>

          </span></td>
          <td><span class="icon-no glyphicon glyphicon-remove-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>

            <i class="far fa-star" style="color: #decc01;"></i>
          </span></td>
          <td><span class="icon-no glyphicon glyphicon-remove-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
          </span></td>
        </tr>
        <tr>
          <td  class=" text-white">Resultados:</td>
          <td><span class="icon-no glyphicon glyphicon-remove-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>
          </span></td>
          <td><span class="icon-no glyphicon glyphicon-remove-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>
          </span></td>
          <td><span class="icon-yes glyphicon glyphicon-ok-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
          </span></td>
        </tr>
        <tr>
          <td  class=" text-white">Comodidad:</td>
          <td><span class="icon-no glyphicon glyphicon-remove-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>
            <i class="far fa-star" style="color: #decc01;"></i>
          </span></td>
          <td><span class="icon-yes glyphicon glyphicon-ok-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
          </span></td>
          <td><span class="icon-yes glyphicon glyphicon-ok-circle">
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
            <i class="fas fa-star" style="color: #decc01;"></i>
          </span></td>
        </tr>
			</tbody></table>
		</div>
	</div>
</div>
<div class="container  destacarContainer hide" style="padding-top:89px; padding-bottom:89px;">
	<div class="row">
		<h2 class="text-center DesDest">Selecciona tu plan</h2>
		<h4 class="text-black tituloAnuncioDest"><strong>Anuncio a destacar :</strong> <span class=" text-center text-blue nombreAnunDest">Fiat punto 1.2 (para despiece).</span></h4>
		<table class="table">
			<thead class="thead-dark">
				<tr>
          <th scope="col"><strong class="text-black text-center">Planes</strong></th>
					<th scope="col " style="width:38%;"><strong class="text-black">Descripción</strong></th>
					<th scope="col"><strong class="text-black text-center">Precio</strong></th>
					<th scope="col"><strong class="text-black text-center">tiempo</strong></th>
					<th scope="col"><strong class="text-black text-center">Pagar</strong></th>
				</tr>
			</thead>
			<tbody >
				<tr>
					<th class=""><h4>Auto renovación</h4></th>
          <td class="text-center text-justify">Tu anuncio no estará más de 4 horas sin que aparezca la fecha como recién publicado,de esta forma la gente sabrá que tu anuncio sigue en venta hasta que tu indiques lo contrario.</td>
          <td  class="text-center">1.5€ (Iva no incluido).</td>
					<td  class="text-center ">Hasta <span id="tiempo"></span></td>
					<td class="fondoPaypal">
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="custom" value="" class="customAnuncio">
							<input type="hidden" name="hosted_button_id" value="ADREGBPZWYP2Q">
							<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/pp-acceptance-medium.png" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
							<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
						</form>
					</td>
				</tr>
				<tr>
					<th class=""><h4>Anuncio principal</h4></th>
          <td  class="text-center text-justify">Este plan te plan te permitirá que tu anuncio además de salir
            en la zona de búsqueda salga en el inicio de la página en un orden aleatorio,lo que te permitirá q
            ue los usuarios que entren en nuestra página de inicio puedan ver tu anuncio e interesarse por el.</td>
          <td class="text-center">2.0€ (Iva no incluido).</td>
					<td  class="text-center">Hasta <span id="tiempo2"></span>.</td>
					<td class="fondoPaypal">
						<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="custom" value="" class="customAnuncio">
							<input type="hidden" name="hosted_button_id" value="KWE74JLT8DA9C">
							<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/i/buttons/pp-acceptance-medium.png" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
							<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
						</form>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="row">
	<div class="col col-md-8 col-md-offset-2">
		<div class="slider-text-inner desc ContMod">
		</div>
		<div class="slider-text-inner desc UltimoAnuncio">
		</div>
	</div>
</div>
<div class="modal fade modalDestcar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
		<div class="modal-content">
			<div class="Continer">
				<h2>Mejora tu membresia y obten más resultados en menos tiempo y con menos esfuerzo.</h2>
				<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="ADREGBPZWYP2Q">
					<input type="hidden" name="custom" value="Anunci1">
					<input type="image" src="https://www.sandbox.paypal.com/es_ES/ES/i/btn/btn_paynow_LG.gif" border="0" name="submit" alt="PayPal, la forma rápida y segura de pagar en Internet.">
					<img alt="" border="0" src="https://www.sandbox.paypal.com/es_ES/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>
		</div>
	</div>
</div>

<script src="assets/js/misAnuncios.js"></script>
