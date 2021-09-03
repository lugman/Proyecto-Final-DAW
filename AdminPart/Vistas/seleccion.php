<!-- Descripción de como la pestaña. -->
<div class="SeleccionText">
  <h3 class="text-center"><strong>Anuncios Seleccionados</strong></h3>
  <dt>
    <dd class=" h3 text-black text-center">
      Añade a tu selección
      <div style=" display: inline;  color:rgb(35, 85, 15)">  en el icono de selección
        <i class="far fa-check-square"> </i> <i class="fas fa-mouse-pointer"></i> -->  <i class="fas fa-check-square"></i> O elimina tu selección
      </div>
      <div style=" display: inline;  color:rgb(142, 0, 0)">
        <i class="far fa-check-square"> </i> <i class="fas fa-mouse-pointer"></i> -->  <i class="fas fa-check-square"></i>
      </div>
    </dd>
  </dt>
  <button  class="btn btn-warning  margin_20 Limpiar">Limpiar lista</button>


</div>
<!--  -->
<!-- Seccion anuncios -->
<div id="fh5co-practice" class="fh5co-bg-section">
  <div class="centroAnuncios">
    <div class="row">
      <div class="col col-md-3 col-sm-12">
        <!-- Filtro -->
        <div class="row filtro2">
          <div class=" col-md-12 search-col relative locationicon " style="margin-top:10px;">
          </div>
          <div class="col col-md-8 col-md-offset-2 col-sm-12">
            <h5 class="text-white">Ordernar por</h5>
            <select class="form-control text-white" id="orderType2">
              <option selected value="Fecha_modificacion" class="text-black"  >Fecha</option>
              <option  value="Precio" class="text-black">Precio</option>
            </select>
          </div>
          <div class="col col-md-8 col-md-offset-2 col-sm-12">
            <!-- Selector precio. -->
            <div id="slider-range"></div>
            <button type="button" name="button" class="btn margin_20 filtrarAnuncios2">Ordenar</button>
          </div>
        </div>
        <!--  -->
      </div>
      <!-- Anuncios -->
      <div class="col col-md-9 col-sm-12">
        <div class="contenedorAnuncios">
          <div class="">
            <div class="row colsFlex ContAnuncios">
            </div>
          </div>
        </div>
      </div>
      <!--  -->

    </div>
  </div>
</div>
<!--  -->


<script src="assets/js/miseleccion.js"></script>
