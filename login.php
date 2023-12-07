<!DOCTYPE html>
<html lang="en">
<?php
include_once 'header.php';
// style for the galerie\
require_once './includes/dbConnect.php';
// session_start();
// if(isset($_POST['']))


  // Check if an error or success message is set in the session
if (isset($_GET['error_message'])) {
    echo '<div class="error-message">' . $_GET['error_message'] . '</div>';
     }

    if (isset($_GET['success_message'])) {
      echo '<div class="success-message">' . $_GET['success_message'] . '</div>';
  // Clear the success message after displaying it
 }
                    

?>
<div  style="margin-top:150px;">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
              
                <div class="card-header" style="background-color:rgb(61,131,97,0.6);">
                    <h2 class="text-center">S'authentifier</h2>
                </div>
                <div class="card-body"  style="background-color: rgb(200, 216, 214);">
                    <form  action="includes/login.inc.php" method="POST">
                        <div class="form-group  ">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="nom" required placeholder="Votre Prenom">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" id="password" name="mot_de_passe" required placeholder="Mot de Passe">
                        </div>
                        <button type="submit" class="btntext-white btn-block" style="background-color:rgb(61,131,97,0.7);">Login</button>

                        <br><div class="form-group">

                            <img src="./img/login4.jpg" class="rounded mx-auto d-block " width="
                            350px" height="250px" alt="image for login" >
                        </div>
                       
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once 'footer.php';

?>