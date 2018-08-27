<div class="row fondo-gris">
  <div class="col-md-7 col-sm-6 col-xs-12">
    <h4>Referencias del Cliente</h4>
    <p class="font-gray-dark">
      Siempre inicie digitando la identificación de la persona para verificar su existencia en la base de datos.
    </p>			  
    <div class="" >
      <div class="form-group col-md-7 col-sm-6 col-xs-12" >
        <div id="resp-validar-cedula" class="form-group col-md-12 col-sm-12 col-xs-12">
        </div>
        <div class="row">
          <div class="form-group col-md-5 col-sm-4 col-xs-12">
            <label class="col-md-12 col-sm-12 col-xs-12" for="ex3">Cedula<span class="required" >*</span></label>
            <input type="text" id="cedula-referencia"  name="cedula-referencia" 
                   onchange="validar_existe_cedula_referencia();"
                   data-inputmask="'mask': '[999999999999]'" 
                   class="form-control col-md-12 col-sm-12 col-xs-12" placeholder=" ">
          </div>
          <div class="form-group col-md-7 col-sm-4 col-xs-12">
            <label class="col-md-12 col-sm-12 col-xs-12" for="ex3">Etiquetas<span class="required" >*</span></label>
            <select id="etiquetas-referencia"  name="etiquetas-referencia" class="form-control" multiple="multiple" style="width: 100%" placeholder="escribe" ></select>          
          </div>

        </div>
        <div class="row">
          <div class="form-group col-md-6 col-sm-4 col-xs-12">
            <label class="col-md-12 col-sm-12 col-xs-12" for="ex4">Nombres<span class="required" >*</span></label>
            <input type="text"  id="nombres-referencia" name="nombres-referencia" 
                   class="form-control col-md-12 col-sm-12 col-xs-12" placeholder=" ">
          </div>
          <div class="form-group col-md-6 col-sm-4 col-xs-12">
            <label class="col-md-12 col-sm-12 col-xs-12" for="ex4">Apellidos<span class="required" >*</span></label>
            <input type="text" id="apellidos-referencia"  name="apellidos-referencia"   
                   class="form-control col-md-12 col-sm-12 col-xs-12" placeholder=" ">
          </div>

        </div>
        <div class="row">
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-12 col-sm-12 col-xs-12" for="ex4">Correo Electrónico</label>
            <input type="email" id="email-referencia"  name="email-referencia"  
                   class="form-control col-md-12 col-sm-12 col-xs-12" placeholder="email">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <label class="col-md-12 col-sm-12 col-xs-12" for="ex4">Dirección</label>
            <textarea id="direccion-referencia"  name="direccion-referencia" 
                      class="resizable_textarea form-control col-md-12 col-sm-12 col-xs-12" placeholder="" 
                      style="width: 100%; overflow: hidden; word-wrap: break-word; resize: horizontal; height: 74px;" data-autosize-on="true"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="form-group " >
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="checkbox">
                <label class="">¿Recibe Equipo? 
                  <input type="checkbox" id="recibe-equipos-referencia" name="recibe-equipos-referencia" 
                         class="flat icheckbox_flat-green" checked="checked"  />
                </label>
              </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <div class="checkbox">
                <label class="">¿Recibe Deposito? 
                  <input type="checkbox" id="recibe-deposito-referencia" name="recibe-deposito-referencia" 
                         class="flat icheckbox_flat-green"  />
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="form-group col-md-5 col-sm-6 col-xs-12">

        <div class="form-group col-md-12 ">
          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="telefono-referencia">Fijo</label>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text" id="telefono-referencia" name="telefono-referencia" size="25" 
                   data-inputmask="'mask': '[999-9999]'"  class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->clienteTelefono : "" ); ?>" />
            <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
          </div>
        </div>
        <div class="form-group col-md-12">
          <label class="control-label col-md-12 col-sm-12 col-xs-12" for="celular-referencia">Movil</label>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <input type="text" id="celular-referencia" name="celular-referencia"  size="25" 
                   data-inputmask="'mask': '[399-9999999]'"  class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosCliente) ? $datosCliente->clienteCelular : "" ); ?>" />
            <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
          </div>
        </div>


        <div class="form-group col-md-12 col-sm-12 col-xs-12">
          <label style="max-width: 100%;" for="ex4">Foto</label>
          <img id="img-personafotoreferencia" class="col-md-12 col-sm-12 col-xs-12" src="/archivos/oximeiser/personas/referencia.jpg" />

          <div class="col-md-12 col-sm-12 col-xs-12" style="overflow: hidden;">
            <input type="file" id="fotopersona-referencia" name="fotopersona-referencia" 
                   class="btn btn-primary col-md-12 col-sm-12 col-xs-12 cargar-foto-mini" />
          </div> 
        </div> 
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
          <a id="btn-agregar-listareferencia" class="btn btn-app" href="javascript:void(0)" onclick="agregarContactoLista();">
            <i class="fa fa-plus-circle"></i> Agregar
          </a>
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12" >
          <a id="btn-borrar-listareferencia" class="btn btn-app" href="javascript:void(0)" onclick="borrarContactoLista();">
            <i class="fa fa-refresh"></i> Cancelar
          </a>
        </div>

        <div id="div-personafotoreferencia"  ></div>

      </div>	
    </div>    
    <div id="cargando-datosreferencia" class="overlay" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>
  </div>
  <div class="col-md-5 col-sm-6 col-xs-12">
    <h4>Lista de Referencias</h4>
    <div class="scroll-view" >
      <ul id="lista-personasreferencia" class="list-unstyled msg_list">
        <?php if (isset($Referencias) and count($Referencias) > 0): ?>
          <?php foreach ($Referencias AS $Referencia): ?>
            <?php
            $datosReferencia['nombres_referencia'] = $Referencia->personaNombres;
            $datosReferencia['apellidos_referencia'] = $Referencia->personaApellidos;
            $datosReferencia['etiquetas_referencia'] = $Referencia->clienteContactoEtiquetas;
            $datosReferencia['cedula_referencia'] = $Referencia->personaIdentificacion;
            $datosReferencia['email_referencia'] = $Referencia->personaCorreoElectronico;
            $datosReferencia['telefono_referencia'] = $Referencia->personaTelefono;
            $datosReferencia['celular_referencia'] = $Referencia->personaCelular;
            $datosReferencia['direccion_referencia'] = $Referencia->personaDireccion;
            $datosReferencia['recibe_equipos_referencia'] = $Referencia->clienteContactoRecibeEquipos;
            $datosReferencia['recibe_deposito_referencia'] = $Referencia->clienteContactoRecibeDeposito;
            $datosReferencia['url_imagen_referencia'] = $Referencia->personaFotoReferencia;
            Vistas::cargar('referencias' . DS . 'item-lista', $datosReferencia)
            ?>	
          <?php endforeach; ?>
        <?php endif; ?>
      </ul>
    </div>
    <div id="cargando-listareferencia" class="overlay" style="display: none;"><i class="fa fa-refresh fa-spin"></i></div>
  </div>
