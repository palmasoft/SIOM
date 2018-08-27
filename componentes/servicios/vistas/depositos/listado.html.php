

<div class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_content">
      <div class=" col-md-5">
        <h2>Depositos de Servicios</h2>
        <div>Son las entregas de dinero del cliente por los productos o equipos en servicios.</div>
      </div>
      <div class="  col-md-7">
        <a class="btn btn-app green" onclick="devolver_deposito();">
          <i class="fa fa-retweet"></i> Devolver Deposito
        </a>
        <a class="btn btn-app danger" onclick="ver_ingreso_recibo();">
          <i class="fa fa-arrow-circle-o-down"></i> Recibo del Ingreso
        </a>
        <a class="btn btn-app danger" onclick="ver_egreso_recibo();">
          <i class="fa fa-arrow-circle-o-up"></i> Recibo del Egreso
        </a>
        <a class="btn btn-app danger" onclick="ver_recibo_servicio();">
          <i class="fa fa-download"></i> Recibo del Servicio
        </a>
        <a class="btn btn-app warning" onclick="ver_resumen_servicio();" >
          <i class="fa fa-eye"></i> Datos del Servicio
        </a>

      </div>
    </div>
  </div>
</div>

<div id="pnl-resumenServicioDeposito" class="col-md-12 col-sm-12 col-xs-12">
  <div class="x_panel">
    <div class="x_title">
      <h2>Resumen del Servicio y Deposito</h2>
      <span class="right" ><a href="javascript:void(0);" onclick="imprimir_resumen();" ><i class="fa fa-print" ></i></a></span>
      <div class="clearfix"></div>
    </div>
    <div id="resumenServicioDeposito" class="x_content text-center">
    </div>
  </div>
</div>










