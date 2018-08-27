<select id="equipos-para-entregar" name="equipos-para-entregar" class="select2 form-control" style="width: 100%" required="">
  <?php if(count($EquiposDisponibles)): foreach($EquiposDisponibles as $Equipo): ?>
      <option value="<?php echo $Equipo->equipoId ?>" ><?php echo $Equipo->tipoEquipoTitulo ?> <?php echo $Equipo->equipoCodigo ?> <?php echo $Equipo->equipoSerial ?></option>
      <?php
    endforeach;
  endif;
  ?>
</select>


<script>
  $(document).ready(function () {
    $("#equipos-para-entregar").select2({
      placeholder: "Seleccione el equipo que va ha entregar"
    });
  });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

