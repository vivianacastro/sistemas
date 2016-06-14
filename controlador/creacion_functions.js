$(document).ready(function() {

    var iluminacionCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0;

    /**
     * Función que se ejecuta al momento que se accede a la página que lo tiene
     * incluido.
     * @returns {undefined}
     */
    (function (){
        var URLactual = window.location;
        if(URLactual['href'].indexOf('crear_campus') >= 0 || URLactual['href'].indexOf('crear_edificio') >= 0){
            actualizarSelectSede();
        }else if(URLactual['href'].indexOf('crear_espacio') >= 0){
            actualizarSelectSede();
            actualizarSelectUsosEspacios();
            actualizarSelectMaterial("material_pared",0);
            actualizarSelectMaterial("material_techo",0);
            actualizarSelectMaterial("material_piso",0);
            actualizarSelectMaterial("material_puerta",0);
            actualizarSelectMaterial("material_marco",0);
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
     * Función que permite crear un campus
     * @param {string} informacion, información del campus 
     * @returns {data}
     */
    function guardarCampus(informacion){
        var dataResult;
        var jObject = JSON.stringify(informacion);
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=guardar_campus",
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
            return dataResult
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
            return dataResult
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
            return dataResult
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
     * unción que realiza una consulta de los campus presentes en el sistema
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
     * unción que realiza una consulta de los edificios del campus seleccionado
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
     * unción que realiza una consulta el número de pisos de un edificio
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
     * Función que llena y actualiza el selector de campus.
     * @returns {undefined}
    **/
    function actualizarSelectSede(){
        var data = buscarSedes();
        $("#nombre_sede").empty();
        var row = $("<option value='seleccionar'/>");
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
        var row = $("<option value='seleccionar'/>");
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
        var row = $("<option value='seleccionar'/>");
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
        var row = $("<option value='seleccionar'/>");
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
        var row = $("<option value='seleccionar'/>");
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
        campus["nombre_campus"] = limpiarCadena($("#nombre_campus").val());
        var data = buscarEdificios(campus);
        $("#nombre_edificio").empty();
        var row = $("<option value='seleccionar'/>");
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
        var row = $("<option value='seleccionar'/>");
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
     * Se captura el evento cuando de dar click en el boton guardar_sede y se
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
                    informacion['nombre_sede'] = limpiarCadena(nombre_sede);
                    var resultado = guardarSede(informacion);
                    mostrarMensaje(resultado.mensaje);
                    if (resultado.verificar) {
                        $("#nombre_sede").val("");
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
     * Se captura el evento cuando de dar click en el boton guardar_campus y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_campus").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del campus?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                if(nombreSede == 'seleccionar' || nombreSede.length == 0){
                    alert("ERROR. Seleccione la sede a la que pertenece el campus");
                    $("#nombre_sede").focus();
                }else if(nombreCampus.length == 0){
                    alert("ERROR. Ingrese el nombre del campus");
                    $("#nombre_campus").focus();
                }else{
                    var informacion = {};
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = limpiarCadena(nombreCampus);
                    var resultado = guardarCampus(informacion);
                    mostrarMensaje(resultado.mensaje);
                    if (resultado.verificar) {
                        $("#nombre_sede").val("seleccionar");
                        $("#nombre_campus").val("");
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
     * Se captura el evento cuando de dar click en el boton guardar_edificio y se
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
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    informacion['id_edificio'] = limpiarCadena(idEdificio);
                    informacion['nombre_edificio'] = limpiarCadena(nombreEdificio);
                    informacion['numero_pisos'] = numeroPisos;
                    informacion['terraza'] = terraza;
                    informacion['sotano'] = sotano;
                    var resultado = guardarEdificio(informacion);
                    mostrarMensaje(resultado.mensaje);
                    console.log(resultado);
                    if(resultado.verificar){
                        $("#nombre_sede").val("seleccionar");
                        $("#nombre_campus").empty();
                        $("#id_edificio").val("");
                        $("#nombre_edificio").val("");
                        $("#pisos_edificio").val("");
                        $('input[name=terraza]').attr('checked',false);
                        $('input[name=sotano]').attr('checked',false);
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
     * Se captura el evento cuando de dar click en el boton guardar_edificio y se
     * realiza la operacion correspondiente.
     */
    $("#guardar_espacio").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del espacio?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = $("#nombre_campus").val();
                var nombreEdificio = $("#nombre_edificio").val();
                var piso = $("#pisos").val();
                var numeroEspacio = $("#id_espacio").val();
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
                        gatoPuerta[i] = $("#gato_puerta").val();
                        materialMarco[i] = $("#material_marco").val();
                        anchoPuerta[i] = $("#ancho_puerta").val();
                        altoPuerta[i] = $("#alto_puerta").val();
                    }else{
                        tipoPuerta[i] = $("#tipo_puerta"+i).val();
                        cantidadPuertas[i] = $("#cantidad_puertas"+i).val();
                        materialPuerta[i] = $("#material_puerta"+i).val();
                        tipoCerradura[i] = $("#tipo_cerradura"+i).val();
                        gatoPuerta[i] = $("#gato_puerta"+i).val();
                        materialMarco[i] = $("#material_marco"+i).val();
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
                informacion["tipo_iluminacion"] = tipoIluminacion;
                informacion["cantidad_iluminacion"] = cantidadIluminacion;
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

                console.log(informacion);

                if (usoEspacio == '1') { //Salón
                    eliminarComponente("informacion");
                    var componente = '<div id="informacion">'
                    +'<div class="div_izquierda"><b>Cantidad de puntos de red<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                    +'<div class="div_izquierda"><b>Capacidad<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="capacidad" id="capacidad" value="" required/><br>'
                    +'<div class="div_izquierda"><b>¿El salón tiene punto(s) de red?<font color="red">*</font>:</b></div>'
                    +'<label class="radio-inline"><input type="radio" name="punto_red" value="true">S&iacute;</label>'
                    +'<label class="radio-inline"><input type="radio" name="punto_red" value="false">No</label><br>'
                    +'</div>';
                }else if(usoEspacio == '2'){ //Auditorio
                    eliminarComponente("informacion");
                    var componente = '<div id="informacion">'
                    +'<div class="div_izquierda"><b>Cantidad de puntos de red<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                    +'<div class="div_izquierda"><b>Capacidad<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="capacidad" id="capacidad" value="" required/><br>'
                    +'<div class="div_izquierda"><b>¿El auditorio tiene punto(s) de red?<font color="red">*</font>:</b></div>'
                    +'<label class="radio-inline"><input type="radio" name="punto_red" value="true">S&iacute;</label>'
                    +'<label class="radio-inline"><input type="radio" name="punto_red" value="false">No</label><br>'
                    +'</div>';
                }else if(usoEspacio == '3'){ //Laboratorio
                    eliminarComponente("informacion");
                    var componente = '<div id="informacion">'
                    +'<div class="div_izquierda"><b>Cantidad de puntos de red<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="cantidad_puntos_red" id="cantidad_puntos_red" value="" required/><br>'
                    +'<div class="div_izquierda"><b>Capacidad<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="capacidad" id="capacidad" value="" required/><br>'
                    +'<div class="div_izquierda"><b>Cantidad de puntos hidráulicos<font color="red">*</font>:</b></div>'
                    +'<input class="form-control formulario" type="number" min="1" name="cantidad_puntos_hidraulicos" id="cantidad_puntos_hidraulicos" value="" required/><br>'
                    +'</div>';
                }else if(usoEspacio == '4'){ //Sala de Cómputo
                    
                }else if(usoEspacio == '5'){ //Oficina
                    
                }else if(usoEspacio == '6'){ //Baño
                    
                }else if(usoEspacio == '7'){ //Cuarto Técnico
                    
                }else if(usoEspacio == '8'){ //Bodega/Almacen
                    
                }else if(usoEspacio == '9'){ //Cuarto Eléctrico
                    
                }else if(usoEspacio == '10'){ //Cuarto de Plantas
                    
                }else if(usoEspacio == '11'){ //Cuarto de Aires Acondicionados
                    
                }else if(usoEspacio == '12'){ //Área Deportiva Cerrada
                    
                }else if(usoEspacio == '13'){ //Unidad de Almacenamiento de Residuos
                    
                }else if(usoEspacio == '14'){ //Centro de Datos/Teléfono
                    
                }else if(usoEspacio == '15'){ //Cafetería
                    
                }else if(usoEspacio == '16'){ //Ascensor
                    
                }else if(usoEspacio == '17'){ //Cuarto de Bombas
                    
                }else if(usoEspacio == '18'){ //Buitrón
                    
                }else if(usoEspacio == '19'){ //Cocineta
                    
                }
                añadirComponente("informacionEspacio",componente);
                $('#divDialogCreacionSalon').modal('show');
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });

    /**
     * Se captura el evento cuando de dar click en el boton guardar_tipo_material y se
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
                        $("#tipo_material").val("seleccionar");
                        $("#nombre_tipo_material").val("");
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
     * Se captura el evento cuando de dar click en el boton guardar_tipo_objeto y se
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
                        $("#tipo_objeto").val("seleccionar");
                        $("#nombre_tipo_objeto").val("");
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
     * Se captura el evento cuando de dar click en el boton añadir_iluminacion y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_iluminacion").click(function (e){
        iluminacionCont++;
        var componente = '<div id="iluminacion'+iluminacionCont+'">'
        +'<div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion'+iluminacionCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="cantidad_iluminacion" id="cantidad_iluminacion'+iluminacionCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("iluminacion",componente);
        actualizarSelectTipoObjeto("tipo_iluminacion",iluminacionCont);
        $('#eliminar_iluminacion').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando de dar click en el boton eliminar_iluminacion y se
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
     * Se captura el evento cuando de dar click en el boton añadir_tomacorriente y se
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
        +'<input class="form-control formulario" type="number" min="1" name="cantidad_tomacorrientes" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("suministro_energia",componente);
        actualizarSelectTipoObjeto("tipo_suministro_energia",tomacorrientesCont);
        $('#eliminar_tomacorriente').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando de dar click en el boton eliminar_tomacorriente y se
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
     * Se captura el evento cuando de dar click en el boton añadir_puerta y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_puerta").click(function (e){
        puertasCont++;
        var componente = '<div id="puerta'+puertasCont+'">'
        +'<div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_puerta" id="tipo_puerta'+puertasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="cantidad_puertas" id="cantidad_puertas'+puertasCont+'" value="" required/><br>'
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
        +'<input class="form-control formulario" type="number" min="1" name="ancho_puerta" id="ancho_puerta'+puertasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="alto_puerta" id="alto_puerta'+puertasCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("puerta",componente);
        actualizarSelectMaterial("material_puerta",puertasCont);
        actualizarSelectTipoObjeto("tipo_puerta",puertasCont);
        $('#eliminar_puerta').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando de dar click en el boton eliminar_puerta y se
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
     * Se captura el evento cuando de dar click en el boton añadir_ventana y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_ventana").click(function (e){
        ventanasCont++;
        var componente = '<div id="ventana'+ventanasCont+'">'
        +'<div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_ventana" id="tipo_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="cantidad_ventanas" id="cantidad_ventanas'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="material_ventana" id="material_ventana'+ventanasCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="ancho_ventana" id="ancho_ventana'+ventanasCont+'" value="" required/><br>'
        +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="alto_ventana" id="alto_ventana'+ventanasCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("ventana",componente);
        actualizarSelectMaterial("material_ventana",ventanasCont);
        actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
        $('#eliminar_ventana').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando de dar click en el boton eliminar_ventana y se
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
     * Se captura el evento cuando de dar click en el boton añadir_interruptor y se
     * realiza la operacion correspondiente.
     */
    $("#añadir_interruptor").click(function (e){
        interruptoresCont++;
        var componente = '<div id="interruptor'+interruptoresCont+'">'
        +'<div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
        +'<select class="form-control formulario" name="tipo_interruptor" id="tipo_interruptor'+interruptoresCont+'" required></select><br>'
        +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
        +'<input class="form-control formulario" type="number" min="1" name="cantidad_interruptores" id="cantidad_interruptores'+interruptoresCont+'" value="" required/><br>'
        +'</div>';
        añadirComponente("interruptor",componente);
        actualizarSelectTipoObjeto("tipo_interruptor",interruptoresCont);
        $('#eliminar_interruptor').removeAttr("disabled");
    });

    /**
     * Se captura el evento cuando de dar click en el boton eliminar_interruptor y se
     * realiza la operacion correspondiente.
     */
    $("#eliminar_interruptor").click(function (e){
        eliminarComponente("interruptor"+interruptoresCont);
        interruptoresCont--;
        if(interruptoresCont == 0){
            $("#eliminar_interruptor").attr('disabled','disabled');
        }
    });
});