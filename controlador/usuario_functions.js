$(document).ready(function() {

	var URLactual = window.location;
	var numeroUsuarios = 0;

	if(URLactual['href'].indexOf('informacion_usuario') >= 0){
		llenarInformacionUsuario("informacion");
	}else if(URLactual['href'].indexOf('listar_usuarios_admin') >= 0){
		llenarTablaUsuarios();
	}

	/**
	 * Función que permite crear un usuario
	 * @param {array} consulta, información de la sede
	 * @returns {data}
	**/
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
	 * Función que permite reestablecer la contraseña un usuario.
	 * @param {array} informacion, correo del usuario.
	 * @returns {data}
	**/
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
	 * Función que permite llenar los campos con la información del usuario.
	 * @param {array} informacion, correo del usuario.
	 * @returns {data}
	**/
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
	 * Función que permite modificar la información de un usuario.
	 * @param {array} informacion, información a modificar.
	 * @returns {data}
	**/
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
	 * Función que permite modificar la contraseña de un usuario.
	 * @param {array} informacion, contraseña antigua y nueva del usuario.
	 * @returns {data}
	**/
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
	 * Función que permite consultar si un login ya esta asignado.
	 * @param {array} consulta, información del login.
	 * @returns {data}
	**/
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
    **/
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
	 * Función que permite consultar los usuarios registrados en el sistema.
	 * @returns {data}
	**/
	function listarUsuarios(){
		var dataResult;
		try {
			$.ajax({
				type: "POST",
				url: "index.php?action=listar_usuarios",
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
	 * Función que permite consultar la información de un usuario en el sistema.
	 * @param {array} informacion, login del usuario.
	 * @returns {data}
	**/
	function informacionUsuario(informacion){
		var dataResult;
		var jObject = JSON.stringify(informacion);
		try {
			$.ajax({
				type: "POST",
				url: "index.php?action=obtener_informacion_usuario_seleccionado",
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
	 * Función que permite guardar las modificaciones a la información de un usuario.
	 * @param {array} informacion, login del usuario.
	 * @returns {data}
	**/
	function guardarModificacionesUsuario(informacion){
		var dataResult;
		var jObject = JSON.stringify(informacion);
		try {
			$.ajax({
				type: "POST",
				url: "index.php?action=guardar_modificaciones_usuario",
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
	 * Función que permite desactivar un usuario del sistema.
	 * @param {array} informacion, login del usuario.
	 * @returns {data}
	**/
	function desactivarUsuario(informacion){
		var dataResult;
		var jObject = JSON.stringify(informacion);
		try {
			$.ajax({
				type: "POST",
				url: "index.php?action=desactivar_usuario",
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
     * Función que llena la tabla usuarios.
     * @returns {undefined}
    **/
    function llenarTablaUsuarios(){
		for (var i=0;i<numeroUsuarios;i++) {
            eliminarComponente("tr_tabla_usuarios");
        }
        var data = listarUsuarios();
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
				var login = record.login;
				var nombre = record.nombre;
				var telefono = record.telefono;
				var extension = record.extension;
				var correo = record.correo;
				var creacion_planta = record.creacion_planta;
				var creacion_aire = record.creacion_aire;
				var creacion_inventario = record.creacion_inventario;
				var perfil = record.perfil;
				var estado = record.estado;
				if (creacion_planta == 'true') {
					creacion_planta = 'Sí';
				}else{
					creacion_planta = 'No';
				}
				if (creacion_aire == 'true') {
					creacion_aire = 'Sí';
				}else{
					creacion_aire = 'No';
				}
				if (creacion_inventario == 'true') {
					creacion_inventario = 'Sí';
				}else{
					creacion_inventario = 'No';
				}
                $("#tabla_usuarios").append("<tr id='tr_tabla_usuarios'><td>"+login+"</td><td>"+nombre+"</td><td>"+correo+"</td><td>"+telefono+"</td><td>"+extension+"</td><td>"+perfil+"</td><td>"+creacion_planta+"</td><td>"+creacion_aire+"</td><td>"+creacion_inventario+"</td><td>"+estado+"</td></tr>");
				numeroUsuarios++;
            }
        });
		$("#tabla_usuarios").show();
    }

	/**
	 * Se captura el evento cuando de dar click en un fila de la tabla usuarios.
	**/
	$('tbody').on('click', 'tr', function() {
		if ($(this).hasClass("filaSeleccionada")) {
			$(this).removeClass("filaSeleccionada");
			$("#ver_informacion_usuario").attr("disabled",true);
		}else{
			$("#tBody tr").removeClass("filaSeleccionada");
	    	$(this).addClass("filaSeleccionada");
			$("#ver_informacion_usuario").removeAttr("disabled");
		}
	});

	/**
	 * Se captura el evento cuando de dar click en el botón ver_informacion_usuario y se
	 * realiza la operacion correspondiente.
	**/
	$("#ver_informacion_usuario").click(function (e){
		var element = $("#tabla_usuarios").find(".filaSeleccionada");
		var usuario = element.html();
		usuario = usuario.split("</td>");
		usuario = usuario[0].substring(4);
		var informacion = {};
		informacion["usuario"] = usuario;
		var data = informacionUsuario(informacion);
		console.log(data);
		$.each(data, function(index, record) {
            if($.isNumeric(index)) {
				$("#nombre_usuario").val(record.nombre);
				$("#login_usuario").val(record.login);
				$("#correo_usuario").val(record.correo);
				$("#correo_usuario").attr('name',record.correo);
				$("#telefono_usuario").val(record.telefono);
				$("#extension_usuario").val(record.extension);
				$("input[name=crear_planta][value="+record.creacion_planta+"]").prop('checked', true);
				$("input[name=crear_aire][value="+record.creacion_aire+"]").prop('checked', true);
				$("input[name=crear_inventario][value="+record.creacion_inventario+"]").prop('checked', true);
				$("#tipo_usuario").val(record.perfil);
				$("#estado").val(record.estado);
            }
        });
		$("#divDialogConsulta").modal('show');
	});

	/**
	 * Se captura el evento cuando de dar click en el botón modificar_usuario y se
	 * realiza la operacion correspondiente.
	**/
	$("#modificar_usuario").click(function (e){
		$("#nombre_usuario").removeAttr("disabled");
		$("#correo").removeAttr("disabled");
		$("#telefono_usuario").removeAttr("disabled");
		$("#extension_usuario").removeAttr("disabled");
		$("input[name=crear_planta]").attr('disabled', false);
		$("input[name=crear_aire]").attr('disabled', false);
		$("input[name=crear_inventario]").attr('disabled', false);
		$("#tipo_usuario").removeAttr("disabled");
		$("#estado").removeAttr("disabled");
		$("#modificar_usuario").hide();
        $("#guardar_modificaciones_usuario").show();
		$('#divDialogConsulta').scrollTop(0);
	});

	/**
	 * Se captura el evento cuando de dar click en el botón guardar_modificaciones_usuario y se
	 * realiza la operacion correspondiente.
	**/
	$("#guardar_modificaciones_usuario").click(function (e){
		var confirmacion = window.confirm("¿Guardar la información del usuario?");
		if (confirmacion) {
			var login = $("#login_usuario").val();
			var nombreUsuario = limpiarCadena($("#nombre_usuario").val());
			var correo = limpiarCadena($("#correo_usuario").val());
			var correoAnterior = $("#correo_usuario").attr('name');
			var telefono = $("#telefono_usuario").val();
			var extension = $("#extension_usuario").val();
			var crearPlanta = $('input[name="crear_planta"]:checked').val();
			var crearAire = $('input[name="crear_aire"]:checked').val();
			var crearInventario = $('input[name="crear_inventario"]:checked').val();
			var tipoUsuario = $("#tipo_usuario").val();
			var estado = $("#estado").val();
			console.log(crearPlanta);
			console.log(crearAire);
			console.log(crearInventario);
			if (!validarCadena(nombreUsuario)) {
				alert("ERROR. Ingrese el nombre del usuario");
				$("#nombre_usuario").focus();
			}else if(!validarCorreo(correo)){
				alert("ERROR. El correo ingresado no es un correo válido");
				$("#correo_usuario").focus();
			}else if(!validarCadena(crearPlanta)){
				alert("ERROR. Especifique si el usuario tiene permisos de creación en el módulo de planta física");
				$("#crear_planta").focus();
			}else if(!validarCadena(crearAire)){
				alert("ERROR. Especifique si el usuario tiene permisos de creación en el módulo de aires acondicionados");
				$("#crear_aire").focus();
			}else if(!validarCadena(crearInventario)){
				alert("ERROR. Especifique si el usuario tiene permisos de creación en el módulo de inventario");
				$("#crear_inventario").focus();
			}else if(!validarCadena(tipoUsuario)){
				alert("ERROR. Seleccione el tipo de usuario");
				$("#tipo_usuario").focus();
			}else if(!validarCadena(estado)){
				alert("ERROR. Seleccione el estado del usuario");
				$("#estado").focus();
			}else{
				var correoRepetido = false;
				if (correo != correoAnterior) {
					var correo = {};
					correo["correo"] = limpiarCadena($("#correo_usuario").val());
					var data = verificarCorreo(correo);
					if(!data.verificar){
						$("#error_correo").show();
						$("#divCorreo").addClass("has-error");
						$("#divCorreo").addClass("has-feedback");
						$("#iconoErrorCorreo").show();
						correoRepetido = true;
					}else{
						$("#error_correo").hide();
						$("#divCorreo").removeClass("has-error");
						$("#divCorreo").removeClass("has-feedback");
						$("#iconoErrorCorreo").hide();
					}
				}
				if (!correoRepetido) {
					var informacion = {};
					informacion["login"] = login;
					informacion["nombre_usuario"] = nombreUsuario;
					informacion["correo"] = correo;
					informacion["telefono"] = telefono;
					informacion["extension"] = extension;
					informacion["crear_planta"] = crearPlanta;
					informacion["crear_aire"] = crearAire;
					informacion["crear_inventario"] = crearInventario;
					informacion["perfil"] = tipoUsuario;
					informacion["estado"] = estado;
					var data = guardarModificacionesUsuario(informacion);
					alert(data.mensaje);
					if (data.verificar) {
						llenarTablaUsuarios();
						$("#divDialogConsulta").modal('hide');
					}
				}
			}
		}
	});

	/**
	 * Se captura el evento cuando de dar click en el botón desactivar_usuario y se
	 * realiza la operacion correspondiente.
	**/
	$("#desactivar_usuario").click(function (e){
		var confirmacion = window.confirm("¿Esta seguro que desea desactivar el usuario seleccionado?");
		if (confirmacion) {
			var login = $("#login_usuario").val();
			var informacion = {};
			informacion["login"] = login;
			var data = desactivarUsuario(informacion);
			alert(data.mensaje);
			if (data.verificar) {
				llenarTablaUsuarios();
				$("#divDialogConsulta").modal('hide');
			}
		}
	});


	/**
     * Se captura el evento cuando se cierra el modal divDialogConsulta.
    **/
    $('#divDialogConsulta').on('hidden.bs.modal', function () {
		$("#nombre_usuario").attr('disabled', true);
		$("#correo").attr('disabled', true);
		$("#telefono_usuario").attr('disabled', true);
		$("#extension_usuario").attr('disabled', true);
		$("input[name=crear_planta]").attr('disabled', true);
		$("input[name=crear_aire]").attr('disabled', true);
		$("input[name=crear_inventario]").attr('disabled', true);
		$("#tipo_usuario").attr('disabled', true);
		$("#estado").attr('disabled', true);
        $("#modificar_usuario").show();
        $("#guardar_modificaciones_usuario").hide();
        window.scrollTo(0,0);
    });

	/**
	 * Se captura el evento cuando de dar click en el botón guardar_usuario y se
	 * realiza la operacion correspondiente.
	**/
	//$("#guardar_usuario").click(function (e){
	$("#guardar_usuario").off('click').on('click', function() {
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
				var pattern = /(?=.*\d)(?=.*[a-z])(?=.+[A-Z])/;
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
				}else if(contrasenia.length < 8){
					alert('ERROR. La contraseña mínimo debe tener 8 caracteres');
					$("#contrasenia").focus();
				}else if(!pattern.test(contrasenia)){
					alert('ERROR. La contraseña debe contener por lo menos una letra y un número');
					console.log(contrasenia);
					$("#contrasenia").focus();
				}else if(contrasenia != contrasenia2){
					alert('ERROR. Las contraseñas no coinciden');
					//$("#contrasenia").focus();
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
	 * Se captura el evento cuando de dar click en el botón guardar_usuario_admin y se
	 * realiza la operacion correspondiente.
	**/
	//$("#guardar_usuario_admin").click(function (e){
	$("#guardar_usuario_admin").off('click').on('click', function() {
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
				var crearPlanta = $('input[name="crear_planta"]:checked').val();
				var crearAire = $('input[name="crear_aire"]:checked').val();
				var crearInventario = $('input[name="crear_inventario"]:checked').val();
				var tipoUsuario = $("#tipo_usuario").val();
				var pattern = /(?=.*\d)(?=.*[a-z])(?=.+[A-Z])/;
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
				}else if(contrasenia.length < 8){
					alert('ERROR. La contraseña mínimo debe tener 8 caracteres');
					$("#contrasenia").focus();
				}else if(!pattern.test(contrasenia)){
					alert('ERROR. La contraseña debe contener por lo menos una letra y un número');
					console.log(contrasenia);
					$("#contrasenia").focus();
				}else if(contrasenia != contrasenia2){
					alert('ERROR. Las contraseñas no coinciden');
					//$("#contrasenia").focus();
					$("#repita_contrasenia").focus();
				}else if(!validarCadena(crearPlanta)){
					alert('ERROR. Especifique si el usuario tiene permisos de creación en el módulo de planta física');
					$("#crear_planta").focus();
				}else if(!validarCadena(crearAire)){
					alert('ERROR. Especifique si el usuario tiene permisos de creación en el módulo de aires acondicionados');
					$("#crear_aire").focus();
				}else if(!validarCadena(crearInventario)){
					alert('ERROR. Especifique si el usuario tiene permisos de creación en el módulo de inventario');
					$("#crear_inventario").focus();
				}else if(!validarCadena(tipoUsuario)){
					alert('ERROR. Especifique el tipo de usuario a crear');
					$("#tipo_usuario").focus();
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
					informacion['creacion_planta'] = crearPlanta;
					informacion['creacion_inventario'] = crearAire;
					informacion['creacion_aires'] = crearInventario;
					informacion['perfil'] = tipoUsuario;
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
						$('input[name=crear_planta]').attr('checked',false);
						$('input[name=crear_aire]').attr('checked',false);
						$('input[name=crear_inventario]').attr('checked',false);
						$("#tipo_usuario").val("");
						window.scrollTo(0,0);
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
	 * Se captura el evento cuando de dar click en el botón reestablecer_contrasenia y se
	 * realiza la operacion correspondiente.
	**/
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
	 * Se captura el evento cuando de dar click en el botón guardar_informacion y se
	 * realiza la operacion correspondiente.
	**/
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
	 * Se captura el evento cuando de dar click en el botón guardar_contrasenia y se
	 * realiza la operacion correspondiente.
	**/
	$("#guardar_contrasenia").click(function (e){
		try{
			var confirmacion = window.confirm("¿Desea modificar la contraseña?");
			if (confirmacion) {
				var antiguaContrasenia = $("#contrasenia_actual").val();
				var nuevaContrasenia = $("#contrasenia_nueva").val();
				var nuevaContraseniaRep = $("#contrasenia_nueva_rep").val();
				var pattern = /(?=.*\d)(?=.*[a-z])(?=.+[A-Z])/;
				if(contrasenia.length < 8){
					alert('ERROR. La contraseña mínimo debe tener 8 caracteres');
					$("#contrasenia").focus();
				}else if(!pattern.test(contrasenia)){
					alert('ERROR. La contraseña debe contener por lo menos una letra y un número');
					console.log(contrasenia);
					$("#contrasenia").focus();
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
		}catch(ex){
			console.log(ex);
			alert("Ocurrió un error, por favor inténtelo nuevamente");
		}
	});

	/**
	 * Se captura el evento cuando se modifica el valor del selector login_usuario
	**/
	$("#login_usuario").keydown(function (e) {
		var login = {};
		login["login"] = limpiarCadena($("#login_usuario").val());
		var data = verificarUsuario(login);
		if(!data.verificar){
			$("#error_login").show();
			$("#divLogin").addClass("has-error");
			$("#divLogin").addClass("has-feedback");
			$("#iconoErrorLogin").show();
			//$("#login_usuario").addClass("resaltarInput");
			$("#guardar_usuario").attr('disabled','disabled');
		}else{
			$("#error_login").hide();
			$("#divLogin").removeClass("has-error");
			$("#divLogin").removeClass("has-feedback");
			$("#iconoErrorLogin").hide();
			//$("#login_usuario").removeClass("resaltarInput");
			$('#guardar_usuario').removeAttr("disabled");
		}
	});

	/**
	 * Se captura el evento cuando se modifica el valor del selector correo_usuario
	**/
	$("#correo_usuario").keydown(function (e) {
		var correo = {};
		correo["correo"] = limpiarCadena($("#correo_usuario").val());
		var data = verificarCorreo(correo);
		if(!data.verificar){
			$("#error_correo").show();
			$("#divCorreo").addClass("has-error");
			$("#divCorreo").addClass("has-feedback");
			$("#iconoErrorCorreo").show();
			//$("#correo_usuario").addClass("resaltarInput");
			$("#guardar_usuario").attr('disabled','disabled');
			$('#guardar_informacion').attr('disabled','disabled');
		}else{
			$("#error_correo").hide();
			$("#divCorreo").removeClass("has-error");
			$("#divCorreo").removeClass("has-feedback");
			$("#iconoErrorCorreo").hide();
			//$("#correo_usuario").removeClass("resaltarInput");
			$('#guardar_usuario').removeAttr("disabled");
			$('#guardar_informacion').removeAttr("disabled");
		}
	});
});
