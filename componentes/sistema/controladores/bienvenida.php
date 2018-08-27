<?php

Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Sistema' . DS . 'Usuarios');
Modelos::cargar('Servicios' . DS . 'Recogidas');

class bienvenidaControlador extends Controladores {

    function widgets() {
        if (ORIGEN === 'SMARTPHONE') {
            Vistas::mostrar('version_movil', self::$datos);
        } else {
            self::$datos['primeros5porRecoger'] = Recogidas::proximas(5);
            self::$datos['Equipos'] = Equipos::todos();
            self::$datos['Clientes'] = Clientes::todos();
            self::$datos['Empleados'] = Usuarios::todosActivos();
            Vistas::mostrar('panel_control', self::$datos);
        }
    }

}
