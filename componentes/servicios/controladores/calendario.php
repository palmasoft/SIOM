<?php

Modelos::cargar('Servicios' . DS . 'Recogidas');
Modelos::cargar('Sistema' . DS . 'Mensajes');

class calendarioControlador extends Controladores {

  function recoleccion() {
    self::$datos['equiposPorRecoger'] = Recogidas::proximas();
    Vistas::mostrar('calendario', self::$datos);
  }

}
