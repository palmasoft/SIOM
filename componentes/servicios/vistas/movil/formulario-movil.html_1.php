<?php
//echo json_encode($datosDelServicios, JSON_PRETTY_PRINT);
self::$datos['fechaServicio'] = $fechaServicio = date('Y-m-d h:i:s');
?>
<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Servicio <small>de Arrendamiento de Equipos</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <section class="content invoice">

          <?php if(isset($datosDelServicios) and $datosDelServicios->servicioEstado != 'ACTIVO'): ?>
            <?php
            echo AlertasHTML5::advertencia(
             ''
             . 'Este Servicio está <strong>' . $datosDelServicios->servicioEstado . '</strong> porqué :'
             . '<p><ul><li><em><strong>' . $datosDelServicios->ultimoCambio->reciboCambioObservacion . '</strong></em></li></ul></p>.'
             //. '<br />'
             //. ''.$datosDelServicios->ultimoCambio->tipoMotivoTitulo.'' 
            );
            ?>
          <?php endif; ?>

          <!-- INFO CLIENTE -->
          <form id="form-cliente-servicio">
            <?php
            Vistas::cargar('equipos' . DS . 'form-clientereferencia', self::$datos, 'servicios');
            ?> 
            <input type="submit" id="btn-datoscliente" style="display: none;" />
          </form>


          <!--formulario para direccion de entrega-->
          <?php
          Vistas::cargar('equipos' . DS . 'form-ubicacionservicio', self::$datos, 'servicios');
          ?>   

          <!--formulario para entregar equipos-->
          <?php
          Vistas::cargar('equipos' . DS . 'form-equiposentregar', self::$datos, 'servicios');
          ?>   

          <!--formulario para recoger equipos-->
          <?php
          Vistas::cargar('equipos' . DS . 'form-equiposrecoger', self::$datos, 'servicios');
          ?>   

          <!-- EN SERVICIOS -->
          <?php
          Vistas::cargar('equipos' . DS . 'tabla-recibo', self::$datos, 'servicios');
          ?>       

          <?php
          Vistas::cargar('equipos' . DS . 'form-deposito', self::$datos, 'servicios');
          ?>
          <?php if(isset($datosDelServicios)): ?>
            <?php
            Vistas::cargar('equipos' . DS . 'form-controlcambios', self::$datos, 'servicios');
            ?>
          <?php endif; ?>

          <!-- botonera -->
          <div class="row no-print">
            <div class="col-xs-12">
              <form id="form-datoscontrol">
                <input type="hidden" name="registro_servicio" value="<?php echo isset($datosDelServicios->servicioId) ? $datosDelServicios->servicioId : "" ?>" />
                <?php if(isset($datosDelServicios)): ?>
                  <?php if(isset($datosDelServicios->documentoDeposito)): ?>
                    <div class="btn-group">
                      <label class="btn btn-default border-aero" >Recibo del Deposito</label>
                      <button class="btn btn-info botones_despues_de_generado" onclick="imprimirReciboDeposito();"   ><i class="fa fa-print"></i> IMPRIMIR</button>
                      <button class="btn btn-info botones_despues_de_generado" onclick="verReciboDeposito();"   ><i class="fa fa-eye"></i> VER </button>
                    </div>
                  <?php else: ?>
                    <!--<button class="btn btn-success pull-right botones_despues_de_generado" onclick="recibirDepositoDelServicio();"  ><i class="fa fa-credit-card"></i> Recibir Depósito</button>-->
                  <?php endif; ?>
                  <div class="btn-group">
                    <label class="btn btn-default border-blue" >Recibo del Servicio</label>
                    <button class="btn btn-primary border- botones_despues_de_generado" onclick="imprimirReciboServicio();" ><i class="fa fa-print"></i> IMPRIMIR</button>
                    <button class="btn btn-primary border- botones_despues_de_generado" onclick="verReciboServicio();" ><i class="fa fa-print"></i> VER</button>
                  </div>        
                  <div class="btn-group pull-right ">
                    <button class="btn btn-warning" onclick="guardarNuevoReciboServicio();" ><i class="fa fa-save"></i> guardar CAMBIOS</button>
                  </div>
                <?php else: ?>     
                  <div class="btn-group">
                    <button class="btn btn-primary pull-right botones_despues_de_generado" onclick="guardarReciboServicio();"  style="margin-right: 5px;"><i class="fa fa-download"></i> Generar RECIBO</button>
                  </div>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </section>
      </div>
    </div>
  </div>
</div>
<iframe src="<?php echo isset($datosDelServicios->documentoRecibo) ? $datosDelServicios->documentoRecibo->documentoUrl : "#" ?>" id="documentoRecibo" style="display: none;" />
<iframe src="<?php echo isset($datosDelServicios->documentoDeposito) ? $datosDelServicios->documentoDeposito->documentoUrl : "#" ?>" id="documentoDeposito" style="display: none;" />

