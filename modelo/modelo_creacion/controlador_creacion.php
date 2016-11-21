<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*
/**
 * Clase controlador_creacion
 */
class controlador_creacion
{
	/**
     * Función que despliega el panel que permite crear
     * una sede en el sistema.
    **/
    public function crear_sede() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Sede',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
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
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Campus',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_CAMPUS, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * una cancha en el sistema.
    **/
    public function crear_cancha() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Cancha',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_CANCHA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * un corredor en el sistema.
    **/
    public function crear_corredor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Corredor',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_CORREDOR, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * una cubierta en el sistema.
    **/
    public function crear_cubierta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Cubierta',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_CUBIERTA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * las gradas en el sistema.
    **/
    public function crear_gradas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Gradas',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_GRADAS, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * una cancha en el sistema.
    **/
    public function crear_parqueadero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Parqueadero',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_PARQUEADERO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * una piscina en el sistema.
    **/
    public function crear_piscina() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Piscina',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_PISCINA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * una plazoleta en el sistema.
    **/
    public function crear_plazoleta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Plazoleta',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_PLAZOLETA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * un sendero en el sistema.
    **/
    public function crear_sendero() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Sendero Peatonal',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_SENDERO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * una via en el sistema.
    **/
    public function crear_via() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Vía',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_VIA, $data);
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
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Edificio',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
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
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Espacio',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
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
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Tipo Material',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
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
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Tipo Objeto',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_planta"],"true") == 0 || strcmp($_SESSION["creacion_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CREACION, OPERATION_CREAR_TIPO_OBJETO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * un aire acondicionado en el sistema.
    **/
    public function crear_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Aire Acondicionado',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0 || strcmp($_SESSION["creacion_aires"],"true") == 0) {
            $v->retornar_vista(MOD_AIRES, CREACION, OPERATION_CREAR_AIRE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * una capacidad de aires acondicionados en el sistema.
    **/
    public function crear_capacidad_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Capacidad de Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0 || strcmp($_SESSION["creacion_aires"],"true") == 0) {
            $v->retornar_vista(MOD_AIRES, CREACION, OPERATION_CREAR_CAPACIDAD_AIRE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * una marca de airea acondicionados en el sistema.
    **/
    public function crear_marca_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Marca de Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0 || strcmp($_SESSION["creacion_aires"],"true") == 0) {
            $v->retornar_vista(MOD_AIRES, CREACION, OPERATION_CREAR_MARCA_AIRE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * una tecnología de aires acondicionados en el sistema.
    **/
    public function crear_tecnologia_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Tecnología de Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0 || strcmp($_SESSION["creacion_aires"],"true") == 0) {
            $v->retornar_vista(MOD_AIRES, CREACION, OPERATION_CREAR_TECNOLOGIA_AIRE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear
     * un tipo de aires acondicionados en el sistema.
    **/
    public function crear_tipo_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Tipo de Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0 || strcmp($_SESSION["creacion_aires"],"true") == 0) {
            $v->retornar_vista(MOD_AIRES, CREACION, OPERATION_CREAR_TIPO_AIRE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite registrar un mantenimiento
	 * realizado a un aire acondicionado que esté registrado en el sistema.
    **/
    public function registrar_mantenimiento_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Registrar Mantenimiento Aire Acondicionado',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0 || strcmp($_SESSION["creacion_aires"],"true") == 0) {
            $v->retornar_vista(MOD_AIRES, CREACION, OPERATION_REGISTRAR_MANTENIMIENTO_AIRE, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear un artículo en el sistema.
    **/
    public function crear_articulo() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Artículo',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0 || strcmp($_SESSION["creacion_inventario"],"true") == 0) {
            $v->retornar_vista(MOD_INVENTARIO, CREACION, OPERATION_CREAR_ARTICULO, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear una marca en el sistema.
    **/
    public function crear_marca() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Marca',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0 || strcmp($_SESSION["creacion_inventario"],"true") == 0) {
            $v->retornar_vista(MOD_INVENTARIO, CREACION, OPERATION_CREAR_MARCA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

	/**
     * Función que despliega el panel que permite crear un proveedor en el sistema.
    **/
    public function crear_proveedor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $data = array(
            'mensaje' => 'Crear Proveedor',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0 || strcmp($_SESSION["creacion_inventario"],"true") == 0) {
            $v->retornar_vista(MOD_INVENTARIO, CREACION, OPERATION_CREAR_PROVEEDOR, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
      * Funcion que permite guardar una sede en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_sede(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarSede($info['nombre_sede']);
            if($verificar){
                $m->guardarSede($info['nombre_sede']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar un campus en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_campus(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarCampus($info['nombre_sede'],$info['nombre_campus']);
            if($verificar){
                $m->guardarCampus($info['nombre_sede'],$info['nombre_campus'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar un edificio en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_edificio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarEdificio($info['nombre_sede'],$info['nombre_campus'],$info['id_edificio']);
            if($verificar){
                $m->guardarEdificio($info['nombre_sede'],$info['nombre_campus'],$info['id_edificio'],$info['nombre_edificio'],$info['numero_pisos'],$info['terraza'],$info['sotano'],$info['material_fachada'],$info['alto_fachada'],$info['ancho_fachada'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar una cancha en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_cancha(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarCancha($info['nombre_sede'],$info['nombre_campus'],$info['id_cancha']);
            if($verificar){
                $m->guardarCancha($info['nombre_sede'],$info['nombre_campus'],$info['id_cancha'],$info['uso_cancha'],$info['material_piso'],$info['tipo_pintura'],$info['longitud_demarcacion'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar un corredor en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_corredor(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarCorredor($info['nombre_sede'],$info['nombre_campus'],$info['id_corredor']);
            if($verificar){
                $m->guardarCorredor($info['nombre_sede'],$info['nombre_campus'],$info['id_corredor'],$info['ancho_pared'],$info['alto_pared'],$info['material_pared'],$info['ancho_piso'],$info['largo_piso'],$info['material_piso'],$info['ancho_techo'],$info['largo_techo'],$info['material_techo'],$info['tomacorriente'],$info['tipo_suministro_energia'],$info['cantidad_tomacorrientes'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['tipo_interruptor'],$info['cantidad_interruptores'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar una cubierta en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_cubierta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarCubierta($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['pisos']);
            if($verificar){
                $m->guardarCubierta($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['pisos'],$info['tipo_cubierta'],$info['material_cubierta'],$info['ancho'],$info['largo'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar unas gradas en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_gradas(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarGradas($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['piso_inicio']);
            if($verificar){
                $m->guardarGradas($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['piso_inicio'],$info['pasamanos'],$info['material_pasamanos'],$info['ventana'],$info['tipo_ventana'],$info['cantidad_ventanas'],$info['material_ventana'],$info['ancho_ventana'],$info['alto_ventana']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar un parqueadero en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_parqueadero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarParqueadero($info['nombre_sede'],$info['nombre_campus'],$info['id_parqueadero']);
            if($verificar){
                $m->guardarParqueadero($info['nombre_sede'],$info['nombre_campus'],$info['id_parqueadero'],$info['capacidad'],$info['ancho'],$info['largo'],$info['material_piso'],$info['tipo_pintura'],$info['longitud_demarcacion'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar una piscina en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_piscina(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarPiscina($info['nombre_sede'],$info['nombre_campus'],$info['id_piscina']);
            if($verificar){
                $m->guardarPiscina($info['nombre_sede'],$info['nombre_campus'],$info['id_piscina'],$info['alto'],$info['ancho'],$info['largo'],$info['cantidad_puntos_hidraulicos'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar una plazoleta en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_plazoleta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarPlazoleta($info['nombre_sede'],$info['nombre_campus'],$info['id_plazoleta']);
            if($verificar){
                $m->guardarPlazoleta($info['nombre_sede'],$info['nombre_campus'],$info['id_plazoleta'],$info['nombre'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar un sendero en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_sendero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarSendero($info['nombre_sede'],$info['nombre_campus'],$info['id_sendero']);
            if($verificar){
                $m->guardarSendero($info['nombre_sede'],$info['nombre_campus'],$info['id_sendero'],$info['longitud'],$info['ancho'],$info['material_piso'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['codigo_poste'],$info['ancho_cubierta'],$info['largo_cubierta'],$info['material_cubierta'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar una vía en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_via(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarVia($info['nombre_sede'],$info['nombre_campus'],$info['id_via']);
            if($verificar){
                $m->guardarVia($info['nombre_sede'],$info['nombre_campus'],$info['id_via'],$info['tipo_pintura'],$info['longitud_demarcacion'],$info['material_piso'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar un espacio en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_espacio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            for ($i=0;$i<count($info['numero_espacio']);$i++) {
                $verificar = $m->verificarEspacio($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['numero_espacio'][$i]);
                if($verificar){
                    $m->guardarEspacio($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['piso'],$info['numero_espacio'][$i],$info['uso_espacio'],
                        $info['altura_pared'],$info['ancho_pared'],$info['material_pared'],$info['largo_techo'],$info['ancho_techo'],$info['material_techo'],
                        $info['largo_piso'],$info['ancho_piso'],$info['material_piso'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['tipo_suministro_energia'],
                        $info['tomacorriente'],$info['cantidad_tomacorrientes'],$info['tipo_puerta'],$info['cantidad_puertas'],$info['material_puerta'],$info['tipo_cerradura'],
                        $info['gato_puerta'],$info['material_marco'],$info['ancho_puerta'],$info['alto_puerta'],$info['tipo_ventana'],$info['cantidad_ventanas'],
                        $info['material_ventana'],$info['ancho_ventana'],$info['alto_ventana'],$info['tipo_interruptor'],$info['cantidad_interruptores'],
                        $info['numero_espacio_padre']);
                    if (strcasecmp($info['uso_espacio'],'1') == 0) { //Salón
                        $m->guardarSalon($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
                    }else if (strcasecmp($info['uso_espacio'],'2') == 0) { //Auditorio
                        $m->guardarAuditorio($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
                    }else if (strcasecmp($info['uso_espacio'],'3') == 0) { //Laboratorio
                        $m->guardarLaboratorio($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam'],$info['cantidad_puntos_hidraulicos'],$info['tipo_punto_sanitario'],$info['cantidad_puntos_sanitarios']);
                    }else if (strcasecmp($info['uso_espacio'],'4') == 0) { //Sala de Cómputo
                        $m->guardarSalaComputo($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
                    }else if (strcasecmp($info['uso_espacio'],'5') == 0) { //Oficina
                        $m->guardarOficina($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['punto_videobeam']);
                    }else if (strcasecmp($info['uso_espacio'],'6') == 0) { //Baño
                        $m->guardarBano($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['tipo_inodoro'],$info['cantidad_inodoro'],$info['tipo_orinal'],$info['cantidad_orinal'],$info['tipo_lavamanos'],$info['cantidad_lavamanos'],$info['ducha'],$info['lavatraperos'],$info['cantidad_sifones'],$info['tipo_divisiones'],$info['material_divisiones']);
                    }else if (strcasecmp($info['uso_espacio'],'7') == 0) { //Cuarto Técnico
                        $m->guardarCuartoTecnico($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['punto_videobeam']);
                    }else if (strcasecmp($info['uso_espacio'],'8') == 0) { //Bodega/Almacen
                        $m->guardarBodega($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red']);
                    }else if (strcasecmp($info['uso_espacio'],'10') == 0) { //Cuarto de Plantas
                        $m->guardarCuartoPlantas($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red']);
                    }else if (strcasecmp($info['uso_espacio'],'11') == 0) { //Cuarto de Aires Acondicionados
                        $m->guardarCuartoAireAcondicionado($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red']);
                    }else if (strcasecmp($info['uso_espacio'],'12') == 0) { //Área Deportiva Cerrada
                        $m->guardarAreaDeportivaCerrada($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red']);
                    }else if (strcasecmp($info['uso_espacio'],'14') == 0) { //Centro de Datos/Teléfono
                        $m->guardarCentroDatos($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red']);
                    }else if (strcasecmp($info['uso_espacio'],'17') == 0) { //Cuarto de Bombas
                        $m->guardarCuartoBombas($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_hidraulicos'],$info['tipo_punto_sanitario'],$info['cantidad_puntos_sanitarios']);
                    }else if (strcasecmp($info['uso_espacio'],'19') == 0) { //Cocineta
                        $m->guardarCocineta($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_hidraulicos'],$info['tipo_punto_sanitario'],$info['cantidad_puntos_sanitarios']);
                    }else if (strcasecmp($info['uso_espacio'],'20') == 0) { //Sala de Estudio
                        $m->guardarSalaEstudio($info['numero_espacio'][$i],$info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red']);
                    }
                }
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar un tipo de material en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_tipo_material(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarTipoMaterial($info['tipo_material'],$info['nombre_tipo_material']);
            if($verificar){
                $m->guardarTipoMaterial($info['tipo_material'],$info['nombre_tipo_material']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar un tipo de material en el sistema
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_tipo_objeto(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarTipoObjeto($info['tipo_objeto'],$info['nombre_tipo_objeto']);
            if($verificar){
                $m->guardarTipoObjeto($info['tipo_objeto'],$info['nombre_tipo_objeto']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite verificar si un espacio se encuentra registrado en el sistema.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function verificar_espacio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarEspacio($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['numero_espacio']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_campus(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCampus = json_decode($_POST['campus'], true);
            for ($i=0; $i < count($info); $i++) {
                $idCampus = "";
                $file = $info['archivo'.$i];
                $data = $m->obtenerIdCampus($infoCampus['nombre_sede'],$infoCampus['nombre_campus']);
                foreach ($data as $clave => $valor) {
                 	$idCampus = $valor['id'];
                }
                $verificar = $m->guardarPlanoCampus($infoCampus['nombre_sede'],$idCampus,$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_campus(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCampus = json_decode($_POST['campus'], true);
            for ($i=0; $i < count($info); $i++) {
                $idCampus = "";
                $file = $info['archivo'.$i];
                $data = $m->obtenerIdCampus($infoCampus['nombre_sede'],$infoCampus['nombre_campus']);
                foreach ($data as $clave => $valor) {
                    $idCampus = $valor['id'];
                }
                $verificar = $m->guardarFotoCampus($infoCampus['nombre_sede'],$idCampus,$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_edificio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoEdificio = json_decode($_POST['edificio'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoEdificio($infoEdificio['nombre_sede'],$infoEdificio['nombre_campus'],$infoEdificio['id_edificio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_edificio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoEdificio = json_decode($_POST['edificio'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoEdificio($infoEdificio['nombre_sede'],$infoEdificio['nombre_campus'],$infoEdificio['id_edificio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_cancha(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCancha = json_decode($_POST['cancha'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoCancha($infoCancha['nombre_sede'],$infoCancha['nombre_campus'],$infoCancha['id_cancha'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_cancha(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCancha = json_decode($_POST['cancha'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoCancha($infoCancha['nombre_sede'],$infoCancha['nombre_campus'],$infoCancha['id_cancha'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_corredor(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCorredor = json_decode($_POST['corredor'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoCorredor($infoCorredor['nombre_sede'],$infoCorredor['nombre_campus'],$infoCorredor['id_corredor'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_corredor(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCorredor = json_decode($_POST['corredor'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoCorredor($infoCorredor['nombre_sede'],$infoCorredor['nombre_campus'],$infoCorredor['id_corredor'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_cubierta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCubierta = json_decode($_POST['cubierta'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoCubierta($infoCubierta['nombre_sede'],$infoCubierta['nombre_campus'],$infoCubierta['nombre_edificio'],$infoCubierta['piso'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_cubierta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoCubierta = json_decode($_POST['cubierta'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoCubierta($infoCubierta['nombre_sede'],$infoCubierta['nombre_campus'],$infoCubierta['nombre_edificio'],$infoCubierta['piso'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_gradas(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoGradas = json_decode($_POST['gradas'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoGradas($infoGradas['nombre_sede'],$infoGradas['nombre_campus'],$infoGradas['nombre_edificio'],$infoGradas['piso_inicio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_gradas(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoGradas = json_decode($_POST['gradas'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoGradas($infoGradas['nombre_sede'],$infoGradas['nombre_campus'],$infoGradas['nombre_edificio'],$infoGradas['piso_inicio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_parqueadero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoParqueadero = json_decode($_POST['parqueadero'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoParqueadero($infoParqueadero['nombre_sede'],$infoParqueadero['nombre_campus'],$infoParqueadero['id_parqueadero'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_parqueadero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoParqueadero = json_decode($_POST['parqueadero'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoParqueadero($infoParqueadero['nombre_sede'],$infoParqueadero['nombre_campus'],$infoParqueadero['id_parqueadero'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_piscina(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoPiscina = json_decode($_POST['piscina'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoPiscina($infoPiscina['nombre_sede'],$infoPiscina['nombre_campus'],$infoPiscina['id_piscina'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_piscina(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoPiscina = json_decode($_POST['piscina'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoPiscina($infoPiscina['nombre_sede'],$infoPiscina['nombre_campus'],$infoPiscina['id_piscina'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_plazoleta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();

        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoPlazoleta = json_decode($_POST['plazoleta'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoPlazoleta($infoPlazoleta['nombre_sede'],$infoPlazoleta['nombre_campus'],$infoPlazoleta['id_plazoleta'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_plazoleta(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoPlazoleta = json_decode($_POST['plazoleta'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoPlazoleta($infoPlazoleta['nombre_sede'],$infoPlazoleta['nombre_campus'],$infoPlazoleta['id_plazoleta'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_sendero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoSendero = json_decode($_POST['sendero'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoSendero($infoSendero['nombre_sede'],$infoSendero['nombre_campus'],$infoSendero['id_sendero'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_sendero(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoSendero = json_decode($_POST['sendero'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoSendero($infoSendero['nombre_sede'],$infoSendero['nombre_campus'],$infoSendero['id_sendero'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_via(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoVia = json_decode($_POST['via'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoVia($infoVia['nombre_sede'],$infoVia['nombre_campus'],$infoVia['id_via'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_via(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoVia = json_decode($_POST['via'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoVia($infoVia['nombre_sede'],$infoVia['nombre_campus'],$infoVia['id_via'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar los planos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_planos_espacio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoEspacio = json_decode($_POST['espacio'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoEspacio($infoEspacio['nombre_sede'],$infoEspacio['nombre_campus'],$infoEspacio['nombre_edificio'],$infoEspacio['id_espacio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

    /**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_espacio(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoEspacio = json_decode($_POST['espacio'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoEspacio($infoEspacio['nombre_sede'],$infoEspacio['nombre_campus'],$infoEspacio['nombre_edificio'],$infoEspacio['id_espacio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear un aire acondicionado.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_aire_acondicionado(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarAire($info['numero_inventario']);
            if($verificar){
                $verificar = $m->guardarAire($info['numero_inventario'],$info['sede'],$info['campus'],$info['edificio'],$info['espacio'],$info['capacidad'],$info['marca'],$info['tipo'],$info['tecnologia_aire'],$info['fecha_instalacion'],$info['instalador'],$info['periodicidad_mantenimiento'],$info['ubicacion_condensadora']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_aire(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoAire = json_decode($_POST['aire'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoAire($infoAire['id_aire'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear una capacidad de un aire acondicionado.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_capacidad_aire(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarCapacidadAire($info['capacidad']);
            if($verificar){
                $m->guardarCapacidadAire($info['capacidad']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear una marca de un aire acondicionado.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_marca_aire(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarMarcaAire($info['nombre']);
            if($verificar){
                $m->guardarMarcaAire($info['nombre']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear un tipo de un aire acondicionado.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_tipo_aire(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarTipoObjeto("tipo_aire",$info['tipo']);
            if($verificar){
                $m->guardarTipoAire($info['tipo']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear una tecnología de un aire acondicionado.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_tecnologia_aire(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarTipoObjeto("tipo_tecnologia_aire",$info['tipo']);
            if($verificar){
                $m->guardarTipoTecnologiaAire($info['tipo']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite registrar un mantenimiento a un aire acondicionado.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_mantenimiento_aire(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
		$n = new modelo_creacion(Config::$mvc_bd_ordenes_mantenimiento, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarIdAire($info['id_aire']);
			$verificarOrden = $n->verificarOrdenMantenimiento($info['numero_orden']);
			$verificarAireOrden = $m->verificarMantenimientoAire($info['id_aire'],$info['numero_orden']);
            if($verificar && $verificarOrden && $verificarAireOrden){
                $verificar = $m->guardarMantenimientoAire($info['id_aire'],$info['numero_orden'],$info['fecha_realizacion'],$info['realizado'],$info['revisado'],$info['descripcion']);
            }elseif(!$verificar){
				$GLOBALS['mensaje'] = "ERROR. El aire con id ".$info['id_aire']." no se encuentra registrado en el sistema";
				$verificar = false;
			}elseif(!$verificarOrden){
				$GLOBALS['mensaje'] = "ERROR. La solicitud de mantenimiento número ".$info['numero_orden']." no se encuentra registrada en el sistema";
				$verificar = false;
			}elseif(!$verificarAireOrden){
				$GLOBALS['mensaje'] = "ERROR. La solicitud de mantenimiento con número ".$info['numero_orden']." del aire con id ".$info['id_aire']." ya se encuentra registrada en el sistema";
				$verificar = false;
			}
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
	 * Funcion que permite verificar si una capacidad de aires acondicionados ya existe en el sistema.
	 * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
	**/
	public function verificar_capacidad_aire(){
		$GLOBALS['mensaje'] = "";
		$GLOBALS['sql'] = "";
		$result = array();
		$m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
		Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$info = json_decode($_POST['jObject'], true);
			$verificar = $m->verificarCapacidadAire($info['capacidad']);
		}
		$result['mensaje'] = $GLOBALS['mensaje'];
		$result['sql'] = $GLOBALS['sql'];
		$result['verificar'] = $verificar;
		echo json_encode($result);
	}

	/**
	 * Funcion que permite verificar si una marca de aires acondicionados ya existe en el sistema.
	 * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
	**/
	public function verificar_marca_aire(){
		$GLOBALS['mensaje'] = "";
		$GLOBALS['sql'] = "";
		$result = array();
		$m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
		Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$info = json_decode($_POST['jObject'], true);
			$verificar = $m->verificarMarcaAire($info['nombre']);
		}
		$result['mensaje'] = $GLOBALS['mensaje'];
		$result['sql'] = $GLOBALS['sql'];
		$result['verificar'] = $verificar;
		echo json_encode($result);
	}

	/**
	 * Funcion que permite verificar si un tipo de aires acondicionados ya existe en el sistema.
	 * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
	**/
	public function verificar_tipo_aire(){
		$GLOBALS['mensaje'] = "";
		$GLOBALS['sql'] = "";
		$result = array();
		$m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
		Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$info = json_decode($_POST['jObject'], true);
			$verificar = $m->verificarTipoObjeto("tipo_aire",$info['nombre']);
		}
		$result['mensaje'] = $GLOBALS['mensaje'];
		$result['sql'] = $GLOBALS['sql'];
		$result['verificar'] = $verificar;
		echo json_encode($result);
	}

	/**
	 * Funcion que permite verificar si un tipo de tecnología de aires acondicionados ya existe en el sistema.
	 * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
	**/
	public function verificar_tecnologia_aire(){
		$GLOBALS['mensaje'] = "";
		$GLOBALS['sql'] = "";
		$result = array();
		$m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
		Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$info = json_decode($_POST['jObject'], true);
			$verificar = $m->verificarTipoObjeto("tipo_tecnologia_aire",$info['nombre']);
		}
		$result['mensaje'] = $GLOBALS['mensaje'];
		$result['sql'] = $GLOBALS['sql'];
		$result['verificar'] = $verificar;
		echo json_encode($result);
	}

	/**
      * Funcion que permite crear una marca del módulo de inventario.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_marca_inventario(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarMarcaInventario($info['nombre']);
            if($verificar){
                $m->guardarMarcaInventario($info['nombre']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear un proveedor.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_proveedor(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarProveedor($info['nombre']);
            if($verificar){
                $m->guardarProveedor($info['nombre'],$info['direccion'],$info['telefono'],$info['nit']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite crear un artículo.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_articulo(){
		$GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarArticulo($info['nombre_articulo'],$info['marca']);
            if($verificar){
                $verificar = $m->guardarArticulo($info['nombre_articulo'],$info['marca'],$info['cantidad_minima']);
				while (list($clave, $valor) = each($verificar)){
	                $id_articulo = $valor['id_articulo'];
	            }
				$proveedor = $info['proveedor'];
				for ($i=0;$i<count($proveedor);$i++) {
                    $m->guardarArticuloProveedor($id_articulo,$proveedor[$i]);
                }
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

	/**
      * Funcion que permite guardar las fotos que el usuario seleccione.
      * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
    **/
    public function guardar_fotos_articulo(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoArticulo = json_decode($_POST['articulo'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoArticulo($infoArticulo['id_articulo'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['sql'] = $GLOBALS['sql'];
                $result['verificar'][$i] = $verificar;
            }
        }
        echo json_encode($result);
    }
}
?>
