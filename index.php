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
    'iniciar_sesion' => array('controlador' =>'controlador_usuario', 'action' =>'iniciar_sesion'),
    'cerrar_sesion' => array('controlador' =>'controlador_usuario', 'action' =>'cerrar_sesion'),
    'informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'informacion_usuario'),
    'obtener_informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'obtener_informacion_usuario'),
    'crear_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'crear_usuario'),
    'guardar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'guardar_usuario'),
    'verificar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'verificar_usuario'),
    'verificar_correo' => array('controlador' =>'controlador_usuario', 'action' =>'verificar_correo'),
    'olvido_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'olvido_contrasenia'),
    'reestablecer_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'reestablecer_contrasenia'),
    'modificar_informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_informacion_usuario'),
    'cambiar_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'cambiar_contrasenia'),
    'modificar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_usuario'),
    'modificar_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_contrasenia'),

    //Acciones Página Principal
    'menu_principal' => array('controlador' =>'controlador_usuario', 'action' =>'iniciar_sesion'),
    'modulo_planta' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_planta'),
    'modulo_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_inventario'),
    'modulo_aires' => array('controlador' =>'controlador_consultas', 'action' =>'modulo_aires'),

    //Acciones Módulo Planta Física
    'crear_sede' => array('controlador' =>'controlador_creacion', 'action' =>'crear_sede'),
    'crear_campus' => array('controlador' =>'controlador_creacion', 'action' =>'crear_campus'),
    'crear_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'crear_edificio'),
    'crear_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'crear_espacio'),
    'crear_tipo_material' => array('controlador' =>'controlador_creacion', 'action' =>'crear_tipo_material'),
    'crear_tipo_objeto' => array('controlador' =>'controlador_creacion', 'action' =>'crear_tipo_objeto'),
    'consultar_sedes' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_sedes'),
    'consultar_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_campus'),
    'consultar_edificios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_edificios'),
    'consultar_pisos_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_pisos_edificio'),
    'consultar_usos_espacios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_usos_espacios'),
    'consultar_materiales' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_materiales'),
    'consultar_tipo_objetos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_objetos'),
    'guardar_sede' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_sede'),
    'guardar_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_campus'),
    'guardar_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_edificio'),
    'guardar_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_espacio'),
    'guardar_tipo_material' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tipo_material'),
    'guardar_tipo_objeto' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tipo_objeto'),
    'guardar_planos_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_campus'),
    'guardar_fotos_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_campus'),
    'guardar_planos_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_edificio'),
    'guardar_fotos_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_edificio'),
    'guardar_planos_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_espacio'),
    'guardar_fotos_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_espacio'),
    'verificar_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_espacio'),
    'ubicacion_campus' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_campus'),

    //Acciones Módulo Inventario
    
    //Acciones Módulo Aires Acondicionados
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