<script>
  $(document).ready(function () {
    $('input.flat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    $(".deposito_servicio").on('ifChecked', function (event) {
      actualizarResumenRecibo();
    });
    
    $("#otroValor").on('keyup', function (event) {
      actualizarResumenRecibo();
    });
  });

  function quitarFilaTablaEquipo(objTdFila) {
    var htmlFila = $(objTdFila).parent().parent().html();
    var tipo = $(htmlFila).find('#item-tipo-equipo').val();
    var codigo = $(htmlFila).find('#item-codigo-equipo').val();
    var serial = $(htmlFila).find('#item-serial-equipo').val();
    var movimiento = $(htmlFila).find('#item-movimiento-equipo').val();
    var id = $(htmlFila).find('#item-id-equipo').val();
    if (movimiento == 'entregado') {
      $("#equipos-para-entregar").append('<option value="' + id + '">' + tipo + " " + codigo + " " + serial + '</option>');
      $("#equipos-para-entregar").trigger("change");
    } else {
      $("#equipos-para-recoger").append('<option value="' + id + '">' + tipo + " " + codigo + " " + serial + '</option>');
      $("#equipos-para-recoger").trigger("change");
    }
    $(objTdFila).parent().parent().remove();
    actualizarResumenRecibo();
  }
  function cargarSelectReferenciaCliente(objSelect) {
    ejecutarAccion('personas', 'referencias', 'selectReferenciasCliente',
      'registro_cliente=' + objSelect.val(),
      function (respuesta) {
        $("#div-select-referencia-servicio").html(respuesta);
      }
    );
  }
  function actualizarResumenRecibo() {

    var equiposServicio = 0;
    var equiposServicioEntregado = 0;
    var equiposServicioRecibidos = 0;
    var equiposServicioNORecibidos = 0;
    var equiposServicioDevueltos = 0;
    var equiposServicioDepositoTotal = 0;

    var filas = $('#tabla-equipos-recibo tbody tr');
    filas.each(function () {
      var htmlFila = $(this).html();
      var equipoId = $(htmlFila).find('#item-id-equipo').val();
      if (!estaVacio(equipoId)) {
        var equipoMov = $(htmlFila).find('#item-movimiento-equipo').val();
        switch (equipoMov) {
          case 'entregado':
            equiposServicioEntregado++;
            break;
          case 'perdido':
            equiposServicioNORecibidos++;
            break;
          case 'devuelto':
            equiposServicioDevueltos++;
            break;
          case 'buen_estado':
            equiposServicioRecibidos++;
            break;
        }
        equiposServicio++;
      }
    });
    var valorTarifaDeposito = $('input[name=deposito-servicio]:checked').attr('data-valor');
    if (valorTarifaDeposito == 'OTROVALOR') {
      valorTarifaDeposito = parseFloat($("#otroValor").val());
    }

    equiposServicioDepositoTotal = valorTarifaDeposito * equiposServicioEntregado;
    $("#equipos-totales-servicio").html(formatoNumero(equiposServicio));
    $("#equipos-entregados-servicio").html(formatoNumero(equiposServicioEntregado));
    $("#equipos-recibidos-servicio").html(formatoNumero(equiposServicioRecibidos));
    $("#equipos-norecibidos-servicio").html(formatoNumero(equiposServicioNORecibidos));
    $("#equipos-devueltos-servicio").html(formatoNumero(equiposServicioDevueltos));
    $("#equipos-deposito-servicio").html("$ " + formatoNumero(equiposServicioDepositoTotal));
    $("#valor-deposito").html("$ " + formatoNumero(equiposServicioDepositoTotal));
  }

  function guardarReciboServicio() {

    var resp = $("#btn-datoscliente").click();
    if (estaVacio($("#cliente-servicio").val())) {
      return false;
    }
    var resp = $("#btn-ubicacionservicio").click();
    if (estaVacio($("#direccion-servicio").val())) {
      return false;
    }

    var filas = $('#tabla-equipos-recibo tbody tr');
    var equiposServicio = 0;
    filas.each(function () {
      var htmlFila = $(this).html();
      var equipoId = $(htmlFila).find('#item-id-equipo').val();
      if (!estaVacio(equipoId)) {
        equiposServicio++;
      }
    });
    if (estaVacio(equiposServicio)) {
      alerta('<h4>Debes registrar al menos un EQUIPO para este servicio.</h4>');
      return false;
    }

    //$(".botones_despues_de_generado").removeAttr('disabled');
    ejecutarAccion('servicios', 'equipos', 'guardarCambios',
      $("form").serialize(),
      function (respuesta) {
//        alert(respuesta);
        var resp = JSON.parse(respuesta);
        if (resp.TIPO_RESPUESTA == 'EXITO') {
          mostrar_contenidos(
            'servicios',
            'equipos',
            'editar',
            'registro-servicio=' + resp.MENSAJE_RESPUESTA
            );

        } else {
          alerta(resp.MENSAJE_RESPUESTA);
        }
      }
    );
  }
  
  function guardarCambiosReciboServicio() {

  }
  function guardarNuevoReciboServicio() {


<?php if(isset($datosDelServicios)): ?>
      var resp = $("#btn-razonmodifica").click();
      var razonSel = $('input[name="rd_razonmodifica"]:checked').val();
      if (estaVacio(razonSel)) {
        return false;
      }
      var razonText = $('#razones_modificacion').val();
      if (estaVacio(razonText)) {
        return false;
      }
<?php endif; ?>


    confirmar(
      '<h3>¿Seguro que desea guardar los cambios realizados? <strong>Se va ha generar un nuevo recibo para este servicio. El anterior recibo se anulará¡.</strong></h3>',
      function (respuesta) {
        guardarReciboServicio();
      }
    );
  }

  function imprimirReciboServicio() {
    var doc = document.getElementById('documentoRecibo');
    doc.contentWindow.print();
  }
  function imprimirReciboDeposito() {
    var doc = document.getElementById('documentoDeposito');
    doc.contentWindow.print();
  }
  function verReciboServicio() {
    var doc = $('#documentoRecibo').attr('src');
    abrir_soportes(doc, "Recibo del Servicio <?php echo isset($datosDelServicios->reciboNumero) ? $datosDelServicios->reciboNumero : '?????' ?>");
  }
  function verReciboDeposito() {
    var doc = $('#documentoDeposito').attr('src');
    abrir_soportes(doc, "Recibo del Servicio <?php echo isset($datosDelServicios->reciboNumero) ? $datosDelServicios->reciboNumero : '?????' ?>");
  }

</script>



<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

