<?php
include("php/conexion.php");
$sqlUsuarios = "SELECT COUNT(*) FROM `usuario`";
$sqlTestimonios = "SELECT COUNT(*) FROM comentarios";
$sqlVentas = "SELECT COUNT(*) FROM `anuncios` WHERE cod_estado=1";

$resAnuncios = mysqli_query($conexion,$sqlUsuarios);
$resTestimonios = mysqli_query($conexion,$sqlTestimonios);
$resVentas = mysqli_query($conexion,$sqlVentas);

$usuariosActulaes = mysqli_fetch_array($resAnuncios)["COUNT(*)"];
$testimonios = mysqli_fetch_array($resTestimonios)["COUNT(*)"];
$ventas = mysqli_fetch_array($resVentas)["COUNT(*)"];

$anunciosDestacados = "SELECT anuncios.Id as Id,anuncios.Nombre as Nombre,anuncios.Precio as Precio FROM anuncios JOIN membresia on membresia.Id=anuncios.cod_membresia WHERE membresia.Tipo=3 AND (cod_estado=1  OR cod_estado=2)  ORDER BY RAND() LIMIT 3";
$resAnunciosDestacaados = mysqli_query($conexion,$anunciosDestacados);
$destacados = [];

if(mysqli_num_rows($resAnunciosDestacaados)>0){
  while($fila = mysqli_fetch_array($resAnunciosDestacaados)){
    $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
    $consultaFotos.= " WHERE anuncios.Id={$fila["Id"]} ORDER by fotos.Id LIMIT 1";
    $resFotos = mysqli_query($conexion,$consultaFotos);
    $resFotos = mysqli_fetch_array($resFotos)["Nombre"];
    if ($resFotos!="") {
      $fila["Foto"]="uploads/anuncios/".$resFotos;
    }else{
      $fila["Foto"]="assets/images/default.jpg";
    }
    $destacados[]=$fila;
  }
}
?>
<!-- loader -->
<div class="fh5co-loader"></div>
<!-- . -->
<!-- Buscar anuncio -->
<aside id="panel_busqueda" class="p-5">
  <div class="intro Buscar" >
    <div class="dtable hw100">
      <div class="dtable-cell hw100">
        <div class="container text-center">
          <h1 class="intro-title animated fadeInDown"> Encuentras lo que buscas </h1>
          <p class="sub animateme fittext3 animated fadeIn desBuscar">
            Busca y encuentra lo que buscas y al precio que buscas
          </p>
          <!-- Opciones de busqueda  -->
          <div class="row search-row animated fadeInUp BuscadorIndice">
            <div class="col col-md-8 col-sm-12">
              <div class="row">
                <div class="col col-md-5 col-md-offset-2 margin_10px  col-sm-12 search-col relative">
                  <select class="form-control" id="seleccion_cit">
                    <option selected value="">Todas las ciudades</option>
                  </select>
                </div>
                <div class="col col-md-5 col-md-offset-2  margin_10px col-sm-12 search-col relative">
                  <select class="form-control" id="seleccion_cat">
                    <option selected value="NO">Todas las categorías</option>
                  </select>
                </div>
                <div class="col-xl-12 col-sm-12  margin_10px  search-col relative locationicon">
                  <input type="text" name="country" id="palabras" class="form-control locinput input-rel searchtag-input has-icon" placeholder="Que deseas buscar " autocomplete="off">
                </div>
              </div>
            </div>
            <div class="col col-md-4 col-sm-12  botonBuscarCont">
              <div class="col-xl-12 col-sm-12 w100  search-col botonBuscarCont">
                <button class="btn btn-primary btn-search btn-block" id="buscarIdice"><i class="icon-search"></i><strong>Buscar</strong></button>
              </div>
            </div>
          </div>
          <!-- Fin opciones de busqueda  -->
        </div>
      </div>
    </div>
  </div>
</aside>
<!-- Buscar anuncio fin. -->
<h2 class="text-center tituloAnuncios">Anuncios destacados</h2>
<div class="container conDest">
  <div class="row">
    <?php foreach ($destacados as $anuncio ): ?>
      <div class="col col-md-4 ">
        <a href="index.php?page=anuncio&Id=<?= $anuncio["Id"] ?>">
        <div class="AnuncioDestacado">
          <h3 class="text-center"><?= $anuncio["Nombre"] ?></h3>
          <img src="<?= $anuncio["Foto"] ?>" style="width:300px;">
          <h3 class="text-center tituloDes"><?= $anuncio["Precio"] ?>€</h3>
        </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<!-- Categorias iconos_busqueda. -->
