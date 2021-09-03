
<!-- Menu -->
<div id="page">
<nav class="fh5co-nav" role="navigation">
  <div class="top-menu">
    <div class="container">
      <div class="row">
        <div class="col-xs-2">
          <div class="logo_menu"></div>
        </div>
        <div class="col-xs-10 text-right menu-1">
          <ul>
            <li class=""><a href="index.php">Inicio</a></li>
            <!-- <li><a href="practice.html">Practice Areas</a></li>
            <li><a href="won.html">Won Cases</a></li>
            <li class="has-dropdown">
              <a href="blog.html">Blog</a>
              <ul class="dropdown">
                <li><a href="#">Web Design</a></li>
                <li><a href="#">eCommerce</a></li>
                <li><a href="#">Branding</a></li>
                <li><a href="#">API</a></li>
              </ul>
            </li> -->
            <li><a href="index.php?page=seleccion">Mi seleccion <div style=" display: inline; font-size:1.3em; color:Tomato; margin-right:45px;">
  <i class="far fa-check-square"></i>
</div></a> </li>

            <li class="has-dropdown AnunciosVER">
              <?php if (isset($_SESSION["login"])): ?>
                <a>Mis anuncios </a><i class="fas fa-angle-down  hidden-xs" style="margin-right:25px;"></i>
                <ul class="dropdown AnuciosModIr">
                  <li><a class="poninter" data-sitio="index.php?page=mis_anuncios">Mis anuncios</a></li>
                  <li><a class="poninter" data-sitio="index.php?page=poner_anuncio">Poner anuncio</a></li>
                </ul>
              <?php endif; ?>
            </li>
            <li><a  href="index.php?page=sobrenosotros">Sobre nosotros</a></li>
            <li><a href="index.php?page=contacto">Contacto</a></li>
              <?php if (!(isset($_SESSION["login"]))): ?>
            <li class="btn-cta" id="Registro_usuario"><a href="index.php?page=registrarse"><span style="">Registrarse</span></a></li>
            <li class="btn-cta" id="Entra_session"><a href="index.php?page=entrar"><span>Entrar</span></a></li>
              <?php endif; ?>

            <?php if (isset($_SESSION["login"])): ?>
            <li class="has-dropdown DropSalir">
              <a> <i class="fa fa-user" aria-hidden="true"></i>Mi perfil <i class="fas fa-angle-down  hidden-xs" ></i></a>
              <ul class="dropdown AnuciosModIr DropSalir">

                <?php
                  $perfil_rul = "index.php?page=perfil";
                  if ((isset($_SESSION["Admin"]) && $_SESSION["Admin"]==true) || (isset($_SESSION["Gest"]) && $_SESSION["Gest"]==true)) {
                    $perfil_rul = "index.php?page=perfil_gest";
                  }
                ?>
                <li class="padin_10"><a href="<?php echo $perfil_rul; ?>" class=" text-center">Ver Prefil <span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                <li class="divider"></li>
                <!-- <li><a href="#">User stats <span class="glyphicon glyphicon-stats pull-right"></span></a></li> -->

                <!-- <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li> -->

                <!-- <li><a href="#">Favourites Snippets <span class="glyphicon glyphicon-heart pull-right"></span></a></li> -->
                <?php if (isset($_SESSION["login"])): ?>
                  <a id="Salir_session"><span> Salir</span></a>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
</nav>
<!-- Fin menu -->
<div id="barraaceptacion" style="display: none;">
    <div class="inner">
        Solicitamos su permiso para obtener datos estadísticos de su navegación en esta web, en cumplimiento del Real
        Decreto-ley 13/2012. Si continúa navegando consideramos que acepta el uso de cookies.
        <a href="javascript:void(0);" class="ok" onclick="PonerCookie();"><b>OK</b></a> |
        <a href="http://politicadecookies.com" target="_blank" class="info">Más información</a>
    </div>
</div>
