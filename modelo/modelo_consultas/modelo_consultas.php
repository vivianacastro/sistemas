<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase modelo_consultas
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
    **/
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
     * Función que permite buscar las sedes que se han creado en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarSedes(){
        $sql = "SELECT * FROM sede ORDER BY nombre;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Sedes presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los campus que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán los campus.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCampus($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.nombre,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede FROM campus a JOIN sede b ON a.sede = b.id ORDER BY a.nombre;";
        }else{
            $sql = "SELECT a.id,a.nombre,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede FROM campus a JOIN sede b ON a.sede = b.id WHERE sede = '".$nombre_sede."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Campus de la sede seleccionada presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las canchas que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán las canchas.
     * @param string $nombre_campus, id del campus en donde se buscarán las canchas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCanchas($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.uso,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM cancha a JOIN sede b ON a.id_sede = b.id
                                  JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.uso,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM cancha a JOIN sede b ON a.id_sede = b.id
                                  JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Canchas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Canchas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Canchas del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los corredores que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán los corredores.
     * @param string $nombre_campus, id del campus en donde se buscarán los corredores.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCorredores($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM corredor a JOIN sede b ON a.id_sede = b.id
                                    JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM corredor a JOIN sede b ON a.id_sede = b.id
                            JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Corredores 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Corredores 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Corredores del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las cubiertas que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán las cubiertas.
     * @param string $nombre_campus, id del campus en donde se buscarán las cubiertas.
     * @param string $nombre_edificio, id del edificio en donde se buscarán las cubiertas.
     * @param string $piso, piso del edificio en donde se buscarán las cubiertas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCubiertas($nombre_sede,$nombre_campus,$nombre_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0 AND strcmp($nombre_edificio,"") == 0 AND strcmp($piso,"") == 0) {
            $sql = "SELECT a.piso,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus,a.id_edificio AS id_edificio,d.nombre AS nombre_edificio
                    FROM cubiertas_piso a JOIN sede b ON a.id_sede = b.id
                                          JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                          JOIN edificio d ON a.id_sede = d.id_sede AND a.id_campus = d.id_campus AND a.id_edificio = d.id ORDER BY a.piso;";
        }else{
            $sql = "SELECT a.piso,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus,a.id_edificio AS id_edificio,d.nombre AS nombre_edificio
                    FROM cubiertas_piso a JOIN sede b ON a.id_sede = b.id
                                          JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                          JOIN edificio d ON a.id_sede = d.id_sede AND a.id_campus = d.id_campus AND a.id_edificio = d.id
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id_edificio = '".$nombre_edificio."' ORDER BY piso;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Cubiertas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Cubiertas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Cubiertas del edificio seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las gradas que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán las gradas.
     * @param string $nombre_campus, id del campus en donde se buscarán las gradas.
     * @param string $nombre_edificio, id del edificio en donde se buscarán las gradas.
     * @param string $piso, piso del edificio en donde se buscarán las gradas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarGradas($nombre_sede,$nombre_campus,$nombre_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.piso_inicio,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus,d.nombre AS nombre_edificio,d.id AS id_edificio
                    FROM gradas a JOIN sede b ON a.id_sede = b.id
                                  JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                  JOIN edificio d ON a.id_sede = d.id_sede AND a.id_campus = d.id_campus AND a.id_edificio = d.id ORDER BY a.piso_inicio;";
        }else{
            $sql = "SELECT a.piso_inicio,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus,d.nombre AS nombre_edificio,d.id AS id_edificio
                    FROM gradas a JOIN sede b ON a.id_sede = b.id
                                  JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                  JOIN edificio d ON a.id_sede = d.id_sede AND a.id_campus = d.id_campus AND a.id_edificio = d.id
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id_edificio = '".$nombre_edificio."' ORDER BY piso_inicio;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Gradas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Gradas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Gradas del edificio seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los parqueaderos que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán los parqueaderos.
     * @param string $nombre_campus, id del campus en donde se buscarán los parqueaderos.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarParqueaderos($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM parqueadero a  JOIN sede b ON a.id_sede = b.id
                                        JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM parqueadero a  JOIN sede b ON a.id_sede = b.id
                                        JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Parqueaderos 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Parqueaderos 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Parqueaderos del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las piscinas que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán las piscinas.
     * @param string $nombre_campus, id del campus en donde se buscarán las piscinas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarPiscinas($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM piscina a  JOIN sede b ON a.id_sede = b.id
                                    JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM piscina a  JOIN sede b ON a.id_sede = b.id
                                    JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Piscinas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Piscinas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Piscinas del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las plazoletas que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán las plazoletas.
     * @param string $nombre_campus, id del campus en donde se buscarán las plazoletas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarPlazoletas($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.nombre,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM plazoleta a  JOIN sede b ON a.id_sede = b.id
                                      JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.nombre,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM plazoleta a  JOIN sede b ON a.id_sede = b.id
                                      JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Plazoletas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Plazoletas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Plazoletas del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los senderos que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán los senderos.
     * @param string $nombre_campus, id del campus en donde se buscarán los senderos.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarSenderos($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM sendero a  JOIN sede b ON a.id_sede = b.id
                                    JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM sendero a  JOIN sede b ON a.id_sede = b.id
                                    JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Senderos 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Senderos 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Senderos del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las vías que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede en donde se buscarán las vías.
     * @param string $nombre_campus, id del campus en donde se buscarán las vías.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarVias($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM via a  JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.lat,a.lng,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus
                    FROM via a  JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY id;";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Vías 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Vías 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Vías del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los edificios que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el edificio.
     * @param string $nombre_campus, id del campus donde está el edificio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarEdificios($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.nombre,a.id_campus,b.nombre AS nombre_campus,a.id_sede,c.nombre AS nombre_sede,a.numero_pisos,a.sotano,a.terraza,a.lat,a.lng
                    FROM edificio a JOIN campus b ON a.id_campus = b.id
                                    JOIN sede c ON a.id_sede = c.id
                    WHERE a.id_campus = '".$nombre_campus."' ORDER BY a.id;";
        }else{
            $sql = "SELECT a.id,a.nombre,a.id_campus,b.nombre AS nombre_campus,a.id_sede,c.nombre AS nombre_sede,a.numero_pisos,a.sotano,a.terraza,a.lat,a.lng
                    FROM edificio a JOIN campus b ON a.id_campus = b.id
                                    JOIN sede c ON a.id_sede = c.id
                    WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY a.id;";
        }
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Edificios del campus presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los espacios de un piso de un edificio que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenecen los espacios.
     * @param string $nombre_campus, id del campus donde están los espacios..
     * @param string $nombre_edificio, id del edificio donde están los espacios a buscar.
     * @param string $piso, piso del edificio donde están los espacios.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarEspacios($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT a.id,a.uso_espacio,b.id AS id_sede,b.nombre AS nombre_sede,c.id AS id_campus,c.nombre AS nombre_campus,d.id AS id_edificio,d.nombre AS nombre_edificio,a.piso_edificio,d.lat,d.lng
                FROM espacio a  JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                JOIN edificio d ON a.id_sede = d.id_sede AND a.id_campus = d.id_campus AND a.id_edificio = d.id
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id_edificio = '".$nombre_edificio."' AND a.piso_edificio = '".$piso."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Espacios 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Espacios 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Espacios del edificio presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una sede en el sistema.
     * @param string $nombre_sede, id de la sede.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionSede($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $sql = "SELECT id, nombre FROM sede WHERE id = '".$nombre_sede."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Sede 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Sede 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la sede seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un campus en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el campus a buscar.
     * @param string $nombre_campus, id del campus a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT a.id AS id_campus, a.nombre AS nombre_campus, lat, lng, b.id AS id_sede, b.nombre AS nombre_sede
                FROM campus a JOIN sede b ON a.sede = b.id
                WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del campus seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una cancha en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la cancha a buscar.
     * @param string $nombre_campus, id del campus al que pertenece la cancha a buscar.
     * @param string $id, id de la cancha a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionCancha($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id, b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.uso, a.id_material_piso, a.id_tipo_pintura_demarcacion, a.longitud_demarcacion, a.lat, a.lng
                FROM cancha a JOIN sede b ON a.id_sede = b.id
                              JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Cancha 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Cancha 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la cancha seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un corredor en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el corredor a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el corredor a buscar.
     * @param string $id, id del corredor a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id, b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.ancho_pared, a.alto_pared, a.id_material_pared, a.ancho_piso, a.largo_piso,
                a.id_material_piso, a.ancho_techo, a.largo_techo, a.id_material_techo, a.tomacorriente, a.id_tipo_suministro_energia, a.cantidad, a.lat, a.lng
                FROM corredor a JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Corredor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Corredor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de la iluminación de un corredor en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el corredor a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el corredor a buscar.
     * @param string $id, id del corredor a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionIluminacionCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM iluminacion_corredor WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Iluminación-Corredor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Iluminación-Corredor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la iluminación del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de los interruptores de un corredor en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el corredor a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el corredor a buscar.
     * @param string $id, id del corredor a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionInterruptorCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM interruptor_corredor WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Interruptor-Corredor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Interruptor-Corredor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de los interruptores del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una cubierta en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la cubierta a buscar.
     * @param string $nombre_campus, id del campus donde está la cubierta a buscar.
     * @param string $nombre_edificio, id del edificio al que pertenece la cubierta a buscar.
     * @param string $piso, piso donde se encuentra la cubierta.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionCubierta($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT a.piso, b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, d.id AS id_edificio, d.nombre AS nombre_edificio, a.largo, a.ancho, a.id_material_cubierta, a.id_tipo_cubierta, d.lat, d.lng
                FROM cubiertas_piso a JOIN sede b ON a.id_sede = b.id
                                      JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                      JOIN edificio d ON a.id_edificio = d.id
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id_edificio = '".$nombre_edificio."' AND a.piso = '".$piso."' ORDER BY a.piso;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Cubierta 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Cubierta 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la cubierta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de unas gradas en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenecen las gradas a buscar.
     * @param string $nombre_campus, id del campus donde están las gradas a buscar.
     * @param string $nombre_edificio, id del edificio al que pertenecen las gradas a buscar.
     * @param string $piso, piso donde inician las gradas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, d.id AS id_edificio, d.nombre AS nombre_edificio, a.piso_inicio, a.pasamanos, a.id_material_pasamanos, d.lat, d.lng
                FROM gradas a JOIN sede b ON a.id_sede = b.id
                              JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                              JOIN edificio d ON a.id_edificio = d.id
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id_edificio = '".$nombre_edificio."' AND a.piso_inicio = '".$piso."' ORDER BY a.piso_inicio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Gradas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Gradas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de las gradas seleccionadas";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de las ventanas de unas gradas en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenecen las gradas a buscar.
     * @param string $nombre_campus, id del campus donde están las gradas a buscar.
     * @param string $nombre_edificio, id del edificio al que pertenecen las gradas a buscar.
     * @param string $piso, piso donde inician las gradas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionVentanaGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM ventana_gradas WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_inicio = '".$piso."' ORDER BY piso_inicio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Ventana-Gradas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Ventana-Gradas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de las ventanas de las gradas seleccionadas";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un parqueadero en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el parqueadero a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el parqueadero a buscar.
     * @param string $id, id del parqueadero a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionParqueadero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.id, a.largo, a.ancho, a.capacidad, a.longitud_demarcacion, a.id_material_piso, a.id_tipo_pintura_demarcacion, a.lat, a.lng
                FROM parqueadero a  JOIN sede b ON a.id_sede = b.id
                                    JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Parqueadero 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Parqueadero 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del parqueadero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una piscina en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la piscina a buscar.
     * @param string $nombre_campus, id del campus al que pertenece la piscina a buscar.
     * @param string $id, id de la piscina a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionPiscina($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.id, a.cantidad_punto_hidraulico, a.largo, a.ancho, a.alto, a.lat, a.lng
                FROM piscina a  JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Piscina 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Piscina 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la piscina seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una plazoleta en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la plazoleta a buscar.
     * @param string $nombre_campus, id del campus al que pertenece la plazoleta a buscar.
     * @param string $id, id de la plazoleta a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionPlazoleta($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.id, a.nombre, a.lat, a.lng
                FROM plazoleta a  JOIN sede b ON a.id_sede = b.id
                                  JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la plazoleta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de la iluminación de una plazoleta en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la plazoleta a buscar.
     * @param string $nombre_campus, id del campus al que pertenece la plazoleta a buscar.
     * @param string $id, id de la plazoleta a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionIluminacionPlazoleta($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM iluminacion_plazoleta WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Iluminación-Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Iluminación-Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la iluminación de la plazoleta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un sendero en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el sendero a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el sendero a buscar.
     * @param string $id, id del sendero a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionSendero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.id, a.longitud, a.ancho, a.id_material_piso, a.id_tipo_iluminacion, a.cantidad, a.codigo_poste, a.id_material_cubierta, a.ancho_cubierta, a.largo_cubierta, a.lat, a.lng
                FROM sendero a  JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Sendero 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Sendero 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del sendero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una vía en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la vía a buscar.
     * @param string $nombre_campus, id del campus al que pertenece la vía a buscar.
     * @param string $id, id de la vía a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionVia($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.id, a.id_tipo_material, a.id_tipo_pintura_demarcacion, a.longitud_demarcacion, a.lat, a.lng
                FROM via a  JOIN sede b ON a.id_sede = b.id
                            JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Vía 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Vía 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la vía seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un edificio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el edificio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el edificio a buscar.
     * @param string $id, id del edificio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionEdificio($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, a.id, a.nombre, a.numero_pisos, a.sotano, a.terraza, a.id_material_fachada, a.ancho_fachada, a.alto_fachada, a.lat, a.lng
                FROM edificio a JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Edificio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Edificio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del edificio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un artículo.
     * @param string $id_articulo, id del artículo a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionArticulo($id_articulo){
        $id_articulo = htmlspecialchars(trim($id_articulo));
        $sql = "SELECT a.id_articulo, a.nombre, a.marca AS id_marca, b.nombre AS nombre_marca, a.id_categoria_articulo, c.nombre AS nombre_categoria, a.bodega, a.cantidad_minima
                FROM articulo a JOIN marca_inventario b ON a.marca = b.id
                                LEFT JOIN categoria_articulo c ON a.id_categoria_articulo = c.id
                WHERE a.id_articulo = '".$id_articulo."' ORDER BY a.nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Artículo 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Artículo 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del artículo seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un artículo.
     * @param string $nombre_articulo, nombre del artículo a buscar.
     * @param string $marca, id de la marca.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionArticuloNombre($nombre_articulo,$marca){
        $nombre_articulo = htmlspecialchars(trim($nombre_articulo));
        $sql = "SELECT a.id_articulo, a.nombre, a.marca AS id_marca, b.nombre AS nombre_marca, a.id_categoria_articulo, c.nombre AS nombre_categoria, a.bodega, a.cantidad_minima
                FROM articulo a JOIN marca_inventario b ON a.marca = b.id
                                LEFT JOIN categoria_articulo c ON a.id_categoria_articulo = c.id
                WHERE a.nombre = '".$nombre_articulo."' and a.marca = '".$marca."' ORDER BY a.nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Artículo Nombre 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Artículo Nombre 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del artículo";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una marca.
     * @param string $nombre, nombre de la marca.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionMarca($nombre){
        $nombre = htmlspecialchars(trim($nombre));
        $sql = "SELECT * FROM marca_inventario WHERE nombre = '".$nombre."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Marca 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Marca 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la marca seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una categoría.
     * @param string $nombre, nombre de la categoría.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionCategoria($nombre){
        $nombre = htmlspecialchars(trim($nombre));
        $sql = "SELECT * FROM categoria_articulo WHERE nombre = '".$nombre."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Categoría 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Categoría 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la categoría seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un proveedor.
     * @param string $nombre, nombre del proveedor.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionProveedor($nombre){
        $nombre = htmlspecialchars(trim($nombre));
        $sql = "SELECT * FROM proveedor WHERE nombre = '".$nombre."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Proveedor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Proveedor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del proveedor seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un artículo y su proveedor.
     * @param string $id_articulo, id del artículo a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArticuloProveedor($id_articulo){
        $id_articulo = htmlspecialchars(trim($id_articulo));
        $sql = "SELECT a.id_articulo, a.id_proveedor, b.nombre AS nombre_proveedor
                FROM articulo_proveedor a JOIN proveedor b ON a.id_proveedor = b.id_proveedor
                WHERE a.id_articulo = '".$id_articulo."' ORDER BY b.nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Artículo-Proveedor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Artículo-Proveedor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de los proveedores del artículo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un campus en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el campus.
     * @param string $nombre_campus, id del campus.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM campus_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY tipo,nombre;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del campus seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una cancha en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la cancha.
     * @param string $nombre_campus, id del campus donde está la cancha.
     * @param string $id, id de la cancha..
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosCancha($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM cancha_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Cancha 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Cancha 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la cancha seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un corredor en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el corredor.
     * @param string $nombre_campus, id del campus donde está el corredor.
     * @param string $id, id del corredor.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM corredor_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Corredor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Corredor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una cubierta en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la cubierta.
     * @param string $nombre_campus, id del campus donde está la cubierta.
     * @param string $nombre_edificio, id del edificio donde está la cubierta.
     * @param string $piso, piso del edificio donde está la cubierta.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosCubierta($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM cubiertas_piso_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso = '".$piso."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Cubierta 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Cubierta 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la cubierta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de unas gradas en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenecen las gradas.
     * @param string $nombre_campus, id del campus donde están las gradas.
     * @param string $nombre_edificio, id del edificio donde están las gradas.
     * @param string $piso, piso del edificio donde están las gradas.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM gradas_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_inicio = '".$piso."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Gradas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Gradas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de las gradas seleccionadas";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un parqueadero en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el parqueadero.
     * @param string $nombre_campus, id del campus donde está el parqueadero.
     * @param string $id, id del parqueadero.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosParqueadero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM parqueadero_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Parqueadero 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Parqueadero 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del parqueadero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una piscina en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la piscina.
     * @param string $nombre_campus, id del campus donde está la piscina.
     * @param string $id, id de la piscina.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosPiscina($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM piscina_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Piscina 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Piscina 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la piscina seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una plazoleta en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la plazoleta.
     * @param string $nombre_campus, id del campus donde está la plazoleta.
     * @param string $id, id de la plazoleta.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosPlazoleta($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM plazoleta_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la plazoleta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un sendero en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el sendero.
     * @param string $nombre_campus, id del campus donde está el sendero.
     * @param string $id, id del sendero.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosSendero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM sendero_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Sendero 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Sendero 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del sendero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una vía en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la vía.
     * @param string $nombre_campus, id del campus donde está la vía.
     * @param string $id, id de la vía.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosVia($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM via_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Vía 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Vía 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la vía seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un edificio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el edificio.
     * @param string $nombre_campus, id del campus donde está el edificio.
     * @param string $id_edificio, id del edificio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosEdificio($nombre_sede,$nombre_campus,$id_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $sql = "SELECT * FROM edificio_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$id_edificio."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Edificio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Edificio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del edificio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio.
     * @param string $nombre_campus, id del campus donde está el espacio.
     * @param string $nombre_edificio, id del edificio donde está el espacio.
     * @param string $id_edificio, id del espacio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM espacio_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un aire acondicionado en el sistema.
     * @param string $id_aire, id del aire.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosAireId($id_aire){
        $id_aire = htmlspecialchars(trim($id_aire));
        $sql = "SELECT * FROM aire_acondicionado_archivos WHERE id_aire = '".$id_aire."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del aire acondicionado seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un artículo en el sistema.
     * @param string $id_artículo, id del artículo.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosArticulo($id_articulo){
        $id_articulo = htmlspecialchars(trim($id_articulo));
        $sql = "SELECT * FROM articulo_archivos WHERE id_articulo = '".$id_articulo."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Artículo 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Artículo 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del artículo seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un aire acondicionado en el sistema.
     * @param string $numero_inventario, numero de inventario del aire.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArchivosAireNumeroInventario($numero_inventario){
        $numero_inventario = htmlspecialchars(trim($numero_inventario));
        $sql = "SELECT * FROM aire_acondicionado_archivos WHERE numero_inventario = '".$numero_inventario."' ORDER BY tipo,nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Archivos Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del aire acondicionado seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los mantenimientos a un aire acondicionado.
     * @param string $id_aire, número de la orden de mantenimiento.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMantenimientosAire($id_aire){
        $id_aire = htmlspecialchars(trim($id_aire));
        $sql = "SELECT * FROM mantenimiento_aire WHERE id_aire = '".$id_aire."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Mantenimientos Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Mantenimientos Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el inventario.
     * @param string $bodega, bodega a la que se va a consultar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInventario($bodega){
        $sql = "SELECT a.id_articulo, a.cantidad, b.nombre AS nombre_articulo, b.cantidad_minima, b.marca, c.nombre AS nombre_marca, b.id_categoria_articulo, d.nombre AS nombre_categoria, b.bodega
                FROM inventario a   JOIN articulo b ON a.id_articulo = b.id_articulo
                                    JOIN marca_inventario c ON b.marca = c.id
                                    LEFT JOIN categoria_articulo d ON b.id_categoria_articulo = d.id
                WHERE b.bodega = '".$bodega."'
                ORDER BY b.nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Inventario 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Inventario 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el inventario.
     * @param string $fecha_inicio, fecha desde la cual se va a buscar.
     * @param string $fecha_fin, fecha hasta la cual se va a buscar.
     * @param string $bodega, bodega a la que se va a consultar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMovimientosInventario($fecha_inicio,$fecha_fin,$bodega){
        $fecha_inicio = htmlspecialchars(trim($fecha_inicio));
        $fecha_fin = htmlspecialchars(trim($fecha_fin));
        $sql = "SELECT a.id_objeto AS id_articulo, b.nombre AS nombre_articulo, a.valor_nuevo, a.valor_antiguo, c.nombre AS nombre_marca, a.fecha, d.nombre_usuario AS usuario, e.nombre AS nombre_categoria
                FROM modificaciones a   JOIN articulo b ON a.id_objeto = b.id_articulo
                                        JOIN marca_inventario c ON b.marca = c.id
                                        JOIN usuarios d ON a.usuario = d.login
                                        LEFT JOIN categoria_articulo e ON b.id_categoria_articulo = e.id
                WHERE a.tabla_modificacion = 'inventario' AND a.fecha BETWEEN '".$fecha_inicio."' AND '".$fecha_fin."' AND b.bodega = '".$bodega."'
                ORDER BY a.fecha;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Movimientos Inventario 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Movimientos Inventario 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar un artículo en el inventario.
     * @param string $id_articulo, id del artículo a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArticuloInventario($id_articulo){
        $id_articulo = htmlspecialchars(trim($id_articulo));
        $sql = "SELECT * FROM inventario WHERE id_articulo = '".$id_articulo."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Artículo Inventario 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Artículo Inventario 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar los artículos.
     * @param string $bodega, bodega a la que se va a consultar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArticulos($bodega){
        $sql = "SELECT a.id_articulo, a.nombre, a.marca AS id_marca, b.nombre AS nombre_marca, a.cantidad_minima, c.cantidad
                FROM articulo a RIGHT JOIN marca_inventario b ON a.marca = b.id
                                LEFT JOIN inventario c ON a.id_articulo = c.id_articulo
                WHERE a.bodega = '".$bodega."'
                ORDER BY a.nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Inventario 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Inventario 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de un campus en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el campus.
     * @param string $nombre_campus, id del campus.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT id,nombre,lat,lng FROM campus WHERE sede = '".$nombre_sede."' AND id = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación del campus seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de una cancha en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la cancha.
     * @param string $nombre_campus, id de la cancha al que pertenece la cancha.
     * @param string $id, id de la cancha.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionCancha($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,uso,lat,lng FROM cancha WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Cancha 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Cancha 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación de la cancha seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de un corredor en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece al corredor.
     * @param string $nombre_campus, id del campus al que pertenece al corredor.
     * @param string $id, id del corredor.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,lat,lng FROM corredor WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Corredor 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Corredor 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de un parqueadero en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el parqueadero.
     * @param string $nombre_campus, id del campus al que pertenece el parqueadero.
     * @param string $id, id del parqueadero.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionParqueadero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,lat,lng FROM parqueadero WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación parqueadero 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación parqueadero 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación del parqueadero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de una piscina en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la piscina.
     * @param string $nombre_campus, id del campus al que pertenece la piscina.
     * @param string $id, id de la piscina.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionPiscina($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,lat,lng FROM piscina WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Piscina 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Piscina 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación de la piscina seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de una plazoleta en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la plazoleta.
     * @param string $nombre_campus, id del campus al que pertenece la plazoleta.
     * @param string $id, id de la plazoleta.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionPlazoleta($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,nombre,lat,lng FROM plazoleta WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación de la plazoleta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de una sendero en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el sendero.
     * @param string $nombre_campus, id del campus al que pertenece el sendero.
     * @param string $id, id del sendero.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionSendero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,lat,lng FROM sendero WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Sendero 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Sendero 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación del sendero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de una vía en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece la vía.
     * @param string $nombre_campus, id del campus al que pertenece la vía.
     * @param string $id, id de la cancha.
      * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionVia($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT id,lat,lng FROM via WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Vía 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Vía 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación de la vía seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la ubicación de un edificio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el edificio.
     * @param string $nombre_campus, id del campus al que pertenece el edificio..
     * @param string $nombre_edificio, id del edificio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function ubicacionEdificio($nombre_sede,$nombre_campus,$nombre_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $sql = "SELECT id,nombre,numero_pisos,sotano,terraza,lat,lng FROM edificio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$nombre_edificio."' ORDER BY id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Edificio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Ubicación Edificio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ubicación del edificio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar el número de pisos de un edificio que se han creado en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenecen los espacios.
     * @param string $nombre_campus, id del campus donde están los espacios..
     * @param string $nombre_edificio, id del edificio donde están los espacios a buscar.
     * @param string $piso, piso del edificio donde están los espacios.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarPisosEdificio($nombre_sede,$nombre_campus,$nombre_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $sql = "SELECT id,numero_pisos,terraza,sotano FROM edificio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$nombre_edificio."' ORDER BY id;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Número de pisos del edificio";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los diferentes usos de espacio creados en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarUsosEspacios(){
        $sql = "SELECT id,uso FROM uso_espacio ORDER BY uso;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Usos de Espacios presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los materiales que se han creado en el sistema.
     * @param string $tipo_material, tipo de material a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMateriales($tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $sql = "SELECT id,material FROM ".$tipo_material." ORDER BY material;";
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Materiales presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los tipo de objetos que se han creado en el sistema.
     * @param string $tipo_objeto, tipo de objeto a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarTipoObjetos($tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        if (strcmp($tipo_objeto,"tipo_periodicidad_mantenimiento") == 0) {
            $sql = "SELECT id,tipo FROM ".$tipo_objeto." ORDER BY id ASC;";
        }else{
            $sql = "SELECT id,tipo FROM ".$tipo_objeto." ORDER BY tipo;";
        }
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
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Tipos de objetos presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las marcas almacenadas en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMarcas($bodega){
        $sql = "SELECT * FROM marca_inventario WHERE bodega = '".$bodega."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Marcas presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las categorías almacenadas en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCategorias($bodega){
        $sql = "SELECT * FROM categoria_articulo WHERE bodega = '".$bodega."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Categorías 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Categorías 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Categorías presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los proveedores almacenados en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarProveedores($bodega){
        $sql = "SELECT * FROM proveedor WHERE bodega = '".$bodega."' ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Proveedores 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Proveedores 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Proveedores presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de la iluminación de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionIluminacionEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM iluminacion_espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY id_tipo_iluminacion,id_espacio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Iluminación-Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Iluminación-Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la iluminación del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de los interruptores de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionInterrutorEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM interruptor_espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY id_tipo_interruptor,id_espacio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Interruptor-Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Interruptor-Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de los interruptores del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de las puertas de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionPuertaEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM puerta_espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY id_tipo_puerta,id_material_puerta,id_material_marco,id_espacio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Puerta-Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Puerta-Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de las puertas del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información del tipo de cerradura de una puerta de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionPuertaTipoCerradura($nombre_sede,$nombre_campus,$nombre_edificio,$id,$tipo_puerta,$material_puerta,$material_marco){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_marco = htmlspecialchars(trim($material_marco));
        $sql = "SELECT * FROM puerta_tipo_cerradura WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."'  AND id_tipo_puerta = '".$tipo_puerta."'  AND id_material_puerta = '".$material_puerta."'  AND id_material_marco = '".$material_marco."' ORDER BY id_tipo_cerradura;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Puerta-Tipo Cerradura 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Puerta-Tipo Cerradura 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la cerradura de las puertas del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información del suministro de energía de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionSuministroEnergiaEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM suministro_energia_espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY id_tipo_suministro_energia,id_espacio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Suministro Energía-Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Suministro Energía-Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del suministro de energía del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de las ventanas de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionVentanaEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM ventana_espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY id_tipo_ventana,id_material,id_espacio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Ventana-Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Ventana-Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de las ventanas del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un uso de espacio (salón, laboratorio, oficina, etc.) en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @param string $uso_espacio, uso del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionUsoEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id,$uso_espacio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $uso_espacio = htmlspecialchars(trim($uso_espacio));
        $sql = "SELECT * FROM ".$uso_espacio." WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id_espacio = '".$id."' ORDER BY id_espacio;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Salón 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Salón 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del tipo de espacio seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las capacidades de los aires acondicionados en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCapacidadesAire(){
        $sql = "SELECT * FROM capacidad_aire ORDER BY cast(capacidad AS int);";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Capacidades Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Capacidades Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las marcas de los aires acondicionados en el sistema.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMarcasAire(){
        $sql = "SELECT * FROM marca_aire ORDER BY nombre;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un aire acondicionado por número de inventario.
     * @param string $numero_inventario, número de inventario del aire acondicionado.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function listarInventarioAiresAcondicionados(){
        $result = array();
        $sql = "SELECT a.id_sede, e.nombre AS nombre_sede, a.id_campus, d.nombre AS nombre_campus, a.id_edificio, c.nombre AS nombre_edificio, a.piso, a.id_espacio, a.id_aire, a.numero_inventario, i.capacidad AS capacidad, f.nombre AS marca, a.modelo, g.tipo AS tipo, h.tipo AS tecnologia, a.fecha_instalacion, a.instalador, a.periodicidad_mantenimiento, a.ubicacion_condensadora, a.responsable
                FROM aire_acondicionado a   JOIN edificio c ON a.id_sede = c.id_sede AND a.id_campus = c.id_campus AND a.id_edificio = c.id
                                            JOIN campus d ON a.id_sede = d.sede AND a.id_campus = d.id
                                            JOIN sede e ON a.id_sede = e.id
                                            LEFT JOIN marca_aire f ON a.marca = f.id
                                            LEFT JOIN tipo_aire g ON a.tipo = g.id
                                            LEFT JOIN tipo_tecnologia_aire h ON a.tecnologia = h.id
                                            LEFT JOIN capacidad_aire i ON a.capacidad = i.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Listar Inventario Aires Acondicionados 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Listar Inventario Aires Acondicionados 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del aire acondicionado seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un aire acondicionado por número de inventario.
     * @param string $numero_inventario, número de inventario del aire acondicionado.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarAireNumeroInventario($numero_inventario){
        $numero_inventario = htmlspecialchars(trim($numero_inventario));
        $result = array();
        $sql = "SELECT a.id_sede, e.nombre AS nombre_sede, a.id_campus, d.nombre AS nombre_campus, a.id_edificio, c.nombre AS nombre_edificio, a.piso, a.id_espacio, a.id_aire, a.numero_inventario, a.capacidad, a.marca, a.modelo, a.tipo, a.tecnologia, a.fecha_instalacion, a.instalador, a.periodicidad_mantenimiento, a.ubicacion_condensadora, a.responsable
                FROM aire_acondicionado a   JOIN edificio c ON a.id_sede = c.id_sede AND a.id_campus = c.id_campus AND a.id_edificio = c.id
                                            JOIN campus d ON a.id_sede = d.sede AND a.id_campus = d.id
                                            JOIN sede e ON a.id_sede = e.id
                WHERE numero_inventario = '".$numero_inventario."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Aire Número Inventario 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Aire Número Inventario 2)";
                $GLOBALS['sql'] = $sql;
            }elseif($l_stmt->rowCount() == 0){
                $GLOBALS['mensaje'] = "El aire acondicionado con número de inventario ".$numero_inventario." no se encuentra registrado en el sistema";
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del aire acondicionado seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un aire acondicionado por número de inventario.
     * @param string $idAire, id del aire acondicionado.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarAireId($idAire){
        $numero_inventario = htmlspecialchars(trim($idAire));
        $sql = "SELECT a.id_sede, e.nombre AS nombre_sede, a.id_campus, d.nombre AS nombre_campus, a.id_edificio, c.nombre AS nombre_edificio, a.piso, a.id_espacio, a.id_aire, a.numero_inventario, a.capacidad, a.marca, a.modelo, a.tipo, a.tecnologia, a.fecha_instalacion, a.instalador, a.periodicidad_mantenimiento, a.ubicacion_condensadora, a.responsable
                FROM aire_acondicionado a   JOIN edificio c ON a.id_sede = c.id_sede AND a.id_campus = c.id_campus AND a.id_edificio = c.id
                                            JOIN campus d ON a.id_sede = d.sede AND a.id_campus = d.id
                                            JOIN sede e ON a.id_sede = e.id
                WHERE id_aire = '".$idAire."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Aire Id 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Aire Id 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del aire acondicionado seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un aire acondicionado por ubicación.
     * @param string $id_sede, id de la sede donde está el aire.
     * @param string $id_campus, id del campus donde está el aire.
     * @param string $id_edificio, id del edificio donde está el aire.
     * @param string $id_espacio, id del espacio donde está el aire.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarAiresUbicacion($id_sede,$id_campus,$id_edificio,$id_espacio){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $sql = "SELECT a.id_aire, a.numero_inventario, a.id_sede, a.id_campus, a.id_edificio, a.piso, a.id_espacio, a.capacidad, a.marca, b.nombre AS marca_aire, a.modelo, a.capacidad, c.capacidad AS numero_capacidad, a.tipo, d.tipo AS tipo_aire, a.tecnologia, e.tipo AS tecnologia_aire, a.fecha_instalacion, a.instalador, a.periodicidad_mantenimiento, a.ubicacion_condensadora, a.responsable
                FROM aire_acondicionado a  JOIN marca_aire b ON a.marca = b.id
                                                    JOIN capacidad_aire c ON a.capacidad = c.id
                                                    JOIN tipo_aire d ON a.tipo = d.id
                                                    JOIN tipo_tecnologia_aire e ON a.tecnologia = e.id
                WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id_espacio."' ORDER BY cast(a.id_aire AS int);";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Aire-Ubicación 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Aire-Ubicación 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar una capacidad de aires acondicionados.
     * @param string $id, id de la capacidad.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarCapacidadAires($id){
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM capacidad_aire WHERE id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Capacidad Aires 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Capacidad Aires 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar una marca de aires acondicionados.
     * @param string $id, id de la marca.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMarcaAires($id){
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM marca_aire WHERE id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Marca Aires 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Marca Aires 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un tipo de aires acondicionados.
     * @param string $id, id del tipo.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarTipoAires($id){
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM tipo_aire WHERE id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Tipo Aires 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Tipo Aires 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un tipo de aires acondicionados.
     * @param string $id, id del tipo.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarTecnologiaAires($id){
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM tipo_tecnologia_aire WHERE id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Tecnlogia Aires 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Tecnlogia Aires 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar un mantenimiento a un aire acondicionado.
     * @param string $numero_orden, número de la orden de mantenimiento.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMantenimientoAire($numero_orden){
        $numero_orden = htmlspecialchars(trim($numero_orden));
        $sql = "SELECT * FROM mantenimiento_aire WHERE numero_orden = '".$numero_orden."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Mantenimiento Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Mantenimiento Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
            }
        }
        return $result;
    }

    /**
     * Función que permite verificar si un número de inventario ya está registrado.
     * @param string $numero_inventario, número de inventario a consultar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function verificarNumeroInventarioAire($numero_inventario){
        $numero_inventario = htmlspecialchars(trim($numero_inventario));
        $sql = "SELECT count(numero_inventario), numero_inventario FROM aire_acondicionado WHERE numero_inventario = '".$numero_inventario."' GROUP BY numero_inventario;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Número Inventario Aire 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Número Inventario Aire 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar las marcas de aires más instaladas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMarcasMasInstaladas($id_sede,$id_campus,$id_edificio){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        if (strcmp($id_sede,"todos") == 0) {
            $where = "";
        }elseif(strcmp($id_campus,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."'";
        }elseif(strcmp($id_edificio,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."'";
        }else{
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."'";
        }
        $sql = "SELECT count(a.marca) AS conteo, c.nombre AS marca
                FROM aire_acondicionado a   JOIN mantenimiento_aire b ON a.id_aire = b.id_aire
                                            JOIN marca_aire c ON a.marca = c.id
                ".$where."
                GROUP BY a.marca, c.nombre ORDER BY conteo DESC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas Más Instaladas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas Más Instaladas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar los tipos de aires más instalados.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarTiposMasInstalados($id_sede,$id_campus,$id_edificio){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        if (strcmp($id_sede,"todos") == 0) {
            $where = "";
        }elseif(strcmp($id_campus,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."'";
        }elseif(strcmp($id_edificio,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."'";
        }else{
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."'";
        }
        $sql = "SELECT count(a.tipo) AS conteo, c.tipo
                FROM aire_acondicionado a   JOIN mantenimiento_aire b ON a.id_aire = b.id_aire
                                            JOIN tipo_aire c ON a.tipo = c.id
                ".$where."
                GROUP BY a.tipo, c.tipo ORDER BY conteo DESC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Tipos Más Instalados 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Tipos Más Instalados 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar las tecnologías de aires más instaladas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarTipoTecnologiasMasInstaladas($id_sede,$id_campus,$id_edificio){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        if (strcmp($id_sede,"todos") == 0) {
            $where = "";
        }elseif(strcmp($id_campus,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."'";
        }elseif(strcmp($id_edificio,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."'";
        }else{
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."'";
        }
        $sql = "SELECT count(a.tecnologia) AS conteo, c.tipo
                FROM aire_acondicionado a   JOIN mantenimiento_aire b ON a.id_aire = b.id_aire
                                            JOIN tipo_tecnologia_aire c ON a.tecnologia = c.id
                ".$where."
                GROUP BY a.tecnologia, c.tipo ORDER BY conteo DESC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Tecnologías Más Instaladas 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Tecnologías Más Instaladas 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar los aires con más mantenimientos.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $fechaInicio, fecha inicio.
     * @param string $fechaFin, fecha fin.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarAiresMasMantenimientos($id_sede,$id_campus,$id_edificio,$fechaInicio,$fechaFin){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        if (strcmp($id_sede,"todos") == 0) {
            $where = "WHERE a.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }elseif(strcmp($id_campus,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND a.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }elseif(strcmp($id_edificio,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND a.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }else{
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND a.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }
        $sql = "SELECT count(a.id_aire) AS conteo, a.id_aire, b.numero_inventario, c.nombre AS marca
                FROM mantenimiento_aire a   JOIN aire_acondicionado b ON a.id_aire = b.id_aire
                                            JOIN marca_aire c ON b.marca = c.id
                ".$where."
                GROUP BY a.id_aire, b.numero_inventario, c.nombre ORDER BY conteo DESC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Aires Más Mantenimientos 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Aires Más Mantenimientos 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar las marcas de aires con más mantenimientos.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $fechaInicio, fecha inicio.
     * @param string $fechaFin, fecha fin.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarMarcasMasMantenimientos($id_sede,$id_campus,$id_edificio,$fechaInicio,$fechaFin){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        if (strcmp($id_sede,"todos") == 0) {
            $where = "WHERE b.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }elseif(strcmp($id_campus,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND b.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }elseif(strcmp($id_edificio,"todos") == 0){
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND b.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }else{
            $where = "WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND b.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."'";
        }
        $sql = "SELECT count(a.marca) AS conteo, c.nombre AS marca
                FROM aire_acondicionado a   JOIN mantenimiento_aire b ON a.id_aire = b.id_aire
                                            JOIN marca_aire c ON a.marca = c.id
                ".$where."
                GROUP BY a.marca,c.nombre ORDER BY conteo DESC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas Más Mantenimientos 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Marcas Más Mantenimientos 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar las artículos con más usados entre dos fechas.
     * @param string $bodega, bodega a consultar.
     * @param string $fechaInicio, fecha inicio.
     * @param string $fechaFin, fecha fin.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArticulosMasUsados($bodega,$fechaInicio,$fechaFin){
        $bodega = htmlspecialchars(trim($bodega));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        $sql = "SELECT b.nombre, SUM(CAST(a.valor_antiguo AS INT) - CAST(split_part(a.valor_nuevo, '-', 1) AS INT)) AS suma
                FROM modificaciones a JOIN articulo b ON a.id_objeto = b.id_articulo
                WHERE b.bodega = '".$bodega."' AND CAST(a.valor_antiguo AS INT) > CAST(split_part(a.valor_nuevo, '-', 1) AS INT) AND a.tabla_modificacion = 'inventario' AND a.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND a.valor_antiguo <> '' AND a.valor_nuevo <> ''
                GROUP BY b.nombre ORDER BY suma DESC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Artículos Más Usados 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Artículos Más Usados 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar las artículos con menos usados entre dos fechas.
     * @param string $bodega, bodega a consultar.
     * @param string $fechaInicio, fecha inicio.
     * @param string $fechaFin, fecha fin.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarArticulosMenosUsados($bodega,$fechaInicio,$fechaFin){
        $bodega = htmlspecialchars(trim($bodega));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        $sql = "SELECT b.nombre, SUM(CAST(a.valor_antiguo AS INT) - CAST(split_part(a.valor_nuevo, '-', 1) AS INT)) AS suma
                FROM modificaciones a JOIN articulo b ON a.id_objeto = b.id_articulo
                WHERE b.bodega = '".$bodega."' AND CAST(a.valor_antiguo AS INT) > CAST(split_part(a.valor_nuevo, '-', 1) AS INT) AND a.tabla_modificacion = 'inventario' AND a.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND a.valor_antiguo <> '' AND a.valor_nuevo <> ''
                GROUP BY b.nombre ORDER BY suma ASC LIMIT 10;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Artículos Menos Usados 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Artículos Menos Usados 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un espacio en el sistema.
     * @param string $nombre_sede, id de la sede al que pertenece el espacio a buscar.
     * @param string $nombre_campus, id del campus al que pertenece el espacio a buscar.
     * @param string $nombre_edificio, id del espacio al que pertenece el edificio a buscar.
     * @param string $id, id del espacio a buscar.
     * @return metadata con el resultado de la búsqueda.
    **/
    public function buscarInformacionEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT b.id AS id_sede, b.nombre AS nombre_sede, c.id AS id_campus, c.nombre AS nombre_campus, d.id AS id_edificio, d.nombre AS nombre_edificio, a.id, a.piso_edificio, a.uso_espacio, a.ancho_pared, a.alto_pared, a.id_material_pared, a.ancho_piso, a.largo_piso, a.id_material_piso, a.ancho_techo, a.largo_techo, a.id_material_techo, a.espacio_padre, d.lat, d.lng
                FROM espacio a  JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id AND a.id_sede = c.sede
                                JOIN edificio d ON a.id_sede = d.id_sede AND a.id_campus = d.id_campus AND a.id_edificio = d.id
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' AND a.id_edificio = '".$nombre_edificio."' AND a.id = '".$id."' ORDER BY a.id;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Espacio 1)";
            $GLOBALS['sql'] = $sql;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Buscar Información Espacio 2)";
                $GLOBALS['sql'] = $sql;
            }
            if($l_stmt->rowCount() >= 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del espacio seleccionado";
            }
        }
        return $result;
    }
}
?>
