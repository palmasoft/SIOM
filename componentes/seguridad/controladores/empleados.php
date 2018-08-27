<?php

Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Sistema' . DS . 'TiposIdentificacion');
Modelos::cargar('Sistema' . DS . 'Usuarios');
Modelos::cargar('Sistema' . DS . 'Permisos');
Modelos::cargar('Sistema' . DS . 'PermisosUsuarios');
Modelos::cargar('Personas' . DS . 'Personas');

class empleadosControlador extends Controladores {

  function mostrarTodos() {
    self::$datos['Empleados'] = Usuarios::todos_completo();
    Vistas::mostrar('empleados' . DS . 'listado', self::$datos);
  }

  function nuevo() {
    $this->mostrarFormulario();
  }

  function editar() {
    self::$datos['datosEmpleado'] = Usuarios::datos_del_usuario(self::$datos['registro_empleado']);
    self::$datos['funcionesEmpleado'] = PermisosUsuarios::todos_del_usuario(self::$datos['registro_empleado']);
    $this->mostrarFormulario();
  }

  function guardarCambios() {
    if(isset(self::$datos['registro_empleado']) and ! empty(self::$datos['registro_empleado'])) {
      $this->actualizarDatosEmpleado(self::$datos['registro_empleado']);
    } else {
      $this->crearNuevoEmpleado();
    }
  }

