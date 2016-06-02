<?php
/**
 * Clase controlador
 */
class controlador_creacion
{
	/**
    * Función que despliega el panel que permite crear
    * una sede en el sistema.
    **/
    public function crear_sede() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Crear Sede',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_SEDE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite crear
    * un campus en el sistema.
    **/
    public function crear_campus() {        
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Crear Campus',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_CAMPUS, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite crear
    * un edificio en el sistema.
    **/
    public function crear_edificio() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Crear Edificio',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_EDIFICIO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite crear
    * un espacio en el sistema.
    **/
    public function crear_espacio() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Crear Espacio',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_ESPACIO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite crear
    * un tipo de material en el sistema.
    **/
    public function crear_tipo_material() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Crear Tipo Material',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_TIPO_MATERIAL, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite crear
    * un tipo de material en el sistema.
    **/
    public function crear_tipo_objeto() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Crear Tipo Objeto',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_TIPO_OBJETO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Funcion que permite guardar un campus en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_campus(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new Modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarCampus($info['nombre_sede'],$info['nombre_campus']);
            if($verificar){
                $m->guardarCampus($info['nombre_sede'],$info['nombre_campus']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar un edificio en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_edificio(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new Modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarEdificio($info['nombre_campus'],$info['id_edificio']);
            if($verificar){
                $m->guardarEdificio($info['nombre_campus'],$info['id_edificio'],$info['nombre_edificio'],$info['numero_pisos'],$info['terraza'],$info['sotano']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar un tipo de material en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_tipo_material(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new Modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarTipoMaterial($info['tipo_material'],$info['nombre_tipo_material']);
            if($verificar){
                $m->guardarTipoMaterial($info['tipo_material'],$info['nombre_tipo_material']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar un tipo de material en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_tipo_objeto(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new Modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarTipoObjeto($info['tipo_objeto'],$info['nombre_tipo_objeto']);
            if($verificar){
                $m->guardarTipoObjeto($info['tipo_objeto'],$info['nombre_tipo_objeto']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }
}
?>