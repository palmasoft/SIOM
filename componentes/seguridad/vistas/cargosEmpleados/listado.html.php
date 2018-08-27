
<div class="row">

  <div class="x_panel">
    <div class="x_content">
      <div class=" col-md-4">
        <h2>Cargo de los Empleados / Usuarios</h2>
        <div>Listado o Directorio de Cargos de las personas registradas como usuarios.</div>
      </div>
      <div class="  col-md-8 text-right" >
        <a class="btn btn-app green" onclick="nuevo_cargo_empleado();">
          <i class="fa fa-plus"></i> Nuevo
        </a>
        <a class="btn btn-app warning" onclick="editar_cargo_empleado();" >
          <i class="fa fa-edit"></i> Editar
        </a>
        <a class="btn btn-app danger" onclick="eliminar_cargo_empleado();">
          <i class="fa fa-trash"></i> Eliminar
        </a>        
      </div>
    </div>
  </div>

  <!--//LA TABLA-->
  <div class="x_panel">     
    <div class="x_content">
      <table id="tbl_cargo_empleados" class="table table-striped responsive-utilities jambo_table table-seleccionable">
        <thead>
          <tr class="headings">
            <th style="" ></th>
            <th style="" >Codigo</th>
            <th style="" >Titulo</th>            
          </tr>
        </thead>
        <tbody>
          <?php if(count($CargosEmpleados)) foreach($CargosEmpleados as $indice => $objCargoEmpleado): ?>
              <tr data-id="<?php echo $objCargoEmpleado->cargoEmpleadoId ?>" class="even pointer">
                <td><?php echo $indice + 1 ?></td>
                <td class="text-center"><span class="label label-info"><?php echo $objCargoEmpleado->cargoEmpleadoCodigo ?></span></td>
                <td class=" "><?php echo $objCargoEmpleado->cargoEmpleadoTitulo ?></td>	  
              </tr>  
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script type="text/javascript" >
  var oTable;
  var idCargoEmpleado = null;
  var asInitVals = new Array();
  $(document).ready(function () {
    $("#tbl_cargo_empleados tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_cargo_empleados tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_cargo_empleados tbody tr").dblclick(function () {
      $(this).click();
      editar_cargo_empleado();
    });

    oTable = $('#tbl_cargo_empleados').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
  });

  function nuevo_cargo_empleado() {
    mostrar_contenidos(
      'seguridad',
      'cargosEmpleados',
      'nuevo'
      );
  }

  function editar_cargo_empleado() {
    idCargoEmpleado = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idCargoEmpleado)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
        'seguridad',
        'cargosEmpleados',
        'editar',
        'registro-cargoempleado=' + idCargoEmpleado
        );
    }
  }

  function eliminar_cargo_empleado() {
    idCargoEmpleado = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idCargoEmpleado)) {
      alerta('<h4>Debes seleccionar un registro para eliminar.<h4>');
    } else {
      confirmar('<h4>¿Segur@ que deseas borrar este <strong>CARGO DE EMPLEADO</strong>?</h4><br />Los datos del cargo_empleado seguiran en el directorio, pero ya no podras usarlo como cargo_empleado.',
        function (resp) {
          mostrar_contenidos(
            'seguridad',
            'cargosEmpleados',
            'borrar',
            'registro-cargoempleado=' + idCargoEmpleado
            );
        }
      );
    }
  }


</script>