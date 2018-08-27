
<script src="<?php echo Plantillas::$url ?>js/bootstrap.min.js"></script>
<?php echo Plantillas::min_js(); ?>

<!-- gauge js -->
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/gauge/gauge.min.js"></script>
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
<!-- switchery -->
<script src="<?php echo Plantillas::$url ?>js/switchery/switchery.min.js"></script>

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
<script type="text/javascript" src="<?php echo Plantillas::$url ?>js/bootstrap-wysiwyg.js"></script>

<!--<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAA-rM5Nd8rYdgByaGebRDbLBQ5iDWaCySvAWoJEPKh6ZTBTQDKcBSRl6Lx57xLsY129P0aj0O3TNDZ8w" type="text/javascript"></script>-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script type = "text/javascript" src = "<?php echo Plantillas::$url ?>js/gmaps/gmaps.js" ></script>

<script  type = "text/javascript" src = "<?php echo Plantillas::$url ?>js/calendar/fullcalendar.min.js"></script>
<script  type = "text/javascript" src = "<?php echo Plantillas::$url ?>js/calendar/es.js"></script>






<?php echo Plantillas::js_modulos(); ?>
<script src="<?php echo Plantillas::$url ?>js/personalizado.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        posicionUsuario();
<?php if (ORIGEN != 'SMARTPHONE'): ?>
            consultaAlertas();
<?php endif; ?>

    });
</script>

<script>
//  NProgress.done();
</script>
<!-- /datepicker -->
<!-- /footer content -->




<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

