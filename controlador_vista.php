<?php

/**
 * Clase que controla lo que va ser visto por el usuario. Controla la visualización
 * de la interfaz de usuario.
**/
class controlador_vista
{
    //array que guarda el diccionario de rutas del menu y formularios
    var $diccionario = array();

    /**
     * Metodo constructora del Controlador_vista.
     * @global array $diccionario
    **/
    function __construct() {

        global $diccionario;

        $diccionario = array(
            'links_comunes'=>array(
                'MENU_PRINCIPAL'=>'index.php?action='.MENU_PRINCIPAL,
                'INFORMACION_USUARIO'=>'index.php?action='.INFORMACION_USUARIO,
                'CERRAR'=>'index.php?action='.CERRAR_SESION,
            ),'links_inicio'=>array(
                'CREAR_USUARIO'=>'index.php?action='.CREAR_USUARIO,
                'OLVIDO_CONTRASENIA'=>'index.php?action='.OLVIDO_CONTRASENIA,
            ),'links_menu_principal'=>array(
                'CERRAR'=>'index.php?action='.CERRAR_SESION,
            ),'links_planta'=>array(
                'CREAR_SEDE'=>'index.php?action='.OPERATION_CREAR_SEDE,
                'CREAR_CAMPUS'=>'index.php?action='.OPERATION_CREAR_CAMPUS,
                'CREAR_CANCHA'=>'index.php?action='.OPERATION_CREAR_CANCHA,
                'CREAR_CORREDOR'=>'index.php?action='.OPERATION_CREAR_CORREDOR,
                'CREAR_CUBIERTA'=>'index.php?action='.OPERATION_CREAR_CUBIERTA,
                'CREAR_GRADAS'=>'index.php?action='.OPERATION_CREAR_GRADAS,
                'CREAR_PARQUEADERO'=>'index.php?action='.OPERATION_CREAR_PARQUEADERO,
                'CREAR_PISCINA'=>'index.php?action='.OPERATION_CREAR_PISCINA,
                'CREAR_PLAZOLETA'=>'index.php?action='.OPERATION_CREAR_PLAZOLETA,
                'CREAR_SENDERO'=>'index.php?action='.OPERATION_CREAR_SENDERO,
                'CREAR_VIAS'=>'index.php?action='.OPERATION_CREAR_VIAS,
                'CREAR_EDIFICIO'=>'index.php?action='.OPERATION_CREAR_EDIFICIO,
                'CREAR_ESPACIO'=>'index.php?action='.OPERATION_CREAR_ESPACIO,
                'CREAR_TIPO_MATERIAL'=>'index.php?action='.OPERATION_CREAR_TIPO_MATERIAL,
                'CREAR_TIPO_OBJETOS'=>'index.php?action='.OPERATION_CREAR_TIPO_OBJETO,
            ),'links_inventario'=>array(
                'CREAR_SEDE'=>'index.php?action='.OPERATION_CREAR_SEDE,
            ),'links_aires'=>array(
                'CREAR_SEDE'=>'index.php?action='.OPERATION_CREAR_SEDE,
            ),'links_usuario'=>array(
                'MODIFICAR_INFORMACION_USUARIO'=>'index.php?action='.OPERATION_MODIFICAR_INFORMACION_USUARIO,
                'CAMBIAR_CONTRASENIA'=>'index.php?action='.OPERATION_CAMBIAR_CONTRASENIA,
            ),'form_index'=>array(
                'FORM_INICIAR_SESION'=>'index.php?action='.INICIAR_SESION,
                'FORM_NEW_USER'=>'index.php?action='.OPERATION_NEW_USER,
                'FORM_MOD_PLANTA'=>'index.php?action='.OPERATION_MOD_PLANTA,
                'FORM_MOD_INVENTARIO'=>'index.php?action='.OPERATION_MOD_INVENTARIO,
                'FORM_MOD_AIRES'=>'index.php?action='.OPERATION_MOD_AIRES,
                'FORM_MOD_USUARIO'=>'index.php?action='.OPERATION_MOD_USUARIO,
            ),'form_menu_principal'=>array(
                'FORM_MOD_PLANTA'=>'index.php?action='.OPERATION_MOD_PLANTA,
                'FORM_MOD_INVENTARIO'=>'index.php?action='.OPERATION_MOD_INVENTARIO,
                'FORM_MOD_AIRES'=>'index.php?action='.OPERATION_MOD_AIRES,
                'FORM_MOD_USUARIO'=>'index.php?action='.OPERATION_MOD_USUARIO,
            ),
        );
    }

