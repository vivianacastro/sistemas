<?php
//definicion de la ruta de la aplicacion
define('__ROOT__', dirname(__FILE__));

//dependencias de la aplicacion 
require_once __ROOT__.'/modelo/config.php'; 
require_once __ROOT__.'/modelo/constantes.php';
require_once __ROOT__.'/controlador_vista.php';
require_once __ROOT__.'/modelo/modelo_usuario/controlador_usuario.php';
require_once __ROOT__.'/modelo/modelo_usuario/modelo_usuario.php';

//variable global
global $mesaje;

//mapa de enrutamiento
$map = array(
    'administrar_autorizado_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'administrar_usuario_autorizado'),
    'buscar_autorizados_manejar_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'buscar_autorizados_manejar_sistema'),    
    'iniciar_sesion' => array('controlador' =>'controlador_usuario', 'action' =>'iniciar_sesion'),
    'salir_sesion' => array('controlador' =>'controlador_usuario', 'action' =>'salir_sesion'),
    'crear_usuario_autorizado_para_adm_sistema' => array('controlador' =>'controlador_usuario', 'action' =>'crear_usuario_autorizado_para_adm_sistema'),
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