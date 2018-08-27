<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Formulario <small>de Tipos de Equipos</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="frm-tipoequipo" data-parsley-validate class="form-horizontal form-label-left">
          <div class="row">
            <div class="form-group col-md-4">
              <label class="control-label col-md-3 col-sm-3 col-xs-3">CODIGO</label>
              <div class="col-md-9 col-sm-9 col-xs-9">
                <input type="text" class="form-control mayusculas" name="codigo-tipoequipo" required="required" 
                       data-inputmask="'mask': '[aaaaaaaaaa]'" value="<?php echo ( isset($datosTipoEquipo) ? $datosTipoEquipo->tipoEquipoCodigo : "" ); ?>" />
                <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
            <div class="form-group col-md-8">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo-tipoequipo">
                Titulo <span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="titulo-tipoequipo" name="titulo-tipoequipo"  required="required" 
                       size="25" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosTipoEquipo) ? $datosTipoEquipo->tipoEquipoTitulo : "" ); ?>" />
				<span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group  col-md-12">
              <label for="desc-tipoequipo" class="control-label col-md-3 col-sm-3 col-xs-12">Descripción</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="desc-tipoequipo" name="desc-tipoequipo"  class="form-control col-md-7 col-xs-12" ><?php echo ( isset($datosTipoEquipo) ? $datosTipoEquipo->tipoEquipoDesc : "" ); ?></textarea>
              </div>
            </div>      
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-primary" onclick="mostrarListadoTiposEquipos();"><i class="fa fa-backward" ></i> Regresar</button>
                <button type="reset" class="btn btn-warning" ><i class="fa fa-eraser" ></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Guardar</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="registro-tipoequipo"  name="registro-tipoequipo" value="<?php echo ( isset($datosTipoEquipo) ? $datosTipoEquipo->tipoEquipoId : "" ); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {
    $(":input").inputmask();
    //$('#desc-tipoequipo').wysiwyg();
    $("#frm-tipoequipo").submit(function (evt) {
      mostrar_contenidos(
              'productos',
              'tiposEquipos',
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

