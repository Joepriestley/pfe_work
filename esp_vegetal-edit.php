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
        <?php
          if (isset($_GET['id'])) {
            $nomscientifique = $_GET['id'];
            $query = "SELECT * FROM espece_vegetale WHERE nomscientifique= :nomscientifique";
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
          <form action="./includes/esp_vegetal-edit.inc.php" enctype="multipart/form-data" style="background-color: rgb(201, 216, 214);" method="post">
            <div class="form-row">
              <span class="form-control text-center bg-dark text-white"><b>Identification d'Espece</b></span>
              <div class="form-group col-md-6">
                <label for="nomscientifique">Nom Scientifique</label>
                <input type="text" name="nomscientifique" value="<?=$result->nomscientifique; ?>" class="form-control" id="nomscientifique" placeholder="nom scientifique" disabled="disabled">
              </div>
              <div class="form-group col-md-6">
                <label for="nomfrancais">Nom Francais</label>
                <input type="text" name="nomfrancais" value="<?=$result->nomfrancais; ?>" class="form-control" id="nomfrancais" placeholder="Nom Francais">
              </div>
              <div class="form-group col-md-6">
                <label for="nomvernaculaire">Nom Vernaculaire</label>
                <input type="text" name="nomvernaculaire" value="<?=$result->nomvernaculaire; ?>" class="form-control" id="nomvernaculaire" placeholder="Nom Vernaculaire">
              </div>
              <div class="form-group col-md-6">
                <label for="ordre">Ordre</label>
                <input type="text" name="ordre" value="<?=$result->ordre; ?>" class="form-control" id="ordre" placeholder="Nom d'ordre ">
              </div>
              <div class="form-group col-md-12">
                <label for="famille">Famille</label>
                <input type="text" name="famille" value="<?=$result->famille; ?>" class="form-control" id="famille" placeholder="Nom de la famille ">
              </div>
            </div>
            <span class="form-control text-center bg-dark text-white"><b>Autres Caracteristiques</b></span>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="categorie">Categorie</label>
                <input type="text" name="categorie" value="<?=$result->categorie; ?>" class="form-control" id="categorie" placeholder="categorie">
              </div>
              <div class="form-group col-md-6">
                <label for="milieuvie">Milieu_Vie</label>
                <input type="text" name="milieuvie" value="<?=$result->milieuvie; ?>" class="form-control" id="milieuvie" placeholder="milieuvie">
              </div>

              <div class="form-group col-md-6">
                <label for="modreproduction">Mode_Reproduction</label>
                <select id="modreproduction" name="modreproduction" value="<?=$result->modreproduction; ?>" class="form-control">
                  <option value="">--Choissisez une option--</option>
                  <option value="par_graine">Par graine</option>
                  <option value="par_rejet">Par rejet</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="id_sol">Type sol</label>
                <select id="id_sol" name="id_sol" value="<?=$result->id_sol; ?>" class="form-control">
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
                <select id="id_bioclimat" name="id_bioclimat" value="<?=$result->id_bioclimat; ?>" class="form-control">
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
                <textarea rows="2" cols="7" name="commentaire" value="<?=$result->commentaire; ?>" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
              </div>
              <div class="form-group col-md-4">
                <label for="photo">Photo</label>
                <input type="file" accept="image/*" id="photo" name="photo" value="<?=$result->photo; ?>" class="form-control-file">
                <img src="<?=$result->photo; ?>" id="photo-preview" class="img-fluid img-thumbnail rounded mt-2" height="200" width="270" alt="Photo du Vegetal">
              </div>
              <input type="hidden" value="<?= $result->nomscientifique; ?>" name="nomscientifique">
            </div><br>
            <button type="submit" class="btn " style="background-color:rgb(61,131,97,1);">UPDATE</button>
          </form><br>
          
        </div>
      </div>
    </div>
    <div class="col-md-7">

      <!-- <tbody class="table text-dark table-dark table-striped"> -->
        
        <!-- dynamically generates a table  -->
        <div class="col-10 bg-gray px-2">
        <textarea rows="50" cols="500" name="commentaire"  class="form-control" id="commentaire" aria-label="commentaire" placeholder="Ecrivez vos donnees de mises a jour ici pour ne pas faire aller retour
         pour gagner le temps"></textarea>

          <!-- <div class="container"> -->
          

        </div>
    </div>
  </div>
</div>
</div>

<?php
include_once 'footer.php';

?>