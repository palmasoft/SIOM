<?php

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Permisos extends Modelos {

    /**
     * Puede ser <b>SI </b>para mostrarce en el emnu principal del sistema, o <b>NO
     * </b>para evitar mostrarce
     */
    private static
            $menu_permiso = 'SI';
    private static
            $UQ_Componentes_codigo_componente;
    private static
            $nTabla = " funciones";
    private static
            $sqlBase = <<<sqlBase
SELECT 
  pertenece_a.funcionId AS padreId
  , pertenece_a.funcionCodigo AS padreCodigo
  , pertenece_a.funcionNombre AS padreNombre
  , funciones.*
  , componentes.* 
FROM
  funciones 
  INNER JOIN componentes 
    ON (
      funciones.funcionModulo = componentes.componenteCodigo
    ) 
  LEFT JOIN funciones AS pertenece_a 
    ON (
      funciones.funcionPadre = pertenece_a.funcionId
    )  
sqlBase;
    private static
            $sqlCompleta = "";
    private static
            $sqlDelUsuario = <<<sqlDelUsuario
SELECT 
  pertenece_a.funcionId AS padreId
  , pertenece_a.funcionCodigo AS padreCodigo
  , pertenece_a.funcionNombre AS padreNombre
  , funciones.*
FROM
  funciones 
  LEFT JOIN funciones AS pertenece_a 
    ON (
      funciones.funcionPadre = pertenece_a.funcionId
    ) 
  INNER JOIN usuariosfunciones 
    ON (
      funciones.funcionId = usuariosfunciones.usuarioFuncionAsignada 
    )
sqlDelUsuario;
    private static
            $sqlJoin = "";

    /**
     * 
     * @param ninguno
     * @name todos los permisos / operaciones del sistema
     * @abstract ejecutar para traer todos los componenetes guardasdos en la base de datos
     * 
     */
    static public
            function todos() {
        $query = self::$sqlBase . " ORDER BY  " . self::$nTabla . ".funcionOrden  ";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function todos_menu() {
        $query = self::$sqlBase . " WHERE " . self::$nTabla . ".funcionMenu = 'SI'   ORDER BY  " . self::$nTabla . ".funcionModulo ,  " . self::$nTabla . ".funcionOrden  ";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    /**
     * 
     * @param $cod_componente Codigo del Componente
     * @name todos los permisos
     * @abstract obtiene todos los permisos asociados a un componente
     * 
     */
    static public
            function todos_del_componente($cod_componente) {
        self::$campos = array();
        $query = self::$sqlBase . " "
                . "WHERE " . self::$nTabla . ".funcionModulo = ? AND " . self::$nTabla . ".funcionMenu = 'SI'   ";
        if (ORIGEN === 'SMARTPHONE') {
            $query .= 'AND funciones.funcionMovil = "SI"  ';
        }
        $query .= "ORDER BY  " . self::$nTabla . ".funcionOrden  ";
        array_push(self::$campos, $cod_componente);
        $resultado = self::consulta($query, self::$campos);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    static public
            function todosDelUsuarioComponente($cod_componente, $idUsuario) {
        self::$campos = array();
        $query = self::$sqlDelUsuario . " WHERE "
                . "" . self::$nTabla . ".funcionModulo = ? AND "
                . "" . self::$nTabla . ".funcionMenu = 'SI' AND "
                . " usuariosfunciones.usuarioFuncion = ? "
                . "ORDER BY  " . self::$nTabla . ".funcionOrden  ";
        array_push(self::$campos, $cod_componente);
        array_push(self::$campos, $idUsuario);
        $resultado = self::consulta($query, self::$campos);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

}
