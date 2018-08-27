<?php //print_r($funcionesEmpleado)    ?>
<div class="form-group">
  <div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: center; font-size: 150%;" >Funciones del Sistema</label>
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <?php
    $modulo = 0;
    foreach($funciones as $Funcion) :
      ?>
      <?php
      $check = "";
      if( isset($funcionesEmpleado) and count($funcionesEmpleado)) {
        foreach($funcionesEmpleado as $delEmpleado) {
          if($delEmpleado->funcionId == $Funcion->funcionId) {
            $check = "checked";
          }
        }
      }
      ?>
      <?php if($modulo !== ($Funcion->componenteId)): ?>
        <h4><i class="<?php echo ($Funcion->componenteIcono) ?>" ></i> <?php echo strtoupper($Funcion->componenteTitulo) ?> </h4>
        <?php
        $modulo = $Funcion->componenteId;
      endif;
      ?>
      <div class="" style="cursor: pointer">        
        <label>
          <input type="checkbox" class="js-switch" <?php echo $check; ?>
                 id="funciones_sistema_<?php echo $Funcion->funcionId ?>" name="funciones_sistema[]"  
                 value="<?php echo $Funcion->funcionId ?>" />
          <i class="fa fa-cubes" ></i> <span style="cursor: pointer" ><?php echo strtoupper($Funcion->funcionNombre) ?></span>
        </label>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script type="text/javascript" >
  $(document).ready(function () {
    if ($(".js-switch")[0]) {
      var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
      elems.forEach(function (html) {
        var switchery = new Switchery(html, {
          color: '#26B99A'
        });
      });
    }
  });
</script>