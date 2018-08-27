<table id="reporteRecibos" class="table table-striped responsive-utilities jambo_table table-seleccionable table-responsive col-md-12 col-sm-12 col-xs-12" >
  <thead>
    <tr>                    
      <th></th>
      <th>Fecha</th>
      <th>Servicio</th>
      <th>Recibo</th>
      <th>Cliente</th>
      <th>Referencia</th>
      <th>Empleado</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($RecibosConsulta as $Recibo): ?>
      <tr id="resultado-consulta_<?php echo $Recibo->servicioId ?>" data-servicio="<?php echo $Recibo->servicioId ?>" data-resumen="cerrado" >
        <td id="btn_expandir_contraer_<?php echo $Recibo->servicioId ?>" > <i class="fa fa-plus-square" ></i> </td>
        <td><?php echo $Recibo->reciboFechaServicio ?></td>
        <td><?php echo $Recibo->servicioCodigo ?></td>
        <td><?php echo $Recibo->reciboNumero ?></td>
        <td><?php echo $Recibo->clienteCodigo ?></td>
        <td><?php echo $Recibo->idReferencia ?></td>
        <td><?php echo $Recibo->usuarioNombre ?></td>
        <td><strong><?php echo $Recibo->servicioEstado ?></strong></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>




<script type="text/javascript">
  $(document).ready(function () {
    $("#reporteRecibos tr").click(function () {
      var idResumen = $(this).attr('data-servicio');
      var verResumen = $(this).attr('data-resumen');
      if (verResumen == 'cerrado') {

        cargarResumenServicio(idResumen);

      } else {
        $("tr#resumen_" + idResumen).fadeOut("slow");
        setTimeout(function () {
          $("tr#resumen_" + idResumen).remove();
          $("#btn_expandir_contraer_" + idResumen).html('<i class="fa fa-plus-square" ></i>');
        }, 300);
        $(this).attr('data-resumen', 'cerrado');
      }
    });

    $("#reporteRecibos").dataTable();
    //$("#report").jExpand();
  });

  function cargarResumenServicio(idServicio) {
    ejecutarAccion('consultas', 'recibos', 'consultaResumenServicio', 'registro_servicio=' + idServicio,
      function (htmlRespuesta) {
        $('<tr id="resumen_' + idServicio + '" style="display:none;" ><td colspan="8" style="text-align:center;" >'
          + htmlRespuesta +
          '</td></tr>').insertAfter($("tr#resultado-consulta_" + idServicio));
        $("tr#resumen_" + idServicio).fadeIn("slow");
        $("tr#resultado-consulta_" + idServicio).attr('data-resumen', 'abierto');
        $("#btn_expandir_contraer_" + idServicio).html('<i class="fa fa-minus-square" ></i>');
      })
  }


</script>   









<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

