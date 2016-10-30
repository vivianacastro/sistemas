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
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_sede(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarSede($info['id_sede'],$info['nombre_sede']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un campus en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_campus(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarCampus($info['id_sede'],$info['id_campus'],$info['nombre_campus'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una cancha en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_cancha(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarCancha($info['id_sede'],$info['id_campus'],$info['id'],$info['uso_cancha'],$info['material_piso'],$info['tipo_pintura'],$info['longitud_demarcacion'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un corredor en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_corredor(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarCorredor($info['id_sede'],$info['id_campus'],$info['id'],$info['ancho_pared'],$info['alto_pared'],$info['material_pared'],$info['ancho_piso'],$info['largo_piso'],$info['material_piso'],$info['ancho_techo'],$info['largo_techo'],$info['material_techo'],$info['tomacorriente'],$info['tipo_suministro_energia'],$info['cantidad'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['tipo_interruptor'],$info['cantidad_interruptor'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una cubierta en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_cubierta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarCubierta($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['tipo_cubierta'],$info['material_cubierta'],$info['largo_cubierta'],$info['ancho_cubierta']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar unas gradas en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_gradas(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarGradas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['pasamanos'],$info['material_pasamanos'],$info['tipo_ventana'],$info['material'],$info['alto_ventana'],$info['ancho_ventana']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un parqueadero en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_parqueadero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarParqueadero($info['id_sede'],$info['id_campus'],$info['id'],$info['material_piso'],$info['tipo_pintura'],$info['largo'],$info['ancho'],$info['capacidad'],$info['longitud_demarcacion'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una piscina en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_piscina(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarPiscina($info['id_sede'],$info['id_campus'],$info['id'],$info['cantidad_punto_hidraulico'],$info['largo'],$info['ancho'],$info['alto'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una plazoleta en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_plazoleta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarPlazoleta($info['id_sede'],$info['id_campus'],$info['id'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un sendero en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_sendero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarSendero($info['id_sede'],$info['id_campus'],$info['id'],$info['longitud'],$info['ancho'],$info['material_piso'],$info['tipo_iluminacion'],$info['cantidad'],$info['codigo_poste'],$info['material_cubierta'],$info['ancho_cubierta'],$info['largo_cubierta'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar una vía en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_via(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarVia($info['id_sede'],$info['id_campus'],$info['id'],$info['tipo_material'],$info['tipo_pintura_demarcacion'],$info['longitud_demarcacion'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un edificio en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_edificio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarEdificio($info['id_sede'],$info['id_campus'],$info['id'],$info['numero_pisos'],$info['sotano'],$info['terraza'],$info['material_fachada'],$info['ancho_fachada'],$info['alto_fachada'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un espacio en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_espacio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarEspacio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['id'],$info['uso_espacio'],$info['ancho_pared'],$info['alto_pared'],$info['material_pared'],$info['ancho_piso'],$info['largo_piso'],$info['material_piso'],$info['ancho_techo'],$info['largo_techo'],$info['material_techo'],$info['espacio_padre'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['tipo_interruptor'],$info['cantidad_interruptor'],$info['tipo_puerta'],$info['material_puerta'],$info['cantidad_puerta'],$info['tipo_cerradura'],$info['material_marco'],$info['gato_puerta'],$info['ancho_puerta'],$info['alto_puerta'],$info['tipo_suministro_energia'],$info['tomacorriente'],$info['cantidad_suministro_energia'],$info['tipo_ventana'],$info['cantidad_ventana'],$info['material_ventana'],$info['ancho_ventana'],$info['alto_ventana'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['lat'],$info['lng']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite modificar un tipo de material en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_tipo_material(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarTipoMaterial($info['tipo_material'],$info['id'],$info['nombre']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }
    /**
     * Funcion que permite modificar un tipo de objeto en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function modificar_tipo_objeto(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->modificarTipoObjeto($info['tipo_objeto'],$info['id'],$info['nombre']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }
}
?>
