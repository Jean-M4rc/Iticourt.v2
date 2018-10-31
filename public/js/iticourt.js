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
    mapBoxRouting = document.getElementById("mapBoxRouting"),
    sellerFile = document.getElementById("sellerFile"),
    map,
    userLat,
    userLong,
    target,
    userWatch,
    usercoord,
    sellerId,
    overlayMaps,
    inputsControlsLayers = [],
    cantclick = true;

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
            navigator.geolocation.getCurrentPosition(userPosition);

            // Améliorer cette partie avec une requete de position juste à la création et pas de suivi de déplacement.
            function userPosition(position) {

                mylong = position.coords.longitude;
                mylat = position.coords.latitude;

                usercoord = [mylat, mylong];


                // Création de la map
                map = L.map('map').setView(usercoord, 8);

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

    // Création de la map de lapage Vendeur et itinéraire jusqu'à lui
    initSellerMap: function () {

        if (navigator.geolocation) {

            //Lancement du Loader
            $('#loader2').show();

            // On déclare la variable userWatch afin de pouvoir par la suite annuler le suivi de la position
            userWatch = navigator.geolocation.watchPosition(userPosition);

            function userPosition(position) {

                mylong = position.coords.longitude;
                mylat = position.coords.latitude;
                myspeed = position.coords.speed;


                // Création de la map
                map = L.map('map2').setView([mylat,mylong], 8);
            
                L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                    attribution: 'Iticourt &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors',
                    maxZoom: 18,
                    id: 'mapbox.streets',
                    accessToken: 'pk.eyJ1IjoiajM0bm00cmMiLCJhIjoiY2puMGRsdDQyMmNoZjNxcXlobHRqdXljbiJ9.BvgT9e8mfV3snzZkgvYivg'
                }).addTo(map);

                var blueIcon = L.icon({
                    iconUrl: '/storage/iconMarkers/markerBlue.png',
                    iconSize:     [24, 45],
                    iconAnchor:   [12, 45],
                    popupAnchor:  [0, -40]
                });

                L.marker([mylat,mylong]).bindPopup('<p class="alert alert-info">Vous</p>').addTo(map);
                    
                target = $('#mapBoxRouting').attr('data');   

                L.control.custom({
                    position: 'topright',
                    content : '<button type="button" class="btn btn-danger">'+
                            '    <i class="fa fa-times"></i>'+
                            '</button>',
                    classes : 'btn-group-vertical btn-group-sm',
                    style   :
                    {
                        margin: '10px',
                        padding: '0px 0 0 0',
                        cursor: 'pointer',
                    },
                    datas   : {},
                    events  :
                    {
                        click: function(data)
                        {
                            animDOM.hideMapSeller();
                        },
                    }
                }).addTo(map);


                
                targetsplit = target.split(',');
                targetlat = targetsplit[0];
                targetlong = targetsplit[1];
               
                //mapComponent.getRoute(mylat,mylong,targetlat,targetlong);

                $.getJSON( "https://router.project-osrm.org/route/v1/driving/"+mylat+","+mylong+";"+targetlat+","+targetlong+"?overview=false&alternatives=true&steps=true&hints=;").done(function() {
                    mapComponent.getRoute(mylat,mylong,targetlat,targetlong);
                    })
                    .fail(function() {
                        //alert('Une erreur s\'est produite, veuillez attendre quelques minutes avant de relancer la carte');
                        console.log('erreur');
                        $('#modalError').modal('toggle');
                    });
                    
            
                // Suppression du Loader lorsque les classes "leaflet" sont chargées
                $('g').ready(function () {
                    $('#loader2').hide();                         
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

                L.control.custom({
                    position:   'topright',
                    content :   '<button type="button" id="close" class="btn" style="background:transparent">'+
                                    '<img class="imagecat" src="/storage/svg/cancel.svg" style="background-color:white" alt="cancel"/>'+
                                '</button>'+
                                '<button type="button" id="labelCatFL" class="btn mx-0" data-toggle="button" style="background:transparent">'+
                                    '<img class="imagecat" src="/storage/svg/carrot-and-apple.svg" alt="carrot"/>'+
                                '</button>'+
                                '<button type="button" id="labelCatVO" class="btn mx-0" data-toggle="button" style="background:transparent">'+
                                    '<img class="imagecat" src="/storage/svg/animals.svg" alt="animals"/>'+
                                '</button>'+
                                '<button type="button" id="labelCatLF" class="btn btncat mx-0" data-toggle="button" style="background:transparent">'+
                                    '<img class="imagecat" src="/storage/svg/milk.svg" alt="milk"/>'+
                                '</button>'+                                
                                '<button type="button" id="labelCatBA" class="btn" data-toggle="button" style="background:transparent">'+
                                    '<img class="imagecat" src="/storage/svg/wine.svg" alt="wine"/>'+
                                '</button>',
                    classes :   'btn-group-vertical btn-group-sm btn-group btn-group-toggle',
                    style   :
                    {
                        marginRight: '0px',
                        marginTop:'-40px',
                        padding: '0 0 0 0',
                        cursor: 'pointer',
                        wrap: 'no-wrap',
                        zIndex : '0',
                    },
                    datas   : 
                    {
                        'foo': 'bar',
                    },
                    events  :
                    {
                        click: function(data)
                        {
                            if(data.target.id == 'close'){
                                animDOM.hideMap();
                            }
                        },
                    }
                }).addTo(map);

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
    
                L.marker([sellerLat, sellerLong], {icon : iconType}).bindPopup(
                    '<p class="text-center font-weight-bold">' + sellerName +'</p><img class="d-flex mx-auto" src="/storage/'+sellerAvatar+'" width="150px"/><p class="text-center"><a href="/sellerFile'+sellerId+'"><button class="btn btn-primary p-1">Rejoindre ce vendeur</button></a></p>'
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
    getRoute: function (userLat, userLong, targetlat, targetlong) {
        
        routing = L.Routing.control({
            waypoints: [
                L.latLng([userLat,userLong]),
                L.latLng([targetlat,targetlong])
            ],
            alternatives:false,
            itinerary : false,

        }).addTo(map);
        $('.leaflet-routing-container').hide();
    },    
};

// ------------------------------------------------------- //
// ------------------------ DOM SHOW --------------------- //
// ------------------------------------------------------- //

var animDOM = {

    // Affichage de la map et animation du DOM correspondante
    showMap: function () {

        $('#navbar').hide('slow');
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

        inputsControlsLayers= [];
        L.control.layers().remove();

        $('.btncat>.btn').addClass('active');
        $('#map').remove();
        $(mapBox).hide();
        $('#navbar').show('slow');
        $(titleblock).show('slow');
        $(signinlink).show('slow');
        $(buyingblock).show('slow');

        setTimeout(function(){ cantclick = true },2000);
        cantclick = false;
           
    },

    showMapSeller: function(){
        
        $(sellerFile).hide('slow');
        $('#navbar').hide('slow');
        $(mapBoxRouting).show('slow');
        
        var mapDiv = document.createElement("div");
        mapDiv.id = "map2";
        mapBoxRouting.appendChild(mapDiv);

        mapComponent.initSellerMap();
    },

    hideMapSeller: function(){

        // Annule le suivi de la position si nécessaire.
        navigator.geolocation.clearWatch(userWatch);
        
        $('#map2').remove();
        $(sellerFile).show('slow');
        $('#navbar').show('slow');
        $(mapBoxRouting).hide('slow');

        setTimeout(function(){ cantclick = true },2000);
        cantclick = false;
        
    }
};

// ------------------------------------------------------- //
// ----------------------- EVENTS ------------------------ //
// ------------------------------------------------------- //

$('#buybtn1').click(function (e) {
    if(!cantclick){
        e.preventDefault();
    } else {
        animDOM.showMap();
    }
});

$(cancelmap).click(function () {
    animDOM.hideMap();
});

$('#getCoordonates').click(function () {
    mapComponent.getPositionForm();
});

$(btnrouting).click(function(e) {
    if(!cantclick){
        e.preventDefault();
    } else {
        animDOM.showMapSeller();
    }
});

$('#closeModalError').click(function(){
    animDOM.hideMapSeller();
});


