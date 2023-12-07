


var mymap;
var lyrEsriImagery,lyrTopo,lyrESri,lyrOSM,lyrsearch;
var mrkCurrentLocation;
var ctlAttribute,ctlScale,ctlPan,ctlMouseposition,ctlMeasure,ctlEasybutton,ctlSidebar,ctlSearch,cltLayers,browserControl,map;
var objBasemaps,objOverlays,landscape_image;
var ctlDraw, drawnItems,styleEditor,lyrDouar,lyrClusters, lyrzoneCoeurs;
var googleStreets,googleHybrid,googleSatellite,googleTerrain;
var histChart;
var jsnActivites;

var imagesBaseUrl = "http://localhost/geoportail-pnsm/forms"

var selectedLayer = null;


// relevant columns 
var zoneAdhesionCols = ["name", "superf", ,"zonebiogeo"]; 

var zoneCoeurCols = ["nom", "superficie(ha)", "zone_biogeographique", "commune"];

var douarCols = ["nom", "population", "menages","nombrehommes", "nombrefemmes","nombreenfants","totalscolarises"]



// initialisation des variables pour les données geojson
var jsnDouar, jsnzcoeurs, jsnzAdhesion,jsnSites, jsnZonesEspeces;

var home = {
	lat: 30.13285,
	lng: -9.61349,
	zoom: 11
}; 



//****************** layers style */
// var zonecoeursStyle = {
//     "color": "red",
//     "weight": 5,
//     "opacity": 0.65
// }

//#############style for zoneadhesion#######################
// var styleAdhesion = {
//     "color":"#006600",
//     "weight":4,
//     "opacity":0.75
// }

var sitesStyle = {
    "color":"lime",
    "weight":4,
    "opacity":0.4,
    "zIndexOffset":200
}


//*********map initialisation*****************

$(document).ready(function(){
 
    mymap = L.map('mapdiv', {center:[30.13285,-9.61349], zoom:11, attributionControl:false});
    // function onMapClick(e){
    //     console.log(e.target)
    // }

   // mymap.on("click",onMapClick)
    mymap.zoomControl.setPosition('topright');



    //**********Start:Base maps layers ***************
    googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
    });

    lyrOSM = L.tileLayer.provider('OpenStreetMap.Mapnik');
    mymap.addLayer(lyrOSM);
    lyrEsriImagery = L.tileLayer.provider('Esri.WorldImagery');
   
    lyrTopo = L.tileLayer.provider('OpenTopoMap');
    
    googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    googleSatellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });

    googleTerrain = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    });


    //**********End:Base maps layers ***************


   

    //**********Start:WMS Layers  ***************

var ZoneC = L.tileLayer.wms("http://localhost:8080/geoserver/PNSM_geoportal/wms", {
    layers: 'PNSM_geoportal:zcoeur',
    format: 'image/png',
    transparent: true,
    attribution: "@geoserver"
})

var ZoneA = L.tileLayer.wms("http://localhost:8080/geoserver/PNSM_geoportal/wms", {
    layers: 'PNSM_geoportal:zadhesions',
    format: 'image/png',
    transparent:true,
    attribution:"@geoserver"
})
var siteInvest = L.tileLayer.wms("http://localhost:8080/geoserver/PNSM_geoportal/wms", {
    layers: 'PNSM_geoportal:sites_invest_tour',
    format: 'image/png',
    transparent:true,
    attribution: "@geoserver"
})
var province  = L.tileLayer.wms("http://localhost:8080/geoserver/PNSM_geoportal/wms", {
    layers: 'PNSM_geoportal:provinces',
    format: 'image/png',
    transparent:true,
    attribution: "@geoserver"
})
var secteurFor = L.tileLayer.wms("http://localhost:8080/geoserver/PNSM_geoportal/wms", {
    layers: 'PNSM_geoportal:Secteur_forest',
    format: 'image/png',
    transparent:true,
    attribution: "@geoserver"
})


var LimtePNSM = L.tileLayer.wms("http://localhost:8080/geoserver/PNSM_geoportal/wms", {
    layers: 'PNSM_geoportal:parcLimites',
    format: 'image/png',
    transparent:true,
    attribution: "@geoserver"
})
//**********End:WMS Layers  ***************


