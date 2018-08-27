<!-- Modal Box Content -->
<div id="info-dialog" title="Información del Sistema" >
	<h2>Sistema de Informaci&oacute;n de </h2><h2><?php echo $this->params->valor('NOMBREEMPRESA'); ?>.</h2>
	<h4><?php echo $this->params->valor('ESLOGANEMPRESA'); ?></h4>								
	<img src="<?php echo $this->params->valor('LOGOMINI'); ?>" title="<?php echo $this->params->valor('NOMBREEMPRESA'); ?>" style="float:right;" />
	<p>Sistema de informacion diseñado por <a  rel="tooltip" href="http://www.palmasoftltda.com/" title="Ir al sitio de Palmasoft Limitada | PURO INGENIO SAMARIO" target="_blank" >Palmasoft Limitada</a> </p>
	<blockquote>plantilla de inicio: <?php echo $this->params->valor('TEMPLATE'); ?></blockquote>
	<blockquote>plantilla de administraci&oacute;n: <?php echo $this->params->valor('ADMINTEMPLATE'); ?></blockquote>
	<footer>Todos los derechos reservados para <?php echo $this->params->valor('NOMBREEMPRESA'); ?> &copy; <?php echo date('Y'); ?> </footer>
</div> <!--! end of #info-dialog -->
<script>
$(document).ready(function() {
  // Handler for .ready() called.
  $('#info-dialog').hide();
  $('#info-dialog').slideDown('slow', function() {
    // Animation complete.
  });
});	
  
	
</script>
