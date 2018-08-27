<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class TiposMotivos extends Modelos {

  private static
   $nTabla = "tiposmotivos";
  private static
   $sqlBase = "SELECT tiposmotivos.* FROM tiposmotivos ";
  private static
   $sqlCompleta = "";
  private static
   $sqlJoin = "";

  static public
   function todos() {
    $query = self::$sqlBase;
    $resultado = self::consulta($query);
    if (count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($tipoMotivoId) {
    $query = self::$sqlBase . " WHERE " . self::$nTabla . ".tipoMotivoId = ? ";
    $resultado = self::consulta($query, array($tipoMotivoId));
    if (count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

}
