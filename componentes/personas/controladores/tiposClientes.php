<?php

Modelos::cargar('Personas' . DS . 'TiposClientes');
Modelos::cargar('Sistema' . DS . 'Mensajes');

class tiposClientesControlador extends Controladores {

  function mostrarTodos() {
	self::$datos['TiposClientes'] = TiposClientes::todos();
	Vistas::mostrar('tiposClientes' . DS . 'listado', self::$datos);
  }

  function nuevo() {
	$this->mostrarFormulario();
  }

  function editar() {
	self::$datos['datosTipoCliente'] = TiposClientes::datos(self::$datos['registro_tipocliente']);
	$this->mostrarFormulario();
  }

  function guardarCambios() {
	if (isset(self::$datos['registro_tipocliente']) and ! empty(self::$datos['registro_tipocliente'])) {
	  $cambio = TiposClientes::actualizar(
		self::$datos['registro_tipocliente'], self::$datos['codigo_tipocliente'],
		self::$datos['titulo_tipocliente'], self::$datos['desc_tipocliente']);
	  if ($cambio) {
		Mensajes::operacion('EXITO',
		 'Se han actualizado correctamente los datos asociados al <strong>TIPO DE CLIENTE</strong> [' . self::$datos['codigo_tipocliente'] . '] <strong>' . self::$datos['titulo_tipocliente'] . '</strong>.');
	  } else {
		Mensajes::operacion('ERROR',
		 'NO Se han actualizado los datos asociados al <strong>TIPO DE CLIENTE</strong> [' . self::$datos['codigo_tipocliente'] . '] <strong>' . self::$datos['titulo_tipocliente'] . '</strong>.<br />' . '<strong>Verifique que haya hecho algún cambio en los datos e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
	  }
	} else {
	  self::$datos['registro_tipocliente'] = TiposClientes::insertar(
		self::$datos['codigo_tipocliente'], self::$datos['titulo_tipocliente'],
		self::$datos['desc_tipocliente']);
	  if (!is_null(self::$datos['registro_tipocliente'])) {
		Mensajes::operacion('EXITO',
		 'Se ha creado correctamente un nuevo <strong>TIPO DE CLIENTE</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo_tipocliente'] . '</strong>] ' . self::$datos['titulo_tipocliente'] . '.');
	  } else {
		Mensajes::operacion(
		 'ERROR',
		 'NO Se ha creado el nuevo <strong>TIPO DE CLIENTE</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo_tipocliente'] . '</strong>] ' . self::$datos['titulo_tipocliente'] . '.<br />' . '<strong>Verifique que el CODIGO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
	  }
	}
	$this->editar();
  }

  function mostrarFormulario() {
	Vistas::mostrar('tiposClientes' . DS . 'formulario', self::$datos);
  }

  function borrar() {
	if (isset(self::$datos['registro_tipocliente']) and ! empty(self::$datos['registro_tipocliente'])) {
	  $objTipoCliente = TiposClientes::datos(self::$datos['registro_tipocliente']);
	  $cambio = TiposClientes::desactivar(self::$datos['registro_tipocliente']);
	  if ($cambio) {
		Mensajes::operacion('EXITO',
		 'Se han eliminado correctamente los datos asociados al '
		 . '<strong>TIPO DE CLIENTE</strong> [' . $objTipoCliente->tipoClienteCodigo . '] <strong>' . $objTipoCliente->tipoClienteTitulo . '</strong>. '
		);
	  } else {
		Mensajes::operacion('ERROR',
		 'NO Se han eliminado correctamente los datos asociados al '
		 . '<strong>TIPO DE CLIENTE</strong> [' . $objTipoCliente->tipoClienteCodigo . '] <strong>' . $objTipoCliente->tipoClienteTitulo . '</strong>. '
		 . '<strong>Intentelo nuevamente.</strong> <br />'
		 . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
		);
	  }
	}
	$this->mostrarTodos();
  }

}
