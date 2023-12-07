<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Elements Amenagement</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/clocture.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Cloture</b></span>
                               
                                <div class="form-group col-md-6">
                                    <label for="id_cloture">ID_Cloture</label>
                                    <input name="id_cloture" type="text" class="form-control" id="id_cloture" placeholder="id_cloture">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nom_cloture">nom_cloture</label>
                                    <input name="nom_cloture" type="text" class="form-control" id="nom_cloture" placeholder="nom_cloture">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_cloture">Date_Cloture</label>
                                    <input name="date_cloture" type="date" class="form-control" id="date_cloture" placeholder="date_cloture">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cout_creation">Cout_Creation</label>
                                    <input name="cout_creation" type="number" class="form-control" id="cout_creation" placeholder="cout_creation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nature">Nature</label>
                                    <input name="nature" type="text" class="form-control" id="nature" placeholder="nature">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="duree">Duree (Ans)</label>
                                <input name="duree" type="text" class="form-control" id="duree" placeholder="duree">
                            </div>
                            
                            <button type="submit"name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr >
                            <th>ID_Cloture</th>
                            <th>Date_Cloture</th>
                            <th>Cout_Creation</th>
                            <th>Nature</th>
                            <th>Duree</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped" >
                        <!-- Table rows will be dynamically added here -->
                         <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM clotures";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['id_cloture'] ?></td>
                                <td><?= $row['date_cloture'] ?></td>
                                <td><?= $row['cout_creation'] ?></td>
                                <td><?= $row['nature'] ?></td>
                                <td><?= $row['duree'] ?></td>  
                                <td>
                                    <a href="cloture-edit.php?id=<?= $row['id_cloture'] ?>"><button name="edit_cloture" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_cloture'] ?>">Editer</button></a>
                                </td>
                                <td>

                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/cloture-delete.php" method="POST">
                                        <!-- Hidden input field to include id_piste -->
                                        <input type="hidden" name="id_cloture" value="<?= $row['id_cloture'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_cloture" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_cloture'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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















