
function validarLetras(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla == 8)
    return true; // space
  if (tecla == 9)
    return true; // space
  if (tecla > 30 && tecla < 47)
    return true; // espeiales
  if (tecla == 192)
    return true; // Ñ
  if (tecla == 32)
    return true; // space

  patron = /[a-zA-Z]/; //patron
  te = String.fromCharCode(tecla);
  return patron.test(te); // prueba de patron
}

function validarEspacio(e) {
  tecla = (document.all) ? e.keyCode : e.which;

  if (tecla == 32)
    return false; // space              
  return true; // prueba de patron
}

function convertirAMayusculas(texto) {
  return texto.toUpperCase();
}


function previewImagen(input, img, div) {
  cargando_dentro_objeto(div);
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {      
      $('#' + img).attr('src', e.target.result);
      quitar_cargando_dentro_objeto( div );
    }
    reader.readAsDataURL(input.files[0]);
  }
}