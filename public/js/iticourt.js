//---------------------------------------------------//
//                    ITICOURT                       //
//---------------------------------------------------//

// Déclaration des variables et des sélecteurs jQuery

    var titleBlock = document.getElementById("titleblock"),
        signinlink = document.getElementById("signinlink"),
        buyingblock = document.getElementById("buyingblock"),
        listcat = document.getElementById("listcat"),
        imgcat = document.getElementById("imgcat"),
        cancelmap = document.getElementById("cancelmap"),
        mapBox = document.getElementById("mapBox"),
        map,
        mylong,
        mylat,
        myspeed,
        userWatch;

// ------------------------------------------------------- //
// ------------------------- MAP ------------------------- //
// ------------------------------------------------------- //
// Ici on crée la map. On traite les informations pour
// afficher les marqueurs, et créer les itinéraires.


    var mapComponent = {

        init :function (){

            if(navigator.geolocation) {
                
                //Lancement du Loader
                $('#loader').show();

                // L'API est disponible
        
                // On déclare la variable userWatch afin de pouvoir par la suite annuler le suivi de la position
                var userWatch = navigator.geolocation.watchPosition(userPosition);
        
                function userPosition(position) {
        
                    mylong = position.coords.longitude;
                    mylat = position.coords.latitude;
                    myspeed = position.coords.speed;
        
                    return usercoord = [mylat, mylong];

                }

                // Création de la map
                map = L.map('map').setView(userPosition(position), 10);
                    
                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
                }).addTo(map);
                    
                // Ajout d'un marqueur sur l'utilisateur
                L.marker([mylat, mylong]).addTo(map).bindPopup('Ma latitude est : '+mylat+'\n'+'Ma longitude est : '+mylong+'\n'+'Ma vitesse est : '+myspeed); 
            
                // Suppression du Loader lorsque les classes "leaflet" sont chargées
                $('.leaflet-container').ready(function(){
                    $('#loader').hide();
                });
    
                
            }else{
                
                alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
            }
        },

        sellersMarkers : function(){

            axios({
                method: 'get',
                url: 'https://iticourt.v2.test/sellersMarkersGet'
            })
            .then((response) => {
                //console.log("Réponse : ", JSON.stringify(response));
                //console.log("Premier element dans data : ", JSON.stringify( response.data[0] ) );
                //console.log(JSON.parse(response));
                var categorySellers = JSON(response);
                var category = [];

                for (var i = 0; i < categorySellers.length; i++) {
                    console.log(categorySellers[i].name);
                }

                /*function createMarker() {

                    var dispo = ((stations[i].available_bikes));

                    marker = new google.maps.Marker({

                        position: stations[i].position,
                        name: stations[i].name,
                        address: stations[i].address,
                        status: stations[i].status,
                        bike_stands: stations[i].bike_stands,
                        available_bike_stands: stations[i].available_bike_stands,
                        available_bikes: stations[i].available_bikes,
                        map: map,
                        used: used,
                        icon: image,
                        indice: i
                    });

                    markers.push(marker);
                    marker.addListener('click', function () {
                        
                        //on initialise l'objet à réserver et on l'affiche dans l'infoBox
                        etatStat.init(this.status, this.name, this.address, this.available_bike_stands, this.available_bikes, this.used, this.icon, this.indice);
                        animDom.showEtat();
                        map.setZoom(17);
                        map.setCenter(this.getPosition());

                    });
                }*/
            })
        },

        getRoute : function(targetlat, targetlong, originlat, originlong){

            L.Routing.control({
                waypoints: [
                L.latLng(49.182863, -0.370679), 
                L.latLng(49.276437, -0.70314) 
                ]
                
            }).addTo(map);
        },

    }

// ------------------------------------------------------- //
// ------------------------ DOM SHOW --------------------- //
// ------------------------------------------------------- //
//Ici on anime le DOM. On affiche on masque certains éléments,
// on en crée certains

    var animDOM = {

        showMap : function() {

            $(titleblock).hide('slow');
            $(signinlink).hide('slow');
            $(buyingblock).hide('slow');
            $(imgcat).show();
            $(mapBox).show('slow');

            var mapDiv = document.createElement("div");
            mapDiv.id ="map";
            mapBox.appendChild(mapDiv);

            mapComponent.init();

            mapComponent.sellersMarkers();
        },

        hideMap : function(){

            // Annule le suivi de la position si nécessaire.
            navigator.geolocation.clearWatch(userWatch);

            $('#map').remove();
            $(mapBox).hide('slow');
            $(imgcat).hide('slow');
            $(titleblock).show('slow');
            $(signinlink).show('slow');
            $(buyingblock).show('slow');

        }
    }

// ------------------------------------------------------- //
// --------------- METHODE PROCEDURALE  ------------------ //
// ------------------------------------------------------- //

$('#buybtn1').click(function(){

    $(titleblock).hide('slow');
    $(signinlink).hide('slow');
    $(buyingblock).hide('slow');
    $(imgcat).show();
    $(mapBox).show('slow');
    var mapDiv = document.createElement("div");
    mapDiv.id ="map";
    mapBox.appendChild(mapDiv);
   
    // mapComponent.init(){
    if(navigator.geolocation) {

        //Loader
        $('#loader').show();

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

            
            // Ajout d'un marqueur sur l'utilisateur
            L.marker([mylat, mylong])
            .addTo(map)
            .bindPopup('Je suis ici' +'\n'+'Ma latitude est : '+mylat+'\n'+'Ma longitude est : '+mylong+'\n'+'Ma vitesse est : '+myspeed); 

            //mapComponent.sellersMarkers();
            

            $('.leaflet-container').ready(function(){
                $('#loader').hide();
            });

        }

    } else {
        
        alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
    }
    
});

$(cancelmap).click(function(){

    // Annule le suivi de la position si nécessaire.
    navigator.geolocation.clearWatch(userWatch);

    $('#map').remove();
    $(mapBox).hide();
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

// Layer pas utiliser 

/* L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map); */

/*L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
maxZoom: 20,
attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);*/

/*L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);*/

/*L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
maxZoom: 20,
attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);*/         
    

// ancienne procédure 

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