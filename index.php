<?php
//definicion de la ruta de la aplicacion
define('__ROOT__', dirname(__FILE__));

//dependencias de la aplicacion 
require_once __ROOT__.'/modelo/Config.php';
require_once __ROOT__.'/modelo/Constantes.php';
require_once __ROOT__.'/modelo/Controlador_vista.php';
require_once __ROOT__.'/modelo/mdl_usuario/Controlador_usuario.php';
require_once __ROOT__.'/modelo/mdl_usuario/Modelo_usuario.php';
require_once __ROOT__.'/modelo/mdl_consultas/Controlador_consultas.php';
require_once __ROOT__.'/modelo/mdl_consultas/Modelo_consultas.php';
/*require_once __ROOT__.'/app/mdl_consultas/Controlador_consultas.php';
require_once __ROOT__.'/app/mdl_modificacion/Modelo_modificacion.php';
require_once __ROOT__.'/app/mdl_modificacion/Controlador_modificacion.php';
require_once __ROOT__.'/app/mdl_usuario/Controlador_usuario.php';
require_once __ROOT__.'/app/mdl_usuario/Modelo_usuario.php';*/

//variable global
global $mesaje;

//mapa de enrutamiento
$map = array(
    'iniciar_sesion' => array('controlador' =>'Controlador_usuario', 'action' => 'iniciar_sesion'),
    'crear_sede' => array('controlador' => 'Controlador_consultas', 'action' => 'crear_sede', ),
    'salir_sesion' => array('controlador' =>'Controlador_usuario', 'action' => 'salir_sesion')
);

if ($_SERVER['REMOTE_ADDR'] == '192.168.46.53') {
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
    if(!call_user_func(array(new Controlador_usuario, 'check')))
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
}else{
    echo '<html><body><h1>Error: URL no disponible</h1></body></html>';
}
?>