//**************control panel**********************/
ctlPan = L.control.pan().addTo(mymap);

 //***********Home button*********************** */
 L.easyButton('<i class="fa fa-home fa-lg" title="Zoom to home"></i>',function(btn,map){
    map.setView([home.lat, home.lng], home.zoom);
      //Responsive map...
      $(window).on("resize", function () { $("#map").height($(window).height()-50); map.invalidateSize(); }).trigger("resize");
  },'Zoom To Home').addTo(mymap);



ctlMeasure = L.control.polylineMeasure().addTo(mymap);
ctlSidebar = L.control.sidebar('side-bar').addTo(mymap);



ctlEasybutton = L.easyButton('glyphicon-transfer', function(){
    ctlSidebar.toggle(); 
}).addTo(mymap);




// /////////////HANDLING MODAL///////////////

// var customControl = L.Control.extend({
//     options: {
//         position: 'bottomleft'
//     },

//     onAdd: function () {
//         var container = L.DomUtil.create('div', 'leaflet-bar leaflet-control');

//         // Create your button and add it to the container
//         var button = L.DomUtil.create('button', 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded', container);
//         button.innerHTML = 'Edit';
//         button.id = 'modalButton';

//         // Add a click event listener to your button
//         L.DomEvent.on(button, 'click', function () {
//             // Open the modal when the button is clicked
//             document.querySelector('.modal').style.display = 'block';
//         });

//         return container;
//     }
// });

// // Add the custom control to the map
// mymap.addControl(new customControl());

//////////////MODAL HANDLING  /////////////
    

//==============########### START:FETCHING SPATIAL DATA FROM THE DATABASE TO THE MAP######## ==========/



//#############pnsmlimites #######################
// $.ajax({
//     url:'pnsmlimites.php',
//     success:function(response){
//         jsnlimite=JSON.parse(response);
//         lyrlimite= L.geoJSON(jsnlimite).addTo(mymap);

     
//        cltLayers.addOverlay(lyrlimite,"PNSM Limite");
//     },
//     error:function(xhr,status,error){
//         alert("ERROR:"+ error);
//     }
// });

//############Zone adhesion####################


var styleAdhesion = {
    "color": "#006600",
    "weight": 4,
    "opacity": 0.75,
    "zIndexOffset":100

};

var clickedLayerAdhesion = null; // To keep track of the selected layer

$.ajax({
    url: 'zoneAdhesion.php',
    success: function (response) {
        jsnzAdhesion = JSON.parse(response);
        lyrzAdhesion = L.geoJSON(jsnzAdhesion, {
            style: styleAdhesion,
            onEachFeature: function (feature, layer) {
                if (feature.properties) {
                    layer
                        .bindPopup(buildFearuePopup(feature.properties, 'zoneadhesion', zoneAdhesionCols));
                }
            }
        }).addTo(mymap);

        cltLayers.addOverlay(lyrzAdhesion, "Zone d'Adhesion");

        // lyrzAdhesion.on('click', function (event) {

        //    // change the opacity of the previously clicked layer back to 0.75
        
        //     event.layer.setStyle({
        //         opacity: 0.70,
        //         fillOpacity: 0.70
                
        //     });

        // });
        lyrzAdhesion.on('click', function(e) {
            if (selectedLayer === e.layer) {
                // If the clicked layer is already selected, revert its style to the previous style
                if (e.layer.previousStyle) {
                    e.layer.setStyle(e.layer.previousStyle);
                }
                selectedLayer = null; // Reset the selected layer
            } else {
                // Revert the style of the previously selected layer if exists
                if (selectedLayer && selectedLayer.previousStyle) {
                    selectedLayer.setStyle(selectedLayer.previousStyle);
                }

                // Store the current style before setting a new one for the clicked layer
                var currentStyle = {
                    opacity: e.layer.options.opacity,
                    fillOpacity: e.layer.options.fillOpacity
                };

                // Set the style of the clicked layer
                e.layer.setStyle({
                    opacity: 0.7, // Adjust this value as needed
                    fillOpacity: 0.7 // Adjust this value as needed
                });
                selectedLayer = e.layer; // Update the selected layer
                e.layer.previousStyle = currentStyle; // Store the previous style
            }
        });
    },
    error: function (xhr, status, error) {
        alert("ERROR: " + error);
    }
});


// ############Zone du coeur####################

var zonecoeursStyle = {
    color: "red",
    weight: 5,
    opacity: 0.65,
    zIndexOffset: 100

};

// var selectedLayer = null;  // To keep track of the selected layer

