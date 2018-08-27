
<div class="row resumen_consulta" style="">
  <div class="" >
    <div class="col-md-5 col-sm-12 col-xs-12">
      <div>
        <div class="col-xs-12 col-sm-12">
          <div class="image view view-first text-center" style="height: 64px; ">       
            <img style="width: 100%; display: block;" src="<?php echo $DatosEquipo->equipoUrlBARRAS ?>" alt="Codigo de Barras" />          
          </div>
        </div>
      </div>
      <div class="lead">Datos del Equipo</div>
      <div class="col-xs-12 col-sm-6">
        <div class=" view view-first">
          <img style="width: 100%; display: block;" src="<?php echo $DatosEquipo->equipoUrlQR ?>" alt="Codigo QR" />          
        </div>
        <div class="caption">
          <div><strong><?php echo $DatosEquipo->equipoSerial ?></strong></div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-6">
        <div class="well well-sm shadow">
          <div class="small" style="font-weight: bold; color: green;"><?php echo $DatosEquipo->tipoEquipoTitulo ?></div>
          <div><?php echo $DatosEquipo->equipoTitulo ?></div>
          <div><strong><?php echo $DatosEquipo->equipoCodigo ?></strong></div>
          <div class="">cap.  <?php echo $DatosEquipo->equipoCapacidad ?></div>
          <p><?php echo $DatosEquipo->equipoObservaciones ?></p>
        </div>
      </div>
    </div>

    <div class="col-md-7 col-sm-12 col-xs-12">
      <?php
      $sello = 'label-default';
      $enSevicio = false;
      $cliente = '';
      $recibo = '';
      $ProximaRecogida = '';
      switch($DatosEquipo->equipoEstadoServicio) {
        case Equipos::$DISPONIBLE: $sello = 'label-success';
          break;
        case Equipos::$EN_SERVICIO: $sello = 'label-warning';
          $cliente = $DatosEquipo->clienteCodigo;
          $recibo = $DatosEquipo->reciboNumero;
          $ProximaRecogida = $DatosEquipo->reciboFechaRecogida;
          $enSevicio = true;
          break;
        case Equipos::$DESHABILITADO: $sello = 'label-danger';
          break;
        case Equipos::$EN_MANTENIMIENTO: $sello = 'label-important';
          break;
      }
      ?>
      <div>Estado: <strong><span class="label large <?php echo $sello ?>" style="font-size: 100%;"><?php echo $DatosEquipo->equipoEstadoTitulo ?></span></strong> </div>
      <?php if($enSevicio): ?>
        <div>Cliente: <strong><?php echo $cliente ?></strong> | Recibo: <strong><?php echo $recibo ?></strong> | Recogida: <strong><?php echo $ProximaRecogida ?></strong> | </div>
      <?php endif; ?>
      <div class="lead">Servicios asociados</div>
      <?php if(!count($DatosEquipo->RecibosServicios)): ?>
        <h3>No hay servicios o recibos asociados a este equipo.</h3>
      <?php endif; ?>
      <table id="tblResumenConsultaEquipo<?php echo $DatosEquipo->equipoId ?>" class="dataTable table table-striped">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Recibo</th>
            <th>Movimiento</th>
            <th>Cliente</th>
            <th>Empleado</th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($DatosEquipo->RecibosServicios)): foreach($DatosEquipo->RecibosServicios as $Recibo) : ?>
              <tr>
                <th scope="row"><?php echo $Recibo->reciboFechaServicio ?></th>
                <td><a href="<?php echo $Recibo->documentoUrl ?>" target="_blank"><?php echo $Recibo->reciboNumero ?></a></td>
                <td><?php echo $Recibo->movimientoCodigo ?></td>
                <td><?php echo $Recibo->clienteCodigo ?></td>
                <td><?php echo $Recibo->usuarioNombre ?></td>
              </tr>
              <?php
            endforeach;
          endif;
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  var oTable;
  $(document).ready(function () {
    oTable = $('#tblResumenConsultaEquipo<?php echo $DatosEquipo->equipoId ?>').DataTable({
      "aaSorting": [[0, "desc"]]
    });
  });
</script>


<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