<div class="col-md-12 col-sm-12 col-xs-12">

  <div class="x_panel">     
    <div class="x_content">
      <table id="tbl_depositos" class="table table-striped responsive-utilities jambo_table table-seleccionable">
        <thead>
          <tr class="headings">
            <th style="width: 1%" ></th>
            <th style="width: auto">Tipo Deposito </th>
            <th style="width: auto"># Recibo</th>
            <th style="width: auto"># Ingreso</th>
            <th style="width: auto"># Egreso</th>
            <th style="width: auto">Valor x Equipos</th>
            <th style="width: auto">Total</th>
            <th style="width: auto">Estado</th>
            <th style="width: auto">Recibido</th>
            <th style="width: auto">Devuelto</th>
            <th style="width: auto">Retenido</th>
            <th style="width: auto">Anulado</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($Depositos)) foreach($Depositos as $indice => $objDeposito): ?>

              <tr data-servicio-url="<?php echo $objDeposito->docServicioUrl ?>" data-egreso-url="<?php echo $objDeposito->docEgresoUrl ?>" data-ingreso-url="<?php echo $objDeposito->docIngresoUrl ?>"
                  data-servicio-numero="<?php echo $objDeposito->docServicioConsecutivo ?>" data-egreso-numero="<?php echo $objDeposito->docEgresoConsecutivo ?>" data-ingreso-numero="<?php echo $objDeposito->docIngresoConsecutivo ?>"
                  data-id="<?php echo $objDeposito->reciboDepositoId ?>" class="even pointer">
                <td><?php echo $indice + 1 ?></td>
                <td class=" "><?php echo $objDeposito->depositoTitulo ?></td>
                <td class=" "><?php echo $objDeposito->docServicioConsecutivo ?></td>
                <td class=" "><?php echo $objDeposito->docIngresoConsecutivo ?></td>
                <td class=" "><?php echo $objDeposito->docEgresoConsecutivo ?></td>                
                <td class=" ">$<?php echo $objDeposito->depositoValor ?> X <?php echo $objDeposito->NumEquipos ?></td>
                <td class=" ">$<?php echo $objDeposito->reciboDepositoValor ?></td>
                <td class=" "><?php echo $objDeposito->reciboDepositoEstado ?></td>
                <td class=" "><?php echo $objDeposito->reciboDepositoRecibido ?></td>
                <td class=" "><?php echo $objDeposito->reciboDepositoDevuelto ?></td>
                <td class=" "><?php echo $objDeposito->reciboDepositoRetenido ?></td>
                <td class=" "><?php echo $objDeposito->reciboDepositoAnulado ?></td>
              </tr>  

            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<script type="text/javascript" >
  var oTable;
  var idDeposito = null;
  var asInitVals = new Array();
  $(document).ready(function () {
    $("#tbl_depositos tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_depositos tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_depositos tbody tr").dblclick(function () {
      $(this).click();
      devolver_deposito();
    });
    oTable = $('#tbl_depositos').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
  });

  function devolver_deposito() {
    idDeposito = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idDeposito)) {
      alerta('<h4>Debes seleccionar un DEPOSITO para DEVOLVER.</h4>');
    } else {
      mostrar_contenidos(
        'servicios',
        'depositos',
        'formatoDevolverDeposito',
        'registro-deposito=' + idDeposito
        );
    }
  }
  function ver_resumen_servicio() {
    idDeposito = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idDeposito)) {
      alerta('<h4>Debes seleccionar un DEPOSITO para VER EL RESUMEN DEL SERVICIO Y EL DEPOSITO.</h4>');
    } else {
      ejecutarAccionEsperar(
        'servicios',
        'depositos',
        'verResumenDeposito',
        'registro-deposito=' + idDeposito,
        function (resumen) {
          $("#resumenServicioDeposito").hide();
          $("#resumenServicioDeposito").html(resumen);
          $("#resumenServicioDeposito").fadeIn(1234);
        }
      );
    }
  }
  function imprimir_resumen() {
    imprimir_area_html('Imprimir Resumen del Servicio y Deposito', 'pnl-resumenServicioDeposito');
  }




  function ver_ingreso_recibo() {
    idDeposito = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idDeposito)) {
      alerta('<h4>Debes seleccionar un DEPOSITO para VER EL DOCUMENTO DE SOPORTE DEL INGRESO.</h4>');
    } else {
      if (estaVacio(filaSeleccionada(oTable, 'data-ingreso-url'))) {
        alerta('<h4>Parece que este deposito no tiene asociado un DOCUMENTO DE SOPORTE DEL INGRESO.</h4>');
      } else {
        abrir_soportes(
          filaSeleccionada(oTable, 'data-ingreso-url'),
          'Ingreso del Deposito #' + filaSeleccionada(oTable, 'data-ingreso-numero')
          );
      }
    }
  }
  function ver_egreso_recibo() {
    idDeposito = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idDeposito)) {
      alerta('<h4>Debes seleccionar un DEPOSITO para VER EL DOCUMENTO DE SOPORTE DEL EGRESO.</h4>');
    } else {
      if (estaVacio(filaSeleccionada(oTable, 'data-egreso-url'))) {
        alerta('<h4>Parece que este DEPOSITO no tiene asociado un DOCUMENTO DE SOPORTE DEL EGRESO.</h4>');
      } else {
        abrir_soportes(
          filaSeleccionada(oTable, 'data-egreso-url'),
          'Egreso del Deposito #' + filaSeleccionada(oTable, 'data-egreso-numero')
          );
      }
    }
  }
  function ver_recibo_servicio() {
    idDeposito = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idDeposito)) {
      alerta('<h4>Debes seleccionar un DEPOSITO para VER EL RECIBO DEL SERVICIO asociado.</h4>');
    } else {
      if (estaVacio(filaSeleccionada(oTable, 'data-servicio-url'))) {
        alerta('<h4>Parece que este DEPOSITO no tiene asociado un RECIBO DEL SERVICIO asociado.</h4>');
      } else {
        abrir_soportes(
          filaSeleccionada(oTable, 'data-servicio-url'),
          'Recibo de Servicio #' + filaSeleccionada(oTable, 'data-servicio-numero')
          );
      }
    }
  }

</script>