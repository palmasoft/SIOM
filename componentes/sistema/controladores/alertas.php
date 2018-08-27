<?php

Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Sistema' . DS . 'Usuarios');
Modelos::cargar('Servicios' . DS . 'Recogidas');

class alertasControlador extends Controladores {

  function recogidaEquipos() {
    $recogidas = Recogidas::proximas();
    echo json_encode($recogidas);
  }

}
