<?php
/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class ClientesContactos extends Modelos {
  private static
   $nTabla = "clientescontactos";
  private static
   $sqlBase = <<<EOD
   SELECT clientescontactos.*, personas.*, tiposidentificacion.*,  clientes.* 
   ,  datos_cliente.personaTipoIdentificacion AS tipoIdCliente  
   ,  datos_cliente.personaIdentificacion AS tipoIdCliente  
   ,  datos_cliente.personaRazonSocial AS tipoIdCliente  
   ,  datos_cliente.personaTipoIdentificacion AS tipoIdCliente  
   ,  datos_cliente.personaNombres AS tipoIdCliente  
   ,  datos_cliente.personaApellidos AS tipoIdCliente  
   FROM clientescontactos 
   LEFT JOIN clientes ON ( clientescontactos.clienteContactoCliente = clientes.clienteId ) 
   LEFT JOIN personas ON ( clientescontactos.clienteContactoPersona = personas.personaId ) 
   LEFT JOIN tiposidentificacion ON ( tiposidentificacion.tipoIdentificacionId = personas.personaTipoIdentificacion ) 
   LEFT JOIN personas AS datos_cliente ON ( clientes.clientePersona = personas.personaId )   
EOD;
  private static
   $sqlCompleta = "";
  private static
   $sqlJoin = "";

  static public
   function todos() {
    $query = self::$sqlBase . ' ';
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datosPorClientes($idCliente) {
    $query = self::$sqlBase . " WHERE clientes.clienteId = ? ";
    $resultado = self::consulta($query, array($idCliente));
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function recibenDepositosClientes($idCliente) {
    $query = self::$sqlBase . " "
     . "WHERE clientes.clienteId = ? "
     . "AND clientescontactos.clienteContactoRecibeDeposito = 'SI' ";
    $resultado = self::consulta($query, array($idCliente));
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datosPorCodigoCliente($codigoCliente) {
    $query = self::$sqlBase . " WHERE clientes.clienteCodigo = ? ";
    $resultado = self::consulta($query, array($codigoCliente));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function insertar($clienteContactoCliente, $clienteContactoPersona, $clienteContactoEtiquetas,
   $clienteContactoRecibeEquipos, $clienteContactoRecibeDeposito) {
    $query = " INSERT INTO clientescontactos (  "
     . "clienteContactoCliente,  clienteContactoPersona,  clienteContactoEtiquetas,  "
     . "clienteContactoRecibeEquipos,  clienteContactoRecibeDeposito "
     . ")  VALUES ( ?, ?, ?, ?, ? ) ; ";
    $resultado = self::crearUltimoId(
      $query,
      array($clienteContactoCliente, $clienteContactoPersona, $clienteContactoEtiquetas, "" . $clienteContactoRecibeEquipos . "",
      "" . $clienteContactoRecibeDeposito . "")
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function borrarTodosCliente($idCliente) {
    $query = "DELETE FROM clientescontactos WHERE clienteContactoCliente = ? ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if(count($resultado) > 0) {
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
  //
  
  static $sqlMovimientos = <<<sql
 SELECT clientescontactos.*, personas.*, tiposidentificacion.* ,
COUNT(DISTINCT recibosserviciosequipos.reciboId) AS NUM_RECIBOS , 
     COUNT(ENSERVICIO.reciboEquipoId) AS NUM_ENSERVICIO , 
     COUNT(RECOGIDOS.reciboEquipoId) AS NUM_RECOGIDOS , 
     COUNT(recibodepositos.reciboDepositoId) AS NUM_DEPOSITOS , 
     SUM(recibodepositos.reciboDepositoValor) AS VAL_DEPOSITOS  
   FROM clientescontactos 
   LEFT JOIN personas ON ( clientescontactos.clienteContactoPersona = personas.personaId ) 
   LEFT JOIN tiposidentificacion ON ( tiposidentificacion.tipoIdentificacionId = personas.personaTipoIdentificacion ) 
   
     INNER JOIN recibosserviciosequipos 
     ON   ( clientescontactos.clienteContactoCliente = recibosserviciosequipos.reciboCliente AND recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId AND  recibosserviciosequipos.reciboEstado = 'ACTIVO') 
     LEFT JOIN reciboequipos AS ENSERVICIO 
       ON ( recibosserviciosequipos.reciboId = ENSERVICIO.reciboServicioEquipo AND ENSERVICIO.reciboEquipoMovimiento = 1 ) 
     LEFT JOIN reciboequipos AS RECOGIDOS 
       ON ( recibosserviciosequipos.reciboId = RECOGIDOS.reciboServicioEquipo AND RECOGIDOS.reciboEquipoMovimiento = 2 ) 
     LEFT JOIN recibodepositos 
     ON ( recibosserviciosequipos.reciboServicio = recibodepositos.reciboServicioDeposito ) 
 
sql;

  static public
   function totalesMovimientosPorCliente($fechasInicial, $fechasFinal, $idCliente) {
    $query = self::$sqlMovimientos
     . "WHERE "
     . " recibosserviciosequipos.reciboFechaServicio BETWEEN '$fechasInicial 00:00:00' AND '$fechasFinal 23:59:59' "
     . " AND clientescontactos.clienteContactoCliente  =  $idCliente "
     . " GROUP BY clientescontactos.clienteContactoId"
     . " ORDER BY NUM_ENSERVICIO DESC "
     . " ";
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  //
  //
  ////
  //
  //
  //
  //
  //
  //
  
  static public
   function actualizar($clientePesona, $clienteCodigo, $clienteTipo) {
    $query = " UPDATE clientes SET "
     . "clienteCodigo = ?, clienteTitulo = ?, clienteDesc = ? "
     . "WHERE clienteId = ? ; ";
    $resultado = self::modificarRegistros($query, array($clientePesona, $clienteCodigo, $clienteTipo)
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function activar($idCliente) {
    $query = " UPDATE clientes SET clienteEstado = 'ACTIVO' WHERE clienteId = ? ; ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function desactivar($idCliente) {
    $query = " UPDATE clientes SET clienteEstado = 'INACTIVO' WHERE clienteId = ? ; ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}