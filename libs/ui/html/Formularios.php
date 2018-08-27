<?php

/**
 * @author 
 * @copyright 2010
 */
require PATH_LIBS. 'ui/html/ListaDesplegable.class.php';
require PATH_LIBS. 'ui/html/ListaChequeo.class.php';

class Formularios {

    public function Lista_Desplegable(
    $datos, $campoTexto, $campoValor, $id_lista, $option = '', $onclick = '', $onchange = '', $clases = '', $estilo = '', $multiple = false, $textoDefecto = '', $name = ''
    ) {


        $Lista = new ListaDesplegable();

        return $Lista->crear(
                        $datos, $campoTexto, $campoValor, $id_lista, $option, $onclick, $onchange, $clases, $estilo, $multiple, $textoDefecto, $name
        );
    }

    public function Lista_Seleccion_Multipe(
    $datos, $campoTexto, $campoValor, $id_lista, $option = '', $onclick = '', $onchange = '', $clases = '', $estilo = '', $multiple = false, $textoDefecto = '', $name = '') {


        $Lista = new ListaDesplegable();
        $lst = $Lista->crear_seleccion(
                $datos, $campoTexto, $campoValor, $id_lista, $option, $onclick, $onchange, $clases, $estilo, $multiple, $textoDefecto, $name
        );

        return $lst;
    }

    public function Lista_Chequeo_Multiple_Derecha($idOpciones, $nombreLista, $textoOpciones = array(), $valorOpciones = array(), $valorSeleccionados = array(), $onclick = '', $onchange = '', $estilo = '') {

        $CheckList = new ListaChequeo($idOpciones, $nombreLista);
        return $CheckList->crear_lista_multiple($textoOpciones, $valorOpciones, $valorSeleccionados, $onclick, $onchange, $estilo);
    }

}
