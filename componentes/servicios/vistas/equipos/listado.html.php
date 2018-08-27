
<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="x_panel">
      <div class="x_content">
        <div class=" col-md-4">
          <h2>Servicios de Equipos</h2>
          <div>Listado de Servicios y Recibos de Equipos Arrendados o Alquilados.</div>
        </div>
        <div class="  col-md-8 text-right" >
          <a class="btn btn-app green" onclick="nuevo_reciboServicioEquipo();">
            <i class="fa fa-plus"></i> Nuevo
          </a>
          <a class="btn btn-app warning" onclick="editar_reciboServicioEquipo();" >
            <i class="fa fa-edit"></i> Editar
          </a>
          <a class="btn btn-app danger" onclick="eliminar_reciboServicioEquipo();">
            <i class="fa fa-trash"></i> Anular
          </a>
          <a class="btn btn-app danger" onclick="ver_ubicacion_servicio();">
            <i class="fa fa-map-marker"></i> Ubicar
          </a>
          <a class="btn btn-app danger" onclick="ver_datos_del_reciboServicioEquipo();">            
            <i class="fa fa-user" ></i> Ver Cliente
          </a>
          <a class="btn btn-app danger" onclick="generar_pdf_directorio();">
            <i class="fa fa-print "></i> Ver Recibo
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Ubicación <small>del servicio</small></h2>
        <div class="clearfix"></div>
      </div>
      <div id="div-ubicacionreciboServicioEquipo" class="x_content text-center">
        <em>seleccion un servicio y luego clic en boton <strong>UBICAR</strong></em>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Datos Registrados <small> del ReciboServicioEquipo</small></h2>  
        <div class="clearfix"></div>            
      </div>
      <div id="div-refenciasreciboServicioEquipo" class="x_content text-center">
        <em>seleccion un reciboServicioEquipo y luego clic en boton <strong>VER CLIENTE</strong></em>
      </div>
    </div>
  </div>
  <!--//LA TABLA-->
  <div class="col-xs-12 col-sm-12 col-md-12">
    <div class="x_panel">     
      <div class="x_content">
        <table id="tbl_servicios" class="table table-striped responsive-utilities jambo_table table-seleccionable">
          <thead>
            <tr class="headings text-center">
              <th class="text-center" colspan="5" >Servicio</th>
              <th class="text-center" colspan="2"  >Cliente</th>
              <th class="text-center" ></th>
              <th class="text-center" colspan="2"  >Equipos</th>
              <th  class="text-center" colspan="2"  >Deposito</th>
            </tr>
            <tr class="headings text-center">
              <th style="width: 5%" class="text-center" >Fecha</th>
              <th style="width: 5%" class="text-center" >Recogida</th>
              <th style="width: 5%" class="text-center" >Estado</th>
              <th style="width: 5%" class="text-center" >Codigo</th>
              <th style="width: 5%" class="text-center" >#Recibo</th>
              <th style="width: 30%" class="text-center" >Nombre</th>
              <th style="width: 20%" class="text-center" title="Referencia" >Ref</th>
              <th style="width: 26%" class="text-center" >Direccion</th>
              <th style="width: 2%" class="text-center" title="Entregados" ><i class="fa fa-arrow-circle-o-down" ></i></th>
              <th style="width: 2%" class="text-center" title="Recibidos" ><i class="fa fa-arrow-circle-o-up" ></i></th>
              <th style="width: 5%" class="text-center" ><i class="fa fa-money" ></i></th>
              <th style="width: 5%" class="text-center" ><i class="fa fa-user" ></i></th>
            </tr>
          </thead>
          <tbody>
            <?php
            if(count($RecibosServiciosEquipos))
                foreach($RecibosServiciosEquipos as $indice => $objReciboServicioEquipo):
                ?>
                <tr data-id="<?php echo $objReciboServicioEquipo->servicioId ?>" class="even pointer">
                  <td class=" "><?php echo $objReciboServicioEquipo->reciboFechaServicio ?></td>     
                  <td class=" "><?php echo $objReciboServicioEquipo->reciboFechaRecogida ?></td>                  
                  <td class=" "><?php echo $objReciboServicioEquipo->servicioEstado ?></td>             
                  <td class=" "><?php echo $objReciboServicioEquipo->servicioCodigo ?></td>
                  <td><?php echo $objReciboServicioEquipo->reciboNumero ?></td>
                  <td class="text-center">
                    <span class="label label-default" style="font-size: 100%;"><?php echo $objReciboServicioEquipo->clienteCodigo ?></span>
                    <br /><?php echo $objReciboServicioEquipo->personaRazonSocial ?>
                    <br /><?php echo $objReciboServicioEquipo->personaIdentificacion ?>
                  </td>
                  <td class="text-center">
                    <?php echo $objReciboServicioEquipo->nombresReferencia ?> <?php echo $objReciboServicioEquipo->apellidosReferencia ?>
                    <br /><strong><?php echo $objReciboServicioEquipo->idReferencia ?></strong>
                  </td>
                  <td class=" "><?php echo $objReciboServicioEquipo->reciboDireccion ?></td>
                  <td class=" "><?php echo $objReciboServicioEquipo->equiposEntregados ?></td>
                  <td class=" "><?php echo $objReciboServicioEquipo->equiposRecibos ?></td>  
                  <td class=" "><?php
                echo number_format($objReciboServicioEquipo->totalDeposito, 0, ',', '.')
                    ?></td>			  
                  <td class=" "><?php echo $objReciboServicioEquipo->usuarioNombre ?></td>
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
  var idReciboServicioEquipo = null;
  var asInitVals = new Array();
  $(document).ready(function () {
    $("#tbl_servicios tbody tr").click(function (e) {
      if ($(this).hasClass('fila_seleccionada')) {
        $(this).removeClass('fila_seleccionada');
      } else {
        $("#tbl_servicios tbody tr").removeClass('fila_seleccionada');
        $(this).addClass('fila_seleccionada');
      }
    });
    $("#tbl_servicios tbody tr").dblclick(function () {
      $(this).click();
      editar_reciboServicioEquipo();
    });

    oTable = $('#tbl_servicios').dataTable({
      "scrollY": "360px",
      "scrollCollapse": true,
      "paging": false,
      "aaSorting": [[0, "desc"]]
    });

  });

  function nuevo_reciboServicioEquipo() {
    mostrar_contenidos(
      'servicios',
      'equipos',
      'nuevo'
      );
  }

  function editar_reciboServicioEquipo() {
    idReciboServicioEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idReciboServicioEquipo)) {
      alerta('Debes seleccionar un registro para editar.');
    } else {
      mostrar_contenidos(
        'servicios',
        'equipos',
        'editar',
        'registro-servicio=' + idReciboServicioEquipo
        );
    }
  }

  function eliminar_reciboServicioEquipo() {
    idReciboServicioEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idReciboServicioEquipo)) {
      alerta('<h4>Debes seleccionar un registro para eliminar.<h4>');
    } else {
      confirmar('<h4>¿Segur@ que deseas borrar este <strong>CLIENTE</strong>?</h4><br /> Los datos del reciboServicioEquipo seguiran en el directorio, pero ya no podras usarlo como reciboServicioEquipo.',
        function (resp) {
          mostrar_contenidos(
            'personas',
            'servicios',
            'borrar',
            'registro-reciboServicioEquipo=' + idReciboServicioEquipo
            );
        }
      );
    }
  }





  function ver_ubicacion_reciboServicioEquipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un reciboServicioEquipo para ver la UBICACION registrada.');
    } else {
      ejecutarAccion(
        'personas',
        'servicios',
        'mapaReciboServicioEquipo',
        'registro-reciboServicioEquipo=' + idEquipo,
        function (resp) {
          //alert(resp);
          $("#div-ubicacionreciboServicioEquipo").html(resp);
          $("#mapa-equipo").css('width', '100%');
          $("#mapa-equipo").css('height', '290px');
        }
      );
    }
  }


  function ver_referencias_reciboServicioEquipo() {
    idEquipo = filaSeleccionada(oTable, 'data-id');
    if (estaVacio(idEquipo)) {
      alerta('Debes seleccionar un registro para ver sus CONTACTOS o REFERENCIAS registradas.');
    } else {
      $("#modal-ultimaubicacion").modal('toggle');
      ejecutarAccion(
        'personas',
        'referencias',
        'todosDelReciboServicioEquipo',
        'registro-reciboServicioEquipo=' + idEquipo,
        function (resp) {
          //alert(resp);
          $("#div-refenciasreciboServicioEquipo").html(resp);
        }
      );
    }
  }
</script>