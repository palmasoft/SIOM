<?php if(count($primeros5porRecoger)): foreach($primeros5porRecoger AS $ProximaRecogida): ?>
    <?php //print_r($ProximaRecogida)      ?>
    <article class="media event">
      <a class="pull-left date" title="<?php echo ($ProximaRecogida->reciboFechaRecogida) ?>">
        <p class="month"><?php
          echo substr(
           Fechas::mes_espanol(
            intval(date("m", strtotime($ProximaRecogida->reciboFechaRecogida))) - 1
           ), 0, 4)
          ?></p>
        <p class="day"><?php echo date("d", strtotime($ProximaRecogida->reciboFechaRecogida)) ?></p>
      </a>
      <div class="media-body">
        <a class="title" href="<?php echo ($ProximaRecogida->documentoUrl) ?>" target="_blank"><?php echo ($ProximaRecogida->personaRazonSocial) ?></a>
        <p>
          <?php echo ($ProximaRecogida->referenciaNombres. " " . $ProximaRecogida->referenciaApellidos) ?>
        </p>
        <p>
          Recibo <a class="title" target="_blank" href="<?php echo ($ProximaRecogida->documentoUrl) ?>">#<?php echo ($ProximaRecogida->reciboNumero) ?></a>
        </p>

      </div>
    </article>

  <?php endforeach; ?>
<?php else: ?>
  <article class="media event">
    <a class="pull-left date">
      <p class="month">?????</p>
      <p class="day">??</p>
    </a>
    <div class="media-body">
      <a class="title" href="#">NO HAY PENDIENTES</a>
      <p>No hay registrados proximas regocidas de equipos.</p>
    </div>
  </article>

<?php endif; ?>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

