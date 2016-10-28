	/**
	* Funciones del carousel de inicio de sesión.
	*/
	$(document).ready(function () {
			llenarCarousel();
	});

/**
 * Función que realiza una consulta de los archivos de un tipo de objeto.
 * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
 * @param {array} informacion, informaci&oacute;n del tipo de objeto.
 * @returns {data} object json
**/
function fotosIndex(){
		var dataResult;
		try {
				$.ajax({
						type: "POST",
						url: "index.php?action=consultar_fotos_index",
						//data: {jObject:jObject},
						dataType: "json",
						async: false,
						error: function (request, status, error) {
								console.log(error.toString());
								location.reload(true);
						},
						success: function(data){
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
	 * Función que llena el carrusel de la página de inicio de sesión.
	 * @returns {undefined}
	 */
	function llenarCarousel() {
	    var archivos = fotosIndex();
			$.each(archivos, function(index, record) {
					if($.isNumeric(index)) {
							if (index == 0) {
								 var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
								 var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
									 +'<img class="carouselImg" src="archivos/images/index/'+record.nombre+'" alt="'+record.nombre+'"/>'
									 +'</div>';
						 }else{
									var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
									var componente2 = '<div id="item_carrusel" class="item carouselImg">'
										+'<img class="carouselImg" src="archivos/images/index/'+record.nombre+'" alt="'+record.nombre+'"/>'
										+'</div>';
						 }
						 añadirComponente("indicadores_carrusel",componente);
						 añadirComponente("fotos_carrusel",componente2);
					}
			});
	}
