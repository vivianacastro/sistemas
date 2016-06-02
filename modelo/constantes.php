<?php
/**
 * Constantes del sistema 
 */
const T_SEGUNDOS_INACTIVIDAD_PERMITIDO = 600;

const ESTILO     = 'estilo.css';
const USUARIO = 'usuario';
const CONSULTAS = 'consultas';
const CREACION = 'creacion';
const MODIFICACION = 'modificacion';
const REGISTROS = 'registros';

const EMAIL = 'mantenimiento.univalle@gmail.com';
const PASS = 'ManteUnivalle';

const INICIAR_SESION = 'iniciar_sesion';
const CERRAR_SESION = 'cerrar_sesion';
const OLVIDO_CONTRASENIA = 'olvido_contrasenia';
const MENU_PRINCIPAL = 'menu_principal';

const MOD_PLANTA = 'mod_planta';
const MOD_PLANTA = 'mod_inventario';
const MOD_PLANTA = 'mod_aires';

const OPERATION_MOD_PLANTA = 'modulo_planta';
const OPERATION_MOD_INVENTARIO = 'modulo_inventario';
const OPERATION_MOD_AIRES = 'modulo_aires';
const OPERATION_MOD_USUARIO = 'modificar_usuario';

const OPERATION_CREAR_SEDE = 'crear_sede';
const OPERATION_CREAR_CAMPUS = 'crear_campus';
const OPERATION_CREAR_EDIFICIO = 'crear_edificio';
const OPERATION_CREAR_ESPACIO = 'crear_espacio';
const OPERATION_CREAR_TIPO_MATERIAL = 'crear_tipo_material';
const OPERATION_CREAR_TIPO_OBJETO = 'crear_tipo_objeto';
const OPERATION_BUSQ_PLANTA = 'buscar_planta';


/*******************Mensajes******************/
const MJ_CONSULTA_EXITOSA = 'Se realizó correctamente la consulta ';
const MJ_CONSULTA_FALLIDA = 'No se pudo realizar la consulta ';
const MJ_PREPARAR_CONSULTA_FALLIDA = 'No se pudo preparar la consulta ';

const MJ_INSERT_REGISTROS_EXITOSA = 'Se creo con éxito la orden en el sistema.';
const MJ_INSERT_REGISTROS_FALLIDA = 'No se pudo crear la orden en el sistema';

const MJ_UPDATE_EXITOSA = 'La información de la orden seleccionada se ha actualizado correctamente';
const MJ_UPDATE_FALLIDA = 'No se pudo actualizar la información de la orden seleccionada';
const MJ_DELETE_EXITOSA = 'Las órdenes seleccionadas se han eliminado correctamente';
const MJ_DELETE_FALLIDA = 'No se pudieron eliminar las órdenes seleccionados';

const MS_ACTUALIZACION_FALLIDA = "Error";
const MJ_INSERT_USUARIO_EXITOSA = 'Se creo con éxito el usuario en el sistema';
const MJ_INSERT_USUARIO_FALLIDA = 'No se pudo crear el usuario en el sistema';
const MJ_ACTUALIZACION_USUARIO_EXITOSA = 'La información del usuario seleccionado se ha actualizado correctamente ';
const MJ_ACTUALIZACION_USUARIO_FALLIDA = 'No se pudo actualizar la información del usuario seleccionado ';
const MJ_ACTUALIZACION_DATA_USUARIO_EXITOSA = 'Se modifico correctamente sus datos';
const MJ_ACTUALIZACION_DATA_USUARIO_FALLIDA = 'No se pudo modificar sus datos';
const MJ_ELMINACION_USUARIO_EXITOSA = 'Los usuarios seleccionados se ha eliminado correctamente ';
const MJ_ELMINACION_USUARIO_FALLIDA = 'No se pudieron eliminar los usuarios seleccionados ';
const MJ_ERROR_NO_EXISTE_USUARIO = 'No se pudo realizar la operación. El usuario no existe.';
const MJ_ERROR_CONTRASENA_INCORRECTA = 'No se pudo realizar la operación. Contraseña incorrecta.';
const MJ_ERROR_LOGIN_REGISTRADO_POR_OTRO_USUARIO = 'No se pudo realizar la operación. Ya existe en la base de datos un usuario con el login digitado.';

const MJ_NO_CAMPOS_VACIOS = 'No pueden quedar campos obligatorios (*) vacíos ';
const MJ_REVISE_FORMULARIO = 'No se pudo realizar la operación. Revise el formulario por favor! ';
?>