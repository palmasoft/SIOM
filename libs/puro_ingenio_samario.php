<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PuroIngenioSamario {

    function __construct() {
        
    }

    public static function utilidades() {
        require_once 'libs/sistema/configuracion/Config.php'; //de configuracion
        require_once 'libs/util/Consola.php'; //de configuracion
        //UTILIDADES
        require_once 'libs/util/Archivos.php'; //funciones para manejo de archivos
        require_once 'libs/util/Xml.php'; //funciones para manejo de archivos
        require_once 'libs/util/Fechas.php'; //funciones para manejo de fecha
        require_once 'libs/util/GoogleServices.php'; //funciones para manejo de fecha
        require_once 'libs/util/Zopim.php'; //funciones para manejo de fecha
        require_once 'libs/util/Urls.php'; //funciones para manejo de fecha
        require_once 'libs/util/Servidor.php'; //funciones para manejo de fecha
        require_once 'libs/util/Vectores.php'; //funciones para manejo de fecha
        require_once 'libs/util/Urls.php'; //funciones para manejo de fecha
        require_once 'libs/util/Textos.php'; //funciones para manejo de textos
        require_once 'libs/util/Numeros.php'; //funciones para manejo de numeros
        require_once 'libs/util/Color.php'; //funciones para manejo de colores
        
        
        require_once 'libs/correos/Correos.php'; //funciones para manejo de colores
        
        require_once 'libs/docs/pdf/tcpdf/tcpdf.php'; //funciones para manejo de colores
        
        
        
        require_once 'libs/util/Globales.php'; //funciones para manejo de fecha
    }

    public static function cargar_libreria() {
        //Configuracion y Parametros        
        require_once 'libs/sistema/configuracion/SPDOSistema.php'; //Controlador de Cosultas a la BD | PDO con singleton 
        require_once 'libs/sistema/configuracion/SPDOCliente.php'; //Controlador de Cosultas a la BD | PDO con singleton 
        require_once 'libs/sistema/configuracion/Parametros.php'; //de Parametros        
        //Controladores Basicos       
        require_once 'libs/sistema/bases/Base.php'; //Clase controlador base      
        require_once 'libs/sistema/bases/Controladores.php'; //Mini motor de Drivers Clase controlador base
        require_once 'libs/sistema/bases/Modelos.php'; //Mini motor de Mdelos	 Clase modelo base  
        require_once 'libs/sistema/bases/Vistas.php'; //Mini motor de plantillas Clase modelo base   
        require_once 'libs/sistema/bases/Usuario.php'; //Mini motor de plantillas  
        require_once 'libs/sistema/bases/Empresa.php'; //Mini motor de plantillas 
        require_once 'libs/sistema/control/Plantillas.php'; //Mini motor de plantillas 
        require_once 'libs/sistema/control/Errores.php'; //adminsitra los errores del sistema
        require_once 'libs/sistema/control/Respuestas.php'; //adminsitra los errores del sistema
        //Controladores GUI		        
        require_once 'libs/ui/html/Formularios.php'; //adminsitra las vista para los errores dle sistema
        require_once 'libs/ui/html/Botones.php'; //adminsitra las vista para los errores dle sistema
        require_once 'libs/ui/html/AlertasHTML5.php'; //adminsitra las vista para los errores dle sistema
        
    }

}
