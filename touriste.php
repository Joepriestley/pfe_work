<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';
?>

<div class="container-fluid mt-4 pt-5">
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
          <b>Ajouter Un Touriste</b>
        </div>
        <div class="card-body">
          <form action="./includes/tourist.inc.php" id="touristeForm" style="background-color: rgb(201, 216, 214);" method="post">
            <?php if (isset($_GET['message'])) { ?>
              <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
            <div class="form-row">
              <span class="form-control text-center bg-dark text-white"><b>Informations d'un Touriste</b></span>
              <div class="form-group col-md-6">
                <label for="nomtouriste">Nom Touriste</label>
                <input name="nomtouriste" type="text" class="form-control" id="nomtouriste" placeholder="Nom Touriste">

              </div>
              <div class="form-group col-md-6">
                <label for="age">Age Touriste</label>
                <input name="age" type="number" class="form-control" id="age" placeholder="Age du Touriste">
              </div>
              <div class="form-group col-md-6">
                <label for="sexe">Sexe</label>
                <input name="sexe" type="text" class="form-control" id="sexe" placeholder="sexe">
              </div>
              <div class="form-group col-md-6">
                <label for="numerocin_passport">Numero CIN/Passport</label>
                <input name="numerocin_passport" type="text" class="form-control" id="numerocin_passport" placeholder="numerocin_passport ">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nationalite">Nationalite</label>
                <input name="nationalite" type="text" class="form-control" id="nationalite" placeholder="Nationalite">
              </div>
              <div class="form-group col-md-6">
                <label for="motivation">Motivation</label>
                <input name="motivation" type="text" class="form-control" id="motivation" placeholder="motivation">
              </div>
              <div class="form-group col-md-6">
                <label for="fonction">Fonction</label>
                <input name="fonction" type="text" class="form-control" id="fonction" placeholder="fonction/occupation">
              </div>
              <div class="form-group col-md-6">
                <label for="telephone">telephone</label>
                <input name="telephone" type="tel" class="form-control" id="telephone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890">
              </div>
              <div class="form-group col-md-6">
                <label for="adresse">Adresse</label>
                <input name="adresse" type="text" class="form-control" id="adresse" placeholder="fonction/occupation">
              </div>
              <div class="form-group col-md-6">
                <label for="date_visite">date_visite</label>
                <input name="date_visite" type="text" class="form-control" id="date_visite" placeholder="fonction/occupation">
              </div>
              <div class="form-group col-md-6">
                <label for="prenom">Prenom</label>
                <input name="prenom" type="text" class="form-control" id="prenom" placeholder="Prenom">
              </div>

            </div>

            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
      <table class="table table-striped col-md-6">
        <thead class="thead-dark">
          <tr>
            <!-- <th scope="col">Id</th> -->
            <th scope="col">Nom Touriste</th>
            <th scope="col">Prenom</th>
            <th scope="col">Num Passport</th>
            <th scope="col">Nationalite</th>
            <th scope="col">Motivation</th>
            <th scope="col">Fonction</th>
            <th scope="col">Tel..</th>
            <th scope="col">DateVisite</th>
            <th scope="col">Adresse Touriste</th>
            <th scope="col">select</th>
            <th scope="col">Action</th>

          </tr>
        </thead>
        <tbody id="touriste" class="table table-white bg-white text-dark table-striped">

          <!-- Table will be added here dynamically -->

          <?php
          // Assuming you already have the database connection established ($pdo)
          $query = "SELECT * FROM touristes";
          $stmt = $pdo->prepare($query);
          $stmt->execute();
          $results = $stmt->fetchall(PDO::FETCH_ASSOC);
          ?>

          <!-- Add this inside the table body -->
          <?php foreach ($results as $row) : ?>
            <tr>
              <td><?= $row['nomtouriste'] ?></td>
              <td><?= $row['prenom'] ?></td>
              <td><?= $row['numerocin_passport'] ?></td>
              <td><?= $row['nationalite'] ?></td>
              <td><?= $row['motivation'] ?></td>
              <td><?= $row['fonction'] ?></td>
              <td><?= $row['telephone'] ?></td>
              <td><?= $row['date_visite'] ?></td>
              <td><?= $row['adresse'] ?></td>
              
              <td>
                <a href="touriste-edit.php?id=<?= $row['numerocin_passport'] ?>"><button name="edit_tourist" class="edit-btn" style="background-color:rgb(61,131,97,1);">Editer</button></a>
              </td>
              <td>
                <!-- Delete form -->
                <form style="border:0px; padding:0px;" action="./deletion/tourist-delete.php" method="POST">
                  <!-- Hidden input field to include id_suivi -->
                  <input type="hidden" name="numerocin_passport" value="<?= $row['numerocin_passport'] ?>">
                  <!-- Delete button -->
                  <button name="delete_tourist" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['numerocin_passport'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
                </form>

              </td>
            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
    </div>
  </div>
</div>


<?php
include_once 'footer.php';

?>