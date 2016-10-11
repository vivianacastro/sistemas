<?php
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
     * Función que permite buscar las sedes que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Sedes presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los campus que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarCampus($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        if (strcmp($nombre_sede,"") == 0) {
            $sql = "SELECT a.id,a.nombre,a.lat,a.lng,b.nombre as nombre_sede FROM campus a JOIN sede b ON a.sede = b.id ORDER BY a.nombre;";
        }else{
            $sql = "SELECT * FROM campus WHERE sede = '".$nombre_sede."' ORDER BY nombre;";
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
     * Función que permite buscar las canchas que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarCanchas($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.uso,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM cancha a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM cancha WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Canchas del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los corredores que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarCorredores($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM corredor a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM corredor WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Corredores del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las cubiertas que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarCubiertas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0 AND strcmp($nombre_edificio,"") == 0 AND strcmp($piso,"") == 0) {
            $sql = "SELECT a.piso,b.nombre as nombre_sede,c.nombre as nombre_campus,a.id_edificio as id_edificio,d.nombre as nombre_edificio
                    FROM cubiertas_piso a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id JOIN edificio d ON a.id_edificio = d.id ORDER BY a.piso;";
        }else{
            $sql = "SELECT * FROM cubiertas_piso WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso = '".$piso."' ORDER BY piso;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Cubiertas del edificio seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las gradas que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.piso_inicio,b.nombre as nombre_sede,c.nombre as nombre_campus,d.nombre as nombre_edificio,d.id as id_edificio
                    FROM gradas a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id JOIN edificio d ON a.id_edificio = d.id ORDER BY a.piso_inicio;";
        }else{
            $sql = "SELECT * FROM corredor WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_inicio = '".$piso."' ORDER BY piso_inicio;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Gradas del edificio seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los parqueaderos que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarParqueaderos($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM parqueadero a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM parqueadero WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Parqueaderos del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las piscinas que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarPiscinas($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM piscina a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM piscina WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Piscinas del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las plazoletas que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarPlazoletas($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM plazoleta a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM plazoleta WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Plazoletas del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los senderos que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarSenderos($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM sendero a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM sendero WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Senderos del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar las vías que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarVias($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        if (strcmp($nombre_sede,"") == 0 AND strcmp($nombre_campus,"") == 0) {
            $sql = "SELECT a.id,a.lat,a.lng,b.nombre as nombre_sede,c.nombre as nombre_campus
                    FROM via a JOIN sede b ON a.id_sede = b.id JOIN campus c ON a.id_campus = c.id ORDER BY a.id;";
        }else{
            $sql = "SELECT * FROM via WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Vías del campus seleccionado presentes en el sistema";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un campus en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del campus seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una cancha en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionCancha($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id, b.nombre as nombre_sede, c.nombre as nombre_campus, a.uso, d.material as material_piso, e.tipo as tipo_pintura, a.longitud_demarcacion, a.lat, a.lng
                FROM cancha a JOIN sede b ON a.id_sede = b.id
                              JOIN campus c ON a.id_campus = c.id
                              LEFT JOIN material_piso d ON a.id_material_piso = d.id
                              LEFT JOIN tipo_pintura e ON a.id_tipo_pintura_demarcacion = e.id
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY a.id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la cancha seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un corredor en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id, b.nombre as nombre_sede, c.nombre as nombre_campus, a.ancho_pared, a.alto_pared, d.material as material_pared,
                        a.ancho_piso, a.largo_piso, e.material as material_piso,
                        a.ancho_techo, a.largo_techo, f.material as material_techo, a.tomacorriente, g.tipo as tipo_suministro_energia, a.cantidad, a.lat, a.lng
                FROM corredor a JOIN sede b ON a.id_sede = b.id
                                JOIN campus c ON a.id_campus = c.id
                                LEFT JOIN material_pared d ON a.id_material_pared = d.id
                                LEFT JOIN material_piso e ON a.id_material_piso = e.id
                                LEFT JOIN material_techo f ON a.id_material_techo = f.id
                                LEFT JOIN tipo_suministro_energia g ON a.id_tipo_suministro_energia = g.id
                WHERE a.id_sede = '".$nombre_sede."' AND a.id_campus = '".$nombre_campus."' ORDER BY a.id;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una cubierta en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionCubierta($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT a.piso, b.nombre as nombre_sede, c.nombre as nombre_campus, d.id as id_edificio, d.nombre as nombre_edificio, a.largo, a.ancho, e.material as material_cubierta, f.tipo as tipo_cubierta
                FROM cubiertas_piso a JOIN sede b ON a.id_sede = b.id
                              JOIN campus c ON a.id_campus = c.id
                              JOIN edificio d ON a.id_edificio = d.id
                              JOIN material_cubierta e ON a.id_material_cubierta = e.id
                              JOIN tipo_cubierta f ON a.id_tipo_cubierta = f.id
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la cubierta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de unas gradas en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede
                FROM gradas a JOIN sede b ON a.id_sede = b.id
                              JOIN campus c ON a.id_campus = c.id
                              JOIN edificio d ON a.id_edificio = d.id
                              JOIN material_pasamanos e ON a.id_material_pasamanos = d.id
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de las gradas seleccionadas";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un parqueadero en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionParqueadero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del parqueadero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una piscina en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionPiscina($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la piscina seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una plazoleta en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionPlazoleta($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la plazoleta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un sendero en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionSendero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del sendero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de una vía en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionVia($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información de la vía seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un edificio en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionEdificio($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del edificio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar la información de un espacio en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarInformacionEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT a.id as id_campus, a.nombre as nombre_campus, lat, lng, b.id as id_sede, b.nombre as nombre_sede FROM campus A JOIN sede B ON a.sede = b.id WHERE a.sede = '".$nombre_sede."' AND a.id = '".$nombre_campus."' ORDER BY a.nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Información del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un campus en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM campus_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' ORDER BY nombre;";
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
     * Función que permite buscar los archivos de una cancha en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosCancha($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM cancha_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la cancha seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un corredor en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosCorredor($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM corredor_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del corredor seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una cubierta en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosCubierta($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM cubiertas_piso_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso = '".$piso."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la cubierta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de unas gradas en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM gradas_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_inicio = '".$piso."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de las gradas seleccionadas";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un parqueadero en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosParqueadero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM parqueadero_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del parqueadero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una piscina en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosPiscina($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM piscina_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la piscina seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una plazoleta en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosPlazoleta($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM plazoleta_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la plazoleta seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de un sendero en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosSendero($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM sendero_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del sendero seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una vía en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosVia($nombre_sede,$nombre_campus,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM via_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos de la vía seleccionada";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una vía en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosEdificio($nombre_sede,$nombre_campus,$id_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $sql = "SELECT * FROM edificio_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_edificio."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del edificio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los archivos de una vía en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarArchivosEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$id){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM edificio_archivos WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso = '".$piso."' AND id = '".$id."' ORDER BY nombre;";
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Archivos del espacio seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los campus que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function ubicacionCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT nombre,lat,lng FROM campus WHERE sede = '".$nombre_sede."' and id = '".$nombre_campus."' ORDER BY id;";
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
     * Función que permite buscar los edificios que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarEdificios($nombre_campus){
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT a.id,a.nombre,a.id_campus,b.nombre as nombre_campus,a.id_sede,c.nombre as nombre_sede,a.numero_pisos,a.sotano,a.terraza,a.lat,a.lng,d.material as material_fachada,a.ancho_fachada,a.alto_fachada
                FROM edificio a JOIN campus b ON a.id_campus = b.id JOIN sede c ON a.id_sede = c.id LEFT JOIN material_fachada d ON a.id_material_fachada = d.id
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
     * Función que permite buscar el número de pisos de un edificio que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarPisosEdificio($nombre_campus,$nombre_edificio){
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $sql = "SELECT id,numero_pisos,terraza,sotano FROM edificio WHERE id_campus = '".$nombre_campus."' AND id = '".$nombre_edificio."' ORDER BY id;";
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
     * Función que permite buscar los diferentes usos de espacio creados en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Usos de Espacios presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los materiales que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
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
            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Materiales presentes en el sistema";
            }
        }
        return $result;
    }

    /**
     * Función que permite buscar los tipo de objetos que se han creado en el sistema.
     * @return metadata con el resultado de la busqueda.
     */
    public function buscarTipoObjetos($tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $sql = "SELECT id,tipo FROM ".$tipo_objeto." ORDER BY tipo;";
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
