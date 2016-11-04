<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase modelo_modificacion
 */
class modelo_modificacion {
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
     * Función que permite modificar una sede.
     * @param string $id_sede, id de la sede.
     * @param string $nombre_sede, nuevo nombre de la sede.
     * @return array
     */
    public function modificarSede($id_sede,$nombre_sede){
        $id_sede = htmlspecialchars(trim($id_sede));
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $sql = "UPDATE sede SET nombre = '".$nombre_sede."' WHERE id = '".$id_sede."';";
        $data = $this->consultarCampoSede($id_sede);
        foreach ($data as $clave => $valor) {
            $nombre_sede_antiguo = $valor['nombre'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Sede 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Sede 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("sede",$id_sede,"nombre",$nombre_sede_antiguo,$nombre_sede);
                $GLOBALS['mensaje'] = "La sede se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un campus.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $nombre_campus, nuevo nombre del campus.
     * @param string $lat, nueva lat del campus.
     * @param string $lng, nueva lng del campus.
     * @return array
     */
    public function modificarCampus($id_sede,$id_campus,$nombre_campus,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $sql = "UPDATE campus SET nombre = '".$nombre_campus."', lat = '".$lat."', lng = '".$lng."' WHERE id = '".$id_campus."' AND sede = '".$id_sede."';";
        $data = $this->consultarCampoCampus($id_sede,$id_campus);
        foreach ($data as $clave => $valor) {
            $nombre_campus_anterior = $valor['nombre'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Campus 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Campus 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("campus",$id_sede."-".$id_campus,"nombre",$nombre_campus_anterior,$nombre_campus);
                $this->registrarModificacion("campus",$id_sede."-".$id_campus,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("campus",$id_sede."-".$id_campus,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "El campus se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una cancha.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la cancha.
     * @param string $uso, nuevo uso de la cancha.
     * @param string $material_piso, nuevo material piso de la cancha.
     * @param string $tipo_pintura, nuevo tipo de pintura de la cancha.
     * @param string $longitud_demarcacion, nueva longitud de demarcación de la cancha.
     * @param string $lat, nueva lat de la cancha.
     * @param string $lng, nueva lng de la cancha.
     * @return array
     */
    public function modificarCancha($id_sede,$id_campus,$id,$uso,$material_piso,$tipo_pintura,$longitud_demarcacion,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $uso = htmlspecialchars(trim($uso));
        $material_piso = htmlspecialchars(trim($material_piso));
        $tipo_pintura = htmlspecialchars(trim($tipo_pintura));
        $longitud_demarcacion = htmlspecialchars(trim($longitud_demarcacion));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "uso = '".$uso."', longitud_demarcacion = '".$longitud_demarcacion."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($material_piso,'') != 0)
            $campos = $campos.", id_material_piso = '".$material_piso."'";
        if (strcasecmp($tipo_pintura,'') != 0)
            $campos = $campos.", id_tipo_pintura_demarcacion = '".$tipo_pintura."'";
        $sql = "UPDATE cancha SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"cancha");
        foreach ($data as $clave => $valor) {
            $uso_anterior = $valor['uso'];
            $material_piso_anterior = $valor['id_material_piso'];
            $tipo_pintura_anterior = $valor['id_tipo_pintura_demarcacion'];
            $longitud_demarcacion_anterior = $valor['longitud_demarcacion'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cancha 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Cancha 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"uso",$uso_anterior,$uso);
                if (strcasecmp($material_piso,'') != 0)
                    $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"id_material_piso",$material_piso_anterior,$material_piso);
                if (strcasecmp($tipo_pintura,'') != 0)
                    $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"id_tipo_pintura_demarcacion",$tipo_pintura_anterior,$tipo_pintura);
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"longitud_demarcacion",$longitud_demarcacion_anterior,$longitud_demarcacion);
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "La cancha se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la corredor.
     * @param string $ancho_pared, ancho pared del corredor.
     * @param string $alto_pared, alto pared del corredor.
     * @param string $material_pared, material pared del corredor.
     * @param string $ancho_piso, ancho piso del corredor.
     * @param string $largo_piso, largo piso del corredor.
     * @param string $material_piso, material piso del corredor.
     * @param string $ancho_techo, ancho techo del corredor.
     * @param string $largo_techo, largo techo del corredor.
     * @param string $material_techo, material techo del corredor.
     * @param string $tomacorriente, tipo de tomacorriente del corredor.
     * @param string $tipo_suministro_energia, tipo de suministro de energia del corredor.
     * @param string $cantidad, cantidad de tomacorrientes del corredor.
     * @param string $lat, nueva lat del corredor.
     * @param string $lng, nueva lng del corredor.
     * @return array
     */
    public function modificarCorredor($id_sede,$id_campus,$id,$ancho_pared,$alto_pared,$material_pared,$ancho_piso,$largo_piso,$material_piso,$ancho_techo,$largo_techo,$material_techo,$tomacorriente,$tipo_suministro_energia,$cantidad,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior,$tipo_interruptor,$tipo_interruptor_anterior,$cantidad_interruptor,$cantidad_interruptor_anterior,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
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
        $cantidad = htmlspecialchars(trim($cantidad));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "ancho_pared = '".$ancho_pared."', alto_pared = '".$alto_pared."',
                    ancho_piso = '".$ancho_piso."', largo_piso = '".$largo_piso."',
                    ancho_techo = '".$ancho_techo."', largo_techo = '".$largo_techo."',
                    tomacorriente = '".$tomacorriente."', cantidad = '".$cantidad."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($material_pared,'') != 0)
            $campos = $campos.", id_material_pared = '".$material_pared."'";
        if (strcasecmp($material_piso,'') != 0)
            $campos = $campos.", id_material_piso = '".$material_piso."'";
        if (strcasecmp($material_techo,'') != 0)
            $campos = $campos.", id_material_techo = '".$material_techo."'";
        if (strcasecmp($tipo_suministro_energia,'') != 0)
            $campos = $campos.", id_tipo_suministro_energia = '".$tipo_suministro_energia."'";
        $sql = "UPDATE corredor SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"corredor");
        foreach ($data as $clave => $valor) {
            $ancho_pared_anterior = $valor['ancho_pared'];
            $alto_pared_anterior = $valor['alto_pared'];
            $material_pared_anterior = $valor['id_material_pared'];
            $ancho_piso_anterior = $valor['ancho_piso'];
            $largo_piso_anterior = $valor['largo_piso'];
            $material_piso_anterior = $valor['id_material_piso'];
            $ancho_techo_anterior = $valor['ancho_techo'];
            $largo_techo_anterior = $valor['largo_techo'];
            $material_techo_anterior = $valor['id_material_techo'];
            $tomacorriente_anterior = $valor['tomacorriente'];
            $tipo_suministro_energia_anterior = $valor['id_tipo_suministro_energia'];
            $cantidad_anterior = $valor['cantidad'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Corredor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Corredor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"ancho_pared",$ancho_pared_anterior,$ancho_pared);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"alto_pared",$alto_pared_anterior,$alto_pared);
                if (strcasecmp($material_pared,'') != 0)
                    $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"id_material_pared",$material_pared_anterior,$material_pared);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"ancho_piso",$ancho_piso_anterior,$ancho_piso);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"largo_piso",$largo_piso_anterior,$largo_piso);
                if (strcasecmp($material_piso,'') != 0)
                    $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"id_material_piso",$material_piso_anterior,$material_piso);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"ancho_techo",$ancho_techo_anterior,$ancho_techo);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"largo_techo",$largo_techo_anterior,$largo_techo);
                if (strcasecmp($material_techo,'') != 0)
                    $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"id_material_techo",$material_techo_anterior,$material_techo);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"tomacorriente",$tomacorriente_anterior,$tomacorriente);
                if (strcasecmp($tipo_suministro_energia,'') != 0)
                    $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_suministro_energia",$tipo_suministro_energia_anterior,$tipo_suministro_energia);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad_anterior,$cantidad);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("corredor",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "El corredor se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                  $this->modificarIluminacionCorredor($id_sede,$id_campus,$id,$tipo_iluminacion[$i],$tipo_iluminacion_anterior[$i],$cantidad_iluminacion[$i],$cantidad_iluminacion_anterior[$i]);
                }
                for ($i=0;$i<count($tipo_interruptor);$i++) {
                  $this->modificarInterruptorCorredor($id_sede,$id_campus,$id,$tipo_interruptor[$i],$tipo_interruptor_anterior[$i],$cantidad_interruptor[$i],$cantidad_interruptor_anterior[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite modificar la iluminación de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @param string $tipo_iluminacion, nuevo tipo de iluminación del corredor.
     * @param string $tipo_iluminacion_anterior, tipo anterior de iluminación del corredor.
     * @param string $cantidad_iluminacion, nueva cantidad de iluminación del corredor.
     * @param string $cantidad_iluminacion_anterior, cantidad anterior de iluminación del corredor.
     * @return array
     */
    public function modificarIluminacionCorredor($id_sede,$id_campus,$id,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $tipo_iluminacion_anterior = htmlspecialchars(trim($tipo_iluminacion_anterior));
        $cantidad_iluminacion = htmlspecialchars(trim($cantidad_iluminacion));
        $cantidad_iluminacion_anterior = htmlspecialchars(trim($cantidad_iluminacion_anterior));
        $campos = "";
        if (strcasecmp($tipo_iluminacion,'') != 0){
            if(strcasecmp($tipo_iluminacion_anterior,'') != 0){
                $campos = "id_tipo_iluminacion = '".$tipo_iluminacion."', cantidad = '".$cantidad_iluminacion."'";
                $sql = "UPDATE iluminacion_corredor SET $campos WHERE id_tipo_iluminacion = '".$tipo_iluminacion_anterior."' AND id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO iluminacion_corredor (id,id_sede,id_campus,id_tipo_iluminacion,cantidad) VALUES ('".$id."', '".$id_sede."', '".$id_campus."', '".$tipo_iluminacion."', '".$cantidad_iluminacion."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Iluminación-Corredor 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Iluminación-Corredor 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("iluminacion_corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_iluminacion",$tipo_iluminacion_anterior,$tipo_iluminacion);
                    $this->registrarModificacion("iluminacion_corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad_iluminacion_anterior,$cantidad_iluminacion);
                    $GLOBALS['mensaje'] = "La iluminación del corredor se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar los interruptores de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @param string $tipo_interruptor, nuevo tipo de interruptor del corredor.
     * @param string $tipo_interruptor_anterior, tipo anterior de interruptor del corredor.
     * @param string $cantidad_interruptor, nueva cantidad de interruptor del corredor.
     * @param string $cantidad_interruptor_anterior, cantidad anterior de interruptores del corredor.
     * @return array
     */
    public function modificarInterruptorCorredor($id_sede,$id_campus,$id,$tipo_interruptor,$tipo_interruptor_anterior,$cantidad_interruptor,$cantidad_interruptor_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        $tipo_interruptor_anterior = htmlspecialchars(trim($tipo_interruptor_anterior));
        $cantidad_interruptor = htmlspecialchars(trim($cantidad_interruptor));
        $cantidad_interruptor_anterior = htmlspecialchars(trim($cantidad_interruptor_anterior));
        $campos = "";
        if (strcasecmp($tipo_interruptor,'') != 0){
            if(strcasecmp($tipo_interruptor_anterior,'') != 0){
                $campos = "id_tipo_interruptor = '".$tipo_interruptor."', cantidad = '".$cantidad_interruptor."'";
                $sql = "UPDATE interruptor_corredor SET $campos WHERE id_tipo_interruptor = '".$tipo_interruptor_anterior."' AND id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO interruptor_corredor (id,id_sede,id_campus,id_tipo_interruptor,cantidad) VALUES ('".$id."', '".$id_sede."', '".$id_campus."', '".$tipo_interruptor."', '".$cantidad_interruptor_anterior."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Interruptor-Corredor 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Interruptor-Corredor 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("interruptor_corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_interruptor",$tipo_interruptor_anterior,$tipo_interruptor);
                    $this->registrarModificacion("interruptor_corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad_interruptor_anterior,$cantidad_interruptor);
                    $GLOBALS['mensaje'] = "El interruptor del corredor se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar una cubierta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso donde está la cubierta.
     * @param string $tipo_cubierta, nuevo tipo de cubierta.
     * @param string $material_cubierta, nuevo material de la cubierta.
     * @param string $largo_cubierta, nuevo largo de la cubierta.
     * @param string $ancho_cubierta, nuevo ancho de la cubierta.
     * @return array
     */
    public function modificarCubierta($id_sede,$id_campus,$id_edificio,$piso,$tipo_cubierta,$material_cubierta,$largo_cubierta,$ancho_cubierta){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $tipo_cubierta = htmlspecialchars(trim($tipo_cubierta));
        $material_cubierta = htmlspecialchars(trim($material_cubierta));
        $largo_cubierta = htmlspecialchars(trim($largo_cubierta));
        $ancho_cubierta = htmlspecialchars(trim($ancho_cubierta));
        $campos = "largo = '".$largo_cubierta."', ancho = '".$ancho_cubierta."'";
        if (strcasecmp($tipo_cubierta,'') != 0)
            $campos = $campos.", id_tipo_cubierta = '".$tipo_cubierta."'";
        if (strcasecmp($material_cubierta,'') != 0)
            $campos = $campos.", id_material_cubierta = '".$material_cubierta."'";
        $sql = "UPDATE cubiertas_piso SET $campos WHERE id_edificio = '".$id_edificio."' AND piso = '".$piso."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoCubierta($id_sede,$id_campus,$id_edificio,$piso);
        foreach ($data as $clave => $valor) {
            $tipo_cubierta_anterior = $valor['id_tipo_cubierta'];
            $material_cubierta_anterior = $valor['id_material_cubierta'];
            $largo_cubierta_anterior = $valor['largo'];
            $ancho_cubierta_anterior = $valor['ancho'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cubierta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Cubierta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if (strcasecmp($tipo_cubierta,'') != 0)
                    $this->registrarModificacion("cubiertas_piso",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_tipo_cubierta",$tipo_cubierta_anterior,$tipo_cubierta);
                if (strcasecmp($material_cubierta,'') != 0)
                    $this->registrarModificacion("cubiertas_piso",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material_cubierta",$material_cubierta_anterior,$material_cubierta);
                $this->registrarModificacion("cubiertas_piso",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"largo_cubierta",$largo_cubierta_anterior,$largo_cubierta);
                $this->registrarModificacion("cubiertas_piso",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"ancho_cubierta",$ancho_cubierta_anterior,$ancho_cubierta);
                $GLOBALS['mensaje'] = "La cubierta se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar unas gradas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso donde inician las gradas.
     * @param string $pasamanos, nuevo valor de pasamanos (si tiene o no).
     * @param string $material_pasamanos, nuevo material del pasamanos.
     * @param string $tipo_ventana, tipo de ventanas de las gradas.
     * @param string $material, material de las ventanas de las gradas.
     * @param string $alto_ventana, alto de las ventanas de las gradas.
     * @param string $ancho_ventana, ancho de las ventanas de las gradas.
     * @return array
     */
    public function modificarGradas($id_sede,$id_campus,$id_edificio,$piso,$pasamanos,$material_pasamanos,$tipo_ventana,$tipo_ventana_anterior,$material,$material_anterior,$cantidad_ventana,$cantidad_ventana_anterior,$alto_ventana,$alto_ventana_anterior,$ancho_ventana,$ancho_ventana_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $pasamanos = htmlspecialchars(trim($pasamanos));
        $material_pasamanos = htmlspecialchars(trim($material_pasamanos));
        $campos = "pasamanos = '".$pasamanos."'";
        if (strcasecmp($pasamanos,'false') == 0){
            $material_pasamanos = 'NULL';
            $campos = $campos.", id_material_pasamanos = ".$material_pasamanos."";
        }
        elseif (strcasecmp($material_pasamanos,'') != 0)
                $campos = $campos.", id_material_pasamanos = '".$material_pasamanos."'";
        $sql = "UPDATE gradas SET $campos WHERE id_edificio = '".$id_edificio."' AND piso_inicio = '".$piso."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoGradas($id_sede,$id_campus,$id_edificio,$piso,"gradas");
        foreach ($data as $clave => $valor) {
            $pasamanos_anterior = $valor['pasamanos'];
            $material_pasamanos_anterior = $valor['id_material_pasamanos'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Gradas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Gradas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"pasamanos",$pasamanos_anterior,$pasamanos);
                if (strcasecmp($material_pasamanos,'') != 0)
                    $this->registrarModificacion("gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material_pasamanos",$material_pasamanos_anterior,$material_pasamanos);
                $GLOBALS['mensaje'] = "Las gradas se modificaron correctamente";
                $GLOBALS['sql'] = $sql;
                for ($i=0;$i<count($tipo_ventana);$i++) {
                  $this->modificarVentanaGradas($id_sede,$id_campus,$id_edificio,$piso,$tipo_ventana[$i],$tipo_ventana_anterior[$i],$cantidad_ventana[$i],$cantidad_ventana_anterior[$i],$material[$i],$material_anterior[$i],$ancho_ventana[$i],$ancho_ventana_anterior[$i],$alto_ventana[$i],$alto_ventana_anterior[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite modificar las ventanas de unas gradas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio id del edificio.
     * @param string $piso, piso del edificio donde comienzan las gradas.
     * @param string $tipo_ventana, nuevo tipo de ventana de las gradas.
     * @param string $tipo_ventana_anterior, tipo anterior de ventana de las gradas.
     * @param string $cantidad_ventana, nueva cantidad de ventanas de las gradas.
     * @param string $cantidad_ventana_anterior, antigua cantidad de ventanas de las gradas.
     * @param string $material, nuevo tipo de material de las ventanas de las gradas.
     * @param string $material_anterior, anterior de material de las ventanas de las gradas.
     * @param string $ancho_ventana, nueva ancho de las ventanas de las gradas.
     * @param string $ancho_ventana_anterior, anterior ancho de ventanas de las gradas.
     * @param string $alto_ventana, nuevo alto de las ventanas de las gradas.
     * @param string $alto_ventana_anterior, antiguo alto de las ventanas de las gradas.
     * @return array
     */
    public function modificarVentanaGradas($id_sede,$id_campus,$id_edificio,$piso,$tipo_ventana,$tipo_ventana_anterior,$cantidad_ventana,$cantidad_ventana_anterior,$material,$material_anterior,$ancho_ventana,$ancho_ventana_anterior,$alto_ventana,$alto_ventana_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $tipo_ventana_anterior = htmlspecialchars(trim($tipo_ventana_anterior));
        $cantidad_ventana = htmlspecialchars(trim($cantidad_ventana));
        $cantidad_ventana_anterior = htmlspecialchars(trim($cantidad_ventana_anterior));
        $material = htmlspecialchars(trim($material));
        $material_anterior = htmlspecialchars(trim($material_anterior));
        $ancho_ventana = htmlspecialchars(trim($ancho_ventana));
        $ancho_ventana_anterior = htmlspecialchars(trim($ancho_ventana_anterior));
        $alto_ventana = htmlspecialchars(trim($alto_ventana));
        $alto_ventana_anterior = htmlspecialchars(trim($alto_ventana_anterior));
        $campos = "";
        if (strcasecmp($tipo_ventana,'') != 0 && strcasecmp($material,'') != 0){
            if ((strcasecmp($tipo_ventana_anterior,'') != 0 || strcasecmp($material_anterior,'') != 0)){
                $campos = "id_tipo_ventana = '".$tipo_ventana."', id_material = '".$material."', cantidad = '".$cantidad_ventana."', alto_ventana = '".$alto_ventana."', ancho_ventana = '".$ancho_ventana."'";
                $sql = "UPDATE ventana_gradas SET $campos WHERE id_tipo_ventana = '".$tipo_ventana_anterior."' AND id_material =  '".$material_anterior."' AND piso_inicio = '".$piso."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO ventana_gradas (id_sede,id_campus,id_edificio,piso_inicio,id_tipo_ventana,id_material,cantidad,alto_ventana,ancho_ventana) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$piso."', '".$tipo_ventana."', '".$material."', '".$cantidad_ventana."', '".$ancho_ventana."', '".$alto_ventana."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Ventana-Gradas 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Ventana-Gradas 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_tipo_ventana",$tipo_ventana_anterior,$tipo_ventana);
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"cantidad",$cantidad_ventana_anterior,$cantidad_ventana);
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material",$material_anterior,$material);
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"alto_ventana",$alto_ventana_anterior,$alto_ventana);
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"ancho_ventana",$ancho_ventana_anterior,$ancho_ventana);
                    $GLOBALS['mensaje'] = "Las ventanas de las gradas se modificaron correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un parqueadero.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del parqueadero.
     * @param string $material_piso, nuevo material del piso del parqueadero.
     * @param string $tipo_pintura, nuevo tipo de pintura de parqueadero.
     * @param string $largo, nuevo largo del parqueadero.
     * @param string $ancho, nuevo ancho del parqueadero.
     * @param string $capacidad, nueva capacidad del parqueadero.
     * @param string $longitud_demarcacion, nueva longitud de demarcación del parqueadero.
     * @param string $lat, nueva lat del parqueadero.
     * @param string $lng, nueva lng del parqueadero.
     * @return array
     */
    public function modificarParqueadero($id_sede,$id_campus,$id,$material_piso,$tipo_pintura,$largo,$ancho,$capacidad,$longitud_demarcacion,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $material_piso = htmlspecialchars(trim($material_piso));
        $tipo_pintura = htmlspecialchars(trim($tipo_pintura));
        $largo = htmlspecialchars(trim($largo));
        $ancho = htmlspecialchars(trim($ancho));
        $capacidad = htmlspecialchars(trim($capacidad));
        $longitud_demarcacion = htmlspecialchars(trim($longitud_demarcacion));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "largo = '".$largo."', ancho = '".$ancho."', capacidad = '".$capacidad."', longitud_demarcacion = '".$longitud_demarcacion."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($material_piso,'') != 0)
            $campos = $campos.", id_material_piso = '".$material_piso."'";
        if (strcasecmp($tipo_pintura,'') != 0)
            $campos = $campos.", id_tipo_pintura_demarcacion = '".$tipo_pintura."'";
        $sql = "UPDATE parqueadero SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"parqueadero");
        foreach ($data as $clave => $valor) {
            $material_piso_anterior = $valor['id_material_piso'];
            $tipo_pintura_anterior = $valor['id_tipo_pintura_demarcacion'];
            $largo_anterior = $valor['largo'];
            $ancho_anterior = $valor['ancho'];
            $capacidad_anterior = $valor['capacidad'];
            $longitud_demarcacion_anterior = $valor['longitud_demarcacion'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Parqueadero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Parqueadero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if (strcasecmp($material_piso,'') != 0)
                    $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"id_material_piso",$material_piso_anterior,$material_piso);
                if (strcasecmp($tipo_pintura,'') != 0)
                    $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"id_tipo_pintura_demarcacion",$tipo_pintura_anterior,$tipo_pintura);
                $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"largo",$largo_anterior,$largo);
                $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"ancho",$ancho_anterior,$ancho);
                $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"capacidad",$capacidad_anterior,$capacidad);
                $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"longitud_demarcacion",$longitud_demarcacion_anterior,$longitud_demarcacion);
                $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("parqueadero",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "El parqueadero se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una piscina.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la piscina.
     * @param string $cantidad_punto_hidraulico, nueva cantidad de puntos hidraulicos de la piscina.
     * @param string $largo, nuevo largo de la piscina.
     * @param string $ancho, nuevo largo de la piscina.
     * @param string $alto, nuevo alto de la piscina.
     * @param string $lat, nueva lat de la piscina.
     * @param string $lng, nueva lng de la piscina.
     * @return array
     */
    public function modificarPiscina($id_sede,$id_campus,$id,$cantidad_punto_hidraulico,$largo,$ancho,$alto,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $largo = htmlspecialchars(trim($largo));
        $ancho = htmlspecialchars(trim($ancho));
        $alto = htmlspecialchars(trim($alto));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "cantidad_punto_hidraulico = '".$cantidad_punto_hidraulico."', largo = '".$largo."', ancho = '".$ancho."', alto = '".$alto."', lat = '".$lat."', lng = '".$lng."'";
        $sql = "UPDATE piscina SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"piscina");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_hidraulico_anterior = $valor['cantidad_punto_hidraulico'];
            $largo_anterior = $valor['largo'];
            $ancho_anterior = $valor['ancho'];
            $alto_anterior = $valor['alto'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Piscina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Piscina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("piscina",$id_sede."-".$id_campus."-".$id,"cantidad_punto_hidraulico",$cantidad_punto_hidraulico_anterior,$cantidad_punto_hidraulico);
                $this->registrarModificacion("piscina",$id_sede."-".$id_campus."-".$id,"largo",$largo_anterior,$largo);
                $this->registrarModificacion("piscina",$id_sede."-".$id_campus."-".$id,"ancho",$ancho_anterior,$ancho);
                $this->registrarModificacion("piscina",$id_sede."-".$id_campus."-".$id,"alto",$alto_anterior,$alto);
                $this->registrarModificacion("piscina",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("piscina",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "La piscina se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una plazoleta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la plazoleta.
     * @param string $tipo_iluminacion, nuevo tipo de iluminación de la plazoleta.
     * @param string $tipo_iluminacion_anterior, anterior tipo de iluminación de la plazoleta.
     * @param string $cantidad_iluminacion, nueva cantidad de lámparas de la plazoleta.
     * @param string $cantidad_iluminacion_anterior, anterior cantidad de lámparas de la plazoleta.
     * @param string $lat, nueva lat de la plazoleta.
     * @param string $lng, nueva lng de la plazoleta.
     * @return array
     */
    public function modificarPlazoleta($id_sede,$id_campus,$id,$nombre,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $nombre = htmlspecialchars(trim($nombre));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "nombre = '".$nombre."', lat = '".$lat."', lng = '".$lng."'";
        $sql = "UPDATE plazoleta SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"plazoleta");
        foreach ($data as $clave => $valor) {
            $nombre_anterior = $valor['nombre'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("plazoleta",$id_sede."-".$id_campus."-".$id,"nombre",$nombre_anterior,$nombre);
                $this->registrarModificacion("plazoleta",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("plazoleta",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->modificarIluminacionPlazoleta($id_sede,$id_campus,$id,$tipo_iluminacion[$i],$tipo_iluminacion_anterior[$i],$cantidad_iluminacion[$i],$cantidad_iluminacion_anterior[$i]);
                }
                $GLOBALS['mensaje'] = "La plazoleta se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar la iluminación de una plazoleta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la plazoleta.
     * @param string $tipo_iluminacion, nuevo tipo de iluminación de la plazoleta.
     * @param string $tipo_iluminacion_anterior, anterior tipo de iluminación de la plazoleta.
     * @param string $cantidad_iluminacion, nueva cantidad de iluminación de la plazoleta.
     * @param string $cantidad_iluminacion_anterior, anterior cantidad de lámparas de la plazoleta.
     * @return array
     */
    public function modificarIluminacionPlazoleta($id_sede,$id_campus,$id,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $tipo_iluminacion_anterior = htmlspecialchars(trim($tipo_iluminacion_anterior));
        $cantidad_iluminacion = htmlspecialchars(trim($cantidad_iluminacion));
        $cantidad_iluminacion_anterior = htmlspecialchars(trim($cantidad_iluminacion_anterior));
        $campos = "";
        if (strcasecmp($tipo_iluminacion,'') != 0){
            if(strcasecmp($tipo_iluminacion_anterior,'') != 0){
                $campos = "id_tipo_iluminacion = '".$tipo_iluminacion."', cantidad = '".$cantidad_iluminacion."'";
                $sql = "UPDATE iluminacion_plazoleta SET $campos WHERE id_tipo_iluminacion = '".$tipo_iluminacion_anterior."' AND id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO iluminacion_corredor (id,id_sede,id_campus,id_tipo_iluminacion,cantidad) VALUES ('".$id."', '".$id_sede."', '".$id_campus."', '".$tipo_iluminacion."', '".$cantidad_iluminacion."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Iluminación-Plazoleta 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Iluminación-Plazoleta 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("iluminacion_plazoleta",$id_sede."-".$id_campus."-".$id,"id_tipo_iluminacion",$tipo_iluminacion_anterior,$tipo_iluminacion);
                    $this->registrarModificacion("iluminacion_plazoleta",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad_iluminacion_anterior,$cantidad_iluminacion);
                    $GLOBALS['mensaje'] = "La iluminación de la plazoleta se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un sendero.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de un sendero.
     * @param string $longitud, nueva longitud del sendero.
     * @param string $ancho, nuevo ancho del sendero.
     * @param string $material_piso, nuevo material del piso del sendero.
     * @param string $tipo_iluminacion, nuevo tipo de iluminación del sendero.
     * @param string $cantidad, nueva cantidad de lámparas del sendero.
     * @param string $codigo_poste, nuevo código del poste del sendero.
     * @param string $material_cubierta, nuevo material de la cubierta del sendero.
     * @param string $ancho_cubierta, nuevo ancho de la cubierta del sendero.
     * @param string $largo_cubierta, nuevo largo de la cubierta del sendero.
     * @param string $lat, nueva lat del sendero.
     * @param string $lng, nueva lng del sendero.
     * @return array
     */
    public function modificarSendero($id_sede,$id_campus,$id,$longitud,$ancho,$material_piso,$tipo_iluminacion,$cantidad,$codigo_poste,$material_cubierta,$ancho_cubierta,$largo_cubierta,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $longitud = htmlspecialchars(trim($longitud));
        $ancho = htmlspecialchars(trim($ancho));
        $material_piso = htmlspecialchars(trim($material_piso));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $cantidad = htmlspecialchars(trim($cantidad));
        $codigo_poste = htmlspecialchars(trim($codigo_poste));
        $material_cubierta = htmlspecialchars(trim($material_cubierta));
        $ancho_cubierta = htmlspecialchars(trim($ancho_cubierta));
        $largo_cubierta = htmlspecialchars(trim($largo_cubierta));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "longitud = '".$longitud."', ancho = '".$ancho."', cantidad = '".$cantidad."', codigo_poste = '".$codigo_poste."', ancho_cubierta = '".$ancho_cubierta."', largo_cubierta = '".$largo_cubierta."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($material_cubierta,'') != 0)
            $campos = $campos.", id_material_cubierta = '".$material_cubierta."'";
        if (strcasecmp($material_piso,'') != 0)
            $campos = $campos.", id_material_piso = '".$material_piso."'";
          if (strcasecmp($tipo_iluminacion,'') != 0)
              $campos = $campos.", id_tipo_iluminacion = '".$tipo_iluminacion."'";
        $sql = "UPDATE sendero SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"sendero");
        foreach ($data as $clave => $valor) {
            $longitud_anterior = $valor['longitud'];
            $ancho_anterior = $valor['ancho'];
            $material_piso_anterior = $valor['id_material_piso'];
            $tipo_iluminacion_anterior = $valor['id_tipo_iluminacion'];
            $cantidad_anterior = $valor['cantidad'];
            $codigo_poste_anterior = $valor['codigo_poste'];
            $material_cubierta_anterior = $valor['id_material_cubierta'];
            $ancho_cubierta_anterior = $valor['ancho_cubierta'];
            $largo_cubierta_anterior = $valor['largo_cubierta'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Sendero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Sendero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"longitud_anterior",$longitud_anterior,$longitud);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"ancho_anterior",$ancho_anterior,$ancho);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"id_material_piso_anterior",$material_piso_anterior,$material_piso);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"id_tipo_iluminacion_anterior",$tipo_iluminacion_anterior,$tipo_iluminacion);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"cantidad_anterior",$cantidad_anterior,$cantidad);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"codigo_poste_anterior",$codigo_poste_anterior,$codigo_poste);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"id_material_cubierta_anterior",$material_cubierta_anterior,$material_cubierta);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"ancho_cubierta_anterior",$ancho_cubierta_anterior,$ancho_cubierta);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"largo_cubierta_anterior",$largo_cubierta_anterior,$largo_cubierta);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("sendero",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "El sendero peatonal se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una vía.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la vía.
     * @param string $tipo_material, nueva tipo de material de la vía.
     * @param string $tipo_pintura_demarcacion, nuevo tipo de pintura de la vía.
     * @param string $longitud_demarcacion, nueva longitud de demarcación la vía.
     * @param string $lat, nueva lat de la vía.
     * @param string $lng, nueva lng de la vía.
     * @return array
     */
    public function modificarVia($id_sede,$id_campus,$id,$tipo_material,$tipo_pintura_demarcacion,$longitud_demarcacion,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $tipo_pintura_demarcacion = htmlspecialchars(trim($tipo_pintura_demarcacion));
        $longitud_demarcacion = htmlspecialchars(trim($longitud_demarcacion));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "longitud_demarcacion = '".$longitud_demarcacion."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($tipo_material,'') != 0)
            $campos = $campos.", id_tipo_material = '".$tipo_material."'";
        if (strcasecmp($tipo_pintura_demarcacion,'') != 0)
            $campos = $campos.", id_tipo_pintura_demarcacion = '".$tipo_pintura_demarcacion."'";
        $sql = "UPDATE via SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"via");
        foreach ($data as $clave => $valor) {
            $tipo_material_anterior = $valor['id_tipo_material'];
            $tipo_pintura_demarcacion_anterior = $valor['id_tipo_pintura_demarcacion'];
            $longitud_demarcacion_anterior = $valor['longitud_demarcacion'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Via 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Via 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if (strcasecmp($tipo_material,'') != 0)
                    $this->registrarModificacion("via",$id_sede."-".$id_campus."-".$id,"id_tipo_material",$tipo_material_anterior,$tipo_material);
                if (strcasecmp($tipo_pintura_demarcacion,'') != 0)
                    $this->registrarModificacion("via",$id_sede."-".$id_campus."-".$id,"id_tipo_pintura_demarcacion",$tipo_pintura_demarcacion_anterior,$tipo_pintura_demarcacion);
                $this->registrarModificacion("via",$id_sede."-".$id_campus."-".$id,"longitud_demarcacion",$longitud_demarcacion_anterior,$longitud_demarcacion);
                $this->registrarModificacion("via",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("via",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "La vía se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un edificio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del edificio.
     * @param string $numero_pisos, nuevo número de pisos del edificio.
     * @param string $sotano, nuevo valor del sotano del edificio.
     * @param string $terraza, nuevo valor de la terraza del edificio.
     * @param string $material_fachada, nuevo material de fachada del edificio.
     * @param string $ancho_fachada, nuevo ancho de la fachada del edificio.
     * @param string $alto_fachada, nuevo alto de la fachada del edificio.
     * @param string $lat, nueva lat del edificio.
     * @param string $lng, nueva lng del edificio.
     * @return array
     */
    public function modificarEdificio($id_sede,$id_campus,$id,$nombre,$numero_pisos,$sotano,$terraza,$material_fachada,$ancho_fachada,$alto_fachada,$lat,$lng){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $nombre = htmlspecialchars(trim($nombre));
        $numero_pisos = htmlspecialchars(trim($numero_pisos));
        $sotano = htmlspecialchars(trim($sotano));
        $terraza = htmlspecialchars(trim($terraza));
        $material_fachada = htmlspecialchars(trim($material_fachada));
        $ancho_fachada = htmlspecialchars(trim($ancho_fachada));
        $alto_fachada = htmlspecialchars(trim($alto_fachada));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $campos = "nombre = '".$nombre."', numero_pisos = '".$numero_pisos."', sotano = '".$sotano."', terraza = '".$terraza."', ancho_fachada = '".$ancho_fachada."', alto_fachada = '".$alto_fachada."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($material_fachada,'') != 0)
            $campos = $campos.", id_material_fachada = '".$material_fachada."'";
        $sql = "UPDATE edificio SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"edificio");
        foreach ($data as $clave => $valor) {
            $nombre_anterior = $valor['nombre'];
            $numero_pisos_anterior = $valor['numero_pisos'];
            $sotano_anterior = $valor['sotano'];
            $terraza_anterior = $valor['terraza'];
            $material_fachada_anterior = $valor['id_material_fachada'];
            $ancho_fachada_anterior = $valor['ancho_fachada'];
            $alto_fachada_anterior = $valor['alto_fachada'];
            $lat_anterior = $valor['lat'];
            $lng_anterior = $valor['lng'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Edificio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Edificio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"nombre",$nombre_anterior,$nombre);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"numero_pisos",$numero_pisos_anterior,$numero_pisos);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"sotano",$sotano_anterior,$sotano);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"terraza",$terraza_anterior,$terraza);
                if (strcasecmp($material_fachada,'') != 0)
                    $campos = $campos.", id_material_fachada = '".$material_fachada."'";
                    $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"id_material_fachada",$material_fachada_anterior,$material_fachada);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"ancho_fachada",$ancho_fachada_anterior,$ancho_fachada);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"alto_fachada",$alto_fachada_anterior,$alto_fachada);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("edificio",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
                $GLOBALS['mensaje'] = "El edificio se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del edificio.
     * @param string $numero_pisos, nuevo número de pisos del edificio.
     * @param string $sotano, nuevo valor del sotano del edificio.
     * @param string $terraza, nuevo valor de la terraza del edificio.
     * @param string $material_fachada, nuevo material de fachada del edificio.
     * @param string $ancho_fachada, nuevo ancho de la fachada del edificio.
     * @param string $alto_fachada, nuevo alto de la fachada del edificio.
     * @param string $lat, nueva lat del edificio.
     * @param string $lng, nueva lng del edificio.
     * @return array
     */
    public function modificarEspacio($id_sede,$id_campus,$id_edificio,$piso,$id,$uso_espacio,$ancho_pared,$alto_pared,$material_pared,$ancho_piso,$largo_piso,$material_piso,$ancho_techo,$largo_techo,$material_techo,$tiene_espacio_padre,$espacio_padre,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior,$tipo_interruptor,$tipo_interruptor_anterior,$cantidad_interruptor,$cantidad_interruptor_anterior,$tipo_puerta,$tipo_puerta_anterior,$material_puerta,$material_puerta_anterior,$cantidad_puerta,$cantidad_puerta_anterior,$tipo_cerradura,$tipo_cerradura_anterior,$material_marco,$material_marco_anterior,$gato_puerta,$ancho_puerta,$ancho_puerta_anterior,$alto_puerta,$alto_puerta_anterior,$tipo_suministro_energia,$tipo_suministro_energia_anterior,$tomacorriente,$tomacorriente_anterior,$cantidad_suministro_energia,$cantidad_suministro_energia_anterior,$tipo_ventana,$tipo_ventana_anterior,$cantidad_ventana,$cantidad_ventana_anterior,$material_ventana,$material_ventana_anterior,$ancho_ventana,$ancho_ventana_anterior,$alto_ventana,$alto_ventana_anterior,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $piso = htmlspecialchars(trim($piso));
        $uso_espacio = htmlspecialchars(trim($uso_espacio));
        $ancho_pared = htmlspecialchars(trim($ancho_pared));
        $alto_pared = htmlspecialchars(trim($alto_pared));
        $material_pared = htmlspecialchars(trim($material_pared));
        $ancho_piso = htmlspecialchars(trim($ancho_piso));
        $largo_piso = htmlspecialchars(trim($largo_piso));
        $material_piso = htmlspecialchars(trim($material_piso));
        $ancho_techo = htmlspecialchars(trim($ancho_techo));
        $largo_techo = htmlspecialchars(trim($largo_techo));
        $material_techo = htmlspecialchars(trim($material_techo));
        $tiene_espacio_padre = htmlspecialchars(trim($tiene_espacio_padre));
        $espacio_padre = htmlspecialchars(trim($espacio_padre));
        $campos = "piso_edificio = '".$piso."', ancho_pared = '".$ancho_pared."', alto_pared = '".$alto_pared."', ancho_piso = '".$ancho_piso."', largo_piso = '".$largo_piso."', ancho_techo = '".$ancho_techo."', largo_techo = '".$largo_techo."'";
        if (strcasecmp($material_pared,'') != 0)
            $campos = $campos.", id_material_pared = '".$material_pared."'";
        else
            $campos = $campos.", id_material_pared = NULL";
        if (strcasecmp($material_piso,'') != 0)
            $campos = $campos.", id_material_piso = '".$material_piso."'";
        else
            $campos = $campos.", id_material_piso = NULL";
        if (strcasecmp($material_techo,'') != 0)
            $campos = $campos.", id_material_techo = '".$material_techo."'";
        else
            $campos = $campos.", id_material_techo = NULL";
        if (strcasecmp($tiene_espacio_padre,'false') == 0)
            $campos = $campos.", espacio_padre = NULL, sede_padre = NULL, campus_padre = NULL, edificio_padre = NULL";
        if ((strcasecmp($tiene_espacio_padre,'true') == 0) && (strcasecmp($espacio_padre,'') != 0))
            $campos = $campos.", espacio_padre = '".$espacio_padre."', sede_padre = '".$id_sede."', campus_padre = '".$id_campus."', edificio_padre = '".$id_edificio."'";
        $sql = "UPDATE espacio SET $campos WHERE id = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEdificio($id_sede,$id_campus,$id_edificio,$id,"espacio");
        foreach ($data as $clave => $valor) {
            $piso_anterior = $valor['piso_edificio'];
            $uso_espacio_anterior = $valor['uso_espacio'];
            $ancho_pared_anterior = $valor['ancho_pared'];
            $alto_pared_anterior = $valor['alto_pared'];
            $material_pared_anterior = $valor['id_material_pared'];
            $ancho_piso_anterior = $valor['ancho_piso'];
            $largo_piso_anterior = $valor['largo_piso'];
            $material_piso_anterior = $valor['id_material_piso'];
            $ancho_techo_anterior = $valor['ancho_techo'];
            $largo_techo_anterior = $valor['largo_techo'];
            $material_techo_anterior = $valor['id_material_techo'];
            $espacio_padre_anterior = $valor['espacio_padre'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if (strcasecmp($uso_espacio,'') != 0)
                    $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"uso_espacio",$uso_espacio_anterior,$uso_espacio);
                if (strcasecmp($material_pared,'') != 0)
                    $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_pared",$material_pared_anterior,$material_pared);
                $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_pared",$ancho_pared_anterior,$ancho_pared);
                $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"alto_pared",$alto_pared_anterior,$alto_pared);
                if (strcasecmp($material_piso,'') != 0)
                    $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_piso",$material_piso_anterior,$material_piso);
                $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_piso",$ancho_piso_anterior,$ancho_piso);
                $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"largo_piso",$largo_piso_anterior,$largo_piso);
                if (strcasecmp($material_techo,'') != 0)
                    $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_techo",$material_techo_anterior,$material_techo);
                $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_techo",$ancho_techo_anterior,$ancho_techo);
                $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"largo_techo",$largo_techo_anterior,$largo_techo);
                if (strcasecmp($espacio_padre,'') != 0)
                    $this->registrarModificacion("espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"espacio_padre",$espacio_padre_anterior,$espacio_padre);
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->modificarIluminacionEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_iluminacion[$i],$tipo_iluminacion_anterior[$i],$cantidad_iluminacion[$i],$cantidad_iluminacion_anterior[$i]);
                }
                for ($i=0;$i<count($tipo_interruptor);$i++) {
                    $this->modificarInterruptorEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_interruptor[$i],$tipo_interruptor_anterior[$i],$cantidad_interruptor[$i],$cantidad_interruptor_anterior[$i]);
                }
                for ($i=0;$i<count($tipo_puerta);$i++) {
                  $this->modificarPuertaEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_cerradura[$i],$tipo_cerradura_anterior[$i],$tipo_puerta[$i],$tipo_puerta_anterior[$i],$material_puerta[$i],$material_puerta_anterior[$i],$cantidad_puerta[$i],$cantidad_puerta_anterior[$i],$material_marco[$i],$material_marco_anterior[$i],$ancho_puerta[$i],$ancho_puerta_anterior[$i],$alto_puerta[$i],$alto_puerta_anterior[$i],$gato_puerta[$i]);
                }
                for ($i=0;$i<count($tipo_suministro_energia);$i++) {
                    $this->modificarSuministroEnergiaEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_suministro_energia[$i],$tipo_suministro_energia_anterior[$i],$cantidad_suministro_energia[$i],$cantidad_suministro_energia_anterior[$i],$tomacorriente[$i],$tomacorriente_anterior[$i]);
                }
                for ($i=0;$i<count($tipo_ventana);$i++) {
                    $this->modificarVentanaEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_ventana[$i],$tipo_ventana_anterior[$i],$cantidad_ventana[$i],$cantidad_ventana_anterior[$i],$material_ventana[$i],$material_ventana_anterior[$i],$ancho_ventana[$i],$ancho_ventana_anterior[$i],$alto_ventana[$i],$alto_ventana_anterior[$i]);
                }
                $GLOBALS['mensaje'] = "El espacio se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar la iluminación de un espacio.
     * @param string $id, id del espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $tipo_iluminacion, nuevo tipo de iluminación del espacio.
     * @param string $tipo_iluminacion_anterior, tipo anterior de iluminación del espacio.
     * @param string $cantidad_iluminacion, nueva cantidad de iluminación del espacio.
     * @param string $cantidad_iluminacion_anterior, anterior cantidad de iluminación del espacio.
     * @return array
     */
    public function modificarIluminacionEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_iluminacion,$tipo_iluminacion_anterior,$cantidad_iluminacion,$cantidad_iluminacion_anterior){
        $id = htmlspecialchars(trim($id));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $tipo_iluminacion_anterior = htmlspecialchars(trim($tipo_iluminacion_anterior));
        $cantidad_iluminacion = htmlspecialchars(trim($cantidad_iluminacion));
        $cantidad_iluminacion_anterior = htmlspecialchars(trim($cantidad_iluminacion_anterior));
        $campos = "";
        if (strcasecmp($tipo_iluminacion,'') != 0){
            if(strcasecmp($tipo_iluminacion_anterior,'') != 0){
                $campos = "id_tipo_iluminacion = '".$tipo_iluminacion."', cantidad = '".$cantidad_iluminacion."'";
                $sql = "UPDATE iluminacion_espacio SET $campos WHERE id_tipo_iluminacion = '".$tipo_iluminacion_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO iluminacion_espacio (id_sede,id_campus,id_edificio,id_espacio,id_tipo_iluminacion,cantidad) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_iluminacion."', '".$cantidad_iluminacion."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Iluminación-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Iluminación-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("iluminacion_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_iluminacion",$tipo_iluminacion_anterior,$tipo_iluminacion);
                    $this->registrarModificacion("iluminacion_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_iluminacion_anterior,$cantidad_iluminacion);
                    $GLOBALS['mensaje'] = "La iluminación del espacio se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar los interruptores de un espacio.
     * @param string $id, id del espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $tipo_interruptor, nuevo tipo de interruptor del espacio.
     * @param string $tipo_interruptor_anterior, tipo anterior de interruptor del espacio.
     * @param string $cantidad_interruptor, nueva cantidad de interruptor del espacio.
     * @param string $cantidad_interruptor_anterior, anterior cantidad de interruptor del espacio.
     * @return array
     */
    public function modificarInterruptorEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_interruptor,$tipo_interruptor_anterior,$cantidad_interruptor,$cantidad_interruptor_anterior){
        $id = htmlspecialchars(trim($id));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        $tipo_interruptor_anterior = htmlspecialchars(trim($tipo_interruptor_anterior));
        $cantidad_interruptor = htmlspecialchars(trim($cantidad_interruptor));
        $cantidad_interruptor_anterior = htmlspecialchars(trim($cantidad_interruptor_anterior));
        $campos = "";
        if (strcasecmp($tipo_interruptor,'') != 0){
            if(strcasecmp($tipo_interruptor_anterior,'') != 0){
                $campos = "id_tipo_interruptor = '".$tipo_interruptor."', cantidad = '".$cantidad_interruptor."'";
                $sql = "UPDATE interruptor_espacio SET $campos WHERE id_tipo_interruptor = '".$tipo_interruptor_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO interruptor_espacio (id_sede,id_campus,id_edificio,id_espacio,id_tipo_interruptor,cantidad) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_interruptor."', '".$cantidad_interruptor."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Interruptor-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Interruptor-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("interruptor_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_interruptor",$tipo_interruptor_anterior,$tipo_interruptor);
                    $this->registrarModificacion("interruptor_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_interruptor_anterior,$cantidad_interruptor);
                    $GLOBALS['mensaje'] = "El interruptor del espacio se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar las puertas de un espacio.
     * @param string $id, id del espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $tipo_cerradura, nuevo tipo de cerradura del espacio.
     * @param string $tipo_cerradura_anterior, tipo anterior de cerradura del espacio.
     * @param string $tipo_puerta, nueva cantidad de puerta del espacio.
     * @param string $tipo_puerta_anterior, anterior tipo de puerta del espacio.
     * @param string $material_puerta, nuevo tipo de material de la puerta del espacio.
     * @param string $material_puerta_anterior, anterior tipo de meterial de la puerta del espacio.
     * @param string $cantidad_puerta, nueva cantidad de puertas del espacio.
     * @param string $cantidad_puerta_anterior, anterior cantidad de puertas del espacio.
     * @param string $material_marco, nuevo tipo de marco de las puertas del espacio.
     * @param string $material_marco_anterior, anterior tipo de marco de las puertas del espacio.
     * @param string $ancho_puerta, nuevo ancho de las puertas del espacio.
     * @param string $alto_puerta, nuevo alto de las puertas del espacio.
     * @param string $alto_puerta_anterior, anterior alto de las puertas del espacio.
     * @param string $gato_puerta, nuevo valor del gato de las puertas del espacio.
     * @param string $gato_puerta_anterior, anterior valor del gato de las puertas del espacio.
     * @return array
     */
    public function modificarPuertaEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_cerradura,$tipo_cerradura_anterior,$tipo_puerta,$tipo_puerta_anterior,$material_puerta,$material_puerta_anterior,$cantidad_puerta,$cantidad_puerta_anterior,$material_marco,$material_marco_anterior,$ancho_puerta,$ancho_puerta_anterior,$alto_puerta,$alto_puerta_anterior,$gato_puerta){
        $id = htmlspecialchars(trim($id));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $tipo_puerta_anterior = htmlspecialchars(trim($tipo_puerta_anterior));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_puerta_anterior = htmlspecialchars(trim($material_puerta_anterior));
        $cantidad_puerta = htmlspecialchars(trim($cantidad_puerta));
        $cantidad_puerta_anterior = htmlspecialchars(trim($cantidad_puerta_anterior));
        $material_marco = htmlspecialchars(trim($material_marco));
        $material_marco_anterior = htmlspecialchars(trim($material_marco_anterior));
        $ancho_puerta = htmlspecialchars(trim($ancho_puerta));
        $ancho_puerta_anterior = htmlspecialchars(trim($ancho_puerta_anterior));
        $alto_puerta = htmlspecialchars(trim($alto_puerta));
        $alto_puerta_anterior = htmlspecialchars(trim($alto_puerta_anterior));
        $gato_puerta = htmlspecialchars(trim($gato_puerta));
        $gato_puerta_anterior = 'true';
        $campos = "";
        if (strcasecmp($tipo_puerta,'') != 0 && strcasecmp($material_puerta,'') != 0 && strcasecmp($material_marco,'') != 0){
            /*if (strcasecmp($gato_puerta,'true') == 0){
                $gato_puerta_anterior = 'false';
            }*/
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"puerta_espacio");
            foreach ($data as $clave => $valor) {
                if ((strcasecmp($tipo_puerta,$valor['id_tipo_puerta']) == 0) && (strcasecmp($material_puerta,$valor['id_material_puerta']) == 0) && (strcasecmp($material_marco,$valor['id_material_marco']) == 0)) {
                    $gato_puerta_anterior = $valor['gato'];
                }
            }
            if(strcasecmp($tipo_puerta_anterior,'') != 0 || strcasecmp($material_puerta_anterior,'') != 0 || strcasecmp($material_marco_anterior,'') != 0){
                $campos = "id_tipo_puerta = '".$tipo_puerta."', id_material_puerta = '".$material_puerta."', cantidad = '".$cantidad_puerta."', id_material_marco = '".$material_marco."', ancho_puerta = '".$ancho_puerta."', largo_puerta = '".$alto_puerta."', gato = '".$gato_puerta."'";
                $sql = "UPDATE puerta_espacio SET $campos WHERE id_tipo_puerta = '".$tipo_puerta_anterior."' AND id_material_puerta = '".$material_puerta_anterior."' AND id_material_marco = '".$material_marco_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO puerta_espacio (id_sede,id_campus,id_edificio,id_espacio,id_tipo_puerta,id_material_puerta,cantidad,id_material_marco,ancho_puerta,largo_puerta,gato) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_puerta."', '".$material_puerta."', '".$cantidad_puerta."', '".$material_marco."', '".$ancho_puerta."', '".$alto_puerta."', '".$gato_puerta."');";
            }
            for ($i=0;$i<count($tipo_cerradura);$i++) {
                $this->modificarCerraduraPuerta($id,$id_sede,$id_campus,$id_edificio,$tipo_cerradura[$i],$tipo_cerradura_anterior[$i],$tipo_puerta,$material_puerta,$material_marco);
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Puerta-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Puerta-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    //return false;
                }else{
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_puerta",$tipo_puerta_anterior,$tipo_puerta);
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_puerta",$material_puerta_anterior,$material_puerta);
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_puerta",$cantidad_puerta_anterior,$cantidad_puerta);
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_marco",$material_marco_anterior,$material_marco);
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_puerta",$ancho_puerta_anterior,$ancho_puerta);
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"alto_puerta",$alto_puerta_anterior,$alto_puerta);
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"gato_puerta",$gato_puerta_anterior,$gato_puerta);
                    $GLOBALS['mensaje'] = "Las Puertas del espacio se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar las cerraduras de las puertas de un espacio.
     * @param string $id, id del espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $tipo_cerradura, nuevo tipo de cerradura del espacio.
     * @param string $tipo_cerradura_anterior, tipo anterior de cerradura del espacio.
     * @param string $tipo_puerta, nueva cantidad de puerta del espacio.
     * @param string $material_puerta, nuevo tipo de material de la puerta del espacio.
     * @param string $material_marco, nuevo tipo de marco de las puertas del espacio.
     * @return array
     */
    public function modificarCerraduraPuerta($id,$id_sede,$id_campus,$id_edificio,$tipo_cerradura,$tipo_cerradura_anterior,$tipo_puerta,$material_puerta,$material_marco){
        $id = htmlspecialchars(trim($id));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_cerradura = htmlspecialchars(trim($tipo_cerradura));
        $tipo_cerradura_anterior = htmlspecialchars(trim($tipo_cerradura_anterior));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_marco = htmlspecialchars(trim($material_marco));
        $campos = "";
        if (strcasecmp($tipo_cerradura,'') != 0){
            if(strcasecmp($tipo_cerradura_anterior,'') != 0){
                $campos = "id_tipo_cerradura = '".$tipo_cerradura."'";
                $sql = "UPDATE puerta_tipo_cerradura SET $campos WHERE id_tipo_cerradura = '".$tipo_cerradura_anterior."' AND id_tipo_puerta = '".$tipo_puerta."' AND id_material_puerta = '".$material_puerta."' AND id_material_marco = '".$material_marco."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO puerta_tipo_cerradura (id_sede,id_campus,id_edificio,id_espacio,id_tipo_puerta,id_material_puerta,id_material_marco,id_tipo_cerradura) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_puerta."', '".$material_puerta."', '".$material_marco."', '".$tipo_cerradura."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Puerta-Tipo-Cerradura 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Puerta-Tipo-Cerradura 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("puerta_tipo_cerradura",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_cerradura",$tipo_cerradura_anterior,$tipo_cerradura);
                    $GLOBALS['mensaje'] = "El tipo de cerradura de las puertas del espacio se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar los interruptores de un espacio.
     * @param string $id, id del espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $tipo_suministro_energia, nuevo tipo de suministro de energía del espacio.
     * @param string $tipo_suministro_energia_anterior, tipo anterior de suministro de energía del espacio.
     * @param string $cantidad_suministro_energia, nueva cantidad de tomacorrientes del espacio.
     * @param string $cantidad_suministro_energia_anterior, anterior cantidad de tomacorrientes del espacio.
     * @param string $tomacorriente, nuevo valor de tomacorrientes del espacio.
     * @param string $tomacorriente_anterior, anterior valor de tomacorrientes del espacio.
     * @return array
     */
    public function modificarSuministroEnergiaEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_suministro_energia,$tipo_suministro_energia_anterior,$cantidad_suministro_energia,$cantidad_suministro_energia_anterior,$tomacorriente,$tomacorriente_anterior){
        $id = htmlspecialchars(trim($id));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_suministro_energia = htmlspecialchars(trim($tipo_suministro_energia));
        $tipo_suministro_energia_anterior = htmlspecialchars(trim($tipo_suministro_energia_anterior));
        $cantidad_suministro_energia = htmlspecialchars(trim($cantidad_suministro_energia));
        $cantidad_suministro_energia_anterior = htmlspecialchars(trim($cantidad_suministro_energia_anterior));
        $tomacorriente = htmlspecialchars(trim($tomacorriente));
        $tomacorriente_anterior = htmlspecialchars(trim($tomacorriente_anterior));
        $campos = "";
        if (strcasecmp($tipo_suministro_energia,'') != 0 && strcasecmp($tomacorriente,'') != 0){
            if(strcasecmp($tipo_suministro_energia_anterior,'') != 0 || strcasecmp($tomacorriente_anterior,'') != 0){
                $campos = "id_tipo_suministro_energia = '".$tipo_suministro_energia."', cantidad = '".$cantidad_suministro_energia."', tomacorriente = '".$tomacorriente."'";
                $sql = "UPDATE suministro_energia_espacio SET $campos WHERE id_tipo_suministro_energia = '".$tipo_suministro_energia_anterior."' AND tomacorriente = '".$tomacorriente_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO suministro_energia_espacio (id_sede,id_campus,id_edificio,id_espacio,id_tipo_suministro_energia,tomacorriente,cantidad) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_suministro_energia."', '".$tomacorriente."', '".$cantidad_suministro_energia."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Suministro-Energía-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Suministro-Energía-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("suministro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_suministro_energia",$tipo_suministro_energia_anterior,$tipo_suministro_energia);
                    $this->registrarModificacion("suministro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_suministro_energia_anterior,$cantidad_suministro_energia);
                    $this->registrarModificacion("suministro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"tomacorriente",$tomacorriente_anterior,$tomacorriente);
                    $GLOBALS['mensaje'] = "El suministro de energía del espacio se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar los interruptores de un espacio.
     * @param string $id, id del espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $tipo_ventana, nuevo tipo de ventanas del espacio.
     * @param string $tipo_ventana_anterior, tipo anterior de ventanas del espacio.
     * @param string $cantidad_ventana, nueva cantidad de ventanas del espacio.
     * @param string $cantidad_ventana_anterior, anterior cantidad de ventanas del espacio.
     * @param string $material_ventana, nuevo material de ventanas del espacio.
     * @param string $material_ventana_anterior, tipo anterior de ventanas del espacio.
     * @param string $ancho_ventana, nueva ancho de las ventanas del espacio.
     * @param string $ancho_ventana_anterior, anterior ancho de las ventanas del espacio.
     * @param string $alto_ventana, nueva alto de las ventanas del espacio.
     * @param string $alto_ventana_anterior, anterior alto de las ventanas del espacio.
     * @return array
     */
    public function modificarVentanaEspacio($id,$id_sede,$id_campus,$id_edificio,$tipo_ventana,$tipo_ventana_anterior,$cantidad_ventana,$cantidad_ventana_anterior,$material_ventana,$material_ventana_anterior,$ancho_ventana,$ancho_ventana_anterior,$alto_ventana,$alto_ventana_anterior){
        $id = htmlspecialchars(trim($id));
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $tipo_ventana_anterior = htmlspecialchars(trim($tipo_ventana_anterior));
        $cantidad_ventana = htmlspecialchars(trim($cantidad_ventana));
        $cantidad_ventana_anterior = htmlspecialchars(trim($cantidad_ventana_anterior));
        $material_ventana = htmlspecialchars(trim($material_ventana));
        $material_ventana_anterior = htmlspecialchars(trim($material_ventana_anterior));
        $ancho_ventana = htmlspecialchars(trim($ancho_ventana));
        $ancho_ventana_anterior = htmlspecialchars(trim($ancho_ventana_anterior));
        $alto_ventana = htmlspecialchars(trim($alto_ventana));
        $alto_ventana_anterior = htmlspecialchars(trim($alto_ventana_anterior));
        $campos = "";
        if (strcasecmp($tipo_ventana,'') != 0 && strcasecmp($material_ventana,'') != 0){
            if ((strcasecmp($tipo_ventana_anterior,'') != 0 || strcasecmp($material_ventana_anterior,'') != 0)){
                $campos = "id_tipo_ventana = '".$tipo_ventana."', cantidad = '".$cantidad_ventana."', id_material_ventana = '".$material_ventana."', ancho_ventana = '".$ancho_ventana."', alto_ventana = '".$alto_ventana."'";
                $sql = "UPDATE ventana_espacio SET $campos WHERE id_tipo_ventana = '".$tipo_ventana_anterior."' AND id_material_ventana = '".$material_ventana_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO ventana_espacio (id_sede,id_campus,id_edificio,id_espacio,id_tipo_ventana,id_material,cantidad,alto_ventana,ancho_ventana) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_ventana."', '".$material_ventana."', '".$cantidad_ventana."', '".$ancho_ventana."', '".$alto_ventana."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Ventana-Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Ventana-Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_ventana",$tipo_ventana_anterior,$tipo_ventana);
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_ventana_anterior,$cantidad_ventana);
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_ventana",$material_ventana_anterior,$material_ventana);
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_ventana",$ancho_ventana_anterior,$ancho_ventana);
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"alto_ventana",$alto_ventana_anterior,$alto_ventana);
                    $GLOBALS['mensaje'] = "Las ventanas del espacio se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un salón.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del salón.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del salón.
     * @param string $capacidad, nueva capacidad del salón.
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarSalon($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red,$capacidad,$punto_video_beam){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_video_beam = htmlspecialchars(trim($punto_video_beam));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."', capacidad = '".$capacidad."', punto_video_beam = '".$punto_video_beam."'";
        $sql = "UPDATE salon SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"salon");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
            $capacidad_anterior = $valor['capacidad'];
            $punto_video_beam_anterior = $valor['punto_video_beam'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Salón 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Salón 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("salon",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $this->registrarModificacion("salon",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad_anterior,$capacidad);
                $this->registrarModificacion("salon",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$punto_video_beam_anterior,$punto_video_beam);
                $GLOBALS['mensaje'] = "El salón se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un auditorio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del auditorio.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del auditorio.
     * @param string $capacidad, nueva capacidad del auditorio.
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarAuditorio($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red,$capacidad,$punto_video_beam){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_video_beam = htmlspecialchars(trim($punto_video_beam));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."', capacidad = '".$capacidad."', punto_video_beam = '".$punto_video_beam."'";
        $sql = "UPDATE auditorio SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"auditorio");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
            $capacidad_anterior = $valor['capacidad'];
            $punto_video_beam_anterior = $valor['punto_video_beam'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Auditorio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Auditorio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("auditorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $this->registrarModificacion("auditorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad_anterior,$capacidad);
                $this->registrarModificacion("auditorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$punto_video_beam_anterior,$punto_video_beam);
                $GLOBALS['mensaje'] = "El auditorio se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un salón.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del salón.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del salón.
     * @param string $capacidad, nueva capacidad del salón.
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarLaboratorio($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red,$capacidad,$punto_video_beam,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$tipo_punto_sanitario_anterior,$cantidad_puntos_sanitarios,$cantidad_puntos_sanitarios_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_video_beam = htmlspecialchars(trim($punto_video_beam));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."', capacidad = '".$capacidad."', punto_video_beam = '".$punto_video_beam."', cantidad_punto_hidraulico = '".$cantidad_punto_hidraulico."'";
        $sql = "UPDATE laboratorio SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"laboratorio");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
            $capacidad_anterior = $valor['capacidad'];
            $punto_video_beam_anterior = $valor['punto_video_beam'];
            $cantidad_punto_hidraulico_anterior = $valor['cantidad_punto_hidraulico'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Laboratorio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Laboratorio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad_anterior,$capacidad);
                $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$punto_video_beam_anterior,$punto_video_beam);
                $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_hidraulico",$cantidad_punto_hidraulico_anterior,$cantidad_punto_hidraulico);
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->modificarPuntoSanitario($id_sede,$id_campus,$id_edificio,$id,$tipo_punto_sanitario[$i],$tipo_punto_sanitario_anterior[$i],$cantidad_puntos_sanitarios[$i],$cantidad_puntos_sanitarios_anterior[$i]);
                }
                $GLOBALS['mensaje'] = "El laboratorio se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una sala de cómputo.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la sala de cómputo.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red de la sala de cómputo..
     * @param string $capacidad, nueva capacidad de la sala de cómputo..
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarSalaComputo($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red,$capacidad,$punto_video_beam){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_video_beam = htmlspecialchars(trim($punto_video_beam));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."', capacidad = '".$capacidad."', punto_video_beam = '".$punto_video_beam."'";
        $sql = "UPDATE sala_computo SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"sala_computo");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
            $capacidad_anterior = $valor['capacidad'];
            $punto_video_beam_anterior = $valor['punto_video_beam'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Sala de Cómputo 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Sala de Cómputo 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("sala_computo",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $this->registrarModificacion("sala_computo",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad_anterior,$capacidad);
                $this->registrarModificacion("sala_computo",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$punto_video_beam_anterior,$punto_video_beam);
                $GLOBALS['mensaje'] = "La sala de cómputo se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una oficina.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la oficina.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red de la oficina.
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarOficina($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red,$punto_video_beam){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_video_beam = htmlspecialchars(trim($punto_video_beam));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."', punto_video_beam = '".$punto_video_beam."'";
        $sql = "UPDATE oficina SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"oficina");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
            $punto_video_beam_anterior = $valor['punto_video_beam'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Oficina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Oficina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("oficina",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $this->registrarModificacion("oficina",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$punto_video_beam_anterior,$punto_video_beam);
                $GLOBALS['mensaje'] = "La oficina se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un salón.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del salón.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del salón.
     * @param string $capacidad, nueva capacidad del salón.
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarBano($id_sede,$id_campus,$id_edificio,$id,$tipo_inodoro,$cantidad_inodoro,$tipo_orinal,$tipo_orinal_anterior,$cantidad_orinal,$cantidad_orinal_anterior,$tipo_lavamanos,$tipo_lavamanos_anterior,$cantidad_lavamanos,$cantidad_lavamanos_anterior,$ducha,$lavatraperos,$cantidad_sifones,$tipo_divisiones,$material_divisiones){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_inodoro = htmlspecialchars(trim($tipo_inodoro));
        $cantidad_inodoro = htmlspecialchars(trim($cantidad_inodoro));
        $ducha = htmlspecialchars(trim($ducha));
        $lavatraperos = htmlspecialchars(trim($lavatraperos));
        $cantidad_sifones = htmlspecialchars(trim($cantidad_sifones));
        $tipo_divisiones = htmlspecialchars(trim($tipo_divisiones));
        $material_divisiones = htmlspecialchars(trim($material_divisiones));
        if (strcasecmp($tipo_inodoro,'') != 0 && strcasecmp($tipo_divisiones,'') != 0 && strcasecmp($material_divisiones,'') != 0){
            $campos = "id_tipo_inodoro = '".$tipo_inodoro."', cantidad_inodoro = '".$cantidad_inodoro."', ducha = '".$ducha."', lavatraperos = '".$lavatraperos."', cantidad_sifon = '".$cantidad_sifones."', id_tipo_divisiones = '".$tipo_divisiones."', id_material_divisiones = '".$material_divisiones."'";
            $sql = "UPDATE bano SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"bano");
            foreach ($data as $clave => $valor) {
                $tipo_inodoro_anterior = $valor['id_tipo_inodoro'];
                $cantidad_inodoro_anterior = $valor['cantidad_inodoro'];
                $ducha_anterior = $valor['ducha'];
                $lavatraperos_anterior = $valor['lavatraperos'];
                $cantidad_sifones_anterior = $valor['cantidad_sifon'];
                $tipo_divisiones_anterior = $valor['id_tipo_divisiones'];
                $material_divisiones_anterior = $valor['id_material_divisiones'];
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Baño 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Baño 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"tipo_inodoro",$tipo_inodoro_anterior,$tipo_inodoro);
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_inodoro",$cantidad_inodoro_anterior,$cantidad_inodoro);
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ducha",$ducha_anterior,$ducha);
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"lavatraperos",$lavatraperos_anterior,$lavatraperos);
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_sifon",$cantidad_sifones_anterior,$cantidad_sifones);
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"tipo_divisiones",$tipo_divisiones_anterior,$tipo_divisiones);
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"material_divisiones",$material_divisiones_anterior,$material_divisiones);
                    for ($i=0;$i<count($tipo_orinal);$i++)
                        $this->modificarOrinal($id_sede,$id_campus,$id_edificio,$id,$tipo_orinal[$i],$tipo_orinal_anterior[$i],$cantidad_orinal[$i],$cantidad_orinal_anterior[$i]);
                    for ($i=0;$i<count($tipo_lavamanos);$i++)
                        $this->modificarLavamanos($id_sede,$id_campus,$id_edificio,$id,$tipo_lavamanos[$i],$tipo_lavamanos_anterior[$i],$cantidad_lavamanos[$i],$cantidad_lavamanos_anterior[$i]);
                    $GLOBALS['mensaje'] = "El baño se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un cuarto técnico.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del cuarto técnico.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del cuarto técnico.
     * @param string $punto_video_beam, nuevo valor de campus punto video beam.
     * @return array
     */
    public function modificarCuartoTecnico($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red,$punto_video_beam){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $punto_video_beam = htmlspecialchars(trim($punto_video_beam));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."', punto_video_beam = '".$punto_video_beam."'";
        $sql = "UPDATE cuarto_tecnico SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_tecnico");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
            $punto_video_beam_anterior = $valor['punto_video_beam'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Técnico 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Técnico 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("cuarto_tecnico",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $this->registrarModificacion("cuarto_tecnico",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$punto_video_beam_anterior,$punto_video_beam);
                $GLOBALS['mensaje'] = "El cuarto técnico se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una bodega.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la bodega.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red de la bodega.
     * @return array
     */
    public function modificarBodega($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."'";
        $sql = "UPDATE bodega SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"bodega");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Bodega 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Bodega 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("bodega",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $GLOBALS['mensaje'] = "La bodega se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un cuarto de plantas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del cuarto de plantas.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del cuarto de plantas.
     * @return array
     */
    public function modificarCuartoPlantas($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."'";
        $sql = "UPDATE cuarto_plantas SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_plantas");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Plantas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Plantas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("cuarto_plantas",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $GLOBALS['mensaje'] = "El cuarto de plantas se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un cuarto de aires acondicionados.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del cuarto de aires acondicionados.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del cuarto de aires acondicionados.
     * @return array
     */
    public function modificarCuartoAireAcondicionado($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."'";
        $sql = "UPDATE cuarto_aire_acondicionado SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_aire_acondicionado");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Aires Acondiconados 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Aires Acondiconados 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("cuarto_aire_acondicionado",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $GLOBALS['mensaje'] = "El cuarto de aires acondicionados se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un área deportiva cerrada.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del área deportiva cerrada.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del área deportiva cerrada.
     * @return array
     */
    public function modificarAreaDeportivaCerrada($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."'";
        $sql = "UPDATE area_deportiva_cerrada SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"area_deportiva_cerrada");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Área Deportiva Cerrada 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Área Deportiva Cerrada 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("area_deportiva_cerrada",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $GLOBALS['mensaje'] = "El área deportiva cerrada se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un centro de datos.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del centro de datos.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red del centro de datos.
     * @return array
     */
    public function modificarCentroDatos($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."'";
        $sql = "UPDATE centro_datos SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"centro_datos");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Centro Datos 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Centro Datos 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("centro_datos",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $GLOBALS['mensaje'] = "El centro de datos se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un cuarto de bombas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del cuarto de bombas.
     * @param string $tipo_punto_sanitario, nueva cantidad de puntos de red del cuarto de bombas.
     * @param string $tipo_punto_sanitario, nuevo tipo de punto sanitario del cuarto de bombas.
     * @param string $tipo_punto_sanitario_anterior, anterior tipo de punto sanitario del cuarto de bombas.
     * @param string $cantidad_puntos_sanitarios, nueva cantidad de puntos sanitarios del cuarto de bombas.
     * @param string $cantidad_puntos_sanitarios_anterior, anterior cantidad de puntos sanitarios del cuarto de bombas.
     * @return array
     */
    public function modificarCuartoBombas($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$tipo_punto_sanitario_anterior,$cantidad_puntos_sanitarios,$cantidad_puntos_sanitarios_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $campos = "cantidad_punto_hidraulico = '".$cantidad_punto_hidraulico."'";
        $sql = "UPDATE cuarto_bombas SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_bombas");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_hidraulico_anterior = $valor['cantidad_punto_hidraulico'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Bombas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Cuarto Bombas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("cuarto_bombas",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_hidraulico",$cantidad_punto_hidraulico_anterior,$cantidad_punto_hidraulico);
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->modificarPuntoSanitario($id_sede,$id_campus,$id_edificio,$id,$tipo_punto_sanitario[$i],$tipo_punto_sanitario_anterior[$i],$cantidad_puntos_sanitarios[$i],$cantidad_puntos_sanitarios_anterior[$i]);
                }
                $GLOBALS['mensaje'] = "El cuarto de bombas se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una cocineta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la cocineta.
     * @param string $tipo_punto_sanitario, nueva cantidad de puntos de red de la cocineta.
     * @param string $tipo_punto_sanitario, nuevo tipo de punto sanitario de la cocineta.
     * @param string $tipo_punto_sanitario_anterior, anterior tipo de punto sanitario de la cocineta.
     * @param string $cantidad_puntos_sanitarios, nueva cantidad de puntos sanitarios de la cocineta.
     * @param string $cantidad_puntos_sanitarios_anterior, anterior cantidad de puntos sanitarios de la cocineta.
     * @return array
     */
    public function modificarCocineta($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$tipo_punto_sanitario_anterior,$cantidad_puntos_sanitarios,$cantidad_puntos_sanitarios_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $campos = "cantidad_punto_hidraulico = '".$cantidad_punto_hidraulico."'";
        $sql = "UPDATE cocineta SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cocineta");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_hidraulico_anterior = $valor['cantidad_punto_hidraulico'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Cocineta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Salón 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("cocineta",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_hidraulico",$cantidad_punto_hidraulico_anterior,$cantidad_punto_hidraulico);
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->modificarPuntoSanitario($id_sede,$id_campus,$id_edificio,$id,$tipo_punto_sanitario[$i],$tipo_punto_sanitario_anterior[$i],$cantidad_puntos_sanitarios[$i],$cantidad_puntos_sanitarios_anterior[$i]);
                }
                $GLOBALS['mensaje'] = "La cocineta se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar una sala de estudios.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la sala de estudios.
     * @param string $cantidad_punto_red, nueva cantidad de puntos de red de la sala de estudios.
     * @return array
     */
    public function modificarSalaEstudio($id_sede,$id_campus,$id_edificio,$id,$cantidad_punto_red){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $campos = "cantidad_punto_red = '".$cantidad_punto_red."'";
        $sql = "UPDATE sala_estudio SET $campos WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"sala_estudio");
        foreach ($data as $clave => $valor) {
            $cantidad_punto_red_anterior = $valor['cantidad_punto_red'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Sala Estudio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Sala Estudio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion("sala_estudio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$cantidad_punto_red_anterior,$cantidad_punto_red);
                $GLOBALS['mensaje'] = "La sala de estudio se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un punto sanitario.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_punto_sanitario, nuevo tipo de punto sanitario del espacio.
     * @param string $tipo_punto_sanitario_anterior, anterior tipo de punto sanitario del espacio.
     * @param string $cantidad, nueva cantidad de puntos sanitarios del espacio.
     * @param string $cantidad_anterior, anterior cantidad de puntos sanitarios del espacio.
     * @return array
     */
    public function modificarPuntoSanitario($id_sede,$id_campus,$id_edificio,$id,$tipo_punto_sanitario,$tipo_punto_sanitario_anterior,$cantidad,$cantidad_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_punto_sanitario = htmlspecialchars(trim($tipo_punto_sanitario));
        $tipo_punto_sanitario_anterior = htmlspecialchars(trim($tipo_punto_sanitario_anterior));
        $cantidad = htmlspecialchars(trim($cantidad));
        $cantidad_anterior = htmlspecialchars(trim($cantidad_anterior));
        if (strcasecmp($tipo_punto_sanitario,'') != 0){
            if(strcasecmp($tipo_punto_sanitario_anterior,'') != 0){
                $campos = "id_tipo = '".$tipo_punto_sanitario."', cantidad = '".$cantidad."'";
                $sql = "UPDATE punto_sanitario SET $campos WHERE id_tipo = '".$tipo_punto_sanitario_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO punto_sanitario (id_sede,id_campus,id_edificio,id_espacio,id_tipo,cantidad) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_punto_sanitario."', '".$cantidad."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Punto Sanitario 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Punto Sanitario 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("punto_sanitario",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo",$tipo_punto_sanitario_anterior,$tipo_punto_sanitario);
                    $this->registrarModificacion("punto_sanitario",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_anterior,$cantidad);
                    $GLOBALS['mensaje'] = "El punto sanitario se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un orinal.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_orinal, nuevo tipo de orinal del espacio.
     * @param string $tipo_orinal_anterior, anterior tipo de orinal del espacio.
     * @param string $cantidad, nueva cantidad de orinales del espacio.
     * @param string $cantidad_anterior, anterior cantidad de orinales del espacio.
     * @return array
     */
    public function modificarOrinal($id_sede,$id_campus,$id_edificio,$id,$tipo_orinal,$tipo_orinal_anterior,$cantidad,$cantidad_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_orinal = htmlspecialchars(trim($tipo_orinal));
        $tipo_orinal_anterior = htmlspecialchars(trim($tipo_orinal_anterior));
        $cantidad = htmlspecialchars(trim($cantidad));
        $cantidad_anterior = htmlspecialchars(trim($cantidad_anterior));
        if (strcasecmp($tipo_orinal,'') != 0){
            if(strcasecmp($tipo_orinal_anterior,'') != 0){
                $campos = "id_tipo_orinal = '".$tipo_orinal_anterior."', cantidad = '".$cantidad."'";
                $sql = "UPDATE orinal_bano SET $campos WHERE id_tipo_orinal = '".$tipo_orinal_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO orinal_bano (id_sede,id_campus,id_edificio,id_espacio,id_tipo_orinal,cantidad) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_orinal."', '".$cantidad."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Orinal 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Orinal 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("orinal_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_orinal",$tipo_orinal_anterior,$tipo_orinal);
                    $this->registrarModificacion("orinal_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_anterior,$cantidad);
                    $GLOBALS['mensaje'] = "El orinal se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un lavamanos.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_lavamanos, nuevo tipo de lavamanos del espacio.
     * @param string $tipo_lavamanos_anterior, anterior tipo de lavamanos del espacio.
     * @param string $cantidad, nueva cantidad de lavamanos del espacio.
     * @param string $cantidad_anterior, anterior cantidad de lavamanos del espacio.
     * @return array
     */
    public function modificarLavamanos($id_sede,$id_campus,$id_edificio,$id,$tipo_lavamanos,$tipo_lavamanos_anterior,$cantidad,$cantidad_anterior){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_lavamanos = htmlspecialchars(trim($tipo_lavamanos));
        $tipo_lavamanos_anterior = htmlspecialchars(trim($tipo_lavamanos_anterior));
        $cantidad = htmlspecialchars(trim($cantidad));
        $cantidad_anterior = htmlspecialchars(trim($cantidad_anterior));
        if (strcasecmp($tipo_lavamanos,'') != 0){
            if(strcasecmp($tipo_lavamanos_anterior,'') != 0){
                $campos = "id_tipo = '".$tipo_lavamanos."', cantidad = '".$cantidad."'";
                $sql = "UPDATE lavamanos_bano SET $campos WHERE id_tipo_lavamanos = '".$tipo_lavamanos_anterior."' AND id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_campus = '".$id_campus."' AND id_sede = '".$id_sede."';";
            }else{
                $sql = "INSERT INTO lavamanos_bano (id_sede,id_campus,id_edificio,id_espacio,id_tipo,cantidad) VALUES ('".$id_sede."', '".$id_campus."', '".$id_edificio."', '".$id."', '".$tipo_punto_sanitario."', '".$cantidad."');";
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Lavamanos 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Modificar Lavamanos 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $this->registrarModificacion("lavamanos_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"tipo_punto_sanitario",$tipo_punto_sanitario_anterior,$tipo_punto_sanitario);
                    $this->registrarModificacion("lavamanos_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad_anterior,$cantidad);
                    $GLOBALS['mensaje'] = "El lavamanos se modificó correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite modificar un tipo de material.
     * @param string $tipo_material, nombre del tipo de material (material piso, material techo, etc.)
     * @param string $nombre_anterior, nombre anterior del tipo de material.
     * @param string $nombre, nuevo nombre del tipo de material.
     * @return array
     */
    public function modificarTipoMaterial($tipo_material,$nombre_anterior,$nombre){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $nombre_anterior = htmlspecialchars(trim($nombre_anterior));
        $nombre = htmlspecialchars(trim($nombre));
        $campos = "material = '".$nombre."'";
        $sql = "UPDATE ".$tipo_material." SET $campos WHERE material = '".$nombre_anterior."';";
        $data = $this->consultarCampoTipoMaterial($tipo_material,$nombre_anterior);
        foreach ($data as $clave => $valor) {
            $id = $valor['id'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Tipo Material 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Tipo Material 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion($tipo_material,$id,"material",$nombre_anterior,$nombre);
                $GLOBALS['mensaje'] = "El tipo de material se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }

    /**
     * Función que permite modificar un tipo de objeto.
     * @param string $tipo_objeto, nombre del tipo de objeto (tipo inodoro, tipo puerta, etc.)
     * @param string $nombre_anterior, nombre anterior del tipo de objeto.
     * @param string $nombre, nuevo nombre del tipo de objeto.
     * @return array
     */
    public function modificarTipoObjeto($tipo_objeto,$nombre_anterior,$nombre){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $nombre_anterior = htmlspecialchars(trim($nombre_anterior));
        $nombre = htmlspecialchars(trim($nombre));
        $campos = "tipo = '".$nombre."'";
        $sql = "UPDATE ".$tipo_objeto." SET $campos WHERE tipo = '".$nombre_anterior."';";
        $data = $this->consultarCampoTipoObjeto($tipo_objeto,$nombre_anterior);
        foreach ($data as $clave => $valor) {
            $id = $valor['id'];
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Tipo Objeto 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Tipo Objeto 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $this->registrarModificacion($tipo_objeto,$id,"tipo",$nombre_anterior,$nombre);
                $GLOBALS['mensaje'] = "El tipo de objeto se modificó correctamente";
                $GLOBALS['sql'] = $sql;
                return true;
            }
        }
    }


    /**
     * Función que registra una modificación en una base de datos.
     * @param string $bd, nombre de la base de datos donde se realizó la modificación.
     * @param string $id_objeto, id del objeto modificado.
     * @param string $columna, nombre de la columna que se modificó.
     * @param string $valor_anterior, valor antigüo de la bd.
     * @param string $valor_nuevo, nuevo nombre de la sede.
     * @param string $usuario, nuevo nombre de la sede.
     * @return array
     */
    public function registrarModificacion($bd,$id_objeto,$columna,$valor_anterior,$valor_nuevo){
        $bd = htmlspecialchars(trim($bd));
        $id_objeto = htmlspecialchars(trim($id_objeto));
        $columna = htmlspecialchars(trim($columna));
        $valor_anterior = htmlspecialchars(trim($valor_anterior));
        $valor_nuevo = htmlspecialchars(trim($valor_nuevo));
        if (strcasecmp($valor_anterior,$valor_nuevo) != 0) {
            $sql = "INSERT INTO modificaciones (tabla_modificacion,id_objeto,columna_modificada,valor_antiguo,valor_nuevo,usuario) VALUES ('".$bd."','".$id_objeto."','".$columna."','".$valor_anterior."','".$valor_nuevo."','".$_SESSION["login"]."');";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Registrar Modificación 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Registrar Modificación 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $GLOBALS['mensaje'] = "Se registró la modificación correctamente";
                    $GLOBALS['sql'] = $sql;
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite consultar el valor de un campo de la tabla sede.
     * @param string $id_sede, id de la sede.
     * @return array
     */
    public function consultarCampoSede($id_sede){
        $id_sede = htmlspecialchars(trim($id_sede));
        $sql = "SELECT * FROM sede WHERE id = '".$id_sede."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Sede 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Sede 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de la tabla sede.
     * @param string $id_sede, id de la sede del campus.
     * @param string $id_campus, id del campus.
     * @return array
     */
    public function consultarCampoCampus($id_sede,$id_campus){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $sql = "SELECT * FROM campus WHERE id = '".$id_campus."' AND sede = '".$id_sede."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Campus 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Campus 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un elemento de un campus.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del elemento.
     * @param string $elemento, elemento a consultar (cancha, edificio, parqueadero, etc.).
     * @return array
     */
    public function consultarCampoElementoCampus($id_sede,$id_campus,$id,$elemento){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $elemento = htmlspecialchars(trim($elemento));
        $sql = "SELECT * FROM ".$elemento." WHERE id = '".$id."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Elemento Campus 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Elemento Campus 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de la tabla cubiertas_piso.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @return array
     */
    public function consultarCampoCubierta($id_sede,$id_campus,$id_edificio,$piso){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM cubiertas_piso WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Cubierta 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Cubierta 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de la tabla gradas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @return array
     */
    public function consultarCampoGradas($id_sede,$id_campus,$id_edificio,$piso,$elemento){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM ".$elemento." WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso_inicio = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Gradas 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Gradas 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
    * Función que permite consultar el valor de un elemento de unas gradas.
    * @param string $id_sede, id de la sede.
    * @param string $id_campus, id del campus.
    * @param string $id_edificio, id del edificio.
    * @param string $piso, piso del edificio.
    * @param string $elemento, elemento de las gradas.
    * @return array
    */
    public function consultarElementoGradas($id_sede,$id_campus,$id_edificio,$piso,$elemento){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $elemento = htmlspecialchars(trim($elemento));
        $sql = "SELECT * FROM ".$elemento." WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso_inicio = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Elemento Gradas 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Elemento Gradas 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del elemento seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un elemento de un edificio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del elemento.
     * @param string $elemento, elemento a consultar (cancha, edificio, parqueadero, etc.).
     * @return array
     */
    public function consultarCampoElementoEdificio($id_sede,$id_campus,$id_edificio,$id,$elemento){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $elemento = htmlspecialchars(trim($elemento));
        $sql = "SELECT * FROM ".$elemento." WHERE id = '".$id."' AND id_edificio = '".$id_edificio."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Elemento Edificio 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Elemento Edificio 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un elemento de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del elemento.
     * @param string $elemento, elemento a consultar (cancha, edificio, parqueadero, etc.).
     * @return array
     */
    public function consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,$elemento){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $elemento = htmlspecialchars(trim($elemento));
        $result = "";
        $sql = "SELECT * FROM ".$elemento." WHERE id_espacio = '".$id."' AND id_edificio = '".$id_edificio."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Elemento Edificio 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Elemento Edificio 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un tipo de material.
     * @param string $tipo_material, tipo de material a consultar.
     * @param string $id, id del tipo de mateial.
     * @return array
     */
    public function consultarCampoTipoMaterial($tipo_material,$id){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM ".$tipo_material." WHERE material = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Tipo Material 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Tipo Material 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
                $GLOBALS['sql'] = $sql;
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un tipo de objeto.
     * @param string $tipo_objeto, tipo de objeto a consultar.
     * @param string $id, id del tipo de mateial.
     * @return array
     */
    public function consultarCampoTipoObjeto($tipo_objeto,$id){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $id = htmlspecialchars(trim($id));
        $sql = "SELECT * FROM ".$tipo_objeto." WHERE tipo = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Tipo Objeto 1)";
            $GLOBALS['sql'] = $sql;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Consultar Campo Tipo Objeto 2)";
                $GLOBALS['sql'] = $sql;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Valor del campo seleccionado";
            }
        }
        return $result;
    }

    /**
     * Función que permite eliminar un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarEdificio($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM edificio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $this->eliminarEspaciosEdificio($id_sede,$id_campus,$id);
        $this->eliminarArchivosEdificio($id_sede,$id_campus,$id);
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Edificio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Edificio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "El edificio se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarEspaciosEdificio($id_sede,$id_campus,$id_edificio){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = array();
        $uso_espacio = array();
        $sql = "SELECT * FROM espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Espacios Edificio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Espacios Edificio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                foreach ($result as $clave => $valor) {
                    array_push($puntoRed,$valor['cantidad_punto_red']);
                    array_push($capacidad,$valor['capacidad']);
                    array_push($puntoVideoBeam,$valor['punto_video_beam']);
                }
                //$GLOBALS['mensaje'] = "El espacio se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarEspacio($id_sede,$id_campus,$id_edificio,$id,$uso_espacio){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $uso_espacio = htmlspecialchars(trim($uso_espacio));
        $sql = "DELETE FROM espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id = '".$id."';";
        $this->eliminarIluminacionesEspacio($id_sede,$id_campus,$id_edificio,$id);
        $this->eliminarInterruptoresEspacio($id_sede,$id_campus,$id_edificio,$id);
        $this->eliminarPuertasEspacio($id_sede,$id_campus,$id_edificio,$id);
        $this->eliminarSuministrosEnergiaEspacio($id_sede,$id_campus,$id_edificio,$id);
        $this->eliminarVentanasEspacio($id_sede,$id_campus,$id_edificio,$id);
        if (strcasecmp($uso_espacio,'1') == 0) { //Salón
            $m->eliminarSalon($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'2') == 0) { //Auditorio
            $m->eliminarAuditorio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'3') == 0) { //Laboratorio
            $m->eliminarLaboratorio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'4') == 0) { //Sala de Cómputo
            $m->eliminarSalaComputo($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'5') == 0) { //Oficina
            $m->eliminarOficina($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'6') == 0) { //Baño
            $m->eliminarBano($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'7') == 0) { //Cuarto Técnico
            $m->eliminarCuartoTecnico($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'8') == 0) { //Bodega/Almacen
            $m->eliminarBodega($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'10') == 0) { //Cuarto de Plantas
            $m->eliminarCuartoPlantas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'11') == 0) { //Cuarto de Aires Acondicionados
            $m->eliminarCuartoAireAcondicionado($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'12') == 0) { //Área Deportiva Cerrada
            $m->eliminarAreaDeportivaCerrada($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'14') == 0) { //Centro de Datos/Teléfono
            $m->eliminarCentroDatos($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'17') == 0) { //Cuarto de Bombas
            $m->eliminarCuartoBombas($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'19') == 0) { //Cocineta
            $m->eliminarCocineta($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }else if (strcasecmp($uso_espacio,'20') == 0) { //Sala de Estudio
            $m->eliminarSalaEstudio($info['id_sede'],$info['id_campus'],$info['id_edificio'],$info['id']);
        }
        $this->eliminarArchivosEspacio($id_sede,$id_campus,$id_edificio,$id);
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "El espacio se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un salón.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del salón.
     * @return array
     */
    public function eliminarSalon($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $capacidad = array();
        $puntoVideoBeam = array();
        $sql = "DELETE FROM salon WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"salon");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
            array_push($capacidad,$valor['capacidad']);
            array_push($puntoVideoBeam,$valor['punto_video_beam']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Salón 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Salón 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("salon",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                    $this->registrarModificacion("salon",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad[$i],"eliminado");
                    $this->registrarModificacion("salon",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$puntoVideoBeam[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El salón se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un auditorio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del auditorio.
     * @return array
     */
    public function eliminarAuditorio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $capacidad = array();
        $puntoVideoBeam = array();
        $sql = "DELETE FROM auditorio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"auditorio");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
            array_push($capacidad,$valor['capacidad']);
            array_push($puntoVideoBeam,$valor['punto_video_beam']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Auditorio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Auditorio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("auditorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                    $this->registrarModificacion("auditorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad[$i],"eliminado");
                    $this->registrarModificacion("auditorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$puntoVideoBeam[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El auditorio se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un laboratorio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del laboratorio.
     * @return array
     */
    public function eliminarLaboratorio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $capacidad = array();
        $puntoVideoBeam = array();
        $puntoHidraulico = array();
        $this->eliminarPuntosSanitario($id_sede,$id_campus,$id_edificio,$id);
        $sql = "DELETE FROM laboratorio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"laboratorio");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
            array_push($capacidad,$valor['capacidad']);
            array_push($puntoVideoBeam,$valor['punto_video_beam']);
            array_push($puntoHidraulico,$valor['cantidad_punto_hidraulico']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Laboratorio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Laboratorio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                    $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad[$i],"eliminado");
                    $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$puntoVideoBeam[$i],"eliminado");
                    $this->registrarModificacion("laboratorio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_hidraulico",$puntoHidraulico[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El laboratorio se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar una sala de cómputo.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id de la sala de cómputo.
     * @return array
     */
    public function eliminarSalaComputo($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $capacidad = array();
        $puntoVideoBeam = array();
        $sql = "DELETE FROM sala_computo WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"sala_computo");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
            array_push($capacidad,$valor['capacidad']);
            array_push($puntoVideoBeam,$valor['punto_video_beam']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Sala Cómputo 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Sala Cómputo 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("sala_computo",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                    $this->registrarModificacion("sala_computo",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"capacidad",$capacidad[$i],"eliminado");
                    $this->registrarModificacion("sala_computo",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$puntoVideoBeam[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "La sala de cómputo se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar una oficina.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id de la oficina.
     * @return array
     */
    public function eliminarOficina($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $puntoVideoBeam = array();
        $sql = "DELETE FROM oficina WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"oficina");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
            array_push($puntoVideoBeam,$valor['punto_video_beam']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Oficina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Oficina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("oficina",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                    $this->registrarModificacion("oficina",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$puntoVideoBeam[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "La oficina se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un baño.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del baño.
     * @return array
     */
    public function eliminarBano($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipoInodoro = array();
        $cantidadInodoro = array();
        $ducha = array();
        $lavatraperos = array();
        $cantidadSifon = array();
        $tipoDivisiones = array();
        $materialDivisiones = array();
        $this->eliminarTodosLavamanos($id_sede,$id_campus,$id_edificio,$id);
        $this->eliminarOrinales($id_sede,$id_campus,$id_edificio,$id);
        $sql = "DELETE FROM bano WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"bano");
        foreach ($data as $clave => $valor) {
            array_push($tipoInodoro,$valor['id_tipo_inodoro']);
            array_push($cantidadInodoro,$valor['cantidad_inodoro']);
            array_push($ducha,$valor['ducha']);
            array_push($lavatraperos,$valor['lavatraperos']);
            array_push($cantidadSifon,$valor['cantidad_sifon']);
            array_push($tipoDivisiones,$valor['id_tipo_divisiones']);
            array_push($materialDivisiones,$valor['id_material_divisiones']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Baño 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Baño 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipoInodoro); $i++) {
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_inodoro",$tipoInodoro[$i],"eliminado");
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_inodoro",$cantidadInodoro[$i],"eliminado");
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ducha",$ducha[$i],"eliminado");
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"lavatraperos",$lavatraperos[$i],"eliminado");
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_sifon",$cantidadSifon[$i],"eliminado");
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_divisiones",$tipoDivisiones[$i],"eliminado");
                    $this->registrarModificacion("bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_divisiones",$materialDivisiones[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El baño se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un cuarto técnico.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del cuarto técnico.
     * @return array
     */
    public function eliminarCuartoTecnico($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $puntoVideoBeam = array();
        $sql = "DELETE FROM cuarto_tecnico WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_tecnico");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
            array_push($puntoVideoBeam,$valor['punto_video_beam']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Técnico 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Técnico 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("cuarto_tecnico",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                    $this->registrarModificacion("cuarto_tecnico",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"punto_video_beam",$puntoVideoBeam[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El cuato técnico se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar una bodega.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id de la bodega.
     * @return array
     */
    public function eliminarBodega($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $sql = "DELETE FROM bodega WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"bodega");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Bodega 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Bodega 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("bodega",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "La bodega se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un cuarto de plantas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del cuarto de plantas.
     * @return array
     */
    public function eliminarCuartoPlantas($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $sql = "DELETE FROM cuarto_plantas WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_plantas");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Plantas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Plantas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("cuarto_plantas",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El cuarto de plantas se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un cuarto de aires acondicionados.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del cuarto de aires acondicionados.
     * @return array
     */
    public function eliminarCuartoAiresAcondicionados($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $sql = "DELETE FROM cuarto_aire_acondicionado WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_aire_acondicionado");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Aires Acondicionados 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Aires Acondicionados 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("cuarto_aire_acondicionado",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El cuarto de aires acondicionados se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un área deportiva cerrada.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del área deportiva cerrada.
     * @return array
     */
    public function eliminarAreaDeportivaCerrada($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $sql = "DELETE FROM area_deportiva_cerrada WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"area_deportiva_cerrada");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Área Deportiva Cerrada 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Área Deportiva Cerrada 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("area_deportiva_cerrada",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El área deportiva cerrada se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un centro de datos.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del centro de datos.
     * @return array
     */
    public function eliminarCentroDatos($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $sql = "DELETE FROM centro_datos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"centro_datos");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Centro Datos 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Centro Datos 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("centro_datos",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El centro de datos se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un cuarto de bombas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del cuarto de bombas.
     * @return array
     */
    public function eliminarCuartoBombas($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoHidraulico = array();
        $this->eliminarPuntosSanitario($id_sede,$id_campus,$id_edificio,$id);
        $sql = "DELETE FROM cuarto_bombas WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cuarto_bombas");
        foreach ($data as $clave => $valor) {
            array_push($puntoHidraulico,$valor['cantidad_punto_hidraulico']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Bombas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cuarto Bombas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("cuarto_bombas",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_hidraulico",$puntoHidraulico[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El cuarto de bombas se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar Unidad cocineta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id de la cocineta.
     * @return array
     */
    public function eliminarCocineta($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoHidraulico = array();
        $this->eliminarPuntosSanitario($id_sede,$id_campus,$id_edificio,$id);
        $sql = "DELETE FROM cocineta WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"cocineta");
        foreach ($data as $clave => $valor) {
            array_push($puntoHidraulico,$valor['cantidad_punto_hidraulico']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cocineta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Cocineta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoHidraulico); $i++) {
                    $this->registrarModificacion("cocineta",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_hidraulico",$puntoHidraulico[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "La cocineta se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar una sala de estudio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id de la sala de estudio.
     * @return array
     */
    public function eliminarSalaEstudio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $puntoRed = array();
        $sql = "DELETE FROM sala_estudio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"sala_estudio");
        foreach ($data as $clave => $valor) {
            array_push($puntoRed,$valor['cantidad_punto_red']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Sala Estudio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Sala Estudio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($puntoRed); $i++) {
                    $this->registrarModificacion("sala_estudio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad_punto_red",$puntoRed[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "La sala de estudio se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los puntos sanitarios de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarPuntosSanitario($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo = array();
        $cantidad = array();
        $sql = "DELETE FROM punto_sanitario WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"punto_sanitario");
        foreach ($data as $clave => $valor) {
            array_push($tipo,$valor['id_tipo']);
            array_push($cantidad,$valor['cantidad']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puntos Sanitarios 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puntos Sanitarios 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo); $i++) {
                    $this->registrarModificacion("punto_sanitario",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo",$tipo[$i],"eliminado");
                    $this->registrarModificacion("punto_sanitario",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "Los puntos sanitarios se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los orinales de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarOrinales($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_orinal = array();
        $cantidad = array();
        $sql = "DELETE FROM orinal_bano WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"orinal_bano");
        foreach ($data as $clave => $valor) {
            array_push($tipo_orinal,$valor['id_tipo_orinal']);
            array_push($cantidad,$valor['cantidad']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Orinales 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Orinales 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_orinal); $i++) {
                    $this->registrarModificacion("orinal_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_orinal",$tipo_orinal[$i],"eliminado");
                    $this->registrarModificacion("orinal_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "Los orinales se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un orinal de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarOrinal($id_sede,$id_campus,$id_edificio,$id,$tipo_orinal){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_orinal = htmlspecialchars(trim($tipo_orinal));
        $sql = "DELETE FROM orinal_bano WHERE id_tipo_orinal = '".$tipo_orinal."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"orinal_bano");
        foreach ($data as $clave => $valor) {
            if (strcasecmp($tipo_orinal,$valor['id_tipo_orinal']) == 0) {
                $cantidad = $valor['cantidad'];
            }
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Orinales 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Orinales 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->registrarModificacion("orinal_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_orinal",$tipo_orinal,"eliminado");
                $this->registrarModificacion("orinal_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                $GLOBALS['mensaje'] = "Los orinales se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los lavamanos de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarTodosLavamanos($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_lavamanos = array();
        $cantidad = array();
        $sql = "DELETE FROM lavamanos_bano WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"orinal_bano");
        foreach ($data as $clave => $valor) {
            array_push($tipo_lavamanos,$valor['id_tipo_lavamanos']);
            array_push($cantidad,$valor['cantidad']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Todos Lavamanos 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Todos Lavamanos 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_lavamanos); $i++) {
                    $this->registrarModificacion("lavamanos_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_lavamanos",$tipo_lavamanos[$i],"eliminado");
                    $this->registrarModificacion("lavamanos_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "Los lavamanos se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los lavamanos de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarLavamanos($id_sede,$id_campus,$id_edificio,$id,$tipo_lavamanos){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_lavamanos = htmlspecialchars(trim($tipo_lavamanos));
        $sql = "DELETE FROM lavamanos_bano WHERE id_tipo_lavamanos = '".$tipo_lavamanos."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"lavamanos_bano");
        foreach ($data as $clave => $valor) {
            if (strcasecmp($tipo_orinal,$valor['id_tipo_orinal']) == 0) {
                $cantidad = $valor['cantidad'];
            }
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Lavamanos 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Lavamanos 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_lavamanos); $i++) {
                    $this->registrarModificacion("lavamanos_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_lavamanos",$tipo_lavamanos,"eliminado");
                    $this->registrarModificacion("lavamanos_bano",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                }
                $GLOBALS['mensaje'] = "El lavamanos se han eliminado correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un campus.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @return array
     */
    public function eliminarArchivosCampus($id_sede,$id_campus){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $sql = "DELETE FROM campus_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Campus 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Campus 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/campus/".$id_sede."-".$id_campus);
                $this->eliminarDir(__ROOT__. "/archivos/images/campus/".$id_sede."-".$id_campus);
                $GLOBALS['mensaje'] = "Los archivos del campus se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de una cancha.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la cancha.
     * @return array
     */
    public function eliminarArchivosCancha($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM cancha_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Cancha 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Cancha 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/cancha/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/cancha/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos de la cancha se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @return array
     */
    public function eliminarArchivosCorredor($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM corredor_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Corredor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Corredor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/corredor/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/corredor/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos del corredor se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de una cubierta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @return array
     */
    public function eliminarArchivosCubierta($id_sede,$id_campus,$id_edificio,$piso){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "DELETE FROM cubierta_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Cubierta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Cubierta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/cubierta/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso);
                $this->eliminarDir(__ROOT__. "/archivos/images/cubierta/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso);
                $GLOBALS['mensaje'] = "Los archivos de la cubierta se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de unas gradas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @return array
     */
    public function eliminarArchivosGradas($id_sede,$id_campus,$id_edificio,$piso){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "DELETE FROM gradas_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Gradas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Gradas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/gradas/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso);
                $this->eliminarDir(__ROOT__. "/archivos/images/gradas/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso);
                $GLOBALS['mensaje'] = "Los archivos de las gradas se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un parqueadero.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del parqueadero.
     * @return array
     */
    public function eliminarArchivosParqueadero($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM parqueadero_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Parqueadero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Parqueadero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/parqueadero/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/parqueadero/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos del parqueadero se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de una piscina.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la piscina.
     * @return array
     */
    public function eliminarArchivosPiscina($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM piscina_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Piscina 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Piscina 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/piscina/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/piscina/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos de la piscina se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de una plazoleta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la plazoleta.
     * @return array
     */
    public function eliminarArchivosPlazoleta($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM plazoleta_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/plazoleta/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/plazoleta/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos de la plazoleta se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un sendero.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del sendero.
     * @return array
     */
    public function eliminarArchivosSendero($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM sendero_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Sendero 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Sendero 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/sendero/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/sendero/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos del sendero se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un vía.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del vía.
     * @return array
     */
    public function eliminarArchivosVia($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM via_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Vía 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Vía 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/via/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/via/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos del vía se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un edificio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del edificio.
     * @return array
     */
    public function eliminarArchivosEdificio($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM edificio_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Edificio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Edificio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/edificio/".$id_sede."-".$id_campus."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/edificio/".$id_sede."-".$id_campus."-".$id);
                $GLOBALS['mensaje'] = "Los archivos del edificio se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los archivos de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @return array
     */
    public function eliminarArchivosEspacio($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $sql = "DELETE FROM espacio_archivos WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_espacio = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Archivos Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                $this->eliminarDir(__ROOT__."/archivos/planos/espacio/".$id_sede."-".$id_campus."-".$id_edificio."-".$id);
                $this->eliminarDir(__ROOT__. "/archivos/images/espacio/".$id_sede."-".$id_campus."-".$id_edificio."-".$id);
                $GLOBALS['mensaje'] = "Los archivos del espacio se han eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar los una carpeta y sus archivos.
     * @param string $carpeta, nombre de la carpeta a eliminar.
     * @return array
     */
    function eliminarDir($carpeta){
        foreach(glob($carpeta . "/*") as $archivos_carpeta){
            if (is_dir($archivos_carpeta)){
                eliminarDir($archivos_carpeta);
            }else{
                unlink($archivos_carpeta);
            }
        }
        rmdir($carpeta);
    }

    /**
     * Función que permite eliminar un tipo de iluminación de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @param string $objeto, tipo de iluminación a eliminar.
     * @return array
     */
    public function eliminarIluminacionCorredor($id_sede,$id_campus,$id,$tipo_iluminacion){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        if (strcasecmp($tipo_iluminacion,'') != 0){
            $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"iluminacion_corredor");
            foreach ($data as $clave => $valor) {
                if (strcasecmp($tipo_iluminacion,$valor['id_tipo_iluminacion']) == 0) {
                    $cantidad = $valor['cantidad'];
                }
            }
            $sql = "DELETE FROM iluminacion_corredor WHERE id_tipo_iluminacion = '".$tipo_iluminacion."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminación Corredor 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminación Corredor 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("iluminacion_corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_iluminacion",$tipo_iluminacion,"eliminado");
                    $this->registrarModificacion("iluminacion_corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de iluminación del corredor ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar un todos los tipos de iluminación de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @return array
     */
    public function eliminarIluminacionesCorredor($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = array();
        $cantidad = array();
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"iluminacion_corredor");
        foreach ($data as $clave => $valor) {
            array_push($tipo_iluminacion, $valor['id_tipo_iluminacion']);
            array_push($cantidad, $valor['cantidad']);
        }
        $sql = "DELETE FROM iluminacion_corredor WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminaciones Corredor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminaciones Corredor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_iluminacion); $i++) {
                    $this->registrarModificacion("iluminacion_corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_iluminacion",$tipo_iluminacion[$i],"eliminado");
                    $this->registrarModificacion("iluminacion_corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de iluminación del corredor ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de interruptor de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @param string $objeto, tipo de interruptor a eliminar.
     * @return array
     */
    public function eliminarInterruptorCorredor($id_sede,$id_campus,$id,$tipo_interruptor){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        if (strcasecmp($tipo_interruptor,'') != 0){
            $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"interruptor_corredor");
            foreach ($data as $clave => $valor) {
                if (strcasecmp($tipo_interruptor,$valor['id_tipo_interruptor']) == 0) {
                    $cantidad = $valor['cantidad'];
                }
            }
            $sql = "DELETE FROM interruptor_corredor WHERE id_tipo_interruptor = '".$tipo_interruptor."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptor Corredor 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptor Corredor 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("interruptor_corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_interruptor",$tipo_interruptor,"eliminado");
                    $this->registrarModificacion("interruptor_corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de interruptor del corredor ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar todos los tipo de interruptor de un corredor.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del corredor.
     * @return array
     */
    public function eliminarInterruptoresCorredor($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_interruptor = array();
        $cantidad = array();
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"interruptor_corredor");
        foreach ($data as $clave => $valor) {
            array_push($tipo_interruptor, $valor['id_tipo_interruptor']);
            array_push($cantidad, $valor['cantidad']);
        }
        $sql = "DELETE FROM interruptor_corredor WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptores Corredor 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptores Corredor 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_interruptor); $i++) {
                    $this->registrarModificacion("interruptor_corredor",$id_sede."-".$id_campus."-".$id,"id_tipo_interruptor",$tipo_interruptor[$i],"eliminado");
                    $this->registrarModificacion("interruptor_corredor",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de interruptor del corredor ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de ventana de unas gradas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @param string $tipo_ventana, tipo de ventana a eliminar.
     * @param string $material_ventana, material de la ventana a eliminar.
     * @return array
     */
    public function eliminarVentanaGradas($id_sede,$id_campus,$id_edificio,$piso,$tipo_ventana,$material_ventana){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $material_ventana = htmlspecialchars(trim($material_ventana));
        if ((strcasecmp($tipo_ventana,'') != 0) && (strcasecmp($material_ventana,'') != 0)){
            $data = $this->consultarElementoGradas($id_sede,$id_campus,$id_edificio,$piso,"ventana_gradas");
            foreach ($data as $clave => $valor) {
                if ((strcasecmp($tipo_ventana,$valor['id_tipo_ventana']) == 0) && (strcasecmp($material_ventana,$valor['id_material']) == 0)) {
                    $cantidad = $valor['cantidad'];
                    $alto = $valor['alto_ventana'];
                    $ancho = $valor['ancho_ventana'];
                }
            }
            $sql = "DELETE FROM ventana_gradas WHERE id_tipo_ventana = '".$tipo_ventana."' AND id_material = '".$material_ventana."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso_inicio = '".$piso."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventana Gradas 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventana Gradas 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_tipo_ventana",$tipo_ventana,"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material",$material_ventana,"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"cantidad",$cantidad,"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"alto_ventana",$alto,"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"ancho_ventana",$ancho,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de ventana de las gradas ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de ventana de unas gradas.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $piso, piso del edificio.
     * @param string $tipo_ventana, tipo de ventana a eliminar.
     * @param string $material_ventana, material de la ventana a eliminar.
     * @return array
     */
    public function eliminarVentanasGradas($id_sede,$id_campus,$id_edificio,$piso){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $tipo_ventana = array();
        $material_ventana = array();
        $cantidad = array();
        $alto = array();
        $ancho = array();
        $data = $this->consultarElementoGradas($id_sede,$id_campus,$id_edificio,$piso,"ventana_gradas");
        foreach ($data as $clave => $valor) {
            array_push($tipo_ventana,$valor['id_tipo_ventana']);
            array_push($material_ventana,$valor['id_material']);
            array_push($cantidad,$valor['cantidad']);
            array_push($alto,$valor['alto_ventana']);
            array_push($ancho,$valor['ancho_ventana']);
        }
        $sql = "DELETE FROM ventana_gradas WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND piso_inicio = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventanas Gradas 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventanas Gradas 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_ventana); $i++) {
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_tipo_ventana",$tipo_ventana[$i],"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material",$material_ventana[$i],"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"cantidad",$cantidad[$i],"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"alto_ventana",$alto[$i],"eliminado");
                    $this->registrarModificacion("ventana_gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"ancho_ventana",$ancho[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de ventana de las gradas ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de iluminación de una plazoleta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la plazoleta.
     * @param string $tipo_iluminacion, tipo de iluminación a eliminar.
     * @return array
     */
    public function eliminarIluminacionPlazoleta($id_sede,$id_campus,$id,$tipo_iluminacion){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        if (strcasecmp($tipo_iluminacion,'') != 0){
            $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"iluminacion_plazoleta");
            foreach ($data as $clave => $valor) {
                if (strcasecmp($tipo_iluminacion,$valor['id_tipo_iluminacion']) == 0) {
                    $cantidad = $valor['cantidad'];
                }
            }
            $sql = "DELETE FROM iluminacion_plazoleta WHERE id_tipo_iluminacion = '".$tipo_iluminacion."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminación Plazoleta 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminación Plazoleta 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("iluminacion_plazoleta",$id_sede."-".$id_campus."-".$id,"id_tipo_iluminacion",$tipo_iluminacion,"eliminado");
                    $this->registrarModificacion("iluminacion_plazoleta",$id_sede."-".$id_campus."-".$id,"cantidad",$cantidad,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de iluminación de la plazoleta ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar un todos los tipos de iluminación de una plazoleta.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id de la plazoleta.
     * @return array
     */
    public function eliminarIluminacionesPlazoleta($id_sede,$id_campus,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = array();
        $cantidad = array();
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"iluminacion_plazoleta");
        foreach ($data as $clave => $valor) {
            array_push($tipo_iluminacion, $valor['id_tipo_iluminacion']);
            array_push($cantidad, $valor['cantidad']);
        }
        $sql = "DELETE FROM iluminacion_plazoleta WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminaciones Plazoleta 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminaciones Plazoleta 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_iluminacion); $i++) {
                    $this->registrarModificacion("iluminacion_plazoleta",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_iluminacion",$tipo_iluminacion[$i],"eliminado");
                    $this->registrarModificacion("iluminacion_plazoleta",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de iluminación de la plazoleta ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de iluminación de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_iluminacion, tipo de iluminación a eliminar.
     * @return array
     */
    public function eliminarIluminacionEspacio($id_sede,$id_campus,$id_edificio,$id,$tipo_iluminacion){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        if (strcasecmp($tipo_iluminacion,'') != 0){
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"iluminacion_espacio");
            foreach ($data as $clave => $valor) {
                if (strcasecmp($tipo_iluminacion,$valor['id_tipo_iluminacion']) == 0) {
                    $cantidad = $valor['cantidad'];
                }
            }
            $sql = "DELETE FROM iluminacion_espacio WHERE id_tipo_iluminacion = '".$tipo_iluminacion."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminación Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminación Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("iluminacion_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_iluminacion",$tipo_iluminacion,"eliminado");
                    $this->registrarModificacion("iluminacion_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de iluminación del espacio ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar todos los tipos de iluminación de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarIluminacionesEspacio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_iluminacion = array();
        $cantidad = array();
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"iluminacion_espacio");
        foreach ($data as $clave => $valor) {
            array_push($tipo_iluminacion, $valor['id_tipo_iluminacion']);
            array_push($cantidad, $valor['cantidad']);
        }
        $sql = "DELETE FROM iluminacion_espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminaciones Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Iluminaciones Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_iluminacion); $i++) {
                    $this->registrarModificacion("iluminacion_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_iluminacion",$tipo_iluminacion[$i],"eliminado");
                    $this->registrarModificacion("iluminacion_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de iluminación del espacio ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de interruptor de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_interruptor, tipo de interruptor a eliminar.
     * @return array
     */
    public function eliminarInterruptorEspacio($id_sede,$id_campus,$id_edificio,$id,$tipo_interruptor){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        if (strcasecmp($tipo_interruptor,'') != 0){
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"interruptor_espacio");
            foreach ($data as $clave => $valor) {
                if (strcasecmp($tipo_interruptor,$valor['id_tipo_interruptor']) == 0) {
                    $cantidad = $valor['cantidad'];
                }
            }
            $sql = "DELETE FROM interruptor_espacio WHERE id_tipo_interruptor = '".$tipo_interruptor."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptor Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptor Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("interruptor_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_interruptor",$tipo_interruptor,"eliminado");
                    $this->registrarModificacion("interruptor_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de interruptor del espacio ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar todos los tipos de interruptor de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarInterruptoresEspacio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_interruptor = array();
        $cantidad = array();
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"interruptor_espacio");
        foreach ($data as $clave => $valor) {
            array_push($tipo_interruptor, $valor['id_tipo_interruptor']);
            array_push($cantidad, $valor['cantidad']);
        }
        $sql = "DELETE FROM interruptor_espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptores Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Interruptores Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_interruptor); $i++) {
                    $this->registrarModificacion("interruptor_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_interruptor",$tipo_interruptor[$i],"eliminado");
                    $this->registrarModificacion("interruptor_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de interruptor del espacio ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de puerta de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_puerta, tipo de puerta a eliminar.
     * @param string $material_puerta, material de la puerta a eliminar.
     * @param string $material_marco, material marco a eliminar.
     * @param string $tipo_cerradura, tipo de cerradura a eliminar.
     * @return array
     */
    public function eliminarPuertaEspacio($id_sede,$id_campus,$id_edificio,$id,$tipo_puerta,$material_puerta,$material_marco,$tipo_cerradura){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_marco = htmlspecialchars(trim($material_marco));
        if ((strcasecmp($tipo_puerta,'') != 0) && (strcasecmp($material_puerta,'') != 0) && (strcasecmp($material_marco,'') != 0)){
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"puerta_espacio");
            foreach ($data as $clave => $valor) {
                if ((strcasecmp($tipo_puerta,$valor['id_tipo_puerta']) == 0) && (strcasecmp($material_puerta,$valor['id_material_puerta']) == 0) && (strcasecmp($material_marco,$valor['id_material_marco']) == 0)) {
                    $cantidad = $valor['cantidad'];
                    $ancho = $valor['ancho_puerta'];
                    $largo = $valor['largo_puerta'];
                    $gato = $valor['gato'];
                }
            }
            $sql = "DELETE FROM puerta_espacio WHERE id_tipo_puerta = '".$tipo_puerta."' AND id_material_puerta = '".$material_puerta."' AND id_material_marco = '".$material_marco."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
            for ($i=0;$i<count($tipo_cerradura);$i++) {
                $this->eliminarCerraduraPuerta($id_sede,$id_campus,$id_edificio,$id,$tipo_puerta,$material_puerta,$material_marco,$tipo_cerradura[$i]);
            }
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puerta Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puerta Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_puerta",$tipo_puerta,"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_puerta",$material_puerta,"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_marco",$material_marco,"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_puerta",$ancho,"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"largo_puerta",$largo,"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"gato",$gato,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de puerta del espacio ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar todos los tipos de puerta de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarPuertasEspacio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_puerta = array();
        $material_puerta = array();
        $material_marco = array();
        $cantidad = array();
        $ancho = array();
        $largo = array();
        $gato = array();
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"puerta_espacio");
        foreach ($data as $clave => $valor) {
            array_push($tipo_puerta,$valor['id_tipo_puerta']);
            array_push($material_puerta,$valor['id_material_puerta']);
            array_push($material_marco,$valor['id_material_marco']);
            array_push($cantidad,$valor['cantidad']);
            array_push($ancho,$valor['ancho_puerta']);
            array_push($largo,$valor['largo_puerta']);
            array_push($gato,$valor['gato']);
        }
        $sql = "DELETE FROM puerta_espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
        for ($i=0;$i<count($tipo_cerradura);$i++) {
            $this->eliminarCerradurasPuerta($id_sede,$id_campus,$id_edificio,$id);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puertas Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puertas Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_puerta); $i++) {
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_puerta",$tipo_puerta[$i],"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_puerta",$material_puerta[$i],"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_marco",$material_marco[$i],"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_puerta",$ancho[$i],"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"largo_puerta",$largo[$i],"eliminado");
                    $this->registrarModificacion("puerta_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"gato",$gato[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de puerta del espacio ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de cerradura de una puerta de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_puerta, tipo de puerta a eliminar.
     * @param string $material_puerta, material de la puerta a eliminar.
     * @param string $material_marco, material marco a eliminar.
     * @param string $tipo_cerradura, tipo de cerradura a eliminar.
     * @return array
     */
    public function eliminarCerraduraPuerta($id_sede,$id_campus,$id_edificio,$id,$tipo_puerta,$material_puerta,$material_marco,$tipo_cerradura){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_marco = htmlspecialchars(trim($material_marco));
        $tipo_cerradura = htmlspecialchars(trim($tipo_cerradura));
        if (strcasecmp($tipo_cerradura,'') != 0){
            $sql = "DELETE FROM puerta_tipo_cerradura WHERE id_tipo_cerradura = '".$tipo_cerradura."' AND id_tipo_puerta = '".$tipo_puerta."' AND id_material_puerta = '".$material_puerta."' AND id_material_marco = '".$material_marco."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puerta Tipo-Cerradura 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puerta Tipo-Cerradura 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("puerta_tipo_cerradura",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_cerradura",$tipo_cerradura,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de cerrdura de la puerta del espacio ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar un todos los tipos de cerradura de una puerta de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarCerradurasPuerta($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_cerradura = array();
        $sql = "DELETE FROM puerta_tipo_cerradura WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"puerta_tipo_cerradura");
        foreach ($data as $clave => $valor) {
            array_push($tipo_cerradura,$valor['id_tipo_cerradura']);
        }
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puerta Tipos-Cerraduras 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Puerta Tipos-Cerraduras 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_puerta); $i++) {
                    $this->registrarModificacion("puerta_tipo_cerradura",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_cerradura",$tipo_cerradura[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de cerrdura de la puerta del espacio ha sido eliminado";
                return true;
            }
        }
    }

    /**
    * Función que permite eliminar un tipo de suministro de energía de un espacio.
    * @param string $id_sede, id de la sede.
    * @param string $id_campus, id del campus.
    * @param string $id, id del espacio.
    * @param string $tipo_suministro_energia, tipo de suministro de energía a eliminar.
    * @param string $tomacorriente, tipo de tomacorriente a eliminar.
    * @return array
    */
    public function eliminarSuministroEnergiaEspacio($id_sede,$id_campus,$id_edificio,$id,$tipo_suministro_energia,$tomacorriente){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_suministro_energia = htmlspecialchars(trim($tipo_suministro_energia));
        $tomacorriente = htmlspecialchars(trim($tomacorriente));
        if ((strcasecmp($tipo_suministro_energia,'') != 0) && (strcasecmp($tomacorriente,'') != 0)){
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"sumunistro_energia_espacio");
            foreach ($data as $clave => $valor) {
                if ((strcasecmp($tipo_suministro_energia,$valor['id_tipo_suministro_energia']) == 0) && (strcasecmp($tomacorriente,$valor['tomacorriente']) == 0)) {
                    $cantidad = $valor['cantidad'];
                }
            }
            $sql = "DELETE FROM suministro_energia_espacio WHERE id_tipo_suministro_energia = '".$tipo_suministro_energia."' AND tomacorriente = '".$tomacorriente."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Suministro Energía Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Suministro Energía Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("sumunistro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_suministro_energia",$tipo_suministro_energia,"eliminado");
                    $this->registrarModificacion("sumunistro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"tomacorriente",$tomacorriente,"eliminado");
                    $this->registrarModificacion("sumunistro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de suministro de energía del espacio ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar todos los tipos de suministro de energía de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarSuministrosEnergiaEspacio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_suministro_energia = array();
        $tomacorriente = array();
        $cantidad = array();
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"sumunistro_energia_espacio");
        foreach ($data as $clave => $valor) {
            array_push($tipo_suministro_energia,$valor['id_tipo_suministro_energia']);
            array_push($tomacorriente,$valor['tomacorriente']);
            array_push($cantidad,$valor['cantidad']);
        }
        $sql = "DELETE FROM suministro_energia_espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Suministros Energía Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Suministro Energía Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_suministro_energia); $i++) {
                    $this->registrarModificacion("sumunistro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_suministro_energia",$tipo_suministro_energia[$i],"eliminado");
                    $this->registrarModificacion("sumunistro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"tomacorriente",$tomacorriente[$i],"eliminado");
                    $this->registrarModificacion("sumunistro_energia_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de suministro de energía del espacio ha sido eliminado";
                return true;
            }
        }
    }

    /**
     * Función que permite eliminar un tipo de ventana de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @param string $tipo_ventana, tipo de ventana eliminar.
     * @param string $material_ventana, material de la ventana a eliminar.
     * @return array
     */
    public function eliminarVentanaEspacio($id_sede,$id_campus,$id_edificio,$id,$tipo_ventana,$material_ventana){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $material_ventana = htmlspecialchars(trim($material_ventana));
        if ((strcasecmp($tipo_ventana,'') != 0) && (strcasecmp($material_ventana,'') != 0)){
            $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"ventana_espacio");
            foreach ($data as $clave => $valor) {
                if ((strcasecmp($tipo_ventana,$valor['id_tipo_ventana']) == 0) && (strcasecmp($material_ventana,$valor['id_material_ventana']) == 0)) {
                    $cantidad = $valor['cantidad'];
                    $ancho = $valor['ancho_ventana'];
                    $alto = $valor['alto_ventana'];
                }
            }
            $sql = "DELETE FROM ventana_espacio WHERE id_tipo_ventana = '".$tipo_ventana."' AND id_material_ventana = '".$material_ventana."' AND id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
            $l_stmt = $this->conexion->prepare($sql);
            if(!$l_stmt){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventana Espacio 1)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventana Espacio 2)";
                    $GLOBALS['sql'] = $sql;
                    return false;
                }else{
                    $result = $l_stmt->fetchAll();
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_ventana",$tipo_ventana,"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_ventana",$material_ventana,"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad,"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_ventana",$ancho,"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"alto_ventana",$alto,"eliminado");
                    $GLOBALS['mensaje'] = "El tipo de ventana del espacio ha sido eliminado";
                    return true;
                }
            }
        }
    }

    /**
     * Función que permite eliminar todos los tipos de ventana de un espacio.
     * @param string $id_sede, id de la sede.
     * @param string $id_campus, id del campus.
     * @param string $id, id del espacio.
     * @return array
     */
    public function eliminarVentanasEspacio($id_sede,$id_campus,$id_edificio,$id){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $id = htmlspecialchars(trim($id));
        $tipo_ventana = array();
        $material_ventana = array();
        $cantidad = array();
        $ancho = array();
        $alto = array();
        $data = $this->consultarCampoElementoEspacio($id_sede,$id_campus,$id_edificio,$id,"ventana_espacio");
        foreach ($data as $clave => $valor) {
            array_push($tipo_ventana,$valor['id_tipo_ventana']);
            array_push($material_ventana,$valor['id_material_ventana']);
            array_push($cantidad,$valor['cantidad']);
            array_push($ancho,$valor['ancho_ventana']);
            array_push($alto,$valor['alto_ventana']);
        }
        $sql = "DELETE FROM ventana_espacio WHERE id_sede = '".$id_sede."' AND id_campus = '".$id_campus."' AND id_edificio = '".$id_edificio."' AND id_espacio = '".$id."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventanas Espacio 1)";
            $GLOBALS['sql'] = $sql;
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Eliminar Ventanas Espacio 2)";
                $GLOBALS['sql'] = $sql;
                return false;
            }else{
                $result = $l_stmt->fetchAll();
                for ($i=0;$i<count($tipo_ventana); $i++) {
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_tipo_ventana",$tipo_ventana[$i],"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"id_material_ventana",$material_ventana[$i],"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"cantidad",$cantidad[$i],"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"ancho_ventana",$ancho[$i],"eliminado");
                    $this->registrarModificacion("ventana_espacio",$id_sede."-".$id_campus."-".$id_edificio."-".$id,"alto_ventana",$alto[$i],"eliminado");
                }
                $GLOBALS['mensaje'] = "El tipo de ventana del espacio ha sido eliminado";
                return true;
            }
        }
    }
}
?>
