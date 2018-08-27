<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Formulario <small>de Tipos de Clientes</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="frm-tipocliente" data-parsley-validate class="form-horizontal form-label-left">
          <div class="row">
            <div class="form-group col-md-4">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">CODIGO</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control mayusculas" name="codigo-tipocliente" required="required" 
                       data-inputmask="'mask': '[aaaaaaaaaa]'" value="<?php echo ( isset($datosTipoCliente) ? $datosTipoCliente->tipoClienteCodigo : "" ); ?>" />
                <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="form-group col-md-8">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo-tipocliente">
                Titulo <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="titulo-tipocliente" name="titulo-tipocliente"  required="required" 
                       size="25" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosTipoCliente) ? $datosTipoCliente->tipoClienteTitulo : "" ); ?>" />
				<span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group  col-md-12">
              <label for="desc-tipocliente" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="desc-tipocliente" name="desc-tipocliente"  class="form-control col-md-7 col-xs-12" ><?php echo ( isset($datosTipoCliente) ? $datosTipoCliente->tipoClienteDefinicion : "" ); ?></textarea>
              </div>
            </div>      
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-primary" onclick="mostrarListadoTiposClientes();"><i class="fa fa-backward" ></i> Regresar</button>
                <button type="reset" class="btn btn-warning" ><i class="fa fa-eraser" ></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Guardar</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="registro-tipocliente"  name="registro-tipocliente" value="<?php echo ( isset($datosTipoCliente) ? $datosTipoCliente->tipoClienteId : "" ); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {
    $(":input").inputmask();
    //$('#desc-tipocliente').wysiwyg();
    $("#frm-tipocliente").submit(function (evt) {
      mostrar_contenidos(
              'personas',
              'tiposClientes',
              'guardarCambios',
              $(this).serialize()
              );
	  return false;
    });
  });



</script>



<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

