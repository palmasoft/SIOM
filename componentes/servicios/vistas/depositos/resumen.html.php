<?php //print_r($DatosDeposito)  ?>
<div class="row">
  <div class="col-md-6 col-sm-4 col-xs-12">
    <div class="">Servicio <?php echo $DatosDeposito->servicioCodigo ?> | Fecha <?php echo $DatosDeposito->servicioCreado ?> </div>
    <div class="">Cliente <?php echo $DatosDeposito->clienteCodigo ?></div>
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

  <div class=" col-md-6 col-sm-8 col-xs-12">
    <div class=" col-md-12 col-sm-12 col-xs-12">
      <div>Deposito Entregado: $ <?php echo number_format($DatosDeposito->reciboDepositoValor, 0, ',', '.') ?></div>
      <div class="lead">Datos del Deposito <label class="label label-info label-important large"><?php echo $DatosDeposito->reciboDepositoEstado ?></label></div>
    </div>
    <div class=" col-md-6 col-sm-6 col-xs-12">
      <div>Doc. de Ingreso: #<?php if(!is_null($DatosDeposito->documentoConsecutivo)): ?><?php echo $DatosDeposito->documentoConsecutivo ?><?php endif; ?></div>
      <p class="lead">Entregado por:</p>
      <div>
        <p class="text-muted well well-sm no-shadow" style="">
          <strong><?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->nombresReferencia ?><?php else: ?><?php echo $DatosDeposito->personaRazonSocial ?><?php endif; ?></strong>
          <br><?php if(!is_null($DatosDeposito->reciboReferencia)): ?>CC <?php echo $DatosDeposito->identificacionReferencia ?><?php else: ?><?php echo $DatosDeposito->tipoIdentificacionCodigo . " " . $DatosDeposito->personaIdentificacion ?><?php endif; ?>
          <br><?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->direccionReferencia ?><?php else: ?><?php echo $DatosDeposito->personaDireccion ?><?php endif; ?>
          <br><?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->celularReferencia ?><?php else: ?><?php echo $DatosDeposito->personaCelular ?><?php endif; ?>
          <br> <?php if(!is_null($DatosDeposito->reciboReferencia)): ?><?php echo $DatosDeposito->correoReferencia ?><?php else: ?><?php echo $DatosDeposito->personaCorreoElectronico ?><?php endif; ?>
        </p>
      </div>
    </div>
    <div class=" col-md-6 col-sm-6 col-xs-12">
      <div>Doc. de Egreso: #<?php if(!is_null($DatosDeposito->documentoConsecutivoEgreso)): ?><?php echo $DatosDeposito->documentoConsecutivoEgreso ?><?php endif; ?></div>
      <p class="lead">Devuelto a:</p>
      <div>
        <p class="text-muted well well-sm no-shadow" style="">
          <strong><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->nombresDevueltoA ?><?php endif; ?></strong>
          <br><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?>CC <?php echo $DatosDeposito->identificacionDevueltoA ?><?php endif; ?>
          <br><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->direccionDevueltoA ?><?php endif; ?>
          <br><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->celularDevueltoA ?><?php endif; ?>
          <br> <?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->correoDevueltoA ?><?php endif; ?>
        </p>
      </div>
    </div>
  </div>

</div>