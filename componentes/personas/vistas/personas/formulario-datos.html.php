            
<div class="row">
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de ID<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <select id="tipoidentificacion-cliente"  name="tipoidentificacion-cliente" 
              onchange="validar_existe_identificacion_cliente();"
              class="form-control" required="">
        <option value="">SELECCIONA UNO</option>
        <?php foreach ($tiposIdentificacion as $TipoIdentificacion) : ?>
          <?php
          $selected = "";
          if (isset($datosCliente) and $datosCliente->personaTipoIdentificacion == $TipoIdentificacion->tipoIdentificacionId) {
            $selected = "selected";
          }
          ?>
          <option <?php echo $selected ?> value="<?php echo $TipoIdentificacion->tipoIdentificacionId ?>">[<?php echo $TipoIdentificacion->tipoIdentificacionCodigo ?>] <?php echo $TipoIdentificacion->tipoIdentificacionTitulo ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="identificacion-cliente">Número Id<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">

      <input type="text" class="form-control " id="identificacion-cliente"  name="identificacion-cliente" required="required"
             data-inputmask="'mask': '[9999999999]'" 
             value="<?php echo ( isset($datosCliente) ? $datosCliente->personaIdentificacion : "" ); ?>" />

      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-3">Nombres<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-9">
      <input type="text" class="form-control" id="nombres-cliente" name="nombres-cliente" required="required" 
             value="<?php echo ( isset($datosCliente) ? $datosCliente->personaNombres : "" ); ?>" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" class="form-control " id="apellidos-cliente"  name="apellidos-cliente" required="required" 
             value="<?php echo ( isset($datosCliente) ? $datosCliente->personaApellidos : "" ); ?>" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razonsocial-cliente">
      Razón Social <span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="razonsocial-cliente" id="razonsocial-cliente" name="razonsocial-cliente"  required="required" 
             size="25" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaRazonSocial : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombrecomercial-cliente">
      Nombre Comercial / Alias 
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="nombrecomercial-cliente" name="nombrecomercial-cliente" 
             size="25" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaNombreComercial : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6 ">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono-cliente">
      Telefono Fijo / Fax 
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="telefono-cliente" name="telefono-cliente" size="25" 
             data-inputmask="'mask': '[999-9999]'"  class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaTelefono : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celular-cliente">
      Telefono Movil  
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="celular-cliente" name="celular-cliente"  size="25" 
             data-inputmask="'mask': '[399-9999999]'"  class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaCelular : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>		  
<div class="row">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="correo-cliente">
      Correo Electronico <span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="email" id="correo-cliente" name="correo-cliente"  required="required" 
             size="255" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->personaCorreoElectronico : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion-cliente">
      Direccion<span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <textarea id="direccion-cliente" name="direccion-cliente" required="required" 
                class="form-control col-md-7 col-xs-12" ><?php echo ( isset($datosCliente) ? $datosCliente->personaDireccion : "" ); ?></textarea>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group ">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="min-height: 128px;">
        <img id="img-fotoreferencia" src="<?php echo ( isset($datosCliente) ? $datosCliente->personaFotoReferencia : "/archivos/oximeiser/img/fotos.png" ); ?>" style="max-width: 100%; width: 100%;" />
      </div>
      <label class="control-label col-md-12 col-sm-12 col-xs-12" for="qrcode-cliente">
        Foto de Referencia <span class="required">*</span>
      </label>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="file" id="fotoreferencia-cliente" name="fotoreferencia-cliente"  
               class="btn btn-primary col-md-12 col-sm-12 col-xs-12" />
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group ">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="min-height: 128px;">
        <img id="img-logocliente" src="<?php echo ( isset($datosCliente) ? $datosCliente->personaLogo : "/archivos/oximeiser/img/logo-aqui.png" ); ?>" style="max-width: 100%; width: 100%;" />
      </div>
      <label class="control-label col-md-12 col-sm-12 col-xs-12" for="logo-cliente">
        Logo <span class="required">*</span>
      </label>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="file" id="logo-cliente" name="logo-cliente"  
               class="btn btn-primary col-md-12 col-sm-12 col-xs-12" />
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label for="desc-cliente" class="control-label col-md-2 col-sm-4 col-xs-12">Observaciones</label>
    <div class="col-md-10 col-sm-8 col-xs-12">
      <textarea id="desc-cliente" name="desc-cliente"  class="form-control col-md-12 col-sm-12 col-xs-12" ><?php echo ( isset($datosCliente) ? $datosCliente->personaObservaciones : "" ); ?></textarea>
    </div>
  </div>   
</div>

<div id="cargando-cliente" class="overlay"  style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>


