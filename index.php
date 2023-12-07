<?php
include_once 'header.php';
?>

<style>
/* Center the text inside the carousel item */
    .carousel-caption {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -30%);
      color: black;
    }
    element {
      height:100% !important;
    }
    .carousel-caption h1 {
      color: #fff;
      font-weight: 800;
    }
    .carousel-caption h5 {
      color: #fff;
      font-weight: 800;
    }
  </style>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" style="height:1000px !important;">
        <div class="carousel-item active" style="height:1000px !important;" >
          <img class="d-block w-100 height-img" height="400" src="./img/josvan.jpg"  alt="photo_addax" style="height:100% !important;">
          <div class="carousel-caption d-none d-md-block">
            <h1>La Gazzelle Dorcas</h1>
            <h5>Symbole de grâce et de vivacité, habitante emblématique du Parc National de Souss Massa</h5>
          </div>
        </div>
        <div class="carousel-item w-80">
          <img class="d-block w-100" height="800" src="./img/ORYX10.jpg"  alt="photo_oryx">
          <div class="carousel-caption d-none d-md-block">
            <h1>L'Addax </h1>
            <h5>Élégance et robustesse incarnées au cœur du Parc National de Souss Massa, un symbole de résilience désertique.</h5>
          </div>
        </div>
        <div class="carousel-item">
        <img class="d-block w-100"  src="./img/ostrich10.jpg" alt="autriche">
        <div class="carousel-caption d-none d-md-block">
          <h1>L'Autruche</h1>
          <h5>L'autruche à cou rouge : une espèce distinctive parmi les quatre espèces sahariennes, prospérant dans le Parc National de Souss Massa</h5>
        </div>
      </div>
      </div>
    </div>
    <div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
    </div>
    <div>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>

<div style="width: 80%; margin-left:10%; margin-top:100px; margin-bottom:100px; text-align: center;">
<h2>Nos Activités</h2>
  <div class="card-deck">
  <div class="card">
      <img class="card-img-top" height="240" src="./img/walk.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Circuit Touristiques</h5>
        <p class="card-text"><i>Explorez nos circuits sécurisés conçus pour divertir toute la famille. 
          Découvrez des sentiers captivants et des attractions pour des moments inoubliables au cœur de notre parc.</i></p>
      </div>
    </div>
    
    <div class="card">
      <img class="card-img-top" height="240" src="./img/horse_ride.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Circuit A Dos d'Ane</h5>
        <p class="card-text"><i>Partez à l'aventure avec notre circuit à dos d'âne. 
          Explorez la nature à un rythme tranquille et vivez des moments authentiques en compagnie de ces adorables compagnons</i></p>
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" height="240" src="./img/fishing.svg" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Perche Artisanal</h5>
        <p class="card-text"><i>Découvrez notre perche artisanale, créée avec passion pour capturer vos moments uniques en extérieur avec style et fonctionnalité.</i></p>
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" height="240" src="./img/ornithology.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Ornithologie</h5>
        <p class="card-text"><i>Développez votre passion pour les oiseaux avec notre guide ornithologique. 
          Explorez la diversité des espèces et découvrez leurs habitats au sein de nos circuits dédiés.</i></p>
      </div>
    </div>
  
  </div>
</div>
<div style="width: 80%; margin-left:10%; margin-top:100px; margin-bottom:100px; text-align: center;">
<h2>Nos Services</h2>
  <div class="card-deck">
    <div class="card">
      <img class="card-img-top" height="245" src="./img/Children.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Espace Enfants</h5>
        <p class="card-text"><i>Totalement sécurisé et pensé afin d'accueillir vos petits chou pour passer des moments agréables au sein du parc</i></p>
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" height="245" src="./img/food.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Restaurant</h5>
        <p class="card-text"><i>Une restauration local et international pour tous les gouts</i></p>
      </div>
    </div>
    <div class="card">
      <img class="card-img-top" height="245" src="./img/car.png" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">Station Service</h5>
        <p class="card-text"><i>Plusieurs services sont proposés pour vos véchicules</i></p>
      </div>
    </div>
  </div>
</div>
<div style="text-align: center;">
  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d18012.089738433435!2d-9.637165521372017!3d30.199410016042883!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xdb3bfb1eddebaf9%3A0x21551b50a964bb53!2sPorte%20du%20parc%20national%20de%20souss%20massa!5e0!3m2!1sen!2sma!4v1700663185496!5m2!1sen!2sma"
    width="1000" height="350" style="border:3px; display: inline-block;"
    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
</div>

<?php
include_once 'footer.php';
?>