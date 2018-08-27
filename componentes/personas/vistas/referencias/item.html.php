
<div class="col-md-12" > 
  <div class="col-md-3 col-sm-4 col-xs-12"> 
    <img style="max-width: 100%; " class=" img img-rounded image" src="<?php echo $Referencia->personaFotoReferencia ?>" alt="Referencia Personal" />
  </div>
  <div class="col-md-9 col-sm-8 col-xs-12 text-left" >	  
    <div>

      <span>
        <span><?php echo $Referencia->personaNombres ?> <?php echo $Referencia->personaApellidos ?></span>
        <span></span>
        <span class="time"><span class="label label-primary"><?php echo $Referencia->clienteContactoEtiquetas ?></span></span>        
      </span>		  

    </div>
    <div>
      <span><?php echo $Referencia->personaIdentificacion ?></span>      
    </div>
    <div>
      <div class="fa-hover ">
        <?php if (isset($Referencia->clienteContactoRecibeEquipos) and $Referencia->clienteContactoRecibeEquipos == 'SI'): ?>
          <i class="fa fa-check-square" style="font-size: 100%;"></i>

        <?php else: ?>		  
          <i class="fa fa-square" style="font-size: 100%;"></i>

        <?php endif; ?> ¿recibe equipos? 
      </div>
      <div class="fa-hover ">
        <?php if (isset($Referencia->clienteContactoRecibeDeposito) and $Referencia->clienteContactoRecibeDeposito == 'SI'): ?>
          <i class="fa fa-check-square" style="font-size: 100%;"></i>

        <?php else: ?>		  
          <i class="fa fa-square" style="font-size: 100%;"></i>
        <?php endif; ?>¿recibe depositos?		  
      </div>
    </div>
  </div>
  <input type="hidden" name="item_id-item-referencia[]" id="item_id-item-referencia_<?php echo $cedula_referencia ?>" 
         class="item_id-item-referencia" value="<?php echo $Referencia->clienteContactoId ?>" />
</div>
<div style="clear: both;" ></div>






<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

