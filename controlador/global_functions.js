/**
*funciones globales de la aplicacion
**/
$(document).ready(function () {
	//$('#divDialogTimeOut').modal({backdrop: 'static', keyboard: false});
	var URLactual = window.location;
	if(URLactual['href'].indexOf('menu_principal') >= 0 || URLactual['href'].indexOf('iniciar_sesion') >= 0){
		$('#home').addClass("opcion_activa");
	}else if(URLactual['href'].indexOf('modulo_planta') >= 0 || URLactual['href'].indexOf('planta') >= 0){
		$('#planta').addClass("opcion_activa");
		if ((URLactual['href'].indexOf('planta_crear_sede') >= 0)) {
			$('#option_crear_sede').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_sede') >= 0)) {
			$('#option_consultar_sede').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_campus') >= 0)) {
			$('#option_crear_campus').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_cancha') >= 0)) {
			$('#option_crear_cancha').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_corredor') >= 0)) {
			$('#option_crear_corredor').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_parqueadero') >= 0)) {
			$('#option_crear_parqueadero').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_piscina') >= 0)) {
			$('#option_crear_piscina').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_plazoleta') >= 0)) {
			$('#option_crear_plazoleta').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_sendero') >= 0)) {
			$('#option_crear_sendero').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_via') >= 0)) {
			$('#option_crear_via').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_campus') >= 0)) {
			$('#option_consultar_campus').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_cancha') >= 0)) {
			$('#option_consultar_cancha').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_corredor') >= 0)) {
			$('#option_consultar_corredor').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_parqueadero') >= 0)) {
			$('#option_consultar_parqueadero').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_piscina') >= 0)) {
			$('#option_consultar_piscina').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_plazoleta') >= 0)) {
			$('#option_consultar_plazoleta').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_sendero') >= 0)) {
			$('#option_consultar_sendero').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_via') >= 0)) {
			$('#option_consultar_via').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_edificio') >= 0)) {
			$('#option_crear_edificio').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_edificio') >= 0)) {
			$('#option_consultar_edificio').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_espacio') >= 0)) {
			$('#option_crear_espacio').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_cubierta') >= 0)) {
			$('#option_crear_cubierta').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_gradas') >= 0)) {
			$('#option_crear_gradas').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_espacio') >= 0) || (URLactual['href'].indexOf('modulo_planta') >= 0)) {
			$('#option_consultar_espacio').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_cubierta') >= 0)) {
			$('#option_consultar_cubierta').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_gradas') >= 0)) {
			$('#option_consultar_gradas').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_tipo_material') >= 0)) {
			$('#option_crear_tipo_material').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_crear_tipo_objeto') >= 0)) {
			$('#option_crear_tipo_objeto').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_tipo_material') >= 0)) {
			$('#option_consultar_tipo_material').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('planta_consultar_tipo_objeto') >= 0)) {
			$('#option_consultar_tipo_objeto').addClass("opcion_activa_seleccion");
		}
	}else if(URLactual['href'].indexOf('modulo_aires') >= 0 || URLactual['href'].indexOf('aires') >= 0){
		$('#aires').addClass("opcion_activa");
		if ((URLactual['href'].indexOf('aires_crear_aire') >= 0)) {
			$('#option_crear_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_crear_aire') >= 0)) {
			$('#option_crear_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_crear_capacidad_aire') >= 0)) {
			$('#option_crear_capacidad_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_crear_marca_aire') >= 0)) {
			$('#option_crear_marca_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_crear_tipo_aire') >= 0)) {
			$('#option_crear_tipo_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_crear_tecnologia_aire') >= 0)) {
			$('#option_crear_tecnologia_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_aire_ubicacion') >= 0)) {
			$('#option_consultar_aire_ubicacion').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_aire_numero_inventario') >= 0)) {
			$('#option_consultar_aire_numero_inventario').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_capacidad_aire') >= 0)) {
			$('#option_consultar_capacidad_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_marca_aire') >= 0)) {
			$('#option_consultar_marca_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_tipo_aire') >= 0)) {
			$('#option_consultar_tipo_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_tecnologia_aire') >= 0)) {
			$('#option_consultar_tecnologia_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_registrar_mantenimiento_aire_id_aire') >= 0)) {
			$('#option_registrar_mantenimiento_aire_id_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_consultar_mantenimiento_aire_numero_orden') >= 0)) {
			$('#option_consultar_mantenimiento_aire_numero_orden').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_mas_marcas_aire') >= 0)) {
			$('#option_mas_marcas_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_mas_tipos_aire') >= 0)) {
			$('#option_mas_tipos_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_mas_tipo_tecnologias_aire') >= 0)) {
			$('#option_mas_tipo_tecnologias_aire').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0)) {
			$('#option_mas_mantenimientos').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('aires_marcas_mas_mantenimientos') >= 0)) {
			$('#option_marcas_mas_mantenimientos').addClass("opcion_activa_seleccion");
		}
	}else if(URLactual['href'].indexOf('modulo_inventario') >= 0 || URLactual['href'].indexOf('inventario') >= 0){
		$('#inventario').addClass("opcion_activa");
		if ((URLactual['href'].indexOf('inventario_anadir_articulo') >= 0)) {
			$('#option_anadir_articulo').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_crear_marca') >= 0)) {
			$('#option_crear_marca').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_crear_proveedor') >= 0)) {
			$('#option_crear_proveedor').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_crear_articulo') >= 0)) {
			$('#option_crear_articulo').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_consultar_inventario') >= 0)) {
			$('#option_consultar_inventario').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_movimientos_inventario') >= 0)) {
			$('#option_movimientos_inventario').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_consultar_articulo') >= 0)) {
			$('#option_consultar_articulo').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_consultar_marca') >= 0)) {
			$('#option_consultar_marca').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_consultar_proveedor') >= 0)) {
			$('#option_consultar_proveedor').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_articulos_mas_usados') >= 0)) {
			$('#option_articulos_mas_usados').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('inventario_articulos_menos_usados') >= 0)) {
			$('#option_articulos_menos_usados').addClass("opcion_activa_seleccion");
		}
	}else if(URLactual['href'].indexOf('cambiar_contrasenia') >= 0){
		$('#barra_usuario').addClass("opcion_activa_seleccion");
		$('#option_cambiar_contrasenia').addClass("opcion_activa_seleccion");
	}else if(URLactual['href'].indexOf('modificar_informacion_usuario') >= 0){
		$('#barra_usuario').addClass("opcion_activa_seleccion");
		$('#option_modificar_datos').addClass("opcion_activa_seleccion");
	}else if(URLactual['href'].indexOf('informacion_usuario') >= 0){
		$('#barra_usuario').addClass("opcion_activa_seleccion");
		$('#option_informacion_usuario').addClass("opcion_activa_seleccion");
	}else if(URLactual['href'].indexOf('modulo_usuarios') >= 0 || URLactual['href'].indexOf('usuario') >= 0){
		$('#usuarios').addClass("opcion_activa");
		if ((URLactual['href'].indexOf('crear_usuario_admin') >= 0)) {
			$('#option_crear_usuario').addClass("opcion_activa_seleccion");
		}else if ((URLactual['href'].indexOf('listar_usuarios_admin') >= 0)) {
			$('#option_listar_usuarios').addClass("opcion_activa_seleccion");
		}
	}
	setTimeout(function() {
		if(URLactual['href'].indexOf('crear_usuario') == -1 && URLactual['href'].indexOf('olvido_contrasenia') == -1){
			$("#divDialogTimeOut").modal('show');
		}
	},1000000);
	$('#divDialogTimeOut').on('hidden.bs.modal', function () {
		location.reload();
	});
});

