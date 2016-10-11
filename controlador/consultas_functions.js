$(document).ready(function() {

  var mapaConsulta, mapaModificacion;
  var marcadores = [];

  initMap();
  actualizarSelectSede();

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
      if (data.mensaje != "") {
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
          getCoordenadas();
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
   * Se captura el evento cuando se da click en el boton visualizarCampus y se
   * realiza la operacion correspondiente.
   */
  $("#modificar_campus").click(function (e){
      $("#modificar_campus").hide();
      $("#guardar_modificaciones_campus").show();
  });
});
