//---------------------------------------------------//
//                    ITICOURT                       //
//---------------------------------------------------//


var titleBlock = document.getElementById("titleblock");
var signinlink = document.getElementById("signinlink");
var buyingblock = document.getElementById("buyingblock");
var cancelmap = document.getElementById("cancelmap");
var mapBox = document.getElementById("mapBox");
var imgcat = document.getElementById("imgcat");
var listcat = document.getElementById("listcat");

var map;
var mylong, mylat,myspeed,userWatch;

$('#buybtn1').click(function(){

    $(titleblock).hide('slow');
    $(signinlink).hide('slow');
    $(buyingblock).hide('slow');
    $(imgcat).show();
    
    
    // On affiche un loader le temps de chargement de la map.
    $('#loader').show();
   
    if(navigator.geolocation) {

        // L'API est disponible

        // On déclare la variable userWatch afin de pouvoir par la suite annuler le suivi de la position
        var userWatch = navigator.geolocation.watchPosition(userPosition);

        function userPosition(position) {

            mylong = position.coords.longitude;
            mylat = position.coords.latitude;
            myspeed = position.coords.speed;

            var usercoord = [mylat, mylong];

            // Création de la map
            map = L.map('map').setView(usercoord, 10);
               
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox.streets',
            accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
            }).addTo(map);

            /*L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);*/

            /*L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            maxZoom: 20,
            attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(map);*/
            
    
            // Ajout d'un marqueur sur l'utilisateur
            L.marker([mylat, mylong])
            .addTo(map)
            .bindPopup('Je suis ici' +'\n'+'Ma latitude est : '+mylat+'\n'+'Ma longitude est : '+mylong+'\n'+'Ma vitesse est : '+myspeed); 

        }

        $(mapBox).show('slow');
    } else {
        
        alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
    }

    $('#map').ready( function(){
        setTimeout(function(){
            $('#loader').hide()
        },3000)
        
    });
    
    
});

$(cancelmap).click(function(){

    // Annule le suivi de la position si nécessaire.
    navigator.geolocation.clearWatch(userWatch);

    $('#mapBox').innerHTML = "<div id='map'></div>";
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

        function maPosition(position) {

            $('#longInput').val(position.coords.longitude);
            $('#latInput').val(position.coords.latitude);
            
        }

    } else {

        // Pas de support, proposer une alternative ?
        alert('Une erreur est survenue, veuillez réessayer.');
    
    }
});

/*
    function maPosition(position) {

    mylong = position.coords.longitude;
    mylat = position.coords.latitude;
    // Création de la map
    map = L.map('map').setView([mylat, mylong], 10);

    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox.streets',
    accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
    }).addTo(map);

    //Ajout d'un marqueur
    L.marker([mylat, mylong])
    .addTo(map)
    .bindPopup('Je suis ici');  
    }*/

    // Création du calque images
    /*
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
*/

function getroute(targetlat, targetlong, originlat, originlong){
    L.Routing.control({
        waypoints: [
          L.latLng(49.182863, -0.370679), 
          L.latLng(49.276437, -0.70314) 
        ]
        
    }).addTo(map);
}
  