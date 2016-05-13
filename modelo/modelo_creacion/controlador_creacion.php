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
     * Funcion que permite guardar una sede en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_sede(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            if($m->verificarSede($info['nombre_sede'])){
                $m->guardarSede($info['nombre_sede']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($result);
    }
}
?>