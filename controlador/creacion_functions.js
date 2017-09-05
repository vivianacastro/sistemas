$(document).ready(function() {

    var numeroAires, espaciosCont = 0, iluminacionCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0, puntosSanitariosCont = 0, lavamanosCont = 0, orinalesCont = 0, proveedoresCont = 0;
    var coordenadas = {};
    var dataEspacio = {};
    var arregloFotosEspacio = new FormData();
    var arregloPlanosEspacio = new FormData();
    var map;
    var icono = "";
    var URLactual = window.location;

    /**
     * Función que se ejecuta al momento que se accede a la página que lo tiene
     * incluido.
     * @returns {undefined}
    */
    (function (){
        if(URLactual['href'].indexOf('crear_campus') >= 0){
            actualizarSelectSede();
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_campus.png';
        }else if(URLactual['href'].indexOf('crear_edificio') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_fachada",0);
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_edificio.png';
        }else if(URLactual['href'].indexOf('crear_cancha') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_cancha.png';
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
            icono = 'vistas/images/icono_corredor.png';
        }else if(URLactual['href'].indexOf('crear_cubierta') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_cubierta",0);
            actualizarSelectTipoObjeto("tipo_cubierta",0);
        }else if(URLactual['href'].indexOf('crear_gradas') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_pasamanos",0);
            actualizarSelectMaterial("material_ventana",0);
            actualizarSelectTipoObjeto("tipo_ventana",0);
        }else if(URLactual['href'].indexOf('crear_parqueadero') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_parqueadero.png';
        }else if(URLactual['href'].indexOf('crear_piscina') >= 0){
            actualizarSelectSede();
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_piscina.png';
        }else if(URLactual['href'].indexOf('crear_plazoleta') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_plazoleta.png';
        }else if(URLactual['href'].indexOf('crear_sendero') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_cubierta",0);
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_sendero.png';
        }else if(URLactual['href'].indexOf('crear_via') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            getCoordenadas();
            icono = 'vistas/images/icono_via.png';
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
        }else if(URLactual['href'].indexOf('crear_aire') >= 0){
            actualizarSelectSede();
            actualizarSelectCapacidadAire();
            actualizarSelectMarcaAire();
            actualizarSelectTipoObjeto("tipo_tecnologia_aire",0);
            actualizarSelectTipoObjeto("tipo_periodicidad_mantenimiento",0);
            actualizarSelectTipoObjeto("tipo_aire",0);
            $('.form-group #fecha_instalacion').datepicker({
                endDate: "today",
                todayBtn: "linked",
                language: "es",
                autoclose: true,
                orientation: "auto"
            });
        }else if(URLactual['href'].indexOf('registrar_mantenimiento_aire') >= 0){
            actualizarSelectSede();
            $('.form-group #fecha_realizacion').datepicker({
                endDate: "today",
                todayBtn: "linked",
                language: "es",
                autoclose: true,
                orientation: "auto"
            });
        }else if(URLactual['href'].indexOf('crear_articulo') >= 0){
            /*actualizarSelectMarcas();
            actualizarSelectCategorias();
            actualizarSelectProveedores(proveedoresCont);*/
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
            center: {lat: 3.375119, lng: -76.5336927}, //Coordenadas Univalle - Meléndez
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        if(URLactual['href'].indexOf('crear_campus') >= 0){
            icono = 'vistas/images/icono_campus.png';
        }else if(URLactual['href'].indexOf('crear_edificio') >= 0 || URLactual['href'].indexOf('crear_aire') >= 0){
            icono = 'vistas/images/icono_edificio.png';
        }else if(URLactual['href'].indexOf('crear_cancha') >= 0){
            icono = 'vistas/images/icono_cancha.png';
        }else if(URLactual['href'].indexOf('crear_corredor') >= 0){
            icono = 'vistas/images/icono_corredor.png';
        }else if(URLactual['href'].indexOf('crear_parqueadero') >= 0){
            icono = 'vistas/images/icono_parqueadero.png';
        }else if(URLactual['href'].indexOf('crear_piscina') >= 0){
            icono = 'vistas/images/icono_piscina.png';
        }else if(URLactual['href'].indexOf('crear_plazoleta') >= 0){
            icono = 'vistas/images/icono_plazoleta.png';
        }else if(URLactual['href'].indexOf('crear_sendero') >= 0){
            icono = 'vistas/images/icono_sendero.png';
        }else if(URLactual['href'].indexOf('crear_via') >= 0){
            icono = 'vistas/images/icono_via.png';
        }
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
                draggable: true,
                icon: icono
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
                coordenadas = null;
                drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
            });
        });
    }

    /**
     * Función que permite crear un tipo de objeto.
     * @param {string} tipo_objeto, tipo de objeto a guardar (sede, campus, edificio, etc., a excepción de los espacios).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data}
    */
    function guardarObjeto(tipo_objeto,informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_"+tipo_objeto,
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
     * Función que permite crear un espacio.
     * @param {array} informacion, información del espacio.
     * @returns {data}
    */
    function guardarEspacio(){
        var jObject = JSON.stringify(dataEspacio);
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
                    var resultadoPlanos = guardarPlanos("espacio",arregloPlanosEspacio);
                    var resultadoFotos = guardarFotos("espacio",arregloFotosEspacio);
                    alert(data.mensaje);
                    var mensaje = "";
                    if (resultadoPlanos.length != 0) {
                        for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                            if (!resultadoPlanos.verificar[i]) {
                                if (mensaje == "") {
                                    mensaje += resultadoPlanos.mensaje[i];
                                }else{
                                    mensaje += "\n" + resultadoPlanos.mensaje[i];
                                }
                            }
                            if (i<resultadoPlanos.verificar.length-2) {
                                mensaje += "\n";
                            }
                        }
                    }
                    if (resultadoFotos.length != 0) {
                        for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                            if (!resultadoFotos.verificar[i]) {
                                if (mensaje == "") {
                                    mensaje += resultadoFotos.mensaje[i];
                                }else{
                                    mensaje += "\n" + resultadoFotos.mensaje[i];
                                }
                            }
                            if (i<resultadoFotos.verificar.length-1) {
                                mensaje += "\n";
                            }
                        }
                    }
                    if (mensaje.substring(0,1) != "") {
                        alert(mensaje);
                    }
                    if(data.verificar){
                        $('#divDialogCreacion').modal('hide');
                        $("#nombre_sede").val("");
                        $("#nombre_campus").empty();
                        $("#nombre_campus").val("");
                        $("#nombre_edificio").empty();
                        $("#nombre_edificio").val("");
                        $("#pisos").empty();
                        $("#pisos").val("");
                        $("#id_espacio").val("");
                        $("#uso_espacio").val("");
                        $("#altura_pared").val("");
                        $("#ancho_pared").val("");
                        $("#material_pared").val("");
                        $("#largo_techo").val("");
                        $("#ancho_techo").val("");
                        $("#material_techo").val("");
                        $("#largo_piso").val("");
                        $("#ancho_piso").val("");
                        $("#material_piso").val("");
                        $("#tipo_iluminacion").val("");
                        $("#cantidad_iluminacion").val("");
                        $("#tipo_suministro_energia").val("");
                        $("#tomacorriente").val("");
                        $("#cantidad_tomacorrientes").val("");
                        $("#tipo_puerta").val("");
                        $("#cantidad_puertas").val("");
                        $("#material_puerta").val("");
                        $("#tipo_cerradura").val("");
                        $('input[name=gato_puerta]').attr('checked',false);
                        $("#material_marco_puerta").val("");
                        $("#ancho_puerta").val("");
                        $("#alto_puerta").val("");
                        $("#cantidad_ventanas").val("");
                        $("#material_ventana").val("");
                        $("#ancho_ventana").val("");
                        $("#alto_ventana").val("");
                        $("#tipo_interruptor").val("");
                        $("#cantidad_interruptores").val("");
                        $("#informacion-adicional").hide();
                        while (iluminacionCont > 0) {
                            eliminarComponente("iluminacion"+iluminacionCont);
                            iluminacionCont--;
                        }
                        while (tomacorrientesCont > 0) {
                            eliminarComponente("suministro_energia"+tomacorrientesCont);
                            tomacorrientesCont--;
                        }
                        while (puertasCont > 0) {
                            eliminarComponente("puerta"+tomacorrientesCont);
                            puertasCont--;
                        }
                        while (ventanasCont > 0) {
                            eliminarComponente("ventana"+tomacorrientesCont);
                            ventanasCont--;
                        }
                        while (interruptoresCont > 0) {
                            eliminarComponente("interruptor"+tomacorrientesCont);
                            interruptoresCont--;
                        }
                        $("#añadir_informacion_adicional").removeAttr('disabled');
                        $("#eliminar_informacion_adicional").attr('disabled',true);
                        $("#divTieneEspacioPadre").hide();
                        $('input[name=tiene_espacio_padre]').attr('checked',false);
                        var planos = document.getElementById("planos[]");
                        var fotos = document.getElementById("fotos[]");
                        planos.value = "";
                        fotos.value = "";
                        for(var i=espaciosCont;i>0;i--){
                            eliminarComponente("espacio"+espaciosCont);
                        }
                        espaciosCont = 0;
                        $("#eliminar_espacio").attr('disabled',true);
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
     * Función que permite consultar los espacios existentes en un piso de un edificio.
     * @param {array} informacion, información del tipo de material.
     * @returns {data}
    */
    function buscarEspacios(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_espacios",
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
     * Función que permite crear un tipo de material.
     * @param {array} informacion, información del tipo de material.
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
     * @param {array} informacion, información del tipo de objeto
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
     * Función que permite guardar los planos que se suban al sistema.
     * @param {string} tipo_objeto, string cone el tipo de objeto (campus,edificio, etc.).
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
    */
    function guardarPlanos(tipo_objeto,informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_planos_"+tipo_objeto,
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
     * @param {string} tipo_objeto, string cone el tipo de objeto (campus,edificio, etc.).
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
    */
    function guardarFotos(tipo_objeto,informacion){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_fotos_"+tipo_objeto,
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
     * @returns {data} object json.
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
     * @param {array} sede, arreglo con la información de la sede a la que pertenece el campus a buscar.
     * @returns {data} object json.
    **/
    function buscarCampus(sede){
        var jObject = JSON.stringify(sede);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_todos_campus",
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
     * @param {array} informacion, arreglo con la información del campus a buscar.
     * @returns {data} object json.
    **/
    function ubicacionCampus(informacion){
        var jObject = JSON.stringify(informacion);
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
     * presentes en el sistema.
     * @param {array} campus, arreglo con la información del campus al que pertenece el edificio a buscar.
     * @returns {data} object json.
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
     * @param {array} edificio, arreglo que contiene el edificio a buscar.
     * @returns {data} object json.
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
     * @returns {data} object json.
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
     * @param {array} informacion, arreglo que contiene el tipo de material a buscar
     * @returns {data} object json.
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
     * @param {array} informacion, arreglo que contiene el tipo de objeto a buscar
     * @returns {data} object json.
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
     * Función que realiza una consulta de las capacidades de los aires acondicionados.
     * @returns {data} object json.
    **/
    function buscarCapacidadAire(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_capacidades_aire",
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
     * Función que realiza una consulta de las capacidades de los aires acondicionados.
     * @returns {data} object json.
    **/
    function buscarAiresEspacio(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_aires_ubicacion",
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
     * Función que realiza una consulta de las marcas de los aires acondicionados.
     * @returns {data} object json.
    **/
    function buscarMarcaAire(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_marcas_aire",
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
     * Función que realiza una consulta de los proveedores.
     * @returns {data} object json.
    **/
    function buscarProveedores(bodega){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_proveedores_"+bodega,
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
     * Función que realiza una consulta de las marcas del inventario.
     * @returns {data} object json.
    **/
    function buscarMarcas(bodega){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_marcas_"+bodega,
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
     * Función que realiza una consulta de las categorías del inventario.
     * @returns {data} object json.
    **/
    function buscarCategorias(bodega){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_categorias_"+bodega,
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
     * Función que realiza una consulta de los espacios presentes en el sistema.
     * @param {string} informacion, arreglo que contiene el espacio a buscar.
     * @returns {data} object json.
    **/
    function verificarEspacio(nombreSede,nombreCampus,nombreEdificio,numeroEspacio){
        var espacio = {};
        espacio["nombre_sede"] = nombreSede;
        espacio["nombre_campus"] = nombreCampus;
        espacio["nombre_edificio"] = nombreEdificio;
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
     * Función que llena y actualiza el selector de sede..
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
     * Función que llena y actualiza el selector de capacida de un aire acondicionado.
     * @returns {undefined}
    **/
    function actualizarSelectCapacidadAire(){
        var data = buscarCapacidadAire();
        $("#capacidad_aire").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#capacidad_aire");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.capacidad;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#capacidad_aire");
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de capacida de un aire acondicionado.
     * @returns {undefined}
    **/
    function actualizarSelectMarcaAire(){
        var data = buscarMarcaAire();
        $("#marca_aire").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#marca_aire");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#marca_aire");
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
     * Función que llena y actualiza el selector de proveedor.
     * @returns {undefined}
    **/
    function actualizarSelectProveedores(id,bodega){
        if (id == 0) {
            id = "";
        }
        var data = buscarProveedores(bodega);
        $("#proveedor_articulo"+id).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#proveedor_articulo"+id);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre;
                row = $("<option value='" + record.id_proveedor + "'/>");
                row.text(aux);
                row.appendTo("#proveedor_articulo"+id);
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de marcas.
     * @returns {undefined}
    **/
    function actualizarSelectMarcas(bodega){
        var data = buscarMarcas(bodega);
        $("#marca").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#marca");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#marca");
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de categorias.
     * @returns {undefined}
    **/
    function actualizarSelectCategorias(bodega){
        var data = buscarCategorias(bodega);
        $("#categoria").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#categoria");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#categoria");
            }
        });
    }

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_sede
     * y se actualiza el selector de campus.
    */
    $("#nombre_sede").change(function (e) {
        $("#divTieneEspacioPadre").hide();
        $('input[name=tiene_espacio_padre]').attr('checked',false);
        $("#div_espacio_padre").hide();
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
        $("#nombre_edificio").val("");
        $("#pisos").empty();
        $("#pisos").val("");
        $("#id_espacio").empty();
        $("#id_espacio").val("");
        $("#id_aire_search").empty();
        $("#id_aire_search").val("").change();
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_campus
     * y se actualiza el selector de edificios.
    */
    $("#nombre_campus").change(function (e) {
        $("#divTieneEspacioPadre").hide();
        $('input[name=tiene_espacio_padre]').attr('checked',false);
        $("#div_espacio_padre").hide();
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
            if (map != undefined) {
                map.panTo(coords);
                map.setZoom(15);
                map.setCenter(coords);
                google.maps.event.trigger(map, 'resize');
            }
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
        $("#pisos").val("");
        $("#id_espacio").empty();
        $("#id_espacio").val("");
        $("#id_aire_search").empty();
        $("#id_aire_search").val("").change();
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_edificio
     * y se actualiza el selector de pisos.
    */
    $("#nombre_edificio").change(function (e) {
        $("#divTieneEspacioPadre").hide();
        $('input[name=tiene_espacio_padre]').attr('checked',false);
        $("#div_espacio_padre").hide();
        var edificio = {};
        var numeroPisos, terraza, sotano;
        edificio["nombre_edificio"] = limpiarCadena($("#nombre_edificio").val());
        edificio["nombre_campus"] = limpiarCadena($("#nombre_campus").val());
        edificio["nombre_sede"] = limpiarCadena($("#nombre_sede").val());
        var data = buscarPisosEdificio(edificio);
        if (URLactual['href'].indexOf('crear_gradas') >= 0) {
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
                    aux = "Sótano";
                    row = $("<option value='sotano'/>");
                    row.text(aux);
                    row.appendTo("#pisos");
                }
                if (i == (numeroPisos-1) && terraza == 'true') {
                    aux = i+1;
                    row = $("<option value='" + aux + "'/>");
                    row.text(aux);
                    row.appendTo("#pisos");
                    aux = "Terraza";
                    /*row = $("<option value='terraza'/>");
                    //row.text(aux);
                    row.appendTo("#pisos");*/
                }else if(i < (numeroPisos-1)){
                    aux = i+1;
                    row = $("<option value='" + aux + "'/>");
                    row.text(aux);
                    row.appendTo("#pisos");
                }
            }
        }else{
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
                    aux = "Sótano";
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
            }
        }
        $("#id_espacio").empty();
        $("#id_espacio").val("");
        $("#id_aire_search").empty();
        $("#id_aire_search").val("").change();
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector de pisos.
    */
    $("#pisos").change(function (e) {
        $("#divTieneEspacioPadre").hide();
        $('input[name=tiene_espacio_padre]').attr('checked',false);
        $("#div_espacio_padre").hide();
        var nombreSede = $("#nombre_sede").val();
        var nombreCampus = $("#nombre_campus").val();
        var nombreEdificio = $("#nombre_edificio").val();
        var piso = $("#pisos").val();
        if (validarCadena(nombreSede) && validarCadena(nombreCampus) && validarCadena(nombreEdificio) && validarCadena(piso)) {
            var informacion = {};
            informacion["nombre_sede"] = nombreSede;
            informacion["nombre_campus"] = nombreCampus;
            informacion["nombre_edificio"] = nombreEdificio;
            informacion["piso"] = piso;
            var data = buscarEspacios(informacion);
            if(URLactual['href'].indexOf('crear_aire') >= 0 || URLactual['href'].indexOf('registrar_mantenimiento_aire') >= 0){
                $("#id_espacio").empty();
                var row = $("<option value=''/>");
                row.text("--Seleccionar--");
                row.appendTo("#id_espacio");
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        aux = record.id;
                        row = $("<option value='" + record.id + "'/>");
                        row.text(aux);
                        row.appendTo("#id_espacio");
                    }
                });
            }else{
                if (data.mensaje != null) {
                    $("#espacio_padre").empty();
                    var row = $("<option value=''/>");
                    row.text("--Seleccionar--");
                    row.appendTo("#espacio_padre");
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            aux = record.id;
                            row = $("<option value='" + record.id + "'/>");
                            row.text(aux);
                            row.appendTo("#espacio_padre");
                        }
                    });
                    $("#divTieneEspacioPadre").show();
                }else{
                    $("#divTieneEspacioPadre").hide();
                }
            }
        }
        $("#id_espacio").val("");
        $("#id_aire_search").empty();
        $("#id_aire_search").val("").change();
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector de espacio.
    */
    $("#id_espacio").change(function (e) {
        for (var i=0;i<numeroAires;i++) {
            eliminarComponente("tr_tabla_aires");
        }
        if(URLactual['href'].indexOf('crear_aire') >= 0 || URLactual['href'].indexOf('registrar_mantenimiento_aire') >= 0){
            var sede = $("#nombre_sede").val();
            var campus = $("#nombre_campus").val();
            var edificio = $("#nombre_edificio").val();
            var espacio = $("#id_espacio").val();
            if (validarCadena(espacio)) {
                var informacion = {};
                informacion["id_sede"] = sede;
                informacion["id_campus"] = campus;
                informacion["id_edificio"] = edificio;
                informacion["id_espacio"] = espacio;
                var aires = buscarAiresEspacio(informacion);
                numeroAires = 0;
                if (URLactual['href'].indexOf('crear_aire') >= 0) {
                    $.each(aires, function(index, record) {
                        if($.isNumeric(index)) {
                            var id_aire = record.id_aire;
                            var numero_inventario = record.numero_inventario;
                            var marca = record.marca_aire;
                            var capacidad = record.numero_capacidad+" BTU";
                            var tipo = record.tipo_aire;
                            var tecnologia = record.tecnologia_aire;
                            $("#tabla_aires").append("<tr id='tr_tabla_aires'><td>"+id_aire+"</td><td>"+numero_inventario+"</td><td>"+marca+"</td><td>"+capacidad+"</td><td>"+tipo+"</td><td>"+tecnologia+"</td></tr>");
                            numeroAires++;
                        }
                    });
                    if (numeroAires > 0) {
                        alert("A continuación, se mostrarán los aires acondiconados registrados en el espacio seleccionado");
                        $("#divDialogAiresEspacio").modal('show');
                    }
                }else{
                    $("#id_aire_search").empty();
                    var row = $("<option value=''/>");
                    row.text("--Seleccionar--");
                    row.appendTo("#id_aire_search");
                    $.each(aires, function(index, record) {
                        if($.isNumeric(index)) {
                            aux = record.id_aire + " - " + record.numero_inventario + " - " + record.marca_aire + " - " + record.numero_capacidad + "BTU - " + record.tipo_aire + " - " + record.tecnologia_aire;
                            row = $("<option value='" + record.id_aire + "'/>");
                            row.text(aux);
                            row.appendTo("#id_aire_search");
                        }
                    });
                }
            }else{
                $("#id_aire_search").empty();
                $("#id_aire_search").val("").change();
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector de aire acondicionado.
    */
    $("#id_aire_search").change(function (e) {
        var idAIre = $("#id_aire_search").val();
        if (validarCadena(idAIre)) {
            $("#seleccionar_aire").attr('disabled',false);
        }else{
            $("#seleccionar_aire").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del radio button pasamanos
     * y se actualiza el selector de pisos.
    */
    $("#form_pasamanos").change(function (e) {
        var pasamanos = $('input[name="pasamanos"]:checked').val();
        if (pasamanos == "true") {
            $('#divPasamanos').show();
        }else{
            $('#divPasamanos').hide();
        }
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
     * Se captura el evento cuando se da click en el botón guardar_sede y se
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
                    var resultado = guardarObjeto("sede",informacion);
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
     * Se captura el evento cuando se da click en el botón guardar_campus y se
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
                if(!validarCadena(nombreSede)){
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
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    informacion['nombre_campus'] = limpiarCadena(nombreCampus);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        var resultado = guardarObjeto("campus",informacion);
                        var resultadoPlanos = guardarPlanos("campus",arregloPlanos);
                        var resultadoFotos = guardarFotos("campus",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        $("#nombre_sede").val("");
                        $("#nombre_campus").val("");
                        planos.value = "";
                        fotos.value = "";
                        initMap();
                        coordenadas = {};
                        window.scrollTo(0,0);
                        $('#divDialogCreacion').modal('hide');
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por campus es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por campus es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación del campus en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_edificio y se
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
                var materialFachada = $("#material_fachada").val();
                var altoFachada = $("#alto_fachada").val();
                var anchoFachada = $("#ancho_fachada").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece el edificio");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece el edifiicio");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idEdificio)){
                    alert("ERROR. Ingrese el código del edificio");
                    $("#id_edificio").focus();
                }else if(!validarCadena(nombreEdificio)){
                    alert("ERROR. Ingrese el nombre del edificio");
                    $("#nombre_edificio").focus();
                }else if(!validarCadena(numeroPisos)){
                    alert("ERROR. Ingrese el número de pisos del edificio");
                    $("#pisos_edificio").focus();
                }else if(!validarCadena(terraza)){
                    alert("ERROR. Establesca si el edificio tiene terraza");
                    $("#terraza").focus();
                }else if(!validarCadena(sotano)){
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
                    informacion['material_fachada'] = materialFachada;
                    informacion['alto_fachada'] = altoFachada;
                    informacion['ancho_fachada'] = anchoFachada;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        var resultado = guardarObjeto("edificio",informacion);
                        var resultadoPlanos = guardarPlanos("edificio",arregloPlanos);
                        var resultadoFotos = guardarFotos("edificio",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_edificio").val("");
                            $("#nombre_edificio").val("");
                            $("#pisos_edificio").val("");
                            $('input[name=terraza]').attr('checked',false);
                            $('input[name=sotano]').attr('checked',false);
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_edificio").focus();
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
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación del edificio en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_cancha y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_cancha").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la cancha?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idCancha = limpiarCadena($("#id_cancha").val());
                var usoCancha = limpiarCadena($("#uso_cancha").val());
                var materialPiso = $("#material_piso").val();
                var tipoPintura = $("#tipo_pintura").val();
                var longitudDemarcacion = $("#longitud_demarcacion").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece la cancha");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece la cancha");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idCancha)){
                    alert("ERROR. Ingrese el código de la cancha");
                    $("#id_cancha").focus();
                }else if(!validarCadena(usoCancha)){
                    alert("ERROR. Ingrese uso de la cancha");
                    $("#uso_cancha").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_cancha'] = idCancha;
                    informacion['uso_cancha'] = usoCancha;
                    informacion['material_piso'] = materialPiso;
                    informacion['tipo_pintura'] = tipoPintura;
                    informacion['longitud_demarcacion'] = longitudDemarcacion;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('cancha',JSON.stringify(informacion));
                        arregloPlanos.append('cancha',JSON.stringify(informacion));
                        var resultado = guardarObjeto("cancha",informacion);
                        var resultadoPlanos = guardarPlanos("cancha",arregloPlanos);
                        var resultadoFotos = guardarFotos("cancha",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_cancha").val("");
                            $("#uso_cancha").val("");
                            $("#material_piso").val("");
                            $('#tipo_pintura').val("");
                            $('#longitud_demarcacion').val("");
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_cancha").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por cancha es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por cancha es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación de la cancha en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_corredor y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_corredor").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del corredor?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idCorredor = limpiarCadena($("#id_corredor").val());
                var alturaPared = $("#altura_pared").val();
                var anchoPared = $("#ancho_pared").val();
                var materialPared = $("#material_pared").val();
                var largoTecho = $("#largo_techo").val();
                var anchoTecho = $("#ancho_techo").val();
                var materialTecho = $("#material_techo").val();
                var largoPiso = $("#largo_piso").val();
                var anchoPiso = $("#ancho_piso").val();
                var materialPiso = $("#material_piso").val();
                var tipoIluminacion = [];
                var cantidadIluminacion = [];
                var tipoSuministroEnergia = [];
                var tomacorriente = [];
                var cantidadTomacorrientes = [];
                var tipoInterruptor = [];
                var cantidadInterruptores = [];
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece el corredor");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece el corredor");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idCorredor)){
                    alert("ERROR. Ingrese el código del corredor");
                    $("#id_corredor").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_corredor'] = idCorredor;
                    informacion['alto_pared'] = alturaPared;
                    informacion['ancho_pared'] = anchoPared;
                    informacion['material_pared'] = materialPared;
                    informacion['largo_techo'] = largoTecho;
                    informacion['ancho_techo'] = anchoTecho;
                    informacion['material_techo'] = materialTecho;
                    informacion['largo_piso'] = largoPiso;
                    informacion['ancho_piso'] = anchoPiso;
                    informacion['material_piso'] = materialPiso;
                    informacion['tipo_suministro_energia'] = $("#tipo_suministro_energia").val();
                    informacion['tomacorriente'] = $("#tomacorriente").val();
                    informacion['cantidad_tomacorrientes'] = $("#cantidad_tomacorrientes").val();
                    for (var i=0;i<=iluminacionCont;i++) {
                        if (i==0) {
                            tipoIluminacion[i] = $("#tipo_iluminacion").val();
                            cantidadIluminacion[i] = $("#cantidad_iluminacion").val();
                        }else{
                            tipoIluminacion[i] = $("#tipo_iluminacion"+i).val();
                            cantidadIluminacion[i] = $("#cantidad_iluminacion"+i).val();
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
                    informacion['tipo_iluminacion'] = tipoIluminacion;
                    informacion['cantidad_iluminacion'] = cantidadIluminacion;
                    informacion['tipo_interruptor'] = tipoInterruptor;
                    informacion['cantidad_interruptores'] = cantidadInterruptores;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('corredor',JSON.stringify(informacion));
                        arregloPlanos.append('corredor',JSON.stringify(informacion));
                        var resultado = guardarObjeto("corredor",informacion);
                        var resultadoPlanos = guardarPlanos("corredor",arregloPlanos);
                        var resultadoFotos = guardarFotos("corredor",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_corredor").val("");
                            $("#altura_pared").val("");
                            $("#ancho_pared").val("");
                            $("#largo_techo").val("");
                            $("#ancho_techo").val("");
                            $("#material_techo").val("");
                            $("#largo_piso").val("");
                            $("#ancho_piso").val("");
                            $("#material_piso").val("");
                            $("#tipo_iluminacion").val("");
                            $("#cantidad_iluminacion").val("");
                            $("#tipo_suministro_energia").val("");
                            $("#tomacorriente").val("");
                            $("#cantidad_tomacorrientes").val("");
                            $("#tipo_interruptor").val("");
                            $("#cantidad_interruptores").val("");
                            while (iluminacionCont > 0) {
                                eliminarComponente("iluminacion"+iluminacionCont);
                                iluminacionCont--;
                            }
                            while (tomacorrientesCont > 0) {
                                eliminarComponente("suministro_energia"+tomacorrientesCont);
                                tomacorrientesCont--;
                            }
                            while (interruptoresCont > 0) {
                                eliminarComponente("interruptor"+tomacorrientesCont);
                                interruptoresCont--;
                            }
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_corredor").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por corredor es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por corredor es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación del corredor en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_cubierta y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_cubierta").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la cubierta?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var nombreEdificio = $("#nombre_edificio").val();
                var piso = $("#pisos").val();
                var tipoCubierta = $("#tipo_cubierta").val();
                var materialCubierta = $("#material_cubierta").val();
                var ancho = $("#ancho").val();
                var largo = $("#largo").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece la cubierta");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece la cubierta");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el edificio al que pertenece la cubierta");
                    $("#nombre_edificio").focus();
                }else if(!validarCadena(piso)){
                    alert("ERROR. Ingrese el piso donde se encuentra la cubierta");
                    $("#piso").focus();
                }else{
                    if (piso == 'sotano') {
                        piso = '0';
                    }else if (piso == 'terraza') {
                        piso = '-1';
                    }
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['nombre_edificio'] = nombreEdificio;
                    informacion['pisos'] = piso;
                    informacion['tipo_cubierta'] = tipoCubierta;
                    informacion['material_cubierta'] = materialCubierta;
                    informacion['ancho'] = ancho;
                    informacion['largo'] = largo;
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('cubierta',JSON.stringify(informacion));
                        arregloPlanos.append('cubierta',JSON.stringify(informacion));
                        var resultado = guardarObjeto("cubierta",informacion);
                        var resultadoPlanos = guardarPlanos("cubierta",arregloPlanos);
                        var resultadoFotos = guardarFotos("cubierta",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#nombre_edificio").empty();
                            $("#nombre_edificio").val("");
                            $("#pisos").empty();
                            $("#pisos").val("");
                            $("#tipo_cubierta").val("");
                            $("#material_cubierta").val("");
                            $("#ancho").val("");
                            $("#largo").val("");
                            planos.value = "";
                            fotos.value = "";
                            window.scrollTo(0,0);
                        }else{
                            $("#nombre_edificio").focus();
                            $("#pisos").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por cubierta es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por cubierta es 20");
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
     * Se captura el evento cuando se da click en el botón guardar_gradas y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_gradas").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de las gradas?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var nombreEdificio = $("#nombre_edificio").val();
                var pisoInicio = $("#pisos").val();
                var pasamanos = $('input[name="pasamanos"]:checked').val();
                var materialPasamanos = $("#material_pasamanos").val();
                var tipoVentana = {};
                var cantidadVentanas = {};
                var materialVentana = {};
                var anchoVentana = {};
                var altoVentana = {};
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenecen las gradas");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenecen las gradas");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(nombreEdificio)){
                    alert("ERROR. Seleccione el edificio al que pertenecen las gradas");
                    $("#nombre_edificio").focus();
                }else if(!validarCadena(pisoInicio)){
                    alert("ERROR. Ingrese el piso desde el que inician las gradas del edificio");
                    $("#pisos").focus();
                }else{
                    if (pisoInicio == 'sotano') {
                        pisoInicio = '0';
                    }else if (pisoInicio == 'terraza') {
                        pisoInicio = '-1';
                    }
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['nombre_edificio'] = nombreEdificio;
                    informacion['piso_inicio'] = pisoInicio;
                    informacion['pasamanos'] = pasamanos;
                    informacion['material_pasamanos'] = materialPasamanos;
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
                    informacion['tipo_ventana'] = tipoVentana;
                    informacion['cantidad_ventanas'] = cantidadVentanas;
                    informacion['material_ventana'] = materialVentana;
                    informacion['ancho_ventana'] = anchoVentana;
                    informacion['alto_ventana'] = altoVentana;
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('gradas',JSON.stringify(informacion));
                        arregloPlanos.append('gradas',JSON.stringify(informacion));
                        var resultado = guardarObjeto("gradas",informacion);
                        var resultadoPlanos = guardarPlanos("gradas",arregloPlanos);
                        var resultadoFotos = guardarFotos("gradas",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                                if (i<resultadoPlanos.verificar.length-2) {
                                    mensaje += "\n";
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                                if (i<resultadoFotos.verificar.length-1) {
                                    mensaje += "\n";
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#nombre_edificio").empty();
                            $("#nombre_edificio").val("");
                            $("#pisos").empty();
                            $("#pisos").val("");
                            $('input[name=pasamanos]').attr('checked',false);
                            $("#divPasamanos").hide();
                            $("#tipo_ventana").val("");
                            $("#cantidad_ventanas").val("");
                            $("#material_ventana").val("");
                            $("#ancho_ventana").val("");
                            $("#alto_ventana").val("");
                            while (ventanasCont > 0) {
                                eliminarComponente("ventana"+ventanasCont);
                                ventanasCont--;
                            }
                            planos.value = "";
                            fotos.value = "";
                            window.scrollTo(0,0);
                        }else{
                            $("#nombre_edificio").focus();
                            $("#pisos").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por gradas es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por gradas es 20");
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
     * Se captura el evento cuando se da click en el botón guardar_parqueadero y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_parqueadero").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del parqueadero?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idParqueadero = limpiarCadena($("#id_parqueadero").val());
                var capacidad = $("#capacidad").val();
                var ancho = $("#ancho").val();
                var largo = $("#largo").val();
                var material_piso = $("#material_piso").val();
                var tipo_pintura = $("#tipo_pintura").val();
                var longitud_demarcacion = $("#longitud_demarcacion").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece el parqueadero");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece el parqueadero");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idParqueadero)){
                    alert("ERROR. Ingrese el código del parqueadero");
                    $("#id_parqueadero").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_parqueadero'] = idParqueadero;
                    informacion['capacidad'] = capacidad;
                    informacion['ancho'] = ancho;
                    informacion['largo'] = largo;
                    informacion['material_piso'] = material_piso;
                    informacion['tipo_pintura'] = tipo_pintura;
                    informacion['longitud_demarcacion'] = longitud_demarcacion;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('parqueadero',JSON.stringify(informacion));
                        arregloPlanos.append('parqueadero',JSON.stringify(informacion));
                        var resultado = guardarObjeto("parqueadero",informacion);
                        var resultadoPlanos = guardarPlanos("parqueadero",arregloPlanos);
                        var resultadoFotos = guardarFotos("parqueadero",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_parqueadero").val("");
                            $("#capacidad").val("");
                            $("#ancho").val("");
                            $("#largo").val("");
                            $("#material_piso").val("");
                            $("#tipo_pintura").val("");
                            $("#longitud_demarcacion").val("");
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_parqueadero").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por parqueadero es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por parqueadero es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación del parqueadero en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_piscina y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_piscina").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la piscina?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idPiscina = limpiarCadena($("#id_piscina").val());
                var alto = $("#alto").val();
                var ancho = $("#ancho").val();
                var largo = $("#largo").val();
                var cantidadPuntosHidraulicos = $("#cantidad_puntos_hidraulicos").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece la piscina");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece la piscina");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idPiscina)){
                    alert("ERROR. Ingrese el código de la piscina");
                    $("#id_piscina").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_piscina'] = idPiscina;
                    informacion['alto'] = alto;
                    informacion['ancho'] = ancho;
                    informacion['largo'] = largo;
                    informacion['cantidad_puntos_hidraulicos'] = cantidadPuntosHidraulicos;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('piscina',JSON.stringify(informacion));
                        arregloPlanos.append('piscina',JSON.stringify(informacion));
                        var resultado = guardarObjeto("piscina",informacion);
                        var resultadoPlanos = guardarPlanos("piscina",arregloPlanos);
                        var resultadoFotos = guardarFotos("piscina",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_piscina").val("");
                            $("#alto").val("");
                            $("#ancho").val("");
                            $("#largo").val("");
                            $("#cantidad_puntos_hidraulicos").val("");
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_piscina").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por piscina es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por piscina es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación de la piscina en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_plazoleta y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_plazoleta").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la plazoleta?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idPlazoleta = limpiarCadena($("#id_plazoleta").val());
                var nombre = limpiarCadena($("#nombre").val());
                var tipoIluminacion = $("#tipo_iluminacion").val();
                var cantidadIluminacion = $("#cantidad_iluminacion").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece la plazoleta");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece la plazoleta");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idPlazoleta)){
                    alert("ERROR. Ingrese el código de la plazoleta");
                    $("#id_plazoleta").focus();
                }else if(!validarCadena(nombre)){
                    alert("ERROR. Ingrese el nombre de la plazoleta");
                    $("#nombre").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_plazoleta'] = idPlazoleta;
                    informacion['nombre'] = nombre;
                    informacion['tipo_iluminacion'] = tipoIluminacion;
                    informacion['cantidad_iluminacion'] = cantidadIluminacion;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('plazoleta',JSON.stringify(informacion));
                        arregloPlanos.append('plazoleta',JSON.stringify(informacion));
                        var resultado = guardarObjeto("plazoleta",informacion);
                        var resultadoPlanos = guardarPlanos("plazoleta",arregloPlanos);
                        var resultadoFotos = guardarFotos("plazoleta",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_plazoleta").val("");
                            $("#nombre").val("");
                            $("#tipo_iluminacion").val("");
                            $("#cantidad_iluminacion").val("");
                            while (iluminacionCont > 0) {
                                eliminarComponente("iluminacion"+iluminacionCont);
                                iluminacionCont--;
                            }
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_plazoleta").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por plazoleta es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por plazoleta es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación de la plazoleta en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_sendero y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_sendero").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del sendero peatonal?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idSendero = limpiarCadena($("#id_sendero").val());
                var longitud = $("#longitud").val();
                var ancho = $("#ancho").val();
                var materialPiso = $("#material_piso").val();
                var tipoIluminacion = $("#tipo_iluminacion").val();
                var cantidadIluminacion = $("#cantidad_iluminacion").val();
                var codigoPoste = $("#codigo_poste").val();
                var anchoCubierta = $("#ancho_cubierta").val();
                var largoCubierta = $("#largo_cubierta").val();
                var materialCubierta = $("#material_cubierta").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece el sendero peatonal");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece el sendero peatonal");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idSendero)){
                    alert("ERROR. Ingrese el código del sendero peatonal");
                    $("#id_sendero").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_sendero'] = idSendero;
                    informacion['longitud'] = longitud;
                    informacion['ancho'] = ancho;
                    informacion['material_piso'] = materialPiso;
                    informacion['cantidad_iluminacion'] = cantidadIluminacion;
                    informacion['tipo_iluminacion'] = tipoIluminacion;
                    informacion['codigo_poste'] = codigoPoste;
                    informacion['ancho_cubierta'] = anchoCubierta;
                    informacion['largo_cubierta'] = largoCubierta;
                    informacion['material_cubierta'] = materialCubierta;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('sendero',JSON.stringify(informacion));
                        arregloPlanos.append('sendero',JSON.stringify(informacion));
                        var resultado = guardarObjeto("sendero",informacion);
                        var resultadoPlanos = guardarPlanos("sendero",arregloPlanos);
                        var resultadoFotos = guardarFotos("sendero",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_sendero").val("");
                            $("#longitud").val("");
                            $("#ancho").val("");
                            $("#material_piso").val("");
                            $("#cantidad_iluminacion").val("");
                            $("#tipo_iluminacion").val("");
                            $("#codigo_poste").val("");
                            $("#ancho_cubierta").val("");
                            $("#largo_cubierta").val("");
                            $("#material_cubierta").val("");
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_sendero").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por sendero peatonal es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por sendero peatonal es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación del sendero peatonal en el mapa");
                $("#map").focus();

            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_via y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_via").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la vía?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var idVia = limpiarCadena($("#id_via").val());
                var tipoPintura = $("#tipo_pintura").val();
                var longitudDemarcacion = $("#longitud_demarcacion").val();
                var materialPiso = $("#material_piso").val();
                var planos = document.getElementById("planos[]");
                var fotos = document.getElementById("fotos[]");
                if(!validarCadena(nombreSede)){
                    alert("ERROR. Seleccione la sede a la que pertenece la vía");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(nombreCampus)){
                    alert("ERROR. Ingrese el nombre del campus al que pertenece la vía");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(idVia)){
                    alert("ERROR. Ingrese el código de la vía");
                    $("#id_via").focus();
                }else{
                    var informacion = {};
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_via'] = idVia;
                    informacion['tipo_pintura'] = tipoPintura;
                    informacion['longitud_demarcacion'] = longitudDemarcacion;
                    informacion['material_piso'] = materialPiso;
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    if (fotos.files.length <= 20 || planos.files.length <= 5) {
                        for (var i=0;i<fotos.files.length;i++) {
                            var foto = fotos.files[i];
                            if (foto.size > 2000000) {
                                alert('La foto: "'+foto.name+"' es muy grande");
                            }else{
                                var nombreArchivo = foto.name;
                                if(nombreArchivo.length > 50){
                                    nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
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
                        arregloFotos.append('via',JSON.stringify(informacion));
                        arregloPlanos.append('via',JSON.stringify(informacion));
                        var resultado = guardarObjeto("via",informacion);
                        var resultadoPlanos = guardarPlanos("via",arregloPlanos);
                        var resultadoFotos = guardarFotos("via",arregloFotos);
                        mostrarMensaje(resultado.mensaje);
                        var mensaje = "";
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                if (!resultadoPlanos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoPlanos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoPlanos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (!resultadoFotos.verificar[i]) {
                                    if (mensaje == "") {
                                        mensaje += resultadoFotos.mensaje[i];
                                    }else{
                                        mensaje += "\n" + resultadoFotos.mensaje[i];
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        if(resultado.verificar){
                            $("#nombre_sede").val("");
                            $("#nombre_campus").empty();
                            $("#nombre_campus").val("");
                            $("#id_via").val("");
                            $("#tipo_pintura").val("");
                            $("#longitud_demarcacion").val("");
                            $("#material_piso").val("");
                            planos.value = "";
                            fotos.value = "";
                            initMap();
                            coordenadas = {};
                            window.scrollTo(0,0);
                        }else{
                            $("#id_via").focus();
                        }
                    }else{
                        if (planos.files.length <= 5) {
                            alert("ERROR. El número máximo de planos por vía es 5");
                            planos.focus();
                        }else{
                            alert("ERROR. El número máximo de fotos por vía es 20");
                            fotos.focus();
                        }
                    }
                }
            }
        }
        catch(ex){
            if (ex instanceof TypeError) {
                alert("ERROR. Indique la ubicación de la vía en el mapa");
                $("#map").focus();
            }else{
                console.log(ex);
                alert("Ocurrió un error, por favor inténtelo nuevamente");
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_espacio y se
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
                    var comprobarEspacio = verificarEspacio(nombreSede,nombreCampus,nombreEdificio,numeroEspacio[i]);
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
                        $('#pisos').focus();
                    }else if(!validarNumero(numeroEspacio)){
                        alert('ERROR. Ingrese el número del espacio');
                        $('#id_espacio').focus();
                    }else if(!validarCadena(usoEspacio)){
                        alert('ERROR. Seleccione el uso que tiene el espacio');
                        $('#uso_espacio').focus();
                    }else if(($('#divTieneEspacioPadre').is(':visible')) && !validarCadena(espacioPadre)){
                        alert('ERROR. Especifique si el espacio está dentro de otro');
                        $('#tiene_espacio_padre').focus();
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
                                        nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                                    }
                                    arregloFotosEspacio.append('archivo'+i,foto,nombreArchivo);
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
                                    arregloPlanosEspacio.append('archivo'+i,plano,nombreArchivo);
                                }
                            }
                            arregloFotosEspacio.append('espacio',JSON.stringify(informacion));
                            arregloPlanosEspacio.append('espacio',JSON.stringify(informacion));
                            dataEspacio = informacion;
                            $('#botones_punto_sanitario').hide();
                            $('#botones_lavamanos').hide();
                            $('#botones_orinal').hide();
                            if (usoEspacio == '1') { //Salón
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) salón(es):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'<div class="div_izquierda"><b>Capacidad del(os) salón(es):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" required/><br>'
                                +'<div class="div_izquierda"><b>¿El(Los) salón(es) tiene punto(s) de videobeam?:</b></div>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) auditorio(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'<div class="div_izquierda"><b>Capacidad del(os) auditorio(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" required/><br>'
                                +'<div class="div_izquierda"><b>¿El(Los) auditorio(s) tiene punto(s) de videobeam?:</b></div>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) laboratorio(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'<div class="div_izquierda"><b>Capacidad del(os) laboratorio(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" required/><br>'
                                +'<div class="div_izquierda"><b>¿El(Los) laboratorio(s) tiene punto(s) de videobeam?:</b></div>'
                                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label>'
                                +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos del(os) laboratorio(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                                +'<div id="punto_sanitario">'
                                +'<div class="div_izquierda"><b>Tipo de punto sanitario del(os) laboratorio(s):</b></div>'
                                +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario" required></select><br>'
                                +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del(os) laboratorio(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios" value="" required/><br>'
                                +'</div>'
                                +'</div>';
                                $('#botones_punto_sanitario').show();
                                añadirComponente("informacionEspacio",componente);
                                actualizarSelectTipoObjeto("tipo_punto_sanitario",0);
                                $('#guardar_espacio_adicional').val('Crear Laboratorio');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '4'){ //Sala de Cómputo
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la(s) sala(s) de cómputo:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'<div class="div_izquierda"><b>Capacidad de la sala de cómputo:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" required/><br>'
                                +'<div class="div_izquierda"><b>¿La(s) sala(s) de cómputo tiene punto(s) de videobeam?:</b></div>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la(s) oficina(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'<div class="div_izquierda"><b>¿La(s) oficina(s) tiene punto(s) de videobeam?:</b></div>'
                                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true">S&iacute;</label>'
                                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false">No</label><br>'
                                +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Oficina');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '6'){ //Baño
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                +'<div class="div_izquierda"><b>Tipo de inodoro:</b></div>'
                                +'<select class="form-control formulario" name="tipo_inodoro" id="tipo_inodoro" required></select><br>'
                                +'<div class="div_izquierda"><b>Cantidad de inodoros:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_inodoros" id="cantidad_inodoros" value="" required/><br>'
                                +'<div id="lavamanos">'
                                +'<div class="div_izquierda"><b>Tipo de lavamanos:</b></div>'
                                +'<select class="form-control formulario" name="tipo_lavamanos" id="tipo_lavamanos" required></select><br>'
                                +'<div class="div_izquierda"><b>Cantidad de lavamanos:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_lavamanos" id="cantidad_lavamanos" value="" required/><br>'
                                +'</div>'
                                +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                var componente = '<br><div id="informacion2">'
                                +'<div class="div_izquierda"><b>Tipo de divisiones:</b></div>'
                                +'<select class="form-control formulario" name="tipo_divisiones" id="tipo_divisiones" required></select><br>'
                                +'<div class="div_izquierda"><b>Material de las divisiones:</b></div>'
                                +'<select class="form-control formulario" name="material_divisiones" id="material_divisiones" required></select><br>'
                                +'<div class="div_izquierda"><b>¿El(Los) baño(s) tiene ducha?:</b></div>'
                                +'<label class="radio-inline"><input type="radio" name="ducha" value="true">S&iacute;</label>'
                                +'<label class="radio-inline"><input type="radio" name="ducha" value="false">No</label>'
                                +'<div class="div_izquierda"><b>¿El(Los) baño(s) tiene lavatraperos?:</b></div>'
                                +'<label class="radio-inline"><input type="radio" name="lavatraperos" value="true">S&iacute;</label>'
                                +'<label class="radio-inline"><input type="radio" name="lavatraperos" value="false">No</label>'
                                +'<div class="div_izquierda"><b>Cantidad de sifones:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_sifones" id="cantidad_sifones" value="" required/><br>'
                                +'<div id="orinal">'
                                +'<div class="div_izquierda"><b>Tipo de orinal:</b></div>'
                                +'<select class="form-control formulario" name="tipo_orinal" id="tipo_orinal" required></select><br>'
                                +'<div class="div_izquierda"><b>Cantidad de orinales:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_orinales" id="cantidad_orinales" value="" required/><br>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) cuarto(s) técnico(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'<div class="div_izquierda"><b>¿El(Los) cuarto(s) técnico(s) tiene punto(s) de videobeam?:</b></div>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la(s) bodega(s) o almacén(es):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) cuarto(s) de Plantas:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Cuarto');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '11'){ //Cuarto de Aires Acondicionados
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) cuarto(s) de Aires Acondicionados:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                                +'</div>';
                                añadirComponente("informacionEspacio",componente);
                                $('#guardar_espacio_adicional').val('Crear Cuarto');
                                $('#divDialogCreacion').modal('show');
                            }else if(usoEspacio == '12'){ //Área Deportiva Cerrada
                                eliminarComponente("informacion");
                                eliminarComponente("informacion2");
                                var componente = '<div id="informacion">'
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(as) área(s) deportiva cerrada:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(os) centro(s) de datos/teléfono:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos del(os) cuarto(s) de bombas:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                                +'<div id="punto_sanitario">'
                                +'<div class="div_izquierda"><b>Tipo de punto sanitario del(os) cuarto(s) de bombas:</b></div>'
                                +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario" required></select><br>'
                                +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del(os) cuarto(s) de bombas:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios" value="" required/><br>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos de la(s) cocineta(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                                +'<div id="punto_sanitario">'
                                +'<div class="div_izquierda"><b>Tipo de punto sanitario de la(s) cocineta(s):</b></div>'
                                +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario" required></select><br>'
                                +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios de la(s) cocineta(s):</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios" value="" required/><br>'
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
                                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la(s) sala(s) de estudio:</b></div>'
                                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
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
     * Se captura el evento cuando se da click en el botón guardar_espacio_adicional y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_espacio_adicional").click(function (e){
        var informacion = {};
        var usoEspacio = $("#uso_espacio").val();
        if (usoEspacio == '1') { //Salón
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntoVideoBeam = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntoVideoBeam;
        }else if(usoEspacio == '2'){ //Auditorio
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntoVideoBeam = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntoVideoBeam;
        }else if(usoEspacio == '3'){ //Laboratorio
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntoVideoBeam = $('input[name="punto_videobeam"]:checked').val();
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
            informacion["punto_videobeam"] = puntoVideoBeam;
            informacion["cantidad_puntos_hidraulicos"] = cantidadPuntosHidraulicos;
            informacion["tipo_punto_sanitario"] = tipoPuntosSanitarios;
            informacion["cantidad_puntos_sanitarios"] = cantidadPuntosSanitarios;
        }else if(usoEspacio == '4'){ //Sala de Cómputo
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var capacidad = $("#capacidad").val();
            var puntoVideoBeam = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["capacidad"] = capacidad;
            informacion["punto_videobeam"] = puntoVideoBeam;
        }else if(usoEspacio == '5'){ //Oficina
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var puntoVideoBeam = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["punto_videobeam"] = puntoVideoBeam;
        }else if(usoEspacio == '6'){ //Baño
            var tipoInodoro = $("#tipo_inodoro").val();
            var cantidadInodoros = $("#cantidad_inodoros").val();
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
            informacion["cantidad_inodoro"] = cantidadInodoros;
            informacion["tipo_orinal"] = tipoOrinal;
            informacion["cantidad_orinal"] = cantidadOrinales;
            informacion["tipo_lavamanos"] = tipoLavamanos;
            informacion["cantidad_lavamanos"] = cantidadLavamanos;
            informacion["tipo_divisiones"] = tipoDivisiones;
            informacion["material_divisiones"] = materialDivisiones;
            informacion["ducha"] = ducha;
            informacion["lavatraperos"] = lavatraperos;
            informacion["cantidad_sifones"] = cantidadSifones;
        }else if(usoEspacio == '7'){ //Cuarto Técnico
            var cantidadPuntosRed = $("#cantidad_puntos_red").val();
            var puntoVideoBeam = $('input[name="punto_videobeam"]:checked').val();
            informacion["cantidad_puntos_red"] = cantidadPuntosRed;
            informacion["punto_videobeam"] = puntoVideoBeam;
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
     * Se captura el evento cuando se da click en el botón guardar_tipo_material y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_tipo_material").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del tipo de material?");
            if (confirmacion) {
                var tipoMaterial = $("#tipo_material").val();
                var nombreTipoMaterial = $("#nombre_tipo_material").val();
                if(!validarCadena(tipoMaterial)){
                    alert("ERROR. Seleccione un tipo de material");
                    $("#tipo_material").focus();
                }else if(!validarCadena(nombreTipoMaterial)){
                    alert("ERROR. Ingrese el nombre del tipo de material");
                    $("#nombre_tipo_material").focus();
                }else{
                    var informacion = {};
                    informacion['tipo_material'] = limpiarCadena(tipoMaterial);
                    informacion['nombre_tipo_material'] = limpiarCadena(nombreTipoMaterial);
                    var resultado = guardarTipoMaterial(informacion);
                    mostrarMensaje(resultado.mensaje);
                    if(resultado.verificar){
                        $("#tipo_material").val("");
                        $("#nombre_tipo_material").val("");
                        window.scrollTo(0,0);
                    }else{
                        $("#nombre_tipo_material").focus();
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
     * Se captura el evento cuando se da click en el botón guardar_tipo_objeto y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_tipo_objeto").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del tipo de objeto?");
            if (confirmacion) {
                var tipoObjeto = $("#tipo_objeto").val();
                var nombreTipoObjeto = $("#nombre_tipo_objeto").val();
                if(!validarCadena(tipoObjeto)){
                    alert("ERROR. Seleccione un tipo de objeto");
                    $("#tipo_objeto").focus();
                }else if(!validarCadena(nombreTipoObjeto)){
                    alert("ERROR. Ingrese el nombre del tipo de objeto");
                    $("#nombre_tipo_objeto").focus();
                }else{
                    var informacion = {};
                    informacion['tipo_objeto'] = limpiarCadena(tipoObjeto);
                    informacion['nombre_tipo_objeto'] = limpiarCadena(nombreTipoObjeto);
                    var resultado = guardarTipoObjeto(informacion);
                    mostrarMensaje(resultado.mensaje);
                    if(resultado.verificar){
                        $("#tipo_objeto").val("");
                        $("#nombre_tipo_objeto").val("");
                        window.scrollTo(0,0);
                    }else{
                        $("#nombre_tipo_objeto").focus();
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
     * Se captura el evento cuando se da click en el botón añadir_informacion_adicional y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_informacion_adicional").click(function (e){
        $("#informacion-adicional").show();
        $("#añadir_informacion_adicional").attr('disabled',true);
        $('#eliminar_informacion_adicional').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_informacion_adicional y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_informacion_adicional").click(function (e){
        $("#informacion-adicional").hide();
        $("#eliminar_informacion_adicional").attr('disabled',true);
        $('#añadir_informacion_adicional').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_iluminacion y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_iluminacion").click(function (e){
        iluminacionCont++;
        var componente = '<div id="iluminacion'+iluminacionCont+'">'
        +'<div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion'+iluminacionCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="cantidad_iluminacion" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("iluminacion",componente);
        actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
        $('#eliminar_iluminacion').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_iluminacion y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_iluminacion").click(function (e){
        eliminarComponente("iluminacion"+iluminacionCont);
        iluminacionCont--;
        if(iluminacionCont == 0){
            $("#eliminar_iluminacion").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_tomacorriente y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_tomacorriente").click(function (e){
        tomacorrientesCont++;
        var componente = '<div id="suministro_energia'+tomacorrientesCont+'">'
        +'<div class="div_izquierda"><b>Tipo de suministro de energía ('+(tomacorrientesCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_suministro_energia" id="tipo_suministro_energia'+tomacorrientesCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Tomacorriente ('+(tomacorrientesCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tomacorriente" id="tomacorriente'+tomacorrientesCont+'" required>'
        +'<option value="seleccionar" selected="selected">--Seleccionar--</option>'
        +'<option value="regulado">Regulado</option>'
        +'<option value="no regulado">No Regulado</option>'
        +'</select><br>'
        +'<div class="div_izquierda"><b>Cantidad de tomacorrientes del tipo ('+(tomacorrientesCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_tomacorrientes" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("suministro_energia",componente);
        actualizarSelectTipoObjeto("tipo_suministro_energia",tomacorrientesCont);
        $('#eliminar_tomacorriente').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_tomacorriente y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_tomacorriente").click(function (e){
        eliminarComponente("suministro_energia"+tomacorrientesCont);
        tomacorrientesCont--;
        if(tomacorrientesCont == 0){
            $("#eliminar_tomacorriente").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_puerta y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_puerta").click(function (e){
        puertasCont++;
        var componente = '<div id="puerta'+puertasCont+'">'
        +'<div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_puerta" id="tipo_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puertas" id="cantidad_puertas'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la puerta ('+(puertasCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="material_puerta" id="material_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Tipo de cerradura ('+(puertasCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_cerradura" id="tipo_cerradura'+puertasCont+'" required></select><br>'
        //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="añadir_tipo_cerradura" id="añadir_tipo_cerradura'+puertasCont+'" value="Añadir Tipo" title="Añadir Tipo Cerradura"/>'
        //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="eliminar_tipo_cerradura" id="eliminar_tipo_cerradura'+puertasCont+'" value="Eliminar Tipo" title="Eliminar Tipo Cerradura" disabled/>'
        +'<div class="div_izquierda"><b>¿La puerta tiene gato? ('+(puertasCont+1)+'):</b></div>'
        +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="true">S&iacute;</label>'
        +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="false">No</label><br>'
        +'<div class="div_izquierda"><b>Material del marco ('+(puertasCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="material_marco_puerta" id="material_marco_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho puerta ('+(puertasCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_puerta" id="ancho_puerta'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_puerta" id="alto_puerta'+puertasCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("puerta",componente);
        actualizarSelectMaterial("material_marco_puerta",puertasCont);
        actualizarSelectMaterial("material_puerta",puertasCont);
        actualizarSelectTipoObjeto("tipo_puerta",puertasCont);
        $('#eliminar_puerta').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_puerta y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_puerta").click(function (e){
        eliminarComponente("puerta"+puertasCont);
        puertasCont--;
        if(puertasCont == 0){
            $("#eliminar_puerta").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_ventana y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_ventana").click(function (e){
        ventanasCont++;
        var componente = '<div id="ventana'+ventanasCont+'">'
        +'<div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_ventana" id="tipo_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_ventanas" id="cantidad_ventanas'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="material_ventana" id="material_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_ventana" id="ancho_ventana'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_ventana" id="alto_ventana'+ventanasCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("ventana",componente);
        actualizarSelectMaterial("material_ventana",ventanasCont);
        actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
        $('#eliminar_ventana').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_ventana y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_ventana").click(function (e){
        eliminarComponente("ventana"+ventanasCont);
        ventanasCont--;
        if(ventanasCont == 0){
            $("#eliminar_ventana").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_interruptor y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_interruptor").click(function (e){
        interruptoresCont++;
        var componente = '<div id="interruptor'+interruptoresCont+'">'
        +'<div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_interruptor" id="tipo_interruptor'+interruptoresCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_interruptores" id="cantidad_interruptores'+interruptoresCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("interruptor",componente);
        actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
        $('#eliminar_interruptor').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_interruptor y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_interruptor").click(function (e){
        eliminarComponente("interruptor"+interruptoresCont);
        interruptoresCont--;
        if(interruptoresCont == 0){
            $("#eliminar_interruptor").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_punto_sanitario y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_punto_sanitario").click(function (e){
        puntosSanitariosCont++;
        var componente = '<div id="punto_sanitario'+puntosSanitariosCont+'">'
        +'<div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario'+puntosSanitariosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("punto_sanitario",componente);
        actualizarSelectTipoObjeto("tipo_punto_sanitario",puntosSanitariosCont);
        $('#eliminar_punto_sanitario').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_punto_sanitario").click(function (e){
        eliminarComponente("punto_sanitario"+puntosSanitariosCont);
        puntosSanitariosCont--;
        if(puntosSanitariosCont == 0){
            $("#eliminar_punto_sanitario").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_punto_sanitario y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_orinal").click(function (e){
        orinalesCont++;
        var componente = '<div id="orinal'+orinalesCont+'">'
        +'<div class="div_izquierda"><b>Tipo de orinal ('+(orinalesCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_orinal" id="tipo_orinal'+orinalesCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de orinales del tipo ('+(orinalesCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_orinales" id="cantidad_orinales'+orinalesCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("orinal",componente);
        actualizarSelectTipoObjeto("tipo_orinal",orinalesCont);
        $('#eliminar_orinal').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_orinal").click(function (e){
        eliminarComponente("orinal"+orinalesCont);
        orinalesCont--;
        if(orinalesCont == 0){
            $("#eliminar_orinal").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_lavamanos y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_lavamanos").click(function (e){
        lavamanosCont++;
        var componente = '<div id="lavamanos'+lavamanosCont+'">'
        +'<div class="div_izquierda"><b>Tipo de lavamanos ('+(lavamanosCont+1)+'):</b></div>'
        +'<select class="form-control formulario" name="tipo_lavamanos" id="tipo_lavamanos'+lavamanosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lavamanos ('+(lavamanosCont+1)+'):</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_lavamanos" id="cantidad_lavamanos'+lavamanosCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("lavamanos",componente);
        actualizarSelectTipoObjeto("tipo_lavamanos",lavamanosCont);
        $('#eliminar_lavamanos').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_lavamanos y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_lavamanos").click(function (e){
        eliminarComponente("lavamanos"+lavamanosCont);
        lavamanosCont--;
        if(lavamanosCont == 0){
            $("#eliminar_lavamanos").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón agregar_espacio y se
     * realiza la operacion correspondiente.
    */
    $("#agregar_espacio").click(function (e){
        $("#divBotonesInformacionAdicional").hide();
        $("#informacion-adicional").hide();
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

    /**
     * Se captura el evento cuando se da click en el botón eliminar_espacio y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_espacio").click(function (e){
        eliminarComponente("espacio"+espaciosCont);
        espaciosCont--;
        if(espaciosCont == 0){
            $("#divBotonesInformacionAdicional").show();
            $("#eliminar_espacio").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_proveedor y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_proveedor").click(function (e){
        proveedoresCont++;
        var bodega = $("#bodega").val();
        var componente = '<div id="proveedor'+proveedoresCont+'">'
        +'<div class="div_izquierda"><b>Proveedor ('+(proveedoresCont+1)+') del Art&iacute;culo:</b></div>'
        +'<select class="form-control formulario" name="proveedor_articulo" id="proveedor_articulo'+proveedoresCont+'" required></select><br>'
        +'</div>';
        añadirComponente("proveedor",componente);
        actualizarSelectProveedores(proveedoresCont,bodega);
        $('#eliminar_proveedor').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_proveedor y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_proveedor").click(function (e){
        eliminarComponente("proveedor"+proveedoresCont);
        proveedoresCont--;
        if(proveedoresCont == 0){
            $("#eliminar_proveedor").attr('disabled',true);
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
        $("#eliminar_lavamanos").attr('disabled',true);
        $("#eliminar_punto_sanitario").attr('disabled',true);
        $("#eliminar_orinal").attr('disabled',true);
    });

    /**
     * Se captura el evento cuando se modifica el selector tipo_iluminacion y se
     * realiza la operacion correspondiente.
    */
    $("input[name=tipo_iluminacion]").change(function (e){
        var tipoIluminacion = $("input[name=tipo_iluminacion]").val();
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_capacidad_aire y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_capacidad_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la capacidad de aires acondicionados?");
        if (confirmacion) {
            var capacidad = limpiarCadena($("#capacidad").val());
            if (validarCadena(capacidad)) {
                var informacion = {};
                informacion["capacidad"] = capacidad;
                var data = guardarObjeto("capacidad_aire",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#capacidad").val("");
                }
            }else{
                alert("ERROR. Ingrese la capacidad de aires acondicionados");
                $("#capacidad").focus();
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_marca_aire y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_marca_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la marca de aires acondicionados?");
        if (confirmacion) {
            var capacidad = limpiarCadena($("#nombre_marca").val());
            if (validarCadena(capacidad)) {
                var informacion = {};
                informacion["nombre"] = capacidad;
                var data = guardarObjeto("marca_aire",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#nombre_marca").val("");
                }
            }else{
                alert("ERROR. Ingrese la marca de aires acondicionados");
                $("#nombre_marca").focus();
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_tipo_aire y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_tipo_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar el tipo de aires acondicionados?");
        if (confirmacion) {
            var tipo = limpiarCadena($("#nombre_tipo").val());
            if (validarCadena(tipo)) {
                var informacion = {};
                informacion["tipo_objeto"] = "tipo_aire";
                informacion["nombre_tipo_objeto"] = tipo;
                var data = guardarTipoObjeto(informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#nombre_tipo").val("");
                }
            }else{
                alert("ERROR. Ingrese el tipo de aires acondicionados");
                $("#nombre_tipo").focus();
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_tecnologia_aire y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_tecnologia_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la tecnología de aires acondicionados?");
        if (confirmacion) {
            var tecnologia = limpiarCadena($("#nombre_tecnologia").val());
            if (validarCadena(tecnologia)) {
                var informacion = {};
                informacion["tipo_objeto"] = "tipo_tecnologia_aire";
                informacion["nombre_tipo_objeto"] = tecnologia;
                var data = guardarTipoObjeto(informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#nombre_tecnologia").val("");
                }
            }else{
                alert("ERROR. Ingrese el nombre de la tecnología de aires acondicionados");
                $("#nombre_tecnologia").focus();
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_aire y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del aire acondicionado?");
        if (confirmacion) {
            var numeroInventario = limpiarCadena($("#numero_inventario").val());
            var sede = $("#nombre_sede").val();
            var campus = $("#nombre_campus").val();
            var edificio = $("#nombre_edificio").val();
            var espacio = $("#id_espacio").val();
            var capacidad = $("#capacidad_aire").val();
            var marca = $("#marca_aire").val();
            var tipo = $("#tipo_aire").val();
            var tecnologia = $("#tipo_tecnologia_aire").val();
            var fechaInstalacion = $("#fecha_instalacion").val();
            var instalador = limpiarCadena($("#instalador").val());
            var periodicidadMantenimiento = $("#tipo_periodicidad_mantenimiento").val();
            var ubicacionCondensadora = limpiarCadena($("#ubicacion_condensadora").val());
            var fotos = document.getElementById("fotos[]");
            if (fotos.files.length <= 20) {
                var arregloFotos = new FormData();
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        arregloFotos.append('archivo'+i,foto,nombreArchivo);
                    }
                }if(!validarCadena(sede)){
                    alert("ERROR. Seleccione la sede donde está el aire acondicionado");
                    $("#nombre_sede").focus();
                }else if(!validarCadena(campus)){
                    alert("ERROR. Seleccione el campus donde está el aire acondicionado");
                    $("#nombre_campus").focus();
                }else if(!validarCadena(edificio)){
                    alert("ERROR. Seleccione el edificio donde está el aire acondicionado");
                    $("#nombre_edificio").focus();
                }else if(!validarCadena(espacio)){
                    alert("ERROR. Seleccione el espacio donde está el aire acondicionado");
                    $("#id_espacio").focus();
                }else if(!validarCadena(marca)){
                    alert("ERROR. Seleccione la marca del aire acondicionado");
                    $("#marca_aire").focus();
                }else if(!validarCadena(tipo)){
                    alert("ERROR. Seleccione el tipo del aire acondicionado");
                    $("#tipo_aire").focus();
                }else if(!validarCadena(tecnologia)){
                    alert("ERROR. Seleccione la tecnolodía del aire acondicionado");
                    $("#tipo_tecnologia_aire").focus();
                }else if(!validarCadena(capacidad)){
                    alert("ERROR. Seleccione la capacidad del aire acondicionado");
                    $("#capacidad_aire").focus();
                }if(!validarFechaMenorActual(fechaInstalacion)){
                    alert("ERROR. La fecha de instalación del aire acondicionado es mayor a la fecha actual");
                    $("#fecha_instalacion").focus();
                }else{
                    var informacion = {};
                    informacion["numero_inventario"] = numeroInventario;
                    informacion["sede"] = sede;
                    informacion["campus"] = campus;
                    informacion["edificio"] = edificio;
                    informacion["espacio"] = espacio;
                    informacion["capacidad"] = capacidad;
                    informacion["marca"] = marca;
                    informacion["tipo"] = tipo;
                    informacion["tecnologia_aire"] = tecnologia;
                    informacion["fecha_instalacion"] = fechaInstalacion;
                    informacion["instalador"] = instalador;
                    informacion["periodicidad_mantenimiento"] = periodicidadMantenimiento;
                    informacion["ubicacion_condensadora"] = ubicacionCondensadora;
                    var data = guardarObjeto("aire_acondicionado",informacion);
                    var id_aire = "";
                    $.each(data.verificar, function(index, record) {
                        if($.isNumeric(index)) {
                            id_aire = record.id_aire;
                        }
                    });
                    if (data.verificar != false) {
                        informacion["id_aire"] = id_aire;
                        arregloFotos.append('aire',JSON.stringify(informacion));
                        var resultadoFotos = guardarFotos("aire",arregloFotos);
                        var mensaje = "";
                        mensaje += data.mensaje;
                        if (resultadoFotos.length != 0) {
                            for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                if (resultadoFotos.mensaje[i].indexOf("Error: SQL") == -1) {
                                    if (!resultadoFotos.verificar[i]) {
                                        if (mensaje == "") {
                                            mensaje += resultadoFotos.mensaje[i];
                                        }else{
                                            mensaje += "\n" + resultadoFotos.mensaje[i];
                                        }
                                    }
                                }
                            }
                        }
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }
                        $("#numero_inventario").val("");
                        $("#nombre_sede").val("").change();
                        $("#nombre_campus").empty();
                        $("#nombre_campus").val("");
                        $("#nombre_edificio").val("");
                        $("#pisos").val("");
                        $("#id_espacio").val("");
                        $("#marca_aire").val("");
                        $("#tipo_aire").val("");
                        $("#capacidad_aire").val("");
                        $("#tipo_tecnologia_aire").val("");
                        $("#fecha_instalacion").val("");
                        $("#fecha_instalacion").datepicker("clearDates");
                        $("#instalador").val("");
                        $("#tipo_periodicidad_mantenimiento").val("");
                        $("#ubicacion_condensadora").val("");
                        fotos.value = "";
                        window.scrollTo(0,0);
                    }else{
                        alert(data.mensaje);
                        $("#numero_inventario").focus();
                    }
                }
            }else{
                if (planos.files.length <= 5) {
                    alert("ERROR. El número máximo de planos por cubierta es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos por cubierta es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_mantenimiento_aire y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_mantenimiento_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del mantenimiento al aire acondicionado?");
        if (confirmacion) {
            var idAire = limpiarCadena($("#id_aire").val());
            var numeroOrden = limpiarCadena($("#numero_orden").val());
            var fechaRealizacion = $("#fecha_realizacion").val();
            var realizado = limpiarCadena($("#realizado").val());
            var revisado = limpiarCadena($("#revisado").val());
            var descripcionTrabajo = limpiarCadena($("#descripcion_trabajo").val());
            if (!validarCadena(idAire)) {
                alert("ERROR. Ingrese el id del aire acondicionado");
                $("#id_aire").focus();
            }else if(!validarCadena(numeroOrden)){
                alert("ERROR. Ingrese el número de la solicitud de mantenimiento");
                $("#numero_orden").focus();
            }else if(!validarCadena(fechaRealizacion)){
                alert("ERROR. Ingrese la fecha de realización de la solicitud de mantenimiento");
                $("#fecha_realizacion").focus();
            }else if(!validarFechaMenorActual(fechaRealizacion)){
                alert("ERROR. La fecha de realización ingresada es mayor a la fecha actual");
                $("#fecha_realizacion").focus();
            }else if(!validarCadena(realizado)){
                alert("ERROR. Ingrese la persona que realizó la solicitud de mantenimiento");
                $("#realizado").focus();
            }else if(!validarCadena(revisado)){
                alert("ERROR. Ingrese la persona que revisó la solicitud de mantenimiento");
                $("#revisado").focus();
            }else if(!validarCadena(descripcionTrabajo)){
                alert("ERROR. Ingrese una descripción del trabajo realizado en el aire acondicionado");
                $("#descripcion_trabajo").focus();
            }else{
                var informacion = {};
                informacion["id_aire"] = idAire;
                informacion["numero_orden"] = numeroOrden;
                informacion["fecha_realizacion"] = fechaRealizacion;
                informacion["realizado"] = realizado;
                informacion["revisado"] = revisado;
                informacion["descripcion"] = descripcionTrabajo;
                var data = guardarObjeto("mantenimiento_aire",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#id_aire").val("");
                    $("#numero_orden").val("");
                    $("#fecha_realizacion").val("");
                    $('#fecha_realizacion').datepicker("clearDates");
                    $("#realizado").val("");
                    $("#revisado").val("");
                    $("#descripcion_trabajo").val("");
                    window.scrollTo(0,0);
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón buscar_aire y se
     * realiza la operacion correspondiente.
    */
    $("#buscar_aire").click(function (e){
        $("#divDialogAiresEspacio").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón seleccionar_aire y se
     * realiza la operacion correspondiente.
    */
    $("#seleccionar_aire").click(function (e){
        $("#id_aire").val($("#id_aire_search").val());
        $("#divDialogAiresEspacio").modal('hide');
        $("#nombre_sede").val("").change();
        $("#nombre_campus").val("");
        $("#nombre_campus").empty();
        $("#id_aire_search").val("");
        $("#id_aire_search").empty();
        $("#seleccionar_aire").attr('disabled',true);
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_marca y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_marca").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la marca?");
        if (confirmacion) {
            var nombre = limpiarCadena($("#nombre_marca").val());
            var bodega = $("#bodega").val();
            if(!validarCadena(nombre)){
                alert("ERROR. Ingrese el nombre de la marca");
                $("#nombre_marca").focus();
            }else if(!validarCadena(bodega)){
                alert("ERROR. Seleccione la bodega de la marca");
                $("#bodega").focus();
            }else{
                var informacion = {};
                informacion["nombre"] = nombre;
                informacion["bodega"] = bodega;
                var data = guardarObjeto("marca_inventario",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#nombre_marca").val("");
                    $("#bodega").val("");
                    window.scrollTo(0,0);
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_proveedor y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_proveedor").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del proveedor?");
        if (confirmacion) {
            var nombre = limpiarCadena($("#nombre_proveedor").val());
            var direccion = limpiarCadena($("#direccion").val());
            var telefono = limpiarCadena($("#telefono").val());
            var nit = limpiarCadena($("#nit").val());
            var bodega = $("#bodega").val();
            if(!validarCadena(nombre)){
                alert("ERROR. Ingrese el nombre del proveedor");
                $("#nombre_marca").focus();
            }else if(!validarCadena(bodega)){
                alert("ERROR. Seleccione la bodega del proveedor");
                $("#bodega").focus();
            }else{
                var informacion = {};
                informacion["nombre"] = nombre;
                informacion["direccion"] = direccion;
                informacion["telefono"] = telefono;
                informacion["nit"] = nit;
                informacion["bodega"] = bodega;
                var data = guardarObjeto("proveedor",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#nombre_proveedor").val("");
                    $("#direccion").val("");
                    $("#telefono").val("");
                    $("#nit").val("");
                    $("#bodega").val("");
                    window.scrollTo(0,0);
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_categoria y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_categoria").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la categoría?");
        if (confirmacion) {
            var nombre = limpiarCadena($("#nombre_categoria").val());
            var bodega = limpiarCadena($("#bodega").val());
            if(!validarCadena(nombre)){
                alert("ERROR. Ingrese el nombre de la categoría");
                $("#nombre_categoria").focus();
            }else if(!validarCadena(bodega)){
                alert("ERROR. Seleccione la bodega a la que pertenece la categoría");
                $("#categoria").focus();
            }else{
                var informacion = {};
                informacion["nombre"] = nombre;
                informacion["bodega"] = bodega;
                var data = guardarObjeto("categoria",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#nombre_categoria").val("");
                    $("#bodega").val("");
                    window.scrollTo(0,0);
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector bodega
     * y se actualiza el selector de campus.
    */
    $("#bodega").change(function (e) {
        var bodega = $("#bodega").val();
        actualizarSelectMarcas(bodega);
        actualizarSelectCategorias(bodega);
        for (var i = 0; i <= proveedoresCont; i++) {
            actualizarSelectProveedores(i,bodega);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_articulo y se
     * realiza la operacion correspondiente.
    */
    $("#guardar_articulo").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del artículo?");
        if (confirmacion) {
            var nombreArticulo = limpiarCadena($("#nombre_articulo").val());
            var marca = $("#marca").val();
            var categoria = $("#categoria").val();
            var bodega = $("#bodega").val();
            var cantidadMinima = $("#cantidad_minima").val();
            var proveedores = [];
            var proveedorRepetido = false;
            for (var i = 0; i <= proveedoresCont; i++) {
                /*if (i == 0) {
                    if ($("#proveedor_articulo").val() != "") {
                        proveedores[i] = $("#proveedor_articulo").val();
                    }else{
                        alert("ERROR. Seleccione por lo menos un proveedor");
                        proveedorRepetido = true;
                        break;
                    }
                }else{*/
                    var aux = $("#proveedor_articulo"+i).val();
                    if (proveedores.indexOf(aux) == -1) {
                        proveedores[i] = $("#proveedor_articulo"+i).val();
                    }else{
                        alert("ERROR. El artículo tiene proveedores repetidos");
                        $("#proveedor_articulo"+i).focus();
                        proveedorRepetido = true;
                        break;
                    }
                //}
            }
            if (!proveedorRepetido) {
                var fotos = document.getElementById("fotos[]");
                if (fotos.files.length <= 20) {
                    var arregloFotos = new FormData();
                    for (var i=0;i<fotos.files.length;i++) {
                        var foto = fotos.files[i];
                        if (foto.size > 2000000) {
                            alert('La foto: "'+foto.name+"' es muy grande");
                        }else{
                            var nombreArchivo = foto.name;
                            if(nombreArchivo.length > 50){
                                nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                            }
                            arregloFotos.append('archivo'+i,foto,nombreArchivo);
                        }
                    }if(!validarCadena(nombreArticulo)){
                        alert("ERROR. Ingrese el nombre del artículo");
                        $("#nombre_articulo").focus();
                    }else if(!validarCadena(marca)){
                        alert("ERROR. Seleccione la marca del artículo");
                        $("#marca").focus();
                    }else if(!validarCadena(bodega)){
                        alert("ERROR. Seleccione la bodega a la que pertenece el artículo");
                        $("#bodega").focus();
                    }else if(!validarNumero(cantidadMinima)){
                        alert("ERROR. Ingrese la cantidad mínima del artículo ");
                        $("#cantidad_minima").focus();
                    }else{
                        var informacion = {};
                        informacion["nombre_articulo"] = nombreArticulo.replace("''", "");
                        informacion["nombre_articulo"] = nombreArticulo.replace("'", "");
                        informacion["marca"] = marca;
                        informacion["categoria"] = categoria;
                        informacion["bodega"] = bodega;
                        informacion["cantidad_minima"] = cantidadMinima;
                        informacion["proveedor"] = proveedores;
                        var data = guardarObjeto("articulo",informacion);
                        console.log(data);
                        var id_articulo = "";
                        $.each(data.verificar, function(index, record) {
                            if($.isNumeric(index)) {
                                id_articulo = record.id_articulo;
                            }
                        });
                        if (data.verificar != false) {
                            informacion["id_articulo"] = id_articulo;
                            arregloFotos.append('articulo',JSON.stringify(informacion));
                            var resultadoFotos = guardarFotos("articulo",arregloFotos);
                            var mensaje = "";
                            mensaje += data.mensaje;
                            if (resultadoFotos.length != 0) {
                                for (var i=0;i<resultadoFotos.mensaje.length;i++) {
                                    if (resultadoFotos.mensaje[i].indexOf("Error: SQL") == -1) {
                                        if (!resultadoFotos.verificar[i]) {
                                            if (mensaje == "") {
                                                mensaje += resultadoFotos.mensaje[i];
                                            }else{
                                                mensaje += "\n" + resultadoFotos.mensaje[i];
                                            }
                                        }
                                    }
                                }
                            }
                            if (mensaje.substring(0,1) != "") {
                                alert(mensaje);
                            }
                            $("#nombre_articulo").val("");
                            $("#marca").val("");
                            $("#categoria").val("");
                            $("#bodega").val("");
                            $("#cantidad_minima").val("");
                            $("#proveedor_articulo").val("");
                            while (proveedoresCont > 0) {
                                eliminarComponente("proveedor"+proveedoresCont);
                                proveedoresCont--;
                            }
                            fotos.value = "";
                            window.scrollTo(0,0);
                        }else{
                            alert(data.mensaje);
                            $("#nombre_articulo").focus();
                        }
                    }
                }else{
                    if (planos.files.length <= 5) {
                        alert("ERROR. El número máximo de planos por cubierta es 5");
                        planos.focus();
                    }else{
                        alert("ERROR. El número máximo de fotos por cubierta es 20");
                        fotos.focus();
                    }
                }
            }
        }
    });
});
