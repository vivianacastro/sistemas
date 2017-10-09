<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase controlador_usuario
 */
class controlador_usuario {

    /**
      * Función que despliega el panel que permite crear
     * un usuario en el sistema.
    **/
    public function crear_usuario() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Crear Usuario',
        );
        $v = new controlador_vista();
        $v->retornar_vista(MOD_USUARIO, USUARIO, CREAR_USUARIO, $data);
    }

    /**
     * Función que despliega el panel que permite crear
     * un usuario en el sistema.
    **/
    public function crear_usuario_admin() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Crear Usuario',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["perfil"],"admin") == 0) {
            $v->retornar_vista(MOD_USUARIOS, USUARIO, CREAR_USUARIO_ADMIN, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite recuperar la contraseña de un usuario
    **/
    public function olvido_contrasenia() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Reestablecer Contraseña',
        );
        $v = new controlador_vista();
        $v->retornar_vista(MOD_USUARIO, USUARIO, OLVIDO_CONTRASENIA, $data);
    }

    /**
     * Función que despliega el panel que permite crear
     * un usuario en el sistema.
    **/
    public function listar_usuarios_admin() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Listar Usuarios',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["perfil"],"admin") == 0) {
            $v->retornar_vista(MOD_USUARIOS, USUARIO, LISTAR_USUARIOS_ADMIN, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite crear
     * un usuario en el sistema.
    **/
    public function informacion_usuario() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Información de Usuario',
        );
        $v = new controlador_vista();
        $v->retornar_vista(MOD_USUARIO, USUARIO, INFORMACION_USUARIO, $data);
    }

    /**
     * Función que despliega el panel que permite crear
     * un usuario en el sistema.
    **/
    public function modificar_informacion_usuario() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Modificar Información de Usuario',
        );
        $v = new controlador_vista();
        $v->retornar_vista(MOD_USUARIO, USUARIO, MODIFICAR_INFORMACION_USUARIO, $data);
    }

    /**
     * Función que despliega el panel que permite crear
     * un usuario en el sistema.
    **/
    public function cambiar_contrasenia() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Cambiar Contraseña',
        );
        $v = new controlador_vista();
        $v->retornar_vista(MOD_USUARIO, USUARIO, CAMBIAR_CONTRASENIA, $data);
    }

    /**
      * Función que permite iniciar una sesion por un usuario, ademas esta
      * función se encarga de desplegar el panel de logeo o el mostrar la pagina
      * de inicio de la aplicación web.
    **/
    public function iniciar_sesion() {
        //session_start();  //Comentado
        //instanciar el objeto de la clase Modelo
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        $v = new Controlador_vista();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($infoResult = $m->comprobarAcceso($_POST['login'], $_POST['password'])){
                if (session_status() == PHP_SESSION_NONE) { //Añadido
                    session_start();
                }
                $_SESSION["autorizado"] = true;
                session_regenerate_id();
                $_SESSION["userid"] = session_id();
                $_SESSION["login"] = $infoResult["login"];
                $_SESSION["perfil_sistemas"] = $infoResult["perfil"];
                $_SESSION["correo_sistemas"] = $infoResult["correo"];
                $_SESSION["telefono_sistemas"] = $infoResult["telefono"];
                $_SESSION["extension_sistemas"] = $infoResult["extension"];
                $_SESSION["nombre_usuario_sistemas"] = ucwords($infoResult["nombre_usuario"]);
                $_SESSION["modulo_planta"] = $infoResult["modulo_planta"];
                $_SESSION["modulo_inventario"] = $infoResult["modulo_inventario"];
                $_SESSION["modulo_aires"] = $infoResult["modulo_aires"];
                $_SESSION["creacion_planta"] = $infoResult["creacion_planta"];
                $_SESSION["creacion_inventario"] = $infoResult["creacion_inventario"];
                $_SESSION["creacion_aires"] = $infoResult["creacion_aires"];
                $_SESSION["id_db_user"] = $infoResult["id"];
                $_SESSION["ultimoAcceso"] = time();
                $data = array(
                    'mensaje' => 'Bienvenido/a al sistema '. $_SESSION["nombre_usuario"],
                );
                $m->actualizarUltimoAcceso($_SESSION["login"]);
                $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
            }else{
                $data = array(
                    'mensaje' => 'Intentelo de nuevo. Puede que haya '
                    . 'escrito mal su usuario o contraseña'
                );
                $v->retornar_vista(MENU_PRINCIPAL, USUARIO, INICIAR_SESION, $data);
            }
        }else{
            if(isset($_SESSION['userid']) && isset($_SESSION['autorizado']) && isset($_SESSION['perfil']) && isset($_SESSION["modulo_planta"])) {
                $data = array(
                    'mensaje' => 'Bienvenido/a al sistema '. $_SESSION["nombre_usuario"],
                );
                $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
            }else {
                $this->cerrar_sesion();
            }
        }
    }

    /**
      * Función que permite cerrar una sesion de un usuario.
    **/
    public function cerrar_sesion() {
        //session_start(); //Comentado
        //eliminar informacion almacenada de la sesion
        session_unset();
        //finalizar sesion
        session_destroy ();
        $data = array(
            'mensaje' => 'Bienvenido  '. date('d-m-y  h:i A'),
        );
        $v = new Controlador_vista();
        $v->retornar_vista(MENU_PRINCIPAL, USUARIO, INICIAR_SESION, $data);
    }

    /**
      * Función que permite crear un usuario en el sistema
    **/
    public function guardar_usuario() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarUsuario($info['login']);
            if($verificar){
                $m->guardarUsuario($info['nombre'],$info['login'],$info['correo'],$info['telefono'],$info['extension'],$info['contrasenia'],$info['mod_planta'],$info['mod_inventario'],
                    $info['mod_aires'],$info['creacion_planta'],$info['creacion_inventario'],$info['creacion_aires'],$info['perfil']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite guardar las modificaciones a la información de un usuario.
    **/
    public function guardar_modificaciones_usuario() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->guardarModificacionesUsuario($info['login'],$info['nombre_usuario'],$info['correo'],$info['telefono'],$info['extension'],$info['crear_planta'],$info['crear_aire'],$info['crear_inventario'],$info['perfil'],$info['estado']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite desactivar un usuario.
    **/
    public function desactivar_usuario() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->desactivarUsuario($info['login']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite crear un usuario en el sistema
    **/
    public function listar_usuarios() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->listarUsuarios();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'nombre' => mb_convert_case($valor['nombre_usuario'],MB_CASE_TITLE,"UTF-8"),
                    'login' => $valor['login'],
                    'telefono' => $valor['telefono'],
                    'extension' => $valor['extension'],
                    'correo' => $valor['correo'],
                    'creacion_planta' => $valor['creacion_planta'],
                    'creacion_aire' => $valor['creacion_aires'],
                    'creacion_inventario' => $valor['creacion_inventario'],
                    'perfil' => $valor['perfil'],
                    'estado' => mb_convert_case($valor['estado'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($result);
    }

    /**
      * Función que permite modificar la información de un usuario
    **/
    public function modificar_usuario() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = !$m->verificarUsuario($info['login']);
            if($verificar){
                $m->modificarUsuario($info['nombre'],$info['login'],$info['correo'],$info['telefono'],$info['extension']);
                if($m){
                    $_SESSION["nombre_usuario"] = ucwords($info["nombre"]);
                    $_SESSION["correo"] = $info["correo"];
                    $_SESSION["telefono"] = $info["telefono"];
                    $_SESSION["extension"] = $info["extension"];
                }
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite modificar la contraseña de un usuario
    **/
    public function modificar_contrasenia() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarContrasena($_SESSION['login'],$info['contrasenia_actual']);
            if ($verificar) {
                $verificar = $m->modificarContrasenia($_SESSION['login'],$info['contrasenia_nueva']);
            }else{
                $GLOBALS['mensaje'] = "ERROR. Contraseña incorrecta";
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite reestablecer la contraseña de un usuario
    **/
    public function reestablecer_contrasenia() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = !$m->verificarCorreo($info['correo']);
            if($verificar){
                $m->reestablecerContrasenia($info['correo']);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite verificar si un login ya esta asignado
    **/
    public function verificar_usuario() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $verificar = $m->verificarUsuario($info['login']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite verificar si un correo ya esta registrado
    **/
    public function verificar_correo() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            /*if(strcmp(htmlspecialchars(trim($info['correo'])),$_SESSION["correo"]) != 0){
                $verificar = $m->verificarCorreo($info['correo']);
            }else{
                $verificar = true;
            }*/
            $verificar = $m->verificarCorreo($info['correo']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
      * Función que permite verificar si un correo ya esta registrado
    **/
    public function obtener_informacion_usuario() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result['login'] = $_SESSION["login"];
            $result['nombre_usuario'] = $_SESSION["nombre_usuario_sistemas"];
            $result['telefono'] = $_SESSION["telefono_sistemas"];
            $result['extension'] = $_SESSION["extension_sistemas"];
            $result['correo'] = $_SESSION["correo_sistemas"];
            /*$arrayAux = array(
                'login' => $_SESSION["login"],
                'nombre_usuario' => $_SESSION["nombre_usuario"],
                'telefono' => $_SESSION["telefono"],
                'extension' => $_SESSION["extension"],
                'correo' => $_SESSION["correo"],
                );
            array_push($result, $arrayAux);*/
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['verificar'] = true;
        echo json_encode($result);
    }

    /**
      * Función que permite obtener la información del usuario seleccionado en la tabla usuarios.
    **/
    public function obtener_informacion_usuario_seleccionado() {
        $GLOBALS['mensaje'] = "";
        $result = array();
        $m = new modelo_usuario(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->listarUsuario($info["usuario"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'nombre' => mb_convert_case($valor['nombre_usuario'],MB_CASE_TITLE,"UTF-8"),
                    'login' => $valor['login'],
                    'telefono' => $valor['telefono'],
                    'extension' => $valor['extension'],
                    'correo' => $valor['correo'],
                    'creacion_planta' => $valor['creacion_planta'],
                    'creacion_aire' => $valor['creacion_aires'],
                    'creacion_inventario' => $valor['creacion_inventario'],
                    'perfil' => $valor['perfil'],
                    'estado' => mb_convert_case($valor['estado'],MB_CASE_LOWER,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($result);
    }

    /**
      * Función que permite chekear si hay una sesion iniciada.
    **/
    public function check() {
        session_start();
        if(isset($_SESSION['userid'])) {
            $fechaGuardada = $_SESSION["ultimoAcceso"];
            $ahora = time();
            $tiempo_transcurrido = $ahora-$fechaGuardada;
            if($tiempo_transcurrido >= T_SEGUNDOS_INACTIVIDAD_PERMITIDO) {
                session_unset();
                session_destroy();
                return false;
            }else {
                $_SESSION["ultimoAcceso"] = $ahora;
                return true;
            }
        }
        return false;
    }
}
?>
