<div class="row">
  <div class="col-xs-12" >
    <div class="text-muted well well-sm no-shadow" style="">
      <form id="form-direccion" class="form form-inline" >
        <div class="row ">
          <div class="form-group col-sm-4 col-xs-12">
            <label class="control-label col-md-12 col-sm-12 col-xs-12">Dirección del Servicio:</label>
            <div class="col-md-12 col-sm-12 col-xs-12">
              <textarea id="direccion-servicio" name="direccion-servicio" required=""
                        class="form-control col-xs-12 col-sm-12 col-md-12" rows="5" style="width: 100%;"
                        placeholder='dirección del servicio'><?php echo isset($datosDelServicios->reciboDireccion) ? $datosDelServicios->reciboDireccion : '' ?></textarea>
            </div>
            <!--                      
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Switch</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <div class="">
                    <label>
                      <input type="checkbox" class="js-switch" name="actualiza-ubicacion" /> Checked
                    </label>
                  </div>
                </div>
              </div>
            </div>-->
          </div>
          <div class="form-group col-sm-8 col-xs-12">
            <?php
            Vistas::cargar('servicios' . DS . 'ubicar', self::$datos,
                           'ubicaciones');
            ?>
          </div>
        </div>
        <input type="submit" id="btn-ubicacionservicio" style="display: none;" />
      </form>
    </div>
  </div>
</div>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

