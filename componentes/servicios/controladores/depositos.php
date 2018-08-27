<?php

Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Servicios' . DS . 'ReciboDepositos');
Modelos::cargar('Servicios' . DS . 'ReciboEquipos');
Modelos::cargar('Personas' . DS . 'ClientesContactos');

Modelos::cargar('Documentos' . DS . 'TiposDocumentos');
Modelos::cargar('Documentos' . DS . 'Documentos');
Modelos::cargar('Documentos' . DS . 'Plantillas' . DS . 'ReciboDepositoEquipo');

Modelos::cargar('Correos' . DS . 'CorreosDepositosServicios');

class depositosControlador extends Controladores {

  function mostrarTodos() {
    self::$datos['Depositos'] = ReciboDepositos::todos();
    Vistas::mostrar('depositos' . DS . 'listado', self::$datos);
  }

  function verResumenDeposito() {
    self::$datos['DatosDeposito'] = ReciboDepositos::datos_completos(self::$datos['registro_deposito']);
    self::$datos['DatosDeposito']->Equipos = ReciboEquipos::todos_del_recibo(self::$datos['DatosDeposito']->reciboId);
    self::$datos['DatosDeposito']->EquiposEntregados = 0;
    self::$datos['DatosDeposito']->EquiposRecogidos = 0;
    self::$datos['DatosDeposito']->EquiposNoRecogidos = 0;
    self::$datos['DatosDeposito']->EquiposDevueltos = 0;
    foreach(self::$datos['DatosDeposito']->Equipos as $ObjEquipo) {
      switch($ObjEquipo->reciboEquipoMovimiento) {
        case '1':self::$datos['DatosDeposito']->EquiposEntregados++;
          break;
        case '2':self::$datos['DatosDeposito']->EquiposRecogidos++;
          break;
        case '3':self::$datos['DatosDeposito']->EquiposNoRecogidos++;
          break;
        case '4':self::$datos['DatosDeposito']->EquiposDevueltos++;
          break;
        default:
          break;
      }
    }
    Vistas::mostrar('depositos' . DS . 'resumen', self::$datos);
  }

  function formatoDevolverDeposito() {
    self::$datos['DatosDeposito'] = ReciboDepositos::datos_completos(self::$datos['registro_deposito']);
    self::$datos['DatosDeposito']->Equipos = ReciboEquipos::todos_del_recibo(self::$datos['DatosDeposito']->reciboId);
    self::$datos['DatosDeposito']->EquiposEntregados = 0;
    self::$datos['DatosDeposito']->EquiposRecogidos = 0;
    self::$datos['DatosDeposito']->EquiposNoRecogidos = 0;
    self::$datos['DatosDeposito']->EquiposDevueltos = 0;
    foreach(self::$datos['DatosDeposito']->Equipos as $ObjEquipo) {
      switch($ObjEquipo->reciboEquipoMovimiento) {
        case '1':self::$datos['DatosDeposito']->EquiposEntregados++;
          break;
        case '2':self::$datos['DatosDeposito']->EquiposRecogidos++;
          break;
        case '3':self::$datos['DatosDeposito']->EquiposNoRecogidos++;
          break;
        case '4':self::$datos['DatosDeposito']->EquiposDevueltos++;
          break;
        default:
          break;
      }
    }

    self::$datos['ReferenciasCliente'] = ClientesContactos::recibenDepositosClientes(self::$datos['DatosDeposito']->reciboCliente);

    Vistas::mostrar('depositos' . DS . 'devolver', self::$datos);
  }

  function devolverDeposito() {
    if(isset(self::$datos['registro_deposito']) and ! empty(self::$datos['registro_deposito'])) {
      $devolvio = ReciboDepositos::devolverDinero(self::$datos['registro_deposito'],self::$datos['referencia_recibe_deposito']);
      if(!is_null($devolvio)) {
        $DatosDeposito = ReciboDepositos::datos_completos(self::$datos['registro_deposito']);     
        $idDocumentoDeposito = ReciboDepositoEquipo::generarEgreso($DatosDeposito);
        ReciboDepositos::actualizar_documento_egreso(self::$datos['registro_deposito'], $idDocumentoDeposito);
        $dtsDeposito = ReciboDepositos::datos(self::$datos['registro_deposito']);
        if(!is_null($idDocumentoDeposito)) {
          Mensajes::operacion(
           'EXITO',
           'Se ha registrado correctamente el <strong>EGRESO DEL DEPOSITO</strong> con comprobante <strong>#' . $dtsDeposito->docEgresoConsecutivo . '</strong>, '
           . 'para el servicio con numero de recibo [<strong>' . $dtsDeposito->reciboNumero . '</strong>].'
           . ' '
          );
          $this->enviarNotificacionDevolucion(self::$datos['registro_deposito']);
          echo Respuestas::JSON("EXITO", "");
        } else {
          echo Respuestas::JSON(
           "ERROR",
           'No se ha podido generar el <strong>DOCUMENTO DEL EGRESO DEL DEPOSITO</strong> '
           . 'del servicio con numero de recibo [<strong>' . $dtsDeposito->reciboNumero . '</strong>].'
           . 'Porfavor, contacte al Adminsitrador de Sistema.'
          );
        }
      } else {
        echo Respuestas::JSON(
         "ERROR",
         'No se ha podido REGISTRAR la <strong>DEVOLUCION DEL DEPOSITO</strong> '
         . 'del servicio con numero de recibo [<strong>' . $dtsDeposito->reciboNumero . '</strong>].'
         . 'Porfavor, contacte al Adminsitrador de Sistema.'
        );
      }
    }
  }

  function enviarNotificacionDevolucion($idDeposito) {

    $DatosDeposito = ReciboDepositos::datos_completos($idDeposito);
    if(CorreosDepositosServicios::enviarDevolucion($DatosDeposito) === TRUE) {
      Mensajes::operacion(
       'EXITO',
       'Se ha <strong>Enviado Correctamente</strong> la notificación de la '
       . 'devolución de deposito con [<strong>Recibo ' . $DatosDeposito->documentoConsecutivoEgreso . '</strong>] a los correos:'
       . '[' . $DatosDeposito->personaCorreoElectronico . ' | ' . $DatosDeposito->correoReferencia . '].'
      );
    } else {
      Mensajes::operacion(
       'ERROR',
       '<strong>NO SE PUDO ENVIAR</strong> la notificación de la '
       . 'devolución de deposito con[<strong>Recibo ' . $DatosDeposito->documentoConsecutivoEgreso . '</strong>] a los correos:'
       . '[' . $DatosDeposito->personaCorreoElectronico . ' | ' . $DatosDeposito->correoReferencia . '].'
      );
    }
  }

}
