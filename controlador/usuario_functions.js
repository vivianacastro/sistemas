$(document).ready(function() {

	var URLactual = window.location;
    if(URLactual['href'].indexOf('informacion_usuario') >= 0){
        llenarInformacionUsuario("informacion");
    }

	/**
     * Función que permite crear un usuario
     * @param {array} consulta, información de la sede
     * @returns {data}
     */
    function guardarUsuario(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_usuario",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    //mostrarMensaje(data.mensaje);
                    dataResult = data;
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite reestablecer la contraseña un usuario
     * @param {array} consulta, correo del usuario
     * @returns {data}
     */
    function reestablecerContrasenia(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=reestablecer_contrasenia",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    //mostrarMensaje(data.mensaje);
                    dataResult = data;
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite llenar los campos con la información del usuario
     * @param {array} consulta, correo del usuario
     * @returns {data}
     */
    function llenarInformacionUsuario(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_informacion_usuario",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    $('#nombre_usuario').val(data.nombre_usuario);
                    $('#login_usuario').val(data.login);
                    $('#correo_usuario').val(data.correo);
                    $('#telefono_usuario').val(data.telefono);
                    $('#extension_usuario').val(data.extension);
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite modificar la información de un usuario
     * @param {array} informacion, información a modificar
     * @returns {data}
     */
    function modificarInformacionUsuario(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=modificar_usuario",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    //mostrarMensaje(data.mensaje);
                    dataResult = data;
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite modificar la contraseña de un usuario
     * @param {array} informacion, contraseña antigua y nueva del usuario
     * @returns {data}
     */
    function modificarContrasenia(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=modificar_contrasenia",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    //mostrarMensaje(data.mensaje);
                    dataResult = data;
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite consultar si un login ya esta asignado
     * @param {array} consulta, información del login
     * @returns {data}
     */
    function verificarUsuario(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=verificar_usuario",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    //mostrarMensaje(data.mensaje);
                    dataResult = data;
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite consultar si un correo ya esta asignado
     * @param {array} consulta, información del correo
     * @returns {data}
     */
    function verificarCorreo(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=verificar_correo",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    //alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    //mostrarMensaje(data.mensaje);
                    dataResult = data;
                }
            });
            return dataResult;
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Se captura el evento cuando de dar click en el boton guardar_usuario y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_usuario").click(function (e){
    	try{
            var confirmacion = window.confirm("¿Guardar la información del usuario?");
            if (confirmacion) {
                var nombre = $("#nombre_usuario").val();
                var login = $("#login_usuario").val();
                var correo = $("#correo_usuario").val();
                var telefono = $("#telefono_usuario").val();
                var extension = $("#extension_usuario").val();
                var contrasenia = $("#contrasenia").val();
                var contrasenia2 = $("#repita_contrasenia").val();
                if (nombre.length == 0) {
                	alert('ERROR. Ingrese un nombre de usuario');
                	$("#nombre_usuario").focus();
                }else if(login.length == 0){
                	alert('ERROR. Ingrese un login para el usuario');
                	$("#login_usuario").focus();
                }else if(correo.length == 0){
                	alert('ERROR. Ingrese el correo de usuario');
                	$("#correo_usuario").focus();
                }else if(!validarCorreo(correo)){
                	alert("ERROR: Ingrese un correo válido");
                	$("#correo_usuario").focus();
                }else if(contrasenia.length == 0){
                	alert('ERROR. Ingrese una contraseña para el usuario');
                	$("#contrasenia").focus();
                }else if(contrasenia != contrasenia2){
                	alert('ERROR. Las contraseñas no coinciden');
                	$("#contrasenia").focus();
                	$("#repita_contrasenia").focus();
                }else{
                	var informacion = {};
                	informacion['nombre'] = limpiarCadena(nombre);
                	informacion['login'] = limpiarCadena(login);
                	informacion['correo'] = limpiarCadena(correo);
                	informacion['telefono'] = limpiarCadena(telefono);
                	informacion['extension'] = limpiarCadena(extension);
                	informacion['contrasenia'] = contrasenia;
                	informacion['mod_planta'] = "true";
                	informacion['mod_inventario'] = "true";
                	informacion['mod_aires'] = "true";
                	informacion['creacion_planta'] = "false";
                	informacion['creacion_inventario'] = "false";
                	informacion['creacion_aires'] = "false";
                	informacion['perfil'] = "normal";
                	var respuesta = guardarUsuario(informacion);
                	if (respuesta.verificar) {
                		mostrarMensaje(respuesta.mensaje);
	                	$("#nombre_usuario").val("");
	                	$("#login_usuario").val("");
	                	$("#correo_usuario").val("");
	                	$("#telefono_usuario").val("");
	                	$("#extension_usuario").val("");
	                	$("#contrasenia").val("");
	                	$("#repita_contrasenia").val("");
	                	window.location = "http://192.168.46.53/sistemas/index.php";
                	}else{
                		alert("El login ya se ha registrado previamente");
			        	$("#login_usuario").addClass("resaltarInput");
			        	$("#guardar_usuario").attr('disabled','disabled');
                	}
                	
                }
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });

	/**
     * Se captura el evento cuando de dar click en el boton reestablecer_contrasenia y se
     * realiza la operacion correspondiente.
     */
    $("#reestablecer_contrasenia").click(function (e){
    	try{
            var confirmacion = window.confirm("¿Reestablecer la contraseña del usuario asociado a éste correo?");
            if (confirmacion) {
                var correo = $("#correo").val();
				if(correo.length == 0){
                	alert('ERROR. Ingrese el correo de usuario');
                	$("#correo").focus();
                }else if(!validarCorreo(correo)){
                	alert("ERROR: Ingrese un correo válido");
                	$("#correo").focus();
                }else{
                	var informacion = {};
                	informacion['correo'] = limpiarCadena(correo);
                	var respuesta = reestablecerContrasenia(informacion);
                	if (respuesta.verificar) {
                		alert(respuesta.mensaje);
	                	$("#correo").val("");
	                	window.location = "http://192.168.46.53/sistemas/index.php";
                	}else{
                		alert("El correo no está registrado");
                		$("#correo").focus();
                	}
                	
                }
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });

	/**
     * Se captura el evento cuando de dar click en el boton guardar_informacion y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_informacion").click(function (e){
    	try{
            var confirmacion = window.confirm("¿Desea modificar la información del usuario?");
            if (confirmacion) {
            	var login = $("#login_usuario").val();
                var nombre = $("#nombre_usuario").val();
                var correo = $("#correo_usuario").val();
                var telefono = $("#telefono_usuario").val();
                var extension = $("#extension_usuario").val();
				if (nombre.length == 0) {
                	alert('ERROR. Ingrese un nombre de usuario');
                	$("#nombre_usuario").focus();
                }else if(correo.length == 0){
                	alert('ERROR. Ingrese el correo de usuario');
                	$("#correo_usuario").focus();
                }else if(!validarCorreo(correo)){
                	alert("ERROR: Ingrese un correo válido");
                	$("#correo_usuario").focus();
                }else{
                	var informacion = {};
                	informacion['login'] = limpiarCadena(login);
                	informacion['nombre'] = limpiarCadena(nombre);
                	informacion['correo'] = limpiarCadena(correo);
                	informacion['telefono'] = limpiarCadena(telefono);
                	informacion['extension'] = limpiarCadena(extension);
                	var respuesta = modificarInformacionUsuario(informacion);
                	if (respuesta.verificar) {
                		alert(respuesta.mensaje);
	                	$("#login_usuario").val("");
	                	$("#nombre_usuario").val("");
	                	$("#correo_usuario").val("");
	                	$("#telefono_usuario").val("");
	                	$("#extension_usuario").val("");
	                	window.location = "http://192.168.46.53/sistemas/index.php?action=informacion_usuario";
                	}else{
                		alert("El correo no está registrado");
                		$("#correo").focus();
                	}
                	
                }
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });

	/**
     * Se captura el evento cuando de dar click en el boton guardar_contrasenia y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_contrasenia").click(function (e){
    	try{
            var confirmacion = window.confirm("¿Desea modificar la contraseña?");
            if (confirmacion) {
            	var antiguaContrasenia = $("#contrasenia_actual").val();
            	var nuevaContrasenia = $("#contrasenia_nueva").val();
            	var nuevaContraseniaRep = $("#contrasenia_nueva_rep").val();
				if(nuevaContrasenia.length == 0){
                	alert('ERROR. Ingrese una contraseña para el usuario');
                	$("#contrasenia_nueva").focus();
                }else if(nuevaContrasenia != nuevaContraseniaRep){
                	alert('ERROR. Las contraseñas no coinciden');
                	$("#contrasenia_rep").focus();
                }else if(antiguaContrasenia == nuevaContrasenia){
                	alert('ERROR. La nueva contraseña es igual a la anterior');
                	$("#contrasenia_nueva").focus();
                }else{
                	var informacion = {};
                	informacion['contrasenia_actual'] = antiguaContrasenia;
                	informacion['contrasenia_nueva'] = nuevaContrasenia;
                	var respuesta = modificarContrasenia(informacion);
                	if (respuesta.verificar) {
                		alert(respuesta.mensaje);
	                	$("#login_usuario").val("");
	                	$("#nombre_usuario").val("");
	                	$("#correo_usuario").val("");
	                	$("#telefono_usuario").val("");
	                	$("#extension_usuario").val("");
	                	window.location = "http://192.168.46.53/sistemas/index.php?action=informacion_usuario";
                	}else{
                		alert(respuesta.mensaje);
                		$("#contrasenia_actual").focus();
                	}
                	
                }
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });

	/**
     * Se captura el evento cuando se modifica el valor del selector login_usuario
     */
    $("#login_usuario").keydown(function (e) {
        var login = {};
        login["login"] = limpiarCadena($("#login_usuario").val());
        var data = verificarUsuario(login);
        if(!data.verificar){
        	$("#error_login").show();
        	$("#login_usuario").addClass("resaltarInput");
        	$("#guardar_usuario").attr('disabled','disabled');
        }else{
        	$("#error_login").hide();
        	$("#login_usuario").removeClass("resaltarInput");
        	$('#guardar_usuario').removeAttr("disabled");        	
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector correo_usuario
     */
    $("#correo_usuario").keydown(function (e) {
        var correo = {};
        correo["correo"] = limpiarCadena($("#correo_usuario").val());
        var data = verificarCorreo(correo);
        if(!data.verificar){
        	$("#error_correo").show();
        	$("#correo_usuario").addClass("resaltarInput");
        	$("#guardar_usuario").attr('disabled','disabled');
        	$('#guardar_informacion').attr('disabled','disabled');
        }else{
        	$("#error_correo").hide();
        	$("#correo_usuario").removeClass("resaltarInput");
        	$('#guardar_usuario').removeAttr("disabled");
        	$('#guardar_informacion').removeAttr("disabled");
        }
    });
});