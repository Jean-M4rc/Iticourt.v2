//---------------------------------------------------//
//                    ITICOURT                       //
//---------------------------------------------------//

// Déclaration des variables globales et des sélecteurs jQuery

var titleBlock = document.getElementById("titleblock"),
    signinlink = document.getElementById("signinlink"),
    buyingblock = document.getElementById("buyingblock"),
    listcat = document.getElementById("listcat"),
    imgcat = document.getElementById("imgcat"),
    btnrouting = document.getElementById('btnrouting'),
    cancelmap = document.getElementById("cancelmap"),
    mapBox = document.getElementById("mapBox"),
    map,
    userWatch,
    sellerId,
    overlayMaps,
    inputsControlsLayers = [];

// ------------------------------------------------------- //
// ------------------------- MAP ------------------------- //
// ------------------------------------------------------- //

var mapComponent = {

    // Création de la map et du marqueur de l'utilisateur
    init: function () {

        if (navigator.geolocation) {

            //Lancement du Loader
            $('#loader').show();

            // L'API est disponible

            // On déclare la variable userWatch afin de pouvoir par la suite annuler le suivi de la position

            userWatch = navigator.geolocation.watchPosition(userPosition);

            function userPosition(position) {

                mylong = position.coords.longitude;
                mylat = position.coords.latitude;
                myspeed = position.coords.speed;

                usercoord = [mylat, mylong];

            

                // Création de la map
                map = L.map('map',{zoomControl:false}).setView(usercoord, 10);

                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    attribution: 'Iticourt &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                    id: 'mapbox.streets',
                    accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
                }).addTo(map);

                // Ajout d'un marqueur sur l'utilisateur

                var blueIcon = L.icon({
                    iconUrl: '/storage/iconMarkers/markerBlue.png',
                    iconSize:     [24, 45],
                    iconAnchor:   [12, 45],
                    popupAnchor:  [0, -40]
                });

                L.marker(usercoord, {icon : blueIcon}).addTo(map).bindPopup('<p class="alert alert-info">Vous</p>').openPopup();

                // Suppression du Loader lorsque les classes "leaflet" sont chargées
                $('.leaflet-container').ready(function () {
                    $('#loader').hide();
                    mapComponent.sellersMarkersAll();
                });
            }


        } else {

            alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
        }
    },
    
    // Cette méthode récupère tout les vendeurs
    sellersMarkersAll: function () {

        var greenIcon = L.icon({iconUrl:'/storage/iconMarkers/markerGreen.png',iconSize:[24, 45],iconAnchor:[12, 45],popupAnchor:[0, -40]});
        var redIcon = L.icon({iconUrl:'/storage/iconMarkers/markerRed.png',iconSize:[24, 45],iconAnchor:[12, 45],popupAnchor:[0, -40]});
        var yellowIcon = L.icon({iconUrl:'/storage/iconMarkers/markerYellow.png',iconSize:[24, 45],iconAnchor:[12, 45],popupAnchor:  [0, -40]});
        var purpleIcon = L.icon({iconUrl:'/storage/iconMarkers/markerPurple.png',iconSize:[24, 45],iconAnchor:[12, 45],popupAnchor:[0, -40]});

        axios({
                method: 'get',
                url: 'https://iticourt.v2.test/sellersMarkersGet'
            })
            .then((response) => {
                
                var categorySellers = response.data;
                
                // Fruits et Légumes
                var catFL = categorySellers[0];
                var FLgroup = L.layerGroup();
                mapComponent.setMarkersSellerGroup(catFL, FLgroup, greenIcon);
                
                // Viandes et Oeufs
                var catVO = categorySellers[1];
                var VOgroup = L.layerGroup();
                mapComponent.setMarkersSellerGroup(catVO, VOgroup, redIcon);

                // Laits et Fromages
                var catLF = categorySellers[2];
                var LFgroup = L.layerGroup();
                mapComponent.setMarkersSellerGroup(catLF, LFgroup, yellowIcon); 

                // Boissons et Alcools
                var catBA = categorySellers[3];
                var BAgroup = L.layerGroup();
                mapComponent.setMarkersSellerGroup(catBA, BAgroup, purpleIcon);

                var overlays = {
                    "Fruits & Légumes": FLgroup,
                    "Viandes & Oeufs" : VOgroup,
                    "Laits & Fromages" : LFgroup,
                    "Boissons & Alcools": BAgroup,
                };

                L.control.layers(null, overlays).addTo(map);
                $('.leaflet-control-layers').addClass('invisible');

                // On parcours les éléments ayant la classe des controleur leaflet 
                $('.leaflet-control-layers-selector').each(function(){
                    inputsControlsLayers.push($(this));
                });

                var inputCatFL = inputsControlsLayers[0];
                var inputCatVO = inputsControlsLayers[1];
                var inputCatLF = inputsControlsLayers[2];
                var inputCatBA = inputsControlsLayers[3];


                $('#labelCatFL').click(function () {  
                    $(inputCatFL).trigger("click");
                });

                $('#labelCatVO').click(function () {  
                    $(inputCatVO).trigger("click");
                });

                $('#labelCatLF').click(function () {  
                    $(inputCatLF).trigger("click");
                });

                $('#labelCatBA').click(function () {  
                    $(inputCatBA).trigger("click");
                });

                
            })
    },

    setMarkersSellerGroup: function(catGroupParam,layerGroupParam, iconType){

        var groupLength = catGroupParam.sellers.length;
    
        if(groupLength !=0){
    
            for(z = 0; z < groupLength; z++){
    
                // On défini les données de chaque vendeur                        
                sellerId = catGroupParam.sellers[z].id;
                var sellerName = catGroupParam.sellers[z].business_name;
                var sellerLat = catGroupParam.sellers[z].latitude;
                var sellerLong = catGroupParam.sellers[z].longitude;
                var sellerAvatar = catGroupParam.sellers[z].avatar1_path;
                var sellerTeaser = catGroupParam.sellers[z].presentation;
    
                L.marker([sellerLat, sellerLong], {icon : iconType}).bindPopup(
                    '<p class="lead text-center"><a  href="/sellerFile'+sellerId+'">' + sellerName +'</p><p class="text-center"><img class="d-flex mx-auto" src="/storage/'+sellerAvatar+'" width="120px" height="120px"/></a><br/></p>'
                ).addTo(layerGroupParam).openPopup();                
            };
            layerGroupParam.addTo(map);
        }
    },

    // Récupération des coordonnées GPS pour le formulaire d'inscription
    getPositionForm: function () {

        if (navigator.geolocation) {

            navigator.geolocation.getCurrentPosition(maPosition);

            function maPosition(position) {

                $('#longInput').val(position.coords.longitude);
                $('#latInput').val(position.coords.latitude);
            }
        } else {
            
            alert('Une erreur est survenue, veuillez réessayer. Avez-vous accepté la géolocalisation ?');
        }
    },

    // Mise en place de l'itinéraire vers un vendeur
    getRoute: function (targetlat, targetlong, originlat, originlong) {

        L.Routing.control({
            waypoints: [
                L.latLng(49.182863, -0.370679),
                L.latLng(49.276437, -0.70314)
            ]

        }).addTo(map);
    },    
};

