<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Elements Amenagement</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/pistes.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Piste</b></span>
                               
                                <div class="form-group col-md-6">
                                    <label for="id_piste">Id_Piste</label>
                                    <input name="id_piste" type="text" class="form-control" id="id_piste" placeholder="id_piste">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="longueur">Longueur (km)</label>
                                    <input name="longueur" type="number" class="form-control" id="longueur" placeholder="longueur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cout_creationt">Cout Creation (dhs)</label>
                                    <input name="cout_creationt" type="number" class="form-control" id="cout_creationt" placeholder="cout_creationt">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="accessibilite">Accessibilite</label>
                                    <input name="accessibilite" type="text" class="form-control" id="accessibilite" placeholder="accessibilite">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date_creation">Date ouverture</label>
                                <input name="date_creation" type="date" class="form-control" id="date_creation" placeholder="date_creation">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="_nom_piste">Id_Amenagement</label>
                                <input name=_nom_piste" type="number" class="form-control" id=_nom_piste" placeholder=_nom_piste">
                            </div>
                            <button type="submit"name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr >
                            <th>Id_Piste</th>
                            <th>Longueur (km)</th>
                            <th>Cout Creation (dhs)</th>
                            <th>Accessibilite</th>
                            <th>Date uverture</th>
                            <th>Id_Amenagement</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped" >
                        <!-- Table rows will be dynamically added here -->
                         <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM pistes";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['id_piste'] ?></td>
                                <td><?= $row['longueur'] ?></td>
                                <td><?= $row['cout_creationt'] ?></td>
                                <td><?= $row['accessibilite'] ?></td>
                                <td><?= $row['date_creation'] ?></td>
                                <td><?= $row['id_amengt'] ?></td>   
                                <td>
                                    <a href="pistes-edit.php?id=<?= $row['id_piste'] ?>"><button name="edit_pistes" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_piste'] ?>">Editer</button></a>
                                </td>
                                <td>

                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/pistes-delete.php" method="POST">
                                        <!-- Hidden input field to include id_piste -->
                                        <input type="hidden" name="id_piste" value="<?= $row['id_piste'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_piste" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_piste'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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















