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
     * Función que permite consultar las sedes
     * almacenadas en el sistema.
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
     * Función que permite consultar los campus
     * almacenados en el sistema.
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
     * Función que permite consultar las canchas
     * almacenadas en el sistema.
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
                    'nombre_sede' => ucwords($valor['nombre_sede']),
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
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'nombre_sede' => ucwords($valor['nombre_sede']),
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

    /**
     * Función que permite consultar la ubicación de un
     * campus.
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
     * Función que permite consultar los edificios de un campus
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
                    'nombre_sede' => ucwords($valor['nombre_sede']),
                    'nombre_campus' => ucwords($valor['nombre_campus']),
                    'id_edificio' => ucwords($valor['id_edificio']),
                    'nombre_edificio' => ucwords($valor['nombre_edificio']),
                    'piso' => ucwords($valor['piso_edificio']),
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
}
?>
