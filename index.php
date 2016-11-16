<?php
//definicion de la ruta de la aplicacion
define('__ROOT__', dirname(__FILE__));

ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log',  __ROOT__.'/errores.log');

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
        'crear_usuario_admin' => array('controlador' =>'controlador_usuario', 'action' =>'crear_usuario_admin'),
        'listar_usuarios_admin' => array('controlador' =>'controlador_usuario', 'action' =>'listar_usuarios_admin'),
        'olvido_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'olvido_contrasenia'),
        'listar_usuarios' => array('controlador' =>'controlador_usuario', 'action' =>'listar_usuarios'),
        'modificar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_usuario'),
        'modificar_contrasenia' => array('controlador' =>'controlador_usuario', 'action' =>'modificar_contrasenia'),
        //Acciones de creación
        'guardar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'guardar_usuario'),
        //Acciones de consulta
        'obtener_informacion_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'obtener_informacion_usuario'),
        'obtener_informacion_usuario_seleccionado' => array('controlador' =>'controlador_usuario', 'action' =>'obtener_informacion_usuario_seleccionado'),
        'verificar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'verificar_usuario'),
        'verificar_correo' => array('controlador' =>'controlador_usuario', 'action' =>'verificar_correo'),
        'consultar_fotos_index' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_fotos_index'),
        //Acciones de modificación
        'guardar_modificaciones_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'guardar_modificaciones_usuario'),
        'desactivar_usuario' => array('controlador' =>'controlador_usuario', 'action' =>'desactivar_usuario'),
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
        'planta_crear_via' => array('controlador' =>'controlador_creacion', 'action' =>'crear_via'),
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
        'planta_consultar_via' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_via'),
        'planta_consultar_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_edificio'),
        'planta_consultar_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_espacio'),
        'planta_consultar_tipo_material' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_material'),
        'planta_consultar_tipo_objeto' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_objeto'),
        'planta_consultar_mapa' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_mapa'),
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
        'guardar_via' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_via'),
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
        'guardar_planos_via' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_via'),
        'guardar_fotos_via' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_via'),
        'guardar_planos_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_planos_espacio'),
        'guardar_fotos_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_espacio'),
        //Acciones de consulta
        'consultar_sedes' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_sedes'),
        'consultar_todos_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_todos_campus'),
        'consultar_canchas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_canchas'),
        'consultar_corredores' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_corredores'),
        'consultar_cubiertas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_cubiertas'),
        'consultar_todas_gradas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_todas_gradas'),
        'consultar_parqueaderos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_parqueaderos'),
        'consultar_piscinas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_piscinas'),
        'consultar_plazoletas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_plazoletas'),
        'consultar_senderos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_senderos'),
        'consultar_vias' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_vias'),
        'consultar_edificios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_edificios'),
        'consultar_espacios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_espacios'),
        'consultar_pisos_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_pisos_edificio'),
        'consultar_usos_espacios' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_usos_espacios'),
        'consultar_materiales' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_materiales'),
        'consultar_tipo_objetos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_objetos'),
        'consultar_archivos_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_campus'),
        'consultar_archivos_cancha' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_cancha'),
        'consultar_archivos_corredor' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_corredor'),
        'consultar_archivos_cubierta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_cubierta'),
        'consultar_archivos_gradas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_gradas'),
        'consultar_archivos_parqueadero' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_parqueadero'),
        'consultar_archivos_piscina' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_piscina'),
        'consultar_archivos_plazoleta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_plazoleta'),
        'consultar_archivos_sendero' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_sendero'),
        'consultar_archivos_via' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_via'),
        'consultar_archivos_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_edificio'),
        'consultar_archivos_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_espacio'),
        'ubicacion_campus' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_campus'),
        'ubicacion_cancha' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_cancha'),
        'ubicacion_corredor' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_corredor'),
        'ubicacion_parqueadero' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_parqueadero'),
        'ubicacion_piscina' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_piscina'),
        'ubicacion_plazoleta' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_plazoleta'),
        'ubicacion_sendero' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_sendero'),
        'ubicacion_via' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_via'),
        'ubicacion_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'ubicacion_edificio'),
        'consultar_informacion_sede' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_sede'),
        'consultar_informacion_campus' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_campus'),
        'consultar_informacion_cancha' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cancha'),
        'consultar_informacion_corredor' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_corredor'),
        'consultar_informacion_cubierta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cubierta'),
        'consultar_informacion_gradas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_gradas'),
        'consultar_informacion_parqueadero' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_parqueadero'),
        'consultar_informacion_piscina' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_piscina'),
        'consultar_informacion_plazoleta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_plazoleta'),
        'consultar_informacion_sendero' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_sendero'),
        'consultar_informacion_via' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_via'),
        'consultar_informacion_edificio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_edificio'),
        'consultar_informacion_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_espacio'),
        'consultar_informacion_iluminacion_corredor' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_iluminacion_corredor'),
        'consultar_informacion_interruptor_corredor' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_interruptor_corredor'),
        'consultar_informacion_ventana_gradas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_ventana_gradas'),
        'consultar_informacion_iluminacion_plazoleta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_iluminacion_plazoleta'),
        'consultar_informacion_iluminacion_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_iluminacion_espacio'),
        'consultar_informacion_interruptor_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_interruptor_espacio'),
        'consultar_informacion_puerta_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_puerta_espacio'),
        'consultar_informacion_puerta_tipo_cerradura' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_puerta_tipo_cerradura'),
        'consultar_informacion_suministro_energia_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_suministro_energia_espacio'),
        'consultar_informacion_ventana_espacio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_ventana_espacio'),
        'consultar_informacion_salon' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_salon'),
        'consultar_informacion_auditorio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_auditorio'),
        'consultar_informacion_laboratorio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_laboratorio'),
        'consultar_informacion_punto_sanitario' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_punto_sanitario'),
        'consultar_informacion_sala_computo' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_sala_computo'),
        'consultar_informacion_oficina' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_oficina'),
        'consultar_informacion_bano' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_bano'),
        'consultar_informacion_orinal' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_orinal'),
        'consultar_informacion_lavamanos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_lavamanos'),
        'consultar_informacion_cuarto_tecnico' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cuarto_tecnico'),
        'consultar_informacion_bodega' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_bodega'),
        'consultar_informacion_cuarto_plantas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cuarto_plantas'),
        'consultar_informacion_cuarto_aires_acondicionados' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cuarto_aires_acondicionados'),
        'consultar_informacion_area_deportiva_cerrada' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_area_deportiva_cerrada'),
        'consultar_informacion_centro_datos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_centro_datos'),
        'consultar_informacion_cuarto_bombas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cuarto_bombas'),
        'consultar_informacion_cocineta' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_cocineta'),
        'consultar_informacion_sala_estudio' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_sala_estudio'),
        'verificar_espacio' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_espacio'),
        //Acciones de modificación
        'modificar_sede' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_sede'),
        'modificar_campus' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_campus'),
        'modificar_cancha' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_cancha'),
        'modificar_corredor' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_corredor'),
        'modificar_cubierta' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_cubierta'),
        'modificar_gradas' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_gradas'),
        'modificar_parqueadero' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_parqueadero'),
        'modificar_piscina' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_piscina'),
        'modificar_plazoleta' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_plazoleta'),
        'modificar_sendero' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_sendero'),
        'modificar_via' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_via'),
        'modificar_edificio' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_edificio'),
        'modificar_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_espacio'),
        'modificar_tipo_material' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_tipo_material'),
        'modificar_tipo_objeto' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_tipo_objeto'),
        'eliminar_sede' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_sede'),
        'eliminar_campus' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_campus'),
        'eliminar_cancha' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_cancha'),
        'eliminar_corredor' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_corredor'),
        'eliminar_iluminacion_corredor' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_iluminacion_corredor'),
        'eliminar_interruptor_corredor' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_interruptor_corredor'),
        'eliminar_ventana_gradas' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_ventana_gradas'),
        'eliminar_iluminacion_plazoleta' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_iluminacion_plazoleta'),
        'eliminar_iluminacion_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_iluminacion_espacio'),
        'eliminar_interruptor_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_interruptor_espacio'),
        'eliminar_puerta_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_puerta_espacio'),
        'eliminar_suministro_energia_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_suministro_energia_espacio'),
        'eliminar_ventana_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_ventana_espacio'),
        'eliminar_cubierta' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_cubierta'),
        'eliminar_gradas' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_gradas'),
        'eliminar_parqueadero' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_parqueadero'),
        'eliminar_piscina' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_piscina'),
        'eliminar_plazoleta' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_plazoleta'),
        'eliminar_sendero' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_sendero'),
        'eliminar_via' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_via'),
        'eliminar_edificio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_edificio'),
        'eliminar_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_espacio'),
        'eliminar_archivo_campus' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_campus'),
        'eliminar_archivo_cancha' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_cancha'),
        'eliminar_archivo_corredor' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_corredor'),
        'eliminar_archivo_cubierta' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_cubierta'),
        'eliminar_archivo_gradas' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_gradas'),
        'eliminar_archivo_parqueadero' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_parqueadero'),
        'eliminar_archivo_plazoleta' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_plazoleta'),
        'eliminar_archivo_piscina' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_piscina'),
        'eliminar_archivo_sendero' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_sendero'),
        'eliminar_archivo_via' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_via'),
        'eliminar_archivo_edificio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_edificio'),
        'eliminar_archivo_espacio' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_archivo_espacio'),

    //Acciones Módulo Inventario
        //Acciones de carga de plantillas
        'inventario_crear_articulo' => array('controlador' =>'controlador_creacion', 'action' =>'crear_articulo'),
        'inventario_crear_marca' => array('controlador' =>'controlador_creacion', 'action' =>'crear_marca'),
        'inventario_crear_proveedor' => array('controlador' =>'controlador_creacion', 'action' =>'crear_proveedor'),
        'inventario_anadir_articulo' => array('controlador' =>'controlador_consultas', 'action' =>'anadir_articulo'),
        'inventario_consultar_articulo' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_articulo'),
        'inventario_consultar_marca' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_marca'),
        'inventario_consultar_proveedor' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_proveedor'),
        'inventario_consultar_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_inventario'),
        'inventario_articulos_mas_usados' => array('controlador' =>'controlador_consultas', 'action' =>'articulos_mas_usados'),
        'inventario_articulos_menos_usados' => array('controlador' =>'controlador_consultas', 'action' =>'articulos_menos_usados'),
        //Acciones de creación
        'guardar_articulo' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_articulo'),
        'guardar_fotos_articulo' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_articulo'),
        'guardar_marca_inventario' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_marca_inventario'),
        'guardar_proveedor' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_proveedor'),
        //Acciones de consulta
        'listar_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'listar_inventario'),
        'consultar_marcas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_marcas'),
        'consultar_proveedores' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_proveedores'),
        //Acciones de modificación

    //Acciones Módulo Aires Acondicionados
        //Acciones de carga de plantillas
        'aires_crear_aire' => array('controlador' =>'controlador_creacion', 'action' =>'crear_aire'),
        'aires_crear_capacidad_aire' => array('controlador' =>'controlador_creacion', 'action' =>'crear_capacidad_aire'),
        'aires_crear_marca_aire' => array('controlador' =>'controlador_creacion', 'action' =>'crear_marca_aire'),
        'aires_crear_tipo_aire' => array('controlador' =>'controlador_creacion', 'action' =>'crear_tipo_aire'),
        'aires_crear_tecnologia_aire' => array('controlador' =>'controlador_creacion', 'action' =>'crear_tecnologia_aire'),
        'aires_registrar_mantenimiento_aire' => array('controlador' =>'controlador_creacion', 'action' =>'registrar_mantenimiento_aire'),
        'aires_consultar_aire_ubicacion' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_aire_ubicacion'),
        'aires_consultar_aire_numero_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_aire_numero_inventario'),
        'aires_consultar_capacidad_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_capacidad_aire'),
        'aires_consultar_marca_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_marca_aire'),
        'aires_consultar_tipo_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_aire'),
        'aires_consultar_tecnologia_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tecnologia_aire'),
        'aires_consultar_mantenimiento_aire_id_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_mantenimiento_aire_id_aire'),
        'aires_consultar_mantenimiento_aire_numero_orden' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_mantenimiento_aire_numero_orden'),
        'aires_mas_marcas_aire' => array('controlador' =>'controlador_consultas', 'action' =>'mas_marcas_aire'),
        'aires_mas_tipos_aire' => array('controlador' =>'controlador_consultas', 'action' =>'mas_tipos_aire'),
        'aires_mas_tipo_tecnologias_aire' => array('controlador' =>'controlador_consultas', 'action' =>'mas_tipo_tecnologias_aire'),
        'aires_mas_mantenimientos' => array('controlador' =>'controlador_consultas', 'action' =>'aires_mas_mantenimientos'),
        'aires_marcas_mas_mantenimientos' => array('controlador' =>'controlador_consultas', 'action' =>'marcas_mas_mantenimientos'),
        //Acciones de creación
        'guardar_aire' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_aire'),
        'guardar_fotos_aire' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_fotos_aire'),
        'guardar_capacidad_aire' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_capacidad_aire'),
        'guardar_marca_aire' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_marca_aire'),
        'guardar_tecnologia_aire' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_tecnologia_aire'),
        'guardar_mantenimiento_aire' => array('controlador' =>'controlador_creacion', 'action' =>'guardar_mantenimiento_aire'),
        'verificar_capacidad_aire' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_capacidad_aire'),
        'verificar_marca_aire' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_marca_aire'),
        'verificar_tipo_aire' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_tipo_aire'),
        'verificar_tecnologia_aire' => array('controlador' =>'controlador_creacion', 'action' =>'verificar_tecnologia_aire'),
        //Acciones de consulta
        'verificar_numero_inventario_aire' => array('controlador' =>'controlador_consultas', 'action' =>'verificar_numero_inventario_aire'),
        'consultar_aires_ubicacion' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_aires_ubicacion'),
        'consultar_informacion_aire_numero_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_aire_numero_inventario'),
        'consultar_informacion_aire_id' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_aire_id'),
        'consultar_archivos_aire_numero_inventario' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_aire_numero_inventario'),
        'consultar_archivos_aire_id' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_archivos_aire_id'),
        'consultar_informacion_capacidad_aires' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_capacidad_aires'),
        'consultar_informacion_marca_aires' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_marca_aires'),
        'consultar_informacion_tipo_aires' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_tipo_aires'),
        'consultar_informacion_tecnologia_aires' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_tecnologia_aires'),
        'consultar_informacion_mantenimiento_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_informacion_mantenimiento_aire'),
        'consultar_mantenimientos_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_mantenimientos_aire'),
        'consultar_capacidades_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_capacidades_aire'),
        'consultar_marcas_aire' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_marcas_aire'),
        'consultar_marcas_mas_instaladas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_marcas_mas_instaladas'),
        'consultar_tipos_mas_instalados' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipos_mas_instalados'),
        'consultar_tipo_tecnologias_mas_instaladas' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_tipo_tecnologias_mas_instaladas'),
        'consultar_aires_mas_mantenimientos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_aires_mas_mantenimientos'),
        'consultar_marcas_mas_mantenimientos' => array('controlador' =>'controlador_consultas', 'action' =>'consultar_marcas_mas_mantenimientos'),
        //Acciones de modificación
        'modificar_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_aire'),
        'modificar_capacidad_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_capacidad_aire'),
        'modificar_marca_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_marca_aire'),
        'modificar_mantenimiento_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'modificar_mantenimiento_aire'),
        'eliminar_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_aire'),
        'eliminar_mantenimiento_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_mantenimiento_aire'),
        'eliminar_foto_aire' => array('controlador' =>'controlador_modificacion', 'action' =>'eliminar_foto_aire'),
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
    }elseif(strcmp($_GET['action'],'consultar_fotos_index') == 0){
        $ruta = 'consultar_fotos_index';
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
