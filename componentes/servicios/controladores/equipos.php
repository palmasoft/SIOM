<?php

Modelos::cargar('Sistema' . DS . 'Mensajes');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Personas' . DS . 'ClientesContactos');
Modelos::cargar('Equipos' . DS . 'Equipos');

Modelos::cargar('Servicios' . DS . 'Servicios');
Modelos::cargar('Servicios' . DS . 'RecibosServicios');
Modelos::cargar('Servicios' . DS . 'ReciboEquipos');
Modelos::cargar('Servicios' . DS . 'ReciboDepositos');
Modelos::cargar('Servicios' . DS . 'ReciboControlCambios');
Modelos::cargar('Servicios' . DS . 'TiposDepositos');
Modelos::cargar('Servicios' . DS . 'TiposMotivos');
Modelos::cargar('Documentos' . DS . 'TiposDocumentos');
Modelos::cargar('Documentos' . DS . 'Documentos');
Modelos::cargar('Documentos' . DS . 'Plantillas' . DS . 'ReciboArriendoEquipo');
Modelos::cargar('Documentos' . DS . 'Plantillas' . DS . 'ReciboDepositoEquipo');

Modelos::cargar('Correos' . DS . 'CorreosServiciosEquipos');

class equiposControlador extends Controladores {

    function nuevoFilaTabla() {
        self::$datos['ReciboEquipo'] = Equipos::datos_completos(self::$datos['registro_equipo']);
        switch (self::$datos['movimiento']) {
            case 'entregado':
                self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-success' >ENTREGADO</span>";
                break;
            case 'buen_estado':
                self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-info' >RECIBIDO</span>";
                break;
            case 'perdido':
                self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-danger' >PERDIDO</span>";
                break;
            case 'devuelto':
                self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-warning' >DEVUELTO</span>";
                break;
            default:
                break;
        }
        self::$datos['ReciboEquipo']->reciboEquipoMovimiento = self::$datos['movimiento'];
        Vistas::cargar('equipos' . DS . 'fila-tabla-recibo', self::$datos);
    }

    function mostrarTodos() {
        self::$datos['RecibosServiciosEquipos'] = Servicios::listado();
        Vistas::mostrar('equipos' . DS . 'listado', self::$datos);
    }

    function nuevo() {
        self::$datos['Referencias'] = array();
        $this->mostrarFormulario();
    }

    function editar() {
        self::$datos['datosDelServicios'] = $this->datosDelServicio(self::$datos['registro_servicio']);
        self::$datos['Referencias'] = ClientesContactos::datosPorClientes(self::$datos['datosDelServicios']->reciboCliente);
        self::$datos['RazonesModificacion'] = TiposMotivos::todos();
        //print_r(self::$datos['Referencias']);
        $this->mostrarFormulario();
    }

    function guardarNuevoReciboMovil() {
        $this->crearNuevoServicioConSoporte();
    }

    function guardarCambios() {
        //print_r(self::$datos);
        if (isset(self::$datos['registro_servicio']) and ! empty(self::$datos['registro_servicio'])) {
            $this->registrarCambiosServicio();
        } else {
            $this->crearNuevoServicioConSoporte();
        }
    }

