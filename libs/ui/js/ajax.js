var _puede_salir_formulario = true;
var _arreglo_temporizadores = {
  recarga_estadisticas: null, contador_recarga: null
};

function inciar_plugins_sistema() {
  $("form").submit(function (evt) {
    evt.preventDefault();
  });

  $('.mayusculas').on("keyup", function (event) {    
      $(this)[0].value = convertirAMayusculas($(this)[0].value);
  });
  
}

function mostrar_contenidos(modulo, controlador, accion, datos) {
  if (!_puede_salir_formulario) {
    confirm(
      '<strong>¿Seguro que desea salir sin guardar los datos del formulario?</strong> ' +
      'Recuerde que para guardar debe hacer clic en el Boton <a class="btn btn-success" ><i class="icon-save" ></i> Guardar </a>.',
      function (RESPUESTA) {
        ejecutarAccionMuestraAreaTrabajo(modulo, controlador, accion, datos);
      }
    );
  } else {
    ejecutarAccionMuestraAreaTrabajo(modulo, controlador, accion, datos);
  }
}
function ejecutarAccionMuestraAreaTrabajo(modulo, controlador, accion, datos) {
  _puede_salir_formulario = true;
  _arreglo_temporizadores = new Object();
  _arreglo_temporizadores = {
    recarga_estadisticas: null,
    contador_recarga: null
  };
  bloqueoCargando();
  ajax("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
    function (respHTML) {
      actualizar_area_contenido(respHTML);
      ir_arriba();
      desbloqueoCargando();
      inciar_plugins_sistema();
//            inciar_plugins_plantilla();
    }

  );
}

