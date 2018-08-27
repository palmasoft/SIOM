<?php //print_r($DatosDeposito)             ?>
<div class="row">


  <div class="x_panel">   
    <div class="x_title">
      <h2>Formato de Devolución de Depositos</h2>      
      <div class="clearfix"></div>
    </div>
    <div class="x_content">

      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="">Servicio <?php echo $DatosDeposito->servicioCodigo ?> | Fecha <strong><?php echo $DatosDeposito->servicioCreado ?></strong></div>
        <div class="">Cliente <strong><?php echo $DatosDeposito->clienteCodigo ?></strong></div>
        <div class=""><strong><?php echo $DatosDeposito->personaRazonSocial ?></strong></div>
        <div class=""><?php echo $DatosDeposito->personaNombreComercial ?></div>
        <div class=""><?php echo $DatosDeposito->tipoIdentificacionCodigo . " " . $DatosDeposito->personaIdentificacion ?></div>
        <div><?php echo $DatosDeposito->reciboDireccion ?></div>
        <div class="lead">Recibo #<?php echo $DatosDeposito->reciboNumero ?></div>
        <div class="table-responsive">
          <table class="table">
            <tbody>
              <tr>
                <th style="text-align: center;" colspan="4">Equipos del Servicio</th>
              </tr>
              <tr>
                <th style="width:auto">Entregados:</th>
                <td><?php echo $DatosDeposito->EquiposEntregados ?></td>
                <th>Devuletos:</th>
                <td><?php echo $DatosDeposito->EquiposDevueltos ?></td>
              </tr>
              <tr>
                <th>Recogidos:</th>
                <td><?php echo $DatosDeposito->EquiposRecogidos ?></td>
                <th>No Recogidos:</th>
                <td><?php echo $DatosDeposito->EquiposNoRecogidos ?></td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
      <div class=" col-md-8 col-sm-8 col-xs-12">
        <div class=" col-md-6 col-sm-6 col-xs-12">
          <div class=" col-md-12 col-sm-12 col-xs-12">
            <div style="font-size: 120%">Deposito Entregado: $ <?php echo number_format($DatosDeposito->reciboDepositoValor, 0, ',', '.') ?></div>
            <div class="lead">Datos del Deposito <label class="label label-info label-important large"><?php echo $DatosDeposito->reciboDepositoEstado ?></label></div>
          </div>
          <div>Doc. de Ingreso: #<?php if(!is_null($DatosDeposito->documentoConsecutivo)): ?><?php echo $DatosDeposito->documentoConsecutivo ?><?php endif; ?></div>
          <p class="lead">Entregado por:</p>
          <div>
            <p class="text well well-sm no-shadow" style="">
              <strong><?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->nombresReferencia ?><?php else: ?><?php echo $DatosDeposito->personaRazonSocial ?><?php endif; ?></strong>
              <br><?php if(!is_null($DatosDeposito->reciboReferencia)): ?>CC <?php echo $DatosDeposito->identificacionReferencia ?><?php else: ?><?php echo $DatosDeposito->tipoIdentificacionCodigo . " " . $DatosDeposito->personaIdentificacion ?><?php endif; ?>
              <br><?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->direccionReferencia ?><?php else: ?><?php echo $DatosDeposito->personaDireccion ?><?php endif; ?>
              <br><?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->celularReferencia ?><?php else: ?><?php echo $DatosDeposito->personaCelular ?><?php endif; ?>
              <br> <?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->correoReferencia ?><?php else: ?><?php echo $DatosDeposito->personaCorreoElectronico ?><?php endif; ?>
            </p>
          </div>
        </div>
        <div class=" col-md-6 col-sm-6 col-xs-12">
          <form id="frm-devolverdeposito">

            <div></div>
            <p class="lead">Devolver A:</p>
            <div>
              <p class="text well well-sm no-shadow" style="">
                <span>
                  <label>
                    <span class="label label-danger label-important large pull-right" style="font-size: 100%;">CLIENTE</span> 
                    <input type="radio" class="flat" required=""
                           name="referencia-recibe-deposito" value="<?php echo $DatosDeposito->personaId ?>" >
                             <?php echo $DatosDeposito->clienteCodigo ?> | <?php echo $DatosDeposito->personaRazonSocial ?>
                  </label>
                </span>
                <span class="clearfix"></span>
                <?php foreach($ReferenciasCliente AS $Referencia): ?>
                  <span>
                    <label>

                      <span class="label label-info label-important large pull-right" style="font-size: 100%;"><?php echo $Referencia->clienteContactoEtiquetas ?></span> 

                      <input type="radio" class="flat" required=""
                             name="referencia-recibe-deposito" value="<?php echo $Referencia->personaId ?>" > 
                      <?php echo $Referencia->personaNombres ?> <?php echo $Referencia->personaApellidos ?> | <?php echo $Referencia->personaIdentificacion ?>

                    </label>
                  </span>
                  <span class="clearfix"></span>
                <?php endforeach; ?>
              </p>
            </div>

            <div class="text-center">
              <?php if($DatosDeposito->reciboDepositoEstado == "RECIBIDO"): ?>
              <input type="hidden" name="registro_deposito" value="<?php echo $DatosDeposito->reciboDepositoId ?>" />
              <button type="submit" class="btn btn-success">
                <i class="fa fa-backward" style="display: inline-block"></i>
                <i class="fa fa-money"  style="display: inline-block"></i>
                <br />Entregar Dinero
              </button>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>

</div>

<script>

  $(document).ready(function () {
    $('input.flat').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });



    $("#frm-devolverdeposito").submit(function () {
      var datos = $(this).serialize();
      ejecutarAccion('servicios', 'depositos', 'devolverDeposito', datos,
        function (resp) {
//          alert(resp);
          var respuesta = JSON.parse(resp)
          if (respuesta.TIPO_RESPUESTA == "EXITO") {
            mostrar_contenidos('servicios', 'depositos', 'mostrarTodos', '');
          } else {
            alerta(respuesta.MENSAJE_RESPUESTA);
          }
        });
    });

  });

</script>