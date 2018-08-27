<?php
Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Personas' . DS . 'Clientes');
Modelos::cargar('Personas' . DS . 'ClientesContactos');
Modelos::cargar('Sistema' . DS . 'Usuarios');
Modelos::cargar('Sistema' . DS . 'Mensajes');


Modelos::cargar('Consultas' . DS . 'Recibos');
Modelos::cargar('Consultas' . DS . 'Equipos');
Modelos::cargar('Consultas' . DS . 'Clientes');

Modelos::cargar('Servicios' . DS . 'Servicios');
Modelos::cargar('Servicios' . DS . 'RecibosServicios');
Modelos::cargar('Servicios' . DS . 'ReciboEquipos');
Modelos::cargar('Servicios' . DS . 'ReciboDepositos');


Modelos::cargar('Equipos' . DS . 'TiposEquipos');
Modelos::cargar('Equipos' . DS . 'Equipos');


Modelos::cargar('Exportar' . DS . 'ConsultasRecibos');
class recibosControlador extends Controladores {

  function panelBusqueda() {

    self::$datos['Empleados'] = Usuarios::todos_completo();
    self::$datos['Clientes'] = Clientes::todos();
    self::$datos['TiposEquipos'] = TiposEquipos::todos();
    Vistas::mostrar('buscar_en_recibos', self::$datos);
  }

  function buscarRegistros() {

    $fechas = explode("-", self::$datos['intervaloConsulta']);
    $fechas[0] = str_replace("/", "-", $fechas[0]);
    $fechas[1] = str_replace("/", "-", $fechas[1]);
    $cliente_servicio = null;
    if(self::$datos['cliente_servicio'] != 0) {
      $cliente_servicio = self::$datos['cliente_servicio'];
    }
    $empleado_servicio = null;
    if(self::$datos['empleado_servicio'] != 0) {
      $empleado_servicio = self::$datos['empleado_servicio'];
    }
    $tipoequipo_servicio = null;
    if(self::$datos['tipoequipo_servicio'] != 0) {
      $tipoequipo_servicio = self::$datos['tipoequipo_servicio'];
    }

    switch(self::$datos['mostrar']) {
      case 'recibos':
        self::$datos['RecibosConsulta'] = ConsultaServicios::buscar($fechas[0], $fechas[1], $cliente_servicio,
          $empleado_servicio);
        if(count(self::$datos['RecibosConsulta'])):
          Vistas::cargar("recibos" . DS . "basica", self::$datos);
        endif;

        break;
      case 'equipos':
        self::$datos['EquiposConsulta'] = ConsultaEquipos::buscar($fechas[0], $fechas[1], $cliente_servicio,
          $empleado_servicio, $tipoequipo_servicio);
        if(count(self::$datos['EquiposConsulta'])) {
          Vistas::cargar("equipos" . DS . "basica", self::$datos);
        }
        break;
      case 'clientes':
        self::$datos['ClientesConsulta'] = ConsultaClientes::buscar($fechas[0], $fechas[1], $cliente_servicio,
          $empleado_servicio, $tipoequipo_servicio);
        if(count(self::$datos['ClientesConsulta'])):
          Vistas::cargar("clientes" . DS . "basica", self::$datos);
        endif;
        break;
      default:
        break;
    }
  }

  function consultaResumenServicio() {
    self::$datos['DatosServicio'] = $this->datosRecibosAsociado(self::$datos['registro_servicio']);
    Vistas::mostrar('recibos' . DS . 'resumen', self::$datos);
  }

  function datosRecibosAsociado($idServicio) {
    self::$datos['DatosServicio'] = Servicios::datos_completos($idServicio);
//    print_r(self::$datos);
    self::$datos['DatosServicio']->Deposito = self::$datos['DatosDeposito'] = ReciboDepositos::datos_completos(self::$datos['DatosServicio']->reciboDepositoId);
    self::$datos['DatosServicio']->Equipos = ReciboEquipos::todos_del_recibo(self::$datos['DatosServicio']->reciboId);
    self::$datos['DatosServicio']->EquiposEntregados = 0;
    self::$datos['DatosServicio']->EquiposRecogidos = 0;
    self::$datos['DatosServicio']->EquiposNoRecogidos = 0;
    self::$datos['DatosServicio']->EquiposDevueltos = 0;
    foreach(self::$datos['DatosServicio']->Equipos as $ObjEquipo) {
      switch($ObjEquipo->reciboEquipoMovimiento) {
        case '1':self::$datos['DatosServicio']->EquiposEntregados++;
          break;
        case '2':self::$datos['DatosServicio']->EquiposRecogidos++;
          break;
        case '3':self::$datos['DatosServicio']->EquiposNoRecogidos++;
          break;
        case '4':self::$datos['DatosServicio']->EquiposDevueltos++;
          break;
        default:
          break;
      }
    }

    return self::$datos['DatosServicio'];
  }

