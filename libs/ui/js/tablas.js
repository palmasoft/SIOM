var tabla = null;



function agregar_fila(oTableLocal, datos) {
  oTableLocal.fnAddData(datos);
}

function eliminarFilas(oTableLocal) {
  var aTrs = oTableLocal.fnGetNodes();
  for (var i = 0; i < aTrs.length; i++)
  {
    if ($(aTrs[i]).hasClass('row_selected'))
    {
      oTableLocal.fnDeleteRow(aTrs[i]);
    }
  }
  return true;
}

function cantidad_filas(oTable) {
  var nFilas = 0;
  $('#' + oTable + ' tbody tr').each(function () {
    nFilas++;
  });

  return nFilas;
}

function fnShowHide(iCol)
{
  var bVis = tabla.fnSettings().aoColumns[iCol].bVisible;
  tabla.fnSetColumnVis(iCol, bVis ? false : true);
}

function filaId(oTableLocal)
{
  return oTableLocal.$('tr.row_selected').attr('fila-id');
  /*
   var aTrs = oTableLocal.fnGetNodes();
   var aReturn = new Array();
   for ( var i=0 ; i<aTrs.length ; i++ )
   {
   if ( $(aTrs[i]).hasClass('row_selected') )
   {
   aReturn.push( $(aTrs[i]).attr('fila-id') );
   }
   }
   return aReturn;
   */
}

function filaSeleccionada(oTableLocal, atributo) {
  if (!estaVacio(oTableLocal.$('tr.fila_seleccionada').attr(atributo))) {
    return oTableLocal.$('tr.fila_seleccionada').attr(atributo);
  }
  return false;

}


function iniciar_tablas() {
  $(".table-seleccionable tbody tr").click(function (e) {
    if ($(this).hasClass('fila_seleccionada')) {
      $(this).removeClass('fila_seleccionada');
    } else {
      $(".table-seleccionable tbody tr").removeClass('fila_seleccionada');
      $(this).addClass('fila_seleccionada');
    }
  });
}