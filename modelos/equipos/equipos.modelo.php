<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Equipos extends Modelos {

    private static
            $nTabla = "equipos";
    private static
            $sqlBase = "SELECT `equipos`.* , `tiposequipos`.* FROM `equipos` LEFT JOIN `tiposequipos` ON ( `equipos`.`equipoTipo` = `tiposequipos`.`tipoEquipoId` ) ";
    private static
            $sqlCompleta = <<<sqlCompleta
  SELECT 
  equiposestados.*
  , equipos.*
  , tiposequipos.* 
  , clientes.*
  , personas.*
  , recibosserviciosequipos.*
FROM
  equipos 
  INNER JOIN tiposequipos 
    ON (
      equipos.equipoTipo = tiposequipos.tipoEquipoId
    ) 
  INNER JOIN equiposestados 
    ON (
      equipos.equipoEstadoServicio = equiposestados.equipoEstadoId
    ) 
    LEFT JOIN clientes 
        ON (equipos.equipoClienteServicio = clientes.clienteId)
    LEFT JOIN recibosserviciosequipos 
        ON (equipos.equipoReciboServicio = recibosserviciosequipos.reciboId)
    LEFT JOIN personas 
        ON (clientes.clientePersona = personas.personaId)
sqlCompleta;
    private static
            $sqlJoin = "";
    public static
            $DISPONIBLE = "1";
    public static
            $EN_SERVICIO = "2";
    public static
            $DESHABILITADO = "3";
    public static
            $EN_MANTENIMIENTO = "4";

    static public
            function todos($ESTADO = 'ACTIVO') {
        $query = self::$sqlBase . ' WHERE equipoEstado = "' . $ESTADO . '"';
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function disponibles($ESTADO = 'ACTIVO') {
        $query = self::$sqlCompleta . ' WHERE equipoEstado = "' . $ESTADO . '" AND equipoEstadoServicio = ' . self::$DISPONIBLE . ' ; ';
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function todos_listado($ESTADO = 'ACTIVO') {
        $query = self::$sqlCompleta . ' WHERE equipoEstado = "' . $ESTADO . '"';
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function datos($idEquipo) {
        $query = self::$sqlBase . " WHERE equipos.equipoId = ? ";
        $resultado = self::consulta($query, array($idEquipo));
        if (count($resultado) > 0) {
            return $resultado[0];
        }
        return NULL;
    }

    static public
            function datos_completos($idEquipo) {
        $query = self::$sqlCompleta . " WHERE equipos.equipoId = ? ";
        $resultado = self::consulta($query, array($idEquipo));
        if (count($resultado) > 0) {
            return $resultado[0];
        }
        return NULL;
    }

    private static
            $sqlMovimientos = <<<sqlCompletasql
SELECT 
  equiposestados.*
  , equipos.*
  , tiposequipos.*
  , clientes.*
  , personas.*
  , recibosserviciosequipos.*
  , COUNT(
    DISTINCT SERVICIOSPRESTADOS.reciboId
  ) AS NUM_RECIBOS  
FROM
  equipos 
  INNER JOIN tiposequipos 
    ON (
      equipos.equipoTipo = tiposequipos.tipoEquipoId
    ) 
  INNER JOIN equiposestados 
    ON (
      equipos.equipoEstadoServicio = equiposestados.equipoEstadoId
    ) 
  LEFT JOIN clientes 
    ON (
      equipos.equipoClienteServicio = clientes.clienteId
    ) 
  LEFT JOIN recibosserviciosequipos 
    ON (
      equipos.equipoReciboServicio = recibosserviciosequipos.reciboId
    ) 
  LEFT JOIN personas 
    ON (
      clientes.clientePersona = personas.personaId
    ) 
  INNER JOIN reciboequipos 
    ON (
      equipos.equipoId = reciboequipos.reciboEquipoId
    ) 
  INNER JOIN recibosserviciosequipos AS SERVICIOSPRESTADOS 
    ON (
      reciboequipos.reciboServicioEquipo = SERVICIOSPRESTADOS.reciboId 
      AND SERVICIOSPRESTADOS.reciboEstado = 'ACTIVO'
    ) 

sqlCompletasql;

    static public
            function totalesMovimientos($fechasInicial, $fechasFinal) {
        $query = self::$sqlMovimientos
                . "WHERE recibosserviciosequipos.reciboFechaServicio BETWEEN '$fechasInicial 00:00:00' AND '$fechasFinal 23:59:59'  "
                . "GROUP BY equipos.equipoId  "
                . "ORDER BY recibosserviciosequipos.reciboFechaServicio DESC, NUM_RECIBOS DESC  "
                . " ";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    private static $sqlListaMovimientos = <<<sqlCompletasql
SELECT
    recibosserviciosequipos.reciboFechaServicio
    , recibosserviciosequipos.reciboNumero
    , tiposmovimientos.movimientoId 
    , tiposmovimientos.movimientoCodigo
    , recibosserviciosequipos.reciboCliente
    , datoscliente.personaIdentificacion
    , datoscliente.personaRazonSocial
    
    , recibosserviciosequipos.reciboReferencia
    , clientescontactos.clienteContactoEtiquetas
    , datosreferencia.personaIdentificacion AS referenciaIdentificacion
    , datosreferencia.personaRazonSocial AS referenciaRazonSocial
    , recibodepositos.reciboDepositoDocIngreso
FROM
    recibosserviciosequipos
    INNER JOIN reciboequipos 
        ON (recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo)
    LEFT JOIN recibodepositos 
        ON (recibosserviciosequipos.reciboId = recibodepositos.reciboServicioDeposito)        
    INNER JOIN tiposmovimientos 
        ON (reciboequipos.reciboEquipoMovimiento = tiposmovimientos.movimientoId)
    INNER JOIN clientes 
        ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)
    LEFT JOIN clientescontactos 
        ON (recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoPersona)
    LEFT JOIN personas AS datoscliente
        ON (clientes.clientePersona = datoscliente.personaId)
    LEFT JOIN personas AS datosreferencia
        ON (recibosserviciosequipos.reciboReferencia = datosreferencia.personaId)

sqlCompletasql;

    static
    public function movimientos($idEquipo, $fechasInicial, $fechasFinal) {
        $query = self::$sqlListaMovimientos
                . "WHERE "
                . "recibosserviciosequipos.reciboFechaServicio BETWEEN '$fechasInicial 00:00:00' AND '$fechasFinal 23:59:59' "
                . "AND "
                . "reciboequipos.reciboEquipoEnServicio = $idEquipo "
                . "AND recibosserviciosequipos.reciboEstado = 'ACTIVO' "
                . "ORDER BY reciboFechaServicio DESC  "
                . " ";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static
    public function todosMovimientos($idEquipo) {
        $query = self::$sqlListaMovimientos
                . "WHERE "
                . "reciboequipos.reciboEquipoEnServicio = $idEquipo "
                . "AND recibosserviciosequipos.reciboEstado = 'ACTIVO' "
                . "ORDER BY reciboFechaServicio DESC  "
                . " ";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    //
    //
  //
  //
  //
  //

  static public
            function insertar($equipoTipo, $equipoCodigo, $equipoSerial, $equipoTitulo, $equipoCapacidad, $equipoUrlQR, $equipoUrlBARRAS, $equipoObservaciones) {
        $query = " INSERT INTO `equipos` ( "
                . "`equipoTipo`,  `equipoCodigo`,  `equipoSerial`,  `equipoTitulo`,  `equipoCapacidad`,  `equipoUrlQR`,  `equipoUrlBARRAS`,  `equipoObservaciones`,  `equipoUsuarioCrea` "
                . ") VALUES ( ?, ?, ? ,?, ?, ? ,?, ?, ? ) ; ";
        $resultado = self::crearUltimoId($query, array($equipoTipo, $equipoCodigo, $equipoSerial,
                    $equipoTitulo, $equipoCapacidad, $equipoUrlQR, $equipoUrlBARRAS,
                    $equipoObservaciones, Visitante::idUsuario())
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function actualizar($idEquipo, $equipoTipo, $equipoCodigo, $equipoSerial, $equipoTitulo, $equipoCapacidad, $equipoUrlQR, $equipoUrlBARRAS, $equipoObservaciones) {
        $query = " UPDATE `equipos` SET "
                . "`equipoTipo` = ?, `equipoCodigo` = ?, `equipoSerial` = ?, `equipoTitulo` = ?, "
                . "`equipoCapacidad` = ?, `equipoUrlQR` = ?, `equipoUrlBARRAS` = ?, `equipoObservaciones` = ?, "
                . "`equipoFechaModifica` = CURRENT_TIMESTAMP, `equipoUsuarioModifica` = ? "
                . "WHERE `equipoId` = ? ; ";
        $resultado = self::modificarRegistros($query, array($equipoTipo, $equipoCodigo, $equipoSerial,
                    $equipoTitulo, $equipoCapacidad, $equipoUrlQR, $equipoUrlBARRAS,
                    $equipoObservaciones, Visitante::idUsuario(), $idEquipo)
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function LOGUbicaciones($idEquipo, $equipoUltimaUbicacionLatitud, $equipoUltimaUbicacionLongitud) {
        $query = " INSERT INTO equiposubicaciones ( "
                . "equipoUbicacion , equipoUbicacionLatitud , equipoUbicacionLongitud , equipoUbicacionUsuario "
                . ") VALUES ( ?, ?, ?, ? ) "
                . "  ";
        $resultado = self::modificarRegistros(
                        $query, array(
                    $idEquipo, $equipoUltimaUbicacionLatitud, $equipoUltimaUbicacionLongitud, Visitante::idUsuario()
                        )
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function cambiarUbicacion($idEquipo, $equipoUltimaUbicacionLatitud, $equipoUltimaUbicacionLongitud) {
        $query = " UPDATE `equipos` SET "
                . "`equipoUltimaUbicacionLatitud` = ?, `equipoUltimaUbicacionLongitud` = ?, "
                . "`equipoUltimaUbicacionFecha` = CURRENT_TIMESTAMP "
                . "WHERE `equipoId` = ? ; ";
        $resultado = self::modificarRegistros(
                        $query, array($equipoUltimaUbicacionLatitud, $equipoUltimaUbicacionLongitud, $idEquipo)
        );
        if (($resultado) > 0) {
            self::LOGUbicaciones($idEquipo, $equipoUltimaUbicacionLatitud, $equipoUltimaUbicacionLongitud);
            return $resultado;
        }
        return NULL;
    }

    static public
            function cambiarEstadoServicioEquipo($idEquipo, $equipoEstadoId, $equipoClienteServicio = NULL, $equipoIdServicio = NULL) {
        $query = " UPDATE `equipos` SET "
                . "`equipoEstadoServicio` = ?, `equipoReciboServicio` = ?  , `equipoClienteServicio` = ?  "
                . "WHERE `equipoId` = ? ; ";
        $resultado = self::modificarRegistros(
                        $query, array($equipoEstadoId, $equipoClienteServicio, $equipoIdServicio, $idEquipo)
        );
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function activar($idEquipo) {
        $query = " UPDATE `equipos` SET equipoEstado = 'ACTIVO' WHERE `equipoId` = ? ; ";
        $resultado = self::modificarRegistros($query, array($idEquipo));
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function desactivar($idEquipo) {
        $query = " UPDATE `equipos` SET equipoEstado = 'BORRADO' WHERE `equipoId` = ? ; ";
        $resultado = self::modificarRegistros($query, array($idEquipo));
        if (($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

}
