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
    userWatch,
    FLgroup,
    VOgroup,
    LFgroup,
    BAgroup,
    overlayMaps,
    sellersLF;

// ------------------------------------------------------- //
// ------------------------- MAP ------------------------- //
// ------------------------------------------------------- //
// Ici on crée la map. On traite les informations pour
// afficher les marqueurs, et créer les itinéraires.


var mapComponent = {

    init: function () {

        if (navigator.geolocation) {

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
            L.marker([mylat, mylong]).addTo(map).bindPopup('Ma latitude est : ' + mylat + '\n' + 'Ma longitude est : ' + mylong + '\n' + 'Ma vitesse est : ' + myspeed);

            // Suppression du Loader lorsque les classes "leaflet" sont chargées
            $('.leaflet-container').ready(function () {
                $('#loader').hide();
            });


        } else {

            alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
        }
    },

    // Cette méthode récupère tout les vendeurs
    sellersMarkersAll: function () {

        axios({
                method: 'get',
                url: 'https://iticourt.v2.test/sellersMarkersGet'
            })
            .then((response) => {
                
                var categorySellers = response.data;
                
                // Cela me donne l'array response
                // Il y a quatre catégorie et cela ne change pas
                // Donc on sait par avance que categorySeller contiendra
                // Quatre objets, les quatre catégories.

                // Fruits et Légumes
                var catFL = categorySellers[0];

                var sellersFL = [];

                var greenIcon = L.icon({
                    iconUrl: '/storage/iconMarkers/markerGreen.png',
                    iconSize:     [24, 45], // size of the icon
                    iconAnchor:   [12, 45], // point of the icon which will correspond to marker's location
                    popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAnchor
                });

                if(catFL.sellers.length != 0){

                    for(var z = 0; z < catFL.sellers.length; z++){

                        // On défini les données de chaque vendeur                        
                        var sellerId = catFL.sellers[z].id;
                        var sellerName = catFL.sellers[z].business_name;
                        var sellerLat = catFL.sellers[z].latitude;
                        var sellerLong = catFL.sellers[z].longitude;
                        var sellerAvatar = catFL.sellers[z].avatar1_path;
                        var sellerTeaser = catFL.sellers[z].presentation;

                        var seller = L.marker([sellerLat, sellerLong], {icon : greenIcon}).bindPopup('<p class="lead text-center">' + sellerName +'</p><p>' + sellerTeaser+'</p><p class="text-center lead"><a  href="/sellerFile'+sellerId+'"><img class="d-flex mx-auto" src="/storage/'+sellerAvatar+'" width="120px" height="120px"/>Voir ma fiche</a></p>').addTo(map);

                        sellersFL.push(seller);


                    }

                FLgroup = L.layerGroup(sellersFL);

                }


                

                // Viandes et Oeufs
                var catVO = categorySellers[1];

                var sellersVO = [];

                var redIcon = L.icon({
                    iconUrl: '/storage/iconMarkers/markerRed.png',
                    iconSize:     [24, 45], // size of the icon
                    iconAnchor:   [12, 45], // point of the icon which will correspond to marker's location
                    popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAnchor
                });

                // S'il y a des vendeurs de cette catégorie on les affiche
                if(catVO.sellers.length != 0){

                    for(var z = 0; z < catVO.sellers.length; z++){

                        // On défini les données de chaque vendeur                        
                        var sellerId = catVO.sellers[z].id;
                        var sellerName = catVO.sellers[z].business_name;
                        var sellerLat = catVO.sellers[z].latitude;
                        var sellerLong = catVO.sellers[z].longitude;
                        var sellerAvatar = catVO.sellers[z].avatar1_path;
                        var sellerTeaser = catVO.sellers[z].presentation;

                        var seller = L.marker([sellerLat, sellerLong], {icon : redIcon}).bindPopup('<p class="lead text-center">' + sellerName +'</p><p>' + sellerTeaser+'</p><p class="text-center lead"><a  href="/sellerFile'+sellerId+'"><img class="d-flex mx-auto" src="/storage/'+sellerAvatar+'" width="120px" height="120px"/>Voir ma fiche</a></p>').addTo(map);

                        sellersVO.push(seller);

                    }

                    VOgroup = L.layerGroup(sellersVO);

                }

                // Laits et Fromages
                var catLF = categorySellers[2];

                sellersLF = [];

                var yellowIcon = L.icon({
                    iconUrl: '/storage/iconMarkers/markerYellow.png',
                    iconSize:     [24, 45], // size of the icon
                    iconAnchor:   [12, 45], // point of the icon which will correspond to marker's location
                    popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAnchor
                });

                // S'il y a des vendeurs de cette catégorie on les affiche
                if(catLF.sellers.length != 0){

                    for(var z = 0; z < catLF.sellers.length; z++){

                        // On défini les données de chaque vendeur                        
                        var sellerId = catLF.sellers[z].id;
                        var sellerName = catLF.sellers[z].business_name;
                        var sellerLat = catLF.sellers[z].latitude;
                        var sellerLong = catLF.sellers[z].longitude;
                        var sellerAvatar = catLF.sellers[z].avatar1_path;
                        var sellerTeaser = catLF.sellers[z].presentation;

                        var seller = L.marker([sellerLat, sellerLong], {icon : yellowIcon}).bindPopup('<p class="lead text-center">' + sellerName +'</p><p>' + sellerTeaser+'</p><p class="text-center lead"><a  href="/sellerFile'+sellerId+'"><img class="d-flex mx-auto" src="/storage/'+sellerAvatar+'" width="120px" height="120px"/>Voir ma fiche</a></p>').addTo(map);

                        sellersLF.push(seller);

                    }

                    LFgroup = L.layerGroup(sellersLF);

                }

                // Boissons et Alcools
                var catBA = categorySellers[3];

                var sellersBA = [];

                var purpleIcon = L.icon({
                    iconUrl: '/storage/iconMarkers/markerPurple.png',
                    iconSize:     [24, 45], // size of the icon
                    iconAnchor:   [12, 45], // point of the icon which will correspond to marker's location
                    popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAnchor
                });

                // S'il y a des vendeurs de cette catégorie on les affiche
                if(catBA.sellers.length != 0){

                    for(var z = 0; z < catBA.sellers.length; z++){

                        // On défini les données de chaque vendeur                        
                        var sellerId = catBA.sellers[z].id;
                        var sellerName = catBA.sellers[z].business_name;
                        var sellerLat = catBA.sellers[z].latitude;
                        var sellerLong = catBA.sellers[z].longitude;
                        var sellerAvatar = catBA.sellers[z].avatar1_path;
                        var sellerTeaser = catBA.sellers[z].presentation;

                        var seller = L.marker([sellerLat, sellerLong], {icon : purpleIcon}).bindPopup('<p class="lead text-center">' + sellerName +'</p><p>' + sellerTeaser+'</p><p class="text-center lead"><a  href="/sellerFile'+sellerId+'"><img class="d-flex mx-auto" src="/storage/'+sellerAvatar+'" width="120px" height="120px"/>Voir ma fiche</a></p>').addTo(map);

                        sellersBA.push(seller);

                    }

                    BAgroup = L.layerGroup(sellersBA);

                }



                overlayMaps = {
                    "Fruits & Légumes": FLgroup,
                    "Viandes & Oeufs" : VOgroup,
                    "Laits & Fromages" : LFgroup,
                    "Boissons & Alcools": BAgroup,
                };

                L.control.layers(null, overlayMaps).addTo(map);


            })
    },

    getRoute: function (targetlat, targetlong, originlat, originlong) {

        L.Routing.control({
            waypoints: [
                L.latLng(49.182863, -0.370679),
                L.latLng(49.276437, -0.70314)
            ]

        }).addTo(map);
    },

    getPositionForm: function () {

        if (navigator.geolocation) {
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

    }

}

// ------------------------------------------------------- //
// ------------------------ DOM SHOW --------------------- //
// ------------------------------------------------------- //
//Ici on anime le DOM. On affiche on masque certains éléments,
// on en crée certains

var animDOM = {

    showMap: function () {

        $(titleblock).hide('slow');
        $(signinlink).hide('slow');
        $(buyingblock).hide('slow');
        $(imgcat).show();
        $(mapBox).show('slow');

        var mapDiv = document.createElement("div");
        mapDiv.id = "map";
        mapBox.appendChild(mapDiv);

        mapComponent.init();

        mapComponent.sellersMarkers();
    },

    hideMap: function () {

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

$('#buybtn1').click(function () {

    $(titleblock).hide('slow');
    $(signinlink).hide('slow');
    $(buyingblock).hide('slow');
    $(imgcat).show();
    $(mapBox).show('slow');
    var mapDiv = document.createElement("div");
    mapDiv.id = "map";
    mapBox.appendChild(mapDiv);

    // mapComponent.init(){
    if (navigator.geolocation) {

        //Loader
        $('#loader').show();

        // L'API est disponible

        // On déclare la variable userWatch afin de pouvoir par la suite annuler le suivi de la position
        userWatch = navigator.geolocation.watchPosition(userPosition);

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
                .bindPopup('Je suis ici' + '\n' + 'Ma latitude est : ' + mylat + '\n' + 'Ma longitude est : ' + mylong + '\n' + 'Ma vitesse est : ' + myspeed);

            // par défault on récupère tout les vendeurs
            mapComponent.sellersMarkersAll();


            $('.leaflet-container').ready(function () {
                $('#loader').hide();
            });

        }

    } else {

        alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
    }

});

$(cancelmap).click(function () {

    // Annule le suivi de la position si nécessaire.
    navigator.geolocation.clearWatch(userWatch);

    $('#labelCatAll').button('toggle');
    $('#map').remove();
    $(mapBox).hide();
    $(imgcat).hide('slow');
    $(titleblock).show('slow');
    $(signinlink).show('slow');
    $(buyingblock).show('slow');

});

$('#icocatFL').click(function () {

    console.log('clic catFL');
    L.layerGroup(sellersLF).remove();
});

/**
 * Récupération des données GPS dans les formulaires
 */
$('#getCoordonates').click(function () {

    // mapComponent.getPositionForm();

    if (navigator.geolocation) {
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
