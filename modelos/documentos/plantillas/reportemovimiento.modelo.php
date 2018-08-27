<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

Modelos::cargar('Documentos' . DS . 'Documentos');
Modelos::cargar('Documentos' . DS . 'Plantillas' . DS . 'RecibosA4');

class ReporteMovimientos {

    static function deClientesXLS($fechasInicial, $fechasFinal, $Clientes) {

        $dirArchivo = PATH_ARCHIVOS . 'reportes' . DS . 'movimientos' . DS;
        $urlArchivo = URL_ARCHIVOS . 'reportes' . WS . 'movimientos' . WS;
        $archivo = "reporte-xls-" . uniqid();

        $html = '<?php '
                . 'header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8");    '
                . 'header("Content-Disposition: attachment; filename=' . $archivo . '.xls");  '
                . 'header("Expires: 0");    '
                . 'header("Cache-Control: max-age=0"); '
                . 'header("Cache-Control: must-revalidate, post-check=0, pre-check=0");   '
                . 'header("Cache-Control: private", false);    '
                . 'echo \'';
        $html .= '<table>'
                . '<tr><td style=" font-size: 200%; color: #5e9ca0; text-align: center; margin: 0px; padding: 0px;">Reporte de Movimientos</td></tr>'
                . '<tr><td style=" font-size: 100%; color: #2e6c80; text-align: center; margin: 0px;  padding: 0px;">entre ' . $fechasInicial . ' y ' . $fechasFinal . '</td></tr>'
                . '</table>'
                . '';
        $html .= self::tablaReporte($Clientes);
        $html .= '\'; ';
        $html .= 'unlink("' . $dirArchivo . $archivo . ".php" . '");';

        Archivos::escribir_en_archivo($dirArchivo . $archivo . ".php", $html);
        return $urlArchivo . $archivo . ".php";
    }

    static function deClientesPDF($fechasInicial, $fechasFinal, $Clientes) {

        $documentoCodigo = uniqid();
        $documentoTipo = 1;
        $documentoTitulo = 'Reporte de Movimientos #' . $documentoCodigo;
        $nombreArchivo = $fechasInicial . '_' . $fechasFinal . ".pdf";
        $dirArchivo = PATH_ARCHIVOS . 'reportes' . DS . 'movimientos' . DS;
        Archivos::probar_crear_directorio($dirArchivo);
        $urlArchivo = URL_ARCHIVOS . 'reportes' . WS . 'movimientos' . WS;



        $pdf = new RecibosA4();
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Params::valor('siglas_sistema'));
        $pdf->SetTitle($documentoTitulo);
        $pdf->SetSubject('Reporte de Movimiento de Equipos por Clientes.');
        $pdf->SetKeywords('Reportes, Recibo, Equipos, Entrega, Recoleccion ');

        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1,
            'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        $html = '<div><span style=" font-size: 200%; color: #5e9ca0; text-align: center; margin: 0px; padding: 0px;">Reporte de Movimientos</span>'
                . '<br/>'
                . '<span style=" font-size: 100%; color: #2e6c80; text-align: center; margin: 0px;  padding: 0px;">entre ' . $fechasInicial . ' y ' . $fechasFinal . '</span></div>'
                . '<br/>';

