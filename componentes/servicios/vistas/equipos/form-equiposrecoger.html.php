
<div class="row no-print hidden-print">
  <div class="col-xs-12" >
    <div class="text-muted well well-sm no-shadow" style="">
      <form id="form-equipos-para-recoger" class="form form-inline" >
        <div class="row ">
          <div class="form-group col-md-8 col-sm-8 col-xs-12">
            <label class="control-label col-md-2 col-sm-3 col-xs-12">Recibiendo:</label>
            <div id="div-select-equipos-recoger-cliente"  class="col-md-10 col-sm-9 col-xs-12">
              <?php
              Vistas::cargar('equipos' . DS . 'select-equipos-para-recibir', self::$datos, 'productos');
              ?>                    
            </div>
          </div>
          <div class="form-group col-md-34 col-sm-4 col-xs-12">
            <div class="btn-group" > 
              <input type="hidden" id="estado_entrega_equipo" name="estado_entrega_equipo" value=""  />
              <button type="submit" class="btn btn-info"    onclick="$('#estado_entrega_equipo').val('buen_estado');"  >Buen Estado</button>
              <button type="submit" class="btn btn-danger"  onclick="$('#estado_entrega_equipo').val('perdido');">Perdido</button>
              <button type="submit" class="btn btn-warning" onclick="$('#estado_entrega_equipo').val('devuelto');">Devuelto</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {

    $("#form-equipos-para-recoger").submit(function () {
      ejecutarAccion(
        'servicios', 'equipos', 'nuevoFilaTabla', 'movimiento=' + $('#estado_entrega_equipo').val() + '&registro_equipo=' + $("#equipos-para-recoger").val(),
        function (respuesta) {
          $("#equipos-para-recoger option[value='" + $("#equipos-para-recoger").val() + "']").remove();
          $("#equipos-para-recoger").trigger("change");
          $("#lista-equipos-recibo-servicio").prepend(respuesta);
          actualizarResumenRecibo();
        });
    });
  });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

