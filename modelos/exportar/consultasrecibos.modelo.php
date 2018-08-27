<?php

require_once('libs/docs/Excel.php');

class ConsultasRecibos {

  static public
   $encabezadosRecibos = array(
   'Fecha del Servicio',
   'Fecha de Recogida',
   'Servicio',
   'Num Recibo',
   'URL Recibo',
   'Direccion del Servicio',
   'Atendido por',
   'Cliente',
   'Nombre o Razon Social',
   'Tipo de Identificacion',
   'Identificacion',
   'Direccion',
   'Correo',
   'Referencia Nombre',
   'Referencia Identificacion',
   'Referencia Etiquetas',
   'Referencia Correo',
   'Equipos Entregados',
   'Equipos Recogidos',
   'Equipos No Recogidos',
   'Equipos Devueltos',
   'Total Equipos',
   'Deposito',
   'Valor',
   'Doc Ingreso',
   'URL Ingreso',
   'Doc Egreso',
   'URL Engreso',
   'Devuelto A Identificacion',
   'Devuelto A Nombre',
   'Devuelto Por Identificacion',
   'Devuelto Por Nombre',
  );
  static public
   $encabezadosEquipos = array(
   'Servicio',
   'Num Recibo',
   'Tipo Equipo',
   'Codigo Equipo',
   'Serial Equipo',
   'Nombre Equipo',
   'Movimiento',
   'Fecha Movimiento',
   'Ubicacion Movimiento',
   'Responsable',
   'Cliente',
   'Nombre o Razon Social',
   'Tipo de Identificacion',
   'Identificacion',
   'Referencia Nombre',
   'Referencia Identificacion',
  );
  static public
   $encabezadosEquiposRegistrados = array(
   'Tipo ',
   'Codigo ',
   'Serial',
   'Nombre',
   'Cap.',
   'Disponibilidad',
   'Recibo',
   'Cliente',
   'Fecha Ultimo Movimiento',
   'Ultima Latitud',
   'Ultima Longitud',
   'Estado',
  );
  static public
   $encabezadosClientesRegistrados = array(
   'Tipo ',
   'Codigo ',
   'Desde',
   'Tipo ID',
   'Identificación',
   'Razon Social',
   'Nombres',
   'Apellidos',
   'Dirección',
   'Teléfono',
   'Celular',
   'Correo',
   'Contactos',
   'Observaciones',
  );
  static public
   $encabezadosReferenciasClientesRegistrados = array(
   'Cliente',
   'Etiquetas',
   'Tipo ID',
   'Identificación',
   'Razon Social',
   'Nombres',
   'Apellidos',
   'Dirección',
   'Teléfono',
   'Celular',
   'Correo',
   'Recibe Equipos',
   'Recibe Depositos',
   'Observaciones',
  );

