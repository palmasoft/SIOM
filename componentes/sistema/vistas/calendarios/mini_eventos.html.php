<div class="box box-solid bg-green-gradient">
    <div class="box-header ui-sortable-handle" style="cursor: move;">
        <i class="fa fa-calendar"></i>
        <h3 class="box-title">Calendario de la CCSM</h3>
        <!-- tools box -->
        <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
                <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="#">Agregar Evento</a></li>                                
                    <li class="divider"></li>
                    <li><a href="#">Ver Calendario</a></li>
                </ul>
            </div>
            <button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
        </div><!-- /. tools -->
    </div><!-- /.box-header -->
    <div class="box-body no-padding">
        <!--The calendar -->
        <div id="calendar" style="width: 100%"></div>
    </div><!-- /.box-body -->
    <div class="box-footer text-black">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="text-center">Eventos para <?php echo $fecha_consulta ?></h4>
            </div>
            <div class="col-sm-6">
                <!-- Progress bars -->
                <div class="clearfix">
                    <span class="pull-left">Task #1</span>
                    <small class="pull-right">90%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                </div>

                <div class="clearfix">
                    <span class="pull-left">Task #2</span>
                    <small class="pull-right">70%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                </div>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <div class="clearfix">
                    <span class="pull-left">Task #3</span>
                    <small class="pull-right">60%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                </div>

                <div class="clearfix">
                    <span class="pull-left">Task #4</span>
                    <small class="pull-right">40%</small>
                </div>
                <div class="progress xs">
                    <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                </div>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
</div>



<script type="text/javascript">
    'use strict';
    $(document).ready(function () {
        //The Calender
        var calendario = $("#calendar").datepicker({
            todayHighlight: true
        });
        calendario.on('changeDate', function (date) {
            alert("->" + JSON.stringify(date));
        });

    });
</script>

<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

