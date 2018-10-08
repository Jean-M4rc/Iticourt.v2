//---------------------------------------------------//
//                    ITICOURT                       //
//---------------------------------------------------//


var titleBlock = document.getElementById("titleblock");
var signinlink = document.getElementById("signinlink");
var buyingblock = document.getElementById("buyingblock");
var cancelmap = document.getElementById("cancelmap");
var mapBox = document.getElementById("mapBox");
var imgcat = document.getElementById("imgcat");

var map;

$('#buybtn1').click(function(){

    $(titleblock).hide('slow');
    $(signinlink).hide('slow');
    $(buyingblock).hide('slow');

    // Création de la map
    map = L.map('map').setView([49.182863, -0.370679], 8);

    // Création du calque images
    /*
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    */
    
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
    }).addTo(map);
    

    //Ajout d'un marqueur
    L.marker([49.182863, -0.370679])
    .addTo(map)
    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.');  

});

$(cancelmap).click(function(){

    map.remove(map);

    $(mapBox).hide('slow');
    $(imgcat).hide('slow');
    $(titleblock).show('slow');
    $(signinlink).show('slow');
    $(buyingblock).show('slow');

    

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
  