            
<div class="row">
  <div class="form-group">
    <div id="resp-validar-codigo-empleado" class="col-md-12"></div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de ID<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <select id="tipoidentificacion-empleado"  name="tipoidentificacion-empleado" 
              onchange="validar_existe_identificacion_empleado();"
              class="form-control" required="">
        <option value="">SELECCIONA UNO</option>
        <?php foreach($tiposIdentificacion as $TipoIdentificacion) : ?>
          <?php
          $selected = "";
          if(isset($datosEmpleado) and $datosEmpleado->personaTipoIdentificacion == $TipoIdentificacion->tipoIdentificacionId) {
            $selected = "selected";
          }
          ?>
          <option <?php echo $selected ?> value="<?php echo $TipoIdentificacion->tipoIdentificacionId ?>">[<?php echo $TipoIdentificacion->tipoIdentificacionCodigo ?>] <?php echo $TipoIdentificacion->tipoIdentificacionTitulo ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="identificacion-empleado">Número Id<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">

      <input type="text" class="form-control " id="identificacion-empleado"  name="identificacion-empleado" required="required"
             data-inputmask="'mask': '[9999999999]'" 
             value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaIdentificacion : "" ); ?>" />

      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombres<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" class="form-control" id="nombres-empleado" name="nombres-empleado" required="required" 
             value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaNombres : "" ); ?>" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellidos<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" class="form-control " id="apellidos-empleado"  name="apellidos-empleado" required="required" 
             value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaApellidos : "" ); ?>" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="razonsocial-empleado">
      Razón Social <span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="razonsocial-empleado" id="razonsocial-empleado" name="razonsocial-empleado"  required="required" 
             size="25" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaRazonSocial : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nombrecomercial-empleado">
      Nombre Comercial / Alias 
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="nombrecomercial-empleado" name="nombrecomercial-empleado" 
             size="25" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaNombreComercial : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>
<div class="row">
  <div class="form-group col-md-6 ">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telefono-empleado">
      Telefono Fijo / Fax 
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="telefono-empleado" name="telefono-empleado" size="25" 
             data-inputmask="'mask': '[999-9999]'"  class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaTelefono : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group col-md-6">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="celular-empleado">
      Telefono Movil  
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" id="celular-empleado" name="celular-empleado"  size="25" 
             data-inputmask="'mask': '[399-9999999]'"  class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaCelular : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
</div>		  
<div class="row">
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="correo-empleado">
      Correo Electronico <span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="email" id="correo-empleado" name="correo-empleado"  required="required" 
             size="255" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaCorreoElectronico : "" ); ?>" />
      <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="direccion-empleado">
      Direccion<span class="required">*</span>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
      <textarea id="direccion-empleado" name="direccion-empleado" required="required" 
                class="form-control col-md-7 col-xs-12" ><?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaDireccion : "" ); ?></textarea>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group ">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="min-height: 128px;">
        <img id="img-fotoreferencia" src="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaFotoReferencia : "/archivos/oximeiser/img/fotos.png" ); ?>" style="max-width: 100%; width: 100%;" />
      </div>
      <label class="control-label col-md-12 col-sm-12 col-xs-12" for="qrcode-empleado">
        Foto de Referencia <span class="required">*</span>
      </label>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="file" id="fotoreferencia-empleado" name="fotoreferencia-empleado"  
               class="btn btn-primary col-md-12 col-sm-12 col-xs-12" />
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <div class="form-group ">
      <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="min-height: 128px;">
        <img id="img-logoempleado" src="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaLogo : "/archivos/oximeiser/img/logo-aqui.png" ); ?>" style="max-width: 100%; width: 100%;" />
      </div>
      <label class="control-label col-md-12 col-sm-12 col-xs-12" for="logo-empleado">
        Logo <span class="required">*</span>
      </label>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <input type="file" id="logo-empleado" name="logo-empleado"  
               class="btn btn-primary col-md-12 col-sm-12 col-xs-12" />
      </div>
    </div>
  </div>
</div>


<div class="row">
  <div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label for="desc-empleado" class="control-label col-md-2 col-sm-4 col-xs-12">Observaciones</label>
    <div class="col-md-10 col-sm-8 col-xs-12">
      <textarea id="desc-empleado" name="desc-empleado"  class="form-control col-md-12 col-sm-12 col-xs-12" ><?php echo ( isset($datosEmpleado) ? $datosEmpleado->personaObservaciones : "" ); ?></textarea>
    </div>
  </div>   
</div>

<div id="cargando-empleado" class="overlay"  style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>


