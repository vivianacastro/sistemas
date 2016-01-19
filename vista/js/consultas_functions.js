$(document).ready(function() {
	

    $('#tabla').DataTable({
        /*"scrollY":          "400px",*/
        /*"scrollX":          true,*/
        "scrollCollapse":   true,
        "paging":           true,
        "info":             true,
        "language": {
            "url":          "vista/js/Spanish.json"
        }
    });
 
    $('#tabla tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );

/***********************************Funciones de los formularios de consulta consultas*********************************************/
    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function buscarOrdenes(consulta) {
        var dataResult;

        try
        {
            $.ajax({
                type: "POST",
                url: "index.php?action=buscar_orden",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                beforeSend: function() {
                    $("#loader").dialog("open");
                    $('#loader').html('<img id="" src="../web/images/loading.gif"/>');
                // $("#loader").dialog("close");   
                },
                success: function(data){
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                    $("#loader").dialog("close");
                }
            });
            return dataResult;
        }
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
    * Función que realiza la consulta de una orden  por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function buscarSolicitud(consulta)
    {
        var dataResult;

        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=buscar_solicitudes_mantenimiento",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data) {
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function buscarOrdenesParametros(consulta) {
        var dataResult;
        var dataSave = {};

        var campus = $.trim(consulta[0]);
        var sistema = $.trim(consulta[1]);
        var fechaInicio = $.trim(consulta[2]);
        var fechaFin = $.trim(consulta[3]);

        dataSave['campus']= campus;
        dataSave['sistema'] = sistema;
        dataSave['fechaInicio'] = fechaInicio;
        dataSave['fechaFin'] = fechaFin;

        var jObject = JSON.stringify(dataSave);

        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=buscar_orden_parametros",
                data: {jObject:  jObject},
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){  	
                    dataResult = data;
                    //console.log(dataResult);
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }
    
    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function obtenerEstadisticasEdificios(consulta) {

        var dataResult;
        var dataSave = {};

        var campus = $.trim(consulta[0]);
        var sistema = $.trim(consulta[1]);
        var fechaInicial = $.trim(consulta[2]);
        var fechaFinal = $.trim(consulta[3]);

        dataSave['campus']= campus;
        dataSave['sistema'] = sistema;
        dataSave['fechaInicio'] = fechaInicial;
        dataSave['fechaFin'] = fechaFinal;

        var jObject = JSON.stringify(dataSave);

        //console.log(dataSave);

        try
        {
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_estadisticas_edificios",
                data: {jObject:  jObject},
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function obtenerEstadisticasEspacios(consulta) {

        var dataResult;
        var dataSave = {};

        var campus = $.trim(consulta[0]);
        var sistema = $.trim(consulta[1]);
        var fechaInicial = $.trim(consulta[2]);
        var fechaFinal = $.trim(consulta[3]);

        dataSave['campus']= campus;
        dataSave['sistema'] = sistema;
        dataSave['fechaInicio'] = fechaInicial;
        dataSave['fechaFin'] = fechaFinal;

        var jObject = JSON.stringify(dataSave);

        //console.log(dataSave);

        try
        {
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_estadisticas_espacios",
                data: {jObject:  jObject},
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function obtenerEstadisticasSistema(consulta)
    {
        var dataResult;
        var dataSave = {};

        var campus = $.trim(consulta[0]);
        var sistema = $.trim(consulta[1]);
        var fechaInicial = $.trim(consulta[2]);
        var fechaFinal = $.trim(consulta[3]);

        dataSave['campus']= campus;
        dataSave['sistema'] = sistema;
        dataSave['fechaInicio'] = fechaInicial;
        dataSave['fechaFin'] = fechaFinal;

        var jObject = JSON.stringify(dataSave);

        //console.log(dataSave);

        try
        {
            $.ajax({
                type: "POST",
                url: "index.php?action=buscar_estadisticas_sistema",
                data: {jObject:  jObject},
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function obtenerEstadisticasOperador(consulta)
    {
        var dataResult;
        var dataSave = {};

        var campus = $.trim(consulta[0]);
        var sistema = $.trim(consulta[1]);
        var fechaInicial = $.trim(consulta[2]);
        var fechaFinal = $.trim(consulta[3]);

        dataSave['campus']= campus;
        dataSave['sistema'] = sistema;
        dataSave['fechaInicio'] = fechaInicial;
        dataSave['fechaFin'] = fechaFinal;

        var jObject = JSON.stringify(dataSave);

        //console.log(dataSave);

        try
        {
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_estadisticas_operador",
                data: {jObject:  jObject},
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
    * Función que realiza la consulta de una orden por medio de ajax.
    * @param {string} consulta, Cadena que representa la palabra clave.
    * @returns {data}
    **/
    function buscarOrdenesParametrosAvanzados(consulta)
    {
        var dataResult;
        var dataSave = {};

        var campus = $.trim(consulta[0]);
        var edificio = $.trim(consulta[1]);
        var sistema = $.trim(consulta[2]);
        var fechaInicial = $.trim(consulta[3]);
        var fechaFinal = $.trim(consulta[4]);

        dataSave['campus']= campus;
        dataSave['edificio'] = edificio;
        dataSave['sistema'] = sistema;
        dataSave['fechaInicio'] = fechaInicial;
        dataSave['fechaFin'] = fechaFinal;

        var jObject = JSON.stringify(dataSave);

        //console.log(dataSave);

        try
        {
            $.ajax({
                type: "POST",
                url: "index.php?action=buscar_orden_parametros_avanzados",
                data: {jObject:  jObject},
                dataType: "json",
                async: false,
                error: function(error){
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){
                    dataResult = data;
                    mostrarMensaje(dataResult.mensaje);
                }
            });
            return dataResult;
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
     * Función que realiza una consulta de los edificios 
     * con base en una palabra clave.
     * @param {type} consulta, palabra clave para realizar la consulta.
     * @returns {data} object json
    **/
    function buscarEdificio(consulta)
    {
        var dataResult;

        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_edificio",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){  
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        } 
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }          
    }
    
	 /**
     * Función que realiza una consulta de las ordenes dado
     un usuario
     * @param {type} consulta, palabra clave para realizar la consulta.
     * @returns {data} object json
    **/
    function buscarOrdenesSistema(consulta)
    {
        var dataResult;

        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_ordenes_sistema",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function(data){  
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        } 
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }          
    }

    /**
     * funcion que permite recuperar los datos del usuario asociados a una orden/solicitud
     * @param  {string} consulta [nombre de login del usuario]
     * @return {object}          [Objeto json con los datos del usuario]
     */
    function buscarDatosUsuario(consulta)
    {
        var dataResult;

        try{
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_datos_usuario",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function (data){
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        }
        catch(ex){
            alert("ERROR: Ocurrio un error " + ex);
        }
    }
    
	 /**
     * funcion que permite recuperar los datos del usuario asociados a una orden/solicitud
     * @param  {string} consulta [nombre de login del usuario]
     * @return {object}          [Objeto json con los datos del usuario]
     */
    function buscarHistorialUsuario(consulta)
    {
        var dataResult;

        try{
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_historial",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function (data){
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        }
        catch(ex){
            alert("ERROR: Ocurrio un error " + ex);
        }
    } 

    /**
     * funcion que permite recuperar los datos del usuario asociados a una orden/solicitud
     * @param  {string} consulta [nombre de login del usuario]
     * @return {object}          [Objeto json con los datos del usuario]
     */
    function buscarOrdenesElectrico(consulta)
    {
        var dataResult;

        try{
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_ordenes_electrico",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function (data){
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        }
        catch(ex){
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
     * funcion que permite recuperar los datos del usuario asociados a una orden/solicitud
     * @param  {string} consulta [nombre de login del usuario]
     * @return {object}          [Objeto json con los datos del usuario]
     */
    function buscarOrdenesHidraulico(consulta)
    {
        var dataResult;

        try{
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_ordenes_hidraulico",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function (data){
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        }
        catch(ex){
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
     * funcion que permite recuperar los datos del usuario asociados a una orden/solicitud
     * @param  {string} consulta [nombre de login del usuario]
     * @return {object}          [Objeto json con los datos del usuario]
     */
    function buscarOrdenesMobiliario(consulta)
    {
        var dataResult;

        try{
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_ordenes_mobiliario",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function (data){
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        }
        catch(ex){
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
     * funcion que permite recuperar los datos del usuario asociados a una orden/solicitud
     * @param  {string} consulta [nombre de login del usuario]
     * @return {object}          [Objeto json con los datos del usuario]
     */
    function buscarOrdenesPlanta(consulta)
    {
        var dataResult;

        try{
            $.ajax({
                type: "POST",
                url: "index.php?action=obtener_ordenes_planta",
                data: "buscar=" + consulta,
                dataType: "json",
                async: false,
                error: function (request, status, error) {
                    alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                    console.log(error.toString());
                    location.reload(true);
                },
                success: function (data){
                    dataResult = data;
                    //console.log(dataResult);
                }
            });
            return dataResult;
        }
        catch(ex){
            alert("ERROR: Ocurrio un error " + ex);
        }
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaOrdenes(data) {

        $("#tablaOrdenes").clearGridData();
        $.each(data, function(index, record) {            
            if($.isNumeric(index)) {
                $("#tablaOrdenes").jqGrid('addRowData',index,record);
            }
        });
        var numeroFilas = $("#tablaOrdenes").getGridParam("reccount");
        $("#divConteo").html("Número de registros: "+numeroFilas);          
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaOrdenes2(data) {

        $("#tablaOrdenes2").clearGridData();
        $.each(data, function(index, record) {            
            if($.isNumeric(index)) {
                $("#tablaOrdenes2").jqGrid('addRowData',index,record);
            }
        });
        var numeroFilas = $("#tablaOrdenes2").getGridParam("reccount");
        $("#divConteo").html("Número de registros: "+numeroFilas);     
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaOrdenes3(data) {

    	$("#tablaOrdenes3").clearGridData();
    	$.each(data, function(index, record) {            
        	if($.isNumeric(index)) {
            	$("#tablaOrdenes3").jqGrid('addRowData',index,record);
        	}
        });
    	var numeroFilas = $("#tablaOrdenes3").getGridParam("reccount");
    	$("#divConteo2").html("Número de registros: "+numeroFilas);         
    }


    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaOrdenes4(data) {

        $("#tablaOrdenes4").clearGridData();
        $.each(data, function(index, record) {            
            if($.isNumeric(index)) {
                $("#tablaOrdenes4").jqGrid('addRowData',index,record);
            }
        });
        var numeroFilas = $("#tablaOrdenes4").getGridParam("reccount");
        $("#divConteo4").html("Número de registros: "+numeroFilas);         
    }
    
    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaHistorial() {
    	var URLactual = window.location;
    	
    	/*if(URLactual == 'http://localhost/mantenimiento/web/index.php?action=listar_historial' ||
         URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=listar_historial'){*/

        if(URLactual['href'].indexOf('listar_historial') >= 0){

        	$("#tablaHistorial").clearGridData();
        	data = buscarHistorialUsuario('consulta');
        	$.each(data, function(index, record) {            
            	if($.isNumeric(index)) {
                	$("#tablaHistorial").jqGrid('addRowData',index,record);
            	}
        	});
        	var numeroFilas = $("#tablaHistorial").getGridParam("reccount");
        	$("#divConteo").html("Número de registros: "+numeroFilas); 
        }                 
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaElectrico() {
        var URLactual = window.location;
        
        /*if(URLactual == 'http://localhost/mantenimiento/web/index.php?action=listar_electrico_consultas' ||
         URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=listar_electrico_consultas'){*/

        if(URLactual['href'].indexOf('listar_electrico_consultas') >= 0){

            $("#tablaOrdenes3").clearGridData();
            data = buscarOrdenesElectrico('consulta');
            $.each(data, function(index, record) {            
                if($.isNumeric(index)) {
                    $("#tablaOrdenes3").jqGrid('addRowData',index,record);
                }
            });
            var numeroFilas = $("#tablaOrdenes3").getGridParam("reccount");
            $("#divConteo2").html("Número de registros: "+numeroFilas); 
        }                 
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaHidraulico() {
        var URLactual = window.location;
        
        /*if(URLactual == 'http://localhost/mantenimiento/web/index.php?action=listar_hidraulico_consultas' ||
         URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=listar_hidraulico_consultas'){*/

        if(URLactual['href'].indexOf('listar_hidraulico_consultas') >= 0){

            $("#tablaOrdenes3").clearGridData();
            data = buscarOrdenesHidraulico('consulta');
            $.each(data, function(index, record) {            
                if($.isNumeric(index)) {
                    $("#tablaOrdenes3").jqGrid('addRowData',index,record);
                }
            });
            var numeroFilas = $("#tablaOrdenes3").getGridParam("reccount");
            $("#divConteo2").html("Número de registros: "+numeroFilas); 
        }                 
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaMobiliario() {
        var URLactual = window.location;
        
        /*if(URLactual == 'http://localhost/mantenimiento/web/index.php?action=listar_mobiliario_consultas' ||
         URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=listar_mobiliario_consultas'){*/

        if(URLactual['href'].indexOf('listar_mobiliario_consultas') >= 0){

            $("#tablaOrdenes3").clearGridData();
            data = buscarOrdenesMobiliario('consulta');
            $.each(data, function(index, record) {            
                if($.isNumeric(index)) {
                    $("#tablaOrdenes3").jqGrid('addRowData',index,record);
                }
            });
            var numeroFilas = $("#tablaOrdenes3").getGridParam("reccount");
            $("#divConteo2").html("Número de registros: "+numeroFilas); 
        }                 
    }

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes
     * en el sistema.
     */
    function actualizarTablaPlanta() {
        var URLactual = window.location;
        
        /*if(URLactual == 'http://localhost/mantenimiento/web/index.php?action=listar_planta_consultas' ||
         URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=listar_planta_consultas'){*/

        if(URLactual['href'].indexOf('listar_planta_consultas') >= 0){

            $("#tablaOrdenes3").clearGridData();
            data = buscarOrdenesPlanta('consulta');
            $.each(data, function(index, record) {            
                if($.isNumeric(index)) {
                    $("#tablaOrdenes3").jqGrid('addRowData',index,record);
                }
            });
            var numeroFilas = $("#tablaOrdenes3").getGridParam("reccount");
            $("#divConteo2").html("Número de registros: "+numeroFilas); 
        }                 
    }
    
    /**
    *funcion axuliar que actualiza el campo impreso de una solicitud
    */
    function actualizarImpreso(numeroSolicitud){
    	
		  var dataResult;
		          
        //console.log("Actualizar Impreso "+numeroSolicitud);

        $.ajax({
            type: "POST",
            url: 'index.php?action=actualizar_impreso',
            data: "buscar=" + numeroSolicitud,
            dataType: "json",
            async: false,
            error: function(error){
                alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                console.log(error.toString());
                location.reload(true);
            },
            success: function(data){
                dataResult = data;
            }
        });
        return dataResult;
    }

     /**
     * Función que llena y actualiza el selector de Edificio.
     * @param {array} data, datos que se van a actualizar en el selector.
     * @returns {undefined}
    **/    
    function actualizarSelectEdificio(idSelect)
    {
        var data = buscarEdificio(idSelect);
        //console.log(data);

        $("#edificioSearch").empty();
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
            	 if(index == 1){
            		var todos = "TODOS";
            		var row2 = $("<option value='" + todos + "'/>");
                	row2.text(todos);
                	row2.appendTo("#edificioSearch");
                }
                var row = $("<option value='" + record.codigo + "'/>");
                row.text(record.codigo + " - " + record.nombre);
                row.appendTo("#edificioSearch");                            
            }
        });        
    }

    /** funcion auxiliar que permite devolver el nombre del campus 
    */
    function getNombreCampus(data){
        if(data == 1){
            return "Meléndez";
        }
        else if(data == 2){
            return "San Fernando";
        }
        else if(data == 3){
            return "Otro"
        }
        else{
            return "";  
        }
    }

    /** funcion auxiliar que pinta un grafico dado los datos de entrada
    */
    function generarGrafico(titulo,subtitulo,xCategorias,xTitulo,yTitulo,info){
        $('#divGraficos').highcharts({
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
                pointFormat: 'Solicitudes: <b>{point.y:.0f}</b>'
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
                color: '#E60013'
            }]
        });
    }

    /**
    *funcion auxiliar que devuelve el nombre del sistema
    */
    function getNombreSistema(data){
        if(data == 1){
            return "Sistema Hidráulico y Sanitario";
        }
        else if(data == 2){
            return "Sistema Eléctrico";
        }
        else if(data == 3){
            return "Sistema Planta Física ";
        }
        else if(data == 4){
            return "Sistema Mobiliario y Equipos";
        }
        else{
            return "";
        }  
    }
    /**
    *funcion axuliar que permite recuperar el nombre de un edificio
    */
    function getNombreEdficio(campus, edificio){

        var dataResult;
        var dataSave = {};
        dataSave['campus'] = campus;
        dataSave['edificio']= edificio;

        var jObject = JSON.stringify(dataSave);

        $.ajax({
            type: "POST",
            url: 'index.php?action=obtener_nombre_edificio',
            dataType: "json",
            data: {jObject:  jObject},
            async: false,
            error: function(error){
                alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                console.log(error.toString());
                location.reload(true);
            },
            success: function(data){
                dataResult = data;
            }
        });
        return dataResult;
    }

    /**
     * Se captura el evento cuando de da click en el boton guardar modificación
     * y se realiza la operacion correspondiente.
     */     
    function guardarModOrdenes(idTabla,id)
    {
        try {           
            var idElementSelect = $("#"+idTabla).jqGrid('getGridParam','selarrrow');

            if(id == ""){
                aux = 2;
            }else{
                aux = id;
            }
            
            if($.trim($("#descripcion"+aux).val()) == ""){
                alert("Error, la descripción no puede estar vacía");
            }else if($.trim($("#estado").val()) == "Seleccionar"){
                alert("Error, seleccione un estado");
            }else{
            
                var saveData = {}, solicitud = {}, usuario = {};

                //console.log("Elementos "+idElementSelect);
                
                for(i=0;i<idElementSelect.length;i++){
            
                    var elementSelect = $("#"+idTabla).jqGrid('getRowData',idElementSelect[i]);

                    //var saveData = {};
                    solicitud[i] = elementSelect.numero_solicitud;
                    usuario[i] = elementSelect.usuario;

                    /*saveData["solicitud"] = elementSelect.numero_solicitud;
                    saveData["usuario"] = $("#usuario").val();
                    saveData["estado"] = $.trim($("#selectEstado").find(':selected').val());
                    saveData["descripcion"] = $.trim($("#descripcion").val());*/
                }
                
                saveData["solicitud"] = solicitud;
                saveData["usuario"] = usuario;
                saveData["estado"] = $.trim($("#selectEstado").find(':selected').val());
                saveData["descripcion"] = $.trim($("#descripcion"+aux).val());

                if ($.trim($("#selectEstado").find(':selected').val()) == 'Realizado') {
                    saveData["operario"] = $.trim($("#selectOperario").find(':selected').val());
                }else{
                    saveData["operario"] = "";
                }
                console.log(saveData);
                    
                    /*if($.trim($("#descripcion").val()) == ""){
                        alert("Error, la descripción no puede estar vacía");
                    }else{*/
                        //console.log(saveData);      
                var jObject = JSON.stringify(saveData);

                //console.log("Prueba "+jObject);

                $.ajax({
                    type: "POST",
                    url: "index.php?action=actualizar_orden_varios",
                    data: {jObject:  jObject},
                    dataType: "json",
                    error: function(error){
                        alert("La sesión ha expirado, por favor ingrese nuevamente al sistema");
                        console.log(error.toString());
                        location.reload(true);
                    },
                    success: function(result){
                        if(result.value == true) {
                        $("#divDialogModificacion"+id).dialog("close");
                            alert(result.mensaje);
                            for(i=0;i<idElementSelect.length;i++){
                                var elementSelect = $("#"+idTabla).jqGrid('getRowData',i);
                                //console.log(elementSelect.numero_solicitud);
                                var data = buscarSolicitud(elementSelect.numero_solicitud);
                                /*if(i==0){
                                    $("#tablaOrdenes").clearGridData();
                                }*/
                                $('#'+idTabla).jqGrid('delRowData',i);
                                actualizarTablaOrdenesVarios(data,id);
                            }
                            $('#'+idTabla).jqGrid('resetSelection');
                        }
                        else {
                            alert(result.mensaje);
                        }
                    }
                });
                    //}
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error " + ex);
        }        
    }
    
/*********************************Funciones de Impresion**************************************/    
    /**
     * funcion que genera el archivo pdf usando la libreria BytescoutPDF.js
     *se utiliza la libreria bytescoutpdf para la generacion del pdf documentacion ->https://bytescout.com/products/developer/pdfgeneratorsdkjs/index.html
     */
    function generarPDF(data, numeroSolicitudes)
    {
    	var arregloSolicitudes = data[0];
        var arregloUsers = data[1];
		var arregloCampus = data[2];
        var arregloEdificios = data[3];
        
        var pdf = new BytescoutPDF();      
 
        //Definir el tipo de documento
        pdf.pageSetSize(BytescoutPDF.A4);
 
        //Definir la orientacion del pdf
        pdf.pageSetOrientation(false);
        
    	for(i=0;i<numeroSolicitudes;i++){
    	  	var dataOrder = buscarOrdenes(arregloSolicitudes[i]);
            var dataUser = buscarDatosUsuario(arregloUsers[i]);
            var dataEdificio = getNombreEdficio(arregloCampus[i], arregloEdificios[i]);
            var dataCampus = getNombreCampus(arregloCampus[i]);
            //var descripcion;


            // Agregar la nueva pagina
            pdf.pageAdd();

            // configurar fuente
            pdf.fontSetName('Helvetica');

            // Agregar configuraciones
            pdf.fontSetStyle(true, false, false);
            //header
            pdf.imageLoadFromUrl('images/logouv.png');
            pdf.imagePlace(50, 25);
            pdf.fontSetSize(15);
            pdf.textAdd(50, 65, 'ORDEN DE MANTENIMIENTO', 0);
            pdf.graphicsSetLineWidth(0.5);
            //cuerpo del archivo pdf
            pdf.graphicsDrawLine(49, 75, 570, 75);
            pdf.fontSetSize(10);
            pdf.fontSetStyle(false, false, false);
            pdf.graphicsDrawRectangle(50, 84, 175, 20);

            //informacion del usuario
            $.each(dataOrder, function(index, record)
            {
             if($.isNumeric(index))
             {
                 pdf.textAdd(52, 100, 'Número Solicitud:   '+record.numero_solicitud);
                 arregloNumSolicitudes.push(record.numero_solicitud);
                 pdf.graphicsDrawRectangle(225, 84, 175, 20);
                 pdf.textAdd(227, 100, 'Fecha:  '+record.fecha);
                 pdf.graphicsDrawRectangle(400, 84, 145, 20);
                 pdf.textAdd(402, 100, 'Estado:  '+record.estado);
                 pdf.graphicsDrawRectangle(50, 104, 235, 20);
             }
            });

            //campus
            pdf.graphicsDrawRectangle(50, 124, 115, 20);
            pdf.textAdd(51, 140, "Campus: "+dataCampus);

            //datos del usuario
            $.each(dataUser, function(index, record)
            {
             if($.isNumeric(index))
             {

                 pdf.textAdd(51, 120, 'Solicitante: '+record.nombre_usuario);
                 pdf.graphicsDrawRectangle(285, 104, 115, 20);
                 pdf.textAdd(287, 120, 'Teléfono: '+record.telefono);
                 pdf.graphicsDrawRectangle(400, 104, 145, 20);
                 pdf.textAdd(402, 120, 'Extensión:  '+record.extension);
             }
            });

            //datos del espacio de la orden
            $.each(dataOrder, function(index, record)
            {
             if($.isNumeric(index))
             {
                 pdf.graphicsDrawRectangle(470, 124, 75, 20);
                 pdf.textAdd(472, 140, 'Piso: '+record.piso);

                 //validar si hay datos null en la consulta
                 if(record.espacio == "" || record.espacio == null){
                     pdf.graphicsDrawRectangle(50, 144, 495, 20);
                     pdf.textAdd(51, 160,"Espacio: " + "No se registró espacio en la orden");
                 }
                 else{
                    pdf.graphicsDrawRectangle(50, 144, 495, 20);
                    pdf.textAdd(51, 160,"Espacio: " + record.espacio);
                 }
                 

                 if(record.contacto == "" || record.contacto == null){
                     pdf.graphicsDrawRectangle(50, 144, 495, 20);
                     pdf.textAdd(51, 160, "Contacto: " + "No se registró contacto en la orden");
                 }
                 else{
                     pdf.graphicsDrawRectangle(50, 164, 495, 20);
                     pdf.textAdd(51, 180, "Contacto: "+record.contacto);
                 }
                 
                 
             }
            });
            $.each(dataEdificio, function(index, record){
             if($.isNumeric(index)){                 
                 pdf.graphicsDrawRectangle(165, 124, 305, 20);
                 var nombre = record.nombre;
                 if(nombre.length > 40){
                    nombre = nombre.substr(0,40);
                 }
                 pdf.textAdd(167,140, 'Edificio: '+record.codigo+" / "+nombre);
             }
            });

            //datos de la novedad
            $.each(dataOrder, function(index, record){
             if($.isNumeric(index)){
                 pdf.graphicsDrawRectangle(50,184,415,20);
                 pdf.graphicsDrawRectangle(50,204,495,20);
                 pdf.textAdd(51, 200, "Tarea 1: "+record.descripcion1);
                 pdf.textAdd(51, 220, "Descripción Tarea 1: "+record.descripcion_novedad);
             }
            });

            $.each(dataOrder, function(index, record){
             if($.isNumeric(index)){
                 pdf.graphicsDrawRectangle(465,184,80,20);
                 pdf.textAdd(467, 200, "Cantidad: "+record.cantidad1);
             }
            });

            $.each(dataOrder, function(index,record){
             if($.isNumeric(index)){
                 if(record.descripcion2 == '' || record.descripcion2 == null){
                     pdf.graphicsDrawRectangle(50,224,415,20);
                     pdf.graphicsDrawRectangle(50,244,495,20);
                     pdf.textAdd(51, 240, "Tarea 2: "+"----------");
                     pdf.textAdd(51, 260, "Descripción Tarea 2: "+"----------");
                 }
                 else{
                     pdf.graphicsDrawRectangle(50,224,415,20);
                     pdf.graphicsDrawRectangle(50,244,495,20);
                     pdf.textAdd(51, 240, "Tarea 2: "+record.descripcion2); 
                     pdf.textAdd(51, 260, "Descripción Tarea 2: "+record.descripcion_novedad2);     
                 }
             }            
            });

            $.each(dataOrder, function(index,record){
             if($.isNumeric(index)){
                 if(record.descripcion3 == '' || record.descripcion3 == null)
                 {
                     pdf.graphicsDrawRectangle(465,224,80,20);
                     pdf.textAdd(467, 240,  "Cantidad: "+"-----");
                 }
                 else{
                     pdf.graphicsDrawRectangle(465,224,80,20);
                     pdf.textAdd(467, 240,  "Cantidad: "+record.cantidad2);
                 }
             }
            });

            $.each(dataOrder, function(index,record){
             if($.isNumeric(index)){
                 if(record.descripcion3 == '' || record.descripcion3 == null){
                     pdf.graphicsDrawRectangle(50,264,415,20);
                     pdf.graphicsDrawRectangle(50,284,495,20);
                     pdf.textAdd(51, 280, "Tarea 3: "+"----------");
                     pdf.textAdd(51, 300, "Descripción Tarea 3: "+"----------");
                 }
                 else{
                     pdf.graphicsDrawRectangle(50,264,415,20);
                     pdf.graphicsDrawRectangle(50,284,495,20);
                     pdf.textAdd(51, 280, "Tarea 3: "+record.descripcion3);    
                     pdf.textAdd(51, 300, "Descripción Tarea 3: "+record.descripcion_novedad3);  
                 }
             }            
            });
            
            $.each(dataOrder, function(index,record){
             if($.isNumeric(index)){
                 if(record.descripcion3 == '' || record.descripcion3 == null)
                 {
                     pdf.graphicsDrawRectangle(465,264,80,20);
                     pdf.textAdd(467, 280,  "Cantidad: "+"-----");
                 }
                 else{
                     pdf.graphicsDrawRectangle(465,264,80,20);
                     pdf.textAdd(467, 280,  "Cantidad: "+record.cantidad3);
                 }
                 //descripcion = record.descripcion;
                }
            });

            //informacion adicional 329
            pdf.graphicsDrawRectangle(50, 304, 175, 55);
            pdf.textAdd(52, 320, 'Trabajo Realizado:');
            /*if(descripcion != null){
                if(descripcion.length > 25){
                    var descripcion1 = descripcion.substr(0,35);
                    pdf.textAdd(54, 336, ''+descripcion1);
                    var descripcion2 = descripcion.substr(36,descripcion.length);
                    if(descripcion2.length > 25){
                        descripcion2 = descripcion2.substr(0,35);
                        var descripcion3 = descripcion2.substr(36,descripcion.length);
                        if(descripcion3.length > 25){
                            descripcion3 = descripcion3.substr(0,35);
                        }
                        pdf.textAdd(54, 352, ''+descripcion2);
                        pdf.textAdd(54, 368, ''+descripcion3);
                    }else{
                        pdf.textAdd(54, 336, ''+descripcion1);
                        pdf.textAdd(54, 352, ''+descripcion2);
                    }
                }else{
                    pdf.textAdd(54, 336,  ''+descripcion);
                }
            }*/
            pdf.graphicsDrawRectangle(225, 304, 175, 55);
            pdf.textAdd(227, 320, 'Materiales utilizados:');
            pdf.graphicsDrawRectangle(400, 304, 145, 55);
            pdf.textAdd(402, 320, 'Fecha de ejecución (D-M-A):');

            pdf.graphicsDrawRectangle(50, 359, 175, 35);
            pdf.textAdd(52, 370, 'Solicitante:');
            pdf.graphicsDrawRectangle(225, 359, 175, 35);
            pdf.textAdd(227, 370, 'Realizado por:');
            pdf.graphicsDrawRectangle(400, 359, 145, 35);
            pdf.textAdd(402, 370, 'Revisado por:');
            pdf.textSetAlign(BytescoutPDF.LEFT);
        }
 
     return pdf;
    
    }

    /**
     * funcion que permite generar el link de descargar de la orden en formato pdf en del div de mensajes de la aplicacion 
     * @param {[type]} PDFContentBase64 [description]
     */
    function generarLinkDescarga(PDFContentBase64)
    {
        var pdfdiv = document.getElementById("divMensaje");
        for(i=0;i<arregloNumSolicitudes.length;i++){
        	actualizarImpreso(arregloNumSolicitudes[i]);
        }
        pdfdiv.innerHTML ='<h4><a title=\"Archivo PDF \" target=\"_blank \" href=\"data:application/pdf;base64,' + PDFContentBase64 + '\">Se generó de forma correcta el pdf. Haga click para visualizarlo.<\/a></h4>';
    }
    

    
/********************************Eventos de los componentes del frm de consultas***********************************************/
    /*
    cargar los datepicker de jQuery UI y su configuración para idioma español
     */
    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
        dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    $(function () {
        //$("#searchFecha").datepicker();
        $("#searchFecha").datepicker({
            defaultDate: "w",
            changeMonth: true,
            numberOfMonths: 1,
        });
        $("#searchFechaInicial").datepicker({
            defaultDate: "-1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#searchFechaFinal" ).datepicker( "option", "minDate", selectedDate );
            }
        });
        $("#searchFechaFinal").datepicker({
            defaultDate: "-1w",
            changeMonth: true,
            numberOfMonths: 1,
            onClose: function( selectedDate ) {
                $( "#searchFechaInicial" ).datepicker( "option", "maxDate", selectedDate );
            }
        });
        actualizarTablaHistorial();
        /*actualizarTablaElectrico();
        actualizarTablaHidraulico();
        actualizarTablaMobiliario();
        actualizarTablaPlanta();*/
        
    });

    /**
     * Se captura el evento cuando de da click en el boton buscar y se
     * realiza la operacion correspondiente.
     */
    $("#buscarOrdenes").click(function () {
        var vlrinput = $("#search").val();
        $("#tablaOrdenes").clearGridData();
        
        if(vlrinput != ""){
            var data =  buscarOrdenes(vlrinput);
            actualizarTablaOrdenes(data);
            $("#search").val("");
            $("#btImprimir").removeAttr('Disabled');
            $("#visualizarOrdenes").removeAttr('Disabled');
            $("#modificarOrdenes").removeAttr('Disabled');
        }
        else{
            mostrarMensaje("Ingrese un valor en el campo de búsqueda");
            $("#btImprimir").prop('disabled', true);
            $("#visualizarOrdenes").prop('disabled', true);
            $("#modificarOrdenes").prop('disabled', true);
		    //$("#tablaOrdenes").clearGridData();
        }
    });

    /**
     * Se captura el evento cuando se da click en el boton buscar y se
     * realiza la operacion correspondiente.
     */
    $("#visualizarEstadisticas").click(function () {

        var URLactual = window.location;
        var totalSolicitudes = 0;
        var campus = $("#campusSearch").find(':selected').val();
        var sistema = $("#sistemaSearch").find(':selected').val();
        var fechaInicial = $("#searchFechaInicial").val();
        var fechaFinal = $("#searchFechaFinal").val();
        var nombreSistema = "";

        if(campus != 0 & sistema != 0 & fechaInicial != "" & fechaFinal != ""){
            saveData = [campus,sistema,fechaInicial,fechaFinal];

            if(URLactual['href'].indexOf('estadisticas_edificios') >= 0){
            //if(URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=estadisticas_edificios' || URLactual == 'http://localhost/mantenimiento/web/index.php?action=estadisticas_edificios'){
                estadisticas = obtenerEstadisticasEdificios(saveData);
                label = [], informacion = [];
                tipo = "Edificios";
                
                $.each(estadisticas, function(posicion, info){
                    if(!isNaN(info.codigo_edificio)){
                     label.push(info.codigo_edificio);
                     informacion.push(info.conteosolicitudes);
                    }
                });
                if(estadisticas != null){
                    var aux;
                    var categorias = [], info = [];

                    if (!isNaN(informacion[0])) {
                        aux = parseInt(informacion[0]);
                        totalSolicitudes = aux;
                        categorias.push(label[0]);
                        info.push(parseInt(informacion[0]));
                    }if (!isNaN(informacion[1])) {
                        aux = parseInt(informacion[1]);
                        totalSolicitudes += aux;
                        categorias.push(label[1]);
                        info.push(parseInt(informacion[1]));
                    }if (!isNaN(informacion[2])) {
                        aux = parseInt(informacion[2]);
                        totalSolicitudes += aux;
                        categorias.push(label[2]);
                        info.push(parseInt(informacion[2]));
                    }if (!isNaN(informacion[3])) {
                        aux = parseInt(informacion[3]);
                        totalSolicitudes += aux;
                        categorias.push(label[3]);
                        info.push(parseInt(informacion[3]));
                    }if (!isNaN(informacion[4])) {
                        aux = parseInt(informacion[4]);
                        totalSolicitudes += aux;
                        categorias.push(label[4]);
                        info.push(parseInt(informacion[4]));
                    }if (!isNaN(informacion[5])) {
                        aux = parseInt(informacion[5]);
                        totalSolicitudes += aux;
                        categorias.push(label[5]);
                        info.push(parseInt(informacion[5]));
                    }if (!isNaN(informacion[6])) {
                        aux = parseInt(informacion[6]);
                        totalSolicitudes += aux;
                        categorias.push(label[6]);
                        info.push(parseInt(informacion[6]));
                    }if (!isNaN(informacion[7])) {
                        aux = parseInt(informacion[7]);
                        totalSolicitudes += aux;
                        categorias.push(label[7]);
                        info.push(parseInt(informacion[7]));
                    }if (!isNaN(informacion[8])) {
                        aux = parseInt(informacion[8]);
                        totalSolicitudes += aux;
                        categorias.push(label[8]);
                        info.push(parseInt(informacion[8]));
                    }if (!isNaN(informacion[9])) {
                        aux = parseInt(informacion[9]);
                        totalSolicitudes += aux;
                        categorias.push(label[9]);
                        info.push(parseInt(informacion[9]));
                    }

                    var titulo = tipo+" con más solicitudes";
                    var subtitulo = 'Desde: '+fechaInicial+" hasta: "+fechaFinal;
                    //var categorias = [label[0],label[1],label[2],label[3],label[4],label[5],label[6],label[7],label[8],label[9]];
                    var xTitulo = tipo;
                    var yTitulo = 'Número de Solicitudes (Total: '+totalSolicitudes+')';
                    //var info = [parseInt(informacion[0]),parseInt(informacion[1]),parseInt(informacion[2]),parseInt(informacion[3]),parseInt(informacion[4]),parseInt(informacion[5]),parseInt(informacion[6]),parseInt(informacion[7]),parseInt(informacion[8]),parseInt(informacion[9])];

                    generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
                }
            }else if(URLactual['href'].indexOf('estadisticas_espacios') >= 0){
            //}else if(URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=estadisticas_espacios' || URLactual == 'http://localhost/mantenimiento/web/index.php?action=estadisticas_espacios'){
                estadisticas = obtenerEstadisticasEspacios(saveData);
                label = [], informacion = [];
                tipo = "Espacios";

                //console.log(estadisticas);
                
                $.each(estadisticas, function(posicion, info){
                    if(!isNaN(info.codigo_edificio)){
                     label.push(info.codigo_edificio + ":" + info.espacio);
                     informacion.push(info.conteosolicitudes);
                    }
                });

                if(estadisticas != null){
                    var aux;
                    var categorias = [], info = [];

                    if (!isNaN(informacion[0])) {
                        aux = parseInt(informacion[0]);
                        totalSolicitudes = aux;
                        categorias.push(label[0]);
                        info.push(parseInt(informacion[0]));
                    }if (!isNaN(informacion[1])) {
                        aux = parseInt(informacion[1]);
                        totalSolicitudes += aux;
                        categorias.push(label[1]);
                        info.push(parseInt(informacion[1]));
                    }if (!isNaN(informacion[2])) {
                        aux = parseInt(informacion[2]);
                        totalSolicitudes += aux;
                        categorias.push(label[2]);
                        info.push(parseInt(informacion[2]));
                    }if (!isNaN(informacion[3])) {
                        aux = parseInt(informacion[3]);
                        totalSolicitudes += aux;
                        categorias.push(label[3]);
                        info.push(parseInt(informacion[3]));
                    }if (!isNaN(informacion[4])) {
                        aux = parseInt(informacion[4]);
                        totalSolicitudes += aux;
                        categorias.push(label[4]);
                        info.push(parseInt(informacion[4]));
                    }if (!isNaN(informacion[5])) {
                        aux = parseInt(informacion[5]);
                        totalSolicitudes += aux;
                        categorias.push(label[5]);
                        info.push(parseInt(informacion[5]));
                    }if (!isNaN(informacion[6])) {
                        aux = parseInt(informacion[6]);
                        totalSolicitudes += aux;
                        categorias.push(label[6]);
                        info.push(parseInt(informacion[6]));
                    }if (!isNaN(informacion[7])) {
                        aux = parseInt(informacion[7]);
                        totalSolicitudes += aux;
                        categorias.push(label[7]);
                        info.push(parseInt(informacion[7]));
                    }if (!isNaN(informacion[8])) {
                        aux = parseInt(informacion[8]);
                        totalSolicitudes += aux;
                        categorias.push(label[8]);
                        info.push(parseInt(informacion[8]));
                    }if (!isNaN(informacion[9])) {
                        aux = parseInt(informacion[9]);
                        totalSolicitudes += aux;
                        categorias.push(label[9]);
                        info.push(parseInt(informacion[9]));
                    }

                    var titulo = tipo+" con más solicitudes";
                    var subtitulo = 'Desde: '+fechaInicial+" hasta: "+fechaFinal;
                    //var categorias = [label[0],label[1],label[2],label[3],label[4],label[5],label[6],label[7],label[8],label[9]];
                    var xTitulo = tipo;
                    var yTitulo = 'Número de Solicitudes (Total: '+totalSolicitudes+')';
                    //var info = [parseInt(informacion[0]),parseInt(informacion[1]),parseInt(informacion[2]),parseInt(informacion[3]),parseInt(informacion[4]),parseInt(informacion[5]),parseInt(informacion[6]),parseInt(informacion[7]),parseInt(informacion[8]),parseInt(informacion[9])];

                    generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);
                }
            }else if(URLactual['href'].indexOf('estadisticas_sistema') >= 0){
            //}else if(URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=estadisticas_sistema' || URLactual == 'http://localhost/mantenimiento/web/index.php?action=estadisticas_sistema'){

                var data =  obtenerEstadisticasSistema(saveData);

                label = [], informacion = [];
            
                $.each(data, function(posicion, info){
                    if(posicion < 3){
                        label.push(info.estado);
                        informacion.push(info.conteosolicitudes);
                    }
                });

                var aux;
                if (!isNaN(informacion[0])) {
                    aux = parseInt(informacion[0]);
                    totalSolicitudes = aux;
                };
                if (!isNaN(informacion[1])) {
                    aux = parseInt(informacion[1]);
                    totalSolicitudes += aux;
                };
                if (!isNaN(informacion[2])) {
                    aux = parseInt(informacion[2]);
                    totalSolicitudes += aux;
                };

                var infoSolicitud = [];

                if (label[0] == 'Solicitado') {
                    infoSolicitud[0] = parseInt(informacion[0]);
                }else if(label[0] == 'Revisado'){
                    infoSolicitud[1] = parseInt(informacion[0]);
                }else if(label[0] == 'Realizado'){
                    infoSolicitud[2] = parseInt(informacion[0]);
                }else{
                    infoSolicitud[0] = 0;
                }

                if (label[1] == 'Solicitado') {
                    infoSolicitud[0] = parseInt(informacion[1]);
                }else if(label[1] == 'Revisado'){
                    infoSolicitud[1] = parseInt(informacion[1]);
                }else if(label[1] == 'Realizado'){
                    infoSolicitud[2] = parseInt(informacion[1]);
                }else{
                    infoSolicitud[1] = 0;
                }

                if (label[2] == 'Solicitado') {
                    infoSolicitud[0] = parseInt(informacion[2]);
                }else if(label[2] == 'Revisado'){
                    infoSolicitud[1] = parseInt(informacion[2]);
                }else if(label[2] == 'Realizado'){
                    infoSolicitud[2] = parseInt(informacion[2]);
                }else{
                    infoSolicitud[2] = 0;
                }

                if (sistema == 1) {
                    nombreSistema = "Sistema Hidráulico y Sanitario";
                }if (sistema == 2) {
                    nombreSistema = "Sistema Eléctrico";
                }if (sistema == 3) {
                    nombreSistema = "Sistema Planta Física";
                }if (sistema == 4) {
                    nombreSistema = "Sistema Mobiliario y Equipos";
                }if (sistema == 5) {
                    nombreSistema = "Todos los Sistemas";
                }

                var titulo = 'Estadísticas '+nombreSistema;
                var subtitulo = 'Desde: '+fechaInicial+" hasta: "+fechaFinal;
                var categorias = ['Solicitado','Revisado','Realizado'];
                var xTitulo = "Estado solicitud";
                var yTitulo = 'Número de Solicitudes (Total: '+totalSolicitudes+')';
                var info = [infoSolicitud[0],infoSolicitud[1],infoSolicitud[2]];

                generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);

                $('#campusSearch').prop('selectedIndex',0);
                $('#sistemaSearch').prop('selectedIndex',0);
                $('#searchFechaInicial').val("dd/mm/aaaa");
                $('#searchFechaFinal').val("dd/mm/aaaa");
            }else if(URLactual['href'].indexOf('estadisticas_operador') >= 0){
            //}else if(URLactual == 'http://192.168.46.53/mantenimiento/web/index.php?action=estadisticas_sistema' || URLactual == 'http://localhost/mantenimiento/web/index.php?action=estadisticas_sistema'){

                var data =  obtenerEstadisticasOperador(saveData);

                label = [], informacion = [];
            
                $.each(data, function(posicion, info){
                    if(posicion < 3){
                        label.push(info.operario);
                        informacion.push(info.conteosolicitudes);
                    }
                });

                var aux;
                if (!isNaN(informacion[0])) {
                    aux = parseInt(informacion[0]);
                    totalSolicitudes = aux;
                };
                if (!isNaN(informacion[1])) {
                    aux = parseInt(informacion[1]);
                    totalSolicitudes += aux;
                };

                var infoSolicitud = [];

                if (label[0] == 'Contratista') {
                    infoSolicitud[0] = parseInt(informacion[0]);
                    if(label[1] == 'Propio'){
                        infoSolicitud[1] = parseInt(informacion[1]);
                    }else{
                        infoSolicitud[1] = 0;
                    }                    
                }else{
                    infoSolicitud[0] = 0;
                    infoSolicitud[1] = parseInt(informacion[0]);
                }

                if (sistema == 1) {
                    nombreSistema = "Sistema Hidráulico y Sanitario";
                }if (sistema == 2) {
                    nombreSistema = "Sistema Eléctrico";
                }if (sistema == 3) {
                    nombreSistema = "Sistema Planta Física";
                }if (sistema == 4) {
                    nombreSistema = "Sistema Mobiliario y Equipos";
                }if (sistema == 5) {
                    nombreSistema = "Todos los Sistemas";
                }

                var titulo = 'Estadísticas '+nombreSistema;
                var subtitulo = 'Desde: '+fechaInicial+" hasta: "+fechaFinal;
                var categorias = ['Contratista','Propio'];
                var xTitulo = "Operario";
                var yTitulo = 'Número de Solicitudes (Total: '+totalSolicitudes+')';
                var info = [infoSolicitud[0],infoSolicitud[1]];

                generarGrafico(titulo,subtitulo,categorias,xTitulo,yTitulo,info);

                $('#campusSearch').prop('selectedIndex',0);
                $('#sistemaSearch').prop('selectedIndex',0);
                $('#searchFechaInicial').val("dd/mm/aaaa");
                $('#searchFechaFinal').val("dd/mm/aaaa");
            }
        }else{
            alert("ERROR. Por favor rellene todos los campos")
        }
    });

    /**
     * Se captura el evento cuando de da click en el boton buscar y se
     * realiza la operacion correspondiente.
     */
    $("#buscarOrdenes2").click(function () {
        var campus = $("#campusSearch").find(':selected').val();
        var sistema = $("#sistemaSearch").find(':selected').val();
        var fechaInicio = $("#searchFechaInicial").val();
        var fechaFin = $("#searchFechaFinal").val();
        $("#tablaOrdenes2").clearGridData();
        
        if(campus != 0 & sistema != 0 & fechaInicio != "" & fechaFin != "")
        {
            //if(fechaInicio <= fechaFin){
                saveData = [campus,sistema,fechaInicio,fechaFin];
                var data =  buscarOrdenesParametros(saveData);
                actualizarTablaOrdenes2(data);
                $("#btImprimir2").removeAttr('Disabled');
                $("#visualizarOrdenes2").removeAttr('Disabled');
                $("#modificarOrdenes2").removeAttr('Disabled');
                //$('#campusSearch').prop('selectedIndex',0);
                //$('#sistemaSearch').prop('selectedIndex',0);
                //$('#searchFecha').val("dd/mm/aaaa");
            /*}else{
                mostrarMensaje("Error. La fecha inicio no puede ser mayor que la fecha final.");
                $("#btImprimir2").prop('disabled', true);
                $("#visualizarOrdenes2").prop('disabled', true);
                $("#modificarOrdenes2").prop('disabled', true);
            }*/
        }
        else{
            mostrarMensaje("Error. No puede dejar selectores sin opciones validas seleccionada.");
            $("#btImprimir2").prop('disabled', true);
            $("#visualizarOrdenes2").prop('disabled', true);
            $("#modificarOrdenes2").prop('disabled', true);
            //$("#tablaOrdenes2").clearGridData();
        }
    });

    /**
     * Se captura el evento cuando de da click en el boton buscar y se
     * realiza la operacion correspondiente.
     */
    $("#buscarOrdenes3").click(function () {
        var campus = $("#campusSearch").find(':selected').val();
        var edificio = $("#edificioSearch").find(':selected').val();
        var sistema = $("#sistemaSearch").find(':selected').val();
        var fechaInicial = $("#searchFechaInicial").val();
        var fechaFinal = $("#searchFechaFinal").val();
        $("#tablaOrdenes2").clearGridData();

        //if(fechaInicial <= fechaFinal){
        
        	if(campus != 0 & sistema != 0 & edificio != "--" & fechaInicial != "" & fechaFinal != "")
        	{
                saveData = [campus,edificio,sistema,fechaInicial,fechaFinal];
                var data =  buscarOrdenesParametrosAvanzados(saveData);
                actualizarTablaOrdenes2(data);
                $("#btImprimir3").removeAttr('Disabled');
                $("#visualizarOrdenes3").removeAttr('Disabled');
                $("#modificarOrdenes2").removeAttr('Disabled');
                /*$('#campusSearch').prop('selectedIndex',0);
                $("#edificioSearch").prop('selectedIndex',"--");
                $('#sistemaSearch').prop('selectedIndex',0);
                $('#searchFechaInicial').val("dd/mm/aaaa");
                $('#searchFechaFinal').val("dd/mm/aaaa");*/
  	
     	   }
     	   else{
   	         mostrarMensaje("Error. No puede dejar selectores sin opciones validas seleccionada.");
            	$("#btImprimir3").prop('disabled', true);
                $("#visualizarOrdenes3").prop('disabled', true);
                $("#modificarOrdenes2").prop('disabled', true);
          	  //$("#tablaOrdenes2").clearGridData();
        	}
        /*}else{
        	mostrarMensaje("Error. La fecha inicio no puede ser mayor que la fecha final.");
            $("#btImprimir3").prop('disabled', true);
            $("#visualizarOrdenes3").prop('disabled', true);
            $("#modificarOrdenes2").prop('disabled', true);
        }*/
    });

    /**
     * Se captura el evento cuando de da click en el boton buscar y se
     * realiza la operacion correspondiente.
     */
    $("#buscarOrdenes4").click(function () {

        var URLactual = window.location;

        var campus = '1';
        var edificio = 'TODOS';
        var sistema = '10';
        var fechaInicial = $("#searchFechaInicial").val();
        var fechaFinal = $("#searchFechaFinal").val();
        $("#tablaOrdenes3").clearGridData();

        if(URLactual['href'].indexOf('listar_electrico_consultas') >= 0){
            sistema = '2';
        }else if(URLactual['href'].indexOf('listar_hidraulico_consultas') >= 0){
            sistema = '1';
        }else if(URLactual['href'].indexOf('listar_mobiliario_consultas') >= 0){
            sistema = '4';
        }else if(URLactual['href'].indexOf('listar_planta_consultas') >= 0){
            sistema = '3';
        }

        //if(fechaInicial <= fechaFinal){
        
            if(campus != 0 & sistema != 0 & edificio != "--" & fechaInicial != "" & fechaFinal != "")
            {
                saveData = [campus,edificio,sistema,fechaInicial,fechaFinal];
                var data =  buscarOrdenesParametrosAvanzados(saveData);
                actualizarTablaOrdenes3(data);
                $("#btImprimir5").removeAttr('Disabled');
                $("#visualizarOrdenes4").removeAttr('Disabled');
                $("#modificarOrdenes3").removeAttr('Disabled');
                /*$('#campusSearch').prop('selectedIndex',0);
                $("#edificioSearch").prop('selectedIndex',"--");
                $('#sistemaSearch').prop('selectedIndex',0);
                $('#searchFechaInicial').val("dd/mm/aaaa");
                $('#searchFechaFinal').val("dd/mm/aaaa");*/
    
           }
           else{
             mostrarMensaje("Error. No puede dejar selectores sin opciones validas seleccionada.");
                $("#btImprimir5").prop('disabled', true);
                $("#visualizarOrdenes4").prop('disabled', true);
                $("#modificarOrdenes3").prop('disabled', true);
              //$("#tablaOrdenes2").clearGridData();
            }
        /*}else{
            mostrarMensaje("Error. La fecha inicio no puede ser mayor que la fecha final.");
            $("#btImprimir5").prop('disabled', true);
            $("#visualizarOrdenes4").prop('disabled', true);
            $("#modificarOrdenes3").prop('disabled', true);
        }*/
    });

    /**
     * Se captura el evento cuando de da click en el boton buscar y se
     * realiza la operacion correspondiente.
     */
    $("#buscarOrdenes5").click(function () {

        //var URLactual = window.location;

        var campus = '10';
        var edificio = 'TODOS';
        var sistema = '10';
        var fechaInicial = $("#searchFecha").val();
        var fechaFinal = $("#searchFecha").val();
        $("#tablaOrdenes4").clearGridData();

        //if(fechaInicial <= fechaFinal){
        
            if(campus != 0 & sistema != 0 & edificio != "--" & fechaInicial != "")
            {
                saveData = [campus,edificio,sistema,fechaInicial,fechaFinal];
                var data =  buscarOrdenesParametrosAvanzados(saveData);
                actualizarTablaOrdenes4(data);
                $("#btImprimir6").removeAttr('Disabled');
                $("#visualizarOrdenes5").removeAttr('Disabled');
                $("#modificarOrdenes5").removeAttr('Disabled');
                /*$('#campusSearch').prop('selectedIndex',0);
                $("#edificioSearch").prop('selectedIndex',"--");
                $('#sistemaSearch').prop('selectedIndex',0);
                $('#searchFechaInicial').val("dd/mm/aaaa");
                $('#searchFechaFinal').val("dd/mm/aaaa");*/
    
           }
           else{
             mostrarMensaje("Error. No puede dejar selectores sin opciones validas seleccionada.");
                $("#btImprimir6").prop('disabled', true);
                $("#visualizarOrdenes5").prop('disabled', true);
                $("#modificarOrdenes5").prop('disabled', true);
              //$("#tablaOrdenes2").clearGridData();
            }
        /*}else{
            mostrarMensaje("Error. La fecha inicio no puede ser mayor que la fecha final.");
            $("#btImprimir5").prop('disabled', true);
            $("#visualizarOrdenes4").prop('disabled', true);
            $("#modificarOrdenes3").prop('disabled', true);
        }*/
    });
    
    /**
     * Evento que permite imprimir una o más ordenes o solicitudes de mantenimiento
     */
    $("#btImprimir").click(function (e) {

        if(confirm("¿Está seguro que desea imprimir la orden de mantenimiento?")){
            var idElementSelect = $("#tablaOrdenes").jqGrid('getGridParam','selarrrow');
            var elementSelect = []
            var numeroSolicitudes = idElementSelect.length;
            var solicitud = [];
            var usuario = [];
            var campus = [];
            var edificio = [];
            
            for(i=0;i<numeroSolicitudes;i++){
            	elementSelect[i] = $("#tablaOrdenes").jqGrid('getRowData',idElementSelect[i]);
            	solicitud[i] = elementSelect[i].numero_solicitud;
            	usuario[i] = elementSelect[i].usuario;
            	campus[i] = elementSelect[i].codigo_campus;
            	edificio[i] = elementSelect[i].codigo_edificio;

            }
            
            var data = [solicitud,usuario,campus,edificio];

            //console.log(data);

                
            var pdf = generarPDF(data, numeroSolicitudes);
                
            pdf.onload(function() {
            	var PDFContentBase64 = pdf.getBase64Text();
               generarLinkDescarga(PDFContentBase64);
            });
        }
    });

    /**
     * Evento que permite imprimir una o varias ordenes o solicitudes de mantenimiento
     */
    $("#btImprimir2").click(function () {
        if(confirm("¿Está seguro que desea imprimir la orden de mantenimiento?")){

            var idElementSelect = $("#tablaOrdenes2").jqGrid('getGridParam','selarrrow');
            var elementSelect = []
            var numeroSolicitudes = idElementSelect.length;
            var solicitud = [];
            var usuario = [];
            var campus = [];
            var edificio = [];
            var estado = [];
            
            for(i=0;i<numeroSolicitudes;i++){
            	elementSelect[i] = $("#tablaOrdenes2").jqGrid('getRowData',idElementSelect[i]);
            	solicitud[i] = elementSelect[i].numero_solicitud;
           	   usuario[i] = elementSelect[i].usuario;
           		campus[i] = elementSelect[i].codigo_campus;
           		edificio[i] = elementSelect[i].codigo_edificio;
           		estado[i] = elementSelect[i].estado;
            }
            
            var data = [solicitud,usuario,campus,edificio];

            //console.log(data);

                
            var pdf = generarPDF(data, numeroSolicitudes);
                
            pdf.onload(function() {
            	var PDFContentBase64 = pdf.getBase64Text();
               generarLinkDescarga(PDFContentBase64);
            });
        }
    });

    /**
     * Evento que permite imprimir una o varias ordenes o solicitudes de mantenimiento
     */
    $("#btImprimir3").click(function () {
        if(confirm("¿Está seguro que desea imprimir la orden de mantenimiento?")){
            
            var idElementSelect = $("#tablaOrdenes2").jqGrid('getGridParam','selarrrow');
            var elementSelect = []
            var numeroSolicitudes = idElementSelect.length;
            var solicitud = [];
            var usuario = [];
            var campus = [];
            var edificio = [];
            var estado = [];
            
            for(i=0;i<numeroSolicitudes;i++){
            	elementSelect[i] = $("#tablaOrdenes2").jqGrid('getRowData',idElementSelect[i]);
            	solicitud[i] = elementSelect[i].numero_solicitud;
           	   usuario[i] = elementSelect[i].usuario;
           		campus[i] = elementSelect[i].codigo_campus;
           		edificio[i] = elementSelect[i].codigo_edificio;
           		estado[i] = elementSelect[i].estado;
            }
            
            var data = [solicitud,usuario,campus,edificio];

            //console.log(data);

                
            var pdf = generarPDF(data, numeroSolicitudes);
                
            pdf.onload(function() {
            	var PDFContentBase64 = pdf.getBase64Text();
               generarLinkDescarga(PDFContentBase64);
            });
        }
    });
    
    /**
     * Evento que permite imprimir una o varias ordenes o solicitudes de mantenimiento
     */
    $("#btImprimir4").click(function () {
        if(confirm("¿Está seguro que desea imprimir la orden de mantenimiento?")){
            
            var idElementSelect = $("#tablaHistorial").jqGrid('getGridParam','selarrrow');
            var elementSelect = []
            var numeroSolicitudes = idElementSelect.length;
            var solicitud = [];
            var usuario = [];
            var campus = [];
            var edificio = [];
            var estado = [];
            
            for(i=0;i<numeroSolicitudes;i++){
            	elementSelect[i] = $("#tablaHistorial").jqGrid('getRowData',idElementSelect[i]);
            	solicitud[i] = elementSelect[i].numero_solicitud;
           	   usuario[i] = elementSelect[i].usuario;
           		campus[i] = elementSelect[i].codigo_campus;
           		edificio[i] = elementSelect[i].codigo_edificio;
           		estado[i] = elementSelect[i].estado;
            }
            
            var data = [solicitud,usuario,campus,edificio];

            //console.log(data);

                
            var pdf = generarPDF(data, numeroSolicitudes);
                
            pdf.onload(function() {
            	var PDFContentBase64 = pdf.getBase64Text();
               generarLinkDescarga(PDFContentBase64);
            });
        }
    });
    
    /**
     * Evento que permite imprimir una o varias ordenes o solicitudes de mantenimiento
     */
    $("#btImprimir5").click(function () {
        if(confirm("¿Está seguro que desea imprimir la orden de mantenimiento?")){
            
            var idElementSelect = $("#tablaOrdenes3").jqGrid('getGridParam','selarrrow');
            var elementSelect = []
            var numeroSolicitudes = idElementSelect.length;
            var solicitud = [];
            var usuario = [];
            var campus = [];
            var edificio = [];
            var estado = [];
            
            for(i=0;i<numeroSolicitudes;i++){
            	elementSelect[i] = $("#tablaOrdenes3").jqGrid('getRowData',idElementSelect[i]);
            	solicitud[i] = elementSelect[i].numero_solicitud;
           	   usuario[i] = elementSelect[i].usuario;
           		campus[i] = elementSelect[i].codigo_campus;
           		edificio[i] = elementSelect[i].codigo_edificio;
           		estado[i] = elementSelect[i].estado;
            }
            
            var data = [solicitud,usuario,campus,edificio];

            //console.log(data);

                
            var pdf = generarPDF(data, numeroSolicitudes);
                
            pdf.onload(function() {
            	var PDFContentBase64 = pdf.getBase64Text();
               generarLinkDescarga(PDFContentBase64);
            });
        }
    });

    /**
     * Evento que permite imprimir una o varias ordenes o solicitudes de mantenimiento
     */
    $("#btImprimir6").click(function () {
        if(confirm("¿Está seguro que desea imprimir la orden de mantenimiento?")){
            
            var idElementSelect = $("#tablaOrdenes4").jqGrid('getGridParam','selarrrow');
            var elementSelect = []
            var numeroSolicitudes = idElementSelect.length;
            var solicitud = [];
            var usuario = [];
            var campus = [];
            var edificio = [];
            var estado = [];
            
            for(i=0;i<numeroSolicitudes;i++){
                elementSelect[i] = $("#tablaOrdenes4").jqGrid('getRowData',idElementSelect[i]);
                solicitud[i] = elementSelect[i].numero_solicitud;
                usuario[i] = elementSelect[i].usuario;
                campus[i] = elementSelect[i].codigo_campus;
                edificio[i] = elementSelect[i].codigo_edificio;
                estado[i] = elementSelect[i].estado;
            }
            
            var data = [solicitud,usuario,campus,edificio];

            //console.log(data);

                
            var pdf = generarPDF(data, numeroSolicitudes);
                
            pdf.onload(function() {
                var PDFContentBase64 = pdf.getBase64Text();
                generarLinkDescarga(PDFContentBase64);
            });
        }
    });
    
    /**
     * Se captura el evento cuando se da click en el boton visualizarOrdenes y se
     * realiza la operacion correspondiente desplegar una ventana con los datos especificos de la orden .
     */    
    $("#visualizarOrdenes").click(function (e) {
        try
        {
            var idElementSelect = $("#tablaOrdenes").jqGrid('getGridParam','selarrrow');

            if(idElementSelect.length > 1)
            {
                alert("Sólo puede ser visualizar un elemento a la vez");
            }
            else if(idElementSelect.length == 0)
            {
                alert("Seleccione un elemento");
            }
            else
            {
                var elementSelect = $("#tablaOrdenes").jqGrid('getRowData',idElementSelect);
                
                var data = buscarOrdenes(elementSelect.numero_solicitud);

                var campus = getNombreCampus(elementSelect.codigo_campus);

                var dataUsuario = buscarDatosUsuario(elementSelect.usuario);

                var dataEdificio = getNombreEdficio(elementSelect.codigo_campus, elementSelect.codigo_edificio);

                $.each(data, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#divDialogVisualizacion").dialog("open");
                        $("#divDialogVisualizacion").dialog("option", "height", 725);
                        $("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                        $("#sede").val("Cali");
                        $("#campus").val(campus);
                        $("#espacio").val(record.espacio);
                        $("#cantidad1").val(record.cantidad1);
                        $("#novedad1").val(record.descripcion1);
                        $("#descripcion_novedad").val(record.descripcion_novedad);
                        $("#cantidadN2").val(record.cantidad2);
                        $("#novedad2").val(record.descripcion2);
                        $("#descripcion_novedad2").val(record.descripcion_novedad2);
                        $("#cantidadN3").val(record.cantidad3);
                        $("#novedad3").val(record.descripcion3);
                        $("#descripcion_novedad3").val(record.descripcion_novedad3);
                        $("#contacto").val(record.contacto);
                        $("#estado").val(record.estado);
                        $("#descripcion").val(record.descripcion);
                        $("#fecha").val(record.fecha);
                    }
                });
                

                $.each(dataUsuario, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#usuario").val(record.nombre_usuario);
                        $("#telefono").val(record.telefono);
                        $("#extension").val(record.extension);
                    }
                });

                $.each(dataEdificio, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#edificio").val(record.codigo+" - "+record.nombre);
                    }
                });
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error"+ex);
        }
    });
    
    /**
     * Se captura el evento cuando se da click en el boton visualizarHistorial y se
     * realiza la operacion correspondiente desplegar una ventana con los datos especificos de la orden .
     */    
    $("#visualizarHistorial").click(function (e) {
        try
        {
            var idElementSelect = $("#tablaHistorial").jqGrid('getGridParam','selarrrow');

            if(idElementSelect.length > 1)
            {
                alert("Sólo puede ser visualizar un elemento a la vez");
            }
            else if(idElementSelect.length == 0)
            {
                alert("Seleccione un elemento");
            }
            else
            {
                var elementSelect = $("#tablaHistorial").jqGrid('getRowData',idElementSelect);
                
                var data = buscarOrdenes(elementSelect.numero_solicitud);

                var campus = getNombreCampus(elementSelect.codigo_campus);

                var dataUsuario = buscarDatosUsuario(elementSelect.usuario);

                var dataEdificio = getNombreEdficio(elementSelect.codigo_campus, elementSelect.codigo_edificio);

                $.each(data, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#divDialogVisualizacion").dialog("open");
                        $("#divDialogVisualizacion").dialog("option", "height", 725);
                        $("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                        $("#sede").val("Cali");
                        $("#campus").val(campus);
                        $("#espacio").val(record.espacio);
                        $("#cantidad1").val(record.cantidad1);
                        $("#novedad1").val(record.descripcion1);
                        $("#descripcion_novedad").val(record.descripcion_novedad);
                        $("#cantidadN2").val(record.cantidad2);
                        $("#novedad2").val(record.descripcion2);
                        $("#descripcion_novedad2").val(record.descripcion_novedad2);
                        $("#cantidadN3").val(record.cantidad3);
                        $("#novedad3").val(record.descripcion3);
                        $("#descripcion_novedad3").val(record.descripcion_novedad3);
                        $("#contacto").val(record.contacto);
                        $("#estado").val(record.estado);
                        $("#descripcion").val(record.descripcion);
                        $("#fecha").val(record.fecha);
                    }
                });

                $.each(dataEdificio, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#edificio").val(record.codigo+" - "+record.nombre);
                    }
                });

                $.each(dataUsuario, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#usuario").val(record.nombre_usuario);
                        $("#telefono").val(record.telefono);
                        $("#extension").val(record.extension);
                    }
                });
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error"+ex);
        }
    });
    
    /**
     * Se captura el evento cuando de da click en el boton visualizarOrdenes y se
     *  realiza la operacion correspondiente desplegar una ventana con los datos especificos de la orden .
     */    
    $("#visualizarOrdenes2").click(function (e) {
        try
        {
            var idElementSelect = $("#tablaOrdenes2").jqGrid('getGridParam','selarrrow');

                    
            if(idElementSelect.length > 1)
            {
                alert("Sólo puede ser visualizar un elemento a la vez");
            }
            else if(idElementSelect.length == 0)
            {
                alert("Seleccione un elemento");
            }
            else
            {
                var elementSelect = $("#tablaOrdenes2").jqGrid('getRowData',idElementSelect);
                
                var data = buscarOrdenes(elementSelect.numero_solicitud);

                var campus = getNombreCampus(elementSelect.codigo_campus);

                var dataEdificio = getNombreEdficio(elementSelect.codigo_campus, elementSelect.codigo_edificio);

                var dataUsuario = buscarDatosUsuario(elementSelect.usuario);

                var sistema = getNombreSistema(elementSelect.cod_sistema);

                $.each(data, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#divDialogVisualizacion2").dialog("open");
                        $("#divDialogVisualizacion2").dialog("option", "height", 725);
                        $("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                        $("#sede").val("Cali");
                        $("#campus").val(campus);
                        $("#espacio").val(record.espacio);
                        $("#cantidad1").val(record.cantidad1);
                        $("#novedad1").val(record.descripcion1);
                        $("#descripcion_novedad").val(record.descripcion_novedad);
                        $("#cantidadN2").val(record.cantidad2);
                        $("#descripcion_novedad2").val(record.descripcion_novedad2);
                        $("#novedad2").val(record.descripcion2);
                        $("#cantidadN3").val(record.cantidad3);
                        $("#novedad3").val(record.descripcion3);
                        $("#descripcion_novedad3").val(record.descripcion_novedad3);
                        $("#contacto").val(record.contacto);
                        $("#estado").val(record.estado);
                        $("#descripcion").val(record.descripcion);
                        $("#fecha").val(record.fecha);
                        $("#sistema").val(sistema);
                    }
                });

                $.each(dataEdificio, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#edificio").val(record.codigo+" "+record.nombre);
                    }
                });

                $.each(dataUsuario, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#usuario").val(record.nombre_usuario);
                        $("#telefono").val(record.telefono);
                        $("#extension").val(record.extension);
                    }
                });
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error");
        }
    });
    
    /**
     * Se captura el evento cuando de da click en el boton visualizarOrdenes y se
     *  realiza la operacion correspondiente desplegar una ventana con los datos especificos de la orden .
     */    
    $("#visualizarOrdenes3").click(function() {
        try
        {
            var idElementSelect = $("#tablaOrdenes2").jqGrid('getGridParam','selarrrow');

                    
            if(idElementSelect.length > 1)
            {
                alert("Sólo puede ser visualizar un elemento a la vez");
            }
            else if(idElementSelect.length == 0)
            {
                alert("Seleccione un elemento");
            }
            else
            {
                var elementSelect = $("#tablaOrdenes2").jqGrid('getRowData',idElementSelect);

                //console.log(elementSelect.numero_solicitud);
                
                var data = buscarOrdenes(elementSelect.numero_solicitud);

                var campus = getNombreCampus(elementSelect.codigo_campus);

                var dataEdificio = getNombreEdficio(elementSelect.codigo_campus, elementSelect.codigo_edificio);

                var dataUsuario = buscarDatosUsuario(elementSelect.usuario);

                var sistema = getNombreSistema(elementSelect.cod_sistema);

                $.each(data, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#divDialogVisualizacion2").dialog("open");
                        $("#divDialogVisualizacion2").dialog("option", "height", 725);
                        $("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                        $("#sede").val("Cali");
                        $("#campus").val(campus);
                        $("#espacio").val(record.espacio);
                        $("#cantidad1").val(record.cantidad1);
                        $("#novedad1").val(record.descripcion1);
                        $("#descripcion_novedad").val(record.descripcion_novedad);
                        $("#cantidadN2").val(record.cantidad2);
                        $("#novedad2").val(record.descripcion2);
                        $("#descripcion_novedad2").val(record.descripcion_novedad2);
                        $("#cantidadN3").val(record.cantidad3);
                        $("#novedad3").val(record.descripcion3);
                        $("#descripcion_novedad3").val(record.descripcion_novedad3);
                        $("#contacto").val(record.contacto);
                        $("#estado").val(record.estado);
                        $("#descripcion").val(record.descripcion);
                        $("#fecha").val(record.fecha);
                        $("#sistema").val(sistema);
                    }
                });

                $.each(dataEdificio, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#edificio").val(record.codigo+" "+record.nombre);
                    }
                });

                $.each(dataUsuario, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#usuario").val(record.nombre_usuario);
                        $("#telefono").val(record.telefono);
                        $("#extension").val(record.extension);
                    }
                });
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error");
        }
    });
    
    /**
     * Se captura el evento cuando de da click en el boton visualizarOrdenes y se
     *  realiza la operacion correspondiente desplegar una ventana con los datos especificos de la orden .
     */    
    $("#visualizarOrdenes4").click(function() {
        try
        {
            var idElementSelect = $("#tablaOrdenes3").jqGrid('getGridParam','selarrrow');

                    
            if(idElementSelect.length > 1)
            {
                alert("Sólo puede ser visualizar un elemento a la vez");
            }
            else if(idElementSelect.length == 0)
            {
                alert("Seleccione un elemento");
            }
            else
            {
                var elementSelect = $("#tablaOrdenes3").jqGrid('getRowData',idElementSelect);

                //console.log(elementSelect.numero_solicitud);
                
                var data = buscarOrdenes(elementSelect.numero_solicitud);

                var campus = getNombreCampus(elementSelect.codigo_campus);

                var dataEdificio = getNombreEdficio(elementSelect.codigo_campus, elementSelect.codigo_edificio);

                var dataUsuario = buscarDatosUsuario(elementSelect.usuario);

                var sistema = getNombreSistema(elementSelect.cod_sistema);

                $.each(data, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#divDialogVisualizacion2").dialog("open");
                        $("#divDialogVisualizacion2").dialog("option", "height", 725);
                        $("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                        $("#sede").val("Cali");
                        $("#campus").val(campus);
                        $("#espacio").val(record.espacio);
                        $("#cantidad1").val(record.cantidad1);
                        $("#novedad1").val(record.descripcion1);
                        $("#descripcion_novedad").val(record.descripcion_novedad);
                        $("#cantidadN2").val(record.cantidad2);
                        $("#novedad2").val(record.descripcion2);
                        $("#descripcion_novedad2").val(record.descripcion_novedad2);
                        $("#cantidadN3").val(record.cantidad3);
                        $("#novedad3").val(record.descripcion3);
                        $("#descripcion_novedad3").val(record.descripcion_novedad3);
                        $("#contacto").val(record.contacto);
                        $("#estado").val(record.estado);
                        $("#descripcion").val(record.descripcion);
                        $("#fecha").val(record.fecha);
                        $("#sistema").val(sistema);
                    }
                });

                $.each(dataEdificio, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#edificio").val(record.codigo+" "+record.nombre);
                    }
                });

                $.each(dataUsuario, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#usuario").val(record.nombre_usuario);
                        $("#telefono").val(record.telefono);
                        $("#extension").val(record.extension);
                    }
                });
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error");
        }
    });

    /**
     * Se captura el evento cuando de da click en el boton visualizarOrdenes y se
     *  realiza la operacion correspondiente desplegar una ventana con los datos especificos de la orden .
     */    
    $("#visualizarOrdenes5").click(function() {
        try
        {
            var idElementSelect = $("#tablaOrdenes4").jqGrid('getGridParam','selarrrow');

                    
            if(idElementSelect.length > 1)
            {
                alert("Sólo puede ser visualizar un elemento a la vez");
            }
            else if(idElementSelect.length == 0)
            {
                alert("Seleccione un elemento");
            }
            else
            {
                var elementSelect = $("#tablaOrdenes4").jqGrid('getRowData',idElementSelect);

                //console.log(elementSelect.numero_solicitud);
                
                var data = buscarOrdenes(elementSelect.numero_solicitud);

                var campus = getNombreCampus(elementSelect.codigo_campus);

                var dataEdificio = getNombreEdficio(elementSelect.codigo_campus, elementSelect.codigo_edificio);

                var dataUsuario = buscarDatosUsuario(elementSelect.usuario);

                var sistema = getNombreSistema(elementSelect.cod_sistema);

                $.each(data, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#divDialogVisualizacion").dialog("open");
                        $("#divDialogVisualizacion").dialog("option", "height", 725);
                        $("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                        $("#sede").val("Cali");
                        $("#campus").val(campus);
                        $("#espacio").val(record.espacio);
                        $("#cantidad1").val(record.cantidad1);
                        $("#novedad1").val(record.descripcion1);
                        $("#descripcion_novedad").val(record.descripcion_novedad);
                        $("#cantidadN2").val(record.cantidad2);
                        $("#novedad2").val(record.descripcion2);
                        $("#descripcion_novedad2").val(record.descripcion_novedad2);
                        $("#cantidadN3").val(record.cantidad3);
                        $("#novedad3").val(record.descripcion3);
                        $("#descripcion_novedad3").val(record.descripcion_novedad3);
                        $("#contacto").val(record.contacto);
                        $("#estado").val(record.estado);
                        $("#descripcion").val(record.descripcion);
                        $("#fecha").val(record.fecha);
                        $("#sistema").val(sistema);
                    }
                });

                $.each(dataEdificio, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#edificio").val(record.codigo+" "+record.nombre);
                    }
                });

                $.each(dataUsuario, function(index, record)
                {
                    if($.isNumeric(index))
                    {
                        $("#usuario").val(record.nombre_usuario);
                        $("#telefono").val(record.telefono);
                        $("#extension").val(record.extension);
                    }
                });
            }
        }
        catch(ex)
        {
            alert("ERROR: Ocurrio un error");
        }
    });

    /**
     * Validad que el usuario selecciones una opcion valida del selector 
     */
    $("#sistemaSearch").change(function (e) {
        var vlr = $("#sistemaSearch").find(':selected').val();

        if(vlr == 0){
            mostrarMensaje("Seleccione una opcion validad en el selector sistema");
        }
    });

     /**
     * captura el elemento seleccionado del select campus y de acuerdo a la seleccion actualiza el select de edificios
     */
    $("#campusSearch").change(function (e) {

        var vlr = $("#campusSearch").find(':selected').val();
        
        if(vlr == 0){
            $("#edificioSearch").empty();
        }
   
        if(vlr == 1){
            var id = 01;
            $("#edificioSearch").empty();
            actualizarSelectEdificio(id);

        }
        else if(vlr == 2){
            var id = 02;
            $("#edificioSearch").empty();
            actualizarSelectEdificio(id);

        }
        else if(vlr == 3){
            var id = 03;
            $("#edificioSearch").empty();
            actualizarSelectEdificio(id);
        }
        else if(vlr == 4){
            var id = 04;
            $("#edificioSearch").empty();
        }else{
            mostrarMensaje("Error no selecciono un campus de la lista");
        }   
    });

    /**
     * Valida que se seleccione una opcion valida del selector edificio
     */
    $("#edificioSearch").change(function (e) {
        var vlr = $("#edificioSearch").find(':selected').val();

        if(vlr == "--"){
            mostrarMensaje("Error. Seleccione una opción valida");
        }
    });

    /**
     * Se captura el evento cuando de da click en el boton modificar y se
     * realiza la operacion correspondiente.
     */    
    $("#modificarOrdenes").click(function (e) {
        try {      
            var idElementSelect = $("#tablaOrdenes").jqGrid('getGridParam','selarrrow'); 
            
            /*if(idElementSelect.length > 1) {
                alert("Sólo puede ser modificado un elemento a la vez");
            }
            else */if(idElementSelect.length == 0) {
                alert("Selecciona un elemento");
            }
            else {
                actualizarSelectorEstado();
                $("#divOperario").css('display','none');
                $('#divSelectOperario').css('display','none');
                for(i=0;i<idElementSelect.length;i++){                
                    var elementSelect = $("#tablaOrdenes").jqGrid('getRowData',idElementSelect[i]);
                
                    var data = buscarSolicitud(elementSelect.numero_solicitud);

                    //console.log(data);                
                }

                if (idElementSelect.length == 1) {
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion").dialog( "open" );
                            $("#divDialogModificacion" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            $("#descripcion2").val(record.descripcion);
                            //$("#descripcion").val(record.descripcion);
                            $("#usuario").val(record.usuario);
                            //$('#selectEstado').val('Seleccionar');
                            $('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $('#divOperario').css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }else{               
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion").dialog( "open" );
                            $("#divDialogModificacion" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            //$("#descripcion2").val(record.descripcion);
                            $("#descripcion2").val("");
                            $("#usuario").val(record.usuario);
                            $('#selectEstado').val('Seleccionar');
                            /*$('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $('#divOperario').css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }*/
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }                               
            }
        } 
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }         
    });

    /**
     * Se captura el evento cuando de da click en el boton modificar y se
     * realiza la operacion correspondiente.
     */    
    $("#modificarOrdenes2").click(function (e) {
        try {      
            var idElementSelect = $("#tablaOrdenes2").jqGrid('getGridParam','selarrrow'); 
            
            /*if(idElementSelect.length > 1) {
                alert("Sólo puede ser modificado un elemento a la vez");
            }
            else */if(idElementSelect.length == 0) {
                alert("Selecciona un elemento");
            }
            else {
                actualizarSelectorEstado();
                $("#divOperario").css('display','none');
                $('#divSelectOperario').css('display','none');
                for(i=0;i<idElementSelect.length;i++){
                
                    var elementSelect = $("#tablaOrdenes2").jqGrid('getRowData',idElementSelect[i]);
                
                    var data = buscarSolicitud(elementSelect.numero_solicitud);

                    //console.log(data);
                
                }
                if(idElementSelect.length == 1){
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion2").dialog( "open" );
                            $("#divDialogModificacion2" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            //$("#descripcion2").val("");
                            $("#descripcion2").val(record.descripcion);
                            $("#usuario").val(record.usuario);
                            //$('#selectEstado').val('Seleccionar');
                            $('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $('#divOperario').css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }else{
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion2").dialog( "open" );
                            $("#divDialogModificacion2" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            $("#descripcion2").val("");
                            //$("#descripcion2").val(record.descripcion);
                            $("#usuario").val(record.usuario);
                            $('#selectEstado').val('Seleccionar');
                            /*$('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $('#divOperario').css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }*/
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }
            }
        } 
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }         
    });

    /**
     * Se captura el evento cuando de da click en el boton modificar y se
     * realiza la operacion correspondiente.
     */    
    $("#modificarOrdenes3").click(function (e) {
        try {      
            var idElementSelect = $("#tablaOrdenes3").jqGrid('getGridParam','selarrrow'); 
            
            /*if(idElementSelect.length > 1) {
                alert("Sólo puede ser modificado un elemento a la vez");
            }
            else */if(idElementSelect.length == 0) {
                alert("Selecciona un elemento");
            }
            else {
                actualizarSelectorEstado();
                $("#divOperario").css('display','none');
                $('#divSelectOperario').css('display','none');
                for(i=0;i<idElementSelect.length;i++){
                
                    var elementSelect = $("#tablaOrdenes3").jqGrid('getRowData',idElementSelect[i]);
                
                    var data = buscarSolicitud(elementSelect.numero_solicitud);

                    //console.log(data);
                
                }
                if(idElementSelect.length == 1){
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion3").dialog( "open" );
                            $("#divDialogModificacion3" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            //$("#descripcion3").val("");
                            $("#descripcion3").val(record.descripcion);
                            $("#usuario").val(record.usuario);
                            //$('#selectEstado').val('Seleccionar');
                            $('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $('#divOperario').css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }else{
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion3").dialog( "open" );
                            $("#divDialogModificacion3" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            $("#descripcion3").val("");
                            //$("#descripcion3").val(record.descripcion);
                            $("#usuario").val(record.usuario);
                            $('#selectEstado').val('Seleccionar');
                            /*$('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $('#divOperario').css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }*/
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }
            }
        } 
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }         
    });

    /**
     * Se captura el evento cuando de da click en el boton modificar y se
     * realiza la operacion correspondiente.
     */    
    $("#modificarOrdenes5").click(function (e) {
        try {      
            var idElementSelect = $("#tablaOrdenes4").jqGrid('getGridParam','selarrrow'); 
            
            /*if(idElementSelect.length > 1) {
                alert("Sólo puede ser modificado un elemento a la vez");
            }
            else */if(idElementSelect.length == 0) {
                alert("Selecciona un elemento");
            }
            else {
                actualizarSelectorEstado();
                $("#divOperario").css('display','none');
                $('#divSelectOperario').css('display','none');
                for(i=0;i<idElementSelect.length;i++){
                
                    var elementSelect = $("#tablaOrdenes4").jqGrid('getRowData',idElementSelect[i]);
                
                    var data = buscarSolicitud(elementSelect.numero_solicitud);

                    //console.log(data);
                }
                if(idElementSelect.length == 1){
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion4").dialog( "open" );
                            $("#divDialogModificacion4" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            $("#descripcion4").val(record.descripcion);
                            //$("#descripcion").val(record.descripcion);
                            $("#usuario").val(record.usuario);
                            $('#selectEstado').val(record.estado);
                            //$('#selectEstado').val(record.estado);
                            if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $("#divOperario").css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }else{
                    $.each(data, function(index, record) {
                        if($.isNumeric(index)) {
                            $("#divDialogModificacion4").dialog( "open" );
                            $("#divDialogModificacion4" ).dialog( "option", "height", /*450*/350 );
                            //$("#campNumeroSolicitud").html(elementSelect.numero_solicitud);
                            //$("#descripcion4").val(record.descripcion);
                            $("#descripcion4").val("");
                            $("#usuario").val(record.usuario);
                            $('#selectEstado').val('Seleccionar');
                            //$('#selectEstado').val(record.estado);
                            /*if(record.estado == "Solicitado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                            }else if(record.estado == "Revisado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                            }else if(record.estado == "Realizado"){
                                $("#selectEstado option[value='Seleccionar']").remove();
                                $("#selectEstado option[value='Solicitado']").remove();
                                $("#selectEstado option[value='Revisado']").remove();
                                $("#divOperario").css('display','block');
                                $('#divSelectOperario').css('display','block');
                            }*/
                            //$('#estadoM').prop('selectedIndex',record.estado);
                        }
                    });
                }
            }
        } 
        catch(ex) {
            alert("ERROR: Ocurrio un error " + ex);
        }         
    });

    /**
     * Función que actualiza la tabla en donde se muestran las ordenes que hay
     * registrados en el sistema.
     */    
    function actualizarTablaOrdenesVarios(data,id) {

        //$("#tablaOrdenes").clearGridData();
        $.each(data, function(index, record) {            
            if($.isNumeric(index)) {
                $("#tablaOrdenes"+id).jqGrid('addRowData',index,record);
            }
        });
    }

    /**
     * Función que actualiza el selector dado
     */    
    function actualizarSelectorEstado() {
        $('#selectEstado').empty();
        $('#selectEstado').append('<option value="Solicitado">Solicitado</option>');
        $('#selectEstado').append('<option value="Revisado">Revisado</option>');
        $('#selectEstado').append('<option value="Realizado">Realizado</option>');
    }

    /**
     * evento que permite guardar las modificaciones de las ordenes en la ventana modal
     */
    $("#btGuardarModOrdenes").click(function() {  
        if(confirm("Esta seguro(a) que desea guardar" + " los cambios realizados a la orden","Confirmación"))
        {
                guardarModOrdenes('tablaOrdenes','');
                //enviarCorreo();
        }
    }); 

    /**
     * evento que permite guardar las modificaciones de las ordenes en la ventana modal
     */
    $("#btGuardarModOrdenes2").click(function() {  
        if(confirm("Esta seguro(a) que desea guardar" + " los cambios realizados a la orden","Confirmación"))
        {
                guardarModOrdenes('tablaOrdenes2','2');
                //enviarCorreo();
        }
    });

    /**
     * evento que permite guardar las modificaciones de las ordenes en la ventana modal
     */
    $("#btGuardarModOrdenes3").click(function() {  
        if(confirm("Esta seguro(a) que desea guardar" + " los cambios realizados a la orden","Confirmación"))
        {
                guardarModOrdenes('tablaOrdenes3','3');
                //enviarCorreo();
        }
    });

    /**
     * evento que permite guardar las modificaciones de las ordenes en la ventana modal
     */
    $("#btGuardarModOrdenes4").click(function() {  
        if(confirm("Esta seguro(a) que desea guardar" + " los cambios realizados a la orden","Confirmación"))
        {
                guardarModOrdenes('tablaOrdenes4','4');
                //enviarCorreo();
        }
    });

    $("#selectEstado").change(function(){
        if ($.trim($("#selectEstado").find(':selected').val()) == 'Realizado') {
            $('#divOperario').css('display','block');
            $('#divSelectOperario').css('display','block');
        }else{
            $('#divOperario').css('display','none');
            $('#divSelectOperario').css('display','none');
        }
    });
});