function ejecutarAccion(modulo, controlador, accion, datos, script) {
  bloqueoCargando();
  ajax("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos, script);
}
function ejecutarAccionSinBloqueo(modulo, controlador, accion, datos, script) {
  ajax("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
    script
    );
}
function ejecutarAccionJson(modulo, controlador, accion, datos, script) {
  //bloqueoCargando();
  json("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
    script
    );
}
function ejecutarAccionJsonSinBloqueo(modulo, controlador, accion, datos, script) {
  json("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
    script
    );
}
function ejecutarAccionArchivos(modulo, controlador, accion, datos, script) {
  bloqueoCargando();
  datos.append('componente', modulo);
  datos.append('controlador', controlador);
  datos.append('accion', accion);
  ajaxArchivos(
    datos,
    script
    );
}
function ejecutarAccionEsperar(modulo, controlador, accion, datos, script) {
  bloqueoCargando();
  return  ajaxEsperar("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
    script
    );
}
function ejecutarAccionJsonArchivos(modulo, controlador, accion, datos, script) {
  bloqueoCargando();
  datos.append('componente', modulo);
  datos.append('accion', accion);
  datos.append('controlador', controlador);
  jsonArchivos(
    datos, "desbloqueoCargando();  " + script
    );
}
function ejecutarAccionJsonEsperar(modulo, controlador, accion, datos, script) {
  bloqueoCargando();
  return jsonEsperar("&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos, "desbloqueoCargando();  " + script
    );
}


var objAjaxPost;
function ajax(datos, script) {
  //alert(datos);
  var posting = $.post('controlador.php', datos);
  posting.done(function (data) {
    script(data);
//    asignarControlAccion();
    inciar_plugins_sistema();
//    inciar_plugins_plantilla();
    //ir_arriba();
  });
  posting.fail(function () {
    //alert("ATENCIÓN: Parece que no se puede realizar en la transmision de los datos. \r\nSi el problema persiste, por favor contacte al administrador del sistema.");
    desbloqueoCargando();
  });
  posting.always(function (data) {
//alert('Termino la ejecucion:' + data);     
    desbloqueoCargando();
  });
  objAjaxPost = posting;
}
function ajaxArchivos(datos, script) {
  var posting = $.ajax({
    url: 'controlador.php', //Url a donde la enviaremos
    type: 'POST', //Metodo que usaremos
    //dataType:"html",
    contentType: false, //Debe estar en false para que pase el objeto sin procesar
    data: datos, //Le pasamos el objeto que creamos con los archivos
    processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
    cache: false //Para que el formulario no guarde cache
  }).done(function (data) {
    script(data);
    desbloqueoCargando();
//ir_arriba();
  });
  objAjaxPost = posting;
}
function ajaxEsperar(datos, script) {
  var posting = $.ajax({
    async: true,
    cache: false,
    dataType: "html",
    type: 'POST',
    url: "controlador.php",
    data: datos,
    success: function (respuesta) {
      script(respuesta);
      desbloqueoCargando();
      return respuesta;
    },
    beforeSend: function () {
    },
    error: function (objXMLHttpRequest) {
      //            alert("ATENCIÓN: Ha ocurrido un error en la operacion. <strong>Verifique que su conexion a internet este activa</strong> e intente nuevamente realizar la operacion.  \r\nSi el problema persiste, por favor contacte al administrador del sistema.");
      desbloqueoCargando();
    }
  });
  objAjaxPost = posting;
}
function abortar_ajax() {
  objAjaxPost.abort();
}
function validar_resultado_html(htmlMsg, funcExito, funcError) {

  var resp = htmlMsg.split("@pis_");
  //if (!$.isEmptyObject(resp)) {
  switch (resp[0]) {
    case 'ERROR':
      error(resp[1]);
      funcError();
      break;
    case 'INFO':
      informacion(resp[1]);
      funcExito();
      break;
    case 'EXITO':
      informacion(resp[1]);
      funcExito();
      break;
    case 'ALERTA':
      alerta(resp[1]);
      funcExito();
      break;
  }
  //}
}

function json(datos, script) {
  var posting = $.post('controlador.php', datos);
  posting.done(function (data) {
    if (!estaVacio(data)) {
      data = JSON.parse(data);
    }
    script(data);
//    asignarControlAccion();
    //ir_arriba();
  });
  posting.fail(function () {
    //        alert("ATENCIÓN: <strong>Verifique que su conexion a internet este activa</strong> e intente nuevamente realizar la operacion. Parece que no se puede realizar en la transmision de los datos. \r\nSi el problema persiste, por favor contacte al administrador del sistema.");
    desbloqueoCargando();
  });
  posting.always(function (data) {
//alert('Termino la ejecucion:' + data);     
  });
  objAjaxPost = posting;
}
function jsonArchivos(datos, script) {

  var posting = $.ajax({
    url: 'controlador.php', //Url a donde la enviaremos
    type: 'POST', //Metodo que usaremos
    dataType: 'json',
    contentType: false, //Debe estar en false para que pase el objeto sin procesar
    data: datos, //Le pasamos el objeto que creamos con los archivos
    processData: false, //Debe estar en false para que JQuery no procese los datos a enviar
    cache: false //Para que el formulario no guarde cache
  }).done(function (data) {
    eval(script);

  });
  objAjaxPost = posting;
}
function jsonEsperar(datos, script) {
  var posting = $.ajax({
    async: true,
    cache: false,
    dataType: "html",
    type: 'POST',
    url: "controlador.php",
    data: datos,
    success: function (respuesta) {
      eval(script);
      return respuesta;
    },
    beforeSend: function () {
    },
    error: function (objXMLHttpRequest) {
      //            alert("ATENCIÓN: <strong>Verifique que su conexion a internet este activa</strong> e intente nuevamente realizar la operacion.  Parece que no se puede realizar en la transmision de los datos. \r\nSi el problema persiste, por favor contacte al administrador del sistema.");
      desbloqueoCargando();
    }
  });
  objAjaxPost = posting;
}
function validar_resultado_json(resp, funcExito, funcError) {
//if (!$.isEmptyObject(resp)) {
  switch (resp.resultado) {
    case 'ERROR':
      error(resp.mensaje);
      eval(funcError);
      break;
    case 'EXITO':
      informacion(resp.mensaje);
      eval(funcExito);
      break;
    case 'ALERTA':
      alert(resp.mensaje);
      eval(funcExito);
      break;
  }
//} 
}



function accionBackground(modulo, controlador, accion, datos, script) {
  var posting = $.post('controlador.php', "&componente=" + modulo + "&accion=" + accion + "&controlador=" + controlador + "&" + datos,
    function () {
    },
    "json");
  posting.done(function (data) {
    script(data);
  });
}
function esActivaSesion() {
  ejecutarAccionJsonSinBloqueo(
    'sistema', 'sesion', 'esta_activa_sesion', '',
    function (data) {
      if (estaVacio(data.respuesta)) {
        salir_sistema();
      }
    }
  );
}
function consulta_mensajes_para_usuarios() {
  accionBackground(
    'sistema', 'sesion', 'mensajes_usuario_activo', '',
    'mostrar_resultado_guardar(data);'
    );
}


var htmlMiniCargando = '<div id="miniCargando" style="<i class="fa fa-cog"></i></div>';
var tMiniCargando = 0;
var timerMiniCargando = null;
function cargando_dentro_objeto(enDonde) {
  $("#" + enDonde).prepend(htmlMiniCargando);
  $("#" + enDonde + " #miniCargando").fadeIn(1500);
  tMiniCargando = 0;
  timerMiniCargando = setInterval(function () {

    var min = (tMiniCargando / 60);
    if (min >= 1) {
      $('#tiempo-minicargando').html(min.toFixed(2) + " Minutos");
    } else {
      $('#tiempo-minicargando').html(tMiniCargando + " Segundos");
    }

    tMiniCargando++;
  }, 1000);
}
function quitar_cargando_dentro_objeto(enDonde) {
  $("#" + enDonde + " #miniCargando").fadeOut(1500);
  clearInterval(timerMiniCargando);
}


