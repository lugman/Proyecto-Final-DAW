<?php
include("estructura/cabecera.php");
include("estructura/barra_menu.php");
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $idusuario = $_GET['idusuario'];
  $email = $_GET['Email'];

?>
  <div class="container" role="main">
   <div class="col-md-4"></div>
   <div class="col-md-4">
    <form action=""  data-toggle="validator">
     <div class="panel panel-default">
      <div class="panel-heading"> Restaurar contraseña </div>
      <div class="panel-body">
       <p></p>
       <div class="form-group">
        <label for="password"> Nueva contraseña </label>
        <input type="password" id="cont" class="form-control" name="password1" pattern="(?=\w*\d)(?=\w*[A-z])\S{6,50}$" required>
       </div>
       <div class="form-group">
        <label for="password2"> Confirmar contraseña </label>
        <input type="password"  id="cont2" class="form-control" name="password2" pattern="(?=\w*\d)(?=\w*[A-z])\S{6,50}$" required>
       </div>
       <input type="hidden" name="token" id="tok" value="<?php echo $token ?>">
       <input type="hidden" name="idusuario" id="id" value="<?php echo $idusuario ?>">
       <input type="hidden" name="idusuario" id="email" value="<?php echo $email ?>">
       <div class="form-group">
        <input type="submit" class="btn btn-primary" id="cambiar" value="Recuperar contraseña" >
       </div>
      </div>
     </div>
    </form>
   </div>
  <div class="col-md-4"></div>  </div>
 </body>
 <script type="text/javascript" src="assets/js/recordar.js"></script>
</html>
<?php }else{ ?>
  <div class="container">
    <br>
    <br>
    <br>
    <br>
    <h2 class="text-center">Enalce no valido.</h2>
    <br>
    <br>
    <br>
    <br>
  </div>
<?php
}
 include("estructura/pie.html");
?>
