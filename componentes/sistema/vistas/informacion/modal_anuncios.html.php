<div id="modal_anuncios"  class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="Anuncios / Mensajes">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                Anuncios / Mensajes
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                    
            </div>
            <div class="modal-body">
                <iframe src="https://docs.google.com/a/palmasoftltda.com/forms/d/1M_w5-CHw_a_qcVDs10tID3dOZ73QpfXb6j6A4m1w-UU/viewform" 
                        id="ifAnuncio"  name="ifAnuncio" scrolling="auto" frameborder="no" align="center" height = "" width = "100%">
                </iframe>
            </div>
        </div>
    </div>
</div>

<script>
    $("#ifAnuncio").attr('height', ( $( "#modal_anuncios" ).height()  * 6 / 10));
    $(document).ready(function () {
        setTimeout(
                function (evt) {
                    $('#modal_anuncios').modal('show');
                }, 700);
    });
</script>


    <?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

