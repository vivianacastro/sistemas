<?php
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
     * @param string $nombre_sede, nombre de la sede.
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
     * Función que permite guardar un campus.
     * @param string $nombre_sede, id de la sede a la que pertenece el edificio.
     * @param string $nombre_campus, id del campus a la que pertenece el campus.
     * @return array
     */
    public function guardarCampus($nombre_sede,$nombre_campus,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        $sql = "INSERT INTO campus (sede,nombre,lat,lng,usuario_crea) VALUES ('".$nombre_sede."','".$nombre_campus."','".$lat."','".$lng."','".$_SESSION["login"]."');";
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
     * Función que permite guardar un edificio.
     * @param string $nombre_campus, id del campus.
     * @param string $id_edificio, id del edificio.
     * @param string $nombre_edificio, nombre del edificio.
     * @param string $numero_pisos, número de pisos del edificio.
     * @param string $terraza, si el edificio tiene terraza.
     * @param string $sotano, si el edificio tiene sotano.
     * @return array
     */
    public function guardarEdificio($nombre_sede,$nombre_campus,$id_edificio,$nombre_edificio,$numero_pisos,$terraza,$sotano,$tipo_fachada,$alto_fachada,$ancho_fachada,$lat,$lng){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $numero_pisos = htmlspecialchars(trim($numero_pisos));
        $terraza = htmlspecialchars(trim($terraza));
        $sotano = htmlspecialchars(trim($sotano));
        $tipo_fachada = htmlspecialchars(trim($tipo_fachada));
        $alto_fachada = htmlspecialchars(trim($alto_fachada));
        $ancho_fachada = htmlspecialchars(trim($ancho_fachada));
        $lat = htmlspecialchars(trim($lat));
        $lng = htmlspecialchars(trim($lng));
        if(strcasecmp($material_pared,'') != 0){
            $sql = "INSERT INTO edificio (id,nombre,id_campus,numero_pisos,usuario_crea,sotano,terraza,id_sede,lat,lng,id_material_fachada,ancho_fachada,alto_fachada) VALUES ('".$id_edificio."','".$nombre_edificio."','".$nombre_campus."','".$numero_pisos."','".$_SESSION["login"]."','".$sotano."','".$terraza."','".$nombre_sede."','".$lat."','".$lng."','".$tipo_fachada."','".$ancho_fachada."','".$alto_fachada."');";
        }else{
            $sql = "INSERT INTO edificio (id,nombre,id_campus,numero_pisos,usuario_crea,sotano,terraza,id_sede,lat,lng,ancho_fachada,alto_fachada) VALUES ('".$id_edificio."','".$nombre_edificio."','".$nombre_campus."','".$numero_pisos."','".$_SESSION["login"]."','".$sotano."','".$terraza."','".$nombre_sede."','".$lat."','".$lng."','".$ancho_fachada."','".$alto_fachada."');";
        }

        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Edificio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Edificio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "El edificio se guardó correctamente";
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
     * @return array
     */
    public function guardarGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso_inicio,$pasamanos,$material_pasamanos,$ventana,$tipoVentana,$cantidadVentanas,$materialVentana,$anchoVentana,$altoVentana){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso_inicio = htmlspecialchars(trim($piso_inicio));
        $pasamanos = htmlspecialchars(trim($pasamanos));
        $material_pasamanos = htmlspecialchars(trim($material_pasamanos));
        $ventana = htmlspecialchars(trim($ventana));
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
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Gradas 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                if (strcasecmp($ventana,'false') != 0) {
                    for ($i=0;$i<count($tipoVentana);$i++) {
                        $this->guardarVentanaGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso_inicio,$tipoVentana[$i],$cantidadVentanas[$i],$materialVentana[$i],$anchoVentana[$i],$altoVentana[$i]);
                    }
                }
                $GLOBALS['mensaje'] = "Las gradas del piso ".$piso_inicio." del edificio ".$nombre_edificio." se guardaron correctamente";
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
     */
    public function guardarEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$numero_espacio,$uso_espacio,$alto_pared,$ancho_pared,$material_pared,$largo_techo,$ancho_techo,$material_techo,$largo_piso,$ancho_piso,$material_piso,$tipo_iluminacion,$cantidad_iluminacion,$tipo_suministro_energia,$tomacorriente,$cantidad_tomacorrientes,$tipo_puerta,$cantidad_puertas,$material_puerta,$tipo_cerradura,$gato_puerta,$material_marco,$ancho_puerta,$alto_puerta,$tipo_ventana,$cantidad_ventanas,$material_ventana,$ancho_ventana,$alto_ventana,$tipo_interruptor,$cantidad_interruptores,$numero_espacio_padre,$sede_espacio_padre,$campus_espacio_padre,$edificio_espacio_padre){
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
        $sede_espacio_padre = htmlspecialchars(trim($sede_espacio_padre));
        $campus_espacio_padre = htmlspecialchars(trim($campus_espacio_padre));
        $edificio_espacio_padre = htmlspecialchars(trim($edificio_espacio_padre));
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

        /*$sql = "INSERT INTO espacio (id,uso_espacio,ancho_pared,alto_pared,id_material_pared,
            ancho_piso,largo_piso,id_material_piso,ancho_techo,largo_techo,id_material_techo,
            espacio_padre,id_edificio,id_campus,edificio_padre,campus_padre,sede_padre,
            usuario_crea,piso_edificio,id_sede) VALUES ('".$numero_espacio."','".$uso_espacio."','".$ancho_pared."','".$alto_pared."',
            '".$material_pared."','".$ancho_piso."','".$largo_piso."','".$material_piso."','".$ancho_techo."','".$largo_techo."','".$material_techo."','".$numero_espacio_padre."',
            '".$nombre_edificio."','".$nombre_campus."','".$edificio_espacio_padre."','".$campus_espacio_padre."','".$sede_espacio_padre."','".$_SESSION["login"]."','".$piso."','".$nombre_sede."');";*/
        $sql = "INSERT INTO espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                for ($i=0;$i<count($tipo_iluminacion);$i++) {
                    $this->guardarIluminacionEspacio($numero_espacio,$nombre_campus,$nombre_edificio,$tipo_iluminacion[$i],$cantidad_iluminacion[$i]);
                }
                for ($i=0;$i<count($tipo_interruptor);$i++) {
                    $this->guardarInterruptoresEspacio($numero_espacio,$nombre_campus,$nombre_edificio,$tipo_interruptor[$i],$cantidad_interruptores[$i]);
                }
                for ($i=0;$i<count($tipo_puerta);$i++) {
                    $this->guardarPuertasEspacio($numero_espacio,$nombre_campus,$nombre_edificio,$tipo_puerta[$i],$material_puerta[$i],$cantidad_puertas[$i],$material_marco[$i],$ancho_puerta[$i],$alto_puerta[$i],$gato_puerta[$i]);
                }
                for ($i=0;$i<count($tipo_suministro_energia);$i++) {
                    $this->guardarSuministroEnergiaEspacio($numero_espacio,$nombre_campus,$nombre_edificio,$tipo_suministro_energia[$i],$cantidad_tomacorrientes[$i],$tomacorriente[$i]);
                }
                for ($i=0;$i<count($tipo_ventana);$i++) {
                    $this->guardarVentanaEspacio($numero_espacio,$nombre_campus,$nombre_edificio,$tipo_ventana[$i],$cantidad_ventanas[$i],$material_ventana[$i],$ancho_ventana[$i],$alto_ventana[$i]);
                }
                $GLOBALS['mensaje'] = "El(los) espacio(s) se guardó(aron) correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de la iluminación de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_iluminacion, tipo de iluminación que tiene el espacio.
     * @param string $cantidad, cantidad de lámparas que tiene el espacio.
     * @return array
     */
    public function guardarIluminacionEspacio($id_espacio,$id_campus,$id_edificio,$tipo_iluminacion,$cantidad){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_iluminacion = htmlspecialchars(trim($tipo_iluminacion));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id_espacio,id_edificio,id_campus,id_tipo_iluminacion";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_iluminacion."'";
        if (strcasecmp($cantidad,'') != 0) {
          $campos = $campos.",cantidad";
          $valores = $valores.",'".$cantidad."'";
        }
        $sql = "INSERT INTO iluminacion_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Iluminación-Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "La iluminación del espacio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de los interruptores de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_interruptor, tipo de interruptor que tiene el espacio.
     * @param string $cantidad, cantidad de interruptores que tiene el espacio.
     * @return array
     */
    public function guardarInterruptoresEspacio($id_espacio,$id_campus,$id_edificio,$tipo_interruptor,$cantidad){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_interruptor = htmlspecialchars(trim($tipo_interruptor));
        $cantidad = htmlspecialchars(trim($cantidad));
        $campos = "id_espacio,id_edificio,id_campus,id_tipo_interruptor";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_interruptor."'";
        if (strcasecmp($cantidad,'') != 0) {
          $campos = $campos.",cantidad";
          $valores = $valores.",'".$cantidad."'";
        }
        $sql = "INSERT INTO interruptores_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Interruptor-Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Interruptor-Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "Los interruptores del espacio se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de las puertas de un espacio.
     * @param string $id_espacio, id del espacio.
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
     */
    public function guardarPuertasEspacio($id_espacio,$id_campus,$id_edificio,$tipo_puerta,$material_puerta,$cantidad,$material_marco,$ancho,$largo,$gato){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $cantidad = htmlspecialchars(trim($cantidad));
        $material_marco = htmlspecialchars(trim($material_marco));
        $ancho = htmlspecialchars(trim($ancho));
        $largo = htmlspecialchars(trim($largo));
        $gato = htmlspecialchars(trim($gato));
        $campos = "id_espacio,id_edificio,id_campus,id_tipo_puerta,id_material_puerta,id_material_marco";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_puerta."','".$material_puerta."','".$material_marco."'";
        if (strcasecmp($cantidad,'') != 0) {
          $campos = $campos.",cantidad";
          $valores = $valores.",'".$cantidad."'";
        }
        if (strcasecmp($ancho,'') != 0) {
          $campos = $campos.",ancho_puerta";
          $valores = $valores.",'".$ancho."'";
        }
        if (strcasecmp($largo,'') != 0) {
          $campos = $campos.",largo_puerta";
          $valores = $valores.",'".$largo."'";
        }
        if (strcasecmp($gato,'') != 0) {
          $campos = $campos.",gato";
          $valores = $valores.",'".$gato."'";
        }
        $sql = "INSERT INTO puerta_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "Las puertas del espacio se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de las cerraduras de una puerta de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_puerta, tipo de puerta que tiene el espacio.
     * @param string $material_puerta, material de las puertas del espacio.
     * @param string $material_marco, material del marco de las puertas del espacio.
     * @param string $tipo_cerradura, tipo de cerradura de las puertas.
     * @return array
     */
    public function guardarPuertaTipoCerradura($id_espacio,$id_campus,$id_edificio,$tipo_puerta,$material_puerta,$material_marco,$tipo_cerradura){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_puerta = htmlspecialchars(trim($tipo_puerta));
        $material_puerta = htmlspecialchars(trim($material_puerta));
        $material_marco = htmlspecialchars(trim($material_marco));
        $tipo_cerradura = htmlspecialchars(trim($tipo_cerradura));
        $sql = "INSERT INTO puerta_tipo_cerradura (id_espacio,id_tipo_puerta,id_material_puerta,id_material_marco,id_tipo_cerradura,id_edificio,id_campus) VALUES ('".$id_espacio."','".$tipo_puerta."','".$material_puerta."','".$material_marco."','".$id_tipo_cerradura."','".$id_edificio."','".$id_campus."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Tipo Cerradura 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Puerta-Tipo Cerradura 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "El tipo se cerradura de la puerta del espacio se guardó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de las puertas de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_suministro_energia, tipo de suministro de energía que tiene el espacio.
     * @param string $cantidad, cantidad de tomacorrientes que tiene el espacio.
     * @param string $tomacorriente, si el tomacorriente es regulado o no.
     * @return array
     */
    public function guardarSuministroEnergiaEspacio($id_espacio,$id_campus,$id_edificio,$tipo_suministro_energia,$cantidad,$tomacorriente){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_suministro_energia = htmlspecialchars(trim($tipo_suministro_energia));
        $cantidad = htmlspecialchars(trim($cantidad));
        $tomacorriente = htmlspecialchars(trim($tomacorriente));
        $campos = "id_espacio,id_edificio,id_campus,id_tipo_suministro_energia";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_suministro_energia."'";
        if (strcasecmp($cantidad,'') != 0) {
          $campos = $campos.",cantidad";
          $valores = $valores.",'".$cantidad."'";
        }
        if (strcasecmp($tomacorriente,'') != 0) {
          $campos = $campos.",tomacorriente";
          $valores = $valores.",'".$tomacorriente."'";
        }
        $sql = "INSERT INTO suministro_energia_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Suministro-Energia-Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Suministro-Energia-Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "El suministro de energía del espacio se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información del suministro de energía de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_ventana, tipo de ventana que tiene el espacio.
     * @param string $cantidad, cantidad de ventanas que tiene el espacio.
     * @param string $material_ventana, material de las ventanas del espacio.
     * @param string $ancho_ventana, ancho de las ventanas del espacio.
     * @param string $alto_ventana, alto de las ventanas del espacio.
     * @return array
     */
    public function guardarVentanaEspacio($id_espacio,$id_campus,$id_edificio,$tipo_ventana,$cantidad,$material_ventana,$ancho_ventana,$alto_ventana){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_ventana = htmlspecialchars(trim($tipo_ventana));
        $cantidad = htmlspecialchars(trim($cantidad));
        $material_ventana = htmlspecialchars(trim($material_ventana));
        $ancho_ventana = htmlspecialchars(trim($ancho_ventana));
        $alto_ventana = htmlspecialchars(trim($alto_ventana));
        $campos = "id_espacio,id_edificio,id_campus,id_tipo_ventana,id_material";
        $valores = "'".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_ventana."','".$material_ventana."'";
        if (strcasecmp($cantidad,'') != 0) {
          $campos = $campos.",cantidad";
          $valores = $valores.",'".$cantidad."'";
        }
        if (strcasecmp($ancho_ventana,'') != 0) {
          $campos = $campos.",ancho_ventana";
          $valores = $valores.",'".$ancho_ventana."'";
        }
        if (strcasecmp($alto_ventana,'') != 0) {
          $campos = $campos.",alto_ventana";
          $valores = $valores.",'".$alto_ventana."'";
        }
        $sql = "INSERT INTO ventana_espacio (".$campos.") VALUES (".$valores.");";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "La ventana del espacio se guardaró correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información del suministro de energía de un espacio.
     * @param string $id_espacio, id del espacio.
     * @param string $id_campus, id del campus al que pertenece el espacio.
     * @param string $id_edificio, id del edificio al que pertenece el espacio.
     * @param string $tipo_ventana, tipo de ventana que tiene el espacio.
     * @param string $cantidad, cantidad de ventanas que tiene el espacio.
     * @param string $material_ventana, material de las ventanas del espacio.
     * @param string $ancho_ventana, ancho de las ventanas del espacio.
     * @param string $alto_ventana, alto de las ventanas del espacio.
     * @return array
     */
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
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Ventana-Gradas 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "La ventana de las gradas se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información del punto sanitario de un espacio.
     * @param string $id_espacio, id del espacio al que pertenece el punto sanitario.
     * @param string $id_campus, id del campus al que pertenece el punto sanitario.
     * @param string $id_edificio, id del edificio al que pertenece el punto sanitario.
     * @param string $tipo_punto_sanitario, tipo de punto sanitario que tiene el baño.
     * @param string $cantidad_punto_sanitario, cantidad de puntos sanitarios que tiene el espacio.
     * @return array
     */
    public function guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_punto_sanitario = htmlspecialchars(trim($tipo_punto_sanitario));
        $cantidad_punto_sanitario = htmlspecialchars(trim($cantidad_punto_sanitario));
        $sql = "INSERT INTO punto_sanitario (id_espacio,id_edificio,id_campus,id_tipo,cantidad) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_punto_sanitario."','".$cantidad_punto_sanitario."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Punto Sanitario 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Punto Sanitario 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el lavamanos.
     * @param string $id_edificio, id del edificio al que pertenece el lavamanos.
     * @param string $tipo_lavamanos, tipo de lavamanos que tiene el baño.
     * @param string $cantidad_lavamanos, cantidad de lavamanos que tiene el baño.
     * @return array
     */
    public function guardarLavamanosBano($id_espacio,$id_campus,$id_edificio,$tipo_lavamanos,$cantidad_lavamanos){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_lavamanos = htmlspecialchars(trim($tipo_lavamanos));
        $cantidad_lavamanos = htmlspecialchars(trim($cantidad_lavamanos));
        $sql = "INSERT INTO lavamanos_bano (id_espacio,id_edificio,id_campus,id_tipo_lavamanos,cantidad) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_lavamanos."','".$cantidad_lavamanos."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Lavamanos-Baño 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Lavamanos-Baño 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el orinal.
     * @param string $id_edificio, id del edificio al que pertenece el orinal.
     * @param string $tipo_orinal, tipo de orinal que tiene el baño.
     * @param string $cantidad_orinal, cantidad de orinales que tiene el baño.
     * @return array
     */
    public function guardarOrinalBano($id_espacio,$id_campus,$id_edificio,$tipo_orinal,$cantidad_orinal){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_orinal = htmlspecialchars(trim($tipo_orinal));
        $cantidad_orinal = htmlspecialchars(trim($cantidad_orinal));

        $sql = "INSERT INTO orinal_bano (id_espacio,id_edificio,id_campus,id_tipo_orinal,cantidad) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_orinal."','".$cantidad_orinal."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Orinal-Baño 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Orinal-Baño 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el salón.
     * @param string $id_edificio, id del edificio al que pertenece el salón.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el salón.
     * @param string $capacidad, capacidad del salón.
     * @param string $punto_proyector, si el salón tiene o no punto de proyector.
     * @return array
     */
    public function guardarSalon($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_proyector){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_proyector = htmlspecialchars(trim($punto_proyector));
        $sql = "INSERT INTO salon (id_espacio,id_edificio,id_campus,puntos_red,capacidad,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."','".$capacidad."','".$punto_proyector."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Salón 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Salón 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el auditorio.
     * @param string $id_edificio, id del edificio al que pertenece el auditorio.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el auditorio.
     * @param string $capacidad, capacidad del auditorio.
     * @param string $punto_proyector, si el auditorio tiene o no punto de proyector.
     * @return array
     */
    public function guardarAuditorio($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_proyector){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_proyector = htmlspecialchars(trim($punto_proyector));
        $sql = "INSERT INTO auditorio (id_espacio,id_edificio,id_campus,puntos_red,capacidad,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."','".$capacidad."','".$punto_proyector."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Auditorio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Auditorio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el laboratorio.
     * @param string $id_edificio, id del edificio al que pertenece el laboratorio.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el laboratorio.
     * @param string $capacidad, capacidad del laboratorio.
     * @param string $punto_proyector, si el laboratorio tiene o no punto de proyector.
     * @param string $cantidad_punto_hidraulico, cantidad de puntos hidraulicos que tiene el laboratorio.
     * @param string $tipo_punto_sanitario, tipo de punto sanitario que tiene el laboratorio.
     * @param string $cantidad_punto_sanitario, cantidad de puntos sanitarios que tiene el laboratorio.
     * @return array
     */
    public function guardarLaboratorio($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_proyector,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_proyector = htmlspecialchars(trim($punto_proyector));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $sql = "INSERT INTO laboratorio (id_espacio,id_edificio,id_campus,puntos_red,capacidad,punto_video_beam,cantidad_punto_hidraulico) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."','".$capacidad."','".$punto_proyector."','".$cantidad_punto_hidraulico."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Laboratorio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Laboratorio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_punto_sanitario);$i++) {
                    $this->guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario[$i],$cantidad_punto_sanitario[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una sala de computo
     * @param string $id_espacio, id de la sala de computo.
     * @param string $id_campus, id del campus al que pertenece la sala de computo.
     * @param string $id_edificio, id del edificio al que pertenece la sala de computo.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la sala de computo.
     * @param string $capacidad, capacidad de la sala de computo.
     * @param string $punto_proyector, si la sala de computo tiene o no punto de proyector.
     * @return array
     */
    public function guardarSalaComputo($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red,$capacidad,$punto_proyector){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $capacidad = htmlspecialchars(trim($capacidad));
        $punto_proyector = htmlspecialchars(trim($punto_proyector));
        $sql = "INSERT INTO sala_computo (id_espacio,id_edificio,id_campus,puntos_red,capacidad,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."','".$capacidad."','".$punto_proyector."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala Computo 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala Computo 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece la oficina.
     * @param string $id_edificio, id del edificio al que pertenece la oficina.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la oficina.
     * @param string $punto_proyector, si la oficina tiene o no punto de proyector.
     * @return array
     */
    public function guardarOficina($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red,$punto_proyector){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $punto_proyector = htmlspecialchars(trim($punto_proyector));
        $sql = "INSERT INTO oficina (id_espacio,id_edificio,id_campus,puntos_red,punto_video_beam) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."','".$punto_proyector."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Oficina 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Oficina 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     */
    public function guardarBano($id_espacio,$id_campus,$id_edificio,$tipo_inodoro,$cantidad_inodoro,$tipo_orinal,$cantidad_orinal,$tipo_lavamanos,$cantidad_lavamanos,$ducha,$lavatraperos,$cantidad_sifon,$tipo_divisiones,$material_divisiones){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $tipo_inodoro = htmlspecialchars(trim($tipo_inodoro));
        $cantidad_inodoro = htmlspecialchars(trim($cantidad_inodoro));
        $ducha = htmlspecialchars(trim($ducha));
        $lavatraperos = htmlspecialchars(trim($lavatraperos));
        $cantidad_sifon = htmlspecialchars(trim($cantidad_sifon));
        $tipo_divisiones = htmlspecialchars(trim($tipo_divisiones));
        $material_divisiones = htmlspecialchars(trim($material_divisiones));
        $sql = "INSERT INTO oficina (id_espacio,id_edificio,id_campus,id_tipo_inodoro,cantidad_inodoro,ducha,lavatraperos,cantidad_sifon,id_tipo_divisiones,id_material_divisiones) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$tipo_inodoro."','".$cantidad_inodoro."','".$ducha."','".$lavatraperos."','".$cantidad_sifon."','".$tipo_divisiones."','".$material_divisiones."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Baño 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Baño 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_lavamanos);$i++) {
                    $this->guardarLavamanosBano($id_espacio,$id_campus,$id_edificio,$tipo_lavamanos[$i],$cantidad_lavamanos[$i]);
                }
                for ($i=0;$i<count($tipo_orinal);$i++) {
                    $this->guardarOrinalBano($id_espacio,$id_campus,$id_edificio,$tipo_orinal[$i],$cantidad_orinal[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una bodega.
     * @param string $id_espacio, id de la bodega.
     * @param string $id_campus, id del campus al que pertenece la bodega.
     * @param string $id_edificio, id del edificio al que pertenece la bodega.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la bodega.
     * @return array
     */
    public function guardarBodega($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO bodega (id_espacio,id_edificio,id_campus,puntos_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Bodega 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Bodega 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece la sala de estudio.
     * @param string $id_edificio, id del edificio al que pertenece la sala de estudio.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la sala de estudio.
     * @return array
     */
    public function guardarSalaEstudio($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO sala_estudio (id_espacio,id_edificio,id_campus,puntos_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala de Estudio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Sala de Estudio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el cuarto de plantas.
     * @param string $id_edificio, id del edificio al que pertenece el cuarto de plantas.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el cuarto de plantas.
     * @return array
     */
    public function guardarCuartoPlantas($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO cuarto_plantas (id_espacio,id_edificio,id_campus,puntos_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Plantas 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Plantas 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el cuarto de aires acondicionados.
     * @param string $id_edificio, id del edificio al que pertenece el cuarto de aires acondicionados.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el cuarto de aires acondicionados.
     * @return array
     */
    public function guardarCuartoAireAcondicionado($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO cuarto_aire_acondicionado (id_espacio,id_edificio,id_campus,puntos_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Aires Acondicionados 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Aires Acondicionados 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el área deportiva cerrada.
     * @param string $id_edificio, id del edificio al que pertenece el área deportiva cerrada.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el área deportiva cerrada.
     * @return array
     */
    public function guardarAreaDeportivaCerrada($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO area_deportiva_cerrada (id_espacio,id_edificio,id_campus,puntos_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Área Deportiva Cerrada 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Área Deportiva Cerrada 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el centro de datos.
     * @param string $id_edificio, id del edificio al que pertenece el centro de datos.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el centro de datos.
     * @return array
     */
    public function guardarCentroDatos($id_espacio,$id_campus,$id_edificio,$cantidad_punto_red){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_red = htmlspecialchars(trim($cantidad_punto_red));
        $sql = "INSERT INTO centro_datos (id_espacio,id_edificio,id_campus,puntos_red) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_red."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Centro de Datos 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Centro de Datos 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     * @param string $id_campus, id del campus al que pertenece el cuarto de bombas.
     * @param string $id_edificio, id del edificio al que pertenece el cuarto de bombas.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene el cuarto de bombas.
     * @return array
     */
    public function guardarCuartoBombas($id_espacio,$id_campus,$id_edificio,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $sql = "INSERT INTO cuarto_bombas (id_espacio,id_edificio,id_campus,cantidad_punto_hidraulico) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_hidraulico."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Bombas 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cuarto de Bombas 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_punto_sanitario);$i++) {
                    $this->guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario[$i],$cantidad_punto_sanitario[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite guardar la información de una cocineta.
     * @param string $id_espacio, id de la cocineta.
     * @param string $id_campus, id del campus al que pertenece la cocineta.
     * @param string $id_edificio, id del edificio al que pertenece la cocineta.
     * @param string $cantidad_punto_red, cantidad de puntos de red que tiene la cocineta.
     * @param string $tipo_punto_sanitario, tipo de punto sanitario que tiene la cocineta.
     * @param string $cantidad_punto_sanitario, cantidad de puntos sanitarios que tiene la cocineta
     * @return array
     */
    public function guardarCocineta($id_espacio,$id_campus,$id_edificio,$cantidad_punto_hidraulico,$tipo_punto_sanitario,$cantidad_punto_sanitario){
        $id_espacio = htmlspecialchars(trim($id_espacio));
        $id_campus = htmlspecialchars(trim($id_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $cantidad_punto_hidraulico = htmlspecialchars(trim($cantidad_punto_hidraulico));
        $sql = "INSERT INTO cocineta (id_espacio,id_edificio,id_campus,cantidad_punto_hidraulico) VALUES ('".$id_espacio."','".$id_edificio."','".$id_campus."','".$cantidad_punto_hidraulico."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Cocineta 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Cocineta 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                //$GLOBALS['mensaje'] = "El auditorio se guardó correctamente";
                for ($i=0;$i<count($tipo_punto_sanitario);$i++) {
                    $this->guardarPuntoSanitario($id_espacio,$id_campus,$id_edificio,$tipo_punto_sanitario[$i],$cantidad_punto_sanitario[$i]);
                }
                return true;
            }
        }
    }

    /**
     * Función que permite guardar un edificio.
     * @param string $tipo_material, tipo de material.
     * @param string $nombre_tipo_material, nombre del tipo de material.
     * @return array
     */
    public function guardarTipoMaterial($tipo_material,$nombre_tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $nombre_tipo_material = htmlspecialchars(trim($nombre_tipo_material));
        $sql = "INSERT INTO ".$tipo_material." (material) VALUES ('".$nombre_tipo_material."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Material 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Material 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     */
    public function guardarTipoObjeto($tipo_objeto,$nombre_tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $nombre_tipo_objeto = htmlspecialchars(trim($nombre_tipo_objeto));
        $sql = "INSERT INTO ".$tipo_objeto." (tipo) VALUES ('".$nombre_tipo_objeto."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Objeto 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Tipo Objeto 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
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
     */
    public function guardarPlanoCampus($id_sede,$id_campus,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = "/var/www/sistemas/archivos/planos/campus/".$id_sede."-".$id_campus."/";
            if (!file_exists($ruta.$foto['name'])) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO campus_archivos (id_sede,id_campus,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Campus 1)";
                    unlink($ruta.$plano['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Campus 2)";
                        unlink($ruta.$plano['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     */
    public function guardarFotoCampus($id_sede,$id_campus,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = "/var/www/sistemas/archivos/images/campus/".$id_sede."-".$id_campus."/";
            if (!file_exists($foto["name"], $ruta)) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO campus_archivos (id_sede,id_campus,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Campus 1)";
                    unlink($ruta.$foto['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Campus 2)";
                        unlink($ruta.$foto['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     */
    public function guardarPlanoEdificio($id_sede,$id_campus,$id_edificio,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = "/var/www/sistemas/archivos/planos/edificio/".$id_sede."-".$id_campus."-".$id_edificio."/";
            if (!file_exists($ruta.$foto['name'])) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                $id_edificio = htmlspecialchars(trim($id_edificio));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO edificio_archivos (id_sede,id_campus,id_edificio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Edificio 1)";
                    unlink($ruta.$plano['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Edificio 2)";
                        unlink($ruta.$plano['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     */
    public function guardarFotoEdificio($id_sede,$id_campus,$id_edificio,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = "/var/www/sistemas/archivos/images/edificio/".$id_sede."-".$id_campus."-".$id_edificio."/";
            if (!file_exists($ruta.$foto['name'])) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                $id_edificio = htmlspecialchars(trim($id_edificio));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO edificio_archivos (id_sede,id_campus,id_edificio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Edificio 1)";
                    unlink($ruta.$foto['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Edificio 2)";
                        unlink($ruta.$foto['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     */
    public function guardarPlanoGradas($id_sede,$id_campus,$id_edificio,$piso,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = "/var/www/html/sistemas/archivos/planos/gradas/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."/";
            if (!file_exists($ruta.$foto['name'])) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                $id_edificio = htmlspecialchars(trim($id_edificio));
                $piso = htmlspecialchars(trim($piso));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO gradas_archivos (id_sede,id_campus,id_edificio,piso,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Gradas 1)";
                    unlink($ruta.$plano['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Gradas 2)";
                        unlink($ruta.$plano['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     */
    public function guardarFotoGradas($id_sede,$id_campus,$id_edificio,$piso,$foto){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = "/var/www/html/sistemas/archivos/images/gradas/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."/";
            if (!file_exists($ruta.$foto['name'])) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                $id_edificio = htmlspecialchars(trim($id_edificio));
                $piso = htmlspecialchars(trim($piso));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO gradas_archivos (id_sede,id_campus,id_edificio,piso,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$foto['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Gradas 1)";
                    unlink($ruta.$foto['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Gradas 2)";
                        unlink($ruta.$foto['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     * @param string $piso, variable con la información del piso.
     * @param string $id_espacio, variable con la información del espacio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
     */
    public function guardarPlanoEspacio($id_sede,$id_campus,$id_edificio,$piso,$espacio,$plano){
        if ($plano['error'] == UPLOAD_ERR_OK) {
            $plano['name'] = str_replace(" ", "",$plano['name']);
            $ruta = "/var/www/sistemas/archivos/planos/espacio/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."-".$id_espacio."/";
            if (!file_exists($ruta.$foto['name'])) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                $id_edificio = htmlspecialchars(trim($id_edificio));
                $piso = htmlspecialchars(trim($piso));
                $espacio = htmlspecialchars(trim($espacio));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($plano["tmp_name"], $ruta.$plano['name']);
                $sql = "INSERT INTO espacio_archivos (id_sede,id_campus,id_edificio,piso,id_espacio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$id_espacio."','".$plano['name']."','plano');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Espacio 1)";
                    unlink($ruta.$plano['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Plano-Espacio 2)";
                        unlink($ruta.$plano['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     * @param string $piso, variable con la información del piso.
     * @param string $id_espacio, variable con la información del espacio.
     * @param file $plano, variable con la información del plano a guardar.
     * @return array
     */
    public function guardarFotoEspacio($id_sede,$id_campus,$id_edificio,$piso,$espacio,$plano){
        if ($foto['error'] == UPLOAD_ERR_OK) {
            $foto['name'] = str_replace(" ", "",$foto['name']);
            $ruta = "/var/www/sistemas/archivos/planos/espacio/".$id_sede."-".$id_campus."-".$id_edificio."-".$piso."-".$id_espacio."/";
            if (!file_exists($foto["name"], $ruta)) {
                $id_sede = htmlspecialchars(trim($id_sede));
                $id_campus = htmlspecialchars(trim($id_campus));
                $id_edificio = htmlspecialchars(trim($id_edificio));
                $piso = htmlspecialchars(trim($piso));
                $espacio = htmlspecialchars(trim($espacio));
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                move_uploaded_file($foto["tmp_name"], $ruta.$foto['name']);
                $sql = "INSERT INTO espacio_archivos (id_sede,id_campus,id_edificio,piso,id_espacio,nombre,tipo) VALUES ('".$id_sede."','".$id_campus."','".$id_edificio."','".$piso."','".$id_espacio."','".$plano['name']."','foto');";
                $l_stmt = $this->conexion->prepare($sql);
                if(!$l_stmt){
                    $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Espacio 1)";
                    unlink($ruta.$foto['name']);
                    //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                    return false;
                }else{
                    if(!$l_stmt->execute()){
                        $GLOBALS['mensaje'] = "Error: SQL (Guardar Foto-Espacio 2)";
                        unlink($ruta.$foto['name']);
                        //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                        return false;
                    }else{
                        $GLOBALS['mensaje'] = 'El archivo se ha guardado correctamente';
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
     * Función que permite consultar si una sede ya esta registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede.
     * @return array
     */
    public function verificarSede($nombre_sede){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $sql = "SELECT * FROM sede WHERE nombre = '".$nombre_sede."'";
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
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "La sede ya se encuentra registrada en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un campus ya esta registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el campus.
     * @param string $nombre_campus, nombre del campus.
     * @return array
     */
    public function verificarCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT * FROM campus WHERE sede = '".$nombre_sede."' AND nombre = '".$nombre_campus."'";
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
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El campus ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya esta registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el edificio.
     * @param string $nombre_campus, nombre del campus al que pertenece el edificio.
     * @param string $id_edificio, id del edificio.
     * @return array
     */
    public function verificarEdificio($nombre_sede,$nombre_campus,$id_edificio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $id_edificio = htmlspecialchars(trim($id_edificio));
        $sql = "SELECT * FROM edificio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id = '".$id_edificio."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Edificio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Edificio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El edificio ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya esta registrada en el sistema.
     * @param string $nombre_sede, id de la sede a la que pertenece el edificio.
     * @param string $nombre_campus, id del campus al que pertenece el edificio.
     * @param string $nombre_edificio, id del edificio.
     * @param string $piso, piso donde inician las gradas.
     * @return array
     */
    public function verificarGradas($nombre_sede,$nombre_campus,$nombre_edificio,$piso){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $sql = "SELECT * FROM gradas WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_inicio = '".$piso."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Gradas 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Gradas 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "Las gradas del piso ".$piso." del edificio ".$nombre_edificio." ya se encuentran registradas en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya esta registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el espacio.
     * @param string $nombre_campus, nombre del campus al que pertenece el espacio.
     * @param string $nombre_edificio, nombre del edificio al que pertenece el espacio.
     * @param string $piso, piso del edificio donde se encuentra el espacio
     * @param string $numero_espacio, número del espacio.
     * @return array
     */
    public function verificarEspacio($nombre_sede,$nombre_campus,$nombre_edificio,$piso,$numero_espacio){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $nombre_edificio = htmlspecialchars(trim($nombre_edificio));
        $piso = htmlspecialchars(trim($piso));
        $numero_espacio = htmlspecialchars(trim($numero_espacio));
        $sql = "SELECT * FROM espacio WHERE id_sede = '".$nombre_sede."' AND id_campus = '".$nombre_campus."' AND id_edificio = '".$nombre_edificio."' AND piso_edificio = '".$piso."' AND id = '".$numero_espacio."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Espacio 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Espacio 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El espacio ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya esta registrada en el sistema.
     * @param string $tipo_material, tipo de material.
     * @param string $nombre_tipo_material, nombre del tipo de material.
     * @return array
     */
    public function verificarTipoMaterial($tipo_material,$nombre_tipo_material){
        $tipo_material = htmlspecialchars(trim($tipo_material));
        $nombre_tipo_material = htmlspecialchars(trim($nombre_tipo_material));
        $sql = "SELECT * FROM ".$tipo_material." WHERE material = '".$nombre_tipo_material."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Material 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Material 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El tipo de material ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar si un edificio ya esta registrada en el sistema.
     * @param string $tipo_material, tipo de objeto.
     * @param string $nombre_tipo_material, nombre del tipo de objeto.
     * @return array
     */
    public function verificarTipoObjeto($tipo_objeto,$nombre_tipo_objeto){
        $tipo_objeto = htmlspecialchars(trim($tipo_objeto));
        $nombre_tipo_objeto = htmlspecialchars(trim($nombre_tipo_objeto));
        $sql = "SELECT * FROM ".$tipo_objeto." WHERE tipo = '".$nombre_tipo_objeto."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Objeto 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Tipo Objeto 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El tipo de objeto ya se encuentra registrado en el sistema";
                return false;
            }
            else{
                return true;
            }
        }
    }

    /**
     * Función que permite consultar el id de un campus ya esta registrada en el sistema.
     * @param string $nombre_sede, nombre de la sede a la que pertenece el campus.
     * @param string $nombre_campus, nombre del campus.
     * @return array
     */
    public function obtenerIdCampus($nombre_sede,$nombre_campus){
        $nombre_sede = htmlspecialchars(trim($nombre_sede));
        $nombre_campus = htmlspecialchars(trim($nombre_campus));
        $sql = "SELECT id FROM campus WHERE sede = '".$nombre_sede."' AND nombre = '".$nombre_campus."'";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Obtener Id Campus 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Obtener Id Campus 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            }elseif($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
            }
            return $result;
        }
    }
}
?>
