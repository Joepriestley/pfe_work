<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white"  style="background-color:rgb(61,131,97,1);">
                      <b>Infrastructures Touristique</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/infrastruturetouristiq.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Infrastructures Touristique</b></span>
                                <div class="form-group col-md-6">
                                    <label for="id_infrastructure">Id_Infrastructure</label>
                                    <input type="number" class="form-control" id="id_infrastructure" name="id_infrastructure" placeholder="date de gestion">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nominfra">Nom Infrastructures </label>
                                    <input type="text" name="nominfra" class="form-control" id="nominfra" placeholder="nominfra">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="typeinfra">Type Infrastructure</label>
                                    <input type="text" name="typeinfra" class="form-control" id="typeinfra" placeholder="typeinfra">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="etatinfra">Etat Infrastructure </label>
                                    <input type="text" name="etatinfra" class="form-control" id="etatinfra" placeholder="etatinfra">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="localisation">Localisation</label>
                                    <input type="text" name="localisation" class="form-control" id="localisation" placeholder="localisation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datecontruction">Date Construction </label>
                                    <input type="date" name="datecontruction" class="form-control" id="datecontruction" placeholder="Date Construction">
                                </div>
                            </div>
                            <div class="form-row">
                                
                    
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Commentaire</span>
                                    </div>
                                    <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                                </div>
                            </div>
                            <br><br><button type="submit" name="submit" class="btn text-white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr >
                            <th>Id Infra</th>
                            <th>Nom Infra</th>
                            <th>Type Infra</th>
                            <th>Etat Infra</th>
                            <th>Localisation</th>
                            <th>Date Const.</th>
                            <th>Commentaire</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->


                        <?php
                            // Assuming you already have the database connection established ($pdo)
                            $query = "SELECT * FROM infrastructure_touristique";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                            ?>

                            <!-- Add this inside the table body -->
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?= $row['id_infrastructure'] ?></td>
                                    <td><?= $row['nominfra'] ?></td>
                                    <td><?= $row['typeinfra'] ?></td>
                                    <td><?= $row['etatinfra'] ?></td>
                                    <td><?= $row['localisation'] ?></td>
                                    <td><?= $row['datecontruction'] ?></td>
                                    <td><?= $row['commentaire'] ?></td>
                                    <td>
                                        <a href="infrastruturetouristiq-edit.php?id=<?= $row['id_infrastructure'] ?>"><button name="edit_infratour" class="edit-btn btn text-white"  style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_infrastructure'] ?>">Editer</button></a>
                                    </td>
                                    <td>
                                        <button name="delete_infratour" class="delete-btn btntext-white"  style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_infrastructure'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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














