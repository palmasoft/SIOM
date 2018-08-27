
<div class="row no-print hidden-print">
    <div class="col-xs-12" >
        <div class="text-muted well well-sm no-shadow" style="">
            <form id="form-equipos-para-entregar" class="form form-inline" >
                <div class="row ">
                    <div class="form-group col-md-9 col-sm-8 col-xs-12">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Equipo para Entregar:</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <?php
                            Vistas::cargar('equipos' . DS . 'select-equipos-para-entregar', self::$datos, 'productos');
                            ?>        
                        </div>
                    </div>
                    <div class="form-group col-md-3 col-sm-4 col-xs-12">
                        <button class="btn btn-success" type="submit"><i class="fa fa-arrow-down" ></i> Entregar Equipo</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<script>
    $(document).ready(function () {

        $("#form-equipos-para-entregar").submit(function () {
            ejecutarAccion(
                    'servicios', 'equipos', 'nuevoFilaTabla',
                    'movimiento=entregado&registro_equipo=' + $("#equipos-para-entregar").val(),
                    function (respuesta) {

                        $("#equipos-para-entregar option[value='" + $("#equipos-para-entregar").val() + "']").remove();

                        $("#equipos-para-entregar").trigger("change");

                        $("#lista-equipos-recibo-servicio").prepend(respuesta);
                        actualizarResumenRecibo();
                    }
            );
        });


    });
</script>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

