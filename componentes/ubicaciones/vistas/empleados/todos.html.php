<div id="mapa-clientes" style="height:420px;"></div>



<script type="text/javascript">
  var map;
  $(document).ready(function () {
    var bounds = new google.maps.LatLngBounds();
    map = new GMaps({
      el: '#mapa-clientes',
      lat: -11.227413,
      lng: -74.196884,
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

<?php foreach ($Clientes as $Cliente): ?>
      var lat = <?php echo $Cliente->personaLatitud ?>;
      var lng = <?php echo $Cliente->personaLongitud ?>;
      map.addMarker({
        lat: lat,
        lng: lng,
        title: '<?php echo $Cliente->personaRazonSocial ?>',
        icon: '<?php echo 'archivos/oximeiser/marcadores/clientes.png'; //( $Cliente->personaLogo == '' ) ? 'archivos/oximeiser/marcadores/clientes.png' : $Cliente->personaLogo    ?>',
        click: function (e) {
          informacion(
            "<h4><?php echo $Cliente->personaRazonSocial ?></h4><em><strong><?php echo $Cliente->personaDireccion ?></strong></em><br /><?php
  echo nl2br(str_replace("\r\n", "", $Cliente->personaObservaciones))
  ?>"
            );
        }
      });
      var latlng = new google.maps.LatLng(lat, lng);
      bounds.extend(latlng);
<?php endforeach; ?>
    map.fitBounds(bounds);

  });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

