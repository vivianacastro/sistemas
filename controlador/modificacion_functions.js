
$(document).ready(function() {

  /**
   * Se captura el evento cuando de dar click en el boton guardar_modificaciones_sede y se
   * realiza la operacion correspondiente.
   */
  $("#guardar_modificaciones_sede").click(function (e){
      sede = {};
      nombre_sede = limpiarCadena($("#nombre_sede").val());
      sede["nombre_sede"] = nombre_sede;
      data = guardarModificacionesObjeto("sede",sede);
      if(data.verificar){
          alert(data.mensaje);
      }
  });

  /**
   * Se captura el evento cuando de dar click en el boton guardar_modificaciones_campus y se
   * realiza la operacion correspondiente.
   */
  $("#guardar_modificaciones_campus").click(function (e){

  });
});
