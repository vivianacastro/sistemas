<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase controlador_consultas
 */
class controlador_consultas{

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
            if (strcmp($_SESSION["creacion_planta"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_CONSULTAR_MAPA, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_MAPA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * un aire acondicionado en el sistema.
    **/
    public function consultar_aire_ubicacion() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Aire Acondicionado por su Ubicación',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_AIRE_UBICACION, $data);
            }else{
                $v->retornar_vista(MOD_AIRES, CONSULTAS, OPERATION_CONSULTAR_AIRE_UBICACION, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * un aire acondicionado en el sistema.
    **/
    public function consultar_aire_numero_inventario() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Aire Acondicionado por su Número de Inventario',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_AIRE_NUMERO_INVENTARIO, $data);
            }else{
                $v->retornar_vista(MOD_AIRES, CONSULTAS, OPERATION_CONSULTAR_AIRE_NUMERO_INVENTARIO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * una capacidad de aire acondicionado en el sistema.
    **/
    public function consultar_capacidad_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Capacidad de Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_CAPACIDAD_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_AIRES, CONSULTAS, OPERATION_CONSULTAR_CAPACIDAD_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * una marca de aire acondicionado en el sistema.
    **/
    public function consultar_marca_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Marca Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_MARCA_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_AIRES, CONSULTAS, OPERATION_CONSULTAR_MARCA_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * un tipo de aire acondicionado en el sistema.
    **/
    public function consultar_tipo_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Tipo Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_TIPO_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_TIPO_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * una tecnología de aire acondicionado en el sistema.
    **/
    public function consultar_tecnologia_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Tecnología Aires Acondicionados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_TECNOLOGIA_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_TECNOLOGIA_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * un mantenimmiento de aire acondicionado en el sistema.
    **/
    public function consultar_mantenimiento_aire_id_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Mantenimiento Aire Acondicionado',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_MANTENIMIENTO_AIRE_ID_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_MANTENIMIENTO_AIRE_ID_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * un mantenimmiento de aire acondicionado en el sistema.
    **/
    public function consultar_mantenimiento_aire_numero_orden() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Mantenimiento Aire Acondicionado',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_AIRES, MODIFICACION, OPERATION_CONSULTAR_MANTENIMIENTO_AIRE_NUMERO_ORDEN, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_CONSULTAR_MANTENIMIENTO_AIRE_NUMERO_ORDEN, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de aires.
    **/
    public function mas_marcas_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Marcas de Aires Acondicionados Más Instaladas',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_MAS_MARCAS_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_MAS_MARCAS_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de aires.
    **/
    public function mas_tipos_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Tipos de Aires Acondicionados Más Instalados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_MAS_TIPOS_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_MAS_TIPOS_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de aires.
    **/
    public function mas_tipo_tecnologias_aire() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Tipos de Tecnología de Aires Acondicionados Más Instalados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_MAS_TIPO_TECNOLOGIAS_AIRE, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_MAS_TIPO_TECNOLOGIAS_AIRE, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de aires.
    **/
    public function aires_mas_mantenimientos() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Aires Acondicionados con Más Mantenimientos',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_AIRES_MAS_MANTENIMIENTOS, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_AIRES_MAS_MANTENIMIENTOS, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de aires.
    **/
    public function marcas_mas_mantenimientos() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Marcas de Aires Acondicionados con Más Mantenimientos',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_aires"],"true") == 0) {
            if (strcmp($_SESSION["creacion_aires"],"true") == 0) {
                $v->retornar_vista(MOD_PLANTA, MODIFICACION, OPERATION_MARCAS_MAS_MANTENIMIENTOS, $data);
            }else{
                $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_MARCAS_MAS_MANTENIMIENTOS, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite añadir uno o varios articulos al inventario.
    **/
    public function anadir_articulo() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Añadir Artículo',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_ANADIR_ARTICULO, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_ANADIR_ARTICULO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar un artículo.
    **/
    public function consultar_articulo() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Artículo',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_CONSULTAR_ARTICULO, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_CONSULTAR_ARTICULO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar una categoría de artículos.
    **/
    public function consultar_categoria() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Categoría Artículos',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_CONSULTAR_CATEGORIA, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_CONSULTAR_CATEGORIA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar una marca.
    **/
    public function consultar_marca() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Marca',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_CONSULTAR_MARCA, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_CONSULTAR_MARCA, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar un proveedor.
    **/
    public function consultar_proveedor() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Proveedor',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_CONSULTAR_PROVEEDOR, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_CONSULTAR_PROVEEDOR, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar el inventario de la bodega eléctrica.
    **/
    public function consultar_inventario_electrico() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Inventario Eléctrico',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_CONSULTAR_INVENTARIO_ELECTRICO, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_CONSULTAR_INVENTARIO_ELECTRICO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar el inventario de la bodega hidraulica.
    **/
    public function consultar_inventario_hidraulico() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Inventario Hidráulico',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_CONSULTAR_INVENTARIO_HIDRAULICO, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_CONSULTAR_INVENTARIO_HIDRAULICO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar el inventario de la bodega eléctrica.
    **/
    public function movimientos_inventario_electrico() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Movimientos Inventario Eléctrico',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_MOVIMIENTOS_INVENTARIO_ELECTRICO, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_MOVIMIENTOS_INVENTARIO_ELECTRICO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar el inventario de la bodega hidraulica.
    **/
    public function movimientos_inventario_hidraulico() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Movimientos Inventario Hidráulico',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_MOVIMIENTOS_INVENTARIO_HIDRAULICO, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_MOVIMIENTOS_INVENTARIO_HIDRAULICO, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar los artículos más usados.
    **/
    public function articulos_mas_usados() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Artículos Más Usados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_ARTICULOS_MAS_USADOS, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_ARTICULOS_MAS_USADOS, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que despliega el panel que permite consultar los artículos menos usados.
    **/
    public function articulos_menos_usados() {
        $GLOBALS['mensaje'] = "";
        $data = array(
            'mensaje' => 'Consultar Artículos Menos Usados',
        );
        $v = new controlador_vista();
        if (strcmp($_SESSION["modulo_inventario"],"true") == 0) {
            if (strcmp($_SESSION["creacion_inventario"],"true") == 0) {
                $v->retornar_vista(MOD_INVENTARIO, MODIFICACION, OPERATION_ARTICULOS_MENOS_USADOS, $data);
            }else{
                $v->retornar_vista(MOD_INVENTARIO, CONSULTAS, OPERATION_ARTICULOS_MENOS_USADOS, $data);
            }
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }

    /**
     * Función que permite consultar las sedes almacenadas en el sistema.
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
     * Función que permite consultar las capacidades de los aires aconidcionados.
    **/
    public function consultar_capacidades_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarCapacidadesAire();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'capacidad' => strval($valor['capacidad']),
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id'],
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
     * Función que permite consultar los aires acondicionados almacenados en el sistema.
    **/
    public function consultar_aires_ubicacion() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarAiresUbicacion($info["id_sede"],$info["id_campus"],$info["id_edificio"],$info["id_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_aire' => strval($valor['id_aire']),
                    'numero_inventario' => mb_convert_case($valor['numero_inventario'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'id_espacio' => $valor['id_espacio'],
                    'capacidad' => $valor['capacidad'],
                    'numero_capacidad' => mb_convert_case($valor['numero_capacidad'],MB_CASE_TITLE,"UTF-8"),
                    'marca' => $valor['marca'],
                    'marca_aire' => mb_convert_case($valor['marca_aire'],MB_CASE_TITLE,"UTF-8"),
                    'tipo' => $valor['tipo'],
                    'tipo_aire' => mb_convert_case($valor['tipo_aire'],MB_CASE_TITLE,"UTF-8"),
                    'tecnologia' => $valor['tecnologia'],
                    'tecnologia_aire' => mb_convert_case($valor['tecnologia_aire'],MB_CASE_TITLE,"UTF-8"),
                    'fecha_instalacion' => $valor['fecha_instalacion'],
                    'instalador' => $valor['instalador'],
                    'periodicidad_mantenimiento' => $valor['periodicidad_mantenimiento'],
                    'ubicacion_condensadora' => $valor['ubicacion_condensadora'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de los mantenimientos realizados a un aire acondicionado.
    **/
    public function consultar_mantenimientos_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMantenimientosAire($info["id_aire"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_aire' => $valor['id_aire'],
                    'numero_orden' => $valor['numero_orden'],
                    'fecha_realizacion' => substr($valor['fecha'],0,10),
                    'realizado' => mb_convert_case($valor['realizado'],MB_CASE_TITLE,"UTF-8"),
                    'revisado' => mb_convert_case($valor['revisado'],MB_CASE_TITLE,"UTF-8"),
                    'descripcion_trabajo' => ucfirst($valor['descripcion']),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las estadísticas del módulo de aires.
    **/
    public function consultar_marcas_mas_instaladas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMarcasMasInstaladas($info["id_sede"],$info["id_campus"],$info["id_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'conteo' => $valor['conteo'],
                    'marca' => mb_convert_case($valor['marca'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las estadísticas del módulo de aires.
    **/
    public function consultar_tipos_mas_instalados() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarTiposMasInstalados($info["id_sede"],$info["id_campus"],$info["id_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'conteo' => $valor['conteo'],
                    'tipo' => mb_convert_case($valor['tipo'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las estadísticas del módulo de aires.
    **/
    public function consultar_tipo_tecnologias_mas_instaladas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarTipoTecnologiasMasInstaladas($info["id_sede"],$info["id_campus"],$info["id_edificio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'conteo' => $valor['conteo'],
                    'tipo' => mb_convert_case($valor['tipo'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las estadísticas del módulo de aires.
    **/
    public function consultar_aires_mas_mantenimientos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarAiresMasMantenimientos($info["id_sede"],$info["id_campus"],$info["id_edificio"],$info["fecha_inicio"],$info["fecha_fin"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'conteo' => $valor['conteo'],
                    'id_aire' => mb_convert_case($valor['id_aire'],MB_CASE_TITLE,"UTF-8"),
                    'numero_inventario' => mb_convert_case($valor['numero_inventario'],MB_CASE_TITLE,"UTF-8"),
                    'marca' => mb_convert_case($valor['marca'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las estadísticas del módulo de aires.
    **/
    public function consultar_marcas_mas_mantenimientos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMarcasMasMantenimientos($info["id_sede"],$info["id_campus"],$info["id_edificio"],$info["fecha_inicio"],$info["fecha_fin"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'conteo' => $valor['conteo'],
                    'marca' => mb_convert_case($valor['marca'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las marcas almacenadas en el sistema.
    **/
    public function consultar_marcas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarMarcas();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las categorias almacenadas en el sistema.
    **/
    public function consultar_categorias() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarCategorias();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los proveedores almacenados en el sistema.
    **/
    public function consultar_proveedores() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarProveedores();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_proveedor' => $valor['id_proveedor'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'nit' => $valor['nit'],
                    'direccion' => mb_convert_case($valor['direccion'],MB_CASE_TITLE,"UTF-8"),
                    'telefono' => $valor['telefono'],
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
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
    **/
    public function consultar_informacion_cancha() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
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
                    'tipo_pintura' => $valor['id_tipo_pintura_demarcacion'],
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
    **/
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
                    'largo_techo' => $valor['largo_techo'],
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
     * Función que permite consultar la información de la iluminación de un corredor
     * almacenado en el sistema.
    **/
    public function consultar_informacion_iluminacion_corredor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionIluminacionCorredor($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'tipo_iluminacion' => $valor['id_tipo_iluminacion'],
                    'cantidad' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de los interruptores de un corredor
     * almacenado en el sistema.
    **/
    public function consultar_informacion_interruptor_corredor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionInterruptorCorredor($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'tipo_interruptor' => $valor['id_tipo_interruptor'],
                    'cantidad' => $valor['cantidad'],
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
    **/
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
    **/
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
                    'nombre_edificio' => $valor['nombre_edificio'],
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
     * Función que permite consultar la información de las ventanas de unas gradas
     * almacenadas en el sistema.
    **/
    public function consultar_informacion_ventana_gradas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionVentanaGradas($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["piso_inicio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'piso_inicio' => $valor['piso_inicio'],
                    'tipo_ventana' => $valor['id_tipo_ventana'],
                    'cantidad' => $valor['cantidad'],
                    'material' => $valor['id_material'],
                    'alto' => $valor['alto_ventana'],
                    'ancho' => $valor['ancho_ventana'],
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
    **/
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
    **/
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
    **/
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
     * Función que permite consultar la información de la iluminación de una plazoleta
     * almacenada en el sistema.
    **/
    public function consultar_informacion_iluminacion_plazoleta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionIluminacionPlazoleta($info["nombre_sede"],$info["nombre_campus"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id' => mb_convert_case($valor['id'],MB_CASE_TITLE,"UTF-8"),
                    'tipo_iluminacion' => $valor['id_tipo_iluminacion'],
                    'cantidad' => $valor['cantidad'],
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
    **/
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
                    'codigo_poste' => $valor['codigo_poste'],
                    'material_cubierta' => $valor['id_material_cubierta'],
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
    **/
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
                    'id' => $valor['id'],
                    'material_piso' => $valor['id_tipo_material'],
                    'tipo_pintura' => $valor['id_tipo_pintura_demarcacion'],
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
     * Función que permite consultar la información de una capacidad de aires acondicionados almacenados en el sistema.
    **/
    public function consultar_informacion_capacidad_aires() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarCapacidadAires($info["capacidad"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'capacidad' => $valor['capacidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una marca de aires acondicionados almacenados en el sistema.
    **/
    public function consultar_informacion_marca_aires() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMarcaAires($info["marca"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un tipo de aires acondicionados almacenados en el sistema.
    **/
    public function consultar_informacion_tipo_aires() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarTipoAires($info["tipo"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'tipo' => mb_convert_case($valor['tipo'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un tipo de aires acondicionados almacenados en el sistema.
    **/
    public function consultar_informacion_tecnologia_aires() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarTecnologiaAires($info["tipo"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'tipo' => mb_convert_case($valor['tipo'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los aires acondicionados almacenados en el sistema.
    **/
    public function consultar_informacion_aire_numero_inventario() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarAireNumeroInventario($info["numero_inventario"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'numero_inventario' => mb_convert_case($valor['numero_inventario'],MB_CASE_TITLE,"UTF-8"),
                    'id_aire' => $valor['id_aire'],
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso' => $valor['piso'],
                    'id_espacio' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'capacidad' => $valor['capacidad'],
                    'marca' => $valor['marca'],
                    'tipo' => $valor['tipo'],
                    'tecnologia' => $valor['tecnologia'],
                    'fecha_instalacion' => substr($valor['fecha_instalacion'],0,10),
                    'instalador' => $valor['instalador'],
                    'periodicidad_mantenimiento' => $valor['periodicidad_mantenimiento'],
                    'ubicacion_condensadora' => $valor['ubicacion_condensadora'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los aires acondicionados almacenados en el sistema.
    **/
    public function consultar_informacion_aire_id() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarAireId($info["id_aire"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'numero_inventario' => mb_convert_case($valor['numero_inventario'],MB_CASE_TITLE,"UTF-8"),
                    'id_aire' => $valor['id_aire'],
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'piso' => $valor['piso'],
                    'id_espacio' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'capacidad' => $valor['capacidad'],
                    'marca' => $valor['marca'],
                    'tipo' => $valor['tipo'],
                    'tecnologia' => $valor['tecnologia'],
                    'fecha_instalacion' => substr($valor['fecha_instalacion'],0,10),
                    'instalador' => $valor['instalador'],
                    'periodicidad_mantenimiento' => $valor['periodicidad_mantenimiento'],
                    'ubicacion_condensadora' => $valor['ubicacion_condensadora'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un mantenimiento de un aire acondicionado.
    **/
    public function consultar_informacion_mantenimiento_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMantenimientoAire($info["numero_orden"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_aire' => $valor['id_aire'],
                    'numero_orden' => $valor['numero_orden'],
                    'fecha_realizacion' => substr($valor['fecha'],0,10),
                    'realizado' => mb_convert_case($valor['realizado'],MB_CASE_TITLE,"UTF-8"),
                    'revisado' => mb_convert_case($valor['revisado'],MB_CASE_TITLE,"UTF-8"),
                    'descripcion' => ucfirst($valor['descripcion']),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las imagenes que hay en una carpeta.
    **/
    public function consultar_fotos_index() {
        $GLOBALS['mensaje'] = "";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $directory = __ROOT__."/archivos/images/index/";
            $dirint = dir($directory);
            while (($archivo = $dirint->read()) !== false){
              //if($archivo != '.' && $archivo != '..' && $archivo != '.htaccess'){
              if (preg_match("/gif/", $archivo) || preg_match("/jpg/", $archivo) || preg_match("/png/", $archivo)){
                    $arrayAux = array(
                        'nombre' => $archivo,
                    );
                    array_push($result, $arrayAux);
                }
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un edificio
     * almacenado en el sistema.
    **/
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
    **/
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
                    'id_sede' => $valor['id_sede'],
                    'nombre_sede' => mb_convert_case($valor['nombre_sede'],MB_CASE_TITLE,"UTF-8"),
                    'id_campus' => $valor['id_campus'],
                    'nombre_campus' => mb_convert_case($valor['nombre_campus'],MB_CASE_TITLE,"UTF-8"),
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'nombre_edificio' => mb_convert_case($valor['nombre_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'espacio_padre' => $valor['espacio_padre'],
                    'piso' => $valor['piso_edificio'],
                    'uso_espacio' => $valor['uso_espacio'],
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
     * Función que permite consultar la información de un salón
     * almacenado en el sistema.
    **/
    public function consultar_informacion_salon() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                    'capacidad' => $valor['capacidad'],
                    'punto_videobeam' => $valor['punto_video_beam'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un auditorio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_auditorio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                    'capacidad' => $valor['capacidad'],
                    'punto_videobeam' => $valor['punto_video_beam'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un laboratorio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_laboratorio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                    'capacidad' => $valor['capacidad'],
                    'punto_videobeam' => $valor['punto_video_beam'],
                    'cantidad_puntos_hidraulicos' => $valor['cantidad_punto_hidraulico'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un punto sanitario de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_punto_sanitario() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],"punto_sanitario_".$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'tipo_punto_sanitario' => $valor['id_tipo'],
                    'cantidad_puntos_sanitarios' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una sala de cómputo
     * almacenada en el sistema.
    **/
    public function consultar_informacion_sala_computo() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                    'capacidad' => $valor['capacidad'],
                    'punto_videobeam' => $valor['punto_video_beam'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una oficina
     * almacenada en el sistema.
    **/
    public function consultar_informacion_oficina() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                    'punto_videobeam' => $valor['punto_video_beam'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un baño
     * almacenado en el sistema.
    **/
    public function consultar_informacion_bano() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'tipo_inodoro' => $valor['id_tipo_inodoro'],
                    'cantidad_inodoro' => $valor['cantidad_inodoro'],
                    'ducha' => $valor['ducha'],
                    'lavatraperos' => $valor['lavatraperos'],
                    'cantidad_sifones' => $valor['cantidad_sifon'],
                    'tipo_divisiones' => $valor['id_tipo_divisiones'],
                    'material_divisiones' => $valor['id_material_divisiones'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un lavamanos de un salón
     * almacenado en el sistema.
    **/
    public function consultar_informacion_lavamanos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],"lavamanos_bano");
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'tipo_lavamanos' => $valor['id_tipo_lavamanos'],
                    'cantidad_lavamanos' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un orinal de un salón
     * almacenado en el sistema.
    **/
    public function consultar_informacion_orinal() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],"orinal_bano");
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'tipo_orinal' => $valor['id_tipo_orinal'],
                    'cantidad_orinales' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un cuarto técnico
     * almacenado en el sistema.
    **/
    public function consultar_informacion_cuarto_tecnico() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                    'punto_videobeam' => $valor['punto_video_beam'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una bodega/almacén
     * almacenada en el sistema.
    **/
    public function consultar_informacion_bodega() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un cuarto de plantas
     * almacenado en el sistema.
    **/
    public function consultar_informacion_cuarto_plantas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un cuarto de aires acondicionados
     * almacenado en el sistema.
    **/
    public function consultar_informacion_cuarto_aires_acondicionados() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un área deportiva cerrada
     * almacenado en el sistema.
    **/
    public function consultar_informacion_area_deportiva_cerrada() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un centro de datos
     * almacenado en el sistema.
    **/
    public function consultar_informacion_centro_datos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un cuarto de bombas
     * almacenado en el sistema.
    **/
    public function consultar_informacion_cuarto_bombas() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_hidraulicos' => $valor['cantidad_punto_hidraulico'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una cocineta
     * almacenada en el sistema.
    **/
    public function consultar_informacion_cocineta() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_hidraulicos' => $valor['cantidad_punto_hidraulico'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una sala de estudio
     * almacenada en el sistema.
    **/
    public function consultar_informacion_sala_estudio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionUsoEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["uso_espacio"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => mb_convert_case($valor['id_espacio'],MB_CASE_TITLE,"UTF-8"),
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => mb_convert_case($valor['id_edificio'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_puntos_red' => $valor['cantidad_punto_red'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de la iluminación de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_iluminacion_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionIluminacionEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id_espacio'],
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'tipo_iluminacion' => $valor['id_tipo_iluminacion'],
                    'cantidad' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de los interruptores de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_interruptor_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionInterrutorEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id_espacio'],
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'tipo_interruptor' => $valor['id_tipo_interruptor'],
                    'cantidad' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de las puertas de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_puerta_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionPuertaEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id_espacio'],
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'tipo_puerta' => $valor['id_tipo_puerta'],
                    'material_puerta' => $valor['id_material_puerta'],
                    'cantidad' => $valor['cantidad'],
                    'material_marco' => $valor['id_material_marco'],
                    'ancho' => $valor['ancho_puerta'],
                    'largo' => $valor['largo_puerta'],
                    'gato' => $valor['gato'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de las cerraduras de una puerta de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_puerta_tipo_cerradura() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionPuertaTipoCerradura($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"],$info["tipo_puerta"],$info["material_puerta"],$info["material_marco"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id_espacio'],
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'tipo_puerta' => $valor['id_tipo_puerta'],
                    'material_puerta' => $valor['id_material_puerta'],
                    'material_marco' => $valor['id_material_marco'],
                    'tipo_cerradura' => $valor['id_tipo_cerradura'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información del suminstro de energía de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_suministro_energia_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionSuministroEnergiaEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id_espacio'],
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'tipo_suministro_energia' => $valor['id_tipo_suministro_energia'],
                    'cantidad' => $valor['cantidad'],
                    'tomacorriente' => $valor['tomacorriente'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de la iluminación de un espacio
     * almacenado en el sistema.
    **/
    public function consultar_informacion_ventana_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionVentanaEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id_espacio'],
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'tipo_ventana' => $valor['id_tipo_ventana'],
                    'ancho' => $valor['ancho_ventana'],
                    'alto' => $valor['alto_ventana'],
                    'cantidad' => $valor['cantidad'],
                    'material_ventana' => $valor['id_material'],
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
    **/
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
    **/
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id'],
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
    **/
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
                    'id' => $valor['id_edificio'],
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
    **/
    public function consultar_archivos_espacio() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosEspacio($info["nombre_sede"],$info["nombre_campus"],$info["nombre_edificio"],$info["id"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_sede' => $valor['id_sede'],
                    'id_campus' => $valor['id_campus'],
                    'id_edificio' => $valor['id_edificio'],
                    'id' => $valor['id_espacio'],
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
     * Función que permite consultar los archivos de un aire acondicionado
     * almacenado en el sistema.
    **/
    public function consultar_archivos_aire_id() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosAireId($info["id_aire"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_aire' => $valor['id_aire'],
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
     * Función que permite consultar los archivos de un aire acondicionado
     * almacenado en el sistema.
    **/
    public function consultar_archivos_aire_numero_inventario() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosAireNumeroInventario($info["numero_inventario"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_aire' => $valor['id_aire'],
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
     * Función que permite consultar los archivos de un artículo
     * almacenado en el sistema.
    **/
    public function consultar_archivos_articulo() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArchivosArticulo($info["id_articulo"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
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
     * Función que permite consultar las marcas de los aires aconidcionados.
    **/
    public function consultar_marcas_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarMarcasAire();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id' => $valor['id'],
                    'nombre' => $valor['nombre'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las marcas de los aires aconidcionados.
    **/
    public function consultar_articulos() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarArticulos();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'id_marca' => $valor['id_marca'],
                    'nombre_marca' => mb_convert_case($valor['nombre_marca'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_minima' => $valor['cantidad_minima'],
                    'cantidad' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar las marcas de los aires aconidcionados.
    **/
    public function consultar_articulo_inventario() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArticuloInventario($info["id_articulo"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'cantidad' => $valor['cantidad'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite verificar si un numero de inventario ya
     * está asignado a un aire acondicionado.
    **/
    public function verificar_numero_inventario_aire() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->verificarNumeroInventarioAire($info["numero_inventario"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'count' => $valor['count'],
                    'numero_inventario' => $valor['numero_inventario'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar el inventario.
    **/
    public function listar_inventario() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $data = $m->buscarInventario();
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'cantidad' => $valor['cantidad'],
                    'nombre_articulo' => mb_convert_case($valor['nombre_articulo'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_minima' => $valor['cantidad_minima'],
                    'id_marca' => $valor['marca'],
                    'nombre_marca' => mb_convert_case($valor['nombre_marca'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar el inventario.
    **/
    public function listar_movimientos_inventario() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarMovimientosInventario($info["fecha_inicio"],$info["fecha_fin"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'nombre_articulo' => mb_convert_case($valor['nombre_articulo'],MB_CASE_TITLE,"UTF-8"),
                    'valor_nuevo' => $valor['valor_nuevo'],
                    'valor_antiguo' => $valor['valor_antiguo'],
                    'nombre_marca' => mb_convert_case($valor['nombre_marca'],MB_CASE_TITLE,"UTF-8"),
                    'fecha' => $valor['fecha'],
                    'usuario' => mb_convert_case($valor['usuario'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar los proveedores de un artículo.
    **/
    public function consultar_informacion_articulo_proveedor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArticuloProveedor($info['id_articulo']);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'id_proveedor' => $valor['id_proveedor'],
                    'nombre_proveedor' => mb_convert_case($valor['nombre_proveedor'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un artículo
     * almacenado en el sistema.
    **/
    public function consultar_informacion_articulo() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionArticulo($info["id_articulo"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'id_marca' => $valor['id_marca'],
                    'nombre_marca' => mb_convert_case($valor['nombre_marca'],MB_CASE_TITLE,"UTF-8"),
                    'cantidad_minima' => $valor['cantidad_minima'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un artículo
     * almacenado en el sistema.
    **/
    public function consultar_informacion_articulo_nombre() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionArticuloNombre($info["nombre_articulo"],$info["marca"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_articulo' => $valor['id_articulo'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'id_marca' => $valor['id_marca'],
                    'nombre_marca' => mb_convert_case($valor['nombre_marca'],MB_CASE_TITLE,"UTF-8"),
                    'id_categoria_articulo' => $valor['id_categoria_articulo'],
                    'nombre_categoria' => mb_convert_case($valor['nombre_categoria'],MB_CASE_TITLE,"UTF-8"),
                    'bodega' => $valor['bodega'],
                    'cantidad_minima' => $valor['cantidad_minima'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una marca
     * almacenada en el sistema.
    **/
    public function consultar_informacion_marca() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionMarca($info["nombre"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_marca' => $valor['id'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de una categoría
     * almacenada en el sistema.
    **/
    public function consultar_informacion_categoria() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionCategoria($info["nombre"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_marca' => $valor['id'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que permite consultar la información de un proveedor
     * almacenada en el sistema.
    **/
    public function consultar_informacion_proveedor() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarInformacionProveedor($info["nombre"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'id_proveedor' => $valor['id_proveedor'],
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'nit' => $valor['nit'],
                    'direccion' => mb_convert_case($valor['direccion'],MB_CASE_TITLE,"UTF-8"),
                    'telefono' => $valor['telefono'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de inventario.
    **/
    public function consultar_articulos_mas_usados() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArticulosMasUsados($info["fecha_inicio"],$info["fecha_fin"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'suma' => $valor['suma'],
                );
                array_push($result, $arrayAux);
            }
        }
        $result['mensaje'] = $GLOBALS['mensaje'];
        $result['sql'] = $GLOBALS['sql'];
        echo json_encode($result);
    }

    /**
     * Función que despliega el panel que permite consultar
     * las estadísticas del módulo de inventario.
    **/
    public function consultar_articulos_menos_usados() {
        $GLOBALS['mensaje'] = "";
        $GLOBALS['sql'] = "";
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $result = array();
            $info = json_decode($_POST['jObject'], true);
            $data = $m->buscarArticulosMenosUsados($info["fecha_inicio"],$info["fecha_fin"]);
            while (list($clave, $valor) = each($data)){
                $arrayAux = array(
                    'nombre' => mb_convert_case($valor['nombre'],MB_CASE_TITLE,"UTF-8"),
                    'suma' => $valor['suma'],
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