    function registrarCambiosServicio() {
        $datosAntes = $this->datosDelServicio(self::$datos['registro_servicio']);
        $this->modificarServicio(self::$datos['registro_servicio']);
        $datosDespues = $this->datosDelServicio(self::$datos['registro_servicio']);
        $idCambio = ReciboControlCambios::insertar(
                        $datosAntes->servicioId, self::$datos['rd_razonmodifica'], self::$datos['razones_modificacion'], json_encode($datosAntes, JSON_PRETTY_PRINT), json_encode($datosDespues, JSON_PRETTY_PRINT)
        );
        if (!is_null($idCambio)) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>REGISTRADO EL CAMBIO</strong> en el servicio ' . $datosDespues->servicioCodigo . ' con <strong>RECIBO #' . $datosDespues->reciboNumero . '</strong>.'
            );
            echo Respuestas::JSON(
                    'EXITO', '' . self::$datos['registro_servicio'] . ''
            );
            die();
        } else {
            echo Respuestas::JSON(
                    'ERROR', 'NO Se ha creado el nuevo <strong>SERVICIO</strong>, ' . 'identificado por el codigo [<strong>' . self::$datos['codigo_servicio'] . '</strong>].'
                    . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
            );
            die();
        }
    }

    function modificarServicio($idServicio) {
        switch (self::$datos['rd_razonmodifica']) {
            case 1:
                $this->anularServicio($idServicio);
                break;
            case 2:
                $this->anularServicio($idServicio);
                $this->crearNuevoServicioConSoporte();
                break;
            case 4:
                $this->devolverServicio($idServicio);
                break;
            case 3:
            case 5:
            case 6:
            case 7:
            case 8:
                $this->anularRecibo($idServicio);
                $this->crearNuevoRecibo($idServicio);
                break;
            default:
                //$this->crearNuevoServicioConSoporte();
                break;
        }
        $this->enviarCorreoServicioAnulado(self::$datos['registro_servicio'], self::$datos['rd_razonmodifica'], self::$datos['razones_modificacion']);
    }

    function anularDeposito($idReciboDeposito) {
        $dtsDeposito = ReciboDepositos::datos($idReciboDeposito);
        $anulado = ReciboDepositos::anular($idReciboDeposito);
        if (!is_null($anulado)) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>ANULADO EL DEPOSITO</strong> con documento de ingreso #' . $dtsDeposito->docIngresoConsecutivo . '.'
            );
        } else {
            Mensajes::operacion(
                    'ERROR', 'NO se pudo <strong>ANULAR EL DEPOSITO</strong> con documento de ingreso #' . $dtsDeposito->docIngresoConsecutivo . '.'
                    . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
            );
        }
    }

    function anularRecibo($idServicio) {
        $dtsRecibo = RecibosServicios::datos_por_servicio($idServicio);
        $desactivo = RecibosServicios::anular($dtsRecibo->reciboId);
        if (!is_null($desactivo)) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>ANULADO EL RECIBO</strong>  #' . $dtsRecibo->reciboNumero . ' '
                    . 'y se ha reversado el estado de los equipos asociados al servicio.'
            );
            $equiposRecibo = ReciboEquipos::todos_del_recibo($dtsRecibo->reciboId);
            foreach ($equiposRecibo as $EquipoRecibo) {
                if ($EquipoRecibo->equipoEstadoServicio == Equipos::$EN_SERVICIO and $EquipoRecibo->equipoReciboServicio == $dtsRecibo->reciboId) {
                    $cambio = Equipos::cambiarUbicacion(
                                    $EquipoRecibo->equipoId, Params::valor('lat_organizacion'), Params::valor('lng_organizacion')
                    );
                    $cambio2 = Equipos::cambiarEstadoServicioEquipo($EquipoRecibo->equipoId, Equipos::$DISPONIBLE);
                } else if ($EquipoRecibo->equipoEstadoServicio != Equipos::$EN_SERVICIO and $EquipoRecibo->equipoReciboServicio == $dtsRecibo->reciboId) {
                    $cambio = Equipos::cambiarUbicacion(
                                    $EquipoRecibo->equipoId, $dtsRecibo->reciboLatitud, $dtsRecibo->reciboLongitud
                    );
                    $cambio2 = Equipos::cambiarEstadoServicioEquipo(
                                    $EquipoRecibo->equipoId, Equipos::$EN_SERVICIO, $dtsRecibo->reciboId, $dtsRecibo->reciboCliente
                    );
                }
            }
            if (!is_null($dtsRecibo->reciboDepositoId)) {
                $this->anularDeposito($dtsRecibo->reciboDepositoId);
            }
        } else {
            Mensajes::operacion(
                    'ERROR', 'NO se pudo <strong>ANULAR EL RECIBO</strong> ' . $dtsRecibo->reciboNumero . '.'
                    . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
            );
        }
    }

    function anularServicio($idServicio) {
        $dtsServicio = Servicios::datos($idServicio);
        $desactivo = Servicios::anular($idServicio);
        if (!is_null($desactivo)) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>ANULADO EL SERVICIO</strong>  ' . $dtsServicio->servicioCodigo . '.'
            );
            $this->anularRecibo($idServicio);
        } else {
            Mensajes::operacion(
                    'ERROR', 'NO se pudo <strong>ANULAR EL SERVICIO</strong> ' . $dtsServicio->servicioCodigo . '.'
                    . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
            );
        }
    }

    function devolverServicio($idServicio) {
        $dtsServicio = Servicios::datos($idServicio);
        $desactivo = Servicios::devolver($idServicio);
        if (!is_null($desactivo)) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>DEVUELTO EL SERVICIO</strong>  ' . $dtsServicio->servicioCodigo . '.'
            );
            $this->anularRecibo($idServicio);
        } else {
            Mensajes::operacion(
                    'ERROR', 'NO se pudo <strong>DEVOLVER EL SERVICIO</strong> ' . $dtsServicio->servicioCodigo . '.'
                    . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
            );
        }
    }

    function crearNuevoServicioConSoporte() {
        if (isset(self::$datos['item_id_equipo'])) {
            self::$datos['codigoServicio'] = ( empty(self::$datos['codigo_servicio']) ? '' . date('dmyhis') : self::$datos['codigo_servicio'] ); //.''.substr(md5(Visitante::idPersona()), -4).'';
            
            $idNuevoServicio = Servicios::insertar(self::$datos['codigo_servicio']);
            if (!is_null($idNuevoServicio)) {
                $this->crearNuevoRecibo($idNuevoServicio);
                echo Respuestas::JSON(
                        'EXITO', '' . $idNuevoServicio . ''
                );
                die();
            } else {
                echo Respuestas::JSON(
                        'ERROR', 'NO Se ha creado el nuevo <strong>SERVICIO</strong>, ' . 'identificado por el codigo [<strong>' . self::$datos['codigo_servicio'] . '</strong>].'
                        . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
                );
                die();
            }
        }
    }

    function crearNuevoRecibo($idNuevoServicio) {
        self::$datos['reciboNumero'] = TiposDocumentos::usarConsecutivo('RECIBOEQUIPOS');
        $idNuevoRecibo = RecibosServicios::insertar(
                        $idNuevoServicio, self::$datos['reciboNumero'], self::$datos['fecha_recibo'], self::$datos['proxima_recogida_servicio'], self::$datos['cliente_servicio'], ( empty(self::$datos['referencia_cliente_servicio']) ? NULL : self::$datos['referencia_cliente_servicio']), self::$datos['direccion_servicio'], Visitante::idUsuario(), self::$datos['latitud_cliente'], self::$datos['longitud_cliente']
        );
        if (!is_null($idNuevoRecibo)) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>REGISTRADO EL RECIBO #' . self::$datos['reciboNumero'] . '</strong> del servicio, '
                    . 'identificado por el codigo [<strong>' . self::$datos['codigo_servicio'] . '</strong>].'
            );
            $this->registrarEquipos($idNuevoRecibo);
            $this->registrarDeposito($idNuevoRecibo);
            $this->generarNuevoRecibo($idNuevoServicio);
            $this->enviarCorreoNuevoServicio($idNuevoServicio);
        } else {
            echo Respuestas::JSON(
                    'ERROR', 'NO Se ha podido <strong>REGISTRAR EL RECIBO</strong> del servicio, ' . 'identificado por el codigo [<strong>' . self::$datos['codigo_servicio'] . '</strong>].'
                    . '<br />' . 'Intentalo nuevamente' . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
            );
            die();
        }

        return $idNuevoRecibo;
    }

    function generarNuevoRecibo($idNuevoServicio) {
        $objServicio = $this->datosDelServicio($idNuevoServicio);
        $idDocumentoRecibo = ReciboArriendoEquipo::generar($objServicio);
        RecibosServicios::actualizar_documento($objServicio->reciboId, $idDocumentoRecibo);
    }

    function registrarEquipos($idNuevoRecibo) {
        self::$datos['item_id_equipo_recibidos'] = array();
        foreach (self::$datos['item_id_equipo'] as $iEquipo => $EqServicio) {
            $reciboEquipoMovimiento = 0;
            switch (self::$datos['item_movimiento_equipo'][$iEquipo]) {
                case 'entregado': $reciboEquipoMovimiento = 1;
                    break;
                case 'buen_estado': $reciboEquipoMovimiento = 2;
                    break;
                case 'perdido': $reciboEquipoMovimiento = 3;
                    break;
                case 'devuelto': $reciboEquipoMovimiento = 4;
                    break;
            }
            $idNuevoEquipoServicio = ReciboEquipos::insertar(
                            $idNuevoRecibo, $reciboEquipoMovimiento, self::$datos['item_id_equipo'][$iEquipo]
            );
            if (!is_null($idNuevoEquipoServicio)) {
                if ($reciboEquipoMovimiento == 1) {
                    $cambio = Equipos::cambiarUbicacion(
                                    self::$datos['item_id_equipo'][$iEquipo], self::$datos['latitud_cliente'], self::$datos['longitud_cliente']
                    );
                    $cambio2 = Equipos::cambiarEstadoServicioEquipo(
                                    self::$datos['item_id_equipo'][$iEquipo], Equipos::$EN_SERVICIO, $idNuevoRecibo, self::$datos['cliente_servicio']
                    );
                    array_push(self::$datos['item_id_equipo_recibidos'], self::$datos['item_id_equipo'][$iEquipo]);
                } else {
                    $cambio = Equipos::cambiarUbicacion(self::$datos['item_id_equipo'][$iEquipo], Params::valor('lat_organizacion'), Params::valor('lng_organizacion'));
                    switch ($reciboEquipoMovimiento) {
                        case 3:
                            $cambio2 = Equipos::cambiarEstadoServicioEquipo(self::$datos['item_id_equipo'][$iEquipo], Equipos::$DESHABILITADO);
                            break;
                        case 4:
                            $cambio2 = Equipos::cambiarEstadoServicioEquipo(self::$datos['item_id_equipo'][$iEquipo], Equipos::$EN_MANTENIMIENTO);
                            break;

                        default:
                            $cambio2 = Equipos::cambiarEstadoServicioEquipo(self::$datos['item_id_equipo'][$iEquipo], Equipos::$DISPONIBLE);
                            break;
                    }
                }
            }
        }
    }

    function registrarDeposito($idNuevoRecibo) {
        if (count(self::$datos['item_id_equipo']) > '0' and isset(self::$datos['deposito_servicio']) and self::$datos['deposito_servicio'] != 0) {
            $dtsTipoDeposito = TiposDepositos::datos(self::$datos['deposito_servicio']);
            $valorTipoDeposito = $dtsTipoDeposito->depositoValor;
            if ($dtsTipoDeposito->depositoCodigo == 'OTROVALOR') {
                $valorTipoDeposito = self::$datos['otroValor'];
            }
            $totalDeposito = count(self::$datos['item_id_equipo_recibidos']) * floatval($valorTipoDeposito);
            $idNuevoDeposito = ReciboDepositos::insertar($idNuevoRecibo, self::$datos['deposito_servicio'], $totalDeposito);
            if (!is_null($idNuevoDeposito)) {

                $DatosDeposito = ReciboDepositos::del_recibo($idNuevoRecibo);
                $idDocumentoDeposito = ReciboDepositoEquipo::generar($DatosDeposito);
                ReciboDepositos::actualizar_documento_ingreso($idNuevoDeposito, $idDocumentoDeposito);
                $dtsDeposito = ReciboDepositos::datos($idNuevoDeposito);
                Mensajes::operacion(
                        'EXITO', 'Se ha registrado correctamente el <strong>DEPOSITO</strong> con comprobante <strong>#' . $dtsDeposito->docIngresoConsecutivo . '</strong>, '
                        . 'para el servicio de codigo [<strong>' . self::$datos['codigo_servicio'] . '</strong>]  '
                        . 'y numero de recibo [<strong>' . self::$datos['reciboNumero'] . '</strong>] '
                );
            } else {
                Mensajes::operacion(
                        'ERROR', 'No se ha podido registrar el <strong>DEPOSITO</strong> '
                        . 'del servicio con codigo [<strong>' . self::$datos['codigo_servicio'] . '</strong>] '
                        . 'y numero de recibo [<strong>' . self::$datos['reciboNumero'] . '</strong>].'
                );
            }
        }
    }

    function mostrarFormulario() {
        self::$datos['Clientes'] = Clientes::todos();
        self::$datos['EquiposDisponibles'] = Equipos::disponibles();
        self::$datos['EquiposEnServicio'] = array();
        self::$datos['TiposDepositos'] = TiposDepositos::todos();

        self::$datos['codigoServicio'] = '' . date('dmyhis'); //.''.substr(md5(Visitante::idPersona()), -4).'';
        self::$datos['ProximaRecogidaServicio'] = date(
                'Y-m-d', strtotime("+" . (Params::valor('DIAS_RECOGIDA')) . " days")
        );
        Vistas::mostrar('equipos' . DS . 'formulario', self::$datos);
    }

    function borrar() {
        if (isset(self::$datos['registro_servicio']) and ! empty(self::$datos['registro_servicio'])) {
            $objTipoEquipo = TiposEquipos::datos(self::$datos['registro_servicio']);
            $cambio = TiposEquipos::desactivar(self::$datos['registro_servicio']);
            if ($cambio) {
                Mensajes::operacion('EXITO', 'Se han eliminado correctamente los datos asociados al '
                        . '<strong>TIPO DE EQUIPO</strong> [' . $objTipoEquipo->tipoEquipoCodigo . '] <strong>' . $objTipoEquipo->tipoEquipoTitulo . '</strong>. '
                );
            } else {
                Mensajes::operacion('ERROR', 'NO Se han eliminado correctamente los datos asociados al '
                        . '<strong>TIPO DE EQUIPO</strong> [' . $objTipoEquipo->tipoEquipoCodigo . '] <strong>' . $objTipoEquipo->tipoEquipoTitulo . '</strong>. '
                        . '<strong>Intentelo nuevamente.</strong> <br />'
                        . '<em>Si el problema persiste, contacte al Soporte del Sistema.</em>'
                );
            }
        }
        $this->mostrarTodos();
    }

    function datosDelServicio($idNuevoServicio) {
        $objServicio = Servicios::datos_completos($idNuevoServicio);
        $objServicio->equiposRecibo = ReciboEquipos::todos_del_recibo($objServicio->reciboId);
        if (!is_null($objServicio->reciboDocumento)) {
            $objServicio->documentoRecibo = Documentos::datos($objServicio->reciboDocumento);
        }
        $objServicio->depositoRecibo = ReciboDepositos::del_recibo($objServicio->reciboId);
        if (!is_null($objServicio->depositoRecibo)) {
            if (!is_null($objServicio->depositoRecibo->reciboDepositoDocIngreso)) {
                $objServicio->documentoDeposito = Documentos::datos($objServicio->depositoRecibo->reciboDepositoDocIngreso);
            }
        }
        if ($objServicio->servicioEstado != 'ACTIVO') {
            $objServicio->ultimoCambio = ReciboControlCambios::ultimo_del_servicio($idNuevoServicio);
        }
        return $objServicio;
    }

    function enPosesionDelCliente() {
        self::$datos['EquiposEnServicio'] = ReciboEquipos::pendientesPorRecogerPorCliente(self::$datos['registro_cliente']);
        Vistas::cargar('equipos' . DS . 'select-equipos-para-recibir', self::$datos, 'productos');
    }

    function enviarCorreoNuevoServicio($idNuevoServicio) {
        $objServicio = $this->datosDelServicio($idNuevoServicio);
        if (CorreosServiciosEquipos::enviarNuevoServicioEquipos($objServicio) === TRUE) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>Enviado Correctamente</strong> la notificacion del '
                    . 'servicio de [<strong>Recibo ' . $objServicio->reciboNumero . '</strong>] a los correos:'
                    . '[' . $objServicio->personaCorreoElectronico . ' | ' . $objServicio->correoReferencia . '].'
            );
        } else {
            Mensajes::operacion(
                    'ERROR', '<strong>NO SE PUDO ENVIAR</strong> la notificacion del '
                    . 'servicio de [<strong>Recibo ' . $objServicio->reciboNumero . '</strong>] a los correos:'
                    . '[' . $objServicio->personaCorreoElectronico . ' | ' . $objServicio->correoReferencia . '].'
            );
        }
    }

    function enviarCorreoServicioAnulado($idNuevoServicio, $rd_razonmodifica, $razones_modificacion) {
        $objServicio = $this->datosDelServicio($idNuevoServicio);
        $objRazon = TiposMotivos::datos($rd_razonmodifica);
        if (CorreosServiciosEquipos::enviarAnuladoServicioEquipos($objServicio, $objRazon, $razones_modificacion) === TRUE) {
            Mensajes::operacion(
                    'EXITO', 'Se ha <strong>Enviado Correctamente</strong> la notificacion del '
                    . 'servicio anulado de [<strong>Recibo ' . $objServicio->reciboNumero . '</strong>] a los correos:'
                    . '[' . $objServicio->personaCorreoElectronico . ' | ' . $objServicio->correoReferencia . '].'
            );
        } else {
            Mensajes::operacion(
                    'ERROR', '<strong>NO SE PUDO ENVIAR</strong> la notificacion del '
                    . 'servicio anulado de [<strong>Recibo ' . $objServicio->reciboNumero . '</strong>] a los correos:'
                    . '[' . $objServicio->personaCorreoElectronico . ' | ' . $objServicio->correoReferencia . '].'
            );
        }
    }

}
