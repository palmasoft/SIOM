<!-- DEPOSITO -->
<form id="form-deposito-servicio">
  <div class="row">
    <!-- deposito -->
    <div class="col-md-8  col-xs-12">
      <div class="row">
        <div class="col-md-12" >
          <p class="lead"><strong>Deposito:</strong></p>
          <div>
            <div class="radio">
              <label>
                <input type="radio" class="flat deposito_servicio" checked name="deposito-servicio" data-valor="0" value="0" > NO ENTREGA
              </label>
            </div>
            <?php
            foreach($TiposDepositos as $Deposito):
              ?>
              <?php $chequeado = ( isset($datosDelServicios->depositoRecibo) ? ( $Deposito->depositoId == $datosDelServicios->depositoRecibo->reciboDepositoTipo ? 'checked' : '' ) : ''); ?>
              <div class="radio">
                <label>                  
                  <input type="radio" class="flat deposito_servicio" 
                         id="deposito-servicio-<?php echo $Deposito->depositoCodigo ?>" name="deposito-servicio" 
                         data-valor="<?php echo $Deposito->depositoValor ?>" <?php echo $chequeado; ?>
                         value="<?php echo $Deposito->depositoId ?>"> <?php echo $Deposito->depositoTitulo ?>
                </label>
              </div>
            <?php endforeach; ?>
            <div>Otro valor $:<input type="number" id="otroValor" name="otroValor" value="0" min="0" />
            </div>
          </div>
        </div>
        <div class="col-md-12">                  
          <p class="lead">Valor a Entregar: <strong><span id="valor-deposito">$ <?php
                echo isset($datosDelServicios->depositoRecibo) ? number_format($datosDelServicios->depositoRecibo->reciboDepositoValor,
                  0, ',', '.') : '000.000'
                ?></span></strong></p>
          <?php // print_r($datosDelServicios->depositoRecibo) ?>
          <h2></h2>
        </div>
      </div>
    </div>
    <!-- /.col -->
    <div class="col-md-4  col-xs-12">
      <p class="lead">Resumen del Servicio</p>
      <div class="table-responsive">
        <table class="table">
          <tbody>
            <tr>
              <th style="width:50%">Total de Equipos:</th>
              <td style="font-size: 160%; text-align: right" >
                <span id="equipos-totales-servicio"><?php echo $ttlEquipos ?></span></td>
            </tr>
            <tr>
              <th>Entregados:</th>
              <td  style="font-size: 160%; text-align: right" >
                <span id="equipos-entregados-servicio"><?php echo $ttlEquiposEnServicio ?></span></td>
            </tr>
            <tr>
              <th>Recibidos:</th>
              <td style="font-size: 160%; text-align: right" >
                <span id="equipos-recibidos-servicio"><?php echo $ttlEquiposRecogidos ?></span></td>
            </tr>
            <tr>
              <th>NO Entregados:</th>
              <td style="font-size: 160%; text-align: right" >
                <span id="equipos-norecibidos-servicio"><?php echo $ttlEquiposPerdidos ?></span></td>
            </tr>
            <tr>
              <th>Devueltos:</th>
              <td style="font-size: 160%; text-align: right" >
                <span id="equipos-devueltos-servicio"><?php echo $ttlEquiposDevueltos ?></span></td>
            </tr>
            <tr>
              <th>Deposito por los equipos:</th>
              <td style="font-size: 180%; text-align: right" >
                <span id="equipos-deposito-servicio">$ <?php
                  echo isset($datosDelServicios->depositoRecibo) ? number_format($datosDelServicios->depositoRecibo->reciboDepositoValor,
                    0, ',', '.') : '000.000'
                  ?></span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    
    <div class="col-xs-12">        
      <p class="text-muted well well-sm no-shadow text-justify" style="margin-top: 10px;">
        <em><strong>Informacion legal sobre el deposito y la responsabilidad sobre el equipo entregado.</strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec scelerisque erat vel nisi feugiat tincidunt. In imperdiet orci nec dictum feugiat. Phasellus pulvinar magna id posuere sollicitudin. Curabitur elementum metus metus, vel cursus est auctor scelerisque. Nullam malesuada et dolor eget gravida. Fusce tincidunt elementum tincidunt. Nam varius felis sed pulvinar placerat. Praesent vel accumsan mi. Quisque pellentesque mi posuere nisi tristique fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</em>
      </p>
    </div>
    <!-- /.col -->
  </div>
</form>

<script type="text/javascript" >
  $(document).ready(function () {

  });
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

