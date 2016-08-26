<?php
include_once('class.phpmailer.php');
include_once('class.smtp.php');
class modelo_usuario {
    protected $conexion;

    /**
     * Función contructura de la clase Modelo_usuario.
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
            
        }catch (PDOException $e) {
            var_dump( $e->getMessage());
        }
    }

    /**
     * Función que retorna la contraseña se un usuario por medio de su login.
     * @param string $l, Login del usuario a consultar.
     * @return boolean
     */
    function retornarContrasena($l) {
        $l = htmlspecialchars($l);
        $sql = "SELECT password FROM usuarios WHERE login = '".$l."';";
        $l_stmt = $this->conexion->prepare($sql);
        if (!$l_stmt) {
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;
            return false;
        }else {
            if(!$l_stmt->execute()) { 
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
                return false;
            }if($l_stmt->rowCount() > 0){
                $result = $l_stmt->fetch(PDO::FETCH_NUM);
            }
        }
        return $result[0];
    }    
    
    /**
     * funcion que encripta la constraseña del usuario usando el metodo md5
     * @param  [type] $password [description]
     * @return [type]           [description]
     */
    public function encriptarPassword($password) {       
        //return crypt($password, Config::$salt);
        return md5($password);
    }

    /**
     * Función que verifica si la contraseña digitada por el usuario es correcta
     * o no.
     * @param string $linput, login que digito el usuario.
     * @param string $cinput, password que digito el usuario.
     * @return boolean
     */
    public function verificarContrasena($linput, $cinput) {
        $passwdBd = $this->retornarContrasena($linput);        
        if (md5($cinput) == $passwdBd) {
            return true;
        } 
        else {
            return false;
        }
    }

