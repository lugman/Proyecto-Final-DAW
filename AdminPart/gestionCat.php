<?php
include("php/conexion.php");
include("php/funciones.php");
$categorias = traer_categorias($conexion);
session_start();
// print_r($categorias);
if(isset($_SESSION["Admin"]) && $_SESSION["Admin"]){
 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
  <meta charset="utf-8">
  <title>Categorías</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <style media="screen">

  .CategoriaClass{
    margin-left: 10px;
    padding: 10px;
    display: flex;
    flex-direction: row-reverse;
    justify-content: center;
    align-items: flex-start;
  }
  .verSubcategorias{
    margin-left: 4px;
    margin-right:  30px;
  }
  </style>
  </head>
<body>
  <?php include("php/navbar.php");  ?>

  <div class="container pt-5">
      <div class="contenedorCentral">
      <div id="categorias" >
        <div class="CategoriaClass col-12" data-num="0">
          <div class="">
            <button type="button" name="button" class="insertar btn btn-success ml-2" >Insertar categoría</button>
            <button type="button" name="button" class="ModCat btn btn-warning ml-2">Modificar</button>
            <button type="button" name="button" class="borrarCat btn btn-danger ml-2">Borrar</button>
          </div>
          <button type="button" name="button" class="InsertCatDes btn btn-info ml-2" data-num="0">Insertar subcategoría</button>
          <div class="form-group col-6 row">
            <select  name="categorias" class="categoriasSelec col col-7 form-control" data-num="0">
              <option value="NO">Selecciona categoría</option>
              <?php
              while ($fila = $categorias->fetch_array() ) {
                echo "<option value='".$fila["Id"]."'>{$fila["Nombre"]}</option>";
              }
              ?>
            </select>
            <a class="verSubcategorias btn col col-3" type="button" data-num="0"><span class="glyphicon glyphicon-arrow-down">↓</span></a>
          </div>
        </div>
      </div>

      <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Nombre">Insertar Categoría</h5>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Nombre:</label>
                  <input type="text" class="form-control-inline" id="catInsert">
                  <a class="btn btn-success" id="btnIntroducir">Introducir</a>
                </div>
                <div>
                  <h5>Categorías a introducir:</h5>
                  <ul class="insMomentCat">
                  </ul>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="ConformInsert">Insertar</button>
              <button type="button" class="btn btn-danger" id="CancelInsert" >cerrar y cancelar</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="Nombre">Insertar Categorría</h5>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Cateroria:</label>
                  <input type="text" class="form-control" id="catIToMod">
                </div>
                <div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" id="ConfirMod">Modificar</button>
              <button type="button" class="btn btn-danger" id="CancelMod" >cerrar y cancelar</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/categorias.js"></script>
  </div>
</body>
</html>
<?php
} else {
  echo "<h2>Usted no tiene permiso para acceder a esta pantalla.</h2>";
}
?>
