<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase que guarda la información para conectarse a la base de datos.
 */
class config{
    static public $mvc_bd_hostname  = "localhost";
    static public $mvc_bd_nombre    = "sistemas"; //sistemas
    static public $mvc_bd_ordenes_mantenimiento = "solicitudes_mantenimiento";
    static public $mvc_bd_usuario   = "postgres";
    static public $mvc_bd_clave     = "12";
    static public $mvc_vis_css      = "estilo.css";
    //static public $salt = '$2a$07$G4C2/I0514B266.BBKD5ID';
}

?>
