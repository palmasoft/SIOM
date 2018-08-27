
<script src="<?php echo Plantillas::$url ?>js/bootstrap.min.js"></script>
<?php echo Plantillas::min_js(); ?>

<!-- gauge js -->
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/gauge/gauge.min.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/gauge/gauge_demo.js"></script>
<!-- chart js -->
<script src="<?php echo Plantillas::$url ?>js/chartjs/chart.min.js"></script>
<!-- bootstrap progress js -->
<script src="<?php echo Plantillas::$url ?>js/progressbar/bootstrap-progressbar.min.js"></script>
<script src="<?php echo Plantillas::$url ?>js/nicescroll/jquery.nicescroll.min.js"></script>
<!-- icheck -->
<script src="<?php echo Plantillas::$url ?>js/icheck/icheck.min.js"></script>

<!-- daterangepicker -->
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/moment.min.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/datepicker/daterangepicker.js"></script>
<!-- input mask -->
<script src="<?php echo Plantillas::$url ?>js/input_mask/jquery.inputmask.js"></script>
<script src="<?php echo Plantillas::$url ?>js/custom.js"></script>

<!-- Datatables -->
<script src="<?php echo Plantillas::$url ?>js/datatables/js/jquery.dataTables.js"></script>
<script src="<?php echo Plantillas::$url ?>js/datatables/tools/js/dataTables.tableTools.js"></script>

<!-- flot js -->
<!--[if lte IE 8]><script type="text/javascript" src="<?php echo Plantillas::$url ?>js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/date.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/curvedLines.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/flot/jquery.flot.resize.js"></script>



<?php echo Plantillas::js_modulos(); ?>

<!-- worldmap -->
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/jquery-jvectormap-2.0.1.min.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/gdp-data.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/jquery-jvectormap-world-mill-en.js"></script>
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/maps/jquery-jvectormap-us-aea-en.js"></script>

<!-- skycons -->
<script src="<?php echo Plantillas::$url ?>js/skycons/skycons.js"></script>
<script>
  var icons = new Skycons({
    "color": "#73879C"
  }), list = [
    "clear-day", "clear-night", "partly-cloudy-day",
    "partly-cloudy-night", "cloudy", "rain", "sleet", "snow", "wind",
    "fog"
  ], i;

  for (i = list.length; i--; ) {
    icons.set(list[i], list[i]);
  }
  icons.play();
</script>
<script>
  NProgress.done();
</script>
<!-- /datepicker -->
<!-- /footer content -->




<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