$.ajax({
    url: 'zonecoeurs.php',
    success: function(response) {
        jsnzcoeurs = JSON.parse(response);
        lyrzoneCoeurs = L.geoJSON(jsnzcoeurs, { 
            style: zonecoeursStyle,
            onEachFeature: function(feature, layer) {
                if (feature.properties) {
                    layer.bindPopup(buildFearuePopup(feature.properties, 'zonecoeur', zoneCoeurCols));
                }          
            }
        }).addTo(mymap);

        cltLayers.addOverlay(lyrzoneCoeurs, "Zone du Coeurs");

        lyrzoneCoeurs.on('click', function(e) {
            if (selectedLayer === e.layer) {
                // If the clicked layer is already selected, revert its style to the previous style
                if (e.layer.previousStyle) {
                    e.layer.setStyle(e.layer.previousStyle);
                }
                selectedLayer = null; // Reset the selected layer
            } else {
                // Revert the style of the previously selected layer if exists
                if (selectedLayer && selectedLayer.previousStyle) {
                    selectedLayer.setStyle(selectedLayer.previousStyle);
                }

                // Store the current style before setting a new one for the clicked layer
                var currentStyle = {
                    opacity: e.layer.options.opacity,
                    fillOpacity: e.layer.options.fillOpacity
                };

                // Set the style of the clicked layer
                e.layer.setStyle({
                    opacity: 0.7, // Adjust this value as needed
                    fillOpacity: 0.7 // Adjust this value as needed
                });
                selectedLayer = e.layer; // Update the selected layer
                e.layer.previousStyle = currentStyle; // Store the previous style
            }
        });


    },
    error: function(xhr, status, error) {
        alert("ERROR: " + error);
    }
});








//===============sites invest ===========================/
$.ajax({
    url:'sites.php',
    success:function(response){
        jsnSites=JSON.parse(response);
        sitesInvest= L.geoJSON(jsnSites,{
            style: sitesStyle,
            onEachFeature: function(layer,feature){
                
                if(feature.properties){
                    layer
                    .bindPopup(buildFearuePopup(feature.properties, 'sitesInvest'))

                }
            }
        }).addTo(mymap);
       cltLayers.addOverlay(sitesInvest,"Sites Investissement Touristiques");
    },
    error:function(xhr,status,error){
        alert("ERROR:"+ error);
    }
});



// //=============== Douar Parc ======================/
// $.ajax({
//     url:'douar2.php',
//     success:function(response){
//         jsnDouar=JSON.parse(response);
//         lyrTest= L.geoJSON(jsnDouar,{pointToLayer:returnDouarmakr
        
//         }).addTo(mymap);

//        cltLayers.addOverlay(lyrTest,"Douars du Parc");

//        var clickedLayer = null;


//        // Adding a click event to the layer
//        lyrTest.on('click', function(e){

//         //     // change the opacity of the previously clicked layer back to 0.75
//         //     e.layer.setStyle({
//         //     opacity: 0.70,
//         //     fillOpacity: 0.70
        
//         // });
   
//     if (selectedLayer === e.layer) {
//         // If the clicked layer is already selected, revert its style to the previous style
//         if (e.layer.previousStyle) {
//             e.layer.setStyle(e.layer.previousStyle);
//         }
//         selectedLayer = null; // Reset the selected layer
//     } else {
//         // Revert the style of the previously selected layer if exists
//         if (selectedLayer && selectedLayer.previousStyle) {
//             selectedLayer.setStyle(selectedLayer.previousStyle);
//         }

//         // Store the current style before setting a new one for the clicked layer
//         var currentStyle = {
//             opacity: e.layer.options.opacity,
//             fillOpacity: e.layer.options.fillOpacity
//         };
//         selectedLayer = null;

//         // Set the style of the clicked layer
//         e.layer.setStyle({
//             opacity: 0.9, // Adjust this value as needed
//             fillOpacity: 0.9 // Adjust this value as needed
//         });
//         selectedLayer = e.layer; // Update the selected layer
        
//         e.layer.previousStyle = currentStyle; // Store the previous style
        
//     }
// });

//     },
    
//     error:function(xhr,status,error){
//         alert("ERROR:"+ error);
//     }
// });


//===============clusters================================/
// $.ajax({
//     url:'clusters.php',
//     success:function(response){
//         jsnClusters=JSON.parse(response);
//         clusters= L.geoJSON(jsnClusters,{pointToLayer:returnClustermakr,

