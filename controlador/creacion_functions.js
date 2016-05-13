$(document).ready(function() {
    
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
                    console.log(status);
                    //location.reload(true);
                    var err = eval("(" + xhr.responseText + ")");
                    console.log(err.Message);
                },
                success: function(data) {
                    mostrarMensaje(data.mensaje);
                    console.log(data);
                }
            });
        }
        catch(ex) {
            console.log(ex);
            alert("Ocurrió un error, por favor inténtelo nuevamente");
        }
    }  
    
    /**
     * Se captura el evento cuando de dar click en el boton crear_sede y se
     * realiza la operacion correspondiente.
     */     
    $("#guardar_sede").click(function (e) {
        try{
            var confirmacion = window.confirm("¿Guardar la información de la Sede?");
            if (confirmacion) {
                var nombreSede = cadenaMinusculas($("#nombre_sede").val());
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
});