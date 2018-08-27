<?php
//echo json_encode($datosDelServicios, JSON_PRETTY_PRINT);
self::$datos['fechaServicio'] = $fechaServicio = date('Y-m-d h:i:s');
?>
<div class="row"> 
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Servicio <small>de Arrendamiento de Equipos</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <section id="area-form-servicio" class="content invoice">
                    <form id="form-cliente-servicio">
                        <?php
                        Vistas::cargar('movil' . DS . 'form-clientereferencia', self::$datos, 'servicios');
                        ?> 
                    </form>
                </section>
                <section id="area-form-ubicacionservicio" class="content invoice ">
                    <div id="form-ubicacionservicio"><?php
                        Vistas::cargar('equipos' . DS . 'form-ubicacionservicio', self::$datos, 'servicios');
                        ?>  </div>
                    <div>
                        <a href="javascript:void(0);" onclick="cargaFormEquiposEntregaMovil();"
                           class="btn btn-block btn-lg btn-primary">Equipos para Entregar <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </div>
                </section>
                <section id="area-tabla-equipos" style="display: none;" >
                    <?php
                    Vistas::cargar('equipos' . DS . 'tabla-recibo', self::$datos, 'servicios');
                    ?>  
                </section>
                <section id="area-form-equiposentregar" class="content invoice " style="display: none;">
                    <div id="form-equiposentregar"></div>
                    <div>
                        <a href="javascript:void(0);" onclick="cargaFormEquiposRecogerMovil();"
                           class="btn btn-block btn-lg btn-primary">Equipos para Recoger <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </div>
                </section>                
                <section id="area-form-equiposrecoger" class="content invoice " style="display: none;">
                    <div id="form-equiposrecoger"></div>
                    <div>
                        <a href="javascript:void(0);" onclick="cargaFormEquiposDepositoMovil();"
                           class="btn btn-block btn-lg btn-primary">Deposito por los equipos <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </div>
                </section>            
                <section id="area-form-equiposdeposito" class="content invoice " style="display: none;">
                    <div id="form-equiposdeposito">
                        <?php
                        Vistas::cargar('movil' . DS . 'formulario-equiposdeposito', self::$datos, 'servicios');
                        ?>  
                    </div>
                    <div>
                        <a href="javascript:void(0);" onclick="guardarNuevoReciboServicioMovil();"
                           class="btn btn-block btn-lg btn-primary">Guardar <span class="glyphicon glyphicon-save-file"></span></a>
                    </div>
                </section>


                <hr />
                <form>
                <div class=" col-xs-12 invoice-col ">
                    <b>Recibo #<span id="numero-recibo" title="Numero del Recibo Generado" style="font-size: 150%;" ><?php echo isset($datosDelServicios->reciboNumero) ? $datosDelServicios->reciboNumero : '?????' ?></span></b>
                    <br>
                    <br>
                    <b>Orden de Servicio:</b> <span id="orden-servicio"><?php echo isset($datosDelServicios->servicioCodigo) ? $datosDelServicios->servicioCodigo : $codigoServicio ?></span>
                    <input type="hidden" name="codigo-servicio" value="<?php echo isset($datosDelServicios->servicioCodigo) ? $datosDelServicios->servicioCodigo : $codigoServicio ?>" />
                    <br>
                    <b>Proxima RECOGIDA:</b> <span id="proxima-recogida"><?php echo isset($datosDelServicios->reciboFechaRecogida) ? $datosDelServicios->reciboFechaRecogida : $ProximaRecogidaServicio ?></span>
                    <input type="hidden" name="proxima-recogida-servicio" value="<?php echo isset($datosDelServicios->reciboFechaRecogida) ? $datosDelServicios->reciboFechaRecogida : $ProximaRecogidaServicio ?>" />
                    <br>
                    <div title="<?php echo isset($datosDelServicios->reciboFechaRecogida) ? $datosDelServicios->nombresEncargado . " " . $datosDelServicios->apellidosEncargado : Visitante::nombreCompletoUsuario() ?>" ><b>Responsable:</b> <span id="usuario-entrega"><?php echo isset($datosDelServicios->reciboFechaRecogida) ? $datosDelServicios->idEncargado . " " . $datosDelServicios->nombresEncargado . " " . $datosDelServicios->apellidosEncargado : Visitante::identificacionUsuario() . " " . Visitante::nombreCompletoUsuario() ?></span></div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var registro_cliente;
    $(document).ready(function () {

    });

    function cargarSelectReferenciaCliente(objSelect) {
        registro_cliente = objSelect.val();
        ejecutarAccion('personas', 'referencias', 'selectReferenciasCliente',
                'registro_cliente=' + registro_cliente,
                function (respuesta) {
                    $("#div-select-referencia-servicio").html(respuesta);
                }
        );
    }

    function cargaFormUbicacionMovil() {
        ejecutarAccion('servicios', 'movil', 'mostrarFormularioUbicacion', null,
                function (respuesta) {
                    $("#area-form-servicio").slideUp();
                    $("#form-ubicacionservicio").html(respuesta);
                    $("#area-form-ubicacionservicio").slideDown();
                }
        );
    }
    function cargaFormEquiposEntregaMovil() {
        ejecutarAccion('servicios', 'movil', 'mostrarFormularioEquiposEntrega', null,
                function (respuesta) {
                    $("#area-form-servicio").slideUp();
                    $("#area-form-ubicacionservicio").slideUp();
                    $("#form-equiposentregar").html(respuesta);
                    $("#area-form-equiposentregar").slideDown();
                    $("#area-tabla-equipos").slideDown();
                }
        );
    }
    function cargaFormEquiposRecogerMovil() {
        ejecutarAccion('servicios', 'movil', 'mostrarFormularioEquiposRecoger', 'registro_cliente=' + registro_cliente,
                function (respuesta) {
                    $("#area-form-servicio").slideUp();
                    $("#area-form-ubicacionservicio").slideUp();
                    $("#area-form-equiposentregar").slideUp();
                    $("#form-equiposrecoger").html(respuesta);
                    $("#area-form-equiposrecoger").slideDown();
                    $("#area-tabla-equipos").slideDown();
                }
        );
    }
    function cargaFormEquiposDepositoMovil() {
        ejecutarAccion('servicios', 'movil', 'mostrarFormularioEquiposDeposito', null,
                function (respuesta) {
                    $("#area-form-servicio").slideUp();
                    $("#area-form-ubicacionservicio").slideUp();
                    $("#area-form-equiposentregar").slideUp();
                    $("#area-form-equiposrecoger").slideUp();
                    $("#area-tabla-equipos").slideUp();
                    $("#form-equiposdeposito").html(respuesta);
                    $("#area-form-equiposdeposito").slideDown();
                }
        );
    }



    function guardarNuevoReciboServicioMovil() {

        var resp = $("#btn-datoscliente").click();
        if (estaVacio($("#cliente-servicio").val())) {
            return false;
        }
        var resp = $("#btn-ubicacionservicio").click();
        if (estaVacio($("#direccion-servicio").val())) {
            return false;
        }

        var filas = $('#tabla-equipos-recibo tbody tr');
        var equiposServicio = 0;
        filas.each(function () {
            var htmlFila = $(this).html();
            var equipoId = $(htmlFila).find('#item-id-equipo').val();
            if (!estaVacio(equipoId)) {
                equiposServicio++;
            }
        });
        if (estaVacio(equiposServicio)) {
            alerta('<h4>Debes registrar al menos un EQUIPO para este servicio.</h4>');
            return false;
        }

        //$(".botones_despues_de_generado").removeAttr('disabled');
        ejecutarAccion('servicios', 'equipos', 'guardarNuevoReciboMovil',
                $("form").serialize(),
                function (respuesta) {
                    alert(respuesta);
                    var resp = JSON.parse(respuesta);
                    if (resp.TIPO_RESPUESTA == 'EXITO') {
                        mostrar_contenidos(
                                'servicios',
                                'movil',
                                'descargarRecibo',
                                'registro-servicio=' + resp.MENSAJE_RESPUESTA
                                );

                    } else {
                        alerta(resp.MENSAJE_RESPUESTA);
                    }
                }
        );
    }


    function actualizarResumenRecibo() {



        var equiposServicio = 0;
        var equiposServicioEntregado = 0;
        var equiposServicioRecibidos = 0;
        var equiposServicioNORecibidos = 0;
        var equiposServicioDevueltos = 0;
        var equiposServicioDepositoTotal = 0;

        var filas = $('#tabla-equipos-recibo tbody tr');
        filas.each(function () {
            var htmlFila = $(this).html();
            var equipoId = $(htmlFila).find('#item-id-equipo').val();
            if (!estaVacio(equipoId)) {
                var equipoMov = $(htmlFila).find('#item-movimiento-equipo').val();
                switch (equipoMov) {
                    case 'entregado':
                        equiposServicioEntregado++;
                        break;
                    case 'perdido':
                        equiposServicioNORecibidos++;
                        break;
                    case 'devuelto':
                        equiposServicioDevueltos++;
                        break;
                    case 'buen_estado':
                        equiposServicioRecibidos++;
                        break;
                }
                equiposServicio++;
            }
        });
        var valorTarifaDeposito = $('input[name=deposito-servicio]:checked').attr('data-valor');
        if (valorTarifaDeposito == 'OTROVALOR') {
            valorTarifaDeposito = parseFloat($("#otroValor").val());
        }

        try {
            equiposServicioDepositoTotal = valorTarifaDeposito * equiposServicioEntregado;
            $("#equipos-totales-servicio").html(/*formatoNumero*/(equiposServicio));
            $("#equipos-entregados-servicio").html((equiposServicioEntregado));
            $("#equipos-recibidos-servicio").html((equiposServicioRecibidos));
            $("#equipos-norecibidos-servicio").html((equiposServicioNORecibidos));
            $("#equipos-devueltos-servicio").html((equiposServicioDevueltos));
            $("#equipos-deposito-servicio").html("$ " + (equiposServicioDepositoTotal));
            $("#valor-deposito").html("$ " + (equiposServicioDepositoTotal));
        } catch (err) {
            console.log(err.message);
        }
    }
</script>



<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

