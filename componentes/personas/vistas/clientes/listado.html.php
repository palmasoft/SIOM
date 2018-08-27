
<div class="row">

  <div class="x_panel">
    <div class="x_content">
      <div class=" col-md-4">
        <h2>Clientes</h2>
        <div>Listado o Directorio de Clientes, personas y empresas, a los que se les presta un servicio.</div>
      </div>
      <div class="  col-md-8 text-right" >
        <a class="btn btn-app green" onclick="nuevo_cliente();">
          <i class="fa fa-plus"></i> Nuevo
        </a>
        <a class="btn btn-app warning" onclick="editar_cliente();" >
          <i class="fa fa-edit"></i> Editar
        </a>
        <a class="btn btn-app danger" onclick="eliminar_cliente();">
          <i class="fa fa-trash"></i> Eliminar
        </a>
        <a class="btn btn-app danger" onclick="ver_ubicacion_cliente();">
          <i class="fa fa-map-marker"></i> Ubicar
        </a>
        <a class="btn btn-app danger" onclick="ver_referencias_cliente();">            
          <i class="fa fa-users"  style="display: inline-block;"></i> <br />Referencias
        </a>
        <a class="btn btn-app danger" onclick="generar_pdf_directorio();">
          <i class="fa fa-print " style="display: inline-block;" ></i>
          <i class="fa fa-book"  style="display: inline-block;"></i> <br />Directorio
        </a>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Ubicación <small>registrada</small></h2>
        <div class="clearfix"></div>
      </div>
      <div id="div-ubicacioncliente" class="x_content text-center">
        <em>seleccion un cliente y luego clic en boton <strong>UBICAR</strong></em>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Personas Autorizadas <small> de Referencia</small></h2>  
        <div class="clearfix"></div>            
      </div>
      <div id="div-refenciascliente" class="x_content text-center">
        <em>seleccion un cliente y luego clic en boton <strong>REFERENCIAS</strong></em>
      </div>
    </div>
  </div>
  <!--//LA TABLA-->
  <div class="x_panel">     
    <div class="x_content">
      <table id="tbl_clientes" class="table table-striped responsive-utilities jambo_table table-seleccionable">
        <thead>
          <tr class="headings">
            <th style="width: 1%" ></th>
            <th style="width: 1%" >Codigo</th>
            <th style="width: 5%">Cliente </th>
            <th style="width: 10%">Identificacion</th>
            <th style="width: 30%">Nombre</th>
            <th style="width: 20%">Correo</th>
            <th style="width: 10%">Movil</th>
            <th style="width: 20%">Direccion</th>
          </tr>
        </thead>
        <tbody>
          <?php if (count($Clientes)) foreach ($Clientes as $indice => $objCliente): ?>
              <tr data-id="<?php echo $objCliente->clienteId ?>" class="even pointer">
                <td><?php echo $indice + 1 ?></td>
                <td class="text-center"><span class="label label-info"><?php echo $objCliente->clienteCodigo ?></span></td>
                <td class=" "><?php echo $objCliente->tipoClienteTitulo ?></td>
                <td class=" "><?php echo $objCliente->tipoIdentificacionCodigo ?> <?php echo $objCliente->personaIdentificacion ?></td>
                <td class=" "><?php echo $objCliente->personaRazonSocial ?></td>
                <td class=" "><?php echo $objCliente->personaCorreoElectronico ?></td>
                <td class=" "><?php echo $objCliente->personaCelular ?></td>  
                <td class=" "><?php echo $objCliente->personaDireccion ?></td>			  
              </tr>  
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</div>

<script type="text/javascript" >
  var oTable;
  var idCliente = null;
  var asInitVals = new Array();
  $(document).ready(function () {
    $("#tbl_clientes tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_clientes tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_clientes tbody tr").dblclick(function () {
      $(this).click();
      editar_cliente();
    });

    oTable = $('#tbl_clientes').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
  });

  function nuevo_cliente() {
    mostrar_contenidos(
      'personas',
      'clientes',
      'nuevo'
      );
  }

  function editar_cliente() {
    idCliente = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idCliente)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
        'personas',
        'clientes',
        'editar',
        'registro-cliente=' + idCliente
        );
    }
  }

  function eliminar_cliente() {
    idCliente = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idCliente)) {
      alerta('<h4>Debes seleccionar un registro para eliminar.<h4>');
    } else {
      confirmar('<h4>¿Segur@ que deseas borrar este <strong>CLIENTE</strong>?</h4><br /> Los datos del cliente seguiran en el directorio, pero ya no podras usarlo como cliente.',
        function (resp) {
          mostrar_contenidos(
            'personas',
            'clientes',
            'borrar',
            'registro-cliente=' + idCliente
            );
        }
      );
    }
  }





  function ver_ubicacion_cliente() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un cliente para ver la UBICACION registrada.');
    } else {      
      ejecutarAccion(
        'personas',
        'clientes',
        'mapaCliente',
        'registro-cliente=' + idEquipo,
        function (resp) {
          //alert(resp);
          $("#div-ubicacioncliente").html(resp);          
          $("#mapa-equipo").css('width', '100%');
          $("#mapa-equipo").css('height', '290px');
        }
      );
    }
  }


  function ver_referencias_cliente() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para ver sus CONTACTOS o REFERENCIAS registradas.');
    } else {
      $("#modal-ultimaubicacion").modal('toggle');
      ejecutarAccion(
        'personas',
        'referencias',
        'todosDelCliente',
        'registro-cliente=' + idEquipo,
        function (resp) {
          //alert(resp);
          $("#div-refenciascliente").html(resp);
        }
      );
    }
  }
</script>