<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class TiposEquipos extends Modelos {

  private static $nTabla = "tiposequipos";
  private static $sqlBase = "SELECT tiposequipos.* FROM tiposequipos ";
  private static $sqlCompleta = "";
  private static $sqlJoin = "";

  static public function todos($ESTADO = 'ACTIVO') {
    $query = self::$sqlBase . ' WHERE tipoEquipoEstado = "' . $ESTADO . '"';
    $resultado = self::consulta($query);
    if (count($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public function datos($idTipoEquipo) {
    $query = self::$sqlBase . " WHERE tiposequipos.tipoEquipoId = ? ";
    $resultado = self::consulta($query, array($idTipoEquipo));
    if (count($resultado) > 0) {
      return $resultado[0];
    }
    return NULL;
  }

  static public function insertar($tipoEquipoCodigo, $tipoEquipoTitulo,
          $tipoEquipoDesc) {
    $query = " INSERT INTO `tiposequipos` ( "
            . "`tipoEquipoCodigo`, `tipoEquipoTitulo`, `tipoEquipoDesc` "
            . ") VALUES ( ?, ?, ? ) ; ";
    $resultado = self::crearUltimoId($query,
                    array($tipoEquipoCodigo, $tipoEquipoTitulo,
                $tipoEquipoDesc)
    );
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public function actualizar($idTipoEquipo, $tipoEquipoCodigo,
          $tipoEquipoTitulo, $tipoEquipoDesc) {
    $query = " UPDATE `tiposequipos` SET "
            . "`tipoEquipoCodigo` = ?, `tipoEquipoTitulo` = ?, `tipoEquipoDesc` = ? "
            . "WHERE `tipoEquipoId` = ? ; ";
    $resultado = self::modificarRegistros($query,
                    array($tipoEquipoCodigo, $tipoEquipoTitulo,
                $tipoEquipoDesc, $idTipoEquipo)
    );
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public function activar($idTipoEquipo) {
    $query = " UPDATE `tiposequipos` SET tipoEquipoEstado = 'ACTIVO' WHERE `tipoEquipoId` = ? ; ";
    $resultado = self::modificarRegistros($query, array($idTipoEquipo));
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

  static public function desactivar($idTipoEquipo) {
    $query = " UPDATE `tiposequipos` SET tipoEquipoEstado = 'INACTIVO' WHERE `tipoEquipoId` = ? ; ";
    $resultado = self::modificarRegistros($query, array($idTipoEquipo));
    if (($resultado) > 0) {
      return $resultado;
    }
    return NULL;
  }

}
