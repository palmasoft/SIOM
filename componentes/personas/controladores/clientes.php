<?php

Modelos::cargar('Personas' . DS . 'TiposClientes');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Personas' . DS . 'ClientesContactos');
Modelos::cargar('Personas' . DS . 'Personas');
Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Sistema' . DS . 'TiposIdentificacion');

class clientesControlador extends Controladores {

  function validarExistenciaCliente() {
    if(isset(self::$datos['tipo_identificacion']) and isset(self::$datos['num_identificacion'])) {
      self::$datos['num_identificacion'] = str_replace("_", "", self::$datos['num_identificacion']);
      $Cliente = Clientes::datosPorIdentificacion(self::$datos['tipo_identificacion'],
                                                  self::$datos['num_identificacion']);
      if(is_null($Cliente)) {
        $Persona = Personas::datosPorIdentificacion(self::$datos['tipo_identificacion'],
                                                    self::$datos['num_identificacion']);
        if(is_null($Persona)) {
          $objTipoId = TiposIdentificacion::datos(self::$datos['tipo_identificacion']);
          echo json_encode(
           array(
            "respuesta" => "CONTINUAR",
            "mensaje" => "" . AlertasHTML5::informacion(
             "La identificación para este cliente [<strong>" . $objTipoId->tipoIdentificacionCodigo . " " . self::$datos['num_identificacion'] . "</strong>] NO tiene coincidencias en la base de datos. <strong>Puedes usarlo para CREAR un nuevo cliente.<strong>"),
            "Cliente" => $Cliente,
            "Persona" => $Persona)
          );
        } else {
          echo json_encode(
           array(
            "respuesta" => "BLOQUEAR",
            "mensaje" => "" . AlertasHTML5::advertencia(
             "La identificación [<strong>" . $Persona->tipoIdentificacionCodigo . " " . $Persona->personaIdentificacion . "</strong>] "
             . "le pertenece a <strong>" . (
             $Persona->personaTipoIdentificacion == 1 ?
              ($Persona->personaNombres . " " . $Persona->personaApellidos . "</strong> ") :
              ($Persona->personaRazonSocial . "</strong> " . $Persona->personaNombreComercial) ) . " "
             . "que <strong>NO ES CLIENTE</strong>.<br />"
             . "Es decir, que puedes usarlo para <strong>CREAR</strong> un NUEVO Cliente, pero no podras modificar sus datos hasta que termines y guardes el <strong>CODIGO</strong> y <strong>TIPO</strong> de cliente.."
            ),
            "Cliente" => $Cliente,
            "Persona" => $Persona)
          );
        }
      } else {
        echo json_encode(
         array(
          "respuesta" => "ERROR",
          "mensaje" => "" . AlertasHTML5::error(
           "La identificación [<strong>" . $Cliente->tipoIdentificacionCodigo . " " . $Cliente->personaIdentificacion . "</strong>] le pertenece al cliente <strong>" . $Cliente->personaRazonSocial . "</strong> " . $Cliente->personaNombreComercial . " con codigo <strong>" . $Cliente->clienteCodigo . "</strong> .<br />"
           . "<em>Si consideras que esto es un error, comunicate con el adminsitrador del sistema para validar la información.</em><br />"
           . "<strong>Si intentas utilizarlo para crear un nuevo cliente, el sistema no te dejará guardar los datos.</strong>"
          ),
          "Cliente" => $Cliente)
        );
      }
    }
  }

  function validarExistenciaCodigo() {
    if(isset(self::$datos['codigo_cliente'])) {
      self::$datos['codigo_cliente'] = str_replace("_", "", self::$datos['codigo_cliente']);
      $Cliente = Clientes::datosPorCodigo(self::$datos['codigo_cliente']);
      if(is_null($Cliente)) {
        echo json_encode(
         array(
          "respuesta" => "CONTINUAR",
          "mensaje" => "" . AlertasHTML5::informacion(
           "El código de cliente [<strong>" . self::$datos['codigo_cliente'] . "</strong>] NO se encuentra en la base de datos. <strong>Puedes usarlo para <strong>CREAR</strong> un NUEVO cliente.<strong>"),
          "Cliente" => $Cliente)
        );
      } else {
        echo json_encode(
         array(
          "respuesta" => "ERROR",
          "mensaje" => "" . AlertasHTML5::error(
           "El código de cliente [<strong>" . self::$datos['codigo_cliente'] . "</strong>] le pertenece al cliente [<strong>" . $Cliente->personaRazonSocial . "</strong>] " . $Cliente->personaNombreComercial . ".<br />"
           . "<em>Si consideras que esto es un error, comunicate con el adminsitrador del sistema para validar la información.</em><br />"
           . "<strong>Si intentas utilizarlo para crear un nuevo cliente, el sistema no te dejará guardar los datos.</strong>"
          ),
          "Cliente" => $Cliente)
        );
      }
    }
  }

