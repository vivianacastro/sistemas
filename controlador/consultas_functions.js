$(document).ready(function() {

  var mapaConsulta, mapaModificacion, sedeSeleccionada, campusSeleccionado, codigoSeleccionado, numeroFotos = 0, numeroPlanos = 0;
  var iluminacionCont = 0, cerraduraCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0, puntosSanitariosCont = 0, lavamanosCont = 0, orinalesCont = 0;
  var campusSelect = null;
  var marcadores = [], marcadoresModificacion = [];
  var URLactual = window.location;
  var infoWindowActiva;
  var coordsMapaModificacion;

  /**
   * Función que se ejecuta al momento que se accede a la página que lo tiene
   * incluido.
   * @returns {undefined}
   */
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
      }
  })();

  /**
   * Función que carga el mapa y lo configura.
   * @returns {undefined}
   */
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
   */
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
  */
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
   * Función que realiza una consulta de los campus presentes en el sistema.
   * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
   * @param {array} informacion, informaci&oacute;n del tipo de objeto.
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
   * Función que realiza una consulta de la informaci&oacute;n de un tipo de objeto en el sistema.
   * @param {string} tipo_objeto, tipo de objeto a consultar (sede, campus, edificio, etc.).
   * @param {array} informacion, informaci&oacute;n del tipo de objeto.
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
   * @param {array} informacion, informaci&oacute;n del tipo de objeto.
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
   * @param {array} informacion, informaci&oacute;n del tipo de objeto.
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
   * Función que llena y actualiza el selector de campus.
   * @returns {undefined}
  **/
  function actualizarSelectSede(){
      var data = buscarObjetos("sedes","");
      $("#sede_search").empty();
      var row = $("<option value=''/>");
      row.text("--Seleccionar--");
      row.appendTo("#sede_search");
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
                  mapaConsulta.setZoom(16);
                  mapaConsulta.setCenter(this.getPosition());
              });
          }
      }else{
          getCoordenadas(mapaConsulta);
      }
  }

  /**
   * Se captura el evento cuando se modifica el valor del selector sede_search
   * y se actualiza el selector de sedes.
   */
  $("#sede_search").change(function (e) {
      if (URLactual['href'].indexOf('consultar_sede') >= 0) {
          var sede = $("#sede_search").val();
          if (validarCadena(sede)) {
              $('#visualizarSede').removeAttr("disabled");
          }else{
              $('#visualizarSede').attr('disabled','disabled');
          }
      }else{
          if (validarCadena($("#sede_search").val())) {
              for (var i = 0; i < marcadores.length; i++) {
                  marcadores[i].setMap(null);
              }
              var sede = {};
              var bounds  = new google.maps.LatLngBounds();
              $("#campus_search").empty();
              if (URLactual['href'].indexOf('consultar_campus') >= 0) {
                  $('#visualizarCampus').attr('disabled','disabled');
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
              var sede = $("#sede_search").val();
              rellenarMapa(mapaConsulta);
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector campus_search
   * y se actualiza el selector de campus.
   */
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
              $('#visualizarCampus').attr('disabled','disabled');
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
                      $('#visualizarEdificio').attr('disabled','disabled');
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
              }else{
                  $("#codigo_search").empty();
                  $("#codigo_search").val("");
              }
              $("#codigo_search").empty();
              $("#codigo_search").val("");
              $("#edificio_search").empty();
              $("#edificio_search").val("");
              $("#pisos_search").empty();
              $("#pisos_search").val("");
              $("#espacio_search").empty();
              $("#espacio_search").val("");
              var sede = $("#sede_search").val();
              $("#sede_search").val(sede).change();
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector codigo_search
   * y se actualiza el selector de códigos.
   */
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
              $('#visualizarCancha').attr('disabled','disabled');
          }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
              $('#visualizarCorredor').attr('disabled','disabled');
          }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
              $('#visualizarParqueadero').attr('disabled','disabled');
          }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
              $('#visualizarPiscina').attr('disabled','disabled');
          }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
              $('#visualizarPlazoleta').attr('disabled','disabled');
          }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
              $('#visualizarSendero').attr('disabled','disabled');
          }else if(URLactual['href'].indexOf('consultar_via') >= 0){
              $('#visualizarVia').attr('disabled','disabled');
          }
          var campus = $("#campus_search").val();
          $("#campus_search").val(campus).change();
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector edificio_search
   * y se actualiza el selector de edificios.
   */
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
              $('#visualizarCubierta').attr('disabled','disabled');
              $('#visualizarGradas').attr('disabled','disabled');
              $('#visualizarEdificio').attr('disabled','disabled');

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
              var campus = $("#campus_search").val();
              $("#campus_search").val(campus).change();
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector pisos_search
   * y se actualiza el selector de pisos.
   */
  $("#pisos_search").change(function (e) {
      if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0) {
          for (var i = 0; i < marcadores.length; i++) {
              if (marcadores[i].id == $("#edificio_search").val()) {
                  mapaConsulta.setCenter(marcadores[i].getPosition());
                  break;
              }
          }
          if (validarCadena($("#edificio_search").val())) {
              $('#visualizarCubierta').removeAttr("disabled");
              $('#visualizarGradas').removeAttr("disabled");
              $('#visualizarEspacio').removeAttr("disabled");
          }else{
              $('#visualizarCubierta').attr('disabled','disabled');
              $('#visualizarGradas').attr('disabled','disabled');
              $('#visualizarEspacio').removeAttr("disabled");
          }
      }else{
          if (validarCadena($("#edificio_search").val())) {
              var edificio = {};
              edificio["nombre_sede"] = $("#sede_search").val();
              edificio["nombre_campus"] = $("#campus_search").val();
              edificio["nombre_edificio"] = $("#edificio_search").val();
              edificio["piso"] = $("#pisos_search").val();
              var data = buscarObjetos("espacios",edificio);
              $("#espacio_search").empty();
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
              var edificio = $("#edificio_search").val();
              $("#edificio_search").val(edificio).change();
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector espacio_search
   * y se actualiza el selector de espacios.
   */
  $("#espacio_search").change(function (e) {
      if (validarCadena($("#espacio_search").val())) {
          $('#visualizarEspacio').removeAttr("disabled");
      }else{
          $('#visualizarEspacio').attr('disabled','disabled');
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector pisos_search
   * y se actualiza el selector de tipo de objeto.
   */
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
                  row = $("<option value='" + limpiarCadena(record.nombre_material) + "'/>");
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
   */
  $("#nombre_tipo_material_search").change(function (e) {
      if (validarCadena($("#nombre_tipo_material_search").val())) {
          $('#visualizarTipoMaterial').removeAttr("disabled");
      }else{
          $('#visualizarTipoMaterial').attr('disabled','disabled');
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector pisos_search
   * y se actualiza el selector de tipo de objeto.
   */
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
                  row = $("<option value='" + limpiarCadena(record.tipo_objeto) + "'/>");
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
   */
  $("#nombre_tipo_objeto_search").change(function (e) {
      if (validarCadena($("#nombre_tipo_objeto_search").val())) {
          $('#visualizarTipoObjeto').removeAttr("disabled");
      }else{
          $('#visualizarTipoObjeto').attr('disabled','disabled');
      }
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarSede y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarSede").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = "";
      var data = consultarInformacionObjeto("sede",info);
      console.log(data);
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
          }
      });
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarCampus y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarCampus").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      var data = consultarInformacionObjeto("campus",info);
      var archivos = consultarArchivosObjeto("campus",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
      }
      for (var i = 0; i < numeroPlanos; i++) {
          eliminarComponente("plano");
      }
      numeroFotos = 0;
      numeroPlanos = 0;
      $.each(archivos, function(index, record) {
          if($.isNumeric(index)) {
              if (record.tipo == 'foto') {
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                 }
                  añadirComponente("indicadores_carrusel",componente);
                  añadirComponente("fotos_carrusel",componente2);
                  numeroFotos++;
                  $("#myCarousel").show();
              }else{
                  var componente = '<div id="plano" class="div_izquierda">'
                  +'<a target="_blank" href="archivos/planos/campus/'+sede+'-'+campus+'/'+record.nombre+'">'
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
          +'<br><br></div>';
      numeroPlanos++;
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
   * Se captura el evento cuando se da click en el boton visualizarCancha y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarCancha").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("cancha",info);
      var archivos = consultarArchivosObjeto("cancha",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarCorredor y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarCorredor").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("corredor",info);
      var dataIluminacion = consultarInformacionObjeto("iluminacion_corredor",info);
      var dataInterruptor = consultarInformacionObjeto("interruptor_corredor",info);
      var archivos = consultarArchivosObjeto("corredor",info);
      console.log(data);
      console.log(dataIluminacion);
      console.log(dataInterruptor);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarCubierta y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarCubierta").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var edificio = $("#edificio_search").val();
      var piso = $("#pisos_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['nombre_edificio'] = limpiarCadena(edificio);
      var piso = piso;
      if (piso == 'sotano') {
          piso = '0';
      }else if(piso == 'terraza'){
          piso = '-1';
      }
      info['piso'] = piso;
      var data = consultarInformacionObjeto("cubierta",info);
      var archivos = consultarArchivosObjeto("cubierta",info);
      console.log(data);
      console.log(archivos);
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
              $("#nombre_campus").val(record.nombre_campus);
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
      }
      for (var i = 0; i < numeroPlanos; i++) {
          eliminarComponente("plano");
      }
      numeroFotos = 0;
      numeroPlanos = 0;
      $.each(archivos, function(index, record) {
          if($.isNumeric(index)) {
              if (record.tipo == 'foto') {
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                 }
                  añadirComponente("indicadores_carrusel",componente);
                  añadirComponente("fotos_carrusel",componente2);
                  numeroFotos++;
                  $("#myCarousel").show();
              }else{
                  var componente = '<div id="plano" class="div_izquierda">'
                  +'<a target="_blank" href="archivos/planos/cubierta/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'">'
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
          +'<br><br></div>';
      numeroPlanos++;
      añadirComponente("planos",componentePlano);
      numeroFotos++;
      añadirComponente("indicadores_carrusel",componente);
      añadirComponente("fotos_carrusel",componente2);
      $("#myCarousel").show();
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarGradas y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarGradas").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var edificio = $("#edificio_search").val();
      var piso = $("#pisos_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['nombre_edificio'] = limpiarCadena(edificio);
      var piso = piso;
      if (piso == 'sotano') {
          piso = '0';
      }else if(piso == 'terraza'){
          piso = '-1';
      }
      info['piso_inicio'] = piso;
      var data = consultarInformacionObjeto("gradas",info);
      var dataVentana = consultarInformacionObjeto("ventana_gradas",info);
      var archivos = consultarArchivosObjeto("gradas",info);
      console.log(data);
      console.log(dataVentana);
      console.log(archivos);
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
              $("#nombre_campus").val(record.nombre_campus);
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
          }
      });
      $.each(dataVentana, function(index, record) {
          if($.isNumeric(index)) {
              if (ventanasCont == 0) {
                  $("#tipo_ventana").val(record.tipo_ventana);
                  $("#cantidad_ventanas").val(record.cantidad);
                  $("#material_ventana").val(record.material);
                  $("#ancho_ventana").val(record.ancho);
                  $("#alto_ventana").val(record.alto);
              }else{
                  var componente = '<div id="ventana'+ventanasCont+'">'
                  +'<br><div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="tipo_ventana" id="tipo_ventana'+ventanasCont+'" disabled required></select><br>'
                  +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_ventanas" id="cantidad_ventanas'+ventanasCont+'" value="" disabled required/><br>'
                  +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="material_ventana" id="material_ventana'+ventanasCont+'" disabled required></select><br>'
                  +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_ventana" id="ancho_ventana'+ventanasCont+'" value="" disabled required/><br>'
                  +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_ventana" id="alto_ventana'+ventanasCont+'" value="" disabled required/><br>'
                  +'</div>';
                  añadirComponente("ventana",componente);
                  actualizarSelectMaterial("material_ventana",ventanasCont);
                  actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
                  $("#tipo_ventana"+ventanasCont).val(record.tipo_ventana);
                  $("#cantidad_ventanas"+ventanasCont).val(record.cantidad);
                  $("#material_ventana"+ventanasCont).val(record.material);
                  $("#ancho_ventana"+ventanasCont).val(record.ancho);
                  $("#alto_ventana"+ventanasCont).val(record.alto);
              }
              ventanasCont++;
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                        +'</div>';
                 }
                  añadirComponente("indicadores_carrusel",componente);
                  añadirComponente("fotos_carrusel",componente2);
                  numeroFotos++;
                  $("#myCarousel").show();
              }else{
                  var componente = '<div id="plano" class="div_izquierda">'
                  +'<a target="_blank" href="archivos/planos/gradas/'+sede+'-'+campus+'-'+edificio+'-'+piso+'/'+record.nombre+'">'
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
          +'<br><br></div>';
      numeroPlanos++;
      añadirComponente("planos",componentePlano);
      numeroFotos++;
      añadirComponente("indicadores_carrusel",componente);
      añadirComponente("fotos_carrusel",componente2);
      $("#myCarousel").show();
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarParqueadero y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarParqueadero").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("parqueadero",info);
      var archivos = consultarArchivosObjeto("parqueadero",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarPiscina y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarPiscina").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("piscina",info);
      var archivos = consultarArchivosObjeto("piscina",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarPlazoleta y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarPlazoleta").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("plazoleta",info);
      var dataIluminacion = consultarInformacionObjeto("iluminacion_plazoleta",info);
      var archivos = consultarArchivosObjeto("plazoleta",info);
      console.log(data);
      console.log(dataIluminacion);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarSendero y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarSendero").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("sendero",info);
      var archivos = consultarArchivosObjeto("sendero",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarVia y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarVia").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#codigo_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("via",info);
      var archivos = consultarArchivosObjeto("via",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarEdificio y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarEdificio").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var id = $("#edificio_search").val();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("edificio",info);
      var archivos = consultarArchivosObjeto("edificio",info);
      console.log(data);
      console.log(archivos);
      for (var i = 0; i < marcadoresModificacion.length; i++) {
          marcadoresModificacion[i].setMap(null);
      }
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/edificio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
      numeroPlanos++;
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
   * Se captura el evento cuando se da click en el boton visualizarEspacio y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarEspacio").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var edificio = $("#edificio_search").val();
      var id = $("#espacio_search").val();
      var usoEspacio;
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['nombre_edificio'] = edificio;
      info['id'] = limpiarCadena(id);
      var data = consultarInformacionObjeto("espacio",info);
      var dataIluminacion = consultarInformacionObjeto("iluminacion_espacio",info);
      var dataInterruptor = consultarInformacionObjeto("interruptor_espacio",info);
      var dataPuerta = consultarInformacionObjeto("puerta_espacio",info);
      var dataSuministro = consultarInformacionObjeto("suministro_energia_espacio",info);
      var dataVentana = consultarInformacionObjeto("ventana_espacio",info);
      var archivos = consultarArchivosObjeto("espacio",info);
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
              $("#nombre_sede").val(record.nombre_sede);
              $("#nombre_campus").val(record.nombre_campus);
              $("#nombre_edificio").val(record.id_edificio+" - "+record.nombre_edificio);
              $("#pisos").val(record.piso);
              $("#id_espacio").val(record.id);
              usoEspacio = record.uso_espacio;
              $("#uso_espacio").val(usoEspacio);
              $("#ancho_pared").val(record.ancho_pared);
              $("#altura_pared").val(record.alto_pared);
              $("#material_pared").val(record.material_pared);
              $("#ancho_piso").val(record.ancho_piso);
              $("#largo_piso").val(record.largo_piso);
              $("#material_piso").val(record.material_piso);
              $("#ancho_techo").val(record.ancho_techo);
              $("#largo_techo").val(record.largo_techo);
              $("#material_techo").val(record.material_techo);
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
                  iluminacionCont++;
              }
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
                  interruptoresCont++;
              }
          }
      });
      $.each(dataPuerta, function(index, record) {
          if($.isNumeric(index)) {
              if (puertasCont == 0) {
                  $("#tipo_puerta").val(record.tipo_puerta);
                  $("#cantidad_puertas").val(record.cantidad);
                  $("#material_puerta").val(record.material_puerta);
                  $("input[name=gato_puerta][value="+record.gato+"]").prop('checked', true);
                  $("#material_marco_puerta").val(record.material_marco);
                  $("#ancho_puerta").val(record.ancho);
                  $("#alto_puerta").val(record.largo);
              }else{
                  var componente = '<div id="puerta'+puertasCont+'">'
                  +'<div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="tipo_puerta" id="tipo_puerta'+puertasCont+'" required></select><br>'
                  +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puertas" id="cantidad_puertas'+puertasCont+'" value="" required/><br>'
                  +'<div class="div_izquierda"><b>Material de la puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="material_puerta" id="material_puerta'+puertasCont+'" required></select><br>'
                  +'<div class="div_izquierda"><b>Tipo de cerradura ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="tipo_cerradura" id="tipo_cerradura'+puertasCont+'" required></select><br>'
                  //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="añadir_tipo_cerradura" id="añadir_tipo_cerradura'+puertasCont+'" value="Añadir Tipo" title="Añadir Tipo Cerradura"/>'
                  //+'<input type="submit" class="btn btn-primary btn-lg btn-agregar" name="eliminar_tipo_cerradura" id="eliminar_tipo_cerradura'+puertasCont+'" value="Eliminar Tipo" title="Eliminar Tipo Cerradura" disabled/>'
                  +'<div class="div_izquierda"><b>¿La puerta tiene gato? ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="true">S&iacute;</label>'
                  +'<label class="radio-inline"><input type="radio" name="gato_puerta'+puertasCont+'" value="false">No</label><br>'
                  +'<div class="div_izquierda"><b>Material del marco ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="material_marco_puerta" id="material_marco_puerta'+puertasCont+'" required></select><br>'
                  +'<div class="div_izquierda"><b>Ancho puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_puerta" id="ancho_puerta'+puertasCont+'" value="" required/><br>'
                  +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_puerta" id="alto_puerta'+puertasCont+'" value="" required/><br>'
                  +'</div>';
                  añadirComponente("puerta",componente);
                  actualizarSelectMaterial("material_marco_puerta",puertasCont);
                  actualizarSelectMaterial("material_puerta",puertasCont);
                  actualizarSelectTipoObjeto("tipo_puerta",puertasCont);
                  $("#tipo_puerta"+puertasCont).val(record.tipo_puerta);
                  $("#cantidad_puertas"+puertasCont).val(record.cantidad);
                  $("#material_puerta"+puertasCont).val(record.material_puerta);
                  $("input[name=gato_puerta"+puertasCont+"][value="+record.gato+"]").prop('checked', true);
                  $("#material_marco_puerta"+puertasCont).val(record.material_marco);
                  $("#ancho_puerta"+puertasCont).val(record.ancho);
                  $("#alto_puerta"+puertasCont).val(record.alto);
                  puertasCont++;
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
                          }else {
                              $("#tipo_cerradura"+puertasCont).val(valor.tipo_cerradura);
                          }
                      }else{
                          var componente = '<div id="cerradura'+cerraduraCont+'">'
                          +'<div class="div_izquierda"><b>Tipo de cerradura ('+(cerraduraCont+1)+') de la puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
                          +'<select class="form-control formulario" name="tipo_cerradura" id="tipo_cerradura'+puertasCont+cerraduraCont+'" required></select><br>'
                          +'</div>';
                          añadirComponente("cerradura",componente);
                          actualizarSelectTipoObjeto("tipo_cerradura",cerraduraCont);
                          $("#tipo_cerradura"+cerraduraCont).val(valor.tipo_cerradura);
                          cerraduraCont++;
                      }
                  }
              });
          }
      });
      $.each(dataSuministro, function(index, record) {
          if($.isNumeric(index)) {
              if (tomacorrientesCont == 0) {
                  $("#tipo_suministro_energia").val(record.tipo_suministro_energia);
                  $("#tomacorriente").val(record.tomacorriente);
                  $("#cantidad_tomacorrientes").val(record.cantidad);
              }else{
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
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_tomacorrientes" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" required/><br>'
                  +'</div>';
                  añadirComponente("suministro_energia",componente);
                  actualizarSelectTipoObjeto("tipo_suministro_energia",tomacorrientesCont);
                  $("#tipo_suministro_energia"+tomacorrientesCont).val(record.tipo_suministro_energia);
                  $("#tomacorriente"+tomacorrientesCont).val(record.tomacorriente);
                  $("#cantidad_tomacorrientes"+tomacorrientesCont).val(record.cantidad);
                  tomacorrientesCont++;
              }
          }
      });
      $.each(dataVentana, function(index, record) {
          if($.isNumeric(index)) {
              if (ventanasCont == 0) {
                  $("#tipo_ventana").val(record.tipo_ventana);
                  $("#cantidad_ventanas").val(record.cantidad);
                  $("#material_ventana").val(record.material_ventana);
                  $("#ancho_ventana").val(record.ancho);
                  $("#alto_ventana").val(record.alto);
              }else{
                  var componente = '<div id="ventana'+ventanasCont+'">'
                  +'<br><div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="tipo_ventana" id="tipo_ventana'+ventanasCont+'" disabled required></select><br>'
                  +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_ventanas" id="cantidad_ventanas'+ventanasCont+'" value="" disabled required/><br>'
                  +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<select class="form-control formulario" name="material_ventana" id="material_ventana'+ventanasCont+'" disabled required></select><br>'
                  +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_ventana" id="ancho_ventana'+ventanasCont+'" value="" disabled required/><br>'
                  +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
                  +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_ventana" id="alto_ventana'+ventanasCont+'" value="" disabled required/><br>'
                  +'</div>';
                  añadirComponente("ventana",componente);
                  actualizarSelectMaterial("material_ventana",ventanasCont);
                  actualizarSelectTipoObjeto("tipo_ventana",ventanasCont);
                  $("#tipo_ventana"+ventanasCont).val(record.tipo_ventana);
                  $("#cantidad_ventanas"+ventanasCont).val(record.cantidad);
                  $("#material_ventana"+ventanasCont).val(record.material_ventana);
                  $("#ancho_ventana"+ventanasCont).val(record.ancho);
                  $("#alto_ventana"+ventanasCont).val(record.alto);
                  ventanasCont++;
              }
          }
      });
      /*if (usoEspacio == '1') { //Salón
          data = consultarInformacionObjeto("salon",info);
      }else if(usoEspacio == '2'){ //Auditorio
          data = consultarInformacionObjeto("auditorio",info);
      }else if(usoEspacio == '3'){ //Laboratorio
          data = consultarInformacionObjeto("laboratorio",info);
      }else if(usoEspacio == '4'){ //Sala de Cómputo
          data = consultarInformacionObjeto("sala_computo",info);
      }else if(usoEspacio == '5'){ //Oficina
          data = consultarInformacionObjeto("oficina",info);
      }else if(usoEspacio == '6'){ //Baño
          data = consultarInformacionObjeto("bano",info);
      }else if(usoEspacio == '7'){ //Cuarto Técnico
          data = consultarInformacionObjeto("cuarto_tecnico",info);
      }else if(usoEspacio == '8'){ //Bodega/Almacen
          data = consultarInformacionObjeto("bodega",info);
      }else if(usoEspacio == '10'){ //Cuarto de Plantas
          data = consultarInformacionObjeto("cuarto_plantas",info);
      }else if(usoEspacio == '11'){ //Cuarto de Aires Acondicionados
          data = consultarInformacionObjeto("cuarto_aires_acondicionados",info);
      }else if(usoEspacio == '12'){ //Área Deportiva Cerrada
          data = consultarInformacionObjeto("area_deportiva_cerrada",info);
      }else if(usoEspacio == '14'){ //Centro de Datos/Teléfono
          data = consultarInformacionObjeto("centro_datos",info);
      }else if(usoEspacio == '17'){ //Cuarto de Bombas
          data = consultarInformacionObjeto("cuarto_bombas",info);
      }else if(usoEspacio == '19'){ //Cocineta
          data = consultarInformacionObjeto("cocineta",info);
      }else if(usoEspacio == '20'){ //Sala de Estudio
          data = consultarInformacionObjeto("sala_estudio",info);
      }*/
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
                        +'<img class="carouselImg" src="archivos/images/espacio/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
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
          +'<br><br></div>';
      numeroPlanos++;
      añadirComponente("planos",componentePlano);
      numeroFotos++;
      añadirComponente("indicadores_carrusel",componente);
      añadirComponente("fotos_carrusel",componente2);
      $("#myCarousel").show();
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarTipoMaterial y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarTipoMaterial").click(function (e){
      var info =  {};
      var tipoMaterial = $("#tipo_material_search").val();
      var nombreTipoMaterial = $("#nombre_tipo_material_search").val();
      /*info['tipo_material'] = tipoMaterial;
      info['nombre_tipo_materil'] = nombreTipoMaterial;
      var data = consultarInformacionObjeto("tipo_material",info);
      console.log(data);
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#tipo_material").val(record.tipo_material);
              $("#nombre_tipo_material").val(record.nombre);
          }
      });*/
      $("#tipo_material").val(tipoMaterial);
      $("#nombre_tipo_material").val(nombreTipoMaterial);
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarTipoObjeto y se
   * realiza la operacion correspondiente.
   */
   $("#visualizarTipoObjeto").click(function (e){
       var info =  {};
       var tipoObjeto = $("#tipo_objeto_search").val();
       var nombreTipoObjeto = $("#nombre_tipo_objeto_search").val();
       /*info['tipo_objeto'] = tipoObjeto;
       info['nombre_tipo_objeto'] = nombreTipoObjeto;
       var data = consultarInformacionObjeto("tipo_objeto",info);
       console.log(data);
       $.each(data, function(index, record) {
           if($.isNumeric(index)) {
              $("#tipo_objeto").val(record.tipo_objeto);
               $("#nombre_tipo_objeto").val(record.nombre);
           }
       });*/
       $("#tipo_objeto").val(tipoObjeto);
       $("#nombre_tipo_objeto").val(nombreTipoObjeto);
       $("#divDialogConsulta").modal('show');
   });

  /**
   * Se captura el evento cuando se abre el modal divDialogConsulta.
   */
  $("#divDialogConsulta").on("shown.bs.modal", function () {
      if (URLactual['href'].indexOf('consultar_cubierta') == -1 && URLactual['href'].indexOf('consultar_gradas') == -1 && URLactual['href'].indexOf('consultar_espacio') == -1 && URLactual['href'].indexOf('consultar_sede') == -1) {
          if (URLactual['href'].indexOf('consultar_campus') >= 0) {
              mapaModificacion.setZoom(15);
              google.maps.event.trigger(mapaModificacion, "resize");
              mapaModificacion.setCenter(coordsMapaModificacion);
          }else if((URLactual['href'].indexOf('consultar_tipo_material') == -1 && (URLactual['href'].indexOf('consultar_tipo_objeto') == -1))){
              mapaModificacion.setZoom(18);
              google.maps.event.trigger(mapaModificacion, "resize");
              mapaModificacion.setCenter(coordsMapaModificacion);
          }
      }
  });

  /**
  * Se captura el evento cuando se cierra el modal divDialogConsulta.
  */
  $('#divDialogConsulta').on('hidden.bs.modal', function () {
      $("#nombre_sede").attr('disabled','disabled');
      $("#nombre_campus").attr('disabled','disabled');
      $("#id_cancha").attr('disabled','disabled');
      $("#uso_cancha").attr('disabled','disabled');
      $("#material_piso").attr('disabled','disabled');
      $("#tipo_pintura").attr('disabled','disabled');
      $("#longitud_demarcacion").attr('disabled','disabled');
      $("#id_corredor").attr('disabled','disabled');
      $("#altura_pared").attr('disabled','disabled');
      $("#ancho_pared").attr('disabled','disabled');
      $("#material_pared").attr('disabled','disabled');
      $("#tipo_cubierta").attr('disabled','disabled');
      $("#material_cubierta").attr('disabled','disabled');
      $("#ancho").attr('disabled','disabled');
      $("#largo").attr('disabled','disabled');
      $("#pasamanos").attr('disabled','disabled');
      $("#material_pasamanos").attr('disabled','disabled');
      $("#tipo_ventana").attr('disabled','disabled');
      $("#cantidad_ventanas").attr('disabled','disabled');
      $("#material_ventana").attr('disabled','disabled');
      $("#ancho_ventana").attr('disabled','disabled');
      $("#alto_ventana").attr('disabled','disabled');
      $("#id_parqueadero").attr('disabled','disabled');
      $("#capacidad").attr('disabled','disabled');
      $("#ancho").attr('disabled','disabled');
      $("#largo").attr('disabled','disabled');
      $("#material_piso").attr('disabled','disabled');
      $("#tipo_pintura").attr('disabled','disabled');
      $("#longitud_demarcacion").attr('disabled','disabled');
      $("#id_piscina").attr('disabled','disabled');
      $("#alto").attr('disabled','disabled');
      $("#ancho").attr('disabled','disabled');
      $("#largo").attr('disabled','disabled');
      $("#cantidad_puntos_hidraulicos").attr('disabled','disabled');
      $("#id_plazoleta").attr('disabled','disabled');
      $("#nombre").attr('disabled','disabled');
      $("#tipo_iluminacion").attr('disabled','disabled');
      $("#cantidad_iluminacion").attr('disabled','disabled');
      $("#id_sendero").attr('disabled','disabled');
      $("#longitud").attr('disabled','disabled');
      $("#ancho").attr('disabled','disabled');
      $("#material_piso").attr('disabled','disabled');
      $("#tipo_iluminacion").attr('disabled','disabled');
      $("#cantidad_iluminacion").attr('disabled','disabled');
      $("#codigo_poste").attr('disabled','disabled');
      $("#ancho_cubierta").attr('disabled','disabled');
      $("#largo_cubierta").attr('disabled','disabled');
      $("#material_cubierta").attr('disabled','disabled');
      $("#id_via").attr('disabled','disabled');
      $("#tipo_pintura").attr('disabled','disabled');
      $("#longitud_demarcacion").attr('disabled','disabled');
      $("#material_piso").attr('disabled','disabled');
      $("#nombre_edificio").attr('disabled','disabled');
      $("#pisos_edificio").attr('disabled','disabled');
      $("#terraza").attr('disabled','disabled');
      $("#sotano").attr('disabled','disabled');
      $("#ancho_fachada").attr('disabled','disabled');
      $("#alto_fachada").attr('disabled','disabled');
      $("#material_fachada").attr('disabled','disabled');
      $("#id_espacio").attr('disabled','disabled');
      $("#pisos").attr('disabled','disabled');
      $("#uso_espacio").attr('disabled','disabled');
      $("#altura_pared").attr('disabled','disabled');
      $("#ancho_pared").attr('disabled','disabled');
      $("#material_pared").attr('disabled','disabled');
      $("#largo_techo").attr('disabled','disabled');
      $("#ancho_techo").attr('disabled','disabled');
      $("#material_techo").attr('disabled','disabled');
      $("#largo_piso").attr('disabled','disabled');
      $("#ancho_piso").attr('disabled','disabled');
      $("#material_piso").attr('disabled','disabled');
      $("#tipo_iluminacion").attr('disabled','disabled');
      $("#cantidad_iluminacion").attr('disabled','disabled');
      $("#tipo_suministro_energia").attr('disabled','disabled');
      $("#tomacorriente").attr('disabled','disabled');
      $("#cantidad_tomacorrientes").attr('disabled','disabled');
      $("#tipo_puerta").attr('disabled','disabled');
      $("#cantidad_puertas").attr('disabled','disabled');
      $("#material_puerta").attr('disabled','disabled');
      $("#tipo_cerradura").attr('disabled','disabled');
      $("#gato_puerta").attr('disabled','disabled');
      $("#material_marco_puerta").attr('disabled','disabled');
      $("#ancho_puerta").attr('disabled','disabled');
      $("#alto_puerta").attr('disabled','disabled');
      $("#tipo_ventana").attr('disabled','disabled');
      $("#cantidad_ventanas").attr('disabled','disabled');
      $("#material_ventana").attr('disabled','disabled');
      $("#ancho_ventana").attr('disabled','disabled');
      $("#alto_ventana").attr('disabled','disabled');
      $("#tipo_interruptor").attr('disabled','disabled');
      $("#cantidad_interruptores").attr('disabled','disabled');
      $("#tiene_espacio_padre").attr('disabled','disabled');
      $("#nombre_tipo_material").attr('disabled','disabled');
      $("#nombre_tipo_objeto").attr('disabled','disabled');
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
      $("#botones_anadir_iluminacion").hide();
      $("#botones_anadir_interruptor").hide();
      $("#botones_anadir_puerta").hide();
      $("#botones_anadir_tomacorriente").hide();
      $("#botones_anadir_ventana").hide();
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
  });

  /**
  * Se captura el evento cuando se cierra el modal divDialogConsulta.
  */
  $('#divDialogConsultaMapa').on('hidden.bs.modal', function () {
      eliminarComponente("tituloObjeto");
      eliminarComponente("informacionObjeto");
      iluminacionCont = 0, cerraduraCont = 0, tomacorrientesCont = 0, puertasCont = 0, ventanasCont = 0, interruptoresCont = 0, puntosSanitariosCont = 0, lavamanosCont = 0, orinalesCont = 0;
  });

  /**
   * Evento de cambio del selector de archivo del modal de consulta/modificación.
   */
  $("#planos").on("change", ".agregar_archivos", function(){
      var planos = document.getElementById("planos[]");
			var fotos = document.getElementById("fileInputOculto");
      var aux = numeroPlanos + planos.files.length;
      var aux2 = numeroFotos + fotos.files.length;
			if (aux > numeroPlanos) {
					$("#guardar_archivos").show();
			}else if(aux2 == numeroFotos){
					$("#guardar_archivos").hide();
			}
  });

  /**
   * Evento de cambio del selector de archivo del modal de consulta/modificación.
   */
  $("#myCarousel").on("change", ".upload", function(){
      var fotos = document.getElementById("fileInputOculto");
      var planos = document.getElementById("planos[]");
      var aux = numeroFotos + fotos.files.length;
      var aux2 = numeroPlanos + planos.files.length;
			if (aux > numeroFotos) {
					$("#guardar_archivos").show();
			}else if(aux2 == numeroPlanos){
					$("#guardar_archivos").hide();
			}
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_sede y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_sede").click(function (e){
      $("#nombre_sede").removeAttr("disabled");
      $("#modificar_sede").hide();
      $("#guardar_modificaciones_sede").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_campus y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_campus").click(function (e){
      $("#nombre_campus").removeAttr("disabled");
      $("#modificar_campus").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_campus").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_cancha y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_cancha").click(function (e){
      $("#uso_cancha").removeAttr("disabled");
      $("#material_piso").removeAttr("disabled");
      $("#tipo_pintura").removeAttr("disabled");
      $("#longitud_demarcacion").removeAttr("disabled");
      $("#modificar_cancha").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_cancha").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_corredor y se
   * realiza la operacion correspondiente.
   */
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
      $("#botones_anadir_iluminacion").show();
      $("#botones_anadir_interruptor").show();
      $("#modificar_corredor").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_corredor").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_cubierta y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_cubierta").click(function (e){
      $("#tipo_cubierta").removeAttr("disabled");
      $("#material_cubierta").removeAttr("disabled");
      $("#ancho").removeAttr("disabled");
      $("#largo").removeAttr("disabled");
      $("#modificar_cubierta").hide();
      $("#guardar_modificaciones_cubierta").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_gradas y se
   * realiza la operacion correspondiente.
   */
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
      $("#botones_anadir_ventana").show();
      $("#modificar_gradas").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_gradas").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_parqueadero y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_parqueadero").click(function (e){
      $("#capacidad").removeAttr("disabled");
      $("#ancho").removeAttr("disabled");
      $("#largo").removeAttr("disabled");
      $("#material_piso").removeAttr("disabled");
      $("#tipo_pintura").removeAttr("disabled");
      $("#longitud_demarcacion").removeAttr("disabled");
      $("#modificar_parqueadero").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_parqueadero").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_piscina y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_piscina").click(function (e){
      $("#alto").removeAttr("disabled");
      $("#ancho").removeAttr("disabled");
      $("#largo").removeAttr("disabled");
      $("#cantidad_puntos_hidraulicos").removeAttr("disabled");
      $("#modificar_piscina").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_piscina").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_plazoleta y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_plazoleta").click(function (e){
      $("#nombre").removeAttr("disabled");
      $("#tipo_iluminacion").removeAttr("disabled");
      $("#cantidad_iluminacion").removeAttr("disabled");
      for (var i = 1; i < iluminacionCont; i++) {
          $("#tipo_iluminacion"+i).removeAttr("disabled");
          $("#cantidad_iluminacion"+i).removeAttr("disabled");
      }
      $("#botones_anadir_iluminacion").show();
      $("#modificar_plazoleta").hide();
      $("#guardar_modificaciones_plazoleta").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_sendero y se
   * realiza la operacion correspondiente.
   */
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
      $("#modificar_sendero").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_sendero").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_via y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_via").click(function (e){
      $("#tipo_pintura").removeAttr("disabled");
      $("#longitud_demarcacion").removeAttr("disabled");
      $("#material_piso").removeAttr("disabled");
      $("#modificar_via").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_via").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_edificio y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_edificio").click(function (e){
      $("#nombre_edificio").removeAttr("disabled");
      $("#terraza").removeAttr("disabled");
      $("#sotano").removeAttr("disabled");
      $("#ancho_fachada").removeAttr("disabled");
      $("#alto_fachada").removeAttr("disabled");
      $("#material_fachada").removeAttr("disabled");
      $("#modificar_edificio").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_edificio").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_espacio y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_espacio").click(function (e){
      $("#uso_espacio").removeAttr("disabled");
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
      $("#espacio_padre").removeAttr("disabled");
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
      $("#botones_anadir_iluminacion").show();
      $("#botones_anadir_interruptor").show();
      $("#botones_anadir_puerta").show();
      $("#botones_anadir_tomacorriente").show();
      $("#botones_anadir_ventana").show();
      $("#modificar_espacio").hide();
      $("#guardar_archivos").hide();
      $("#guardar_modificaciones_espacio").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_tipo_material y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_tipo_material").click(function (e){
    $("#nombre_tipo_material").removeAttr("disabled");
    $("#modificar_tipo_material").hide();
    $("#guardar_modificaciones_tipo_material").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton modificar_tipo_objeto y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_tipo_objeto").click(function (e){
      $("#nombre_tipo_objeto").removeAttr("disabled");
      $("#modificar_tipo_objeto").hide();
      $("#guardar_modificaciones_tipo_objeto").show();
  });

  /**
   * Se captura el evento cuando se da click en el boton ver_campus y se
   * realiza la operacion correspondiente.
   */
  $("#map").on("click", ".ver_campus", function(){
      rellenarMapaConsulta();
  });

  /**
   * Se captura el evento cuando se da click en el boton ver_edificios y se
   * realiza la operacion correspondiente.
   */
  $("#map").on("click", ".ver_edificios", function(){
      for (var i = 0; i < marcadores.length; i++) {
          marcadores[i].setMap(null);
      }
      var info = {};
      info["nombre_sede"] = sedeSeleccionada;
      info["nombre_campus"] = campusSeleccionado;
      var edificios = buscarObjetos("edificios",info);
      var canchas = buscarObjetos("canchas",info);
      var corredores = buscarObjetos("corredores",info);
      var parqueaderos = buscarObjetos("parqueaderos",info);
      var piscinas = buscarObjetos("piscinas",info);
      var plazoletas = buscarObjetos("plazoletas",info);
      var senderos = buscarObjetos("senderos",info);
      var vias = buscarObjetos("vias",info);
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
                          '<div class="col-xs-6">'+
                              '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                          '</div>'+
                          '<div class="col-xs-6">'+
                              '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_espacios" name="ver_espacios" id="ver_espacios" value="Ver Espacios" title="Ver los espacios del edificio"/>'+
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
          $.each(canchas, function(index, record) {
              if($.isNumeric(index)) {
                  var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                  var marker = new google.maps.Marker({
                      position: myLatlng,
                      icon: 'vistas/images/icono_cancha.png',
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
              });
          }
      }
  });

  /**
   * Se captura el evento cuando se da click en el boton ver_cancha y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_cancha", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("cancha",info);
      var archivos = consultarArchivosObjeto("cancha",info);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/cancha/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton ver_corredor y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_corredor", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("corredor",info);
      var dataIluminacion = consultarInformacionObjeto("iluminacion_corredor",info);
      var dataInterruptor = consultarInformacionObjeto("interruptor_corredor",info);
      var archivos = consultarArchivosObjeto("corredor",info);
      console.log(data);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/corredor/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton ver_parqueadero y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_parqueadero", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("parqueadero",info);
      var archivos = consultarArchivosObjeto("parqueadero",info);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/parqueadero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton ver_piscina y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_piscina", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("piscina",info);
      var archivos = consultarArchivosObjeto("piscina",info);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/piscina/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton ver_plazoleta y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_plazoleta", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("plazoleta",info);
      var dataIluminacion = consultarInformacionObjeto("iluminacion_plazoleta",info);
      var archivos = consultarArchivosObjeto("plazoleta",info);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/plazoleta/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton ver_sendero y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_sendero", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("sendero",info);
      var archivos = consultarArchivosObjeto("sendero",info);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/sendero/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton ver_via y se
   * realiza la operacion correspondiente.
   */
  $("#contenido").on("click", ".ver_via", function(){
      var info =  {};
      var sede = sedeSeleccionada;
      var campus = campusSeleccionado;
      var id = limpiarCadena(codigoSeleccionado);
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      info['id'] = id;
      var data = consultarInformacionObjeto("via",info);
      var archivos = consultarArchivosObjeto("via",info);
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
              $("#nombre_sede").val(record.nombre_sede);
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
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active carouselImg">'
                       +'<img class="carouselImg" src="archivos/images/via/'+sede+'-'+campus+'-'+id+'/'+record.nombre+'" alt="'+record.nombre+'"/>'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item carouselImg">'
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
          +'<br><br></div>';
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
   * Se captura el evento cuando se da click en el boton modificar_campus y se
   * realiza la operacion correspondiente.
   */
  $("#guardar_archivos").click(function (e){
      if (window.confirm("¿Guardar los archivos seleccionados?")) {
          var planos = document.getElementById("planos[]");
          var fotos = document.getElementById("fileInputOculto");
          var aux = numeroFotos + fotos.files.length;
          var aux2 = numeroPlanos + planos.files.length;
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
                  informacion["piso"] = $("#pisos_search").val();
                  informacion["id_espacio"] = $("#espacio_search").val();
              }
              arregloFotos.append(tipoObjeto,JSON.stringify(informacion));
              arregloPlanos.append(tipoObjeto,JSON.stringify(informacion));
              var resultadoPlanos = guardarPlanos(tipoObjeto,arregloPlanos);
              var resultadoFotos = guardarFotos(tipoObjeto,arregloFotos);
              console.log(informacion);
              console.log(resultadoPlanos);
              console.log(resultadoFotos);
              var mensaje = "";
              if (resultadoPlanos.length > 0) {
                  for (var i=0;i<resultadoPlanos.mensaje.length;i++) {
                      if (!resultadoPlanos.verificar[i]) {
                          mensaje += resultadoPlanos.mensaje[i];
                      }
                      if (i<resultadoPlanos.verificar.length-2) {
                          mensaje += "\n";
                      }
                  }
              }
              if (resultadoFotos.length > 0) {
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
                  alert(mensaje);
              }else{
                  if (fotos.files.length > 1 || planos.files.length > 1) {
                      alert("Los archivos se han guardado correctamente");
                  }else if (fotos.files.length == 1 || planos.files.length == 1) {
                      alert("El archivo se ha guardado correctamente");
                  }
                  $("#divDialogConsulta").modal('hide');
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
      +'<br><div class="div_izquierda"><b>Tipo de lámpara ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_iluminacion" id="tipo_iluminacion'+iluminacionCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de lámparas del tipo ('+(iluminacionCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" name="cantidad_iluminacion" maxlength="10" id="cantidad_iluminacion'+iluminacionCont+'" value="" required/><br>'
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
      +'<br><div class="div_izquierda"><b>Tipo de suministro de energía ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_suministro_energia" id="tipo_suministro_energia'+tomacorrientesCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Tomacorriente ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tomacorriente" id="tomacorriente'+tomacorrientesCont+'" required>'
      +'<option value="seleccionar" selected="selected">--Seleccionar--</option>'
      +'<option value="regulado">Regulado</option>'
      +'<option value="no regulado">No Regulado</option>'
      +'</select><br>'
      +'<div class="div_izquierda"><b>Cantidad de tomacorrientes del tipo ('+(tomacorrientesCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_tomacorrientes" id="cantidad_tomacorrientes'+tomacorrientesCont+'" value="" required/><br>'
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
      +'<br><div class="div_izquierda"><b>Tipo de puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_puerta" id="tipo_puerta'+puertasCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de puertas del tipo ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puertas" id="cantidad_puertas'+puertasCont+'" value="" required/><br>'
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
      +'<select class="form-control formulario" name="material_marco_puerta" id="material_marco_puerta" required></select><br>'
      +'<div class="div_izquierda"><b>Ancho puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_puerta" id="ancho_puerta'+puertasCont+'" value="" required/><br>'
      +'<div class="div_izquierda"><b>Alto puerta ('+(puertasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_puerta" id="alto_puerta'+puertasCont+'" value="" required/><br>'
      +'</div>';
      añadirComponente("puerta",componente);
      actualizarSelectMaterial("material_marco_puerta",puertasCont);
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
      +'<br><div class="div_izquierda"><b>Tipo de ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_ventana" id="tipo_ventana'+ventanasCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de ventanas del tipo ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_ventanas" id="cantidad_ventanas'+ventanasCont+'" value="" required/><br>'
      +'<div class="div_izquierda"><b>Material de la ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="material_ventana" id="material_ventana'+ventanasCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Ancho ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="ancho_ventana" id="ancho_ventana'+ventanasCont+'" value="" required/><br>'
      +'<div class="div_izquierda"><b>Alto ventana ('+(ventanasCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="alto_ventana" id="alto_ventana'+ventanasCont+'" value="" required/><br>'
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
      +'<br><div class="div_izquierda"><b>Tipo de interruptor ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_interruptor" id="tipo_interruptor'+interruptoresCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de interruptores ('+(interruptoresCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_interruptores" id="cantidad_interruptores'+interruptoresCont+'" value="" required/><br>'
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
      +'<br><div class="div_izquierda"><b>Tipo de punto sanitario ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_punto_sanitario" id="tipo_punto_sanitario'+puntosSanitariosCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de puntos sanitarios del tipo ('+(puntosSanitariosCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_puntos_sanitarios" id="cantidad_puntos_sanitarios'+puntosSanitariosCont+'" value="" required/><br>'
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
      +'<br><div class="div_izquierda"><b>Tipo de orinal ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_orinal" id="tipo_orinal'+orinalesCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de orinales del tipo ('+(orinalesCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_orinales" id="cantidad_orinales'+orinalesCont+'" value="" required/><br>'
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
      +'<br><div class="div_izquierda"><b>Tipo de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
      +'<select class="form-control formulario" name="tipo_lavamanos" id="tipo_lavamanos'+lavamanosCont+'" required></select><br>'
      +'<div class="div_izquierda"><b>Cantidad de lavamanos ('+(lavamanosCont+1)+')<font color="red">*</font>:</b></div>'
      +'<input class="form-control formulario" type="number" min="1" maxlength="10" name="cantidad_lavamanos" id="cantidad_lavamanos'+lavamanosCont+'" value="" required/><br>'
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
   * Se captura el evento cuando se da click en el boton agregar_espacio y se
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
   * Se captura el evento cuando se da click en el boton eliminar_espacio y se
   * realiza la operacion correspondiente.
   */
  $("#eliminar_espacio").click(function (e){
      eliminarComponente("espacio"+espaciosCont);
      espaciosCont--;
      if(espaciosCont == 0){
          $("#divBotonesInformacionAdicional").show();
          $("#eliminar_espacio").attr('disabled','disabled');
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
});
