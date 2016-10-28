<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase controlador_modificacion
 *
 */
class controlador_modificacion{
  /**
   * Funcion que permite modificar una sede en el sistema
   * @return array $result. Un array que contiene el mensaje a desplegar en la barra de estado
   */
  public function modificar_sede(){
      $GLOBALSGLOBALS['mensaje'] = "";
      $GLOBALS['sql'] = "";
      $result = array();
      $m = new modelo_creacion(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                  Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
          $info = json_decode($_POST['jObject'], true);
          $m->modificarSede($info['id_sede'],$info['nombre_sede_nuevo']);
      }
      $result['mensaje'] = $GLOBALS['mensaje'];
      $result['sql'] = $GLOBALS['sql'];
      $result['verificar'] = $verificar;
      echo json_encode($result);
  }

}
?>
