/**
 * @author Ing. Juan Pablo Llinas Ramirez
 */

window.informacion = function (mensaje, titulo) {
  $.msgbox(mensaje, {
    type: "info",
    title: titulo
  }, function (result) {
    //$("#result2").text(result); 
  });
  //beep(1);
}


window.exito = function (mensaje, titulo) {
  $.msgbox(mensaje, {
    type: "success",
    title: titulo
  }, function (result) {
    //$("#result2").text(result); 
  });
  //beep(1);
}




window.alerta = function (mensaje) {
  $.alert(mensaje);
  //beep(2);
};



window.error = function (mensaje) {
  $.msgbox(mensaje, {
    type: "error",
    title: "ERROR"
  });
}


//window.confirm = 
window.confirmar = function (mensaje, accion) {
  $.msgbox(mensaje, {
    type: "confirm",
    confirm: true,
    ok: 'SI',
    no: 'NO',
    submit: function (result) {
      if (result) {
        //alert(result);
        accion(result);
      }
      return false;
    }
  });
//    beep(1);
};


var _RECARGAR_SALIR = true;
window.onbeforeunload = function () {
  //alert( "esta recargando o cambiando la pagina. se perderá todo lo que ha hecho hasta ahora!!!!!" );
  if (_RECARGAR_SALIR == false) {
    return 'Estas recargando o saliendo del SICCSM.';
  }
};






function pantallaCompleta(element) {
  if (element.requestFullscreen) {
    element.requestFullscreen();
  } else if (element.mozRequestFullScreen) {
    element.mozRequestFullScreen();
  } else if (element.webkitRequestFullscreen) {
    element.webkitRequestFullscreen();
  } else if (element.msRequestFullscreen) {
    element.msRequestFullscreen();
  }
}

function salirPantallaCompleta() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) {
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) {
    document.webkitExitFullscreen();
  }
}



