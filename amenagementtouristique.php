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
                        <form action="./includes/amenagementtouristique.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Amenagement Touristique</b></span>
                                <div class="form-group col-md-6">
                                    <label for="type">Type Amenagement Touristique</label>
                                    <input name="type" type="text" class="form-control" id="type" name="type" placeholder="type d'amenagement touristique">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="resposable">Responsable Amenagement Touristique</label>
                                    <input name="resposable" type="text" class="form-control" id="resposable" placeholder="Resposable de l'amenagement touristique">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="id_amengttour">ID Amenagement Touristique </label>
                                    <input name="id_amegttour" type="text" class="form-control" id="id_amengttour" placeholder="Donnerr un numero d'identifiant">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="periode">Periode</label>
                                    <input name="periode" type="text" class="form-control" id="periode" placeholder="Periode de gestion">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="date_cree">Date_Creation</label>
                                    <input name="date_cree" type="date" class="form-control" id="date_cree" placeholder="date_cree de gestion">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_amengt">Cout Amenagement</label>
                                    <input name="cout_amengt" type="text" class="form-control" id="cout_amengt" placeholder="Saissir le cout de gestion">
                                </div>
                               
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
                            <th>identifiant</th>
                            <th>Type</th>
                            <th>Responsable </th>
                            <th>Periode</th>
                            <th>Cout Creation</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" >
                        <!-- Table rows will be dynamically added here -->

                        <?php
                            // Assuming you already have the database connection established ($pdo)
                            $query = "SELECT * FROM amenagement_touristiques";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                            ?>

                            <!-- Add this inside the table body -->
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?= $row['id_amengttour'] ?></td>
                                    <td><?= $row['type'] ?></td>
                                    <td><?= $row['responsable'] ?></td>
                                    <td><?= $row['periode'] ?></td>
                                    <td><?= $row['cout_creation'] ?></td>
                                    <td>
                                        <a href="amenagementtouristique-edit.php?id=<?= $row['id_amengttour'] ?>"><button name="edit_amenagementtour" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_amengttour'] ?>">Editer</button></a>
                                    </td>
                                    <td>
                                        <button name="delete_amenagementtour" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_amengttour'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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













