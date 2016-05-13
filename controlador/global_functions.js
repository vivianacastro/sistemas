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
 * Función que devuelve la cadena de entrada en minúsculas, sin espacios dobles y sin espacios al comienzo y al final de ésta..
 * @param {string} cadena, Cadena a convertir a minúsculas.
 * @returns {string} cadenaMinus, Cadena convertida.
 */
function cadenaMinusculas(cadena) {
	var cadenaMinus = cadena.toLowerCase();
	cadenaMinus = cadenaMinus.replace(/\s+/gi,' ');
	cadenaMinus = cadenaMinus.replace(/^\s*|\s*$/g,"");
	return cadenaMinus;
}

/**
 * Función que devuelve la cadena de entrada con la primera letra de cada palabra en mayúsculas.
 * @param {string} cadena, Cadena a convertir.
 * @returns {string} cadenaMostrar, Cadena para mostrar (primera letra de cada palabra en mayúsculas).
 */
function cadenaMostrar(cadena) {
	var cadenaMostrar = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {return letter.toUpperCase();});
	return cadenaMostrar;
}