/**
 * Evento de cambio del selector de archivo del modal de consulta/modificación.
**/
$("#myCarousel").on("change", ".upload", function(){
	var fotos = document.getElementById("fileInputOculto");
	var texto = "";
	if (fotos.files.length > 1) {
		texto = fotos.files.length + " archivos";
	}else if (fotos.files.length == 1){
		texto = fotos.files[0].name;
	}
	$("#fileInputVisible").val(texto);
});


/**
 * Función que muestra el texto como mensaje en el panel superior.
 * @param {string} texto, Cadena que representa el mensaje a mostrar.
 * @returns {undefined}
**/
function mostrarMensaje(texto) {
	//$('#divMensaje').empty();
	//$('#divMensaje').text(texto);
	alert(texto);
}

/**
 * Función que valida si una cadena no esta vacía.
 * @param {string} cadena, Cadena a validar.
 * @returns {boolean} valido, booleano.
**/
function validarCadena(cadena) {
	var valido = true;
	if (cadena == '' || cadena == null) {
		valido = false;
	}else if(cadena == 'seleccionar'){
		valido = false;
	}
	return valido;
}

/**
 * Función que valida si las cadenas de un arreglo no están vacías.
 * @param {array} arreglo, Arreglo a validar.
 * @returns {integer} posicion, numero que representa la posicion del arreglo donde se encontró la cadena que no cumple.
**/
function validarArregloCadenas(arreglo) {
	var posicion = null;
	for (var i=0;i<arreglo.length;i++) {
		if (arreglo[i] == '' || arreglo[i] == null) {
			posicion = i;
			break;
		}else if(arreglo[i] == 'seleccionar'){
			posicion = i;
			if(posicion == 0){
				posicion = '';
			}
			break;
		}
	}
	return posicion;
}