    /**
    *funcion que permite cargar de forma dinamica las librerias de la aplicacion web
    *@param $operacion. Hace referencia la modulo que se carga una vez ejecutada una ruta
    **/
    function crear_enlace_libreria($operacion)
    {
        $link = "<script type='text/javascript' src='controlador/".$operacion."_functions.js'>"
                . "</script>";

        return $link;
    }

    /**
     * Función que permite conseguir y alamacenar como un string el menu de
     * operaciones adicional dependiendo de la operación a realizar.
     * @param string $accion, Cadena que hace referencia a la operación a realizar por
     * por parte del usuario y el módulo al que pertenece.
     * @return string
    **/
    function conseguir_operaciones_add($modulo){
        if(strcmp($modulo,MOD_PLANTA) == 0){
            if(strcmp($_SESSION['creacion_planta'],'true') == 0){
                $file = dirname(__FILE__).'/vistas/vistas_menu/menu_creacion_planta.html';
            }else{
                $file = dirname(__FILE__).'/vistas/vistas_menu/menu_consulta_planta.html';
            }
        }elseif (strcmp($modulo,MOD_INVENTARIO) == 0) {
            if(strcmp($_SESSION['creacion_inventario'],'true') == 0){
                $file = dirname(__FILE__).'/vistas/vistas_menu/menu_creacion_inventario.html';
            }else{
                $file = dirname(__FILE__).'/vistas/vistas_menu/menu_consulta_inventario.html';
            }
        }elseif (strcmp($modulo,MOD_AIRES) == 0) {
            if(strcmp($_SESSION['creacion_aires'],'true') == 0){
                $file = dirname(__FILE__).'/vistas/vistas_menu/menu_creacion_aires.html';
            }else{
                $file = dirname(__FILE__).'/vistas/vistas_menu/menu_consulta_aires.html';
            }
        }else{
            $file = dirname(__FILE__).'/vistas/vistas_menu/menu_'.$modulo.'.html';
        }
        $template = file_get_contents($file);
        return $template;
    }

    /**
     * Función que permite conseguir la plantilla de una vista y guardarla en
     * un string.
     * @param string $operacion, Cadena que hace referencia al modulo al cual
     * pertenece la vista a visualizar.
     * @param string $accion, Cadena que hace referencia a la operación que
     * permite realizar la vista que se va a visualizar.
     * @return string.
    **/
    function conseguir_plantilla($operacion='registros', $accion=''){
        if(strcmp($operacion, 'template1') == 0 || strcmp($operacion, 'template2') == 0 || strcmp($operacion, 'template3') == 0 ){
            $file = dirname(__FILE__).'/vistas/'.$operacion.'.html';
        }
        elseif(strcmp($accion,"menu_principal") == 0){
            //Menú principal para el usuario con acceso a todos los módulos de la aplicación
            if (strcmp($_SESSION["perfil"],"admin") == 0) {
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'.$accion.'_admin.html';
            }
            //Menú principal para el usuario con acceso a todos los módulos de la aplicación
            elseif (strcmp($_SESSION["modulo_planta"],"true") == 0 && strcmp($_SESSION["modulo_inventario"],"true") == 0 && strcmp($_SESSION["modulo_aires"],"true") == 0) {
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'.$accion.'_todos.html';
            }
            //Menú principal para el usuario con acceso a 2 módulos de la aplicación
            elseif(strcmp($_SESSION["modulo_planta"],"true") == 0 && strcmp($_SESSION["modulo_inventario"],"true") == 0){
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'
                    .$accion.'_1-2.html';
            }elseif(strcmp($_SESSION["modulo_inventario"],"true") == 0 && strcmp($_SESSION["modulo_aires"],"true") == 0){
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'
                    .$accion.'_2-3.html';
            }elseif(strcmp($_SESSION["modulo_planta"],"true") == 0 && strcmp($_SESSION["modulo_aires"],"true") == 0){
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'
                    .$accion.'_1-3.html';
            }
            //Menú principal para el usuario con acceso a 1 módulo de la aplicación
            elseif(strcmp($_SESSION["modulo_planta"],"true") == 0){
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'.$accion.'_1.html';
            }elseif(strcmp($_SESSION["modulo_inventario"],"true") == 0){
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'.$accion.'_2.html';
            }elseif(strcmp($_SESSION["modulo_aires"],"true") == 0){
                $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'.$accion.'_3.html';
            }
        }
        else{
            $file = dirname(__FILE__).'/vistas/vistas_'.$operacion.'/'.$accion.'.html';
        }

        $template = file_get_contents($file);

        return $template;
    }

