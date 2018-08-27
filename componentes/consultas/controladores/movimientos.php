<?php

Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Equipos' . DS . 'Equipos');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Personas' . DS . 'ClientesContactos');
Modelos::cargar('Documentos' . DS . 'Plantillas' . DS . 'ReporteMovimiento');

class movimientosControlador extends Controladores {

    function panelMovimientos() {
        Vistas::mostrar('panel_movimientos', self::$datos);
    }

    function generarReporte() {
        $fechas = explode("-", self::$datos['intervaloConsulta']);
        $fechas[0] = str_replace("/", "-", $fechas[0]);
        $fechas[1] = str_replace("/", "-", $fechas[1]);

        $qryConsulta = $this->consultarMovimientos($fechas[0], $fechas[1]);
    }

    function exportarRegistros() {

        switch (self::$datos['mostrar']) {
            case 'clientes':
                $fechas = explode("-", self::$datos['intervaloConsulta']);
                $fechas[0] = str_replace("/", "-", $fechas[0]);
                $fechas[1] = str_replace("/", "-", $fechas[1]);
                $Clientes = Clientes::totalesMovimientos($fechas[0], $fechas[1]);
                echo ReporteMovimientos::deClientesXLS($fechas[0], $fechas[1], $Clientes);
                break;
            case 'referencias':
                $fechas = explode("-", self::$datos['intervaloConsulta']);
                $fechas[0] = str_replace("/", "-", $fechas[0]);
                $fechas[1] = str_replace("/", "-", $fechas[1]);
                $Clientes = Clientes::totalesMovimientos($fechas[0], $fechas[1]);
                foreach ($Clientes as $objCliente) {
                    $objCliente->Referencias = ClientesContactos::totalesMovimientosPorCliente($fechas[0], $fechas[1], $objCliente->clienteId);
                }
                echo ReporteMovimientos::deReferenciasXLS($fechas[0], $fechas[1], $Clientes);
                break;
            case 'equipos':
                $fechas = explode("-", self::$datos['intervaloConsulta']);
                $fechas[0] = str_replace("/", "-", $fechas[0]);
                $fechas[1] = str_replace("/", "-", $fechas[1]);
                $Equipos = Equipos::totalesMovimientos($fechas[0], $fechas[1]);
                foreach ($Equipos as $objEquipo) {
                    $objEquipo->Movimientos = Equipos::movimientos($objEquipo->equipoId, $fechas[0], $fechas[1]);
                    $objEquipo->NUM_SERVICIOS = 0;
                    $objEquipo->NUM_ENSERVICIO = 0;
                    $objEquipo->NUM_RECOGIDOS = 0;
                    $objEquipo->NUM_PERDIDA = 0;
                    $objEquipo->NUM_DEVUELTO = 0;
                    $objEquipo->NUM_DEPOSITOS = 0;
                    foreach ($objEquipo->Movimientos as $objMovimiento) {
                        switch ($objMovimiento->movimientoId) {
                            case 1: $objEquipo->NUM_ENSERVICIO++;
                                break;
                            case 2: $objEquipo->NUM_RECOGIDOS++;
                                break;
                            case 3: $objEquipo->NUM_PERDIDA++;
                                break;
                            case 4: $objEquipo->NUM_DEVUELTO++;
                                break;
                        }
                        $objEquipo->NUM_SERVICIOS++;

                        if (!is_null($objEquipo->reciboDepositoDocIngreso)) {
                            $objEquipo->NUM_DEPOSITOS ++;
                        }
                    }
                }
                echo ReporteMovimientos::deEquiposXLS($fechas[0], $fechas[1], $Equipos);
                break;
            default:
                break;
        }
    }

    function consultarMovimientos($fechasInicial, $fechasFinal) {
        switch (self::$datos['mostrar']) {
            case 'clientes':
                $Clientes = Clientes::totalesMovimientos($fechasInicial, $fechasFinal);
                echo ReporteMovimientos::deClientesPDF($fechasInicial, $fechasFinal, $Clientes);
                break;
            case 'referencias':
                $Clientes = Clientes::totalesMovimientos($fechasInicial, $fechasFinal);
                foreach ($Clientes as $objCliente) {
                    $objCliente->Referencias = ClientesContactos::totalesMovimientosPorCliente($fechasInicial, $fechasFinal, $objCliente->clienteId);                    
                }
                echo ReporteMovimientos::deReferenciasPDF($fechasInicial, $fechasFinal, $Clientes);
                break;
            case 'equipos':                
                set_time_limit(18000);    
                $Equipos = Equipos::totalesMovimientos($fechasInicial, $fechasFinal);
                foreach ($Equipos as $objEquipo) {
                    $objEquipo->Movimientos = Equipos::movimientos($objEquipo->equipoId, $fechasInicial, $fechasFinal);
                    $objEquipo->NUM_SERVICIOS = 0;
                    $objEquipo->NUM_ENSERVICIO = 0;
                    $objEquipo->NUM_RECOGIDOS = 0;
                    $objEquipo->NUM_PERDIDA = 0;
                    $objEquipo->NUM_DEVUELTO = 0;
                    $objEquipo->NUM_DEPOSITOS = 0;
                    foreach ($objEquipo->Movimientos as $objMovimiento) {
                        switch ($objMovimiento->movimientoId) {
                            case 1: $objEquipo->NUM_ENSERVICIO++;
                                break;
                            case 2: $objEquipo->NUM_RECOGIDOS++;
                                break;
                            case 3: $objEquipo->NUM_PERDIDA++;
                                break;
                            case 4: $objEquipo->NUM_DEVUELTO++;
                                break;
                        }
                        $objEquipo->NUM_SERVICIOS++;

                        if (!is_null($objEquipo->reciboDepositoDocIngreso)) {
                            $objEquipo->NUM_DEPOSITOS ++;
                        }
                    }
                    $objEquipo->Movimientos = Equipos::todosMovimientos($objEquipo->equipoId, $fechasInicial, $fechasFinal);
                }
                echo ReporteMovimientos::deEquiposPDF($fechasInicial, $fechasFinal, $Equipos);
                break;
            default:
                break;
        }
    }

}
