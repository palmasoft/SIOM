<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="javascript:void(0);" onclick="nuevo_reciboMovilServicioEquipo()" 
                               class="btn btn-lg btn-success">Nueva Entrega o Recogida <span class="glyphicon glyphicon-barcode"></span></a>
                        </div>
                    </div>
<!--                    <div class="row">
                        <div class="col-xs-12">
                            <a href="javascript:void(0);" onclick="probar_generar()"  class="btn btn-lg btn-info">Probar Generar Archivo <span class="glyphicon glyphicon-folder-open"></span></a>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-xs-12">
                            <a href="#" class="btn btn-lg btn-info">Mis Últimos 10 Recibos <span class="glyphicon glyphicon-folder-open"></span></a>
                        </div>
                    </div>
                                        
                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" >

  function nuevo_reciboMovilServicioEquipo() {
    mostrar_contenidos(
      'servicios',
      'movil',
      'nuevoMovil'
      );
  }
  function probar_generar(){
    mostrar_contenidos(
      'servicios',
      'movil',
      'probarGenerar'
      );
  }

</script>