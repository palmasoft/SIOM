<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Botones
 *
 * @author BASE DE DATOS
 */
class Botones {

    //put your code here

    static function normal($contenido, $class = '', $click = '', $icono = 'fa-bars') {
        $strBtn = '<button type="button" class="btn  btn-default ' . $class . ' " ';        
        if (!empty($click)) {
            $strBtn .= ' onClick="' . $click . '" ';
        }
        $strBtn .= ' >'
                . '<i class="fa ' . $icono . ' " ></i> '
                . '<span class = "">' . $contenido . '</span> ' 
                . '</button> ';
        return $strBtn;
    }
    
    
    static function normal_accion($contenido, $class = '', $icono = 'fa-bars', $componente = '', $controlador = '', $accion = '', $script = '' ) {
        $strBtn = '<button type="button" class="btn  btn-default ' . $class . ' control-de-accion" ';
        if (!empty($componente)) {
            $strBtn .= ' data-componente = "' . $componente . '" ';
        }
        if (!empty($controlador)) {
            $strBtn .= ' data-controlador = "' . $controlador . '" ';
        }
        if (!empty($accion)) {
            $strBtn .= ' data-accion = "' . $accion . '"  ';
        }
        if (!empty($script)) {
            $strBtn .= ' data-script="' . $script . '" ';
        }
        if (!empty($click)) {
            $strBtn .= ' onClick="' . $click . '" ';
        }
        $strBtn .= ' >'
                . '<i class="fa ' . $icono . ' " ></i> '
                . '<span class = "">' . $contenido . '</span> ' 
                . '</button> ';
        return $strBtn;
    }

    static function enlace($contenido, $componente = '', $controlador = '', $accion = '', $script = '', $class = '') {
        return '<a href = "javascript:void(0);" class = "btn ' . $class . '" '
                . 'onClick = "' . $accion . '" '
                . 'data-controlador = "' . $controlador . '" '
                . 'data-componente = "' . $componente . '" '
                . 'data-accion = "' . $accion . '" '
                . 'data-script = "' . $script . '" >'
                . '' . $contenido . ''
                . '</a>';
    }

}
