
<?php
Vistas::cargar('equipos' . DS . 'form-deposito', self::$datos, 'servicios');
?>
<script>
    $(document).ready(function () {
        $('input.flat').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
        $(".deposito_servicio").on('ifChecked', function (event) {
            actualizarResumenRecibo();
        });
        $("#otroValor").on('keyup', function (event) {
            actualizarResumenRecibo();
        });
    });


</script>



<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

