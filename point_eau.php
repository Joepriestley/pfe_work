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
                        <form action="./includes/point_eau.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b> Point Eau</b></span>
                                <div class="form-group col-md-6">
                                    <label for="id_ref_point_eau">ID Point Eau </label>
                                    <input name="id_point_eau" type="text" class="form-control" id="id_point_eau" placeholder="saissir l'identifiant du point eau">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="profondeur">Profondeur</label>
                                    <input name="profondeur" type="number" class="form-control" id="profondeur" placeholder="profondeur">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nature">Nature</label>
                                    <input name="nature" type="text" class="form-control" id="nature" placeholder="la nature d'eau">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_installation">Cout Installation</label>
                                    <input name="cout_installation" type="number" class="form-control" id="cout_installation" placeholder="le cout de l'action">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="localisation">Localisation</label>
                                    <input name="localisation" type="text" class="form-control" id="localisation" placeholder="localisation">
                             </div>
                            </div>
                                <div class="form-group col-md-12">
                                    <label for="importance">Importance</label>
                                    <input name="importance" type="text" class="form-control" id="importance" placeholder="les importance du point d'eau">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="date_installation">Dte Installation</label>
                                    <input name="date_installation" type="date" class="form-control" id="date_installation" placeholder="mettre l'identifiant de type d'amenagement">
                                </div>
                           
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
            
                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr >
                                <th>ID Point Eau</th>
                                <th>Profondeur</th>
                                <th>Date Creation</th>
                                <th>Nature</th>
                                <th>Cout Installation</th>
                                <th>Localisation</th>
                                <th>Importance</th>
                                <th>Editer</th>
                                <th>Effacer</th>
                            </tr>
                        </thead>
                        <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped" >
                            <!-- Table rows will be dynamically added here -->
                            <?php
                            // Assuming you already have the database connection established ($pdo)
                            $query = "SELECT * FROM point_eau";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                            ?>
                            <!-- Add this inside the table body -->
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?= $row['id_point_eau'] ?></td>
                                    <td><?= $row['profondeur'] ?></td>
                                    <td><?= $row['date_installation'] ?></td>
                                    <td><?= $row['nature'] ?></td>
                                    <td><?= $row['cout_installation'] ?></td>
                                    <td><?= $row['localisation'] ?></td>
                                    <td><?= $row['importance'] ?></td>
                                    <td>
                                        <a href="point_eau-edit.php?id=<?= $row['id_point_eau'] ?>"><button name="edit_point_eau" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_point_eau'] ?>">Editer</button></a>
                                    </td>
                                    <td>
                                        <!-- Delete form -->
                                        <form style="border:0px; padding:0px;" action="./deletion/point_eau-delete.php" method="POST">
                                            <!-- Hidden input field to include id_point_eau  -->
                                            <input type="hidden" name="id_point_eau" value="<?= $row['id_point_eau'] ?>">
                                            <!-- Delete button -->
                                            <button name="delete_point_eau" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_point_eau'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
            </div>
        </div>
    </div>


<?php
   include_once 'footer.php';
   
   ?>














