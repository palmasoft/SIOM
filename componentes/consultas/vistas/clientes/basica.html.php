<table id="reporteClientes" class="table table-striped responsive-utilities jambo_table table-seleccionable table-responsive col-md-12 col-sm-12 col-xs-12" >
  <thead>
    <tr>                    
      <th></th>
      <th>Tipo</th>
      <th>Codigo</th>
      <th>Doc. ID </th>
      <th>Nombre</th>
      <th>Direccion</th>
      <th>Contactos</th>
      <th>Estado</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($ClientesConsulta as $Cliente): ?>
      <tr id="resultado-consulta_<?php echo $Cliente->clienteId ?>" data-equipo="<?php echo $Cliente->clienteId ?>" data-resumen="cerrado" >
        <td id="btn_expandir_contraer_<?php echo $Cliente->clienteId ?>" > <i class="fa fa-plus-square" ></i> </td>
        <td><?php echo $Cliente->tipoClienteTitulo ?></td>
        <td><?php echo $Cliente->clienteCodigo ?></td>
        <td><?php echo $Cliente->tipoIdentificacionCodigo ?> <?php echo $Cliente->personaIdentificacion ?></td>
        <td><?php echo $Cliente->personaRazonSocial ?></td>
        <td><?php echo $Cliente->personaDireccion ?></td>
        <td><?php echo $Cliente->cantContactos ?></td>
        <td><strong><?php echo $Cliente->clienteEstado ?></strong></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>




<script type="text/javascript">
  $(document).ready(function () {
    $("#reporteClientes tr").click(function () {
      var idCliente = $(this).attr('data-equipo');
      var verResumen = $(this).attr('data-resumen');
      if (verResumen == 'cerrado') {
        cargarResumenCliente(idCliente);
      } else {
        $("tr#resumen_" + idCliente).fadeOut("slow");
        setTimeout(function () {
          $("tr#resumen_" + idCliente).remove();
          $("#btn_expandir_contraer_" + idCliente).html('<i class="fa fa-plus-square" ></i>');
        }, 300);
        $(this).attr('data-resumen', 'cerrado');
      }
    });

    $("#reporteClientes").dataTable();
    //$("#report").jExpand();
  });

  function cargarResumenCliente(idCliente) {
    ejecutarAccion('consultas', 'recibos', 'consultaResumenCliente', 'registro_cliente=' + idCliente,
      function (htmlRespuesta) {
        $('<tr id="resumen_' + idCliente + '" style="display:none;" ><td colspan="8" style="text-align:center;padding-top:0px;" >'
          + htmlRespuesta +
          '</td></tr>').insertAfter($("tr#resultado-consulta_" + idCliente));
        $("tr#resumen_" + idCliente).fadeIn("slow");
        $("tr#resultado-consulta_" + idCliente).attr('data-resumen', 'abierto');
        $("#btn_expandir_contraer_" + idCliente).html('<i class="fa fa-minus-square" ></i>');
      })
  }


</script>   









<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

