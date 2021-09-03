<?php
if (!isset($_GET["Id"])) {
  die('<p class="h2 text-center">No se ha seleccionado anuncio.<a class="btn" href="index.php?page=buscar">Ver anuncios</a></p>');
}

include("php/conexion.php");
$consulta = "";
$consulta .= "SELECT DISTINCT anuncios.Id, anuncios.Nombre,";
$consulta .= "Descripcion,Extra,";
$consulta .= "DATE_FORMAT(`Fecha`,'%d-%m-%Y %H:%i ')  as Fecha,";
$consulta .= "`cod_usuario`, ciudades.Nombre as ciudad, `Precio`, `Poblacion`, `cod_estado`, `cod_membresia`, `Fecha_modificacion`";
$consulta .= " FROM `anuncios` JOIN categoria_anuncio ON categoria_anuncio.cod_anuncio=anuncios.Id";
$consulta .= " JOIN ciudades ON ciudades.Id = anuncios.cod_ciudad ";
$consulta .= " WHERE";
$consulta .= "  anuncios.Id=".$_GET["Id"]." and cod_estado != 3";


$respuesta = mysqli_query($conexion,$consulta);

//Creamos y rellenamos con los datos un  array asociastovo para parsearlo a JSON.
$anuncio=[];
while($elemento = mysqli_fetch_assoc($respuesta))
{

  $sqlUsuario="SELECT usuario.Id,usuario.Nombre,usuario.Telefono_1 as tlf,usuario.Telefono_2 as tlf2,usuario.Foto as FotoUs,usuario.Email";
  $sqlUsuario.= " FROM usuario JOIN anuncios ON anuncios.cod_usuario=usuario.Id WHERE anuncios.Id=".$elemento["Id"];
  $consultaFotos="SELECT fotos.Nombre FROM anuncios JOIN fotos ON fotos.cod_anuncio=anuncios.Id";
  $consultaFotos.= " WHERE anuncios.Id={$elemento["Id"]} ORDER by fotos.Id ";
  $consultaCommentario ="SELECT `cod_anuncio`, `Descripcion`, DATE_FORMAT(comentarios.Fecha,'%d-%m-%Y %H:%i ') as Fecha, usuario.Email,usuario.Id as usuario FROM `comentarios`".
  " JOIN usuario ON usuario.Id=comentarios.cod_usuario WHERE cod_anuncio=".$elemento["Id"];

  $resFotos = mysqli_query($conexion,$consultaFotos);
  $consultaCommentario = mysqli_query($conexion,$consultaCommentario);
  $fot=[];
  $comments=[];
  while($photo = mysqli_fetch_assoc($resFotos))
  {
      $fot[]=$photo["Nombre"];
  }
  while($com = mysqli_fetch_assoc($consultaCommentario))
  {
      $comments[]=$com;
  }
  $resFotos=$fot;
  $resUsu = mysqli_query($conexion,$sqlUsuario);
  $resUsu=mysqli_fetch_array($resUsu);
  $elemento["NombreUs"]=$resUsu["Nombre"];
  $elemento["IdUs"]=$resUsu["Id"];
  $elemento["Telf"]=$resUsu["tlf"];
  $elemento["Telf2"]=$resUsu["tlf2"];
  $elemento["fotoUs"]=$resUsu["FotoUs"];
  $elemento["Email"]=$resUsu["Email"];
  $anuncio = $elemento;
}
$consultaUs="SELECT AVG(Valoracion) AS val FROM valoracion join anuncios ON anuncios.Id=valoracion.cod_anuncio WHERE anuncios.Id =".$_GET["Id"];

$resUs = mysqli_fetch_assoc(mysqli_query($conexion,$consultaUs))["val"];

  ?>
<div class="container">
  <?php  if((isset($_SESSION["Admin"]) && $_SESSION["Admin"]) || (isset($_SESSION["Gest"]) && $_SESSION["Gest"])){

      ?>
  <button class="btn btn-danger" data-toggle="modal" data-target="#Bloqueo">Bloquear <i class="fas fa-lock"></i></button>
  <?php if ($anuncio["cod_estado"]==3): ?>
    <p>Anuncio bloqueado</p>
  <?php endif; ?>
<?php } ?>
<?php if (!isset($anuncio["Nombre"])): ?>
  <h1 class="text-center TituloAnuncio textosAnuncio">Anuncio no disponible</h1>
<?php die(); endif; ?>
<h1 class="text-center TituloAnuncio textosAnuncio"><?= $anuncio["Nombre"] ?>&nbsp;	&nbsp;	&nbsp;<?= ($anuncio["cod_estado"]!="1"?"<span class='text-green'>En venta</span>":"<span class='text-red'>Vendido</span>") ?></h1>
<div class="container" style="position:relative;">

  <section class="banner">
    <ul>
      <?php
       if(count($resFotos)>0){
      foreach ($resFotos as $value){
        echo '<li class="text-center"><img src="'.($value=!''?'uploads/anuncios/'.$value:'assets/images/default.jpg').'"></li>';
      }
      }else {
        echo '<li><img src="assets/images/default.jpg"></li>';
      }
       ?>
    </ul>
  </section>
</div>

