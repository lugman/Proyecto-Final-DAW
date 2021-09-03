<?php
include("php/conexion.php");
function ciudades($con)
{
 $consulta_ciudades = 'SELECT `Id`, `Nombre` FROM `ciudades`';

 $respuesta = mysqli_query($con,$consulta_ciudades);

 $respuesta_json=[];
 while($elemento = mysqli_fetch_assoc($respuesta))
 {
  $respuesta_json[]=$elemento;
 }
 return $respuesta_json;
}

$ciudades = ciudades($conexion);
session_start();

if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] ){
 ?>


 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">

     <title></title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
     <style media="screen">
     #categorias{
       display: flex;
       flex-direction: row;
       justify-content: center;
       align-items: flex-start;
     }
       .CategoriaClass{
         margin-left: 10px;
         padding: 10px;
         display: flex;
         flex-direction: row-reverse;
         justify-content: center;
         align-items: flex-start;
       }
     </style>
   </head>
   <body>
          <?php include("php/navbar.php"); ?>
          <div class="contenedorCentral">

<div id="categorias">

<div class="CategoriaClass col-5" data-num="0">
  <div class="col-6">
    <a type="button"  class="insertar btn btn-success" >Insertar</a>
    <a type="button"  class="ModCat btn btn-warning">Modificar</a>
    <a type="button"  class="borrarCat btn btn-danger">Borrar</a>
  </div>
  <div class="col-6">
  <select class="Ciudades form-control" name="categorias"  data-num="0">
  <option value="NO">Selecciona ciudad</option>
  <?php
  foreach ($ciudades as $fila) {
    echo '<option value="'.$fila["Id"].'">'.$fila["Nombre"].'</option>';
  }
   ?>
</select>
</div>
</div>
</div>


<div class="modal fade"  data-backdrop="static" data-keyboard="false" id="insertar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Nombre">Insertar Ciudad</h5>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Nombre:</label><br>
            <input type="text" class="form-control-inline" id="catInsert">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="ConformInsert">Insertar</button>
        <button type="button" class="btn btn-danger" id="CancelInsert" >cerrar y cancelarr</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade"  data-backdrop="static" data-keyboard="false" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="Nombre">Insertar Categoria</h5>
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
        <button type="button" class="btn btn-danger" id="CancelMod" >cerrar y cancelarr</button>
      </div>
    </div>
  </div>
</div>

</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/cities.js"></script>
   </body>
 </html>
 <?php
 } else {
   echo "<h2>Usted no tiene permiso para acceder a esta pantalla.</h2>";
 }
 ?>
