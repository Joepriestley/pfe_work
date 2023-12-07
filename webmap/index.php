<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="keywords" content="Geoportail-PNSM,Geoportal,web GIS" />
    <meta name="description" content="Web GIS developpement" />
    <title>Geoportail-PNSM</title>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.css" rel="stylesheet" /> -->

    <link rel="stylesheet" href="src/leaflet.css" />
    <!-- <link rel="stylesheet" href="src/css/bootstrap.css" /> -->
    <link rel="stylesheet" href="src/plugins/L.Control.Pan.css" />
    <link rel="stylesheet" href="src/plugins/L.Control.Zoomslider.css" />
    <link rel="stylesheet" href="src/plugins/L.Control.MousePosition.css" />
    <link rel="stylesheet" href="src/plugins/L.Control.Sidebar.css" />
    <link rel="stylesheet" href="src/plugins/Leaflet.PolylineMeasure.css" />
    <link rel="stylesheet" href="src/plugins/easy-button.css" />
    <link
      rel="stylesheet"
      href="src/plugins/leaflet-opencage/src/css/L.Control.OpenCageSearch.css"
    />
    <link
      rel="stylesheet"
      href="src/plugins/leaflet-styleeditor/css/Leaflet.StyleEditor.css"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"
      rel="stylesheet"
      type="text/css"
    />
    <link rel="stylesheet" href="src/plugins/Control.FullScreen.css" />
    <link rel="stylesheet" href="src/plugins/leaflet-draw/leaflet.draw.css" />

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="src/lightbox/lightbox.css">
    <script src="https://cdn.tailwindcss.com"></script>

  </head>
  <style>
  
    #item-details-dialog {
      max-height: 300px;
      width: fit-content;
      background: white;
    }
    .leaflet-popup {
      width: fit-content !important;
    }
    .graph-link {
      padding-left: 4px;
      padding-right: 4px;
    }
/* 
    #charts {
      color: brown;

    } */
    .hist-chart {
      height: 200px !important;
    }
  </style>

  <body>


  <!--start modal for edit feature -->
  <!-- Button to trigger the modal -->
 <!-- <button type="button" id="modalButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" data-toggle="modal" data-target="#editPolygonModal">
  Edit Polygon
</button> -->

<!-- Modal -->
<div class="modal fixed w-full h-full top-0 left-0 flex items-center justify-center" style="display:none;">
  <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

  <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

    <!-- Add margin if you want to see some of the overlay behind the modal-->
    <div class="modal-content py-4 text-left px-6">
      <!--Title-->
      <div class="flex justify-between items-center pb-3">
        <p class="text-2xl font-bold">Edit Polygon</p>
        <div class="modal-close cursor-pointer z-50">
          <svg class="fill-current text-black hover:text-gray-700" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
            <path d="M18 1.5L16.5 0 9 7.5 1.5 0 0 1.5 7.5 9 0 16.5 1.5 18 9 10.5l7.5 7.5 1.5-1.5L10.5 9z"/>
          </svg>
        </div>
      </div>

      <!--Body-->
      <form id="editPolygonForm" class="w-full max-w-lg">
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="property1">
              Property 1:
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="property1" name="property1" type="text">
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="property2">
              Property 2:
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="property2" name="property2" type="text">
          </div>
        </div>
        <!-- Add additional form fields as needed -->
        <input type="hidden" id="polygonCoords" name="polygonCoords">
      </form>

      <!--Footer-->
      <div class="flex justify-end pt-2">
        <button id="savePolygonBtn" class="px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400">Save</button>
        <button class="modal-close px-4 ml-2 bg-gray-500 p-3 rounded-lg text-white hover:bg-gray-400">Cancel</button>
      </div>

    </div>
  </div>
</div>

<!-- <script>
// // Initialize the edit polygon modal
// $('.modal').on('shown.bs.modal', function (event) {
//   // Get the polygon data and convert it to a string of coordinates
//   var polygonData = drawnItems.getLayers()[0].toGeoJSON();
//   var polygonCoords = JSON.stringify(polygonData.geometry.coordinates[0]);

//   // Set the polygon coordinates in the hidden input field
//   $('#polygonCoords').val(polygonCoords);
// });

