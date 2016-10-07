$(document).ready(function() {

  var mapaConsulta, mapaModificacion, campusSeleccionado;
  var marcadores = [];
  var URLactual = window.location;
  var infoWindowActiva;

  /**
   * Función que se ejecuta al momento que se accede a la página que lo tiene
   * incluido.
   * @returns {undefined}
   */
  (function (){
      if(URLactual['href'].indexOf('consultar_campus') >= 0){
          actualizarSelectSede();
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_edificio') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_fachada",0);
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_cancha') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_pintura",0);
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_corredor') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_pared",0);
          actualizarSelectMaterial("material_techo",0);
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_iluminacion",0);
          actualizarSelectTipoObjeto("tipo_interruptor",0);
          actualizarSelectTipoObjeto("tipo_suministro_energia",0);
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_cubierta') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_cubierta",0);
          actualizarSelectTipoObjeto("tipo_cubierta",0);
      }else if(URLactual['href'].indexOf('consultar_gradas') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_pasamanos",0);
          actualizarSelectMaterial("material_ventana",0);
          actualizarSelectTipoObjeto("tipo_ventana",0);
      }else if(URLactual['href'].indexOf('consultar_parqueadero') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_pintura",0);
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_piscina') >= 0){
          actualizarSelectSede();
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_plazoleta') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_pintura",0);
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_sendero') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_cubierta",0);
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_iluminacion",0);
          initMap();
          getCoordenadas(mapaConsulta);
      }else if(URLactual['href'].indexOf('consultar_via') >= 0){
          actualizarSelectSede();
          actualizarSelectMaterial("material_piso",0);
          actualizarSelectTipoObjeto("tipo_pintura",0);
          initMap();
          getCoordenadas(mapaConsulta);
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
      }else if(URLactual['href'].indexOf('consultar_mapa') >= 0){
          initMapConsulta();
          rellenarMapa();
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
          //mapTypeId: google.maps.MapTypeId.ROADMAP
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
   * Función que realiza una consulta de los campus presentes en el sistema
   * @returns {data} object json
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
   * Función que realiza una consulta de la información de un campus en el sistema
   * @returns {data} object json
  **/
  function consultarInformacionCampus(info){
      var jObject = JSON.stringify(info);
      var dataResult;
      try {
          $.ajax({
              type: "POST",
              url: "index.php?action=consultar_informacion_campus",
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
   * Función que realiza una consulta de los archivos de un campus
   * @returns {data} object json
  **/
  function consultarArchivosCampus(info){
      var jObject = JSON.stringify(info);
      var dataResult;
      try {
          $.ajax({
              type: "POST",
              url: "index.php?action=consultar_archivos_campus",
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
   * @returns {data} object json
  **/
  function ubicacionCampus(info){
      var jObject = JSON.stringify(info);
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
   * Función que realiza una consulta el número de pisos de un edificio
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
   * Función que realiza una consulta de los materiales presentes en el sistema
   * @param {array} informacion, arreglo que contiene el tipo de material a buscar
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
   * @param {array} informacion, arreglo que contiene el tipo de objeto a buscar
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
  function rellenarMapa(){
      for (var i = 0; i < marcadores.length; i++) {
          marcadores[i].setMap(null);
      }
      var bounds  = new google.maps.LatLngBounds();
      var sede = {};
      sede["nombre_sede"] = "";
      var data = buscarCampus(sede);
      $.each(data, function(index, record) {
          if($.isNumeric(index)) {
              if (record.lat != '0' || record.lng != '0') {
                  var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                  var marker = new google.maps.Marker({
                      position: myLatlng,
                      title: record.nombre_campus,
                      id: record.id
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
                  /*var select = this.id;
                  var limites = new google.maps.LatLngBounds();
                  var loc = new google.maps.LatLng(this.position.lat(), this.position.lng());
                  limites.extend(loc);
                  mapaConsulta.fitBounds(limites);
                  mapaConsulta.panToBounds(limites);*/
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
   * Se captura el evento cuando se modifica el valor del selector nombre_sede
   * y se actualiza el selector de campus.
   */
  $("#sede_search").change(function (e) {
      for (var i = 0; i < marcadores.length; i++) {
          marcadores[i].setMap(null);
      }
      var sede = {};
      var bounds  = new google.maps.LatLngBounds();
      sede["nombre_sede"] = limpiarCadena($("#sede_search").val());
      var data = buscarCampus(sede);
      $("#campus_search").empty();
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
                  id: record.id
              });
              marcadores.push(marker);
              marker.setMap(mapaConsulta);
              var loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
              bounds.extend(loc);
          }
      });
      if (data.mensaje != null) {
          mapaConsulta.fitBounds(bounds);
          mapaConsulta.panToBounds(bounds);
          for (var i = 0; i < marcadores.length; i++) {
              google.maps.event.addListener(marcadores[i], 'click',
              function () {
                  var select = this.id;
                  var limites = new google.maps.LatLngBounds();
                  $("#campus_search").val(select);
                  var loc = new google.maps.LatLng(this.position.lat(), this.position.lng());
                  limites.extend(loc);
                  mapaConsulta.fitBounds(limites);
                  mapaConsulta.panToBounds(limites);
              });
          }
      }else{
        getCoordenadas(mapaConsulta);
      }
      $("#edificio_search").empty();
      $("#pisos_search").empty();
  });

  /**
   * Se captura el evento cuando se modifica el valor del selector nombre_campus
   * y se actualiza el selector de edificios.
   */
  $("#campus_search").change(function (e) {
      for (var i = 0; i < marcadores.length; i++) {
          if (marcadores[i].id == $("#campus_search").val()) {
              mapaConsulta.setCenter(marcadores[i].getPosition());
              break;
          }
      }
      var campus = $("campus_search").val();
      if (campus != "") {
          $('#visualizarCampus').removeAttr("disabled");
      }
      /*var campus = {};
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
          getCoordenadas(mapaConsulta);
      }else{
          var coords =  {
              lng: longitud,
              lat: latitud
          }
          if (map != undefined) {
            map.panTo(coords);
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
      $("#pisos").empty();*/
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
                aux = "Sotano";
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
          }
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
      var data = consultarInformacionCampus(info);
      var archivos = consultarArchivosCampus(info);
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
  $("#map").on("click", ".ver_edificios", function(){
    for (var i = 0; i < marcadores.length; i++) {
        marcadores[i].setMap(null);
    }
    var info = {};
    info["nombre_campus"] = campusSeleccionado;
    var data = buscarEdificios(info);
    console.log(data);
    var bounds  = new google.maps.LatLngBounds();
    if (data.mensaje == null) {
        alert("El campus seleccionado no tiene edificios creados en el sistema o con su ubicación establecida");
        rellenarMapa();
    }else{
        $.each(data, function(index, record) {
            if($.isNumeric(index)) {
                var myLatlng = new google.maps.LatLng(record.lat,record.lng);
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    title: record.nombre_campus,
                    id: record.id
                });
                var contentString = '<div id="content">'+
                    '<div id="siteNotice">'+
                    '</div>'+
                    '<h3 id="firstHeading" class="firstHeading">Informaci&oacute;n Edificio</h3>'+
                    '<div id="bodyContent">'+
                      '<p><b>Sede:</b> '+record.nombre_sede+'<br><b>Campus:</b> '+record.nombre_campus+'<br><b>Edificio:</b> '+record.id+'-'+record.nombre_edificio+'</p>'+
                      '<div class="form_button">'+
                      '<div class="col-xs-6">'+
                        '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_campus" name="ver_campus" id="ver_campus" value="Ver Campus" title="Ver todos los campus"/>'+
                      '</div>'+
                      '<div class="col-xs-6">'+
                        '<input type="submit" class="btn btn-primary btn-lg btn-formulario ver_espacios" name="ver_espacios" id="ver_espacios" value="Ver Espacios" title="Ver espacios del edificio"/>'+
                      '</div>'+
                      '</div>'+
                    '</div>'+
                    '</div>';
                infoWindow = new google.maps.InfoWindow({
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
    if (data.mensaje != null) {
        mapaConsulta.fitBounds(bounds);
        mapaConsulta.panToBounds(bounds);
        for (var i = 0; i < marcadores.length; i++) {
            google.maps.event.addListener(marcadores[i], 'click',
            function () {
                /*var select = this.id;
                var limites = new google.maps.LatLngBounds();
                campusSeleccionado = select;
                var loc = new google.maps.LatLng(this.position.lat(), this.position.lng());
                limites.extend(loc);
                mapaConsulta.fitBounds(limites);
                mapaConsulta.panToBounds(limites);*/
                mapaConsulta.setZoom(19);
                mapaConsulta.setCenter(this.getPosition());
            });
        }
    }
  });

  /**
   * Se captura el evento cuando se da click en el boton ver_edificios y se
   * realiza la operacion correspondiente.
   */
  $("#map").on("click", ".ver_campus", function(){
      rellenarMapa();
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
