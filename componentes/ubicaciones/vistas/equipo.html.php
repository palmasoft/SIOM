
<div id="mapa-equipo" style="width:100%;height:420px;"></div>

<script type="text/javascript">
  var map;
  $(document).ready(function () {
    var bounds = new google.maps.LatLngBounds();
<?php if (isset($datosEquipo) and ! is_null($datosEquipo->equipoUltimaUbicacionLatitud)): ?>
      var lat = <?php echo $datosEquipo->equipoUltimaUbicacionLatitud ?>;
<?php else: ?>
      var lat = 11.253427413<?php echo rand(0, 9) ?>;
<?php endif; ?>

<?php if (isset($datosEquipo) and ! is_null($datosEquipo->equipoUltimaUbicacionLongitud)): ?>
      var lng = <?php echo $datosEquipo->equipoUltimaUbicacionLongitud ?>;
<?php else: ?>
      var lng = -74.196884<?php echo rand(0, 9) ?>;
<?php endif; ?>

    map = new GMaps({
      el: '#mapa-equipo',
      lat: lat,
      lng: lng,
      zoom: 17,
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

    map.addMarker({
      lat: lat,
      lng: lng,
      title: 'Ubicacion Actual',
      icon: 'archivos/oximeiser/marcadores/equipos.png',
      click: function (e) {
        alert('Ultima Ubicacion Registrada');
      }
    });

//    var latlng = new google.maps.LatLng(lat, lng);
//    bounds.extend(latlng);
//    map.fitBounds(bounds);
  });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

