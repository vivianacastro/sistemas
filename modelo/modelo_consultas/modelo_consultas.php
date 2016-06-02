<?php
/**
 * Clase modelo de consultas
 */
class modelo_consultas
{
    protected $conexion;

    /**
     * Función contructur de la clase Model
     * @param string $dbname nombre de la base de datos a la que se va a 
     * conectar el modelo.
     * @param string $dbuser usuario con el que se va a conectar a la 
     * base de datos.
     * @param string $dbpass contraseña para poder acceder a la base de datos.
     * @param string $dbhost Host en donde se encuentra la base de datos.
     */
    public function __construct($dbname,$dbuser,$dbpass,$dbhost){
        $conn_string = 'pgsql:host='.$dbhost.';port=5432;dbname='.$dbname;
        try { 
            $bd_conexion = new PDO($conn_string, $dbuser, $dbpass); 
            $this->conexion = $bd_conexion;
        } catch (PDOException $e) {
            var_dump( $e->getMessage());
        }
    }

    /**
     * funcion que permite buscar las sedes que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarSedes(){
        $sql = "SELECT id,nombre from sede ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Sedes 1)";
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Sedes 2)";
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Sedes presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los campus que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarCampus($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $sql = "SELECT id,nombre from campus WHERE sede = '".$nombre_sede."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Campus 1)";
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Campus 2)";
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Campus de la sede seleccionada presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los edificios que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarEdificios($nombre_campus){
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT id,nombre from edificio WHERE id_campus = '".$nombre_campus."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Edificios 1)";
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Edificios 2)";
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Edificios del campus presentes en el sistema";
            }
        }
        return $result;
    }
}
?>
