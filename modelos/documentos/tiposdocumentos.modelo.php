<?php
/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class TiposDocumentos extends Modelos {
  private static
   $nTabla = "tiposdocumentos";
  private static
   $sqlBase = "SELECT tiposdocumentos.* FROM tiposdocumentos ";
  private static
   $sqlCompleta = "";
  private static
   $sqlJoin = "";

  static public
   function todos() {
    $query = self::$sqlBase; //. ' WHERE tipoDocumentoEstado = "' . $ESTADO . '"';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($tipoDocId) {
    $query = self::$sqlBase . " WHERE tiposdocumentos.tipoDocId = ? ";
    $resultado = self::consulta($query, array($tipoDocId));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datosPorCodigo($tipoDocCodigo) {
    $query = self::$sqlBase . " WHERE tiposdocumentos.tipoDocCodigo = ? ";
    $resultado = self::consulta($query, array($tipoDocCodigo));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function usarConsecutivo($tipoDocCodigo) {
    $query = "UPDATE `tiposdocumentos` SET `tipoDocActual` = tipoDocActual + 1 WHERE `tipoDocCodigo` = ? ; ";
    $resultado = self::modificarRegistros($query, array($tipoDocCodigo));    
    $query = "SELECT "
     . "LPAD( tiposdocumentos.tipoDocActual , tiposdocumentos.tipoDocLongitud , tiposdocumentos.tipoDocRelleno ) AS CONSECUTIVO "
     . "FROM tiposdocumentos WHERE `tipoDocCodigo` = ? ;  ";
    $resultado = self::consulta($query, array($tipoDocCodigo));    
    if(count($resultado) > 0) {
      return $resultado[0]->CONSECUTIVO;
    }
    return NULL;
  }

}