$(document).ready(function() {

  var mapaConsulta, mapaModificacion, sedeSeleccionada, campusSeleccionado;
  var campusSelect = null;
  var marcadores = [];
  var URLactual = window.location;
  var infoWindowActiva;

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
          actualizarSelectTipoObjeto("tipo_pintura",0);
          initMap();
          rellenarMapa(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_cubierta",0);
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_iluminacion",0);
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
          zoom: 16,
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
              url: "index.php?action=consultar_informacion"+tipo_objeto,
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
                        '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_edificios" name="ver_edificios" id="ver_edificios" value="Ver Edificios Campus" title="Ver edificios del campus"/>'+
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
   * y se actualiza el selector de campus.
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
          }else if (URLactual['href'].indexOf('consultar_cubiertas') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0 || URLactual['href'].indexOf('consultar_espacios') >= 0) {
              $("#edificio_search").empty();
              $("#pisos_search").empty();
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector campus_search
   * y se actualiza el selector de edificios.
   */
  $("#campus_search").change(function (e) {
      if (URLactual['href'].indexOf('consultar_campus') >= 0) {
          for (var i = 0; i < marcadores.length; i++) {
              if (marcadores[i].id == $("#campus_search").val()) {
                  mapaConsulta.setCenter(marcadores[i].getPosition());
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
                  if (URLactual['href'].indexOf('consultar_cubiertas') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0 || URLactual['href'].indexOf('consultar_espacios') >= 0) {
                      $("#pisos_search").empty();
                  }
              }
          }else{
              var sede = $("#sede_search").val();
              $("#sede_search").val(sede).change();
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector codigo_search
   * y se actualiza el selector de pisos.
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
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector edificio_search
   * y se actualiza el selector de pisos.
   */
  $("#edificio_search").change(function (e) {
      if (URLactual['href'].indexOf('consultar_cubierta') >= 0 || URLactual['href'].indexOf('consultar_gradas') >= 0 || URLactual['href'].indexOf('consultar_edificio') >= 0) {
          for (var i = 0; i < marcadores.length; i++) {
              if (marcadores[i].id == $("#edificio_search").val()) {
                  mapaConsulta.setCenter(marcadores[i].getPosition());
                  break;
              }
          }
          if (validarCadena($("#edificio_search").val())) {
              if (URLactual['href'].indexOf('consultar_cubierta') >= 0) {
                  $('#visualizarCubierta').removeAttr("disabled");
              }else if (URLactual['href'].indexOf('consultar_gradas') >= 0) {
                  $('#visualizarGradas').removeAttr("disabled");
              }else if (URLactual['href'].indexOf('consultar_edificio') >= 0) {
                  $('#visualizarEdificio').removeAttr("disabled");
              }
          }else{
              if (URLactual['href'].indexOf('consultar_cubierta') >= 0) {
                  $('#visualizarCubierta').attr('disabled','disabled');
              }else if (URLactual['href'].indexOf('consultar_gradas') >= 0) {
                  $('#visualizarGradas').removeAttr("disabled");
              }else if (URLactual['href'].indexOf('consultar_edificio') >= 0) {
                  $('#visualizarEdificio').removeAttr("disabled");
              }
          }
      }else{
          var edificio = {};
          var numeroPisos, terraza, sotano;
          if (validarCadena($("#edificio_search").val())) {
              edificio["nombre_sede"] = $("#sede_search").val();
              edificio["nombre_campus"] = $("#campus_search").val();
              edificio["nombre_edificio"] = $("#edificio_search").val();
              if(URLactual['href'].indexOf('consultar_cubierta') >= 0){
                  var data = buscarObjetos("cubiertas",edificio);
              }else if(URLactual['href'].indexOf('consultar_gradas') >= 0){
                  var data = buscarObjetos("gradas",edificio);
              }else{
                  var data = buscarObjetos("pisos_edificio",edificio);
              }
              if (URLactual['href'].indexOf('crear_gradas') >= 0) {
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
                          aux = "Sotano";
                          row = $("<option value='sotano'/>");
                          row.text(aux);
                          row.appendTo("#pisos_search");
                      }
                      if (i == (numeroPisos-1) && terraza == 'true') {
                          aux = i+1;
                          row = $("<option value='" + aux + "'/>");
                          row.text(aux);
                          row.appendTo("#pisos_search");
                          aux = "Terraza";
                      }else if(i < (numeroPisos-1)){
                          aux = i+1;
                          row = $("<option value='" + aux + "'/>");
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
                          aux = "Sotano";
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
          }else{
              var campus = $("#campus_search").val();
              $("#campus_search").val(campus).change();
              $("#pisos_search").empty();
              $("#espacio_search").empty();
          }
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector pisos_search
   * y se actualiza el selector de pisos.
   */
  $("#pisos_search").change(function (e) {
      if (URLactual['href'].indexOf('consultar_edificio') >= 0) {
          for (var i = 0; i < marcadores.length; i++) {
              if (marcadores[i].id == $("#edificio_search").val()) {
                  mapaConsulta.setCenter(marcadores[i].getPosition());
                  break;
              }
          }
          if (validarCadena($("#edificio_search").val())) {
              $('#visualizarCubierta').removeAttr("disabled");
              $('#visualizarGradas').removeAttr("disabled");
          }else{
              $('#visualizarCubierta').attr('disabled','disabled');
              $('#visualizarGradas').removeAttr("disabled");
          }
      }else{
          var edificio = {};
          edificio["nombre_sede"] = $("#sede_search").val();
          edificio["nombre_campus"] = $("#campus_search").val();
          edificio["nombre_edificio"] = $("#edificio_search").val();
          if($("#pisos_search").val() == '-1'){
              edificio["piso"] = "terraza";
          }else if($("#pisos_search").val() == '0'){
              edificio["piso"] = "sotano";
          }else{
              edificio["piso"] = $("#pisos_search").val();
          }
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
      }
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector pisos_search
   * y se actualiza el selector de pisos.
   */
  $("#espacio_search").change(function (e) {
      if (validarCadena($("#espacio_search").val())) {
          $('#visualizarEspacio').removeAttr("disabled");
      }else{
          $('#visualizarEspacio').attr('disabled','disabled');
      }
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarCampus y se
   * realiza la operacion correspondiente.
   */
  $("#visualizarCampus").click(function (e){
      var info =  {};
      var sede = $("#sede_search").val();
      var campus = $("#campus_search").val();
      var bounds  = new google.maps.LatLngBounds();
      info['nombre_sede'] = sede;
      info['nombre_campus'] = campus;
      var data = consultarInformacionObjeto("campus",info);
      var archivos = consultarArchivosObjeto("campus",info);
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              $("#nombre_sede").val(record.nombre_sede);
              $("#nombre_campus").val(record.nombre_campus);
              var myLatlng = new google.maps.LatLng(record.lat,record.lng);
              var marker = new google.maps.Marker({
                  position: myLatlng,
                  //draggable: true,
                  title: record.nombre_campus,
                  id: record.id_campus
              });
              marker.setMap(mapaModificacion);
              var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
              bounds.extend(loc);
          }
      });
      $("#myCarousel").hide();
      eliminarComponente("slide_carrusel");
      eliminarComponente("item_carrusel");
      $.each(archivos, function(index, record) {
          if($.isNumeric(index)) {
              if (record.tipo == 'foto') {
                  console.log(index);
                  if ((index-1) == 0) {
                     var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="0" class="active"></li>';
                     var componente2 = '<div id="item_carrusel" class="item active">'
                       +'<img src="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'" alt="'+record.nombre+'">'
                       +'</div>';
                 }else{
                      var componente = '<li id="slide_carrusel" data-target="#myCarousel" data-slide-to="'+(index-1)+'"></li>'
                      var componente2 = '<div id="item_carrusel" class="item">'
                        +'<img src="archivos/images/campus/'+sede+'-'+campus+'/'+record.nombre+'" alt="'+record.nombre+'">'
                        +'</div>';
                 }
                  añadirComponente("indicadores_carrusel",componente);
                  añadirComponente("fotos_carrusel",componente2);
                  $("#myCarousel").show();
              }else{
                  var componente = '<div class="div_izquierda">'
                  +'<a target="_blank" href="archivos/planos/campus/'+sede+'-'+campus+'/'+record.nombre+'">'
                  +'<span>'+record.nombre+'</span>'
                  +'</a></div>';
                  añadirComponente("planos",componente);
              }
          }
      });
      mapaModificacion.fitBounds(bounds);
      mapaModificacion.panToBounds(bounds);
      $("#divDialogConsulta").modal('show');
  });

  /**
   * Se captura el evento cuando se da click en el boton ver_edificios y se
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
                        '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>parqueadero:</b> '+record.id+'</p>'+
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
                      title: "Sendero: " + record.id,
                      id: record.id,
                      id_campus: record.id_campus,
                      id_sede: record.id_sede
                  });
                  var contentString = '<div id="content">'+
                      '<div id="siteNotice">'+
                      '</div>'+
                      '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Sendero</h3>'+
                      '<div id="bodyContent">'+
                        '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Sendero:</b> '+record.id+'</p>'+
                        '<div class="form_button">'+
                        '<div class="col-xs-12">'+
                            '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_sendero" name="ver_sendero" id="ver_sendero" value="Ver Informaci&oacute;n Sendero" title="Ver la informaci&oacute;n del sendero"/>'+
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
                      title: "V&iacute;a: " + record.id,
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
      if (edificios.mensaje != null && canchas.mensaje != null && corredores.mensaje != null && parqueaderos.mensaje != null && piscinas.mensaje != null && plazoletas.mensaje != null && senderos.mensaje != null && vias.mensaje != null) {
          mapaConsulta.fitBounds(bounds);
          mapaConsulta.panToBounds(bounds);
          for (var i = 0; i < marcadores.length; i++) {
              google.maps.event.addListener(marcadores[i], 'click',
              function () {
                  mapaConsulta.setZoom(19);
                  mapaConsulta.setCenter(this.getPosition());
              });
          }
      }
  });

  /**
   * Se captura el evento cuando se da click en el boton visualizarCampus y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_campus").click(function (e){
      $("#modificar_campus").hide();
      $("#guardar_modificaciones_campus").show();
  });
});
