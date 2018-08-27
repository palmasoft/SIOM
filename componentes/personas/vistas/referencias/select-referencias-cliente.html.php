<?php
$placeholder = "seleccione un cliente";
if(count($Referencias)) {
  $placeholder = "seleccione una referencia";
}
?>
<strong>REFERENCIA:</strong>
<div class="hidden-print no-print">
  <select id="referencia-cliente-servicio" name="referencia-cliente-servicio" class=" select2 " style="width: 100%" placeholder="seleccione un cliente" >
    <option value=""></option>
    <?php if(count($Referencias)) foreach($Referencias as $Referencia): ?>
        <?php $seleccionado = ( isset($datosDelServicios->reciboReferencia) ? ($datosDelServicios->reciboReferencia == $Referencia->clienteContactoId ? "selected" : "" ) : "" ); ?>
        <option  <?php echo $seleccionado ?>
          data-nombre="<?php echo $Referencia->personaRazonSocial ?>"  
          data-dir="<?php echo $Referencia->personaDireccion ?>"  
          data-tel="<?php echo $Referencia->personaTelefono ?>"  
          data-correo="<?php echo $Referencia->personaCorreoElectronico ?>"  
          data-latitud="<?php echo $Referencia->personaLatitud ?>"  
          data-longitud="<?php echo $Referencia->personaLongitud ?>"  
          value="<?php echo $Referencia->clienteContactoId ?>"  >
          <?php echo $Referencia->tipoIdentificacionCodigo ?> <?php echo $Referencia->personaIdentificacion ?> | <?php echo $Referencia->personaNombres ?> <?php echo $Referencia->personaApellidos ?>
        </option>
      <?php endforeach; ?>
  </select>
</div>
<address>
  <strong><span id="nombre-referencia-cliente"><?php echo isset($datosDelServicios->nombresReferencia) ? $datosDelServicios->nombresReferencia . " " . $datosDelServicios->apellidosReferencia : $placeholder ?></span></strong>
  <br><span id="dir-referencia-cliente"><?php echo isset($datosDelServicios->direccionReferencia) ? $datosDelServicios->direccionReferencia : $placeholder ?></span>                
  <br>Teléfono: <strong><span id="tel-referencia-cliente"><?php echo isset($datosDelServicios->celularReferencia) ? $datosDelServicios->celularReferencia : $placeholder ?></span></strong>
  <br>Correo: <strong><span id="correo-referencia-cliente"><?php echo isset($datosDelServicios->correoReferencia) ? $datosDelServicios->correoReferencia : $placeholder ?></span></strong>
</address>



<script>
  $(document).ready(function () {
    $("#referencia-cliente-servicio").select2({
      placeholder: "<?php echo $placeholder ?>"
    }).change(function () {
      $("#nombre-referencia-cliente").html($("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-nombre'));
      $("#dir-referencia-cliente").html($("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-dir'));
      $("#tel-referencia-cliente").html($("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-tel'));
      $("#correo-referencia-cliente").html($("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-correo'));


      $("#direccion-servicio").html($("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-dir'));
      colocarMarcador(
        $("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-latitud'),
        $("#referencia-cliente-servicio option[value='" + $(this).val() + "']").attr('data-longitud')
        );

    });
  });
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

