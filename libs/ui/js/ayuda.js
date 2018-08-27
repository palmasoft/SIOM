/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function agregar_boton_ayuda(COD_AYUDA) {
    ejecutarAccionSinBloqueo(
            'sistema', 'ayudas', 'cargar_ayuda',
            'codigo_ayuda=' + COD_AYUDA, ' $("#pre-page-content").prepend( data ); '
            );
}

