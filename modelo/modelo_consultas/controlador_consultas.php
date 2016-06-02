<?php
/**
 * Clase controlador
 */
class controlador_consultas
{

    /**
    * Función que despliega el panel que permite consultar
    * los espacios que se encuentran registrados en el sistema.
    **/
    public function modulo_planta() {        
        $GLOBALS['mensaje'] = "";        
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $data = array(
            'mensaje' => 'Consultar espacio',
        );        
        $v = new Controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_BUSQ_PLANTA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }
    
    /**
     * Función que permite consultar las sedes
     * almacenadas en el sistema.
     */
    public function consultar_sedes() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dataNew = array();
            $data = $m->buscarSedes();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_sede' => $valor['nombre'],
                    );
                array_push($dataNew, $arrayAux);
            }
        }        
        $dataNew['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($dataNew);
    }

    /**
     * Función que permite consultar los campus
     * almacenados en el sistema.
     */
    public function consultar_campus() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dataNew = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCampus($info["nombre_sede"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_campus' => $valor['nombre'],
                    );
                array_push($dataNew, $arrayAux);
            }
        }        
        $dataNew['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($dataNew);
    }

    /**
     * Función que permite consultar los edificios de un campus
     * almacenados en el sistema.
     */
    public function consultar_edificios() {
        $GLOBALS['mensaje'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $dataNew = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarEdificios($info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_edificio' => $valor['nombre'],
                    );
                array_push($dataNew, $arrayAux);
            }
        }        
        $dataNew['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($dataNew);
    }
}
?>