<?php
//definicion de la ruta de la aplicacion
define('__ROOT__', dirname(__FILE__));

//dependencias de la aplicacion
require_once __ROOT__.'/modelo/config.php';
require_once __ROOT__.'/modelo/constantes.php';
require_once __ROOT__.'/controlador_vista.php';
require_once __ROOT__.'/modelo/modelo_consultas/controlador_consultas.php';
require_once __ROOT__.'/modelo/modelo_consultas/modelo_consultas.php';
require_once __ROOT__.'/modelo/modelo_creacion/controlador_creacion.php';
require_once __ROOT__.'/modelo/modelo_creacion/modelo_creacion.php';
require_once __ROOT__.'/modelo/modelo_modificacion/controlador_modificacion.php';
require_once __ROOT__.'/modelo/modelo_modificacion/modelo_modificacion.php';
require_once __ROOT__.'/modelo/modelo_usuario/controlador_usuario.php';
require_once __ROOT__.'/modelo/modelo_usuario/modelo_usuario.php';

//variable global
global $mesaje;

//mapa de enrutamiento
$map = array(
    //Acciones usuario
        //Acciones de carga de plantillas
        'iniciar_sesion' => array('controlador' =>'controlador_usuario', 'action' =>'iniciar_sesion'),
        'cerrar_sesion' => array('controlador' =>'controlador_usuario', 'action' =>'cerrar_sesion'),
        'informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'informacion_usuario'),
        'crear_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'crear_usuario'),
        'olvido_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'olvido_contrasenia'),
        'modificar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_usuario'),
        'modificar_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_contrasenia'),
        //Acciones de creación
        'guardar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'guardar_usuario'),
        //Acciones de consulta
        'obtener_informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'obtener_informacion_usuario'),
        'verificar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'verificar_usuario'),
        'verificar_correo' => array('controlador' =>'controlador_usuario', 'action' =>'verificar_correo'),
        //Acciones de modificación
        'reestablecer_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'reestablecer_contrasenia'),
        'modificar_informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_informacion_usuario'),
        'cambiar_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'cambiar_contrasenia'),

    //Acciones Página Principal
        //Acciones de carga de plantillas
        'menu_principal' => array('controlador' =>'controlador_usuario', 'action' =>'iniciar_sesion'),
        'modulo_planta' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_planta'),
        'modulo_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_inventario'),
        'modulo_aires' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_aires'),
        'modulo_usuarios' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_usuarios'),

    //Acciones Módulo Planta Física
        //Acciones de carga de plantillas
        'planta_crear_sede' => array('controlador' =>'controlador_creacion', 'action' =>'crear_sede'),
        'planta_crear_campus' => array('controlador' =>'controlador_creacion', 'action' =>'crear_campus'),
        'planta_crear_cancha' => array('controlador' =>'controlador_creacion', 'action' =>'crear_cancha'),
        'planta_crear_corredor' => array('controlador' =>'controlador_creacion', 'action' =>'crear_corredor'),
        'planta_crear_cubierta' => array('controlador' =>'controlador_creacion', 'action' =>'crear_cubierta'),
        'planta_crear_gradas' => array('controlador' =>'controlador_creacion', 'action' =>'crear_gradas'),
        'planta_crear_parqueadero' => array('controlador' =>'controlador_creacion', 'action' =>'crear_parqueadero'),
        'planta_crear_piscina' => array('controlador' =>'controlador_creacion', 'action' =>'crear_piscina'),
        'planta_crear_plazoleta' => array('controlador' =>'controlador_creacion', 'action' =>'crear_plazoleta'),
        'planta_crear_sendero' => array('controlador' =>'controlador_creacion', 'action' =>'crear_sendero'),
        'planta_crear_vias' => array('controlador' =>'controlador_creacion', 'action' =>'crear_vias'),
        'planta_crear_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'crear_edificio'),
        'planta_crear_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'crear_espacio'),
        'planta_crear_tipo_material' => array('controlador' =>'controlador_creacion', 'action' =>'crear_tipo_material'),
        'planta_crear_tipo_objeto' => array('controlador' =>'controlador_creacion', 'action' =>'crear_tipo_objeto'),
        'planta_consultar_sede' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_sede'),
        'planta_consultar_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_campus'),
        'planta_consultar_cancha' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_cancha'),
        'planta_consultar_corredor' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_corredor'),
        'planta_consultar_cubierta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_cubierta'),
        'planta_consultar_gradas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_gradas'),
        'planta_consultar_parqueadero' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_parqueadero'),
        'planta_consultar_piscina' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_piscina'),
        'planta_consultar_plazoleta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_plazoleta'),
        'planta_consultar_sendero' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_sendero'),
        'planta_consultar_vias' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_vias'),
        'planta_consultar_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_edificio'),
        'planta_consultar_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_espacio'),
        'planta_consultar_tipo_material' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_material'),
        'planta_consultar_tipo_objeto' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_objeto'),
        //Acciones de creación
        'guardar_sede' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_sede'),
        'guardar_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_campus'),
        'guardar_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_edificio'),
        'guardar_cancha' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_cancha'),
        'guardar_corredor' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_corredor'),
        'guardar_cubierta' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_cubierta'),
        'guardar_gradas' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_gradas'),
        'guardar_parqueadero' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_parqueadero'),
        'guardar_piscina' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_piscina'),
        'guardar_plazoleta' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_plazoleta'),
        'guardar_sendero' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_sendero'),
        'guardar_vias' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_vias'),
        'guardar_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_espacio'),
        'guardar_tipo_material' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tipo_material'),
        'guardar_tipo_objeto' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tipo_objeto'),
        'guardar_planos_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_campus'),
        'guardar_fotos_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_campus'),
        'guardar_planos_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_edificio'),
        'guardar_fotos_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_edificio'),
        'guardar_planos_cancha' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_cancha'),
        'guardar_fotos_cancha' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_cancha'),
        'guardar_planos_corredor' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_corredor'),
        'guardar_fotos_corredor' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_corredor'),
        'guardar_planos_cubierta' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_cubierta'),
        'guardar_fotos_cubierta' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_cubierta'),
        'guardar_planos_gradas' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_gradas'),
        'guardar_fotos_gradas' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_gradas'),
        'guardar_planos_parqueadero' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_parqueadero'),
        'guardar_fotos_parqueadero' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_parqueadero'),
        'guardar_planos_piscina' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_piscina'),
        'guardar_fotos_piscina' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_piscina'),
        'guardar_planos_plazoleta' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_plazoleta'),
        'guardar_fotos_plazoleta' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_plazoleta'),
        'guardar_planos_sendero' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_sendero'),
        'guardar_fotos_sendero' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_sendero'),
        'guardar_planos_vias' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_vias'),
        'guardar_fotos_vias' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_vias'),        
        'guardar_planos_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_espacio'),
        'guardar_fotos_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_espacio'),
        //Acciones de consulta
        'consultar_sedes' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_sedes'),
        'consultar_informacion_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_campus'),
        'consultar_archivos_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_campus'),
        'consultar_todos_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_todos_campus'),
        'consultar_edificios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_edificios'),
        'consultar_pisos_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_pisos_edificio'),
        'consultar_usos_espacios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_usos_espacios'),
        'consultar_materiales' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_materiales'),
        'consultar_tipo_objetos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_objetos'),
        'verificar_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_espacio'),
        'ubicacion_campus' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_campus'),
        //Acciones de modificación

    //Acciones Módulo Inventario
        //Acciones de carga de plantillas
        //Acciones de creación
        //Acciones de consulta
        //Acciones de modificación

    //Acciones Módulo Aires Acondicionados
        //Acciones de carga de plantillas
        //Acciones de creación
        //Acciones de consulta
        //Acciones de modificación

        //Acciones Módulo Usuarios
            //Acciones de carga de plantillas
            //Acciones de creación
            //Acciones de consulta
            //Acciones de modificación
);