/**
 * Función que valida si un número es mayor que cero.
 * @param {string} numero, Número a validar.
 * @returns {boolean} valido, booleano.
**/
function validarNumero(numero) {
	var numero = parseInt(numero);
	var valido = true;
	if (numero == '' || isNaN(numero)) {
		valido = false;
	}else if(numero < 0){
		valido = false;
	}
	return valido;
}

/**
 * Función que valida si los numeros de un arreglo son números mayores que cero.
 * @param {array} arreglo, Arreglo a validar.
 * @returns {integer} posicion, numero que representa la posicion del arreglo donde se encontró el número que no cumple.
**/
function validarArregloNumeros(arreglo) {
	var posicion = null;
	for (var i=0;i<arreglo.length;i++) {
		if (arreglo[i] == '' || isNaN(arreglo[i])) {
			posicion = i;
			break;
		}else if(arreglo[i] < 0){
			posicion = i;
			if(posicion == 0){
				posicion = '';
			}
			break;
		}
	}
	return posicion;
}

/**
 * Función que valida si un correo es válido o no.
 * @param {string} correo, cadena a validar.
 * @returns {boolean} valido, booleano.
**/
function validarCorreo(correo) {
	var valido = true;
	expr = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
	if (!expr.test(correo)){
		valido = false;
	}
	return valido;
}

/**
 * Función que devuelve la cadena de entrada en minúsculas, sin espacios dobles y sin espacios al comienzo y al final de ésta.
 * @param {string} cadena, Cadena a convertir a minúsculas.
 * @returns {string} cadenaMinus, Cadena convertida.
**/
function limpiarCadena(cadena) {
	var cadenaMinus = cadena.toLowerCase();
	cadenaMinus = cadenaMinus.replace(/\s+/gi,' ');
	cadenaMinus = cadenaMinus.replace(/^\s*|\s*$/g,'');
	return cadenaMinus;
}

/**
 * Función que añade un componente a un div.
 * @param {string} divPadre, nombre del div al que se añadirá el componente.
 * @param {string} componente, cadena con el componente a añadir.
**/
function añadirComponente(divPadre,componente) {
	$('#'+divPadre).append(componente);
}

/**
 * Función que elimina un componente a un div.
 * @param {string} idComponente, id del componente a eliminar.
 * @param {string} componente, cadena con el componente a eliminar.
**/
function eliminarComponente(idComponente) {
	$('#'+idComponente).remove();
}

/**
 * Función que valida el si una fecha es menor que la fecha actual.
 * @param {string} date, fecha.
 * @param {string} componente, cadena con el componente a eliminar.
**/
function validarFechaMenorActual(date){
	var x = new Date();
	var fecha = date.split("-");
	x.setFullYear(fecha[0],fecha[1]-1,fecha[2]);
	var today = new Date();
	if (x >= today)
		return false;
	else
		return true;
}
