<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase controlador_consultas
 */
class controlador_consultas
{
    /**
    * Función que despliega el panel que permite consultar
    * una sede en el sistema.
    **/
    public function consultar_sede() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Sede',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_SEDE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_SEDE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un campus en el sistema.
    **/
    public function consultar_campus() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Campus',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_CAMPUS, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CAMPUS, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * una cancha en el sistema.
    **/
    public function consultar_cancha() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Cancha',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_CANCHA, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CANCHA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un corredor en el sistema.
    **/
    public function consultar_corredor() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Corredor',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_CORREDOR, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CORREDOR, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

		/**
    * Función que despliega el panel que permite consultar
    * una cubierta en el sistema.
    **/
    public function consultar_cubierta() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Cubierta',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_CUBIERTA, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CUBIERTA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

		/**
    * Función que despliega el panel que permite consultar
    * las gradas en el sistema.
    **/
    public function consultar_gradas() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Gradas',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_GRADAS, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_GRADAS, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un parqueadero en el sistema.
    **/
    public function consultar_parqueadero() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Parqueadero',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_PARQUEADERO, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_PARQUEADERO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * una piscina en el sistema.
    **/
    public function consultar_piscina() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Piscina',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_PISCINA, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_PISCINA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * una plazoleta en el sistema.
    **/
    public function consultar_plazoleta() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Plazoleta',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_PLAZOLETA, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_PLAZOLETA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un sendero en el sistema.
    **/
    public function consultar_sendero() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Sendero Peatonal',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_SENDERO, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_SENDERO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * una vias en el sistema.
    **/
    public function consultar_via() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Vía',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_VIA, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_VIA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un edificio en el sistema.
    **/
    public function consultar_edificio() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Edificio',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_EDIFICIO, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_EDIFICIO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un espacio en el sistema.
    **/
    public function consultar_espacio() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Espacio',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_ESPACIO, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_ESPACIO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un tipo de material en el sistema.
    **/
    public function consultar_tipo_material() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Tipo Material',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_TIPO_MATERIAL, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_TIPO_MATERIAL, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * un tipo de material en el sistema.
    **/
    public function consultar_tipo_objeto() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Tipo Objeto',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_TIPO_OBJETO, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_TIPO_OBJETO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * el mapa con todos los campus, edificios, etc. creados en el sistema.
    **/
    public function consultar_mapa() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Mapa',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_MAPA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que permite consultar las sedes almacenadas en el sistema.
     */
    public function consultar_sedes() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarSedes();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_sede' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los campus almacenados en el sistema.
     */
    public function consultar_todos_campus() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCampus($info["nombre_sede"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_campus' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las canchas almacenadas en el sistema.
     */
    public function consultar_canchas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCanchas($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'uso' => mb_convert_case($valor['uso'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los corredores almacenados en el sistema.
     */
    public function consultar_corredores() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCorredores($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las cubiertas almacenadas en el sistema.
     */
    public function consultar_cubiertas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCubiertas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso' => $valor['piso'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las gradas almacenadas en el sistema.
     */
    public function consultar_todas_gradas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarGradas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso' => $valor['piso_inicio'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los parqueaderos almacenados en el sistema.
     */
    public function consultar_parqueaderos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarParqueaderos($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las piscinas almacenadas en el sistema.
     */
    public function consultar_piscinas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarPiscinas($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las plazoletas almacenadas en el sistema.
     */
    public function consultar_plazoletas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarPlazoletas($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los senderos almacenados en el sistema.
     */
    public function consultar_senderos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarSenderos($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las vías almacenadas en el sistema.
     */
    public function consultar_vias() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarVias($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los edificios de un campus
     * almacenados en el sistema.
     */
    public function consultar_edificios() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarEdificios($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'pisos' => $valor['numero_pisos'],
                    'sotano' => $valor['sotano'],
                    'terraza' => $valor['terraza'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los espacios de un edificio
     * almacenados en el sistema.
     */
    public function consultar_espacios() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarEspacios($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'uso_espacio' => mb_convert_case($valor['uso_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso' => $valor['piso_edificio'],
                    'ancho_pared' => $valor['ancho_pared'],
                    'alto_pared' => $valor['alto_pared'],
                    'material_pared' => $valor['id_material_pared'],
                    'ancho_piso' => $valor['ancho_piso'],
                    'largo_piso' => $valor['largo_piso'],
                    'material_piso' => $valor['id_material_piso'],
                    'ancho_techo' => $valor['ancho_techo'],
                    'largo_techo' => $valor['largo_techo'],
                    'material_techo' => $valor['id_material_techo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar el número de pisos de un edificio
     * almacenado en el sistema.
     */
    public function consultar_pisos_edificio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarPisosEdificio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'numero_pisos' => $valor['numero_pisos'],
                    'terraza' => $valor['terraza'],
                    'sotano' => $valor['sotano'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los diferentes usos de un espacio
     * almacenados en el sistema.
     */
    public function consultar_usos_espacios() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarUsosEspacios();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'uso_espacio' => mb_convert_case($valor['uso'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los diferentes materiales
     * almacenados en el sistema.
     */
    public function consultar_materiales() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMateriales($info["tipo_material"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_material' => mb_convert_case($valor['material'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los diferentes tipos de objetos
     * almacenados en el sistema.
     */
    public function consultar_tipo_objetos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarTipoObjetos($info["tipo_objeto"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'tipo_objeto' => mb_convert_case($valor['tipo'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de un campus.
     */
    public function ubicacion_campus() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionCampus($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_campus' => $valor['id'],
                    'nombre_campus' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de una cancha.
     */
    public function ubicacion_cancha() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionCancha($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'uso' => mb_convert_case($valor['uso'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de un corredor.
     */
    public function ubicacion_corredor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionCorredor($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de un parqueadero.
     */
    public function ubicacion_parqueadero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionParqueadero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de una piscina.
     */
    public function ubicacion_piscina() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionPiscina($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de una plazoleta.
     */
    public function ubicacion_plazoleta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionPlazoleta($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de un sendero.
     */
    public function ubicacion_sendero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionSendero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de una vía.
     */
    public function ubicacion_via() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionVia($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la ubicación de un edificio.
     */
    public function ubicacion_edificio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionEdificio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un campus
     * almacenado en el sistema.
     */
    public function consultar_informacion_sede() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionSede($info["nombre_sede"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id'],
                    'nombre_sede' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un campus
     * almacenado en el sistema.
     */
    public function consultar_informacion_campus() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCampus($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una cancha
     * almacenado en el sistema.
     */
    public function consultar_informacion_cancha() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $GLOBALS['sql'] = $info["nombre_sede"].$info["nombre_campus"].$info["id"];
            $data = $m->buscarInformacionCancha($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'uso' => $valor['uso'],
                    'material_piso' => $valor['id_material_piso'],
                    'tipo_pintura' => $valor['id_tipo_pintura'],
                    'longitud_demarcacion' => $valor['longitud_demarcacion'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un corredor
     * almacenado en el sistema.
     */
    public function consultar_informacion_corredor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCorredor($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'ancho_pared' => $valor['ancho_pared'],
                    'alto_pared' => $valor['alto_pared'],
                    'material_pared' => $valor['id_material_pared'],
                    'ancho_piso' => $valor['ancho_piso'],
                    'largo_piso' => $valor['largo_piso'],
                    'material_piso' => $valor['id_material_piso'],
                    'ancho_techo' => $valor['ancho_techo'],
                    'largo_techo' => $valor['largo_piso'],
                    'material_techo' => $valor['id_material_techo'],
                    'tomacorriente' => $valor['tomacorriente'],
                    'tipo_suministro_energia' => $valor['id_tipo_suministro_energia'],
                    'cantidad' => $valor['cantidad'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una cubierta
     * almacenadas en el sistema.
     */
    public function consultar_informacion_cubierta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCubierta($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'piso' => $valor['piso'],
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => $valor['id_edificio'],
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'largo' => $valor['largo'],
                    'ancho' => $valor['ancho'],
                    'material_cubierta' => $valor['id_material_cubierta'],
                    'tipo_cubierta' => $valor['id_tipo_cubierta'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
    * Función que permite consultar la información de unas gradas
    * almacenadas en el sistema.
     */
    public function consultar_informacion_gradas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionGradas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso_inicio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => $valor['id_edificio'],
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso_inicio' => $valor['piso_inicio'],
                    'pasamanos' => $valor['pasamanos'],
                    'material_pasamanos' => $valor['id_material_pasamanos'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un parqueadero
     * almacenado en el sistema.
     */
    public function consultar_informacion_parqueadero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionParqueadero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'largo' => $valor['largo'],
                    'ancho' => $valor['ancho'],
                    'capacidad' => $valor['capacidad'],
                    'longitud_demarcacion' => $valor['longitud_demarcacion'],
                    'material_piso' => $valor['id_material_piso'],
                    'tipo_pintura_demarcacion' => $valor['id_tipo_pintura_demarcacion'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una piscina
     * almacenada en el sistema.
     */
    public function consultar_informacion_piscina() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionPiscina($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_punto_hidraulico' => $valor['cantidad_punto_hidraulico'],
                    'largo' => $valor['largo'],
                    'ancho' => $valor['ancho'],
                    'alto' => $valor['alto'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una plazoleta
     * almacenada en el sistema.
     */
    public function consultar_informacion_plazoleta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionPlazoleta($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un sendero
     * almacenado en el sistema.
     */
    public function consultar_informacion_sendero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionSendero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'longitud' => $valor['longitud'],
                    'ancho' => $valor['ancho'],
                    'material_piso' => $valor['id_material_piso'],
                    'tipo_iluminacion' => $valor['id_tipo_iluminacion'],
                    'cantidad' => $valor['cantidad'],
                    'codigo_poste' => mb_convert_case($valor['codigo_poste'],MB_CASE_UPPER ,"UTF-8"),
                    'material_cubierta' => $valor['material_cubierta'],
                    'ancho_cubierta' => $valor['ancho_cubierta'],
                    'largo_cubierta' => $valor['largo_cubierta'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una vía
     * almacenada en el sistema.
     */
    public function consultar_informacion_via() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionVia($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'material_piso' => $valor['material_pisog'],
                    'tipo_pintura' => $valor['id_tipo_pintura'],
                    'longitud_demarcacion' => $valor['longitud_demarcacion'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un edificio
     * almacenado en el sistema.
     */
    public function consultar_informacion_edificio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionEdificio($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'numero_pisos' => $valor['numero_pisos'],
                    'sotano' => $valor['sotano'],
                    'terraza' => $valor['terraza'],
                    'material_fachada' => $valor['id_material_fachada'],
                    'ancho_fachada' => $valor['ancho_fachada'],
                    'alto_fachada' => $valor['alto_fachada'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un espacio
     * almacenado en el sistema.
     */
    public function consultar_informacion_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'uso_espacio' => mb_convert_case($valor['uso_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso' => $valor['piso_edificio'],
                    'ancho_pared' => $valor['ancho_pared'],
                    'alto_pared' => $valor['alto_pared'],
                    'material_pared' => $valor['id_material_pared'],
                    'ancho_piso' => $valor['ancho_piso'],
                    'largo_piso' => $valor['largo_piso'],
                    'material_piso' => $valor['id_material_piso'],
                    'ancho_techo' => $valor['ancho_techo'],
                    'largo_techo' => $valor['largo_techo'],
                    'material_techo' => $valor['id_material_techo'],
                    'lat' => $valor['lat'],
                    'lng' => $valor['lng'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de un campus
     * almacenado en el sistema.
     */
    public function consultar_archivos_campus() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosCampus($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de una cancha
     * almacenada en el sistema.
     */
    public function consultar_archivos_cancha() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosCancha($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de un corredor
     * almacenado en el sistema.
     */
    public function consultar_archivos_corredor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosCorredor($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de una cubierta
     * almacenada en el sistema.
     */
    public function consultar_archivos_cubierta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosCubierta($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'piso' => $valor['piso'],
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de unas gradas
     * almacenadas en el sistema.
     */
    public function consultar_archivos_gradas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosGradas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso_inicio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'piso_inicio' => $valor['piso_inicio'],
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de un parqueadero
     * almacenado en el sistema.
     */
    public function consultar_archivos_parqueadero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosParqueadero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de una piscina
     * almacenada en el sistema.
     */
    public function consultar_archivos_piscina() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosPiscina($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de una plazoleta
     * almacenada en el sistema.
     */
    public function consultar_archivos_plazoleta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosPlazoleta($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de un sendero
     * almacenado en el sistema.
     */
    public function consultar_archivos_sendero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosSendero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de una vía
     * almacenada en el sistema.
     */
    public function consultar_archivos_via() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosVia($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de un edificio
     * almacenado en el sistema.
     */
    public function consultar_archivos_edificio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosEdificio($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los archivos de un espacio
     * almacenado en el sistema.
     */
    public function consultar_archivos_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_campus"],$info["piso"],$info["codigo_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'piso' => $valor['piso_edificio'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'nombre' => $valor['nombre'],
                    'tipo' => $valor['tipo'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }
}
?>
