<?php
//Librerías para el envío de mail
include_once('class.phpmailer.php');
include_once('class.smtp.php');
/**
 * clase Modelo del modulo
 */
class modelo_creacion {
    protected $conexion;

    /**
     * Función contructur de la clase Modelo
     * @param string $dbname nombre de la base de datos a la que se va a 
     * conectar el modelo.
     * @param string $dbuser usuario con el que se va a conectar a la 
     * base de datos.
     * @param string $dbpass contraseña para poder acceder a la base de datos.
     * @param string $dbhost Host en donde se encuentra la base de datos.
     */    
    public function __construct($dbname,$dbuser,$dbpass,$dbhost) {
        
        $conn_string = 'pgsql:host='.$dbhost.';port=5432;dbname='.$dbname;
        
        try{ 
            $bd_conexion = new PDO($conn_string, $dbuser, $dbpass); 
            $this->conexion = $bd_conexion;  
            
        }catch (PDOException $e){
            var_dump( $e->getMessage());
        }       
    }    

    /**
     * Función que permite guardar una sede.
     * @param strig $nombre_sede, palabra clave.
     * @return array
     */
    public function guardarSede($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));

        $sql = "INSERT INTO sede (nombre,usuario_crea) VALUES ('".$nombre_sede."','".$_SESSION["login"]."');";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error 1: SQL (Guardar Sede)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error 2: SQL (Guardar Sede)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "La sede se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una sede ya esta registrada en el sistema.
     * @param strig $nombre_sede, palabra clave.
     * @return array
     */
    public function verificarSede($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));

        $sql = "SELECT nombre FROM sede WHERE nombre = '".$nombre_sede."'";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error 3: SQL (Verificar Sede)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error 4: SQL (Verificar Sede)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0)
            {
                $GLOBALS['mensaje'] = "La sede ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }
}
?>