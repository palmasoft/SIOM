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

class movilControlador extends Controladores {

    function probarGenerar() {

//        Vistas::mostrar('movil' . DS . 'descargarRecibo', self::$datos);
    }

    function descargarRecibo() {
        $objServicio = Servicios::datos_completos(self::$datos['registro_servicio']);
        $objServicio->depositoRecibo = ReciboDepositos::del_recibo($objServicio->reciboId);
        if (!is_null($objServicio->depositoRecibo)) {
            if (!is_null($objServicio->depositoRecibo->reciboDepositoDocIngreso)) {
                $objServicio->documentoDeposito = Documentos::datos($objServicio->depositoRecibo->reciboDepositoDocIngreso);
            }
        }
        self::$datos['Recibo'] = $objServicio;
        Vistas::mostrar('movil' . DS . 'descargarRecibo', self::$datos);
    }

    function nuevoMovil() {
        self::$datos['Referencias'] = array();
        $this->mostrarFormularioMovil_1();
    }

    function mostrarFormularioMovil_1() {
        $_SESSION['codigoServicio'] = '' . date('dmyhis'); //.''.substr(md5(Visitante::idPersona()), -4).'';
        $_SESSION['ProximaRecogidaServicio'] = date('Y-m-d', strtotime("+" . (Params::valor('DIAS_RECOGIDA')) . " days"));
        self::$datos['Clientes'] = Clientes::todos();

        self::$datos['codigoServicio'] = $_SESSION['codigoServicio'];
        self::$datos['ProximaRecogidaServicio'] = $_SESSION['ProximaRecogidaServicio'];
        Vistas::mostrar('movil' . DS . 'formulario-movil', self::$datos);
    }

    function mostrarFormularioUbicacion() {
        self::$datos['codigoServicio'] = $_SESSION['codigoServicio'];
        self::$datos['ProximaRecogidaServicio'] = $_SESSION['ProximaRecogidaServicio'];
        Vistas::mostrar('movil' . DS . 'formulario-ubicacion', self::$datos);
    }

    function mostrarFormularioEquiposEntrega() {
        self::$datos['EquiposDisponibles'] = Equipos::disponibles();
        self::$datos['codigoServicio'] = $_SESSION['codigoServicio'];
        self::$datos['ProximaRecogidaServicio'] = $_SESSION['ProximaRecogidaServicio'];
        Vistas::mostrar('movil' . DS . 'formulario-equiposentregar', self::$datos);
    }

    function mostrarFormularioEquiposRecoger() {
        self::$datos['EquiposEnServicio'] = ReciboEquipos::pendientesPorRecogerPorCliente(self::$datos['registro_cliente']);
        //Vistas::cargar('equipos' . DS . 'select-equipos-para-recibir', self::$datos, 'productos');        
        self::$datos['codigoServicio'] = $_SESSION['codigoServicio'];
        self::$datos['ProximaRecogidaServicio'] = $_SESSION['ProximaRecogidaServicio'];
        Vistas::mostrar('movil' . DS . 'formulario-equiposrecoger', self::$datos);
    }

    function mostrarFormularioEquiposDeposito() {
        self::$datos['TiposDepositos'] = TiposDepositos::todos();
        self::$datos['codigoServicio'] = $_SESSION['codigoServicio'];
        self::$datos['ProximaRecogidaServicio'] = $_SESSION['ProximaRecogidaServicio'];
        Vistas::mostrar('movil' . DS . 'formulario-equiposdeposito', self::$datos);
    }

    function mostrarFormularioMovil_4() {
        self::$datos['Clientes'] = Clientes::todos();
        self::$datos['EquiposDisponibles'] = Equipos::disponibles();
        self::$datos['EquiposEnServicio'] = array();
        self::$datos['TiposDepositos'] = TiposDepositos::todos();

        self::$datos['codigoServicio'] = '' . date('dmyhis'); //.''.substr(md5(Visitante::idPersona()), -4).'';
        self::$datos['ProximaRecogidaServicio'] = date(
                'Y-m-d', strtotime("+" . (Params::valor('DIAS_RECOGIDA')) . " days")
        );
        Vistas::mostrar('equipos' . DS . 'formulario-movil', self::$datos);
    }

}
