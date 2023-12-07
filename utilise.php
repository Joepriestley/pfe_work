<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>
<body>
    <div class="container-fluid pt-5" style="margin-top: 90px;">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Utilisation d'Infrastructure Touristique</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/utilise.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                               <br><br> <span class="form-control text-center bg-dark text-white"><b>Utilisation</b></span>
                               <br><br> <div class="form-group col-md-6">
                                    <label for="dateutilisation">Date Utilisee</label>
                                    <input type="date" name="dateutilisation" class="form-control" id="dateutilisation" placeholder="dateutilisation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree </label>
                                    <input type="text" class="form-control" id="duree" name="duree" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appreciation">Appreciation</label>
                                    <input type="text" class="form-control" name="appreciation" id="appreciation" placeholder="appreciation_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_infrastructure">Id_Infrastructure </label>
                                    <input type="number" class="form-control" name="id_infrastructure" id="id_infrastructure" placeholder="id_infrastructure">
                                </div>
            
                                <div class="form-group col-md-6">
                                    <label for="id_touriste">Id_Touriste</label>
                                    <input type="text" class="form-control" id="id_touriste"  name="id_touriste" placeholder="appreciation_Partenaire">
                                </div>
                            </div>
                            <div class="form-row">
                               
                                
                            </div>
                            <br><br><button type="submit" name="submit" class="btn text white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Date Utilisee</th>
                            <th>Duree </th>
                            <th>Appreciation</th>
                            <th>Id_Infrastructure</th>
                            <th>Id_Touriste</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->


                         <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM utilise";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['dateutilisation'] ?></td>
                                <td><?= $row['duree'] ?></td>
                                <td><?= $row['appreciation'] ?></td>
                                <td><?= $row['id_infrastructure'] ?></td>
                                <td><?= $row['id_touriste'] ?></td>
                                <td>
                                    <?php
                                    $id_infrastructure = $row['id_infrastructure'];
                                    $id_touriste = $row['id_touriste'];
                                    $editLink = "utilise-edit.php?id_infrastructure=$id_infrastructure&id_touriste=$id_touriste";
                                    ?>
                                    <a href="<?= $editLink ?>"><button name="edit_utilise" class="edit-btn btn btn-warning">Editer</button></a>
                                </td>


                                <td>

                                    <form style="border:0px; padding:0px;" action="./deletion/utilise-delete.php" method="POST">
                                        <!-- Hidden input fields to include id_infrastructure and id_touriste -->
                                        <input type="hidden" name="id_infrastructure" value="<?= $row['id_infrastructure'] ?>">
                                        <input type="hidden" name="id_touriste" value="<?= $row['id_touriste'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_utilise" class="delete-btn btn btn-danger" data-id="<?= $row['id_infrastructure'] . '_' . $row['id_touriste'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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














