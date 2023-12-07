<?php
include_once 'header.php';
?>

<style>
  /* Center the text inside the carousel item */
  .carousel-caption {
    position: absolute;
    top: 49%;
    left: 63%;
    right: 0%;
    bottom: 35%;
    transform: translate(-70%, -40%);
    color: #ffffff; /* Set the text color to white */
    background-color: rgb(32 71 63 / 45%); /* Semi-transparent black background */
    padding: 10px; /* Add some padding for better visibility */
    border-radius: 50px; /* Rounded corners */
    size: 8px;
  }

  /* Set text shadow for better contrast on light backgrounds */
  .carousel-caption h5 {
    text-shadow: 1px 1px 2px #000; /* Reduce shadow for h5 in the middle part */
  }

  /* Style carousel text content */
  .carousel-caption h5, .carousel-caption p {
    margin: 0; /* Remove default margins for a clean look */
  }
</style>

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <!-- Add more carousel indicators here if needed -->
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100 height-img" height="400" src="../img/addax.png" alt="photo_addax">
      <div class="carousel-caption d-none d-md-block">
        <h5>This is an addax of the Saharan species at PNSM</h5>
        <p>Some description goes here.</p>
      </div>
    </div>
    <!-- Add more carousel items with captions as needed -->
  </div>

  <!-- Carousel controls -->
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<?php
include_once 'footer.php';
?>
