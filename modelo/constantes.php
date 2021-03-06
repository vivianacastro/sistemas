<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Constantes del sistema
 */
const T_SEGUNDOS_INACTIVIDAD_PERMITIDO = 1000;//600;
const ESTILO = 'estilo.css';
const USUARIO = 'usuario';
const CONSULTAS = 'consultas';
const CREACION = 'creacion';
const MODIFICACION = 'modificacion';
const REGISTROS = 'registros';
const EMAIL = 'mantenimiento.univalle@gmail.com';
const PASS = 'ManteUnivalle';
// Operaciones módulo Usuarios.
const INICIAR_SESION = 'iniciar_sesion';
const CERRAR_SESION = 'cerrar_sesion';
const CREAR_USUARIO = 'crear_usuario';
const CREAR_USUARIO_ADMIN = 'crear_usuario_admin';
const LISTAR_USUARIOS_ADMIN = 'listar_usuarios_admin';
const OLVIDO_CONTRASENIA = 'olvido_contrasenia';
const MENU_PRINCIPAL = 'menu_principal';
const INFORMACION_USUARIO = 'informacion_usuario';
const MODIFICAR_INFORMACION_USUARIO = 'modificar_informacion_usuario';
const CAMBIAR_CONTRASENIA = 'cambiar_contrasenia';
const OPERATION_MODIFICAR_INFORMACION_USUARIO = 'modificar_informacion_usuario';
const OPERATION_CAMBIAR_CONTRASENIA = 'cambiar_contrasenia';
// Operaciones carga módulos.
const MOD_PLANTA = 'mod_planta';
const MOD_INVENTARIO = 'mod_inventario';
const MOD_AIRES = 'mod_aires';
const MOD_USUARIOS = 'mod_usuarios';
const MOD_USUARIO = 'mod_usuario';
const OPERATION_MOD_PLANTA = 'modulo_planta';
const OPERATION_MOD_INVENTARIO = 'modulo_inventario';
const OPERATION_MOD_AIRES = 'modulo_aires';
const OPERATION_MOD_USUARIO = 'modulo_usuarios';
// Operaciones módulo Planta Física.
const OPERATION_CREAR_SEDE = 'planta_crear_sede';
const OPERATION_CREAR_CAMPUS = 'planta_crear_campus';
const OPERATION_CREAR_CANCHA = 'planta_crear_cancha';
const OPERATION_CREAR_CORREDOR = 'planta_crear_corredor';
const OPERATION_CREAR_CUBIERTA = 'planta_crear_cubierta';
const OPERATION_CREAR_GRADAS = 'planta_crear_gradas';
const OPERATION_CREAR_PARQUEADERO = 'planta_crear_parqueadero';
const OPERATION_CREAR_PISCINA = 'planta_crear_piscina';
const OPERATION_CREAR_PLAZOLETA = 'planta_crear_plazoleta';
const OPERATION_CREAR_SENDERO = 'planta_crear_sendero';
const OPERATION_CREAR_VIA = 'planta_crear_via';
const OPERATION_CREAR_EDIFICIO = 'planta_crear_edificio';
const OPERATION_CREAR_ESPACIO = 'planta_crear_espacio';
const OPERATION_CREAR_TIPO_MATERIAL = 'planta_crear_tipo_material';
const OPERATION_CREAR_TIPO_OBJETO = 'planta_crear_tipo_objeto';
const OPERATION_CONSULTAR_MAPA = 'planta_consultar_mapa';
const OPERATION_CONSULTAR_SEDE = 'planta_consultar_sede';
const OPERATION_CONSULTAR_CAMPUS = 'planta_consultar_campus';
const OPERATION_CONSULTAR_CANCHA = 'planta_consultar_cancha';
const OPERATION_CONSULTAR_CORREDOR = 'planta_consultar_corredor';
const OPERATION_CONSULTAR_CUBIERTA = 'planta_consultar_cubierta';
const OPERATION_CONSULTAR_GRADAS = 'planta_consultar_gradas';
const OPERATION_CONSULTAR_PARQUEADERO = 'planta_consultar_parqueadero';
const OPERATION_CONSULTAR_PISCINA = 'planta_consultar_piscina';
const OPERATION_CONSULTAR_PLAZOLETA = 'planta_consultar_plazoleta';
const OPERATION_CONSULTAR_SENDERO = 'planta_consultar_sendero';
const OPERATION_CONSULTAR_VIA = 'planta_consultar_via';
const OPERATION_CONSULTAR_EDIFICIO = 'planta_consultar_edificio';
const OPERATION_CONSULTAR_ESPACIO = 'planta_consultar_espacio';
const OPERATION_CONSULTAR_TIPO_MATERIAL = 'planta_consultar_tipo_material';
const OPERATION_CONSULTAR_TIPO_OBJETO = 'planta_consultar_tipo_objeto';
// Operaciones módulo Aires Acondicionados.
const OPERATION_CREAR_AIRE = 'aires_crear_aire';
const OPERATION_CREAR_CAPACIDAD_AIRE = 'aires_crear_capacidad_aire';
const OPERATION_CREAR_MARCA_AIRE = 'aires_crear_marca_aire';
const OPERATION_CREAR_TIPO_AIRE = 'aires_crear_tipo_aire';
const OPERATION_CREAR_TECNOLOGIA_AIRE = 'aires_crear_tecnologia_aire';
const OPERATION_REGISTRAR_MANTENIMIENTO_AIRE = 'aires_registrar_mantenimiento_aire';
const OPERATION_CONSULTAR_INVENTARIO_AIRES = 'aires_consultar_inventario_aires';
const OPERATION_CONSULTAR_AIRE_UBICACION = 'aires_consultar_aire_ubicacion';
const OPERATION_CONSULTAR_AIRE_NUMERO_INVENTARIO = 'aires_consultar_aire_numero_inventario';
const OPERATION_CONSULTAR_CAPACIDAD_AIRE = 'aires_consultar_capacidad_aire';
const OPERATION_CONSULTAR_MARCA_AIRE = 'aires_consultar_marca_aire';
const OPERATION_CONSULTAR_TIPO_AIRE = 'aires_consultar_tipo_aire';
const OPERATION_CONSULTAR_TECNOLOGIA_AIRE = 'aires_consultar_tecnologia_aire';
const OPERATION_CONSULTAR_MANTENIMIENTO_AIRE_ID_AIRE = 'aires_consultar_mantenimiento_aire_id_aire';
const OPERATION_CONSULTAR_MANTENIMIENTO_AIRE_NUMERO_ORDEN = 'aires_consultar_mantenimiento_aire_numero_orden';
const OPERATION_MAS_MARCAS_AIRE = 'aires_mas_marcas_aire';
const OPERATION_MAS_TIPOS_AIRE = 'aires_mas_tipos_aire';
const OPERATION_MAS_TIPO_TECNOLOGIAS_AIRE = 'aires_mas_tipo_tecnologias_aire';
const OPERATION_AIRES_MAS_MANTENIMIENTOS = 'aires_mas_mantenimientos';
const OPERATION_MARCAS_MAS_MANTENIMIENTOS = 'aires_marcas_mas_mantenimientos';
// Operaciones módulo Inventario.
const OPERATION_CREAR_ARTICULO = 'inventario_crear_articulo';
const OPERATION_CREAR_CATEGORIA = 'inventario_crear_categoria';
const OPERATION_CREAR_MARCA = 'inventario_crear_marca';
const OPERATION_CREAR_PROVEEDOR = 'inventario_crear_proveedor';
const OPERATION_CONSULTAR_ARTICULO = 'inventario_consultar_articulo';
const OPERATION_CONSULTAR_CATEGORIA = 'inventario_consultar_categoria';
const OPERATION_CONSULTAR_MARCA = 'inventario_consultar_marca';
const OPERATION_CONSULTAR_PROVEEDOR = 'inventario_consultar_proveedor';
const OPERATION_CONSULTAR_INVENTARIO_ELECTRICO = 'inventario_consultar_inventario_electrico';
const OPERATION_CONSULTAR_INVENTARIO_HIDRAULICO = 'inventario_consultar_inventario_hidraulico';
const OPERATION_CONSULTAR_INVENTARIO_SANFERNANDO = 'inventario_consultar_inventario_sanfernando';
const OPERATION_MOVIMIENTOS_INVENTARIO_ELECTRICO = 'inventario_movimientos_inventario_electrico';
const OPERATION_MOVIMIENTOS_INVENTARIO_HIDRAULICO = 'inventario_movimientos_inventario_hidraulico';
const OPERATION_MOVIMIENTOS_INVENTARIO_SANFERNANDO = 'inventario_movimientos_inventario_sanfernando';
const OPERATION_ARTICULOS_MAS_USADOS = 'inventario_articulos_mas_usados';
const OPERATION_ARTICULOS_MENOS_USADOS = 'inventario_articulos_menos_usados';
?>
