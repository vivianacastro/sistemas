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
            $verificar = $m->verificarSede($info['nombre_sede']);
            if($verificar){
                $m->guardarSede($info['nombre_sede']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar un campus en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_campus(){
        $GLOBALS['mensaje'] = "";
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
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarEdificio($info['nombre_sede'],$info['nombre_campus'],$info['id_edificio']);
            if($verificar){
                $m->guardarEdificio($info['nombre_sede'],$info['nombre_campus'],$info['id_edificio'],$info['nombre_edificio'],$info['numero_pisos'],$info['terraza'],$info['sotano'],$info['lat'],$info['lng']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar un espacio en el sistema
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_espacio(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarEspacio($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['piso'],$info['numero_espacio']);
            if($verificar){
                $m->guardarEspacio($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['piso'],$info['numero_espacio'],$info['uso_espacio'],
                    $info['altura_pared'],$info['ancho_pared'],$info['material_pared'],$info['largo_techo'],$info['ancho_techo'],$info['material_techo'],
                    $info['largo_piso'],$info['ancho_piso'],$info['material_piso'],$info['tipo_iluminacion'],$info['cantidad_iluminacion'],$info['tipo_suministro_energia'],
                    $info['tomacorriente'],$info['cantidad_tomacorrientes'],$info['tipo_puerta'],$info['cantidad_puertas'],$info['material_puerta'],$info['tipo_cerradura'],
                    $info['gato_puerta'],$info['material_marco'],$info['ancho_puerta'],$info['alto_puerta'],$info['tipo_ventana'],$info['cantidad_ventanas'],
                    $info['material_ventana'],$info['ancho_ventana'],$info['alto_ventana'],$info['tipo_interruptor'],$info['cantidad_interruptores'],
                    $info['numero_espacio_padre']);
                /*for ($i=0;$i<count($info['tipo_iluminacion']);$i++) {
                    $m->guardarIluminacion($info['numero_espacio'],$info['nombre_campus'],$info['nombre_edificio'],$info['tipo_iluminacion'][$i],$info['cantidad_iluminacion'][$i]);
                }
                for ($i=0;$i<count($info['tipo_interruptor']);$i++) {
                    $m->guardarInterruptores($info['numero_espacio'],$info['nombre_campus'],$info['nombre_edificio'],$info['tipo_interruptor'][$i],$info['cantidad_interruptores'][$i]);
                }
                for ($i=0;$i<count($info['tipo_puerta']);$i++) {
                    $m->guardarPuertas($info['numero_espacio'],$info['nombre_campus'],$info['nombre_edificio'],$info['tipo_puerta'][$i],$info['material_puerta'][$i],$info['cantidad_puertas'][$i],$info['material_marco'][$i],$info['ancho_puerta'][$i],$info['alto_puerta'][$i],$info['gato_puerta'][$i]);
                }
                for ($i=0;$i<count($info['tipo_suministro_energia']);$i++) {
                    $m->guardarSuministroEnergia($info['numero_espacio'],$info['nombre_campus'],$info['nombre_edificio'],$info['tipo_suministro_energia'][$i],$info['cantidad_tomacorrientes'][$i],$info['tomacorriente'][$i]);
                }
                for ($i=0;$i<count($info['tipo_ventana']);$i++) {
                    $m->guardarVentana($info['numero_espacio'],$info['nombre_campus'],$info['nombre_edificio'],$info['tipo_ventana'][$i],$info['cantidad_ventanas'][$i],$info['material_ventana'][$i],$info['ancho_ventana'][$i],$info['alto_ventana'][$i]);
                }*/
                if (strcasecmp($info['uso_espacio'],'1') == 0) { //Salón
                    $m->guardarSalon($info['numero_espacio'],$info['nombre_campus'],$info['nombre_edificio'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
                }else if (strcasecmp($uso_espacio,'2') == 0) { //Auditorio
                    
                }else if (strcasecmp($uso_espacio,'3') == 0) { //Laboratorio
                    
                }else if (strcasecmp($uso_espacio,'4') == 0) { //Sala de Cómputo
                    
                }else if (strcasecmp($uso_espacio,'5') == 0) { //Oficina

                }else if (strcasecmp($uso_espacio,'6') == 0) { //Baño
                    
                }else if (strcasecmp($uso_espacio,'7') == 0) { //Cuarto Técnico
                    
                }else if (strcasecmp($uso_espacio,'8') == 0) { //Bodega/Almacen
                    
                }else if (strcasecmp($uso_espacio,'10') == 0) { //Cuarto de Plantas
                    
                }else if (strcasecmp($uso_espacio,'11') == 0) { //Cuarto de Aires Acondicionados
                    
                }else if (strcasecmp($uso_espacio,'12') == 0) { //Área Deportiva Cerrada
                    
                }else if (strcasecmp($uso_espacio,'14') == 0) { //Centro de Datos/Teléfono
                    
                }else if (strcasecmp($uso_espacio,'17') == 0) { //Cuarto de Bombas
                    
                }else if (strcasecmp($uso_espacio,'19') == 0) { //Cocineta
                    
                }else if (strcasecmp($uso_espacio,'20') == 0) { //Sala de Estudio
                    
                }
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
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite verificar si un espacio se encuentra registrado en el sistema.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function verificar_espacio(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarEspacio($info['nombre_sede'],$info['nombre_campus'],$info['nombre_edificio'],$info['piso'],$info['numero_espacio']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar los planos que el usuario seleccione
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_planos_campus(){
        $GLOBALS['mensaje'] = "";
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
                $result['verificar'][$i] = $verificar;
            }
        }        
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar las fotos que el usuario seleccione
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_fotos_campus(){
        $GLOBALS['mensaje'] = "";
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
                $result['verificar'][$i] = $verificar;
            }
        }        
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar los planos que el usuario seleccione
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_planos_edificio(){
        $GLOBALS['mensaje'] = "";
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
                $result['verificar'][$i] = $verificar;
            }
        }        
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar las fotos que el usuario seleccione
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_fotos_edificio(){
        $GLOBALS['mensaje'] = "";
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
                $result['verificar'][$i] = $verificar;
            }
        }        
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar los planos que el usuario seleccione
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_planos_espacio(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoEspacio = json_decode($_POST['espacio'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarPlanoEspacio($infoEspacio['nombre_sede'],$infoEspacio['nombre_campus'],$infoEspacio['nombre_edificio'],$infoEspacio['piso'],$infoEspacio['id_espacio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['verificar'][$i] = $verificar;
            }
        }        
        echo json_encode($result);
    }

    /**
     * Funcion que permite guardar las fotos que el usuario seleccione
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
     */
    public function guardar_fotos_espacio(){
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = $_FILES;
            $infoEspacio = json_decode($_POST['espacio'], true);
            for ($i=0; $i < count($info); $i++) {
                $file = $info['archivo'.$i];
                $verificar = $m->guardarFotoEspacio($infoEspacio['nombre_sede'],$infoEspacio['nombre_campus'],$infoEspacio['id_edificio'],$infoEspacio['piso'],$infoEspacio['id_espacio'],$file);
                $result['mensaje'][$i] = $GLOBALS['mensaje'];
                $result['verificar'][$i] = $verificar;
            }
        }        
        echo json_encode($result);
    }
}
?>