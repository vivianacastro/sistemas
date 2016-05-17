$(document).ready(function() {

    /**
     * Función que se ejecuta al momento que se accede a la página que lo tiene
     * incluido.
     * @returns {undefined}
     */    
    (function (){
        var URLactual = window.location;
        if(URLactual['href'].indexOf('crear_campus') >= 0){
            actualizarSelectSede();
        }
    })();
    
    /**
     * Función que permite crear una sede
     * @param {strign} consulta, información de la sede 
     * @returns {data}
     */
    function guardarSede(informacion){
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
                    mostrarMensaje(data.mensaje);
                }
            });
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que permite crear una sede
     * @param {strign} consulta, información de la sede 
     * @returns {data}
     */
    function guardarCampus(informacion){
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
                    mostrarMensaje(data.mensaje);
                }
            });
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }

    /**
     * Función que realiza una consulta de los campus
     * con base en una palabra clave.
     * @param {type} consulta, palabra clave para realizar la consulta.
     * @returns {data} object json
    **/
    function buscarSede(){
        var dataResult;
        try {
            $.ajax({
                type: "POST",
                url: "index.php?action=consultar_sede",
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
     * Función que llena y actualiza el selector de campus.
     * @param {array} data, datos que se van a actualizar en el selector.
     * @returns {undefined}
    **/   
    function actualizarSelectSede(){
        var data = buscarSede();        
        $("#nombre_sede").empty();
        var row = $("<option value='seleccionar'/>");
        row.text("--Seleccionar--");
        row.appendTo("#nombre_sede");
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                aux = cadenaMayusculas(record.nombre_sede);
                row = $("<option value='" + record.id + "'/>");
                row.text(aux);
                row.appendTo("#nombre_sede");
            }
        });      
    } 
    
    /**
     * Se captura el evento cuando de dar click en el boton crear_sede y se
     * realiza la operacion correspondiente.
     */     
    $("#guardar_sede").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información de la sede?");
            if (confirmacion) {
                var nombreSede = limpiarCadena($("#nombre_sede").val());
                if (nombreSede.length == 0){
                    alert("ERROR. Ingrese el nombre de la sede");
                    $("#nombre_sede").focus();
                }else{
                    var informacion = {};
                    informacion['nombre_sede'] = nombreSede;
                    guardarSede(informacion);
                    $("#nombre_sede").val("");
                }
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });

    /**
     * Se captura el evento cuando de dar click en el boton crear_sede y se
     * realiza la operacion correspondiente.
     */     
    $("#guardar_campus").click(function (e){
        try{
            var confirmacion = window.confirm("¿Guardar la información del campus?");
            if (confirmacion) {
                var nombreSede = $("#nombre_sede").val();
                var nombreCampus = limpiarCadena($("#nombre_campus").val());
                if(nombreSede == 'seleccionar' || nombreSede.length == 0){
                    alert("ERROR. Seleccione la sede a la que pertenece el campus");
                    $("#nombre_sede").focus();
                }else if(nombreCampus.length == 0){
                    alert("ERROR. Ingrese el nombre del campus");
                    $("#nombre_campus").focus();
                }else{
                    var informacion = {};
                    informacion['nombre_sede'] = nombreSede;
                    informacion['nombre_campus'] = nombreCampus;
                    guardarCampus(informacion);
                    $("#nombre_sede").val("seleccionar");
                    $("#nombre_campus").val("");
                }
            }
        }
        catch(ex){
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    });
});