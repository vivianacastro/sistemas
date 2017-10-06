<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase modelo_creacion
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
    **/
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
     * @param string $nombre_sede, nombre de la sede.
     * @return array
    **/
    public function guardarSede($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $sql = "INSERT INTO sede (nombre,usuario_crea) VALUES ('".$nombre_sede."','".$_SESSION["login"]."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sede 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sede 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La sede se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un campus.
     * @param string $nombre_sede, id de la sede a la que pertenece el edificio.
     * @param string $nombre_campus, id del campus a la que pertenece el campus.
     * @return array
    **/
    public function guardarCampus($nombre_sede,$nombre_campus,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $sql = "INSERT INTO campus (sede,nombre,lat,lng,usuario_crea) VALUES ('".$nombre_sede."','".$nombre_campus."','".$lat."','".$lng."','".$_SESSION["login"]."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Campus 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Campus 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El campus se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un edificio.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $nombre_edificio, nombre del edificio.
     * @param string $numero_pisos, número de pisos del edificio.
     * @param string $terraza, si el edificio tiene terraza.
     * @param string $sotano, si el edificio tiene sotano.
     * @param string $material_fachada, material de la fachada del edificio.
     * @param string $alto_fachada, alto de la fachada del edificio.
     * @param string $ancho_fachada, ancho de la fachada del edificio.
     * @param string $lat, latitud donde se encuentra el edificio.
     * @param string $lng, longitud donde se encuentra el edificio.
     * @return array
    **/
    public function guardarEdificio($nombre_sede,$nombre_campus,$id_edificio,$nombre_edificio,$numero_pisos,$terraza,$sotano,$material_fachada,$alto_fachada,$ancho_fachada,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $numero_pisos = htmlspecialchars(trim($numero_pisos));
        $terraza = htmlspecialchars(trim($terraza));
        $sotano = htmlspecialchars(trim($sotano));
        $material_fachada = htmlspecialchars(trim($material_fachada));
        $alto_fachada = htmlspecialchars(trim($alto_fachada));
        $ancho_fachada = htmlspecialchars(trim($ancho_fachada));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        if (strcasecmp($material_fachada,'') != 0){
            $sql = "INSERT INTO edificio (id,nombre,id_campus,numero_pisos,usuario_crea,sotano,terraza,id_sede,lat,lng,id_material_fachada,ancho_fachada,alto_fachada) VALUES ('".$id_edificio."','".$nombre_edificio."','".$nombre_campus."','".$numero_pisos."','".$_SESSION["login"]."','".$sotano."','".$terraza."','".$nombre_sede."','".$lat."','".$lng."','".$material_fachada."','".$ancho_fachada."','".$alto_fachada."');";
        }else{
            $sql = "INSERT INTO edificio (id,nombre,id_campus,numero_pisos,usuario_crea,sotano,terraza,id_sede,lat,lng,ancho_fachada,alto_fachada) VALUES ('".$id_edificio."','".$nombre_edificio."','".$nombre_campus."','".$numero_pisos."','".$_SESSION["login"]."','".$sotano."','".$terraza."','".$nombre_sede."','".$lat."','".$lng."','".$ancho_fachada."','".$alto_fachada."');";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Edificio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Edificio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El edificio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una cancha.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_cancha, id de la cancha.
     * @param string $uso_cancha, uso de la cancha.
     * @param string $material_piso, material del piso de la cancha.
     * @param string $tipo_pintura, tipo de pintura de la demarcación de la cancha.
     * @param string $longitud_demarcacion, longitud de la demarcación de la cancha.
     * @param string $lat, latitud donde se encuentra la cancha.
     * @param string $lng, longitud donde se encuentra la cancha.
     * @return array
    **/
    public function guardarCancha($nombre_sede,$nombre_campus,$id_cancha,$uso_cancha,$material_piso,$tipo_pintura,$longitud_demarcacion,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_cancha = htmlspecialchars(trim($id_cancha));
        $uso_cancha = htmlspecialchars(trim($uso_cancha));
        $material_piso = htmlspecialchars(trim($material_piso));
        $tipo_pintura = htmlspecialchars(trim($tipo_pintura));
        $longitud_demarcacion = htmlspecialchars(trim($longitud_demarcacion));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,uso,longitud_demarcacion,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$id_cancha."','".$uso_cancha."','".$longitud_demarcacion."','".$lat."','".$lng."','".$_SESSION['login']."'";
        if (strcasecmp($material_piso,'') != 0) {
            $campos = $campos.",id_material_piso";
            $valores = $valores.",'".$material_piso."'";
        }if (strcasecmp($tipo_pintura,'') != 0) {
            $campos = $campos.",id_tipo_pintura_demarcacion";
            $valores = $valores.",'".$tipo_pintura."'";
        }
        $sql = "INSERT INTO cancha (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cancha 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cancha 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La cancha se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un corredor.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_cancha, id del corredor.
     * @param string $uso_cancha, uso del corredor.
     * @param string $material_piso, material del piso del corredor.
     * @param string $tipo_pintura, tipo de pintura de la demarcación del corredor.
     * @param string $longitud_demarcacion, longitud de la demarcación del corredor.
     * @param string $lat, latitud donde se encuentra la cancha.
     * @param string $lng, longitud donde se encuentra la cancha.
     * @return array
    **/
    public function guardarCorredor($nombre_sede,$nombre_campus,$id_corredor,$ancho_pared,$alto_pared,$material_pared,$ancho_piso,$largo_piso,$material_piso,$ancho_techo,$largo_techo,$material_techo,$tomacorriente,$tipo_suministro_energia,$cantidad_tomacorrientes,$tipo_iluminacion,$cantidad_iluminacion,$tipo_interruptor,$cantidad_interruptores,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_corredor = htmlspecialchars(trim($id_corredor));
        $ancho_pared = htmlspecialchars(trim($ancho_pared));
        $alto_pared = htmlspecialchars(trim($alto_pared));
        $material_pared = htmlspecialchars(trim($material_pared));
        $ancho_piso = htmlspecialchars(trim($ancho_piso));
        $largo_piso = htmlspecialchars(trim($largo_piso));
        $material_piso = htmlspecialchars(trim($material_piso));
        $ancho_techo = htmlspecialchars(trim($ancho_techo));
        $largo_techo = htmlspecialchars(trim($largo_techo));
        $material_techo = htmlspecialchars(trim($material_techo));
        $tomacorriente = htmlspecialchars(trim($tomacorriente));
        $tipo_suministro_energia = htmlspecialchars(trim($tipo_suministro_energia));
        $cantidad_tomacorrientes = htmlspecialchars(trim($cantidad_tomacorrientes));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,ancho_pared,alto_pared,ancho_piso,largo_piso,ancho_techo,largo_techo,tomacorriente,cantidad,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$id_corredor."','".$ancho_pared."','".$alto_pared."','".$ancho_piso."','".$largo_piso."','".$ancho_techo."','".$largo_techo."','".$tomacorriente."','".$cantidad_tomacorrientes."','".$lat."','".$lng."','".$_SESSION['login']."'";
        if (strcasecmp($material_pared,'') != 0) {
            $campos = $campos.",id_material_pared";
            $valores = $valores.",'".$material_pared."'";
        }if (strcasecmp($material_piso,'') != 0) {
            $campos = $campos.",id_material_piso";
            $valores = $valores.",'".$material_piso."'";
        }if (strcasecmp($material_techo,'') != 0) {
            $campos = $campos.",id_material_techo";
            $valores = $valores.",'".$material_techo."'";
        }if (strcasecmp($tipo_suministro_energia,'') != 0) {
            $campos = $campos.",id_tipo_suministro_energia";
            $valores = $valores.",'".$tipo_suministro_energia."'";
        }
        $sql = "INSERT INTO corredor (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Corredor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Corredor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->guardarIluminacionCorredor($nombre_sede,$nombre_campus,$id_corredor,$tipo_iluminacion[$i],$cantidad_iluminacion[$i]);
                }
                for ($i=0;$i<count($tipo_interruptor);$i++) {
                    $this->guardarInterruptoresCorredor($nombre_sede,$nombre_campus,$id_corredor,$tipo_interruptor[$i],$cantidad_interruptores[$i]);
                }
                $GLOBALS['mensaje'] = "El corredor se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una cubierta de un edificio.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $nombre_edificio, id del edificio donde se encuentra la cubierta.
     * @param string $piso, piso donde se encuentra la cubierta.
     * @param string $tipo_cubierta, tipo de cubierta.
     * @param string $material_cubierta, material de la cubierta.
     * @param string $ancho_cubierta, ancho de la cubierta.
     * @param string $largo_cubierta, largo de la cubierta.
     * @return array
    **/
    public function guardarCubierta($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$tipo_cubierta,$material_cubierta,$ancho_cubierta,$largo_cubierta){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $tipo_cubierta = htmlspecialchars(trim($tipo_cubierta));
        $material_cubierta = htmlspecialchars(trim($material_cubierta));
        $ancho_cubierta = htmlspecialchars(trim($ancho_cubierta));
        $largo_cubierta = htmlspecialchars(trim($largo_cubierta));
        $campos = "id_sede,id_campus,id_edificio,piso,largo,ancho,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$nombre_edificio."','".$piso."','".$largo_cubierta."','".$ancho_cubierta."','".$_SESSION['login']."'";
        if (strcasecmp($tipo_cubierta,'') != 0) {
            $campos = $campos.",id_tipo_cubierta";
            $valores = $valores.",'".$tipo_cubierta."'";
        }if (strcasecmp($material_cubierta,'') != 0) {
            $campos = $campos.",id_material_cubierta";
            $valores = $valores.",'".$material_cubierta."'";
        }
        $sql = "INSERT INTO cubiertas_piso (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cubierta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cubierta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La cubierta se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar las gradas de un edificio.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id de campus.
     * @param string $nombre_edificio, id del edificio.
     * @param string $piso_inicio, piso de inicio de las gradas.
     * @param string $pasamanos, si las gradas tienen pasamanos.
     * @param string $material_pasamanos, id del material del pasamanos.
     * @param string $tipoVentana, tipo de ventana de las gradas.
     * @param string $cantidadVentanas, cantidad de ventanas del tipo de las gradas.
     * @param string $materialVentana, material de las ventanas de las gradas.
     * @param string $anchoVentana, ancho de las ventanas de las gradas.
     * @param string $altoVentana, alto de las ventanas de las gradas.
     * @return array
    **/
    public function guardarGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso_inicio,$pasamanos,$material_pasamanos,$tipoVentana,$cantidadVentanas,$materialVentana,$anchoVentana,$altoVentana){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso_inicio = htmlspecialchars(trim($piso_inicio));
        $pasamanos = htmlspecialchars(trim($pasamanos));
        $material_pasamanos = htmlspecialchars(trim($material_pasamanos));
        $campos = "id_sede,id_campus,id_edificio,piso_inicio,pasamanos,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$nombre_edificio."','".$piso_inicio."','".$pasamanos."','".$_SESSION['login']."'";
        if (strcasecmp($material_pasamanos,'') != 0) {
            $campos = $campos.",id_material_pasamanos";
            $valores = $valores.",'".$material_pasamanos."'";
        }
        $sql = "INSERT INTO gradas (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Gradas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Gradas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                for ($i=0;$i<count($tipoVentana);$i++) {
                    $this->guardarVentanaGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso_inicio,$tipoVentana[$i],$cantidadVentanas[$i],$materialVentana[$i],$anchoVentana[$i],$altoVentana[$i]);
                }
                $GLOBALS['mensaje'] = "Las gradas se guardaron correctamente";
            }
        }
    }

    /**
     * Función que permite guardar un parqueadero.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $codigo, código del parqueadero.
     * @param string $capacidad, capacidad del parqueadero.
     * @param string $ancho, ancho del parqueadero.
     * @param string $largo, largo del parqueadero.
     * @param string $material_piso, material del piso del parqueadero.
     * @param string $tipo_pintura, tipo de pintura de la demarcación del parqueadero.
     * @param string $longitud_demarcacion, longitud de la demarcación del parqueadero.
     * @param string $lat, latitud donde se encuentra el parqueadero.
     * @param string $lng, longitud donde se encuentra el parqueadero.
     * @return array
    **/
    public function guardarParqueadero($nombre_sede,$nombre_campus,$codigo,$capacidad,$ancho,$largo,$material_piso,$tipo_pintura,$longitud_demarcacion,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $codigo = htmlspecialchars(trim($codigo));
        $capacidad = htmlspecialchars(trim($capacidad));
        $ancho = htmlspecialchars(trim($ancho));
        $largo = htmlspecialchars(trim($largo));
        $material_piso = htmlspecialchars(trim($material_piso));
        $tipo_pintura = htmlspecialchars(trim($tipo_pintura));
        $longitud_demarcacion = htmlspecialchars(trim($longitud_demarcacion));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,largo,ancho,capacidad,longitud_demarcacion,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$codigo."','".$capacidad."','".$ancho."','".$largo."','".$longitud_demarcacion."','".$lat."','".$lng."','".$_SESSION['login']."'";
        if (strcasecmp($material_piso,'') != 0) {
            $campos = $campos.",id_material_piso";
            $valores = $valores.",'".$material_piso."'";
        }if (strcasecmp($tipo_pintura,'') != 0) {
            $campos = $campos.",id_tipo_pintura_demarcacion";
            $valores = $valores.",'".$tipo_pintura."'";
        }
        $sql = "INSERT INTO parqueadero (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Parqueadero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Parqueadero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El parqueadero se guardó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una piscina.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_piscina, código de la piscina.
     * @param string $cantidad_punto_hidraulico, cantidad de puntos hidraulicos de la piscina.
     * @param string $ancho, ancho de la piscina.
     * @param string $largo, largo de la piscina.
     * @param string $alto, alto de la piscina.
     * @param string $lat, latitud donde se encuentra la piscina.
     * @param string $lng, longitud donde se encuentra la piscina.
     * @return array
    **/
    public function guardarPiscina($nombre_sede,$nombre_campus,$id_piscina,$cantidad_punto_hidraulico,$ancho,$largo,$alto,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_piscina = htmlspecialchars(trim($id_piscina));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $ancho = htmlspecialchars(trim($ancho));
        $largo = htmlspecialchars(trim($largo));
        $alto = htmlspecialchars(trim($alto));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,cantidad_punto_hidraulico,largo,ancho,alto,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$id_piscina."','".$cantidad_punto_hidraulico."','".$ancho."','".$largo."','".$alto."','".$lat."','".$lng."','".$_SESSION['login']."'";
        $sql = "INSERT INTO piscina (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Piscina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Piscina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La piscina se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una plazoleta.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_plazoleta, código de la plazoleta.
     * @param string $nombre, nombre de la plazoleta.
     * @param array $tipo_iluminacion, tipo de iluminación de la plazoleta.
     * @param array $cantidad_iluminacion, cantidad de lamparas de la plazoleta.
     * @param string $lat, latitud donde se encuentra la plazoleta.
     * @param string $lng, longitud donde se encuentra la plazoleta.
     * @return array
    **/
    public function guardarPlazoleta($nombre_sede,$nombre_campus,$id_plazoleta,$nombre,$tipo_iluminacion,$cantidad_iluminacion,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_plazoleta = htmlspecialchars(trim($id_plazoleta));
        $nombre = htmlspecialchars(trim($nombre));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,nombre,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$id_plazoleta."','".$nombre."','".$lat."','".$lng."','".$_SESSION['login']."'";
        $sql = "INSERT INTO plazoleta (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->guardarIluminacionPlazoleta($nombre_sede,$nombre_campus,$id_plazoleta,$tipo_iluminacion[$i],$cantidad_iluminacion[$i]);
                }
                $GLOBALS['mensaje'] = "La plazoleta se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una plazoleta.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_plazoleta, código de la plazoleta.
     * @param string $nombre, nombre de la plazoleta.
     * @param array $tipo_iluminacion, tipo de iluminación de la plazoleta.
     * @param array $cantidad_iluminacion, cantidad de lamparas de la plazoleta.
     * @param string $lat, latitud donde se encuentra el parqueadero.
     * @param string $lng, longitud donde se encuentra el parqueadero.
     * @return array
    **/
    public function guardarSendero($nombre_sede,$nombre_campus,$id_sendero,$longitud,$ancho,$material_piso,$tipo_iluminacion,$cantidad_iluminacion,$codigo_poste,$ancho_cubierta,$largo_cubierta,$material_cubierta,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_sendero = htmlspecialchars(trim($id_sendero));
        $longitud = htmlspecialchars(trim($longitud));
        $ancho = htmlspecialchars(trim($ancho));
        $material_piso = htmlspecialchars(trim($material_piso));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $cantidad_iluminacion = htmlspecialchars(trim($cantidad_iluminacion));
        $codigo_poste = htmlspecialchars(trim($codigo_poste));
        $ancho_cubierta = htmlspecialchars(trim($ancho_cubierta));
        $largo_cubierta = htmlspecialchars(trim($largo_cubierta));
        $material_cubierta = htmlspecialchars(trim($material_cubierta));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,longitud,ancho,cantidad,codigo_poste,ancho_cubierta,largo_cubierta,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$id_sendero."','".$longitud."','".$ancho."','".$cantidad_iluminacion."','".$codigo_poste."','".$ancho_cubierta."','".$largo_cubierta."','".$lat."','".$lng."','".$_SESSION['login']."'";
        if (strcasecmp($material_piso,'') != 0) {
            $campos = $campos.",id_material_piso";
            $valores = $valores.",'".$material_piso."'";
        }if (strcasecmp($tipo_iluminacion,'') != 0) {
            $campos = $campos.",id_tipo_iluminacion";
            $valores = $valores.",'".$tipo_iluminacion."'";
        }if (strcasecmp($material_cubierta,'') != 0) {
            $campos = $campos.",id_material_cubierta";
            $valores = $valores.",'".$material_cubierta."'";
        }
        $sql = "INSERT INTO sendero (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sendero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sendero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El sendero peatonal se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar una vía.
     * @param string $nombre_sede, id de la sede.
     * @param string $nombre_campus, id del campus.
     * @param string $id_via, código de la vía.
     * @param string $tipo_pintura, tipo de pintura de la vía.
     * @param string $longitud_demarcacion, longitud de la demarcación de la vía.
     * @param string $material_piso, material del piso de la vía.
     * @param string $lat, latitud donde se encuentra la vía.
     * @param string $lng, longitud donde se encuentra la vía.
     * @return array
    **/
    public function guardarVia($nombre_sede,$nombre_campus,$id_via,$tipo_pintura,$longitud_demarcacion,$material_piso,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_via = htmlspecialchars(trim($id_via));
        $tipo_pintura = htmlspecialchars(trim($tipo_pintura));
        $longitud_demarcacion = htmlspecialchars(trim($longitud_demarcacion));
        $material_piso = htmlspecialchars(trim($material_piso));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "id_sede,id_campus,id,longitud_demarcacion,lat,lng,usuario_crea";
        $valores = "'".$nombre_sede."','".$nombre_campus."','".$id_via."','".$longitud_demarcacion."','".$lat."','".$lng."','".$_SESSION['login']."'";
        if (strcasecmp($tipo_pintura,'') != 0) {
            $campos = $campos.",id_tipo_pintura_demarcacion";
            $valores = $valores.",'".$tipo_pintura."'";
        }if (strcasecmp($material_piso,'') != 0) {
            $campos = $campos.",id_tipo_material";
            $valores = $valores.",'".$material_piso."'";
        }
        $sql = "INSERT INTO via (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Vía 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Vía 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La vía se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un espacio.
     * @param string $nombre_sede, id de la sede a la que pertenece el espacio.
     * @param string $nombre_campus, id del campus a la que pertenece el espacio
     * @param string $nombre_edificio, nombre del edificio al que pertenece el espacio.
     * @param string $piso, piso en el que está ubicado el espacio.
     * @param string $numero_espacio, número del espacio.
     * @param string $uso_espacio, uso que se le da al espacio.
     * @param string $altura_pared, altura de las paredes del espacio
     * @param string $ancho_pared, ancho de las paredes del espacio.
     * @param string $material_pared, material de las paredes del espacio.
     * @param string $largo_techo, largo del techo del espacio.
     * @param string $ancho_techo, ancho del techo del espacio.
     * @param string $material_techo, material del techo del espacio.
     * @param string $largo_piso, largo del piso del espacio.
     * @param string $ancho_piso, ancho del piso del espacio.
     * @param string $material_piso, material del piso del espacio.
     * @param string $tipo_iluminacion, tipo de iluminación del espacio.
     * @param string $cantidad_iluminacion, cantidad de lámparas del espacio.
     * @param string $tipo_suministro_energia, tipo de suministro de energía del espacio.
     * @param string $tomacorriente, tomacorrientes del espacio.
     * @param string $cantidad_tomacorrientes, cantidad de tomacorrientes del espacio.
     * @param string $tipo_puerta, tipo de puerta del espacio.
     * @param string $cantidad_puertas, cantidad de puertas del espacio.
     * @param string $material_puerta, material de las puertas del espacio.
     * @param string $tipo_cerradura, tipo de cerradura del espacio.
     * @param string $gato_puerta, si la puerta tiene gato o no.
     * @param string $material_marco, material del marco de la puerta del espacio.
     * @param string $ancho_puerta, ancho de la puerta del espacio.
     * @param string $alto_puerta, alto de la puerta del espacio.
     * @param string $tipo_ventana, tipo de ventanas del espacio.
     * @param string $cantidad_ventanas, cantidad de ventanas del espacio.
     * @param string $material_ventana, material de las ventanas del espacio.
     * @param string $ancho_ventana, ancho de las ventanas del espacio.
     * @param string $alto_ventana, alto de las ventanas del espacio.
     * @param string $tipo_interruptor, tipo de interruptor del espacio.
     * @param string $cantidad_interruptores, cantidad de interruptores en el espacio
     * @param string $numero_espacio_padre, número del espacio al que pertenece el nuevo espacio.
     * @return array
    **/
    public function guardarEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$numero_espacio,$uso_espacio,$alto_pared,$ancho_pared,$material_pared,$largo_techo,$ancho_techo,$material_techo,$largo_piso,$ancho_piso,$material_piso,$tipo_iluminacion,$cantidad_iluminacion,$tipo_suministro_energia,$tomacorriente,$cantidad_tomacorrientes,$tipo_puerta,$cantidad_puertas,$material_puerta,$tipo_cerradura,$gato_puerta,$material_marco,$ancho_puerta,$alto_puerta,$tipo_ventana,$cantidad_ventanas,$material_ventana,$ancho_ventana,$alto_ventana,$tipo_interruptor,$cantidad_interruptores,$numero_espacio_padre){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $numero_espacio = htmlspecialchars(trim($numero_espacio));
        $uso_espacio = htmlspecialchars(trim($uso_espacio));
        $alto_pared = htmlspecialchars(trim($alto_pared));
        $ancho_pared = htmlspecialchars(trim($ancho_pared));
        $material_pared = htmlspecialchars(trim($material_pared));
        $largo_techo = htmlspecialchars(trim($largo_techo));
        $ancho_techo = htmlspecialchars(trim($ancho_techo));
        $material_techo = htmlspecialchars(trim($material_techo));
        $largo_piso = htmlspecialchars(trim($largo_piso));
        $ancho_piso = htmlspecialchars(trim($ancho_piso));
        $material_piso = htmlspecialchars(trim($material_piso));
        $numero_espacio_padre = htmlspecialchars(trim($numero_espacio_padre));
        $campos = "id,uso_espacio,id_edificio,id_campus,usuario_crea,piso_edificio,id_sede";
        $valores = "'".$numero_espacio."','".$uso_espacio."','".$nombre_edificio."','".$nombre_campus."','".$_SESSION["login"]."','".$piso."','".$nombre_sede."'";
        if (strcasecmp($material_pared,'') != 0) {
            $campos = $campos.",ancho_pared,alto_pared,id_material_pared";
            $valores = $valores.",'".$ancho_pared."','".$alto_pared."','".$material_pared."'";
        }
        if (strcasecmp($material_techo,'') != 0) {
            $campos = $campos.",ancho_techo,largo_techo,id_material_techo";
            $valores = $valores.",'".$ancho_techo."','".$largo_techo."','".$material_techo."'";
        }
        if (strcasecmp($material_piso,'') != 0) {
            $campos = $campos.",ancho_piso,largo_piso,id_material_piso";
            $valores = $valores.",'".$ancho_piso."','".$largo_piso."','".$material_piso."'";
        }
        if (strcasecmp($numero_espacio_padre,'') != 0) {
            $campos = $campos.",sede_padre,campus_padre,edificio_padre,espacio_padre";
            $valores = $valores.",'".$nombre_sede."','".$nombre_campus."','".$nombre_edificio."','".$numero_espacio_padre."'";
        }
        $sql = "INSERT INTO espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->guardarIluminacionEspacio($numero_espacio,$nombre_sede,$nombre_campus,$nombre_edificio,$tipo_iluminacion[$i],$cantidad_iluminacion[$i]);
                }
                for ($i=0;$i<count($tipo_interruptor);$i++) {
                    $this->guardarInterruptoresEspacio($numero_espacio,$nombre_sede,$nombre_campus,$nombre_edificio,$tipo_interruptor[$i],$cantidad_interruptores[$i]);
                }
                for ($i=0;$i<count($tipo_puerta);$i++) {
                  $this->guardarPuertasEspacio($numero_espacio,$nombre_sede,$nombre_campus,$nombre_edificio,$tipo_cerradura,$tipo_puerta[$i],$material_puerta[$i],$cantidad_puertas[$i],$material_marco[$i],$ancho_puerta[$i],$alto_puerta[$i],$gato_puerta[$i]);
                }
                for ($i=0;$i<count($tipo_suministro_energia);$i++) {
                    $this->guardarSuministroEnergiaEspacio($numero_espacio,$nombre_sede,$nombre_campus,$nombre_edificio,$tipo_suministro_energia[$i],$cantidad_tomacorrientes[$i],$tomacorriente[$i]);
                }
                for ($i=0;$i<count($tipo_ventana);$i++) {
                    $this->guardarVentanaEspacio($numero_espacio,$nombre_sede,$nombre_campus,$nombre_edificio,$tipo_ventana[$i],$cantidad_ventanas[$i],$material_ventana[$i],$ancho_ventana[$i],$alto_ventana[$i]);
                }
                $GLOBALS['mensaje'] = "El(los) espacio(s) se guardó(aron) correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de la iluminación de un corredor.
     * @param string $id_espacio, id del corredor.
     * @param string $id_campus, id del campus al que pertenece el corredor.
     * @param string $id_corredor, id del corredor.
     * @param string $tipo_iluminacion, tipo de iluminación que tiene el corredor.
     * @param string $cantidad, cantidad de lámparas que tiene el corredor.
     * @return array
    **/
    public function guardarIluminacionCorredor($id_sede,$id_campus,$id_corredor,$tipo_iluminacion,$cantidad){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_corredor = htmlspecialchars(trim($id_corredor));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id_sede,id_campus,id,cantidad";
        $valores = "'".$id_sede."','".$id_campus."','".$id_corredor."','".$cantidad."'";
        if (strcasecmp($tipo_iluminacion,'') != 0) {
            $campos = $campos.",id_tipo_iluminacion";
            $valores = $valores.",'".$tipo_iluminacion."'";
            $sql = "INSERT INTO iluminacion_corredor (".$campos.") VALUES (".$valores.");";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Corredor 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Corredor 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "La iluminación del corredor se guardó correctamente";
                    $GLOBALS['sql'] = $sql;
                return true;
                }
            }
        }
    }

    /**
     * Función que permite guardar la información de la iluminación de una plazoleta.
     * @param string $id_espacio, id la plazoleta
     * @param string $id_campus, id del campus al que pertenece la plazoleta.
     * @param string $id_plazoleta, id del corredor.
     * @param string $tipo_iluminacion, tipo de iluminación que tiene la plazoleta
     * @param string $cantidad, cantidad de lámparas que tiene la plazoleta.
     * @return array
    **/
    public function guardarIluminacionPlazoleta($id_sede,$id_campus,$id_plazoleta,$tipo_iluminacion,$cantidad){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_plazoleta = htmlspecialchars(trim($id_plazoleta));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id_sede,id_campus,id,cantidad";
        $valores = "'".$id_sede."','".$id_campus."','".$id_plazoleta."','".$cantidad."'";
        if (strcasecmp($tipo_iluminacion,'') != 0) {
            $campos = $campos.",id_tipo_iluminacion";
            $valores = $valores.",'".$tipo_iluminacion."'";
            $sql = "INSERT INTO iluminacion_plazoleta (".$campos.") VALUES (".$valores.");";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Plazoleta 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Plazoleta 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "La iluminación de la plazoleta se guardó correctamente";
                    $GLOBALS['sql'] = $sql;
                return true;
                }
            }
        }
    }

    /**
     * Función que permite guardar la información de la iluminación de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_iluminacion, tipo de iluminación que tiene el espacio.
     * @param string $cantidad, cantidad de lámparas que tiene el espacio.
     * @return array
    **/
    public function guardarIluminacionEspacio($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_iluminacion,$cantidad){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id_espacio,id_edificio,id_campus,id_sede,cantidad";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad."'";
        if (strcasecmp($tipo_iluminacion,'') != 0) {
              $campos = $campos.",id_tipo_iluminacion";
              $valores = $valores.",'".$tipo_iluminacion."'";
            $sql = "INSERT INTO iluminacion_espacio (".$campos.") VALUES (".$valores.");";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "La iluminación del espacio se guardó correctamente";
                    $GLOBALS['sql'] = $sql;
                return true;
                }
            }
        }
    }

    /**
     * Función que permite guardar la información de los interruptores de un espacio.
     * @param string $id_espacio, id del corredor.
     * @param string $id_sede, id de la sede a la que pertenece el corredor.
     * @param string $id_campus, id del campus al que pertenece el corredor.
     * @param string $tipo_interruptor, tipo de interruptor que tiene el corredor.
     * @param string $cantidad, cantidad de interruptores que tiene el corredor.
     * @return array
    **/
    public function guardarInterruptoresCorredor($id_sede,$id_campus,$id_corredor,$tipo_interruptor,$cantidad){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_corredor = htmlspecialchars(trim($id_corredor));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id,id_sede,id_campus,cantidad";
        $valores = "'".$id_corredor."','".$id_sede."','".$id_campus."','".$cantidad."'";
        if (strcasecmp($tipo_interruptor,'') != 0) {
            $campos = $campos.",id_tipo_interruptor";
            $valores = $valores.",'".$tipo_interruptor."'";
            $sql = "INSERT INTO interruptor_corredor (".$campos.") VALUES (".$valores.");";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Interruptor-Corredor 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Interruptor-Corredor 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "Los interruptores del corredor se guardaron correctamente";
                    $GLOBALS['sql'] = $sql;
                return true;
                }
            }
        }
    }

    /**
     * Función que permite guardar la información de los interruptores de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_interruptor, tipo de interruptor que tiene el espacio.
     * @param string $cantidad, cantidad de interruptores que tiene el espacio.
     * @return array
    **/
    public function guardarInterruptoresEspacio($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_interruptor,$cantidad){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id_espacio,id_edificio,id_campus,id_sede,cantidad";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad."'";
        if (strcasecmp($tipo_interruptor,'') != 0) {
            $campos = $campos.",id_tipo_interruptor";
            $valores = $valores.",'".$tipo_interruptor."'";
            $sql = "INSERT INTO interruptor_espacio (".$campos.") VALUES (".$valores.");";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Interruptor-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Interruptor-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "Los interruptores del espacio se guardaron correctamente";
                    $GLOBALS['sql'] = $sql;
                return true;
                }
            }
        }
    }

    /**
     * Función que permite guardar la información de las puertas de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_puerta, tipo de puerta que tiene el espacio.
     * @param string $material_puerta, material de las puertas del espacio.
     * @param string $cantidad, cantidad de puertas que tiene el espacio.
     * @param string $material_marco, material del marco de las puertas del espacio.
     * @param string $ancho, ancho de las puertas.
     * @param string $largo, largo de las puertas.
     * @param string $gato, si la puerta tiene gato o no.
     * @return array
    **/
    public function guardarPuertasEspacio($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_cerradura,$tipo_puerta,$material_puerta,$cantidad,$material_marco,$ancho,$largo,$gato){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $cantidad = htmlspecialchars(trim($cantidad));
        $material_marco = htmlspecialchars(trim($material_marco));
        $ancho = htmlspecialchars(trim($ancho));
        $largo = htmlspecialchars(trim($largo));
        $gato = htmlspecialchars(trim($gato));
        $campos = "id_espacio,id_edificio,id_campus,id_sede,cantidad,ancho_puerta,largo_puerta,gato";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad."','".$ancho."','".$largo."','".$gato."'";
        if (strcasecmp($tipo_puerta,'') != 0) {
          $campos = $campos.",id_tipo_puerta";
          $valores = $valores.",'".$tipo_puerta."'";
        }
        if (strcasecmp($material_puerta,'') != 0) {
          $campos = $campos.",id_material_puerta";
          $valores = $valores.",'".$material_puerta."'";
        }
        if (strcasecmp($material_marco,'') != 0) {
          $campos = $campos.",id_material_marco";
          $valores = $valores.",'".$material_marco."'";
        }
        $sql = "INSERT INTO puerta_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "Las puertas del espacio se guardaron correctamente";
                for ($i=0;$i<count($tipo_cerradura);$i++) {
                  $this->guardarPuertaTipoCerradura($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_puerta,$material_puerta,$material_marco,$tipo_cerradura[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de las cerraduras de una puerta de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_puerta, tipo de puerta que tiene el espacio.
     * @param string $material_puerta, material de las puertas del espacio.
     * @param string $material_marco, material del marco de las puertas del espacio.
     * @param string $tipo_cerradura, tipo de cerradura de las puertas.
     * @return array
    **/
    public function guardarPuertaTipoCerradura($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_puerta,$material_puerta,$material_marco,$tipo_cerradura){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_marco = htmlspecialchars(trim($material_marco));
        $tipo_cerradura = htmlspecialchars(trim($tipo_cerradura));
        $sql = "INSERT INTO puerta_tipo_cerradura (id_espacio,id_tipo_puerta,id_material_puerta,id_material_marco,id_tipo_cerradura,id_edificio,id_campus,id_sede) VALUES ('".$id_espacio."','".$tipo_puerta."','".$material_puerta."','".$material_marco."','".$tipo_cerradura."','".$id_edificio."','".$id_campus."','".$id_sede."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Tipo Cerradura 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Tipo Cerradura 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El tipo se cerradura de la puerta del espacio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información del suministro de energía de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_suministro_energia, tipo de suministro de energía que tiene el espacio.
     * @param string $cantidad, cantidad de tomacorrientes que tiene el espacio.
     * @param string $tomacorriente, si el tomacorriente es regulado o no.
     * @return array
    **/
    public function guardarSuministroEnergiaEspacio($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_suministro_energia,$cantidad,$tomacorriente){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_suministro_energia = htmlspecialchars(trim($tipo_suministro_energia));
        $cantidad = htmlspecialchars(trim($cantidad));
        $tomacorriente = htmlspecialchars(trim($tomacorriente));
        $campos = "id_espacio,id_edificio,id_campus,id_sede,cantidad,tomacorriente";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad."','".$tomacorriente."'";
        if (strcasecmp($tipo_suministro_energia,'') != 0) {
            $campos = $campos.",id_tipo_suministro_energia";
            $valores = $valores.",'".$tipo_suministro_energia."'";
            $sql = "INSERT INTO suministro_energia_espacio (".$campos.") VALUES (".$valores.");";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Suministro-Energia-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Suministro-Energia-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "El suministro de energía del espacio se guardaron correctamente";
                    $GLOBALS['sql'] = $sql;
                return true;
                }
            }
        }
    }

    /**
     * Función que permite guardar la información de las ventanas de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_ventana, tipo de ventana que tiene el espacio.
     * @param string $cantidad, cantidad de ventanas que tiene el espacio.
     * @param string $material_ventana, material de las ventanas del espacio.
     * @param string $ancho_ventana, ancho de las ventanas del espacio.
     * @param string $alto_ventana, alto de las ventanas del espacio.
     * @return array
    **/
    public function guardarVentanaEspacio($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_ventana,$cantidad,$material_ventana,$ancho_ventana,$alto_ventana){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $cantidad = htmlspecialchars(trim($cantidad));
        $material_ventana = htmlspecialchars(trim($material_ventana));
        $ancho_ventana = htmlspecialchars(trim($ancho_ventana));
        $alto_ventana = htmlspecialchars(trim($alto_ventana));
        $campos = "id_espacio,id_edificio,id_campus,id_sede,cantidad,ancho_ventana,alto_ventana";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad."','".$ancho_ventana."','".$alto_ventana."'";
        if (strcasecmp($tipo_ventana,'') != 0) {
          $campos = $campos.",id_tipo_ventana";
          $valores = $valores.",'".$tipo_ventana."'";
        }
        if (strcasecmp($material_ventana,'') != 0) {
          $campos = $campos.",id_material";
          $valores = $valores.",'".$material_ventana."'";
        }
        $sql = "INSERT INTO ventana_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La ventana del espacio se guardaró correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de las ventanas de unas gradas.
     * @param string $id_sede, id de la sede a la que pertenecen las gradas.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenecen las gradas.
     * @param string $piso, piso donde están las gradas
     * @param string $tipo_ventana, tipo de ventana que tienen las gradas.
     * @param string $cantidad, cantidad de ventanas que tienen las gradas.
     * @param string $material_ventana, material de las ventanas de las gradas.
     * @param string $ancho_ventana, ancho de las ventanas de las gradas.
     * @param string $alto_ventana, alto de las ventanas de las gradas.
     * @return array
    **/
    public function guardarVentanaGradas($id_sede,$id_campus,$id_edificio,$piso,$tipo_ventana,$cantidad,$material_ventana,$ancho_ventana,$alto_ventana){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $cantidad = htmlspecialchars(trim($cantidad));
        $material_ventana = htmlspecialchars(trim($material_ventana));
        $ancho_ventana = htmlspecialchars(trim($ancho_ventana));
        $alto_ventana = htmlspecialchars(trim($alto_ventana));
        $campos = "id_sede,id_campus,id_edificio,piso_inicio,id_tipo_ventana";
        $valores = "'".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$tipo_ventana."'";
        if (strcasecmp($cantidad,'') != 0) {
          $campos = $campos.",cantidad";
          $valores = $valores.",'".$cantidad."'";
        }
        if (strcasecmp($material_ventana,'') != 0) {
          $campos = $campos.",id_material";
          $valores = $valores.",'".$material_ventana."'";
        }
        if (strcasecmp($ancho_ventana,'') != 0) {
          $campos = $campos.",ancho_ventana";
          $valores = $valores.",'".$ancho_ventana."'";
        }
        if (strcasecmp($alto_ventana,'') != 0) {
          $campos = $campos.",alto_ventana";
          $valores = $valores.",'".$alto_ventana."'";
        }
        $sql = "INSERT INTO ventana_gradas (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Gradas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Gradas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La ventana de las gradas se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información del punto sanitario de un espacio.
     * @param string $id_espacio, id del espacio al que pertenece el espacio.
     * @param string $id_sede, id de la sede a la que pertenece el espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_punto_sanitario, tipo de punto sanitario que tiene el baño.
     * @param string $cantidad_punto_sanitario, cantidad de puntos sanitarios que tiene el espacio.
     * @return array
    **/
    public function guardarPuntoSanitario($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_punto_sanitario = htmlspecialchars(trim($tipo_punto_sanitario));
        $cantidad_punto_sanitario = htmlspecialchars(trim($cantidad_punto_sanitario));
        $sql = "INSERT INTO punto_sanitario (id_espacio,id_edificio,id_campus,id_sede,id_tipo,cantidad) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$tipo_punto_sanitario."','".$cantidad_punto_sanitario."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Punto Sanitario 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Punto Sanitario 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "La ventana del espacio se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de los lavamanos de un baño.
     * @param string $id_espacio, id del espacio al que pertenece el lavamanos.
     * @param string $id_sede, id de la sede a la que pertenece el lavamanos.
     * @param string $id_campus, id del campus al que pertenece el lavamanos.
     * @param string $id_edificio, id del edificio al que pertenece el lavamanos.
     * @param string $tipo_lavamanos, tipo de lavamanos que tiene el baño.
     * @param string $cantidad_lavamanos, cantidad de lavamanos que tiene el baño.
     * @return array
    **/
    public function guardarLavamanosBano($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_lavamanos,$cantidad_lavamanos){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_lavamanos = htmlspecialchars(trim($tipo_lavamanos));
        $cantidad_lavamanos = htmlspecialchars(trim($cantidad_lavamanos));
        $sql = "INSERT INTO lavamanos_bano (id_espacio,id_edificio,id_campus,id_sede,id_tipo_lavamanos,cantidad) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$tipo_lavamanos."','".$cantidad_lavamanos."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Lavamanos-Baño 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Lavamanos-Baño 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El lavamanos del baño se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de los orinales de un baño.
     * @param string $id_espacio, id del espacio al que pertenece el orinal.
     * @param string $id_sede, id de la sede a la que pertenece el orinal.
     * @param string $id_campus, id del campus al que pertenece el orinal.
     * @param string $id_edificio, id del edificio al que pertenece el orinal.
     * @param string $tipo_orinal, tipo de orinal que tiene el baño.
     * @param string $cantidad_orinal, cantidad de orinales que tiene el baño.
     * @return array
    **/
    public function guardarOrinalBano($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_orinal,$cantidad_orinal){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_orinal = htmlspecialchars(trim($tipo_orinal));
        $cantidad_orinal = htmlspecialchars(trim($cantidad_orinal));
        $sql = "INSERT INTO orinal_bano (id_espacio,id_edificio,id_campus,id_sede,id_tipo_orinal,cantidad) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$tipo_orinal."','".$cantidad_orinal."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Orinal-Baño 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Orinal-Baño 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El orinal del baño se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un salón
     * @param string $id_espacio, id del salón.
     * @param string $id_sede, id de la sede a la que pertenece el salón.
     * @param string $id_campus, id del campus al que pertenece el salón.
     * @param string $id_edificio, id del edificio al que pertenece el salón.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el salón.
     * @param string $capacidad, capacidad del salón.
     * @param string $punto_videobeam, si el salón tiene o no punto de proyector.
     * @return array
    **/
    public function guardarSalon($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_videobeam){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_videobeam = htmlspecialchars(trim($punto_videobeam));
        $sql = "INSERT INTO salon (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red,capacidad,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."','".$capacidad."','".$punto_videobeam."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Salón 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Salón 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El salón se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un auditorio
     * @param string $id_espacio, id del auditorio.
     * @param string $id_sede, id de la sede a la que pertenece el auditorio.
     * @param string $id_campus, id del campus al que pertenece el auditorio.
     * @param string $id_edificio, id del edificio al que pertenece el auditorio.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el auditorio.
     * @param string $capacidad, capacidad del auditorio.
     * @param string $punto_videobeam, si el auditorio tiene o no punto de proyector.
     * @return array
    **/
    public function guardarAuditorio($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_videobeam){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_videobeam = htmlspecialchars(trim($punto_videobeam));
        $sql = "INSERT INTO auditorio (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red,capacidad,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."','".$capacidad."','".$punto_videobeam."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Auditorio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Auditorio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un laboratorio
     * @param string $id_espacio, id del laboratorio.
     * @param string $id_sede, id de la sede a la que pertenece el laboratorio.
     * @param string $id_campus, id del campus al que pertenece el laboratorio.
     * @param string $id_edificio, id del edificio al que pertenece el laboratorio.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el laboratorio.
     * @param string $capacidad, capacidad del laboratorio.
     * @param string $punto_videobeam, si el laboratorio tiene o no punto de proyector.
     * @param string $cantidad_punto_hidraulico, cantidad de puntos hidraulicos que tiene el laboratorio.
     * @param string $tipo_punto_sanitario, tipo de punto sanitario que tiene el laboratorio.
     * @param string $cantidad_punto_sanitario, cantidad de puntos sanitarios que tiene el laboratorio.
     * @return array
    **/
    public function guardarLaboratorio($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_videobeam,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_videobeam = htmlspecialchars(trim($punto_videobeam));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $sql = "INSERT INTO laboratorio (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red,capacidad,punto_video_beam,cantidad_punto_hidraulico) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."','".$capacidad."','".$punto_videobeam."','".$cantidad_punto_hidraulico."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Laboratorio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Laboratorio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_punto_sanitario);$i++) {
                    $this->guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario[$i],$cantidad_punto_sanitario[$i]);
                }
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una sala de computo
     * @param string $id_espacio, id de la sala de computo.
     * @param string $id_sede, id de la sede a la que pertenece la sala de computo.
     * @param string $id_campus, id del campus al que pertenece la sala de computo.
     * @param string $id_edificio, id del edificio al que pertenece la sala de computo.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la sala de computo.
     * @param string $capacidad, capacidad de la sala de computo.
     * @param string $punto_videobeam, si la sala de computo tiene o no punto de proyector.
     * @return array
    **/
    public function guardarSalaComputo($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_videobeam){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_videobeam = htmlspecialchars(trim($punto_videobeam));
        $sql = "INSERT INTO sala_computo (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red,capacidad,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."','".$capacidad."','".$punto_videobeam."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala Computo 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala Computo 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una oficina
     * @param string $id_espacio, id de la oficina.
     * @param string $id_sede, id de la sede a la que pertenece la oficina.
     * @param string $id_campus, id del campus al que pertenece la oficina.
     * @param string $id_edificio, id del edificio al que pertenece la oficina.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la oficina.
     * @param string $punto_videobeam, si la oficina tiene o no punto de proyector.
     * @return array
    **/
    public function guardarOficina($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red,$punto_videobeam){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $punto_videobeam = htmlspecialchars(trim($punto_videobeam));
        $sql = "INSERT INTO oficina (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."','".$punto_videobeam."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Oficina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Oficina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un baño
     * @param string $id_espacio, id del baño.
     * @param string $id_sede, id de la sede a la que pertenece el baño.
     * @param string $id_campus, id del campus al que pertenece el baño.
     * @param string $id_edificio, id del edificio al que pertenece el baño.
     * @param string $tipo_inodoro, tipo de inodoros que tiene el baño.
     * @param string $cantidad_inodoro, cantidad de inodoros que tiene el baño.
     * @param string $ducha, si el baño tiene ducha o no.
     * @param string $tipo_orinal, tipo de orinales que tiene el baño.
     * @param string $cantidad_orinal, cantidad de orinales que tiene el baño.
     * @param string $tipo_lavamanos, tipo de lavamanos que tiene el baño.
     * @param string $cantidad_lavamanos, cantidad de lavamanos que tiene el baño.
     * @param string $lavatraperos, si el baño tiene o no lavatraperos.
     * @param string $cantidad_sifon, cantidad de sifones que tiene el baño.
     * @param string $tipo_divisiones, tipo de divisiones del baño.
     * @param string $material_divisiones, material de las divisiones del baño.
     * @return array
    **/
    public function guardarBano($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_inodoro,$cantidad_inodoro,$tipo_orinal,$cantidad_orinal,$tipo_lavamanos,$cantidad_lavamanos,$ducha,$lavatraperos,$cantidad_sifon,$tipo_divisiones,$material_divisiones){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_inodoro = htmlspecialchars(trim($tipo_inodoro));
        $cantidad_inodoro = htmlspecialchars(trim($cantidad_inodoro));
        $ducha = htmlspecialchars(trim($ducha));
        $lavatraperos = htmlspecialchars(trim($lavatraperos));
        $cantidad_sifon = htmlspecialchars(trim($cantidad_sifon));
        $tipo_divisiones = htmlspecialchars(trim($tipo_divisiones));
        $material_divisiones = htmlspecialchars(trim($material_divisiones));
        $sql = "INSERT INTO bano
                            (id_espacio,id_edificio,id_campus,id_sede,id_tipo_inodoro,cantidad_inodoro,ducha,lavatraperos,cantidad_sifon,id_tipo_divisiones,id_material_divisiones)
                        VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$tipo_inodoro."','".$cantidad_inodoro."','".$ducha."','".$lavatraperos."','".$cantidad_sifon."','".$tipo_divisiones."','".$material_divisiones."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Baño 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Baño 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El baño se guardó correctamente";
                for ($i=0;$i<count($tipo_lavamanos);$i++) {
                    $this->guardarLavamanosBano($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_lavamanos[$i],$cantidad_lavamanos[$i]);
                }
                for ($i=0;$i<count($tipo_orinal);$i++) {
                    $this->guardarOrinalBano($id_espacio,$id_sede,$id_campus,$id_edificio,$tipo_orinal[$i],$cantidad_orinal[$i]);
                }
                //$GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una bodega.
     * @param string $id_espacio, id de la bodega.
     * @param string $id_sede, id de la sede a la que pertenece la bodega.
     * @param string $id_campus, id del campus al que pertenece la bodega.
     * @param string $id_edificio, id del edificio al que pertenece la bodega.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la bodega.
     * @return array
    **/
    public function guardarBodega($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO bodega (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Bodega 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Bodega 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una sala de estudio.
     * @param string $id_espacio, id de la sala de estudio.
     * @param string $id_sede, id de la sede a la que pertenece la sala de estudio.
     * @param string $id_campus, id del campus al que pertenece la sala de estudio.
     * @param string $id_edificio, id del edificio al que pertenece la sala de estudio.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la sala de estudio.
     * @return array
    **/
    public function guardarSalaEstudio($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO sala_estudio (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala de Estudio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala de Estudio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un cuarto de plantas.
     * @param string $id_espacio, id del cuarto de plantas.
     * @param string $id_sede, id de la sede a la que pertenece el cuarto de plantas.
     * @param string $id_campus, id del campus al que pertenece el cuarto de plantas.
     * @param string $id_edificio, id del edificio al que pertenece el cuarto de plantas.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el cuarto de plantas.
     * @return array
    **/
    public function guardarCuartoPlantas($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO cuarto_plantas (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Plantas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Plantas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un cuarto de aires acondicionados.
     * @param string $id_espacio, id del cuarto de aires acondicionados.
     * @param string $id_sede, id de la sede a la que pertenece el cuarto de aires acondicionados.
     * @param string $id_campus, id del campus al que pertenece el cuarto de aires acondicionados.
     * @param string $id_edificio, id del edificio al que pertenece el cuarto de aires acondicionados.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el cuarto de aires acondicionados.
     * @return array
    **/
    public function guardarCuartoAireAcondicionado($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO cuarto_aire_acondicionado (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Aires Acondicionados 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Aires Acondicionados 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un área deportiva cerrada.
     * @param string $id_espacio, id del área deportiva cerrada.
     * @param string $id_sede, id de la sede a la que pertenece el área deportiva cerrada.
     * @param string $id_campus, id del campus al que pertenece el área deportiva cerrada.
     * @param string $id_edificio, id del edificio al que pertenece el área deportiva cerrada.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el área deportiva cerrada.
     * @return array
    **/
    public function guardarAreaDeportivaCerrada($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO area_deportiva_cerrada (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Área Deportiva Cerrada 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Área Deportiva Cerrada 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un centro de datos.
     * @param string $id_espacio, id del centro de datos.
     * @param string $id_sede, id de la sede a la que pertenece el centro de datos.
     * @param string $id_campus, id del campus al que pertenece el centro de datos.
     * @param string $id_edificio, id del edificio al que pertenece el centro de datos.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el centro de datos.
     * @return array
    **/
    public function guardarCentroDatos($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO centro_datos (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Centro de Datos 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Centro de Datos 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un cuarto de bombas.
     * @param string $id_espacio, id del cuarto de bombas.
     * @param string $id_sede, id de la sede a la que pertenece el cuarto de bombas.
     * @param string $id_campus, id del campus al que pertenece el cuarto de bombas.
     * @param string $id_edificio, id del edificio al que pertenece el cuarto de bombas.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el cuarto de bombas.
     * @return array
    **/
    public function guardarCuartoBombas($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $sql = "INSERT INTO cuarto_bombas (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_hidraulico) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_hidraulico."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Bombas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Bombas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_punto_sanitario);$i++) {
                    $this->guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario[$i],$cantidad_punto_sanitario[$i]);
                }
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una cocineta.
     * @param string $id_espacio, id de la cocineta.
     * @param string $id_sede, id de la sede a la que pertenece la cocineta.
     * @param string $id_campus, id del campus al que pertenece la cocineta.
     * @param string $id_edificio, id del edificio al que pertenece la cocineta.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la cocineta.
     * @param string $tipo_punto_sanitario, tipo de punto sanitario que tiene la cocineta.
     * @param string $cantidad_punto_sanitario, cantidad de puntos sanitarios que tiene la cocineta
     * @return array
    **/
    public function guardarCocineta($id_espacio,$id_sede,$id_campus,$id_edificio,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $sql = "INSERT INTO cocineta (id_espacio,id_edificio,id_campus,id_sede,cantidad_punto_hidraulico) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$id_sede."','".$cantidad_punto_hidraulico."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cocineta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cocineta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_punto_sanitario);$i++) {
                    $this->guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario[$i],$cantidad_punto_sanitario[$i]);
                }
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un edificio.
     * @param string $tipo_material, tipo de material.
     * @param string $nombre_tipo_material, nombre del tipo de material.
     * @return array
    **/
    public function guardarTipoMaterial($tipo_material,$nombre_tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $nombre_tipo_material = htmlspecialchars(trim($nombre_tipo_material));
        $sql = "INSERT INTO ".$tipo_material." (material) VALUES ('".$nombre_tipo_material."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Material 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Material 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El tipo de material se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un edificio.
     * @param string $tipo_objeto, tipo de objeto.
     * @param string $nombre_tipo_objeto, nombre del tipo de objeto.
     * @return array
    **/
    public function guardarTipoObjeto($tipo_objeto,$nombre_tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $nombre_tipo_objeto = htmlspecialchars(trim($nombre_tipo_objeto));
        $sql = "INSERT INTO ".$tipo_objeto." (tipo) VALUES ('".$nombre_tipo_objeto."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Objeto 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Objeto 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El tipo de objeto se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar planos de un campus que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoCampus($id_sede,$id_campus,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/campus/".$id_sede."-".$id_campus."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO campus_archivos (id_sede,id_campus,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Campus 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Campus 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un campus que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoCampus($id_sede,$id_campus,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/campus/".$id_sede."-".$id_campus."/";
            if (!file_exists($ruta.$foto["name"])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO campus_archivos (id_sede,id_campus,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Campus 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Campus 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de un edificio que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, variable con la información del edificio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoEdificio($id_sede,$id_campus,$id_edificio,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/edificio/".$id_sede."-".$id_campus."-".$id_edificio."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO edificio_archivos (id_sede,id_campus,id_edificio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Edificio 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Edificio 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un edificio que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, variable con la información del edificio.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoEdificio($id_sede,$id_campus,$id_edificio,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/edificio/".$id_sede."-".$id_campus."-".$id_edificio."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO edificio_archivos (id_sede,id_campus,id_edificio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Edificio 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Edificio 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de una cancha que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_cancha, id de la cancha.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoCancha($id_sede,$id_campus,$id_cancha,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_cancha = htmlspecialchars(trim($id_cancha));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/cancha/".$id_sede."-".$id_campus."-".$id_cancha."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO cancha_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_cancha."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Cancha 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Cancha 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un edificio que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_cancha, id de la cancha.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoCancha($id_sede,$id_campus,$id_cancha,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_cancha = htmlspecialchars(trim($id_cancha));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/cancha/".$id_sede."-".$id_campus."-".$id_cancha."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO cancha_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_cancha."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Cancha 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Cancha 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de un corredor que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_corredor, id del corredor.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoCorredor($id_sede,$id_campus,$id_corredor,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_corredor = htmlspecialchars(trim($id_corredor));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/corredor/".$id_sede."-".$id_campus."-".$id_corredor."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO corredor_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_corredor."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Corredor 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Corredor 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un corredor que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_corredor, id del corredor.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoCorredor($id_sede,$id_campus,$id_corredor,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_corredor = htmlspecialchars(trim($id_corredor));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/corredor/".$id_sede."-".$id_campus."-".$id_corredor."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO corredor_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_corredor."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Corredor 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Corredor 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de una cubierta que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoCubierta($id_sede,$id_campus,$id_edificio,$piso,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $piso = htmlspecialchars(trim($piso));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/cubierta/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO cubiertas_piso_archivos (id_sede,id_campus,id_edificio,piso,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Cubierta 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Cubierta 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de una cubierta que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarFotoCubierta($id_sede,$id_campus,$id_edificio,$piso,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $piso = htmlspecialchars(trim($piso));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/cubierta/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO cubiertas_piso_archivos (id_sede,id_campus,id_edificio,piso,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Cubierta 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Cubierta 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de unas gradas que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, variable con la información del edificio.
     * @param string $id_edificio, variable con el piso del edificio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoGradas($id_sede,$id_campus,$id_edificio,$piso,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $piso = htmlspecialchars(trim($piso));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/gradas/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO gradas_archivos (id_sede,id_campus,id_edificio,piso,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Gradas 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Gradas 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de unas gradas que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, variable con la información del edificio.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoGradas($id_sede,$id_campus,$id_edificio,$piso,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $piso = htmlspecialchars(trim($piso));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/gradas/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO gradas_archivos (id_sede,id_campus,id_edificio,piso,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Gradas 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Gradas 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de un parqueadero que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_parqueadero, id del parqueadero.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoParqueadero($id_sede,$id_campus,$id_parqueadero,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_parqueadero = htmlspecialchars(trim($id_parqueadero));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/parqueadero/".$id_sede."-".$id_campus."-".$id_parqueadero."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO parqueadero_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_parqueadero."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Parqueadero 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Parqueadero 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un parqueadero que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_parqueadero, id del parqueadero.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoParqueadero($id_sede,$id_campus,$id_parqueadero,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_parqueadero = htmlspecialchars(trim($id_parqueadero));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/parqueadero/".$id_sede."-".$id_campus."-".$id_parqueadero."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO parqueadero_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_parqueadero."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Parqueadero 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Parqueadero 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de una piscina que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_piscina, id de la piscina.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoPiscina($id_sede,$id_campus,$id_piscina,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_piscina = htmlspecialchars(trim($id_piscina));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/piscina/".$id_sede."-".$id_campus."-".$id_piscina."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO piscina_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_piscina."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Piscina 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Piscina 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de una piscina que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_piscina, id de la piscina.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoPiscina($id_sede,$id_campus,$id_piscina,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_piscina = htmlspecialchars(trim($id_piscina));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/piscina/".$id_sede."-".$id_campus."-".$id_piscina."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO piscina_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_piscina."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Piscina 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Piscina 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de una plazoleta que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_plazoleta, id de la plazoleta.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoPlazoleta($id_sede,$id_campus,$id_plazoleta,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_plazoleta = htmlspecialchars(trim($id_plazoleta));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/plazoleta/".$id_sede."-".$id_campus."-".$id_plazoleta."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO plazoleta_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_plazoleta."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Plazoleta 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Plazoleta 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de una plazoleta que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_plazoleta, id de la plazoleta.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoPlazoleta($id_sede,$id_campus,$id_plazoleta,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_plazoleta = htmlspecialchars(trim($id_plazoleta));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/plazoleta/".$id_sede."-".$id_campus."-".$id_plazoleta."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO plazoleta_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_plazoleta."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Plazoleta 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Plazoleta 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de un sendero que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_sendero, id del sendero.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoSendero($id_sede,$id_campus,$id_sendero,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_sendero = htmlspecialchars(trim($id_sendero));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/sendero/".$id_sede."-".$id_campus."-".$id_sendero."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO sendero_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_sendero."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Sendero 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Sendero 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un sendero que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_sendero, id del sendero.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoSendero($id_sede,$id_campus,$id_sendero,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_sendero = htmlspecialchars(trim($id_sendero));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/sendero/".$id_sede."-".$id_campus."-".$id_sendero."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO sendero_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_sendero."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Sendero 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Sendero 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de una vía que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_via, id de la vía.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoVia($id_sede,$id_campus,$id_via,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_via = htmlspecialchars(trim($id_via));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/via/".$id_sede."-".$id_campus."-".$id_via."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO via_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_via."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Vía 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Vía 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de una via que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_via, id de la via.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoVia($id_sede,$id_campus,$id_via,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_via = htmlspecialchars(trim($id_via));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/via/".$id_sede."-".$id_campus."-".$id_via."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO via_archivos (id_sede,id_campus,id,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_via."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Vía 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Vía 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar planos de un espacio que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, variable con la información del edificio.
     * @param string $id_espacio, variable con la información del espacio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarPlanoEspacio($id_sede,$id_campus,$id_edificio,$id_espacio,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $id_espacio = htmlspecialchars(trim($id_espacio));
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = __ROOT__."/archivos/planos/espacio/".$id_sede."-".$id_campus."-".$id_edificio."-".$id_espacio."/";
            if (!file_exists($ruta.$plano['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO espacio_archivos (id_sede,id_campus,id_edificio,id_espacio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$id_espacio."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Espacio 1)";
                    unlink($ruta.$plano['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Espacio 2)";
                        unlink($ruta.$plano['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$plano['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un edificio que el usuario selecionó.
     * @param string $id_sede, variable con la información de la sede.
     * @param string $id_campus, variable con la información del campus.
     * @param string $id_edificio, variable con la información del edificio.
     * @param string $id_espacio, variable con la información del espacio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
    **/
    public function guardarFotoEspacio($id_sede,$id_campus,$id_edificio,$id_espacio,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_sede = htmlspecialchars(trim($id_sede));
            $id_campus = htmlspecialchars(trim($id_campus));
            $id_edificio = htmlspecialchars(trim($id_edificio));
            $id_espacio = htmlspecialchars(trim($id_espacio));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/espacio/".$id_sede."-".$id_campus."-".$id_edificio."-".$id_espacio."/";
            if (!file_exists($ruta.$foto["name"])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO espacio_archivos (id_sede,id_campus,id_edificio,id_espacio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$id_espacio."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Espacio 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Espacio 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar la información de un aire acondicionado.
     * @param string $numero_inventario, número de inventario del aire acondicionado.
     * @param string $sede, sede donde está el aire acondicionado.
     * @param string $campus, campus donde está el aire acondicionado.
     * @param string $edificio, edificio donde está el aire acondicionado.
     * @param string $espacio, espacio donde está el aire acondicionado.
     * @param string $capacidad, capacidad del aire acondicionado.
     * @param string $marca, marca del aire acondicionado.
     * @param string $tipo, tipo de aire acondicionado.
     * @return array
    **/
    public function guardarAire($numero_inventario,$sede,$campus,$edificio,$espacio,$capacidad,$marca,$tipo,$tecnologia_aire,$fecha_instalacion,$instalador,$periodicidad_mantenimiento,$ubicacion_condensadora){
        $numero_inventario = htmlspecialchars(trim($numero_inventario));
        $sede = htmlspecialchars(trim($sede));
        $campus = htmlspecialchars(trim($campus));
        $edificio = htmlspecialchars(trim($edificio));
        $espacio = htmlspecialchars(trim($espacio));
        $capacidad = htmlspecialchars(trim($capacidad));
        $marca = htmlspecialchars(trim($marca));
        $tipo = htmlspecialchars(trim($tipo));
        $tecnologia_aire = htmlspecialchars(trim($tecnologia_aire));
        $fecha_instalacion = htmlspecialchars(trim($fecha_instalacion));
        $instalador = htmlspecialchars(trim($instalador));
        $periodicidad_mantenimiento = htmlspecialchars(trim($periodicidad_mantenimiento));
        $ubicacion_condensadora = htmlspecialchars(trim($ubicacion_condensadora));
        $campos = "numero_inventario,id_sede,id_campus,id_edificio,id_espacio,capacidad,marca,tipo,tecnologia,instalador,ubicacion_condensadora,usuario_crea";
        $valores = "'".$numero_inventario."','".$sede."','".$campus."','".$edificio."','".$espacio."','".$capacidad."','".$marca."','".$tipo."','".$tecnologia_aire."','".$instalador."','".$ubicacion_condensadora."','".$_SESSION["login"]."'";
        if (strcasecmp($fecha_instalacion,'') != 0) {
            $campos = $campos.",fecha_instalacion" ;
            $valores = $valores.",'".$fecha_instalacion."'";
        }if (strcasecmp($periodicidad_mantenimiento,'') != 0) {
            $campos = $campos.",periodicidad_mantenimiento" ;
            $valores = $valores.",'".$periodicidad_mantenimiento."'";
        }
        $sql = "INSERT INTO aire_acondicionado (".$campos.") VALUES (".$valores.") RETURNING id_aire;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "El aire acondicionado se ha guardado correctamente en el sistema.";
                return $result;
            }
        }
    }

    /**
     * Función que permite guardar la información de una capacidad de aire acondicionado.
     * @param string $capacidad, capacidad.
     * @return array
    **/
    public function guardarCapacidadAire($capacidad){
        $capacidad = htmlspecialchars(trim($capacidad));
        $sql = "INSERT INTO capacidad_aire (capacidad) VALUES ('".$capacidad."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Capacidad Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Capacidad Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La capacidad de aires acondicionados se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una marca de aire acondicionado.
     * @param string $marca, marca de aire acondicionado.
     * @return array
    **/
    public function guardarMarcaAire($marca){
        $marca = htmlspecialchars(trim($marca));
        $sql = "INSERT INTO marca_aire (nombre) VALUES ('".$marca."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Marca Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Marca Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La marca de aires acondicionados se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un tipo de aire acondicionado.
     * @param string $tipo, tipo de aire acondicionado.
     * @return array
    **/
    public function guardarTipoAire($tipo){
        $tipo = htmlspecialchars(trim($tipo));
        $sql = "INSERT INTO tipo_aire (tipo) VALUES ('".$tipo."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El tipo de aires acondicionados se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un tipo de tecnología de aires acondicionados.
     * @param string $tipo, tipo de aire acondicionado.
     * @return array
    **/
    public function guardarTipoTecnologiaAire($tipo){
        $tipo = htmlspecialchars(trim($tipo));
        $sql = "INSERT INTO tipo_tecnologia_aire (tipo) VALUES ('".$tipo."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Tecnología Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Tecnología Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El tipo de tecnología de aires acondicionados se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un mantenimiento de un aire acondiciondo.
     * @param string $tipo, tipo de aire acondicionado.
     * @return array
    **/
    public function guardarMantenimientoAire($id_aire,$numero_orden,$fecha_realizacion,$realizado,$revisado,$descripcion){
        $id_aire = htmlspecialchars(trim($id_aire));
        $numero_orden = htmlspecialchars(trim($numero_orden));
        $fecha_realizacion = htmlspecialchars(trim($fecha_realizacion));
        $realizado = htmlspecialchars(trim($realizado));
        $revisado = htmlspecialchars(trim($revisado));
        $descripcion = htmlspecialchars(trim($descripcion));
        $sql = "INSERT INTO mantenimiento_aire (id_aire,numero_orden,fecha,realizado,revisado,descripcion,usuario_crea) VALUES ('".$id_aire."','".$numero_orden."','".$fecha_realizacion."','".$realizado."','".$revisado."','".$descripcion."','".$_SESSION["login"]."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Mantenimiento Aire Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Mantenimiento Aire Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El mantenimiento del aire acondicionado se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una marca del módulo de inventario.
     * @param string $marca, nombre de la marca.
     * @param string $bodega, bodega de la marca.
     * @return array
    **/
    public function guardarMarcaInventario($marca,$bodega){
        $marca = htmlspecialchars(trim($marca));
        $bodega = htmlspecialchars(trim($bodega));
        $sql = "INSERT INTO marca_inventario (nombre,bodega) VALUES ('".$marca."','".$bodega."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Marca Inventario 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Marca Inventario 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La marca se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una categoría del módulo de inventario.
     * @param string $categoria, nombre de la categoría.
     * @param string $bodega, bodega de la categoría.
     * @return array
    **/
    public function guardarCategoria($categoria,$bodega){
        $categoria = htmlspecialchars(trim($categoria));
        $bodega = htmlspecialchars(trim($bodega));
        $sql = "INSERT INTO categoria_articulo (nombre,bodega) VALUES ('".$categoria."','".$bodega."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Categoría 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Categoría 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "La categoría se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un proveedor.
     * @param string $nombre, nombre del proveedor.
     * @param string $direccion, dirección del proveedor.
     * @param string $telefono, telefono del proveedor.
     * @param string $nit, nit del proveedor.
     * @param string $bodega, bodega del proveedor.
     * @return array
    **/
    public function guardarProveedor($nombre,$direccion,$telefono,$nit,$bodega){
        $nombre = htmlspecialchars(trim($nombre));
        $direccion = htmlspecialchars(trim($direccion));
        $telefono = htmlspecialchars(trim($telefono));
        $nit = htmlspecialchars(trim($nit));
        $bodega = htmlspecialchars(trim($bodega));
        $sql = "INSERT INTO proveedor (nombre,nit,direccion,telefono,bodega) VALUES ('".$nombre."','".$nit."','".$direccion."','".$telefono."','".$bodega."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Proveedor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Proveedor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El proveedor se ha guardado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de un articulo.
     * @param string $nombre, nombre del artículo.
     * @param string $marca, marca del artículo.
     * @param string $categoria, categoría del artículo.
     * @param string $bodega, bodega en la que está el artículo.
     * @param string $cantidad_minima, cantidad mínima del artículo.
     * @return array
    **/
    public function guardarArticulo($nombre,$marca,$categoria,$bodega,$cantidad_minima){
        $nombre = htmlspecialchars(trim($nombre));
        $marca = htmlspecialchars(trim($marca));
        $categoria = htmlspecialchars(trim($categoria));
        $bodega = htmlspecialchars(trim($bodega));
        $cantidad_minima = htmlspecialchars(trim($cantidad_minima));
        $campos = "nombre,bodega,cantidad_minima,usuario_crea";
        $valores = "'".$nombre."','".$bodega."','".$cantidad_minima."','".$_SESSION["login"]."'";
        if (strcmp($categoria,"")!=0) {
            $campos .= ",id_categoria_articulo";
            $valores .= ",'".$categoria."'";
        }
        if (strcmp($marca,"")!=0) {
            $campos .= ",marca";
            $valores .= ",'".$marca."'";
        }
        $sql = "INSERT INTO articulo (".$campos.") VALUES (".$valores.") RETURNING id_articulo;";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Artículo 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Artículo 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "El artículo se ha guardado correctamente en el sistema.";
                return $result;
            }
        }
    }

    /**
     * Función que permite guardar la información de un articulo en el inventario.
     * @param string $id, id del artículo.
     * @param string $cantidad, cantidad del artículo.
     * @return array
    **/
    public function guardarArticuloInventario($id,$cantidad){
        $id = htmlspecialchars(trim($id));
        $cantidad = htmlspecialchars(trim($cantidad));
        $sql = "INSERT INTO inventario (id_articulo,cantidad) VALUES ('".$id."','".$cantidad."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Artículo Inventario 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Artículo Inventario 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "El artículo se ha guardado correctamente en el sistema.";
                return $result;
            }
        }
    }

    /**
     * Función que permite guardar la información de un articulo y su proveedor.
     * @param string $id_articulo, id del articulo.
     * @param string $proveedor, id del proveedor.
     * @return array
    **/
    public function guardarArticuloProveedor($id_articulo,$proveedor){
        $id_articulo = htmlspecialchars(trim($id_articulo));
        $proveedor = htmlspecialchars(trim($proveedor));
        $campos = "id_articulo,id_proveedor";
        $valores = "'".$id_articulo."','".$proveedor."'";
        $sql = "INSERT INTO articulo_proveedor (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Artículo Proveedor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Artículo Proveedor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $GLOBALS['mensaje'] = "El artículo y su proveedor se han guardado correctamente en el sistema.";
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una sede ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede.
     * @return array
    **/
    public function verificarSede($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $sql = "SELECT * FROM sede WHERE nombre = '".$nombre_sede."'";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Sede 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Sede 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La sede ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un campus ya está registrado en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el campus.
     * @param string $nombre_campus, nombre del campus.
     * @return array
    **/
    public function verificarCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM campus WHERE sede = '".$nombre_sede."' AND nombre = '".$nombre_campus."'";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Campus 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Campus 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El campus ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya está registrado en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el edificio.
     * @param string $nombre_campus, nombre del campus al que pertenece el edificio.
     * @param string $id_edificio, id del edificio.
     * @return array
    **/
    public function verificarEdificio($nombre_sede,$nombre_campus,$id_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $sql = "SELECT * FROM edificio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_edificio."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Edificio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Edificio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El edificio ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una cancha ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece la cancha.
     * @param string $nombre_campus, nombre del campus al que pertenece la cancha.
     * @param string $id_cancha, id de la cancha.
     * @return array
    **/
    public function verificarCancha($nombre_sede,$nombre_campus,$id_cancha){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_cancha = htmlspecialchars(trim($id_cancha));
        $sql = "SELECT * FROM cancha WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_cancha."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Cancha 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Cancha 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La cancha ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un corredor ya está registrado en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el corredor.
     * @param string $nombre_campus, nombre del campus al que pertenece el corredor.
     * @param string $id_corredor, id del corredor.
     * @return array
    **/
    public function verificarCorredor($nombre_sede,$nombre_campus,$id_corredor){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_corredor = htmlspecialchars(trim($id_corredor));
        $sql = "SELECT * FROM corredor WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_corredor."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Corredor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Corredor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El corredor ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una cubierta ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece la cubierta.
     * @param string $nombre_campus, nombre del campus al que pertenece la cubierta.
     * @param string $nombre_edificio, id del edificio.
     * @param string $piso, piso donde está la cubierta.
     * @return array
    **/
    public function verificarCubierta($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM cubiertas_piso WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Cubierta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Cubierta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La cubierta ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si unas gradas ya están registradas en el sistema.
     * @param string $nombre_sede, id de la sede a la que pertenecen las gradas.
     * @param string $nombre_campus, id del campus al que pertenecen las gradas.
     * @param string $nombre_edificio, id del edificio.
     * @param string $piso, piso donde inician las gradas.
     * @return array
    **/
    public function verificarGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM gradas WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_inicio = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Gradas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Gradas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. Las gradas del piso ".$piso." del edificio ".$nombre_edificio." ya se encuentran registradas en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un parqueadero ya está registrado en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el parqueadero.
     * @param string $nombre_campus, nombre del campus al que pertenece el parqueadero.
     * @param string $codigo, código del parqueadero.
     * @return array
    **/
    public function verificarParqueadero($nombre_sede,$nombre_campus,$codigo){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $codigo = htmlspecialchars(trim($codigo));
        $sql = "SELECT * FROM parqueadero WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$codigo."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Parqueadero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Parqueadero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El parqueadero ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una piscina ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece la piscina.
     * @param string $nombre_campus, nombre del campus al que pertenece la piscina.
     * @param string $id_piscina, id de la piscina.
     * @return array
    **/
    public function verificarPiscina($nombre_sede,$nombre_campus,$id_piscina){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_piscina = htmlspecialchars(trim($id_piscina));
        $sql = "SELECT * FROM piscina WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_piscina."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Piscina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Piscina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La piscina ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una plazoleta ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece la plazoleta.
     * @param string $nombre_campus, nombre del campus al que pertenece la plazoleta.
     * @param string $id_plazoleta, id de la plazoleta.
     * @return array
    **/
    public function verificarPlazoleta($nombre_sede,$nombre_campus,$id_plazoleta){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_plazoleta = htmlspecialchars(trim($id_plazoleta));
        $sql = "SELECT * FROM plazoleta WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_plazoleta."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La plazoleta ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un sendero ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el sendero.
     * @param string $nombre_campus, nombre del campus al que pertenece el sendero.
     * @param string $id_sendero, id del sendero.
     * @return array
    **/
    public function verificarSendero($nombre_sede,$nombre_campus,$id_sendero){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_sendero = htmlspecialchars(trim($id_sendero));
        $sql = "SELECT * FROM sendero WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_sendero."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Sendero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Sendero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El sendero ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una vía ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece la vía.
     * @param string $nombre_campus, nombre del campus al que pertenece la vía.
     * @param string $id_edificio, id de la vía.
     * @return array
    **/
    public function verificarVia($nombre_sede,$nombre_campus,$id_via){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_via = htmlspecialchars(trim($id_via));
        $sql = "SELECT * FROM via WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_via."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Vía 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Vía 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La vía ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el espacio.
     * @param string $nombre_campus, nombre del campus al que pertenece el espacio.
     * @param string $nombre_edificio, nombre del edificio al que pertenece el espacio.
     * @param string $numero_espacio, número del espacio.
     * @return array
    **/
    public function verificarEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$numero_espacio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $numero_espacio = htmlspecialchars(trim($numero_espacio));
        $sql = "SELECT * FROM espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND id = '".$numero_espacio."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El espacio ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya está registrada en el sistema.
     * @param string $tipo_material, tipo de material.
     * @param string $nombre_tipo_material, nombre del tipo de material.
     * @return array
    **/
    public function verificarTipoMaterial($tipo_material,$nombre_tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $nombre_tipo_material = htmlspecialchars(trim($nombre_tipo_material));
        $sql = "SELECT * FROM ".$tipo_material." WHERE material = '".$nombre_tipo_material."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Material 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Material 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El tipo de material ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya está registrada en el sistema.
     * @param string $tipo_material, tipo de objeto.
     * @param string $nombre_tipo_material, nombre del tipo de objeto.
     * @return array
    **/
    public function verificarTipoObjeto($tipo_objeto,$nombre_tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $nombre_tipo_objeto = htmlspecialchars(trim($nombre_tipo_objeto));
        $sql = "SELECT * FROM ".$tipo_objeto." WHERE tipo = '".$nombre_tipo_objeto."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Objeto 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Objeto 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                if (strcmp($tipo_objeto,"tipo_aire") == 0) {
                    $GLOBALS['mensaje'] = "ERROR. El tipo de aire acondicionado ya se encuentra registrado en el sistema";
                }else{
                    $GLOBALS['mensaje'] = "ERROR. El tipo de objeto ya se encuentra registrado en el sistema";
                }
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un aire acondicionado ya esta registrada en el sistema.
     * @param string $numero_inventario, número de inventario del aire.
     * @return array
    **/
    public function verificarAire($numero_inventario){
        $numero_inventario = htmlspecialchars(trim($numero_inventario));
        if (strcmp($numero_inventario,"") == 0) {
            return true;
        }else{
            $sql = "SELECT * FROM aire_acondicionado WHERE numero_inventario = '".$numero_inventario."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Aire Acondicionado 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Verificar Aire Acondicionado 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }elseif($l_stmt->rowCount() > 0){
                    $GLOBALS['mensaje'] = 'ERROR. El aire acondicionado con número de inventario "'.$numero_inventario.'" ya se encuentra registrada en el sistema.';
                    return false;
                }
                else{
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite consultar si un aire acondicionado ya esta registrada en el sistema.
     * @param string $id_aire, id del aire.
     * @return array
    **/
    public function verificarIdAire($id_aire){
        $id_aire = htmlspecialchars(trim($id_aire));
        $sql = "SELECT * FROM aire_acondicionado WHERE id_aire = '".$id_aire."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Aire Acondicionado Id 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Aire Acondicionado Id 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['sql'] = $sql;
                return true;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return false;
            }
        }
    }

    /**
     * Función que permite guardar fotos de un aire acondicionado que el usuario selecionó.
     * @param string $id_aire, id del aire.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoAire($id_aire,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_aire = htmlspecialchars(trim($id_aire));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/aire_acondicionado/".$id_aire."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO aire_acondicionado_archivos (id_aire,nombre,tipo) VALUES ('".$id_aire."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Aire 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Aire 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                        return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite guardar fotos de un artículo que el usuario selecionó.
     * @param string $id_articulo, id del artículo.
     * @param file $foto, variable con la información de la foto a guardar.
     * @return array
    **/
    public function guardarFotoArticulo($id_articulo,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $id_articulo = htmlspecialchars(trim($id_articulo));
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = __ROOT__."/archivos/images/articulo/".$id_articulo."/";
            if (!file_exists($ruta.$foto['name'])) {
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO articulo_archivos (id_articulo,nombre,tipo) VALUES ('".$id_articulo."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Articulo 1)";
                    unlink($ruta.$foto['name']);
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Articulo 2)";
                        unlink($ruta.$foto['name']);
                        $GLOBALS['sql'] = $sql;
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
                        $GLOBALS['sql'] = $sql;
                return true;
                    }
                }
            }else{
                $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" ya existe.';
                return false;
            }
        }else{
            $GLOBALS['mensaje'] = 'ERROR. El archivo "'.$foto['name'].'" no se subió correctamente';
            return false;
        }
    }

    /**
     * Función que permite consultar si una orden de mantenimiento existe.
     * @param string $capacidad, capacidad.
     * @return array
    **/
    public function verificarOrdenMantenimiento($numero_orden){
        $numero_orden = htmlspecialchars(trim($numero_orden));
        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE numero_solicitud = '".$numero_orden."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Orden Mantenimiento 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Orden Mantenimiento 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['sql'] = $sql;
                return true;
            }
            else{
                $GLOBALS['mensaje'] = 'ERROR. La orden de mantenimiento no se encuentra registrada en el sistema.';
                $GLOBALS['sql'] = $sql;
                return false;
            }
        }
    }

    /**
     * Función que permite consultar si una capacidad de aires acondicionados ya esta registrada en el sistema.
     * @param string $capacidad, capacidad.
     * @return array
    **/
    public function verificarCapacidadAire($capacidad){
        $capacidad = htmlspecialchars(trim($capacidad));
        $sql = "SELECT * FROM capacidad_aire WHERE capacidad = '".$capacidad."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Capacidad Aires Acondicionados 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Capacidad Aires Acondicionados 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La capacidad ya se encuentra registrada en el sistema.";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una marca de aires acondicionados ya esta registrada en el sistema.
     * @param string $marca, marca de aire acondicionado.
     * @return array
    **/
    public function verificarMarcaAire($marca){
        $marca = htmlspecialchars(trim($marca));
        $sql = "SELECT * FROM marca_aire WHERE nombre = '".$marca."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Marca Aires Acondicionados 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Marca Aires Acondicionados 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La marca de aires acondicionados ya se encuentra registrada en el sistema.";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un mantenimiento a un aire acondicionado ya esta registrado en el sistema.
     * @param string $id_aire, id del aire.
     * @param string $numero_orden, número de orden de mantenimiento.
     * @return array
    **/
    public function verificarMantenimientoAire($id_aire,$numero_orden){
        $id_aire = htmlspecialchars(trim($id_aire));
        $numero_orden = htmlspecialchars(trim($numero_orden));
        $sql = "SELECT * FROM mantenimiento_aire WHERE id_aire = '".$id_aire."' AND numero_orden = '".$numero_orden."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Mantenimiento Aire 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Mantenimiento Aire 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un mantenimiento a un aire acondicionado ya esta registrado en el sistema.
     * @param string $numero_orden, número de orden de mantenimiento.
     * @return array
    **/
    public function verificarSolicitudMantenimiento($numero_orden){
        $id_aire = htmlspecialchars(trim($id_aire));
        $numero_orden = htmlspecialchars(trim($numero_orden));
        $sql = "SELECT * FROM mantenimiento_aire WHERE numero_orden = '".$numero_orden."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Solicitud Mantenimiento 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Solicitud Mantenimiento 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una marca del módulo de inventario ya está registrada en el sistema.
     * @param string $marca, nombre de la marca.
     * @param string $bodega, bodega de la marca.
     * @return array
    **/
    public function verificarMarcaInventario($marca,$bodega){
        $marca = htmlspecialchars(trim($marca));
        $bodega = htmlspecialchars(trim($bodega));
        $sql = "SELECT * FROM marca_inventario WHERE nombre = '".$marca."' AND bodega = '".$bodega."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Marca Inventario 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Marca Inventario 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La marca ya se encuentra registrada en el sistema.";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si una categoría del módulo de inventario ya está registrada en el sistema.
     * @param string $categoria, nombre de la categoría.
     * @param string $bodega, bodega de la categoría.
     * @return array
    **/
    public function verificarCategoria($categoria,$bodega){
        $categoria = htmlspecialchars(trim($categoria));
        $bodega = htmlspecialchars(trim($bodega));
        $sql = "SELECT * FROM categoria_articulo WHERE nombre = '".$categoria."' AND bodega = '".$bodega."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Categoría 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Categoría 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. La categoría ya se encuentra registrada en el sistema.";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un proveedor ya se encuentra registrado en el sistema.
     * @param string $nombre, nombre del proveedor.
     * @param string $bodega, bodega del proveedor.
     * @return array
    **/
    public function verificarProveedor($nombre,$bodega){
        $nombre = htmlspecialchars(trim($nombre));
        $bodega = htmlspecialchars(trim($bodega));
        $sql = "SELECT * FROM proveedor WHERE nombre = '".$nombre."' AND bodega = '".$bodega."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Proveedor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Proveedor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "ERROR. El proveedor ya se encuentra registrado en el sistema.";
                return false;
            }
            else{
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un artículo ya se encuentra registrado en el sistema.
     * @param string $nombre, nombre del artículo.
     * @param string $marca, marca del artículo.
     * @return array
    **/
    public function verificarArticulo($nombre,$marca){
        $nombre = htmlspecialchars(trim($nombre));
        $marca = htmlspecialchars(trim($marca));
        if (strcmp($nombre,"") == 0 && strcmp($marca,"") == 0) {
            return true;
        }else{
            $sql = "SELECT * FROM articulo WHERE nombre = '".$nombre."' AND marca = '".$marca."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Artículo 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Verificar Artículo 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }elseif($l_stmt->rowCount() > 0){
                    $GLOBALS['mensaje'] = 'ERROR. El artículo ya se encuentra registrado en el sistema.';
                    return false;
                }
                else{
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite consultar el id de un campus ya está registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el campus.
     * @param string $nombre_campus, nombre del campus.
     * @return array
    **/
    public function obtenerIdCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT id FROM campus WHERE sede = '".$nombre_sede."' AND nombre = '".$nombre_campus."'";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Obtener Id Campus 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Obtener Id Campus 2)";
                $GLOBALS['sql'] = $sql;
            }elseif($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
            }
            return $result;
        }
    }
}
?>
