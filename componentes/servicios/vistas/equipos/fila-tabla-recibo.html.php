<tr>
  <td class="hidden-xs hidden-sm">1</td>
  <td><?php echo $ReciboEquipo->tipoEquipoCodigo ?><input type="hidden" name="item-tipo-equipo[]" id="item-tipo-equipo" value="<?php echo $ReciboEquipo->tipoEquipoTitulo ?>" /></td>
  <td><?php echo $ReciboEquipo->equipoCodigo ?><input type="hidden" name="item-codigo-equipo[]" id="item-codigo-equipo" value="<?php echo $ReciboEquipo->equipoCodigo ?>" /></td>
  <td><strong><?php echo $ReciboEquipo->equipoSerial ?><input type="hidden" name="item-serial-equipo[]" id="item-serial-equipo" value="<?php echo $ReciboEquipo->equipoSerial ?>" /></strong></td>
  <td><?php echo $ReciboEquipo->equipoCapacidad ?></td>
  <td><?php echo $ReciboEquipo->equipoTitulo ?></td>
  <td><?php echo $ReciboEquipo->reciboEquipoMovimientoLabel ?><input type="hidden" name="item-movimiento-equipo[]"  id="item-movimiento-equipo" value="<?php echo $ReciboEquipo->reciboEquipoMovimiento ?>" /></td>
  <td><a href="javascript:void(0)" onclick="quitarFilaTablaEquipo(this);" ><i class="fa fa-close" ></i></a><input type="hidden" name="item-id-equipo[]" id="item-id-equipo" value="<?php echo $ReciboEquipo->equipoId ?>" /></td>
</tr>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

