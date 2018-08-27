<?php
$ext = exif_imagetype($_GET['url']);
switch($ext) {
  case "gif": $ctype = "image/gif";
    break;
  case "png": $ctype = "image/png";
    break;
  case "jpeg":
  case "jpg": $ctype = "image/jpeg";
    break;
  default:
}

header('Content-type: ' . $ctype);
$porcentaje = 0.1;
if($ext == IMAGETYPE_GIF) {
  $rsr_org = imagecreatefromgif($_GET['url']);
} else if($ext == IMAGETYPE_PNG) {
  $rsr_org = imagecreatefrompng($_GET['url']);
} else if($ext == IMAGETYPE_JPEG) {
  $rsr_org = imagecreatefromjpeg($_GET['url']);
}
// Obtener los nuevos tamaños
list($ancho, $alto) = getimagesize($_GET['url']);
$nuevo_ancho = 100;//$ancho * $porcentaje;
$nuevo_alto = 100;//$alto * $porcentaje;

// Cargar
$thumb = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

// Cambiar el tamaño
imagecopyresized($thumb, $rsr_org, 0, 0, 0, 0, $nuevo_ancho, $nuevo_alto, $ancho, $alto);

// Imprimir
imagejpeg($thumb);
