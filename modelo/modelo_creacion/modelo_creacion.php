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
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sede 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sede 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "La sede se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una sede.
     * @param strig $nombre_sede, palabra clave.
     * @return array
     */
    public function guardarCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "INSERT INTO campus (sede,nombre,usuario_crea) VALUES ('".$nombre_sede."','".$nombre_campus."','".$_SESSION["login"]."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Campus 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Campus 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "El campus se guardó correctamente";
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
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Sede 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Sede 2)";
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

    /**
     * Función que permite consultar si una sede ya esta registrada en el sistema.
     * @param strig $nombre_sede, palabra clave.
     * @return array
     */
    public function verificarCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT nombre FROM campus WHERE sede = '".$nombre_sede."' AND nombre = '".$nombre_campus."'";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Campus 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Campus 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0)
            {
                $GLOBALS['mensaje'] = "El campus ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }
}
?>