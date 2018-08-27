
<?php
Vistas::cargar('equipos' . DS . 'form-equiposentregar', self::$datos, 'servicios');
?>   

<script>
    $(document).ready(function () {

    });

    function quitarFilaTablaEquipo(objTdFila) {
        var htmlFila = $(objTdFila).parent().parent().html();
        var tipo = $(htmlFila).find('#item-tipo-equipo').val();
        var codigo = $(htmlFila).find('#item-codigo-equipo').val();
        var serial = $(htmlFila).find('#item-serial-equipo').val();
        var movimiento = $(htmlFila).find('#item-movimiento-equipo').val();
        var id = $(htmlFila).find('#item-id-equipo').val();
        if (movimiento == 'entregado') {
            $("#equipos-para-entregar").append('<option value="' + id + '">' + tipo + " " + codigo + " " + serial + '</option>');
            $("#equipos-para-entregar").trigger("change");
        } else {
            $("#equipos-para-recoger").append('<option value="' + id + '">' + tipo + " " + codigo + " " + serial + '</option>');
            $("#equipos-para-recoger").trigger("change");
        }
        $(objTdFila).parent().parent().remove();
        actualizarResumenRecibo();
    }

</script>



<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

