<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<body>
    <div class="container-fluid pt-5" style="margin-top:115px;">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Executeur du Projet</b>
                    </div>
                    <div class="card-body ">
                        <form action="./includes/executeur.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Executeur</b></span>
                                <div class="form-group col-md-6">
                                    <label for="numerocin">Numero_CIN</label>
                                    <input name="numerocin" type="text" class="form-control" id="numerocin" placeholder="numerocin">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomexecuteur">Nom_Executeur</label>
                                    <input name="nomexecuteur" type="text" class="form-control" id="nomexecuteur" name="nomexecuteur" placeholder="nomexecuteur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenomexecuteur">Prenom_Executeur</label>
                                    <input name="prenomexecuteur" type="text" class="form-control" name="prenomexecuteur" id="prenomexecuteur" placeholder="prenomexecuteur_Partenaire">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="qualiteexecuteur">Quality_Executeur </label>
                                    <input name="qualiteexecuteur" type="text" class="form-control" name="qualiteexecuteur" id="qualiteexecuteur" placeholder="qualiteexecuteur">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="adresse">Adresse</label>
                                    <input name="adresse" type="text" class="form-control" id="adresse"  name="adresse" placeholder="prenomexecuteur_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telephone">Telephone</label>
                                    <input name="telephone" type="tel" class="form-control" id="telephone" name="telephone" placeholder="telephone">
                                </div>
                                
                              
                               
                            </div>
                            <div class="form-row">
                               
                                
                            </div>
                            <button type="submit" name="submit" class="btn " style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped bg-success bg-white"">
                    <thead class="table-success">
                        <tr>
                            <th>Numero Cin</th>
                            <th>Nom Executeur</th>
                            <th>Prenom Executeur</th>
                            <th>Qualite Executeur</th>
                            <th>adresse</th>
                            <th>Telephone</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->

                        <?php
                            // Assuming you already have the database connection established ($pdo)
                            $query = "SELECT * FROM executeur";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                            ?>

                            <!-- Add this inside the table body -->
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?= $row['numerocin'] ?></td>
                                    <td><?= $row['nomexecuteur'] ?></td>
                                    <td><?= $row['prenomexecuteur'] ?></td>
                                    <td><?= $row['qualiteexecuteur'] ?></td>
                                    <td><?= $row['adresse'] ?></td>
                                    <td><?= $row['telephone'] ?></td>
                                    <td>
                                        <a href="executeur-edit.php?id=<?= $row['numerocin'] ?>"><button name="edit_executeur" class="edit-btn " style="background-color:rgb(61,131,97,1);" data-id="<?= $row['numerocin'] ?>">Editer</button></a>
                                    </td>
                                    <td>
                                        <button name="delete_executeur" class="delete-btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['numerocin'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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