<div class="row DesAnuncioCon">


  <div class="col col-md-8 ">

    <p class="text-black"><small>Fecha</small>: <strong class="text-black"> 10:00 14/05/2018</strong> </p>
     <small>Titulo</small>
     <h3 class="textosAnuncio"><?= $anuncio["Nombre"] ?></small></h3>
     <small>Descripción</small>
     <h4 class="textosAnuncio"><?= $anuncio["Descripcion"] ?></h4>
     <small>Extra</small>
     <h4 class="textosAnuncio"><?= ($anuncio["Extra"]!=""?$anuncio["Extra"]:"No hay datos extra.") ?></h4>
     <small>Precio</small>
     <h3 class="textosAnuncio"><?= $anuncio["Precio"] ?>€</h3>
     <div class="separator"></div>
     <div class="borderColor padding_10 text-center">
       <h4>Puntuación media : <span class="h2 text-blue"><?= ($resUs!=""?round ($resUs,2)."/5":"Aún no ha sido valorado.") ?></v></h4>
     <?php if (isset($_SESSION["login"]) && $_SESSION["login"]): ?>
     <h4><u>Aportar valoración</u></h4>
       <div class="stars">
         <form action="">
           <input class="star star-5" id="star-5" type="radio" value="5" name="star"/>
           <label class="star star-5" for="star-5"></label>
           <input class="star star-4" id="star-4" type="radio" value="4" name="star"/>
           <label class="star star-4" for="star-4"></label>
           <input class="star star-3" id="star-3" type="radio" value="3" name="star"/>
           <label class="star star-3" for="star-3"></label>
           <input class="star star-2" id="star-2" type="radio" value="2" name="star"/>
           <label class="star star-2" for="star-2"></label>
           <input class="star star-1" id="star-1" type="radio"  value="1" name="star"/>
           <label class="star star-1" for="star-1"></label>
           <a class="btn btn-primary" id="GuardarClasificacion">Guardar valoración</a>
         </form>
       </div>
     <?php endif; ?>
       </div>

  </div>
  <button class="btn btn-dark"  data-toggle="modal" data-target="#Denunciar">Denunciar anuncio</button>
  <br>
  <br>
  <div class="col col-md-4 ContactoAnuncioCont">
    <h3>Datos de contacto</h3>
    <h4><strong>Nombre: </strong><?= $anuncio["NombreUs"] ?></h4>
    <h4><strong>Teléfono de contacto:</strong> <?= $anuncio["Telf"] ?></h4>
    <?= ($anuncio["Telf2"]!=""?'<h4><strong>Teléfono de contacto:</strong>'.$anuncio["Telf2"].'</h4>':"") ?>
    <h4><strong>Correo: </strong><?= $anuncio["Email"] ?></h4>
    Usuario
    <a href="index.php?page=usuario&Id=<?= $anuncio["IdUs"] ?>">
    <div class="UsaAnuncio">
      <div class="row">
         <div class="col col-md-4 ">
            <img style="border-radius:100%" width="70px" height="70px" src='<?= ($anuncio["fotoUs"]!=""?"uploads/usuarios/".$anuncio["fotoUs"]:"assets/images/default-user.png") ?>' alt="">
         </div>
          <div class="col col-md-8 ">
             <h6><strong><?= $anuncio["NombreUs"] ?></strong></h6>
             <h6><?= $anuncio["Email"] ?></h6>
          </div>
        </div>
     </div>
     </a>
     <br>
    <br>

</div>
</div>
<div class="container">
 <div class="row">
   <hr style="border-bottom:1px solid rgba(105, 105, 105, 0.3);">
   <p class="text-black bg-succes"><h3>Comentarios</h3></p>
  <?php foreach ($comments as $value): ?>
    <div class="media comment-box">
      <div class="media-body">
        <h4 class="media-heading"><?= $value["Fecha"] ?> &nbsp;	&nbsp;	&nbsp;	  <strong>Usuario</strong>:<a href="index.php?page=usuario&Id=<?= $value["usuario"] ?>"><?= $value["Email"] ?></h4></a>
        <p><?= $value["Descripcion"] ?></p>
      </div>
    </div>
  <?php endforeach; ?>
  <?php if (count($comments) == 0): ?>
    <h4 class="text-center">No hay comentarios </h4>
  <?php endif; ?>
 </div>
 <?php if (isset($_SESSION["login"]) && $_SESSION["login"]): ?>

 <form class="" action="index.html" method="post">
   <label for="">Cometario</label><br>
   <textarea class="form-control commentarioTEXT" rows="3"  cols="80"></textarea>
   <a class="btn btn-primary" id="Comentar">comentar</a>
 </form>
<?php endif; ?>
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
          <input type="hidden" name="" id="IdAnuncio" value="<?= $anuncio["Id"] ?>">
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Causa</label>
            <select class="form-control" id="causa">
              <option value="Estafa">Es un intento de estafa</option>
              <option value="No corresponde">No se corresponde con la categoría seleccionada</option>
              <option value="Ilegal">Producto Ilegal</option>
              <option value="Repetido">Repetido</option>
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
          <input type="hidden" name="" id="IdAnuncio" value="<?= $anuncio["Id"] ?>">
          <input type="hidden" name="" id="EmailUsuario" value="<?= $anuncio["Email"] ?>">
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
</div>
<script src="assets/js/librerias/unslider.js"></script>
<script type="text/javascript" src="assets/js/anuncio.js"></script>
