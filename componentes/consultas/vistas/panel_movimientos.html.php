
<div class="x_panel">
    <div class="x_title">
        <h2>Reporte de Movimientos <small>de clientes y equipos.</small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <form id="form-generarreporte" data-parsley-validate class="form-horizontal form-label-left">
            <div class="col-md-6 col-sm-12 col-xs-12">   

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="intervaloConsulta">Desde - Hasta<span class="required">*</span></label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="control-group">
                            <div class="controls">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" style="width: 200px" name="intervaloConsulta" id="intervaloConsulta" required="required" 
                                           class="form-control" value="" placeholder="yyyy-mm-dd - yyyy-mm-dd" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Movimiento por<span class="required">*</span>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn btn-danger" data-toggle-passive-class="btn-warning">
                                <input type="radio" name="mostrar" value="clientes" required="" /> &nbsp; Clientes &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn btn-danger" data-toggle-passive-class="btn-warning">
                                <input type="radio" name="mostrar" value="equipos" required="" /> &nbsp; Equipos &nbsp;
                            </label>              
                            <label class="btn btn-danger" data-toggle-class="btn btn-success" data-toggle-passive-class="btn-warning"
                                   onclick="alert('Está operación se puede demorar demasiado.\n\rSe recomiendo que el intervalo de tiempo no supere los 5 días.')" >
                                <input type="radio" name="mostrar" value="referencias" required="" /> &nbsp; Clientes y sus Referencias &nbsp;
                            </label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
                        <button type="reset" class="btn btn-primary btn-app ">
                            <i class="fa fa-backward"></i>Limpiar
                        </button>
                        <button type="submit" class="btn btn-success btn-app ">
                            <i class="fa fa-file-pdf-o"></i>Generar
                        </button>
                        <button id="exportar-excel" type="button" class="btn btn-success btn-app ">
                            <i class="fa fa-file-excel-o"></i>Exportar
                        </button>
                    </div>
                </div> 
            </div>
        </form>
    </div>
</div>

<div class="x_panel">
    <div class="x_title">
        <h2>Visor <small>de Reportes</small></h2>
        <div class="clearfix"></div>
    </div>
    <div id="resultado_consulta" class="x_content"><iframe src="" style="width: 100%;height: 490px;" ></iframe></div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#intervaloConsulta').daterangepicker({
            format: 'YYYY/MM/DD'
        }, function (start, end, label) {
        });
        $(".select2").select2({}).change(function () {
        });
        $("#exportar-excel").click(function () {
            ejecutarAccion('consultas', 'movimientos', 'exportarRegistros', $("#form-generarreporte").serialize(), function (dataRespuesta) {
                window.open(dataRespuesta, '_blank');
            });
        });

        $("#form-generarreporte").submit(function () {
            ejecutarAccion('consultas', 'movimientos', 'generarReporte', $(this).serialize(), function (dataHtml) {
                $("#resultado_consulta iframe").attr('src', dataHtml);
//        $("#resultado_consulta").html( dataHtml);
            });
        });
    });
</script>
