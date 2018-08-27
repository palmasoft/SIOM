<?php

class RecibosServicios extends Modelos {

  private static
   $nTabla = "recibosserviciosequipos";
  private static
   $sqlBase = <<<sqlBase
   SELECT
        recibosserviciosequipos.*
        , servicios.*
        , clientes.*
        , clientescontactos.*
        , recibodepositos.*
    FROM
        recibosserviciosequipos
        INNER JOIN servicios 
            ON (recibosserviciosequipos.reciboServicio = servicios.servicioId)
        INNER JOIN clientes 
            ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)
        LEFT JOIN clientescontactos 
            ON (recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId)
        INNER JOIN usuarios 
            ON (recibosserviciosequipos.reciboUsuarioAtiende = usuarios.usuarioId)
        LEFT JOIN recibodepositos 
            ON (recibosserviciosequipos.reciboId = recibodepositos.reciboServicioDeposito) 
sqlBase;
  private static
   $sqlCompleta = "";
  private static
   $sqlJoin = "";

  static public
   function todos($ESTADO = 'ACTIVO') {
    $query = self::$sqlBase . ' WHERE reciboEstado = "' . $ESTADO . '"';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($idReciboServicioEquipos) {
    $query = self::$sqlBase . " WHERE recibosserviciosequipos.reciboId = ? ";
    $resultado = self::consulta($query, array($idReciboServicioEquipos));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datos_por_servicio($idServicio) {
    $query = self::$sqlBase . " "
     . "WHERE recibosserviciosequipos.reciboId = (SELECT MAX( recibosserviciosequipos.reciboId ) FROM recibosserviciosequipos WHERE recibosserviciosequipos.reciboServicio = ? )  "
     . "AND servicios.servicioId = ? ";
    $resultado = self::consulta($query, array($idServicio, $idServicio));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function recibosPorCliente($idCliente) {
    $query = self::$sqlBase . " WHERE recibosserviciosequipos.reciboCliente = ? AND  recibosserviciosequipos.reciboEstado = 'ACTIVO'   ";
    $resultado = self::consulta($query, array($idCliente));
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function insertar($reciboServicio, $reciboNumero, $reciboFechaServicio, $reciboFechaRecogida, $reciboCliente,
                     $reciboReferencia, $reciboDireccion, $reciboUsuarioAtiende, $reciboLatitud, $reciboLongitud) {
    $query = " INSERT INTO recibosserviciosequipos ( "
     . "reciboServicio, reciboNumero, "
     . "reciboFechaServicio , reciboFechaRecogida, "
     . "reciboCliente, reciboReferencia, reciboDireccion, reciboUsuarioAtiende, "
     . "reciboLatitud, reciboLongitud, reciboUsuarioCrea "
     . ") VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ) ; ";
    $resultado = self::crearUltimoId(
      $query,
      array($reciboServicio, $reciboNumero, $reciboFechaServicio,
      $reciboFechaRecogida, $reciboCliente, $reciboReferencia,
      $reciboDireccion, $reciboUsuarioAtiende, $reciboLatitud,
      $reciboLongitud, Visitante::idUsuario())
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function actualizar_documento($idRecibo, $idDocumentoRecibo) {
    $query = " UPDATE recibosserviciosequipos SET "
     . "reciboDocumento = ? "
     . "WHERE reciboId = ? ; ";
    $resultado = self::modificarRegistros(
      $query, array($idDocumentoRecibo, $idRecibo)
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function reactivar($idReciboServicioEquipos) {
    $query = " UPDATE `recibosserviciosequipos` "
     . "SET reciboEstado = 'ACTIVO' , reciboFechaAnulado = CURRENT_TIMESTAMP , reciboUsuarioAnula = ? "
     . "WHERE `reciboId` = ? ; ";
    $resultado = self::modificarRegistros($query, array(Visitante::idUsuario(), $idReciboServicioEquipos));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function anular($idReciboServicioEquipos) {
    $query = " UPDATE recibosserviciosequipos "
     . "SET reciboEstado = 'ANULADO' , reciboFechaAnulado = CURRENT_TIMESTAMP , reciboUsuarioAnula = ? "
     . "WHERE reciboId = ? ; ";
    $resultado = self::modificarRegistros($query, array(Visitante::idUsuario(), $idReciboServicioEquipos));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  /////////
  //////
  ////
//
}
