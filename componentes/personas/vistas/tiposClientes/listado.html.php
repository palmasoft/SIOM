
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <div class=" col-md-5">
          <h2>Tipos de Clientes</h2>
          <div>Son las clasificaciones o sectores en las que estan organizados los clientes a que se les prestán los servicios.</div>
        </div>
        <div class="  col-md-7">
          <a class="btn btn-app green" onclick="nuevo_tipo_cliente();">
            <i class="fa fa-plus"></i> Nuevo
          </a>
          <a class="btn btn-app warning" onclick="editar_tipo_cliente();" >
            <i class="fa fa-edit"></i> Editar
          </a>
          <a class="btn btn-app danger" onclick="eliminar_tipo_cliente();">
            <i class="fa fa-trash"></i> Eliminar
          </a>
        </div>
      </div>
    </div>
    <div class="x_panel">     
      <div class="x_content">
        <table id="tbl_tiposclientes" class="table table-striped responsive-utilities jambo_table table-seleccionable">
          <thead>
            <tr class="headings">
              <th style="width: 5%" ></th>
              <th style="width: 10%">Codigo </th>
              <th style="width: 25%">Titulo</th>
              <th style="width: 40%">Descripción</th>
            </tr>
          </thead>
          <tbody>
			<?php if(count($TiposClientes)) foreach ($TiposClientes as $indice => $objTipo): ?>
  			<tr data-id="<?php echo $objTipo->tipoClienteId ?>" class="even pointer">
  			  <td><?php echo $indice + 1 ?></td>
  			  <td class=" "><?php echo $objTipo->tipoClienteCodigo ?></td>
  			  <td class=" "><?php echo $objTipo->tipoClienteTitulo ?></td>
  			  <td class=" "><?php echo $objTipo->tipoClienteDefinicion ?></td>
  			</tr>  
			<?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript" >
  var oTable;
  var idTipoEquipo = null;
  var asInitVals = new Array();
  $(document).ready(function () {
    oTable = $('#tbl_tiposclientes').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
    $("#tbl_tiposclientes tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_tiposclientes tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_tiposclientes tbody tr").dblclick(function () {
      $(this).click();
      editar_tipo_cliente();
    });

  });

  function nuevo_tipo_cliente() {
    mostrar_contenidos(
            'personas',
            'tiposClientes',
            'nuevo'
            );
  }

  function editar_tipo_cliente() {
    idTipoEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idTipoEquipo)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
              'personas',
              'tiposClientes',
              'editar',
              'registro-tipocliente=' + idTipoEquipo
              );
    }
  }

  function eliminar_tipo_cliente() {
    idTipoEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idTipoEquipo)) {
      alerta('Debes seleccionar un registro para eliminar.');
    } else {
      confirmar('¿Segur@ que deseas borrar este TIPO DE CLIENTE?',
              function (resp) {
                mostrar_contenidos(
                        'personas',
                        'tiposClientes',
                        'borrar',
                        'registro-tipocliente=' + idTipoEquipo
                        );
              }
      );
    }
  }
</script>