  function mostrarTodos() {
    self::$datos['Clientes'] = Clientes::todos();
    Vistas::mostrar('clientes' . DS . 'listado', self::$datos);
  }

  function nuevo() {
    $this->mostrarFormulario();
  }

  function editar() {
    self::$datos['datosCliente'] = Clientes::datos(self::$datos['registro_cliente']);
    self::$datos['datosClienteContactos'] = ClientesContactos::datosPorClientes(self::$datos['registro_cliente']);
    $this->mostrarFormulario();
  }

  function guardarCambios() {
    if(isset(self::$datos['registro_cliente']) and ! empty(self::$datos['registro_cliente'])) {
      self::$datos['idPersona'] = $this->crear_datos_identificacion_contacto(TRUE);
      if(!is_null(self::$datos['idPersona'])) {
        $actualizado = Clientes::actualizar(
          self::$datos['registro_cliente'], self::$datos['idPersona'], self::$datos['codigo_cliente'],
          self::$datos['tipo_cliente']
        );
        if($actualizado > 0) {
          Mensajes::operacion(
           'EXITO',
           'Se han actualizado correctamente los datos de identificación del <strong>CLIENTE ' . self::$datos['razonsocial_cliente'] . '</strong>, ' . ' con codigo [<strong>' . self::$datos['codigo_cliente'] . '</strong>].'
          );
        }
        $boradosContactos = ClientesContactos::borrarTodosCliente(self::$datos['registro_cliente']);
        $this->asociarContactosCliente();
        echo Respuestas::JSON('EXITO', '' . self::$datos['registro_cliente'] . '');
      }
    } else {
      $this->crearNuevoCliente();
    }
  }

  function crearNuevoCliente() {
    self::$datos['id_nueva_persona'] = $this->crear_datos_identificacion_contacto();
    self::$datos['registro_cliente'] = Clientes::insertar(
      self::$datos['id_nueva_persona'], self::$datos['codigo_cliente'], self::$datos['tipo_cliente']
    );
    if(!is_null(self::$datos['registro_cliente'])) {
      $this->asociarContactosCliente();
      Mensajes::operacion(
       'EXITO',
       'Se ha creado correctamente un nuevo <strong>CLIENTE ' . self::$datos['razonsocial_cliente'] . '</strong>, ' . 'identificado por codigo [<strong>' . self::$datos['codigo_cliente'] . '</strong>] .'
      );
      echo Respuestas::JSON('EXITO', '' . self::$datos['registro_cliente'] . '');
    } else {
      echo Respuestas::JSON(
       'ERROR',
       AlertasHTML5::error(
        'NO Se ha creado el nuevo <strong>CLIENTE</strong>, ' . 'identificado por el codigo [<strong>' . self::$datos['codigo_cliente'] . '</strong>] y rasón social ' . self::$datos['razonsocial_cliente'] . '.'
        . '<br />' . '<strong>Verifique que el CODIGO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>')
      );
      die();
    }
  }

  function mostrarFormulario() {

    self::$datos['tiposClientes'] = TiposClientes::todos();
    self::$datos['tiposIdentificacion'] = TiposIdentificacion::todos();
    Vistas::mostrar('clientes' . DS . 'formulario', self::$datos);
  }

  function borrar() {
    if(isset(self::$datos['registro_cliente']) and ! empty(self::$datos['registro_cliente'])) {
      $objCliente = Clientes::datos(self::$datos['registro_cliente']);
      $cambio = Clientes::desactivar(self::$datos['registro_cliente']);
      if($cambio) {
        Mensajes::operacion('EXITO',
                            'Se han eliminado correctamente los datos asociados al '
         . 'CLIENTE <strong> [' . $objCliente->clienteCodigo . '  ' . $objCliente->personaRazonSocial . '] </strong>. '
        );
      } else {
        Mensajes::operacion('ERROR',
                            'NO Se han eliminado correctamente los datos asociados al '
         . '<strong>CLIENTE</strong> [' . $objCliente->clienteCodigo . '] <strong>' . $objCliente->personaRazonSocial . '</strong>. '
         . '<strong>Intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
        );
      }
    }
    $this->mostrarTodos();
  }

  /*
   * Ayudas de Escritura
   */

  function mapa() {

    self::$datos['Clientes'] = Clientes::todos();
    Vistas::mostrar('clientes' . DS . 'mapa', self::$datos);
  }