        $html .= self::tablaReporte($Clientes);

        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
        $pdf->Output($dirArchivo . $nombreArchivo, 'F');
        return $urlArchivo . $nombreArchivo;
    }

    static function tablaReporte($Clientes) {
        $html = '<table border="1" cellpadding="2" style="margin-left: auto; margin-right: auto; border: black thin solid;">'
                . '<thead>'
                . '<tr style="color: #000000; background-color: #DDD; text-align: center;  font-size: 80%; font-weight: bold;" >'
                . '<th width="15%" rowspan="2" valign="middle" >Identificación</th>'
                . '<th width="35%" rowspan="2" valign="middle" >Nombre / Razón Social</th>'
                . '<th width="10%" rowspan="2" valign="middle" >Recibos o servicios</th>'
                . '<th width="20%" colspan="2" valign="middle" >Equipos</th>'
                . '<th width="20%" colspan="2" valign="middle" >Depositos</th>'
                . '</tr>'
                . '<tr style="color: #000000; background-color: #EEE; text-align: center;  font-size: 70%;" >'
                . '<th width="10%">Se le entregarón</th>'
                . '<th width="10%">Se recogierón</th>'
                //. '<th width="10%">Hoy tiene</th>'
                . '<th width="5%">Cant</th>'
                . '<th width="15%">Valor</th>'
                . '</tr>'
                . '</thead>'
                . '<tbody>';

        $ttlRecibos = 0;
        $ttlEnServicio = 0;
        $ttlRecogidos = 0;
        $ttlDepositos = 0;
        $ttlValorDepositos = 0;
        foreach ($Clientes as $indice => $objCLiente) {
            $html .= '<tr style="color: #000000; text-align: center; font-size: 80%; "  >'
                    . '<td width="15%">' . $objCLiente->personaIdentificacion . '</td>'
                    . '<td width="35%">' . $objCLiente->personaRazonSocial . '</td>'
                    . '<td width="10%">' . $objCLiente->NUM_RECIBOS . '</td>'
                    . '<td width="10%" style="color: #000000; background-color: #DDD; text-align: center;" >' . $objCLiente->NUM_ENSERVICIO . '</td>'
                    . '<td width="10%">' . $objCLiente->NUM_RECOGIDOS . '</td>'
                    . '<td width="5%">' . $objCLiente->NUM_DEPOSITOS . '</td>'
                    . '<td width="15%">$' . number_format($objCLiente->VAL_DEPOSITOS, 0, ",", ".") . '</td>'
                    . '</tr>';
            $ttlRecibos += $objCLiente->NUM_RECIBOS;
            $ttlEnServicio += $objCLiente->NUM_ENSERVICIO;
            $ttlRecogidos += $objCLiente->NUM_RECOGIDOS;
            $ttlDepositos += $objCLiente->NUM_DEPOSITOS;
            $ttlValorDepositos += $objCLiente->VAL_DEPOSITOS;
//      if($indice == 50) break;
        }

        $html .= '</tbody>';
        $html .= '<tfoot><tr style="color: #000000; background-color: #EEE; text-align: center; font-size: 100%; font-weight: bold;" >'
                . '<th width="15%" ></th>'
                . '<th width="35%" >Totales</th>'
                . '<th width="10%">' . $ttlRecibos . '</th>'
                . '<th width="10%">' . $ttlEnServicio . '</th>'
                . '<th width="10%">' . $ttlRecogidos . '</th>'
                . '<th width="5%">' . $ttlDepositos . '</th>'
                . '<th width="15%">$' . number_format($ttlValorDepositos, 0, ",", ".") . '</th>'
                . '</tr></tfoot>';

        $html .= '</table>';


        return $html;
    }

    static function deReferenciasXLS($fechasInicial, $fechasFinal, $Clientes) {

        $dirArchivo = PATH_ARCHIVOS . 'reportes' . DS . 'movimientos' . DS;
        $urlArchivo = URL_ARCHIVOS . 'reportes' . WS . 'movimientos' . WS;
        $archivo = "reporte-xls-" . uniqid();

        $html = '<?php '
                . 'header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8");    '
                . 'header("Content-Disposition: attachment; filename=' . $archivo . '.xls");  '
                . 'header("Expires: 0");    '
                . 'header("Cache-Control: must-revalidate, post-check=0, pre-check=0");   '
                . 'header("Cache-Control: private", false);    '
                . 'echo \'';
        $html .= '<table>'
                . '<tr><td style=" font-size: 200%; color: #5e9ca0; text-align: center; margin: 0px; padding: 0px;">Reporte de Movimientos</td></tr>'
                . '<tr><td style=" font-size: 100%; color: #2e6c80; text-align: center; margin: 0px;  padding: 0px;">entre ' . $fechasInicial . ' y ' . $fechasFinal . '</td></tr>'
                . '</table>'
                . '';
        $html .= self::tablaCliente($Clientes);
        $html .= '\'; ';
        $html .= 'unlink("' . $dirArchivo . $archivo . ".php" . '");';

        Archivos::escribir_en_archivo($dirArchivo . $archivo . ".php", $html);
        return $urlArchivo . $archivo . ".php";
    }

    static function deReferenciasPDF($fechasInicial, $fechasFinal, $Clientes) {

        $documentoCodigo = uniqid();
        $documentoTipo = 1;
        $documentoTitulo = 'Reporte de Movimientos #' . $documentoCodigo;
        $nombreArchivo = $fechasInicial . '_' . $fechasFinal . ".pdf";
        $dirArchivo = PATH_ARCHIVOS . 'reportes' . DS . 'movimientos' . DS;
        Archivos::probar_crear_directorio($dirArchivo);
        $urlArchivo = URL_ARCHIVOS . 'reportes' . WS . 'movimientos' . WS;



        $pdf = new RecibosA4();
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Params::valor('siglas_sistema'));
        $pdf->SetTitle($documentoTitulo);
        $pdf->SetSubject('Reporte de Movimiento de Equipos por Clientes.');
        $pdf->SetKeywords('Reportes, Recibo, Equipos, Entrega, Recoleccion ');

        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1,
            'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        $html = '<div><span style=" font-size: 200%; color: #5e9ca0; text-align: center; margin: 0px; padding: 0px;">Reporte de Movimientos</span>'
                . '<br/>'
                . '<span style=" font-size: 100%; color: #2e6c80; text-align: center; margin: 0px;  padding: 0px;">entre ' . $fechasInicial . ' y ' . $fechasFinal . '</span></div>'
                . '<br/>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        $html = self::tablaCliente($Clientes, $pdf);

        $pdf->Output($dirArchivo . $nombreArchivo, 'F');
        return $urlArchivo . $nombreArchivo;
    }

    static function tablaCliente($Clientes, $pdf = null) {

        $htmlreturn = "";
        $ttlRecibos = 0;
        $ttlEnServicio = 0;
        $ttlRecogidos = 0;
        $ttlDepositos = 0;
        $ttlValorDepositos = 0;
        foreach ($Clientes as $indice => $objCLiente) {
            $htmlreturn .= $html = '<table border="1" style="margin-left: auto; margin-right: auto; border: black thin solid;"> '
                    . '<tr> <th colspan="2" style="color: #000000; background-color: #DDD; text-align: center;">COD: ' . $objCLiente->clienteCodigo . '</th> <th colspan="4" ></th>  </tr> '
                    . '<tr> <td rowspan="3"><img src="' . $objCLiente->personaLogo . '" style="width: 42px; height: 42px;" /></td> <td style="color: #000000; background-color: #DDD; text-align: center;">Nombre</td> <td colspan="4" >' . $objCLiente->personaRazonSocial . '</td> </tr> '
                    . '<tr> <td style="color: #000000; background-color: #DDD; text-align: center;">C.C. / NIT</td> <td>' . $objCLiente->personaIdentificacion . '</td> <td style="color: #000000; background-color: #DDD; text-align: center;" >Tels.</td> <td  colspan="2" >' . $objCLiente->personaTelefono . '/' . $objCLiente->personaCelular . '</td> </tr> '
                    . '<tr> <td style="color: #000000; background-color: #DDD; text-align: center;">Correo</td> <td colspan="4">' . $objCLiente->personaCorreoElectronico . '</td> <td></td> </tr> '
                    . '<tr> <td style="color: #000000; background-color: #DDD; text-align: center;">Dirección</td> <td colspan="5">' . $objCLiente->personaDireccion . '</td> <td></td> </tr> '
                    . '</table>';
            if (!is_null($pdf))
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $htmlreturn .= $html = ''
                    . '<table width="100%"  align="center" border="1" style="border: black thin solid;">'
                    . '<thead>'
                    . '<tr style="color: #000000; background-color: #DDD; text-align: center;" >'
                    . '<th width="20%" valign="middle" >Servicios Prestados</th>'
                    . '<th width="20%" valign="middle" >Equipos En Servicio</th>'
                    . '<th width="20%" valign="middle" >Equipos Recogidos</th>'
                    . '<th width="20%" valign="middle" >Cant de Depositos</th>'
                    . '<th width="20%" valign="middle" >Valor en Depositos</th>'
                    . '</tr>'
                    . '</thead>'
                    . '<tbody>'
                    . '<tr >'
                    . '<td width="20%">' . $objCLiente->NUM_RECIBOS . '</td>'
                    . '<td width="20%" style="color: #000000; background-color: #DDD; text-align: center;" >' . $objCLiente->NUM_ENSERVICIO . '</td>'
                    . '<td width="20%">' . $objCLiente->NUM_RECOGIDOS . '</td>'
                    . '<td width="20%">' . $objCLiente->NUM_DEPOSITOS . '</td>'
                    . '<td width="20%">$' . number_format($objCLiente->VAL_DEPOSITOS, 0, ",", ".") . '</td>'
                    . '</tr>'
                    . '</tbody></table>';
            if (!is_null($pdf))
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            $htmlreferencia = "";
            if (count($objCLiente->Referencias)) {
                $htmlreferencia .= '<div style="color: #000000; background-color: #EEE; text-align: center; font-size: 120%; font-weight: bold;" >Contactos o Referencias</div>';
                $htmlreferencia .= self::tablaReporte($objCLiente->Referencias);
            } else {
                $htmlreferencia .= '<div style="color: #000000; background-color: #EEE; text-align: center; font-size: 120%; font-weight: bold;" >No tiene Contactos o Referencias</div>';
            }
            $htmlreturn .= $htmlreferencia .= '<br /><br />';
            if (!is_null($pdf))
                $pdf->writeHTMLCell(0, 0, '', '', $htmlreferencia, 0, 1, 0, true, '', true);

            $ttlRecibos += $objCLiente->NUM_RECIBOS;
            $ttlEnServicio += $objCLiente->NUM_ENSERVICIO;
            $ttlRecogidos += $objCLiente->NUM_RECOGIDOS;
            $ttlDepositos += $objCLiente->NUM_DEPOSITOS;
            $ttlValorDepositos += $objCLiente->VAL_DEPOSITOS;
            //if($indice == 10) break;
        }
        return $htmlreturn;
    }

    static function deEquiposXLS($fechasInicial, $fechasFinal, $Equipos) {

        $dirArchivo = PATH_ARCHIVOS . 'reportes' . DS . 'movimientos' . DS;
        $urlArchivo = URL_ARCHIVOS . 'reportes' . WS . 'movimientos' . WS;
        $archivo = "reporte-xls-" . uniqid();

        $html = '<?php '
                . 'header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8");    '
                . 'header("Content-Disposition: attachment; filename=' . $archivo . '.xls");  '
                . 'header("Expires: 0");    '
                . 'header("Cache-Control: must-revalidate, post-check=0, pre-check=0");   '
                . 'header("Cache-Control: private", false);    '
                . 'echo \'';
        $html .= '<table>'
                . '<tr><td style=" font-size: 200%; color: #5e9ca0; text-align: center; margin: 0px; padding: 0px;">Reporte de Movimientos</td></tr>'
                . '<tr><td style=" font-size: 100%; color: #2e6c80; text-align: center; margin: 0px;  padding: 0px;">entre ' . $fechasInicial . ' y ' . $fechasFinal . '</td></tr>'
                . '</table>'
                . '';
        $html .= self::tablaEquipos($Equipos);
        $html .= '\'; ';
        $html .= 'unlink("' . $dirArchivo . $archivo . ".php" . '");';

        Archivos::escribir_en_archivo($dirArchivo . $archivo . ".php", $html);
        return $urlArchivo . $archivo . ".php";
    }

    static function deEquiposPDF($fechasInicial, $fechasFinal, $Equipos) {

        $documentoCodigo = uniqid();
        $documentoTipo = 1;
        $documentoTitulo = 'Reporte de Movimientos #' . $documentoCodigo;
        $nombreArchivo = $fechasInicial . '_' . $fechasFinal . ".pdf";
        $dirArchivo = PATH_ARCHIVOS . 'reportes' . DS . 'movimientos' . DS;
        Archivos::probar_crear_directorio($dirArchivo);
        $urlArchivo = URL_ARCHIVOS . 'reportes' . WS . 'movimientos' . WS;



        $pdf = new RecibosA4();
// set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(Params::valor('siglas_sistema'));
        $pdf->SetTitle($documentoTitulo);
        $pdf->SetSubject('Reporte de Movimiento por cada Equipos.');
        $pdf->SetKeywords('Reportes, Recibo, Equipos, Entrega, Recoleccion ');

        $pdf->SetFont('dejavusans', '', 7, '', true);
        $pdf->AddPage();
        $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.1, 'depth_h' => 0.1,
            'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));


        $html = '<div><span style=" font-size: 200%; color: #5e9ca0; text-align: center; margin: 0px; padding: 0px;">Reporte de Movimientos por Equipos</span>'
                . '<br/>'
                . '<span style=" font-size: 100%; color: #2e6c80; text-align: center; margin: 0px;  padding: 0px;">entre ' . $fechasInicial . ' y ' . $fechasFinal . '</span></div>'
                . '<br/>';
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);


        set_time_limit(18000);

        $html = self::tablaEquipos($Equipos, $pdf);
        //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        set_time_limit(18000);
        $pdf->Output($dirArchivo . $nombreArchivo, 'F');
        return $urlArchivo . $nombreArchivo;
    }

    static function tablaEquipos($Equipos, $pdf = null) {

        //print_r($Equipos);
        $htmlreturn = "";
        $ttlRecibos = 0;
        $ttlEnServicio = 0;
        $ttlRecogidos = 0;
        $ttlDepositos = 0;
        $ttlValorDepositos = 0;
        foreach ($Equipos as $indice => $objEquipo) {
            $htmlreturn .= $html = '<table border="1" cellpadding="3" >'
                    . '<tr>'
                    . '<td width="20%" colspan="2" style="font-weight:bold;">Tipo de Equipo</td>'
                    . '<td width="80%" colspan="4" >' . $objEquipo->tipoEquipoTitulo . '</td>'
                    . '</tr>'
                    . '<tr>'
                    . '<td width="7%" style="font-weight:bold;">Código</td>'
                    . '<td width="13%" >' . $objEquipo->equipoCodigo . '</td>'
                    . '<td width="10%" style="font-weight:bold;">Serial #</td>'
                    . '<td width="40%">' . $objEquipo->equipoSerial . '</td>'
                    . '<td width="10%"  style="font-weight:bold;">Cap.</td>'
                    . '<td width="20%">' . $objEquipo->equipoCapacidad . '</td>'
                    . '</tr>'
                    . '<tr>'
                    . '<td colspan="2" style="font-weight:bold;">Nombre</td>'
                    . '<td colspan="2" >' . $objEquipo->equipoTitulo . '</td>'
                    . '<td style="font-weight:bold;">Estado Actual:</td>'
                    . '<td>' . $objEquipo->equipoEstadoTitulo . '</td>'
                    . '</tr>'
                    . '</table>';
            if (!is_null($pdf))
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
            //$html .= '<hr style="margin: 10px;color:#000;" />';
            $htmlreturn .= $html = '<table border="1" cellpadding="3" >'
                    . '<tr style="text-align:center;" >'
                    . '<td width="20%" style="font-weight:bold;" >Total de Servicios</td>'
                    . '<td width="5%" style="font-size:150%;" >' . $objEquipo->NUM_SERVICIOS . '</td>'
                    . '<td width="10%" style="font-weight:bold;" >En Servicio</td>'
                    . '<td width="5%" style="font-size:150%;">' . $objEquipo->NUM_ENSERVICIO . '</td>'
                    . '<td width="10%" style="font-weight:bold;" >Recogidas</td>'
                    . '<td width="5%" style="font-size:150%;">' . $objEquipo->NUM_RECOGIDOS . '</td>'
                    . '<td width="10%" style="font-weight:bold;" >Devueltos</td>'
                    . '<td width="5%" style="font-size:150%;">' . $objEquipo->NUM_DEVUELTO . '</td>'
                    . '<td width="10%" style="font-weight:bold;" >Perdidos</td>'
                    . '<td width="5%" style="font-size:150%;">' . $objEquipo->NUM_PERDIDA . '</td>'
                    . '<td width="10%" style="font-weight:bold;" >Con Deposito</td>'
                    . '<td width="5%" style="font-size:150%;">' . $objEquipo->NUM_DEPOSITOS . '</td>'
                    . '</tr>'
                    . '</table>';
            if (!is_null($pdf))
                $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

            if (count($objEquipo->Movimientos)) {
                $htmlLog = '<table cellpadding="3" style="text-align:center;" ><tbody>';
                $htmlLog .= '<tr style="font-weight:bold;" ><td border="1" colspan="5">Movimientos del Equipo</td></tr>';
                $htmlLog .= '<tr style="font-weight:bold;" >'
                        . '<td width="15%" border="1" >fecha</td>'
                        . '<td width="10%" border="1" >sentido</td>'
                        . '<td width="10%" border="1" >recibo</td>'
                        . '<td width="35%" border="1" >Cliente</td>'
                        . '<td width="20%" border="1" >Referencia</td>'
                        . '<td width="10%" border="1" ></td></tr>';
                foreach ($objEquipo->Movimientos as $objMovimiento) {
                    $htmlLog .= '<tr  style="font-size: 80%;" ><td>'
                            . $objMovimiento->reciboFechaServicio
                            . '</td><td>'
                            . $objMovimiento->movimientoCodigo
                            . '</td><td>'
                            . $objMovimiento->reciboNumero
                            . '</td><td>'
                            . $objMovimiento->personaIdentificacion . " - " . $objMovimiento->personaRazonSocial
                            . '</td><td>'
                            . $objMovimiento->referenciaRazonSocial
                            . '</td><td>'
                            . $objMovimiento->clienteContactoEtiquetas
                            . '</td></tr>';
                }
                $htmlreturn .= $htmlLog .= '</tbody></table>';
            } else {
                $htmlreturn .= $htmlLog = '<table cellspacing="3" ><tbody>'
                        . '<tr><td>NO HAY MOVIMIENTOS REGISTRADOS PARA ESTE EQUIPO DURANTE EL PERIODO CONSULTADO</td></tr>'
                        . '</tbody></table>';
            }

            if (!is_null($pdf))
                $pdf->writeHTMLCell(0, 0, '', '', $htmlLog, 0, 1, 0, true, '', true);
            //$html .= '</br>';
            //$html .= '<hr style="margin: 10px;color:#000;" />';
            //$html .= '</br>';
        }

        return $htmlreturn;
    }

}
