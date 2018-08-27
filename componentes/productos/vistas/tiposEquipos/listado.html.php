
<div class="row">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_content">
        <div class=" col-md-5">
          <h2>Tipos de Equipos o productos</h2>
          <div>Son las categorias en las que estan organizados los productos o equipos que son parte de los servicios.</div>
        </div>
        <div class="  col-md-7">
          <a class="btn btn-app green" onclick="nuevo_tipo_equipo();">
            <i class="fa fa-plus"></i> Nuevo
          </a>
          <a class="btn btn-app warning" onclick="editar_tipo_equipo();" >
            <i class="fa fa-edit"></i> Editar
          </a>
          <a class="btn btn-app danger" onclick="eliminar_tipo_equipo();">
            <i class="fa fa-trash"></i> Eliminar
          </a>
        </div>
      </div>
    </div>
    <div class="x_panel">     
      <div class="x_content">
        <table id="tbl_tiposequipos" class="table table-striped responsive-utilities jambo_table table-seleccionable">
          <thead>
            <tr class="headings">
              <th style="width: 5%" ></th>
              <th style="width: 10%">Codigo </th>
              <th style="width: 25%">Titulo</th>
              <th style="width: 40%">Descripción</th>
            </tr>
          </thead>
          <tbody>
			<?php if(count($TiposEquipos)) foreach ($TiposEquipos as $indice => $objTipo): ?>
  			<tr data-id="<?php echo $objTipo->tipoEquipoId ?>" class="even pointer">
  			  <td><?php echo $indice + 1 ?></td>
  			  <td class=" "><?php echo $objTipo->tipoEquipoCodigo ?></td>
  			  <td class=" "><?php echo $objTipo->tipoEquipoTitulo ?></td>
  			  <td class=" "><?php echo $objTipo->tipoEquipoDesc ?></td>
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
    oTable = $('#tbl_tiposequipos').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
    $("#tbl_tiposequipos tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_tiposequipos tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_tiposequipos tbody tr").dblclick(function () {
      $(this).click();
      editar_tipo_equipo();
    });

  });

  function nuevo_tipo_equipo() {
    mostrar_contenidos(
            'productos',
            'tiposEquipos',
            'nuevo'
            );
  }

  function editar_tipo_equipo() {
    idTipoEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idTipoEquipo)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
              'productos',
              'tiposEquipos',
              'editar',
              'registro-tipoequipo=' + idTipoEquipo
              );
    }
  }

  function eliminar_tipo_equipo() {
    idTipoEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idTipoEquipo)) {
      alerta('Debes seleccionar un registro para eliminar.');
    } else {
      confirmar('¿Segur@ que deseas borrar este TIPO DE EQUIPO?',
              function (resp) {
                mostrar_contenidos(
                        'productos',
                        'tiposEquipos',
                        'borrar',
                        'registro-tipoequipo=' + idTipoEquipo
                        );
              }
      );
    }
  }
</script>