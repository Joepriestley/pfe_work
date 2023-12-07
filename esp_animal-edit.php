<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<style>
  .card-body .toggle-content.collapsed {
    max-height: 100px;
    /* Set the collapsed height as needed */
    overflow: hidden;
  }
</style>

<div class="container-fluid mt-4 pt-5">
  <div class="row">
    <div class="col-5 ">
      <div class="card">
        <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
          <b>Ajouter une espece animale</b>
        </div>
        <div class="card-body ">
          <?php
          if (isset($_GET['id'])) {
            $nomscientifique = $_GET['id'];
            $query = "SELECT * FROM espece_animale WHERE nomscientifique= :nomscientifique";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nomscientifique', $nomscientifique, PDO::PARAM_STR);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_OBJ);

            // You might want to print specific properties of $result, not the entire object
            if ($result) {
              echo "record found.";
            } else {
              echo "No record found.";
            }
          }
          ?>
          <form action="./includes/esp_animal-edit.inc.php" enctype="multipart/form-data" id="animalForm" style="background-color: rgb(201, 216, 214);" method="post">
            <div class="form-row">
              <span class="form-control text-center bg-dark text-white"><b>Identification d'Espece</b></span>
              <div class="form-group col-md-6">
                <label for="nomscientifique">Nom Scientifique</label>
                <input type="text" class="form-control" value="<?=$result->nomscientifique; ?>" name="nomscientifique" placeholder="nom scientifique" disabled="disabled">
              </div>
              <div class="form-group col-md-6">
                <label for="nomfrancais">Nom Francais</label>
                <input type="text" name="nomfrancais" value="<?= $result->nomfrancais; ?>"  class="form-control" id="nomfrancais" placeholder="Nom Francais">
              </div>
            </div>
            <div class="form-group">
              <label for="famille">Famille</label>
              <input type="text" name="famille" value="<?=$result->famille; ?>" class="form-control" id="famille" placeholder="Nom de la famille ">
            </div>
            <span class="form-control text-center bg-dark text-white"><b>Comportement</b></span>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="statutsocial">Statut Social</label>
                <input type="text" name="statutsocial" value="<?=$result->statutsocial; ?>" class="form-control" id="statutsocial" placeholder="statutsocial">
              </div>

              <div class="form-group col-md-6">
                <label for="sedentaire">Sedentaire</label>
                <select id="sedentaire" name="sedentaire" value="<?=$result->sedentaire;?>" class="form-control">
                  <option selected>--Choissisez...</option>
                  <option value="oui">oui</option>
                  <option value="non">non</option>
                </select>
              </div>
              <div class="form-group col-md-12">
                <label for="regimealimentaire">Regime Alimentaire </label>
                <input type="text" name="regimealimentaire" value="<?=$result->regimealimentaire; ?>" class="form-control" id="regimealimentaire" placeholder="Regime Alimentaire">
              </div>

            </div>
            <span class="form-control text-center bg-dark text-white"><b>Reproduction</b></span>

            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="tailleportee">Taille Portee </label>
                <input type="number" name="tailleportee" value="<?=$result->tailleportee; ?>" class="form-control" id="tailleportee" placeholder="Taille Portee ">
              </div>

              <div class="form-group col-md-5">
                <label for="nombreportee_an">Nombre Portee_An </label>
                <input type="number" name="nombreportee_an" value="<?=$result->nombreportee_an; ?>" class="form-control" id="nombreportee_an"" placeholder=" Nombre portee/an">
              </div><br>
              <div class="form-group col-md-7">
                <label for="periodereproduction">Periode Reproduction</label>
                <input type="text" name="periodereproduction" value="<?=$result->periodereproduction; ?>" class="form-control" id="periodereproduction" placeholder="Periode Reproduction">
              </div>

              <div class="form-group col-md-4">
                <label for="photo">Photo</label>
                <input type="file" accept="image/*" id="photo" value="<?=$result->photo; ?>" name="photo" class="form-control-file">
                <img src="<?=$result->photo; ?>" id="photo-preview" class="img-fluid img-thumbnail rounded mt-2" height="200" width="200" alt="Photo d'animal">
              </div>
              <div class="input-group col-md-8">
                <div class="input-group-prepend">
                  <span class="input-group-text">Commentaire</span>
                </div>
                <textarea name="commentaire" value="<?=$result->commentaire; ?>" rows="3" cols="10" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
              </div>
              <input type="hidden" value="<?= $result->nomscientifique; ?>" name="nomscientifique">

            </div>
            <br><button type="submit" class="btn " style="background-color:rgb(61,131,97,1);">UPDATE</button> <br><br>
          </form>

        </div>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#photo').on('change', function() {
          var input = this;
          if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
              $('#photo-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
          }
        });
      });
    </script>

    <!-- <tbody class="table text-dark table-dark table-striped"> -->
    <?php
    try {
      $query = "SELECT * FROM espece_animale";
      $stmt = $pdo->query($query);

      if ($stmt) {
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      } else {
        echo "Error retrieving data from the database.";
      }
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    ?> 

    <div class="col-7 bg-gray px-2">
    <textarea rows="50" cols="500" name="commentaire"  class="form-control" id="commentaire" aria-label="commentaire" placeholder="Ecrivez vos donnees de mises a jour ici pour ne pas faire aller retour" ></textarea>


    </div>

  </div>
</div>

<?php
include_once 'footer.php';

?>