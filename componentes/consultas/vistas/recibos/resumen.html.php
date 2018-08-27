<div class="row resumen_consulta" style="">
  <div class="col-md-4 col-sm-12 col-xs-12">
    <div class="">Servicio <?php echo $DatosServicio->servicioCodigo ?> | Fecha <?php echo $DatosServicio->servicioCreado ?> </div>
    <label class="label label-info label-important large"><?php echo $DatosServicio->reciboEstado ?></label>
    <div class="lead"><a href="<?php echo $DatosServicio->documentoUrl ?>" target="_blank">Recibo #<?php echo $DatosServicio->reciboNumero ?></a></div>

    <div class="table-responsive">
      <table class="table">
        <tbody>
          <tr>
            <th style="text-align: center;" colspan="4">Equipos del Servicio</th>
          </tr>
          <tr>
            <th style="width:auto">Entregados:</th>
            <td><?php echo $DatosServicio->EquiposEntregados ?></td>          
            <th>Devuletos:</th>
            <td><?php echo $DatosServicio->EquiposDevueltos ?></td>
          </tr>
          <tr>
            <th>Recogidos:</th>
            <td><?php echo $DatosServicio->EquiposRecogidos ?></td>          
            <th>No Recogidos:</th>
            <td><?php echo $DatosServicio->EquiposNoRecogidos ?></td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>

  <div class=" col-md-4 col-sm-12 col-xs-12">
    <div class=" col-md-12 col-sm-12 col-xs-12">      
      <h2>
        <?php echo $DatosServicio->personaRazonSocial ?> 
        <div><?php echo $DatosServicio->tipoIdentificacionCodigo ?> <?php echo $DatosServicio->personaIdentificacion ?></div>
      </h2>
      <div>codigo <strong><?php echo $DatosServicio->clienteCodigo ?></strong></div>
      <div>dirección <strong><?php echo $DatosServicio->personaDireccion ?></strong></div>

    </div>
    <div class="  <?php if(!is_null($DatosServicio->clienteContactoId)): ?>col-md-6<?php else: ?>col-md-12<?php endif; ?> col-sm-6 col-xs-12">
      <h5>Servicio realizado en:</h5>
      <div>
        <p class=" well well-sm no-shadow" style="">
          <strong><?php echo $DatosServicio->reciboDireccion ?></strong>
          <br><a target="_blank" href="https://maps.google.com/maps?q=<?php echo $DatosServicio->reciboLatitud ?>, <?php echo $DatosServicio->reciboLongitud ?>&hl=es;z=14&amp;output=embed"><?php echo $DatosServicio->reciboLatitud ?>, <?php echo $DatosServicio->reciboLongitud ?></a>
        </p>
      </div>
    </div>
    <?php if(!is_null($DatosServicio->clienteContactoId)): ?>
      <div class=" col-md-6 col-sm-6 col-xs-12">      
        <h5>Entregado a:</h5>
        <div>
          <p class=" well well-sm no-shadow" style="">
            <strong><?php echo $DatosServicio->nombresReferencia ?> <?php echo $DatosServicio->apellidosReferencia ?></strong>
            <br> <?php echo $DatosServicio->idReferencia ?>
            <br> <?php echo $DatosServicio->celularReferencia ?> <?php echo $DatosServicio->telefonoReferencia ?>
            <br> <?php echo $DatosServicio->correoReferencia ?>
          </p>
        </div>
      </div>
    <?php endif; ?>

  </div>

  <?php if(!is_null($DatosDeposito)): ?>
    <div class=" col-md-4 col-sm-12 col-xs-12">
      <div class=" col-md-12 col-sm-12 col-xs-12">
        <div>Deposito Entregado: $ <?php echo number_format($DatosDeposito->reciboDepositoValor, 0, ',', '.') ?></div>
        <div class="lead">Datos del Deposito <label class="label label-info label-important large"><?php echo $DatosDeposito->reciboDepositoEstado ?></label></div>
      </div>
      <div class=" col-md-6 col-sm-6 col-xs-12">
        <div>Doc. de Ingreso: #<?php if(!is_null($DatosDeposito->documentoConsecutivo)): ?><?php echo $DatosDeposito->documentoConsecutivo ?><?php endif; ?></div>
        <h5>Entregado por:</h5>
        <div>
          <p class=" well well-sm no-shadow" style="">
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
        <h5>Devuelto a:</h5>
        <div>
          <p class=" well well-sm no-shadow" style="">
            <strong><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->nombresDevueltoA ?><?php endif; ?></strong>
            <br><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?>CC <?php echo $DatosDeposito->identificacionDevueltoA ?><?php endif; ?>
            <br><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->direccionDevueltoA ?><?php endif; ?>
            <br><?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->celularDevueltoA ?><?php endif; ?>
            <br> <?php if(!is_null($DatosDeposito->reciboDepositoDevueltoA)): ?><?php echo $DatosDeposito->correoDevueltoA ?><?php endif; ?>
          </p>
        </div>
      </div>
    </div>
  <?php endif; ?>
</div>





<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

