<?php
/**
 * Clase modelo de consultas
 */
class Modelo_consultas
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
    public function __construct($dbname,$dbuser,$dbpass,$dbhost) {
        
        $conn_string = 'pgsql:host='.$dbhost.';port=5432;dbname='.$dbname;
        
        try { 
            $bd_conexion = new PDO($conn_string, $dbuser, $dbpass); 
            $this->conexion = $bd_conexion;  
            
        } catch (PDOException $e) {
            var_dump( $e->getMessage());
        }       
    }
    
    /**
     * Función que permite buscar ordenes en el sistema utilizando el nombre
     * de este.
     * @param strig $n, palabra clave.
     * @return array
     */
    public function buscarOrdenesPorNombre($n)
    {
        $n = htmlspecialchars(trim($n));
        //$n = ucwords($n);

        /*$usuario = $this->getLoginUsuario($n);
        $dato = $usuario[0];*/

        //$sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado = 'Solicitado' AND usuario = '".$dato."' ORDER BY numero_solicitud;";
		  $sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND usuario = '".$n."' ORDER BY numero_solicitud;";      
        
        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta con el nombre de usuario que ingreso";
            }              
        } 
        
        return $result;
    } 
    
    /**
     * Función que permite consultar una orden en el sistema por medio de su
     * serial.
     * @param numerico $k, Entero que hace referencia al serial de la orden
     */
    public function buscarOrdenesPorKey($k)
    {
        $k = htmlspecialchars(trim($k));

        //$sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado = 'Solicitado' AND numero_solicitud = '".$k."' ORDER BY numero_solicitud;";
		  $sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND numero_solicitud = '".$k."' ORDER BY numero_solicitud;";       
       
        $l_stmt = $this->conexion->prepare($sql);
        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }           
        } 
        
        return $result;
    }
    
    /**
     * Función que permite consultar el historial de ordenes de un usuario
     */
    public function buscarBDHistorial($u)
    {
        $u = htmlspecialchars(trim($u));

        
		  $sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND usuario = '".$u."' ORDER BY numero_solicitud DESC;";       
       
        $l_stmt = $this->conexion->prepare($sql);
        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No tiene órdenes registradas aun";
            }           
        } 
        
        return $result;
    }
    
	 /**
     * Función que permite consultar el historial de ordenes de un usuario
     */
    public function buscarOrdenesSistema($u)
    {
        $u = htmlspecialchars(trim($u));

        if($u == 0){
        		$sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
        }else{
        		$sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.estado <> 'Eliminado' AND novedad_sistema.cod_sistema = '".$u."' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
        }
        $l_stmt = $this->conexion->prepare($sql);
        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No tiene órdenes registradas aun";
            }           
        } 
        
        return $result;
    }

     /**
     * Función que permite consultar el historial de ordenes de un usuario
     */
    public function buscarOrdenesSistemaCampus($u, $c)
    {
        $u = htmlspecialchars(trim($u));
        $c = htmlspecialchars(trim($c));

        if($u == 0){
                $sql = "SELECT * FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
        }else{
                $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.estado <> 'Eliminado' AND novedad_sistema.cod_sistema = '".$u."' AND solicitudes_mantenimiento.codigo_campus = '".$c."' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";       
        }
        $l_stmt = $this->conexion->prepare($sql);
        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No tiene órdenes registradas aun";
            }           
        } 
        
        return $result;
    }

    /**
     * Función que permite buscar ordenes en el sistema utilizando el nombre
     * de este.
     * @param string $c, campus seleccionado.
     * @param string $S, codigo del sistema de la orden/solicitud
     * @param string $f, fecha que selecciono el usuario
     * @return array Resulset con los parametros de la busqueda
     */
    public function buscarOrdenesParametros($c, $s, $fi, $ff)
    {
        $c = htmlspecialchars(trim($c));
        $s = htmlspecialchars(trim($s));
        $fi = htmlspecialchars(trim($fi));
        $ff = htmlspecialchars(trim($ff));

        if($c == 4){
            if($s == 5){
                $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' ORDER BY numero_solicitud;";
            }else{
                $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' ORDER BY solicitudes_mantenimiento.numero_solicitud;";
            }            
        }else{
            if($s == 5){
                $sql = "SELECT * FROM solicitudes_mantenimiento WHERE codigo_campus = '".$c."' AND fecha BETWEEN '".$fi."' AND '".$ff."' ORDER BY numero_solicitud;";
            }else{
                $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.codigo_campus = '".$c."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' ORDER BY solicitudes_mantenimiento.numero_solicitud;";
            }            
        }                
        

        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }              
        } 
        
        return $result;
    }
    
    /**
     * Función que permite obtener los edificios con más solicitudes.
     * @return array Resulset con los parametros de la busqueda
     */
    public function buscarEdificiosMasSolicitudes($campus, $sistema, $fechaInicio, $fechaFin)
    {
        $campus = htmlspecialchars(trim($campus));
        $sistema = htmlspecialchars(trim($sistema));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
                
        if($sistema == 5){
            $sql = "SELECT codigo_edificio, COUNT(*) AS conteosolicitudes FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND codigo_campus = '".$campus."' AND fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' GROUP BY codigo_edificio ORDER BY conteosolicitudes DESC LIMIT 10;";
        }else{
            $sql = "SELECT solicitudes_mantenimiento.codigo_edificio, COUNT(*) AS conteosolicitudes FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.estado <> 'Eliminado' AND solicitudes_mantenimiento.codigo_campus = '".$campus."' AND novedad_sistema.cod_sistema = '".$sistema."' AND solicitudes_mantenimiento.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' GROUP BY solicitudes_mantenimiento.codigo_edificio ORDER BY conteosolicitudes DESC LIMIT 10;";
        }

        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Edificios con más solicitudes asociadas";
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }              
        } 
        
        return $result;
    }

    /**
     * Función que permite obtener los edificios con más solicitudes.
     * @return array Resulset con los parametros de la busqueda
     */
    public function buscarEstadisticasSistemas($campus, $sistema, $fechaInicio, $fechaFin)
    {

        $campus = htmlspecialchars(trim($campus));
        $sistema = htmlspecialchars(trim($sistema));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        
        if($sistema == 5){
            $sql = "SELECT estado, count(*) AS conteosolicitudes FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND codigo_campus = '".$campus."' AND fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' GROUP BY estado ORDER BY estado DESC;";
        }else{
            $sql = "SELECT solicitudes_mantenimiento.estado, count(*) AS conteosolicitudes FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.estado <> 'Eliminado' AND solicitudes_mantenimiento.codigo_campus = '".$campus."' AND novedad_sistema.cod_sistema = '".$sistema."' AND solicitudes_mantenimiento.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' GROUP BY solicitudes_mantenimiento.estado ORDER BY estado DESC;";
        }  
          
        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Estado órdenes sistema";
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }              
        } 
        
        return $result;
    }

    /**
     * Función que permite obtener los edificios con más solicitudes.
     * @return array Resulset con los parametros de la busqueda
     */
    public function buscarEspaciosMasSolicitudes($campus, $sistema, $fechaInicio, $fechaFin)
    {

        $campus = htmlspecialchars(trim($campus));
        $sistema = htmlspecialchars(trim($sistema));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        
        if($sistema == 5){
            $sql = "SELECT codigo_edificio, espacio, COUNT(*) AS conteosolicitudes FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND codigo_campus = '".$campus."' AND fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' GROUP BY codigo_edificio, espacio ORDER BY conteosolicitudes DESC LIMIT 10;";
        }else{
            $sql = "SELECT solicitudes_mantenimiento.codigo_edificio, solicitudes_mantenimiento.espacio, COUNT(*) AS conteosolicitudes FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.estado <> 'Eliminado' AND solicitudes_mantenimiento.codigo_campus = '".$campus."' AND novedad_sistema.cod_sistema = '".$sistema."' AND solicitudes_mantenimiento.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' GROUP BY solicitudes_mantenimiento.codigo_edificio, solicitudes_mantenimiento.espacio ORDER BY conteosolicitudes DESC LIMIT 10;";
        }
          
        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Espacios con más solicitudes asociadas";
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }              
        } 
        
        return $result;
    }

    /**
     * Función que permite obtener los edificios con más solicitudes.
     * @return array Resulset con los parametros de la busqueda
     */
    public function buscarEstadisticasOperador($campus, $sistema, $fechaInicio, $fechaFin)
    {

        $campus = htmlspecialchars(trim($campus));
        $sistema = htmlspecialchars(trim($sistema));
        $fechaInicio = htmlspecialchars(trim($fechaInicio));
        $fechaFin = htmlspecialchars(trim($fechaFin));
        
        if($sistema == 5){
            $sql = "SELECT operario, COUNT(*) AS conteosolicitudes FROM solicitudes_mantenimiento WHERE estado <> 'Eliminado' AND codigo_campus = '".$campus."' AND fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND operario <> 'NULL' GROUP BY operario ORDER BY operario DESC;";
        }else{
            $sql = "SELECT solicitudes_mantenimiento.operario, COUNT(*) AS conteosolicitudes FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.estado <> 'Eliminado' AND solicitudes_mantenimiento.codigo_campus = '".$campus."' AND novedad_sistema.cod_sistema = '".$sistema."' AND solicitudes_mantenimiento.fecha BETWEEN '".$fechaInicio."' AND '".$fechaFin."' AND operario <> 'NULL' GROUP BY solicitudes_mantenimiento.operario ORDER BY operario DESC;";
        }
          
        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Ordenes Realizadas por Operador";
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }              
        } 
        
        return $result;
    }

    /**
     * Funcion que permite buscar una orden/solicitud por parametros avanzados campus, edificio, sistema, rango fecha inicio-fecha Final
     * @param  [string] $c, hace referencia a la campus seleccionado.
     * @param  [string] $e, hace referencia al edificio seleccionado.
     * @param  [string] $s, hace referenica al sistema seleccionado.
     * @param  [string] $fi, hace referencia a la fecha inicial seleccionada
     * @param  [string] $ff, hace referencia a la fecha final seleccionada
     * @return [array] Un array con los parametros resultantes de la busqueda
     */
    public function buscarOrdenesParametrosAvanzados($c, $e, $s, $p, $fi, $ff){
        $c = htmlspecialchars(trim($c));
        $e = htmlspecialchars(trim($e));
        $s = htmlspecialchars(trim($s));
        $p = htmlspecialchars(trim($p));
        $fi = htmlspecialchars(trim($fi));
        $ff = htmlspecialchars(trim($ff));
        
        if($c == -1){
            if($e == "TODOS"){
                if($s == 5){
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND piso = '".$p."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }
                }else{
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.piso = '".$p."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }
                }
            }else {
                if($s == 5){
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND codigo_edificio = '".$e."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND piso = '".$p."' AND codigo_edificio = '".$e."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }
                }else{
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.codigo_edificio = '".$e."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.piso = '".$p."' AND solicitudes_mantenimiento.codigo_edificio = '".$e."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }
                }
    		}
        }else{
            if($e == "TODOS"){
                if($s == 5){
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND codigo_campus = '".$c."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND codigo_campus = '".$c."' AND piso = '".$p."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }
                }else{
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.codigo_campus = '".$c."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.codigo_campus = '".$c."' AND solicitudes_mantenimiento.piso = '".$p."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }
                }
            }else {
                if($s == 5){
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND codigo_campus = '".$c."' AND codigo_edificio = '".$e."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento WHERE fecha BETWEEN '".$fi."' AND '".$ff."' AND codigo_campus = '".$c."' AND piso = '".$p."' AND codigo_edificio = '".$e."' AND estado <> 'Eliminado' ORDER BY numero_solicitud DESC;";
                    }
                }else{
                    if($p == -1){
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.codigo_campus = '".$c."' AND solicitudes_mantenimiento.codigo_edificio = '".$e."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }else{
                        $sql = "SELECT * FROM solicitudes_mantenimiento JOIN novedad_sistema ON solicitudes_mantenimiento.descripcion1 = novedad_sistema.id WHERE solicitudes_mantenimiento.fecha BETWEEN '".$fi."' AND '".$ff."' AND solicitudes_mantenimiento.codigo_campus = '".$c."' AND solicitudes_mantenimiento.piso = '".$p."' AND solicitudes_mantenimiento.codigo_edificio = '".$e."' AND novedad_sistema.cod_sistema = '".$s."' AND solicitudes_mantenimiento.estado <> 'Eliminado' ORDER BY solicitudes_mantenimiento.numero_solicitud DESC;";
                    }
                }
            }
        }
        $l_stmt = $this->conexion->prepare($sql);

        if (!$l_stmt)
        {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
        }
        else
        {
            if(!$l_stmt->execute())
            {
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }

            if($l_stmt->rowCount() > 0)
            {
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }              
        } 
        
        return $result;
    }

    /**
     * funcion que devuelve el nombre del edificio dado su codigo y campus asociado
     * @param  [integer] $c [Hace referencia al codigo del campus]
     * @param  [integer] $e [hace referencia al codigo del edificio]
     * @return [array]    [Informacion del edificio]
     */
    public function getNombreEdificio($c,$e){
        $e = htmlspecialchars(trim($e));
        $c = htmlspecialchars(trim($c));

        if($c == 1)
        {
            $sql = "SELECT * FROM edificiomelendez WHERE codigo = '".$e."';";
            $l_stmt = $this->conexion->prepare($sql);
            if (!$l_stmt){
                $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            }
            else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA."Edif";
                }
                if($l_stmt->rowCount() > 0)
                {
                    $result = $l_stmt->fetchAll();
                    $GLOBALS['mensaje'] = "Exito";
                }
                else
                {
                    $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
                }  
            }
           
        }
        if($c == 2){
            $sql = "SELECT * FROM edifsanfernando WHERE codigo = '".$e."';";
            $l_stmt = $this->conexion->prepare($sql);
            if (!$l_stmt){
                $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            }
            else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA."Edif";
                }

                if($l_stmt->rowCount() > 0)
                {
                    $result = $l_stmt->fetchAll();
                    $GLOBALS['mensaje'] = "Exito";
                }
                else
                {
                    $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
                }  
            }
           
        }
        if($c == 3){
            $sql = "SELECT * FROM otrosespacios WHERE codigo = '".$e."';";
            $l_stmt = $this->conexion->prepare($sql);
            if (!$l_stmt){
                $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            }
            else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA."Edif";
                }

                if($l_stmt->rowCount() > 0)
                {
                    $result = $l_stmt->fetchAll();
                    $GLOBALS['mensaje'] = "Exito";
                }
                else
                {
                    $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
                }  
            }
            
        }

        return $result;    
    }

    /**
     * [Funcion que obtiene el nombre de la novedad]
     * @param  [integer] $n [Hace referencia al identificador de la novedad]
     * @return [type]    [description]
     */
    public function getNombreNovedad($n){
        $n = htmlspecialchars(trim($n));

        $sql = "SELECT novedad FROM novedad_sistema WHERE id = '".$n."';";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt){
            //$GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA."Novedad";
        }
        else{
            if(!$l_stmt->execute()){
                //$GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA."Novedad";
            }

            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                //$GLOBALS['mensaje'] = "Exito";
            }
            else{
                $result['0'] = "";
            }
        }

        return $result;
    }

    public function buscarUsuario($l){
        $l = htmlspecialchars($l);

        $sql = "SELECT nombre_usuario,telefono,extension,correo FROM usuarios_autorizados_sistema WHERE login = '".$l."' LIMIT 1;";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt){
            $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);;
        }
        else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);;
            }

            if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetchAll();
                $GLOBALS['mensaje'] = "Exito";
            }
            else
            {
                $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
            }  
        }

        return $result;
    }

    /**
     * funcion quer permite buscar los edificios de la sede melendes
     * @param  [int] $p hace referencia al codigo del campus 01==melendez,02==San fernando,03==Otros
     * @return [ResultSet] contiene la informacion de la busqueda.
     */
    public function buscarDBEdificio($p){

        $p = htmlspecialchars(trim($p));

        if($p == 01)
        {
            $sql = "SELECT * FROM edificiomelendez ORDER BY codigo;";
            $l_stmt = $this->conexion->prepare($sql);
            if (!$l_stmt){
                $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            }
            else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
                }

                if($l_stmt->rowCount() > 0)
                {
                    $result = $l_stmt->fetchAll();
                    $GLOBALS['mensaje'] = "Exito";
                }
                else
                {
                    $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
                }  
            }
           
        }
        if($p == 02){
            $sql = "SELECT * FROM edifsanfernando ORDER BY codigo;";
            $l_stmt = $this->conexion->prepare($sql);
            if (!$l_stmt){
                $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            }
            else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
                }

                if($l_stmt->rowCount() > 0)
                {
                    $result = $l_stmt->fetchAll();
                    $GLOBALS['mensaje'] = "Exito";
                }
                else
                {
                    $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
                }  
            }
           
        }
        if($p == 03){
            $sql = "SELECT * FROM otrosespacios ORDER BY codigo;";
            $l_stmt = $this->conexion->prepare($sql);
            if (!$l_stmt){
                $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            }
            else{
                if(!$l_stmt->execute()){
                    $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
                }

                if($l_stmt->rowCount() > 0)
                {
                    $result = $l_stmt->fetchAll();
                    $GLOBALS['mensaje'] = "Exito";
                }
                else
                {
                    $GLOBALS['mensaje'] = "No hay registro asociado a su consulta";
                }  
            }
            
        }

        return $result;    
    }

    /**
     * funcion que permite obtener el login del usuario 
     * @return $dato. Hace referencia a el nombre del usuario
     */
    public function getLoginUsuario($dato)
    {

        $parametro = htmlspecialchars(trim($dato));
        $parametro = mb_convert_case($parametro,MB_CASE_TITLE,"utf8");

        $sql = "SELECT login FROM usuarios_autorizados_sistema WHERE nombre_usuario = '".$parametro."';";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt->execute()){
           $GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
        }
        
        if($l_stmt->rowCount() > 0){
            $result = $l_stmt->fetchAll();
        }

        $data = $result[0];

        return $data;
    }
    
    /**
     * funcion que permite obtener el login del usuario 
     * @return $dato. Hace referencia a el nombre del usuario
     */
    public function getTipoUsuario($dato)
    {

        $parametro = htmlspecialchars(trim($dato));

        $sql = "SELECT perfil FROM usuarios_autorizados_sistema WHERE login = '".$parametro."' LIMIT 1;";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt->execute()){
           $GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
        }
        
        if($l_stmt->rowCount() > 0){
            $result = $l_stmt->fetchAll();
        }

        $data = $result[0];

        return $data;
    }
    
	  /**
     * funcion que actualiza el campo impreso de una orden
     */
    public function actualizarImpresoSi($dato)
    {

        $parametro = htmlspecialchars(trim($dato));

        //$sql = "UPDATE solicitudes_mantenimiento SET impreso = 'Si' WHERE numero_solicitud = '".$parametro."';";

        $sql = "UPDATE solicitudes_mantenimiento SET impreso = impreso + 1 WHERE numero_solicitud = '".$parametro."';";

        $l_stmt = $this->conexion->prepare($sql);

        if(!$l_stmt->execute()){
           return true;
        }
        return false;
    }
    
}
?>
