
<select id="<?php echo $id_lista_dinamica ?>" name="<?php echo $nombre_lista_dinamica ?>" class="form-control" multiple="" >
    <option>SELECCIONE UNO</option>                
</select>
<script type="text/javascript">
    $(document).ready(function () {
        $("#<?php echo $id_lista_dinamica ?>").select2({
            ajax: {
                url: "controlador.php",
                type: "POST",
                dataType: 'html',
                delay: 250,
                data: function (params) {
                    return {
                        buscar: params.term, // search term
                        pagina: params.page,
                        componente: "<?php echo $componente_consulta ?>",
                        controlador: "<?php echo $controlador_consulta ?>",
                        accion: "<?php echo $accion_consulta ?>"
                    };
                },
                processResults: function (data, page) {
                   //alert(data);
                    data = JSON.parse(data);
                    return {
                        results: data.items
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 3,
//            templateResult: formatRepo, // omitted for brevity, see the source of this page
//            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
            tags: true
        });
    });
</script>



<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

