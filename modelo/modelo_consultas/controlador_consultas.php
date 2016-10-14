<?php
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_SEDE, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CAMPUS, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CANCHA, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CORREDOR, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_CUBIERTA, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_GRADAS, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
    * Función que despliega el panel que permite consultar
    * una cancha en el sistema.
    **/
    public function consultar_parqueadero() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Parqueadero',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_PARQUEADERO, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_PISCINA, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_PLAZOLETA, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_SENDERO, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_VIA, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_EDIFICIO, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_ESPACIO, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_TIPO_MATERIAL, $data);
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
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_TIPO_OBJETO, $data);
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarSedes();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_sede' => ucwords($valor['nombre']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCampus($info["nombre_sede"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_campus' => ucwords($valor['nombre']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCanchas($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
                    'uso' => ucwords($valor['uso']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCorredores($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCubiertas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_edificio' => ucwords($valor['id_edificio']),
                    'nombre_edificio' => ucwords($valor['nombre_edificio']),
                    'piso' => ucwords($valor['piso']),
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
     * Función que permite consultar las gradas almacenadas en el sistema.
     */
    public function consultar_todas_gradas() {
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarGradas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso_inicio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_edificio' => ucwords($valor['id_edificio']),
                    'nombre_edificio' => ucwords($valor['nombre_edificio']),
                    'piso_inicio' => ucwords($valor['piso_inicio']),
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
     * Función que permite consultar los parqueaderos almacenados en el sistema.
     */
    public function consultar_parqueaderos() {
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarParqueaderos($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarPiscinas($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarPlazoletas($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
                    'nombre' => ucwords($valor['nombre']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarSenderos($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarVias($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarEdificios($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_edificio' => ucwords($valor['nombre']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'pisos' => ucwords($valor['numero_pisos']),
                    'sotano' => ucwords($valor['sotano']),
                    'terraza' => ucwords($valor['terraza']),
                    'lat' => ucwords($valor['lat']),
                    'lng' => ucwords($valor['lng']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarEspacios($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'uso_espacio' => ucwords($valor['uso_espacio']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_edificio' => ucwords($valor['id_edificio']),
                    'nombre_edificio' => ucwords($valor['nombre_edificio']),
                    'piso' => ucwords($valor['piso_edificio']),
                    'ancho_pared' => ucwords($valor['ancho_pared']),
                    'alto_pared' => ucwords($valor['alto_pared']),
                    'material_pared' => ucwords($valor['material_pared']),
                    'ancho_piso' => ucwords($valor['ancho_piso']),
                    'largo_piso' => ucwords($valor['largo_piso']),
                    'material_piso' => ucwords($valor['material_piso']),
                    'ancho_techo' => ucwords($valor['ancho_techo']),
                    'largo_techo' => ucwords($valor['largo_techo']),
                    'material_techo' => ucwords($valor['material_techo']),
                    'lat' => ucwords($valor['lat']),
                    'lng' => ucwords($valor['lng']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarPisosEdificio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarUsosEspacios();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'uso_espacio' => ucwords($valor['uso']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMateriales($info["tipo_material"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre_material' => ucwords($valor['material']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarTipoObjetos($info["tipo_objeto"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'tipo_objeto' => ucwords($valor['tipo']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionCampus($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_campus' => ucwords($valor['id']),
                    'nombre_campus' => ucwords($valor['nombre']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionCancha($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
                    'uso' => ucwords($valor['uso']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionCorredor($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionParqueadero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionPiscina($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionPlazoleta($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
                    'nombre' => ucwords($valor['nombre']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionSendero($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionVia($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->ubicacionEdificio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionSede($info["nombre_sede"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCampus($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
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
    public function consultar_informacion_cancha() {
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCancha($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => $valor['nombre_campus'],
                    'uso' => $valor['uso'],
                    'material_piso' => ucwords($valor['material_piso']),
                    'tipo_pintura' => ucwords($valor['tipo_pintura']),
                    'longitud_demarcacion' => ucwords($valor['longitud_demarcacion']),
                    'lat' => ucwords($valor['lat']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCorredor($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => ucwords($valor['id']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => $valor['nombre_campus'],
                    'ancho_pared' => $valor['ancho_pared'],
                    'alto_pared' => ucwords($valor['alto_pared']),
                    'material_pared' => ucwords($valor['material_pared']),
                    'lat' => ucwords($valor['lat']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCubierta($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'piso' => ucwords($valor['piso']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => $valor['nombre_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'nombre_edificio' => ucwords($valor['nombre_edificio']),
                    'largo' => ucwords($valor['largo']),
                    'ancho' => ucwords($valor['ancho']),
                    'material_cubierta' => ucwords($valor['material_cubierta']),
                    'tipo_cubierta' => $valor['tipo_cubierta'],
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionGradas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso_inicio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_edificio' => $valor['id_edificio'],
                    'nombre_edificio' => $valor['nombre_edificio'],
                    'piso_inicio' => ucwords($valor['piso_inicio']),
                    'pasamanos' => ucwords($valor['pasamanos']),
                    'material_pasamanos' => ucwords($valor['material_pasamanos']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionParqueadero($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => $valor['id'],
                    'largo' => $valor['largo'],
                    'ancho' => ucwords($valor['ancho']),
                    'capacidad' => ucwords($valor['capacidad']),
                    'longitud_demarcacion' => ucwords($valor['longitud_demarcacion']),
                    'material_piso' => ucwords($valor['material_piso']),
                    'tipo_pintura_demarcacion' => $valor['tipo_pintura_demarcacion'],
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionPiscina($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => $valor['id'],
                    'cantidad_punto_hidraulico' => $valor['cantidad_punto_hidraulico'],
                    'largo' => ucwords($valor['largo']),
                    'ancho' => ucwords($valor['ancho']),
                    'alto' => ucwords($valor['alto']),
                    'lat' => ucwords($valor['lat']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionPlazoleta($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => $valor['id'],
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionSendero($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => $valor['id'],
                    'longitud' => $valor['longitud'],
                    'ancho' => ucwords($valor['ancho']),
                    'material_piso' => ucwords($valor['material_piso']),
                    'tipo_iluminacion' => ucwords($valor['tipo_iluminacion']),
                    'cantidad' => ucwords($valor['cantidad']),
                    'codigo_poste' => $valor['codigo_poste'],
                    'material_cubierta' => $valor['material_cubierta'],
                    'ancho_cubierta' => ucwords($valor['ancho_cubierta']),
                    'largo_cubierta' => ucwords($valor['largo_cubierta']),
                    'lat' => ucwords($valor['lat']),
                    'lng' => ucwords($valor['lng']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionVia($info["nombre_sede"],$info["nombre_campus"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => $valor['idt'],
                    'material_piso' => $valor['material_pisog'],
                    'tipo_pintura' => ucwords($valor['tipo_pintura']),
                    'longitud_demarcacion' => ucwords($valor['longitud_demarcacion']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
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
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id' => ucwords($valor['id']),
                    'nombre' => ucwords($valor['nombre']),
                    'numero_pisos' => ucwords($valor['numero_pisos']),
                    'sotano' => ucwords($valor['sotano']),
                    'terraza' => ucwords($valor['terraza']),
                    'material_fachada' => ucwords($valor['material_fachada']),
                    'ancho_fachada' => ucwords($valor['ancho_fachada']),
                    'alto_fachada' => ucwords($valor['alto_fachada']),
                    'lat' => ucwords($valor['lat']),
                    'lng' => ucwords($valor['lng']),
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
        $GLOBALSGLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'uso_espacio' => ucwords($valor['uso_espacio']),
                    'id_sede' => ucwords($valor['id_sede']),
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'id_campus' => ucwords($valor['id_campus']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_edificio' => ucwords($valor['id_edificio']),
                    'nombre_edificio' => ucwords($valor['nombre_edificio']),
                    'piso' => ucwords($valor['piso_edificio']),
                    'ancho_pared' => ucwords($valor['ancho_pared']),
                    'alto_pared' => ucwords($valor['alto_pared']),
                    'material_pared' => ucwords($valor['material_pared']),
                    'ancho_piso' => ucwords($valor['ancho_piso']),
                    'largo_piso' => ucwords($valor['largo_piso']),
                    'material_piso' => ucwords($valor['material_piso']),
                    'ancho_techo' => ucwords($valor['ancho_techo']),
                    'largo_techo' => ucwords($valor['largo_techo']),
                    'material_techo' => ucwords($valor['material_techo']),
                    'lat' => ucwords($valor['lat']),
                    'lng' => ucwords($valor['lng']),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los campus
     * almacenados en el sistema.
     */
    public function consultar_archivos_campus() {
        $GLOBALSGLOBALS['mensaje'] = "";
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
}
?>
