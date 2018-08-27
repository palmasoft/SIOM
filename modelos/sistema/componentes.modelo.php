<?php

Modelos::cargar('sistema' . DS . 'Permisos');
Modelos::cargar('sistema' . DS . 'PermisosUsuarios');

/**
 * @author Puro Ingenio Samario
 * @version 1.0
 * @created 25-mar.-2015 11:22:18 a. m.
 */
class Componentes extends Modelos {

    private static
            $id_componente;
    private static
            $codigo_componente;
    private static
            $icono_componente = 'fa fa-dashboard';
    private static
            $nombre_componente;
    private static
            $desc_componente;
    private static
            $nTabla = "componentes";
    private static
            $sqlBase = "SELECT componentes.* FROM componentes ";
    private static
            $sqlDelUsuario = <<<sqlDelUsuario
      SELECT
          componentes.*
      FROM
          componentes
          INNER JOIN funciones 
              ON (componentes.componenteCodigo = funciones.funcionModulo)
          INNER JOIN usuariosfunciones 
              ON (funciones.funcionId = usuariosfunciones.usuarioFuncionAsignada)   
sqlDelUsuario;
    private static
            $sqlJoin = "";

    /**
     * 
     * @param ninguno
     * @name todos los componentes del sistema
     * @abstract ejecutar para traer todos los componenetes guardasdos en la base de datos
     * 
     */
    static public
            function todos() {
        $query = self::$sqlBase;
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            return $resultado;
        }
        return NULL;
    }

    /**
     * 
     * @param ninguno
     * @name todos los componentes del sistema
     * @abstract ejecutar para traer todos los componenetes guardasdos en la base de datos
     * 
     */
    static public
            function DelUsuarioConPermisos($idUsuario) {
        $query = self::$sqlDelUsuario . "  "
                . "WHERE  usuariosfunciones.usuarioFuncion = " . $idUsuario . " ";
        if (ORIGEN === 'SMARTPHONE') {
            $query .= 'AND funciones.funcionMovil = "SI"  ';
        }
        $query .= "GROUP BY componentes.componenteId "; //. " ORDER BY id_componente ASC";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            foreach ($resultado as $indice => $comp) {
                $resultado[$indice]->permisos = Permisos::todosDelUsuarioComponente($comp->componenteCodigo, $idUsuario);
            }
            return $resultado;
        }
        return NULL;
    }

    static public
            function todos_con_permisos() {
        $query = self::$sqlBase; //. " ORDER BY id_componente ASC";
        $resultado = self::consulta($query);
        if (count($resultado) > 0) {
            foreach ($resultado as $indice => $comp) {
                $resultado[$indice]->permisos = Permisos::todos_del_componente($comp->componenteCodigo);
            }
            return $resultado;
        }
        return NULL;
    }

    static public
            function asignados_con_permisos($idUsuario) {
        $resultado = PermisosUsuarios::componentes_asignados($idUsuario);
        if (count($resultado) > 0) {
            foreach ($resultado as $indice => $comp) {
                $resultado[$indice]->permisos = PermisosUsuarios::permisos_asignados_por_componente($idUsuario, $comp->componenteId);
            }
            return $resultado;
        }
        return NULL;
    }

    /**
     * 
     * @param codigo_componente
     */
    public
            function por_codigo_componente(varchar $codigo_componente) {
        
    }

    /**
     * 
     * @param id_componente
     */
    public
            function por_id_componente(integer $id_componente) {
        
    }

    /**
     * 
     * @param id_componente
     */
    public
            function datos(integer $id_componente) {
        
    }

    /**
     * 
     * @param newVal
     */
    public
            function setdesc_componente(text $newVal) {
        
    }

    public
            function getdesc_componente() {
        return desc_componente;
    }

    /**
     * 
     * @param newVal
     */
    public
            function setnombre_componente(varchar $newVal) {
        
    }

    public
            function getnombre_componente() {
        return nombre_componente;
    }

    /**
     * 
     * @param newVal
     */
    public
            function seticono_componente(varchar $newVal) {
        
    }

    public
            function geticono_componente() {
        return icono_componente;
    }

    /**
     * 
     * @param newVal
     */
    public
            function setcodigo_componente(varchar $newVal) {
        
    }

    public
            function getcodigo_componente() {
        return codigo_componente;
    }

    /**
     * 
     * @param newVal
     */
    public
            function setid_componente(integer $newVal) {
        
    }

    public
            function getid_componente() {
        return id_componente;
    }

}
