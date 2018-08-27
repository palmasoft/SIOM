<?php // Vistas::cargar('datosEstadisticos', self::$datos, 'reportes');              ?>
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Ubicaciónes <small>equipos, clientes y usuarios</small></h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><span id="timerRecarga" class="label label-danger" style="font-size: 150%;">##</span></li>
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
          <li class="dropdown">
            <a href="<?php echo Plantillas::$url ?>#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
              <li> 
                <div class="radio">
                  <label>
                    <input type="checkbox" class="flat" name="ubi_equipos"> Equipos
                  </label>
                </div>
              </li>
              <li> 
                <div class="radio">
                  <label>
                    <input type="checkbox" class="flat" name="ubi_clientes"> Clientes
                  </label>
                </div>
              </li>
              <li> 
                <div class="radio">
                  <label>
                    <input type="checkbox" class="flat" name="ubi_usuarios"> Usuarios
                  </label>
                </div>
              </li>
            </ul>
          </li>
          <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="dashboard-widget-content">
          <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                <h2>Recogidas <small>proximas fechas</small></h2>
                <div class="clearfix"></div>
              </div>
              <div class="x_content" style="max-height: 520px; overflow-x: hidden;overflow-y: auto;" >
                <?php Vistas::cargar('proximasRecogidas', self::$datos, 'servicios'); ?>
              </div>
            </div>
          </div>
          <div id="div-mapageneral" class="col-md-8 col-sm-12 col-xs-12"  >
            <?php Vistas::cargar('mapaGeneral', self::$datos, 'ubicaciones'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var timerPanel;
  var tiempoEntreRecargasPanel = 120;
  var tRecargaPanel = tiempoEntreRecargasPanel;
  $(document).ready(function () {
    $('input.flat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    clearInterval(timerPanel);
    timerPanel = setInterval(function () {
      $("#timerRecarga").html(tRecargaPanel);
      tRecargaPanel--;
      if (tRecargaPanel == 0) {
        tRecargaPanel = tiempoEntreRecargasPanel;
        recargarPanel();
      }
    }, 1000);
  });
  function recargarPanel() {
    ejecutarAccion('ubicaciones', 'mapas', 'mapaGeneral', '', function (resp) {
      //alert(resp);
      $("#div-mapageneral").html(resp);
      //setTimeout(recargarPanel(), 10000);
    });
  }
</script>

<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

