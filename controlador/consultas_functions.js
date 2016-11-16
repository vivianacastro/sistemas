$(document).ready(function() {
    var mapaConsulta, mapaModificacion, sedeSeleccionada, campusSeleccionado, codigoSeleccionado, objetoSeleccionado, numeroFotos = 0, numeroPlanos = 0;
    var iluminacionCont = 0, cerraduraCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0, puntosSanitariosCont = 0, lavamanosCont = 0, orinalesCont = 0, articulosCont = 0, proveedoresCont = 0, anadirArticulosCont = 0;
    var usoEspacioSelect;
    var marcadores = [], marcadoresModificacion = [];
    var URLactual = window.location;
    var infoWindowActiva;
    var coordsMapaModificacion;
    var coordenadas = {};
    var fotosEliminar = [], planosEliminar = [], tipoIluminacionEliminar = [], tipoSuministroEnergiaEliminar = [], tomacorrienteEliminar = [], tipoPuertaEliminar = [], materialPuertaEliminar = [], tipoCerraduraEliminar = [], materialMarcoPuertaEliminar = [], tipoVentanaEliminar = [], materialVentanaEliminar = [], tipoInterruptorEliminar = [], tipoPuntoSanitarioEliminar = [], tipoOrinalEliminar = [], tipoLavamanosEliminar = [], nombreProveedor = [];

    /**
     * Función que se ejecuta al momento que se accede a la página que lo tiene
     * incluido.
     * @returns {undefined}
    **/
    (function (){
        if(URLactual['href'].indexOf('consultar_sede') >= 0){
            actualizarSelectSede();
        }else if(URLactual['href'].indexOf('consultar_campus') >= 0){
            actualizarSelectSede();
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_edificio') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_fachada",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_cancha') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_pared",0);
            actualizarSelectMaterial("material_techo",0);
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            actualizarSelectTipoObjeto("tipo_interruptor",0);
            actualizarSelectTipoObjeto("tipo_suministro_energia",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_cubierta') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_cubierta",0);
            actualizarSelectTipoObjeto("tipo_cubierta",0);
            initMapConsulta();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_gradas') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_pasamanos",0);
            actualizarSelectMaterial("material_ventana",0);
            actualizarSelectTipoObjeto("tipo_ventana",0);
            initMapConsulta();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
            actualizarSelectSede();
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_cubierta",0);
            actualizarSelectTipoObjeto("tipo_iluminacion",0);
            actualizarSelectMaterial("material_piso",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_via') >= 0){
            actualizarSelectSede();
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectTipoObjeto("tipo_pintura",0);
            initMap();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_espacio') >= 0){
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
            initMapConsulta();
            rellenarMapa(mapaConsulta);
        }else if(URLactual['href'].indexOf('consultar_mapa') >= 0){
            initMapConsulta();
            rellenarMapaConsulta();
        }else if(URLactual['href'].indexOf('consultar_aire') >= 0){
            actualizarSelectSede();
            actualizarSelectCapacidadAire("capacidad_aire");
            actualizarSelectMarcaAire("marca_aire");
            actualizarSelectTipoObjeto("tipo_aire",0);
            actualizarSelectTipoObjeto("tipo_tecnologia_aire",0);
            actualizarSelectTipoObjeto("tipo_periodicidad_mantenimiento",0);
        }else if(URLactual['href'].indexOf('consultar_capacidad_aire') >= 0){
            actualizarSelectCapacidadAire("capacidad_aire_search");
        }else if(URLactual['href'].indexOf('consultar_marca_aire') >= 0){
            actualizarSelectMarcaAire("marca_aire_search");
        }else if(URLactual['href'].indexOf('consultar_tipo_aire') >= 0){
            actualizarSelectTipoAire("tipo_aire_search");
        }else if(URLactual['href'].indexOf('consultar_tecnologia_aire') >= 0){
            actualizarSelectTecnologiaAire("tecnologia_aire_search");
        }else if (URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
            actualizarSelectSede();
        }else if (URLactual['href'].indexOf('consultar_inventario')) {
            llenarTablaInventario();
            actualizarSelectMarcas();
            actualizarSelectProveedores(proveedoresCont);
        }
    })();

    /**
     * Función que carga el mapa y lo configura.
     * @returns {undefined}
    **/
    function initMap() {
        var options = {
            center: {lat: 3.375119, lng: -76.5336927}, //Coordenadas Univalle - Meléndez
            zoom: 15,
            //mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        mapaConsulta = new google.maps.Map(document.getElementById('map'), options);
        mapaModificacion = new google.maps.Map(document.getElementById('map_modificacion'), options);
    }

    /**
     * Función que carga el mapa y lo configura.
     * @returns {undefined}
    **/
    function initMapConsulta() {
        var options = {
            center: {lat: 3.375119, lng: -76.5336927}, //Coordenadas Univalle - Meléndez
            zoom: 16,
        }
        mapaConsulta = new google.maps.Map(document.getElementById('map'), options);
    }

    /**
     * Función que obtiene las coordenadas donde se encuentra el usuario
     * y actualiza el mapa.
     * @returns {undefined}
    **/
    function getCoordenadas(mapa){
        var coords = {};
        navigator.geolocation.getCurrentPosition(function (position){
            coords =  {
                lng: position.coords.longitude,
                lat: position.coords.latitude
            }
            mapa.panTo(coords);
            google.maps.event.trigger(mapa, 'resize');
        },function(error){
            console.log(error);
        });
    }

    /**
     * Función que permite guardar los planos que se suban al sistema.
     * @param {string} tipo_objeto, string cone el tipo de objeto (campus,edificio, etc.).
     * @param {formData} informacion, formData con las imagenes.
     * @returns {data}
    **/
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
    **/
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
     * Función que realiza una consulta de los campus presentes en el sistema.
     * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data} object json
    **/
    function buscarObjetos(tipo_objeto,informacion){
        if (tipo_objeto == "gradas") {
            tipo_objeto = "todas_gradas";
        }else if(tipo_objeto == "campus"){
            tipo_objeto = "todos_campus";
        }
        var jObject = JSON.stringify(informacion);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_"+tipo_objeto,
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
     * Función que guarda las modificaciones hechas por el usuario a un objeto (sede, campus, espacio, etc.)
     * @param {string} tipo_objeto, tipo de objeto a modificar (sede, campus, edificio, etc.).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data} object json
    **/
    function modificarObjeto(tipo_objeto,informacion){
        var jObject = JSON.stringify(informacion);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=modificar_"+tipo_objeto,
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
     * Función que permite eliminar un objeto (sede, campus, espacio, etc.)
     * @param {string} tipo_objeto, tipo de objeto a eliminar (sede, campus, edificio, etc.).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data} object json
    **/
    function eliminarObjeto(tipo_objeto,informacion){
        var jObject = JSON.stringify(informacion);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=eliminar_"+tipo_objeto,
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
     * Función que realiza una consulta de la informaci&oacute;n de un tipo de objeto en el sistema.
     * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data} object json
    **/
    function consultarInformacionObjeto(tipo_objeto,informacion){
        var jObject = JSON.stringify(informacion);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_informacion_"+tipo_objeto,
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
     * Función que realiza una consulta de los archivos de un tipo de objeto.
     * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data} object json
    **/
    function consultarArchivosObjeto(tipo_objeto,informacion){
        var jObject = JSON.stringify(informacion);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_archivos_"+tipo_objeto,
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
     * Función que realiza una consulta de la ubicación de un tipo de objeto en el sistema.
     * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
     * @param {array} informacion, información del tipo de objeto.
     * @returns {data} object json
    **/
    function ubicacionObjeto(tipo_objeto,informacion){
        var jObject = JSON.stringify(informacion);
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=ubicacion_"+tipo_objeto,
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
     * Función que realiza una consulta de los materiales presentes en el sistema.
     * @param {array} informacion, arreglo que contiene el tipo de material a buscar.
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
     * Función que realiza una consulta de los objetos presentes en el sistema.
     * @param {array} informacion, arreglo que contiene el tipo de objeto a buscar.
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
     * Función que realiza una verificación de si un elemento se encuentra registrado.
     * @param {array} elemento, elemento a consultar.
     * @param {array} informacion, arreglo que contiene el número de inventario.
     * @returns {data} object json
    **/
    function verificarElemento(elemento,informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=verificar_"+elemento,
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
     * Función que llena y actualiza el selector de campus.
     * @returns {undefined}
    **/
    function actualizarSelectSede(){
        var data = buscarObjetos("sedes","");
        $("#sede_search").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#sede_search");
        if (URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
            row = $("<option value='todos'/>");
            row.text("TODAS");
            row.appendTo("#sede_search");
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre_sede;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#sede_search");
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
     * Función que llena y actualiza el selector de capacida de un aire acondicionado.
     * @returns {undefined}
    **/
    function actualizarSelectCapacidadAire(input){
        var data = buscarCapacidadAire();
        $("#"+input).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#"+input);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.capacidad;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#"+input);
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de capacida de un aire acondicionado.
     * @returns {undefined}
    **/
    function actualizarSelectMarcaAire(input){
        var data = buscarMarcaAire();
        $("#"+input).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#"+input);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#"+input);
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de tipo de objeto.
     * @param {string} tipo_objeto, nombre del selector a actualizar y tipo de objeto.
     * @returns {undefined}
    **/
    function actualizarSelectTipoAire(input){
        var informacion = {};
        informacion['tipo_objeto'] = "tipo_aire";
        var data = buscarTipoObjetos(informacion);
        $("#"+input).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#"+input);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.tipo_objeto;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#"+input);
            }
        });
    }

    /**
     * Función que llena y actualiza el selector de tecnología de aires acondicionados.
     * @param {string} tipo_objeto, nombre del selector a actualizar y tipo de objeto.
     * @returns {undefined}
    **/
    function actualizarSelectTecnologiaAire(input){
        var informacion = {};
        informacion['tipo_objeto'] = "tipo_tecnologia_aire";
        var data = buscarTipoObjetos(informacion);
        $("#"+input).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#"+input);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.tipo_objeto;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#"+input);
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
     * Función que llena el mapa con todos los campus.
     * @returns {undefined}
    **/
    function rellenarMapa(mapa){
        for (var i = 0; i < marcadores.length; i++) {
            marcadores[i].setMap(null);
        }
        var bounds  = new google.maps.LatLngBounds();
        var sede = {};
        sede["nombre_sede"] = "";
        var data = buscarObjetos("campus",sede);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_campus.png',
                    title: record.nombre_campus,
                    id: record.id,
                    id_sede: record.id_sede
                });
                marcadores.push(marker);
                marker.setMap(mapa);
                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                bounds.extend(loc);
            }
        });
        if (data.mensaje != "") {
            mapa.fitBounds(bounds);
            mapa.panToBounds(bounds);
            for (var i = 0; i < marcadores.length; i++) {
                google.maps.event.addListener(marcadores[i], 'click',
                function () {
                    $("#sede_search").val(this.id_sede).change();
                    $("#campus_search").val(this.id).change();
                    mapa.setZoom(15);
                    mapa.setCenter(this.getPosition());
                });
            }
        }else{
            getCoordenadas(mapa);
        }
    }

    /**
     * Función que llena el mapa con todos los campus.
     * @returns {undefined}
    **/
    function rellenarMapaConsulta(){
        for (var i = 0; i < marcadores.length; i++) {
            marcadores[i].setMap(null);
        }
        var bounds  = new google.maps.LatLngBounds();
        var sede = {};
        sede["nombre_sede"] = "";
        var data = buscarObjetos("campus",sede);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                if (record.lat != '0' || record.lng != '0') {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_campus.png',
                        title: record.nombre_campus,
                        id: record.id,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Campus</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'</p>'+
                    '<div class="form_button">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_edificios" name="ver_edificios" id="ver_edificios" value="Ver Elementos Campus" title="Ver elementos del campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            }
        });
        if (data.mensaje != null) {
            mapaConsulta.fitBounds(bounds);
            mapaConsulta.panToBounds(bounds);
            for (var i = 0; i < marcadores.length; i++) {
                google.maps.event.addListener(marcadores[i], 'click',
                function () {
                    sedeSeleccionada = this.id_sede;
                    campusSeleccionado = this.id;
                    objetoSeleccionado = "campus",
                    mapaConsulta.setZoom(16);
                    mapaConsulta.setCenter(this.getPosition());
                });
            }
        }else{
            getCoordenadas(mapaConsulta);
        }
    }

    /**
     *funcion auxiliar que pinta un grafico dado los datos de entrada
    **/
    function generarGrafico(titulo,subtitulo,xCategorias,xTitulo,yTitulo,info){
        $('#divGrafico').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: titulo,
                style: {
                     fontweight: 'bolder'
                }
            },
            subtitle: {
                text: subtitulo
            },
            xAxis: {
                categories: xCategorias,
                title: {
                    text: xTitulo,
                    style: {
                         color: 'black',
                         fontweight: 'bolder'
                    }
                },
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: yTitulo,
                    style: {
                         color: 'black',
                         fontweight: 'bolder'
                    },
                    align: 'high'
                },
                labels: {
                    overflow: 'justify'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                pointFormat: 'Aires Acondicionados: <b>{point.y:.0f}</b>'
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: '',
                data: info,
                color: '#D51B23'
            }]
        });
    }

    /**
	 * Función que permite consultar el inventario.
	 * @returns {data}
	**/
	function listarInventario(){
		var dataResult;
		try {
			$.ajax({
				type: "POST",
				url: "index.php?action=listar_inventario",
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
     * Función que llena la tabla inventario.
     * @returns {undefined}
    **/
    function llenarTablaInventario(){
		for (var i=0;i<articulosCont;i++) {
            eliminarComponente("tr_tabla_inventario");
        }
        articulosCont = 0;
        var data = listarInventario();
        console.log(data);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                var id_articulo = record.id_articulo;
				var nombre = record.nombre_articulo;
				var cantidad = record.cantidad;
				var marca = record.nombre_marca;
				var cantidad_minima = record.cantidad_minima;
                $("#tabla_inventario").append("<tr id='tr_tabla_inventario'><td>"+id_articulo+"</td><td>"+nombre+"</td><td>"+cantidad+"</td><td>"+marca+"</td><td>"+cantidad_minima+"</td></tr>");
				articulosCont++;
            }
        });
		$("#tabla_inventario").show();
    }

    /**
     * Función que realiza una consulta de los proveedores.
     * @returns {data} object json.
    **/
    function buscarProveedores(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_proveedores",
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
    function buscarMarcas(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_marcas",
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
     * Función que realiza una consulta de los artículos.
     * @returns {data} object json.
    **/
    function buscarArticulos(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_articulos",
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
     * Función que realiza una consulta de un articulo en el inventario.
     * @returns {data} object json.
    **/
    function consultarArticuloInventario(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_articulo_inventario",
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
     * Función que llena y actualiza el selector de proveedor.
     * @returns {undefined}
    **/
    function actualizarSelectProveedores(id){
        if (id == 0) {
            id = "";
        }
        var data = buscarProveedores();
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
    function actualizarSelectMarcas(){
        var data = buscarMarcas();
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
     * Función que llena y actualiza el selector de artículos.
     * @returns {undefined}
    **/
    function actualizarSelectArticulo(id){
        if (id == 0) {
            id = "";
        }
        var data = buscarArticulos();
        $("#nombre_articulo"+id).empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#nombre_articulo"+id);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.nombre+" - "+record.nombre_marca;
                row = $("<option value='" + record.id_articulo + "'/>");
                row.text(aux);
                row.appendTo("#nombre_articulo"+id);
            }
        });
    }

    /**
     * Se captura el evento cuando se modifica el valor del selector sede_search
     * y se actualiza el selector de sedes.
    **/
    $("#sede_search").change(function (e) {
        if (URLactual['href'].indexOf('consultar_sede') >= 0) {
            var sede = $("#sede_search").val();
            if (validarCadena(sede)) {
                $('#visualizarSede').removeAttr("disabled");
            }else{
                $('#visualizarSede').attr('disabled',true);
            }
        }else{
            if (validarCadena($("#sede_search").val())) {
                if (URLactual['href'].indexOf('consultar_aire_ubicacion') >= 0 || URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
                    var sede = {};
                    $("#campus_search").empty();
                    $("#campus_search").val("");
                    sede["nombre_sede"] = $("#sede_search").val();
                    var data = buscarObjetos("campus",sede);
                    var row = $("<option value=''/>");
                    row.text("--Seleccionar--");
                    row.appendTo("#campus_search");
                    if (URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
                        row = $("<option value='todos'/>");
                        row.text("TODOS");
                        row.appendTo("#campus_search");
                        if ($("#sede_search").val() != 'todos') {
                            $("#divCampus").show();
                            $('#visualizarMarcasAiresMasInstaladas').attr('disabled',true);
                            $('#visualizarTiposAiresMasInstalados').attr('disabled',true);
                            $('#visualizarTipoTecnologiasAiresMasInstaladas').attr('disabled',true);
                            $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                            $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
                        }else{
                            $("#divCampus").hide();
                            $("#divEdificio").hide();
                            $('#visualizarMarcasAiresMasInstaladas').removeAttr("disabled");
                            $('#visualizarTiposAiresMasInstalados').removeAttr("disabled");
                            $('#visualizarTipoTecnologiasAiresMasInstaladas').removeAttr("disabled");
                            $("#fecha_inicio").change();
                            $("#fecha_fin").change();
                        }
                    }
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            aux = record.nombre_campus;
                            row = $("<option value='" + record.id + "'/>");
                            row.text(aux);
                            row.appendTo("#campus_search");
                        }
                    });
                }else{
                    for (var i = 0; i < marcadores.length; i++) {
                        marcadores[i].setMap(null);
                    }
                    var sede = {};
                    var bounds  = new google.maps.LatLngBounds();
                    $("#campus_search").empty();
                    $("#campus_search").val("");
                    if (URLactual['href'].indexOf('consultar_campus') >= 0) {
                        $('#visualizarCampus').attr('disabled',true);
                    }
                    if (validarCadena($("#sede_search").val())) {
                        sede["nombre_sede"] = $("#sede_search").val();
                        var data = buscarObjetos("campus",sede);
                    }else{
                        rellenarMapa(mapaConsulta);
                    }
                    var row = $("<option value=''/>");
                    row.text("--Seleccionar--");
                    row.appendTo("#campus_search");
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            aux = record.nombre_campus;
                            row = $("<option value='" + record.id + "'/>");
                            row.text(aux);
                            row.appendTo("#campus_search");
                            var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                            var marker = new google.maps.Marker({
                                position: myLatlng,
                                icon: 'vistas/images/icono_campus.png',
                                title: record.nombre_campus,
                                id: record.id,
                                id_sede: record.id_sede
                            });
                            marcadores.push(marker);
                            marker.setMap(mapaConsulta);
                            var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                            bounds.extend(loc);
                        }
                    });
                    if (data.mensaje != "") {
                        mapaConsulta.fitBounds(bounds);
                        mapaConsulta.panToBounds(bounds);
                        for (var i = 0; i < marcadores.length; i++) {
                            google.maps.event.addListener(marcadores[i], 'click',
                            function () {
                                $("#sede_search").val(this.id_sede);
                                $("#campus_search").val(this.id).change();
                                mapaConsulta.setZoom(15);
                                mapaConsulta.setCenter(this.getPosition());
                            });
                        }
                    }else{
                        getCoordenadas(mapaConsulta);
                    }
                    if (URLactual['href'].indexOf('consultar_edificio') >= 0) {
                        $("#edificio_search").empty();
                        $("#edificio_search").val("");
                    }else if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0 || URLactual['href'].indexOf('consultar_espacio') >= 0) {
                        $("#edificio_search").empty();
                        $("#edificio_search").val("");
                        $("#pisos_search").empty();
                        $("#pisos_search").val("");
                        $("#espacio_search").empty();
                        $("#espacio_search").val("");
                    }
                }
            }else{
                $("#campus_search").empty();
                $("#campus_search").val("");
                $("#codigo_search").empty();
                $("#codigo_search").val("");
                $("#edificio_search").empty();
                $("#edificio_search").val("");
                $("#pisos_search").empty();
                $("#pisos_search").val("");
                $("#espacio_search").empty();
                $("#espacio_search").val("");
                $("#id_aire_search").empty();
                $("#id_aire_search").val("");
                $('#visualizarCampus').attr('disabled',true);
                $('#visualizarCancha').attr('disabled',true);
                $('#visualizarCorredor').attr('disabled',true);
                $('#visualizarParqueadero').attr('disabled',true);
                $('#visualizarPiscina').attr('disabled',true);
                $('#visualizarPlazoleta').attr('disabled',true);
                $('#visualizarSendero').attr('disabled',true);
                $('#visualizarVia').attr('disabled',true);
                $('#visualizarCubierta').attr('disabled',true);
                $('#visualizarGradas').attr('disabled',true);
                $('#visualizarEdificio').attr('disabled',true);
                $('#visualizarEspacio').attr('disabled',true);
                $('#visualizarAire').attr('disabled',true);
                $("#fecha_inicio").change();
                $("#fecha_fin").change();
                var sede = $("#sede_search").val();
                if (URLactual['href'].indexOf('aires') == -1) {
                    rellenarMapa(mapaConsulta);
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector campus_search
     * y se actualiza el selector de campus.
    **/
    $("#campus_search").change(function (e) {
        if (URLactual['href'].indexOf('consultar_campus') >= 0) {
            for (var i = 0; i < marcadores.length; i++) {
                if (marcadores[i].id == $("#campus_search").val()) {
                    mapaConsulta.setCenter(marcadores[i].getPosition());
                    mapaConsulta.setZoom(15);
                    break;
                }
            }
            var campus = $("#campus_search").val();
            if (validarCadena(campus)) {
                $('#visualizarCampus').removeAttr("disabled");
            }else{
                $('#visualizarCampus').attr('disabled',true);
            }
        }else{
            if (URLactual['href'].indexOf('consultar_aire_ubicacion') >= 0 || URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
                var campus = {};
                if (validarCadena($("#campus_search").val())) {
                    var row = $("<option value=''/>");
                    campus["nombre_sede"] = $("#sede_search").val();
                    campus["nombre_campus"] = $("#campus_search").val();
                    var data = buscarObjetos("edificios",campus);
                    $("#edificio_search").empty();
                    $("#edificio_search").val("");
                    row.text("--Seleccionar--");
                    row.appendTo("#edificio_search");
                    if (URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
                        row = $("<option value='todos'/>");
                        row.text("TODOS");
                        row.appendTo("#edificio_search");
                        if ($("#campus_search").val() != 'todos') {
                            $("#divEdificio").show();
                            $('#visualizarMarcasAiresMasInstaladas').attr('disabled',true);
                            $('#visualizarTiposAiresMasInstalados').attr('disabled',true);
                            $('#visualizarTipoTecnologiasAiresMasInstaladas').attr('disabled',true);
                            $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                            $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
                        }else{
                            $("#divEdificio").hide();
                            $('#visualizarMarcasAiresMasInstaladas').removeAttr("disabled");
                            $('#visualizarTiposAiresMasInstalados').removeAttr("disabled");
                            $('#visualizarTipoTecnologiasAiresMasInstaladas').removeAttr("disabled");
                            $("#fecha_inicio").change();
                            $("#fecha_fin").change();
                        }
                    }
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            aux = record.id + " - " + record.nombre_edificio;
                            row = $("<option value='" + record.id + "'/>");
                            row.text(aux);
                            row.appendTo("#edificio_search");
                        }
                    });
                }else{
                    $("#edificio_search").empty();
                    $("#edificio_search").val("");
                    $("#pisos_search").empty();
                    $("#pisos_search").val("");
                    $("#espacio_search").empty();
                    $("#espacio_search").val("");
                    $("#id_aire_search").empty();
                    $("#id_aire_search").val("");
                    $('#visualizarAire').attr('disabled',true);
                }
            }else{
                for (var i = 0; i < marcadores.length; i++) {
                    marcadores[i].setMap(null);
                }
                var campus = {};
                var bounds  = new google.maps.LatLngBounds();
                if (validarCadena($("#campus_search").val())) {
                    campus["nombre_sede"] = $("#sede_search").val();
                    campus["nombre_campus"] = $("#campus_search").val();
                    if (URLactual['href'].indexOf('consultar_cancha') >= 0) {
                        $("#codigo_search").empty();
                        $("#codigo_search").val("");
                        var data = buscarObjetos("canchas",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id + " - " + record.uso;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_cancha.png',
                                    title: record.id + " - " + record.uso,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
                        $("#codigo_search").empty();
                        var data = buscarObjetos("corredores",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_corredor.png',
                                    title: record.id,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
                        $("#codigo_search").empty();
                        var data = buscarObjetos("parqueaderos",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_parqueadero.png',
                                    title: record.id,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
                        $("#codigo_search").empty();
                        var data = buscarObjetos("piscinas",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_piscina.png',
                                    title: record.id,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
                        $("#codigo_search").empty();
                        var data = buscarObjetos("plazoletas",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id + " - " + record.nombre;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_plazoleta.png',
                                    title: record.id + " - " + record.nombre,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
                        $("#codigo_search").empty();
                        var data = buscarObjetos("senderos",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_sendero.png',
                                    title: record.id,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else if(URLactual['href'].indexOf('consultar_via') >= 0){
                        $("#codigo_search").empty();
                        var data = buscarObjetos("vias",campus);
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#codigo_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#codigo_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_via.png',
                                    title: record.id,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#codigo_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                    }else{
                        var data = buscarObjetos("edificios",campus);
                        $("#edificio_search").empty();
                        if(URLactual['href'].indexOf('consultar_edificio') >= 0){
                            $('#visualizarEdificio').attr('disabled',true);
                        }
                        var row = $("<option value=''/>");
                        row.text("--Seleccionar--");
                        row.appendTo("#edificio_search");
                        $.each(data, function(index, record) {
                            if($.isNumeric(index)) {
                                aux = record.id + "-" + record.nombre_edificio;
                                row = $("<option value='" + record.id + "'/>");
                                row.text(aux);
                                row.appendTo("#edificio_search");
                                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                                var marker = new google.maps.Marker({
                                    position: myLatlng,
                                    icon: 'vistas/images/icono_edificio.png',
                                    title: record.id + "-" + record.nombre_edificio,
                                    id: record.id,
                                    id_sede: record.id_sede,
                                    id_campus: record.id_campus
                                });
                                marcadores.push(marker);
                                marker.setMap(mapaConsulta);
                                var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                                bounds.extend(loc);
                            }
                        });
                        if (data.mensaje != "") {
                            mapaConsulta.fitBounds(bounds);
                            mapaConsulta.panToBounds(bounds);
                            for (var i = 0; i < marcadores.length; i++) {
                                google.maps.event.addListener(marcadores[i], 'click',
                                function () {
                                    $("#edificio_search").val(this.id).change();
                                    mapaConsulta.setZoom(19);
                                    mapaConsulta.setCenter(this.getPosition());
                                });
                            }
                        }else{
                            getCoordenadas(mapaConsulta);
                        }
                        if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0 || URLactual['href'].indexOf('consultar_espacio') >= 0) {
                            $("#pisos_search").empty();
                            $("#pisos_search").val("");
                            $("#espacio_search").empty();
                            $("#espacio_search").val("");
                        }
                    }
                }else{
                    if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0 || URLactual['href'].indexOf('consultar_espacio') >= 0) {
                        $("#edificio_search").empty();
                        $("#edificio_search").val("");
                        $("#pisos_search").empty();
                        $("#pisos_search").val("");
                        $("#espacio_search").empty();
                        $("#espacio_search").val("");
                        $('#visualizarCubierta').attr('disabled',true);
                        $('#visualizarGradas').attr('disabled',true);
                        $('#visualizarEspacio').attr('disabled',true);
                    }else{
                        $("#codigo_search").empty();
                        $("#codigo_search").val("");
                        $('#visualizarEdificio').attr('disabled',true);
                        $('#visualizarAire').attr('disabled',true);
                    }
                    $("#edificio_search").empty();
                    $("#edificio_search").val("");
                    $("#pisos_search").empty();
                    $("#pisos_search").val("");
                    $("#espacio_search").empty();
                    $("#espacio_search").val("");
                    var sede = $("#sede_search").val();
                    $("#sede_search").val(sede).change();
                    $("#fecha_inicio").change();
                    $("#fecha_fin").change();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector codigo_search
     * y se actualiza el selector de códigos.
    **/
    $("#codigo_search").change(function (e) {
        if (validarCadena($("#codigo_search").val())) {
            if(URLactual['href'].indexOf('consultar_cancha') >= 0){
                $('#visualizarCancha').removeAttr("disabled");
            }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
                $('#visualizarCorredor').removeAttr("disabled");
            }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
                $('#visualizarParqueadero').removeAttr("disabled");
            }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
                $('#visualizarPiscina').removeAttr("disabled");
            }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
                $('#visualizarPlazoleta').removeAttr("disabled");
            }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
                $('#visualizarSendero').removeAttr("disabled");
            }else if(URLactual['href'].indexOf('consultar_via') >= 0){
                $('#visualizarVia').removeAttr("disabled");
            }
            for (var i = 0; i < marcadores.length; i++) {
                var codigo = $("#codigo_search").val();
                if(codigo == marcadores[i].id){
                    mapaConsulta.setCenter(marcadores[i].getPosition());
                    mapaConsulta.setZoom(19);
                    break;
                }
            }
        }else{
            if(URLactual['href'].indexOf('consultar_cancha') >= 0){
                $('#visualizarCancha').attr('disabled',true);
            }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
                $('#visualizarCorredor').attr('disabled',true);
            }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
                $('#visualizarParqueadero').attr('disabled',true);
            }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
                $('#visualizarPiscina').attr('disabled',true);
            }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
                $('#visualizarPlazoleta').attr('disabled',true);
            }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
                $('#visualizarSendero').attr('disabled',true);
            }else if(URLactual['href'].indexOf('consultar_via') >= 0){
                $('#visualizarVia').attr('disabled',true);
            }
            var campus = $("#campus_search").val();
            $("#campus_search").val(campus).change();
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector edificio_search
     * y se actualiza el selector de edificios.
    **/
    $("#edificio_search").change(function (e) {
        if (URLactual['href'].indexOf('consultar_edificio') >= 0) {
            for (var i = 0; i < marcadores.length; i++) {
                if (marcadores[i].id == $("#edificio_search").val()) {
                    mapaConsulta.setCenter(marcadores[i].getPosition());
                    mapaConsulta.setZoom(19);
                    break;
                }
            }
            if (validarCadena($("#edificio_search").val())) {
                $('#visualizarCubierta').removeAttr("disabled");
                $('#visualizarGradas').removeAttr("disabled");
                $('#visualizarEdificio').removeAttr("disabled");
            }else{
                $('#visualizarCubierta').attr('disabled',true);
                $('#visualizarGradas').attr('disabled',true);
                $('#visualizarEdificio').attr('disabled',true);

            }
        }else if (URLactual['href'].indexOf('mas_marcas_aire') >= 0 || URLactual['href'].indexOf('mas_tipos_aire') >= 0 || URLactual['href'].indexOf('mas_tipo_tecnologias_aire') >= 0 || URLactual['href'].indexOf('aires_mas_mantenimientos') >= 0 || URLactual['href'].indexOf('marcas_mas_mantenimientos') >= 0) {
            if (validarCadena($("#edificio_search").val())){
                $('#visualizarMarcasAiresMasInstaladas').removeAttr("disabled");
                $('#visualizarTiposAiresMasInstalados').removeAttr("disabled");
                $('#visualizarTipoTecnologiasAiresMasInstaladas').removeAttr("disabled");
                $("#fecha_inicio").change();
                $("#fecha_fin").change();
            }else{
                $('#visualizarMarcasAiresMasInstaladas').attr('disabled',true);
                $('#visualizarTiposAiresMasInstalados').attr('disabled',true);
                $('#visualizarTipoTecnologiasAiresMasInstaladas').attr('disabled',true);
                $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
            }
        }else{
            var edificio = {};
            var numeroPisos, terraza, sotano;
            if (validarCadena($("#edificio_search").val())) {
                var data;
                edificio["nombre_sede"] = $("#sede_search").val();
                edificio["nombre_campus"] = $("#campus_search").val();
                edificio["nombre_edificio"] = $("#edificio_search").val();
                if(URLactual['href'].indexOf('consultar_cubierta') >= 0){
                    data = buscarObjetos("cubiertas",edificio);
                }else if(URLactual['href'].indexOf('consultar_gradas') >= 0){
                    data = buscarObjetos("gradas",edificio);
                }else{
                    data = buscarObjetos("pisos_edificio",edificio);
                }
                if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0) {
                    $("#pisos_search").empty();
                    $("#pisos_search").val("");
                    var row = $("<option value=''/>");
                    row.text("--Seleccionar--");
                    row.appendTo("#pisos_search");
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            var aux;
                            piso = record.piso;
                            if (piso == '0') {
                                aux = "Sótano";
                                row = $("<option value='sotano'/>");
                                row.text(aux);
                                row.appendTo("#pisos_search");
                            }else if (piso == '-1') {
                                aux = "Terraza";
                                row = $("<option value='terraza'/>");
                                row.text(aux);
                                row.appendTo("#pisos_search");
                            }else{
                                row = $("<option value='" + piso + "'/>");
                                row.text(piso);
                                row.appendTo("#pisos_search");
                            }
                        }
                    });
                    for (var i=0; i<numeroPisos;i++) {
                        if (i == 0 && sotano == 'true') {
                            aux = "Sótano";
                            row = $("<option value='sotano'/>");
                            row.text(aux);
                            row.appendTo("#pisos_search");
                        }
                        aux = i+1;
                        row = $("<option value='" + aux + "'/>");
                        row.text(aux);
                        row.appendTo("#pisos_search");
                        if (i == (numeroPisos-1) && terraza == 'true') {
                            aux = "Terraza";
                            row = $("<option value='terraza'/>");
                            row.text(aux);
                            row.appendTo("#pisos_search");
                        }
                    }
                }else{
                    $("#pisos_search").empty();
                    $("#pisos_search").val("");
                    var row = $("<option value=''/>");
                    row.text("--Seleccionar--");
                    row.appendTo("#pisos_search");
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
                            row.appendTo("#pisos_search");
                        }
                        aux = i+1;
                        row = $("<option value='" + aux + "'/>");
                        row.text(aux);
                        row.appendTo("#pisos_search");
                        if (i == (numeroPisos-1) && terraza == 'true') {
                            aux = "Terraza";
                            row = $("<option value='terraza'/>");
                            row.text(aux);
                            row.appendTo("#pisos_search");
                        }
                    }
                }
                for (var i = 0; i < marcadores.length; i++) {
                    var codigo = $("#edificio_search").val();
                    if(codigo == marcadores[i].id){
                        mapaConsulta.setCenter(marcadores[i].getPosition());
                        mapaConsulta.setZoom(19);
                        break;
                    }
                }
                $("#espacio_search").empty();
                $("#espacio_search").val("");
            }else{
                $("#pisos_search").empty();
                $("#pisos_search").val("");
                $("#espacio_search").empty();
                $("#espacio_search").val("");
                $("#id_aire_search").val("");
                $("#id_aire_search").empty();
                var campus = $("#campus_search").val();
                $("#campus_search").val(campus).change();
                $('#visualizarEdificio').attr('disabled',true);
                $('#visualizarEspacio').attr('disabled',true);
                $('#visualizarAire').attr('disabled',true);
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del input fecha_inicio.
    **/
    $("#fecha_inicio").change(function (e) {
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var edificio = $("#edificio_search").val();
        var fechaInicio = $("#fecha_inicio").val();
        var fechaFin = $("#fecha_fin").val();
        if (validarCadena(fechaInicio) && validarCadena(fechaFin)) {
            if (fechaInicio > fechaFin) {
                $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
            }else{
                if (sede == 'todos') {
                    $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                    $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                }else{
                    if (campus == 'todos') {
                        $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                        $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                    }else{
                        if (edificio == 'todos') {
                            $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                            $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                        }else if(validarCadena(edificio)){
                            $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                            $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                        }else{
                            $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                            $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
                        }
                    }
                }
            }
        }else{
            $('#visualizarAiresMasMantenimientos').attr('disabled',true);
            $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del input fecha_fin.
    **/
    $("#fecha_fin").change(function (e) {
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var edificio = $("#edificio_search").val();
        var fechaInicio = $("#fecha_inicio").val();
        var fechaFin = $("#fecha_fin").val();
        if (validarCadena(fechaFin)) {
            if (fechaInicio > fechaFin) {
                $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
            }else{
                if (sede == 'todos') {
                    $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                    $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                }else{
                    if (campus == 'todos') {
                        $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                        $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                    }else{
                        if (edificio == 'todos') {
                            $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                            $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                        }else if(validarCadena(edificio)){
                            $('#visualizarAiresMasMantenimientos').removeAttr("disabled");
                            $('#visualizarMarcasMasMantenimientos').removeAttr("disabled");
                        }else{
                            $('#visualizarAiresMasMantenimientos').attr('disabled',true);
                            $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
                        }
                    }
                }
            }
        }else{
            $('#visualizarAiresMasMantenimientos').attr('disabled',true);
            $('#visualizarMarcasMasMantenimientos').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector pisos_search
     * y se actualiza el selector de pisos.
    **/
    $("#pisos_search").change(function (e) {
        if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0) {
            for (var i = 0; i < marcadores.length; i++) {
                if (marcadores[i].id == $("#edificio_search").val()) {
                    mapaConsulta.setCenter(marcadores[i].getPosition());
                    break;
                }
            }
            if (validarCadena($("#pisos_search").val())) {
                $('#visualizarCubierta').removeAttr("disabled");
                $('#visualizarGradas').removeAttr("disabled");
            }else{
                $('#visualizarCubierta').attr('disabled',true);
                $('#visualizarGradas').attr('disabled',true);
            }
        }else{
            if (validarCadena($("#pisos_search").val())) {
                var edificio = {};
                edificio["nombre_sede"] = $("#sede_search").val();
                edificio["nombre_campus"] = $("#campus_search").val();
                edificio["nombre_edificio"] = $("#edificio_search").val();
                edificio["piso"] = $("#pisos_search").val();
                var data = buscarObjetos("espacios",edificio);
                $("#espacio_search").empty();
                $("#espacio_search").val("");
                $("#id_aire_search").empty();
                $("#id_aire_search").val("");
                var row = $("<option value=''/>");
                row.text("--Seleccionar--");
                row.appendTo("#espacio_search");
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        aux = record.id;
                        row = $("<option value='" + record.id + "'/>");
                        row.text(aux);
                        row.appendTo("#espacio_search");
                    }
                });
            }else{
                $("#pisos_search").empty();
                $("#pisos_search").val("");
                $("#espacio_search").empty();
                $("#espacio_search").val("");
                $("#id_aire_search").empty();
                $("#id_aire_search").val("");
                var edificio = $("#edificio_search").val();
                $("#edificio_search").val(edificio).change();
                $('#visualizarEdificio').attr('disabled',true);
                $('#visualizarEspacio').attr('disabled',true);
                $('#visualizarAire').attr('disabled',true);
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector espacio_search
     * y se actualiza el selector de espacios.
    **/
    $("#espacio_search").change(function (e) {
        if(URLactual['href'].indexOf('consultar_aire') >= 0){
            var sede = $("#sede_search");
            var campus = $("#campus_search");
            var edificio = $("#edificio_search");
            var espacio = $("#espacio_search");
            if (validarCadena($("#espacio_search").val())) {
                var informacion = {};
                informacion["id_sede"] = $("#sede_search").val();
                informacion["id_campus"] = $("#campus_search").val();
                informacion["id_edificio"] = $("#edificio_search").val();
                informacion["id_espacio"] = $("#espacio_search").val();
                var data = buscarObjetos("aires_ubicacion",informacion);
                $("#id_aire_search").empty();
                $("#id_aire_search").val("");
                var row = $("<option value=''/>");
                row.text("--Seleccionar--");
                row.appendTo("#id_aire_search");
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        aux = record.id_aire+" - "+record.numero_inventario;
                        row = $("<option value='" + record.id_aire + "'/>");
                        row.text(aux);
                        row.appendTo("#id_aire_search");
                    }
                });
            }else{
                $("#id_aire_search").empty();
                $("#id_aire_search").val("");
                $('#visualizarAire').attr('disabled',true);
            }
        }else{
            if (validarCadena($("#espacio_search").val())) {
                $('#visualizarEspacio').removeAttr("disabled");
            }else{
                $('#visualizarEspacio').attr('disabled',true);
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector numero_inventario_search
     * y se actualiza el selector de espacios.
    **/
    $("#numero_inventario_search").change(function (e) {
        if (validarCadena($("#numero_inventario_search").val())) {
            $('#visualizarAire').removeAttr("disabled");
        }else{
            $('#visualizarAire').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector numero_inventario_search
     * y se actualiza el selector de espacios.
    **/
    $("#id_aire_search").change(function (e) {
        if(URLactual['href'].indexOf('consultar_mantenimiento_aire_id_aire') >= 0){
            var idAire = $("#id_aire_search").val();
            if (validarCadena(idAire)) {
                var informacion = {};
                var row = $("<option value=''/>");
                informacion["id_aire"] = idAire;
                var data = buscarObjetos("mantenimientos_aire",informacion);
                console.log(data);
                $("#numero_orden_search").empty();
                row.text("--Seleccionar--");
                row.appendTo("#numero_orden_search");
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        aux = record.numero_orden;
                        row = $("<option value='" + record.numero_orden + "'/>");
                        row.text(aux);
                        row.appendTo("#numero_orden_search");
                    }
                });
            }else{
                $('#numero_orden_search').empty();
                $('#numero_orden_search').val("");
            }
        }else{
            if (validarCadena($("#id_aire_search").val())) {
                $('#visualizarAire').removeAttr("disabled");
            }else{
                $('#visualizarAire').attr('disabled',true);
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del input numero_orden_search
     * y se actualiza el selector de espacios.
    **/
    $("#numero_orden_search").change(function (e) {
        if (validarCadena($("#numero_orden_search").val())) {
            $('#visualizarMantenimientoAire').removeAttr("disabled");
        }else{
            $('#visualizarMantenimientoAire').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector pisos_search
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#tipo_material_search").change(function (e) {
        if (validarCadena($("#tipo_material_search").val())) {
            var tipoObjeto = {};
            tipoObjeto["tipo_material"] = $("#tipo_material_search").val();
            var data = buscarObjetos("materiales",tipoObjeto);
            $("#nombre_tipo_material_search").empty();
            var row = $("<option value=''/>");
            row.text("--Seleccionar--");
            row.appendTo("#nombre_tipo_material_search");
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    aux = record.nombre_material;
                    row = $("<option name='"+record.id+"' value='" + limpiarCadena(record.nombre_material) + "'/>");
                    row.text(aux);
                    row.appendTo("#nombre_tipo_material_search");
                }
            });
        }else{
            $("#nombre_tipo_material_search").empty();
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_tipo_material_search
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#nombre_tipo_material_search").change(function (e) {
        if (validarCadena($("#nombre_tipo_material_search").val())) {
            $('#visualizarTipoMaterial').removeAttr("disabled");
        }else{
            $('#visualizarTipoMaterial').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector pisos_search
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#tipo_objeto_search").change(function (e) {
        if (validarCadena($("#tipo_objeto_search").val())) {
            var tipoObjeto = {};
            tipoObjeto["tipo_objeto"] = $("#tipo_objeto_search").val();
            var data = buscarObjetos("tipo_objetos",tipoObjeto);
            $("#nombre_tipo_objeto_search").empty();
            var row = $("<option value=''/>");
            row.text("--Seleccionar--");
            row.appendTo("#nombre_tipo_objeto_search");
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    aux = record.tipo_objeto;
                    row = $("<option name='"+record.id+"' value='" + limpiarCadena(record.tipo_objeto) + "'/>");
                    row.text(aux);
                    row.appendTo("#nombre_tipo_objeto_search");
                }
            });
        }else{
            $("#nombre_tipo_objeto_search").empty();
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_tipo_objeto_search
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#nombre_tipo_objeto_search").change(function (e) {
        if (validarCadena($("#nombre_tipo_objeto_search").val())) {
            $('#visualizarTipoObjeto').removeAttr("disabled");
        }else{
            $('#visualizarTipoObjeto').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector capacidad_aire
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#capacidad_aire_search").change(function (e) {
        if (validarCadena($("#capacidad_aire_search").val())) {
            $('#visualizarCapacidadAires').removeAttr("disabled");
        }else{
            $('#visualizarCapacidadAires').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector marca_aire
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#marca_aire_search").change(function (e) {
        if (validarCadena($("#marca_aire_search").val())) {
            $('#visualizarMarcaAires').removeAttr("disabled");
        }else{
            $('#visualizarMarcaAires').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector tipo_aire
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#tipo_aire_search").change(function (e) {
        if (validarCadena($("#tipo_aire_search").val())) {
            $('#visualizarTipoAires').removeAttr("disabled");
        }else{
            $('#visualizarTipoAires').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector tecnologia_aire_search
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#tecnologia_aire_search").change(function (e) {
        if (validarCadena($("#tecnologia_aire_search").val())) {
            $('#visualizarTecnologiaAires').removeAttr("disabled");
        }else{
            $('#visualizarTecnologiaAires').attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_articulo
     * y se actualiza el selector de tipo de objeto.
    **/
    $("#nombre_articulo").change(function (e) {
        var idArticulo = $("#nombre_articulo").val();
        var informacion = {};
        informacion["id_articulo"] = idArticulo;
        var data = consultarArticuloInventario(informacion);
        console.log(data);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#cantidad").attr('name',record.cantidad);
                $("#cantidad").attr("placeholder","Disponibles: "+record.cantidad);
            }
        });
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarSede y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarSede").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = "";
        var data = consultarInformacionObjeto("sede",informacion);
        console.log(data);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
            }
        });
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarCampus y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarCampus").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        var data = consultarInformacionObjeto("campus",informacion);
        var archivos = consultarArchivosObjeto("campus",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_campus.png',
                    title: record.nombre_campus,
                    id: record.id_campus,
                    id_sede: record.id_sede
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/campus/'+sede+'-'+campus+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(15);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarCancha y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarCancha").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("cancha",informacion);
        var archivos = consultarArchivosObjeto("cancha",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_cancha").attr('name',record.id);
                $("#id_cancha").val(record.id);
                $("#uso_cancha").val(record.uso);
                $("#material_piso").val(record.material_piso);
                $("#tipo_pintura").val(record.tipo_pintura);
                $("#longitud_demarcacion").val(record.longitud_demarcacion);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_cancha.png',
                    title: record.id+" - "+record.uso,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente;
                    var componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos)
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarCorredor y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarCorredor").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("corredor",informacion);
        var dataIluminacion = consultarInformacionObjeto("iluminacion_corredor",informacion);
        var dataInterruptor = consultarInformacionObjeto("interruptor_corredor",informacion);
        var archivos = consultarArchivosObjeto("corredor",informacion);
        console.log(data);
        console.log(dataIluminacion);
        console.log(dataInterruptor);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_corredor").attr('name',record.id);
                $("#id_corredor").val(record.id);
                $("#altura_pared").val(record.ancho_pared);
                $("#ancho_pared").val(record.alto_pared);
                $("#material_pared").val(record.material_pared);
                $("#ancho_piso").val(record.ancho_piso);
                $("#largo_piso").val(record.largo_piso);
                $("#material_piso").val(record.material_piso);
                $("#ancho_techo").val(record.ancho_techo);
                $("#largo_techo").val(record.largo_techo);
                $("#material_techo").val(record.material_techo);
                $("#tomacorriente").val(record.tomacorriente);
                $("#tipo_suministro_energia").val(record.tipo_suministro_energia);
                $("#cantidad_tomacorrientes").val(record.cantidad);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_corredor.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $.each(dataIluminacion, function(index, record) {
            if($.isNumeric(index)) {
                if (iluminacionCont == 0) {
                    $("#tipo_iluminacion").val(record.tipo_iluminacion);
                    $("#tipo_iluminacion").attr('name',record.tipo_iluminacion);
                    $("#cantidad_iluminacion").val(record.cantidad);
                    $("#cantidad_iluminacion").attr('name',record.cantidad);
                    $("#tipo_iluminacion option[value='']").hide();
                }else{
                    var componente = '<div id="iluminacion'+iluminacionCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_iluminacion'+iluminacionCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("iluminacion",componente);
                    actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
                    $("#tipo_iluminacion"+iluminacionCont).val(record.tipo_iluminacion);
                    $("#tipo_iluminacion"+iluminacionCont).attr('name',record.tipo_iluminacion);
                    $("#cantidad_iluminacion"+iluminacionCont).val(record.cantidad);
                    $("#cantidad_iluminacion"+iluminacionCont).attr('name',record.cantidad);
                    $("#tipo_iluminacion"+iluminacionCont+" option[value='']").hide();
                }
                iluminacionCont++;
            }
        });
        $.each(dataInterruptor, function(index, record) {
            if($.isNumeric(index)) {
                if (interruptoresCont == 0) {
                    $("#tipo_interruptor").val(record.tipo_interruptor);
                    $("#tipo_interruptor").attr('name',record.tipo_interruptor);
                    $("#cantidad_interruptores").val(record.cantidad);
                    $("#cantidad_interruptores").attr('name',record.cantidad);
                    $("#tipo_interruptor option[value='']").hide();
                }else{
                    var componente = '<div id="interruptor'+interruptoresCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_interruptor'+interruptoresCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_interruptores'+interruptoresCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("interruptor",componente);
                    actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
                    $("#tipo_interruptor"+interruptoresCont).val(record.tipo_interruptor);
                    $("#tipo_interruptor"+interruptoresCont).attr('name',record.tipo_interruptor);
                    $("#cantidad_interruptores"+interruptoresCont).val(record.cantidad);
                    $("#cantidad_interruptores"+interruptoresCont).attr('name',record.cantidad);
                    $("#tipo_interruptor"+interruptoresCont+" option[value='']").hide();
                }
                interruptoresCont++;
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarCubierta y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarCubierta").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var edificio = $("#edificio_search").val();
        var piso = $("#pisos_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['nombre_edificio'] = limpiarCadena(edificio);
        var piso = piso;
        if (piso == 'sotano') {
            piso = '0';
        }else if(piso == 'terraza'){
            piso = '-1';
        }
        informacion['piso'] = piso;
        var data = consultarInformacionObjeto("cubierta",informacion);
        var archivos = consultarArchivosObjeto("cubierta",informacion);
        console.log(data);
        console.log(archivos);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#nombre_edificio").attr('name',record.id_edificio);
                $("#nombre_edificio").val(record.id_edificio+" - "+record.nombre_edificio);
                var piso = record.piso;
                if (piso == '0') {
                    piso = 'sotano';
                }else if (piso == '-1') {
                    piso = 'terraza';
                }
                $("#pisos").val(piso);
                $("#tipo_cubierta").val(record.tipo_cubierta);
                $("#material_cubierta").val(record.material_cubierta);
                $("#ancho").val(record.ancho);
                $("#largo").val(record.largo);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarGradas y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarGradas").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var edificio = $("#edificio_search").val();
        var piso = $("#pisos_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['nombre_edificio'] = limpiarCadena(edificio);
        var piso = piso;
        if (piso == 'sotano') {
            piso = '0';
        }else if(piso == 'terraza'){
            piso = '-1';
        }
        informacion['piso_inicio'] = piso;
        var data = consultarInformacionObjeto("gradas",informacion);
        var dataVentana = consultarInformacionObjeto("ventana_gradas",informacion);
        var archivos = consultarArchivosObjeto("gradas",informacion);
        console.log(data);
        console.log(dataVentana);
        console.log(archivos);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#nombre_edificio").attr('name',record.id_edificio);
                $("#nombre_edificio").val(record.id_edificio+" - "+record.nombre_edificio);
                var piso = record.piso_inicio;
                if (piso == '0') {
                    piso = 'sotano';
                }else if (piso == '-1') {
                    piso = 'terraza';
                }
                $("#pisos").val(piso);
                $("input[name=pasamanos][value="+ record.pasamanos + "]").prop('checked', true);
                $("#material_pasamanos").val(record.material_pasamanos);
                if (record.pasamanos == 'true') {
                    $("#divPasamanos").show();
                }
            }
        });
        $.each(dataVentana, function(index, record) {
            if($.isNumeric(index)) {
                if (ventanasCont == 0) {
                    $("#tipo_ventana").val(record.tipo_ventana);
                    $("#tipo_ventana").attr('name',record.tipo_ventana);
                    $("#cantidad_ventanas").val(record.cantidad);
                    $("#cantidad_ventanas").attr('name',record.cantidad);
                    $("#material_ventana").val(record.material);
                    $("#material_ventana").attr('name',record.material);
                    $("#ancho_ventana").val(record.ancho);
                    $("#ancho_ventana").attr('name',record.ancho);
                    $("#alto_ventana").val(record.alto);
                    $("#alto_ventana").attr('name',record.alto);
                    $("#tipo_ventana option[value='']").hide();
                    $("#cantidad_ventanas option[value='']").hide();
                }else{
                    var componente = '<div id="ventana'+ventanasCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_ventana'+ventanasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_ventanas'+ventanasCont+'" value="" disabled required/><br>'
                    +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="material_ventana'+ventanasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="ancho_ventana'+ventanasCont+'" value="" disabled required/><br>'
                    +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="alto_ventana'+ventanasCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("ventana",componente);
                    actualizarSelectMaterial("material_ventana",ventanasCont);
                    actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
                    $("#tipo_ventana"+ventanasCont).val(record.tipo_ventana);
                    $("#tipo_ventana"+ventanasCont).attr('name',record.tipo_ventana);
                    $("#cantidad_ventanas"+ventanasCont).val(record.cantidad);
                    $("#cantidad_ventanas"+ventanasCont).attr('name',record.cantidad);
                    $("#material_ventana"+ventanasCont).val(record.material);
                    $("#material_ventana"+ventanasCont).attr('name',record.material);
                    $("#ancho_ventana"+ventanasCont).val(record.ancho);
                    $("#ancho_ventana"+ventanasCont).attr('name',record.ancho);
                    $("#alto_ventana"+ventanasCont).val(record.alto);
                    $("#alto_ventana"+ventanasCont).attr('name',record.alto);
                    $("#tipo_ventana"+ventanasCont+" option[value='']").hide();
                    $("#material_ventana"+ventanasCont+" option[value='']").hide();
                }
                ventanasCont++;
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarParqueadero y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarParqueadero").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("parqueadero",informacion);
        var archivos = consultarArchivosObjeto("parqueadero",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_parqueadero").attr('name',record.id);
                $("#id_parqueadero").val(record.id);
                $("#capacidad").val(record.capacidad);
                $("#ancho").val(record.ancho);
                $("#largo").val(record.largo);
                $("#material_piso").val(record.material_piso);
                $("#tipo_pintura").val(record.tipo_pintura_demarcacion);
                $("#longitud_demarcacion").val(record.longitud_demarcacion);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_parqueadero.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarPiscina y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarPiscina").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("piscina",informacion);
        var archivos = consultarArchivosObjeto("piscina",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_piscina").attr('name',record.id);
                $("#id_piscina").val(record.id);
                $("#alto").val(record.alto);
                $("#ancho").val(record.ancho);
                $("#largo").val(record.largo);
                $("#cantidad_puntos_hidraulicos").val(record.cantidad_punto_hidraulico);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_piscina.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarPlazoleta y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarPlazoleta").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("plazoleta",informacion);
        var dataIluminacion = consultarInformacionObjeto("iluminacion_plazoleta",informacion);
        var archivos = consultarArchivosObjeto("plazoleta",informacion);
        console.log(data);
        console.log(dataIluminacion);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_plazoleta").attr('name',record.id);
                $("#id_plazoleta").val(record.id);
                $("#nombre").val(record.nombre);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_plazoleta.png',
                    title: record.id+" - "+record.nombre,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $.each(dataIluminacion, function(index, record) {
            if($.isNumeric(index)) {
                if (iluminacionCont == 0) {
                    $("#tipo_iluminacion").val(record.tipo_iluminacion);
                    $("#tipo_iluminacion").attr('name',record.tipo_iluminacion);
                    $("#cantidad_iluminacion").val(record.cantidad);
                    $("#cantidad_iluminacion").attr('name',record.cantidad);
                    $("#cantidad_iluminacion option[value='']").hide();
                }else{
                    var componente = '<div id="iluminacion'+iluminacionCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_iluminacion'+iluminacionCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("iluminacion",componente);
                    actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
                    $("#tipo_iluminacion"+iluminacionCont).val(record.tipo_iluminacion);
                    $("#tipo_iluminacion"+iluminacionCont).attr('name',record.tipo_iluminacion);
                    $("#cantidad_iluminacion"+iluminacionCont).val(record.cantidad);
                    $("#cantidad_iluminacion"+iluminacionCont).attr('name',record.cantidad);
                    $("#cantidad_iluminacion"+iluminacionCont+" option[value='']").hide();
                }
                iluminacionCont++;
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarSendero y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarSendero").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("sendero",informacion);
        var archivos = consultarArchivosObjeto("sendero",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_sendero").attr('name',record.id);
                $("#id_sendero").val(record.id);
                $("#longitud").val(record.longitud);
                $("#ancho").val(record.ancho);
                $("#material_piso").val(record.material_piso);
                $("#tipo_iluminacion").val(record.tipo_iluminacion);
                $("#cantidad_iluminacion").val(record.cantidad);
                $("#codigo_poste").val(record.codigo_poste);
                $("#ancho_cubierta").val(record.ancho_cubierta);
                $("#largo_cubierta").val(record.largo_cubierta);
                $("#material_cubierta").val(record.material_cubierta);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_sendero.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarVia y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarVia").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#codigo_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("via",informacion);
        var archivos = consultarArchivosObjeto("via",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_via").attr('name',record.id);
                $("#id_via").val(record.id);
                $("#tipo_pintura").val(record.tipo_pintura);
                $("#longitud_demarcacion").val(record.longitud_demarcacion);
                $("#material_piso").val(record.material_piso);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_via.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarEdificio y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarEdificio").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var id = $("#edificio_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("edificio",informacion);
        var archivos = consultarArchivosObjeto("edificio",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_edificio").val(record.id);
                $("#nombre_edificio").val(record.nombre);
                $("#pisos_edificio").val(record.numero_pisos);
                $("input[name=terraza][value="+ record.terraza + "]").prop('checked', true);
                $("input[name=sotano][value="+ record.sotano + "]").prop('checked', true);
                $("#ancho_fachada").val(record.ancho_fachada);
                $("#alto_fachada").val(record.alto_fachada);
                $("#material_fachada").val(record.material_fachada);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_edificio.png',
                    title: record.id+" - "+record.nombre,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(19);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarEspacio y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarEspacio").click(function (e){
        var informacion =  {};
        var sede = $("#sede_search").val();
        var campus = $("#campus_search").val();
        var edificio = $("#edificio_search").val();
        var id = $("#espacio_search").val();
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['nombre_edificio'] = edificio;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("espacio",informacion);
        var dataIluminacion = consultarInformacionObjeto("iluminacion_espacio",informacion);
        var dataInterruptor = consultarInformacionObjeto("interruptor_espacio",informacion);
        var dataPuerta = consultarInformacionObjeto("puerta_espacio",informacion);
        var dataSuministro = consultarInformacionObjeto("suministro_energia_espacio",informacion);
        var dataVentana = consultarInformacionObjeto("ventana_espacio",informacion);
        var archivos = consultarArchivosObjeto("espacio",informacion);
        var edificioEspacioPadre = {};
        edificioEspacioPadre["nombre_sede"] = $("#sede_search").val();
        edificioEspacioPadre["nombre_campus"] = $("#campus_search").val();
        edificioEspacioPadre["nombre_edificio"] = $("#edificio_search").val();
        edificioEspacioPadre["piso"] = $("#pisos_search").val();
        var dataEspacioPadre = buscarObjetos("espacios",edificioEspacioPadre);
        $("#espacio_padre").empty();
        var row = $("<option value=''/>");
        row.text("--Seleccionar--");
        row.appendTo("#espacio_padre");
        $.each(dataEspacioPadre, function(index, record) {
            if($.isNumeric(index)) {
                aux = record.id;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#espacio_padre");
            }
        });
        $("#espacio_padre option[value='"+limpiarCadena(id)+"']").remove();
        console.log(data);
        console.log(archivos);
        console.log(dataIluminacion);
        console.log(dataInterruptor);
        console.log(dataPuerta);
        console.log(dataSuministro);
        console.log(dataVentana);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#nombre_edificio").attr('name',record.id_edificio);
                $("#nombre_edificio").val(record.id_edificio+" - "+record.nombre_edificio);
                $("#pisos").val(record.piso);
                $("#id_espacio").val(record.id);
                usoEspacioSelect = record.uso_espacio;
                $("#uso_espacio").val(usoEspacioSelect);
                $("#ancho_pared").val(record.ancho_pared);
                $("#altura_pared").val(record.alto_pared);
                $("#material_pared").val(record.material_pared);
                $("#material_pared option[value='']").hide();
                $("#ancho_piso").val(record.ancho_piso);
                $("#largo_piso").val(record.largo_piso);
                $("#material_piso").val(record.material_piso);
                $("#material_piso option[value='']").hide();
                $("#ancho_techo").val(record.ancho_techo);
                $("#largo_techo").val(record.largo_techo);
                $("#material_techo").val(record.material_techo);
                $("#material_techo option[value='']").hide();
                if (record.espacio_padre != null) {
                    $("input[name=tiene_espacio_padre][value=true]").prop('checked', true);
                    $("#div_espacio_padre").show();
                    $("#espacio_padre").val(record.espacio_padre);
                }else{
                    $("#div_espacio_padre").hide();
                    $("input[name=tiene_espacio_padre][value=false]").prop('checked', true);
                }

            }
        });
        $.each(dataIluminacion, function(index, record) {
            if($.isNumeric(index)) {
                if (iluminacionCont == 0) {
                    $("#tipo_iluminacion").val(record.tipo_iluminacion);
                    $("#tipo_iluminacion").attr('name',record.tipo_iluminacion);
                    $("#cantidad_iluminacion").val(record.cantidad);
                    $("#cantidad_iluminacion").attr('name',record.cantidad);
                    $("#tipo_iluminacion option[value='']").hide();
                }else{
                    var componente = '<div id="iluminacion'+iluminacionCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_iluminacion'+iluminacionCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("iluminacion",componente);
                    actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
                    $("#tipo_iluminacion"+iluminacionCont).val(record.tipo_iluminacion);
                    $("#tipo_iluminacion"+iluminacionCont).attr('name',record.tipo_iluminacion);
                    $("#cantidad_iluminacion"+iluminacionCont).val(record.cantidad);
                    $("#cantidad_iluminacion"+iluminacionCont).attr('name',record.cantidad);
                    $("#tipo_iluminacion"+iluminacionCont+" option[value='']").hide();
                }
                iluminacionCont++;
            }
        });
        $.each(dataInterruptor, function(index, record) {
            if($.isNumeric(index)) {
                if (interruptoresCont == 0) {
                    $("#tipo_interruptor").val(record.tipo_interruptor);
                    $("#tipo_interruptor").attr('name',record.tipo_interruptor);
                    $("#cantidad_interruptores").val(record.cantidad);
                    $("#cantidad_interruptores").attr('name',record.cantidad);
                    $("#tipo_interruptor option[value='']").hide();
                }else{
                    interruptoresCont++;
                    var componente = '<div id="interruptor'+interruptoresCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_interruptor'+interruptoresCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_interruptores'+interruptoresCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("interruptor",componente);
                    actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
                    $("#tipo_interruptor"+interruptoresCont).val(record.tipo_interruptor);
                    $("#tipo_interruptor"+interruptoresCont).attr('name',record.tipo_interruptor);
                    $("#cantidad_interruptores"+interruptoresCont).val(record.cantidad);
                    $("#cantidad_interruptores"+interruptoresCont).attr('name',record.cantidad);
                    $("#tipo_interruptor"+interruptoresCont+" option[value='']").hide();
                }
            }
        });
        $.each(dataPuerta, function(index, record) {
            if($.isNumeric(index)) {
                if (puertasCont == 0) {
                    $("#tipo_puerta").val(record.tipo_puerta);
                    $("#tipo_puerta").attr('name',record.tipo_puerta);
                    $("#cantidad_puertas").val(record.cantidad);
                    $("#cantidad_puertas").attr('name',record.cantidad);
                    $("#material_puerta").val(record.material_puerta);
                    $("#material_puerta").attr('name',record.material_puerta);
                    $("input[name=gato_puerta][value='"+record.gato+"']").prop('checked', true);
                    $("#material_marco_puerta").val(record.material_marco);
                    $("#material_marco_puerta").attr('name',record.material_marco);
                    $("#ancho_puerta").val(record.ancho);
                    $("#ancho_puerta").attr('name',record.ancho);
                    $("#alto_puerta").val(record.largo);
                    $("#alto_puerta").attr('name',record.largo);
                    $("#tipo_puerta option[value='']").hide();
                    $("#material_puerta option[value='']").hide();
                    $("#material_marco_puerta option[value='']").hide();
                }else{
                    var componente = '<div id="puerta'+puertasCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_puerta'+puertasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puertas'+puertasCont+'" value="" disabled required/><br>'
                    +'<div class="div_izquierda"><b>Material de la puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="material_puerta'+puertasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Tipo de cerradura ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_cerradura'+puertasCont+'" disabled required></select><br>'
                    //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="añadir_tipo_cerradura" id="añadir_tipo_cerradura'+puertasCont+'" value="Añadir Tipo" title="Añadir Tipo Cerradura"/>'
                    //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="eliminar_tipo_cerradura" id="eliminar_tipo_cerradura'+puertasCont+'" value="Eliminar Tipo" title="Eliminar Tipo Cerradura" disabled/>'
                    +'<div class="div_izquierda"><b>¿La puerta tiene gato? ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="true">S&iacute;</label>'
                    +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="false">No</label><br>'
                    +'<div class="div_izquierda"><b>Material del marco ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="material_marco_puerta'+puertasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Ancho puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="ancho_puerta'+puertasCont+'" value="" disabled required/><br>'
                    +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="alto_puerta'+puertasCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("puerta",componente);
                    actualizarSelectMaterial("material_marco_puerta",puertasCont);
                    actualizarSelectMaterial("material_puerta",puertasCont);
                    actualizarSelectTipoObjeto("tipo_puerta",puertasCont);
                    $("#tipo_puerta"+puertasCont).val(record.tipo_puerta);
                    $("#tipo_puerta"+puertasCont).attr('name',record.tipo_puerta);
                    $("#cantidad_puertas"+puertasCont).val(record.cantidad);
                    $("#cantidad_puertas"+puertasCont).attr('name',record.cantidad);
                    $("#material_puerta"+puertasCont).val(record.material_puerta);
                    $("#material_puerta"+puertasCont).attr('name',record.material_puerta);
                    $("input[name=gato_puerta"+puertasCont+"][value="+record.gato+"]").prop('checked', true);
                    $("#material_marco_puerta"+puertasCont).val(record.material_marco);
                    $("#material_marco_puerta"+puertasCont).attr('name',record.material_marco);
                    $("#ancho_puerta"+puertasCont).val(record.ancho);
                    $("#ancho_puerta"+puertasCont).attr('name',record.ancho);
                    $("#alto_puerta"+puertasCont).val(record.largo);
                    $("#alto_puerta"+puertasCont).attr('name',record.largo);
                    $("#tipo_puerta"+puertasCont+" option[value='']").hide();
                    $("#material_puerta"+puertasCont+" option[value='']").hide();
                    $("#material_marco_puerta"+puertasCont+" option[value='']").hide();
                }
                var tipoPuerta = record.tipo_puerta;
                var materialPuerta = record.material_puerta;
                var materialMarco = record.material_marco;
                var infoPuerta = {};
                infoPuerta['nombre_sede'] = sede;
                infoPuerta['nombre_campus'] = campus;
                infoPuerta['nombre_edificio'] = edificio;
                infoPuerta['id'] = limpiarCadena(id);
                infoPuerta['tipo_puerta'] = tipoPuerta;
                infoPuerta['material_puerta'] = materialPuerta;
                infoPuerta['material_marco'] = materialMarco;
                var dataTipoCerradura = consultarInformacionObjeto("puerta_tipo_cerradura",infoPuerta);
                console.log(dataTipoCerradura);
                $.each(dataTipoCerradura, function(indice, valor) {
                    if($.isNumeric(indice)) {
                        if (cerraduraCont == 0) {
                            if (puertasCont == 0) {
                                $("#tipo_cerradura").val(valor.tipo_cerradura);
                                $("#tipo_cerradura").attr('name',valor.tipo_cerradura);
                                $("#tipo_cerradura option[value='']").hide();
                            }else {
                                $("#tipo_cerradura"+puertasCont).val(valor.tipo_cerradura);
                                $("#tipo_cerradura"+puertasCont).attr('name',valor.tipo_cerradura);
                                $("#tipo_cerradura"+puertasCont+" option[value='']").hide();
                            }
                        }else{
                            var componente = '<div id="cerradura'+cerraduraCont+'">'
                            +'<div class="div_izquierda"><b>Tipo de cerradura ('+(cerraduraCont+1)+') de la puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<select class="form-control formulario" name="" id="tipo_cerradura'+puertasCont+cerraduraCont+'" disabled required></select>'
                            +'</div>';
                            añadirComponente("cerradura",componente);
                            actualizarSelectTipoObjeto("tipo_cerradura",cerraduraCont);
                            $("#tipo_cerradura"+cerraduraCont).val(valor.tipo_cerradura);
                            $("#tipo_cerradura"+cerraduraCont).attr('name',valor.tipo_cerradura);
                            $("#tipo_cerradura"+cerraduraCont+" option[value='']").hide();
                        }
                        cerraduraCont++;
                    }
                });
                puertasCont++;
            }
        });
        $.each(dataSuministro, function(index, record) {
            if($.isNumeric(index)) {
                if (tomacorrientesCont == 0) {
                    $("#tipo_suministro_energia").val(record.tipo_suministro_energia);
                    $("#tipo_suministro_energia").attr('name',record.tipo_suministro_energia);
                    $("#tomacorriente").val(record.tomacorriente);
                    $("#tomacorriente").attr('name',record.tomacorriente);
                    $("#cantidad_tomacorrientes").val(record.cantidad);
                    $("#cantidad_tomacorrientes").attr('name',record.cantidad);
                    $("#tipo_suministro_energia option[value='']").hide();
                    $("#tomacorriente option[value='']").hide();
                }else{
                    var componente = '<div id="suministro_energia'+tomacorrientesCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de suministro de energía ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_suministro_energia'+tomacorrientesCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Tomacorriente ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tomacorriente'+tomacorrientesCont+'" disabled required>'
                    +'<option value="seleccionar" selected="selected">--Seleccionar--</option>'
                    +'<option value="regulado">Regulado</option>'
                    +'<option value="no regulado">No Regulado</option>'
                    +'</select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de tomacorrientes del tipo ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("suministro_energia",componente);
                    actualizarSelectTipoObjeto("tipo_suministro_energia",tomacorrientesCont);
                    $("#tipo_suministro_energia"+tomacorrientesCont).val(record.tipo_suministro_energia);
                    $("#tipo_suministro_energia"+tomacorrientesCont).attr('name',record.tipo_suministro_energia);
                    $("#tomacorriente"+tomacorrientesCont).val(record.tomacorriente);
                    $("#tomacorriente"+tomacorrientesCont).attr('name',record.tomacorriente);
                    $("#cantidad_tomacorrientes"+tomacorrientesCont).val(record.cantidad);
                    $("#cantidad_tomacorrientes"+tomacorrientesCont).attr('name',record.cantidad);
                    $("#tipo_suministro_energia"+tomacorrientesCont+" option[value='']").hide();
                    $("#tomacorriente"+tomacorrientesCont+" option[value='']").hide();
                }
                tomacorrientesCont++;
            }
        });
        $.each(dataVentana, function(index, record) {
            if($.isNumeric(index)) {
                if (ventanasCont == 0) {
                    $("#tipo_ventana").val(record.tipo_ventana);
                    $("#tipo_ventana").attr('name',record.tipo_ventana);
                    $("#cantidad_ventanas").val(record.cantidad);
                    $("#cantidad_ventanas").attr('name',record.cantidad);
                    $("#material_ventana").val(record.material_ventana);
                    $("#material_ventana").attr('name',record.material_ventana);
                    $("#ancho_ventana").val(record.ancho);
                    $("#ancho_ventana").attr('name',record.ancho);
                    $("#alto_ventana").val(record.alto);
                    $("#alto_ventana").attr('name',record.alto);
                    $("#tipo_ventana option[value='']").hide();
                    $("#material_ventana option[value='']").hide();
                }else{
                    var componente = '<div id="ventana'+ventanasCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="tipo_ventana'+ventanasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_ventanas'+ventanasCont+'" value="" disabled required/><br>'
                    +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="" id="material_ventana'+ventanasCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="ancho_ventana'+ventanasCont+'" value="" disabled required/><br>'
                    +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="alto_ventana'+ventanasCont+'" value="" disabled required/>'
                    +'</div>';
                    añadirComponente("ventana",componente);
                    actualizarSelectMaterial("material_ventana",ventanasCont);
                    actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
                    $("#tipo_ventana"+ventanasCont).val(record.tipo_ventana);
                    $("#tipo_ventana"+ventanasCont).attr('name',record.tipo_ventana);
                    $("#cantidad_ventanas"+ventanasCont).val(record.cantidad);
                    $("#cantidad_ventanas"+ventanasCont).attr('name',record.cantidad);
                    $("#material_ventana"+ventanasCont).val(record.material_ventana);
                    $("#material_ventana"+ventanasCont).attr('name',record.material_ventana);
                    $("#ancho_ventana"+ventanasCont).val(record.ancho);
                    $("#ancho_ventana"+ventanasCont).attr('name',record.ancho);
                    $("#alto_ventana"+ventanasCont).val(record.alto);
                    $("#alto_ventana"+ventanasCont).attr('name',record.alto);
                    $("#tipo_ventana"+ventanasCont+" option[value='']").hide();
                    $("#material_ventana"+ventanasCont+" option[value='']").hide();
                }
                ventanasCont++;
            }
        });
        var nombreUsoEspacio;
        if (usoEspacioSelect == '1') { //Salón
            nombreUsoEspacio ='salon';
        }else if(usoEspacioSelect == '2'){ //Auditorio
            nombreUsoEspacio ='auditorio';
        }else if(usoEspacioSelect == '3'){ //Laboratorio
            nombreUsoEspacio ='laboratorio';
        }else if(usoEspacioSelect == '4'){ //Sala de Cómputo
            nombreUsoEspacio ='sala_computo';
        }else if(usoEspacioSelect == '5'){ //Oficina
            nombreUsoEspacio ='oficina';
        }else if(usoEspacioSelect == '6'){ //Baño
            nombreUsoEspacio ='bano';
        }else if(usoEspacioSelect == '7'){ //Cuarto Técnico
            nombreUsoEspacio ='cuarto_tecnico';
        }else if(usoEspacioSelect == '8'){ //Bodega/Almacen
            nombreUsoEspacio ='bodega';
        }else if(usoEspacioSelect == '10'){ //Cuarto de Plantas
            nombreUsoEspacio ='cuarto_plantas';
        }else if(usoEspacioSelect == '11'){ //Cuarto de Aires Acondicionados
            nombreUsoEspacio ='cuarto_aire_acondicionado';
        }else if(usoEspacioSelect == '12'){ //Área Deportiva Cerrada
            nombreUsoEspacio ='area_deportiva_cerrada';
        }else if(usoEspacioSelect == '14'){ //Centro de Datos/Teléfono
            nombreUsoEspacio ='centro_datos';
        }else if(usoEspacioSelect == '17'){ //Cuarto de Bombas
            nombreUsoEspacio ='cuarto_bombas';
        }else if(usoEspacioSelect == '19'){ //Cocineta
            nombreUsoEspacio ='cocineta';
        }else if(usoEspacioSelect == '20'){ //Sala de Estudio
            nombreUsoEspacio ='sala_estudio';
        }else {
            nombreUsoEspacio = "";
        }
        if (usoEspacioSelect != "") {
            informacion['uso_espacio'] = nombreUsoEspacio;
            if (usoEspacioSelect == '1') { //Salón
                data = consultarInformacionObjeto("salon",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Salón</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del salón<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>Capacidad del salón<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>¿El salón tiene punto de videobeam?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false" disabled>No</label><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                        $("#capacidad").val(record.capacidad);
                        $("input[name=punto_videobeam][value="+record.punto_videobeam+"]").prop('checked', true);
                    }
                });
            }else if(usoEspacioSelect == '2'){ //Auditorio
                data = consultarInformacionObjeto("auditorio",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Auditorio</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del auditorio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>Capacidad del auditorio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>¿El auditorio tiene punto de videobeam?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false" disabled>No</label>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                        $("#capacidad").val(record.capacidad);
                        $("input[name=punto_videobeam][value="+record.punto_videobeam+"]").prop('checked', true);
                    }
                });
            }else if(usoEspacioSelect == '3'){ //Laboratorio
                data = consultarInformacionObjeto("laboratorio",informacion);
                dataSanitario = consultarInformacionObjeto("punto_sanitario",informacion);
                console.log(data);
                console.log(dataSanitario);
                var componente = '<div id="tituloInfo"><b><h5>Información del Laboratorio</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del laboratorio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>Capacidad del laboratorio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>¿El laboratorio tiene punto de videobeam?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false" disabled>No</label>'
                +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos del laboratorio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" disabled required/><br>'
                +'<div id="punto_sanitario">'
                +'<div class="div_izquierda"><b>Tipo de punto sanitario del laboratorio<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="" id="tipo_punto_sanitario" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del laboratorio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios" value="" disabled required/><br>'
                +'</div>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                        $("#capacidad").val(record.capacidad);
                        $("input[name=punto_videobeam][value="+record.punto_videobeam+"]").prop('checked', true);
                        $("#cantidad_puntos_hidraulicos").val(record.cantidad_puntos_hidraulicos);
                    }
                });
                $.each(dataSanitario, function(index, record) {
                    if($.isNumeric(index)) {
                        if (puntosSanitariosCont == 0) {
                            $("#tipo_punto_sanitario").val(record.tipo_punto_sanitario);
                            $("#tipo_punto_sanitario").attr('name',record.tipo_punto_sanitario);
                            $("#cantidad_puntos_sanitarios").val(record.cantidad_puntos_sanitarios);
                            $("#cantidad_puntos_sanitarios").attr('name',record.cantidad_puntos_sanitarios);
                            $("#tipo_punto_sanitario option[value='']").hide();
                        }else{
                            var componente = '<div id="punto_sanitario'+puntosSanitariosCont+'">'
                            +'<br><div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<select class="form-control formulario" name="" id="tipo_punto_sanitario'+puntosSanitariosCont+'" disabled required></select><br>'
                            +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" disabled required/><br>'
                            +'</div>';
                            añadirComponente("punto_sanitario",componente);
                            actualizarSelectTipoObjeto("tipo_punto_sanitario",puntosSanitariosCont);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont).val(record.tipo_punto_sanitario);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont).attr('name',record.tipo_punto_sanitario);
                            $("#cantidad_puntos_sanitarios"+puntosSanitariosCont).val(record.cantidad_puntos_sanitarios);
                            $("#cantidad_puntos_sanitarios"+puntosSanitariosCont).attr('name',record.cantidad_puntos_sanitarios);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont+" option[value='']").hide();
                        }
                        puntosSanitariosCont++;
                    }
                });
            }else if(usoEspacioSelect == '4'){ //Sala de Cómputo
                data = consultarInformacionObjeto("sala_computo",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información de la Sala de Cómputo</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la sala de cómputo<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>Capacidad de la sala de cómputo<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="capacidad" id="capacidad" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>¿La sala de cómputo tiene punto de videobeam?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false" disabled>No</label><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                        $("#capacidad").val(record.capacidad);
                        $("input[name=punto_videobeam][value="+record.punto_videobeam+"]").prop('checked', true);
                    }
                });
            }else if(usoEspacioSelect == '5'){ //Oficina
                data = consultarInformacionObjeto("oficina",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información de la Oficina</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la oficina<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>¿La oficina tiene punto de videobeam?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false" disabled>No</label><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                        $("input[name=punto_videobeam][value="+record.punto_videobeam+"]").prop('checked', true);
                    }
                });
            }else if(usoEspacioSelect == '6'){ //Baño
                data = consultarInformacionObjeto("bano",informacion);
                dataLavamanos = consultarInformacionObjeto("lavamanos",informacion);
                dataOrinal = consultarInformacionObjeto("orinal",informacion);
                console.log(data);
                console.log(dataLavamanos);
                console.log(dataOrinal);
                var componente = '<div id="tituloInfo"><b><h5>Información del Baño</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Tipo de inodoro<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="tipo_inodoro" id="tipo_inodoro" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Cantidad de inodoros<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_inodoros" id="cantidad_inodoros" value="" disabled required/><br>'
                +'<div id="lavamanos">'
                +'<div class="div_izquierda"><b>Tipo de lavamanos<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="" id="tipo_lavamanos" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Cantidad de lavamanos<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_lavamanos" value="" disabled required/>'
                +'</div>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                componente = '<div id="informacion2">'
                +'<div class="div_izquierda"><b>Tipo de divisiones<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="tipo_divisiones" id="tipo_divisiones" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Material de las divisiones<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="material_divisiones" id="material_divisiones" disabled required></select><br>'
                +'<div class="div_izquierda"><b>¿El baño tiene ducha?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="ducha" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="ducha" value="false" disabled>No</label>'
                +'<div class="div_izquierda"><b>¿El baño tiene lavatraperos?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="lavatraperos" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="lavatraperos" value="false" disabled>No</label>'
                +'<div class="div_izquierda"><b>Cantidad de sifones<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_sifones" id="cantidad_sifones" value="" disabled required/><br>'
                +'<div id="orinal">'
                +'<div class="div_izquierda"><b>Tipo de orinal<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="" id="tipo_orinal" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Cantidad de orinales<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_orinales" value="" disabled required/>'
                +'</div>'
                +'</div>';
                añadirComponente("informacionUsoEspacio2",componente);
                actualizarSelectTipoObjeto("tipo_inodoro",0);
                actualizarSelectTipoObjeto("tipo_orinal",0);
                actualizarSelectTipoObjeto("tipo_lavamanos",0);
                actualizarSelectTipoObjeto("tipo_divisiones",0);
                actualizarSelectMaterial("material_divisiones",0);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#tipo_inodoro").val(record.tipo_inodoro);
                        $("#cantidad_inodoros").val(record.cantidad_inodoro);
                        $("#tipo_divisiones").val(record.tipo_divisiones);
                        $("#material_divisiones").val(record.material_divisiones);
                        $("input[name=ducha][value="+record.ducha+"]").prop('checked', true);
                        $("input[name=lavatraperos][value="+record.lavatraperos+"]").prop('checked', true);
                        $("#cantidad_sifones").val(record.cantidad_sifones);
                    }
                });
                $.each(dataLavamanos, function(index, record) {
                    if($.isNumeric(index)) {
                        if(lavamanosCont == 0){
                            $("#tipo_lavamanos").val(record.tipo_lavamanos);
                            $("#tipo_lavamanos").attr('name',record.tipo_lavamanos);
                            $("#cantidad_lavamanos").val(record.cantidad_lavamanos);
                            $("#cantidad_lavamanos").attr('name',record.cantidad_lavamanos);
                            $("#tipo_lavamanos option[value='']").hide();
                        }else{
                            var componente = '<div id="lavamanos'+lavamanosCont+'">'
                            +'<br><div class="div_izquierda"><b>Tipo de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<select class="form-control formulario" name="" id="tipo_lavamanos'+lavamanosCont+'" disabled required></select><br>'
                            +'<div class="div_izquierda"><b>Cantidad de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_lavamanos'+lavamanosCont+'" value="" disabled required/><br>'
                            +'</div>'
                            +'</div>';
                            añadirComponente("lavamanos",componente);
                            actualizarSelectTipoObjeto("tipo_lavamanos",lavamanosCont);
                            $("#tipo_lavamanos"+lavamanosCont).val(record.tipo_lavamanos);
                            $("#tipo_lavamanos"+lavamanosCont).attr('name',record.tipo_lavamanos);
                            $("#cantidad_lavamanos"+lavamanosCont).val(record.cantidad_lavamanos);
                            $("#cantidad_lavamanos"+lavamanosCont).attr('name',record.cantidad_lavamanos);
                            $("#tipo_lavamanos"+lavamanosCont+" option[value='']").hide();
                        }
                        lavamanosCont++;
                    }
                });
                $.each(dataOrinal, function(index, record) {
                    if($.isNumeric(index)) {
                        if (orinalesCont == 0) {
                            $("#tipo_orinal").val(record.tipo_orinal);
                            $("#tipo_orinal").attr('name',record.tipo_orinal);
                            $("#cantidad_orinales").val(record.cantidad_orinales);
                            $("#cantidad_orinales").attr('name',record.cantidad_orinales);
                            $("#tipo_orinal option[value='']").hide();
                        }else{
                            var componente = '<div id="orinal'+orinalesCont+'">'
                            +'<br><div class="div_izquierda"><b>Tipo de orinal ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<select class="form-control formulario" name="tipo_orinal" id="tipo_orinal'+orinalesCont+'" disabled required></select><br>'
                            +'<div class="div_izquierda"><b>Cantidad de orinales del tipo ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_orinales" id="cantidad_orinales'+orinalesCont+'" value="" disabled required/><br>'
                            +'</div>';
                            añadirComponente("orinal",componente);
                            actualizarSelectTipoObjeto("tipo_orinal",orinalesCont);
                            $("#tipo_orinal"+orinalesCont).val(record.tipo_orinal);
                            $("#tipo_orinal"+orinalesCont).attr('name',record.tipo_orinal);
                            $("#cantidad_orinales"+orinalesCont).val(record.cantidad_orinales);
                            $("#cantidad_orinales"+orinalesCont).attr('name',record.cantidad_orinales);
                            $("#tipo_orinal"+orinalesCont+" option[value='']").hide();
                        }
                        orinalesCont++;
                    }
                });
            }else if(usoEspacioSelect == '7'){ //Cuarto Técnico
                data = consultarInformacionObjeto("cuarto_tecnico",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Cuarto Técnico</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del cuarto técnico<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'<div class="div_izquierda"><b>¿El cuarto técnico tiene punto de videobeam?<font color="red">*</font>:</b></div>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="true" disabled>S&iacute;</label>'
                +'<label class="radio-inline"><input type="radio" name="punto_videobeam" value="false" disabled>No</label>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                        $("input[name=punto_videobeam][value="+record.punto_videobeam+"]").prop('checked', true);
                    }
                });
            }else if(usoEspacioSelect == '8'){ //Bodega/Almacen
                data = consultarInformacionObjeto("bodega",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información de la Bodega/Almacén</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                var componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la bodega o almacén<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                    }
                });
            }else if(usoEspacioSelect == '10'){ //Cuarto de Plantas
                data = consultarInformacionObjeto("cuarto_plantas",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Cuarto de Plantas</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del cuarto de Plantas<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                    }
                });
            }else if(usoEspacioSelect == '11'){ //Cuarto de Aires Acondicionados
                data = consultarInformacionObjeto("cuarto_aire_acondicionado",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Cuarto de Aires Acondicionados</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del cuarto de Aires Acondicionados<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                    }
                });
            }else if(usoEspacioSelect == '12'){ //Área Deportiva Cerrada
                data = consultarInformacionObjeto("area_deportiva_cerrada",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Área Deportiva Cerrada</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del(as) área deportiva cerrada<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                    }
                });
            }else if(usoEspacioSelect == '14'){ //Centro de Datos/Teléfono
                data = consultarInformacionObjeto("centro_datos",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información del Centro de Datos</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red del centro de datos/teléfono<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                    }
                });
            }else if(usoEspacioSelect == '17'){ //Cuarto de Bombas
                data = consultarInformacionObjeto("cuarto_bombas",informacion);
                dataPuntoSanitario = consultarInformacionObjeto("punto_sanitario",informacion);
                console.log(data);
                console.log(dataPuntoSanitario);
                var componente = '<div id="tituloInfo"><b><h5>Información del Cuarto de Bombas</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos del cuarto de bombas<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" disabled required/><br>'
                +'<div id="punto_sanitario">'
                +'<div class="div_izquierda"><b>Tipo de punto sanitario del cuarto de bombas<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="" id="tipo_punto_sanitario" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del cuarto de bombas<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios" value="" disabled required/><br>'
                +'</div>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                actualizarSelectTipoObjeto("tipo_punto_sanitario",0);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_hidraulicos").val(record.cantidad_puntos_hidraulicos);
                    }
                });
                $.each(dataPuntoSanitario, function(index, record) {
                    if($.isNumeric(index)) {
                        if (puntosSanitariosCont == 0) {
                            $("#tipo_punto_sanitario").val(record.tipo_punto_sanitario);
                            $("#tipo_punto_sanitario").attr('name',record.tipo_punto_sanitario);
                            $("#cantidad_puntos_sanitarios").val(record.cantidad_puntos_sanitarios);
                            $("#cantidad_puntos_sanitarios").attr('name',record.cantidad_puntos_sanitarios);
                            $("#tipo_punto_sanitario option[value='']").hide();
                        }else{
                            var componente = '<div id="punto_sanitario'+puntosSanitariosCont+'">'
                            +'<br><div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<select class="form-control formulario" name="" id="tipo_punto_sanitario'+puntosSanitariosCont+'" disabled required></select><br>'
                            +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" disabled required/><br>'
                            +'</div>';
                            añadirComponente("punto_sanitario",componente);
                            actualizarSelectTipoObjeto("tipo_punto_sanitario",puntosSanitariosCont);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont).val(record.tipo_punto_sanitario);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont).attr('name',record.tipo_punto_sanitario);
                            $("#cantidad_puntos_sanitarios"+puntosSanitariosCont).val(record.cantidad_puntos_sanitarios);
                            $("#cantidad_puntos_sanitarios"+puntosSanitariosCont).attr('name',record.cantidad_puntos_sanitarios);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont+" option[value='']").hide();
                        }
                        puntosSanitariosCont++;
                    }
                });
            }else if(usoEspacioSelect == '19'){ //Cocineta
                data = consultarInformacionObjeto("cocineta",informacion);
                dataPuntoSanitario = consultarInformacionObjeto("punto_sanitario",informacion);
                console.log(data);
                console.log(dataPuntoSanitario);
                var componente = '<div id="tituloInfo"><b><h5>Información de la Cocineta</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos de la cocineta<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" disabled required/><br>'
                +'<div id="punto_sanitario">'
                +'<div class="div_izquierda"><b>Tipo de punto sanitario de la cocineta<font color="red">*</font>:</b></div>'
                +'<select class="form-control formulario" name="" id="tipo_punto_sanitario" disabled required></select><br>'
                +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios de la cocineta<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios" value="" disabled required/><br>'
                +'</div>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                actualizarSelectTipoObjeto("tipo_punto_sanitario",0);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_hidraulicos").val(record.cantidad_puntos_hidraulicos);
                    }
                });
                $.each(dataPuntoSanitario, function(index, record) {
                    if($.isNumeric(index)) {
                        if (puntosSanitariosCont == 0) {
                            $("#tipo_punto_sanitario").val(record.tipo_punto_sanitario);
                            $("#tipo_punto_sanitario").attr('name',record.tipo_punto_sanitario);
                            $("#cantidad_puntos_sanitarios").val(record.cantidad_puntos_sanitarios);
                            $("#cantidad_puntos_sanitarios").attr('name',record.cantidad_puntos_sanitarios);
                            $("#tipo_punto_sanitario option[value='']").hide();
                        }else{
                            var componente = '<div id="punto_sanitario'+puntosSanitariosCont+'">'
                            +'<br><div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<select class="form-control formulario" name="" id="tipo_punto_sanitario'+puntosSanitariosCont+'" disabled required></select><br>'
                            +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
                            +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" disabled required/><br>'
                            +'</div>';
                            añadirComponente("punto_sanitario",componente);
                            actualizarSelectTipoObjeto("tipo_punto_sanitario",puntosSanitariosCont);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont).val(record.tipo_punto_sanitario);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont).attr('name',record.tipo_punto_sanitario);
                            $("#cantidad_puntos_sanitarios"+puntosSanitariosCont).val(record.cantidad_puntos_sanitarios);
                            $("#cantidad_puntos_sanitarios"+puntosSanitariosCont).attr('name',record.cantidad_puntos_sanitarios);
                            $("#tipo_punto_sanitario"+puntosSanitariosCont+" option[value='']").hide();
                        }
                        puntosSanitariosCont++;
                    }
                });
            }else if(usoEspacioSelect == '20'){ //Sala de Estudio
                data = consultarInformacionObjeto("sala_estudio",informacion);
                console.log(data);
                var componente = '<div id="tituloInfo"><b><h5>Información de la Sala de Estudio</h5></b></div>';
                añadirComponente("tituloUsoEspacio",componente);
                componente = '<div id="informacion">'
                +'<div class="div_izquierda"><b>Cantidad de puntos de red de la sala de estudio<font color="red">*</font>:</b></div>'
                +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" disabled required/><br>'
                +'</div>';
                añadirComponente("informacionUsoEspacio",componente);
                $.each(data, function(index, record) {
                    if($.isNumeric(index)) {
                        $("#cantidad_puntos_red").val(record.cantidad_puntos_red);
                    }
                });
            }
        }
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
            eliminarComponente("foto");
            eliminarComponente("inputFileFotos");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/espacio/'+sede+'-'+campus+'-'+edificio+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/espacio/'+sede+'-'+campus+'-'+edificio+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    componente = '<div id="foto">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/espacio/'+sede+'-'+campus+'-'+edificio+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                    +'</div>'
                    +'<br></div>';
                    añadirComponente("enlace_fotos",componente);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano">'
                    +'<div class="col-sm-8 div_izquierda">'
                    +'<a target="_blank" name="'+record.nombre+'" id="plano'+numeroPlanos+'" href="archivos/planos/espacio/'+sede+'-'+campus+'-'+edificio+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span></a>'
                    +'</div><div class="col-sm-4" id="divBotonEliminarPlano" name="divBotonEliminarPlano'+numeroPlanos+'" style="display:none">'
                    +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="plano'+numeroPlanos+'" id="eliminar_archivo" value="X" title="Eliminar el plano seleccionado"/>'
                    +'</div>'
                    +'<br></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
        +'<span>Agregar una foto</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
        +'<br></div>';
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("enlace_fotos",componenteFotos);
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarTipoMaterial y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarTipoMaterial").click(function (e){
        var informacion =  {};
        var tipoMaterial = $("#tipo_material_search").val();
        var nombreTipoMaterial = $("#nombre_tipo_material_search").val();
        $("#tipo_material").val(tipoMaterial);
        $("#nombre_tipo_material").val(nombreTipoMaterial);
        $("#nombre_tipo_material").attr('name',nombreTipoMaterial);
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarTipoObjeto y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarTipoObjeto").click(function (e){
        var informacion =  {};
        var tipoObjeto = $("#tipo_objeto_search").val();
        var nombreTipoObjeto = $("#nombre_tipo_objeto_search").val();
        $("#tipo_objeto").val(tipoObjeto);
        $("#nombre_tipo_objeto").val(nombreTipoObjeto);
        $("#nombre_tipo_objeto").attr('name',nombreTipoObjeto);
        $("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarAire y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarAire").click(function (e){
        var informacion =  {};
        var registros = 0;
        var numeroInventario = $("#numero_inventario_search").val();
        var idAire = $("#id_aire_search").val();
        if (validarCadena(numeroInventario) || validarCadena(idAire)) {
            if(URLactual['href'].indexOf('consultar_aire_ubicacion') >= 0){
                informacion['id_aire'] = idAire;
                var data = consultarInformacionObjeto("aire_id",informacion);
            }else{
                informacion['numero_inventario'] = numeroInventario;
                var data = consultarInformacionObjeto("aire_numero_inventario",informacion);
            }
            console.log(data);
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    $("#nombre_sede").val(record.nombre_sede);
                    $("#nombre_campus").val(record.nombre_campus);
                    $("#nombre_edificio").val(record.id_edificio+"-"+record.nombre_edificio);
                    var piso = record.piso;
                    if (piso == '0') {
                        piso = 'Sótano';
                    }else if(piso == '-1'){
                        piso = 'Terraza';
                    }
                    $("#pisos").val(piso);
                    $("#id_aire").val(record.id_aire);
                    idAire = record.id_aire;
                    $("#id_espacio").val(record.id_espacio);
                    $("#numero_inventario").val(record.numero_inventario);
                    $("#numero_inventario").attr('name',record.numero_inventario);
                    $("#capacidad_aire").val(record.capacidad);
                    $("#capacidad_aire").attr('name',record.capacidad);
                    $("#marca_aire").val(record.marca);
                    $("#marca_aire").attr('name',record.marca);
                    $("#tipo_aire").val(record.tipo);
                    $("#tipo_aire").attr('name',record.tipo);
                    $("#tipo_tecnologia_aire").val(record.tecnologia);
                    $("#tipo_tecnologia_aire").attr('name',record.tecnologia);
                    $("#fecha_instalacion").val(record.fecha_instalacion);
                    $("#fecha_instalacion").attr('name',record.fecha_instalacion);
                    $("#instalador").val(record.instalador);
                    $("#instalador").attr('name',record.instalador);
                    $("#tipo_periodicidad_mantenimiento").val(record.periodicidad_mantenimiento);
                    $("#tipo_periodicidad_mantenimiento").attr('name',record.periodicidad_mantenimiento);
                    $("#ubicacion_condensadora").val(record.ubicacion_condensadora);
                    $("#ubicacion_condensadora").attr('name',record.ubicacion_condensadora);
                    registros++;
                }
            });
            informacion['id_aire'] = idAire;
            var archivos = consultarArchivosObjeto("aire_id",informacion);
            $("#myCarousel").hide();
            for (var i = 0; i < numeroFotos; i++) {
                eliminarComponente("slide_carrusel");
                eliminarComponente("item_carrusel");
                eliminarComponente("foto");
                eliminarComponente("inputFileFotos");
            }
            for (var i = 0; i < numeroPlanos; i++) {
                eliminarComponente("plano");
            }
            numeroFotos = 0;
            numeroPlanos = 0;
            $.each(archivos, function(index, record) {
                if($.isNumeric(index)) {
                    if (record.tipo == 'foto') {
                        var componente, componente2;
                        if (numeroFotos == 0) {
                            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                            +'<img class="carouselImg" src="archivos/images/aire_acondicionado/'+idAire+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                            +'</div>';
                        }else{
                            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                            componente2 = '<div id="item_carrusel" class="item carouselImg">'
                            +'<img class="carouselImg" src="archivos/images/aire_acondicionado/'+idAire+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                            +'</div>';
                        }
                        añadirComponente("indicadores_carrusel",componente);
                        añadirComponente("fotos_carrusel",componente2);
                        componente = '<div id="foto">'
                        +'<div class="col-sm-8 div_izquierda">'
                        +'<a target="_blank" name="'+record.nombre+'" id="foto'+numeroFotos+'" href="archivos/images/aire_acondicionado/'+idAire+'/'+record.nombre+'">'
                        +'<span>'+record.nombre+'</span></a>'
                        +'</div><div class="col-sm-4">'
                        +'<input type="submit" class="btn btn-primary btn-lg btn-formulario btn-eliminar-archivos" name="foto'+numeroFotos+'" id="eliminar_archivo" value="X" title="Eliminar la foto seleccionada"/>'
                        +'</div>'
                        +'<br></div>';
                        añadirComponente("enlace_fotos",componente);
                        numeroFotos++;
                        $("#myCarousel").show();
                    }
                }
            });
            var componente, componente2;
            if (numeroFotos == 0) {
                componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
                componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                +'<div class="fileUpload btn boton_agregar_foto">'
                +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
                +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
                +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
                +'</div>'
                +'</div>';
            }else{
                componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
                componente2 = '<div id="item_carrusel" class="item carouselImg">'
                +'<div class="fileUpload btn boton_agregar_foto">'
                +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
                +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
                +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
                +'</div>'
                +'</div>';
            }
            var componenteFotos = '<div id="inputFileFotos" style="display:none" class="div_izquierda">'
            +'<span>Agregar una foto</span><br>'
            +'<input class="form-control formulario agregar_archivos" type="file" id="fotos[]" name="fotos[]" multiple accept="image/*">'
            +'<br></div>';
            añadirComponente("enlace_fotos",componenteFotos);
            numeroFotos++;
            añadirComponente("indicadores_carrusel",componente);
            añadirComponente("fotos_carrusel",componente2);
            $("#myCarousel").show();
            if (registros > 0) {
                $("#divDialogConsulta").modal('show');
            }else {
                alert(data.mensaje);
            }
        }else{
            alert("ERROR. Ingrese el número de inventario");
            $("#numero_inventario").focus();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarCapacidadAires y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarCapacidadAires").click(function (e){
        var informacion =  {};
        var capacidad = $("#capacidad_aire_search").val();
        if (validarCadena(capacidad)) {
            informacion['capacidad'] = capacidad;
            var data = consultarInformacionObjeto("capacidad_aires",informacion);
            console.log(data);
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    $("#capacidad_aire_nueva").attr('name',record.capacidad);
                    $("#capacidad_aire_nueva").val(record.capacidad);
                }
            });
            $("#divDialogConsulta").modal('show');
        }else{
            alert("ERROR. Seleccione la capacidad de aires acondicionados");
            $("#capacidad_aire_search").focus();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarMarcaAires y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarMarcaAires").click(function (e){
        var informacion =  {};
        var marca = $("#marca_aire_search").val();
        if (validarCadena(marca)) {
            informacion['marca'] = marca;
            var data = consultarInformacionObjeto("marca_aires",informacion);
            console.log(data);
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    $("#marca_aire_nueva").attr('name',record.nombre);
                    $("#marca_aire_nueva").val(record.nombre);
                }
            });
            $("#divDialogConsulta").modal('show');
        }else{
            alert("ERROR. Seleccione la marca de aires acondicionados");
            $("#marca_aire_search").focus();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarTipoAires y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarTipoAires").click(function (e){
        var informacion =  {};
        var tipoAire = $("#tipo_aire_search").val();
        if (validarCadena(tipoAire)) {
            informacion['tipo'] = tipoAire;
            var data = consultarInformacionObjeto("tipo_aires",informacion);
            console.log(data);
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    $("#tipo_aire_nuevo").attr('name',record.tipo);
                    $("#tipo_aire_nuevo").val(record.tipo);
                }
            });
            $("#divDialogConsulta").modal('show');
        }else{
            alert("ERROR. Seleccione el tipo de aires acondicionados");
            $("#tipo_aire_search").focus();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarTecnologiaAires y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarTecnologiaAires").click(function (e){
        var informacion =  {};
        var tecnologiaAire = $("#tecnologia_aire_search").val();
        if (validarCadena(tecnologiaAire)) {
            informacion['tipo'] = tecnologiaAire;
            var data = consultarInformacionObjeto("tecnologia_aires",informacion);
            console.log(data);
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    $("#tecnologia_aire_nuevo").attr('name',record.tipo);
                    $("#tecnologia_aire_nuevo").val(record.tipo);
                }
            });
            $("#divDialogConsulta").modal('show');
        }else{
            alert("ERROR. Seleccione la tecnología de aires acondicionados");
            $("#tecnologia_aire_search").focus();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarMantenimientoAire y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarMantenimientoAire").click(function (e){
        var informacion =  {};
        var numeroOrden = $("#numero_orden_search").val();
        if (validarCadena(numeroOrden)) {
            informacion['numero_orden'] = numeroOrden;
            var data = consultarInformacionObjeto("mantenimiento_aire",informacion);
            console.log(data);
            $.each(data, function(index, record) {
                if($.isNumeric(index)) {
                    $("#id_aire").val(record.id_aire);
                    $("#numero_orden").val(record.numero_orden);
                    $("#fecha_realizacion").val(record.fecha_realizacion);
                    $("#realizado").val(record.realizado);
                    $("#revisado").val(record.revisado);
                    $("#descripcion_trabajo").val(record.descripcion);
                }
            });
            $("#divDialogConsulta").modal('show');
        }else{
            alert("ERROR. Ingrese el numero de la orden de mantenimiento");
            $("#numero_orden_search").focus();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarMarcasAiresMasInstaladas y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarMarcasAiresMasInstaladas").click(function (e){
        var informacion =  {};
        var idSede = $("#sede_search").val();
        var nombreSede = $("#sede_search option:selected").text();
        var idCampus = $("#campus_search").val();
        var nombreCampus = $("#campus_search option:selected").text();
        var idEdificio = $("#edificio_search").val();
        var nombreEdificio = $("#edificio_search option:selected").text();
        informacion['id_sede'] = idSede;
        informacion['id_campus'] = idCampus;
        informacion['id_edificio'] = idEdificio;
        var data = buscarObjetos("marcas_mas_instaladas",informacion);
        var total = 0;
        var tipo = "Marcas de Aires Acondicionados Más Instaladas";
        var tituloX = "Marca de Aires Acondicionados";
        var subTipo;
        if (nombreSede == 'TODAS') {
            subTipo = "Todas las Sedes";
        }else{
            if (nombreCampus == 'TODOS') {
                subTipo = "Sede "+nombreSede;
            }else{
                if (nombreEdificio == 'TODOS') {
                    subTipo = "Campus "+nombreCampus+" de la Sede "+nombreSede;
                }else{
                    subTipo = "Edificio "+nombreEdificio+" del Campus "+nombreCampus+" de la Sede "+nombreSede;
                }
            }
        }
        label = [], informacion = [];
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                label.push(record.marca);
                informacion.push(record.conteo);
            }
        });
        if(data != null){
            var aux;
            var categorias = [], info = [];
            for (var i = 0; i < informacion.length; i++) {
                if (!isNaN(informacion[i])) {
                    aux = parseInt(informacion[i]);
                    total = aux;
                    categorias.push(label[i]);
                    info.push(parseInt(informacion[i]));
                }
            }
            var titulo = tipo;
            var subtitulo = subTipo;
            var xTitulo = tituloX;
            var yTitulo = 'Número de Aires Acondicionados (Total: '+total+')';
            generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
            $("#divDialogConsulta").modal('show');
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarTiposAiresMasInstalados y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarTiposAiresMasInstalados").click(function (e){
        var informacion =  {};
        var idSede = $("#sede_search").val();
        var nombreSede = $("#sede_search option:selected").text();
        var idCampus = $("#campus_search").val();
        var nombreCampus = $("#campus_search option:selected").text();
        var idEdificio = $("#edificio_search").val();
        var nombreEdificio = $("#edificio_search option:selected").text();
        informacion['id_sede'] = idSede;
        informacion['id_campus'] = idCampus;
        informacion['id_edificio'] = idEdificio;
        var data = buscarObjetos("tipos_mas_instalados",informacion);
        var total = 0;
        var tipo = "Tipos de Aires Acondicionados Más Instalados";
        var tituloX = "Tipo de Aires Acondicionados";
        var subTipo;
        if (nombreSede == 'TODAS') {
            subTipo = "Todas las Sedes";
        }else{
            if (nombreCampus == 'TODOS') {
                subTipo = "Sede "+nombreSede;
            }else{
                if (nombreEdificio == 'TODOS') {
                    subTipo = "Campus "+nombreCampus+" de la Sede "+nombreSede;
                }else{
                    subTipo = "Edificio "+nombreEdificio+" del Campus "+nombreCampus+" de la Sede "+nombreSede;
                }
            }
        }
        label = [], informacion = [];
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                label.push(record.tipo);
                informacion.push(record.conteo);
            }
        });
        if(data != null){
            var aux;
            var categorias = [], info = [];
            for (var i = 0; i < informacion.length; i++) {
                if (!isNaN(informacion[i])) {
                    aux = parseInt(informacion[i]);
                    total += aux;
                    categorias.push(label[i]);
                    info.push(parseInt(informacion[i]));
                }
            }
            var titulo = tipo;
            var subtitulo = subTipo;
            var xTitulo = tipo;
            var yTitulo = 'Número de Aires Acondicionados (Total: '+total+')';
            generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
            $("#divDialogConsulta").modal('show');
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarTipoTecnologiasAiresMasInstaladas y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarTipoTecnologiasAiresMasInstaladas").click(function (e){
        var informacion =  {};
        var idSede = $("#sede_search").val();
        var nombreSede = $("#sede_search option:selected").text();
        var idCampus = $("#campus_search").val();
        var nombreCampus = $("#campus_search option:selected").text();
        var idEdificio = $("#edificio_search").val();
        var nombreEdificio = $("#edificio_search option:selected").text();
        informacion['id_sede'] = idSede;
        informacion['id_campus'] = idCampus;
        informacion['id_edificio'] = idEdificio;
        var data = buscarObjetos("tipo_tecnologias_mas_instaladas",informacion);
        var total = 0;
        var tipo = "Tipo de Tecnologías de Aires Acondicionados Más Instaladas";
        var tituloX = "Tipo de Tecnología de Aires Acondicionados";
        var subTipo;
        if (nombreSede == 'TODAS') {
            subTipo = "Todas las Sedes";
        }else{
            if (nombreCampus == 'TODOS') {
                subTipo = "Sede "+nombreSede;
            }else{
                if (nombreEdificio == 'TODOS') {
                    subTipo = "Campus "+nombreCampus+" de la Sede "+nombreSede;
                }else{
                    subTipo = "Edificio "+nombreEdificio+" del Campus "+nombreCampus+" de la Sede "+nombreSede;
                }
            }
        }
        label = [], informacion = [];
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                label.push(record.tipo);
                informacion.push(record.conteo);
            }
        });
        if(data != null){
            var aux;
            var categorias = [], info = [];
            for (var i = 0; i < informacion.length; i++) {
                if (!isNaN(informacion[i])) {
                    aux = parseInt(informacion[i]);
                    total += aux;
                    categorias.push(label[i]);
                    info.push(parseInt(informacion[i]));
                }
            }
            var titulo = tipo;
            var subtitulo = subTipo;
            var xTitulo = tituloX;
            var yTitulo = 'Número de Aires Acondicionados (Total: '+total+')';
            generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
            $("#divDialogConsulta").modal('show');
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarMarcasMasMantenimientos y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarMarcasMasMantenimientos").click(function (e){
        var informacion =  {};
        var idSede = $("#sede_search").val();
        var nombreSede = $("#sede_search option:selected").text();
        var idCampus = $("#campus_search").val();
        var nombreCampus = $("#campus_search option:selected").text();
        var idEdificio = $("#edificio_search").val();
        var nombreEdificio = $("#edificio_search option:selected").text();
        var fechaInicio = $("#fecha_inicio").val();
        var fechaFin = $("#fecha_fin").val();
        informacion['id_sede'] = idSede;
        informacion['id_campus'] = idCampus;
        informacion['id_edificio'] = idEdificio;
        informacion['fecha_inicio'] = fechaInicio + "  00:00:00";
        informacion['fecha_fin'] = fechaFin + "  00:00:00";
        var data = buscarObjetos("marcas_mas_mantenimientos",informacion);
        var total = 0;
        var tipo = "Marcas de Aires Acondicionados con Más Ordenes Mantenimiento";
        var tituloX = "Marca de Aires Acondicionados";
        var subTipo;
        if (nombreSede == 'TODAS') {
            subTipo = "Todas las Sedes";
        }else{
            if (nombreCampus == 'TODOS') {
                subTipo = "Sede "+nombreSede;
            }else{
                if (nombreEdificio == 'TODOS') {
                    subTipo = "Campus "+nombreCampus+" de la Sede "+nombreSede;
                }else{
                    subTipo = "Edificio "+nombreEdificio+" del Campus "+nombreCampus+" de la Sede "+nombreSede;
                }
            }
        }
        subTipo += " entre el "+fechaInicio+" y el "+fechaFin;
        label = [], informacion = [];
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                label.push(record.marca);
                informacion.push(record.conteo);
            }
        });
        if(data != null){
            var aux;
            var categorias = [], info = [];
            for (var i = 0; i < informacion.length; i++) {
                if (!isNaN(informacion[i])) {
                    aux = parseInt(informacion[i]);
                    total += aux;
                    categorias.push(label[i]);
                    info.push(parseInt(informacion[i]));
                }
            }
            var titulo = tipo;
            var subtitulo = subTipo;
            var xTitulo = tituloX;
            var yTitulo = 'Número de Aires Acondicionados (Total: '+total+')';
            generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
            $("#divDialogConsulta").modal('show');
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón visualizarAiresMasMantenimientos y se
     * realiza la operacion correspondiente.
    **/
    $("#visualizarAiresMasMantenimientos").click(function (e){
        var informacion =  {};
        var idSede = $("#sede_search").val();
        var nombreSede = $("#sede_search option:selected").text();
        var idCampus = $("#campus_search").val();
        var nombreCampus = $("#campus_search option:selected").text();
        var idEdificio = $("#edificio_search").val();
        var nombreEdificio = $("#edificio_search option:selected").text();
        var fechaInicio = $("#fecha_inicio").val();
        var fechaFin = $("#fecha_fin").val();
        informacion['id_sede'] = idSede;
        informacion['id_campus'] = idCampus;
        informacion['id_edificio'] = idEdificio;
        informacion['fecha_inicio'] = fechaInicio + "  00:00:00";
        informacion['fecha_fin'] = fechaFin + "  00:00:00";
        var data = buscarObjetos("aires_mas_mantenimientos",informacion);
        console.log(data);
        var total = 0;
        var tipo = "Aires Acondicionados con Más Ordenes Mantenimiento";
        var tituloX = "Aires Acondicionados";
        var subTipo;
        if (nombreSede == 'TODAS') {
            subTipo = "Todas las Sedes";
        }else{
            if (nombreCampus == 'TODOS') {
                subTipo = "Sede "+nombreSede;
            }else{
                if (nombreEdificio == 'TODOS') {
                    subTipo = "Campus "+nombreCampus+" de la Sede "+nombreSede;
                }else{
                    subTipo = "Edificio "+nombreEdificio+" del Campus "+nombreCampus+" de la Sede "+nombreSede;
                }
            }
        }
        subTipo += " entre el "+fechaInicio+" y el "+fechaFin;
        label = [], informacion = [];
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                label.push(record.id_aire+" - "+record.numero_inventario+" - "+record.marca);
                informacion.push(record.conteo);
            }
        });
        if(data != null){
            var aux;
            var categorias = [], info = [];
            for (var i = 0; i < informacion.length; i++) {
                if (!isNaN(informacion[i])) {
                    aux = parseInt(informacion[i]);
                    total += aux;
                    categorias.push(label[i]);
                    info.push(parseInt(informacion[i]));
                }
            }
            var titulo = tipo;
            var subtitulo = subTipo;
            var xTitulo = tituloX;
            var yTitulo = 'Número de Aires Acondicionados (Total: '+total+')';
            generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
            $("#divDialogConsulta").modal('show');
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_informacion_articulo y se
     * realiza la operacion correspondiente.
    **/
    $("#ver_informacion_articulo").click(function (e){
        var element = $("#tabla_inventario").find(".filaSeleccionada");
		var articulo = element.html();
		articulo = articulo.split("</td>");
		articulo = articulo[0].substring(4);
		var informacion = {};
		informacion["id_articulo"] = articulo;
        var data = consultarInformacionObjeto("articulo",informacion);
        var dataProveedor = consultarInformacionObjeto("articulo_proveedor",informacion);
        proveedoresCont = 0;
		console.log(data);
        console.log(dataProveedor);
		$.each(data, function(index, record) {
            if($.isNumeric(index)) {
				$("#nombre_articulo").val(record.nombre);
				$("#marca").val(record.id_marca);
                $("#marca").attr('name',record.id_marca);
				$("#cantidad_minima").val(record.cantidad_minima);
            }
        });
        $.each(dataProveedor, function(index, record) {
            if($.isNumeric(index)) {
                if (proveedoresCont == 0) {
                    $("#proveedor_articulo").val(record.id_proveedor);
                    $("#proveedor_articulo").attr('name',record.id_proveedor);
                }else{
                    var componente = '<div id="proveedor'+proveedoresCont+'">'
                    +'<br><div class="div_izquierda"><b>Proveedor ('+(proveedoresCont+1)+') del Art&iacute;culo:</b></div>'
                    +'<select class="form-control formulario" name="proveedor_articulo" id="proveedor_articulo'+proveedoresCont+'" disabled required></select>'
                    +'</div>';
                    añadirComponente("proveedor",componente);
                    actualizarSelectProveedores(proveedoresCont);
                    $("#proveedor_articulo"+proveedoresCont).val(record.id_proveedor);
                    $("#proveedor_articulo"+proveedoresCont).attr('name',record.id_proveedor);
                }
                proveedoresCont++;
            }
        });
		$("#divDialogConsulta").modal('show');
    });

    /**
     * Se captura el evento cuando se abre el modal divDialogConsulta.
    **/
    $("#divDialogConsulta").on("shown.bs.modal", function () {
        if (URLactual['href'].indexOf('consultar_cubierta') == -1 && URLactual['href'].indexOf('consultar_gradas') == -1 && URLactual['href'].indexOf('consultar_espacio') == -1 && URLactual['href'].indexOf('consultar_sede') == -1) {
            if (URLactual['href'].indexOf('consultar_campus') >= 0) {
                mapaModificacion.setZoom(15);
                google.maps.event.trigger(mapaModificacion, "resize");
                mapaModificacion.setCenter(coordsMapaModificacion);
            }else if((URLactual['href'].indexOf('consultar_tipo_material') == -1 && (URLactual['href'].indexOf('consultar_tipo_objeto') == -1) && (URLactual['href'].indexOf('aires') == -1) && (URLactual['href'].indexOf('inventario') == -1))){
                mapaModificacion.setZoom(18);
                google.maps.event.trigger(mapaModificacion, "resize");
                mapaModificacion.setCenter(coordsMapaModificacion);
            }
        }
        eliminarComponente("slide_carrusel_eliminar");
        eliminarComponente("item_carrusel_eliminar");
    });

    /**
     * Se captura el evento cuando se abre el modal divDialogConsulta.
    **/
    $("#divDialogConsultaMapa").on("shown.bs.modal", function () {
        eliminarComponente("slide_carrusel_eliminar");
        eliminarComponente("item_carrusel_eliminar");
    });

    /**
     * Se captura el evento cuando se cierra el modal divDialogConsulta.
    **/
    $('#divDialogConsulta').on('hidden.bs.modal', function () {
        $("#nombre_sede").attr('disabled',true);
        $("#nombre_campus").attr('disabled',true);
        $("#id_cancha").attr('disabled',true);
        $("#uso_cancha").attr('disabled',true);
        $("#material_piso").attr('disabled',true);
        $("#tipo_pintura").attr('disabled',true);
        $("#longitud_demarcacion").attr('disabled',true);
        $("#id_corredor").attr('disabled',true);
        $("#altura_pared").attr('disabled',true);
        $("#ancho_pared").attr('disabled',true);
        $("#material_pared").attr('disabled',true);
        $("#tipo_cubierta").attr('disabled',true);
        $("#material_cubierta").attr('disabled',true);
        $("#ancho").attr('disabled',true);
        $("#largo").attr('disabled',true);
        $("input[name=pasamanos]").attr('disabled', true);
        $("#material_pasamanos").attr('disabled',true);
        $("#tipo_ventana").attr('disabled',true);
        $("#cantidad_ventanas").attr('disabled',true);
        $("#material_ventana").attr('disabled',true);
        $("#ancho_ventana").attr('disabled',true);
        $("#alto_ventana").attr('disabled',true);
        $("#id_parqueadero").attr('disabled',true);
        $("#capacidad").attr('disabled',true);
        $("#ancho").attr('disabled',true);
        $("#largo").attr('disabled',true);
        $("#material_piso").attr('disabled',true);
        $("#tipo_pintura").attr('disabled',true);
        $("#longitud_demarcacion").attr('disabled',true);
        $("#id_piscina").attr('disabled',true);
        $("#alto").attr('disabled',true);
        $("#ancho").attr('disabled',true);
        $("#largo").attr('disabled',true);
        $("#cantidad_puntos_hidraulicos").attr('disabled',true);
        $("#id_plazoleta").attr('disabled',true);
        $("#nombre").attr('disabled',true);
        $("#tipo_iluminacion").attr('disabled',true);
        $("#cantidad_iluminacion").attr('disabled',true);
        $("#id_sendero").attr('disabled',true);
        $("#longitud").attr('disabled',true);
        $("#ancho").attr('disabled',true);
        $("#material_piso").attr('disabled',true);
        $("#tipo_iluminacion").attr('disabled',true);
        $("#cantidad_iluminacion").attr('disabled',true);
        $("#codigo_poste").attr('disabled',true);
        $("#ancho_cubierta").attr('disabled',true);
        $("#largo_cubierta").attr('disabled',true);
        $("#material_cubierta").attr('disabled',true);
        $("#id_via").attr('disabled',true);
        $("#tipo_pintura").attr('disabled',true);
        $("#longitud_demarcacion").attr('disabled',true);
        $("#material_piso").attr('disabled',true);
        $("#nombre_edificio").attr('disabled',true);
        $("#pisos_edificio").attr('disabled',true);
        $("#terraza").attr('disabled',true);
        $("#sotano").attr('disabled',true);
        $("#ancho_fachada").attr('disabled',true);
        $("#alto_fachada").attr('disabled',true);
        $("#material_fachada").attr('disabled',true);
        $("#id_espacio").attr('disabled',true);
        $("#pisos").attr('disabled',true);
        $("#uso_espacio").attr('disabled',true);
        $("#altura_pared").attr('disabled',true);
        $("#ancho_pared").attr('disabled',true);
        $("#material_pared").attr('disabled',true);
        $("#largo_techo").attr('disabled',true);
        $("#ancho_techo").attr('disabled',true);
        $("#material_techo").attr('disabled',true);
        $("#largo_piso").attr('disabled',true);
        $("#ancho_piso").attr('disabled',true);
        $("#material_piso").attr('disabled',true);
        $("#tipo_iluminacion").attr('disabled',true);
        $("#cantidad_iluminacion").attr('disabled',true);
        $("#tipo_suministro_energia").attr('disabled',true);
        $("#tomacorriente").attr('disabled',true);
        $("#cantidad_tomacorrientes").attr('disabled',true);
        $("#tipo_puerta").attr('disabled',true);
        $("#cantidad_puertas").attr('disabled',true);
        $("#material_puerta").attr('disabled',true);
        $("#tipo_cerradura").attr('disabled',true);
        $("input[name=gato_puerta]").attr('disabled', true);
        $("#material_marco_puerta").attr('disabled',true);
        $("#ancho_puerta").attr('disabled',true);
        $("#alto_puerta").attr('disabled',true);
        $("#tipo_ventana").attr('disabled',true);
        $("#cantidad_ventanas").attr('disabled',true);
        $("#material_ventana").attr('disabled',true);
        $("#ancho_ventana").attr('disabled',true);
        $("#alto_ventana").attr('disabled',true);
        $("#tipo_interruptor").attr('disabled',true);
        $("#cantidad_interruptores").attr('disabled',true);
        $("input[name=tiene_espacio_padre]").attr('disabled', true);
        $("#nombre_tipo_material").attr('disabled',true);
        $("#nombre_tipo_objeto").attr('disabled',true);
        $("#numero_inventario").attr('disabled',true);
        $("#capacidad_aire").attr('disabled',true);
        $("#marca_aire").attr('disabled',true);
        $("#tipo_aire").attr('disabled',true);
        $("#capacidad_aire_nueva").attr('disabled',true);
        $("#marca_aire_nueva").attr('disabled',true);
        $("#tipo_aire_nuevo").attr('disabled',true);
        $("#tecnologia_aire_nuevo").attr('disabled',true);
        $("#tipo_tecnologia_aire").attr('disabled',true);
        $("#fecha_instalacion").attr('disabled',true);
        $("#instalador").attr('disabled',true);
        $("#tipo_periodicidad_mantenimiento").attr('disabled',true);
        $("#ubicacion_condensadora").attr('disabled',true);
        $("#fecha_realizacion").attr('disabled',true);
        $("#realizado").attr('disabled',true);
        $("#revisado").attr('disabled',true);
        $("#descripcion_trabajo").attr('disabled',true);
        $("#nombre_articulo").attr('disabled',true);
        $("#marca").attr('disabled',true);
        $("#cantidad_minima").attr('disabled',true);
        $("#proveedor_articulo").attr('disabled',true);
        $("#modificar_sede").show();
        $("#modificar_campus").show();
        $("#modificar_cancha").show();
        $("#modificar_corredor").show();
        $("#modificar_cubierta").show();
        $("#modificar_gradas").show();
        $("#modificar_parqueadero").show();
        $("#modificar_piscina").show();
        $("#modificar_plazoleta").show();
        $("#modificar_sendero").show();
        $("#modificar_via").show();
        $("#modificar_edificio").show();
        $("#modificar_espacio").show();
        $("#modificar_tipo_material").show();
        $("#modificar_tipo_objeto").show();
        $("#fotos").show();
        $("#modificar_aire").show();
        $("#modificar_capacidad_aire").show();
        $("#modificar_marca_aire").show();
        $("#modificar_tipo_aire").show();
        $("#modificar_tecnologia_aire").show();
        $("#modificar_articulo").show();
        $("#guardar_modificaciones_sede").hide();
        $("#guardar_modificaciones_campus").hide();
        $("#guardar_modificaciones_cancha").hide();
        $("#guardar_modificaciones_corredor").hide();
        $("#guardar_modificaciones_cubierta").hide();
        $("#guardar_modificaciones_gradas").hide();
        $("#guardar_modificaciones_parqueadero").hide();
        $("#guardar_modificaciones_piscina").hide();
        $("#guardar_modificaciones_plazoleta").hide();
        $("#guardar_modificaciones_sendero").hide();
        $("#guardar_modificaciones_via").hide();
        $("#guardar_modificaciones_edificio").hide();
        $("#guardar_modificaciones_espacio").hide();
        $("#guardar_modificaciones_tipo_material").hide();
        $("#guardar_modificaciones_tipo_objeto").hide();
        $("#guardar_fotos").hide();
        $("#botones_anadir_iluminacion").hide();
        $("#botones_anadir_interruptor").hide();
        $("#botones_anadir_puerta").hide();
        $("#botones_anadir_tomacorriente").hide();
        $("#botones_anadir_ventana").hide();
        $("#enlace_fotos").hide();
        $("#divBotonEliminarPlano").hide();
        $("#botones_lavamanos").hide();
        $("#guardar_archivos").hide();
        $("#botones_orinal").hide();
        $("#guardar_modificaciones_aire").hide();
        $("#guardar_modificaciones_capacidad_aire").hide();
        $("#guardar_modificaciones_marca_aire").hide();
        $("#guardar_modificaciones_tipo_aire").hide();
        $("#guardar_modificaciones_tecnologia_aire").hide();
        $("#guardar_modificaciones_articulo").hide();
        eliminarComponente("tituloInfo");
        eliminarComponente("informacion");
        eliminarComponente("informacion2");
        while (iluminacionCont > 0) {
            eliminarComponente("iluminacion"+iluminacionCont);
            iluminacionCont--;
        }
        while (lavamanosCont > 0) {
            eliminarComponente("lavamanos"+lavamanosCont);
            lavamanosCont--;
        }
        while (tomacorrientesCont > 0) {
            eliminarComponente("suministro_energia"+tomacorrientesCont);
            tomacorrientesCont--;
        }
        while (orinalesCont > 0) {
            eliminarComponente("orinal"+orinalesCont);
            orinalesCont--;
        }
        while (puertasCont > 0) {
            eliminarComponente("puerta"+puertasCont);
            puertasCont--;
        }
        while (puntosSanitariosCont > 0) {
            eliminarComponente("punto_sanitario"+puntosSanitariosCont);
            puntosSanitariosCont--;
        }
        while (ventanasCont > 0) {
            eliminarComponente("ventana"+ventanasCont);
            ventanasCont--;
        }
        while (interruptoresCont > 0) {
            eliminarComponente("interruptor"+interruptoresCont);
            interruptoresCont--;
        }
        while (proveedoresCont > 0) {
            eliminarComponente("proveedor"+proveedoresCont);
            proveedoresCont--;
        }
        $("#eliminar_iluminacion").attr('disabled', true);
        $("#eliminar_interruptor").attr('disabled', true);
        $("#eliminar_tomacorriente").attr('disabled', true);
        $("#eliminar_puerta").attr('disabled', true);
        $("#eliminar_ventana").attr('disabled', true);
        $("#eliminar_proveedor").attr('disabled', true);
        fotosEliminar = [], planosEliminar = [], tipoIluminacionEliminar = [], tipoSuministroEnergiaEliminar = [], tomacorrienteEliminar = [], tipoPuertaEliminar = [], materialPuertaEliminar = [], tipoCerraduraEliminar = [], materialMarcoPuertaEliminar = [], tipoVentanaEliminar = [], materialVentanaEliminar = [], tipoInterruptorEliminar = [], tipoPuntoSanitarioEliminar = [], tipoOrinalEliminar = [], tipoLavamanosEliminar = [];
        window.scrollTo(0,0);
    });

    /**
     * Se captura el evento cuando se cierra el modal divDialogConsulta.
    **/
    $('#divDialogConsultaMapa').on('hidden.bs.modal', function () {
        eliminarComponente("tituloObjeto");
        eliminarComponente("informacionObjeto");
        iluminacionCont = 0, cerraduraCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0, puntosSanitariosCont = 0, lavamanosCont = 0, orinalesCont = 0;
    });

    /**
     * Evento de cambio del selector de archivo del modal de consulta/modificación.
    **/
    $("#planos").on("change", ".agregar_archivos", function(){
        var planos = document.getElementById("planos[]");
        var aux = numeroPlanos + planos.files.length;
        if (aux > numeroPlanos) {
            if(URLactual['href'].indexOf('consultar_mapa') >= 0){
                $("#guardar_archivos").removeAttr('disabled');
            }else{
                if (!$("#guardar_modificaciones_campus").is(':visible'))
                $("#guardar_archivos").show();
            }
        }else if(aux2 == numeroFotos){
            if(URLactual['href'].indexOf('consultar_mapa') >= 0){
                $("#guardar_archivos").attr('disabled',true);
            }else{
                $("#guardar_archivos").hide();
            }
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del radio button pasamanos
     * y se actualiza el selector de pisos.
    **/
    $("#form_pasamanos").change(function (e) {
        var pasamanos = $('input[name="pasamanos"]:checked').val();
        if (pasamanos == "true") {
            $('#divPasamanos').show();
        }else{
            $('#divPasamanos').hide();
        }
    });

    /**
     * Evento de cambio del selector de archivo del modal de consulta/modificación.
    **/
    $("#myCarousel").on("change", ".upload", function(){
        var fotos = document.getElementById("fileInputOculto");
        var aux = numeroFotos + fotos.files.length;
        if (aux > numeroFotos) {
            if(URLactual['href'].indexOf('consultar_mapa') >= 0){
                $("#guardar_archivos").removeAttr('disabled');
                $("#guardar_fotos").removeAttr('disabled');
            }else{
                $("#guardar_archivos").show();
                $("#guardar_fotos").show();
            }
        }else if(aux2 == numeroPlanos){
            if(URLactual['href'].indexOf('consultar_mapa') >= 0){
                $("#guardar_archivos").attr('disabled',true);
            }else{
                $("#guardar_archivos").hide();
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_sede y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_sede").click(function (e){
        $("#nombre_sede").removeAttr("disabled");
        $("#modificar_sede").hide();
        $("#guardar_modificaciones_sede").show();
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_campus y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_campus").click(function (e){
        $("#nombre_campus").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_campus").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_campus").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_cancha y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_cancha").click(function (e){
        $("#uso_cancha").removeAttr("disabled");
        $("#material_piso").removeAttr("disabled");
        $("#tipo_pintura").removeAttr("disabled");
        $("#longitud_demarcacion").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_cancha").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_cancha").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_corredor y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_corredor").click(function (e){
        $("#altura_pared").removeAttr("disabled");
        $("#ancho_pared").removeAttr("disabled");
        $("#material_pared").removeAttr("disabled");
        $("#ancho_piso").removeAttr("disabled");
        $("#largo_piso").removeAttr("disabled");
        $("#material_piso").removeAttr("disabled");
        $("#ancho_techo").removeAttr("disabled");
        $("#largo_techo").removeAttr("disabled");
        $("#material_techo").removeAttr("disabled");
        $("#tipo_suministro_energia").removeAttr("disabled");
        $("#tomacorriente").removeAttr("disabled");
        $("#cantidad_tomacorrientes").removeAttr("disabled");
        $("#tipo_iluminacion").removeAttr("disabled");
        $("#cantidad_iluminacion").removeAttr("disabled");
        $("#tipo_interruptor").removeAttr("disabled");
        $("#cantidad_interruptores").removeAttr("disabled");
        for (var i = 1; i < iluminacionCont; i++) {
            $("#tipo_iluminacion"+i).removeAttr("disabled");
            $("#cantidad_iluminacion"+i).removeAttr("disabled");
        }
        for (var i = 1; i < interruptoresCont; i++) {
            $("#tipo_interruptor"+i).removeAttr("disabled");
            $("#cantidad_interruptores"+i).removeAttr("disabled");
        }
        if (iluminacionCont > 1) {
            $("#eliminar_iluminacion").removeAttr("disabled");
        }
        if (interruptoresCont > 1) {
            $("#eliminar_interruptor").removeAttr("disabled");
        }
        $("#botones_anadir_iluminacion").show();
        $("#botones_anadir_interruptor").show();
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_corredor").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_corredor").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_cubierta y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_cubierta").click(function (e){
        $("#tipo_cubierta").removeAttr("disabled");
        $("#material_cubierta").removeAttr("disabled");
        $("#ancho").removeAttr("disabled");
        $("#largo").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_cubierta").hide();
        $("#guardar_modificaciones_cubierta").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_gradas y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_gradas").click(function (e){
        $("input[name=pasamanos]").attr('disabled', false);
        $("#material_pasamanos").removeAttr("disabled");
        $("#tipo_ventana").removeAttr("disabled");
        $("#cantidad_ventanas").removeAttr("disabled");
        $("#material_ventana").removeAttr("disabled");
        $("#ancho_ventana").removeAttr("disabled");
        $("#alto_ventana").removeAttr("disabled");
        for (var i = 1; i < ventanasCont; i++) {
            $("#tipo_ventana"+i).removeAttr("disabled");
            $("#cantidad_ventanas"+i).removeAttr("disabled");
            $("#material_ventana"+i).removeAttr("disabled");
            $("#ancho_ventana"+i).removeAttr("disabled");
            $("#alto_ventana"+i).removeAttr("disabled");
        }
        if (ventanasCont > 1) {
            $("#eliminar_ventana").removeAttr("disabled");
        }
        $("#botones_anadir_ventana").show();
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_gradas").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_gradas").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_parqueadero y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_parqueadero").click(function (e){
        $("#capacidad").removeAttr("disabled");
        $("#ancho").removeAttr("disabled");
        $("#largo").removeAttr("disabled");
        $("#material_piso").removeAttr("disabled");
        $("#tipo_pintura").removeAttr("disabled");
        $("#longitud_demarcacion").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_parqueadero").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_parqueadero").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_piscina y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_piscina").click(function (e){
        $("#alto").removeAttr("disabled");
        $("#ancho").removeAttr("disabled");
        $("#largo").removeAttr("disabled");
        $("#cantidad_puntos_hidraulicos").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_piscina").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_piscina").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_plazoleta y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_plazoleta").click(function (e){
        $("#nombre").removeAttr("disabled");
        $("#tipo_iluminacion").removeAttr("disabled");
        $("#cantidad_iluminacion").removeAttr("disabled");
        for (var i = 1; i < iluminacionCont; i++) {
            $("#tipo_iluminacion"+i).removeAttr("disabled");
            $("#cantidad_iluminacion"+i).removeAttr("disabled");
        }
        if (iluminacionCont > 1) {
            $("#eliminar_iluminacion").removeAttr("disabled");
        }
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#botones_anadir_iluminacion").show();
        $("#modificar_plazoleta").hide();
        $("#guardar_modificaciones_plazoleta").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_sendero y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_sendero").click(function (e){
        $("#longitud").removeAttr("disabled");
        $("#ancho").removeAttr("disabled");
        $("#material_piso").removeAttr("disabled");
        $("#tipo_iluminacion").removeAttr("disabled");
        $("#cantidad_iluminacion").removeAttr("disabled");
        $("#codigo_poste").removeAttr("disabled");
        $("#ancho_cubierta").removeAttr("disabled");
        $("#largo_cubierta").removeAttr("disabled");
        $("#material_cubierta").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_sendero").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_sendero").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_via y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_via").click(function (e){
        $("#tipo_pintura").removeAttr("disabled");
        $("#longitud_demarcacion").removeAttr("disabled");
        $("#material_piso").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_via").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_via").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_edificio y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_edificio").click(function (e){
        $("#nombre_edificio").removeAttr("disabled");
        $("#terraza").removeAttr("disabled");
        $("#sotano").removeAttr("disabled");
        $("#ancho_fachada").removeAttr("disabled");
        $("#alto_fachada").removeAttr("disabled");
        $("#material_fachada").removeAttr("disabled");
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_edificio").hide();
        $("#guardar_archivos").hide();
        $("#guardar_modificaciones_edificio").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setDraggable(true);
        }
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_espacio y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_espacio").click(function (e){
        $("#altura_pared").removeAttr("disabled");
        $("#ancho_pared").removeAttr("disabled");
        $("#material_pared").removeAttr("disabled");
        $("#largo_techo").removeAttr("disabled");
        $("#ancho_techo").removeAttr("disabled");
        $("#material_techo").removeAttr("disabled");
        $("#largo_piso").removeAttr("disabled");
        $("#ancho_piso").removeAttr("disabled");
        $("#material_piso").removeAttr("disabled");
        $("#tipo_iluminacion").removeAttr("disabled");
        $("#cantidad_iluminacion").removeAttr("disabled");
        $("#tipo_suministro_energia").removeAttr("disabled");
        $("#tomacorriente").removeAttr("disabled");
        $("#cantidad_tomacorrientes").removeAttr("disabled");
        $("#tipo_puerta").removeAttr("disabled");
        $("#cantidad_puertas").removeAttr("disabled");
        $("#material_puerta").removeAttr("disabled");
        $("#tipo_cerradura").removeAttr("disabled");
        $("input[name=gato_puerta]").attr('disabled', false);
        $("#material_marco_puerta").removeAttr("disabled");
        $("#ancho_puerta").removeAttr("disabled");
        $("#alto_puerta").removeAttr("disabled");
        $("#tipo_ventana").removeAttr("disabled");
        $("#cantidad_ventanas").removeAttr("disabled");
        $("#material_ventana").removeAttr("disabled");
        $("#ancho_ventana").removeAttr("disabled");
        $("#alto_ventana").removeAttr("disabled");
        $("#tipo_interruptor").removeAttr("disabled");
        $("#cantidad_interruptores").removeAttr("disabled");
        $("input[name=tiene_espacio_padre]").attr('disabled', false);
        $("#cantidad_puntos_red").removeAttr("disabled");
        $("#capacidad").removeAttr("disabled");
        $("input[name=punto_videobeam]").attr('disabled', false);
        $("#cantidad_puntos_hidraulicos").removeAttr("disabled");
        $("#tipo_punto_sanitario").removeAttr("disabled");
        $("#cantidad_puntos_sanitarios").removeAttr("disabled");
        $("#tipo_inodoro").removeAttr("disabled");
        $("#cantidad_inodoros").removeAttr("disabled");
        $("input[name=ducha]").attr('disabled', false);
        $("input[name=lavatraperos]").attr('disabled', false);
        $("#cantidad_sifones").removeAttr("disabled");
        $("#tipo_divisiones").removeAttr("disabled");
        $("#material_divisiones").removeAttr("disabled");
        $("#tipo_lavamanos").removeAttr("disabled");
        $("#cantidad_lavamanos").removeAttr("disabled");
        $("#tipo_orinal").removeAttr("disabled");
        $("#cantidad_orinales").removeAttr("disabled");
        for (var i = 1; i < iluminacionCont; i++) {
            $("#tipo_iluminacion"+i).removeAttr("disabled");
            $("#cantidad_iluminacion"+i).removeAttr("disabled");
        }
        for (var i = 1; i < interruptoresCont; i++) {
            $("#tipo_interruptor"+i).removeAttr("disabled");
            $("#cantidad_interruptores"+i).removeAttr("disabled");
        }
        for (var i = 1; i < tomacorrientesCont; i++) {
            $("#tipo_suministro_energia"+i).removeAttr("disabled");
            $("#tomacorriente"+i).removeAttr("disabled");
            $("#cantidad_tomacorrientes"+i).removeAttr("disabled");
        }
        for (var i = 1; i < puertasCont; i++) {
            $("#tipo_puerta"+i).removeAttr("disabled");
            $("#cantidad_puertas"+i).removeAttr("disabled");
            $("#material_puerta"+i).removeAttr("disabled");
            $("#tipo_cerradura"+i).removeAttr("disabled");
            $("#gato_puerta"+i).removeAttr("disabled");
            $("#material_marco_puerta"+i).removeAttr("disabled");
            $("#ancho_puerta"+i).removeAttr("disabled");
            $("#alto_puerta"+i).removeAttr("disabled");
        }
        for (var i = 1; i < ventanasCont; i++) {
            $("#tipo_ventana"+i).removeAttr("disabled");
            $("#cantidad_ventanas"+i).removeAttr("disabled");
            $("#material_ventana"+i).removeAttr("disabled");
            $("#ancho_ventana"+i).removeAttr("disabled");
            $("#alto_ventana"+i).removeAttr("disabled");
        }
        if (iluminacionCont > 1) {
            $("#eliminar_iluminacion").removeAttr("disabled");
        }
        if (interruptoresCont > 1) {
            $("#eliminar_interruptor").removeAttr("disabled");
        }
        if (tomacorrientesCont > 1) {
            $("#eliminar_tomacorriente").removeAttr("disabled");
        }
        if (puertasCont > 1) {
            $("#eliminar_puerta").removeAttr("disabled");
        }
        if (ventanasCont > 1) {
            $("#eliminar_ventana").removeAttr("disabled");
        }
        $("#botones_anadir_iluminacion").show();
        $("#botones_anadir_interruptor").show();
        $("#botones_anadir_puerta").show();
        $("#botones_anadir_tomacorriente").show();
        $("#botones_anadir_ventana").show();
        $("#enlace_fotos").show();
        for (var i = 0; i < numeroPlanos; i++) {
            $('[name="divBotonEliminarPlano'+i+'"]').show();
        }
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $("#modificar_espacio").hide();
        $("#guardar_archivos").hide();
        if (usoEspacioSelect == '6'){
            $('#botones_lavamanos').show();
            $('#botones_orinal').show();
        }else if(usoEspacioSelect == '3' || usoEspacioSelect == '17' || usoEspacioSelect == '19'){
            $("#botones_punto_sanitario").show();
        }
        $("#guardar_modificaciones_espacio").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_tipo_material y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_tipo_material").click(function (e){
        $("#nombre_tipo_material").removeAttr("disabled");
        $("#modificar_tipo_material").hide();
        $("#guardar_modificaciones_tipo_material").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_tipo_objeto y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_tipo_objeto").click(function (e){
        $("#nombre_tipo_objeto").removeAttr("disabled");
        $("#modificar_tipo_objeto").hide();
        $("#guardar_modificaciones_tipo_objeto").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_aire").click(function (e){
        $("#numero_inventario").removeAttr("disabled");
        $("#marca_aire").removeAttr("disabled");
        $("#tipo_aire").removeAttr("disabled");
        $("#tipo_tecnologia_aire").removeAttr("disabled");
        $("#capacidad_aire").removeAttr("disabled");
        $("#fecha_instalacion").removeAttr("disabled");
        $("#instalador").removeAttr("disabled");
        $("#tipo_periodicidad_mantenimiento").removeAttr("disabled");
        $("#ubicacion_condensadora").removeAttr("disabled");
        $("#modificar_aire").hide();
        $("#guardar_modificaciones_aire").show();
        $("#enlace_fotos").show();
        $("#inputFileFotos").show();
        $("#fotos").hide();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_capacidad_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_capacidad_aire").click(function (e){
        $("#capacidad_aire_nueva").removeAttr("disabled");
        $("#modificar_capacidad_aire").hide();
        $("#guardar_modificaciones_capacidad_aire").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_marca_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_marca_aire").click(function (e){
        $("#marca_aire_nueva").removeAttr("disabled");
        $("#modificar_marca_aire").hide();
        $("#guardar_modificaciones_marca_aire").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_tipo_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_tipo_aire").click(function (e){
        $("#tipo_aire_nuevo").removeAttr("disabled");
        $("#modificar_tipo_aire").hide();
        $("#guardar_modificaciones_tipo_aire").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_tecnologia_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_tecnologia_aire").click(function (e){
        $("#tecnologia_aire_nuevo").removeAttr("disabled");
        $("#modificar_tecnologia_aire").hide();
        $("#guardar_modificaciones_tecnologia_aire").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_mantenimiento_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_mantenimiento_aire").click(function (e){
        $("#fecha_realizacion").removeAttr("disabled");
        $("#realizado").removeAttr("disabled");
        $("#revisado").removeAttr("disabled");
        $("#descripcion_trabajo").removeAttr("disabled");
        $("#modificar_mantenimiento_aire").hide();
        $("#guardar_modificaciones_mantenimiento_aire").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_mantenimiento_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_articulo").click(function (e){
        $("#nombre_articulo").removeAttr("disabled");
        $("#marca").removeAttr("disabled");
        $("#cantidad_minima").removeAttr("disabled");
        $("#proveedor_articulo").removeAttr("disabled");
        $("#modificar_articulo").hide();
        $("#guardar_modificaciones_articulo").show();
        $('#divDialogConsulta').scrollTop(0);
    });

    /**
     * Se captura el evento cuando se da click en el botón modificar_cantidad_articulos y se
     * realiza la operacion correspondiente.
    **/
    $("#modificar_cantidad_articulos").click(function (e){
        actualizarSelectArticulo(anadirArticulosCont);
        $("#divDialogModificarArticulo").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_campus y se
     * realiza la operacion correspondiente.
    **/
    $("#enlace_fotos").on("click", "#eliminar_archivo", function(){
        var nombreId = $(this).attr('name');
        var nombreArchivo = $("#"+nombreId).attr('name');
        if ($("#"+nombreId).hasClass('texto_tachado')) {
            $("#"+nombreId).removeClass("texto_tachado");
            var posicion = fotosEliminar.indexOf(nombreArchivo);
            if (posicion > -1) {
                fotosEliminar.splice(posicion,1);
            }
        }else{
            $("#"+nombreId).addClass("texto_tachado");
            fotosEliminar.push(nombreArchivo);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_campus y se
     * realiza la operacion correspondiente.
    **/
    $("#planos").on("click", "#eliminar_archivo", function(){
        var nombreId = $(this).attr('name');
        var nombreArchivo = $("#"+nombreId).attr('name');
        if ($("#"+nombreId).hasClass('texto_tachado')) {
            $("#"+nombreId).removeClass("texto_tachado");
            var posicion = planosEliminar.indexOf(nombreArchivo);
            if (posicion > -1) {
                planosEliminar.splice(posicion,1);
            }
        }else{
            $("#"+nombreId).addClass("texto_tachado");
            planosEliminar.push(nombreArchivo);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_campus y se
     * realiza la operacion correspondiente.
    **/
    $("#map").on("click", ".ver_campus", function(){
        rellenarMapaConsulta();
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_edificios y se
     * realiza la operacion correspondiente.
    **/
    $("#map").on("click", ".ver_edificios", function(){
        for (var i = 0; i < marcadores.length; i++) {
            marcadores[i].setMap(null);
        }
        var informacion = {};
        informacion["nombre_sede"] = sedeSeleccionada;
        informacion["nombre_campus"] = campusSeleccionado;
        var edificios = buscarObjetos("edificios",informacion);
        var canchas = buscarObjetos("canchas",informacion);
        var corredores = buscarObjetos("corredores",informacion);
        var parqueaderos = buscarObjetos("parqueaderos",informacion);
        var piscinas = buscarObjetos("piscinas",informacion);
        var plazoletas = buscarObjetos("plazoletas",informacion);
        var senderos = buscarObjetos("senderos",informacion);
        var vias = buscarObjetos("vias",informacion);
        console.log(edificios);
        console.log(canchas);
        console.log(corredores);
        console.log(parqueaderos);
        console.log(piscinas);
        console.log(plazoletas);
        console.log(senderos);
        console.log(vias);
        var bounds  = new google.maps.LatLngBounds();
        if (edificios.mensaje == null && canchas.mensaje == null && corredores.mensaje == null && parqueaderos.mensaje == null && piscinas.mensaje == null && plazoletas.mensaje == null && senderos.mensaje == null && vias.mensaje == null) {
            alert("El campus seleccionado no tiene edificios creados en el sistema");
            rellenarMapaConsulta();
        }else{
            $.each(edificios, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_edificio.png',
                        objeto: "edificio",
                        title: "Edificio: " + record.id + "-" + record.nombre_edificio,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Edificio</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Edificio:</b> '+record.id+'-'+record.nombre_edificio+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_edificio" name="ver_edificio" id="ver_edificio" value="Ver Informaci&oacute;n Edificio" title="Ver la informaci&oacute;n del edificio"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+//class="col-xs-6">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    /*'<div class="col-xs-6">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_espacios" name="ver_espacios" id="ver_espacios" value="Ver Espacios" title="Ver los espacios del edificio"/>'+
                    '</div>'+*/
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(canchas, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_cancha.png',
                        objeto: "cancha",
                        title: "Cancha: " + record.id,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Cancha</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Cancha:</b> '+record.id+'<b><br>Uso:</b> '+record.uso+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_cancha" name="ver_cancha" id="ver_cancha" value="Ver Informaci&oacute;n Cancha" title="Ver la informaci&oacute;n de la cancha"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(corredores, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_corredor.png',
                        objeto: "corredor",
                        title: "Corredor: " + record.id,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Corredor</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Corredor:</b> '+record.id+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_corredor" name="ver_corredor" id="ver_corredor" value="Ver Informaci&oacute;n Corredor" title="Ver la informaci&oacute;n del corredor"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(parqueaderos, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_parqueadero.png',
                        objeto: "parqueadero",
                        title: "Parqueadero: " + record.id,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Parqueadero</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Parqueadero:</b> '+record.id+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_parqueadero" name="ver_parqueadero" id="ver_parqueadero" value="Ver Informaci&oacute;n Parqueadero" title="Ver la informaci&oacute;n del parqueadero"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(piscinas, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_piscina.png',
                        objeto: "piscina",
                        title: "Piscina: " + record.id,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Piscina</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Piscina:</b> '+record.id+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_piscina" name="ver_piscina" id="ver_piscina" value="Ver Informaci&oacute;n Piscina" title="Ver la informaci&oacute;nd de la piscina"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(plazoletas, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_plazoleta.png',
                        objeto: "plazoleta",
                        title: "Plazoleta: " + record.id + "-" + record.nombre,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Plazoleta</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Plazoleta:</b> '+record.id+'-'+record.nombre+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_plazoleta" name="ver_plazoleta" id="ver_plazoleta" value="Ver Informaci&oacute;n Plazoleta" title="Ver la informaci&oacute;n de la plazoleta"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(senderos, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_sendero.png',
                        objeto: "sendero",
                        title: "Sendero: " + record.id,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Sendero Peatonal</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Sendero Peatonal:</b> '+record.id+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_sendero" name="ver_sendero" id="ver_sendero" value="Ver Informaci&oacute;n Sendero" title="Ver la informaci&oacute;n del sendero peatonal"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
            $.each(vias, function(index, record) {
                if($.isNumeric(index)) {
                    var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        icon: 'vistas/images/icono_via.png',
                        objeto: "via",
                        title: "Vía: " + record.id,
                        id: record.id,
                        id_campus: record.id_campus,
                        id_sede: record.id_sede
                    });
                    var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n V&iacute;a</h3>'+
                    '<div id="bodyContent">'+
                    '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>V&iacute;a:</b> '+record.id+'</p>'+
                    '<div class="form_button">'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_via" name="ver_via" id="ver_via" value="Ver Informaci&oacute;n V&iacute;a" title="Ver la informaci&oacute;n de la v&iacute;a"/>'+
                    '</div><br>'+
                    '<div class="col-xs-12">'+
                    '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                    '</div>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                    var infoWindow = new google.maps.InfoWindow({
                        content: contentString
                    });
                    marker.addListener('click', function() {
                        if (infoWindowActiva != null) {
                            infoWindowActiva.close();
                        }
                        infoWindow.open(map, marker);
                        infoWindowActiva = infoWindow;
                    });
                    google.maps.event.addListener(mapaConsulta, 'click', function(){
                        infoWindow.close();
                    });
                    marcadores.push(marker);
                    marker.setMap(mapaConsulta);
                    var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    bounds.extend(loc);
                }
            });
        }
        if (edificios.mensaje != null || canchas.mensaje != null || corredores.mensaje != null || parqueaderos.mensaje != null || piscinas.mensaje != null || plazoletas.mensaje != null || senderos.mensaje != null || vias.mensaje != null) {
            mapaConsulta.fitBounds(bounds);
            mapaConsulta.panToBounds(bounds);
            for (var i = 0; i < marcadores.length; i++) {
                google.maps.event.addListener(marcadores[i], 'click',
                function () {
                    mapaConsulta.setZoom(19);
                    mapaConsulta.setCenter(this.getPosition());
                    sedeSeleccionada = this.id_sede;
                    campusSeleccionado = this.id_campus;
                    codigoSeleccionado = this.id;
                    objetoSeleccionado = this.objeto;
                });
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_cancha y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_cancha", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("cancha",informacion);
        var archivos = consultarArchivosObjeto("cancha",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n de la Cancha</h4></div';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div id="dataCancha" class="div_izquierda"><b>C&oacute;digo de la Cancha<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="text" name="id_cancha" id="id_cancha" value="" disabled required/><br>'
        +'<div class="div_izquierda"><b>Uso de la Cancha<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="text" name="uso_cancha" id="uso_cancha" maxlength="100" value="" placeholder="Ej: Fútbol Sala" disabled required/><br>'
        +'<div class="div_izquierda"><b>Material del piso:</b></div>'
        +'<select class="form-control formulario" name="material_piso" id="material_piso" disabled required></select><br>'
        +'<div class="div_izquierda"><b>Tipo de pintura de la demarcaci&oacute;n:</b></div>'
        +'<select class="form-control formulario" name="tipo_pintura" id="tipo_pintura" disabled required></select><br>'
        +'<div class="div_izquierda"><b>Longitud de la demaraci&oacute;n:</b>'
        +'</div>'
        +'</div>';
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_piso",0);
        actualizarSelectTipoObjeto("tipo_pintura",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_cancha").val(record.id);
                $("#uso_cancha").val(record.uso);
                $("#material_piso").val(record.material_piso);
                $("#tipo_pintura").val(record.tipo_pintura);
                $("#longitud_demarcacion").val(record.longitud_demarcacion);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_cancha.png',
                    title: record.id+" - "+record.uso,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_corredor y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_corredor", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("corredor",informacion);
        var dataIluminacion = consultarInformacionObjeto("iluminacion_corredor",informacion);
        var dataInterruptor = consultarInformacionObjeto("interruptor_corredor",informacion);
        var archivos = consultarArchivosObjeto("corredor",informacion);
        console.log(data);
        console.log(dataIluminacion);
        console.log(dataInterruptor);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n del Corredor</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n de las Paredes del Corredor</h5></b></div>'+
        '<div class="div_izquierda"><b>Altura de las paredes:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="altura_pared" id="altura_pared" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Ancho de las paredes:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="ancho_pared" id="ancho_pared" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Material de las paredes:</b></div>'+
        '<select class="form-control formulario" name="material_pared" id="material_pared" disabled required></select><br>'+
        '</div>'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n del Techo del Corredor</h5></b></div>'+
        '<div class="div_izquierda"><b>Largo del techo:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="largo_techo" id="largo_techo" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Ancho del techo:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="ancho_techo" id="ancho_techo" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Material del techo:</b></div>'+
        '<select class="form-control formulario" name="material_techo" id="material_techo" disabled required></select><br>'+
        '</div>'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n del Piso del Corredor</h5></b></div>'+
        '<div class="div_izquierda"><b>Largo del piso:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="largo_piso" id="largo_piso" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Ancho del piso:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="ancho_piso" id="ancho_piso" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Material del piso:</b></div>'+
        '<select class="form-control formulario" name="material_piso" id="material_piso" disabled required></select><br>'+
        '</div>'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n de la Iluminaci&oacute;n del Corredor</h5></b></div>'+
        '<div id="iluminacion">'+
        '<div class="div_izquierda"><b>Tipo de l&aacute;mpara:</b></div>'+
        '<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion" disabled required></select><br>'+
        '<div class="div_izquierda"><b>Cantidad de l&aacute;mparas del tipo:</b></div>'+
        '<input class="form-control formulario" type="number" min="1" name="cantidad_iluminacion" id="cantidad_iluminacion" value="" placeholder="Ej: 2" disabled required/>'+
        '</div>'+
        '</div><br>'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n del Suministro de Energ&iacute;a del Corredor</h5></b></div>'+
        '<div id="suministro_energia">'+
        '<div class="div_izquierda"><b>Tipo de suministro de energ&iacute;a:</b></div>'+
        '<select class="form-control formulario" name="tipo_suministro_energia" id="tipo_suministro_energia" disabled required></select><br>'+
        '<div class="div_izquierda"><b>Tomacorriente:</b></div>'+
        '<select class="form-control formulario" name="tomacorriente" id="tomacorriente" disabled required>'+
        '<option value="" selected="selected">--Seleccionar--</option>'+
        '<option value="regulado">Regulado</option>'+
        '<option value="no regulado">No Regulado</option>'+
        '</select><br>'+
        '<div class="div_izquierda"><b>Cantidad de tomacorrientes del tipo:</b></div>'+
        '<input class="form-control formulario" type="number" min="1" name="cantidad_tomacorrientes" id="cantidad_tomacorrientes" value="" placeholder="Ej: 2" disabled required/>'+
        '</div>'+
        '</div><br>'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n de los Interruptores del Corredor</h5></b></div>'+
        '<div id="interruptor">'+
        '<div class="div_izquierda"><b>Tipo de interruptor:</b></div>'+
        '<select class="form-control formulario" name="tipo_interruptor" id="tipo_interruptor" disabled required></select><br>'+
        '<div class="div_izquierda"><b>Cantidad de interruptores:</b></div>'+
        '<input class="form-control formulario" type="number" min="1" name="cantidad_interruptores" id="cantidad_interruptores" value="" placeholder="Ej: 2" disabled required/>'+
        '</div>'+
        '</div>'+
        '</div>';
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_pared",0);
        actualizarSelectMaterial("material_techo",0);
        actualizarSelectMaterial("material_piso",0);
        actualizarSelectTipoObjeto("tipo_iluminacion",0);
        actualizarSelectTipoObjeto("tipo_interruptor",0);
        actualizarSelectTipoObjeto("tipo_suministro_energia",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_corredor").val(record.id);
                $("#altura_pared").val(record.ancho_pared);
                $("#ancho_pared").val(record.alto_pared);
                $("#material_pared").val(record.material_pared);
                $("#ancho_piso").val(record.ancho_piso);
                $("#largo_piso").val(record.largo_piso);
                $("#material_piso").val(record.material_piso);
                $("#ancho_techo").val(record.ancho_techo);
                $("#largo_techo").val(record.largo_techo);
                $("#material_techo").val(record.material_techo);
                $("#tomacorriente").val(record.tomacorriente);
                $("#tipo_suministro_energia").val(record.tipo_suministro_energia);
                $("#cantidad_tomacorrientes").val(record.cantidad);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_corredor.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $.each(dataIluminacion, function(index, record) {
            if($.isNumeric(index)) {
                if (iluminacionCont == 0) {
                    $("#tipo_iluminacion").val(record.tipo_iluminacion);
                    $("#cantidad_iluminacion").val(record.cantidad);
                }else{
                    var componente = '<div id="iluminacion'+iluminacionCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion'+iluminacionCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="cantidad_iluminacion" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" disabled required/><br>'
                    +'</div>';
                    añadirComponente("iluminacion",componente);
                    actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
                    $("#tipo_iluminacion"+iluminacionCont).val(record.tipo_iluminacion);
                    $("#cantidad_iluminacion"+iluminacionCont).val(record.cantidad);

                }
                iluminacionCont++;
            }
        });
        $.each(dataInterruptor, function(index, record) {
            if($.isNumeric(index)) {
                if (interruptoresCont == 0) {
                    $("#tipo_interruptor").val(record.tipo_interruptor);
                    $("#cantidad_interruptores").val(record.cantidad);
                }else{
                    var componente = '<div id="interruptor'+interruptoresCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="tipo_interruptor" id="tipo_interruptor'+interruptoresCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_interruptores" id="cantidad_interruptores'+interruptoresCont+'" value="" disabled required/><br>'
                    +'</div>';
                    añadirComponente("interruptor",componente);
                    actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
                    $("#tipo_interruptor"+interruptoresCont).val(record.tipo_interruptor);
                    $("#cantidad_interruptores"+interruptoresCont).val(record.cantidad);
                }
                interruptoresCont++;
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_parqueadero y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_parqueadero", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("parqueadero",informacion);
        var archivos = consultarArchivosObjeto("parqueadero",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n del Parqueadero</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="div_izquierda" ><b>C&oacute;digo del Parqueadero<font color="red" >*</font>:</b></div>'+
        '<input class="form-control formulario"  type="text"  name="id_parqueadero"  id="id_parqueadero"  maxlength="50" value=""  placeholder="Ej: Parqueadero 1"  disabled required/><br>'+
        '<div class="div_izquierda" ><b>Capacidad del Parqueadero:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="capacidad"  id="capacidad"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">autos</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Ancho del Parqueadero:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="ancho"  id="ancho"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Largo del Parqueadero:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="largo"  id="largo"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Material del piso:</b></div>'+
        '<select class="form-control formulario"  name="material_piso"  id="material_piso"  disabled required></select><br>'+
        '<div class="div_izquierda" ><b>Tipo de pintura de la demarcaci&oacute;n:</b></div>'+
        '<select class="form-control formulario"  name="tipo_pintura"  id="tipo_pintura"  disabled required></select><br>'+
        '<div class="div_izquierda" ><b>Longitud de la demarcaci&oacute;n:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="longitud_demarcacion"  id="longitud_demarcacion"  min="1" class="form-control" value=""  placeholder="Ej: 20"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div>';+
        '</div>'
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_piso",0);
        actualizarSelectTipoObjeto("tipo_pintura",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_parqueadero").val(record.id);
                $("#capacidad").val(record.capacidad);
                $("#ancho").val(record.ancho);
                $("#largo").val(record.largo);
                $("#material_piso").val(record.material_piso);
                $("#tipo_pintura").val(record.tipo_pintura_demarcacion);
                $("#longitud_demarcacion").val(record.longitud_demarcacion);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_parqueadero.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_piscina y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_piscina", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("piscina",informacion);
        var archivos = consultarArchivosObjeto("piscina",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n de la Piscina</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="div_izquierda" ><b>C&oacute;digo del Piscina<font color="red" >*</font>:</b></div>'+
        '<input class="form-control formulario"  type="text"  name="id_piscina"  id="id_piscina"  value=""  disabled required/><br>'+
        '<div class="div_izquierda" ><b>Profundidad de la Piscina:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="alto"  id="alto"  min="1" class="form-control" value=""  placeholder="Ej: 2"  disabled required>'+
        '<span class="input-group-addon">cm</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Ancho de la Piscina:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="ancho"  id="ancho"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">cm</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Largo de la Piscina:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="largo"  id="largo"  min="1" class="form-control" value=""  placeholder="Ej: 80"  disabled required>'+
        '<span class="input-group-addon">cm</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Cantidad de Puntos Hidraulicos de la Piscina:</b></div>'+
        '<input class="form-control formulario"  type="number" name="cantidad_puntos_hidraulicos"  id="cantidad_puntos_hidraulicos"  min="1" class="form-control" value=""  placeholder="Ej: 10"  disabled required>';+
        '</div>'
        añadirComponente("dataObjeto",componente);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_piscina").val(record.id);
                $("#alto").val(record.alto);
                $("#ancho").val(record.ancho);
                $("#largo").val(record.largo);
                $("#cantidad_puntos_hidraulicos").val(record.cantidad_punto_hidraulico);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_piscina.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_plazoleta y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_plazoleta", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("plazoleta",informacion);
        var dataIluminacion = consultarInformacionObjeto("iluminacion_plazoleta",informacion);
        var archivos = consultarArchivosObjeto("plazoleta",informacion);
        console.log(data);
        console.log(dataIluminacion);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n de la Plazoleta</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="div_izquierda" ><b>C&oacute;digo de la Plazoleta<font color="red" >*</font>:</b></div>'+
        '<input class="form-control formulario"  type="text"  name="id_plazoleta"  id="id_plazoleta"  value=""  disabled required/><br>'+
        '<div class="div_izquierda" ><b>Nombre de la Plazoleta<font color="red" >*</font>:</b></div>'+
        '<input class="form-control formulario"  type="text"  name="nombre"  id="nombre"  maxlength="10" value=""  placeholder="Ej: Plazoleta Ingenierías"  disabled required/><br>'+
        '<div class="form-group" >'+
        '<div><b><h5>Informaci&oacute;n de la Iluminaci&oacute;n de la Plazoleta</h5></b></div>'+
        '<div id="iluminacion" >'+
        '<div class="div_izquierda" ><b>Tipo de l&aacute;mpara:</b></div>'+
        '<select class="form-control formulario"  name="tipo_iluminacion"  id="tipo_iluminacion"  disabled required></select><br>'+
        '<div class="div_izquierda" ><b>Cantidad de l&aacute;mparas del tipo:</b></div>'+
        '<input class="form-control formulario"  type="number"  min="1"  name="cantidad_iluminacion"  id="cantidad_iluminacion"  value=""  placeholder="Ej: 2"  disabled required/>'+
        '</div>'+
        '<div id="botones_anadir_iluminacion" style="display:none">'+
        '<br><input type="submit"  class="btn btn-primary btn-lg btn-agregar"  name="añadir_iluminacion"  id="añadir_iluminacion"  value="Añadir Tipo Iluminaci&oacute;n"  title="Añadir Tipo de Iluminaci&oacute;n" />'+
        '<input type="submit"  class="btn btn-primary btn-lg btn-agregar"  name="eliminar_iluminacion"  id="eliminar_iluminacion"  value="Eliminar Tipo Iluminaci&oacute;n"  title="Eliminar Tipo de Iluminaci&oacute;n"  disabled/>'+
        '</div>'+
        '</div>'+
        '</div>';
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_piso",0);
        actualizarSelectTipoObjeto("tipo_iluminacion",0);
        actualizarSelectTipoObjeto("tipo_pintura",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_plazoleta").val(record.id);
                $("#nombre").val(record.nombre);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_plazoleta.png',
                    title: record.id+" - "+record.nombre,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $.each(dataIluminacion, function(index, record) {
            if($.isNumeric(index)) {
                if (iluminacionCont == 0) {
                    $("#tipo_iluminacion").val(record.tipo_iluminacion);
                    $("#cantidad_iluminacion").val(record.cantidad);
                }else{
                    var componente = '<div id="iluminacion'+iluminacionCont+'">'
                    +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion'+iluminacionCont+'" disabled required></select><br>'
                    +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="cantidad_iluminacion" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" disabled required/><br>'
                    +'</div>';
                    añadirComponente("iluminacion",componente);
                    actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
                    $("#tipo_iluminacion"+iluminacionCont).val(record.tipo_iluminacion);
                    $("#cantidad_iluminacion"+iluminacionCont).val(record.cantidad);
                }
                iluminacionCont++;
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_sendero y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_sendero", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("sendero",informacion);
        var archivos = consultarArchivosObjeto("sendero",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n del Sendero Peatonal</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="div_izquierda"><b>C&oacute;digo del Sendero<font color="red"> *</font>:</b></div>'+
        '<input class="form-control formulario"  type="text"  name="id_sendero"  id="id_sendero"  value=""  disabled required/><br>'+
        '<div class="div_izquierda"> <b>Longitud del Sendero:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="longitud"  id="longitud"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"> <b>Ancho del Sendero:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="ancho"  id="ancho"  min="1" class="form-control" value=""  placeholder="Ej: 10"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"> <b>Material del piso:</b></div>'+
        '<select class="form-control formulario"  name="material_piso"  id="material_piso"  disabled required></select><br>'+
        '<div class="form-group"> '+
        '<div><b><h5>Informaci&oacute;n de la Iluminaci&oacute;n del Sendero</h5></b></div>'+
        '<div id="iluminacion"> '+
        '<div class="div_izquierda"> <b>Tipo de l&aacute;mpara:</b></div>'+
        '<select class="form-control formulario"  name="tipo_iluminacion"  id="tipo_iluminacion"  disabled required></select><br>'+
        '<div class="div_izquierda"> <b>Cantidad:</b></div>'+
        '<input class="form-control formulario"  type="number" name="cantidad_iluminacion"  id="cantidad_iluminacion"  min="1"  maxlength="10" class="form-control" value=""  placeholder="Ej: 10"  disabled required><br>'+
        '<div class="div_izquierda"> <b>C&oacute;digo del poste:</b></div>'+
        '<input class="form-control formulario"  type="number"  min="1"  name="codigo_poste"  id="codigo_poste"  value=""  placeholder="Ej: 10320"  disabled required/><br>'+
        '</div>'+
        '</div>'+
        '<div class="form-group">'+
        '<div><b><h5>Informaci&oacute;n de la Cubierta del Sendero</h5></b></div>'+
        '<div id="cubierta">'+
        '<div class="div_izquierda"> <b>Ancho de la cubierta:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="ancho_cubierta"  id="ancho_cubierta"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"> <b>Largo de la cubierta:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="largo_cubierta"  id="largo_cubierta"  min="1" class="form-control" value=""  placeholder="Ej: 30"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"> <b>Materia de la cubierta:</b></div>'+
        '<select class="form-control formulario"  name="material_cubierta"  id="material_cubierta"  disabled required></select>'+
        '</div>'+
        '</div>'+
        '</div>';
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_cubierta",0);
        actualizarSelectTipoObjeto("tipo_iluminacion",0);
        actualizarSelectMaterial("material_piso",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_sendero").val(record.id);
                $("#longitud").val(record.longitud);
                $("#ancho").val(record.ancho);
                $("#material_piso").val(record.material_piso);
                $("#tipo_iluminacion").val(record.tipo_iluminacion);
                $("#cantidad_iluminacion").val(record.cantidad);
                $("#codigo_poste").val(record.codigo_poste);
                $("#ancho_cubierta").val(record.ancho_cubierta);
                $("#largo_cubierta").val(record.largo_cubierta);
                $("#material_cubierta").val(record.material_cubierta);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_sendero.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_via y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_via", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado;
        var id = limpiarCadena(codigoSeleccionado);
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = id;
        var data = consultarInformacionObjeto("via",informacion);
        var archivos = consultarArchivosObjeto("via",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n de la Vía</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="div_izquierda" ><b>C&oacute;digo de la V&iacute;a<font color="red" >*</font>:</b></div>'+
        '<input class="form-control formulario"  type="text"  name="id_via"  id="id_via"  maxlength="10" value=""  placeholder="Ej: 1"  disabled required/><br>'+
        '<div class="div_izquierda" ><b>Tipo de pintura de la demarcaci&oacute;n:</b></div>'+
        '<select class="form-control formulario"  name="tipo_pintura"  id="tipo_pintura"  disabled required></select><br>'+
        '<div class="div_izquierda" ><b>Longitud de la demarcaci&oacute;n:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario"  type="number" name="longitud_demarcacion"  id="longitud_demarcacion"  min="1" class="form-control" value=""  placeholder="Ej: 20"  disabled required>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda" ><b>Material del piso:</b></div>'+
        '<select class="form-control formulario"  name="material_piso"  id="material_piso"  disabled required></select>'+
        '</div>';
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_piso",0);
        actualizarSelectTipoObjeto("tipo_pintura",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_via").val(record.id);
                $("#tipo_pintura").val(record.tipo_pintura);
                $("#longitud_demarcacion").val(record.longitud_demarcacion);
                $("#material_piso").val(record.material_piso);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_via.png',
                    title: record.id,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón ver_edificio y se
     * realiza la operacion correspondiente.
    **/
    $("#contenido").on("click", ".ver_edificio", function(){
        var informacion =  {};
        var sede = sedeSeleccionada;
        var campus = campusSeleccionado
        var id = codigoSeleccionado;
        informacion['nombre_sede'] = sede;
        informacion['nombre_campus'] = campus;
        informacion['id'] = limpiarCadena(id);
        var data = consultarInformacionObjeto("edificio",informacion);
        var archivos = consultarArchivosObjeto("edificio",informacion);
        console.log(data);
        console.log(archivos);
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            marcadoresModificacion[i].setMap(null);
        }
        var componente = '<div id="tituloObjeto"><h4 id="tituloCancha" class="modal-title">Informaci&oacute;n del Edificio</h4></div>';
        añadirComponente("tituloModalMapa",componente);
        componente = '<div id="informacionObjeto">'+
        '<div class="div_izquierda"><b>C&oacute;digo del Edificio<font color="red">*</font>:</b></div>'+
        '<input class="form-control formulario" type="text" name="id_edificio" id="id_edificio" value="" placeholder="Ej: 331" disabled required/><br>'+
        '<div class="div_izquierda"><b>Nombre del Edificio<font color="red">*</font>:</b></div>'+
        '<input class="form-control formulario" type="text" name="nombre_edificio" id="nombre_edificio" value="" placeholder="Ej: Ingenier&iacute;as" disabled required/><br>'+
        '<div class="div_izquierda"><b>N&uacute;mero de Pisos del Edificio<font color="red">*</font>:</b></div>'+
        '<input class="form-control formulario" type="number" min="1" name="pisos_edificio" id="pisos_edificio" value="" placeholder="Ej: 4" disabled required/><br>'+
        '<div class="div_izquierda"><b>¿El Edificio tiene terraza?<font color="red">*</font></b></div>'+
        '<label class="radio-inline"><input type="radio" name="terraza" value="true" disabled>S&iacute;</label>'+
        '<label class="radio-inline"><input type="radio" name="terraza" value="false" disabled>No</label><br>'+
        '<div class="div_izquierda"><b>¿El Edificio tiene sotano?<font color="red">*</font></b></div>'+
        '<label class="radio-inline"><input type="radio" name="sotano" value="true" disabled>S&iacute;</label>'+
        '<label class="radio-inline"><input type="radio" name="sotano" value="false" disabled>No</label><br><br>'+
        '<div><b><h5>Informaci&oacute;n de la Fachada del Edificio</h5></b></div>'+
        '<div class="div_izquierda"><b>Ancho de la fachada:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="ancho_fachada" id="ancho_fachada" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Alto de la fachada:</b></div>'+
        '<div class="input-group">'+
        '<input class="form-control formulario" type="number" min="1" name="alto_fachada" id="alto_fachada" value="" placeholder="Ej: 4" disabled required/>'+
        '<span class="input-group-addon">m</span>'+
        '</div><br>'+
        '<div class="div_izquierda"><b>Material de la fachada (m):</b></div>'+
        '<select class="form-control formulario" name="material_fachada" id="material_fachada" disabled required></select>'+
        '</div>';
        añadirComponente("dataObjeto",componente);
        actualizarSelectMaterial("material_fachada",0);
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                $("#nombre_sede").attr('name',record.id_sede);
                $("#nombre_sede").val(record.nombre_sede);
                $("#nombre_campus").attr('name',record.id_campus);
                $("#nombre_campus").val(record.nombre_campus);
                $("#id_edificio").val(record.id);
                $("#nombre_edificio").val(record.nombre);
                $("#pisos_edificio").val(record.numero_pisos);
                $("input[name=terraza][value="+ record.terraza + "]").prop('checked', true);
                $("input[name=sotano][value="+ record.sotano + "]").prop('checked', true);
                $("#ancho_fachada").val(record.ancho_fachada);
                $("#alto_fachada").val(record.alto_fachada);
                $("#material_fachada").val(record.material_fachada);
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                coordsMapaModificacion = myLatlng;
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    icon: 'vistas/images/icono_edificio.png',
                    title: record.id+" - "+record.nombre,
                    id: record.id,
                    id_sede: record.id_sede,
                    id_campus: record.id_campus
                });
                marcadoresModificacion.push(marker);
                marker.setMap(mapaModificacion);
            }
        });
        $("#myCarousel").hide();
        for (var i = 0; i < numeroFotos; i++) {
            eliminarComponente("slide_carrusel");
            eliminarComponente("item_carrusel");
        }
        for (var i = 0; i < numeroPlanos; i++) {
            eliminarComponente("plano");
        }
        numeroFotos = 0;
        numeroPlanos = 0;
        $.each(archivos, function(index, record) {
            if($.isNumeric(index)) {
                if (record.tipo == 'foto') {
                    var componente, componente2;
                    if (numeroFotos == 0) {
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                        componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }else{
                        componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>'
                        componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                    }
                    añadirComponente("indicadores_carrusel",componente);
                    añadirComponente("fotos_carrusel",componente2);
                    numeroFotos++;
                    $("#myCarousel").show();
                }else{
                    var componente = '<div id="plano" class="div_izquierda">'
                    +'<a target="_blank" href="archivos/planos/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'">'
                    +'<span>'+record.nombre+'</span>'
                    +'</a></div>';
                    numeroPlanos++;
                    añadirComponente("planos",componente);
                }
            }
        });
        var componente, componente2;
        if (numeroFotos == 0) {
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'" class="active"></li>';
            componente2 = '<div id="item_carrusel" class="item active carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }else{
            componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+numeroFotos+'"></li>';
            componente2 = '<div id="item_carrusel" class="item carouselImg">'
            +'<div class="fileUpload btn boton_agregar_foto">'
            +'<img id="icono_foto" src="vistas/images/icono_foto.png" title="A&ntilde;adir fotos" />'
            +'<input id="fileInputVisible" placeholder="Agregar fotos" multiple disabled="disabled" accept="image/*" multiple/>'
            +'<input id="fileInputOculto" type="file" class="upload" accept="image/*" multiple/>'
            +'</div>'
            +'</div>';
        }
        var componentePlano = '<div id="plano" class="div_izquierda">'
        +'<span>Agregar un plano</span><br>'
        +'<input class="form-control formulario agregar_archivos" type="file" id="planos[]" name="planos[]" multiple accept=".dwg,.dxf">'
        +'<br></div>';
        numeroPlanos++;
        añadirComponente("planos",componentePlano);
        numeroFotos++;
        añadirComponente("indicadores_carrusel",componente);
        añadirComponente("fotos_carrusel",componente2);
        $("#myCarousel").show();
        for (var i = 0; i < marcadoresModificacion.length; i++) {
            google.maps.event.addListener(marcadoresModificacion[i], 'click',
            function () {
                mapaModificacion.setZoom(18);
                mapaModificacion.setCenter(this.getPosition());
            });
        }
        $("#divDialogConsultaMapa").modal('show');
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_informacion_adicional y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_informacion_adicional").click(function (e){
        $("#informacion-adicional").show();
        $("#añadir_informacion_adicional").attr('disabled',true);
        $('#eliminar_informacion_adicional').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_informacion_adicional y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_informacion_adicional").click(function (e){
        $("#informacion-adicional").hide();
        $("#eliminar_informacion_adicional").attr('disabled',true);
        $('#añadir_informacion_adicional').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_iluminacion y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_iluminacion").click(function (e){
        if (iluminacionCont == 0) {
            iluminacionCont = 1;
        }
        var componente = '<div id="iluminacion'+iluminacionCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_iluminacion'+iluminacionCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" required/>'
        +'</div>';
        añadirComponente("iluminacion",componente);
        actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
        $('#eliminar_iluminacion').removeAttr("disabled");
        iluminacionCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_iluminacion y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_iluminacion").click(function (e){
        iluminacionCont--;
        tipoIluminacionEliminar.push($("#tipo_iluminacion"+iluminacionCont).val());
        eliminarComponente("iluminacion"+iluminacionCont);
        if(iluminacionCont == 1){
            $("#eliminar_iluminacion").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_tomacorriente y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_tomacorriente").click(function (e){
        if (tomacorrientesCont == 0) {
            tomacorrientesCont = 1;
        }
        var componente = '<div id="suministro_energia'+tomacorrientesCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de suministro de energía ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_suministro_energia'+tomacorrientesCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Tomacorriente ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tomacorriente'+tomacorrientesCont+'" required>'
        +'<option value="seleccionar" selected="selected">--Seleccionar--</option>'
        +'<option value="regulado">Regulado</option>'
        +'<option value="no regulado">No Regulado</option>'
        +'</select><br>'
        +'<div class="div_izquierda"><b>Cantidad de tomacorrientes del tipo ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" required/>'
        +'</div>';
        añadirComponente("suministro_energia",componente);
        actualizarSelectTipoObjeto("tipo_suministro_energia",tomacorrientesCont);
        $('#eliminar_tomacorriente').removeAttr("disabled");
        tomacorrientesCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_tomacorriente y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_tomacorriente").click(function (e){
        tomacorrientesCont--;
        tipoSuministroEnergiaEliminar.push($("#tipo_suministro_energia"+tomacorrientesCont).val());
        tomacorrienteEliminar.push($("#tomacorriente"+tomacorrientesCont).val());
        eliminarComponente("suministro_energia"+tomacorrientesCont);
        if(tomacorrientesCont == 1){
            $("#eliminar_tomacorriente").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_puerta y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_puerta").click(function (e){
        if (puertasCont == 0) {
            puertasCont = 1;
        }
        var componente = '<div id="puerta'+puertasCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puertas'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="material_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Tipo de cerradura ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_cerradura'+puertasCont+'" required></select><br>'
        //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="añadir_tipo_cerradura" id="añadir_tipo_cerradura'+puertasCont+'" value="Añadir Tipo" title="Añadir Tipo Cerradura"/>'
        //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="eliminar_tipo_cerradura" id="eliminar_tipo_cerradura'+puertasCont+'" value="Eliminar Tipo" title="Eliminar Tipo Cerradura" disabled/>'
        +'<div class="div_izquierda"><b>¿La Puerta tiene gato? ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="true">S&iacute;</label>'
        +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="false">No</label><br>'
        +'<div class="div_izquierda"><b>Material del marco ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="material_marco_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="ancho_puerta'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="alto_puerta'+puertasCont+'" value="" required/>'
        +'</div>';
        añadirComponente("puerta",componente);
        actualizarSelectMaterial("material_marco_puerta",puertasCont);
        actualizarSelectMaterial("material_puerta",puertasCont);
        actualizarSelectTipoObjeto("tipo_puerta",puertasCont);
        $('#eliminar_puerta').removeAttr("disabled");
        puertasCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_puerta y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_puerta").click(function (e){
        puertasCont--;
        tipoPuertaEliminar.push($("#tipo_puerta"+puertasCont).val());
        materialPuertaEliminar.push($("#material_puerta"+puertasCont).val());
        tipoCerraduraEliminar.push($("#tipo_cerradura"+puertasCont).val());
        materialMarcoPuertaEliminar.push($("#material_marco_puerta"+puertasCont).val());
        eliminarComponente("puerta"+puertasCont);
        if(puertasCont == 1){
            $("#eliminar_puerta").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_ventana y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_ventana").click(function (e){
        if (ventanasCont == 0) {
            ventanasCont = 1;
        }
        var componente = '<div id="ventana'+ventanasCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_ventanas'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="material_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="ancho_ventana'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="alto_ventana'+ventanasCont+'" value="" required/>'
        +'</div>';
        añadirComponente("ventana",componente);
        actualizarSelectMaterial("material_ventana",ventanasCont);
        actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
        $('#eliminar_ventana').removeAttr("disabled");
        ventanasCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_ventana y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_ventana").click(function (e){
        ventanasCont--;
        tipoVentanaEliminar.push($("#tipo_ventana"+ventanasCont).val());
        materialVentanaEliminar.push($("#material_ventana"+ventanasCont).val());
        eliminarComponente("ventana"+ventanasCont);
        if(ventanasCont == 1){
            $("#eliminar_ventana").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_interruptor y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_interruptor").click(function (e){
        if (interruptoresCont == 0) {
            interruptoresCont = 1;
        }
        var componente = '<div id="interruptor'+interruptoresCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_interruptor'+interruptoresCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_interruptores'+interruptoresCont+'" value="" required/>'
        +'</div>';
        añadirComponente("interruptor",componente);
        actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
        $('#eliminar_interruptor').removeAttr("disabled");
        interruptoresCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_interruptor y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_interruptor").click(function (e){
        interruptoresCont--;
        tipoInterruptorEliminar.push($("#tipo_interruptor"+interruptoresCont).val());
        eliminarComponente("interruptor"+interruptoresCont);
        if(interruptoresCont == 1){
            $("#eliminar_interruptor").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_punto_sanitario y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_punto_sanitario").click(function (e){
        if (puntosSanitariosCont == 0) {
            puntosSanitariosCont = 1;
        }
        var componente = '<div id="punto_sanitario'+puntosSanitariosCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_punto_sanitario'+puntosSanitariosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" required/>'
        +'</div>';
        añadirComponente("punto_sanitario",componente);
        actualizarSelectTipoObjeto("tipo_punto_sanitario",puntosSanitariosCont);
        $('#eliminar_punto_sanitario').removeAttr("disabled");
        puntosSanitariosCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_punto_sanitario").click(function (e){
        puntosSanitariosCont--;
        tipoPuntoSanitarioEliminar.push($("#tipo_punto_sanitario"+puntosSanitariosCont).val());
        eliminarComponente("punto_sanitario"+puntosSanitariosCont);
        if(puntosSanitariosCont == 1){
            $("#eliminar_punto_sanitario").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_punto_sanitario y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_orinal").click(function (e){
        if (orinalesCont == 0) {
            orinalesCont = 1;
        }
        var componente = '<div id="orinal'+orinalesCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de orinal ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_orinal'+orinalesCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de orinales del tipo ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_orinales'+orinalesCont+'" value="" required/>'
        +'</div>';
        añadirComponente("orinal",componente);
        actualizarSelectTipoObjeto("tipo_orinal",orinalesCont);
        $('#eliminar_orinal').removeAttr("disabled");
        orinalesCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_punto_sanitario y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_orinal").click(function (e){
        orinalesCont--;
        tipoOrinalEliminar.push($("#tipo_orinal"+orinalesCont).val());
        eliminarComponente("orinal"+orinalesCont);
        if(orinalesCont == 1){
            $("#eliminar_orinal").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_lavamanos y se
     * realiza la operacion correspondiente.
    **/
    $("#añadir_lavamanos").click(function (e){
        if (lavamanosCont == 0) {
            lavamanosCont = 1;
        }
        var componente = '<div id="lavamanos'+lavamanosCont+'">'
        +'<br><div class="div_izquierda"><b>Tipo de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="" id="tipo_lavamanos'+lavamanosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="" id="cantidad_lavamanos'+lavamanosCont+'" value="" required/>'
        +'</div>'
        +'</div>';
        añadirComponente("lavamanos",componente);
        actualizarSelectTipoObjeto("tipo_lavamanos",lavamanosCont);
        $('#eliminar_lavamanos').removeAttr("disabled");
        lavamanosCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_lavamanos y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_lavamanos").click(function (e){
        lavamanosCont--;
        tipoLavamanosEliminar.push($("#tipo_lavamanos"+lavamanosCont).val());
        eliminarComponente("lavamanos"+lavamanosCont);
        if(lavamanosCont == 1){
            $("#eliminar_lavamanos").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_proveedor y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_proveedor").click(function (e){
        if (proveedoresCont == 0) {
            proveedoresCont = 1;
        }
        var componente = '<div id="proveedor'+proveedoresCont+'">'
        +'<div class="div_izquierda"><b>Proveedor ('+(proveedoresCont+1)+') del Art&iacute;culo:</b></div>'
        +'<select class="form-control formulario" name="proveedor_articulo" id="proveedor_articulo'+proveedoresCont+'" required></select><br>'
        +'</div>';
        añadirComponente("proveedor",componente);
        actualizarSelectProveedores(proveedoresCont);
        $('#eliminar_proveedor').removeAttr("disabled");
        proveedoresCont++;
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_proveedor y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_proveedor").click(function (e){
        proveedoresCont--;
        nombreProveedor.push($("#proveedor_articulo"+proveedoresCont).val());
        eliminarComponente("proveedor"+proveedoresCont);
        if(proveedoresCont == 1){
            $("#eliminar_proveedor").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón añadir_articulo y se
     * realiza la operacion correspondiente.
    */
    $("#añadir_articulo").click(function (e){
        anadirArticulosCont++;
        var componente = '<div id="articulo'+anadirArticulosCont+'">'
        +'<br><div class="div_izquierda"><b>Nombre del Art&iacute;culo ('+(anadirArticulosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="nombre_articulo" id="nombre_articulo'+anadirArticulosCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Artículos a A&ntilde;adir o Eliminar ('+(anadirArticulosCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" name="cantidad" id="cantidad'+anadirArticulosCont+'" value="" placeholder="Ej: 10" required/>'
        +'</div>';
        añadirComponente("articulo",componente);
        actualizarSelectArticulo(anadirArticulosCont);
        $('#eliminar_articulo').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando se da click en el botón eliminar_articulo y se
     * realiza la operacion correspondiente.
    */
    $("#eliminar_articulo").click(function (e){
        eliminarComponente("articulo"+anadirArticulosCont);
        anadirArticulosCont--;
        if(anadirArticulosCont == 0){
            $("#eliminar_articulo").attr('disabled',true);
        }
    });

    /**
     * Se captura el evento cuando se modifica el valor del radio button tiene_espacio_padre
     * y se actualiza el selector de pisos.
    **/
    $("#form_espacio_padre").change(function (e) {
        var espacioPadre = $('input[name="tiene_espacio_padre"]:checked').val();
        if (espacioPadre == "true") {
            $('#div_espacio_padre').show();
        }else{
            $('#div_espacio_padre').hide();
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_archivos y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_archivos").click(function (e){
        if (window.confirm("¿Guardar los archivos seleccionados?")) {
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fileInputOculto");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroPlanos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var informacion = {};
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
                var tipoObjeto;
                if(URLactual['href'].indexOf('consultar_campus') >= 0){
                    tipoObjeto = "campus";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = limpiarCadena($("#nombre_campus").val());
                }else if(URLactual['href'].indexOf('consultar_edificio') >= 0){
                    tipoObjeto = "edificio";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_edificio"] = $("#edificio_search").val();
                }else if(URLactual['href'].indexOf('consultar_cancha') >= 0){
                    tipoObjeto = "cancha";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_cancha"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
                    tipoObjeto = "corredor";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_corredor"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_cubierta') >= 0){
                    tipoObjeto = "cubierta";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["nombre_edificio"] = $("#edificio_search").val();
                    informacion["piso"] = $("#pisos_search").val();
                }else if(URLactual['href'].indexOf('consultar_gradas') >= 0){
                    tipoObjeto = "gradas";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["nombre_edificio"] = $("#edificio_search").val();
                    informacion["piso_inicio"] = $("#pisos_search").val();
                }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
                    tipoObjeto = "parqueadero";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_parqueadero"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
                    tipoObjeto = "piscina";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_piscina"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
                    tipoObjeto = "plazoleta";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_plazoleta"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
                    tipoObjeto = "sendero";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_sendero"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_via') >= 0){
                    tipoObjeto = "via";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["id_via"] = $("#codigo_search").val();
                }else if(URLactual['href'].indexOf('consultar_espacio') >= 0){
                    tipoObjeto = "espacio";
                    informacion["nombre_sede"] = $("#sede_search").val();
                    informacion["nombre_campus"] = $("#campus_search").val();
                    informacion["nombre_edificio"] = $("#edificio_search").val();
                    informacion["id_espacio"] = $("#espacio_search").val();
                }else if(URLactual['href'].indexOf('consultar_mapa') >= 0){
                    tipoObjeto = objetoSeleccionado;
                    console.log(tipoObjeto);
                    informacion["nombre_sede"] = sedeSeleccionada;
                    informacion["nombre_campus"] = campusSeleccionado;
                    if (tipoObjeto != "campus") {
                        if (tipoObjeto != "campus") {
                            if (tipoObjeto == "cancha") {
                                informacion["id_cancha"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "corredor") {
                                informacion["id_corredor"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "cubierta") {
                                informacion["id_cubierta"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "edificio") {
                                informacion["id_edificio"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "gradas") {
                                informacion["id_gradas"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "parqueadero") {
                                informacion["id_parqueadero"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "piscina") {
                                informacion["id_piscina"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "plazoleta") {
                                informacion["id_plazoleta"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "sendero") {
                                informacion["id_sendero"] = limpiarCadena(codigoSeleccionado);
                            }else if (tipoObjeto == "via") {
                                informacion["id_via"] = limpiarCadena(codigoSeleccionado);
                            }
                        }
                    }
                }
                arregloFotos.append(tipoObjeto,JSON.stringify(informacion));
                arregloPlanos.append(tipoObjeto,JSON.stringify(informacion));
                var resultadoPlanos = guardarPlanos(tipoObjeto,arregloPlanos);
                var resultadoFotos = guardarFotos(tipoObjeto,arregloFotos);
                console.log(informacion);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if (fotos.files.length > 1 || planos.files.length > 1) {
                        alert("Los archivos se han guardado correctamente");
                    }else if (fotos.files.length == 1 || planos.files.length == 1) {
                        alert("El archivo se ha guardado correctamente");
                    }
                    $("#sede_search").val("").change();
                    $("#divDialogConsulta").modal('hide');
                    $("#divDialogConsultaMapa").modal('hide');
                    planos.value = "";
                    fotos.value = "";
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_fotos y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_fotos").click(function (e){
        if (window.confirm("¿Guardar las fotos seleccionados?")) {
            var fotos = document.getElementById("fileInputOculto");
            var aux = (numeroFotos-1) + fotos.files.length;
            if (aux <= 20) {
                var arregloFotos = new FormData();
                var informacion = {};
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
                var tipoObjeto;
                if(URLactual['href'].indexOf('consultar_aire') >= 0){
                    tipoObjeto = "aire";
                    informacion["id_aire"] = $("#id_aire").val();
                }
                arregloFotos.append(tipoObjeto,JSON.stringify(informacion));
                var resultadoFotos = guardarFotos(tipoObjeto,arregloFotos);
                console.log(informacion);
                console.log(resultadoFotos);
                var mensaje = "";
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
                }else{
                    if (fotos.files.length > 1) {
                        alert("Los archivos se han guardado correctamente");
                    }else if (fotos.files.length == 1) {
                        alert("El archivo se ha guardado correctamente");
                    }
                    $("#sede_search").val("").change();
                    $("#divDialogConsulta").modal('hide');
                    fotos.value = "";
                }
            }else{
                alert("ERROR. El número máximo de fotos es 20");
                fotos.focus();
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_sede y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_sede").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la sede?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var nombreSede = limpiarCadena($("#nombre_sede").val());
            if (nombreSede != "") {
                informacion["id_sede"] = idSede;
                informacion["nombre_sede"] = nombreSede;
                var data = modificarObjeto("sede",informacion);
                console.log(informacion);
                console.log(data);
                if(data.verificar){
                    alert(data.mensaje);
                    $("#divDialogConsulta").modal('hide');
                    actualizarSelectSede();
                }
            }else{
                alert("ERROR. Ingrese el nombre de la sede");
                $("#nombre_sede").focus();
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_campus y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_campus").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del campus?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var nombreCampus = limpiarCadena($("#nombre_campus").val());
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (nombreCampus == "") {
                alert("ERROR. Ingrese el nombre del campus");
                $("#nombre_campus").focus();
            }else{
                if (aux <= 20 || aux2 <= 5) {
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    var info = {};
                    for (var i=0;i<fotos.files.length;i++) {
                        var foto = fotos.files[i];
                        if (foto.size > 2000000) {
                            alert('La foto: "'+foto.name+"' es muy grande");
                        }else{
                            var nombreArchivo = foto.name;
                            if(nombreArchivo.length > 50){
                                nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                            }
                            console.log(nombreArchivo);
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
                    informacion["id_sede"] = idSede;
                    informacion["id_campus"] = idCampus;
                    informacion["nombre_campus"] = nombreCampus;
                    info["nombre_sede"] = idSede;
                    info["nombre_campus"] = nombreCampus;
                    var arregloFotosEliminar = {};
                    var arregloPlanosEliminar = {};
                    arregloFotosEliminar["id_sede"] = idSede;
                    arregloFotosEliminar["id"] = idCampus;
                    arregloFotosEliminar["nombre"] = fotosEliminar;
                    arregloFotosEliminar["tipo"] = "foto";
                    arregloPlanosEliminar["id_sede"] = idSede;
                    arregloPlanosEliminar["id"] = idCampus;
                    arregloPlanosEliminar["nombre"] = planosEliminar;
                    arregloPlanosEliminar["tipo"] = "plano";
                    for (var i = 0; i < marcadoresModificacion.length; i++) {
                        coordenadas = marcadoresModificacion[i].getPosition();
                    }
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    arregloFotos.append("campus",JSON.stringify(info));
                    arregloPlanos.append("campus",JSON.stringify(info));
                    var data = modificarObjeto("campus",informacion);
                    var dataEliminarFotos = eliminarObjeto("archivo_campus",arregloFotosEliminar);
                    var dataEliminarPlanos = eliminarObjeto("archivo_campus",arregloPlanosEliminar);
                    var resultadoPlanos = guardarPlanos("campus",arregloPlanos);
                    var resultadoFotos = guardarFotos("campus",arregloFotos);
                    console.log(info);
                    console.log(informacion);
                    console.log(data);
                    console.log(dataEliminarFotos);
                    console.log(dataEliminarPlanos);
                    console.log(resultadoPlanos);
                    console.log(resultadoFotos);
                    var mensaje = "";
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
                    if (resultadoPlanos.length != 0) {
                        for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                            console.log(resultadoPlanos.verificar[i]);
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
                    if (mensaje.substring(0,1) != "") {
                        alert(mensaje);
                    }else{
                        if(data.verificar){
                            alert(data.mensaje);
                            $("#sede_search").val("").change();
                            $("#divDialogConsulta").modal('hide');
                            planos.value = "";
                            fotos.value = "";
                            marcadores = [];
                        }
                    }
                }else{
                    if (aux2 <= 5) {
                        alert("ERROR. El número máximo de planos es 5");
                        planos.focus();
                    }else{
                        alert("ERROR. El número máximo de fotos es 20");
                        fotos.focus();
                    }
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_cancha y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_cancha").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la cancha?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_cancha").val());
            var usoCancha = $("#uso_cancha").val();
            var materialPiso = $("#material_piso").val();
            var tipoPintura = $("#tipo_pintura").val();
            var longitudDemarcacion = $("#longitud_demarcacion").val();
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (usoCancha == "") {
                alert("ERROR. Ingrese el uso de la cancha");
                $("#uso_cancha").focus();
            }else{
                if (aux <= 20 || aux2 <= 5) {
                    var arregloFotos = new FormData();
                    var arregloPlanos = new FormData();
                    var info = {};
                    for (var i=0;i<fotos.files.length;i++) {
                        var foto = fotos.files[i];
                        if (foto.size > 2000000) {
                            alert('La foto: "'+foto.name+"' es muy grande");
                        }else{
                            var nombreArchivo = foto.name;
                            if(nombreArchivo.length > 50){
                                nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                            }
                            console.log(nombreArchivo);
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
                    informacion["id_sede"] = idSede;
                    informacion["id_campus"] = idCampus;
                    informacion["id"] = id;
                    informacion["uso_cancha"] = usoCancha;
                    informacion["material_piso"] = materialPiso;
                    informacion["tipo_pintura"] = tipoPintura;
                    informacion["longitud_demarcacion"] = longitudDemarcacion;
                    info["nombre_sede"] = idSede;
                    info["nombre_campus"] = idCampus;
                    info["id_cancha"] = id;
                    var arregloFotosEliminar = {};
                    var arregloPlanosEliminar = {};
                    arregloFotosEliminar["id_sede"] = idSede;
                    arregloFotosEliminar["id_campus"] = idCampus;
                    arregloFotosEliminar["id"] = id;
                    arregloFotosEliminar["nombre"] = fotosEliminar;
                    arregloFotosEliminar["tipo"] = "foto";
                    arregloPlanosEliminar["id_sede"] = idSede;
                    arregloPlanosEliminar["id_campus"] = idCampus;
                    arregloPlanosEliminar["id"] = id;
                    arregloPlanosEliminar["nombre"] = planosEliminar;
                    arregloPlanosEliminar["tipo"] = "plano";
                    for (var i = 0; i < marcadoresModificacion.length; i++) {
                        coordenadas = marcadoresModificacion[i].getPosition();
                    }
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    arregloFotos.append("cancha",JSON.stringify(info));
                    arregloPlanos.append("cancha",JSON.stringify(info));
                    var data = modificarObjeto("cancha",informacion);
                    var dataEliminarFotos = eliminarObjeto("archivo_cancha",arregloFotosEliminar);
                    var dataEliminarPlanos = eliminarObjeto("archivo_cancha",arregloPlanosEliminar);
                    var resultadoPlanos = guardarPlanos("cancha",arregloPlanos);
                    var resultadoFotos = guardarFotos("cancha",arregloFotos);
                    console.log(info);
                    console.log(informacion);
                    console.log(data);
                    console.log(dataEliminarFotos);
                    console.log(dataEliminarPlanos);
                    console.log(resultadoPlanos);
                    console.log(resultadoFotos);
                    var mensaje = "";
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
                    if (resultadoPlanos.length != 0) {
                        for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                            console.log(resultadoPlanos.verificar[i]);
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
                    if (mensaje.substring(0,1) != "") {
                        alert(mensaje);
                    }else{
                        if(data.verificar){
                            alert(data.mensaje);
                            $("#sede_search").val("").change();
                            $("#divDialogConsulta").modal('hide');
                            planos.value = "";
                            fotos.value = "";
                            marcadores = [];
                        }
                    }
                }else{
                    if (aux2 <= 5) {
                        alert("ERROR. El número máximo de planos es 5");
                        planos.focus();
                    }else{
                        alert("ERROR. El número máximo de fotos es 20");
                        fotos.focus();
                    }
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_corredor y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_corredor").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del corredor?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_corredor").val());
            var alturaPared = $("#altura_pared").val();
            var anchoPared = $("#ancho_pared").val();
            var materialPared = $("#material_pared").val();
            var largoTecho = $("#largo_techo").val();
            var anchoTecho = $("#ancho_techo").val();
            var materialTecho = $("#material_techo").val();
            var largoPiso = $("#largo_piso").val();
            var anchoPiso = $("#ancho_piso").val();
            var materialPiso = $("#material_piso").val();
            var tipoSuministroEnergia = $("#tipo_suministro_energia").val();
            var tomacorriente = $("#tomacorriente").val();
            var cantidadTomacorrientes = $("#cantidad_tomacorrientes").val();
            var tipoIluminacion = [];
            var tipoIluminacionAnterior = [];
            var cantidadIluminacion = [];
            var cantidadIluminacionAnterior = [];
            var tipoInterruptor = [];
            var tipoInterruptorAnterior = [];
            var cantidadInterruptor = [];
            var cantidadInterruptorAnterior = [];
            var coordenadas;
            var error = false;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
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
                for (var i=0;i<iluminacionCont;i++) {
                    if (i==0) {
                        tipoIluminacion[i] = $("#tipo_iluminacion").val();
                        tipoIluminacionAnterior[i] = $("#tipo_iluminacion").attr('name');
                        cantidadIluminacion[i] = $("#cantidad_iluminacion").val();
                        cantidadIluminacionAnterior[i] = $("#cantidad_iluminacion").attr('name');
                    }else{
                        if (tipoIluminacion.indexOf($("#tipo_iluminacion"+i).val()) == -1) {
                            tipoIluminacion[i] = $("#tipo_iluminacion"+i).val();
                            tipoIluminacionAnterior[i] = $("#tipo_iluminacion"+i).attr('name');
                            cantidadIluminacion[i] = $("#cantidad_iluminacion"+i).val();
                            cantidadIluminacionAnterior[i] = $("#cantidad_iluminacion"+i).attr('name');
                        }else{
                            alert("ERROR. Hay uno o más tipos de iluminación repetidos");
                            $("#tipo_iluminacion"+i).focus();
                            error = true;
                            break;
                        }
                    }
                }
                for (var i=0;i<interruptoresCont;i++) {
                    if (i==0) {
                        tipoInterruptor[i] = $("#tipo_interruptor").val();
                        tipoInterruptorAnterior[i] = $("#tipo_interruptor").attr('name');
                        cantidadInterruptor[i] = $("#cantidad_interruptores").val();
                        cantidadInterruptorAnterior[i] = $("#cantidad_interruptores").attr('name');
                    }else{
                        if (tipoInterruptor.indexOf($("#tipo_interruptor"+i).val()) == -1) {
                            tipoInterruptor[i] = $("#tipo_interruptor"+i).val();
                            tipoInterruptorAnterior[i] = $("#tipo_interruptor"+i).attr('name');
                            cantidadInterruptor[i] = $("#cantidad_interruptores"+i).val();
                            cantidadInterruptorAnterior[i] = $("#cantidad_interruptores"+i).attr('name');
                        }else{
                            alert("ERROR. Hay uno o más tipos de interruptor repetidos");
                            $("#tipo_interruptor"+i).focus();
                            error = true;
                            break;
                        }
                    }
                }
                if (!error) {
                    informacion["id_sede"] = idSede;
                    informacion["id_campus"] = idCampus;
                    informacion["id"] = id;
                    informacion['alto_pared'] = alturaPared;
                    informacion['ancho_pared'] = anchoPared;
                    informacion['material_pared'] = materialPared;
                    informacion['largo_techo'] = largoTecho;
                    informacion['ancho_techo'] = anchoTecho;
                    informacion['material_techo'] = materialTecho;
                    informacion['largo_piso'] = largoPiso;
                    informacion['ancho_piso'] = anchoPiso;
                    informacion['material_piso'] = materialPiso;
                    informacion['tipo_suministro_energia'] = tipoSuministroEnergia;
                    informacion['tomacorriente'] = tomacorriente;
                    informacion['cantidad_suministro_energia'] = cantidadTomacorrientes;
                    informacion['tipo_iluminacion'] = tipoIluminacion;
                    informacion['tipo_iluminacion_anterior'] = tipoIluminacionAnterior;
                    informacion['cantidad_iluminacion'] = cantidadIluminacion;
                    informacion['cantidad_iluminacion_anterior'] = cantidadIluminacionAnterior;
                    informacion['tipo_interruptor'] = tipoInterruptor;
                    informacion['tipo_interruptor_anterior'] = tipoInterruptorAnterior;
                    informacion['cantidad_interruptor'] = cantidadInterruptor;
                    informacion['cantidad_interruptor_anterior'] = cantidadInterruptorAnterior;
                    info["nombre_sede"] = idSede;
                    info["nombre_campus"] = idCampus;
                    info["id_corredor"] = id;
                    info["tipo_iluminacion_eliminar"] = tipoIluminacionEliminar;
                    info["tipo_interruptor_eliminar"] = tipoInterruptorEliminar;
                    var arregloFotosEliminar = {};
                    var arregloPlanosEliminar = {};
                    arregloFotosEliminar["id_sede"] = idSede;
                    arregloFotosEliminar["id_campus"] = idCampus;
                    arregloFotosEliminar["id"] = id;
                    arregloFotosEliminar["nombre"] = fotosEliminar;
                    arregloFotosEliminar["tipo"] = "foto";
                    arregloPlanosEliminar["id_sede"] = idSede;
                    arregloPlanosEliminar["id_campus"] = idCampus;
                    arregloPlanosEliminar["id"] = id;
                    arregloPlanosEliminar["nombre"] = planosEliminar;
                    arregloPlanosEliminar["tipo"] = "plano";
                    for (var i = 0; i < marcadoresModificacion.length; i++) {
                        coordenadas = marcadoresModificacion[i].getPosition();
                    }
                    informacion['lat'] = coordenadas.lat().toFixed(8);
                    informacion['lng'] = coordenadas.lng().toFixed(8);
                    arregloFotos.append("corredor",JSON.stringify(info));
                    arregloPlanos.append("corredor",JSON.stringify(info));
                    var data = modificarObjeto("corredor",informacion);
                    var dataEliminarFotos = eliminarObjeto("archivo_corredor",arregloFotosEliminar);
                    var dataEliminarPlanos = eliminarObjeto("archivo_corredor",arregloPlanosEliminar);
                    var dataEliminarIluminacion = eliminarObjeto("iluminacion_corredor",info);
                    var dataEliminarInterruptor = eliminarObjeto("interruptor_corredor",info);
                    var resultadoPlanos = guardarPlanos("corredor",arregloPlanos);
                    var resultadoFotos = guardarFotos("corredor",arregloFotos);
                    console.log(informacion);
                    console.log(data);
                    console.log(info);
                    console.log(dataEliminarFotos);
                    console.log(dataEliminarPlanos);
                    console.log(dataEliminarIluminacion);
                    console.log(dataEliminarInterruptor);
                    console.log(resultadoPlanos);
                    console.log(resultadoFotos);
                    var mensaje = "";
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
                    if (resultadoPlanos.length != 0) {
                        for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                            console.log(resultadoPlanos.verificar[i]);
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
                    if (mensaje.substring(0,1) != "") {
                        alert(mensaje);
                    }else{
                        if(data.verificar){
                            alert(data.mensaje);
                            $("#sede_search").val("").change();
                            $("#divDialogConsulta").modal('hide');
                            planos.value = "";
                            fotos.value = "";
                            marcadores = [];
                        }
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_cubierta y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_cubierta").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la cubierta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var idEdificio = $("#nombre_edificio").attr('name');
            var piso = $("#pisos").val();
            var tipoCubierta = $("#tipo_cubierta").val();
            var materialCubierta = $("#material_cubierta").val();
            var ancho = $("#ancho").val();
            var largo = $("#largo").val();
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id_edificio"] = idEdificio;
                informacion["piso"] = piso;
                informacion['tipo_cubierta'] = tipoCubierta;
                informacion['material_cubierta'] = materialCubierta;
                informacion['ancho_cubierta'] = ancho;
                informacion['largo_cubierta'] = largo;
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['nombre_edificio'] = idEdificio;
                info['piso'] = piso;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id_edificio"] = idEdificio;
                arregloFotosEliminar["piso"] = piso;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id_edificio"] = idEdificio;
                arregloPlanosEliminar["piso"] = piso;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("cubierta",JSON.stringify(info));
                arregloPlanos.append("cubierta",JSON.stringify(info));
                var data = modificarObjeto("cubierta",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_cubierta",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_cubierta",arregloPlanosEliminar);
                var resultadoPlanos = guardarPlanos("cubierta",arregloPlanos);
                var resultadoFotos = guardarFotos("cubierta",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_gradas y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_gradas").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de las gradas?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var idEdificio = $("#nombre_edificio").attr('name');
            var piso = $("#pisos").val();
            var pasamanos = $('input[name="pasamanos"]:checked').val();
            var materialPasamanos = $("#material_pasamanos").val();
            var tipoVentana = [];
            var tipoVentanaAnterior = [];
            var cantidadVentanas = [];
            var cantidadVentanasAnterior = [];
            var materialVentana = [];
            var materialVentanaAnterior = [];
            var anchoVentana = [];
            var anchoVentanaAnterior = [];
            var altoVentana = [];
            var altoVentanaAnterior = [];
            var error = false;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (piso == 'sotano') {
                piso = '0';
            }else if (piso == 'terraza') {
                piso = '-1';
            }
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id_edificio"] = idEdificio;
                informacion["piso"] = piso;
                informacion['pasamanos'] = pasamanos;
                informacion['material_pasamanos'] = materialPasamanos;
                for (var i=0;i<ventanasCont;i++) {
                    if (i==0) {
                        tipoVentana[i] = $("#tipo_ventana").val();
                        tipoVentanaAnterior[i] = $("#tipo_ventana").attr('name');
                        cantidadVentanas[i] = $("#cantidad_ventanas").val();
                        cantidadVentanasAnterior[i] = $("#cantidad_ventanas").attr('name');
                        materialVentana[i] = $("#material_ventana").val();
                        materialVentanaAnterior[i] = $("#material_ventana").attr('name');
                        anchoVentana[i] = $("#ancho_ventana").val();
                        anchoVentanaAnterior[i] = $("#ancho_ventana").attr('name');
                        altoVentana[i] = $("#alto_ventana").val();
                        altoVentanaAnterior[i] = $("#alto_ventana").attr('name');
                    }else{
                        if ((tipoVentana.indexOf($("#tipo_ventana"+i).val()) != -1) && (materialVentana.indexOf($("#material_ventana"+i).val()) != -1)) {
                            alert("ERROR. Hay uno o más tipo y material de ventana repetidos");
                            $("#material_ventana"+i).focus();
                            error = true;
                            break;
                        }else{
                            tipoVentana[i] = $("#tipo_ventana"+i).val();
                            tipoVentanaAnterior[i] = $("#tipo_ventana"+i).attr('name');
                            cantidadVentanas[i] = $("#cantidad_ventanas"+i).val();
                            cantidadVentanasAnterior[i] = $("#cantidad_ventanas"+i).attr('name');
                            materialVentana[i] = $("#material_ventana"+i).val();
                            materialVentanaAnterior[i] = $("#material_ventana"+i).attr('name');
                            anchoVentana[i] = $("#ancho_ventana"+i).val();
                            anchoVentanaAnterior[i] = $("#ancho_ventana"+i).attr('name');
                            altoVentana[i] = $("#alto_ventana"+i).val();
                            altoVentanaAnterior[i] = $("#alto_ventana"+i).attr('name');
                        }
                    }
                }
                if (!error) {
                    informacion['tipo_ventana'] = tipoVentana;
                    informacion['tipo_ventana_anterior'] = tipoVentanaAnterior;
                    informacion['cantidad_ventana'] = cantidadVentanas;
                    informacion['cantidad_ventana_anterior'] = cantidadVentanasAnterior;
                    informacion['material_ventana'] = materialVentana;
                    informacion['material_ventana_anterior'] = materialVentanaAnterior;
                    informacion['ancho_ventana'] = anchoVentana;
                    informacion['ancho_ventana_anterior'] = anchoVentanaAnterior;
                    informacion['alto_ventana'] = altoVentana;
                    informacion['alto_ventana_anterior'] = altoVentanaAnterior;
                    info['nombre_sede'] = idSede;
                    info['nombre_campus'] = idCampus;
                    info['nombre_edificio'] = idEdificio;
                    info['piso'] = piso;
                    info["tipo_ventana_eliminar"] = tipoVentanaEliminar;
                    info["material_ventana_eliminar"] = materialVentanaEliminar;
                    var arregloFotosEliminar = {};
                    var arregloPlanosEliminar = {};
                    arregloFotosEliminar["id_sede"] = idSede;
                    arregloFotosEliminar["id_campus"] = idCampus;
                    arregloFotosEliminar["id_edificio"] = idEdificio;
                    arregloFotosEliminar["piso"] = piso;
                    arregloFotosEliminar["nombre"] = fotosEliminar;
                    arregloFotosEliminar["tipo"] = "foto";
                    arregloPlanosEliminar["id_sede"] = idSede;
                    arregloPlanosEliminar["id_campus"] = idCampus;
                    arregloPlanosEliminar["id_edificio"] = idEdificio;
                    arregloPlanosEliminar["piso"] = piso;
                    arregloPlanosEliminar["nombre"] = planosEliminar;
                    arregloPlanosEliminar["tipo"] = "plano";
                    arregloFotos.append("gradas",JSON.stringify(info));
                    arregloPlanos.append("gradas",JSON.stringify(info));
                    var data = modificarObjeto("gradas",informacion);
                    var dataEliminarFotos = eliminarObjeto("archivo_gradas",arregloFotosEliminar);
                    var dataEliminarPlanos = eliminarObjeto("archivo_gradas",arregloPlanosEliminar);
                    var dataEliminarVentana = eliminarObjeto("ventana_gradas",info);
                    var resultadoPlanos = guardarPlanos("gradas",arregloPlanos);
                    var resultadoFotos = guardarFotos("gradas",arregloFotos);
                    console.log(informacion);
                    console.log(info);
                    console.log(data);
                    console.log(dataEliminarFotos);
                    console.log(dataEliminarPlanos);
                    console.log(dataEliminarVentana);
                    console.log(resultadoPlanos);
                    console.log(resultadoFotos);
                    var mensaje = "";
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
                    if (resultadoPlanos.length != 0) {
                        for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                            console.log(resultadoPlanos.verificar[i]);
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
                    if (mensaje.substring(0,1) != "") {
                        alert(mensaje);
                    }else{
                        if(data.verificar){
                            alert(data.mensaje);
                            $("#sede_search").val("").change();
                            $("#divDialogConsulta").modal('hide');
                            planos.value = "";
                            fotos.value = "";
                            marcadores = [];
                        }
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_parqueadero y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_parqueadero").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del parqueadero?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_parqueadero").val());
            var capacidad = $("#capacidad").val();
            var ancho = $("#ancho").val();
            var largo = $("#largo").val();
            var material_piso = $("#material_piso").val();
            var tipo_pintura = $("#tipo_pintura").val();
            var longitud_demarcacion = $("#longitud_demarcacion").val();
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id"] = id;
                informacion['capacidad'] = capacidad;
                informacion['ancho'] = ancho;
                informacion['largo'] = largo;
                informacion['material_piso'] = material_piso;
                informacion['tipo_pintura'] = tipo_pintura;
                informacion['longitud_demarcacion'] = longitud_demarcacion;
                for (var i = 0; i < marcadoresModificacion.length; i++) {
                    coordenadas = marcadoresModificacion[i].getPosition();
                }
                informacion['lat'] = coordenadas.lat().toFixed(8);
                informacion['lng'] = coordenadas.lng().toFixed(8);
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['id_parqueadero'] = id;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id"] = id;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id"] = id;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("parqueadero",JSON.stringify(info));
                arregloPlanos.append("parqueadero",JSON.stringify(info));
                var data = modificarObjeto("parqueadero",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_parqueadero",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_parqueadero",arregloPlanosEliminar);
                var resultadoPlanos = guardarPlanos("parqueadero",arregloPlanos);
                var resultadoFotos = guardarFotos("parqueadero",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_piscina y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_piscina").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la piscina?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_piscina").val());
            var alto = $("#alto").val();
            var ancho = $("#ancho").val();
            var largo = $("#largo").val();
            var cantidadPuntosHidraulicos = $("#cantidad_puntos_hidraulicos").val();
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id"] = id;
                informacion['alto'] = alto;
                informacion['ancho'] = ancho;
                informacion['largo'] = largo;
                informacion['cantidad_punto_hidraulico'] = cantidadPuntosHidraulicos;
                for (var i = 0; i < marcadoresModificacion.length; i++) {
                    coordenadas = marcadoresModificacion[i].getPosition();
                }
                informacion['lat'] = coordenadas.lat().toFixed(8);
                informacion['lng'] = coordenadas.lng().toFixed(8);
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['id_piscina'] = id;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id"] = id;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id"] = id;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("piscina",JSON.stringify(info));
                arregloPlanos.append("piscina",JSON.stringify(info));
                var data = modificarObjeto("piscina",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_piscina",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_piscina",arregloPlanosEliminar);
                var resultadoPlanos = guardarPlanos("piscina",arregloPlanos);
                var resultadoFotos = guardarFotos("piscina",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_plazoleta y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_plazoleta").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la plazoleta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_plazoleta").val());
            var nombre = limpiarCadena($("#nombre").val());
            var tipoIluminacion = [];
            var tipoIluminacionAnterior = [];
            var cantidadIluminacion = [];
            var cantidadIluminacionAnterior = [];
            var coordenadas;
            var error = false;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id"] = id;
                informacion['nombre'] = nombre;
                for (var i=0;i<=iluminacionCont;i++) {
                    if (i==0) {
                        tipoIluminacion[i] = $("#tipo_iluminacion").val();
                        tipoIluminacionAnterior[i] = $("#tipo_iluminacion").attr('name');
                        cantidadIluminacion[i] = $("#cantidad_iluminacion").val();
                        cantidadIluminacionAnterior[i] = $("#cantidad_iluminacion").attr('name');
                    }else{
                        if (tipoIluminacion.indexOf($("#tipo_iluminacion"+i).val()) == -1) {
                            tipoIluminacion[i] = $("#tipo_iluminacion"+i).val();
                            tipoIluminacionAnterior[i] = $("#tipo_iluminacion"+i).attr('name');
                            cantidadIluminacion[i] = $("#cantidad_iluminacion"+i).val();
                            cantidadIluminacionAnterior[i] = $("#cantidad_iluminacion"+i).attr('name');
                        }else{
                            alert("ERROR. Hay uno o más tipo de iluminación repetidos");
                            $("#tipo_iluminacion"+i).focus();
                            error = true;
                            break;
                        }
                    }
                }
                for (var i = 0; i < marcadoresModificacion.length; i++) {
                    coordenadas = marcadoresModificacion[i].getPosition();
                }
                informacion['tipo_iluminacion'] = tipoIluminacion;
                informacion['tipo_iluminacion_anterior'] = tipoIluminacionAnterior;
                informacion['cantidad_iluminacion'] = cantidadIluminacion;
                informacion['cantidad_iluminacion_anterior'] = cantidadIluminacionAnterior;
                informacion['lat'] = coordenadas.lat().toFixed(8);
                informacion['lng'] = coordenadas.lng().toFixed(8);
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['id_plazoleta'] = id;
                info["tipo_iluminacion_eliminar"] = tipoIluminacionEliminar;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id"] = id;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id"] = id;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("plazoleta",JSON.stringify(info));
                arregloPlanos.append("plazoleta",JSON.stringify(info));
                var data = modificarObjeto("plazoleta",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_plazoleta",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_plazoleta",arregloPlanosEliminar);
                var dataEliminarIluminacion = eliminarObjeto("iluminacion_plazoleta",info)
                var resultadoPlanos = guardarPlanos("plazoleta",arregloPlanos);
                var resultadoFotos = guardarFotos("plazoleta",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(dataEliminarIluminacion);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_sendero y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_sendero").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del sendero?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_sendero").val());
            var longitud = $("#longitud").val();
            var ancho = $("#ancho").val();
            var materialPiso = $("#material_piso").val();
            var tipoIluminacion = $("#tipo_iluminacion").val();
            var cantidadIluminacion = $("#cantidad_iluminacion").val();
            var codigoPoste = $("#codigo_poste").val();
            var anchoCubierta = $("#ancho_cubierta").val();
            var largoCubierta = $("#largo_cubierta").val();
            var materialCubierta = $("#material_cubierta").val();
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id"] = id;
                informacion['longitud'] = longitud;
                informacion['ancho'] = ancho;
                informacion['material_piso'] = materialPiso;
                informacion['cantidad'] = cantidadIluminacion;
                informacion['tipo_iluminacion'] = tipoIluminacion;
                informacion['codigo_poste'] = codigoPoste;
                informacion['ancho_cubierta'] = anchoCubierta;
                informacion['largo_cubierta'] = largoCubierta;
                informacion['material_cubierta'] = materialCubierta;
                for (var i = 0; i < marcadoresModificacion.length; i++) {
                    coordenadas = marcadoresModificacion[i].getPosition();
                }
                informacion['lat'] = coordenadas.lat().toFixed(8);
                informacion['lng'] = coordenadas.lng().toFixed(8);
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['id_sendero'] = id;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id"] = id;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id"] = id;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("sendero",JSON.stringify(info));
                arregloPlanos.append("sendero",JSON.stringify(info));
                var data = modificarObjeto("sendero",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_sendero",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_sendero",arregloPlanosEliminar);
                var resultadoPlanos = guardarPlanos("sendero",arregloPlanos);
                var resultadoFotos = guardarFotos("sendero",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_via y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_via").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la vía?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_via").val());
            var tipoPintura = $("#tipo_pintura").val();
            var longitudDemarcacion = $("#longitud_demarcacion").val();
            var materialPiso = $("#material_piso").val();
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id"] = id;
                informacion['tipo_pintura'] = tipoPintura;
                informacion['longitud_demarcacion'] = longitudDemarcacion;
                informacion['material_piso'] = materialPiso;
                for (var i = 0; i < marcadoresModificacion.length; i++) {
                    coordenadas = marcadoresModificacion[i].getPosition();
                }
                informacion['lat'] = coordenadas.lat().toFixed(8);
                informacion['lng'] = coordenadas.lng().toFixed(8);
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['id_via'] = id;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id"] = id;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id"] = id;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("via",JSON.stringify(info));
                arregloPlanos.append("via",JSON.stringify(info));
                var data = modificarObjeto("via",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_via",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_via",arregloPlanosEliminar);
                var resultadoPlanos = guardarPlanos("via",arregloPlanos);
                var resultadoFotos = guardarFotos("via",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_edificio y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_edificio").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del edificio?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_edificio").val());
            var nombre = limpiarCadena($("#nombre_edificio").val());
            var piso = $("#pisos_edificio").val();
            var terraza = $('input[name="terraza"]:checked').val();
            var sotano = $('input[name="sotano"]:checked').val();
            var materialFachada = $("#material_fachada").val();
            var altoFachada = $("#alto_fachada").val();
            var anchoFachada = $("#ancho_fachada").val();
            var coordenadas;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id"] = id;
                informacion["nombre"] = nombre;
                informacion["numero_pisos"] = piso;
                informacion['terraza'] = terraza;
                informacion['sotano'] = sotano;
                informacion['material_fachada'] = materialFachada;
                informacion['alto_fachada'] = altoFachada;
                informacion['ancho_fachada'] = anchoFachada;
                for (var i = 0; i < marcadoresModificacion.length; i++) {
                    coordenadas = marcadoresModificacion[i].getPosition();
                }
                informacion['lat'] = coordenadas.lat().toFixed(8);
                informacion['lng'] = coordenadas.lng().toFixed(8);
                info['nombre_sede'] = idSede;
                info['nombre_campus'] = idCampus;
                info['id_edificio'] = id;
                var arregloFotosEliminar = {};
                var arregloPlanosEliminar = {};
                arregloFotosEliminar["id_sede"] = idSede;
                arregloFotosEliminar["id_campus"] = idCampus;
                arregloFotosEliminar["id"] = id;
                arregloFotosEliminar["nombre"] = fotosEliminar;
                arregloFotosEliminar["tipo"] = "foto";
                arregloPlanosEliminar["id_sede"] = idSede;
                arregloPlanosEliminar["id_campus"] = idCampus;
                arregloPlanosEliminar["id"] = id;
                arregloPlanosEliminar["nombre"] = planosEliminar;
                arregloPlanosEliminar["tipo"] = "plano";
                arregloFotos.append("edificio",JSON.stringify(info));
                arregloPlanos.append("edificio",JSON.stringify(info));
                var data = modificarObjeto("edificio",informacion);
                var dataEliminarFotos = eliminarObjeto("archivo_edificio",arregloFotosEliminar);
                var dataEliminarPlanos = eliminarObjeto("archivo_edificio",arregloPlanosEliminar);
                var resultadoPlanos = guardarPlanos("edificio",arregloPlanos);
                var resultadoFotos = guardarFotos("edificio",arregloFotos);
                console.log(informacion);
                console.log(info);
                console.log(data);
                console.log(dataEliminarFotos);
                console.log(dataEliminarPlanos);
                console.log(resultadoPlanos);
                console.log(resultadoFotos);
                var mensaje = "";
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
                if (resultadoPlanos.length != 0) {
                    for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                        console.log(resultadoPlanos.verificar[i]);
                        if (!resultadoPlanos.verificar[i]) {
                            if (mensaje == "") {
                                mensaje += resultadoPlanos.mensaje[i];
                            }else{
                                mensaje += "\n" + resultadoPlanos.mensaje[i];
                            }
                        }
                    }
                }
                if (mensaje.substring(0,1) != "") {
                    alert(mensaje);
                }else{
                    if(data.verificar){
                        alert(data.mensaje);
                        $("#sede_search").val("").change();
                        $("#divDialogConsulta").modal('hide');
                        planos.value = "";
                        fotos.value = "";
                        marcadores = [];
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_espacio y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_espacio").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del espacio?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var idEdificio = $("#nombre_edificio").attr('name');
            var piso = $("#pisos").val();
            var id = limpiarCadena($("#id_espacio").val());
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
            var tipoIluminacionAnterior = [];
            var cantidadIluminacion = [];
            var cantidadIluminacionAnterior = [];
            var tipoSuministroEnergia = [];
            var tipoSuministroEnergiaAnterior = [];
            var tomacorriente = [];
            var tomacorrienteAnterior = [];
            var cantidadTomacorrientes = [];
            var cantidadTomacorrientesAnterior = [];
            var tipoPuerta = [];
            var tipoPuertaAnterior = [];
            var cantidadPuertas = [];
            var cantidadPuertasAnterior = [];
            var materialPuerta = [];
            var materialPuertaAnterior = [];
            var tipoCerradura = [];
            var tipoCerraduraAnterior = [];
            var gatoPuerta = [];
            var gatoPuertaAnterior = [];
            var materialMarco = [];
            var materialMarcoAnterior = [];
            var anchoPuerta = [];
            var anchoPuertaAnterior = [];
            var altoPuerta = [];
            var altoPuertaAnterior = [];
            var tipoVentana = [];
            var tipoVentanaAnterior = [];
            var cantidadVentanas = [];
            var cantidadVentanasAnterior = [];
            var materialVentana = [];
            var materialVentanaAnterior = [];
            var anchoVentana = [];
            var anchoVentanaAnterior = [];
            var altoVentana = [];
            var altoVentanaAnterior = [];
            var tipoInterruptor = [];
            var tipoInterruptorAnterior = [];
            var cantidadInterruptor = [];
            var cantidadInterruptorAnterior = [];
            var coordenadas;
            var error = false;
            var planos = document.getElementById("planos[]");
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            var aux2 = (numeroFotos-1) + planos.files.length;
            if (piso == 'sotano') {
                piso = '0';
            }
            if (piso == 'terraza') {
                piso = '-1';
            }
            if (aux <= 20 || aux2 <= 5) {
                var arregloFotos = new FormData();
                var arregloPlanos = new FormData();
                var info = {};
                console.log(fotos.files);
                console.log(planos.files);
                for (var i=0;i<fotos.files.length;i++) {
                    var foto = fotos.files[i];
                    if (foto.size > 2000000) {
                        alert('La foto: "'+foto.name+"' es muy grande");
                    }else{
                        var nombreArchivo = foto.name;
                        if(nombreArchivo.length > 50){
                            nombreArchivo = foto.name.substring(foto.name.length-50, foto.name.length);
                        }
                        console.log(nombreArchivo);
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
                informacion["id_sede"] = idSede;
                informacion["id_campus"] = idCampus;
                informacion["id_edificio"] = idEdificio;
                informacion["piso"] = piso;
                informacion["id"] = id;
                informacion['uso_espacio'] = usoEspacio;
                informacion['alto_pared'] = alturaPared;
                informacion['ancho_pared'] = anchoPared;
                informacion['material_pared'] = materialPared;
                informacion['largo_techo'] = largoTecho;
                informacion['ancho_techo'] = anchoTecho;
                informacion['material_techo'] = materialTecho;
                informacion['largo_piso'] = largoPiso;
                informacion['ancho_piso'] = anchoPiso;
                informacion['material_piso'] = materialPiso;
                informacion['tiene_espacio_padre'] = espacioPadre;
                informacion['espacio_padre'] = numero_espacio_padre;
                for (var i=0;i<=iluminacionCont;i++) {
                    if (i==0) {
                        tipoIluminacion[i] = $("#tipo_iluminacion").val();
                        tipoIluminacionAnterior[i] = $("#tipo_iluminacion").attr('name');
                        cantidadIluminacion[i] = $("#cantidad_iluminacion").val();
                        cantidadIluminacionAnterior[i] = $("#cantidad_iluminacion").attr('name');
                    }else{
                        if (tipoIluminacion.indexOf($("#tipo_iluminacion"+i).val()) == -1) {
                            tipoIluminacion[i] = $("#tipo_iluminacion"+i).val();
                            tipoIluminacionAnterior[i] = $("#tipo_iluminacion"+i).attr('name');
                            cantidadIluminacion[i] = $("#cantidad_iluminacion"+i).val();
                            cantidadIluminacionAnterior[i] = $("#cantidad_iluminacion"+i).attr('name');
                        }else{
                            alert("ERROR. Hay uno o más tipo de iluminación repetidos");
                            $("#tipo_iluminacion"+i).focus();
                            error = true;
                            break;
                        }
                    }
                }
                if (!error) {
                    for (var i=0;i<=tomacorrientesCont;i++) {
                        if (i==0) {
                            tipoSuministroEnergia[i] = $("#tipo_suministro_energia").val();
                            tipoSuministroEnergiaAnterior[i] = $("#tipo_suministro_energia").attr('name');;
                            tomacorriente[i] = $("#tomacorriente").val();
                            tomacorrienteAnterior[i] = $("#tomacorriente").attr('name');
                            cantidadTomacorrientes[i] = $("#cantidad_tomacorrientes").val();
                            cantidadTomacorrientesAnterior[i] = $("#cantidad_tomacorrientes").attr('name');
                        }else{
                            if ((tipoSuministroEnergia.indexOf($("#tipo_suministro_energia"+i).val()) != -1) && (tomacorriente.indexOf($("#tomacorriente"+i).val()) != -1)) {
                                alert("ERROR. Hay uno o más tipo de suministro de energía y tipo de tomacorriente repetidos");
                                $("#tomacorriente"+i).focus();
                                error = true;
                                break;

                            }else{
                                tipoSuministroEnergia[i] = $("#tipo_suministro_energia"+i).val();
                                tipoSuministroEnergiaAnterior[i] = $("#tipo_suministro_energia"+i).attr('name');
                                tomacorriente[i] = $("#tomacorriente"+i).val();
                                tomacorrienteAnterior[i] = $("#tomacorriente"+i).attr('name');
                                cantidadTomacorrientes[i] = $("#cantidad_tomacorrientes"+i).val();
                                cantidadTomacorrientesAnterior[i] = $("#cantidad_tomacorrientes"+i).attr('name');
                            }
                        }
                    }
                }
                if (!error) {
                    for (var i=0;i<=puertasCont;i++) {
                        if (i==0) {
                            tipoPuerta[i] = $("#tipo_puerta").val();
                            tipoPuertaAnterior[i] = $("#tipo_puerta").attr('name');
                            cantidadPuertas[i] = $("#cantidad_puertas").val();
                            cantidadPuertasAnterior[i] = $("#cantidad_puertas").attr('name');
                            materialPuerta[i] = $("#material_puerta").val();
                            materialPuertaAnterior[i] = $("#material_puerta").attr('name');
                            tipoCerradura[i] = $("#tipo_cerradura").val();
                            tipoCerraduraAnterior[i] = $("#tipo_cerradura").attr('name');
                            gatoPuerta[i] = $('input[name="gato_puerta"]:checked').val();
                            materialMarco[i] = $("#material_marco_puerta").val();
                            materialMarcoAnterior[i] = $("#material_marco_puerta").attr('name');
                            anchoPuerta[i] = $("#ancho_puerta").val();
                            anchoPuertaAnterior[i] = $("#ancho_puerta").attr('name');
                            altoPuerta[i] = $("#alto_puerta").val();
                            altoPuertaAnterior[i] = $("#alto_puerta").attr('name');
                        }else{
                            if ((tipoPuerta.indexOf($("#tipo_puerta"+i).val()) != -1) && (materialPuerta.indexOf($("#material_puerta"+i).val()) != -1) && (tipoCerradura.indexOf($("#tipo_cerradura"+i).val()) != -1) && (materialMarco.indexOf($("#material_marco_puerta"+i).val()) != -1)) {
                                alert("ERROR. Hay uno o más tipo de puerta, material de puerta, tipo de cerradura y material del marco de la puerta repetidos");
                                $("#material_marco_puerta"+i).focus();
                                error = true;
                                break;
                            }else{
                                tipoPuerta[i] = $("#tipo_puerta"+i).val();
                                tipoPuertaAnterior[i] = $("#tipo_puerta"+i).attr('name');
                                cantidadPuertas[i] = $("#cantidad_puertas"+i).val();
                                cantidadPuertasAnterior[i] = $("#cantidad_puertas"+i).attr('name');
                                materialPuerta[i] = $("#material_puerta"+i).val();
                                materialPuertaAnterior[i] = $("#material_puerta"+i).attr('name');
                                tipoCerradura[i] = $("#tipo_cerradura"+i).val();
                                tipoCerraduraAnterior[i] = $("#tipo_cerradura"+i).attr('name');
                                gatoPuerta[i] = $('input[name="gato_puerta'+i+'"]:checked').val();
                                materialMarco[i] = $("#material_marco_puerta"+i).val();
                                materialMarcoAnterior[i] = $("#material_marco_puerta"+i).attr('name');
                                anchoPuerta[i] = $("#ancho_puerta"+i).val();
                                anchoPuertaAnterior[i] = $("#ancho_puerta"+i).attr('name');
                                altoPuerta[i] = $("#alto_puerta"+i).val();
                                altoPuertaAnterior[i] = $("#alto_puerta"+i).attr('name');
                            }
                        }
                    }
                }
                if(!error){
                    for (var i=0;i<=ventanasCont;i++) {
                        if (i==0) {
                            tipoVentana[i] = $("#tipo_ventana").val();
                            tipoVentanaAnterior[i] = $("#tipo_ventana").attr('name');
                            cantidadVentanas[i] = $("#cantidad_ventanas").val();
                            cantidadVentanasAnterior[i] = $("#cantidad_ventanas").attr('name');
                            materialVentana[i] = $("#material_ventana").val();
                            materialVentanaAnterior[i] = $("#material_ventana").attr('name');
                            anchoVentana[i] = $("#ancho_ventana").val();
                            anchoVentanaAnterior[i] = $("#ancho_ventana").attr('name');
                            altoVentana[i] = $("#alto_ventana").val();
                            altoVentanaAnterior[i] = $("#alto_ventana").attr('name');
                        }else{
                            if ((tipoVentana.indexOf($("#tipo_ventana"+i).val()) != -1) && (materialVentana.indexOf($("#material_ventana"+i).val()) != -1)) {
                                alert("ERROR. Hay uno o más tipo y material de ventana repetidos");
                                $("#material_ventana"+i).focus();
                                error = true;
                                break;
                            }else{
                                tipoVentana[i] = $("#tipo_ventana"+i).val();
                                tipoVentanaAnterior[i] = $("#tipo_ventana"+i).attr('name');
                                cantidadVentanas[i] = $("#cantidad_ventanas"+i).val();
                                cantidadVentanasAnterior[i] = $("#cantidad_ventanas"+i).attr('name');
                                materialVentana[i] = $("#material_ventana"+i).val();
                                materialVentanaAnterior[i] = $("#material_ventana"+i).attr('name');
                                anchoVentana[i] = $("#ancho_ventana"+i).val();
                                anchoVentanaAnterior[i] = $("#ancho_ventana"+i).attr('name');
                                altoVentana[i] = $("#alto_ventana"+i).val();
                                altoVentanaAnterior[i] = $("#alto_ventana"+i).attr('name');
                            }

                        }
                    }
                }
                if (!error) {
                    for (var i=0;i<=interruptoresCont;i++) {
                        if (i==0) {
                            tipoInterruptor[i] = $("#tipo_interruptor").val();
                            tipoInterruptorAnterior[i] = $("#tipo_interruptor").attr('name');
                            cantidadInterruptor[i] = $("#cantidad_interruptores").val();
                            cantidadInterruptorAnterior[i] = $("#cantidad_interruptores").attr('name');
                        }else{
                            if (tipoInterruptor.indexOf($("#tipo_interruptor"+i).val()) == -1) {
                                tipoInterruptor[i] = $("#tipo_interruptor"+i).val();
                                tipoInterruptorAnterior[i] = $("#tipo_interruptor"+i).attr('name');
                                cantidadInterruptor[i] = $("#cantidad_interruptores"+i).val();
                                cantidadInterruptorAnterior[i] = $("#cantidad_interruptores"+i).attr('name');
                            }else{
                                alert("ERROR. Hay uno o más tipos de interruptor repetidos");
                                $("#tipo_interruptor"+i).focus();
                                error = true;
                                break;
                            }
                        }
                    }
                }
                if (!error) {
                    informacion['tipo_iluminacion'] = tipoIluminacion;
                    informacion['tipo_iluminacion_anterior'] = tipoIluminacionAnterior;
                    informacion['cantidad_iluminacion'] = cantidadIluminacion;
                    informacion['cantidad_iluminacion_anterior'] = cantidadIluminacionAnterior;
                    informacion['tipo_suministro_energia'] = tipoSuministroEnergia;
                    informacion['tipo_suministro_energia_anterior'] = tipoSuministroEnergiaAnterior;
                    informacion['tomacorriente'] = tomacorriente;
                    informacion['tomacorriente_anterior'] = tomacorrienteAnterior;
                    informacion['cantidad_suministro_energia'] = cantidadTomacorrientes;
                    informacion['cantidad_suministro_energia_anterior'] = cantidadTomacorrientesAnterior;
                    informacion['tipo_puerta'] = tipoPuerta;
                    informacion['tipo_puerta_anterior'] = tipoPuertaAnterior;
                    informacion['cantidad_puerta'] = cantidadPuertas;
                    informacion['cantidad_puerta_anterior'] = cantidadPuertasAnterior;
                    informacion['material_puerta'] = materialPuerta;
                    informacion['material_puerta_anterior'] = materialPuertaAnterior;
                    informacion['tipo_cerradura'] = tipoCerradura;
                    informacion['tipo_cerradura_anterior'] = tipoCerraduraAnterior;
                    informacion['gato_puerta'] = gatoPuerta;
                    informacion['material_marco'] = materialMarco;
                    informacion['material_marco_anterior'] = materialMarcoAnterior;
                    informacion['ancho_puerta'] = anchoPuerta;
                    informacion['ancho_puerta_anterior'] = anchoPuertaAnterior;
                    informacion['alto_puerta'] = altoPuerta;
                    informacion['alto_puerta_anterior'] = altoPuertaAnterior;
                    informacion['tipo_ventana'] = tipoVentana;
                    informacion['tipo_ventana_anterior'] = tipoVentanaAnterior;
                    informacion['cantidad_ventana'] = cantidadVentanas;
                    informacion['cantidad_ventana_anterior'] = cantidadVentanasAnterior;
                    informacion['material_ventana'] = materialVentana;
                    informacion['material_ventana_anterior'] = materialVentanaAnterior;
                    informacion['ancho_ventana'] = anchoVentana;
                    informacion['ancho_ventana_anterior'] = anchoVentanaAnterior;
                    informacion['alto_ventana'] = altoVentana;
                    informacion['alto_ventana_anterior'] = altoVentanaAnterior;
                    informacion['tipo_interruptor'] = tipoInterruptor;
                    informacion['tipo_interruptor_anterior'] = tipoInterruptorAnterior;
                    informacion['cantidad_interruptor'] = cantidadInterruptor;
                    informacion['cantidad_interruptor_anterior'] = cantidadInterruptorAnterior;
                    if (usoEspacioSelect == '1') { //Salón
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                        informacion['capacidad'] = $("#capacidad").val();
                        informacion['punto_videobeam'] = $('input[name="punto_videobeam"]:checked').val();
                    }else if(usoEspacioSelect == '2'){ //Auditorio
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                        informacion['capacidad'] = $("#capacidad").val();
                        informacion['punto_videobeam'] = $('input[name="punto_videobeam"]:checked').val();
                    }else if(usoEspacioSelect == '3'){ //Laboratorio
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                        informacion['capacidad'] = $("#capacidad").val();
                        informacion['punto_videobeam'] = $('input[name="punto_videobeam"]:checked').val();
                        informacion['cantidad_puntos_hidraulicos'] = $("#cantidad_puntos_hidraulicos").val();
                        var tipoPuntosSanitarios = [];
                        var tipoPuntosSanitariosAnterior = [];
                        var cantidadPuntosSanitarios = [];
                        var cantidadPuntosSanitariosAnterior = [];
                        for (var i=0;i<=puntosSanitariosCont-1;i++) {
                            if (i==0) {
                                tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario").val();
                                tipoPuntosSanitariosAnterior[i] = $("#tipo_punto_sanitario").attr('name');
                                cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios").val();
                                cantidadPuntosSanitariosAnterior[i] = $("#cantidad_puntos_sanitarios").attr('name');
                            }else{
                                if (tipoInterruptor.indexOf($("#tipo_punto_sanitario"+i).val()) == -1) {
                                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario"+i).val();
                                    tipoPuntosSanitariosAnterior[i] = $("#tipo_punto_sanitario"+i).attr('name');
                                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios"+i).val();
                                    cantidadPuntosSanitariosAnterior[i] = $("#cantidad_puntos_sanitarios"+i).attr('name');
                                }else{
                                    alert("ERROR. Hay uno o más tipos de punto sanitario repetidos");
                                    $("#tipo_interruptor"+i).focus();
                                    error = true;
                                    break;
                                }
                            }
                        }
                        informacion['tipo_punto_sanitario'] = tipoPuntosSanitarios;
                        informacion['tipo_punto_sanitario_anterior'] = tipoPuntosSanitariosAnterior;
                        informacion['cantidad_puntos_sanitarios'] = cantidadPuntosSanitarios;
                        informacion['cantidad_puntos_sanitarios_anterior'] = cantidadPuntosSanitariosAnterior;
                    }else if(usoEspacioSelect == '4'){ //Sala de Cómputo
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                        informacion['capacidad'] = $("#capacidad").val();
                        informacion['punto_videobeam'] = $('input[name="punto_videobeam"]:checked').val();
                    }else if(usoEspacioSelect == '5'){ //Oficina
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                        informacion['punto_videobeam'] = $('input[name="punto_videobeam"]:checked').val();
                    }else if(usoEspacioSelect == '6'){ //Baño
                        informacion['tipo_inodoro'] = $("#tipo_inodoro").val();
                        informacion['cantidad_inodoro'] = $("#cantidad_inodoros").val();
                        informacion['tipo_divisiones'] = $("#tipo_divisiones").val();
                        informacion['material_divisiones'] = $("#material_divisiones").val();
                        informacion['ducha'] = $('input[name="ducha"]:checked').val();
                        informacion['lavatraperos'] = $('input[name="lavatraperos"]:checked').val();
                        informacion['cantidad_sifones'] = $("#cantidad_sifones").val();
                        var tipoLavamanos = [];
                        var tipoLavamanosAnterior = [];
                        var cantidadLavamanos = [];
                        var cantidadLavamanosAnterior = [];
                        for (var i=0;i<=lavamanosCont-1;i++) {
                            if (i==0) {
                                tipoLavamanos[i] = $("#tipo_lavamanos").val();
                                tipoLavamanosAnterior[i] = $("#tipo_lavamanos").attr('name');
                                cantidadLavamanos[i] = $("#cantidad_lavamanos").val();
                                cantidadLavamanosAnterior[i] = $("#cantidad_lavamanos").attr('name');
                            }else{
                                if (tipoLavamanos.indexOf($("#tipo_lavamanos"+i).val()) == -1) {
                                    tipoLavamanos[i] = $("#tipo_lavamanos"+i).val();
                                    tipoLavamanosAnterior[i] = $("#tipo_lavamanos"+i).attr('name');
                                    cantidadLavamanos[i] = $("#cantidad_lavamanos"+i).val();
                                    cantidadLavamanosAnterior[i] = $("#cantidad_lavamanos"+i).attr('name');
                                }else{
                                    alert("ERROR. Hay uno o más tipos de lavamanos repetidos");
                                    $("#tipo_lavamanos"+i).focus();
                                    error = true;
                                    break;
                                }
                            }
                        }
                        informacion['tipo_lavamanos'] = tipoLavamanos;
                        informacion['tipo_lavamanos_anterior'] = tipoLavamanosAnterior;
                        informacion['cantidad_lavamanos'] = cantidadLavamanos;
                        informacion['cantidad_lavamanos_anterior'] = cantidadLavamanosAnterior;
                        if (!error) {
                            var tipoOrinal = [];
                            var tipoOrinalAnterior = [];
                            var cantidadOrinal = [];
                            var cantidadOrinalAnterior = [];
                            for (var i=0;i<=orinalesCont-1;i++) {
                                if (i==0) {
                                    tipoOrinal[i] = $("#tipo_orinal").val();
                                    tipoOrinalAnterior[i] = $("#tipo_orinal").attr('name');
                                    cantidadOrinal[i] = $("#cantidad_orinales").val();
                                    cantidadOrinalAnterior[i] = $("#cantidad_orinales").attr('name');
                                }else{
                                    if (tipoLavamanos.indexOf($("#tipo_orinal"+i).val()) == -1) {
                                        tipoOrinal[i] = $("#tipo_orinal"+i).val();
                                        tipoOrinalAnterior[i] = $("#tipo_orinal"+i).attr('name');
                                        cantidadOrinal[i] = $("#cantidad_orinales"+i).val();
                                        cantidadOrinalAnterior[i] = $("#cantidad_orinales"+i).attr('name');
                                    }else{
                                        alert("ERROR. Hay uno o más tipos de orinal repetidos");
                                        $("#tipo_orinal"+i).focus();
                                        error = true;
                                        break;
                                    }
                                }
                            }
                            informacion['tipo_orinal'] = tipoOrinal;
                            informacion['tipo_orinal_anterior'] = tipoOrinalAnterior;
                            informacion['cantidad_orinal'] = cantidadOrinal;
                            informacion['cantidad_orinal_anterior'] = cantidadOrinalAnterior;
                        }
                    }else if(usoEspacioSelect == '7'){ //Cuarto Técnico
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                        informacion['punto_videobeam'] = $('input[name="punto_videobeam"]:checked').val();
                    }else if(usoEspacioSelect == '8'){ //Bodega/Almacen
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                    }else if(usoEspacioSelect == '10'){ //Cuarto de Plantas
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                    }else if(usoEspacioSelect == '11'){ //Cuarto de Aires Acondicionados
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                    }else if(usoEspacioSelect == '12'){ //Área Deportiva Cerrada
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                    }else if(usoEspacioSelect == '14'){ //Centro de Datos/Teléfono
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                    }else if(usoEspacioSelect == '17'){ //Cuarto de Bombas
                        informacion['cantidad_puntos_hidraulicos'] = $("#cantidad_puntos_hidraulicos").val();
                        var tipoPuntosSanitarios = [];
                        var tipoPuntosSanitariosAnterior = [];
                        var cantidadPuntosSanitarios = [];
                        var cantidadPuntosSanitariosAnterior = [];
                        for (var i=0;i<=puntosSanitariosCont-1;i++) {
                            if (i==0) {
                                tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario").val();
                                tipoPuntosSanitariosAnterior[i] = $("#tipo_punto_sanitario").attr('name');
                                cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios").val();
                                cantidadPuntosSanitariosAnterior[i] = $("#cantidad_puntos_sanitarios").attr('name');
                            }else{
                                if (tipoInterruptor.indexOf($("#tipo_punto_sanitario"+i).val()) == -1) {
                                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario"+i).val();
                                    tipoPuntosSanitariosAnterior[i] = $("#tipo_punto_sanitario"+i).attr('name');
                                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios"+i).val();
                                    cantidadPuntosSanitariosAnterior[i] = $("#cantidad_puntos_sanitarios"+i).attr('name');
                                }else{
                                    alert("ERROR. Hay uno o más tipos de punto sanitario repetidos");
                                    $("#tipo_interruptor"+i).focus();
                                    error = true;
                                    break;
                                }
                            }
                        }
                        informacion['tipo_punto_sanitario'] = tipoPuntosSanitarios;
                        informacion['tipo_punto_sanitario_anterior'] = tipoPuntosSanitariosAnterior;
                        informacion['cantidad_puntos_sanitarios'] = cantidadPuntosSanitarios;
                        informacion['cantidad_puntos_sanitarios_anterior'] = cantidadPuntosSanitariosAnterior;
                    }else if(usoEspacioSelect == '19'){ //Cocineta
                        informacion['cantidad_puntos_hidraulicos'] = $("#cantidad_puntos_hidraulicos").val();
                        var tipoPuntosSanitarios = [];
                        var tipoPuntosSanitariosAnterior = [];
                        var cantidadPuntosSanitarios = [];
                        var cantidadPuntosSanitariosAnterior = [];
                        for (var i=0;i<=puntosSanitariosCont-1;i++) {
                            if (i==0) {
                                tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario").val();
                                tipoPuntosSanitariosAnterior[i] = $("#tipo_punto_sanitario").attr('name');
                                cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios").val();
                                cantidadPuntosSanitariosAnterior[i] = $("#cantidad_puntos_sanitarios").attr('name');
                            }else{
                                if (tipoInterruptor.indexOf($("#tipo_punto_sanitario"+i).val()) == -1) {
                                    tipoPuntosSanitarios[i] = $("#tipo_punto_sanitario"+i).val();
                                    tipoPuntosSanitariosAnterior[i] = $("#tipo_punto_sanitario"+i).attr('name');
                                    cantidadPuntosSanitarios[i] = $("#cantidad_puntos_sanitarios"+i).val();
                                    cantidadPuntosSanitariosAnterior[i] = $("#cantidad_puntos_sanitarios"+i).attr('name');
                                }else{
                                    alert("ERROR. Hay uno o más tipos de punto sanitario repetidos");
                                    $("#tipo_interruptor"+i).focus();
                                    error = true;
                                    break;
                                }
                            }
                        }
                        informacion['tipo_punto_sanitario'] = tipoPuntosSanitarios;
                        informacion['tipo_punto_sanitario_anterior'] = tipoPuntosSanitariosAnterior;
                        informacion['cantidad_puntos_sanitarios'] = cantidadPuntosSanitarios;
                        informacion['cantidad_puntos_sanitarios_anterior'] = cantidadPuntosSanitariosAnterior;
                    }else if(usoEspacioSelect == '20'){ //Sala de Estudio
                        informacion['cantidad_puntos_red'] = $("#cantidad_puntos_red").val();
                    }
                    if (!error) {
                        info['nombre_sede'] = idSede;
                        info['nombre_campus'] = idCampus;
                        info['id_edificio'] = idEdificio;
                        info['id_espacio'] = id;
                        info["tipo_iluminacion_eliminar"] = tipoIluminacionEliminar;
                        info["tipo_interruptor_eliminar"] = tipoInterruptorEliminar;
                        info["tipo_puerta_eliminar"] = tipoPuertaEliminar;
                        info["material_puerta_eliminar"] = materialPuertaEliminar;
                        info["material_marco_eliminar"] = materialMarcoPuertaEliminar;
                        info["tipo_cerradura_eliminar"] = tipoCerraduraEliminar;
                        info["tipo_suministro_energia_eliminar"] = tipoSuministroEnergiaEliminar;
                        info["tomacorriente"] = tomacorrienteEliminar;
                        info["tipo_ventana_eliminar"] = tipoVentanaEliminar;
                        info["material_ventana_eliminar"] = materialVentanaEliminar;
                        var arregloFotosEliminar = {};
                        var arregloPlanosEliminar = {};
                        arregloFotosEliminar["id_sede"] = idSede;
                        arregloFotosEliminar["id_campus"] = idCampus;
                        arregloFotosEliminar["id_edificio"] = idEdificio;
                        arregloFotosEliminar["id"] = id;
                        arregloFotosEliminar["nombre"] = fotosEliminar;
                        arregloFotosEliminar["tipo"] = "foto";
                        arregloPlanosEliminar["id_sede"] = idSede;
                        arregloPlanosEliminar["id_campus"] = idCampus;
                        arregloPlanosEliminar["id_edificio"] = idEdificio;
                        arregloPlanosEliminar["id"] = id;
                        arregloPlanosEliminar["nombre"] = planosEliminar;
                        arregloPlanosEliminar["tipo"] = "plano";
                        arregloFotos.append("espacio",JSON.stringify(info));
                        arregloPlanos.append("espacio",JSON.stringify(info));
                        var data = modificarObjeto("espacio",informacion);
                        var dataEliminarFotos = eliminarObjeto("archivo_espacio",arregloFotosEliminar);
                        var dataEliminarPlanos = eliminarObjeto("archivo_espacio",arregloPlanosEliminar);
                        var dataEliminarIluminacion = eliminarObjeto("iluminacion_espacio",info);
                        var dataEliminarInterruptor = eliminarObjeto("interruptor_espacio",info);
                        var dataEliminarPuerta = eliminarObjeto("puerta_espacio",info);
                        var dataEliminarSuministroEnergia = eliminarObjeto("suministro_energia_espacio",info);
                        var dataEliminarVentana = eliminarObjeto("ventana_espacio",info);
                        var resultadoPlanos = guardarPlanos("espacio",arregloPlanos);
                        var resultadoFotos = guardarFotos("espacio",arregloFotos);
                        console.log(informacion);
                        console.log(info);
                        console.log(data);
                        console.log(dataEliminarFotos);
                        console.log(dataEliminarPlanos);
                        console.log(dataEliminarIluminacion);
                        console.log(dataEliminarInterruptor);
                        console.log(dataEliminarPuerta);
                        console.log(dataEliminarSuministroEnergia);
                        console.log(dataEliminarVentana);
                        console.log(resultadoPlanos);
                        console.log(resultadoFotos);
                        var mensaje = "";
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
                        if (resultadoPlanos.length != 0) {
                            for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                                console.log(resultadoPlanos.verificar[i]);
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
                        if (mensaje.substring(0,1) != "") {
                            alert(mensaje);
                        }else{
                            if(data.verificar){
                                alert(data.mensaje);
                                $("#sede_search").val("").change();
                                $("#divDialogConsulta").modal('hide');
                                planos.value = "";
                                fotos.value = "";
                                marcadores = [];
                            }
                        }
                    }
                }
            }else{
                if (aux2 <= 5) {
                    alert("ERROR. El número máximo de planos es 5");
                    planos.focus();
                }else{
                    alert("ERROR. El número máximo de fotos es 20");
                    fotos.focus();
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_modificaciones_tipo_material y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_tipo_material").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del tipo de material?");
        if (confirmacion) {
            var tipoMaterial = $("#tipo_material").val();
            var nombreTipoMaterialAnterior = $("#nombre_tipo_material").attr('name');
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
                informacion['nombre'] = limpiarCadena(nombreTipoMaterial);
                informacion['nombre_anterior'] = limpiarCadena(nombreTipoMaterialAnterior);
                var resultado = modificarObjeto("tipo_material",informacion);
                console.log(informacion);
                console.log(resultado);
                mostrarMensaje(resultado.mensaje);
                if(resultado.verificar){
                    $("#tipo_material_search").val("seleccionar").change();
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando se da click en el botón guardar_modificaciones_tipo_objeto y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_tipo_objeto").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del tipo de objeto?");
        if (confirmacion) {
            var tipoMaterial = $("#tipo_objeto").val();
            var nombreTipoMaterialAnterior = $("#nombre_tipo_objeto").attr('name');
            var nombreTipoMaterial = $("#nombre_tipo_objeto").val();
            if(!validarCadena(tipoMaterial)){
                alert("ERROR. Seleccione un tipo de objeto");
                $("#tipo_objeto").focus();
            }else if(!validarCadena(nombreTipoMaterial)){
                alert("ERROR. Ingrese el nombre del tipo de objeto");
                $("#nombre_tipo_objeto").focus();
            }else{
                var informacion = {};
                informacion['tipo_objeto'] = limpiarCadena(tipoMaterial);
                informacion['nombre'] = limpiarCadena(nombreTipoMaterial);
                informacion['nombre_anterior'] = limpiarCadena(nombreTipoMaterialAnterior);
                var resultado = modificarObjeto("tipo_objeto",informacion);
                console.log(informacion);
                console.log(resultado);
                mostrarMensaje(resultado.mensaje);
                if(resultado.verificar){
                    $("#tipo_objeto_search").val("seleccionar").change();
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del aire acondicionado?");
        if (confirmacion) {
            var informacion = {};
            var idAire = limpiarCadena($("#id_aire").val());
            var numeroInventario = limpiarCadena($("#numero_inventario").val());
            var numeroInventarioAnterior = limpiarCadena($("#numero_inventario").attr('name'));
            var marcaAire = limpiarCadena($("#marca_aire").val());
            var tipoAire = $("#tipo_aire").val();
            var tecnologiaAire = $("#tipo_tecnologia_aire").val();
            var capacidadAire = $("#capacidad_aire").val();
            var fechaInstalacion = $("#fecha_instalacion").val();
            var instalador = limpiarCadena($("#instalador").val());
            var periodicidadMantenimiento = $("#tipo_periodicidad_mantenimiento").val();
            var ubicacionCondensadora = limpiarCadena($("#ubicacion_condensadora").val());
            var fotos = document.getElementById("fotos[]");
            var aux = (numeroFotos-1) + fotos.files.length;
            if (aux <= 20) {
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
                }
                if (!validarCadena(marcaAire)) {
                    alert("ERROR. Seleccione la marca del aire acondicionado");
                    $("#marca_aire").focus();
                }else if (!validarCadena(tipoAire)) {
                    alert("ERROR. Seleccione el tipo del aire acondicionado");
                    $("#tipo_aire").focus();
                }else if (!validarCadena(tecnologiaAire)) {
                    alert("ERROR. Seleccione la tecnología del aire acondicionado");
                    $("#tipo_tecnologia_aire").focus();
                }else if (!validarCadena(capacidadAire)) {
                    alert("ERROR. Seleccione la capacidad del aire acondicionado");
                    $("#capacidad_aire").focus();
                }else if(!validarFechaMenorActual(fechaInstalacion)){
                    alert("ERROR. La fecha de instalación del aire acondicionado es mayor a la fecha actual");
                    $("#fecha_instalacion").focus();
                }else{
                    var numeroInventarioRepetido = false;
                    var conteo = 0;
                    if ((numeroInventario != "") && (numeroInventario != numeroInventarioAnterior)) {
                        informacion["numero_inventario"] = numeroInventario;
                        numeroInventarioRepetido = verificarElemento("numero_inventario_aire",informacion);
                        console.log(numeroInventarioRepetido);
                        $.each(numeroInventarioRepetido, function(index, record) {
                            if($.isNumeric(index)) {
                                conteo = record.count;
                            }
                        });
                    }
                    if (conteo == 0) {
                        informacion["id_aire"] = idAire;
                        informacion["numero_inventario"] = numeroInventario;
                        informacion["marca_aire"] = marcaAire;
                        informacion["tipo_aire"] = tipoAire;
                        informacion["tipo_tecnologia_aire"] = tecnologiaAire;
                        informacion["capacidad_aire"] = capacidadAire;
                        informacion['fecha_instalacion'] = fechaInstalacion;
                        informacion['instalador'] = instalador;
                        informacion['tipo_periodicidad_mantenimiento'] = periodicidadMantenimiento;
                        informacion['ubicacion_condensadora'] = ubicacionCondensadora;
                        var arregloFotosEliminar = {};
                        arregloFotosEliminar["id_aire"] = idAire;
                        arregloFotosEliminar["nombre"] = fotosEliminar;
                        console.log(fotosEliminar);
                        arregloFotosEliminar["tipo"] = "foto";
                        arregloFotos.append("aire",JSON.stringify(informacion));
                        var data = modificarObjeto("aire",informacion);
                        var dataEliminarFotos = eliminarObjeto("foto_aire",arregloFotosEliminar);
                        var resultadoFotos = guardarFotos("aire",arregloFotos);
                        console.log(informacion);
                        console.log(data);
                        console.log(dataEliminarFotos);
                        console.log(resultadoFotos);
                        var mensaje = "";
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
                        }else{
                            if(data.verificar){
                                alert(data.mensaje);
                                $("#sede_search").val("").change();
                                $("#divDialogConsulta").modal('hide');
                                fotos.value = "";
                            }
                        }
                    }else{
                        alert("ERROR. El número de inventario ya se encuentra registrado en el sistema");
                        $("#numero_inventario").focus();
                    }
                }
            }else{
                alert("ERROR. El número máximo de fotos es 20");
                fotos.focus();
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_capacidad_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_capacidad_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la capacidad de aires acondicionados?");
        if (confirmacion) {
            var informacion = {};
            var capacidadAire = $("#capacidad_aire_nueva").val();
            var capacidadAireAnterior = $("#capacidad_aire_nueva").attr('name');
            informacion["capacidad"] = capacidadAire;
            informacion["capacidad_anterior"] = capacidadAireAnterior;
            if (!validarCadena(capacidadAire)) {
                alert("ERROR. Ingrese el nuevo valor de la capacidad de aires acondicionados");
                $("#capacidad_aire_nueva").focus();
            }else if((capacidadAire != capacidadAireAnterior) && !(verificarElemento("capacidad_aire",informacion).verificar)){
                alert("ERROR. La capacidad de aires acondicionados ya se encuentra registrada en el sistema");
                $("#capacidad_aire_nueva").focus();
            }else{
                var data = modificarObjeto("capacidad_aire",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    actualizarSelectCapacidadAire("capacidad_aire_search");
                    $("#capacidad_aire_search").val("").change();
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_marca_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_marca_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la marca de aires acondicionados?");
        if (confirmacion) {
            var informacion = {};
            var marcaAire = limpiarCadena($("#marca_aire_nueva").val());
            var marcaAireAnterior = limpiarCadena($("#marca_aire_nueva").attr('name'));
            informacion["nombre"] = marcaAire;
            informacion["nombre_anterior"] = marcaAireAnterior;
            if (!validarCadena(marcaAire)) {
                alert("ERROR. Ingrese el nuevo nombre de la marca de aires acondicionados");
                $("#marca_aire_nueva").focus();
            }else if((marcaAire != marcaAireAnterior) && !(verificarElemento("marca_aire",informacion).verificar)){
                alert("ERROR. La marca de aires acondicionados ya se encuentra registrada en el sistema");
                $("#marca_aire_nueva").focus();
            }else{
                var data = modificarObjeto("marca_aire",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    actualizarSelectMarcaAire("marca_aire_search");
                    $("#marca_aire_search").val("").change();
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_marca_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_tipo_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del tipo de aires acondicionados?");
        if (confirmacion) {
            var informacion = {};
            var tipoAire = limpiarCadena($("#tipo_aire_nuevo").val());
            var tipoAireAnterior = limpiarCadena($("#tipo_aire_nuevo").attr('name'));
            informacion["tipo_objeto"] = "tipo_aire";
            informacion["nombre"] = tipoAire;
            informacion["nombre_anterior"] = tipoAireAnterior;
            if (!validarCadena(tipoAire)) {
                alert("ERROR. Ingrese el nuevo nombre del tipo de aires acondicionados");
                $("#tipo_aire_nuevo").focus();
            }else if((tipoAire != tipoAireAnterior) && !(verificarElemento("tipo_aire",informacion).verificar)){
                alert("ERROR. El nombre del tipo de aires acondicionados ya se encuentra registrado en el sistema");
                $("#tipo_aire_nuevo").focus();
            }else{
                var data = modificarObjeto("tipo_objeto",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    actualizarSelectTipoAire("tipo_aire_search");
                    $("#tipo_aire_search").val("").change();
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_marca_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_tecnologia_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información de la tecnología de aires acondicionados?");
        if (confirmacion) {
            var informacion = {};
            var tecnologiaAire = limpiarCadena($("#tecnologia_aire_nuevo").val());
            var tecnologiaAireAnterior = limpiarCadena($("#tecnologia_aire_nuevo").attr('name'));
            informacion["tipo_objeto"] = "tipo_tecnologia_aire";
            informacion["nombre"] = tecnologiaAire;
            informacion["nombre_anterior"] = tecnologiaAireAnterior;
            if (!validarCadena(tecnologiaAire)) {
                alert("ERROR. Ingrese el nuevo nombre de la tecnología de aires acondicionados");
                $("#tecnologia_aire_nuevo").focus();
            }else if((tecnologiaAire != tecnologiaAireAnterior) && !(verificarElemento("tecnologia_aire",informacion).verificar)){
                alert("ERROR. El nombre de la tecnología de aires acondicionados ya se encuentra registrado en el sistema");
                $("#tecnologia_aire_nuevo").focus();
            }else{
                var data = modificarObjeto("tipo_objeto",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    actualizarSelectTecnologiaAire("tecnologia_aire_search");
                    $("#tecnologia_aire_search").val("").change();
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_modificaciones_mantenimiento_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_modificaciones_mantenimiento_aire").click(function (e){
        var confirmacion = window.confirm("¿Guardar la información del mantenimiento del aire acondicionado?");
        if (confirmacion) {
            var informacion = {};
            var idAire = $("#id_aire").val();
            var numeroOrden = $("#numero_orden").val();
            var fecha = limpiarCadena($("#fecha_realizacion").val());
            var realizado = limpiarCadena($("#realizado").val());
            var revisado = limpiarCadena($("#revisado").val());
            var descripcion = limpiarCadena($("#descripcion_trabajo").val());
            informacion["id_aire"] = idAire;
            informacion["numero_orden"] = numeroOrden;
            informacion["fecha"] = fecha;
            informacion["realizado"] = realizado;
            informacion["revisado"] = revisado;
            informacion["descripcion"] = descripcion;
            if (!validarCadena(fecha)) {
                alert("ERROR. Ingrese la fecha en que se realizó el mantenimiento");
                $("#fecha_realizacion").focus();
            }else if(!validarFechaMenorActual(fecha)){
                alert("ERROR. La fecha en que se realizó la orden de mantenimiento del aire acondicionado es mayor a la fecha actual");
                $("#fecha_realizacion").focus();
            }else if (!validarCadena(realizado)) {
                alert("ERROR. Ingrese el nombre de la persona que realizó el mantenimiento");
                $("#realizado").focus();
            }else if (!validarCadena(revisado)) {
                alert("ERROR. Ingrese el nombre de la persona que revisó el mantenimiento");
                $("#revisado").focus();
            }else if (!validarCadena(descripcion)) {
                alert("ERROR. Ingrese la descripción del trabajo realizado en el mantenimiento del aire acondicionado");
                $("#descripcion_trabajo").focus();
            }else{
                var data = modificarObjeto("mantenimiento_aire",informacion);
                alert(data.mensaje);
                if (data.verificar) {
                    $("#id_aire_search").val("").change();
                    $("#numero_orden_search").val("");
                    $("#divDialogConsulta").modal('hide');
                }
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón guardar_articulos y se
     * realiza la operacion correspondiente.
    **/
    $("#guardar_articulos").click(function (e){
        var confirmacion = window.confirm("¿Añadir ó eliminar la cantidad de artículos ingresada?");
        if (confirmacion) {
            var informacion = {};
            var nombreArticulo = [];
            var cantidad = [];

            for (var i = 0; i <= anadirArticulosCont; i++) {
                if (i==0) {
                    nombreArticulo[i] = $("#nombre_articulo").val();
                    cantidad[i] = $("#cantidad").val();
                }else{
                    nombreArticulo[i] = $("#nombre_articulo"+i).val();
                    cantidad[i] = $("#cantidad"+i).val();
                }
            }

            informacion["nombre_articulo"] = nombreArticulo;
            informacion["cantidad"] = cantidad;
            var data = modificarObjeto("mantenimiento_aire",informacion);
            alert(data.mensaje);
            if (data.verificar) {
                $("#id_aire_search").val("").change();
                $("#numero_orden_search").val("");
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_sede y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_sede").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar la sede y todos los elementos (campus, canchas, corredores, edificios, espacios, fotos, planos, etc.) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            informacion["id"] = idSede;
            var data = eliminarObjeto("sede",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                actualizarSelectSede();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_campus y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_campus").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el campus y todos los elementos (canchas, corredores, edificios, espacios, fotos, planos, etc.) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            informacion["id_sede"] = idSede;
            informacion["id"] = idCampus;
            var data = eliminarObjeto("campus",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_cancha y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_cancha").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar la cancha y todos los elementos (fotos y planos) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_cancha").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("cancha",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_corredor y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_corredor").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el corredor y todos los elementos (fotos y planos) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_corredor").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("corredor",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_cubierta y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_cubierta").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar la cubierta y todos los elementos (fotos y planos) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var idEdificio = $("#nombre_edificio").attr('name');
            var piso = $("#pisos").val();
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id_edificio"] = idEdificio;
            informacion["piso"] = piso;
            var data = eliminarObjeto("cubierta",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_gradas y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_gradas").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar las gradas y todos los elementos (fotos y planos) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var idEdificio = $("#nombre_edificio").attr('name');
            var piso = $("#pisos").val();
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id_edificio"] = idEdificio;
            informacion["piso"] = piso;
            var data = eliminarObjeto("gradas",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_parqueadero y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_parqueadero").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el parqueadero y todos los elementos (fotos y planos) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_parqueadero").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("parqueadero",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_piscina y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_piscina").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar la piscina y todos los elementos (fotos y planos) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_piscina").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("piscina",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_plazoleta y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_plazoleta").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar la plazoleta y todos los elementos (fotos y planos) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_plazoleta").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("plazoleta",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_sendero y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_sendero").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el sendero peatonal y todos los elementos (fotos y planos) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_sendero").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("sendero",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_via y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_via").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar la vía y todos los elementos (fotos y planos) de ésta?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_via").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("via",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_edificio y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_edificio").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el edificio y todos los elementos (cubiertas, gradas, espacios, fotos y planos) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var id = limpiarCadena($("#id_edificio").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id"] = id;
            var data = eliminarObjeto("edificio",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_espacio y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_espacio").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el espacio y todos los elementos (fotos y planos) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idSede = $("#nombre_sede").attr('name');
            var idCampus = $("#nombre_campus").attr('name');
            var idEdificio = $("#nombre_edificio").attr('name');
            var id = limpiarCadena($("#id_espacio").val());
            informacion["id_sede"] = idSede;
            informacion["id_campus"] = idCampus;
            informacion["id_edificio"] = idEdificio;
            informacion["id"] = id;
            var data = eliminarObjeto("espacio",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_aire").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el aire acondicionado y todos los elementos (fotos y mantenimientos) de éste?");
        if (confirmacion) {
            var informacion = {};
            var idAire = $("#id_aire").val();
            informacion["id_aire"] = idAire;
            var data = eliminarObjeto("aire",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#sede_search").val("").change();
                $("#numero_inventario_search").val("").change();
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
     * Se captura el evento cuando de dar click en el botón eliminar_mantenimiento_aire y se
     * realiza la operacion correspondiente.
    **/
    $("#eliminar_mantenimiento_aire").click(function (e){
        var confirmacion = window.confirm("¿Desea eliminar el mantenimiento al aire acondicionado?");
        if (confirmacion) {
            var informacion = {};
            var idAire = $("#id_aire").val();
            var idOrden = $("#numero_orden").val();
            informacion["id_aire"] = idAire;
            informacion["numero_orden"] = idOrden;
            var data = eliminarObjeto("mantenimiento_aire",informacion);
            console.log(informacion);
            console.log(data);
            alert(data.mensaje);
            if (data.verificar) {
                $("#id_aire_search").val("").change();
                $("#numero_orden_search").val("");
                $("#divDialogConsulta").modal('hide');
            }
        }
    });

    /**
	 * Se captura el evento cuando de dar click en un fila de la tabla inventario.
	**/
	$('tbody').on('click', 'tr', function() {
		if ($(this).hasClass("filaSeleccionada")) {
			$(this).removeClass("filaSeleccionada");
			$("#ver_informacion_articulo").attr("disabled",true);
		}else{
			$("#tBody tr").removeClass("filaSeleccionada");
	    	$(this).addClass("filaSeleccionada");
			$("#ver_informacion_articulo").removeAttr("disabled");
		}
	});
});
