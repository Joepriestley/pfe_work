<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<div class="container-fluid mt-4 pt-5">
  <div class="row">
    <div class="col-5 ">
      <div class="card">
        <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
          <b>Ajouter une espece Vegetale</b>
        </div>
        <div class="card-body ">
          <form action="./includes/esp_vegetal.inc.php" enctype="multipart/form-data" style="background-color: rgb(201, 216, 214);" method="post">
            <div class="form-row">
              <span class="form-control text-center bg-dark text-white"><b>Identification d'Espece</b></span>
              <div class="form-group col-md-6">
                <label for="nomscientifique">Nom Scientifique</label>
                <input type="text" name="nomscientifique" class="form-control" id="nomscientifique" placeholder="nom scientifique">
              </div>
              <div class="form-group col-md-6">
                <label for="nomfrancais">Nom Francais</label>
                <input type="text" name="nomfrancais" class="form-control" id="nomfrancais" placeholder="Nom Francais">
              </div>
              <div class="form-group col-md-6">
                <label for="nomvernaculaire">Nom Vernaculaire</label>
                <input type="text" name="nomvernaculaire" class="form-control" id="nomvernaculaire" placeholder="Nom Vernaculaire">
              </div>
              <div class="form-group col-md-6">
                <label for="ordre">Ordre</label>
                <input type="text" name="ordre" class="form-control" id="ordre" placeholder="Nom d'ordre ">
              </div>
              <div class="form-group col-md-12">
                <label for="famille">Famille</label>
                <input type="text" name="famille" class="form-control" id="famille" placeholder="Nom de la famille ">
              </div>
            </div>
            <span class="form-control text-center bg-dark text-white"><b>Autres Caracteristiques</b></span>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="categorie">Categorie</label>
                <input type="text" name="categorie" class="form-control" id="categorie" placeholder="categorie">
              </div>
              <div class="form-group col-md-6">
                <label for="milieuvie">Milieu_Vie</label>
                <input type="text" name="milieuvie" class="form-control" id="milieuvie" placeholder="milieuvie">
              </div>

              <div class="form-group col-md-6">
                <label for="modreproduction">Mode_Reproduction</label>
                <select id="modreproduction" name="modreproduction" class="form-control">
                  <option value="">--Choissisez une option--</option>
                  <option value="par_graine">Par graine</option>
                  <option value="par_rejet">Par rejet</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="id_sol">Type sol</label>
                <select id="id_sol" name="id_sol" class="form-control">
                  <option value="">--Choissisez le type du sol --</option>
                  <option value="10YR 4-3">Sol argileux</option>
                  <option value="10YR 6-4">Sol marécageux</option>
                  <option value="2.5Y 4-1">Sol calcaire</option>
                  <option value="2.5Y 5-8">Sol sableux côtier</option>
                  <option value="2.5Y 6-4">Sol limoneux</option>
                  <option value="5Y 7-3">Sol sablo-argileux</option>
                  <option value="5YR 3-2">Sol rocheux</option>
                  <option value="7.5YR 3-2">Sol salin</option>
                  <option value="7.5YR 4-6">Sol dunaire</option>
                  <option value="7.5YR 5-6">Sol alluvial</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="id_bioclimat">Bioclimat</label>
                <select id="id_bioclimat" name="id_bioclimat" class="form-control">
                  <option value="">--Choissisez le bioclimat --</option>
                  <option value="Continental">Continental</option>
                  <option value="Désertique">Désertique</option>
                  <option value="Méditerranéen">Méditerranéen</option>
                  <option value="Subtropical">Subtropical</option>
                  <option value="Tropical">Tropical</option>
                </select>
              </div>

            </div>
            <div class="form-row">
              <div class="input-group col-md-8 border">
                <div class="input-group-prepend">
                  <span class="input-group-text">Commentaire</span>
                </div>
                <textarea rows="2" cols="7" name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
              </div>
              <div class="form-group col-md-4">
                <label for="photo">Photo</label>
                <input type="file" accept="image/*" id="photo" name="photo" class="form-control-file">
                <img src="../img/acaciagumi.jpg" id="photo-preview" class="img-fluid img-thumbnail rounded mt-2" height="200" width="270" alt="Photo du Vegetal">
              </div>
              <div>
                
              </div>
            </div>
           
            <span class="form-control text-center bg-dark text-white mt-4"><b>Zone d'existence</b></span>
            <?php
              // Assuming you already have the database connection established ($pdo)
              $query_zone_coeur = "SELECT * FROM zcoeur";
              $stmt = $pdo->prepare($query_zone_coeur);
              $stmt->execute();
              $zonecoeurs = $stmt->fetchall(PDO::FETCH_ASSOC);

              $query_zone_adhezion = "SELECT * FROM zadhesions";
              $stmt = $pdo->prepare($query_zone_adhezion);
              $stmt->execute();
              $zone_adhesions = $stmt->fetchall(PDO::FETCH_ASSOC);

              ?>
            <div class="form-row pt-3">
              <div class="form-group col-md-6">
                <label for="zcoeurs">Zone coeurs</label>
                <select id="zcoeurs" name="zcoeurs[]" class="form-control" multiple>
                <?php  
                  foreach($zonecoeurs as $zone_c) {
                 ?>
                  <option value="<?=$zone_c['nom'] ?>"  ><?=$zone_c['nom'] ?></option>
                  <?php  
                  }                 
                 ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="zone_adhesions">Zone Adhezion</label>
                <select id="zone_adhesions" name="zadhesions[]" class="form-control" multiple>
                <?php  
                  foreach($zone_adhesions as $zone_a) {
                 ?>
                  <option value="<?=$zone_a['name'] ?>" ><?=$zone_a['name'] ?></option>
          
                  <?php  
                  }                 
                 ?>
                </select>
              </div>
           
            </div>


            <button type="submit" style="background-color:rgb(61,131,97,1);">Inserer</button>
          </form><br>
        </div>
      </div>
    </div>
    <div class="col-md-7">

      <!-- <tbody class="table text-dark table-dark table-striped"> -->
        <?php
        try {
          $query = "SELECT * FROM espece_vegetale";
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
        <!-- dynamically generates a table  -->
        <div class="col-10 bg-gray px-2">
          <h3 class="mb-3">Liste des especes Vegetales</h3>

          <!-- <div class="container"> -->
          <div class="row">
            <?php foreach ($results as $row) : ?>
              <div class="col-md-4 mb-4">
                <div class="card">
                  <img src="<?= $row['photo'] ?>" class="card-img-top" alt="Image">
                  <div class="card-body">
                    <h5 class="card-title"><?= $row['nomscientifique'] ?></h5>
                    <p class="card-text">
                      <strong>Nom Francais:</strong> <?= $row['nomfrancais'] ?><br>
                      <strong>Nom Vernaculaire:</strong> <?= $row['nomvernaculaire'] ?><br>
                      <strong>Ordre:</strong> <?= $row['ordre'] ?><br>
                      <strong>Famille:</strong> <?= $row['famille'] ?><br>
                      <strong>Categorie:</strong> <?= $row['categorie'] ?><br>
                      <strong>Milieu Vie:</strong> <?= $row['milieuvie'] ?><br>
                      <strong>Mode de Reproduction:</strong> <?= $row['modreproduction'] ?><br>
                      <strong>Type du sol:</strong> <?= $row['id_sol'] ?><br>
                      <strong>Bioclimat:</strong> <?= $row['id_bioclimat'] ?><br>
                      <strong>Commentaire :</strong> <?= $row['commentaire'] ?>
                    </p>
                    <a href="esp_vegetal-edit.php?id=<?= $row['nomscientifique'] ?>" class="btn btn-warning" style="background-color:rgb(61,131,97,1);">Editer</a><br><br>
                    <form style="border:0px; padding:0px;" action="./deletion/esp_vegetal-delete.php" method="POST">
                      <!-- Hidden input field to include id_action -->
                      <input type="hidden" name="nomscientifique" value="<?= $row['nomscientifique'] ?>">
                      <!-- Delete button -->
                      <button name="delete_vegetal" class="delete-btn r" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['nomscientifique'] ?>" 
                      onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
                    </form>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

        </div>
    </div>
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
<?php
include_once 'footer.php';

?>