</div>
<div class="ln_solid"></div>






<script>
  $(document).ready(function () {



    $('input.flat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
    $(":input").inputmask();
    $('#etiquetas-referencia').select2({
      tags: true,
      tokenSeparators: [',', ' ']
    });
    $("#fotopersona-referencia").change(function () {
      cargando_dentro_objeto('div-personafotoreferencia');
      previewImagen(this, 'img-personafotoreferencia', 'div-personafotoreferencia');
    });
  });
  function agregarContactoLista() {
    if (estaVacio($("#cedula-referencia").val())) {
      alerta('Debes escribes la cedula para agregar una referencia.');
      $("#cedula-referencia").focus();
      return false;
    }

    var existeCedula = false;
    $.each($(".item_id-item-referencia"), function (key, value) {
      if ($("#cedula-referencia").val() == $(value).val()) {
        existeCedula = true;
        return false;
      }
    });
    if (existeCedula) {
      alerta('<h3>Ya esta persona se encuentra en la lista de referencias.</h3><br />Intenta modificar el que se encuentra en la lista.');
      return false;
    }

    if (estaVacio($("#etiquetas-referencia").val())) {
      alerta('<h4>Ponerle una etiqueta a la referencia es necesario.</h4> <br />Por ejemplo: Paciente, Familiar, etc...');
      $("#etiquetas-referencia").focus().trigger('change');
      return false;
    }

    if (estaVacio($("#nombres-referencia").val())) {
      alerta('<h4>Con un nombre es más fácil identificar la referencia.</h4>');
      $("#nombres-referencia").focus();
      return false;
    }

    if (estaVacio($("#apellidos-referencia").val())) {
      alerta('<h4>Por favor, agregale un apellido para mejor referencia.</h4>');
      $("#apellidos-referencia").focus();
      return false;
    }
    var data = new FormData(document.getElementById('frm-cliente'));
    data.append("etiquetas_referencia", "" + $("#etiquetas-referencia").val() + "");


    ejecutarAccionArchivos(
      'personas', 'referencias', 'nuevoItemLista',
      data,
      function (resp) {
        $("#lista-personasreferencia").append(
          resp
          );
        $("#cedula-referencia").val('');
        $("#etiquetas-referencia").val('').trigger("change");
        $("#nombres-referencia").val('');
        $("#apellidos-referencia").val('');
        $("#telefono-referencia").val('');
        $("#celular-referencia").val('');
        $("#email-referencia").val('');
        $("#direccion-referencia").val('');

      }
    );
  }

  function validar_existe_cedula_referencia() {
    var cedula = $("#cedula-referencia").val();
    if (!estaVacio(cedula)) {
      ejecutarAccion('personas', 'directorio', 'validarExistenciaPersona', 'num_cedula=' + cedula,
        function (resp) {
          //alert(resp);
          var resp = JSON.parse(resp);
          $("#resp-validar-cedula").html(resp.mensaje);
          if (estaVacio(resp.Persona)) {
            $("#nombres-referencia").val('');
            $("#apellidos-referencia").val('');
            $("#email-referencia").val('');
            $("#direccion-referencia").val('');
            $("#nombres-referencia").removeAttr('readonly');
            $("#apellidos-referencia").removeAttr('readonly');
            $("#email-referencia").removeAttr('readonly')
            $("#direccion-referencia").removeAttr('readonly')
          } else {
            $("#nombres-referencia").val('' + resp.Persona.personaNombres + '');
            $("#apellidos-referencia").val('' + resp.Persona.personaNombres + '');
            $("#email-referencia").val('' + resp.Persona.personaNombres + '');
            $("#direccion-referencia").val('' + resp.Persona.personaNombres + '');
            $("#nombres-referencia").attr('readonly', '');
            $("#apellidos-referencia").attr('readonly', '');
            $("#email-referencia").attr('readonly', '');
            $("#direccion-referencia").attr('readonly', '');
          }

          $("#etiquetas-referencia").val('').focus().trigger('change');

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

