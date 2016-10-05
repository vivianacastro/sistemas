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
        $sql = "SELECT * from sede ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Sedes 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Sedes 2)";
                $GLOBALS['sql'] = $sql;
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
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.nombre,a.lat,a.lng,b.nombre as nombre_sede from campus a JOIN sede b ON a.sede = b.id ORDER BY a.nombre;";
        }else{
            $sql = "SELECT * from campus WHERE sede = '".$nombre_sede."' ORDER BY nombre;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Campus 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Campus 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Campus de la sede seleccionada presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los campus que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarInformacionCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT A.id as id_campus, A.nombre as nombre_campus, lat, lng, B.id as id_sede, B.nombre as nombre_sede from campus A JOIN sede B ON A.sede = B.id WHERE A.sede = '".$nombre_sede."' AND A.id = '".$nombre_campus."' ORDER BY A.nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Campus 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Campus 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del campus seleccionado";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los campus que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarArchivosCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * from campus_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Campus 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Campus 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del campus seleccionado";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los campus que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function ubicacionCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT nombre,lat,lng from campus WHERE sede = '".$nombre_sede."' and id = '".$nombre_campus."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Campus 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Campus 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación del Campus seleccionado";
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
        $sql = "SELECT a.id,a.nombre,a.id_campus,b.nombre as nombre_campus,a.id_sede,c.nombre as nombre_sede,a.numero_pisos,a.sotano,a.terraza,a.lat,a.lng,d.material as material_fachada,a.ancho_fachada,a.alto_fachada
                from edificio a JOIN campus b ON a.id_campus = b.id JOIN sede c ON a.id_sede = c.id LEFT JOIN material_fachada d ON a.id_material_fachada = d.id
                WHERE a.id_campus = '".$nombre_campus."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Edificios 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Edificios 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Edificios del campus presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar el número de pisos de un edificio que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarPisosEdificio($nombre_campus,$nombre_edificio){
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $sql = "SELECT id,numero_pisos,terraza,sotano from edificio WHERE id_campus = '".$nombre_campus."' AND id = '".$nombre_edificio."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Pisos Edificio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Pisos Edificio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Número de pisos del edificio";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los diferentes usos de espacio creados en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarUsosEspacios(){
        $sql = "SELECT id,uso from uso_espacio ORDER BY uso;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Usos Espacios 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Usos Espacios 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Usos de Espacios presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los materiales que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarMateriales($tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $sql = "SELECT id,material from ".$tipo_material." ORDER BY material;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Materiales 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Materiales 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Materiales presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * funcion que permite buscar los tipo de objetos que se han creado en el sistema.
     * @return metadata con elresultado de la busqueda.
     */
    public function buscarTipoObjetos($tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $sql = "SELECT id,tipo from ".$tipo_objeto." ORDER BY tipo;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Tipo Objeto 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Tipo Objeto 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Tipos de objetos presentes en el sistema";
            }
        }
        return $result;
    }
}
?>
