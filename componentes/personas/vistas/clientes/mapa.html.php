
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Mapa de Clientes <small>y sus ubicaciones registradas.</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <?php Vistas::cargar('clientes' . DS . 'todos', self::$datos, 'ubicaciones'); ?>
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="col-md-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Galeria de Clientes <small> registrados</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>          
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">

        <div class="row">

          <?php if(count($Clientes)) foreach($Clientes as $Cliente): ?>
              <div class="col-md-4">
                <div class="thumbnail">
                  <div class="image view view-first">
                    <img style="width: 100%; display: block;" src="<?php echo $Cliente->personaFotoReferencia ?>" alt="<?php echo $Cliente->personaRazonSocial ?>" />
                    <div class="mask">
                      <p><?php echo $Cliente->personaRazonSocial ?></p>
                      <div class="tools tools-bottom">
                        <a href="javascript:void(0);" title="ir a la ubicaión de este cliente" onclick="centrarMapaClientes(<?php echo $Cliente->personaLatitud ?>,<?php echo $Cliente->personaLongitud ?>);" ><i class="fa fa-map-marker"></i></a>
    <!--                      <a href="#"><i class="fa fa-pencil"></i></a>
                        <a href="#"><i class="fa fa-times"></i></a>-->
                      </div>
                    </div>
                  </div>
                  <div class="caption">
                    <p><strong><?php echo $Cliente->clienteCodigo ?></strong> | <?php echo $Cliente->personaCelular ?><br/><?php echo $Cliente->personaCorreoElectronico ?><br /><br /><?php echo $Cliente->personaObservaciones ?></p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
        </div>

      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {

  });

  function centrarMapaClientes(lat, lng) {
    map.setCenter(lat, lng);
    map.setZoom(17);
  }

</script>


<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

