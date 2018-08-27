<?php

Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Sistema' . DS . 'Usuarios');
Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Personas' . DS . 'Clientes');

class mapasControlador extends Controladores {

  function mapaGeneral() {
    self::$datos['Equipos'] = Equipos::todos();
    self::$datos['Clientes'] = Clientes::todos();
    self::$datos['Empleados'] = Usuarios::todosActivos();
    Vistas::cargar('mapaGeneral', self::$datos, 'ubicaciones');
  }

}
