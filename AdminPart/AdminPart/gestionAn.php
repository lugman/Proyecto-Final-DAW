<?php
include("php/conexion.php");
include("php/funciones.php");
$categorias = traer_categorias($conexion);
session_start();
if(isset($_SESSION["Admin"]) && $_SESSION["Admin"]){
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
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
     <link rel="stylesheet" href="autocomplete.css">
   </head>
   <?php include("php/navbar.php"); ?>
   <div class="contenedorCentral">
     <div class="container">

     <button type="button" id="VerUs" class="btn">Ver</button>
     <button type="button" id="BorrarUs" class="btn btn-danger">Borrar</button>
   </div>
<div class="p-5">

     <table id="example" class="display" style="width:100%">
             <thead>
                 <tr>
                     <th>Id</th>
                     <th>Nombre</th>
                     <th>Fecha.</th>
                     <th>Fecha modificación.</th>
                     <th>Precio</th>
                     <th>Usuario</th>
                     <th>Estado</th>
                     <th>Membresia</th>
                 </tr>
             </thead>
             <tfoot>
                 <tr>
                   <th>Id</th>
                   <th>Nombre</th>
                   <th>Fecha.</th>
                   <th>Fecha modificación.</th>
                   <th>Precio</th>
                   <th>Usuario</th>
                   <th>Estado</th>
                   <th>Membresia</th>
             </tfoot>
         </table>

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
               <input type="text" class="form-control " id="inlineFormInput" placeholder="Jane Doe">
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
           <button type="button" class="btn btn-danger" id="CancelIns" >cerrar y cancelarr</button>
         </div>
       </div>
     </div>
   </div>

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/anuncios.js"></script>
</div>
</body>
 </html>
<?php
} else {
  echo "<h2>Usted no tiene permiso para acceder a esta pantalla.</h2>";
}
?>
