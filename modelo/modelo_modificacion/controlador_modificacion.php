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
            $verificar = $m->modificarCorredor($info['id_sede'],$info['id_campus'],$info['id'],$info['ancho_pared'],$info['alto_pared'],$info['material_pared'],$info['ancho_piso'],$info['largo_piso'],$info['material_piso'],$info['ancho_techo'],$info['largo_techo'],$info['material_techo'],$info['tomacorriente'],$info['tipo_suministro_energia'],$info['cantidad_suministro_energia'],$info['tipo_iluminacion'],$info['tipo_iluminacion_anterior'],$info['cantidad_iluminacion'],$info['cantidad_iluminacion_anterior'],$info['tipo_interruptor'],$info['tipo_interruptor_anterior'],$info['cantidad_interruptor'],$info['cantidad_interruptor_anterior'],$info['lat'],$info['lng']);
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
            $verificar = $m->modificarGradas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['pasamanos'],$info['material_pasamanos'],$info['tipo_ventana'],$info['tipo_ventana_anterior'],$info['material_ventana'],$info['material_ventana_anterior'],$info['cantidad_ventana'],$info['cantidad_ventana_anterior'],$info['alto_ventana'],$info['alto_ventana_anterior'],$info['ancho_ventana'],$info['ancho_ventana_anterior']);
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
            $verificar = $m->modificarPlazoleta($info['id_sede'],$info['id_campus'],$info['id'],$info['nombre'],$info['tipo_iluminacion'],$info['tipo_iluminacion_anterior'],$info['cantidad_iluminacion'],$info['cantidad_iluminacion_anterior'],$info['lat'],$info['lng']);
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
            $verificar = $m->modificarVia($info['id_sede'],$info['id_campus'],$info['id'],$info['material_piso'],$info['tipo_pintura'],$info['longitud_demarcacion'],$info['lat'],$info['lng']);
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
            $verificar = $m->modificarEdificio($info['id_sede'],$info['id_campus'],$info['id'],$info['nombre'],$info['numero_pisos'],$info['sotano'],$info['terraza'],$info['material_fachada'],$info['ancho_fachada'],$info['alto_fachada'],$info['lat'],$info['lng']);
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
            $verificar = $m->modificarEspacio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['piso'],$info['id'],$info['uso_espacio'],$info['ancho_pared'],$info['alto_pared'],$info['material_pared'],$info['ancho_piso'],$info['largo_piso'],$info['material_piso'],$info['ancho_techo'],$info['largo_techo'],$info['material_techo'],$info['tiene_espacio_padre'],$info['espacio_padre'],$info['tipo_iluminacion'],$info['tipo_iluminacion_anterior'],$info['cantidad_iluminacion'],$info['cantidad_iluminacion_anterior'],$info['tipo_interruptor'],$info['tipo_interruptor_anterior'],$info['cantidad_interruptor'],$info['cantidad_interruptor_anterior'],$info['tipo_puerta'],$info['tipo_puerta_anterior'],$info['material_puerta'],$info['material_puerta_anterior'],$info['cantidad_puerta'],$info['cantidad_puerta_anterior'],$info['tipo_cerradura'],$info['tipo_cerradura_anterior'],$info['material_marco'],$info['material_marco_anterior'],$info['gato_puerta'],$info['ancho_puerta'],$info['ancho_puerta_anterior'],$info['alto_puerta'],$info['alto_puerta_anterior'],$info['tipo_suministro_energia'],$info['tipo_suministro_energia_anterior'],$info['tomacorriente'],$info['tomacorriente_anterior'],$info['cantidad_suministro_energia'],$info['cantidad_suministro_energia_anterior'],$info['tipo_ventana'],$info['tipo_ventana_anterior'],$info['cantidad_ventana'],$info['cantidad_ventana_anterior'],$info['material_ventana'],$info['material_ventana_anterior'],$info['ancho_ventana'],$info['ancho_ventana_anterior'],$info['alto_ventana'],$info['alto_ventana_anterior'],$info['tipo_iluminacion'],$info['tipo_iluminacion_anterior'],$info['cantidad_iluminacion'],$info['cantidad_iluminacion_anterior']);
            if (strcasecmp($info['uso_espacio'],'1') == 0) { //Salón
                $m->modificarSalon($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
            }else if (strcasecmp($info['uso_espacio'],'2') == 0) { //Auditorio
                $m->modificarAuditorio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
            }else if (strcasecmp($info['uso_espacio'],'3') == 0) { //Laboratorio
                $m->modificarLaboratorio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam'],$info['cantidad_puntos_hidraulicos'],$info['tipo_punto_sanitario'],$info['tipo_punto_sanitario_anterior'],$info['cantidad_puntos_sanitarios'],$info['cantidad_puntos_sanitarios_anterior']);
            }else if (strcasecmp($info['uso_espacio'],'4') == 0) { //Sala de Cómputo
                $m->modificarSalaComputo($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red'],$info['capacidad'],$info['punto_videobeam']);
            }else if (strcasecmp($info['uso_espacio'],'5') == 0) { //Oficina
                $m->modificarOficina($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red'],$info['punto_videobeam']);
            }else if (strcasecmp($info['uso_espacio'],'6') == 0) { //Baño
                $m->modificarBano($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['tipo_inodoro'],$info['cantidad_inodoro'],$info['tipo_orinal'],$info['tipo_orinal_anterior'],$info['cantidad_orinal'],$info['cantidad_orinal_anterior'],$info['tipo_lavamanos'],$info['tipo_lavamanos_anterior'],$info['cantidad_lavamanos'],$info['cantidad_lavamanos_anterior'],$info['ducha'],$info['lavatraperos'],$info['cantidad_sifones'],$info['tipo_divisiones'],$info['material_divisiones']);
            }else if (strcasecmp($info['uso_espacio'],'7') == 0) { //Cuarto Técnico
                $m->modificarCuartoTecnico($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red'],$info['punto_videobeam']);
            }else if (strcasecmp($info['uso_espacio'],'8') == 0) { //Bodega/Almacen
                $m->modificarBodega($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red']);
            }else if (strcasecmp($info['uso_espacio'],'10') == 0) { //Cuarto de Plantas
                $m->modificarCuartoPlantas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red']);
            }else if (strcasecmp($info['uso_espacio'],'11') == 0) { //Cuarto de Aires Acondicionados
                $m->modificarCuartoAireAcondicionado($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red']);
            }else if (strcasecmp($info['uso_espacio'],'12') == 0) { //Área Deportiva Cerrada
                $m->modificarAreaDeportivaCerrada($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red']);
            }else if (strcasecmp($info['uso_espacio'],'14') == 0) { //Centro de Datos/Teléfono
                $m->modificarCentroDatos($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red']);
            }else if (strcasecmp($info['uso_espacio'],'17') == 0) { //Cuarto de Bombas
                $m->modificarCuartoBombas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_hidraulicos'],$info['tipo_punto_sanitario'],$info['tipo_punto_sanitario_anterior'],$info['cantidad_puntos_sanitarios'],$info['cantidad_puntos_sanitarios_anterior']);
            }else if (strcasecmp($info['uso_espacio'],'19') == 0) { //Cocineta
                $m->modificarCocineta($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_hidraulicos'],$info['tipo_punto_sanitario'],$info['tipo_punto_sanitario_anterior'],$info['cantidad_puntos_sanitarios'],$info['cantidad_puntos_sanitarios_anterior']);
            }else if (strcasecmp($info['uso_espacio'],'20') == 0) { //Sala de Estudio
                $m->modificarSalaEstudio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id'],$info['cantidad_puntos_red']);
            }
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
            $verificar = $m->modificarTipoMaterial($info['tipo_material'],$info['nombre_anterior'],$info['nombre']);
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
            $verificar = $m->modificarTipoObjeto($info['tipo_objeto'],$info['nombre_anterior'],$info['nombre']);
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }


    /**
     * Funcion que permite eliminar la iluminación de un corredor.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function eliminar_iluminacion_corredor(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $eliminar = $info['iluminacion_eliminar'];
            for ($i=0; $i < count($eliminar); $i++) {
                $verificar = $m->eliminarIluminacionCorredor($info['nombre_sede'],$info['nombre_campus'],$info['id_cancha'],$eliminar[$i]);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }

    /**
     * Funcion que permite eliminar un interruptor de un corredor.
     * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado.
     */
    public function eliminar_interruptor_corredor(){
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $result = array();
        $m = new modelo_modificacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $info = json_decode($_POST['jObject'], true);
            $eliminar = $info['interruptor_eliminar'];
            for ($i=0; $i < count($eliminar); $i++) {
                $verificar = $m->eliminarInterruptorCorredor($info['nombre_sede'],$info['nombre_campus'],$info['id_cancha'],$eliminar[$i]);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        $result['verificar'] = $verificar;
        echo json_encode($result);
    }
}
?>
