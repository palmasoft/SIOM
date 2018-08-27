<div class="row">
  <div class="col-xs-12" >
    <div class="x_panel fondo-gris">
      <div class="x_title">
        <h2>Motivos para la Modificación</h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form>  
          <label for="heard">Razón:</label>
          <?php
          foreach($RazonesModificacion as $Razon):
            ?>
            <div class="radio"  data-toggle="tooltip" title="<?php echo $Razon->tipoMotivoDescripcion ?>" >
              <label>
                <input type="radio" id="rd_razonmodifica_<?php echo $Razon->tipoMotivoId ?>" name="rd_razonmodifica" value="<?php echo $Razon->tipoMotivoId ?>" 
                       class="flat iradio_flat-red" required="" /> <?php echo $Razon->tipoMotivoTitulo ?>
              </label>
            </div>
          <?php endforeach; ?>
          <div class="clearfix"></div>
          <label for="message">Explicación : </label>
          <textarea name="razones_modificacion" id="razones_modificacion" rows="7" required="required" class="form-control" name="message" style="width: 100%"  
                    minlength="20" maxlength="210" ></textarea>
          <input type="submit" id="btn-razonmodifica" style="display: none;" />
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function () {

   
  });
</script>








<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

