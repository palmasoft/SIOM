<?php

/*
  SPDO es una clase que extiende de PDO, su �nica ventaja es que nos permite
  aplicar el patron Singleton para mantener una �nica instancia de PDO.
 */

class BaseDatosCliente extends PDO {

    public static $instance = null;

    public function __construct() {
        try {
            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8 ',
                    //PDO::ATTR_PERSISTENT => true
            );

            parent::__construct(
                    '' . $_SESSION['dbtype_cliente'] .
                    ':dbname=' . $_SESSION['dbname_cliente'] .
                    ';host=' . $_SESSION['dbhost_cliente'] . ''
                    , $_SESSION['dbuser_cliente']
                    , $_SESSION['dbpass_cliente']
                    , $options
            );


            //echo '  HA OCURRIDO UN ERROR AL INTENTAR CONECTARCE CON '
//              . 'EL MOTOR DE DATOS del cliente/usuario EN ' . $_SESSION['dbtype_cliente'] . 
//              ':dbname=' . $_SESSION['dbname_cliente'] . ';host=' . $_SESSION['dbhost_cliente'] . '   -   '.
//               $_SESSION['dbuser_cliente']. " - " .$_SESSION['dbpass_cliente'];
        } catch (PDOException $e) {

            echo '<script>alert( "   HA OCURRIDO UN ERROR AL INTENTAR CONECTARCE CON '
            . 'EL MOTOR DE DATOS del cliente/usuario EN ' . $_SESSION['dbtype_cliente'] . ':dbname=' . $_SESSION['dbname_cliente'] . ';host=' . $_SESSION['dbhost_cliente'] . ' \n\r' .
            $e->getMessage() . '");</script>';
        }
    }

    public function qryCliente($query, $valores = NULL) {
        $consulta = $this->prepare($query);
        if (!is_null($valores)) {
            foreach ($valores as $pos => $valor) {
                $consulta->bindParam(($pos + 1), $valor);
            }
        }
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS);
    }

    public function updCliente($query, $valores = NULL) {
        $consulta = $this->prepare($query);
        if (!is_null($valores)) {
            foreach ($valores as $pos => $valor) {
                $consulta->bindParam(($pos + 1), $valor);
            }
        }
        $consulta->execute();
        return $consulta->rowCount();
    }

    public static function recargar() {
        self::$instance = new self();
        //print_r( self::$instance );
        return self::$instance;
    }

    public static function singleton() {
        if (self::$instance == null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

}

//$ObjConexCliente = new BaseDatosCliente();
