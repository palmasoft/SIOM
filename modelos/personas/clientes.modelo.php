<?php
/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Clientes extends Modelos {
  private static
   $nTabla = "clientes";
  private static
   $sqlBase = <<<EOD
   SELECT `clientes`.*, `personas`.*, `tiposidentificacion`.*, `tiposclientes`.* 
   FROM `clientes` 
   LEFT JOIN `personas` ON ( `clientes`.`clientePersona` = `personas`.`personaId` ) 
   LEFT JOIN `tiposclientes` ON ( `clientes`.`clienteTipo` = `tiposclientes`.`tipoClienteId` ) 
   LEFT JOIN `tiposidentificacion` ON ( `personas`.`personaTipoIdentificacion` = `tiposidentificacion`.`tipoIdentificacionId` ) 
EOD;
  private static
   $sqlCompleta = "";
  private static
   $sqlJoin = "";

  static public
   function todos($ESTADO = 'ACTIVO') {
    $query = self::$sqlBase . ' WHERE clientes.clienteEstado = "' . $ESTADO . '"';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($idCliente) {
    $query = self::$sqlBase . " WHERE clientes.clienteId = ? ";
    $resultado = self::consulta($query, array($idCliente));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datosPorCodigo($codigoCliente) {
    $query = self::$sqlBase . " WHERE clientes.clienteCodigo = ? ";
    $resultado = self::consulta($query, array($codigoCliente));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datosPorIdentificacion($TipoIdentificacion, $Identificacion) {
    $query = self::$sqlBase . " WHERE personas.personaTipoIdentificacion = ? AND personas.personaIdentificacion = ?  ";
    $resultado = self::consulta($query, array($TipoIdentificacion, $Identificacion));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  //
  //
  //
  //
  
static $sqlMovimientos = <<<sql
 
 SELECT 
     `personas`.*, `tiposidentificacion`.*, `tiposclientes`.* ,
     clientes.clienteId, 
     COUNT(DISTINCT recibosserviciosequipos.reciboId) AS NUM_RECIBOS , 
     COUNT(ENSERVICIO.reciboEquipoId) AS NUM_ENSERVICIO , 
     COUNT(RECOGIDOS.reciboEquipoId) AS NUM_RECOGIDOS , 
     COUNT(recibodepositos.reciboDepositoId) AS NUM_DEPOSITOS , 
     SUM(recibodepositos.reciboDepositoValor) AS VAL_DEPOSITOS 
     FROM clientes 

LEFT JOIN `personas` ON ( `clientes`.`clientePersona` = `personas`.`personaId` ) 
   LEFT JOIN `tiposclientes` ON ( `clientes`.`clienteTipo` = `tiposclientes`.`tipoClienteId` ) 
   LEFT JOIN `tiposidentificacion` ON ( `personas`.`personaTipoIdentificacion` = `tiposidentificacion`.`tipoIdentificacionId` )      
     
     INNER JOIN recibosserviciosequipos ON ( clientes.clienteId = recibosserviciosequipos.reciboCliente AND recibosserviciosequipos.reciboEstado = 'ACTIVO') 
     LEFT JOIN reciboequipos AS ENSERVICIO 
       ON ( recibosserviciosequipos.reciboId = ENSERVICIO.reciboServicioEquipo AND ENSERVICIO.reciboEquipoMovimiento = 1 ) 
     LEFT JOIN reciboequipos AS RECOGIDOS 
       ON ( recibosserviciosequipos.reciboId = RECOGIDOS.reciboServicioEquipo AND RECOGIDOS.reciboEquipoMovimiento = 2 ) 
     LEFT JOIN recibodepositos ON ( recibosserviciosequipos.reciboServicio = recibodepositos.reciboServicioDeposito ) 
 
sql;

  static public
   function totalesMovimientos($fechasInicial, $fechasFinal) {
    $query = self::$sqlMovimientos
     . "WHERE recibosserviciosequipos.reciboFechaServicio BETWEEN '$fechasInicial 00:00:00' AND '$fechasFinal 23:59:59'"
     . "GROUP BY clientes.clienteId "
     . "ORDER BY NUM_ENSERVICIO DESC "
     . " ";
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }
  
  
  static public
   function totalesMovimientosCliente($idCliente) {
    $query = self::$sqlMovimientos
     . "WHERE clientes.clienteId = ? "
     . "GROUP BY clientes.clienteId "
     . " ";
    $resultado = self::consulta($query, array($idCliente));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

//
  //
  //
  //
  //
  
  static public
   function insertar($clientePesona, $clienteCodigo, $clienteTipo) {
    $query = " INSERT INTO `clientes` ( "
     . "`clientePersona`, `clienteCodigo`, `clienteTipo`, `clienteCreo` "
     . ") VALUES ( ?, ?, ? , ? ) ; ";
    $resultado = self::crearUltimoId($query, array($clientePesona, $clienteCodigo, $clienteTipo, Visitante::idUsuario()));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function actualizar($clienteId, $clientePesona, $clienteCodigo, $clienteTipo) {
    $query = " UPDATE `clientes` SET "
     . "`clientePersona` = ?, `clienteCodigo` = ?, `clienteTipo` = ?, clienteModificado = CURRENT_TIMESTAMP, clienteModifico = ?  "
     . "WHERE `clienteId` = ? ; ";
    $resultado = self::modificarRegistros($query,
      array($clientePesona, $clienteCodigo, $clienteTipo, Visitante::idUsuario(), $clienteId));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  //
  //
  //
  //
  static public
   function activar($idCliente) {
    $query = " UPDATE `clientes` SET clienteEstado = 'ACTIVO' WHERE `clienteId` = ? ; ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function desactivar($idCliente) {
    $query = " UPDATE `clientes` SET clienteEstado = 'INACTIVO' WHERE `clienteId` = ? ; ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}