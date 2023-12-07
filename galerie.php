<?php
include_once './header.php';
// style for the galerie
echo '<style>';
echo '.card-body {
        border-radius:100px;
        padding:3px;
        
        
}';
echo '<style>';
echo '.images{
       cursor: pointer;
        filter: grayscale(1)brightness(0.5);
        border-radius: 50px;
        transition: 0.3s linear;
        border-radius:100px;     
}';
echo '.images:hover{
        filter: grayscale(0)brightness(1); 
}';
echo '</style>';
?>

<div class="container mt-4">
  <div class="row">

    <div class="col-md-4">
      <div class="card">
        <div class="images"><a href="./img/bald_chauve.jpg"  data-lightbox="models" data-title="Géronticus eremita"><img src="./img/bald_chauve.jpg"  width="350" height="350"></a></div>
        <div class="card-body">
          <p class="card-text">Ibis chauve</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="images"><a href="./img/ostrcouroge.JPG" data-lightbox="models" data-title="Struthio Camelus camelus"><img src="./img/ostrcouroge.JPG" width="350" height="350"></a></div>
        <div class="card-body">
          <p class="card-text">Autruche a cou rouge</p>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card">
        <div class="images"><a href="./img/oedicneme.jpg" data-lightbox="models" data-title="Œdicnème criards"><img src="./img/oedicneme.jpg" width="350" height="350"></a></div>
        <div class="card-body">
          <p class="card-text">Œdicnème criards</p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Sarcelle.jpg" data-lightbox="models" data-title="Sarcelle"><img src="./img/Sarcelle.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Sarcelle</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Foulque.jpg" data-lightbox="models" data-title="Foulque macroule"><img src="./img/Foulque.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Foulque macroule</p>
              </div>
            </div>
          </div>
          <div class="col-md-4  ">
            
            <div class="card">
                <a href="./img/bufalo.jpg" data-lightbox="models" data-title="Addax nasomaculatus"><img src="./img/bufalo.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Addax</p>
              </div>
            </div>
          </div>
         
        </div>
        <div class="row">
    
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Adonis_aestivalis.jpg" data-lightbox="models" data-title="Adonis aestivalis"><img src="./img/Adonis_aestivalis.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Adonis aestivalis</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Anthemis_boveana.jpg" data-lightbox="models" data-title="Anthemis boveana"><img src="./img/Anthemis_boveana.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Anthemis boveana</p>
              </div>
            </div>
          </div>
          <div class="col-md-4  ">
            
            <div class="card">
                <a href="./img/Tamarix_africana.JPG" data-lightbox="models" data-title="Tamarix africana"><img src="./img/Tamarix_africana.JPG"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Tamarix africana</p>
              </div>
            </div>
          </div>
         
        </div>
        <div class="row">
          
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/MIGRA.jpg" data-lightbox="models" data-title="oiseaux de migratio"><img src="./img/MIGRA.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p>oiseaux migrateurs</p>
              </div>
            </div>
          </div>

          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/IMG_4783.jpg" data-lightbox="models" data-title="oiseaux migrateurs"><img src="./img/IMG_4783.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">oiseaux migrateurs</p>
              </div>
            </div>
          </div>
          <div class="col-md-4  ">
            
            <div class="card">
                <a href="./img/gazzelle.png" data-lightbox="models" data-title="Gazzella dorcas"><img src="./img/gazzelle.png"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Gazzelle</p>
              </div>
            </div>
          </div>
          
          
        </div>
        <div class="row">
          
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Agama.jpg" data-lightbox="models" data-title="Agama biberoni"><img src="./img/Agama.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Agama biberoni</p>
              </div>
            </div>
          </div>

          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/coulouvre.jpg" data-lightbox="models" data-title="Coulouvre viperine"><img src="./img/coulouvre.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Coulouvre viperine</p>
              </div>
            </div>
          </div>
          <div class="col-md-4  ">
            
            <div class="card">
                <a href="./img/gazel.jpg" data-lightbox="models" data-title="Gazzella dorcas"><img src="./img/gazel.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Gazzelle</p>
              </div>
            </div>
          </div>
          
        </div>
        <div class="row">
            <div class="row">
              
              <div class="col-md-4 ">
                <div class="card">
                    <a href="./img/circuitando-ane.jpg" data-lightbox="models" data-title="Circuit touristique"><img src="./img/circuitando-ane.jpg"  width="350" height="350" ></a>
                  <div class="card-body">
                    <p class="card-text">Circuit a dos-ane</p>
                  </div>
                </div>
              </div>
    
              <div class="col-md-4 ">
                <div class="card">
                    <a href="./img/TOURISME-PNSM.jpg" data-lightbox="models" data-title="Circuitiques"><img src="./img/TOURISME-PNSM.jpg"  width="350" height="350" ></a>
                  <div class="card-body">
                    <p class="card-text">Circuit</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4  ">
                
                <div class="card">
                    <a href="./img/humidesPNSM.jpg" data-lightbox="models" data-title="zone humide"><img src="./img/humidesPNSM.jpg"  width="350" height="350" ></a>
                  <div class="card-body">
                    <p class="card-text">zone humide</p>
                  </div>
                </div>
              </div>
              
            </div>
          
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Chevalier.jpg" data-lightbox="models" data-title="Chevalier gambette"><img src="./img/Chevalier.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Chevalier gambette</p>
              </div>
            </div>
          </div>
          
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/Echasse.jpg" data-lightbox="models" data-title="Echasse blanche"><img src="./img/Echasse.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Echasse blanche</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
           
            <div class="card">
                <a href="./img/flamingo.jpg" data-lightbox="models" data-title="Phoenicopterus roseus"><img src="./img/flamingo.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Flamant rose</p>
              </div>
            </div>
          </div>
          
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/alpculturepnsm.jpg" data-lightbox="models" data-title="Chevalier gambette"><img src="./img/alpculturepnsm.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text"> Activit Alpculture du PNSM</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/ory_gpr1.jpg" data-lightbox="models" data-title="Echasse blanche"><img src="./img/ory_gpr1.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Oryx Gazzelle</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
           
            <div class="card">
                <a href="./img/faucon_crecerelle.jpg" data-lightbox="models" data-title="Phoenicopterus roseus"><img src="./img/faucon_crecerelle.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Faucon Crecerelle</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/flamant.jpg" data-lightbox="models" data-title="Flamant"><img src="./img/flamant.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Flamant</p>
              </div>
            </div>
          </div>
          
          <div class="col-md-4 ">
            <div class="card">
                <a href="./img/chat_gante.jpg" data-lightbox="models" data-title="Echasse blanche"><img src="./img/chat_gante.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Chat Gante</p>
              </div>
            </div>
          </div>
          <div class="col-md-4 ">
           
            <div class="card">
                <a href="./img/gazelle_.jpg" data-lightbox="models" data-title="Phoenicopterus roseus"><img src="./img/gazelle_.jpg"  width="350" height="350" ></a>
              <div class="card-body">
                <p class="card-text">Dorcas Gazelle_</p>
              </div>
            </div>
          </div>
          
        </div> 

</div>
 
<?php
include_once './footer.php';
?>



       