  function consultaResumenEquipo() {
    self::$datos['DatosEquipo'] = $this->datosRecibosEquipo(self::$datos['registro_equipo']);
    Vistas::mostrar('equipos' . DS . 'resumen', self::$datos);
  }

  function datosRecibosEquipo($idEquipo) {
    self::$datos['DatosEquipo'] = Equipos::datos_completos($idEquipo);
    self::$datos['DatosEquipo']->RecibosServicios = ReciboEquipos::recibosPorEquipo($idEquipo);
    return self::$datos['DatosEquipo'];
  }

  function consultaResumenCliente() {

    self::$datos['DatosCliente'] = $this->datosRecibosCliente(self::$datos['registro_cliente']);
    Vistas::mostrar('clientes' . DS . 'resumen', self::$datos);
  }

  function datosRecibosCliente($idCliente) {
    self::$datos['DatosCliente'] = Clientes::datos($idCliente);
    self::$datos['DatosCliente']->Contactos = ClientesContactos::datosPorClientes($idCliente);
    self::$datos['DatosCliente']->RecibosServicios = RecibosServicios::recibosPorCliente($idCliente);
    if(count(self::$datos['DatosCliente']->RecibosServicios)) {
      foreach(self::$datos['DatosCliente']->RecibosServicios as $kRecibo => $ObjRecibo) {
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo] = Servicios::datos_completos($ObjRecibo->reciboServicio);
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->Deposito = ReciboDepositos::datos_completos(self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->reciboDepositoId);
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->Equipos = ReciboEquipos::todos_del_recibo(self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->reciboId);
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposEntregados = 0;
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposRecogidos = 0;
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposNoRecogidos = 0;
        self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposDevueltos = 0;
        foreach(self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->Equipos as $ObjEquipo) {
          switch($ObjEquipo->reciboEquipoMovimiento) {
            case '1':self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposEntregados++;
              break;
            case '2':self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposRecogidos++;
              break;
            case '3':self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposNoRecogidos++;
              break;
            case '4':self::$datos['DatosCliente']->RecibosServicios[$kRecibo]->EquiposDevueltos++;
              break;
            default:
              break;
          }
        }
      }
    }
    return self::$datos['DatosCliente'];
  }

  function exportarRegistros() {
    $DatosServicios = array();
    $EquiposEncontrados = null;
    $ClientesEncontrados = null;


    switch(self::$datos['mostrar']) {
      case 'recibos':
        self::$datos['RecibosConsulta'] = ConsultaServicios::buscar();
        if(count(self::$datos['RecibosConsulta'])) {
          foreach(self::$datos['RecibosConsulta'] as $ReciboServicio) {
            $ReciboServicio->datosConsulta = $this->datosRecibosAsociado($ReciboServicio->servicioId);
            array_push($DatosServicios, $ReciboServicio);
          }
        }
        break;
      case 'equipos':

        self::$datos['RecibosConsulta'] = ConsultaServicios::buscar();
        if(count(self::$datos['RecibosConsulta'])) {
          foreach(self::$datos['RecibosConsulta'] as $ReciboServicio) {
            $ReciboServicio->datosConsulta = $this->datosRecibosAsociado($ReciboServicio->servicioId);
            array_push($DatosServicios, $ReciboServicio);
          }
        }
        $EquiposEncontrados = Equipos::todos();
        if(count($EquiposEncontrados)) {
          foreach($EquiposEncontrados as $indice => $Equipo) {
            $EquiposEncontrados[$indice] = Equipos::datos_completos($Equipo->equipoId);
          }
        }
        break;
      case 'clientes':
        self::$datos['RecibosConsulta'] = ConsultaServicios::buscar();
        if(count(self::$datos['RecibosConsulta'])) {
          foreach(self::$datos['RecibosConsulta'] as $ReciboServicio) {
            $ReciboServicio->datosConsulta = $this->datosRecibosAsociado($ReciboServicio->servicioId);
            array_push($DatosServicios, $ReciboServicio);
          }
        }
        $ClientesEncontrados = Clientes::todos();
        if(count($ClientesEncontrados)) {
          foreach($ClientesEncontrados as $indice => $Cliente) {
            $ClientesEncontrados [$indice]->Contactos = ClientesContactos::datosPorClientes($Cliente->clienteId);
          }
        }
        break;
      default:
        break;
    }

    ConsultasRecibos::exportarXLS($DatosServicios, $EquiposEncontrados, $ClientesEncontrados);
  }

}