//         }).addTo(mymap);
//        cltLayers.addOverlay(clusters,"Clusters");

//         // Adding a click event to the layer
//         clusters.on('click', function(e){
//              // change the opacity of the previously clicked layer back to 0.75
//              e.layer.setStyle({
//                 opacity: 0.70,
//                 fillOpacity: 0.70
            
//             });
//         });

//     },

//     error:function(xhr,status,error){
//         alert("ERROR:"+ error);
//     }
// });

//===============Zones especes ======================/
$.ajax({
    url:'zonesEspeces.php',
    success:function(response){

        jsnZonesEspeces=JSON.parse(response);

    },
    error:function(xhr,status,error){
        alert("ERROR:"+ error);
    }
});

//===============Activites=============================/

$.ajax({
    url: 'activites.php',
    success: function(response) {
        jsnActivites = JSON.parse(response);
    },
    error: function(xhr, status, error) {
        alert("ERROR: " + error);
    }
});


//END:FETCHING DATA FROM THE DATABASE TO THE MAP 

    //**************Browser print  ************** */
    browserControl = L.control.browserPrint({position: 'topleft'}).addTo(mymap);


    //************edit drawing tools************

    drawnItems= new L.FeatureGroup();
    drawnItems.addTo(mymap);

    ctlDraw = new L.Control.Draw({
        draw:{
            circle:true,
        },
        edit:{
            featureGroup:drawnItems
        }
    }).addTo(mymap);
    
    mymap.on('draw:created',function(e){
       
        drawnItems.addLayer(e.layer);
        let polygonData = e.layer.toGeoJSON();


        

    });

    //############## START HANDLING EDITING DATA INSERTION################;

         // Send the polygon data to the server using AJAX
    // $.ajax({
    //     url: 'editInsertion.php',
    //     type: 'POST',
    //     data: {polygon: JSON.stringify(polygonData)},
    //     success: function(response) {
    //         console.log('Polygon saved successfully!');
    //     },
    //     error: function(xhr, status, error) {
    //         console.error('Error saving polygon:', error);
    //     }
    // });

   



//##############END HANDLING EDITING DATA INSERTION################





//=============== Douar Parc ======================/
$.ajax({
    url:'douar2.php',
    success:function(response){
        jsnDouar=JSON.parse(response);
        lyrTest= L.geoJSON(jsnDouar,{pointToLayer:returnDouarmakr
        
        }).addTo(mymap);

       cltLayers.addOverlay(lyrTest,"Douars du Parc");

       var clickedLayer = null;


       // Adding a click event to the layer
       lyrTest.on('click', function(e){

        //     // change the opacity of the previously clicked layer back to 0.75
        //     e.layer.setStyle({
        //     opacity: 0.70,
        //     fillOpacity: 0.70
        
        // });
   
    if (selectedLayer === e.layer) {
        // If the clicked layer is already selected, revert its style to the previous style
        if (e.layer.previousStyle) {
            e.layer.setStyle(e.layer.previousStyle);
        }
        selectedLayer = null; // Reset the selected layer
    } else {
        // Revert the style of the previously selected layer if exists
        if (selectedLayer && selectedLayer.previousStyle) {
            selectedLayer.setStyle(selectedLayer.previousStyle);
        }

        // Store the current style before setting a new one for the clicked layer
        var currentStyle = {
            opacity: e.layer.options.opacity,
            fillOpacity: e.layer.options.fillOpacity
        };
        selectedLayer = null;

        // Set the style of the clicked layer
        e.layer.setStyle({
            opacity: 0.9, // Adjust this value as needed
            fillOpacity: 0.9 // Adjust this value as needed
        });
        selectedLayer = e.layer; // Update the selected layer
        
        e.layer.previousStyle = currentStyle; // Store the previous style
        
    }
});

    },
    
    error:function(xhr,status,error){
        alert("ERROR:"+ error);
    }
});


///############## START HANDLING THE MODAL FORM########################



