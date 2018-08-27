<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'libs/docs/excel/PHPExcel.php';
require_once 'libs/docs/excel/PHPExcel/IOFactory.php';

class Excel extends PHPExcel {

  public
   $letrasCols = array();

  function __construct() {
    parent::__construct();
    $this->letrasCols = range('a', 'z');
    array_push($this->letrasCols, 'aa');
    array_push($this->letrasCols, 'ab');
    array_push($this->letrasCols, 'ac');
    array_push($this->letrasCols, 'ad');
    array_push($this->letrasCols, 'ae');
    array_push($this->letrasCols, 'af');
    array_push($this->letrasCols, 'ag');
    array_push($this->letrasCols, 'ah');
    array_push($this->letrasCols, 'ai');
    array_push($this->letrasCols, 'aj');
    array_push($this->letrasCols, 'ak');

    //print_r($this->letrasCols);
  }

  function agregar_fila_sinindices($objPHPExcel, $arrayValores, $fila = 1, $hoja = 0) {
    $TMPobjPHPExcel = $objPHPExcel->setActiveSheetIndex($hoja);
    foreach($arrayValores as $indice => $valor) {
      $TMPobjPHPExcel = $TMPobjPHPExcel->setCellValue($this->letrasCols[$indice] . $fila, $valor);
    }
    return $objPHPExcel;
  }

  function agregar_fila($objPHPExcel, $arrayValores, $hoja = 0) {
    $TMPobjPHPExcel = $objPHPExcel->setActiveSheetIndex($hoja);
    foreach($arrayValores as $indice => $valor) {
      $TMPobjPHPExcel = $TMPobjPHPExcel->setCellValue($indice, $valor);
    }
    return $objPHPExcel;
  }

  function agregar_encabezados_sinindices($objPHPExcel, $arrayValores, $hoja = 0) {
    $hoja = $objPHPExcel->setActiveSheetIndex($hoja);
    foreach($arrayValores as $indice => $valor) {
      $hoja->setCellValue(
       $this->letrasCols[$indice] . 1, $valor
      );
    }
    return $objPHPExcel;
  }

  function agregar_encabezados($objPHPExcel, $arrayValores, $hoja = 0) {
    $TMPobjPHPExcel = $objPHPExcel->setActiveSheetIndex($hoja);
    foreach($arrayValores as $indice => $valor) {
      $TMPobjPHPExcel = $TMPobjPHPExcel->setCellValue($indice, $valor);
    }
    return $objPHPExcel;
  }

}
