<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empresa
 *
 * @author Toshiba
 */
class Empresa {

    //put your code here

    public static function tipoNegocio() {
        if (isset($_SESSION['SINAP_USUARIO_EMPRESA'])) {
            return $_SESSION['SINAP_USUARIO_EMPRESA']->NOMBRE_ACTIVIDAD_COMERCIAL;
        }
        return "[nombre actividad comercial]";
    }
    public static function nombre() {
        if (isset($_SESSION['SINAP_USUARIO_EMPRESA'])) {
            return $_SESSION['SINAP_USUARIO_EMPRESA']->NOMBRE_EMPRESA;
        }
        return "[nombre de la empresa]";
    }

}