    /**
     * Función que permite comprobar si un determinado usuario tiene acceso o 
     * no al sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
     * @param string $password, Cadena que hace referencia al login del usuario.
    */
    public function comprobarAcceso($login, $password) {
        $login = htmlspecialchars($login);
        $login = strtolower($login);        
        if(!$this->verificarContrasena($login, $password)){
            $GLOBALS['mensaje'] = MJ_ERROR_CONTRASENA_INCORRECTA;
            return;
        }        
        $password = $this->retornarContrasena($login);        
        $sql = "SELECT * FROM usuarios WHERE login = '".$login."' AND password = '".$password."' AND estado = 'ACTIVO';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA;            
        }else{
            if(!$l_stmt->execute()){ 
                $GLOBALS['mensaje'] = MJ_CONSULTA_FALLIDA;
            }if($l_stmt->rowCount() > 0){ 
                $result = $l_stmt->fetchAll(); 
            }             
        }
        $GLOBALS['mensaje'] = MJ_CONSULTA_EXITOSA;
        return $result[0];
    }

    /**
     * Función que actualiza el último acceso de un usuario.
     * @param string $login, Cadena que hace referencia al login del usuario.
    */
    public function actualizarUltimoAcceso($login){
        $fecha = date("Y-m-d H:i:s");
        $sql = "UPDATE usuarios SET ultimo_acceso = '".$fecha."' WHERE login = '".$login."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            /*$GLOBALS['mensaje'] = MJ_PREPARAR_CONSULTA_FALLIDA." "
                        .MJ_ACTUALIZACION_USUARIO_FALLIDA;*/
            return false;
        }else{
            if(!$l_stmt->execute()){
                /*$GLOBALS['mensaje'] = MJ_ACTUALIZACION_FALLIDA." "
                        .MJ_ACTUALIZACION_USUARIO_FALLIDA;*/
                return false;
            }
        }
        //$GLOBALS['mensaje'] = MJ_ACTUALIZACION_USUARIO_EXITOSA;
        return true;
    }

    /**
     * Función que permite crear un usuario 
     * en el sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
    */
    public function guardarUsuario($nombre,$login,$correo,$telefono,$extension,$contrasenia,$mod_planta,$mod_inventario,$mod_aires,$creacion_planta,$creacion_inventario,$creacion_aires,$perfil){
        $nombre = htmlspecialchars(trim($nombre));
        $login = htmlspecialchars(trim($login));
        $correo = htmlspecialchars(trim($correo));
        $telefono = htmlspecialchars(trim($telefono));
        $extension = htmlspecialchars(trim($extension));
        $contrasenia = $this->encriptarPassword(htmlspecialchars(trim($contrasenia)));
        $mod_planta = htmlspecialchars(trim($mod_planta));
        $mod_inventario = htmlspecialchars(trim($mod_inventario));
        $mod_aires = htmlspecialchars(trim($mod_aires));
        $creacion_planta = htmlspecialchars(trim($creacion_planta));
        $creacion_inventario = htmlspecialchars(trim($creacion_inventario));
        $creacion_aires = htmlspecialchars(trim($creacion_aires));
        $perfil = htmlspecialchars(trim($perfil));
        $sql = "INSERT INTO usuarios (nombre_usuario,login,correo,telefono,extension,password,modulo_planta,modulo_inventario,modulo_aires,creacion_planta,creacion_inventario,creacion_aires,perfil) VALUES 
        ('".$nombre."','".$login."','".$correo."','".$telefono."','".$extension."','".$contrasenia."','".$mod_planta."','".$mod_inventario."','".$mod_aires."','".$creacion_planta."','".$creacion_inventario."','".$creacion_aires."','".$perfil."');";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Guardar Usuario 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Guardar Usuario 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "El usuario se creó correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite crear un usuario 
     * en el sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
    */
    public function modificarUsuario($nombre_usuario,$login,$correo,$telefono,$extension){
        $nombre_usuario = htmlspecialchars(trim($nombre_usuario));
        $login = htmlspecialchars(trim($login));
        $correo = htmlspecialchars(trim($correo));
        $telefono = htmlspecialchars(trim($telefono));
        $extension = htmlspecialchars(trim($extension));
        $sql = "UPDATE usuarios SET nombre_usuario = '".$nombre_usuario."', correo = '".$correo."', telefono = '".$telefono."', extension = '".$extension."' WHERE login = '".$login."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Usuario 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Usuario 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "Los cambios se guardaron correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite crear un usuario 
     * en el sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
     * @param string $contrasenia, Cadena que hace referencia a la nueva contraseña.
    */
    public function modificarContrasenia($login,$contrasenia){
        $login = htmlspecialchars(trim($login));
        $contrasenia = $this->encriptarPassword(htmlspecialchars(trim($contrasenia)));
        $sql = "UPDATE usuarios SET password = '".$contrasenia."' WHERE login = '".$login."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Modificar Contraseña 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Modificar Contraseña 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                $GLOBALS['mensaje'] = "La contaseña se cambió correctamente";
                return true;
            }
        }
    }

    /**
     * Función que permite crear un usuario 
     * en el sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
    */
    public function reestablecerContrasenia($correo){
        $correo = htmlspecialchars(trim($correo));
        $source = 'abcdefghijklmnopqrstuvwxyz';
        $source .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $source .= '1234567890';
        $rstr = "";
        $source = str_split($source,1);
        for($i=1; $i<=10; $i++){
            mt_srand((double)microtime() * 1000000);
            $num = mt_rand(1,count($source));
            $rstr .= $source[$num-1];
        }
        $c = md5($rstr);
        $mail = new PHPMailer();             
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "ssl";
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';
        $email = 'mantenimiento.univalle@gmail.com';
        $pass = 'ManteUnivalle';
        $mail->Username = $email;
        $mail->Password = $pass; //Su password
        $mail->From = $email;
        $mail->Sender = $email;
        $mail->FromName= 'Mantenimiento Universidad del Valle';
        //Agregar destinatario
        $mail->AddAddress($correo);
        $mail->Subject = 'Reestablecer contraseña de acceso al sistema';
        $mail->Body = 'Se ha solicitado reestablecer la contraseña de la cuenta vinculada a este correo, para ingresar utilice esta contraseña temporal: '.$rstr.' y a continuación proceda a cambiar la contraseña."';
        $sql = "UPDATE usuarios SET password = '".$c."' WHERE correo = '".$correo."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Reestablecer Contraseña 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Reestablecer Contraseña 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }else{
                try{
                    $mail->Send();
                }catch(phpmailerException $e){
                    //return $e->errorMessage();
                }catch(Exception $e){
                    //return $e->getMessage();
                }
                $GLOBALS['mensaje'] = "Se ha enviado un correo a ".$correo." con la información para reestablecer la contraseña";
                return true;
            }
        }
    }

    /**
     * Función que permite comprobar si un login ya se 
     * encuentra registrado en el sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
    */
    public function verificarUsuario($login){
        $login = htmlspecialchars(trim($login));
        $sql = "SELECT * FROM usuarios WHERE login = '".$login."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Usuario 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Usuario 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El usuario ya se encuentra registrado en el sistema";
                return false;
            }else{
                return true;
            }
        }
    }

    /**
     * Función que permite comprobar si un correo ya se 
     * encuentra registrado en el sistema.
     * @param string $login, Cadena que hace referencia al login del usuario.
    */
    public function verificarCorreo($correo){
        $correo = htmlspecialchars(trim($correo));
        $sql = "SELECT * FROM usuarios WHERE correo = '".$correo."';";
        $l_stmt = $this->conexion->prepare($sql);
        if(!$l_stmt){
            $GLOBALS['mensaje'] = "Error: SQL (Verificar Correo 1)";
            //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
            return false;
        }else{
            if(!$l_stmt->execute()){
                $GLOBALS['mensaje'] = "Error: SQL (Verificar Correo 2)";
                //$GLOBALS['mensaje'] = var_export($this->conexion->errorInfo(),true);
                return false;
            }elseif($l_stmt->rowCount() > 0){
                $GLOBALS['mensaje'] = "El correo ya se encuentra registrado en el sistema";
                return false;
            }else{
                return true;
            }
        }
    }
}
?>