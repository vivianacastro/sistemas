$(document).ready(function() {

    var espaciosCont = 0, iluminacionCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0, puntosSanitariosCont = 0, lavamanosCont = 0, orinalesCont = 0;
    var coordenadas = {};
    var dataEspacio = {};
    var map;

    /**
     * Función que se ejecuta al momento que se accede a la página que lo tiene
     * incluido.
     * @returns {undefined}
     */
    (function (){
        var URLactual = window.location;
        if(URLactual['href'].indexOf('crear_campus') >= 0){
            actualizarSelectSede();
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_edificio') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_fachada",0);
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_cancha') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);

        }else if(URLactual['href'].indexOf('crear_corredor') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_pared",0);
          actualizarSelectMaterial("material_techo",0);
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_iluminacion",0);
          actualizarSelectTipoObjeto("tipo_interruptor",0);
          actualizarSelectTipoObjeto("tipo_suministro_energia",0);
          initMap();
          getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_parqueadero') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_piscina') >= 0){
            actualizarSelectSede();
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_plazoleta') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_sendero') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_cubierta",0);
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_vias') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
        }else if(URLactual['href'].indexOf('crear_espacio') >= 0){
            actualizarSelectSede();
            actualizarSelectUsosEspacios();
            actualizarSelectMaterial("material_pared",0);
            actualizarSelectMaterial("material_techo",0);
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectMaterial("material_puerta",0);
            actualizarSelectMaterial("material_marco_puerta",0);
            actualizarSelectMaterial("material_ventana",0);
            actualizarSelectTipoObjeto("tipo_cerradura",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            actualizarSelectTipoObjeto("tipo_interruptor",0);
            actualizarSelectTipoObjeto("tipo_puerta",0);
            actualizarSelectTipoObjeto("tipo_suministro_energia",0);
            actualizarSelectTipoObjeto("tipo_ventana",0);
        }
    })();

    /**
     * Función que obtiene las coordenadas donde se encuentra el usuario
     * y actualiza el mapa.
     * @returns {undefined}
    */
    function getCoordenadas(){
        var coords = {};
        navigator.geolocation.getCurrentPosition(function (position){
            coords =  {
                lng: position.coords.longitude,
                lat: position.coords.latitude
            }
            map.panTo(coords);
            google.maps.event.trigger(map, 'resize');
        },function(error){
            console.log(error);
        });
    }

    /**
     * Función que carga el mapa y lo configura.
     * @returns {undefined}
     */
    function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 3.375119, lng: -76.5336927},//{lat: 3.375119, lng: -76.5336927}, //Coordenadas Univalle - Meléndez
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var drawingManager = new google.maps.drawing.DrawingManager({
            drawingMode: google.maps.drawing.OverlayType.MARKER,
            drawingControl: true,
            drawingControlOptions: {
                position: google.maps.ControlPosition.TOP_CENTER,
                drawingModes: [
                    google.maps.drawing.OverlayType.MARKER
                ]
            },
            markerOptions: {
                draggable: true
            }
        });
        drawingManager.setMap(map);
        google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
            coordenadas = (event.overlay.getPosition());
            map.panTo(coordenadas);
            drawingManager.setOptions({
                drawingControl: false
            });
            drawingManager.setDrawingMode(null);
            var element = event.overlay;
            google.maps.event.addListener(element, 'click', function(e) {
                element.setMap(null);
                drawingManager.setOptions({
                    drawingControl: true
                });
                drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
            });
        });
    }

    /**
     * Función que permite crear una sede
     * @param {string} consulta, información de la sede
     * @returns {data}
     */
    function guardarSede(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_sede",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
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
     * Función que permite crear un campus
     * @param {string} informacion, información del campus
     * @returns {data}
     */
    function guardarCampus(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        console.log(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_campus",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
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
     * Función que permite crear un edificio
     * @param {string} informacion, información del edificio
     * @returns {data}
     */
    function guardarEdificio(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_edificio",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
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
     * Función que permite crear un espacio
     * @param {string} informacion, información del espacio
     * @returns {data}
     */
    function guardarEspacio(){
        var jObject = JSON.stringify(dataEspacio);
        console.log(dataEspacio);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_espacio",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    dataEspacio = {};
                    var resultadoPlanos = guardarPlanosEspacio(dataEspacio['planos']);
                    var resultadoFotos = guardarFotosEspacio(dataEspacio['fotos']);
                    alert(data.mensaje);
                    console.log(data);
                    console.log(resultadoPlanos);
                    console.log(resultadoFotos);
                    var mensaje = "";
                    if (typeof resultadoPlanos[0] !== 'undefined' && resultadoPlanos[0] !== null) {
                        for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                            if (!resultadoPlanos.verificar[i]) {
                                mensaje += resultadoPlanos.mensaje[i];
                            }
                            if (i<resultadoPlanos.verificar.length-2) {
                                mensaje += "\n";
                            }
                        }
                    }
                    if (typeof resultadoFotos[0] !== 'undefined' && resultadoFotos[0] !== null) {
                        for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                            if (!resultadoFotos.verificar[i]) {
                                mensaje += resultadoFotos.mensaje[i];
                            }
                            if (i<resultadoFotos.verificar.length-1) {
                                mensaje += "\n";
                            }
                        }
                    }
                    if (mensaje.substring(0,0) != "") {
                        console.log(mensaje.length);
                        alert(mensaje);
                    }
                    if(data.verificar){
                        $('#divDialogCreacion').modal('hide');
                        $("#nombre_sede").val("");
                        $("#nombre_campus").empty();
                        $("#nombre_edificio").empty();
                        $("#pisos").empty();
                        $("#id_espacio").val("");
                        $("#uso_espacio").val("");
                        $('input[name=tiene_espacio_padre]').attr('checked',false);
                        var planos = document.getElementById("planos[]");
                        var fotos = document.getElementById("fotos[]");
                        planos.value = "";
                        fotos.value = "";
                        for(var i=espaciosCont;i>0;i--){
                            eliminarComponente("espacio"+espaciosCont);
                        }
                        espaciosCont = 0;
                        $("#eliminar_espacio").attr('disabled','disabled');
                        window.scrollTo(0,0);
                    }
                }
            });
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite crear un tipo de material
     * @param {string} informacion, información del tipo de material
     * @returns {data}
     */
    function guardarTipoMaterial(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_tipo_material",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
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
     * Función que permite crear un tipo de objeto
     * @param {string} informacion, información del tipo de objeto
     * @returns {data}
     */
    function guardarTipoObjeto(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_tipo_objeto",
                data: {jObject:jObject},
                dataType: "json",
                async: false,
                error: function(xhr, status, error) {
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
     * Función que permite guardar los planos que se suban al sistema
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
     */
    function guardarPlanosCampus(informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_planos_campus",
                data: informacion,
                dataType: "json",
                contentType: false,
                processData: false,
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
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
     * Función que permite guardar las fotos que se suban al sistema
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
     */
    function guardarFotosCampus(informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_fotos_campus",
                data: informacion,
                dataType: "json",
                contentType: false,
                processData: false,
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
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
     * Función que permite guardar los planos que se suban al sistema
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
     */
    function guardarPlanosEdificio(informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_planos_edificio",
                data: informacion,
                dataType: "json",
                contentType: false,
                processData: false,
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
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
     * Función que permite guardar las fotos que se suban al sistema
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
     */
    function guardarFotosEdificio(informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_fotos_edificio",
                data: informacion,
                dataType: "json",
                contentType: false,
                processData: false,
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
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
     * Función que permite guardar los planos que se suban al sistema
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
     */
    function guardarPlanosEspacio(informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_planos_espacio",
                data: informacion,
                dataType: "json",
                contentType: false,
                processData: false,
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
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
     * Función que permite guardar las fotos que se suban al sistema
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
     */
    function guardarFotosEspacio(informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_fotos_espacio",
                data: informacion,
                dataType: "json",
                contentType: false,
                processData: false,
                async: false,
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
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
     * Función que realiza una consulta de las sedes presentes en el sistema
     * @returns {data} object json
    **/
    function buscarSedes(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_sedes",
                data: "buscar=",
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
     * Función que realiza una consulta de los campus presentes en el sistema
     * @returns {data} object json
    **/
    function buscarCampus(sede){
        var jObject = JSON.stringify(sede);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_campus",
                data: {jObject:jObject},
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
     * Función que realiza una consulta de los campus presentes en el sistema
     * @returns {data} object json
    **/
    function ubicacionCampus(info){
        var jObject = JSON.stringify(info);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=ubicacion_campus",
                data: {jObject:jObject},
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
     * Función que realiza una consulta de los edificios del campus seleccionado
     * presentes en el sistema
     * @returns {data} object json
    **/
    function buscarEdificios(campus){
        var jObject = JSON.stringify(campus);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_edificios",
                data: {jObject:jObject},
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
     * Función que realiza una consulta el número de pisos de un edificio
     * @returns {data} object json
    **/
    function buscarPisosEdificio(edificio){
        var jObject = JSON.stringify(edificio);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_pisos_edificio",
                data: {jObject:jObject},
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
     * Función que realiza una consulta de las sedes presentes en el sistema
     * @returns {data} object json
    **/
    function buscarUsosEspacios(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_usos_espacios",
                data: "buscar=",
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
     * Función que realiza una consulta de los materiales presentes en el sistema
     * @param {string} informacion, arreglo que contiene el tipo de material a buscar
     * @returns {data} object json
    **/
    function buscarMateriales(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_materiales",
                data: {jObject:jObject},
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
     * Función que realiza una consulta de los objetos presentes en el sistema
     * @param {string} informacion, arreglo que contiene el tipo de objeto a buscar
     * @returns {data} object json
    **/
    function buscarTipoObjetos(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_tipo_objetos",
                data: {jObject:jObject},
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
     * Función que realiza una consulta de los objetos presentes en el sistema
     * @param {string} informacion, arreglo que contiene el tipo de objeto a buscar
     * @returns {data} object json
    **/
    function verificarEspacio(nombreSede,nombreCampus,nombreEdificio,piso,numeroEspacio){
        var espacio = {};
        espacio["nombre_sede"] = nombreSede;
        espacio["nombre_campus"] = nombreCampus;
        espacio["nombre_edificio"] = nombreEdificio;
        espacio["piso"] = piso;
        espacio["numero_espacio"] = numeroEspacio;
        var dataResult;
        var jObject = JSON.stringify(espacio);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=verificar_espacio",
                data: {jObject:jObject},
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
     * Función que llena y actualiza el selector de campus.
     * @returns {undefined}
    **/
    function actualizarSelectSede(){
        var data = buscarSedes();
        $("#nombre_sede").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#nombre_sede");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre_sede;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#nombre_sede");
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de campus.
     * @returns {undefined}
    **/
    function actualizarSelectUsosEspacios(){
        var data = buscarUsosEspacios();
        $("#uso_espacio").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#uso_espacio");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.uso_espacio;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#uso_espacio");
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de material que se ingresa.
     * @param {string} material, nombre del selector a actualizar y tipo de material.
     * @returns {undefined}
    **/
    function actualizarSelectMaterial(material,id){
        if (id == 0) {
            id = "";
        }
        var informacion = {};
        informacion['tipo_material'] = material;
        var data = buscarMateriales(informacion);
        $("#"+material+id).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#"+material+id);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre_material;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#"+material+id);
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de tipo de objeto.
     * @param {string} tipo_objeto, nombre del selector a actualizar y tipo de objeto.
     * @returns {undefined}
    **/
    function actualizarSelectTipoObjeto(tipo_objeto,id){
        if (id == 0) {
            id = "";
        }
        var informacion = {};
        informacion['tipo_objeto'] = tipo_objeto;
        var data = buscarTipoObjetos(informacion);
        $("#"+tipo_objeto+id).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#"+tipo_objeto+id);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.tipo_objeto;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#"+tipo_objeto+id);
            }
        });
    }

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_sede
     * y se actualiza el selector de campus.
     */
    $("#nombre_sede").change(function (e) {
        var sede = {};
        sede["nombre_sede"] = limpiarCadena($("#nombre_sede").val());
        var data = buscarCampus(sede);
        $("#nombre_campus").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#nombre_campus");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre_campus;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#nombre_campus");
            }
        });
        $("#nombre_edificio").empty();
        $("#pisos").empty();
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_campus
     * y se actualiza el selector de edificios.
     */
    $("#nombre_campus").change(function (e) {
        var campus = {};
        campus["nombre_sede"] = limpiarCadena($("#nombre_sede").val());
        campus["nombre_campus"] = limpiarCadena($("#nombre_campus").val());
        var ubicacion = ubicacionCampus(campus);
        var latitud = 0, longitud = 0;
        $.each(ubicacion, function(index, record) {
            if($.isNumeric(index)) {
                latitud = parseFloat(record.lat);
                longitud = parseFloat(record.lng);
            }
        });
        if ((latitud == 0 || isNaN(latitud)) && (longitud == 0 || isNaN(longitud))) {
            getCoordenadas();
        }else{
            var coords =  {
                lng: longitud,
                lat: latitud
            }
            map.panTo(coords);
            google.maps.event.trigger(map, 'resize');
        }
        var data = buscarEdificios(campus);
        $("#nombre_edificio").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#nombre_edificio");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.id + " - " + record.nombre_edificio;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#nombre_edificio");
            }
        });
        $("#pisos").empty();
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_edificio
     * y se actualiza el selector de pisos.
     */
    $("#nombre_edificio").change(function (e) {
        var edificio = {};
        var numeroPisos, terraza, sotano;
        edificio["nombre_edificio"] = limpiarCadena($("#nombre_edificio").val());
        edificio["nombre_campus"] = limpiarCadena($("#nombre_campus").val());
        var data = buscarPisosEdificio(edificio);
        $("#pisos").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#pisos");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                numeroPisos = record.numero_pisos;
                terraza = record.terraza;
                sotano = record.sotano;
            }
        });
        for (var i=0; i<numeroPisos;i++) {
            if (i == 0 && sotano == 'true') {
                aux = "Sotano";
                row = $("<option value='sotano'/>");
                row.text(aux);
                row.appendTo("#pisos");
            }
            aux = i+1;
            row = $("<option value='" + aux + "'/>");
            row.text(aux);
            row.appendTo("#pisos");
            if (i == (numeroPisos-1) && terraza == 'true') {
                aux = "Terraza";
                row = $("<option value='terraza'/>");
                row.text(aux);
                row.appendTo("#pisos");
            }
        };
    });

    /**
     * Se captura el evento cuando se modifica el valor del radio button tiene_espacio_padre
     * y se actualiza el selector de pisos.
     */
    $("#form_espacio_padre").change(function (e) {
        var espacioPadre = $('input[name="tiene_espacio_padre"]:checked').val();
        if (espacioPadre == "true") {
            $('#div_espacio_padre').show();
        }else{
            $('#div_espacio_padre').hide();
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton guardar_sede y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_sede").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la sede?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                if (nombreSede.length == 0){
                    alert("ERROR. Ingrese el nombre de la sede");
                    $("#nombre_sede").focus();
                }else{
                    var informacion = {};
                    informacion['nombre_sede'] = limpiarCadena(nombreSede);
                    var resultado = guardarSede(informacion);
                    mostrarMensaje(resultado.mensaje);
                    if (resultado.verificar) {
                        $("#nombre_sede").val("");
                        window.scrollTo(0,0);
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
     * Se captura el evento cuando se da click en el boton guardar_campus y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_campus").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del campus?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(nombreSede == 'seleccionar' || nombreSede.length == 0){
                    alert("ERROR. Seleccione la sede a la que pertenece el campus");
                    $("#nombre_sede").focus();
                }else if(nombreCampus.length == 0){
                    alert("ERROR. Ingrese el nombre del campus");
                    $("#nombre_campus").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    if (typeof coordenadas != 'undefined' || coordenadas.length > 0) {
                        informacion['lat'] = coordenadas.lat().toFixed(8);
                        informacion['lng'] = coordenadas.lng().toFixed(8);
                    }else{
                        informacion['lat'] = 0;
                        informacion['lng'] = 0;
                    }
                    informacion['nombre_campus'] = limpiarCadena(nombreCampus);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name = foto.name.substring(foto.name.length-50, foto.name.length);
                                }
                                arregloFotos.append('archivo'+i,foto,nombreArchivo);
                            }
                        }
                        for (var i=0;i<planos.files.length;i++) {
                            var plano = planos.files[i];
                            if (plano.size > 2000000) {
                                alert('El archivo: "'+plano.name+"' es muy grande");
                            }else{
                                var nombreArchivo = plano.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = plano.name = plano.name.substring(plano.name.length-50, plano.name.length);
                                }
                                arregloPlanos.append('archivo'+i,plano,nombreArchivo);
                            }
                        }
                        arregloFotos.append('campus',JSON.stringify(informacion));
                        arregloPlanos.append('campus',JSON.stringify(informacion));
                        var resultado = guardarCampus(informacion);
                        var resultadoPlanos = guardarPlanosCampus(arregloPlanos);
                        var resultadoFotos = guardarFotosCampus(arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        console.log(resultado);
                        console.log(resultadoPlanos);
                        console.log(resultadoFotos);
                        var mensaje = "";
                        if (typeof resultadoPlanos[0] !== 'undefined' && resultadoPlanos[0] !== null) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    mensaje += resultadoPlanos.mensaje[i];
                                }
                                if (i<resultadoPlanos.verificar.length-2) {
                                    mensaje += "\n";
                                }
                            }
                        }
                        if (typeof resultadoFotos-+9[0] !== 'undefined' && resultadoFotos-+9[0] !== null) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    mensaje += resultadoFotos.mensaje[i];
                                }
                                if (i<resultadoFotos.verificar.length-1) {
                                    mensaje += "\n";
                                }
                            }
                        }
                        if (mensaje.substring(0,0) != "") {
                            console.log(mensaje.length);
                            alert(mensaje);
                        }
                        if (resultado.verificar) {
                            $("#nombre_sede").val("");
                            $("#nombre_campus").val("");
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas.length = {};
                            window.scrollTo(0,0);
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por edificio es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por edificio es 20");
                            fotos.focus();
                        }
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
     * Se captura el evento cuando se da click en el boton guardar_edificio y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_edificio").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del edificio?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idEdificio = $("#id_edificio").val();
                var nombreEdificio = $("#nombre_edificio").val();
                var numeroPisos = $("#pisos_edificio").val();
                var terraza = $('input[name="terraza"]:checked').val();
                var sotano = $('input[name="sotano"]:checked').val();
                var material_fachada = $("#material_fachada").val();
                var alto_fachada = $("#alto_fachada").val();
                var ancho_fachada = $("#ancho_fachada").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(nombreSede == 'seleccionar' || nombreSede.length == 0){
                    alert("ERROR. Seleccione la sede a la que pertenece el edificio");
                    $("#nombre_sede").focus();
                }else if(nombreCampus == 'seleccionar' || nombreCampus.length == 0){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece el edifiicio");
                    $("#nombre_campus").focus();
                }else if(idEdificio.length == 0){
                    alert("ERROR. Ingrese el código del edificio");
                    $("#id_edificio").focus();
                }else if(nombreEdificio.length == 0){
                    alert("ERROR. Ingrese el nombre del edificio");
                    $("#nombre_edificio").focus();
                }else if(numeroPisos.length == 0){
                    alert("ERROR. Ingrese el número de pisos del edificio");
                    $("#pisos_edificio").focus();
                }else if(terraza == null || terraza.length == 0){
                    alert("ERROR. Establesca si el edificio tiene terraza");
                    $("#terraza").focus();
                }else if(sotano == null || sotano.length == 0){
                    alert("ERROR. Establesca si el edificio tiene sotano");
                    $("#sotano").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_edificio'] = limpiarCadena(idEdificio);
                    informacion['nombre_edificio'] = limpiarCadena(nombreEdificio);
                    informacion['numero_pisos'] = numeroPisos;
                    informacion['terraza'] = terraza;
                    informacion['sotano'] = sotano;
                    informacion['material_fachada'] = material_fachada;
                    informacion['alto_fachada'] = alto_fachada;
                    informacion['ancho_fachada'] = ancho_fachada;
                    if (typeof coordenadas != 'undefined' || coordenadas.length > 0) {
                        informacion['lat'] = coordenadas.lat().toFixed(8);
                        informacion['lng'] = coordenadas.lng().toFixed(8);
                    }else{
                        informacion['lat'] = 0;
                        informacion['lng'] = 0;
                    }
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name = foto.name.substring(foto.name.length-50, foto.name.length);
                                }
                                arregloFotos.append('archivo'+i,foto,nombreArchivo);
                            }
                        }
                        for (var i=0;i<planos.files.length;i++) {
                            var plano = planos.files[i];
                            if (plano.size > 2000000) {
                                alert('El archivo: "'+plano.name+"' es muy grande");
                            }else{
                                var nombreArchivo = plano.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = plano.name = plano.name.substring(plano.name.length-50, plano.name.length);
                                }
                                arregloPlanos.append('archivo'+i,plano,nombreArchivo);
                            }
                        }
                        arregloFotos.append('edificio',JSON.stringify(informacion));
                        arregloPlanos.append('edificio',JSON.stringify(informacion));
                        console.log(informacion);
                        var resultado = guardarEdificio(informacion);
                        var resultadoPlanos = guardarPlanosEdificio(arregloPlanos);
                        var resultadoFotos = guardarFotosEdificio(arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        console.log(resultado);
                        console.log(resultadoPlanos);
                        console.log(resultadoFotos);
                        var mensaje = "";
                        if (typeof resultadoPlanos[0] !== 'undefined' && resultadoPlanos[0] !== null) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    mensaje += resultadoPlanos.mensaje[i];
                                }
                                if (i<resultadoPlanos.verificar.length-2) {
                                    mensaje += "\n";
                                }
                            }
                        }
                        if (typeof resultadoFotos[0] !== 'undefined' && resultadoFotos[0] !== null) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    mensaje += resultadoFotos.mensaje[i];
                                }
                                if (i<resultadoFotos.verificar.length-1) {
                                    mensaje += "\n";
                                }
                            }
                        }
                        if (mensaje.substring(0,0) != "") {
                            console.log(mensaje.length);
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#id_edificio").val("");
                            $("#nombre_edificio").val("");
                            $("#pisos_edificio").val("");
                            $('input[name=terraza]').attr('checked',false);
                            $('input[name=sotano]').attr('checked',false);
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas.length = {};
                            window.scrollTo(0,0);
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por edificio es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por edificio es 20");
                            fotos.focus();
                        }
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
     * Se captura el evento cuando se da click en el boton guardar_edificio y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_espacio").click(function (e){
        try{
            //var confirmacion = window.confirm("¿Guardar la información del espacio?");
            var confirmacion = true;
            if (confirmacion) {
                var aux;
                var actualizarComponente = false;
                var tipoComponente,conteoTipo;
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var nombreEdificio = $("#nombre_edificio").val();
                var piso = $("#pisos").val();
                var numeroEspacio = [];
                var usoEspacio = $("#uso_espacio").val();
                var alturaPared = $("#altura_pared").val();
                var anchoPared = $("#ancho_pared").val();
                var materialPared = $("#material_pared").val();
                var largoTecho = $("#largo_techo").val();
                var anchoTecho = $("#ancho_techo").val();
                var materialTecho = $("#material_techo").val();
                var largoPiso = $("#largo_piso").val();
                var anchoPiso = $("#ancho_piso").val();
                var materialPiso = $("#material_piso").val();
                var espacioPadre = $('input[name="tiene_espacio_padre"]:checked').val();
                var numero_espacio_padre = $("#espacio_padre").val();
                var tipoIluminacion = [];
                var cantidadIluminacion = [];
                var tipoSuministroEnergia = [];
                var tomacorriente = [];
                var cantidadTomacorrientes = [];
                var tipoPuerta = [];
                var cantidadPuertas = [];
                var materialPuerta = [];
                var tipoCerradura = [];
                var gatoPuerta = [];
                var materialMarco = [];
                var anchoPuerta = [];
                var altoPuerta = [];
                var tipoVentana = [];
                var cantidadVentanas = [];
                var materialVentana = [];
                var anchoVentana = [];
                var altoVentana = [];
                var tipoInterruptor = [];
                var cantidadInterruptores = [];
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if (piso == 'sotano') {
                    piso = '0';
                }
                if (piso == 'terraza') {
                    piso = '-1';
                }
                var espacioExistente = {};
                espacioExistente['verificar'] = true;
                espacioExistente['espacioRepetido'] = false;
                for (var i=0;i<=espaciosCont;i++) {
                    if(i==0){
                        numeroEspacio[i] = $("#id_espacio").val();
                    }else{
                        var control = false;
                        for (var a=0;a<i;a++) {
                            var aux = $("#id_espacio"+i).val();
                            if (aux == numeroEspacio[a]) {
                                control = true;
                            }
                        }
                        if (control) {
                            espacioExistente['espacioRepetido'] = true;
                            espacioExistente['input'] = i;
                            break;
                        }else{
                            numeroEspacio[i] = $("#id_espacio"+i).val();
                        }
                    }
                    var comprobarEspacio = verificarEspacio(nombreSede,nombreCampus,nombreEdificio,piso,numeroEspacio[i]);
                    if (!comprobarEspacio.verificar){
                        espacioExistente['verificar'] = false;
                        if (i==0) {
                            espacioExistente['input'] = "";
                        }else{
                            espacioExistente['input'] = i;
                        }
                        break;
                    }
                }
                if(espacioExistente['espacioRepetido']){
                    alert("ERROR. Hay dos o más espacios repetidos");
                    $("#id_espacio"+espacioExistente['input']).focus();
                }else if (!espacioExistente['verificar']) {
                    alert("ERROR. El número de espacio ya esta registrado en el sistema");
                    $("#id_espacio"+espacioExistente['input']).focus();
                }else{
                    for (var i=0;i<=iluminacionCont;i++) {
                        if (i==0) {
                            tipoIluminacion[i] = $("#tipo_iluminacion").val();
                            cantidadIluminacion[i] = $("#cantidad_iluminacion").val();
                        }else{
                            tipoIluminacion[i] = $("#tipo_iluminacion"+i).val();
                            cantidadIluminacion[i] = $("#cantidad_iluminacion"+i).val();
                        }
                    }
                    for (var i=0;i<=tomacorrientesCont;i++) {
                        if (i==0) {
                            tipoSuministroEnergia[i] = $("#tipo_suministro_energia").val();
                            tomacorriente[i] = $("#tomacorriente").val();
                            cantidadTomacorrientes[i] = $("#cantidad_tomacorrientes").val();
                        }else{
                            tipoSuministroEnergia[i] = $("#tipo_suministro_energia"+i).val();
                            tomacorriente[i] = $("#tomacorriente"+i).val();
                            cantidadTomacorrientes[i] = $("#cantidad_tomacorrientes"+i).val();
                        }
                    }
                    for (var i=0;i<=puertasCont;i++) {
                        if (i==0) {
                            tipoPuerta[i] = $("#tipo_puerta").val();
                            cantidadPuertas[i] = $("#cantidad_puertas").val();
                            materialPuerta[i] = $("#material_puerta").val();
                            tipoCerradura[i] = $("#tipo_cerradura").val();
                            gatoPuerta[i] = $('input[name="gato_puerta"]:checked').val();
                            materialMarco[i] = $("#material_marco_puerta").val();
                            anchoPuerta[i] = $("#ancho_puerta").val();
                            altoPuerta[i] = $("#alto_puerta").val();
                        }else{
                            tipoPuerta[i] = $("#tipo_puerta"+i).val();
                            cantidadPuertas[i] = $("#cantidad_puertas"+i).val();
                            materialPuerta[i] = $("#material_puerta"+i).val();
                            tipoCerradura[i] = $("#tipo_cerradura"+i).val();
                            gatoPuerta[i] = $('input[name="gato_puerta"'+i+']:checked').val();
                            materialMarco[i] = $("#material_marco_puerta"+i).val();
                            anchoPuerta[i] = $("#ancho_puerta"+i).val();
                            altoPuerta[i] = $("#alto_puerta"+i).val();
                        }
                    }
                    for (var i=0;i<=ventanasCont;i++) {
                        if (i==0) {
                            tipoVentana[i] = $("#tipo_ventana").val();
                            cantidadVentanas[i] = $("#cantidad_ventanas").val();
                            materialVentana[i] = $("#material_ventana").val();
                            anchoVentana[i] = $("#ancho_ventana").val();
                            altoVentana[i] = $("#alto_ventana").val();
                        }else{
                            tipoVentana[i] = $("#tipo_ventana"+i).val();
                            cantidadVentanas[i] = $("#cantidad_ventanas"+i).val();
                            materialVentana[i] = $("#material_ventana"+i).val();
                            anchoVentana[i] = $("#ancho_ventana"+i).val();
                            altoVentana[i] = $("#alto_ventana"+i).val();
                        }
                    }
                    for (var i=0;i<=interruptoresCont;i++) {
                        if (i==0) {
                            tipoInterruptor[i] = $("#tipo_interruptor").val();
                            cantidadInterruptores[i] = $("#cantidad_interruptores").val();
                        }else{
                            tipoInterruptor[i] = $("#tipo_interruptor"+i).val();
                            cantidadInterruptores[i] = $("#cantidad_interruptores"+i).val();
                        }
                    }
                    if (!validarCadena(nombreSede)) {
                        alert('ERROR. Seleccione la sede a la que pertenece el espacio');
                        $('#nombre_sede').focus();
                    }else if(!validarCadena(nombreCampus)){
                        alert('ERROR. Seleccione el campus al que pertenece el espacio');
                        $('#nombre_campus').focus();
                    }else if(!validarCadena(nombreEdificio)){
                        alert('ERROR. Seleccione el edificio al que pertenece el espacio');
                        $('#nombre_edificio').focus();
                    }else if(!validarCadena(piso)){
                        alert('ERROR. Seleccione el piso al que pertenece el espacio');
                        $('#piso').focus();
                    }else if(!validarNumero(numeroEspacio)){
                        alert('ERROR. Ingrese el número del espacio');
                        $('#numero_espacio').focus();
                    }else if(!validarCadena(usoEspacio)){
                        alert('ERROR. Seleccione el uso que tiene el espacio');
                        $('#uso_espacio').focus();
                    }/*else if(!validarNumero(alturaPared)){
                        alert('ERROR. Ingrese la altura de las paredes del espacio');
                        $('#altura_pared').focus();
                    }else if(!validarNumero(anchoPared)){
                        alert('ERROR. Ingrese la ancho de las paredes del espacio');
                        $('#ancho_pared').focus();
                    }else if(!validarCadena(materialPared)){
                        alert('ERROR. Seleccione el material de las paredes del espacio');
                        $('#material_pared').focus();
                    }else if(!validarNumero(largoTecho)){
                        alert('ERROR. Ingrese el largo del techo del espacio');
                        $('#largo_techo').focus();
                    }else if(!validarNumero(anchoTecho)){
                        alert('ERROR. Ingrese el largo del techo del espacio');
                        $('#ancho_techo').focus();
                    }else if(!validarCadena(materialTecho)){
                        alert('ERROR. Seleccione el material del techo del espacio');
                        $('#material_techo').focus();
                    }else if(!validarNumero(largoPiso)){
                        alert('ERROR. Ingrese el largo del piso del espacio');
                        $('#largo_piso').focus();
                    }else if(!validarNumero(anchoPiso)){
                        alert('ERROR. Ingrese el ancho del piso del espacio');
                        $('#ancho_piso').focus();
                    }else if(!validarNumero(materialPiso)){
                        alert('ERROR. Seleccione el material del piso del espacio');
                        $('#material_piso').focus();
                    }else if ((aux = validarArregloCadenas(tipoIluminacion)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el tipo de lámpara que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el tipo de lámpara ('+aux+') que tiene el espacio');
                        }
                        $('#tipo_iluminacion'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(cantidadIluminacion)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el número de lámparas que tiene el espacio');
                        }else{
                            alert('ERROR. Ingrese el número de lámparas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#cantidad_iluminacion'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(tipoSuministroEnergia)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el tipo de suministro de energía que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el tipo de suministro de energía ('+aux+') que tiene el espacio');
                        }
                        $('#tipo_suministro_energia'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(tomacorriente)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el tipo de tomacorrientes que tiene el espacio');
                        }else{
                            alert('ERROR. Ingrese el tipo de tomacorrientes del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#tomacorriente'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(cantidadTomacorrientes)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el número de tomacorrientes que tiene el espacio');
                        }else{
                            alert('ERROR. Ingrese el número de tomacorrientes del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#cantidad_tomacorrientes'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(tipoPuerta)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el tipo de puerta que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el tipo de puerta ('+aux+') que tiene el espacio');
                        }
                        $('#tipo_puerta'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(cantidadPuertas)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el número de puertas que tiene el espacio');
                        }else{
                            alert('ERROR. Ingrese el número de puertas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#cantidad_puertas'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(materialPuerta)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el material de la puerta que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el material de la puerta del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#material_puerta'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(tipoCerradura)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el tipo de cerradura de la puerta que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el tipo de cerradura de la puerta del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#tipo_cerradura'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(gatoPuerta)) != null) {
                        if (aux == '') {
                            alert('ERROR. Especifique si la puerta tiene gato');
                        }else{
                            alert('ERROR. Especifique si la puerta del tipo ('+aux+') tiene gato');
                        }
                        $('#gato_puerta'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(materialMarco)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el material del marco la puerta que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el material del marco la puerta del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#material_marco'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(anchoPuerta)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el ancho de las puertas del espacio');
                        }else{
                            alert('ERROR. Ingrese el ancho de las puertas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#ancho_puerta'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(altoPuerta)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el alto de las puertas del espacio');
                        }else{
                            alert('ERROR. Ingrese el alto de las puertas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#alto_puerta'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(tipoVentana)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el tipo de ventana que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el tipo de ventana del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#tipo_ventana'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(cantidadVentanas)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el número de ventanas del espacio');
                        }else{
                            alert('ERROR. Ingrese el número de de ventanas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#cantidad_ventanas'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(materialVentana)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el material de la ventana que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el material de la ventana del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#material_ventana'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(anchoVentana)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el ancho de las ventanas del espacio');
                        }else{
                            alert('ERROR. Ingrese el ancho de las ventanas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#ancho_ventana'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(altoVentana)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el alto de las ventanas del espacio');
                        }else{
                            alert('ERROR. Ingrese el alto de las ventanas del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#alto_ventana'+aux+'').focus();
                    }else if ((aux = validarArregloCadenas(tipoInterruptor)) != null) {
                        if (aux == '') {
                            alert('ERROR. Seleccione el tipo de interruptores que tiene el espacio');
                        }else{
                            alert('ERROR. Seleccione el tipo de interruptores del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#tipo_interruptor'+aux+'').focus();
                    }else if ((aux = validarArregloNumeros(cantidadInterruptores)) != null) {
                        if (aux == '') {
                            alert('ERROR. Ingrese el número de interruptores que tiene el espacio');
                        }else{
                            alert('ERROR. Ingrese el número de interruptores del tipo ('+aux+') que tiene el espacio');
                        }
                        $('#cantidad_interruptores'+aux+'').focus();
                    }*/else if(!validarCadena(espacioPadre)){
                        alert('ERROR. Especifique si el espacio está dentro de otro');
                        $('#tiene_espacio_padre').focus();
                    }else if(espacioPadre == 'true'){
                        if((espacioPadre != null) && (espacioPadre != 'false') && (!validarNumero(numero_espacio_padre))){
                            alert('ERROR. Especifique el número del espacio dentro del cual está el espacio a crear');
                            $('#espacio_padre').focus();
                        }else if(verificarEspacio(nombreSede,nombreCampus,nombreEdificio,piso,numero_espacio_padre).verificar){
                            alert('ERROR. El espacio dentro del cual está el espacio a crear no existe');
                            $('#espacio_padre').focus();
                        }
                    }else{
                        var informacion = {};
                        informacion['nombre_sede'] = nombreSede;
                        informacion['nombre_campus'] = nombreCampus;
                        informacion['nombre_edificio'] = nombreEdificio;
                        informacion['piso'] = piso;
                        informacion['numero_espacio'] = numeroEspacio;
                        informacion['uso_espacio'] = usoEspacio;
                        informacion['altura_pared'] = alturaPared;
                        informacion['ancho_pared'] = anchoPared;
                        informacion['material_pared'] = materialPared;
                        informacion['largo_techo'] = largoTecho;
                        informacion['ancho_techo'] = anchoTecho;
                        informacion['material_techo'] = materialTecho;
                        informacion['largo_piso'] = largoPiso;
                        informacion['ancho_piso'] = anchoPiso;
                        informacion['material_piso'] = materialPiso;
                        informacion['tipo_iluminacion'] = tipoIluminacion;
                        informacion['cantidad_iluminacion'] = cantidadIluminacion;
                        informacion['tipo_suministro_energia'] = tipoSuministroEnergia;
                        informacion['tomacorriente'] = tomacorriente;
                        informacion['cantidad_tomacorrientes'] = cantidadTomacorrientes;
                        informacion['tipo_puerta'] = tipoPuerta;
                        informacion['cantidad_puertas'] = cantidadPuertas;
                        informacion['material_puerta'] = materialPuerta;
                        informacion['tipo_cerradura'] = tipoCerradura;
                        informacion['gato_puerta'] = gatoPuerta;
                        informacion['material_marco'] = materialMarco;
                        informacion['ancho_puerta'] = anchoPuerta;
                        informacion['alto_puerta'] = altoPuerta;
                        informacion['tipo_ventana'] = tipoVentana;
                        informacion['cantidad_ventanas'] = cantidadVentanas;
                        informacion['material_ventana'] = materialVentana;
                        informacion['ancho_ventana'] = anchoVentana;
                        informacion['alto_ventana'] = altoVentana;
                        informacion['tipo_interruptor'] = tipoInterruptor;
                        informacion['cantidad_interruptores'] = cantidadInterruptores;
                        informacion['numero_espacio_padre'] = numero_espacio_padre;
                        var arregloFotos = new FormData();
                        var arregloPlanos = new FormData();
                        if (piso == 'sotano') {
                            informacion['piso'] = '0';
                        }
                        if (piso == 'terraza') {
                            informacion['piso'] = '-1';
                        }
                        if (fotos.files.length <= 20 || planos.files.length <= 5) {
                            for (var i=0;i<fotos.files.length;i++) {
                                var foto = fotos.files[i];
                                if (foto.size > 2000000) {
                                    alert('La foto: "'+foto.name+"' es muy grande");
                                }else{
                                    var nombreArchivo = foto.name;
                                    if(nombreArchivo.length > 50){
                                        nombreArchivo = foto.name = foto.name.substring(foto.name.length-50, foto.name.length);
                                    }
                                    arregloFotos.append('archivo'+i,foto,nombreArchivo);
                                }
                            }
                            for (var i=0;i<planos.files.length;i++) {
                                var plano = planos.files[i];
                                if (plano.size > 2000000) {
                                    alert('El archivo: "'+plano.name+"' es muy grande");
                                }else{
                                    var nombreArchivo = plano.name;
                                    if(nombreArchivo.length > 50){
                                        nombreArchivo = plano.name = plano.name.substring(plano.name.length-50, plano.name.length);
                                    }
                                    arregloPlanos.append('archivo'+i,plano,nombreArchivo);
                                }
                            }
                            arregloFotos.append('espacio',JSON.stringify(informacion));
                            arregloPlanos.append('espacio',JSON.stringify(informacion));
                            dataEspacio['fotos'] = arregloFotos;
                            dataEspacio['planos'] = arregloPlanos;
                            dataEspacio = informacion;
                            $('#botones_punto_sanitario').hide();
                            $('#botones_lavamanos').hide();
                            $('#botones_orinal').hide();
                            if (usoEspacio == '1') { //Salón
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del salón<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>Capacidad del salón<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="capacidad" id="capacidad" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>¿El salón tiene punto(s) de videobeam?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Salón');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '2'){ //Auditorio
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del auditorio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>Capacidad del auditorio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="capacidad" id="capacidad" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>¿El auditorio tiene punto(s) de videobeam?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Auditorio');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '3'){ //Laboratorio
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del laboratorio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>Capacidad del laboratorio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="capacidad" id="capacidad" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>¿El laboratorio tiene punto(s) de videobeam?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label>'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos del laboratorio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                                    +'<div id="punto_sanitario">'
                                    +'<div class="div_izquierda"><b>Tipo de punto sanitario del laboratorio<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario" required></select><br>'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del laboratorio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios" value="" required/><br>'
                                    +'</div>'
                                    +'</div>';
                                $('#botones_punto_sanitario').show();
                                añadirComponente("informacionEspacio",componente);
                                actualizarSelectTipoObjeto("tipo_punto_sanitario",0);
                                $('#guardar_espacio_adicional').val('Crear Laboratorio');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '4'){ //Sala de Cómputo
                                console.log("1");
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red de la sala de cómputo<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>Capacidad de la sala de cómputo<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="capacidad" id="capacidad" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>¿La sala de cómputo tiene punto(s) de videobeam?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Sala');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '5'){ //Oficina
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red de la oficina<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Oficina');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '6'){ //Baño
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Tipo de inodoro<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_inodoro" id="tipo_inodoro" required></select><br>'
                                    +'<div class="div_izquierda"><b>Cantidad de inodoros<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_indoros" id="cantidad_indoros" value="" required/><br>'
                                    +'<div id="lavamanos">'
                                    +'<div class="div_izquierda"><b>Tipo de lavamanos<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_lavamanos" id="tipo_lavamanos" required></select><br>'
                                    +'<div class="div_izquierda"><b>Cantidad de lavamanos<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_lavamanos" id="cantidad_lavamanos" value="" required/><br>'
                                    +'</div>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                var componente = '<br><div id="informacion2">'
                                    +'<div class="div_izquierda"><b>Tipo de divisiones<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_divisiones" id="tipo_divisiones" required></select><br>'
                                    +'<div class="div_izquierda"><b>Material de las divisiones<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="material_divisiones" id="material_divisiones" required></select><br>'
                                    +'<div class="div_izquierda"><b>¿El baño tiene ducha?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="ducha" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="ducha" value="false">No</label>'
                                    +'<div class="div_izquierda"><b>¿El baño tiene lavatraperos?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="lavatraperos" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="lavatraperos" value="false">No</label>'
                                    +'<div class="div_izquierda"><b>Cantidad de sifones<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_sifones" id="cantidad_sifones" value="" required/><br>'
                                    +'<div id="orinal">'
                                    +'<div class="div_izquierda"><b>Tipo de orinal<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_orinal" id="tipo_orinal" required></select><br>'
                                    +'<div class="div_izquierda"><b>Cantidad de orinales<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_orinales" id="cantidad_orinales" value="" required/><br>'
                                    +'</div>'
                                    +'</div>';
                                $('#botones_lavamanos').show();
                                $('#botones_orinal').show();
                                añadirComponente("informacionEspacio2",componente);
                                actualizarSelectTipoObjeto("tipo_inodoro",0);
                                actualizarSelectTipoObjeto("tipo_orinal",0);
                                actualizarSelectTipoObjeto("tipo_lavamanos",0);
                                actualizarSelectTipoObjeto("tipo_divisiones",0);
                                actualizarSelectMaterial("material_divisiones",0);
                                $('#guardar_espacio_adicional').val('Crear Baño');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '7'){ //Cuarto Técnico
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del cuarto técnico<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'<div class="div_izquierda"><b>¿El cuarto técnico tiene punto(s) de videobeam?<font color="red">*</font>:</b></div>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                    +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Cuarto');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '8'){ //Bodega/Almacen
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red de la bodega o almacén<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Bodega/Almacén');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '9'){ //Cuarto Eléctrico
                                guardarEspacio();
                            }else if(usoEspacio == '10'){ //Cuarto de Plantas
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del cuarto de Plantas<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Cuarto');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '11'){ //Cuarto de Aires Acondicionados
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del cuarto de Aires Acondicionados<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Cuarto');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '12'){ //Área Deportiva Cerrada
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del área deportiva cerrada<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Área');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '13'){ //Unidad de Almacenamiento de Residuos
                                guardarEspacio();
                            }else if(usoEspacio == '14'){ //Centro de Datos/Teléfono
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red del centro de datos/teléfono<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Centro de Datos');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '15'){ //Cafetería
                                guardarEspacio();
                            }else if(usoEspacio == '16'){ //Ascensor
                                guardarEspacio();
                            }else if(usoEspacio == '17'){ //Cuarto de Bombas
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos del cuarto de bombas<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                                    +'<div id="punto_sanitario">'
                                    +'<div class="div_izquierda"><b>Tipo de punto sanitario del cuarto de bombas<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario" required></select><br>'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del cuarto de bombas<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios" value="" required/><br>'
                                    +'</div>'
                                    +'</div>';
                                $('#botones_punto_sanitario').show();
                                añadirComponente("informacionEspacio",componente);
                                actualizarSelectTipoObjeto("tipo_punto_sanitario",0);
                                $('#guardar_espacio_adicional').val('Crear Cuarto');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '18'){ //Buitrón
                                guardarEspacio();
                            }else if(usoEspacio == '19'){ //Cocineta
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos de la cocineta<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                                    +'<div id="punto_sanitario">'
                                    +'<div class="div_izquierda"><b>Tipo de punto sanitario de la cocineta<font color="red">*</font>:</b></div>'
                                    +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario" required></select><br>'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios de la cocineta<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios" value="" required/><br>'
                                    +'</div>'
                                    +'</div>';
                                $('#botones_punto_sanitario').show();
                                añadirComponente("informacionEspacio",componente);
                                actualizarSelectTipoObjeto("tipo_punto_sanitario",0);
                                $('#guardar_espacio_adicional').val('Crear Cocineta');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '20'){ //Sala de Estudio
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                    +'<div class="div_izquierda"><b>Cantidad de puntos de red de la sala de estudio<font color="red">*</font>:</b></div>'
                                    +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                    +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Sala');
                                $('#divDialogCreacion').modal('show');
                            }
                        }else{
                            if (planos.files.length <= 5) {
                                alert("ERROR. El número máximo de planos por espacio es 5");
                                planos.focus();
                            }else{
                                alert("ERROR. El número máximo de fotos por espacio es 20");
                                fotos.focus();
                            }
                        }
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
     * Se captura el evento cuando se da click en el boton guardar_edificio y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_espacio_adicional").click(function (e){
        var informacion = {};
        var usoEspacio = $("#uso_espacio").val();
        if (usoEspacio == '1') { //Salón
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntosRed = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntosRed;
        }else if(usoEspacio == '2'){ //Auditorio
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntosRed = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntosRed;
        }else if(usoEspacio == '3'){ //Laboratorio
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntosRed = $('input[name="punto_videobeam"]:checked').val();
            var cantidadPuntosHidraulicos = $("#cantidad_puntos_hidraulicos").val();
            var tipoPuntosSanitarios = [];
            var cantidadPuntosSanitarios = [];
            for (var i=0;i<=puntosSanitariosCont;i++) {
                if (i==0) {
                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario").val();
                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios").val();
                }else{
                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario"+i).val();
                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios"+i).val();
                }
            }
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntosRed;
            informacion["cantidad_puntos_hidraulicos"] = cantidadPuntosHidraulicos;
            informacion["tipo_punto_sanitario"] = tipoPuntosSanitarios;
            informacion["cantidad_puntos_sanitarios"] = cantidadPuntosSanitarios;
        }else if(usoEspacio == '4'){ //Sala de Cómputo
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntosRed = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntosRed;
        }else if(usoEspacio == '5'){ //Oficina
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }else if(usoEspacio == '6'){ //Baño
            var tipoInodoro = $("#tipo_inodoro").val();
            var cantidadInodoros = $("#cantidad_indoros").val();
            var tipoLavamanos = $("#tipo_lavamanos").val();
            var cantidadLavamanos = $("#cantidad_lavamanos").val();
            var tipoDivisiones = $("#tipo_divisiones").val();
            var materialDivisiones = $("#material_divisiones").val();
            var ducha = $('input[name="ducha"]:checked').val();
            var lavatraperos = $('input[name="lavatraperos"]:checked').val();
            var cantidadSifones = $("#cantidad_sifones").val();
            var tipoLavamanos = [];
            var cantidadLavamanos = [];
            for (var i=0;i<=lavamanosCont;i++) {
                if (i==0) {
                    tipoLavamanos[i] = $("#tipo_lavamanos").val();
                    cantidadLavamanos[i] = $("#cantidad_lavamanos").val();
                }else{
                    tipoLavamanos[i] = $("#tipo_lavamanos"+i).val();
                    cantidadLavamanos[i] = $("#cantidad_lavamanos"+i).val();
                }
            }
            var tipoOrinal = [];
            var cantidadOrinales = [];
            for (var i=0;i<=orinalesCont;i++) {
                if (i==0) {
                    tipoOrinal[i] = $("#tipo_orinal").val();
                    cantidadOrinales[i] = $("#cantidad_orinales").val();
                }else{
                    tipoOrinal[i] = $("#tipo_orinal"+i).val();
                    cantidadOrinales[i] = $("#cantidad_orinales"+i).val();
                }
            }
            informacion["tipo_inodoro"] = tipoInodoro;
            informacion["cantidad_indoros"] = cantidadInodoros;
            informacion["tipo_orinal"] = tipoOrinal;
            informacion["cantidad_orinales"] = cantidadOrinales;
            informacion["tipo_lavamanos"] = tipoLavamanos;
            informacion["cantidad_lavamanos"] = cantidadLavamanos;
            informacion["tipo_divisiones"] = tipoDivisiones;
            informacion["material_divisiones"] = materialDivisiones;
            informacion["ducha"] = ducha;
            informacion["lavatraperos"] = lavatraperos;
            informacion["cantidad_sifones"] = cantidadSifones;
        }else if(usoEspacio == '7'){ //Cuarto Técnico
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var puntosRed = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["punto_videobeam"] = puntosRed;
        }else if(usoEspacio == '8'){ //Bodega/Almacen
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }else if(usoEspacio == '10'){ //Cuarto de Plantas
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }else if(usoEspacio == '11'){ //Cuarto de Aires Acondicionados
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }else if(usoEspacio == '12'){ //Área Deportiva Cerrada
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }else if(usoEspacio == '14'){ //Centro de Datos/Teléfono
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }else if(usoEspacio == '17'){ //Cuarto de Bombas
            var cantidadPuntosHidraulicos = $("#cantidad_puntos_hidraulicos").val();
            var tipoPuntosSanitarios = [];
            var cantidadPuntosSanitarios = [];
            for (var i=0;i<=puntosSanitariosCont;i++) {
                if (i==0) {
                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario").val();
                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios").val();
                }else{
                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario"+i).val();
                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios"+i).val();
                }
            }
            informacion["cantidad_puntos_hidraulicos"] = cantidadPuntosHidraulicos;
            informacion["tipo_punto_sanitario"] = tipoPuntosSanitarios;
            informacion["cantidad_puntos_sanitarios"] = cantidadPuntosSanitarios;
        }else if(usoEspacio == '19'){ //Cocineta
            var cantidadPuntosHidraulicos = $("#cantidad_puntos_hidraulicos").val();
            var tipoPuntosSanitarios = [];
            var cantidadPuntosSanitarios = [];
            for (var i=0;i<=puntosSanitariosCont;i++) {
                if (i==0) {
                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario").val();
                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios").val();
                }else{
                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario"+i).val();
                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios"+i).val();
                }
            }
            informacion["cantidad_puntos_hidraulicos"] = cantidadPuntosHidraulicos;
            informacion["tipo_punto_sanitario"] = tipoPuntosSanitarios;
            informacion["cantidad_puntos_sanitarios"] = cantidadPuntosSanitarios;
        }else if(usoEspacio == '20'){ //Sala de Estudio
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
        }
        dataEspacio = $.extend(dataEspacio,informacion);
        guardarEspacio();
    });

    /**
     * Se captura el evento cuando se da click en el boton guardar_tipo_material y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_tipo_material").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del tipo de material?");
            if (confirmacion) {
                var tipoMaterial = $("#tipo_material").val();
                var nombreTipoMaterial = $("#nombre_tipo_material").val();
                if(tipoMaterial == 'seleccionar' || tipoMaterial.length == 0){
                    alert("ERROR. Seleccione un tipo de material");
                    $("#tipo_material").focus();
                }else if(tipoMaterial.length == 0){
                    alert("ERROR. Ingrese el nombre del tipo de material");
                    $("#nombre_tipo_material").focus();
                }else{
                    var informacion = {};
                    informacion['tipo_material'] = limpiarCadena(tipoMaterial);
                    informacion['nombre_tipo_material'] = limpiarCadena(nombreTipoMaterial);
                    var resultado = guardarTipoMaterial(informacion);
                    mostrarMensaje(resultado.mensaje);
                    console.log(resultado);
                    if(resultado.verificar){
                        $("#tipo_material").val("");
                        $("#nombre_tipo_material").val("");
                        window.scrollTo(0,0);
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
     * Se captura el evento cuando se da click en el boton guardar_tipo_objeto y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_tipo_objeto").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del tipo de objeto?");
            if (confirmacion) {
                var tipoObjeto = $("#tipo_objeto").val();
                var nombreTipoObjeto = $("#nombre_tipo_objeto").val();
                if(tipoObjeto == 'seleccionar' || tipoObjeto.length == 0){
                    alert("ERROR. Seleccione un tipo de objeto");
                    $("#tipo_objeto").focus();
                }else if(tipoObjeto.length == 0){
                    alert("ERROR. Ingrese el nombre del tipo de objeto");
                    $("#nombre_tipo_objeto").focus();
                }else{
                    var informacion = {};
                    informacion['tipo_objeto'] = limpiarCadena(tipoObjeto);
                    informacion['nombre_tipo_objeto'] = limpiarCadena(nombreTipoObjeto);
                    var resultado = guardarTipoObjeto(informacion);
                    mostrarMensaje(resultado.mensaje);
                    console.log(resultado);
                    if(resultado.verificar){
                        $("#tipo_objeto").val("");
                        $("#nombre_tipo_objeto").val("");
                        window.scrollTo(0,0);
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
     * Se captura el evento cuando se da click en el boton añadir_informacion_adicional y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_informacion_adicional").click(function (e){
        $("#informacion-adicional").show();
        $("#añadir_informacion_adicional").attr('disabled','disabled');
        $('#eliminar_informacion_adicional').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_informacion_adicional y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_informacion_adicional").click(function (e){
        $("#informacion-adicional").hide();
        $("#eliminar_informacion_adicional").attr('disabled','disabled');
        $('#añadir_informacion_adicional').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_iluminacion y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_iluminacion").click(function (e){
        iluminacionCont++;
        var componente = '<div id="iluminacion'+iluminacionCont+'">'
        +'<div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion'+iluminacionCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_iluminacion" id="cantidad_iluminacion'+iluminacionCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("iluminacion",componente);
        actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
        $('#eliminar_iluminacion').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_iluminacion y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_iluminacion").click(function (e){
        eliminarComponente("iluminacion"+iluminacionCont);
        iluminacionCont--;
        if(iluminacionCont == 0){
            $("#eliminar_iluminacion").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_tomacorriente y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_tomacorriente").click(function (e){
        tomacorrientesCont++;
        var componente = '<div id="suministro_energia'+tomacorrientesCont+'">'
        +'<div class="div_izquierda"><b>Tipo de suministro de energía ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_suministro_energia" id="tipo_suministro_energia'+tomacorrientesCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Tomacorriente ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tomacorriente" id="tomacorriente'+tomacorrientesCont+'" required>'
        +'<option value="seleccionar" selected="selected">--Seleccionar--</option>'
        +'<option value="regulado">Regulado</option>'
        +'<option value="no regulado">No Regulado</option>'
        +'</select><br>'
        +'<div class="div_izquierda"><b>Cantidad de tomacorrientes del tipo ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_tomacorrientes" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("suministro_energia",componente);
        actualizarSelectTipoObjeto("tipo_suministro_energia",tomacorrientesCont);
        $('#eliminar_tomacorriente').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_tomacorriente y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_tomacorriente").click(function (e){
        eliminarComponente("suministro_energia"+tomacorrientesCont);
        tomacorrientesCont--;
        if(tomacorrientesCont == 0){
            $("#eliminar_tomacorriente").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_puerta y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_puerta").click(function (e){
        puertasCont++;
        var componente = '<div id="puerta'+puertasCont+'">'
        +'<div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_puerta" id="tipo_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_puertas" id="cantidad_puertas'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="material_puerta" id="material_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Tipo de cerradura ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_cerradura" id="tipo_cerradura'+puertasCont+'" required></select><br>'
        //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="añadir_tipo_cerradura" id="añadir_tipo_cerradura'+puertasCont+'" value="Añadir Tipo" title="Añadir Tipo Cerradura"/>'
        //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="eliminar_tipo_cerradura" id="eliminar_tipo_cerradura'+puertasCont+'" value="Eliminar Tipo" title="Eliminar Tipo Cerradura" disabled/>'
        +'<div class="div_izquierda"><b>¿La Puerta tiene gato? ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="true">S&iacute;</label>'
        +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="false">No</label><br>'
        +'<div class="div_izquierda"><b>Material del marco ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="material_marco" id="material_marco" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="ancho_puerta" id="ancho_puerta'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="alto_puerta" id="alto_puerta'+puertasCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("puerta",componente);
        actualizarSelectMaterial("material_puerta",puertasCont);
        actualizarSelectTipoObjeto("tipo_puerta",puertasCont);
        $('#eliminar_puerta').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_puerta y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_puerta").click(function (e){
        eliminarComponente("puerta"+puertasCont);
        puertasCont--;
        if(puertasCont == 0){
            $("#eliminar_puerta").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_ventana y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_ventana").click(function (e){
        ventanasCont++;
        var componente = '<div id="ventana'+ventanasCont+'">'
        +'<div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_ventana" id="tipo_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_ventanas" id="cantidad_ventanas'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="material_ventana" id="material_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="ancho_ventana" id="ancho_ventana'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="alto_ventana" id="alto_ventana'+ventanasCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("ventana",componente);
        actualizarSelectMaterial("material_ventana",ventanasCont);
        actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
        $('#eliminar_ventana').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_ventana y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_ventana").click(function (e){
        eliminarComponente("ventana"+ventanasCont);
        ventanasCont--;
        if(ventanasCont == 0){
            $("#eliminar_ventana").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_interruptor y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_interruptor").click(function (e){
        interruptoresCont++;
        var componente = '<div id="interruptor'+interruptoresCont+'">'
        +'<div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_interruptor" id="tipo_interruptor'+interruptoresCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_interruptores" id="cantidad_interruptores'+interruptoresCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("interruptor",componente);
        actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
        $('#eliminar_interruptor').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_interruptor y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_interruptor").click(function (e){
        eliminarComponente("interruptor"+interruptoresCont);
        interruptoresCont--;
        if(interruptoresCont == 0){
            $("#eliminar_interruptor").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_punto_sanitario y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_punto_sanitario").click(function (e){
        puntosSanitariosCont++;
        var componente = '<div id="punto_sanitario'+puntosSanitariosCont+'">'
        +'<div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario'+puntosSanitariosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("punto_sanitario",componente);
        actualizarSelectTipoObjeto("tipo_punto_sanitario",puntosSanitariosCont);
        $('#eliminar_punto_sanitario').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_punto_sanitario").click(function (e){
        eliminarComponente("punto_sanitario"+puntosSanitariosCont);
        puntosSanitariosCont--;
        if(puntosSanitariosCont == 0){
            $("#eliminar_punto_sanitario").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_punto_sanitario y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_orinal").click(function (e){
        orinalesCont++;
        var componente = '<div id="orinal'+orinalesCont+'">'
        +'<div class="div_izquierda"><b>Tipo de orinal ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_orinal" id="tipo_orinal'+orinalesCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de orinales del tipo ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_orinales" id="cantidad_orinales'+orinalesCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("orinal",componente);
        actualizarSelectTipoObjeto("tipo_orinal",orinalesCont);
        $('#eliminar_orinal').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_orinal").click(function (e){
        eliminarComponente("orinal"+orinalesCont);
        orinalesCont--;
        if(orinalesCont == 0){
            $("#eliminar_orinal").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton añadir_lavamanos y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_lavamanos").click(function (e){
        lavamanosCont++;
        var componente = '<div id="lavamanos'+lavamanosCont+'">'
        +'<div class="div_izquierda"><b>Tipo de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_lavamanos" id="tipo_lavamanos'+lavamanosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="0" name="cantidad_lavamanos" id="cantidad_lavamanos'+lavamanosCont+'" value="" required/><br>'
        +'</div>'
        +'</div>';
        añadirComponente("lavamanos",componente);
        actualizarSelectTipoObjeto("tipo_lavamanos",lavamanosCont);
        $('#eliminar_lavamanos').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_lavamanos y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_lavamanos").click(function (e){
        eliminarComponente("lavamanos"+lavamanosCont);
        lavamanosCont--;
        if(lavamanosCont == 0){
            $("#eliminar_lavamanos").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
     */
    $("#agregar_espacio").click(function (e){
        espaciosCont++;
        var componente = '<div id="espacio'+espaciosCont+'">'
        +'<br><div class="input-group">'
        +'<input class="form-control formulario" type="number" min="1" name="id_espacio" id="id_espacio'+espaciosCont+'" value="" placeholder="Ej: 1001" required/>'
        +'<span class="input-group-btn">'
        +'</span>'
        +'</div>'
        +'</div>';
        añadirComponente("espacio",componente);
        $('#eliminar_espacio').removeAttr("disabled");
    });

    $("#eliminar_espacio").click(function (e){
        eliminarComponente("espacio"+espaciosCont);
        espaciosCont--;
        if(espaciosCont == 0){
            $("#eliminar_espacio").attr('disabled','disabled');
        }
    });

    /**
     * Se captura el evento cuando se cierra el modal divDialogCreacion y se
     * realiza la operacion correspondiente.
     */
    $('#divDialogCreacion').on('hidden.bs.modal', function () {
        puntosSanitariosCont = 0;
        lavamanosCont = 0;
        orinalesCont = 0;
        $("#eliminar_lavamanos").attr('disabled','disabled');
        $("#eliminar_punto_sanitario").attr('disabled','disabled');
        $("#eliminar_orinal").attr('disabled','disabled');
    });
});
