<?php
/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/
/**
 * Clase modelo_modificacion
 */
class modelo_modificacion {

    /**
     * Función que permite modificar una sede.
     * @param string $id_sede, id de la sede.
     * @param string $nombre_sede, nuevo nombre de la sede.
     * @return array
     */
    public function modificarSede($id_sede,$nombre_sede){
        $id_sede = htmlspecialchars(trim($id_sede));
        $nombre_sede_nuevo = htmlspecialchars(trim($nombre_sede_nuevo));
        $sql = "UPDATE sede SET nombre = '".$nombre_sede_nuevo."' WHERE id = '".$id_sede."';";
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
                $GLOBALS['mensaje'] = "La sede se modificó correctamente";
                $this->registrarModificacion("sede",$id_sede,"nombre",$nombre_sede_antiguo,$nombre_sede);
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
                $GLOBALS['mensaje'] = "El campus se modificó correctamente";
                $this->registrarModificacion("campus",$id_sede."-".$id_campus,"nombre",$nombre_campus_anterior,$nombre_campus);
                $this->registrarModificacion("campus",$id_sede."-".$id_campus,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("campus",$id_sede."-".$id_campus,"lng",$lng_anterior,$lng);
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
        $campos = "uso = '".$uso."', id_material_piso = '".$material_piso."', lat = '".$lat."', lng = '".$lng."'";
        if (strcasecmp($material_piso,'') != 0)
            $campos = $campos.", id_material_piso = '".$material_piso."'";
        if (strcasecmp($tipo_pintura,'') != 0)
            $campos = $campos.", id_tipo_pintura_demarcacion = '".$tipo_pintura."'";
        $sql = "UPDATE cancha SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND sede = '".$id_sede."';";
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
                $GLOBALS['mensaje'] = "La cancha se modificó correctamente";
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"uso",$uso_anterior,$uso);
                if (strcasecmp($material_piso,'') != 0)
                    $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"id_material_piso",$material_piso_anterior,$material_piso);
                if (strcasecmp($tipo_pintura,'') != 0)
                    $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"id_tipo_pintura_demarcacion",$tipo_pintura_anterior,$tipo_pintura);
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"longitud_demarcacion",$longitud_demarcacion_anterior,$longitud_demarcacion);
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"lat",$lat_anterior,$lat);
                $this->registrarModificacion("cancha",$id_sede."-".$id_campus."-".$id,"lng",$lng_anterior,$lng);
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
    public function modificarCorredor($id_sede,$id_campus,$id,$ancho_pared,$alto_pared,$material_pared,$ancho_piso,$largo_piso,$material_piso,$ancho_techo,$largo_techo,$material_techo,$tomacorriente,$tipo_suministro_energia,$cantidad,$tipo_iluminacion,$cantidad_iluminacion,$tipo_interruptor,$cantidad_interruptor,$lat,$lng){
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
        $sql = "UPDATE corredor SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND sede = '".$id_sede."';";
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
                $GLOBALS['mensaje'] = "El corredor se modificó correctamente";
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
                /*for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->modificarIluminacionCorredor($nombre_sede,$nombre_campus,$id_corredor,$tipo_iluminacion[$i],$cantidad_iluminacion[$i]);
                }
                for ($i=0;$i<count($tipo_interruptor);$i++) {
                    $this->modificarIluminacionCorredor($nombre_sede,$nombre_campus,$id_corredor,$tipo_interruptor[$i],$cantidad_interruptor[$i]);
                }*/
                $GLOBALS['sql'] = $sql;
                return true;
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
        $campos = "largo_cubierta = '".$largo_cubierta."', ancho_cubierta = '".$ancho_cubierta."'";
        if (strcasecmp($tipo_cubierta,'') != 0)
            $campos = $campos.", id_tipo_cubierta = '".$material_pared."'";
        if (strcasecmp($material_cubierta,'') != 0)
            $campos = $campos.", id_material_cubierta = '".$material_cubierta."'";
        $sql = "UPDATE cubiertas_piso SET $campos WHERE id_edificio = '".$id_edificio."' AND piso = '".$id_edificio."' AND id_campus = '".$id_campus."' AND sede = '".$id_sede."';";
        $data = $this->consultarCampoCubierta($id_sede,$id_campus,$id_edificio,$piso);
        foreach ($data as $clave => $valor) {
            $tipo_cubierta_anterior = $valor['id_tipo_cubierta'];
            $material_cubierta_anterior = $valor['id_material_cubierta'];
            $largo_cubierta_anterior = $valor['largo_cubierta'];
            $ancho_cubierta_anterior = $valor['ancho_cubierta'];
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
                $GLOBALS['mensaje'] = "El corredor se modificó correctamente";
                if (strcasecmp($tipo_cubierta,'') != 0)
                    $this->registrarModificacion("cubierta",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_tipo_cubierta",$tipo_cubierta_anterior,$tipo_cubierta);
                if (strcasecmp($material_cubierta,'') != 0)
                    $this->registrarModificacion("cubierta",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material_cubierta",$material_cubierta_anterior,$material_cubierta);
                $this->registrarModificacion("cubierta",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"largo_cubierta",$largo_cubierta_anterior,$largo_cubierta);
                $this->registrarModificacion("cubierta",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"ancho_cubierta",$ancho_cubierta_anterior,$ancho_cubierta);
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
    public function modificarGradas($id_sede,$id_campus,$id_edificio,$piso,$pasamanos,$material_pasamanos,$tipo_ventana,$material,$alto_ventana,$ancho_ventana){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $pasamanos = htmlspecialchars(trim($pasamanos));
        $material_pasamanos = htmlspecialchars(trim($material_pasamanos));
        $campos = "pasamanos = '".$pasamanos."'";
        if (strcasecmp($pasamanos,'true') == 0 && strcasecmp($material_pasamanos,'') != 0)
            $campos = $campos.", id_material_pasamanos = '".$material_pasamanos."'";
        $sql = "UPDATE gradas SET $campos WHERE id_edificio = '".$id_edificio."' AND piso = '".$id_edificio."' AND id_campus = '".$id_campus."' AND sede = '".$id_sede."';";
        $data = $this->consultarCampoGradas($id_sede,$id_campus,$id_edificio,$piso);
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
                $GLOBALS['mensaje'] = "Las gradas se modificaron correctamente";
                $this->registrarModificacion("gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"pasamanos",$pasamanos_anterior,$pasamanos);
                if (strcasecmp($pasamanos,'true') == 0 && strcasecmp($material_pasamanos,'') != 0)
                    $this->registrarModificacion("gradas",$id_sede."-".$id_campus."-".$id_edificio."-".$piso,"id_material_pasamanos",$material_pasamanos_anterior,$material_pasamanos);
                /*for ($i=0;$i<count($tipoVentana);$i++) {
                    $this->modificarVentanaGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$tipo_ventana[$i],$cantidad_ventana[$i],$material[$i],$ancho_ventana[$i],$alto_ventana[$i]);
                }*/
                $GLOBALS['sql'] = $sql;
                return true;
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
        $sql = "UPDATE parqueadero SET $campos WHERE id = '".$id."' AND id_campus = '".$id_campus."' AND sede = '".$id_sede."';";
        $data = $this->consultarCampoElementoCampus($id_sede,$id_campus,$id,"parqueadero");
        foreach ($data as $clave => $valor) {
            $material_piso_anterior = $valor['id_material_piso'];
            $tipo_pintura_anterior = $valor['id_tipo_pintura'];
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
                $GLOBALS['mensaje'] = "El parqueadero se modificó correctamente";
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
        $usuario = htmlspecialchars(trim($usuario));
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
        $sql = "SELECT * FROM sede WHERE id = ".$id_sede.";";
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
        $sql = "SELECT * FROM campus WHERE id = ".$id_campus." AND sede = ".$id_sede.";";
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
        $sql = "SELECT * FROM ".$elemento." WHERE id = ".$id." AND id_sede = ".$id_sede." AND id_campus = ".$id_sede.";";
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
        $sql = "SELECT * FROM cubiertas_piso WHERE id_sede = ".$id_sede." AND id_campus = ".$id_sede." AND id_edificio = ".$id_edificio." AND piso = ".$piso.";";
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
    public function consultarCampoGradas($id_sede,$id_campus,$id_edificio,$piso){
        $id_sede = htmlspecialchars(trim($id_sede));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM gradas WHERE id_sede = ".$id_sede." AND id_campus = ".$id_sede." AND id_edificio = ".$id_edificio." AND piso_inicio = ".$piso.";";
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
        $sql = "SELECT * FROM ".$elemento." WHERE id = ".$id." AND id_edificio = ".$id_edificio." AND id_sede = ".$id_sede." AND id_campus = ".$id_sede.";";
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
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un tipo de material.
     * @param string $tipo_material, tipo de material a consultar.
     * @param string $nombre_tipo_material, nombre del tipo de mateial.
     * @return array
     */
    public function consultarCampoTipoMaterial($tipo_material,$nombre_tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $nombre_tipo_material = htmlspecialchars(trim($nombre_tipo_material));
        $sql = "SELECT * FROM ".$tipo_material." WHERE material = ".$nombre_tipo_material.";";
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
            }
        }
        return $result;
    }

    /**
     * Función que permite consultar el valor de un campo de un tipo de objeto.
     * @param string $tipo_objeto, tipo de objeto a consultar.
     * @param string $nombre_tipo_objeto, nombre del tipo de mateial.
     * @return array
     */
    public function consultarCampoTipoObjeto($tipo_objeto,$nombre_tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $nombre_tipo_objeto = htmlspecialchars(trim($nombre_tipo_objeto));
        $sql = "SELECT * FROM ".$tipo_objeto." WHERE tipo = ".$nombre_tipo_objeto.";";
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
}
?>
