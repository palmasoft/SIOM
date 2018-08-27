<div class="sidebar-footer hidden-small">
  <a data-toggle="tooltip" data-placement="top" title="Configuración">
    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
  </a>
  <a id="cambiarPantallaCompleta" data-toggle="tooltip" data-placement="top" title="Ir a Pantalla Completa" 
     href="javascript:void();" onclick="pantallaCompleta(body);"  >
    <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
  </a>
  <a id="salirPantallaCompleta" data-toggle="tooltip" data-placement="top" title="Salir Pantalla Completa" 
     href="javascript:void();" onclick="salirPantallaCompleta();"  style="display: none;">
    <span class="fa fa-compress" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Suspender">
    <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
  </a>
  <a data-toggle="tooltip" data-placement="top" title="Cerrar" href="javascript:void();" onclick="salir_sistema();">
    <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
  </a>
</div>

<script>
  $(document).ready(function () {
    $("#cambiarPantallaCompleta").click(function () {
      //pantallaCompleta('body');
      $(this).hide()
      $("#salirPantallaCompleta").show();
    });
    $("#salirPantallaCompleta").click(function () {
      //salipantallaCompleta();
      $(this).hide()
      $("#cambiarPantallaCompleta").show();
    });
  });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

