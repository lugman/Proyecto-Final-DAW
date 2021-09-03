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
         flex-direction: column;
         justify-content: center;
         align-items: flex-start;
       }
     </style>
   </head>
   <body>
     <?php include("php/navbar.php"); ?>
<div class="container p-5"  style="min-height:700px;">
<div class="row">
  <div class="col col-md-6">
    <h2>Nombres caracteristicas</h2>
  </div>
  <div class="col col-md-6">

  </div>
</div>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/tipos.js"></script>
 </body>
   <?php include("php/footer.php"); ?>
 </html>
