<?php
$fotos = [];
foreach (scan("../../uploads/DNI/rechazado") as $value) {
$fotos [] = array('Nombre' =>  explode(".",$value)[0],'Foto' => "uploads/DNI/rechazado/".$value);
}
echo json_encode($fotos);


function scan($dir) {

   $result = array();

   $cdir = scandir($dir);
   foreach ($cdir as $key => $value)
   {
      if (!in_array($value,array(".","..")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
         }
         else
         {
            $result[] = $value;
         }
      }
   }

   return $result;
}
 ?>
