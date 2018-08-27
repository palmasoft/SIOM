<?php

Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Sistema' . DS . 'Mensajes');

class recogidasControlador extends Controladores {

  function proximasRecogidas() {
    self::$datos['primeros5porRecoger'] = Recogidas::proximas(5);
    Vistas::mostrar('tiposEquipos' . DS . 'listado', self::$datos);
  }
}
