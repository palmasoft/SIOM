
<div class="row resumen_consulta"  style="">
  <div class="" >
    <div class="col-md-3 col-sm-12 col-xs-12">
      <div class="lead">Datos del Cliente</div>
      <h3><?php echo $DatosCliente->personaRazonSocial ?></h3>
      <div class="col-xs-12 col-sm-12">
        <div class=" view view-first">
          <img style="width: 100%; display: block;" src="<?php echo $DatosCliente->personaFotoReferencia ?>" alt="Codigo QR" />          
        </div>
        <div class="caption">
          <div><strong><?php echo $DatosCliente->clienteCodigo ?></strong></div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12">
        <div class="well well-sm shadow">
          <div class="small" style="font-weight: bold; color: green;"><?php echo $DatosCliente->tipoClienteTitulo ?></div>          
          <div class="small" ><?php echo $DatosCliente->personaNombreComercial ?></div>
          <div class="small" ><?php echo $DatosCliente->personaNombres ?> <?php echo $DatosCliente->personaApellidos ?></div>
          <div><strong><?php echo $DatosCliente->personaTelefono ?> - <?php echo $DatosCliente->personaCelular ?></strong></div>      
          <div><strong><em><a href="mailto:<?php echo $DatosCliente->personaCorreoElectronico ?>" target="_blank"><?php echo $DatosCliente->personaCorreoElectronico ?></a></em></strong></div>          
          <div><?php echo $DatosCliente->personaDireccion ?></div>
          <div class="label-important">desde  <?php echo $DatosCliente->clienteCreado ?></div>
          <p><?php echo $DatosCliente->personaObservaciones ?></p>
        </div>
      </div>
    </div>
    <?php // print_r($DatosCliente->RecibosServicios); ?>

    <div class="col-md-9 col-sm-12 col-xs-12">      
      <div class="lead">Contactos o Referenias</div>
      <table id="tblResumenConsultaClienteContactos<?php echo $DatosCliente->clienteId ?>" class="dataTable table table-striped">
        <thead>
          <tr style="text-align: center;">
            <th>Cedula</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Dirección</th>
            <th>Telefonos</th>
            <th>Correo</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($DatosCliente->Contactos)): foreach($DatosCliente->Contactos as $Contacto) :
              ?>
              <tr>
                <th scope="row"><?php echo $Contacto->personaIdentificacion ?></th>
                <td><?php echo $Contacto->personaNombres ?></td>
                <td><?php echo $Contacto->personaApellidos ?></td>
                <td><?php echo $Contacto->personaDireccion ?></td>
                <td><?php echo $Contacto->personaTelefono ?> - <?php echo $Contacto->personaCelular ?></td>
                <td><?php echo $Contacto->personaCorreoElectronico ?></td>
              </tr>
              <?php
            endforeach;
          endif;
          ?>
        </tbody>
      </table>    
      <div class="clear clearfix"></div>
      <div class="lead">Recibos de Servicios Prestados</div>
      <table id="tblResumenConsultaCliente<?php echo $DatosCliente->clienteId ?>" class="dataTable table table-striped">
        <thead>
          <tr style="text-align: center;">
            <th></th>
            <th></th>
            <th></th>
            <th style="text-align: center;" colspan="4">Equipos</th>
            <th style="text-align: center;" colspan="3">Deposito</th>
            <th></th>
          </tr>
          <tr>
            <th>Fecha</th>
            <th>Recibo</th>
            <th>Referencia</th>
            <th>E</th>
            <th>R</th>
            <th>N</th>
            <th>D</th>
            <th>Ingreso</th>
            <th>Egreso</th>
            <th>Valor</th>
            <th>Empleado</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($DatosCliente->RecibosServicios)): foreach($DatosCliente->RecibosServicios as $Recibo) :
              ?>
              <tr>
                <th scope="row"><?php echo $Recibo->reciboFechaServicio ?></th>
                <td><a href="<?php echo $Recibo->documentoUrl ?>" target="_blank"><?php echo $Recibo->reciboNumero ?></a></td>
                <td><?php if(!is_null($Recibo->reciboReferencia)): ?><span title="<?php echo $Recibo->nombresReferencia ?> <?php echo $Recibo->apellidosReferencia ?>"><?php echo $Recibo->idReferencia ?></span><?php endif; ?></td>
                <td><?php echo $Recibo->EquiposEntregados ?></td>
                <td><?php echo $Recibo->EquiposRecogidos ?></td>
                <td><?php echo $Recibo->EquiposNoRecogidos ?></td>
                <td><?php echo $Recibo->EquiposDevueltos ?></td>
                <td><?php if(isset($Recibo->Deposito)): ?><a href="<?php echo $Recibo->Deposito->documentoUrl ?>" target="_blank"><?php echo $Recibo->Deposito->documentoConsecutivo ?></a><?php endif; ?></td>
                <td><?php if(isset($Recibo->Deposito)): ?><a href="<?php echo $Recibo->Deposito->documentoUrlEgreso ?>" target="_blank"><?php echo $Recibo->Deposito->documentoConsecutivoEgreso ?></a><?php endif; ?></td>
                <td><?php if(isset($Recibo->Deposito)): ?><?php echo $Recibo->Deposito->reciboDepositoValor ?><?php endif; ?></td>
                <td><?php echo $Recibo->usuarioNombre ?></td>
              </tr>
              <?php
            endforeach;
          endif;
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
  var oTable;
  $(document).ready(function () {
    oTable = $('#tblResumenConsultaClienteContactos<?php echo $DatosCliente->clienteId ?>').DataTable({      
    });
    oTable = $('#tblResumenConsultaCliente<?php echo $DatosCliente->clienteId ?>').DataTable({
      "aaSorting": [[0, "desc"]]
    });
  });
</script>


<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

