<?php

Modelos::cargar('Sistema' . DS . 'CargosEmpleados');
Modelos::cargar('Sistema' . DS . 'Mensajes');

class cargosEmpleadosControlador extends Controladores {

  function mostrarTodos() {
    self::$datos['CargosEmpleados'] = CargosEmpleados::todos();
    Vistas::mostrar('cargosEmpleados' . DS . 'listado', self::$datos);
  }

  function nuevo() {
    $this->mostrarFormulario();
  }

  function editar() {
    self::$datos['datosCargoEmpleado'] = CargosEmpleados::datos(self::$datos['registro_cargoempleado']);
    $this->mostrarFormulario();
  }

  function guardarCambios() {
    if(isset(self::$datos['registro_cargoempleado']) and ! empty(self::$datos['registro_cargoempleado'])) {
      $cambio = CargosEmpleados::actualizar(
        self::$datos['registro_cargoempleado'], self::$datos['codigo_cargoempleado'],
        self::$datos['titulo_cargoempleado'], self::$datos['desc_cargoempleado']);
      if($cambio) {
        Mensajes::operacion(
         'EXITO',
         'Se han actualizado correctamente los datos asociados al <strong>CARGO DE EMPLEADO</strong> [' . self::$datos['codigo_cargoempleado'] . '] '
         . '<strong>' . self::$datos['titulo_cargoempleado'] . '</strong>.');
      } else {
        Mensajes::operacion(
         'ERROR',
         'NO Se han actualizado los datos asociados al <strong>CARGO DE EMPLEADO</strong> [' . self::$datos['codigo_cargoempleado'] . '] '
         . '<strong>' . self::$datos['titulo_cargoempleado'] . '</strong>.<br />'
         . '<strong>Verifique que haya hecho algún cambio en los datos e intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
      }
    } else {
      self::$datos['registro_cargoempleado'] = CargosEmpleados::insertar(
        self::$datos['codigo_cargoempleado'], self::$datos['titulo_cargoempleado'], self::$datos['desc_cargoempleado']);
      if(!is_null(self::$datos['registro_cargoempleado'])) {
        Mensajes::operacion(
         'EXITO',
         'Se ha creado correctamente un nuevo <strong>CARGO DE EMPLEADO</strong>, '
         . 'identificado por [<strong>' . self::$datos['codigo_cargoempleado'] . '</strong>] ' . self::$datos['titulo_cargoempleado'] . '.');
      } else {
        Mensajes::operacion(
         'ERROR',
         'NO Se ha creado el nuevo <strong>CARGO DE EMPLEADO</strong>, '
         . 'identificado por [<strong>' . self::$datos['codigo_cargoempleado'] . '</strong>] ' . self::$datos['titulo_cargoempleado'] . '.<br />'
         . '<strong>Verifique que el CODIGO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
      }
    }
    $this->editar();
  }

  function mostrarFormulario() {
    Vistas::mostrar('cargosEmpleados' . DS . 'formulario', self::$datos);
  }

  function borrar() {
    if(isset(self::$datos['registro_cargoempleado']) and ! empty(self::$datos['registro_cargoempleado'])) {
      $objCargoEmpleado = CargosEmpleados::datos(self::$datos['registro_cargoempleado']);
      $cambio = CargosEmpleados::desactivar(self::$datos['registro_cargoempleado']);
      if($cambio) {
        Mensajes::operacion(
         'EXITO',
         'Se han eliminado correctamente los datos asociados al '
         . '<strong>CARGO DE EMPLEADO</strong> [' . $objCargoEmpleado->cargoEmpleadoCodigo . '] <strong>' . $objCargoEmpleado->cargoEmpleadoTitulo . '</strong>. '
        );
      } else {
        Mensajes::operacion(
         'ERROR',
         'NO Se han eliminado correctamente los datos asociados al '
         . '<strong>CARGO DE EMPLEADO</strong> [' . $objCargoEmpleado->cargoEmpleadoCodigo . '] <strong>' . $objCargoEmpleado->cargoEmpleadoTitulo . '</strong>. '
         . '<strong>Intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
        );
      }
    }
    $this->mostrarTodos();
  }

}
