var gMap = {};

gMap.init = function() {
  google.maps.event.addDomListener( window, 'load', gMap.initMap );
};

gMap.initMap = function() {
  var mapOptions = {
    zoom: 15,
    scrollwheel: false,
    center: {lat: 51.5323382, lng: -0.0787519}
  };

  var map = new google.maps.Map( document.getElementById( 'map-canvas' ), mapOptions );

  var image = templateUrl + '/img/gMap_ico.png';

  var marker = new google.maps.Marker({
    map: map,
    place: {
      location: {lat: 51.530639, lng: -0.078752},
      query: 'Shoreditch Campus, Hackney Community College, Falkirk Street, London'
    },
    icon: image
  });

  var infowindow = new google.maps.InfoWindow({
    content: 'Hackney Community College<br>Shoreditch Campus<br>Falkirk Street<br>London N1 6HQ'
  });

  infowindow.open( map, marker );

  // Opens the InfoWindow when marker is clicked.
  marker.addListener('click', function() {
    infowindow.open( map, marker );
  });
};
