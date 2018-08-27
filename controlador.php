<?php

setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
date_default_timezone_set('America/Bogota');
require_once 'set_config.php';
PuroIngenioSamario::cargar_libreria();
//print_r($_POST);
MainController::ejecutarAccion();

//
//Visitante::cerrar_sesion();
