<?php

Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Equipos' . DS . 'Catalogo');

class equiposControlador extends Controladores {

  function mostrarTodos() {
    self::$datos['Equipos'] = Equipos::todos_listado();
    Vistas::mostrar('equipos' . DS . 'listado', self::$datos);
  }

  function nuevo() {
    $this->mostrarFormulario();
  }

  function editar() {
    self::$datos['datosEquipo'] = Equipos::datos(self::$datos['registro_equipo']);
    $this->mostrarFormulario();
  }

  function guardarCambios() {

    self::$datos['capacidad_equipo'] = str_replace("_", "", self::$datos['capacidad_equipo']);

    if(isset(self::$datos['registro_equipo']) and ! empty(self::$datos['registro_equipo'])) {
      $cambio = Equipos::actualizar(
        self::$datos['registro_equipo'], self::$datos['tipo_equipo'], self::$datos['codigo_equipo'],
        self::$datos['serial_equipo'], self::$datos['titulo_equipo'], self::$datos['capacidad_equipo'],
        self::$datos['qrcode_equipo'], self::$datos['barcode_equipo'], self::$datos['desc_equipo']);
      if($cambio) {
        Mensajes::operacion('EXITO',
                            'Se han actualizado correctamente los datos asociados al <strong>EQUIPO</strong> [' . self::$datos['codigo_equipo'] . '] <strong>' . self::$datos['titulo_equipo'] . '</strong>.');
      } else {
        Mensajes::operacion('ERROR',
                            'NO Se han actualizado los datos asociados al <strong>EQUIPO</strong> [' . self::$datos['codigo_equipo'] . '] <strong>' . self::$datos['titulo_equipo'] . '</strong>.<br />' . '<strong>Verifique que haya hecho algún cambio en los datos e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
      }
    } else {
      self::$datos['registro_equipo'] = Equipos::insertar(
        self::$datos['tipo_equipo'], self::$datos['codigo_equipo'], self::$datos['serial_equipo'],
        self::$datos['titulo_equipo'], self::$datos['capacidad_equipo'], self::$datos['qrcode_equipo'],
        self::$datos['barcode_equipo'], self::$datos['desc_equipo']
      );
      if(!is_null(self::$datos['registro_equipo'])) {
        Mensajes::operacion('EXITO',
                            'Se ha creado correctamente un nuevo <strong>EQUIPO</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo_equipo'] . '</strong>] ' . self::$datos['titulo_equipo'] . '.');
      } else {
        Mensajes::operacion(
         'ERROR',
         'NO Se ha creado el nuevo <strong>EQUIPO</strong>, ' . 'identificado por [<strong>' . self::$datos['codigo_equipo'] . '</strong>] ' . self::$datos['titulo_equipo'] . '.<br />' . '<strong>Verifique que el CODIGO no se haya usado anteriormente e intentelo nuevamente.</strong> <br />' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>');
      }
    }
    $this->editar();
  }

  function mostrarFormulario() {
    self::$datos['tiposEquipos'] = TiposEquipos::todos();
    Vistas::mostrar('equipos' . DS . 'formulario', self::$datos);
  }

  function borrar() {
    if(isset(self::$datos['registro_equipo']) and ! empty(self::$datos['registro_equipo'])) {
      $objEquipo = Equipos::datos(self::$datos['registro_equipo']);
      $cambio = Equipos::desactivar(self::$datos['registro_equipo']);
      if($cambio) {
        Mensajes::operacion('EXITO',
                            'Se han eliminado correctamente los datos asociados al '
         . '<strong>EQUIPO</strong> [' . $objEquipo->equipoCodigo . '] <strong>' . $objEquipo->equipoTitulo . '</strong>. '
        );
      } else {
        Mensajes::operacion('ERROR',
                            'NO Se han eliminado correctamente los datos asociados al '
         . '<strong>EQUIPO</strong> [' . $objEquipo->equipoCodigo . '] <strong>' . $objEquipo->equipoTitulo . '</strong>. '
         . '<strong>Intentelo nuevamente.</strong> <br />'
         . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
        );
      }
    }
    $this->mostrarTodos();
  }

  function ultimaUbicacion() {
    self::$datos['datosEquipo'] = Equipos::datos(self::$datos['registro_equipo']);
    Vistas::mostrar('equipo', self::$datos, 'ubicaciones');
  }

  function codigosDelEquipo() {
    self::$datos['datosEquipo'] = Equipos::datos(self::$datos['registro_equipo']);
    echo '<a href="' . (!is_null(self::$datos['datosEquipo']->equipoUrlQR) ? self::$datos['datosEquipo']->equipoUrlQR : "/archivos/oximeiser/img/qr_code.png" ) . '" target="_blank"><img id="img-codigoQR" src="' . (!is_null(self::$datos['datosEquipo']->equipoUrlQR) ? self::$datos['datosEquipo']->equipoUrlQR : "/archivos/oximeiser/img/qr_code.png" ) . '" style="max-width: 100%; " /></a>';
    echo '<a href="' . (!is_null(self::$datos['datosEquipo']->equipoUrlBARRAS) ? self::$datos['datosEquipo']->equipoUrlBARRAS : "/archivos/oximeiser/img/bar_code.png") . '" target="_blank" ><img id="img-codigobarras" src="' . (!is_null(self::$datos['datosEquipo']->equipoUrlBARRAS) ? self::$datos['datosEquipo']->equipoUrlBARRAS : "/archivos/oximeiser/img/bar_code.png") . '" style="max-width: 100%; " /></a>';
  }

  function cambiarDisponibilidad() {
    if(isset(self::$datos['registro_equipo']) and ! empty(self::$datos['registro_equipo'])) {
      switch(self::$datos['estado_equipo']) {
        case 1: Equipos::cambiarEstadoServicioEquipo(self::$datos['registro_equipo'], 3);
          break;
        case 3: Equipos::cambiarEstadoServicioEquipo(self::$datos['registro_equipo'], 1);
          break;
        case 4: Equipos::cambiarEstadoServicioEquipo(self::$datos['registro_equipo'], 1);
          break;
      }
    }
    self::$datos['Equipos'] = Equipos::todos_listado();
    Vistas::mostrar('equipos' . DS . 'listado', self::$datos);
  }

  function catalogo() {
    self::$datos['Equipos'] = Equipos::todos_listado();

    $nombreArchivo = "catalogo-" . uniqid() . ".pdf";
    $dirArchivo = PATH_ARCHIVOS . 'equipos' . DS . 'catalogos' . DS;
    Archivos::probar_crear_directorio($dirArchivo);
    $urlArchivo = URL_ARCHIVOS . 'equipos' . WS . 'catalogos' . WS;


    $documentoCodigo = uniqid();
    $documentoTipo = 1;
    $documentoTitulo = 'Catalogo de Equipos - ' . date('Y-m-d');

    $pdf = new Catalogo();
// set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor(Params::valor('siglas_sistema'));
    $pdf->SetTitle($documentoTitulo);
    $pdf->SetSubject('Todos los seriales y codigos de barras y QR de Equipos.');
    $pdf->SetKeywords(' Equipos, Codigos, QR, Barras, detalles, ' . Visitante::nombreUsuario() . '  ');

    $pdf->SetFont('dejavusans', '', 6, '', true);
    $pdf->AddPage();

    $filaTablaCabeza = '<table align="center" cellpadding="0" cellspacing="2" style="width: 100%;"><tr>';
    $pdf->writeHTML($filaTablaCabeza);
    $filaTablaPie = '</tr></table>';
    $celdaFila = 1;
    $filaCompleta = "";
    foreach(self::$datos['Equipos'] as $indice => $Equipos) {
      if(is_null($Equipos->equipoUrlBARRAS) OR is_null($Equipos->equipoUrlQR)) continue;
      $detEquipo = <<<detEquipo
              <div style="border: thin solid black; padding:0px; margin:2px;" >
              <table border="0" cellpadding="0" align="center" style="width: 100%; ">	
		<tr> 
			<td colspan="2" style="text-align: center; ">                            
                            <img alt="" src="$Equipos->equipoUrlBARRAS" style=" height: 50px; width: 140px; " /> 
			</td>
		</tr>
		<tr>
                  <td style="text-align: center; width: 55%;padding:5px;">  
			SN: <strong>$Equipos->equipoSerial</strong><br />
			$Equipos->equipoTitulo<br />
			$Equipos->equipoCodigo<br />
			<strong>$Equipos->tipoEquipoCodigo</strong> - <strong>$Equipos->equipoCapacidad</strong>
                  </td>
                  <td  style="text-align: center;width: 45%;" ><img alt="" src="$Equipos->equipoUrlQR" style=" height: 60px;" /></td>
		</tr>                
              </table>       
            </div>
detEquipo;

      switch($celdaFila) {
        case 1:
          $filaCompleta = "";
          $fila = $filaTablaCabeza . "<td>" . $detEquipo . "</td>";
          $filaCompleta .= $fila;
          $celdaFila = 2;
          break;
        case 2:
          $fila = "<td>" . $detEquipo . "</td>";
          $filaCompleta .= $fila;
          $celdaFila = 3;
          break;
        case 3:
          $fila = "<td>" . $detEquipo . "</td>";
          $filaCompleta .= $fila;
          $celdaFila = 4;
          break;
        case 4:
          $fila = "<td>" . $detEquipo . "</td>" . $filaTablaPie;
          $filaCompleta .= $fila;
          $pdf->writeHTML($filaCompleta);
          $filaCompleta = "";
          $celdaFila = 1;
          break;
      }

      if((count(self::$datos['Equipos']) == ($indice + 1)) and ( $celdaFila != 1)) {
        $fila = "<td></td>" . $filaTablaPie;
        $filaCompleta .= $fila;
        $pdf->writeHTML($filaCompleta);
      }
    }

// ---------------------------------------------------------
// Close and output PDF document
// This method has several options, check the source code documentation for more information.
    $pdf->Output($dirArchivo . $nombreArchivo, 'F');

    echo $urlArchivo . $nombreArchivo;
  }

}
