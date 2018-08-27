<!DOCTYPE html>
<html lang="es">
  <head>
	<?php include 'inc/cabeza.html.php'; ?>
  </head>
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
		<?php include 'inc/izquierda.html.php'; ?>
		<?php include 'inc/top.html.php'; ?>        
        <div class="right_col" role="main" style="padding-bottom: 40px;" >
          <areaTrabajo></areaTrabajo>
          <footer>
            <div class="">
              <p class="pull-left"> Control de Entregas de Equipos | <a>Oximed Meiser S.A.S.</a>. |
                <span class="lead"> <i class="fa fa-paw"></i> Sistema de Información</span>
              </p>
            </div>
            <div class="clearfix"></div>
          </footer>
        </div>
      </div>
    </div>
	<!--    <div id="custom_notifications" class="custom-notifications dsp_none">
		  <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
		  </ul>
		  <div class="clearfix"></div>
		  <div id="notif-group" class="tabbed_notifications"></div>
		</div>-->
	<?php include 'inc/js.php'; ?>
	<div id="cargando"></div>
  </body>
</html>