    /**
     * Función que permite replazar dinamicamente informacion en cada página
     * html.
     * @param string $html, Cadena que que contiene el html de la página a
     * visualizar.
     * @param array $data, Array que contiene la información a remplazar.
     * @return string
    **/
    function representar_datos_dinamica($html, $data){
        foreach ($data as $clave=>$valor)
        {
            $html = str_replace('{'.$clave.'}', $valor, $html);
        }

        return $html;
    }

    /**
     * Función que retorna y permite visualizar la página requerida por el
     * usuario.
     * @global array $diccionario
     * @param string $modulo, cadena que hace referencia al módulo al que pertenece la
     * operación a realizar.
     * @param string $operacion, cadena que hace referencia a la
     * operación a realizar.
     * @param string $accion, cadena que hace referencia a la operación que
     * permite realizar la vista que se va a visualizar.
     * @param array $data, arreglo que contiene la información que se va a
     * reemplazar dinámicamente.
    **/
    function retornar_vista($modulo, $operacion, $accion, $data=array()) {
        global $diccionario;
        if(strcmp($operacion, USUARIO) == 0 && (strcmp($accion, INICIAR_SESION) == 0)){
            $html = $this->conseguir_plantilla('template1', '');
            $html = str_replace('{contenido}', $this->conseguir_plantilla($operacion, $accion), $html);
            $html = str_replace('{librerias_adicionales}', '', $html);
            $html = $this->representar_datos_dinamica($html, $diccionario['form_index']);
            $html = $this->representar_datos_dinamica($html, $diccionario['links_inicio']);
            $html = $this->representar_datos_dinamica($html, $data);
        }elseif(strcmp($operacion, USUARIO) == 0 && (strcmp($accion, CREAR_USUARIO) == 0 || strcmp($accion, OLVIDO_CONTRASENIA) == 0)) {
            $html = $this->conseguir_plantilla('template3', '');
            $html = str_replace('{operaciones}', ''/*$this->conseguir_operaciones_add($modulo)*/, $html);
            $html = str_replace('{librerias_adicionales}', $this->crear_enlace_libreria($operacion), $html);
            $html = str_replace('{contenido}', $this->conseguir_plantilla($operacion, $accion), $html);
            $html = $this->representar_datos_dinamica($html, $diccionario['form_menu_principal']);
            $html = $this->representar_datos_dinamica($html, $diccionario['links_comunes']);
            $html = $this->representar_datos_dinamica($html, $diccionario['links_menu_principal']);
            $html = $this->representar_datos_dinamica($html, $data);
        }elseif(strcmp($operacion, USUARIO) == 0 && (strcmp($accion, MENU_PRINCIPAL) == 0)) {
            $html = $this->conseguir_plantilla('template2', '');
            $html = str_replace('{operaciones}', ''/*$this->conseguir_operaciones_add($modulo)*/, $html);
            $html = str_replace('{librerias_adicionales}', $this->crear_enlace_libreria($operacion), $html);
            $html = str_replace('{contenido}', $this->conseguir_plantilla($operacion, $accion), $html);
            $html = $this->representar_datos_dinamica($html, $diccionario['form_menu_principal']);
            $html = $this->representar_datos_dinamica($html, $diccionario['links_comunes']);
            $html = $this->representar_datos_dinamica($html, $diccionario['links_menu_principal']);
            $html = $this->representar_datos_dinamica($html, $data);
        }else{
            $html = $this->conseguir_plantilla('template2', '');
            $html = str_replace('{operaciones}', $this->conseguir_operaciones_add($modulo), $html);
            $html = str_replace('{librerias_adicionales}', $this->crear_enlace_libreria($operacion), $html);
            $html = str_replace('{contenido}', $this->conseguir_plantilla($operacion, $accion), $html);
            $html = $this->representar_datos_dinamica($html, $diccionario['links_comunes']);
            if (strcmp($modulo, MOD_PLANTA) == 0) {
                $html = $this->representar_datos_dinamica($html, $diccionario['links_planta']);
            }elseif (strcmp($modulo, MOD_INVENTARIO) == 0) {
                $html = $this->representar_datos_dinamica($html, $diccionario['links_inventario']);
            }elseif (strcmp($modulo, MOD_AIRES) == 0) {
                $html = $this->representar_datos_dinamica($html, $diccionario['links_aires']);
            }elseif (strcmp($modulo, USUARIO) == 0) {
                $html = $this->representar_datos_dinamica($html, $diccionario['links_usuario']);
            }
            $html = $this->representar_datos_dinamica($html, $data);
        }
        print $html;
    }
}
?>
