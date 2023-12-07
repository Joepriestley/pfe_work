<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>

    <div class="container-fluid pt-5" style="margin-top: 85px;">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Suivi de Faune</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/suivi_faune.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Suivi Faune</b></span>
                                <div class="form-group col-md-6">
                                    <label for="id_suivi">Identifiant_Suivi</label>
                                    <input name="id_suivi" type="text" class="form-control" id="id_suivi" placeholder="id_suivi">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lieu">Lieu</label>
                                    <input name="lieu" type="text" class="form-control" id="lieu" placeholder="lieu">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datesable">Responsable</label>
                                    <input name="responsable" type="text" class="form-control" name="responsable" id="responsable" placeholder="responsable">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="typeobsuivi">Date Suivi </label>
                                    <input name="datesuivi" type="date" class="form-control" id="datesuivi" name="datesuivi" min="2005-01-01" max="2030-12-31" placeholder="date de suivi de faune">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="responservation">Type d'Observation </label>
                                    <input name="typeobservation" type="tel" class="form-control" name="typeobservation" id="typeobservation"  placeholder="Observation">
                                </div>
                                
                            </div>
                            <div class="form-row">
                    
                                
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 bg-light">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Identifiant_Suivi</th>
                            <th>Lieu</th>
                            <th>Date Suivi</th>
                            <th>Responsable</th>
                            <th>Type d'Observation </th>
                            <th>Editer</th>
                            <th>Effacer</th>
                            
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->
                        <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM suivi_faune";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['id_suivi'] ?></td>
                                <td><?= $row['lieu'] ?></td>
                                <td><?= $row['datesuivi'] ?></td>
                                <td><?= $row['responsable'] ?></td>
                                <td><?= $row['typeobservation'] ?></td>
                                <td>
                                    <a href="suivi_faune-edit.php?id=<?= $row['id_suivi'] ?>"><button name="edit_suivi_faune" class="edit-btn btn btn-warning" data-id="<?= $row['id_suivi'] ?>">Editer</button></a>
                                </td>
                                <td>

                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/suivi_faune-delete.php" method="POST">
                                        <!-- Hidden input field to include id_suivi -->
                                        <input type="hidden" name="id_suivi" value="<?= $row['id_suivi'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_suivi_faune" class="delete-btn btn btn-danger" data-id="<?= $row['id_suivi'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
   include_once'footer.php';
   
   ?>