  function crearNuevoEmpleado() {
    self::$datos['id_nueva_persona'] = $this->crear_datos_identificacion_contacto();
    if(!is_null(self::$datos['id_nueva_persona'])) {
      self::$datos['registro_empleado'] = Usuarios::insertar(
        self::$datos['id_nueva_persona'], self::$datos['cargo_empleado'], self::$datos['tipo_usuario_empleado'],
        self::$datos['usuario_empleado'], self::$datos['clave_empleado'], self::$datos['correo_empleado'],
        self::$datos['celular_empleado'], self::$datos['url_logo_empleado']
      );
      if(!is_null(self::$datos['registro_empleado'])) {
        if(isset(self::$datos['funciones_sistema']) and count(self::$datos['funciones_sistema'])) {
          foreach(self::$datos['funciones_sistema'] as $idFuncion) {
            PermisosUsuarios::asignar_permiso($idFuncion, self::$datos['registro_empleado']);
          }
        }
        Mensajes::operacion(
         'EXITO',
         'Se ha creado correctamente un nuevo <strong>EMPLEADO ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '</strong>, '
         . 'identificado por usuario [<strong>' . self::$datos['usuario_empleado'] . '</strong>] .'
        );
        echo Respuestas::JSON('EXITO', '' . self::$datos['registro_empleado'] . '');
      } else {
        echo Respuestas::JSON(
         'ERROR',
         AlertasHTML5::error(
          'NO Se ha creado el nuevo <strong>EMPLEADO</strong>, ' . 'identificado por el usuario [<strong>' . self::$datos['usuario_empleado'] . '</strong>] '
          . 'y nombre ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '.'
          . '<br />' . '<strong>Verifique que el NOMBRE DE USUARIO o CORREO ELECTRONICO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />'
          . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>')
        );
        die();
      }
    } else {
      echo Respuestas::JSON(
       'ERROR',
       AlertasHTML5::error(
        'NO Se ha podido registrar los datos personales del <strong>EMPLEADO</strong>, ' . 'identificado por el usuario [<strong>' . self::$datos['usuario_empleado'] . '</strong>] '
        . 'y nombre ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '.'
        . '<br />' . '<strong>Verifique que la IDENTIFICACIÓN o CORREO ELECTRONICO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />'
        . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>')
      );
      die();
    }
  }

  function actualizarDatosEmpleado($idEmpleadoUsuario) {
    self::$datos['Empleado'] = Usuarios::datos_del_usuario(self::$datos['registro_empleado']);
    self::$datos['idPersona'] = $this->actualizar_datos_identificacion_contacto(self::$datos['Empleado']->personaId);
    if(!is_null(self::$datos['idPersona'])) {
      if(!empty(self::$enviados['logo_empleado']['name'])) {
        $actualizado = Usuarios::actualizar(
          self::$datos['registro_empleado'], self::$datos['idPersona'], self::$datos['cargo_empleado'],
          self::$datos['tipo_usuario_empleado'], self::$datos['usuario_empleado'], self::$datos['correo_empleado'],
          self::$datos['celular_empleado'], self::$datos['url_logo_empleado']
        );
      } else {
        $actualizado = Usuarios::actualizarSinAvatar(
          self::$datos['registro_empleado'], self::$datos['idPersona'], self::$datos['cargo_empleado'],
          self::$datos['tipo_usuario_empleado'], self::$datos['usuario_empleado'], self::$datos['correo_empleado'],
          self::$datos['celular_empleado']
        );
      }
      if(!empty(self::$datos['clave_empleado'])) {
        $actualizadoClave = Usuarios::cambiarClave(self::$datos['registro_empleado'], self::$datos['clave_empleado']);
      }
      if($actualizado > 0 or $actualizadoClave > 0) {
        if(isset(self::$datos['funciones_sistema']) and count(self::$datos['funciones_sistema'])) {
          PermisosUsuarios::quitar_permisos(self::$datos['registro_empleado']);
          foreach(self::$datos['funciones_sistema'] as $idFuncion) {
            PermisosUsuarios::asignar_permiso($idFuncion, self::$datos['registro_empleado']);
          }
        }
        Mensajes::operacion(
         'EXITO',
         'Se han actualizado correctamente los datos del '
         . '<strong>EMPLEADO ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '</strong>, '
         . ' con usuario [<strong>' . self::$datos['usuario_empleado'] . '</strong>].'
        );
        echo Respuestas::JSON('EXITO', '' . self::$datos['registro_empleado'] . '');
      } else {
        echo Respuestas::JSON(
         'ERROR',
         (
         'NO Se han actualizado los datos del <strong>EMPLEADO</strong>, ' . 'identificado por el usuario [<strong>' . self::$datos['usuario_empleado'] . '</strong>] '
         . 'y nombre ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '.'
         . '<br />' . '<strong>Verifique que el NOMBRE DE USUARIO o CORREO ELECTRONICO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>')
        );
        die();
      }
    } else {
      echo Respuestas::JSON(
       'ERROR',
       (
       'NO Se han actualizado los datos personales del <strong>EMPLEADO</strong>, ' . 'identificado por el usuario [<strong>' . self::$datos['usuario_empleado'] . '</strong>] '
       . 'y nombre ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '.'
       . '<br />' . '<strong>Verifique que la IDENTIFICACIÓN o CORREO ELECTRONICO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />'
       . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>')
      );
      die();
    }
  }

  function mostrarFormulario() {
    self::$datos['cargos'] = CargosEmpleados::todos();
    self::$datos['funciones'] = Permisos::todos_menu();
    self::$datos['tiposIdentificacion'] = TiposIdentificacion::todos();
    Vistas::mostrar('empleados' . DS . 'formulario', self::$datos);
  }

  function borrar() {
    if(isset(self::$datos['registro_empleado']) and ! empty(self::$datos['registro_empleado'])) {
      $objCliente = Clientes::datos(self::$datos['registro_empleado']);
      $cambio = Clientes::desactivar(self::$datos['registro_empleado']);
      if($cambio) {
        Mensajes::operacion('EXITO',
                            'Se han eliminado correctamente los datos asociados al '
         . 'CLIENTE <strong> [' . $objCliente->empleadoCodigo . '  ' . $objCliente->personaRazonSocial . '] </strong>. '
        );
      } else {
        Mensajes::operacion('ERROR',
                            'NO Se han eliminado correctamente los datos asociados al '
         . '<strong>CLIENTE</strong> [' . $objCliente->empleadoCodigo . '] <strong>' . $objCliente->personaRazonSocial . '</strong>. '
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

  function crear_datos_identificacion_contacto() {
    $empleadoPesona = NULL;
    self::$datos['Persona'] = Personas::datosPorIdentificacion(
      self::$datos['tipoidentificacion_empleado'], self::$datos['identificacion_empleado']);
    if(is_null(self::$datos['Persona'])) {
      self::$datos['url_logo_empleado'] = $this->recibirLogoEmpleado();
      self::$datos['url_foto_empleado'] = $this->recibirFotoEmpleado();
      $empleadoPesona = Personas::insertar(
        self::$datos['tipoidentificacion_empleado'], self::$datos['identificacion_empleado'],
        self::$datos['razonsocial_empleado'], self::$datos['nombrecomercial_empleado'],
        self::$datos['nombres_empleado'], self::$datos['apellidos_empleado'], self::$datos['direccion_empleado'],
        self::$datos['telefono_empleado'], self::$datos['celular_empleado'], self::$datos['correo_empleado'],
        Params::valor('lat_organizacion'), Params::valor('lon_organizacion'), self::$datos['desc_empleado'],
                                                         self::$datos['url_logo_empleado'],
                                                         self::$datos['url_foto_empleado']
      );
      if(is_null($empleadoPesona)) {
        $TipoId = TiposIdentificacion::datos(self::$datos['tipoidentificacion_empleado']);
        echo Respuestas::JSON(
         "ERROR",
         "" . AlertasHTML5::error(
          'Hubo un problema al registrar los datos del <strong>EMPLEADO</strong> '
          . 'identificado por [<strong>' . $TipoId->tipoIdentificacionCodigo . ' ' . self::$datos['identificacion_empleado'] . '</strong>]  ' . self::$datos['nombres_empleado'] . ' ' . self::$datos['apellidos_empleado'] . '.'
         ) . ""
        );
        die();
      } else {
        Mensajes::operacion(
         'EXITO',
         'Se han actualizado correctamente los datos personales del <strong>EMPLEADO</strong>, '
         . 'identificado por [<strong>' . self::$datos['identificacion_empleado'] . '</strong>] ' . self::$datos['nombres_empleado'] . " " . self::$datos['apellidos_empleado'] . '.'
        );
      }
    }
    return $empleadoPesona;
  }

  function actualizar_datos_identificacion_contacto($idPersona) {
    $empleadoPesona = $idPersona;
    self::$datos['Persona'] = Personas::datosPorIdentificacion(self::$datos['tipoidentificacion_empleado'],
                                                               self::$datos['identificacion_empleado']);
    if(is_null(self::$datos['Persona'])) {
      self::$datos['url_logo_empleado'] = $this->recibirLogoEmpleado();
      self::$datos['url_foto_empleado'] = $this->recibirFotoEmpleado();
      $modificado = Personas::actualizar(
        $empleadoPesona, self::$datos['tipoidentificacion_empleado'], self::$datos['identificacion_empleado'],
        self::$datos['razonsocial_empleado'], self::$datos['nombrecomercial_empleado'],
        self::$datos['nombres_empleado'], self::$datos['apellidos_empleado'], self::$datos['direccion_empleado'],
        self::$datos['telefono_empleado'], self::$datos['celular_empleado'], self::$datos['correo_empleado'],
        self::$datos['latitud_empleado'], self::$datos['longitud_empleado'], self::$datos['desc_empleado'],
        self::$datos['url_logo_empleado'], self::$datos['url_foto_empleado']
      );
      if($modificado > 0) {
        Mensajes::operacion(
         'EXITO',
         'Se han actualizado correctamente los datos personales del <strong>EMPLEADO</strong>, '
         . 'identificado por [<strong>' . self::$datos['Persona']->personaIdentificacion . '</strong>] ' . self::$datos['Persona']->personaRazonSocial . '</strong>.'
        );
      }
    } else {
      $empleadoPesona = self::$datos['Persona']->personaId;
    }
    return $empleadoPesona;
  }

  function recibirFotoEmpleado() {
    self::$datos['url_foto_empleado'] = NULL;
    if(!empty(self::$enviados['fotoreferencia_empleado']['name'])) {
      $nombreArchivo = "foto-" . self::$datos['tipoidentificacion_empleado'] . "-" . self::$datos['identificacion_empleado'] . "-" . uniqid() . "." . Archivos::nombre_extension(self::$enviados['fotoreferencia_empleado']);
      $rutaCarpeta = PATH_ARCHIVOS . "personas" . DS . "empleados" . DS;
      $urlCarpeta = URL_ARCHIVOS . "personas" . WS . "empleados" . WS;
      Archivos::mover_archivo_recibido(
       self::$enviados['fotoreferencia_empleado'], $rutaCarpeta, $nombreArchivo
      );
      self::$datos['url_foto_empleado'] = $urlCarpeta . $nombreArchivo;
    } else {
      self::$datos['url_foto_empleado'] = '/archivos/oximeiser/img/logo-aqui.png';
    }
    return self::$datos['url_foto_empleado'];
  }

  function recibirLogoEmpleado() {
    self::$datos['url_logo_empleado'] = NULL;
    if(!empty(self::$enviados['logo_empleado']['name'])) {
      $nombreArchivo = "logo-" . self::$datos['tipoidentificacion_empleado'] . "-" . self::$datos['identificacion_empleado'] . "-" . uniqid() . "." . Archivos::nombre_extension(self::$enviados['logo_empleado']);
      $rutaCarpeta = PATH_ARCHIVOS . "personas" . DS . "empleados" . DS;
      $urlCarpeta = URL_ARCHIVOS . "personas" . WS . "empleados" . WS;
      Archivos::mover_archivo_recibido(
       self::$enviados['logo_empleado'], $rutaCarpeta, $nombreArchivo
      );
      self::$datos['url_logo_empleado'] = $urlCarpeta . $nombreArchivo;
    } else {
      self::$datos['url_logo_empleado'] = '/archivos/oximeiser/img/logo-aqui.png';
    }
    return self::$datos['url_logo_empleado'];
  }

  function validarExistenciaUsuario() {
    if(isset(self::$datos['usuario_empleado'])) {
      self::$datos['usuario_empleado'] = str_replace("_", "", self::$datos['usuario_empleado']);
      $Usuario = Usuarios::existeNombreUsuario(self::$datos['usuario_empleado']);
      if(is_null($Usuario)) {
        echo json_encode(
         array(
          "respuesta" => "CONTINUAR",
          "mensaje" => "" . AlertasHTML5::informacion(
           "El nombre de usuario [<strong>" . self::$datos['usuario_empleado'] . "</strong>] NO se encuentra en la base de datos. <strong>Puedes usarlo para EL EMPLEADO.</strong>"),
          "Usuario" => $Usuario)
        );
      } else {
        echo json_encode(
         array(
          "respuesta" => "ERROR",
          "mensaje" => "" . AlertasHTML5::error(
           "El nombre de usuario [<strong>" . self::$datos['usuario_empleado'] . "</strong>] le pertenece al empleado [<strong>" . $Usuario->personaNombres . " " . $Usuario->personaApellidos . "</strong>] " . $Usuario->personaNombreComercial . ".<br />"
           . "<em>Si consideras que esto es un error, comunicate con el administrador del sistema para validar la información.</em><br />"
           . "<strong>Si intentas utilizarlo para crear un nuevo empleado, el sistema no te dejará guardar los datos.</strong>"
          ),
          "Usuario" => $Usuario)
        );
      }
    }
  }

  function validarExistenciaEmpleado() {
    if(isset(self::$datos['tipo_identificacion']) and isset(self::$datos['num_identificacion'])) {
      self::$datos['num_identificacion'] = str_replace("_", "", self::$datos['num_identificacion']);
      $Usuario = Usuarios::datos_por_identificacion(self::$datos['tipo_identificacion'],
                                                    self::$datos['num_identificacion']);
      if(is_null($Usuario)) {
        $Persona = Personas::datosPorIdentificacion(self::$datos['tipo_identificacion'],
                                                    self::$datos['num_identificacion']);
        if(is_null($Persona)) {
          $objTipoId = TiposIdentificacion::datos(self::$datos['tipo_identificacion']);
          echo json_encode(
           array(
            "respuesta" => "CONTINUAR",
            "mensaje" => "" . AlertasHTML5::informacion(
             "La identificación para este empleado [<strong>" . $objTipoId->tipoIdentificacionCodigo . " " . self::$datos['num_identificacion'] . "</strong>] NO tiene coincidencias en la base de datos. <strong>Puedes usarlo para EL EMPLEADO.<strong>"),
            "Empleado" => NULL)
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
             . "que <strong>NO ES EMPLEADO</strong>.<br />"
             . "Es decir, que puedes usarlo para <strong>CREAR</strong> un NUEVO EMPLEADO, pero no podras modificar sus datos hasta que termines y guardes."
            ),
            "Empleado" => $Persona)
          );
        }
      } else {
        echo json_encode(
         array(
          "respuesta" => "ERROR",
          "mensaje" => "" . AlertasHTML5::error(
           "La identificación [<strong>" . $Usuario->tipoIdentificacionCodigo . " " . $Usuario->personaIdentificacion . "</strong>] le pertenece al EMPLEADO <strong>" . $Usuario->personaNombres . " " . $Usuario->personaApellidos . "</strong> " . $Usuario->personaNombreComercial . " .<br />"
           . "<em>Si consideras que esto es un error, comunicate con el adminsitrador del sistema para validar la información.</em><br />"
           . "<strong>Si intentas utilizarlo para crear un nuevo empleado, el sistema no te dejará guardar los datos.</strong>"
          ),
          "Empleado" => $Usuario)
        );
      }
    }
  }

  function cambiarEstado() {
    if(isset(self::$datos['registro_empleado']) and ! empty(self::$datos['registro_empleado'])) {
      $objUsuario = Usuarios::datos(self::$datos['registro_empleado']);
      if($objUsuario->usuarioEstado == 'ACTIVO') {
        $cambio = Usuarios::desactivar(self::$datos['registro_empleado']);
      } else {
        $cambio = Usuarios::activar(self::$datos['registro_empleado']);
      }
      if($cambio) {
        Mensajes::operacion(
         'EXITO',
         'Se ha <strong>CAMBIADO EL ESTADO</strong> correctamente el EMPLEADO de usuario <strong> [' . $objUsuario->usuarioNombre . '] </strong>. '
        );
      } else {
        Mensajes::operacion(
         'ERROR',
         'No se ha <strong>CAMBIADO EL ESTADO</strong> del EMPLEADO de usuario <strong> [' . $objUsuario->usuarioNombre . '] </strong>. '
         . '<strong>Intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
        );
      }
    }
    $this->mostrarTodos();
  }

}
