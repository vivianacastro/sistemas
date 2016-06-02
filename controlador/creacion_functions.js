$(document).ready(function() {

    var iluminacionCont = 0,tomacorrientesCont = 0,puertasCont = 0;

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
            //actualizarSelectUsoEspacio();
            //actualizarSelectMaterialPared();
            //actualizarSelectMaterialTecho();
            //actualizarSelectMaterialPiso();
            //actualizarSelectTipoLampara();
            //actualizarSelectTipoSuministroEnergia();
            //actualizarSelectTipoPuerta();
            //actualizarSelectMaterialPuerta();
            //actualizarSelectTipoCerradura();
            //actualizarSelectMaterialMarco();
            //actualizarSelectTipoVetana();
            //actualizarSelectMaterialVentana();
            //actualizarSelectTipoInt();
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
     * unción que realiza una consulta de los campus presentes en el sistema
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
    });

    /**
     * Se captura el evento cuando se modifica el valor del selector nombre_sede
     * y se actualiza el selector de campus.
     */
    $("#nombre_campus").change(function (e) {
        var campus = {};
        campus["nombre_campus"] = limpiarCadena($("#nombre_campus").val());
        console.log(campus);
        var data = buscarEdificios(campus);
        $("#nombre_edificio").empty();
        var row = $("<option value='seleccionar'/>");
        row.text("--Seleccionar--");
        row.appendTo("#nombre_edificio");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                console.log(record);
                aux = record.id + " - " + record.nombre_edificio;
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#nombre_edificio");
            }
        });
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
        +'<select class="form-control formulario" name="tipo_tomacorriente" id="tipo_tomacorriente'+tomacorrientesCont+'" required></select><br>'
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
        +'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="añadir_tipo_cerradura" id="añadir_tipo_cerradura'+puertasCont+'" value="Añadir Tipo" title="Añadir Tipo Cerradura"/>'
        +'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="eliminar_tipo_cerradura" id="eliminar_tipo_cerradura'+puertasCont+'" value="Eliminar Tipo" title="Eliminar Tipo Cerradura" disabled/>'
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
        añadirComponente("puertas",componente);
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
});