// ------------------------------------------------------- //
// ------------------------ DOM SHOW --------------------- //
// ------------------------------------------------------- //

var animDOM = {

    // Affichage de la map et animation du DOM correspondante
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
    },

    // Retrait de la map et animation du DOM correspondant
    hideMap: function () {

        // Annule le suivi de la position si nécessaire.
        navigator.geolocation.clearWatch(userWatch);

        inputsControlsLayers= [];
        L.control.layers().remove();

        $('.btncat>.btn').addClass('active');
        $('#map').remove();
        $(mapBox).hide();
        $(imgcat).hide('slow');
        $(titleblock).show('slow');
        $(signinlink).show('slow');
        $(buyingblock).show('slow');
    }
};

// ------------------------------------------------------- //
// ----------------------- EVENTS ------------------------ //
// ------------------------------------------------------- //

$('#buybtn1').click(function () {
    animDOM.showMap();
});

$(cancelmap).click(function () {
    mapComponent.hideMap();
});

$('#getCoordonates').click(function () {
    mapComponent.getPositionForm();
});



//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
/////////////////////// ZONE DE RECYCLAGE ////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////


// Layer pas utiliser 

/* 
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}{r}.png', {
    attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
*/


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
    }
*/

    // Création du calque images
/*
    L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
    maxZoom: 20,
    attribution: '&copy; Openstreetmap France | &copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
*/

/////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////
/////////////// ANCIENNE METHODE ////////////////////////
/////////////////////////////////////////////////////////

/*
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
            var blueIcon = L.icon({
                iconUrl: '/storage/iconMarkers/markerBlue.png',
                iconSize:     [24, 45], // size of the icon
                iconAnchor:   [12, 45], // point of the icon which will correspond to marker's location
                popupAnchor:  [0, -40] // point from which the popup should open relative to the iconAnchor
            });
            L.marker([mylat, mylong], {icon : blueIcon}).addTo(map).bindPopup('Ma latitude est : ' + mylat + '<br/>' + 'Ma longitude est : ' + mylong + '<br/>' + 'Ma vitesse est : ' + myspeed);

            // par défault on récupère tout les vendeurs
            mapComponent.sellersMarkersAll();


            $('.leaflet-container').ready(function () {
                $('#loader').hide();
            });

        }

    } else {

        alert('L\'application n\'est pas disponible sans l\'utilisation de votre géolocalisation');
    }
*/


//////////////////////////////////////
//////////////////////////////////////
///// METHODE POUR LE FORMULAIRE D'INSCRIPTION

/*
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
*/