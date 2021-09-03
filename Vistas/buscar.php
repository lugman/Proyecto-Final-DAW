<!-- Parametros busqueda para buscar por Ajax -->
<div class="filtro1">
  <div class="row">
    <div class="col col-md-10 col-md-offset-1 col-sm-12">
      <div class="row">
        <div class="container col-md-12 padding_20px row">
          <h6 class="text-center">Categorías</h6>
          <div class="FlexRow jcS alI col col-md-6" id="contenedorCategorias">
          </div>
          <div class="row  col col-md-6" id="contenedorCaracteristicas" style="margin-top:-40px;">
      </div>
    </div>
    <div class="col-md-4 col-sm-12 search-col relative locationicon ">
      <input type="text" name="country" id="palabras" class="form-control locinput input-rel searchtag-input has-icon" placeholder="Que deseas buscar " autocomplete="off">
    </div>
    <div class="col col-md-3 col-sm-12 search-col relative">
      <select class="form-control" id="seleccion_cit_busc">
        <option selected value="">Todas las ciudades</option>
      </select>
    </div>
    <div class="col col-md-2 col-sm-12 search-col relative">
      <input type="text" name="" id="seleccion_Poblacion" class="form-control" placeholder="Población" value="">
    </div>
  <div class="col col-md-2   col-sm-12">
    <button type="button" name="button" class="btn btn-block " style="border-radius:3px;  margin-top: 10px; background-color:#f95a5a; color:rgb(36, 36, 36);" id="buscar">Buscar</button>
  </div>
</div>
</div>
</div>
</div>
<div id="fh5co-practice" class="fh5co-bg-section">
  <div class="centroAnuncios">
    <div class="row">
      <div class="col col-md-3 col-sm-12" style="min-width:280px;">
        <div class="row filtro2">
          <div class=" col-md-12 search-col relative locationicon " style="margin-top:10px;">
            <div class="row">
              <h4 class="text-white text-center">Selecciona rango de fechas</h4>
              <div class="col-md-12  margin-bottom-10-m FlexRow jcC tamDP" style="position:relative; height: 50px; "  >
                <div class="date-picker tamDP"  style="position:absolute; z-index:999;"  >
                  <div class="input" data-fecha="1">
                    <div class="result" >Desde: <span></span></div>
                    <button><i class="fa fa-calendar"></i></button>
                  </div>
                  <div class="calendar"></div>
                </div>
              </div>
              <div class="col-md-12 FlexRow jcC tamDP"  style="position:relative; height: 50px;" >
                <div class="date-picker "  style="position:absolute; z-index:979;">
                  <div class="input" data-fecha="2">
                    <div class="result" >Hasta: <span></span></div>
                    <button><i class="fa fa-calendar"></i></button>
                  </div>
                  <div class="calendar2"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="col col-md-8 col-md-offset-2 col-sm-12 ">
            <h5 class="text-white">Ordernar por</h5>
            <select class="form-control selectAct" id="orderType"  style="color:white;">
              <option selected value="Fecha_modificacion"  >Fecha</option>
              <option  value="Precio"  >Precio</option>
            </select>
          </div>
          <div class="col col-md-8 col-md-offset-2 col-sm-12">
            <!-- Selector precio. -->
            <p class="text-center">
              <input type="text" style="width:100%;" id="amount" readonly >
            </p>
            <div id="slider-range"></div>
            <button type="button" name="button" class="btn margin_20 filtrarAnuncios">Filtrar</button>
          </div>
        </div>
      </div>
      <div class="col col-md-9 col-sm-12">
        <div class="contenedorAnuncios">
          <div class="">
            <div class="text-center LoaderGIf">
              <img src="assets/images/loader.gif" width="110px" alt="">
            </div>
            <div class="row colsFlex ContAnuncios">
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-9 col-md-offset-3 padding_10 text-center animate-box">
        <p><a class="btn btn-primary btn-lg btn-learn VerMasAnuncios">Ver mas</a></p>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="assets/js/librerias/jquery-ui/jquery-ui.css">
<script src="assets/js/librerias/jquery-ui/jquery-ui.js"></script>
<script src="assets/js/busqueda.js"></script>
