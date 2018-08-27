          
<form id="form-equipos-servicio">
  <div class="row">
    <div class="col-xs-12 table">
      <table id="tabla-equipos-recibo" class="table table-striped dataTable"  >
        <thead>
          <tr>
            <th style="text-align: center;" class="hidden-xs hidden-sm">Cant</th>
            <th style="text-align: center;" class="hidden-xs">Tipo</th>
            <th style="text-align: center;">Equipo</th>
            <th style="text-align: center;">Serial #</th>
            <th style="text-align: center;">Cap.</th>
            <th style="text-align: center;width: 39%"></th>
            <th style="text-align: center;">Movimiento</th>
            <th style="text-align: center;"></th>
          </tr>
        </thead>
        <tbody id="lista-equipos-recibo-servicio" >
          <?php
          self::$datos['ttlEquiposEnServicio'] = 0;
          self::$datos['ttlEquiposRecogidos'] = 0;
          self::$datos['ttlEquiposPerdidos'] = 0;
          self::$datos['ttlEquiposDevueltos'] = 0;
          self::$datos['ttlEquipos'] = 0;

          if(isset($datosDelServicios)):
            self::$datos['ttlEquipos'] = count($datosDelServicios->equiposRecibo);
            foreach($datosDelServicios->equiposRecibo as $ReciboEquipo):
              ?>                    
              <?php
//                      print_r($ReciboEquipo);
              self::$datos['ReciboEquipo'] = $ReciboEquipo;
              switch(self::$datos['ReciboEquipo']->reciboEquipoMovimiento) {
                case '1':self::$datos['ttlEquiposEnServicio'] ++;
                  self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-success' >ENTREGADO</span>";
                  self::$datos['ReciboEquipo']->reciboEquipoMovimiento = 'entregado';
                  break;
                case '2':self::$datos['ttlEquiposRecogidos'] ++;
                  self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-info' >RECIBIDO</span>";
                  self::$datos['ReciboEquipo']->reciboEquipoMovimiento = 'buen_estado';
                  break;
                case '3':self::$datos['ttlEquiposPerdidos'] ++;
                  self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-danger' >PERDIDO</span>";
                  self::$datos['ReciboEquipo']->reciboEquipoMovimiento = 'perdido';
                  break;
                case '4':self::$datos['ttlEquiposDevueltos'] ++;
                  self::$datos['ReciboEquipo']->reciboEquipoMovimientoLabel = "<span class='label label-warning' >DEVUELTO</span>";
                  self::$datos['ReciboEquipo']->reciboEquipoMovimiento = 'devuelto';
                  break;
                default:
                  break;
              }
              Vistas::cargar('equipos' . DS . 'fila-tabla-recibo', self::$datos);
              ?>
            <?php endforeach; ?>
          <?php endif; ?>
          <tr>
            <td class="hidden-xs hidden-sm"></td>
            <td class="hidden-xs "></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td class="hidden-xs hidden-sm"></td>
            <td class="hidden-xs "></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
</form>

<script>
  $(document).ready(function () {
//    $('.dataTable').dataTable({});
  });
</script>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

