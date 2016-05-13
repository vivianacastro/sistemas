<?php
/**
 * Clase controlador
 */
class controlador_consultas
{

    /**
    * Función que despliega el panel que permite consultar
    * los espacios que se encuentran registrados en el sistema
    **/
    public function modulo_planta() {
        
        $GLOBALS['mensaje'] = "";
        
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $data = array(
            'mensaje' => 'Consultar espacio',
        );  
        
        $v = new Controlador_vista();

        if (strcmp($_SESSION["modulo_planta"],"true") == 0) {
            $v->retornar_vista(MOD_PLANTA, CONSULTAS, OPERATION_BUSQ_PLANTA, $data);
        }else{
            $data['mensaje'] = 'Bienvenido/a al sistema '.$_SESSION["nombre_usuario"];
            $v->retornar_vista(MENU_PRINCIPAL, USUARIO, MENU_PRINCIPAL, $data);
        }
    }
    
    
    /**
    * Función que despliega el panel que permite visualizar las ordenes que
    * hay en el sistemas por nombre o numero de orden
    **/
    public function listar() {
        
        $GLOBALS['mensaje'] = "";
        
        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

        $data = array(
            'mensaje' => 'Consultar órdenes de mantenimiento',
        );  
        
        $v = new Controlador_vista();
        $v->retornar_vista($_SESSION["perfil"],CONSULTAS, OPERATION_LIST, $data);
    }

    
    /**
     * Función que permite buscar una orden  por su 
     * serial o nombre de solicitante.
     */
    public function buscar() {
        $GLOBALS['mensaje'] = "";  
        $control = false;

        $m = new Modelo_consultas(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                    Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
                    
        $dataNew = array();
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            
            if(is_numeric($_POST['buscar'])) {
                $data = $m->buscarOrdenesPorKey($_POST['buscar']);
                $control = true;
            }
            else if(is_string($_POST['buscar'])){
                $data = $m->buscarOrdenesPorNombre($_POST['buscar']);
                $control = true;
            }
            else{
                $data['mensaje'] = 'Error ingrese un valor';
            }
            if($control){
            	foreach ($data as $clave => $valor) {
            	 $temp1 = $valor['descripcion1'];
		  		 $temp2 = $valor['descripcion2'];
				 $temp3 = $valor['descripcion3'];
             	 $novedad1 = $m->getNombreNovedad($temp1);
				 $novedad2 = $m->getNombreNovedad($temp2);
				 $novedad3 = $m->getNombreNovedad($temp3);
            	 foreach ($novedad1 as $a => $b) {
             		 $novedad1 = $b['novedad'];
            	 }foreach ($novedad2 as $c => $d) {
            		 $novedad2 = $d['novedad'];
            	 }foreach ($novedad3 as $e => $f) {
            		 $novedad3 = $f['novedad'];
            	 }
                $arrayAux = array(
                    'numero_solicitud' => $valor['numero_solicitud'],
                    'usuario' => $valor['usuario'],
                    'cod_sede' => $valor['cod_sede'],
                    'codigo_campus' => $valor['codigo_campus'],
                    'codigo_edificio' => $valor['codigo_edificio'],
                    'piso' => $valor['piso'],
                    'espacio' => $valor['espacio'],
                    'cantidad1' => $valor['cantidad1'],
                    'descripcion1' => $novedad1,
                    'descripcion_novedad' => $valor['descripcion_novedad'],
                    'cantidad2' => $valor['cantidad2'],
                    'descripcion2' => $novedad2,
                    'descripcion_novedad2' => $valor['descripcion_novedad2'],
                    'cantidad3' => $valor['cantidad3'],
                    'descripcion3' => $novedad3,
                    'descripcion_novedad3' => $valor['descripcion_novedad3'],
                    'contacto' => $valor['contacto'],
                    'estado' => $valor['estado'],
                    'descripcion' => $valor['descripcion'],
                    'fecha' => $valor['fecha'],
                    'impreso' => $valor['impreso'],
                    'operario' => $valor['operario'],
                );
                array_push($dataNew, $arrayAux);
                
            	}
            }  
        }
        
        $dataNew['mensaje'] = $GLOBALS['mensaje'];
        
        echo json_encode($dataNew);
    }
}
?>