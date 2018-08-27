
<div id="mapa-cliente" style="width:100%;height:420px;"></div>







<script type="text/javascript">

  var map;
  var marcador;
  $(document).ready(function () {
    var bounds = new google.maps.LatLngBounds();
<?php if (isset($datosCliente) and ! is_null($datosCliente->personaLatitud)): ?>
      var lat = <?php echo $datosCliente->personaLatitud ?>;
<?php else: ?>
      var lat = 11.253427413<?php echo rand(0, 9) ?>;
<?php endif; ?>

<?php if (isset($datosCliente) and ! is_null($datosCliente->personaLongitud)): ?>
      var lng = <?php echo $datosCliente->personaLongitud ?>;
<?php else: ?>
      var lng = -74.196884<?php echo rand(0, 9) ?>;
<?php endif; ?>

    map = new GMaps({
      el: '#mapa-cliente',
      lat: lat,
      lng: lng,
      zoom: 15,
      zoomControl: true,
      zoomControlOpt: {
        style: 'SMALL',
        position: 'TOP_LEFT'
      },
      panControl: false,
      streetViewControl: false,
      mapTypeControl: false,
      overviewMapControl: false
    });
    marcador = map.addMarker({
      lat: lat,
      lng: lng,
      title: 'Ubicacion Actual',
      icon: 'archivos/oximeiser/marcadores/clientes.png',
      click: function (e) {
        alert('Ubicacion Registrada para el Cliente');
      }
    });

  });


</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

