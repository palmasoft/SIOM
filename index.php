<?php

setlocale(LC_ALL, "es_ES@euro", "es_ES", "esp");
date_default_timezone_set('America/Bogota');

require_once 'set_config.php';
PuroIngenioSamario::cargar_libreria();
MainController::FrontUI();

//Visitante::cerrar_sesion();