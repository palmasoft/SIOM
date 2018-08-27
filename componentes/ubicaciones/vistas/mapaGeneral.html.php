
<div id="mapa-general" style="height:620px;"></div>

<script type="text/javascript">
  var map;
  $(document).ready(function () {
    var bounds = new google.maps.LatLngBounds();
    map = new GMaps({
      el: '#mapa-general',
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

<?php if(count($Empleados)) foreach($Empleados as $Empleado): ?>
        var lat = <?php echo empty($Empleado->usuarioUltimaUbicacionLatitud) ? Params::valor('lat_organizacion') : $Empleado->usuarioUltimaUbicacionLatitud ?>;
        var lng = <?php echo empty($Empleado->usuarioUltimaUbicacionLongitud) ? Params::valor('lon_organizacion') : $Empleado->usuarioUltimaUbicacionLongitud ?>;
        map.addMarker({
          lat: lat,
          lng: lng,
          title: '<?php echo $Empleado->personaNombres ?> <?php echo $Empleado->personaApellidos ?>',
                icon: 'archivos/oximeiser/marcadores/empleados.png',
                click: function (e) {
//                  alert('You clicked in this marker');
                }
              });

              var latlng = new google.maps.LatLng(lat, lng);
              //bounds.extend(latlng);
  <?php endforeach; ?>

<?php if(count($Clientes)) foreach($Clientes as $Cliente): ?>
              var lat = <?php echo empty($Cliente->personaLatitud) ? Params::valor('lat_organizacion') : $Cliente->personaLatitud ?>;
              var lng = <?php echo empty($Cliente->personaLongitud) ? Params::valor('lon_organizacion') : $Cliente->personaLongitud ?>;
              map.addMarker({
                lat: lat,
                lng: lng,
                title: '<?php echo $Cliente->clienteCodigo ?> <?php echo $Cliente->personaRazonSocial ?>',
                      icon: 'archivos/oximeiser/marcadores/clientes.png',
                      click: function (e) {
//                        alert('You clicked in this marker');
                      }
                    });

                    var latlng = new google.maps.LatLng(lat, lng);
                    bounds.extend(latlng);
  <?php endforeach; ?>

<?php if(count($Equipos)) foreach($Equipos as $Equipo): ?>
                    var lat = <?php echo empty($Equipo->equipoUltimaUbicacionLatitud) ? Params::valor('lat_organizacion') : $Equipo->equipoUltimaUbicacionLatitud ?>;
                    var lng = <?php echo empty($Equipo->equipoUltimaUbicacionLongitud) ? Params::valor('lat_organizacion') : $Equipo->equipoUltimaUbicacionLongitud ?>;
                    map.addMarker({
                      lat: lat,
                      lng: lng,
                      title: '<?php echo $Equipo->tipoEquipoTitulo ?> <?php echo $Equipo->equipoSerial ?>',
                            icon: 'archivos/oximeiser/marcadores/equipos.png',
                            click: function (e) {
//                              alert('You clicked in this marker');
                            }
                          });

                          var latlng = new google.maps.LatLng(lat, lng);
                          //bounds.extend(latlng);
  <?php endforeach; ?>
                      map.fitBounds(bounds);


                      /* Primero seteamos el centro a cualquier punto */
//		  map.setCenter(new google.maps.LatLng( - 11.227413, - 74.196884), 0);
//          /* Creamos un objeto vacio GLatLngBounds() */
//          var bounds = new google.maps.LatLngBounds();
//          /* Por cada uno de los puntos a incluir en el mapa extendemos los límites del objeto */
//          /* En este caso latlng debería ser un objeto GLatLng */
//          /* Ejemplo: var latlng = new google.maps.LatLng(43, -2); */
//          bounds.extend(latlng);
//          /* Cuando hayamos incluido todos los puntos seteamos el centro y el zoom usando el objeto 'bounds' */
//          map.setZoom(map.getBoundsZoomLevel(bounds));
//          map.setCenter(bounds.getCenter());
                    });
</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

