
<div class="row">
    <div class="col-xs-12 invoice-header">
        <h1>
            <i class="fa fa-globe"></i> Recibo de Servicio.
            <small class="pull-right" style="font-size: 50%;">
                Fecha: <strong><?php echo isset($datosDelServicios->reciboFechaServicio) ? $datosDelServicios->reciboFechaServicio : $fechaServicio ?></strong>
                <input type="hidden" name="fecha-recibo" value="<?php echo isset($datosDelServicios->reciboFechaServicio) ? $datosDelServicios->reciboFechaServicio : $fechaServicio ?>" />
            </small>
        </h1>
    </div>
</div>

<div class="row invoice-info">
    <div class="container" >
        <div class="col-md-6 col-sm-6 col-xs-12 invoice-col ">
            <strong>CLIENTE:</strong> 
            <div class="hidden-print no-print">
                <select id="cliente-servicio" name="cliente-servicio" class="select2 " style="width: 100%" placeholder="seleccione un cliente" required="" >
                    <option value=""></option>
                    <?php foreach ($Clientes as $Cliente) : ?> 
                        <?php $seleccionado = ( isset($datosDelServicios->reciboCliente) ? ($datosDelServicios->reciboCliente == $Cliente->clienteId ? "selected" : "" ) : "" ); ?>
                        <option <?php echo $seleccionado ?>
                            data-codigo="<?php echo $Cliente->clienteCodigo ?>"  
                            data-nombre="<?php echo $Cliente->personaRazonSocial ?>"  
                            data-dir="<?php echo $Cliente->personaDireccion ?>"  
                            data-tel="<?php echo $Cliente->personaTelefono ?>"  
                            data-correo="<?php echo $Cliente->personaCorreoElectronico ?>"  
                            data-latitud="<?php echo $Cliente->personaLatitud ?>"  
                            data-longitud="<?php echo $Cliente->personaLongitud ?>"  
                            value="<?php echo $Cliente->clienteId ?>"  >
                            <?php echo $Cliente->tipoIdentificacionCodigo ?> <?php echo $Cliente->personaIdentificacion ?> | <?php echo $Cliente->personaRazonSocial ?> | <?php echo $Cliente->clienteCodigo ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <address>
                codigo: <strong><span id="codigo-cliente"><?php echo isset($datosDelServicios->clienteCodigo) ? $datosDelServicios->clienteCodigo : 'seleccione un cliente' ?></span></strong>
                <br><em><strong><span id="nombres-cliente"><?php echo isset($datosDelServicios->personaRazonSocial) ? $datosDelServicios->personaRazonSocial : 'seleccione un cliente' ?></span></strong></em>
                <br><span id="dir-cliente"><?php echo isset($datosDelServicios->personaDireccion) ? $datosDelServicios->personaDireccion : 'seleccione un cliente' ?></span>                
                <br>Teléfono: <strong><span id="tel-cliente"><?php echo isset($datosDelServicios->personaCelular) ? $datosDelServicios->personaCelular : 'seleccione un cliente' ?></span></strong>
                <br>Correo: <strong><span id="correo-cliente"><?php echo isset($datosDelServicios->personaCorreoElectronico) ? $datosDelServicios->personaCorreoElectronico : 'seleccione un cliente' ?></span></strong>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12 invoice-col  ">
            <div id="div-select-referencia-servicio">
                <?php Vistas::cargar('referencias' . DS . 'select-referencias-cliente', self::$datos, 'personas'); ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(
            function () {
            $("#cliente-servicio").select2({
            placeholder: "Seleccione el cliente"
            })
                    .change(function () {
                    cargarSelectReferenciaCliente($(this));
                            cargarEquiposPosesionCliente($(this));
                            $("#codigo-cliente").html($("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-codigo'));
                            $("#nombres-cliente").html($("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-nombre'));
                            $("#dir-cliente").html($("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-dir'));
                            $("#tel-cliente").html($("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-tel'));
                            $("#correo-cliente").html($("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-correo'));
                            $("#direccion-servicio").html($("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-dir'));
                            var posLat = $("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-latitud');
                            if (estaVacio(posLat)){
                    posLat = 11.253427413<?php echo rand(0, 9) ?>;
                    }
                    var posLon = $("#cliente-servicio option[value='" + $(this).val() + "']").attr('data-longitud');
                            if (estaVacio(posLon)){
                    posLon = - 74.196884<?php echo rand(0, 9) ?>;
                    }
                    colocarMarcador(posLat, posLon);
                    });
            }
    );
    function cargarSelectReferenciaCliente(objSelect) {
        ejecutarAccion('personas', 'referencias', 'selectReferenciasCliente',
                'registro_cliente=' + objSelect.val(),
                function (respuesta) {
                    $("#div-select-referencia-servicio").html(respuesta);
                }
        );
    }

    function cargarEquiposPosesionCliente(objSelect) {
        ejecutarAccion('servicios', 'equipos', 'enPosesionDelCliente',
                'registro_cliente=' + objSelect.val(),
                function (respuesta) {
                    //alert(respuesta); 
                    $("#div-select-equipos-recoger-cliente").html(respuesta);
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

