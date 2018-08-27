<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Formulario <small>de Equipos</small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="frm-equipo" data-parsley-validate class="form-horizontal form-label-left">
          <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12">
			  <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Equipo</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <select name="tipo-equipo" class="form-control" required="">
					<option value="">SELECCIONA UNO</option>
					<?php foreach ($tiposEquipos as $TipoEquipo) : ?>
					  <?php
					  $selected = "";
					  if (isset($datosEquipo) and $datosEquipo->equipoTipo == $TipoEquipo->tipoEquipoId) {
						$selected = "selected";
					  }
					  ?>
  					<option <?php echo $selected ?> value="<?php echo $TipoEquipo->tipoEquipoId ?>">[<?php echo $TipoEquipo->tipoEquipoCodigo ?>] <?php echo $TipoEquipo->tipoEquipoTitulo ?></option>
					<?php endforeach; ?>
				  </select>
				</div>
			  </div>

			  <div class="form-group ">
				<label class="control-label col-md-3 col-sm-3 col-xs-3">Serial<span class="required">*</span></label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" class="form-control mayusculas" name="serial-equipo"  id="serial-equipo" required="required" 
						 data-inputmask="'mask': '[************************]'" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoSerial : "" ); ?>" />
				  <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
				</div>
			  </div>
			  <div class="form-group  col-md-6 ">
				<label class="control-label col-md-3 col-sm-3 col-xs-3">Codigo<span class="required">*</span></label>
				<div class="col-md-9">
				  <input type="text" class="form-control mayusculas" name="codigo-equipo" required="required" 
						 data-inputmask="'mask': '[**********]'" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoCodigo : "" ); ?>" />
				  <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
				</div>
			  </div>
			  <div class="form-group col-md-6">
				<label class="control-label col-md-4 col-sm-4 col-xs-12" for="titulo-equipo">
				  Capacidad<span class="required">*</span>
				</label>
				<div class="col-md-8 col-sm-8">
				  <input type="text" id="capacidad-equipo" name="capacidad-equipo"  required="required" 
						 class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoCapacidad : "" ); ?>" />
				  <span class="fa fa-battery-full form-control-feedback right" aria-hidden="true"></span>
				</div>
			  </div>
			  <div class="form-group ">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="titulo-equipo">
				  Titulo <span class="required">*</span>
				</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <input type="text" id="titulo-equipo" name="titulo-equipo"  required="required" 
						 size="100" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoTitulo : "" ); ?>" />
				  <span class="fa fa-tint form-control-feedback right" aria-hidden="true"></span>
				</div>
			  </div>
			  <div class="form-group">
				<label for="desc-equipo" class="control-label col-md-3 col-sm-3 col-xs-12">Observaciones</label>
				<div class="col-md-9 col-sm-9 col-xs-12">
				  <textarea id="desc-equipo" name="desc-equipo"  class="form-control col-md-7 col-xs-12" ><?php echo ( isset($datosEquipo) ? $datosEquipo->equipoObservaciones : "" ); ?></textarea>
				</div>
			  </div> 


			  <div class="col-md-6 col-sm-12 col-xs-12">
				<div class="form-group ">
				  <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="min-height: 128px">
					<img id="img-codigoqr" src="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoUrlQR : "/archivos/oximeiser/img/qr_code.png" ); ?>" style="max-width: 100%; width: 100%;" />
				  </div>
				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="qrcode-equipo">
					Codigo <span class="required">QR</span>
				  </label>
				  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" id="qrcode-equipo" name="qrcode-equipo"  required="required" readonly=""
						   size="100" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoUrlQR : "SIN  GENERAR" ); ?>" />
					<span class="fa fa-qrcode form-control-feedback right" aria-hidden="true"></span>
					<button type="button" class="btn btn-primary" onclick="generarCodigoQREquipo();"><i class="fa fa-qrcode" ></i> GENERAR</button>
				  </div>
				</div>
			  </div>
			  <div class="col-md-6 col-sm-12 col-xs-12">
				<div class="form-group ">
				  <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="min-height: 128px">
					<img id="img-codigobarras" src="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoUrlBARRAS : "/archivos/oximeiser/img/bar_code.png" ); ?>" style="max-width: 100%; width: 100%;" />
				  </div>
				  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="barcode-equipo">
					Codigo <span class="required">Barras</span>
				  </label>
				  <div class="col-md-9 col-sm-9 col-xs-12">
					<input type="text" id="barcode-equipo" name="barcode-equipo"  required="required" readonly=""
						   size="100" class="form-control col-md-7 col-xs-12" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoUrlBARRAS : "SIN GENERAR" ); ?>" />
					<span class="fa fa-barcode form-control-feedback right" aria-hidden="true"></span>
					<button type="button" class="btn btn-primary" onclick="generarCodigoBarraEquipo();"><i class="fa fa-barcode" ></i> GENERAR</button>
				  </div>
				</div>
			  </div>






			</div>
			<div class="col-md-6 col-sm-12 col-xs-12">
			  <?php Vistas::cargar('equipo', self::$datos, 'ubicaciones') ?>
			</div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-primary" onclick="mostrarListadoEquipos();"><i class="fa fa-backward" ></i> Regresar</button>
                <button type="reset" class="btn btn-warning" ><i class="fa fa-eraser" ></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Guardar</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="registro-equipo"  name="registro-equipo" value="<?php echo ( isset($datosEquipo) ? $datosEquipo->equipoId : "" ); ?>" />
        </form>
      </div>	  
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {
    $(":input").inputmask();
    $("#frm-equipo").submit(function (evt) {
      
      mostrar_contenidos(
              'productos',
              'equipos',
              'guardarCambios',
              $(this).serialize()
              );
      return false;
    });
  });


  function generarCodigoQREquipo() {
    generarCodigoQR(
            $('#serial-equipo').val(),
            'productos/equipos',
            'Debes escribir el serial primero.',
            function (resp) {
              //alert(resp);
              var datos = JSON.parse(resp);
              $("#img-codigoqr").attr('src', datos.archivo);
              $("#qrcode-equipo").attr('value', datos.archivo);
              informacion(
                      datos.mensaje, 'Genraciones de Codigo QR para Equipo'
                      );
            }
    );
  }



  function generarCodigoBarraEquipo() {
    generarCodigoBarras(
            $('#serial-equipo').val(),
            'productos/equipos',
            'Debes escribir el serial primero.',
            function (resp) {
              //alert(resp);
              var datos = JSON.parse(resp);
              $("#img-codigobarras").attr('src', datos.archivo);
              $("#barcode-equipo").attr('value', datos.archivo);
              informacion(
                      datos.mensaje, 'Genraciones de Codigo de Barras para Equipo'
                      );
            }
    );
  }



</script>



<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

