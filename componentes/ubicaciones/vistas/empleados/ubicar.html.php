
<div id="mapa-cliente" style="width:100%;height:420px;"></div>






<label class="control-label col-md-12 col-sm-12 col-xs-12" for="direccion-cliente">
  Digite las coordenadas o Seleccione la Ubicación del Cliente<span class="required">*</span>
</label>

<div class="col-md-12 col-sm-12 col-xs-12">
  <label class="control-label col-md-12 col-sm-12 col-xs-12" for="direccion-cliente">
    Latitud<span class="required">*</span>
  </label>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <input type="text" id="latitud-cliente" name="latitud-cliente"  required="required" 
           size="25" class="form-control col-md-12 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaLatitud : "11.253427413" ); ?>" />
    <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
  </div>

  <label class="control-label col-md-12 col-sm-12 col-xs-12" for="direccion-cliente">
    Longitud<span class="required">*</span>
  </label>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <input type="text" id="longitud-cliente" name="longitud-cliente"  required="required" 
           size="25" class="form-control col-md-12 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaLongitud : "-74.196884" ); ?>" />
    <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
  </div>
</div>

<div class=" col-md-12 col-sm-12 col-xs-12">
  <label class="control-label col-md-12 col-sm-12 col-xs-12" >clic para centrar el mapa.</label>
  <button id="btn-ubicar-cliente" class="btn btn-large col-md-12 col-sm-12 col-xs-12" type="button" ><i class="fa fa-location-arrow" ></i> Localizar</button>
</div>

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

    $("#latitud-cliente").val(lat);
    $("#longitud-cliente").val(lng);

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
      draggable: true,
      title: 'Ubicacion Actual',
      icon: 'archivos/oximeiser/marcadores/clientes.png',
      click: function (e) {
        alert('Ubicacion Registrada para el Cliente');
      }
    });

    map.addListener('click', function (event) {
      colocarMarcador(event.latLng.lat(), event.latLng.lng());
    });
    marcador.addListener('dragend', function (event) {
      colocarMarcador(event.latLng.lat(), event.latLng.lng());
    });



    $("#latitud-cliente").change(function () {
      colocarMarcador($("#latitud-cliente").val(), $("#longitud-cliente").val());
    });
    $("#longitud-cliente").change(function () {
      colocarMarcador($("#latitud-cliente").val(), $("#longitud-cliente").val());
    });
    $("#btn-ubicar-cliente").click(function () {
      colocarMarcador($("#latitud-cliente").val(), $("#longitud-cliente").val());
    });


//    var latlng = new google.maps.LatLng(lat, lng);
//    bounds.extend(latlng);
//    map.fitBounds(bounds);
  });

  function colocarMarcador(lat, lng) {
    marcador.setMap(null);
    marcador = map.addMarker({
      lat: lat,
      lng: lng,
      draggable: true,
      title: 'Ubicacion Actual',
      icon: 'archivos/oximeiser/marcadores/clientes.png',
      click: function (e) {
        alert('Ubicacion Registrada para el Cliente');
      }
    });

    map.setCenter(lat, lng);
    marcador.addListener('dragend', function (event) {
      colocarMarcador(event.latLng.lat(), event.latLng.lng());
    });
    $("#latitud-cliente").val(lat);
    $("#longitud-cliente").val(lng);
  }

</script>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