<script>
  var timerIdentificacion;
  $(document).ready(function () {
    $(":input").inputmask();

    $("#nombres-empleado, #apellidos-empleado").change(function () {
      $("#razonsocial-empleado").val($("#nombres-empleado").val() + " " + $("#apellidos-empleado").val());
    });

    $("#logo-empleado").change(function () {
      previewImagen(this, 'img-logoempleado');
    });
    $("#fotoreferencia-empleado").change(function () {
      previewImagen(this, 'img-fotoreferencia');
    });
    $("#identificacion-empleado").on("keyup", function () {
      clearTimeout(timerIdentificacion);
      timerIdentificacion = setTimeout(function () {
        validar_existe_identificacion_empleado();
      }, 1000);
    });
  });
  function validar_existe_identificacion_empleado() {
    var tipoID = $("#tipoidentificacion-empleado").val();
    var ID = $("#identificacion-empleado").val();
    if (!estaVacio(tipoID) && !estaVacio(ID)) {
//      informacion('<h4 class="text-center">Espera mientras validamos por coincidencias con la identificación del empleado.</h4>', 'Validando Identificación de Empleado');
      $("#cargando-empleado").show();
      ejecutarAccion('seguridad', 'empleados', 'validarExistenciaEmpleado', 'tipo_identificacion=' + tipoID + '&num_identificacion=' + ID,
        function (resp) {
          $("#cargando-empleado").fadeOut();
          //alert(resp);
          var resp = JSON.parse(resp);
          $("#resp-validar-codigo-empleado").html(resp.mensaje);
          if (estaVacio(resp.Empleado)) {

            <?php echo ( isset($datosEmpleado) ? "/*" : "" ); ?>
            $("#nombres-empleado").val('');
            $("#nombres-empleado").removeAttr('readonly');
            $("#apellidos-empleado").val('');
            $("#apellidos-empleado").removeAttr('readonly');
            $("#razonsocial-empleado").val('');
            $("#razonsocial-empleado").removeAttr('readonly');
            $("#nombrecomercial-empleado").val('');
            $("#nombrecomercial-empleado").removeAttr('readonly');
            $("#telefono-empleado").val('');
            $("#telefono-empleado").removeAttr('readonly');
            $("#celular-empleado").val('');
            $("#celular-empleado").removeAttr('readonly');
            $("#correo-empleado").val('');
            $("#correo-empleado").removeAttr('readonly');
            $("#direccion-empleado").val('');
            $("#direccion-empleado").removeAttr('readonly');
//            $("#latitud-empleado").val('11.24034184967624').trigger('change');
//            $("#latitud-empleado").removeAttr('readonly');
//            $("#longitud-empleado").val('-74.19599801301956').trigger('change');
//            $("#longitud-empleado").removeAttr('readonly');
            $("#desc-empleado").val('');
            $("#desc-empleado").removeAttr('readonly');
            $("#logo-empleado").removeAttr('readonly');
            $("#img-logoempleado").attr('src', 'archivos/oximeiser/img/logo-aqui.png');
            $("#logo-empleado").attr('readonly', '');
            $("#fotoreferencia-empleado").removeAttr('readonly');
            $("#img-fotoreferencia").attr('src', '/archivos/oximeiser/img/fotos.png');
            $("#fotoreferencia-empleado").attr('readonly', '');
            <?php echo ( isset($datosEmpleado) ? "*/" : "" ); ?>


          } else {
            $("#nombres-empleado").val('' + resp.Empleado.personaNombres + '')
            $("#nombres-empleado").attr('readonly', '');
            $("#apellidos-empleado").val('' + resp.Empleado.personaApellidos + '')
            $("#apellidos-empleado").attr('readonly', '');
            $("#razonsocial-empleado").val('' + resp.Empleado.personaRazonSocial + '')
            $("#razonsocial-empleado").attr('readonly', '');
            $("#nombrecomercial-empleado").val('' + resp.Empleado.personaNombreComercial + '')
            $("#nombrecomercial-empleado").attr('readonly', '');
            $("#telefono-empleado").val('' + resp.Empleado.personaTelefono + '')
            $("#telefono-empleado").attr('readonly', '');
            $("#celular-empleado").val('' + resp.Empleado.personaCelular + '')
            $("#celular-empleado").attr('readonly', '');
            $("#correo-empleado").val('' + resp.Empleado.personaCorreoElectronico + '')
            $("#correo-empleado").attr('readonly', '');
            $("#direccion-empleado").val('' + resp.Empleado.personaDireccion + '')
            $("#direccion-empleado").attr('readonly', '');
            $("#latitud-empleado").val('' + resp.Empleado.personaLatitud + '')
            $("#latitud-empleado").attr('readonly', '');
            $("#longitud-empleado").val('' + resp.Empleado.personaLongitud + '')
            $("#longitud-empleado").attr('readonly', '');
            $("#desc-empleado").val('' + resp.Empleado.personaObservaciones + '')
            $("#desc-empleado").attr('readonly', '');


            $("#img-logoempleado").attr('src', resp.Empleado.personaLogo);
            $("#logo-empleado").attr('readonly', '');

            $("#img-fotoreferencia").attr('src', resp.Empleado.personaFotoReferencia);
            $("#fotoreferencia-empleado").attr('readonly', '');




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

