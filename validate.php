<?php
if (isset($_GET['Id'])) {
  $id = $_GET['Id'];
  $cond = $_GET['cod'];
  $token = $_GET['token'];

include("php/conexion.php");

$verf=false;
$sql = "SELECT * FROM `validacionemail` WHERE id='{$id}'";
$resultado = mysqli_query($conexion,$sql);
if (mysqli_num_rows($resultado)>0) {
  $resultado=mysqli_fetch_array($resultado);
  if ($resultado["EmailToken"]===$cond) {
    if ($resultado["Token"]===$token) {
      $idVerficar="SELECT `cod_verificiacacion` FROM `usuario` WHERE Id=".$resultado["cod_usuario"];
      $resultadoUs = mysqli_query($conexion,$idVerficar);

      $cod_verificiacacion=mysqli_fetch_array($resultadoUs);
      $Id=$cod_verificiacacion["cod_verificiacacion"];
        $verificarUs="UPDATE verificacion SET  Email_VF=1 WHERE Id=".$Id;
        $resultado = mysqli_query($conexion,$verificarUs);
        if ($resultado) {
          $verf=true;
          $borrarLink = "DELETE FROM `validacionemail` WHERE id='{$id}'";
          mysqli_query($conexion,$borrarLink);

        }
    }
  }
}
}

include("estructura/cabecera.php");
include("estructura/barra_menu.php");



?>


 <body>
  <div class="container" role="main" style="padding:300px;">
    <?php if (isset($verf)&&$verf) { ?>
    <h2 class="text-center text-green">Correo verificado con éxito.</h2>
  <?php }else{ ?>
    <h2 class="text-center text-red">Este enlace no es valido!.<br/>  <small class=" text-red">por favor vuelva a solicitar la verificación.</small></h2>
  <?php } ?>

 </div>
 </body>
 <script type="text/javascript" src="assets/js/recordar.js"></script>
</html>
<?php
 include("estructura/pie.html");
?>
