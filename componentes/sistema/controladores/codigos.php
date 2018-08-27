<?php

//include PATH_LIBS.'codigos/qrcode/index.php';
class codigosControlador extends Controladores {

  function codigoDeBarras() {

    require_once(PATH_LIBS . 'codigos/barcode/class/BCGFontFile.php');
    require_once(PATH_LIBS . 'codigos/barcode/class/BCGColor.php');
    require_once(PATH_LIBS . 'codigos/barcode/class/BCGDrawing.php');
    require_once(PATH_LIBS . 'codigos/barcode/class/BCGcode128.barcode.php');
    $colorFont = new BCGColor(0, 0, 0);
    $colorBack = new BCGColor(255, 255, 255);
    $font = new BCGFontFile(PATH_LIBS . 'codigos/barcode/font/Arial.ttf', 12);
    $code = new BCGcode128(); // Or another class name from the manual
    $code->setScale(3); // Resolution
    $code->setThickness(30); // Thickness
    $code->setForegroundColor($colorFont); // Color of bars
    $code->setBackgroundColor($colorBack); // Color of spaces
    $code->setFont($font); // Font (or 0)
    $code->parse(self::$datos['texto']); // Text
    $code->clearLabels();

    $ruta = PATH_ARCHIVOS . self::$datos['tipoObjeto'] . DS . 'barcode' . DS;
    $url = URL_ARCHIVOS . self::$datos['tipoObjeto'] . '/barcode/';
    $nombre = self::$datos['texto'] . '-bc.png';
    Archivos::probar_crear_directorio($ruta);

    $drawing = new BCGDrawing('', $colorBack);
    $drawing->setBarcode($code);
    $drawing->draw();
    $drawing->setFilename($ruta . $nombre);
    $drawing->finish(BCGDrawing::IMG_FORMAT_PNG);

    echo json_encode(array("archivo" => $url . $nombre, "mensaje" => 'Generado Correctamente.'));
  }

  function codigoQR() {
    include PATH_LIBS . 'codigos/qrcode/qrlib.php';


    $ruta = PATH_ARCHIVOS . self::$datos['tipoObjeto'] . DS . 'qrcode' . DS;
    $url = URL_ARCHIVOS . self::$datos['tipoObjeto'] . '/qrcode/';
    $nombre = self::$datos['texto'] . '-qr.png';
    Archivos::probar_crear_directorio($ruta);

    if(file_exists($ruta . $nombre)) {
      unlink($ruta . $nombre);
    }
    QRcode::png(self::$datos['texto'], $ruta . $nombre, QR_ECLEVEL_H, 6); // creates file 

    echo json_encode(array("archivo" => $url . $nombre, "mensaje" => 'Generado Correctamente.'));
  }

}
