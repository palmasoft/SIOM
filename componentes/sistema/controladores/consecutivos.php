<?php

Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Sistema' . DS . 'Usuarios');
Modelos::cargar('Servicios' . DS . 'Recogidas');

class consecutivosControlador extends Controladores {

  function mostrarTodos() {
    $recogidas = Recogidas::proximas();
    echo json_encode($recogidas);
  }

}
