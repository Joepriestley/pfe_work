<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';
?>
<body>
    <div class="container-fluid  pt-5" style="margin-top: 100px;">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Visite d'un Site</b>
                    </div>
                    <div class="card-body">
                        <form  action="./includes/visitesite.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Visite</b></span>
                                <div class="form-group col-md-6">
                                    <label for="datevisite">Date_Viste </label>
                                    <input name="datevisite" type="date" class="form-control" id="datevisite" placeholder="datevisite">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree</label>
                                    <input type="text" class="form-control" id="duree" name="duree" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="visiteengroupe">Visit_Groupe</label>
                                    <input type="text" class="form-control" name="visiteengroupe" id="visiteengroupe" placeholder="visiteengroupe_Partenaire">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="id_sitetouristique">Id_Site_Touristique</label>
                                    <input type="number" class="form-control" name="id_sitetouristique" id="id_sitetouristique" placeholder="id_sitetouristique">
                                </div>
                                
                                <div class="form-group col-md-12">
                                    <label for="id_touriste">Id_Touriste</label>
                                    <input type="text" class="form-control" id="id_touriste"  name="id_touriste" placeholder="visiteengroupe_Partenaire">
                                </div>
                                
                            </div>
                            <div class="form-row">
                                 
                            <br><br></div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                    
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Date_Viste</th>
                            <th>Duree</th>
                            <th>Visit_Groupe</th>
                            <th>Id_Site_Touristique</th>
                            <th>Id_Touriste</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->
                        <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM visitesite";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['datevisite'] ?></td>
                                <td><?= $row['duree'] ?></td>
                                <td><?= $row['visiteengroupe'] ?></td>
                                <td><?= $row['id_sitetouristique'] ?></td>
                                <td><?= $row['id_touriste'] ?></td>
                                <td>
                                    <?php
                                    $id_sitetouristique = $row['id_sitetouristique'];
                                    $id_touriste = $row['id_touriste'];
                                    $editLink = "visitesite-edit.php?id_sitetouristique=$id_sitetouristique&id_touriste=$id_touriste";
                                    ?>
                                    <a href="<?= $editLink ?>"><button name="edit_visitesite" class="edit-btn btn" style="background-color:rgb(61,131,97,1);">Editer</button></a>
                                </td>
                                <td>

                                    <form style="border:0px; padding:0px;" action="./deletion/utilise-delete.php" method="POST">
                                        <!-- Hidden input fields to include id_sitetouristique and id_touriste -->
                                        <input type="hidden" name="id_sitetouristique" value="<?= $row['id_sitetouristique'] ?>">
                                        <input type="hidden" name="id_touriste" value="<?= $row['id_touriste'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_visitesite" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_sitetouristique'] . '_' . $row['id_touriste'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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