  static
   function exportarXLS($DatosServicios, $EquiposEncontrados = NULL, $ClientesEncontrados = NULL) {

    $fechaGenerado = date('YmdHis');
    $objPHPExcel = new Excel();
    $objPHPExcel->getProperties()->setCreator("SIOM / " . Visitante::idPersona() . "")
     ->setLastModifiedBy("" . Visitante::nombreCompletoUsuario() . "")
     ->setTitle("Registros de Servicios Prestados " . $fechaGenerado . " ")
     ->setSubject("Listado generado desde SIOM")
     ->setDescription("Listado de registros de los recibos de los servicios prestados a clientes,.")
     ->setKeywords("servicios, recibos, siom, listado, " . Visitante::nombreUsuario() . "")
     ->setCategory("Servicios y Recibos");


    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->setTitle('Servicios y Recibos');
    $objPHPExcel = $objPHPExcel->agregar_encabezados_sinindices($objPHPExcel, self::$encabezadosRecibos, 0);
    $objPHPExcel->createSheet(1);
    $objPHPExcel->setActiveSheetIndex(1);
    $objPHPExcel->getActiveSheet()->setTitle('Equipos de los Servicios');
    $objPHPExcel = $objPHPExcel->agregar_encabezados_sinindices($objPHPExcel, self::$encabezadosEquipos, 1);

    $fila = 1;
    $filaEquipos = 1;
    foreach($DatosServicios as $Registro) {
      $objPHPExcel->setActiveSheetIndex(0);
      $valoresFilas = array(
       $Registro->datosConsulta->reciboFechaServicio,
       $Registro->datosConsulta->reciboFechaRecogida,
       $Registro->datosConsulta->servicioCodigo,
       $Registro->datosConsulta->reciboNumero,
       $Registro->datosConsulta->documentoUrl,
       $Registro->datosConsulta->reciboDireccion,
       $Registro->datosConsulta->usuarioNombre,
       $Registro->datosConsulta->clienteCodigo,
       $Registro->datosConsulta->personaRazonSocial,
       $Registro->datosConsulta->tipoIdentificacionCodigo,
       $Registro->datosConsulta->personaIdentificacion,
       $Registro->datosConsulta->personaDireccion,
       $Registro->datosConsulta->personaCorreoElectronico,
       $Registro->datosConsulta->nombresReferencia . ' ' . $Registro->datosConsulta->apellidosReferencia,
       $Registro->datosConsulta->idReferencia,
       $Registro->datosConsulta->clienteContactoEtiquetas,
       $Registro->datosConsulta->correoReferencia,
       $Registro->datosConsulta->EquiposEntregados,
       $Registro->datosConsulta->EquiposRecogidos,
       $Registro->datosConsulta->EquiposNoRecogidos,
       $Registro->datosConsulta->EquiposDevueltos,
       $Registro->datosConsulta->EquiposEntregados + $Registro->datosConsulta->EquiposRecogidos + $Registro->datosConsulta->EquiposNoRecogidos + $Registro->datosConsulta->EquiposDevueltos,
       $Registro->datosConsulta->Deposito->depositoTitulo,
       $Registro->datosConsulta->Deposito->reciboDepositoValor,
       $Registro->datosConsulta->Deposito->documentoConsecutivo,
       $Registro->datosConsulta->Deposito->documentoUrl,
       $Registro->datosConsulta->Deposito->documentoConsecutivoEgreso,
       $Registro->datosConsulta->Deposito->documentoUrlEgreso,
       $Registro->datosConsulta->Deposito->identificacionDevueltoA,
       $Registro->datosConsulta->Deposito->nombresDevueltoA . ' ' . $Registro->datosConsulta->Deposito->apellidosDevueltoA,
       $Registro->datosConsulta->Deposito->identificacionDevuelve,
       $Registro->datosConsulta->Deposito->nombresDevuelve . ' ' . $Registro->datosConsulta->Deposito->apellidosDevuelve,
      );
      $objPHPExcel = $objPHPExcel->agregar_fila_sinindices($objPHPExcel, $valoresFilas, ++$fila, 0);

      foreach($Registro->datosConsulta->Equipos as $Equipos) {
        $valoresEquipos = array(
         $Equipos->servicioCodigo,
         $Equipos->reciboNumero,
         $Equipos->tipoEquipoTitulo,
         $Equipos->equipoCodigo,
         $Equipos->equipoSerial,
         $Equipos->equipoTitulo,
         $Equipos->movimientoTitulo,
         $Equipos->reciboFechaServicio,
         $Equipos->reciboDireccion,
         $Equipos->usuarioNombre,
         $Registro->datosConsulta->clienteCodigo,
         $Registro->datosConsulta->personaRazonSocial,
         $Registro->datosConsulta->tipoIdentificacionCodigo,
         $Registro->datosConsulta->personaIdentificacion,
         $Registro->datosConsulta->nombresReferencia . ' ' . $Registro->datosConsulta->apellidosReferencia,
         $Registro->datosConsulta->idReferencia,
        );
        $objPHPExcel = $objPHPExcel->agregar_fila_sinindices($objPHPExcel, $valoresEquipos, ++$filaEquipos, 1);
      }
    }


    if(!is_null($EquiposEncontrados)) {
      $filaEquiposEncontrados = 1;
      $objPHPExcel->createSheet(2);
      $objPHPExcel->setActiveSheetIndex(2);
      $objPHPExcel->getActiveSheet()->setTitle('Equipos Registrados');
      $objPHPExcel = $objPHPExcel->agregar_encabezados_sinindices($objPHPExcel, self::$encabezadosEquiposRegistrados, 2);
      foreach($EquiposEncontrados as $Equipos) {
        $valoresEquiposEncontrados = array(
         $Equipos->tipoEquipoTitulo,
         $Equipos->equipoCodigo,
         $Equipos->equipoSerial,
         $Equipos->equipoTitulo,
         $Equipos->equipoCapacidad,
         $Equipos->equipoEstadoTitulo,
         $Equipos->reciboNumero,
         $Equipos->clienteCodigo,
         $Equipos->equipoUltimaUbicacionFecha,
         $Equipos->equipoUltimaUbicacionLatitud,
         $Equipos->equipoUltimaUbicacionLongitud,
         $Equipos->equipoEstado,
        );
        $objPHPExcel = $objPHPExcel->agregar_fila_sinindices($objPHPExcel, $valoresEquiposEncontrados,
                                                             ++$filaEquiposEncontrados, 2);
      }
    }


    if(!is_null($ClientesEncontrados)) {
      $filaClientesEncontrados = 1;
      $filaReferenciasClientesEncontrados = 1;
      $objPHPExcel->createSheet(2);
      $objPHPExcel->setActiveSheetIndex(2);
      $objPHPExcel->getActiveSheet()->setTitle('Clientes Registrados');
      $objPHPExcel = $objPHPExcel->agregar_encabezados_sinindices($objPHPExcel, self::$encabezadosClientesRegistrados, 2);
      $objPHPExcel->createSheet(3);
      $objPHPExcel->setActiveSheetIndex(3);
      $objPHPExcel->getActiveSheet()->setTitle('Referencias de Clientes');
      $objPHPExcel = $objPHPExcel->agregar_encabezados_sinindices($objPHPExcel,
                                                                  self::$encabezadosReferenciasClientesRegistrados, 3);


      foreach($ClientesEncontrados as $Cliente) {
        $valoresEquiposEncontrados = array(
         $Cliente->tipoClienteTitulo,
         $Cliente->clienteCodigo,
         $Cliente->clienteCreado,
         $Cliente->tipoIdentificacionCodigo,
         $Cliente->personaIdentificacion,
         $Cliente->personaRazonSocial,
         $Cliente->personaNombres,
         $Cliente->personaApellidos,
         $Cliente->personaDireccion,
         $Cliente->personaTelefono,
         $Cliente->personaCelular,
         $Cliente->personaCorreoElectronico,
         count($Cliente->Contactos),
         $Cliente->personaObservaciones,
        );
        $objPHPExcel = $objPHPExcel->agregar_fila_sinindices($objPHPExcel, $valoresEquiposEncontrados,
                                                             ++$filaClientesEncontrados, 2);
        if(count($Cliente->Contactos)) {
          foreach($Cliente->Contactos as $Contacto) {
            $valoresEquiposEncontrados = array(
             $Contacto->clienteCodigo,
             $Contacto->clienteContactoEtiquetas,
             $Contacto->tipoIdentificacionCodigo,
             $Contacto->personaIdentificacion,
             $Contacto->personaRazonSocial,
             $Contacto->personaNombres,
             $Contacto->personaApellidos,
             $Contacto->personaDireccion,
             $Contacto->personaTelefono,
             $Contacto->personaCelular,
             $Contacto->personaCorreoElectronico,
             $Contacto->clienteContactoRecibeEquipos,
             $Contacto->clienteContactoRecibeDeposito,
             $Contacto->personaObservaciones,
            );
            $objPHPExcel = $objPHPExcel->agregar_fila_sinindices($objPHPExcel, $valoresEquiposEncontrados,
                                                                 ++$filaReferenciasClientesEncontrados, 3);
          }
        }
      }
    }


    $nombreArchivo = uniqid('serv-' . $fechaGenerado . '-') . '.xls';
    $rutaArchivo = PATH_ARCHIVOS . "exportar" . DS . "servicios" . DS;
    $urlArchivo = URL_ARCHIVOS . "exportar" . WS . "servicios" . WS;
    Archivos::probar_crear_directorio($rutaArchivo);
    try {
      $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel5");
      $guardo = $objWriter->save($rutaArchivo . $nombreArchivo);
      echo Respuestas::JSON('EXITO', $urlArchivo . $nombreArchivo);
    } catch(Exception $exc) {
      echo Respuestas::JSON(
       'ERROR',
       AlertasHTML5::error(
        'No se pudo GENERAR el archivo con los registros consultados. <hr  />' . $exc->getTraceAsString()
       )
      );
    }
  }

}