<script>
  var timerIdentificacion;
  $(document).ready(function () {
    $(":input").inputmask();

    $("#nombres-cliente, #apellidos-cliente").change(function () {
      $("#razonsocial-cliente").val($("#nombres-cliente").val() + " " + $("#apellidos-cliente").val());
    });

    $("#logo-cliente").change(function () {
      previewImagen(this, 'img-logocliente');
    });
    $("#fotoreferencia-cliente").change(function () {
      previewImagen(this, 'img-fotoreferencia');
    });
    $("#identificacion-cliente").on("keyup", function () {
      clearTimeout(timerIdentificacion);
      timerIdentificacion = setTimeout(function () {
        validar_existe_identificacion_cliente();
      }, 1000);
    });
  });
  function validar_existe_identificacion_cliente() {
    var tipoID = $("#tipoidentificacion-cliente").val();
    var ID = $("#identificacion-cliente").val();
    if (!estaVacio(tipoID) && !estaVacio(ID)) {
//      informacion('<h4 class="text-center">Espera mientras validamos por coincidencias con la identificación del cliente.</h4>', 'Validando Identificación de Cliente');
      $("#cargando-cliente").show();
      ejecutarAccion('personas', 'clientes', 'validarExistenciaCliente', 'tipo_identificacion=' + tipoID + '&num_identificacion=' + ID,
        function (resp) {
          $("#cargando-cliente").fadeOut();
          alert(resp);
          var resp = JSON.parse(resp);
          $("#resp-validar-codigo-cliente").html(resp.mensaje);
          if (estaVacio(resp.Cliente)) {
            $("#nombres-cliente").val('');
            $("#nombres-cliente").removeAttr('readonly');
            $("#apellidos-cliente").val('');
            $("#apellidos-cliente").removeAttr('readonly');
            $("#razonsocial-cliente").val('');
            $("#razonsocial-cliente").removeAttr('readonly');
            $("#nombrecomercial-cliente").val('');
            $("#nombrecomercial-cliente").removeAttr('readonly');
            $("#telefono-cliente").val('');
            $("#telefono-cliente").removeAttr('readonly');
            $("#celular-cliente").val('');
            $("#celular-cliente").removeAttr('readonly');
            $("#correo-cliente").val('');
            $("#correo-cliente").removeAttr('readonly');
            $("#direccion-cliente").val('');
            $("#direccion-cliente").removeAttr('readonly');
            $("#latitud-cliente").val('11.24034184967624').trigger('change');
            $("#latitud-cliente").removeAttr('readonly');
            $("#longitud-cliente").val('-74.19599801301956').trigger('change');
            $("#longitud-cliente").removeAttr('readonly');
            $("#desc-cliente").val('');
            $("#desc-cliente").removeAttr('readonly');



            $("#logo-cliente").removeAttr('readonly');
            $("#img-logocliente").attr('src', 'archivos/oximeiser/img/logo-aqui.png');
            $("#logo-cliente").attr('readonly', '');

            $("#fotoreferencia-cliente").removeAttr('readonly');
            $("#img-fotoreferencia").attr('src', '/archivos/oximeiser/img/fotos.png');
            $("#fotoreferencia-cliente").attr('readonly', '');



          } else {
            $("#nombres-cliente").val('' + resp.Cliente.personaNombres + '')
            $("#nombres-cliente").attr('readonly', '');
            $("#apellidos-cliente").val('' + resp.Cliente.personaApellidos + '')
            $("#apellidos-cliente").attr('readonly', '');
            $("#razonsocial-cliente").val('' + resp.Cliente.personaRazonSocial + '')
            $("#razonsocial-cliente").attr('readonly', '');
            $("#nombrecomercial-cliente").val('' + resp.Cliente.personaNombreComercial + '')
            $("#nombrecomercial-cliente").attr('readonly', '');
            $("#telefono-cliente").val('' + resp.Cliente.personaTelefono + '')
            $("#telefono-cliente").attr('readonly', '');
            $("#celular-cliente").val('' + resp.Cliente.personaCelular + '')
            $("#celular-cliente").attr('readonly', '');
            $("#correo-cliente").val('' + resp.Cliente.personaCorreoElectronico + '')
            $("#correo-cliente").attr('readonly', '');
            $("#direccion-cliente").val('' + resp.Cliente.personaDireccion + '')
            $("#direccion-cliente").attr('readonly', '');
            $("#latitud-cliente").val('' + resp.Cliente.personaLatitud + '')
            $("#latitud-cliente").attr('readonly', '');
            $("#longitud-cliente").val('' + resp.Cliente.personaLongitud + '')
            $("#longitud-cliente").attr('readonly', '');
            $("#desc-cliente").val('' + resp.Cliente.personaObservaciones + '')
            $("#desc-cliente").attr('readonly', '');


            $("#img-logocliente").attr('src', resp.Cliente.personaLogo);
            $("#logo-cliente").attr('readonly', '');

            $("#img-fotoreferencia").attr('src', resp.Cliente.personaFotoReferencia);
            $("#fotoreferencia-cliente").attr('readonly', '');




          }
        }
      );
    }
  }
</script>




<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

