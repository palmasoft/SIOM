<?php

class ReciboControlCambios extends Modelos {

  private static
   $nTabla = "recibocontrolcambios";
  private static
   $sqlBase = "SELECT recibocontrolcambios.* FROM recibocontrolcambios ";
  private static
   $sqlCompleta = <<<sqlCompleto
   SELECT 
  personas.*
  , usuarios.*
  , tiposmotivos.*
  , servicios.*
  , recibocontrolcambios.* 
FROM
  recibocontrolcambios 
  INNER JOIN servicios 
    ON (
      recibocontrolcambios.reciboCambioServicio = servicios.servicioId
    ) 
  INNER JOIN tiposmotivos 
    ON (
      recibocontrolcambios.reciboCambioMotivo = tiposmotivos.tipoMotivoId
    ) 
  INNER JOIN usuarios 
    ON (
      recibocontrolcambios.reciboCambioUsuario = usuarios.usuarioId
    ) 
  INNER JOIN personas 
    ON (
      usuarios.usuarioPersona = personas.personaId
    ) 
sqlCompleto;
  private static
   $sqlJoin = "";

  static public
   function todos() {
    $query = self::$sqlBase . '  ';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($recibocontrolcambios) {
    $query = self::$sqlBase . " WHERE recibocontrolcambios.reciboCambioId = ? ";
    $resultado = self::consulta($query, array($recibocontrolcambios));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function ultimo_del_servicio($idNuevoServicio) {
    $query = self::$sqlBase . " WHERE recibocontrolcambios.reciboCambioFecha = (SELECT MAX(reciboCambioFecha) FROM  recibocontrolcambios WHERE  recibocontrolcambios.reciboCambioServicio = ? )  ";
    $resultado = self::consulta($query, array($idNuevoServicio));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function insertar($reciboCambioServicio, $reciboCambioMotivo, $reciboCambioObservacion, $reciboCambioDatosAntes,
                     $reciboCambioDatosDespues) {
    $query = " INSERT INTO recibocontrolcambios (  "
     . "reciboCambioServicio, reciboCambioFecha, reciboCambioMotivo, reciboCambioObservacion, "
     . "reciboCambioUsuario, reciboCambioDatosAntes, reciboCambioDatosDespues "
     . ") VALUES ( ?, CURRENT_TIMESTAMP, ?, ?, ?, ?, ? ) ; ";
    $resultado = self::crearUltimoId(
      $query,
      array(
      $reciboCambioServicio, $reciboCambioMotivo, $reciboCambioObservacion, Visitante::idUsuario(),
      $reciboCambioDatosAntes, $reciboCambioDatosDespues
      )
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}
