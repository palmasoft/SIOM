<?php

$useragent = $_SERVER['HTTP_USER_AGENT'];

if (preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)))
    define('ORIGEN', 'SMARTPHONE');

header('Content-Type: text/html; charset=UTF-8');
error_reporting(1);
ini_set("display_errors", 1);
ini_set('post_max_size', 0);
ini_set('upload_max_filesize', 0);
ini_set('max_execution_time', 18000);
set_time_limit(18000);
define('_passEncript', 'OXYMED');
//session_start();
if (!isset($_SESSION[_passEncript])) {
    try {
        session_regenerate_id();
    } catch (Exception $exc) {
        
    }
    session_name(_passEncript);
}
$Usuario = isset($_SESSION['OXYMED_USR']) ? $_SESSION['OXYMED_USR'] : NULL;
session_write_close();

//print_r($Usuario);

include_once 'libs/puro_ingenio_samario.php';
PuroIngenioSamario::utilidades();
define('_PUROINGENIOSAMARIO', 1);
define('DS', DIRECTORY_SEPARATOR);
define('WS', '/');
define('PATH_BASE', dirname(__file__) . DS);
define('URL_BASE', Urls::servidor());

define('PATH_LOGS', PATH_BASE . 'logs' . DS);
define('PATH_PLANTILLAS', PATH_BASE . 'plantillas' . DS);
define('PATH_ARCHIVOS', PATH_BASE . 'archivos' . DS . 'oximeiser' . DS);
define('PATH_LIBS', PATH_BASE . 'libs' . DS);
define('PATH_COMPONENTES', PATH_BASE . 'componentes' . DS);
define('DIR_VISTAS', 'vistas');
define('EXT_VISTAS', '.html.php');
define('DIR_ESTILOS', 'estilos');
define('EXT_ESTILOS', '.css');
define('DIR_SCRIPTS', 'funciones');
define('EXT_SCRIPTS', '.js');
define('PATH_MODELOS', PATH_BASE . 'modelos' . DS);
define('EXT_MODELOS', 'modelo');


define('URL_PLANTILLAS', URL_BASE . 'plantillas/');
define('URL_ARCHIVOS', URL_BASE . 'archivos/oximeiser/');
define('URL_LIBS', URL_BASE . 'libs/');
define('URL_COMPONENTES', URL_BASE . 'componentes/');

//CONEXION A LA BSE DE DATOS DEL ADMINISTRADOR
//define('dbtype_basico', 'mysql');
//define('dbhost_basico', 'localhost');
//define('dbport_basico', '');
//define('dbname_basico', 'oximeise_bkp');
//define('dbuser_basico', 'oximeise_usr');
//define('dbpass_basico', 'io#!kIgx6PnN');

define('dbtype_basico', 'mysql');
define('dbhost_basico', 'localhost');
define('dbport_basico', '');
define('dbname_basico', 'oximeise_siom');
define('dbuser_basico', 'oximeise_usr');
define('dbpass_basico', 'io#!kIgx6PnN');


//define('dbtype_basico', 'mysql');
//define('dbhost_basico', 'localhost');
//define('dbport_basico', '');
//define('dbname_basico', 'oximed_si');
//define('dbuser_basico', 'root');
//define('dbpass_basico', '');
////CONEXION A LA BSE DE DATOS DEL CLIENTE
//Configuraciones::set('dbtype_cliente', Config::get('dbtype_cliente') == "" ?
//    'mysql' : Config::get('dbtype_cliente'));
//Configuraciones::set('dbport_cliente', Config::get('dbport_cliente') == "" ? 
//    '' :  Config::get('dbport_cliente'));
//Configuraciones::set('dbname_cliente', Config::get('dbname_cliente') == "" ?
//    'bd_cliente_puroingeniosamario' : Config::get('dbname_cliente'));
//Configuraciones::set('dbuser_cliente', Config::get('dbuser_cliente') == "" ?
//    'root' : Config::get('dbuser_cliente'));
//Configuraciones::set('dbpass_cliente', Config::get('dbpass_cliente') == "" ?
//    '' : Config::get('dbpass_cliente'));
//Configuraciones::set('dbhost_cliente', Config::get('dbhost_cliente') == "" ?
//    '127.0.0.1' : Config::get('dbhost_cliente'));

include_once 'libs/sistema/MainController.php';
