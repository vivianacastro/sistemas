<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase controlador_modificacion
 *
 */
class controlador_modificacion{

    /**
     * Funcion que permite modificar una sede en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function modificar_sede(){
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $m->modificarSede($info['id_sede'],$info['nombre_sede_nuevo']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un campus en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function modificar_campus(){
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $m->modificarCampus($info['id_sede'],$info['id_campus'],$info['$nombre_campus'],$info['$lat'],$info['$lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una cancha en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function modificar_cancha(){
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $m->modificarCancha($info['id_sede'],$info['id_campus'],$info['id'],$info['uso'],$info['material_piso'],$info['tipo_pintura'],$info['longitud_demarcacion'],$info['$lat'],$info['$lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una cancha en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function modificar_corredor(){
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $m->modificarCorredor($info['id_sede'],$info['id_campus'],$info['id'],$info['ancho_pared'],$info['alto_pared'],$info['material_pared'],$info['ancho_piso'],$info['largo_piso'],$info['material_piso'],$info['ancho_techo'],$info['largo_techo'],$info['material_techo'],$info['tomacorriente'],$info['tipo_suministro_energia'],$info['cantidad'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['tipo_interruptor'],$info['cantidad_interruptor'],$info['$lat'],$info['$lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una cancha en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function modificar_cubierta(){
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $m->modificarCubierta($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['tipo_cubierta'],$info['material_cubierta'],$info['largo_cubierta'],$info['ancho_cubierta']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una cancha en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function modificar_gradas(){
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $m->modificarGradas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['pasamanos'],$info['material_pasamanos'],$info['tipo_ventana'],$info['material'],$info['alto_ventana'],$info['ancho_ventana']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

}
?>
