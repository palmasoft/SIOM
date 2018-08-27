<?php

Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Sistema' . DS . 'Mensajes');

class tiposEquiposControlador extends Controladores {

  function mostrarTodos() {
	self::$datos['TiposEquipos'] = TiposEquipos::todos();
	Vistas::mostrar('tiposEquipos' . DS . 'listado', self::$datos);
  }

  function nuevo() {
	$this->mostrarFormulario();
  }

  function editar() {
	self::$datos['datosTipoEquipo'] = TiposEquipos::datos(self::$datos['registro_tipoequipo']);
	$this->mostrarFormulario();
  }

  function guardarCambios() {
	if (isset(self::$datos['registro_tipoequipo']) and ! empty(self::$datos['registro_tipoequipo'])) {
	  $cambio = TiposEquipos::actualizar(
		self::$datos['registro_tipoequipo'], self::$datos['codigo_tipoequipo'],
		self::$datos['titulo_tipoequipo'], self::$datos['desc_tipoequipo']);
	  if ($cambio) {
		Mensajes::operacion('EXITO',
		 'Se han actualizado correctamente los datos asociados al <strong>TIPO DE EQUIPO</strong> [' . self::$datos['codigo_tipoequipo'] . '] <strong>' . self::$datos['titulo_tipoequipo'] . '</strong>.');
	  } else {
		Mensajes::operacion('ERROR',
		 'NO Se han actualizado los datos asociados al <strong>TIPO DE EQUIPO</strong> [' . self::$datos['codigo_tipoequipo'] . '] <strong>' . self::$datos['titulo_tipoequipo'] . '</strong>.<br />' . '<strong>Verifique que haya hecho algún cambio en los datos e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
	  }
	} else {
	  self::$datos['registro_tipoequipo'] = TiposEquipos::insertar(
		self::$datos['codigo_tipoequipo'], self::$datos['titulo_tipoequipo'],
		self::$datos['desc_tipoequipo']);
	  if (!is_null(self::$datos['registro_tipoequipo'])) {
		Mensajes::operacion('EXITO',
		 'Se ha creado correctamente un nuevo <strong>TIPO DE EQUIPO</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo_tipoequipo'] . '</strong>] ' . self::$datos['titulo_tipoequipo'] . '.');
	  } else {
		Mensajes::operacion(
		 'ERROR',
		 'NO Se ha creado el nuevo <strong>TIPO DE EQUIPO</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo_tipoequipo'] . '</strong>] ' . self::$datos['titulo_tipoequipo'] . '.<br />' . '<strong>Verifique que el CODIGO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
	  }
	}
	$this->editar();
  }

  function mostrarFormulario() {
	Vistas::mostrar('tiposEquipos' . DS . 'formulario', self::$datos);
  }

  function borrar() {
	if (isset(self::$datos['registro_tipoequipo']) and ! empty(self::$datos['registro_tipoequipo'])) {
	  $objTipoEquipo = TiposEquipos::datos(self::$datos['registro_tipoequipo']);
	  $cambio = TiposEquipos::desactivar(self::$datos['registro_tipoequipo']);
	  if ($cambio) {
		Mensajes::operacion('EXITO',
		 'Se han eliminado correctamente los datos asociados al '
		 . '<strong>TIPO DE EQUIPO</strong> [' . $objTipoEquipo->tipoEquipoCodigo . '] <strong>' . $objTipoEquipo->tipoEquipoTitulo . '</strong>. '
		);
	  } else {
		Mensajes::operacion('ERROR',
		 'NO Se han eliminado correctamente los datos asociados al '
		 . '<strong>TIPO DE EQUIPO</strong> [' . $objTipoEquipo->tipoEquipoCodigo . '] <strong>' . $objTipoEquipo->tipoEquipoTitulo . '</strong>. '
		 . '<strong>Intentelo nuevamente.</strong> <br />'
		 . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
		);
	  }
	}
	$this->mostrarTodos();
  }

}