<div class="container">
  <div class="Categories">
    <div class="row IconosCategorias">
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI" data-cat="2">
        <h3 class=" text-center margin-negativo-25">VEHÍCULOS DE MOTOR</h3>
        <img src="assets/images/iconos/automovil.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="4">
        <h3 class=" text-center margin-negativo-25">ELECTRODOMÉSTICSO</h3>
        <img src="assets/images/iconos/lavadora.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI" data-cat="5">
        <h3 class=" text-center margin-negativo-25">INFORMÁTICA Y ELECTRÓNICA</h3>
        <img src="assets/images/iconos/laptop.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="6">
        <h3 class=" text-center margin-negativo-25">JUEGOS Y OCIO</h3>
        <img src="assets/images/iconos/consola.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="8">
        <h3 class=" text-center margin-negativo-25">TELEFONÍA</h3>
        <img src="assets/images/iconos/movil.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="148">
        <h3 class=" text-center margin-negativo-25">MODA Y ACCESORIOS</h3>
        <img src="assets/images/iconos/percha.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="11">
        <h3 class=" text-center margin-negativo-25">LIBROS Y FORMACIÓN</h3>
        <img src="assets/images/iconos/libros.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="12">
        <h3 class=" text-center margin-negativo-25">INMOBILIARIA</h3>
        <img src="assets/images/iconos/piso.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="14">
        <h3 class=" text-center margin-negativo-25">DEPORTES</h3>
        <img src="assets/images/iconos/deporte.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="231">
        <h3 class=" text-center margin-negativo-25">SERVICIOS</h3>
        <img src="assets/images/iconos/servicio.png" alt="">
      </div>
      <div class="col col-md-3 col-sm-4 FlexCol jcC alI"  data-cat="7">
        <h3 class=" text-center margin-negativo-25">OTROS</h3>
        <img src="assets/images/iconos/varios.png" alt="">
      </div>
    </div>
  </div>
</div>
<!-- Categorias iconos_busqueda fiin. -->
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
          <div class="pricing-plan-name">BASIC</div>
          <div class="pricing-plan-price">
            <sup></sup>1<span>.5€</span>
          </div>
          <div class="pricing-plan-period">Día</div>
        </th>
        <th class="plan-header plan-header-standard">
          <div class="header-plan-inner">
            <!--<span class="plan-head"> </span>-->
            <span class="recommended-plan-ribbon">RECOMMENDED</span>
            <div class="pricing-plan-name">STANDARD</div>
            <div class="pricing-plan-price">
              <sup></sup>2<span>.0€</span>
            </div>
            <div class="pricing-plan-period">Día</div>
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
  <!-- Numeros de estadisticas. -->
  <div id="fh5co-counter" class="fh5co-counters fh5co-bg-section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 col-md-offset-1 text-center animate-box">
          <span class="icon"><i class="icon-user"></i></span>
          <span class="fh5co-counter js-counter" data-from="0" data-to="<?php echo $usuariosActulaes;  ?>" data-speed="2000" data-refresh-interval="50"></span>
          <span class="fh5co-counter-label">Usuarios</span>
        </div>
        <div class="col-md-3 col-md-offset-1 text-center animate-box">
          <span class="icon"><i class="icon-speech-bubble"></i></span>
          <span class="fh5co-counter js-counter" data-from="0" data-to="<?php echo $testimonios;  ?>" data-speed="2000" data-refresh-interval="50"></span>
          <span class="fh5co-counter-label">Comentarios</span>
        </div>
        <div class="col-md-3 col-md-offset-1 text-center animate-box">
          <span class="icon"><i class="icon-trophy"></i></span>
          <span class="fh5co-counter js-counter" data-from="0" data-to="<?php echo $ventas;  ?>" data-speed="2000" data-refresh-interval="50"></span>
          <span class="fh5co-counter-label">Ventas</span>
        </div>
      </div>
    </div>
  </div>
  <!-- Numeros de estadisticas fin. -->