// Parseo de la ruta
if (isset($_GET['action'])){
    if (isset($map[$_GET['action']])){
        $ruta = $_GET['action'];
    }else{
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                $_GET['action'] .
                '</p></body></html>';
        exit;
    }
}else{
    $ruta = 'iniciar_sesion';
}

// Checkear el acceso del usuario
if(!call_user_func(array(new controlador_usuario, 'check'))){
    if (strcmp($_GET['action'],'crear_usuario') == 0){
        $ruta = 'crear_usuario';
    }elseif(strcmp($_GET['action'],'verificar_usuario') == 0){
        $ruta = 'verificar_usuario';
    }elseif(strcmp($_GET['action'],'verificar_correo') == 0){
        $ruta = 'verificar_correo';
    }elseif(strcmp($_GET['action'],'guardar_usuario') == 0){
        $ruta = 'guardar_usuario';
    }elseif(strcmp($_GET['action'],'olvido_contrasenia') == 0){
        $ruta = 'olvido_contrasenia';
    }elseif(strcmp($_GET['action'],'reestablecer_contrasenia') == 0){
        $ruta = 'reestablecer_contrasenia';
    }else{
        $ruta = 'iniciar_sesion';
    }
}
$controlador = $map[$ruta];
// Ejecución del controlador asociado a la ruta
if (method_exists($controlador['controlador'],$controlador['action'])){
    call_user_func(array(new $controlador['controlador'], $controlador['action']));
}else{
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
            $controlador['controlador'] .
            '->' .
            $controlador['action'] .
            '</i> no existe</h1></body></html>';
}
?>
