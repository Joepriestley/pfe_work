<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<div class="container-fluid mt-4 pt-5">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                    <b>Les Associaions</b>
                </div>
                <div class="card-body">
                    <form action="./includes/association.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Identification Circuit</b></span>
                            <div class="form-group col-md-6">
                                <label for="nomassociation">Nom_Association</label>
                                <input name="nomassociation" type="text" class="form-control" id="nomassociation" placeholder="Nom_Circuit">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nompresident">President </label>
                                <input name="nompresident" type="text" class="form-control" id="nompresident" placeholder="categorie du circuit">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="adresse">Adresse</label>
                                <input name="adresse" type="text" class="form-control" id="adresse" placeholder="adresse">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="objectif">Objectif_Association</label>
                                <input name="objectif" type="text" class="form-control" id="objectif" placeholder="Objectif association">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="id_douar">Id_douar</label>
                                <input name="id_douar" type="text" class="form-control" id="id_douar" placeholder="id_douar">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="moyens">Moyens</label>
                                <input name="moyens" type="text" class="form-control" id="moyens" placeholder="moyens">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="datecreation">Date_Creation</label>
                                <input name="datecreation" type="date" class="form-control" id="datecreation" placeholder="datecreation">
                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
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
                        <th>Nom Association</th>
                        <th>President</th>
                        <th>Adresse</th>
                        <th>Objectif Association</th>
                        <th>Id Douar</th>
                        <th>Moyens</th>
                        <th>Date Creation</th>
                        <th>Commentaire</th>
                        <th>Editer</th>
                        <th>Effacer</th>
                    </tr>
                </thead>
                <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                    <!-- Table rows will be dynamically added here -->

                    <?php
                    // Assuming you already have the database connection established ($pdo)
                    $query = "SELECT * FROM association";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                    ?>

                    <!-- Add this inside the table body -->
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= $row['nomassociation'] ?></td>
                            <td><?= $row['nompresident'] ?></td>
                            <td><?= $row['adresse'] ?></td>
                            <td><?= $row['datecreation'] ?></td>
                            <td><?= $row['objectif'] ?></td>
                            <td><?= $row['id_douar'] ?></td>
                            <td><?= $row['moyens'] ?></td>
                            <td><?= $row['commentaire'] ?></td>
                            <td>
                                <a href="association-edit.php?id=<?= $row['nomassociation'] ?>"><button name="edit_association" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['nomassociation'] ?>">Editer</button></a>
                            </td>
                            <td>
                                <button name="delete_association" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['nomassociation'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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