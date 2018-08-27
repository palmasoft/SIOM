
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Formulario <small>de Clientes </small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <form id="frm-cliente" data-parsley-validate class="form-horizontal form-label-left">
          <div class="row">
            <div class=" col-md-7">
              <div class="row">
                <div class="form-group col-md-12">
                  <div id="resp-validar-codigo-cliente" class="col-md-12"></div>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label col-md-3 col-sm-3 col-xs-3">Codigo de Cliente</label>
                  <div class="col-md-9 col-sm-9 col-xs-9">
                    <input type="text" class="form-control mayusculas" id="codigo_cliente"  name="codigo_cliente" required="required"                            
                           data-inputmask="'mask': '[********************]'" value="<?php echo ( isset($datosCliente) ? $datosCliente->clienteCodigo : "" ); ?>" />
                    <span class="fa fa-key form-control-feedback right" aria-hidden="true"></span>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de Cliente</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select id="tipo-cliente"  name="tipo-cliente" class="form-control" required="">
                      <option value="">SELECCIONA UNO</option>
                      <?php foreach($tiposClientes as $TipoCliente) : ?>
                        <?php
                        $selected = "";
                        if(isset($datosCliente) and $datosCliente->clienteTipo == $TipoCliente->tipoClienteId) {
                          $selected = "selected";
                        }
                        ?>
                        <option <?php echo $selected ?> value="<?php echo $TipoCliente->tipoClienteId ?>">[<?php echo $TipoCliente->tipoClienteCodigo ?>] <?php echo $TipoCliente->tipoClienteTitulo ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>  
              <?php Vistas::cargar('personas' . DS . 'formulario-datos', self::$datos, 'personas') ?>
            </div>     
            <div class=" col-md-5">
              <div class="row">
                <div class="col-md-12">
                  <?php Vistas::cargar('clientes' . DS . 'ubicar', self::$datos, 'ubicaciones') ?>
                </div>
              </div>
            </div>
          </div>
          <div class="ln_solid"></div>
          <?php
          $datos['Referencias'] = NULL;
          if(isset($datosClienteContactos) and !is_null($datosClienteContactos)  ) {
            $datos['Referencias'] = $datosClienteContactos;
          }
          Vistas::cargar('referencias' . DS . 'formulario-clientes', $datos);
          ?>
          <div class="form-group">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="button" class="btn btn-primary" onclick="mostrarListadoClientes();"><i class="fa fa-backward" ></i> Regresar</button>
                <button type="reset" class="btn btn-warning" ><i class="fa fa-eraser" ></i> Limpiar</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> Guardar</button>
              </div>
            </div>
          </div>
          <input type="hidden" id="registro-cliente"  name="registro-cliente" value="<?php echo ( isset($datosCliente) ? $datosCliente->clienteId : "" ); ?>" />
        </form>
      </div>
    </div>
  </div>
</div>


<script>
  var timerCodigo;
  $(document).ready(function () {
    $("#codigo_cliente").on("keyup", function () {
      clearTimeout(timerCodigo);
      timerCodigo = setTimeout(function () {
        validar_existe_codigo_cliente();
      }, 1000);
    });

    $("#frm-cliente").submit(function (evt) {
      var data = new FormData(document.getElementById('frm-cliente'));
      ejecutarAccionArchivos(
        'personas', 'clientes', 'guardarCambios',
        data,
        function (resp) {
//          alert(resp);
          $("#desc-cliente").html(resp);
          resp = JSON.parse(resp);
//          alert(resp);
          if (resp.TIPO_RESPUESTA == 'EXITO') {
            mostrar_contenidos(
              'personas',
              'clientes',
              'editar',
              'registro-cliente=' + resp.MENSAJE_RESPUESTA
              );
          } else {
            alerta(resp.MENSAJE_RESPUESTA);
          }
        }
      );
      return false;
    });




    $("#codigo_cliente").focus();
  });
  function validar_existe_codigo_cliente() {
    var codigo = $("#codigo_cliente").val();
    if (!estaVacio(codigo)) {
//      informacion('<h4 class="text-center">Espera mientras validamos el codigo.</h4>', 'Validando Codigo de Cliente');
      $("#cargando-cliente").show();
      ejecutarAccion('personas', 'clientes', 'validarExistenciaCodigo', 'codigo_cliente=' + codigo,
        function (resp) {
          $("#cargando-cliente").fadeOut();
          var resp = JSON.parse(resp);
          $("#resp-validar-codigo-cliente").html(resp.mensaje);
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