// // Save the edited polygon when the Save button is clicked
// $('#savePolygonBtn').click(function() {
//   // Get the form data and polygon coordinates
//   var formData = $('#editPolygonForm').serialize();
//   var polygonCoords = $('#polygonCoords').val();

//   // Send the form data and polygon coordinates to the server using AJAX
//   $.ajax({
//     url: 'editInsertion.php',
//     type: 'POST',
//     data: formData + '&polygonCoords=' + polygonCoords,
//     success: function(response) {
//       console.log('Polygon saved successfully!');
//       $('.modal').modal('hide');
//     },
//     error: function(xhr, status, error) {
//       console.error('Error saving polygon:', error);
//     }
//   });
// });
</script> -->


  <!--end modal for edit feature -->
 
    <div id="side-bar" class="col-md-5  text-black">
      <div id="side-bar-content" class="w-full h-full relative p-3 ">
      </div>

      <!-- <div class="w-full h-full relative p-3 ">
        <span class="absolute top-0 text-base left-0 m-2">Zone de coeur</span>
        
       <div class="flex flex-col space-y-4">
          <h1 class="text-4xl  mt-8">
            Zone de coeur nord 1
          </h1>
          <section class="">
            <h2 class="text-2xl mb-3">Détails</h2>
            <ul class="py-2 flex flex-col text-lg  space-y-2">
              <li class="flex space-x-3">
                <span class="font-semibold">Nom:</span>
                <span>Zone de coeur nord 1</span>
              </li>
              <li class="flex space-x-3">
                <span class="font-semibold">Type:</span>
                <span>Zone de coeur</span>
              </li> 
              <li class="flex space-x-3">
                <span class="font-semibold">Superficie:</span>
                <span>0.00 km²</span>
              </li>
              <li class="flex space-x-3">
                <span class="font-semibold">Périmètre:</span>
                <span>0.00 km</span>
            </ul>
          </section>
          <section class="w-full overflow-hidden ">
              <h2 class="text-2xl mb-3">Espèces animals</h2>
              <div class="flex space-x-2 py-4 overflow-auto flex-nowrap w-full">
                <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                  <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                  <div class="p-3">
                    <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                  </div>
                </div>
                <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                  <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                  <div class="p-3">
                    <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                  </div>
                </div>
                <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                  <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                  <div class="p-3">
                    <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                  </div>
                </div>
                <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                  <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                  <div class="p-3">
                    <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                  </div>
                </div>
                
              </div>
          </section>
          <section class="w-full overflow-hidden ">
            <h2 class="text-2xl mb-3">Espèces vegetal</h2>
            <div class="flex space-x-2 py-4 overflow-auto flex-nowrap w-full">
              <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                <div class="p-3">
                  <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                </div>
              </div>
              <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                <div class="p-3">
                  <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                </div>
              </div>
              <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                <div class="p-3">
                  <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                </div>
              </div>
              <div class="shadow-sm-light bg-gray-50 w-32 flex-none overflow-hidden rounded-md p-0">
                <img  class="object-cover w-full h-22" src="https://via.placeholder.com/350x150"  alt="">
                <div class="p-3">
                  <h3 class="text-lg font-semibold">Zone de coeur nord 1</h3>
                </div>
              </div>
              
             
             
            </div>
        </section>
       </div>

      </div> -->
      <!-- <div id="" class="col-xs-12">
        <div class="py-4 flex space-x-2 flex-row">
          <div class="flex-1">
            <label
              for="sidebar_chart_select_label_column"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Column des labels (X)</label
            >
            <select
              id="sidebar_chart_select_label_column"
              class="block sidebar_chart_select w-full p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
              <option selected>Choisir la colonne (X)</option>
              
            </select>
          </div>
          <div class="flex-1">
            <label
              for="sidebar_chart_select_value_column"
              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
              >Colonne des valeurs (Y) [Numeric]</label
            >
            <select
              id="sidebar_chart_select_value_column"
              class="block w-full sidebar_chart_select p-2 mb-6 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            >
              <option selected>Choisir la colonne (Y) </option>
              
            </select>
          </div>
        </div>

        <div id="charts" class="py-3">
          <canvas class="hist-chart" id="sidebar_chart"></canvas>
        </div>
      </div> -->

      <!-- <h4>Zoom Level: <span id='zoom-level'></span></h4>
            <h4>Map Center: <span id='map-center'></span></h4>
            <h4>Mouse Location: <span id='mouse-location'></span></h4>
            <h4>slider:  <span id="image-opacity">0.5</span></h4>
            <input type="range"id="sldopacity" min="0" max="1" step="0.1" value="05"> -->
    </div>
    <div id="mapdiv" class="col-md-12"></div>

    <script src="src/leaflet-src.js"></script>
    <script src="src/jquery-3.2.0.min.js"></script>
    <script src="src/plugins/L.Control.Pan.js"></script>
    <script src="src/plugins/L.Control.Zoomslider.js"></script>
    <script src="src/plugins/L.Control.MousePosition.js"></script>
    <script src="src/plugins/L.Control.Sidebar.js"></script>
    <script src="src/plugins/Leaflet.PolylineMeasure.js"></script>
    <script src="src/plugins/easy-button.js"></script>
    <script src="src/plugins/leaflet-opencage/src/js/L.Control.OpenCageSearch.js"></script>
    <script src="src/plugins/leaflet-providers.js"></script>
    <script src="src/plugins/leaflet.ajax.min.js"></script>
    <script src="src/plugins/leaflet.browser.print.min.js"></script>
    <script src="src/plugins/Control.FullScreen.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="js/templates.js"></script>
    <script src="js/graphs.js"></script>
    <script src="js/main.js"></script>

    <!--    ***************  Begin Leaflet.Draw-->

    <script src="src/plugins/leaflet-draw/Leaflet.draw.js"></script>
    <script src="src/plugins/leaflet-draw/Leaflet.Draw.Event.js"></script>

    <script src="src/plugins/leaflet-draw/Toolbar.js"></script>
    <script src="src/plugins/leaflet-draw/Tooltip.js"></script>

    <script src="src/plugins/leaflet-draw/ext/GeometryUtil.js"></script>
    <script src="src/plugins/leaflet-draw/ext/LatLngUtil.js"></script>
    <script src="src/plugins/leaflet-draw/ext/LineUtil.Intersect.js"></script>
    <script src="src/plugins/leaflet-draw/ext/Polygon.Intersect.js"></script>
    <script src="src/plugins/leaflet-draw/ext/Polyline.Intersect.js"></script>
    <script src="src/plugins/leaflet-draw/ext/TouchEvents.js"></script>

    <script src="src/plugins/leaflet-draw/draw/DrawToolbar.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.Feature.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.SimpleShape.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.Polyline.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.Circle.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.Marker.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.Polygon.js"></script>
    <script src="src/plugins/leaflet-draw/draw/handler/Draw.Rectangle.js"></script>

    <script src="src/plugins/leaflet-draw/edit/EditToolbar.js"></script>
    <script src="src/plugins/leaflet-draw/edit/handler/EditToolbar.Edit.js"></script>
    <script src="src/plugins/leaflet-draw/edit/handler/EditToolbar.Delete.js"></script>

    <script src="src/plugins/leaflet-draw/Control.Draw.js"></script>

    <script src="src/plugins/leaflet-draw/edit/handler/Edit.Poly.js"></script>
    <script src="src/plugins/leaflet-draw/edit/handler/Edit.SimpleShape.js"></script>
    <script src="src/plugins/leaflet-draw/edit/handler/Edit.Circle.js"></script>
    <script src="src/plugins/leaflet-draw/edit/handler/Edit.Rectangle.js"></script>
    <script src="src/plugins/leaflet-draw/edit/handler/Edit.Marker.js"></script>
    <script src="src/plugins/leaflet-styleeditor/javascript/Leaflet.StyleEditor.js"></script>
    <script src="src/plugins/leaflet-styleeditor/javascript/Leaflet.StyleForms.js"></script>
    <script src="src/lightbox/lightbox-plus-jquery.js"></script>

    <!--    **************  End of Lealet Draw-->
  </body>
</html>