  function mapaCliente() {

    if(isset(self::$datos['registro_cliente']) and ! empty(self::$datos['registro_cliente'])) {
      self::$datos['datosCliente'] = Clientes::datos(self::$datos['registro_cliente']);
      Vistas::cargar('clientes' . DS . 'ubicacion', self::$datos, 'ubicaciones');
    }
  }

  function asociarContactosCliente() {
    if(isset(self::$datos['item_cedula_referencia']) and count(self::$datos['item_cedula_referencia'])) {
      foreach(self::$datos['item_cedula_referencia'] as $indiceReferencia => $num_cedula) {
        $foto = self::$datos['item_url_imgreferencia'][$indiceReferencia];
        if(strpos($foto, 'TMP' . WS)) {
          $fotoDir = PATH_BASE . str_replace(WS, DS, $foto);
          if(Archivos::mover_archivo($fotoDir, str_replace('TMP' . DS, '', $fotoDir))) {
            $foto = str_replace('TMP' . WS, '', $foto);
          }
        }
        $idReferencia = $this->crear_datos_de_la_referencia(
         $num_cedula, self::$datos['item_nombre_referencia'][$indiceReferencia],
         self::$datos['item_apellido_referencia'][$indiceReferencia],
         self::$datos['item_dir_referencia'][$indiceReferencia], self::$datos['item_tel_referencia'][$indiceReferencia],
         self::$datos['item_cel_referencia'][$indiceReferencia],
         self::$datos['item_email_referencia'][$indiceReferencia], $foto
        );
        $idClienteContactoNueva = ClientesContactos::insertar(
          self::$datos['registro_cliente'], $idReferencia, self::$datos['item_etiquetas_referencia'][$indiceReferencia],
          self::$datos['item_recibe_equipos_referencia'][$indiceReferencia],
          self::$datos['item_recibe_deposito_referencia'][$indiceReferencia]
        );
        if(is_null($idClienteContactoNueva)) {
          Mensajes::operacion(
           'ALERTA',
           'No Se ha podido asociar correctamente el <strong>CONTACTO AL CLIENTE</strong>, '
           . 'identificado por [<strong>' . $num_cedula . '</strong>] ' . self::$datos['item_nombre_referencia'][$indiceReferencia] . " " . self::$datos['item_apellido_referencia'][$indiceReferencia] . '.'
          );
        } else {
          Mensajes::operacion(
           'EXITO',
           'Se ha asociado correctamente el <strong>CONTACTO</strong>, '
           . 'identificado por [<strong>' . $num_cedula . '</strong>] ' . self::$datos['item_nombre_referencia'][$indiceReferencia] . " " . self::$datos['item_apellido_referencia'][$indiceReferencia] . ' <strong>AL CLIENTE</strong>.'
          );
        }
      }
    }
  }

  function crear_datos_identificacion_contacto($actualzar = false) {
    $clientePesona = NULL;
    self::$datos['Persona'] = Personas::datosPorIdentificacion(
      self::$datos['tipoidentificacion_cliente'], self::$datos['identificacion_cliente']);
    if(is_null(self::$datos['Persona'])) {
      self::$datos['url_logo_cliente'] = $this->recibirLogoCliente();
      self::$datos['url_foto_cliente'] = $this->recibirFotoCliente();
      $clientePesona = Personas::insertar(
        self::$datos['tipoidentificacion_cliente'], self::$datos['identificacion_cliente'],
        self::$datos['razonsocial_cliente'], self::$datos['nombrecomercial_cliente'], self::$datos['nombres_cliente'],
        self::$datos['apellidos_cliente'], self::$datos['direccion_cliente'], self::$datos['telefono_cliente'],
        self::$datos['celular_cliente'], self::$datos['correo_cliente'], self::$datos['latitud_cliente'],
        self::$datos['longitud_cliente'], self::$datos['desc_cliente'], self::$datos['url_logo_cliente'],
        self::$datos['url_foto_cliente']
      );
      if(is_null($clientePesona)) {
        $TipoId = TiposIdentificacion::datos(self::$datos['tipoidentificacion_cliente']);
        echo Respuestas::JSON(
         "ERROR",
         "" . AlertasHTML5::error(
          'Hubo un problema al registrar los datos del <strong>CLIENTE</strong> ' .
          'identificado por [<strong>' . $TipoId->tipoIdentificacionCodigo . ' ' . self::$datos['identificacion_cliente'] . '</strong>]  ' . self::$datos['razonsocial_cliente'] . '.'
         ) . ""
        );
        die();
      }
    } else {
      $clientePesona = self::$datos['Persona']->personaId;
      if($actualzar) {
        self::$datos['url_logo_cliente'] = $this->recibirLogoCliente();
        self::$datos['url_foto_cliente'] = $this->recibirFotoCliente();
        $modificado = Personas::actualizar(
          $clientePesona, self::$datos['tipoidentificacion_cliente'], self::$datos['identificacion_cliente'],
          self::$datos['razonsocial_cliente'], self::$datos['nombrecomercial_cliente'], self::$datos['nombres_cliente'],
          self::$datos['apellidos_cliente'], self::$datos['direccion_cliente'], self::$datos['telefono_cliente'],
          self::$datos['celular_cliente'], self::$datos['correo_cliente'], self::$datos['latitud_cliente'],
          self::$datos['longitud_cliente'], self::$datos['desc_cliente'], self::$datos['url_logo_cliente'],
          self::$datos['url_foto_cliente']
        );
        if($modificado > 0) {
          Mensajes::operacion(
           'EXITO',
           'Se han actualizado correctamente los datos personales del <strong>CLIENTE</strong>, '
           . 'identificado por [<strong>' . self::$datos['Persona']->personaIdentificacion . '</strong>] ' . self::$datos['Persona']->personaRazonSocial . '</strong>.'
          );
        }
      }
    }
    return $clientePesona;
  }

