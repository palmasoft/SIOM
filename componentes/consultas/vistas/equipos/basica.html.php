<table id="reporteRecibos" class="table table-striped responsive-utilities jambo_table table-seleccionable table-responsive col-md-12 col-sm-12 col-xs-12" >
  <thead>
    <tr>                    
      <th></th>
      <th>Tipo</th>
      <th>Codigo</th>
      <th>Serial</th>
      <th>Nombre</th>
      <th>Capacidad</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($EquiposConsulta as $Recibo): ?>
      <tr id="resultado-consulta_<?php echo $Recibo->equipoId ?>" data-equipo="<?php echo $Recibo->equipoId ?>" data-resumen="cerrado" >
        <td id="btn_expandir_contraer_<?php echo $Recibo->equipoId ?>" > <i class="fa fa-plus-square" ></i> </td>
        <td><?php echo $Recibo->tipoEquipoTitulo ?></td>
        <td><?php echo $Recibo->equipoCodigo ?></td>
        <td><?php echo $Recibo->equipoSerial ?></td>
        <td><?php echo $Recibo->equipoTitulo ?></td>
        <td><?php echo $Recibo->equipoCapacidad ?></td>
        <td><strong><?php echo $Recibo->equipoEstadoTitulo ?></strong></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>




<script type="text/javascript">
  $(document).ready(function () {
    $("#reporteRecibos tr").click(function () {
      var idEquipo = $(this).attr('data-equipo');
      var verResumen = $(this).attr('data-resumen');
      if (verResumen == 'cerrado') {
        cargarResumenEquipo(idEquipo);
      } else {
        $("tr#resumen_" + idEquipo).fadeOut("slow");
        setTimeout(function () {
          $("tr#resumen_" + idEquipo).remove();
          $("#btn_expandir_contraer_" + idEquipo).html('<i class="fa fa-plus-square" ></i>');
        }, 300);
        $(this).attr('data-resumen', 'cerrado');
      }
    });

    $("#reporteRecibos").dataTable();
    //$("#report").jExpand();
  });

  function cargarResumenEquipo(idEquipo) {
    ejecutarAccion('consultas', 'recibos', 'consultaResumenEquipo', 'registro_equipo=' + idEquipo,
      function (htmlRespuesta) {
        $('<tr id="resumen_' + idEquipo + '" style="display:none;" ><td colspan="8" style="text-align:center;padding-top:0px;" >'
          + htmlRespuesta +
          '</td></tr>').insertAfter($("tr#resultado-consulta_" + idEquipo));
        $("tr#resumen_" + idEquipo).fadeIn("slow");
        $("tr#resultado-consulta_" + idEquipo).attr('data-resumen', 'abierto');
        $("#btn_expandir_contraer_" + idEquipo).html('<i class="fa fa-minus-square" ></i>');
      })
  }


</script>   









<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

