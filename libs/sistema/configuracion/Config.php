<?php

/*
  Es una peque�a clase de configuraci�n con un funcionamiento muy sencillo,
  implementa el patron singleton para mantener una �nica instancia y poder acceder
  a sus valores desde cualquier sitio.
 */

class Configuraciones {

  public static
   $vars;
  public static
   $instance;

  function __construct() {
    self::$vars = array();
    self::set('passEncript', 'OXIMED');
  }

  //Con set vamos guardando nuestras variables.
  public static
   function set($name, $value) {
    if(session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
    if(!isset($name)) {
      session_register($name);
    }
    $_SESSION["" . $name . ""] = $value;
    session_write_close();
    //define($name, $value);
  }

  //Con get('nombre_de_la_variable') recuperamos un valor.
  public static
   function get($name) {
    if(isset($_SESSION[$name])) {
      $valor = $_SESSION[$name];
      session_write_close();
      return $valor;
    }
    return "";
  }

  public
   function update($name, $value) {
    $_SESSION[$name] = $value;
    return $_SESSION[$name];
  }

  public static
   function singleton() {
    if(self::$instance == null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

}

class Config extends Configuraciones {

  function __construct() {
    parent::__construct();
  }

}

$ObjConfiguraciones = new Config();