///############## END HANDLING THE MODAL FORM########################

    //styling tool
    styleEditor = L.control.styleEditor({position:'topright'}).addTo(mymap);

    //**********Layer controls*************** */
    //basemaps

    objBasemaps = {
        "Google Street Map":googleStreets,
        "Google Hybrid Map":googleHybrid,
        "Google Satellite Map":googleSatellite,
        "Google Terrain Map":googleTerrain,
        "Open Street Maps":lyrOSM,
        "Esri World Imagery":lyrEsriImagery,
        "Open Topo Map":lyrTopo
    };
    //overlays 
    objOverlays={
        "Province":province,
        "Secteur Forestiere":secteurFor,
        "Zone Adhesion du Parc":ZoneA,
        "Zone Coeur du Parc":ZoneC,
        "Limite du PNSM":LimtePNSM,
        "Drawn Items":drawnItems,
        "Sites Investissement Touristiques":siteInvest,
    };


    // Create the control layers with the custom icon
    cltLayers = L.control.layers(objBasemaps, objOverlays,{collapsed:true}).addTo(mymap);
    

    //***********Geosearching button ******************** */

    ctlSearch = L.Control.openCageSearch({key: '27beae5a6d64406c8fa78ad7d2a10442',limit: 10}).addTo(mymap);//3c38d15e76c02545181b07d3f8cfccf0
    
    /***********Attribution controls ******************** */
    ctlAttribute = L.control.attribution({position:'bottomleft'}).addTo(mymap);
    ctlAttribute.addAttribution('OSM');
    //ctlAttribute.addAttribution('&copy; <a href="http://millermountain.com">Miller Mountain LLC</a>');
    
     //*******Scale bar******* */
    ctlScale = L.control.scale({position:'bottomleft', metric:false, maxWidth:200}).addTo(mymap);
    
    //*******Mouse Position******* */
    ctlMouseposition= L.control.mousePosition({position: 'bottomright',maxWidth:350,size: 'large'}).addTo(mymap);
    

    mymap.on('keypress', function(e) {
        if (e.originalEvent.key=="l") {
            mymap.locate();
        }
    });
    
    mymap.on('locationfound', function(e) {
        console.log(e);
        if (mrkCurrentLocation) {
            mrkCurrentLocation.remove();
        }
        mrkCurrentLocation = L.circle(e.latlng, {radius:e.accuracy/2}).addTo(mymap);
        mymap.setView(e.latlng, 14);
    });
    
    mymap.on('locationerror', function(e) {
        console.log(e);
        alert("Location was not found");
    })
    
   
    $("#btnLocate").click(function(){
        mymap.locate();
    });
    
    
    
});

function LatLngToArrayString(ll) {
    console.log(ll);
    return "["+ll.lat.toFixed(5)+", "+ll.lng.toFixed(5)+"]";
}

//********functions for transforming points fetched frm the database layers ************ */

 function returnDouarmakr(json,latlng){
    var att =json.properties;
    return L.circleMarker(latlng,{radius:10,color:'black',fillColor:'green',fillOpacity:0.7, zIndexOffset:200,zIndex:2000,
})   
    .bindPopup(buildFearuePopup(att, 'douar', douarCols))

   
   
 }

//  //#############func for styling clusters##########################
//  function returnClustermakr(json,latlng){
//     var att =json.properties;
//     customCircleMarker = L.CircleMarker.extend({
//         options: { 
//            id: att.id,
//            name: "cluster"
//         }
//      });
//     return new customCircleMarker(latlng,{radius:10,color:'green',fillColor:'blue',fillOpacity:0.5,dashArray:'5,5',
//     id:att.id,name:"cluster"})    
//     .bindPopup(buildFearuePopup(att, 'cluster'))

//  }
 //#############func for styling zonecoeur ##########################
 function returnZonePolygon (json,latlng){
    var att =json.properties;
    customCircleMarker = L.CircleMarker.extend({
        options: { 
           id: att.id,
           name: "cluster"
        }
     });
    return new customCircleMarker(latlng,{radius:10,color:'green',fillColor:'blue',fillOpacity:0.5,dashArray:'5,5',
    id:att.id,name:"cluster"}).bindTooltip("<h5>Id:"+att.id + "</h5> Nom: "+ att.nom);
 }



 function returnPointById(id){
    var arLayers = lyrDouar.getLayers();
    for(i=0;i<arLayers.length-1;i++){
        var featureID = arLayers[i].feature.properties.Project;
        console.log(featureID);
        if(featureID==id){
            return arLayers[i];
        }
    }
    return false;

 }
 $("#btnFindProject").click(function(){
    var id =$("#textFindProject").val();
    var lyr = returnPointById(id);
    if(lyr){
        if(lyrsearch){
            lyrsearch.remove();
        }
        lyrsearch = L.geoJSON(lyr.toGeoJSON(),{style:{color:'red',weight:10,
    opacity:0.7}}).addTo(mymap);
    mymap.fitBounds(lyr.getBounds().pad(1));
    var att=lyr.feature.properties;
    $("#divProjectData").html("<h4> class='text-center'>Attributes</h4> <h5> Type:"+att.type+"</h5>");

    }else{
        $("#divProjectError").html("****Project Id not found******");
    }

    // Details Panel 
    
 });

 //#########################function to handle db table for douar###############

 function loadItemDetails(attrs){
    // append body
   return true
    //$("#item-details-dialog .body").html(body)
   // $("#item-details-dialog").toggleClass("hidden");

 }
    
