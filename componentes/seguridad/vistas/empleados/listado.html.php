
<div class="row">

  <div class="x_panel">
    <div class="x_content">
      <div class=" col-md-4">
        <h2>Empleados / Usuarios</h2>
        <div>Listado o Directorio de personas registradas como usuarios.</div>
      </div>
      <div class="  col-md-8 text-right" >
        <a class="btn btn-app green" onclick="nuevo_empleado();">
          <i class="fa fa-plus"></i> Nuevo
        </a>
        <a class="btn btn-app warning" onclick="editar_empleado();" >
          <i class="fa fa-edit"></i> Editar
        </a>
        <a title="" class="btn btn-app danger" onclick="cambiar_estado_empleado();">
          <i class="fa fa-refresh"></i> Estado
        </a>        
      </div>
    </div>
  </div>

  <!--//LA TABLA-->
  <div class="x_panel">     
    <div class="x_content">
      <table id="tbl_empleados" class="table table-striped responsive-utilities jambo_table table-seleccionable">
        <thead>
          <tr class="headings">
            <th style=""></th>
            <th style="">Tipo de Usuario</th>          
            <th style="">Nombre de Usuario</th>  
            <th style="">Cargo</th>
            <th style="">Identificacion</th>
            <th style="">Nombre</th>
            <th style="">Correo</th>
            <th style="">Movil</th>    
            <th style="">Estado</th>           
          </tr>
        </thead>
        <tbody>
          <?php if(count($Empleados)) foreach($Empleados as $indice => $objEmpleado): ?>
              <tr data-id="<?php echo $objEmpleado->usuarioId ?>" class="even pointer">
                <td><?php echo $indice + 1 ?></td>
                <td class=" "><?php echo $objEmpleado->usuarioTipo ?></td>
                <td class="text-center"><span class="label label-info"><?php echo $objEmpleado->usuarioNombre ?></span></td>	 
                <td class=" "><?php echo $objEmpleado->cargoEmpleadoTitulo ?></td>	 
                <td class=" "><?php echo $objEmpleado->tipoIdentificacionCodigo ?> <?php echo $objEmpleado->personaIdentificacion ?></td>
                <td class=" "><?php echo $objEmpleado->personaRazonSocial ?></td>
                <td class=" "><?php echo $objEmpleado->personaCorreoElectronico ?></td>
                <td class=" "><?php echo $objEmpleado->personaCelular ?></td>  
                <td class=" "><?php echo $objEmpleado->usuarioEstado ?></td>	 
              </tr>  
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script type="text/javascript" >
  var oTable;
  var idEmpleado = null;
  var asInitVals = new Array();
  $(document).ready(function () {
    $("#tbl_empleados tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_empleados tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_empleados tbody tr").dblclick(function () {
      $(this).click();
      editar_empleado();
    });

    oTable = $('#tbl_empleados').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
  });

  function nuevo_empleado() {
    mostrar_contenidos(
      'seguridad',
      'empleados',
      'nuevo'
      );
  }

  function editar_empleado() {
    idEmpleado = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEmpleado)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
        'seguridad',
        'empleados',
        'editar',
        'registro-empleado=' + idEmpleado
        );
    }
  }

  function cambiar_estado_empleado() {
    idEmpleado = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEmpleado)) {
      alerta('<h4>Debes seleccionar un registro para cambiar su estsado.<h4>');
    } else {
      confirmar('<h4>¿Segur@ que deseas CAMBIAR EL ESTADO de este <strong>EMPLEADO</strong>?</h4>.',
        function (resp) {
          mostrar_contenidos(
            'seguridad',
            'empleados',
            'cambiarEstado',
            'registro-empleado=' + idEmpleado
            );
        }
      );
    }
  }


</script>