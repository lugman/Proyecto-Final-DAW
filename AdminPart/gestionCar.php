<?php
include("php/conexion.php");
include("php/funciones.php");
session_start();

$categorias = traer_categorias($conexion);
if(isset($_SESSION["Admin"]) && $_SESSION["Admin"] ){
 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">

     <title></title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
     <style media="screen">

     #caracteristicas{
       display: flex;
       flex-direction: column;
       justify-content: center;
       align-items: flex-start;
     }
       .CategoriaClass{
         margin-left: 10px;
         padding: 10px;
         display: flex;
         flex-direction: column;
         justify-content: center;
         align-items: flex-start;
       }
       #mostrarEle{
         max-height:300px ;
         overflow-y: scroll;
       }
     </style>
     <link rel="stylesheet" href="js/autocomplete.css">
   </head>
   <body>
          <?php include("php/navbar.php"); ?>
          <div class="contenedorCentral">

     <div class=" p-5 m-5">
       <div class="row">
       <div class="col col-md-4">
         <div id="caracteristicas" class="row">
           <div class="CategoriaClass col col-12" data-num="0">
             <div class="row col col-12">
               <select name="categorias" class="categoriasSelec CategoSelec form-control col col-md-8" data-num="0">
                 <option value="NO">Selecciona categoría</option>
                 <?php
                 while ($fila = $categorias->fetch_array() ) {
                   echo "<option value='".$fila["Id"]."'>{$fila["Nombre"]}</option>";
                 }
                 ?>
               </select>
               <a type="button" name="button" class="verSubcategorias btn col col-3" data-num="0"><span class="glyphicon glyphicon-arrow-down">↓</span></a>
             </div>
           </div>
         </div>
       </div>
       <div class="border border-dark p-3 col col-md-8">
         <a id="InsertarCaracteristica" class="btn btn-success">Insertar Característica </a>
         <h2 class="b-1 text-center">Características</h2>
         <div class="p-2 ContenedorCaracteristicas row">

         </div>
       </div>
     </div>
   </div>

   <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="ModificarrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <p class="h5 p-3 text-center">Modificar característica : <span id="cat_pad3" style="color:rgb(2, 0, 117);"></span></p>
         <div class="modal-header">
           <div class="autocomplete" style="width:300px;">
              <h4>Nombre</h4>
              <input id="ModificarCarac" type="text" class="form-control" placeholder="Nombre Caracteristica">
          </div>
         </div>
         <div class="modal-body">
           <form>
             <div class="form-group">
               <h4>Valores</h4>
               <input type="text" class="form-control " id="inlineFormInput3" placeholder="Elemento">
               <a  id="newCat3" class=" btn btn-primary">Nuevo elemento</a>
             </div>
             <div id="Elementos3">
               <h5>Elementos</h5>
               <ul id="EditElements">
               </ul>
               <ul id="newsElements">
               </ul>
             </div>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-success" id="ComfMod">Confirmar cambios</button>
           <button type="button" class="btn btn-danger" id="CancelMod" >cerrar y cancelar</button>
         </div>
       </div>
     </div>
   </div>

   <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="InsertarModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <p class="h5 p-3 text-center">Subcaracteristíca de : <span id="cat_pad2" style="color:rgb(2, 0, 117);"></span></p>
         <div class="modal-header">
           <div class="autocomplete" style="width:300px;">
              <h4>Nombre</h4>
              <input id="InsertarCarac2" type="text" class="form-control" placeholder="Nombre Caracteristica">
          </div>
         </div>
         <div class="modal-body">
           <form>
             <div class="form-group">
               <h4>Valores</h4>
               <input type="text" class="form-control " id="inlineFormInput2" placeholder="Inserta elemento">
               <a  id="newCat2" class=" btn btn-primary">Insertar elemento</a>
             </div>
             <div id="Elementos2">
               <h5>Elementos</h5>
               <ul id="mostrarEle2">
                 <li>No se han insertato valores</li>
               </ul>
             </div>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-success" id="ComfIns2">Insertar</button>
           <button type="button" class="btn btn-danger" id="CancelIns2" >cerrar y cancelar</button>
         </div>
       </div>
     </div>
   </div>

   <div class="modal fade"  data-backdrop="static" data-keyboard="false" id="InsertarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <p class="h5 p-3 text-center">Categoría padre: <span id="cat_pad" style="color:rgb(2, 0, 117);"></span></p>
         <div class="modal-header">
           <div class="autocomplete" style="width:300px;">
              <h4>Nombre</h4>
              <input id="InsertarCarac" type="text" class="form-control" placeholder="Nombre Caracteristica">
          </div>
         </div>
         <div class="modal-body">
           <form>
             <div class="form-group">
               <h4>Valores</h4>
               <input type="text" class="form-control " id="inlineFormInput" placeholder="">
               <a  id="newCat" class=" btn btn-primary">Insertar elemento</a>
             </div>
             <div id="Elementos">
               <h5>Elementos</h5>
               <ul id="mostrarEle">
                 <li>No se han insertato valores</li>
               </ul>
             </div>
           </form>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-success" id="ComfIns">Insertar</button>
           <button type="button" class="btn btn-danger" id="CancelIns" >cerrar y cancelar</button>
         </div>
       </div>
     </div>
   </div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/autocomplete.js"></script>
<script type="text/javascript" src="js/caracteristicas.js"></script>
</div>
</body>
 </html>
 <?php
 } else {
   echo "<h2>Usted no tiene permiso para acceder a esta pantalla.</h2>";
 }
 ?>
