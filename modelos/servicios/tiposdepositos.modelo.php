<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class TiposDepositos extends Modelos {

  private static
   $nTabla = "tiposdepositos";
  private static
   $sqlBase = "SELECT tiposdepositos.* FROM tiposdepositos ";
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
   function datos($depositoId) {
    $query = self::$sqlBase . " WHERE " . self::$nTabla . ".depositoId = ? ";
    $resultado = self::consulta($query, array($depositoId));
    if (count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

}
