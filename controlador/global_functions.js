/**
*funciones globales de la aplicacion 
*/
$(document).ready(function () {});

/**
 * Función que muestra el texto como mensaje en el panel superior.
 * @param {string} texto, Cadena que representa el mensaje a mostrar.
 * @returns {undefined}
 */
function mostrarMensaje(texto) {
    $("#divMensaje").empty();
    $("#divMensaje").text(texto);
}

/**
 * Función que devuelve la cadena de entrada en minúsculas, sin espacios dobles y sin espacios al comienzo y al final de ésta.
 * @param {string} cadena, Cadena a convertir a minúsculas.
 * @returns {string} cadenaMinus, Cadena convertida.
 */
function limpiarCadena(cadena) {
	var cadenaMinus = cadena.toLowerCase();
	cadenaMinus = cadenaMinus.replace(/\s+/gi,' ');
	cadenaMinus = cadenaMinus.replace(/^\s*|\s*$/g,"");
	return cadenaMinus;
}

/**
 * Función que añade un componente a un div.
 * @param {string} divPadre, nombre del div al que se añadirá el componente.
 * @param {string} componente, cadena con el componente a añadir.
 */
function añadirComponente(divPadre,componente) {
	$("#"+divPadre).append(componente);
}

/**
 * Función que elimina un componente a un div.
 * @param {string} componente, cadena con el componente a eliminar.
 */
function eliminarComponente(idComponente) {
	$("#"+idComponente).remove();
}