<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       Sectores Comerciales
       <small>Listado de Sectores de Comercio segun RES-000139 de NOV. 21 DE 2012 de la DIAN.</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Data tables</li>
    </ol>
</section>





<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sectores o Secciones Comerciales</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <h2>Listado de Sectores de Comercio obtenidos de la RESOLUCIÓN NÚMERO 000139 de NOV. 21 DE 2012 de la DIAN. <a href="http://www.dane.gov.co/files/nomenclaturas/CIIU_Rev4ac.pdf" target="_blank">Consulta aquí</a></h2>
                    <table id="example1" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>CODIGO</th>
                                <th>TITULO</th>
                                <th>DESCRIPCION</th>
                                <th>CODIGOS VIEJO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($listado as $Sector) : ?>
                                <tr>
                                    <td>[<?php echo $Sector->codigo_tipo_actividad_economica ?>]</td>
                                    <td><?php echo $Sector->nombre_tipo_actividad_economica ?></td>
                                    <td><?php echo $Sector->desc_tipo_actividad_economica ?></td>
                                    <td><?php echo $Sector->codigo_viejo_tipo_actividad_economica ?></td>
                                </tr>                        
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div><!-- /.col -->
    </div><!-- /.row -->
</section>

<script type="text/javascript">
    $(function () {
        $('#example1').dataTable({
            "bPaginate": true,
            "bLengthChange": true,
            "bFilter": true,
            "bSort": true,
            "bInfo": true,
            "bAutoWidth": true
        });
    });
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

