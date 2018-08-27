
<div class="row">

  <div class="x_panel">
    <div class="x_content">
      <div class=" col-md-4">
        <h2>Equipos o productos</h2>
        <div>Listado o Catalogo de los productos o equipos que son parte de los servicios.</div>
      </div>
      <div class="  col-md-8 text-right">
        <a class="btn btn-app green" onclick="nuevo_equipo();">
          <i class="fa fa-plus"></i> Nuevo
        </a>
        <a class="btn btn-app warning" onclick="editar_equipo();" >
          <i class="fa fa-edit"></i> Editar
        </a>
        <a class="btn btn-app danger" onclick="eliminar_equipo();">
          <i class="fa fa-trash"></i> Eliminar
        </a>
        <a class="btn btn-app danger" onclick="ver_ultima_ubicacion_equipo();">
          <i class="fa fa-map-marker"></i> Ubicar
        </a>
        <a class="btn btn-app danger" onclick="ver_codigos_equipo();">
          <i class="fa fa-qrcode"></i> Ver Codigo
        </a>
        <a class="btn btn-app danger" onclick="generar_pdf_catalogo();">
          <i class="fa fa-print " style="display: inline-block;" ></i>
          <i class="fa fa-qrcode"  style="display: inline-block;"></i> <br />Catálogo
        </a>
        <a class="btn btn-app danger" onclick="cambiar_disponibilidad_equipo();">
          <i class="fa fa-refresh"></i> Disponibilidad
        </a>
      </div>
    </div>
  </div>


  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Ultima Ubicación <small>registrada</small></h2>
        <div class="clearfix"></div>
      </div>
      <div id="ultimaubicacionmapa" class="x_content">
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Codigos del Equipo <small>Barras y QR</small></h2>
        <span class="right" ><a href="javascript:void(0);" onclick="imprimir_codigos();" ><i class="fa fa-print" ></i></a></span>
        <div class="clearfix"></div>
      </div>
      <div id="codigosequipo" class="x_content text-center">
      </div>
    </div>
  </div>


  <div class="x_panel">     
    <div class="x_content">

      <table id="tbl_equipos" class="table table-striped responsive-utilities jambo_table table-seleccionable">
        <thead>
          <tr class="headings">
            <th style="width: 5%" ></th>
            <th style="width: 15%">Tipo </th>
            <th style="width: 20%">Titulo </th>
            <th style="width: 20%">Codigo</th>
            <th style="width: 25%">Serial</th>
            <th style="width: 10%">Cap.</th>
            <th style=""></th>
          </tr>
        </thead>
        <tbody>
          <?php if(count($Equipos)) foreach($Equipos as $indice => $objEquipo): ?>
              <tr data-id="<?php echo $objEquipo->equipoId ?>"  data-estado="<?php echo $objEquipo->equipoEstadoId ?>" class="even pointer">
                <td><?php echo $indice + 1 ?></td>
                <td class=" "><?php echo $objEquipo->tipoEquipoCodigo ?></td>
                <td class=" "><?php echo $objEquipo->equipoTitulo ?></td>
                <td class=" "><?php echo $objEquipo->equipoCodigo ?></td>
                <td class=" "><?php echo $objEquipo->equipoSerial ?></td>
                <td class=" "><?php echo $objEquipo->equipoCapacidad ?></td>
                <td class=" "><?php echo $objEquipo->equipoEstadoTitulo ?></td>
              </tr>  
            <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>


</div>

<script type="text/javascript" >
  var oTable;
  var idEquipo = null;
  var stdEquipo = 0;
  var asInitVals = new Array();
  $(document).ready(function () {
    $("#tbl_equipos tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_equipos tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_equipos tbody tr").dblclick(function () {
      $(this).click();
      editar_equipo();
    });
    oTable = $('#tbl_equipos').dataTable({
        "scrollY":        "360px",
        "scrollCollapse": true,
        "paging":         false
    });
  });

//
  function ver_ultima_ubicacion_equipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para ver su ULTIMA UBICACION.');
    } else {
//      $("#modal-ultimaubicacion").modal('toggle');
      ejecutarAccion(
        'productos',
        'equipos',
        'ultimaUbicacion',
        'registro-equipo=' + idEquipo,
        function (resp) {
          //alert(resp);
          $("#ultimaubicacionmapa").html(resp);
          $("#ultimaubicacion").show();
          $("#mapa-equipo").css('width', '100%');
          $("#mapa-equipo").css('height', '290px');
        }
      );
    }
  }


  function ver_codigos_equipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para ver sus CODIGOS GRAFICOS.');
    } else {
//      $("#modal-ultimaubicacion").modal('toggle');
      ejecutarAccion(
        'productos',
        'equipos',
        'codigosDelEquipo',
        'registro-equipo=' + idEquipo,
        function (resp) {
          //alert(resp);
          $("#codigosequipo").html(resp);
        }
      );
    }
  }

  function nuevo_equipo() {
    mostrar_contenidos(
      'productos',
      'equipos',
      'nuevo'
      );
  }

  function editar_equipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
        'productos',
        'equipos',
        'editar',
        'registro-equipo=' + idEquipo
        );
    }
  }

  function eliminar_equipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para eliminar.');
    } else {
      confirmar('¿Segur@ que deseas borrar este EQUIPO?',
        function (resp) {
          mostrar_contenidos(
            'productos',
            'equipos',
            'borrar',
            'registro-equipo=' + idEquipo
            );
        }
      );
    }
  }


  function cambiar_disponibilidad_equipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para <strong>CAMBIAR LA DISPONIBILIDAD</strong>.');
    } else {
      stdEquipo = filaSeleccionada(oTable, 'data-estado');
      if (stdEquipo != 2) {
        confirmar('<h4>¿Segur@ que deseas CAMBIAR LA DISPONIBILIDAD este EQUIPO? <smal>Si esta FUERA DE SERVICIO cambiará a estado DISPONIBLE y viceversa</smal></h4>',
          function (resp) {
            mostrar_contenidos(
              'productos',
              'equipos',
              'cambiarDisponibilidad',
              'registro-equipo=' + idEquipo + '&estado-equipo=' + stdEquipo
              );
          }
        );
      } else {
        alerta('<h4>Este equipo esta <strong>EN SERVICIO</strong> y no se puede cambiar su disponibilidad desde aquí.</h4> Para cambiar el estado, debes generar un recibo de servicio, donde se recoja el equipo, y alli seleccionar el nuevo estado del equipo.');
      }
    }
  }



  function imprimir_codigos() {
    imprimir_area_html('Imprimir Codigos de Equipo', 'codigosequipo');
  }

  function generar_pdf_catalogo() {

    ejecutarAccion(
      'productos',
      'equipos',
      'catalogo',
      '',
      function (resp) {
//        alert(resp);
        abrir_soportes(resp)
      }
    );


  }



</script>