<style>
  .resumen_consulta {
    background: rgba(255,255,255,1);
    background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(245,245,245,1) 47%, rgba(204,207,240,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(245,245,245,1)), color-stop(100%, rgba(204,207,240,1)));
    background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(245,245,245,1) 47%, rgba(204,207,240,1) 100%);
    background: -o-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(245,245,245,1) 47%, rgba(204,207,240,1) 100%);
    background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(245,245,245,1) 47%, rgba(204,207,240,1) 100%);
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(245,245,245,1) 47%, rgba(204,207,240,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#cccff0', GradientType=0 );

  }
</style>
<div class="x_panel">
  <div class="x_title">
    <h2>Panel de Busquedas <small>sobre recibos</small></h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <form id="form-buscarrecibos" data-parsley-validate class="form-horizontal form-label-left">
      <div class="col-md-6 col-sm-12 col-xs-12">   
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mostrar <span class="required">*</span>
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div id="gender" class="btn-group" data-toggle="buttons">
              <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" name="mostrar" value="recibos" required="" /> &nbsp; Recibos &nbsp;
              </label>
              <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" name="mostrar" value="equipos" required="" /> &nbsp; Equipos &nbsp;
              </label>
              <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" name="mostrar" value="clientes" required="" /> &nbsp; Clientes &nbsp;
              </label>
            </div>
          </div>
        </div>
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
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Palabras 
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="palabras_claves"  name="palabras_claves" class="form-control col-xs-12" type="text">
          </div>
        </div>
        <div class="ln_solid"></div>

      </div>
      <div class="col-md-6 col-sm-12 col-xs-12">
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Clientes<span class="required">*</span>
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="cliente-servicio" name="cliente-servicio" class="select2 " style="width: 100%" placeholder="seleccione un cliente" required="" >
              <option value="0">TODOS</option>
              <?php foreach($Clientes as $Cliente) : ?> 
                <option value="<?php echo $Cliente->clienteId ?>"  >
                  <?php echo $Cliente->tipoIdentificacionCodigo ?> <?php echo $Cliente->personaIdentificacion ?> | <?php echo $Cliente->personaRazonSocial ?> | <?php echo $Cliente->clienteCodigo ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Empleados<span class="required">*</span>
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="empleado-servicio" name="empleado-servicio" class="select2 " style="width: 100%" placeholder="seleccione un cliente" required="" >
              <option value="0">TODOS</option>
              <?php foreach($Empleados as $Empleado) : ?> 
                <option value="<?php echo $Empleado->usuarioId ?>" >
                  <?php echo $Empleado->usuarioNombre ?> || <?php echo $Empleado->tipoIdentificacionCodigo ?> <?php echo $Empleado->personaIdentificacion ?> | <?php echo $Cliente->personaNombres ?> <?php echo $Cliente->personaApellidos ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipos de Equipos<span class="required">*</span>
          </label>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <select id="tipoequipo-servicio" name="tipoequipo-servicio" class="select2 " style="width: 100%" placeholder="seleccione un cliente" required="" >
              <option value="0">TODOS</option>
              <?php foreach($TiposEquipos as $TipoEquipo) : ?> 
              <option value="<?php echo $TipoEquipo->tipoEquipoId ?>" >
                  <?php echo $TipoEquipo->tipoEquipoCodigo ?> | <?php echo $TipoEquipo->tipoEquipoTitulo ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
            <button type="reset" class="btn btn-primary btn-app ">
              <i class="fa fa-backward"></i>Limpiar
            </button>
            <button type="submit" class="btn btn-success btn-app ">
              <i class="fa fa-search"></i>Buscar
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


<style type="text/css">
  #report { border-collapse:collapse;}
  #report h4 { margin:0px; padding:0px;}
  #report img { float:right;}
  #report ul { margin:10px 0 10px 40px; padding:0px;}
  #report th { background:#7CB8E2 url(header_bkg.png) repeat-x scroll center left; color:#fff; padding:7px 15px; text-align:left;}
  #report td { background:#C7DDEE none repeat-x scroll center left; color:#000; padding:7px 15px; }
  #report tr.odd td { background:#fff url(row_bkg.png) repeat-x scroll center left; cursor:pointer; }
  #report div.arrow { background:transparent url(arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;}
  #report div.up { background-position:0px 0px;}
</style>

<div class="x_panel">
  <div class="x_title">
    <h2><small>Resultado de la Consulta</small></h2>
    <div class="clearfix"></div>
  </div>
  <div id="resultado_consulta" class="x_content">
  </div>
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
      ejecutarAccion('consultas', 'recibos', 'exportarRegistros', $("#form-buscarrecibos").serialize(), function (dataRespuesta) {
//        alert(dataRespuesta);
      });
    });

    $("#form-buscarrecibos").submit(function () {
      ejecutarAccion('consultas', 'recibos', 'buscarRegistros', $(this).serialize(), function (dataHtml) {
        $("#resultado_consulta").html(dataHtml);
      });
    });
  });
</script>
