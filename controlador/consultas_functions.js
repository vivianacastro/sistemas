$(document).ready(function() {

  initMap();
  getCoordenadas();

  /**
   * Función que carga el mapa y lo configura.
   * @returns {undefined}
   */
  function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 3.375119, lng: -76.5336927}, //Coordenadas Univalle - Meléndez
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.MARKER,
          drawingControl: true,
          drawingControlOptions: {
              position: google.maps.ControlPosition.TOP_CENTER,
              drawingModes: [
                  google.maps.drawing.OverlayType.MARKER
              ]
          },
          markerOptions: {
              draggable: true
          }
      });
      drawingManager.setMap(map);
      google.maps.event.addListener(drawingManager, 'overlaycomplete', function(event) {
          coordenadas = (event.overlay.getPosition());
          map.panTo(coordenadas);
          drawingManager.setOptions({
              drawingControl: false
          });
          drawingManager.setDrawingMode(null);
          var element = event.overlay;
          google.maps.event.addListener(element, 'click', function(e) {
              element.setMap(null);
              drawingManager.setOptions({
                  drawingControl: true
              });
              drawingManager.setDrawingMode(google.maps.drawing.OverlayType.MARKER);
          });
      });
  }

  /**
   * Función que obtiene las coordenadas donde se encuentra el usuario
   * y actualiza el mapa.
   * @returns {undefined}
  */
  function getCoordenadas(){
      var coords = {};
      navigator.geolocation.getCurrentPosition(function (position){
          coords =  {
              lng: position.coords.longitude,
              lat: position.coords.latitude
          }
          map.panTo(coords);
          google.maps.event.trigger(map, 'resize');
      },function(error){
          console.log(error);
      });
  }
});
