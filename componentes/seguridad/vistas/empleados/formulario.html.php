
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Formulario <small>de Empleados </small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="frm-empleado" class="form-horizontal form-label-left">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class=" col-md-7 col-sm-7 col-xs-12">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cargo del Empleado</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="cargo_empleado"  name="cargo_empleado" class="form-control" required="" style="width: 100%">
                      <option value="">SELECCIONA UNO</option>
                      <?php foreach($cargos as $Cargo) : ?>
                        <?php
                        $selected = "";
                        if(isset($datosEmpleado) and $datosEmpleado->usuarioCargo == $Cargo->cargoEmpleadoId) {
                          $selected = "selected";
                        }
                        ?>
                        <option <?php echo $selected ?> value="<?php echo $Cargo->cargoEmpleadoId ?>"><?php echo $Cargo->cargoEmpleadoTitulo ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <?php Vistas::cargar('personas' . DS . 'formulario-empleados', self::$datos, 'personas') ?>
              </div>     
              <div class=" col-md-5 col-sm-5 col-xs-12" >              
                <?php Vistas::cargar('empleados' . DS . 'formulario-usuario', self::$datos, 'seguridad') ?>
              </div>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-primary" onclick="mostrarListadoEmpleados();"><i class="fa fa-backward" ></i> Regresar</button>
                <button type="reset" class="btn btn-warning" ><i class="fa fa-eraser" ></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Guardar</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="registro-empleado"  name="registro-empleado" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->usuarioId : "" ); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  $(document).ready(function () {
    $("#frm-empleado").submit(function (evt) {
      if (estaVacio($("#registro-empleado").val())) {
        var fileName = $("#fotoreferencia-empleado").val();
        if (estaVacio(fileName)) {
          alerta('<h4>Debe cargar la una imagen/foto para el empleado.</h4>');
          return false;
        }
        fileName = $("#logo-empleado").val();
        if (estaVacio(fileName)) {
          alerta('<h4>Debe cargar la una imagen/avatar para el empleado.</h4>');
          return false;
        }
      }

      $("#clave_empleado").focus();
      var clave = $("#clave_empleado").val();
      var c_clave = $("#confirma_clave_empleado").val();
      if (clave != c_clave) {
        alerta('<h4>La confirmación de la clave no coincide con la clave digitada.</h4>');
        return false;
      } else {
        var data = new FormData(document.getElementById('frm-empleado'));
        ejecutarAccionArchivos(
          'seguridad', 'empleados', 'guardarCambios',
          data,
          function (resp) {
//            alert(resp);
            $("#desc-empleado").html(resp);
            resp = JSON.parse(resp);
            if (resp.TIPO_RESPUESTA == 'EXITO') {
              mostrar_contenidos(
                'seguridad',
                'empleados',
                'editar',
                'registro-empleado=' + resp.MENSAJE_RESPUESTA
                );
            } else {
              error(resp.MENSAJE_RESPUESTA);
            }
          }
        );
        return false;
      }
      evt.preventDefault();
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

