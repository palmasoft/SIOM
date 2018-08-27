
<div class="row">
  <div class="form-group col-md-12 col-sm-12 col-xs-12">
    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="text-align: center; font-size: 150%;" >Datos de Usuario</label>
  </div>
  <div class="form-group col-md-12">
    <label class="control-label col-md-4 col-sm-4 col-xs-12">Tipo de Usuario</label>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <select id="tipo-usuario_empleado"  name="tipo-usuario_empleado" class="form-control" required="">
        <option value="">SELECCIONA UNO</option>
        <option <?php echo ( (isset($datosEmpleado) and $datosEmpleado->usuarioTipo == "REPARTIDOR") ? "selected" : "" ); ?> value="REPARTIDOR">REPARTIDOR</option>
        <option <?php echo ( (isset($datosEmpleado) and $datosEmpleado->usuarioTipo == "SUPERVISOR") ? "selected" : "" ); ?> value="SUPERVISOR">SUPERVISOR</option>
        <option <?php echo ( (isset($datosEmpleado) and $datosEmpleado->usuarioTipo == "ADMINISTRADOR") ? "selected" : "" ); ?> value="ADMINISTRADOR">ADMINISTRADOR</option>
        <option <?php echo ( (isset($datosEmpleado) and $datosEmpleado->usuarioTipo == "SOPORTE") ? "selected" : "" ); ?> value="SOPORTE">SOPORTE</option>
      </select>
    </div>
  </div>
  <div class="form-group col-md-12">
    <div id="resp-validar-usuario-empleado" class="col-md-12"></div>
  </div>
  <div class="form-group col-md-12">
    <label class="control-label col-md-4 col-sm-4 col-xs-12">Nombre de Usuario</label>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <input type="text" class="form-control mayusculas" id="usuario_empleado"  name="usuario_empleado" required="required"                            
             data-inputmask="'mask': '[********************]'" value="<?php echo ( isset($datosEmpleado) ? $datosEmpleado->usuarioNombre : "" ); ?>" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>

  <div class="form-group col-md-12">
    <label class="control-label col-md-4 col-sm-4 col-xs-12">Clave</label>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <input type="text" class="form-control " id="clave_empleado"  name="clave_empleado" <?php echo ( isset($datosEmpleado) ? "" : "required" ); ?>                            
             data-inputmask="'mask': '[********************]'" value="" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>
  <div class="form-group col-md-12">
    <label class="control-label col-md-4 col-sm-4 col-xs-12">Confirma Clave</label>
    <div class="col-md-8 col-sm-8 col-xs-12">
      <input type="text" class="form-control " id="confirma_clave_empleado"  name="confirma_clave_empleado" <?php echo ( isset($datosEmpleado) ? "" : "required" ); ?>                            
             data-inputmask="'mask': '[********************]'" value="" />
      <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
    </div>
  </div>

  <?php Vistas::cargar('funciones' . DS . 'swicthes', self::$datos, 'seguridad') ?>

</div>  

<script>
  var timerCodigoNombreUsuario;
  $(document).ready(function () {
    $("#usuario_empleado").on("keyup", function () {
      clearTimeout(timerCodigoNombreUsuario);
      timerCodigoNombreUsuario = setTimeout(function () {
        validar_existe_usuario_empleado();
      }, 1000);
    });
    $("#usuario_empleado").focus();
  });
  function validar_existe_usuario_empleado() {
    var codigo = $("#usuario_empleado").val();
    if (!estaVacio(codigo)) {
//      informacion('<h4 class="text-center">Espera mientras validamos el codigo.</h4>', 'Validando Codigo de Empleado');
      $("#cargando-empleado").show();
      ejecutarAccion('seguridad', 'empleados', 'validarExistenciaUsuario', 'usuario_empleado=' + codigo,
        function (resp) {
          //alert(resp);
          $("#cargando-empleado").fadeOut();
          var resp = JSON.parse(resp);
          $("#resp-validar-usuario-empleado").html(resp.mensaje);
          if (resp.respuesta == "ERROR") {

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

