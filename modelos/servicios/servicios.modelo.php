<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Servicios extends Modelos {

  private static
   $nTabla = "servicios";
  private static
   $sqlBase = "SELECT servicios.* FROM servicios ";
  private static
   $sqlCompleta = <<<EOD
   SELECT 
  servicios.*
  , recibosserviciosequipos.*
  , clientes.*
  , cliente.*
  , tiposidentificacion.*
  , clientescontactos.* 
  , referencia.personaTipoIdentificacion AS tipoIdReferencia
  , referencia.personaIdentificacion AS idReferencia
  , referencia.personaRazonSocial AS razonSocialReferencia
  , referencia.personaNombreComercial AS nombreComercialReferencia
  , referencia.personaNombres AS nombresReferencia
  , referencia.personaApellidos AS apellidosReferencia
  , referencia.personaDireccion AS direccionReferencia
  , referencia.personaTelefono AS telefonoReferencia
  , referencia.personaCelular AS celularReferencia
  , referencia.personaCorreoElectronico AS correoReferencia
  , referencia.personaLatitud AS latitudReferencia
  , referencia.personaLongitud AS longitudReferencia
  , referencia.personaObservaciones AS obsReferencia
  , referencia.personaLogo AS logoReferencia
  , referencia.personaFotoReferencia AS fotoReferencia
  , usuarios.*
  , encargado.personaTipoIdentificacion AS tipoIdEncargado
  , encargado.personaIdentificacion AS idEncargado
  , encargado.personaNombres AS nombresEncargado
  , encargado.personaApellidos AS apellidosEncargado
  , encargado.personaFirmaEscaneada AS firmaEncargado
  , documentos.*
  , tiposdocumentos.*
  , recibodepositos.*
  , recibodepositos.reciboDepositoValor AS totalDeposito
  ,  (SELECT 
    COUNT(reciboequipos.reciboEquipoId) 
  FROM
    reciboequipos 
  WHERE recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo) AS equiposRecibo
  
FROM
  servicios 
  LEFT JOIN recibosserviciosequipos 
    ON (
      servicios.servicioId = recibosserviciosequipos.reciboServicio
    ) 
  LEFT JOIN clientes 
    ON (
      recibosserviciosequipos.reciboCliente = clientes.clienteId
    ) 
  LEFT JOIN clientescontactos 
    ON (
      recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId
    ) 
  LEFT JOIN documentos 
    ON (
      recibosserviciosequipos.reciboDocumento = documentos.documentoId
    ) 
  LEFT JOIN recibodepositos
    ON (
      recibosserviciosequipos.reciboId = recibodepositos.reciboServicioDeposito
    ) 
  LEFT JOIN usuarios 
    ON (
      recibosserviciosequipos.reciboUsuarioCrea = usuarios.usuarioId
    ) 
  LEFT JOIN personas AS cliente 
    ON (
      clientes.clientePersona = cliente.personaId
    ) 
  LEFT JOIN tiposidentificacion 
    ON (
      cliente.personaTipoIdentificacion = tiposidentificacion.tipoIdentificacionId
    ) 
  LEFT JOIN personas AS referencia 
    ON (
      clientescontactos.clienteContactoPersona = referencia.personaId
    ) 
  LEFT JOIN tiposdocumentos 
    ON (
      documentos.documentoTipo = tiposdocumentos.tipoDocId
    ) 
  LEFT JOIN personas AS encargado 
    ON (
      usuarios.usuarioPersona = encargado.personaId
    )
EOD;
  private static
   $sqlListado = <<<EOD
   SELECT
    servicios.*
    , recibosserviciosequipos.*
    , clientes.*
    , cliente.*
    , clientescontactos.clienteContactoEtiquetas
    , referencia.personaTipoIdentificacion  AS tipoIdReferencia
    , referencia.personaIdentificacion AS idReferencia
    , referencia.personaNombres AS nombresReferencia
    , referencia.personaApellidos AS apellidosReferencia
    , usuarios.usuarioCargo
    , usuarios.usuarioTipo
    , usuarios.usuarioNombre
    , encargado.personaTipoIdentificacion AS tipoIdEncargado
    , encargado.personaIdentificacion AS idEncargado
    , encargado.personaNombres AS nombresEncargado
    , encargado.personaApellidos AS apellidoEncargado
    , documentos.documentoCodigo
    , documentos.documentoUrl
    , tiposdocumentos.tipoDocCodigo
    , tiposdocumentos.tipoDocTitulo
   , 
  (SELECT 
    COUNT(reciboequipos.reciboEquipoId) 
  FROM
    reciboequipos 
  WHERE recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo) AS equiposServicio
   , 
  (SELECT 
    COUNT(reciboequipos.reciboEquipoId) 
  FROM
    reciboequipos 
  WHERE recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo 
    AND reciboequipos.reciboEquipoMovimiento <> 1) AS equiposRecibos
   , 
  (SELECT 
    COUNT(reciboequipos.reciboEquipoId) 
  FROM
    reciboequipos 
  WHERE recibosserviciosequipos.reciboId = reciboequipos.reciboServicioEquipo 
    AND reciboequipos.reciboEquipoMovimiento = 1) AS equiposEntregados
  , 
  (SELECT 
    SUM(
      recibodepositos.reciboDepositoValor
    ) 
  FROM
    recibodepositos 
  WHERE recibosserviciosequipos.reciboId = recibodepositos.reciboServicioDeposito) AS totalDeposito
FROM servicios
    LEFT JOIN recibosserviciosequipos 
        ON (servicios.servicioId = recibosserviciosequipos.reciboServicio AND recibosserviciosequipos.reciboEstado = 'ACTIVO' )
    LEFT JOIN clientes 
        ON (recibosserviciosequipos.reciboCliente = clientes.clienteId)
    LEFT JOIN clientescontactos 
        ON (recibosserviciosequipos.reciboReferencia = clientescontactos.clienteContactoId)
    LEFT JOIN documentos 
        ON (recibosserviciosequipos.reciboDocumento = documentos.documentoId)
    LEFT JOIN usuarios 
        ON (recibosserviciosequipos.reciboUsuarioCrea = usuarios.usuarioId)
    LEFT JOIN personas AS cliente
        ON (clientes.clientePersona = cliente.personaId)
    LEFT JOIN personas AS referencia
        ON (clientescontactos.clienteContactoPersona = referencia.personaId) 
    LEFT JOIN tiposdocumentos 
        ON (documentos.documentoTipo = tiposdocumentos.tipoDocId)
    LEFT JOIN personas AS encargado
        ON (usuarios.usuarioPersona = encargado.personaId)
EOD;
  private static
   $sqlJoin = "";

  static public
   function todos($ESTADO = 'ACTIVO') {
    $query = self::$sqlBase . "  WHERE servicios.servicioEstado = '" . $ESTADO . "'  ";
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function listado($ESTADO = 'ACTIVO') {
    $query = self::$sqlListado . "  WHERE servicios.servicioEstado = '" . $ESTADO . "'  ORDER BY CAST(     recibosserviciosequipos.reciboNumero AS UNSIGNED  ) DESC  ";
    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($servicioId) {
    $query = self::$sqlBase . " WHERE " . self::$nTabla . ".servicioId = ? ";
    $resultado = self::consulta($query, array($servicioId));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datos_completos($servicioId) {
    $query = self::$sqlCompleta . " "
     . "WHERE recibosserviciosequipos.reciboId = ( SELECT MAX( recibosserviciosequipos.reciboId ) FROM recibosserviciosequipos WHERE recibosserviciosequipos.reciboServicio = ? )  "
     . "AND " . self::$nTabla . ".servicioId = ? ";
    
    $resultado = self::consulta($query, array($servicioId, $servicioId));
    if(count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function insertar($servicioCodigo) {      
    $query = " INSERT INTO servicios ( "
     . " servicioCodigo , servicioCreo "
     . ") VALUES ( ?, ? ) ; ";
    $resultado = self::crearUltimoId(
      $query, array($servicioCodigo, Visitante::idUsuario())
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function actualizar($idServicio) {
    $query = " UPDATE `servicios` SET servicioModificado = CURRENT_TIMESTAMP, servicioModifico = ? WHERE `servicioId` = ? ; ";
    $resultado = self::modificarRegistros(
      $query, array(Visitante::idUsuario(), $idServicio)
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function reactivar($idServicio) {
    $query = " UPDATE `servicios` SET servicioEstado = 'ACTIVO' WHERE `servicioId` = ? ; ";
    $resultado = self::modificarRegistros(
      $query, array(Visitante::idUsuario(), $idServicio)
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function desactivar($idServicio) {
    $query = " UPDATE `servicios` SET servicioEstado = 'BORRADO', servicioBorrado = CURRENT_TIMESTAMP, servicioBorro = ?  WHERE `servicioId` = ? ; ";
    $resultado = self::modificarRegistros(
      $query, array(Visitante::idUsuario(), $idServicio)
    );
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function anular($idServicio) {
    $query = " UPDATE `servicios` SET servicioEstado = 'ANULADO', servicioAnulado = CURRENT_TIMESTAMP, servicioAnulo = ? WHERE `servicioId` = ? ; ";
    $resultado = self::modificarRegistros($query, array(Visitante::idUsuario(), $idServicio));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function devolver($idServicio) {
    $query = " UPDATE `servicios` SET servicioEstado = 'DEVUELTO', servicioDevuelto = CURRENT_TIMESTAMP, servicioDevolvio = ? WHERE `servicioId` = ? ; ";
    $resultado = self::modificarRegistros($query, array(Visitante::idUsuario(), $idServicio));
    if(($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  
  
  
  
  
  static public
   function buscar($ESTADO = NULL) {
    $query = self::$sqlCompleta;

    if(!is_null($ESTADO)) {
      $query .= ' servicioEstado = "' . $ESTADO . '"';
    }

    $resultado = self::consulta($query);
    if(count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}
