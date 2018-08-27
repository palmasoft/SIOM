<li id="lst-<?php echo $cedula_referencia ?>" >
  <div class="row" > 
    <div class="col-md-3 col-sm-3 col-xs-12"> 
      <a href="javasscript:void(0)" onclick="editarReferencia();" >
        <img style="max-width: 100%; " class=" img img-rounded image" src="<?php echo $url_imagen_referencia ?>" alt="Referencia Personal" />
      </a>
      <input type="hidden" id="item_url_imgreferencia_<?php echo $cedula_referencia ?>" name="item_url_imgreferencia[]" value="<?php echo $url_imagen_referencia ?>" />	  
      <div class="text-center" >
<!--        <a class="close-link btn btn-mini btn-link" style="margin: 0px;"><i class="fa fa-edit"></i> Modificar </a>-->
        <a href="javascript:void(0)" onclick="borrar_item_lista_referencias('<?php echo $cedula_referencia ?>');" 
           class="close-link btn btn-mini btn-link"  style="margin: 0px;"><i class="fa fa-close"></i> Quitar </a>
      </div>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-12" >	  
      <div>
        <a href="javasscript:void(0)" onclick="editarReferencia();" >
          <span>
            <span><?php echo $nombres_referencia ?></span>
            <input type="hidden" id="item_nombre-referencia_<?php echo $cedula_referencia ?>" name="item_nombre-referencia[]" value="<?php echo $nombres_referencia ?>" />
            <span><?php echo $apellidos_referencia ?></span>
            <input type="hidden" id="item_apellido-referencia_<?php echo $cedula_referencia ?>" name="item_apellido-referencia[]" value="<?php echo $apellidos_referencia ?>" />
            <span class="time"><?php echo $etiquetas_referencia ?></span>
            <input type="hidden" id="item_etiquetas-referencia_<?php echo $cedula_referencia ?>" name="item_etiquetas-referencia[]" value="<?php echo $etiquetas_referencia ?>" />
          </span>		  
        </a>		
      </div>
      <div>
        <span><?php echo $cedula_referencia ?></span>
        <input type="hidden" id="item_cedula-referencia_<?php echo $cedula_referencia ?>" name="item_cedula-referencia[]" value="<?php echo $cedula_referencia ?>" />
      </div>
      <div>
        <span><?php echo $email_referencia ?></span>
        <input type="hidden" id="item_email-referencia_<?php echo $cedula_referencia ?>" name="item_email-referencia[]" value="<?php echo $email_referencia ?>" />
      </div>
      <div>
        <span><?php echo $telefono_referencia ?></span>
        <input type="hidden" id="item_tel-referencia_<?php echo $cedula_referencia ?>" name="item_tel-referencia[]" value="<?php echo $telefono_referencia ?>" />
      </div>
      <div>
        <span><strong><?php echo $celular_referencia ?></strong></span>
        <input type="hidden" id="item_cel-referencia_<?php echo $cedula_referencia ?>" name="item_cel-referencia[]" value="<?php echo $celular_referencia ?>" />
      </div>
      <div>
        <span class="message"><?php echo $direccion_referencia ?></span>
        <input type="hidden" id="item_dir-referencia_<?php echo $cedula_referencia ?>" name="item_dir-referencia[]" value="<?php echo $direccion_referencia ?>" />
      </div>
      <div>
        <div class="fa-hover ">
          <?php if (isset($recibe_equipos_referencia) and ( $recibe_equipos_referencia == 'on' or $recibe_equipos_referencia == 'SI' )): ?>
            <i class="fa fa-check-square" style="font-size: 100%;"></i>
            <input type="hidden" id="item_recibe-equipos-referencia_<?php echo $cedula_referencia ?>" name="item_recibe-equipos-referencia[]" value="SI" />
          <?php else: ?>		  
            <i class="fa fa-square" style="font-size: 100%;"></i>
            <input type="hidden" id="item_recibe-equipos-referencia_<?php echo $cedula_referencia ?>" name="item_recibe-equipos-referencia[]" value="NO" />
          <?php endif; ?> ¿recibe equipos? 
        </div>
        <div class="fa-hover ">
          <?php if (isset($recibe_deposito_referencia) and ( $recibe_deposito_referencia == 'on' or $recibe_deposito_referencia == 'SI' )): ?>
            <i class="fa fa-check-square" style="font-size: 100%;"></i>
            <input type="hidden" id="item_recibe-deposito-referencia_<?php echo $cedula_referencia ?>" name="item_recibe-deposito-referencia[]" value="SI" />
          <?php else: ?>		  
            <i class="fa fa-square" style="font-size: 100%;"></i>
            <input type="hidden" id="item_recibe-deposito-referencia_<?php echo $cedula_referencia ?>" name="item_recibe-deposito-referencia[]" value="NO" />
          <?php endif; ?>¿recibe depositos?		  
        </div>
      </div>
    </div>
    <input type="hidden" name="item_id-item-referencia[]" id="item_id-item-referencia_<?php echo $cedula_referencia ?>" 
           class="item_id-item-referencia" value="<?php echo $cedula_referencia ?>" />
  </div>
  <div style="clear: both;" ></div>
</li>	



<script>
  $(document).ready(function () {
  });

  function borrar_item_lista_referencias(cedula) {
    confirmar(
      "¿Seguro que desea eliminar esta PERSONA de la liste de REFERENCIAS?",
      function (resp) {
        $('#lst-' + cedula).remove();
      }
    );
  }

</script>








<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

