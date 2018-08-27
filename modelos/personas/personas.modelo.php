<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Personas extends Modelos {

  private static
   $nTabla = "personas";
  private static
   $sqlBase = <<<EOD
   SELECT `personas`.*, `tiposidentificacion`.* 
   FROM `personas` 
   INNER JOIN `tiposidentificacion` ON ( 
   `personas`.`personaTipoIdentificacion` = `tiposidentificacion`.`tipoIdentificacionId`
    ) 
EOD;
  private static
   $sqlCompleta = "";
  private static
   $sqlJoin = "";

  static public
   function todos($ESTADO = ACTIVO) {
    $query = self::$sqlBase . "WHERE personaEstado = " . $ESTADO . "";
    $resultado = self::consulta($query);
    if (count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function datos($idCliente) {
    $query = self::$sqlBase . " WHERE personas.clienteId = ? ";
    $resultado = self::consulta($query, array($idCliente));
    if (count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datosPorCedula($numCedula) {
    $query = self::$sqlBase . " WHERE personas.personaIdentificacion = ? AND  personas.personaTipoIdentificacion = 1 ";
    $resultado = self::consulta($query, array($numCedula));
    if (count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function datosPorIdentificacion($tipoId, $numId) {
    $query = self::$sqlBase . " WHERE personas.personaIdentificacion = ? AND  personas.personaTipoIdentificacion = ? ";
    $resultado = self::consulta($query, array($numId, $tipoId));
    if (count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public
   function insertar($personaTipoIdentificacion, $personaIdentificacion, $personaRazonSocial, $personaNombreComercial, $personaNombres, $personaApellidos,
                     $personaDireccion, $personaTelefono, $personaCelular, $personaCorreoElectronico, $personaLatitud, $personaLongitud, $personaObservaciones,
                     $personaLogo, $personaFotoReferencia, $personaFirmaEscaneada = null) {
    $query = " INSERT INTO `personas` (  "
     . "`personaTipoIdentificacion`,  `personaIdentificacion`,  `personaRazonSocial`,  `personaNombreComercial`,  `personaNombres`,  `personaApellidos`,  "
     . "`personaDireccion`,  `personaTelefono`,  `personaCelular`,  `personaCorreoElectronico`,  `personaLatitud`,  `personaLongitud`, `personaObservaciones`, "
     . "`personaLogo`,  `personaFotoReferencia`,  `personaFirmaEscaneada`,  `personaUsuarioCrea` "
     . ") VALUES  ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? ) ; ";

    
    $resultado = self::crearUltimoId($query,
                                     array($personaTipoIdentificacion,
      $personaIdentificacion, $personaRazonSocial, $personaNombreComercial,
      $personaNombres, $personaApellidos, $personaDireccion, $personaTelefono,
      $personaCelular, $personaCorreoElectronico, $personaLatitud,
      $personaLongitud, $personaObservaciones, $personaLogo, $personaFotoReferencia, $personaFirmaEscaneada,
      Visitante::idUsuario())
    );
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function actualizar($personaId, $personaTipoIdentificacion, $personaIdentificacion, $personaRazonSocial, $personaNombreComercial, $personaNombres,
                       $personaApellidos, $personaDireccion, $personaTelefono, $personaCelular, $personaCorreoElectronico, $personaLatitud, $personaLongitud,
                       $personaObservaciones, $personaLogo, $personaFotoReferencia, $personaFirmaEscaneada = null) {
    $query = " UPDATE oximed_si.personas " .
     "SET personaTipoIdentificacion = ? " .
     ", personaIdentificacion = ? " .
     ", personaRazonSocial = ? " .
     ", personaNombreComercial = ? " .
     ", personaNombres = ? " .
     ", personaApellidos = ? " .
     ", personaDireccion = ? " .
     ", personaTelefono = ? " .
     ", personaCelular = ? " .
     ", personaCorreoElectronico = ? " .
     ", personaLatitud = ? " .
     ", personaLongitud = ? " .
     ", personaObservaciones = ? " .
     ", personaLogo = ? " .
     ", personaFotoReferencia = ? " .
     ", personaFirmaEscaneada = ? " .
     ", personaFechaModificado = CURRENT_TIMESTAMP " .
     ", personaUsuarioModifica = ? " .
     "WHERE personaId = ? ;";
    $resultado = self::modificarRegistros(
      $query,
      array($personaTipoIdentificacion,
      $personaIdentificacion, $personaRazonSocial, $personaNombreComercial,
      $personaNombres, $personaApellidos, $personaDireccion, $personaTelefono,
      $personaCelular, $personaCorreoElectronico, $personaLatitud,
      $personaLongitud, $personaObservaciones, $personaLogo, $personaFotoReferencia, $personaFirmaEscaneada,
      Visitante::idUsuario(), $personaId)
    );
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function activar($idCliente) {
    $query = " UPDATE `personas` SET clienteEstado = ACTIVO WHERE `clienteId` = ? ; ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public
   function desactivar($idCliente) {
    $query = " UPDATE `personas` SET clienteEstado = INACTIVO WHERE `clienteId` = ? ; ";
    $resultado = self::modificarRegistros($query, array($idCliente));
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}
