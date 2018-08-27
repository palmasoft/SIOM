//function cerrar_sesion_usuario(){
//    
//}



function mostrar_widgets_bienvenida() {

  mostrar_contenidos("sistema", "bienvenida", "widgets");


}

function mostrar_informacion_sistema() {

  ejecutarAccionSinBloqueo(
          "sistema", "informacion", "mostrar_informacion_sistema",
          "", "informacion(data, 'Informacion Sobre el Sistema');"
          );

  return false;

}

function abrir_administrador_multimedia() {
  alerta('Abrir modal......');
}

function cargar_sistema_anuncios() {
  var resul = ejecutarAccionEsperar(
          'sistema', 'anuncios', 'mostrar_anuncios', '',
          function (resp) {
            $("body").append(resp);
          }
  );
}
function cargar_sistema_ticket() {
  var resul = ejecutarAccionEsperar(
          'soporte', 'casos', 'modal_nuevo_ticket', '',
          function (resp) {
            cargar_lista_casos_atencion();
            $("body").append(resp);
          }
  );
}
function cargar_lista_casos_atencion() {
  ejecutarAccion(
          'soporte', 'casos', 'casos_atencion_usuario', '',
          function (datos) {
//                alert(datos);
            datos = JSON.parse(datos);
            if (datos.num_casos > 0) {
              $(".span_numcasosatencion").removeClass('bounceIn');
              $(".span_numcasosatencion").addClass('bounceOut');
            }
            $("#lista_casosatencion").html("");
            for (iCaso = 0; iCaso < datos.num_casos; iCaso++) {
              var item = "";
              item += '<li class="caso_' + datos.casos[iCaso].estado_casolaboral.toLowerCase() + '" ><a href="#" onclick="ver_agregar_nuevo_comentario(' + datos.casos[iCaso].id_casolaboral + ');" >';
              item += '<h3 class="" > #' + datos.casos[iCaso].numero_casolaboral + ' | ' + datos.casos[iCaso].asunto_casolaboral + ' </h3>';
              if (estaVacio(datos.casos[iCaso].ultimo_comentario)) {
                item += '<div class="pull-left col-sm-3 ">';
                item += '<img src="' + datos.casos[iCaso].url_foto_persona + '" class="img-circle " alt="' + datos.casos[iCaso].nombre_completo_persona + '" title="' + datos.casos[iCaso].nombre_completo_persona + '" style="height: 32px;"/>';
                item += '</div>';
                item += '<strong>Sistema de Incidencias</strong>';
                item += '<div>Aun no se ha atendido este caso. Contacte al soporte para acelerar la gestion de su caso.</div>';
                item += '<div style="white-space:nowarp;"><i class="fa fa-clock-o "></i> ' + datos.casos[iCaso].fecha_crear_casolaboral + ' |  <i class="fa fa-flag-checkered  "></i>' + datos.casos[iCaso].estado_casolaboral + '</small></div>';
              } else {
                item += '<div class="pull-left col-sm-3 ">';
                item += '<img src="' + datos.casos[iCaso].usuario_atiende_avatar + '" class="img-circle " alt="' + datos.casos[iCaso].nombre_usuario + '" title="' + datos.casos[iCaso].nombre_usuario + '" style="height: 32px;"/>';
                item += '</div>';
                item += '<strong>' + datos.casos[iCaso].ultimo_comentario.nombre_completo_persona + '</strong>';
                var divN = document.createElement("div");
                divN.innerHTML = datos.casos[iCaso].ultimo_comentario.comentario_historia_casolaboral;
                var texto = divN.textContent || divN.innerText || "";
                item += '<div>' + texto + '</div>';
                item += '<div style="white-space:nowarp;"><i class="fa fa-clock-o "></i> ' + datos.casos[iCaso].ultimo_comentario.fecha_crea_historia_casolaboral + ' |  <i class="fa fa-flag-checkered  "></i>' + datos.casos[iCaso].estado_casolaboral + '</small></div>';
              }
              item += '</a></li>';
              $("#lista_casosatencion").append(item);
            }
            $(".span_numcasosatencion").html(datos.num_casos);
            if (datos.num_casos > 0) {
              $(".span_numcasosatencion").removeClass('bounceOut');
              setTimeout(function () {
                $(".span_numcasosatencion").addClass('bounceIn');
              }, 300);
            }
          }
  );
}
function ver_todos_mis_casos_solicitados() {
  mostrar_contenidos(
          'soporte', 'casos', 'todos_casos_solicitados_usuario', ''
          );
}

function cargar_lista_notificaciones() {
  ejecutarAccion(
          'sistema', 'notificaciones', 'listado_por_usuario', '',
          function (datos) {
//                alert(datos);
            datos = JSON.parse(datos);
            if (datos.num_notificaciones > 0) {
              $(".span_numnotificaciones").removeClass('bounceIn');
              $(".span_numnotificaciones").addClass('bounceOut');
            }
            $("#lista_notificaciones").html("");
            for (iNotificacion = 0; iNotificacion < datos.num_notificaciones; iNotificacion++) {
              var icono = '';
              var accion = '';
              switch (datos.notificaciones[iNotificacion].tipo) {
                case "CASOS_SOPORTE":
                  icono = 'fa fa-warning text-yellow';
                  accion = ' ver_listado_mis_casos_pendientes(); ';
                  break;

                case "CASOS_EVALUACION":
                  icono = 'fa fa-info text-yellow';
                  accion = datos.notificaciones[iNotificacion].accion;
                  break;
              }
              var item = "";
              item += '<li><a class="control-de-contenido" href="javascript:void(0);" onclick="' + accion + '" >';
              item += '<i class="' + icono + '"></i> ' + datos.notificaciones[iNotificacion].texto;
              item += '</a></li>';
              $("#lista_notificaciones").append(item);
            }
            $(".span_numnotificaciones").html(datos.num_notificaciones);
            if (datos.num_notificaciones > 0) {
              $(".span_numnotificaciones").removeClass('bounceOut');
              setTimeout(function () {
                $(".span_numnotificaciones").addClass('bounceIn');
              }, 500);
            }
          }
  );
}

function leer_mensajes_sistema() {
  ejecutarAccion(
          'sistema', 'mensajes', 'del_sistema_para_usuario', '',
          function (datos) {
//                alert(datos);
            if (!estaVacio(datos)) {
              datos = JSON.parse(datos);
              var notificacion = new PNotify({
                type: 'notice',
                title: datos.titulo,
                text: datos.mensaje,
                desktop: {
                  desktop: true
                }
              });
            }
          }
  );
}

function salir_sistema() {
  ejecutarAccionSinBloqueo(
          'sistema', 'sesion', 'salir', '',
          function (data) {
            cerrar_sesion_usuario(data);
          }
  );
}











function generarCodigoBarras(textoCodigo, tipoCodigo, mensajeError, operacion) {

  if (!estaVacio(textoCodigo)) {
    ejecutarAccion(
            'sistema', 'codigos', 'codigoDeBarras',
            'texto=' + textoCodigo + '&tipoObjeto=' + tipoCodigo, function (resp) {
              operacion(resp);
            }
    );
  } else {
    alerta('' + mensajeError + '');
  }
}

function generarCodigoQR(textoCodigo, tipoCodigo, mensajeError, operacion) {

  if (!estaVacio(textoCodigo)) {
    ejecutarAccion(
            'sistema', 'codigos', 'codigoQR',
            'texto=' + textoCodigo + '&tipoObjeto=' + tipoCodigo, function (resp) {
              operacion(resp);
            }
    );
  } else {
    alerta('' + mensajeError + '');
  }
}