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
    'crear_usuario_autorizado_para_adm_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'crear_usuario_autorizado_para_adm_sistema'),

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
    'consultar_usos_espacios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_usos_espacios'),
    'consultar_materiales' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_materiales'),
    'consultar_tipo_objetos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_objetos'),
    'guardar_sede' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_sede'),
    'guardar_campus' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_campus'),
    'guardar_edificio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_edificio'),
    'guardar_tipo_material' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tipo_material'),
    'guardar_tipo_objeto' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tipo_objeto'),

    //Acciones Módulo Inventario
    
    //Acciones Módulo Aires Acondicionados

    'administrar_autorizado_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'administrar_usuario_autorizado'),
    'buscar_autorizados_manejar_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'buscar_autorizados_manejar_sistema'),
    'eliminar_usuario_autorizado_adm_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'eliminar_usuario_autorizado_adm_sistema'),
    'modificar_perfil_usuario_autorizado_adm_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_perfil_usuario_autorizado_adm_sistema'),
    'buscar_usuario_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'buscarUsuario'),
    'cambiar_datos' => array('controlador' =>'controlador_usuario', 'action' =>'cambiar_datos'),
);

// Parseo de la ruta
if (isset($_GET['action']))
{
    if (isset($map[$_GET['action']]))
    {
        $ruta = $_GET['action'];
    }
    else
    {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                $_GET['action'] .
                '</p></body></html>';
        exit;
    }
}
else
{
    $ruta = 'iniciar_sesion';
}

// Checkear el acceso del usuario
if(!call_user_func(array(new controlador_usuario, 'check')))
{
    $ruta = 'iniciar_sesion';
}

$controlador = $map[$ruta];

// Ejecución del controlador asociado a la ruta
if (method_exists($controlador['controlador'],$controlador['action']))
{   
    call_user_func(array(new $controlador['controlador'], $controlador['action']));
}
else
{
    header('Status: 404 Not Found');
    echo '<html><body><h1>Error 404: El controlador <i>' .
            $controlador['controlador'] .
            '->' .
            $controlador['action'] .
            '</i> no existe</h1></body></html>';
}
?>