//####################function to handle the map #############################/




 function showZoneCoeurDetailsOnSideBar(attrs){

    let properties = attrs;

    let especesAnimals = jsnZonesEspeces.filter(line => line.zone_type == "zone_coeur" && line.zone_name == properties.nom && line.espece_type == "espece_animale");
    let especesVegetals = jsnZonesEspeces.filter(line => line.zone_type == "zone_coeur" && line.zone_name == properties.nom && line.espece_type == "espece_vegetale");

    let sidbarHtml = buildZoneSidebarHtml("Zone coeur", properties.nom, properties, zoneCoeurCols, especesAnimals, especesVegetals);
    // set the sidebar content
    $("#side-bar-content").html(sidbarHtml);

 }





 function showZoneAdesionDetailsOnSideBar(attrs){ 

    let properties = attrs;

    let especesAnimals = jsnZonesEspeces.filter(line => line.zone_type == "zone_adhesion" && line.zone_name == properties.name && line.espece_type == "espece_animale");
    let especesVegetals = jsnZonesEspeces.filter(line => line.zone_type == "zone_adhesion" && line.zone_name == properties.name && line.espece_type == "espece_vegetale");

    let sidbarHtml = buildZoneSidebarHtml("Zone adhesion", properties.name, properties, zoneAdhesionCols, especesAnimals, especesVegetals);
    // set the sidebar content
    $("#side-bar-content").html(sidbarHtml);

 }



 function showDouarDetailsOnSideBar(attrs){
   
    let sidbarHtml = buildDouarSidebarHtml(attrs, douarCols)
    $("#side-bar-content").html(sidbarHtml);

    let douarActiviteDoughnutEl = document.getElementById("douar_activite_doughnut")
    
    let activitiesSet = [...new Set(jsnActivites.map(act =>  act.activite_type))] 

    // nombre d'activités par douar
    let data = {
        labels: activitiesSet,
        values: activitiesSet.map(act_type => jsnActivites.filter( act => act.activite_type == act_type && act.douar == attrs.nom).length)
    }
    var chart = doughnutChart(douarActiviteDoughnutEl, data,  "Niveau d'activité")



    // nombre rendement des activites par douar
    let douarRendementActiviteDoughnutEl = document.getElementById("douar_rendement_activite_bar")

    var dataRendement = {
        labels: activitiesSet, //["agr", "eleva"]
        values: activitiesSet.map( 
            act_type =>  
            jsnActivites // [{rendement: 1O, nom:..., act_type: agr}, ...]
            .filter( act => act.activite_type == act_type && act.douar == attrs.nom)
            .map(a => a.rendement ?? 0)
            .reduce((a,b) => a+b)
    
        )
    }

    var axisTitles = {
        x: '',
        y: 'Rendement Monetaire (dhs)' 
    }
    var chartRendement = barChart(douarRendementActiviteDoughnutEl, dataRendement,  "Rendement des activités", axisTitles)

    

 }

 

 function showSiteDetailsOnSideBar(attrs){
 
    showFeatureBarChart("Sites Invest Bar chart", jsnSites.features, {labelCol:"nom", valueCol:"supericie"});

 }

 function showClusterDetailsOnSideBar(attrs){
 
    showFeatureBarChart("Clusters Bar chart", jsnClusters.features, {labelCol:"id", valueCol:"nom"});

 }

 



 //#################### Generic function to show charts #############################/



 function showFeatureBarChart(title, featureList, chartDefaultColumns) {

    

    let chartCanvas = document.getElementById("sidebar_chart")

    const columns = getColumnsFromObject(featureList[0].properties)
    
    showSelectedColumnsBarChart(chartCanvas, featureList, chartDefaultColumns)

    // clear the select element
    $("#sidebar_chart_select_label_column").html("")
    $("#sidebar_chart_select_value_column").html("")


    // add columns to the select element
    for (var i = 0; i < columns.length; i++) {
        $("#sidebar_chart_select_label_column").append("<option value='"+columns[i]+"'>"+columns[i]+"</option>")
    }

    // filter out the columns that are not numeric
    var numericColumns = columns.filter(function(item){
        return isNumeric(featureList[0].properties[item])
    })

    for (var i = 0; i < numericColumns.length; i++) {
        $("#sidebar_chart_select_value_column").append("<option value='"+numericColumns[i]+"'>"+numericColumns[i]+"</option>")
    }


    // set the default values
    $("#sidebar_chart_select_label_column").val(chartDefaultColumns.labelCol)
    $("#sidebar_chart_select_value_column").val(chartDefaultColumns.valueCol)

    // add event listener to the select element
    $(".sidebar_chart_select").change(function(){
        x = $("#sidebar_chart_select_label_column").val()
        y = $("#sidebar_chart_select_value_column").val()
    
        // update the chart histChart
        histChart.destroy()
        showSelectedColumnsBarChart(chartCanvas, featureList, {labelCol: x, valueCol: y})

    })
 }

 function showSelectedColumnsBarChart(chartCanvas, featureList, chartColumns, title = "Chart") {
    var data = {
        labels: [],
        values: []
    }
    for (var key of Object.keys(featureList)) {
        data.labels.push(featureList[key].properties[chartColumns.labelCol])
        data.values.push(featureList[key].properties[chartColumns.valueCol])
      
    }
    
    histChart = distributionChart(chartCanvas, data, title)
 }

 function showFeatureDetailsOnSideBar(attrs){
    // get the feature name as attribute of html element
    var featureName = $("#charts-popup-link").attr("feature_name")

    ctlSidebar.show(); 
    if (histChart) histChart.destroy() 

    // case of douar
    if(featureName == "douar"){
        showDouarDetailsOnSideBar(attrs)
    }
    // case of zone coeur
    else if(featureName == "zonecoeur"){
        showZoneCoeurDetailsOnSideBar(attrs)
    }
    // case of zone adhesion
    else if(featureName == "zoneadhesion"){
        showZoneAdesionDetailsOnSideBar(attrs)
    }
    // case of sites invest
    else if(featureName == "sitesInvest"){
        showSiteDetailsOnSideBar(attrs)
    }

    else if(featureName == "cluster") {
        showClusterDetailsOnSideBar(attrs)
    }


 }



  //#################### end Generic function to show charts #############################/


 function addFeatureToMap(
    title,
    backendUrl,
    style = {},
    onEachFeatureFunction ,
    pointToLayerFunction 
 ){
    $.ajax({
        url: backendUrl,
        success:function(response){
            jsonData=JSON.parse(response);
            layers= L.geoJSON(jsonData,{pointToLayer: pointToLayerFunction, onEachFeature: onEachFeatureFunction }).addTo(mymap);
            cltLayers.addOverlay(layers, title);
        },
        error:function(xhr,status,error){
            alert("ERROR:"+ error);
        }
    });
    
 }


 // open graph event handling


 // function to get the list of keys from a json object
function getColumnsFromObject(obj) {
    var columns = []
    for (var key of Object.keys(obj)) {
        columns.push(key)
    }
    return columns
}

function isNumeric(n) {
    return !isNaN(parseFloat(n)) && isFinite(n);
}




// line 678-685
// {/* <div class="shadow-sm flex-wrap bg-gray-50 w-40 flex-none overflow-hidden rounded-md p-0">
// <div class="w-full h-28 overflow-hidden">
//     <img class="object-cover h w-full h-full" src="${imagesBaseUrl}/${line.photo}"  alt="">
    
// </div>                    
// <div class="p-3"></div>
//     <h3 class="text-lg font-semibold">${line.espece_name}</h3>
// </div>
// </div> */}

// 2nd // line 678-685
// {/* <div class="shadow-sm flex-none bg-gray-50 w-40 flex-none overflow-hidden rounded-md p-0">
//                     <div class="w-full h-28 overflow-hidden">
//                         <img class="object-cover h w-full h-full" src="${imagesBaseUrl}/${line.photo}"  alt="">
//                     </div>  
//                     <div class="p-3">
//                         <h3 class="text-lg font-semibold">${line.espece_name}</h3>
//                     </div>
//                 </div> */}


