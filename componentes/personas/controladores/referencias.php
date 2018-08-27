<?php

Modelos::cargar('Personas' . DS . 'TiposClientes');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Personas' . DS . 'ClientesContactos');
Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Sistema' . DS . 'TiposIdentificacion');

class referenciasControlador extends Controladores {

  function nuevoItemLista() {
    if (isset(self::$enviados['fotopersona_referencia']['name']) and ! empty(self::$enviados['fotopersona_referencia']['name'])) {
      $nombreArchivo = self::$datos['cedula_referencia'] . "-" . uniqid() . "." . Archivos::nombre_extension(self::$enviados['fotopersona_referencia']);
      $rutaCarpeta = PATH_ARCHIVOS . "personas" . DS . "TMP" . DS;
      $urlCarpeta = URL_ARCHIVOS . "personas" . WS . "TMP" . WS;
      Archivos::mover_archivo_recibido(
       self::$enviados['fotopersona_referencia'], $rutaCarpeta, $nombreArchivo
      );
      self::$datos['url_imagen_referencia'] = '/archivos/oximeiser/personas/TMP/' . $nombreArchivo;
    } else {
      self::$datos['url_imagen_referencia'] = '/archivos/oximeiser/personas/referencia.jpg';
    }
    Vistas::cargar('referencias' . DS . 'item-lista', self::$datos);
  }

  function todosDelCliente() {
    $ReferenciasCliente = ClientesContactos::datosPorClientes(self::$datos['registro_cliente']);
    if (!is_null($ReferenciasCliente)) {
      foreach ($ReferenciasCliente as $Referencia) {
        self::$datos['Referencia'] = $Referencia;
        Vistas::mostrar('referencias' . DS . 'item', self::$datos);
      }
    } else {
      $Cliente = Clientes::datos(self::$datos['registro_cliente']);
      echo "<h2> <strong>" . $Cliente->personaRazonSocial . "</strong> NO tiene <em>CONTACTOS</em> registrados</h2>";
    }
  }

  function selectReferenciasCliente() {
    self::$datos['Referencias'] = ClientesContactos::datosPorClientes(self::$datos['registro_cliente']);
    if (is_null(self::$datos['Referencias'])) {
      self::$datos['Referencias'] = array();
      $Cliente = Clientes::datos(self::$datos['registro_cliente']);
      echo "<div> <strong>" . $Cliente->personaRazonSocial . "</strong> NO tiene <em>CONTACTOS</em> registrados</div>";
    }
      Vistas::cargar('referencias' . DS . 'select-referencias-cliente', self::$datos);
  }

  //
  //
  //
  //
  //
  //
  

  function nuevo() {
    $this->mostrarFormulario();
  }

  function editar() {
    self::$datos['datosCliente'] = Cliente::datos(self::$datos['registro-cliente']);
    $this->mostrarFormulario();
  }

  function guardarCambios() {
    if (isset(self::$datos['registro-cliente']) and ! empty(self::$datos['registro-cliente'])) {
      $cambio = Cliente::actualizar(
        self::$datos['registro-cliente'], self::$datos['codigo-cliente'], self::$datos['titulo-cliente'], self::$datos['desc-cliente']);
      if ($cambio) {
        Mensajes::operacion('EXITO',
                            'Se han actualizado correctamente los datos asociados al <strong>TIPO DE EQUIPO</strong> [' . self::$datos['codigo-cliente'] . '] <strong>' . self::$datos['titulo-cliente'] . '</strong>.');
      } else {
        Mensajes::operacion('ERROR',
                            'NO Se han actualizado los datos asociados al <strong>TIPO DE EQUIPO</strong> [' . self::$datos['codigo-cliente'] . '] <strong>' . self::$datos['titulo-cliente'] . '</strong>.<br />' . '<strong>Verifique que haya hecho algún cambio en los datos e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
      }
    } else {
      self::$datos['registro-cliente'] = Cliente::insertar(
        self::$datos['codigo-cliente'], self::$datos['titulo-cliente'], self::$datos['desc-cliente']);
      if (!is_null(self::$datos['registro-cliente'])) {
        Mensajes::operacion('EXITO',
                            'Se ha creado correctamente un nuevo <strong>TIPO DE EQUIPO</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo-cliente'] . '</strong>] ' . self::$datos['titulo-cliente'] . '.');
      } else {
        Mensajes::operacion(
         'ERROR',
         'NO Se ha creado el nuevo <strong>TIPO DE EQUIPO</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo-cliente'] . '</strong>] ' . self::$datos['titulo-cliente'] . '.<br />' . '<strong>Verifique que el CODIGO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
      }
    }
    $this->editar();
  }

  function mostrarFormulario() {

    self::$datos['tiposClientes'] = TiposClientes::todos();
    self::$datos['tiposIdentificacion'] = TiposIdentificacion::todos();
    Vistas::mostrar('clientes' . DS . 'formulario', self::$datos);
  }

  function borrar() {
    if (isset(self::$datos['registro-cliente']) and ! empty(self::$datos['registro-cliente'])) {
      $objCliente = Cliente::datos(self::$datos['registro-cliente']);
      $cambio = Cliente::desactivar(self::$datos['registro-cliente']);
      if ($cambio) {
        Mensajes::operacion('EXITO',
                            'Se han eliminado correctamente los datos asociados al '
         . '<strong>TIPO DE EQUIPO</strong> [' . $objCliente->tipoEquipoCodigo . '] <strong>' . $objCliente->tipoEquipoTitulo . '</strong>. '
        );
      } else {
        Mensajes::operacion('ERROR',
                            'NO Se han eliminado correctamente los datos asociados al '
         . '<strong>TIPO DE EQUIPO</strong> [' . $objCliente->tipoEquipoCodigo . '] <strong>' . $objCliente->tipoEquipoTitulo . '</strong>. '
         . '<strong>Intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
        );
      }
    }
    $this->mostrarTodos();
  }

}
