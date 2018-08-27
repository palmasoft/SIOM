<?php

/**
 * Clase base para la carga de todas las clases de lalibreria class
 *
 * @package Bases
 * @author  Juan Pablo Llinas Ramirez
 */
abstract class Base {

  protected static $dbCliente;
  protected static $dbSistema;
  protected static $config;
  protected static $params;
  protected static $datosScript = array();
  protected static $datos = array();
  protected static $enviados = array();
  protected $plantilla;
  protected $vista;
  protected $errores;
  protected $modelo;
  protected $controlador;
  protected $fechas;
  protected $correos;
  protected $formularios;
  protected $spdo;
  protected $spdo_base;

  function paso_navegacion($nombre, $icono = "", $componente = "",
   $controlador = "", $accion = "") {
	$PasoNavegacion = new stdClass();
	$PasoNavegacion->icono = $icono;
	$PasoNavegacion->nombre = $nombre;
	$PasoNavegacion->componente = $componente;
	$PasoNavegacion->controlador = $controlador;
	$PasoNavegacion->accion = $accion;

	return $PasoNavegacion;
  }

  function __construct() {
	self::$config = new Configuraciones();
	self::$params = new Parametros();
	self::$dbSistema = new BaseDatosSistema();
//        self::$dbCliente = new BaseDatosCliente();

	self::$datos['ruta_navegacion'] = new stdClass();
	self::$datos['ruta_navegacion']->titulo_vista = "";
	self::$datos['ruta_navegacion']->descripcion_vista = "";
	self::$datos['ruta_navegacion']->pasos = array();
	if (count($_POST)) {
	  foreach ($_POST as $key => $value) {
		self::$datos[str_replace("-", "_", $key)] = $value;
	  }
	}

	if (isset($GLOBALS['argv'])) {
	  Consola::$activada = true;
	  foreach ($GLOBALS['argv'] as $key => $value) {
		self::$datosScript[str_replace("-", "_", $key)] = $value;
		switch ($key) {
		  case "1": $key = "componente";
			break;
		  case "2": $key = "controlador";
			break;
		  case "3": $key = "accion";
			break;
		}
		self::$datos[str_replace("-", "_", $key)] = $value;
	  }
	}

	self::$enviados = array();
	if (count($_FILES)) {
	  foreach ($_FILES as $key => $value) {
		self::$enviados[str_replace("-", "_", $key)] = $value;
	  }
	}
  }

  function tiempo_ejecucion($nombre_tarea) {
	$segundos = Fechas::segundosEntreFechas($_SESSION['FIN_TAREA'],
	  $_SESSION['INICIA_TAREA']);
	$minutos = floor($segundos / 60);
	$tiempoEjecucion = sprintf("%d minutos, %d segundos\n", $minutos, $segundos);
	echo "<div class='tiempo_ejecucion' >" .
	"tiempos de operación " . $nombre_tarea . ". <br /> Inicia: " . $_SESSION['INICIA_TAREA'] . " -> Termina: " . $_SESSION['FIN_TAREA'] . "<br />" .
	" duración: " . $tiempoEjecucion .
	"</div>";
  }

}

//$ObjConexCliente = new BaseDatosCliente();
