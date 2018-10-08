//---------------------------------------------------//
//                    ITICOURT                       //
//---------------------------------------------------//

var map;
var marker;

$( document ).ready(function() {
    map = L.map('map').setView([49.182863, -0.370679], 8);

    /*L.tileLayer('https://korona.geog.uni-heidelberg.de/tiles/roads/x={x}&y={y}&z={z}', {
    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    })
    .addTo(map);*/

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox.streets',
        accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
    }).addTo(map);
    
    L.marker([49.182863, -0.370679])
    .addTo(map)
    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.');
});

/**
 * Récupération des données GPS dans les formulaires
 */
$('#getCoordonates').click(function(){
    if(navigator.geolocation) {
        // L'API est disponible
        
        navigator.geolocation.getCurrentPosition(maPosition);

      } else {
        // Pas de support, proposer une alternative ?
      }
});

function maPosition(position) {

    $('#longInput').val(position.coords.longitude);
    $('#latInput').val(position.coords.latitude);
    
}
  