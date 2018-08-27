<?php
/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class ReciboEquipos extends Modelos {
  private static
   $nTabla = "reciboequipos";
  private static
   $sqlBase = "SELECT reciboequipos.* FROM reciboequipos ";
  private static
   $sqlCompleta = <<<EOD
   SELECT
    reciboequipos.*
    , recibosserviciosequipos.*
   , clientes.*
    , servicios.*
    , equipos.*
    , tiposequipos .* 
    , tiposmovimientos.*
   , usuarios.*
   , documentos.*
FROM
    reciboequipos
    INNER JOIN recibosserviciosequipos 
        ON (reciboequipos.reciboServicioEquipo = recibosserviciosequipos.reciboId)   
    LEFT JOIN clientes 
        ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)   
    LEFT JOIN documentos 
        ON (recibosserviciosequipos.reciboDocumento = documentos.documentoId)  
    LEFT JOIN equipos 
        ON (reciboequipos.reciboEquipoEnServicio = equipos.equipoId)
   LEFT JOIN tiposequipos 
        ON (equipos.equipoTipo = tiposequipos.tipoEquipoId) 
    LEFT JOIN tiposmovimientos 
        ON (reciboequipos.reciboEquipoMovimiento = tiposmovimientos.movimientoId)
    LEFT JOIN servicios 
        ON (recibosserviciosequipos.reciboServicio = servicios.servicioId)  
    LEFT JOIN usuarios 
        ON (recibosserviciosequipos.reciboUsuarioCrea = usuarios.usuarioId)  
EOD;
  private static
   $sqlJoin = "";
  private static
   $sqlPorRecoger = <<<sqlPorRecoger
   SELECT
    reciboequipos.*
    , equipos.*
    , tiposequipos.*
    , clientes.*
FROM
    reciboequipos
    INNER JOIN recibosserviciosequipos 
        ON (reciboequipos.reciboServicioEquipo = recibosserviciosequipos.reciboId)
    INNER JOIN equipos 
        ON (reciboequipos.reciboEquipoEnServicio = equipos.equipoId)
    INNER JOIN clientes 
        ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)
    INNER JOIN tiposequipos 
        ON (equipos.equipoTipo = tiposequipos.tipoEquipoId)  
sqlPorRecoger;

  static public
   function todos($ESTADO = 'ACTIVO') {
    $query = self::$sqlBase . ' WHERE reciboEquipoEstado = "' . $ESTADO . '"';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function todos_del_servicio($idServicio) {
    $query = self::$sqlCompleta . ' WHERE servicios.servicioId = ' . $idServicio . ' ';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function todos_del_recibo($reciboId) {
    $query = self::$sqlCompleta . ' WHERE recibosserviciosequipos.reciboId = ' . $reciboId . ' ';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function recibosPorEquipo($equipoId) {
    $query = self::$sqlCompleta . ' WHERE equipos.equipoId = ' . $equipoId . ' AND recibosserviciosequipos.reciboEstado = "ACTIVO" ORDER BY recibosserviciosequipos.reciboFechaServicio DESC ';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($idReciboEquipo) {
    $query = self::$sqlBase . " WHERE reciboequipos.reciboEquipoId = ? ";
    $resultado = self::consulta($query, array($idReciboEquipo));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function pendientesPorRecogerPorCliente($idCliente) {
    $query = self::$sqlPorRecoger . " WHERE (     equipos.equipoEstadoServicio = 2  AND equipos.equipoClienteServicio = ? )   GROUP BY equipos.equipoId ";
    $resultado = self::consulta($query, array($idCliente));
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function insertar($reciboServicioEquipo, $reciboEquipoMovimiento, $reciboEquipoEnServicio) {
    $query = " INSERT INTO reciboequipos   ( "
     . "reciboServicioEquipo, reciboEquipoMovimiento, reciboEquipoEnServicio "
     . ") VALUES ( ?, ?, ? ) ; ";
    $resultado = self::crearUltimoId(
      $query, array($reciboServicioEquipo, $reciboEquipoMovimiento,
      $reciboEquipoEnServicio)
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}