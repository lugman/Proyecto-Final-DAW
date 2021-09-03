<?php
if (isset($_SESSION["login"]) && $_SESSION["login"]){}else {
    die('<p class="h2 text-center">Esta acción requiere que inicies sesión.<a class="btn" href="index.php?page=entrar">Iniciar sessión</a></p>');
}
?>
<div class="container p-5  contenedor_nuevo_anuncio" >
  <!-- <h2 class="text-center">Crea tu anuncio  en 2 sencillos pasos :)</h2> -->
  <form class="" action="php/poner_anuncio.php" id="form_anuncio" method="post" enctype="multipart/form-data">
    <div class="container contenedor1">
      <div class="container padding_20px" style="background-color: rgb(137, 137, 137);">
        <h3 class="text-center">Elige categoria y subacategorias</h3>
        <div class="FlexRow jcS alI" id="contenedorCategorias">
        </div>
        <div class="row padding_20px" style="background-color: rgb(137, 137, 137);"id="contenedorCaracteristicas">
    </div>
  </div>
  <div class="container">
    <div class="FlexCol jcSA ">
      <div class="FlexRow jcSA ">
        <div class="catPadre">
          <h4 class="text-center">Elige ciudad del anuncio</h4>
          <div class="ciudades_paso_1 form-group">
          </div>
        </div>
        <div class="FlexCol catPadre">
          <h4 class="text-center" id="poblacion_label">Población</h4>
          <input type="text"  name="poblacion" id="poblacion"  maxlength="60" class="form-control cp_paso_1 " value="" placeholder="Población">
        </div>
        <div class="precio">
          <h4 class="text-center" id="price_label">Precio anuncio</h4>
          <input type="number" step=0.1 class="form-control tit_a" id="price" name="precio" min="1" max="999999" value="1" placeholder="Precio">
        </div>
      </div>
      <div class="titulo">
        <h4 class="text-center" id="nom_label">Título </h4>
        <input type="text" class="form-control tit_a" id="nom" name="titulo" min="8" maxlength="90" value="" placeholder="Título">
      </div>
      <div class="">
        <h4 class="text-center" id="desc_label">Descripción</h4>
        <textarea  placeholder="Descripción anuncio" id="desc" name="desc"  maxlength="800" class="form-control" rows="8" cols="80"></textarea>
      </div>
      <div class="">
        <div class="">
          <h4 class="text-center">Extra/aclaraciones</h4>
          <textarea placeholder="Extra" id="extra"  name="extra"  maxlength="149" class="form-control" rows="3" cols="80"></textarea>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container contenedor2 " style="display:none;">
  <h3 class="text-center">Incluir imágenes</h3>
  <p class="text-center">Esto es totalmente opcional  pero se recomienda hacerlo,ya que es mucho mas descriptivo y ayuda tanto al vendedor
    a vender como a el usuario que lo ve a saber como es el producto.</p>
    <p class="text-center">
      <strong>
        Se permite subir hasta 4 imágenes con un tamaño de hasta 2MB y en formatos jpg,pnf,gif.
        <p style="color:blue;"  class="text-center"> Porfavor Elige el orden en que quieras que aparezcan.</p>
      </strong>
    </p>
    <a class="btn btn-danger" id="BorrarTodas">Borrar imágenes</a>
    <div class="imagenes_subidas">
    </div>
    <div class="poner_foto">
      <input type="file" name="imagen1"  data-identificador=""  class="form-control inputFileSubir" value="">
      <input type="file" name="imagen2"  data-identificador="" class="form-control inputFileSubir" value="">
      <input type="file" name="imagen3"  data-identificador="" class="form-control inputFileSubir" value="">
      <input type="file" name="imagen4"  data-identificador="" class="form-control inputFileSubir" value="">
    </div>
  </div>
  <div class="container contenedor3 " style="display:none;">
    <div class=" ConPrevAnuncio" >
    </div>
  </div>
</form>
<div class="p-4 FlexRow jcSA"  style="margin:5px;">
  <button id="Volver" type="button" class="btn btn-info width_200px  " style="background-color:rgb(144, 46, 32);">volver atras <i class="fas fa-arrow-alt-circle-right"></i></button>
  <button id="Continuar" type="button" class="btn btn-info width_200px  ">Continuar <i class="fas fa-arrow-alt-circle-right"></i></button>
</div>
</div>
