
function buildZoneSidebarHtml(zoneLabel, zoneName,  properties, releventCols, especesAnimals, especesVegetals) {
    return `
    <div class="w-full h-full relative p-3 ">
    <span class="absolute top-0 text-base left-0 m-2">${zoneLabel}</span>
    
   <div class="flex flex-col space-y-4">
      <h1 class="text-4xl  mt-8">
        ${zoneName}
      </h1>
    
      <section class="">
        <h2 class="text-2xl mb-3">Détails</h2>
        <ul class="py-2 flex flex-col text-lg  space-y-2">
          ${releventCols.map(col => `<li class="flex space-x-3">
            <span class="font-semibold">${col}:</span>
            <span>${properties[col]}</span>
          </li>`).join("")} 
        </ul>
      </section>
      <section class="w-full overflow-hidden ">
          <h2 class="text-2xl mb-3">Espèces animals (${especesAnimals.length})</h2>
          <div class="flex space-x-2 py-4 overflow-auto flex-nowrap w-full">
        ${especesAnimals.map(line => `
           
        <div class="shadow-sm bg-gray-50 flex flex-wrap rounded-md p-0">
    <!-- Repeat the following code block for each image -->
    <div class="w-40 flex-none overflow-hidden p-3">
        <a href="${imagesBaseUrl}/${line.photo}" data-title="${line.espece_name}" data-lightbox="image-animal"><img class="object-cover w-full h-28" src="${imagesBaseUrl}/${line.photo}" alt=""></a>
        <h3 class="text-lg font-semibold">${line.espece_name}</h3>
    </div>
</div>

        
        `).join("")}
    
          </div>
      </section>
      <section class="w-full overflow-hidden ">
        <h2 class="text-2xl mb-3">Espèces vegetal (${especesVegetals.length})</h2>
        <div class="flex space-x-2 py-4 overflow-auto flex-nowrap w-full">

          ${especesVegetals.map(line => `
                <div class="shadow-sm flex-none bg-gray-50 w-40 flex-none overflow-hidden rounded-md p-0">
                    <div class="w-full h-28 overflow-hidden">
                    <a href="${imagesBaseUrl}/${line.photo}" data-title="${line.espece_name}" data-lightbox="image-lightbox">
                    <div class="custom-lightbox">
                      <img src="${imagesBaseUrl}/${line.photo}" alt="">
                    </div>
                  </a>
                  
                    </div>  
                    <div class="p-3">
                        <h3 class="text-lg font-semibold">${line.espece_name}</h3>
                    </div>
                </div>

                
            `).join("")}
       
          
        </div>
    </section>
   </div>

  </div>
    `
    
}



function buildDouarSidebarHtml(attrs, releventCols) {
  var photoUrl = `/geoportail-pnsm/forms/${attrs.photo}`
    return `
    <div class="w-full h-full relative p-3 ">
    <span class="absolute top-0 text-base left-0 m-2">Douar</span>
    
   <div class="flex flex-col space-y-4">
      <h1 class="text-4xl  mt-8">
        ${attrs.nom}
      </h1>
     
       ${attrs.photo ? `<div class="w-full h-36 "><img src="${photoUrl}" class="object-cover w-full h-full rounded-md"> </div>` : ''}
   
      <p class="py-3">        
        ${attrs.commentaire}
      <p>
      <section class=""> 
        <h2 class="text-2xl mb-3">Détails</h2>
        <ul class="py-2 flex flex-col text-lg  space-y-2">
          ${releventCols.filter(c => c != "photo" ).map(col => `<li class="flex space-x-3">
            <span class="font-semibold">${col}:</span>
            <span>${attrs[col]}</span>
          </li>`).join("")} 
        </ul>
      </section>
      <section class="w-full h-auto">
        <h2 class="text-2xl mb-3">Activités</h2>
        <div class="p-3  w-full">
           <canvas class="responsive-canvas" height="300" id="douar_activite_doughnut"  ></canvas>
        </div>
        <div class="p-3 mt-3 w-full">
         <canvas class="responsive-canvas" height="300" id="douar_rendement_activite_bar" ></canvas>
      </div>
      </section>
    

   </div>

  </div>
    `
    
}



function buildFearuePopup(attrs, featureKey, cols = []){

      
    var tableHtml = `
    <div
    id="item-details-dialog"
    class="relative space-y-3 overflow-y-scroll w-auto" 
    >
    <table class="table w-full mb-14 ">
    <thead>
      <tr>
        <th scope="col">Field</th>
        <th scope="col">Value</th>
      </tr>
    </thead>
    <tbody class="body">
    `;
    
    for (var key of Object.keys(attrs)) {
        if( cols.length == 0  ||  (cols.length > 0 && cols.includes(key))) tableHtml += "<tr><th>"+key+"</th><td>"+attrs[key]+"</td></tr>";
    }

    tableHtml += `</tbody>
    </table>
    <div class="w-full bg-white pt-6 pb-2 flex absolute bottom-0 left-0 z-20">
    <button
      feature_name=${featureKey}
      id="charts-popup-link"
      class="graph-link px-4 py-1 block rounded-full text-white bg-[#9e1b49] shadow outline-none"
      href=""
    >
      Afficher les détails
    </button>
  </div>
    </div>
    ` 

    var tableEl = document.createElement('div')
    tableEl.innerHTML = tableHtml
    tableEl.addEventListener('click', e => showFeatureDetailsOnSideBar(attrs))

    return tableEl

}