  function crear_datos_de_la_referencia(
  $num_cedula, $nombres, $apellidos, $direccion, $telefono, $celular, $correo, $foto
  ) {
    $idReferencia = NULL;
    self::$datos['PersonaReferencia' . $num_cedula] = Personas::datosPorCedula($num_cedula);
    if(is_null(self::$datos['PersonaReferencia' . $num_cedula])) {
      $idReferencia = Personas::insertar(
        1, $num_cedula, $nombres . " " . $apellidos, "", $nombres, $apellidos, $direccion, $telefono, $celular, $correo,
        "", "", "", "", $foto
      );
      if(is_null($idReferencia)) {
        Mensajes::operacion(
         'ERROR',
         "" . (
         'Hubo un problema al registrar los datos de la <strong>REFERENCIA DEL CLIENTE</strong> ' .
         'identificado por [<strong>C.C.' . $num_cedula . '</strong>]  ' . $nombres . ' ' . $apellidos . '.'
         ) . ""
        );
      }
    } else {
      $idReferencia = self::$datos['PersonaReferencia' . $num_cedula]->personaId;
    }
    return $idReferencia;
  }

  function recibirFotoCliente() {
    self::$datos['url_foto_cliente'] = NULL;
    if(!empty(self::$enviados['fotoreferencia_cliente']['name'])) {
      $nombreArchivo = "foto-" . self::$datos['tipoidentificacion_cliente'] . "-" . self::$datos['identificacion_cliente'] . "-" . uniqid() . "." . Archivos::nombre_extension(self::$enviados['fotoreferencia_cliente']);
      $rutaCarpeta = PATH_ARCHIVOS . "personas" . DS . "clientes" . DS;
      $urlCarpeta = URL_ARCHIVOS . "personas" . WS . "clientes" . WS;
      Archivos::mover_archivo_recibido(
       self::$enviados['fotoreferencia_cliente'], $rutaCarpeta, $nombreArchivo
      );
      self::$datos['url_foto_cliente'] = $urlCarpeta . $nombreArchivo;
    } else {
      self::$datos['url_foto_cliente'] = '/archivos/oximeiser/img/logo-aqui.png';
    }
    return self::$datos['url_foto_cliente'];
  }

  function recibirLogoCliente() {
    self::$datos['url_logo_cliente'] = NULL;
    if(!empty(self::$enviados['logo_cliente']['name'])) {
      $nombreArchivo = "logo-" . self::$datos['tipoidentificacion_cliente'] . "-" . self::$datos['identificacion_cliente'] . "-" . uniqid() . "." . Archivos::nombre_extension(self::$enviados['logo_cliente']);
      $rutaCarpeta = PATH_ARCHIVOS . "personas" . DS . "clientes" . DS;
      $urlCarpeta = URL_ARCHIVOS . "personas" . WS . "clientes" . WS;
      Archivos::mover_archivo_recibido(
       self::$enviados['logo_cliente'], $rutaCarpeta, $nombreArchivo
      );
      self::$datos['url_logo_cliente'] = $urlCarpeta . $nombreArchivo;
    } else {
      self::$datos['url_logo_cliente'] = '/archivos/oximeiser/img/logo-aqui.png';
    }
    return self::$datos['url_logo_cliente'];
  }

}
