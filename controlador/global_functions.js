/**
*funciones globales de la aplicacion
*/
$(document).ready(function () {
	var URLactual = window.location;
    /*if(URLactual['href'].indexOf('menu_principal') >= 0 || URLactual['href'].indexOf('iniciar_sesion') >= 0){
        $('#menuMoviles').hide();
    }

    if(URLactual['href'].indexOf('crear_usuario') >= 0 || URLactual['href'].indexOf('olvido_contrasenia') >= 0){
    	$('#menuMoviles').hide();
    	$('#divBarra2').hide();
    	$('#divBarraMoviles').hide();
    }*/

    if(URLactual['href'].indexOf('menu_principal') >= 0){
    	$('#home').addClass("opcion_activa");
    	$('#planta').removeClass("opcion_activa");
    	$('#aires').removeClass("opcion_activa");
    	$('#inventario').removeClass("opcion_activa");
    	$('#usuarios').removeClass("opcion_activa");
    }else if(URLactual['href'].indexOf('modulo_planta') >= 0 || URLactual['href'].indexOf('planta') >= 0){
    	$('#home').removeClass("opcion_activa");
    	$('#planta').addClass("opcion_activa");
    	$('#aires').removeClass("opcion_activa");
    	$('#inventario').removeClass("opcion_activa");
    	$('#usuarios').removeClass("opcion_activa");
    }else if(URLactual['href'].indexOf('modulo_aires') >= 0 || URLactual['href'].indexOf('aires') >= 0){
    	$('#home').removeClass("opcion_activa");
    	$('#planta').removeClass("opcion_activa");
    	$('#aires').addClass("opcion_activa");
    	$('#inventario').removeClass("opcion_activa");
    	$('#usuarios').removeClass("opcion_activa");
    }else if(URLactual['href'].indexOf('modulo_inventario') >= 0 || URLactual['href'].indexOf('inventario') >= 0){
    	$('#home').removeClass("opcion_activa");
    	$('#planta').removeClass("opcion_activa");
    	$('#aires').removeClass("opcion_activa");
    	$('#inventario').addClass("opcion_activa");
    	$('#usuarios').removeClass("opcion_activa");
    }else if(URLactual['href'].indexOf('modulo_usuarios') >= 0 || URLactual['href'].indexOf('usuarios') >= 0){
    	$('#home').removeClass("opcion_activa");
    	$('#planta').removeClass("opcion_activa");
    	$('#aires').removeClass("opcion_activa");
    	$('#inventario').removeClass("opcion_activa");
    	$('#usuarios').addClass("opcion_activa");
    }

	setTimeout(function() {
		if(URLactual['href'].indexOf('crear_usuario') == -1 && URLactual['href'].indexOf('olvido_contrasenia') == -1){
			$("#divDialogTimeOut").modal('show');
		}
    },600000);
    $('#divDialogTimeOut').on('hidden.bs.modal', function () {
    	location.reload();
	});
});

/**
 * Función que muestra el texto como mensaje en el panel superior.
 * @param {string} texto, Cadena que representa el mensaje a mostrar.
 * @returns {undefined}
 */
function mostrarMensaje(texto) {
    $('#divMensaje').empty();
    $('#divMensaje').text(texto);
}

/**
 * Función que valida si una cadena no esta vacía.
 * @param {string} cadena, Cadena a validar.
 * @returns {boolean} valido, booleano.
 */
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
 */
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
 */
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
 */
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
 */
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
 */
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
 */
function añadirComponente(divPadre,componente) {
	$('#'+divPadre).append(componente);
}

/**
 * Función que elimina un componente a un div.
 * @param {string} componente, cadena con el componente a eliminar.
 */
function eliminarComponente(idComponente) {
	$('#'+idComponente).remove();
}
