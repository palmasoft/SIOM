<?php

Modelos::cargar('Sistema' . DS . 'Componentes');
Modelos::cargar('Sistema' . DS . 'Usuarios');

class sesionControlador extends Controladores {

  public
   function validar_usuario() {
    $iniciar = false;
    self::$datos['nick'] = self::$datos['txt_correo_usuario'];
    self::$datos['pass'] = self::$datos['txt_clave_usuario'];

    $Usr = Usuarios::existeCorreoUsuario(self::$datos['nick']);
    if(!is_null($Usr)) {
      $iniciar = $this->validar_por_correo($Usr);
    } else {
      $Usr = Usuarios::existeNombreUsuario(self::$datos['nick']);
      if(!is_null($Usr)) {
        $iniciar = $this->validar_por_nombre($Usr);
      } else {
        echo Respuestas::JSON(
         'ERROR', (('El Usuario <strong>NO EXISTE</strong> en el sistema.'))
        );
      }
    }
    if($iniciar) {
      Consola::imprimir("iniciando sesion.....\n\r");
      $User = Usuarios::datos_del_usuario($Usr->usuarioId);
      if($Usr->usuarioId == 0) {
        $User->componentes = Componentes::todos_con_permisos();
      } else {
        $User->componentes = Componentes::DelUsuarioConPermisos($Usr->usuarioId);
      }
      Config::set('OXIMED_USR', $User);
      Usuarios::actualizar_fechavisita($User->usuarioId);
      Usuarios::actualizar_ultima_ip($User->usuarioId);
      echo Respuestas::JSON('EXITO', 'CORRECTO');
    }
  }

  function validar_por_correo($Usr) {
    if(!is_null($Usr)) {
      if($Usr->usuarioEstado == "ACTIVO") {
        $Usr = Usuarios::esCorrectoClaveCorreo(self::$datos['nick'], self::$datos['pass']);
        if(!is_null($Usr)) {
          return true;
        } else {
          echo Respuestas::JSON('ERROR', (('El Usuario y la Clave <strong>NO COINCIDEN</strong>.')));
        }
      } else {
        echo Respuestas::JSON('ERROR', (('EL usuario <strong>NO ESTA ACTIVO</strong>.')));
      }
    }
    return false;
  }

  function validar_por_nombre($Usr) {
    if(!is_null($Usr)) {
      if($Usr->usuarioEstado == "ACTIVO") {
        $Usr = Usuarios::esCorrectoClaveNombre(self::$datos['nick'], self::$datos['pass']);
        if(!is_null($Usr)) {
          Config::set('OXIMED_USR', Usuarios::datos_del_usuario($Usr->usuarioId));
          return true;
        } else {
          echo Respuestas::JSON('ERROR', (('El Usuario y la Clave <strong>NO COINCIDEN</strong>.')));
        }
      } else {
        echo Respuestas::JSON('ERROR', (('EL Usuario <strong>NO ESTA ACTIVO</strong>.')));
      }
    }
    return false;
  }

  public
   function salir() {
    echo Respuestas::HTML(
     "EXITO",
     "<div class=\"text-center\" >Se ha CERRADO correctamente tu sesion de trabajo. <br /> <i class=\"fa fa-refresh fa-spin\" style=\"font-size: 200%;\" ></i> <br />Espera mientras cerramos el sistema.</div>"
    );
    Visitante::cerrar_sesion();
  }

  public
   function esta_activa_sesion() {
    if(isset($_SESSION['OXIMED_USR'])) {
      echo json_encode(array("respuesta" => $_SESSION['OXIMED_USR']->usuarioNombre));
    }
  }

  public
   function registrarUltimaUbicacion() {
    Usuarios::actualizar_ultima_ubicacion(Visitante::idUsuario(), self::$datos['latitud'], self::$datos['longitud']);
  }

}
