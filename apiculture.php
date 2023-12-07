<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<div class="container-fluid pt-5" style="margin-top: 50px;">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                    <b>Les Activites</b>
                </div>
                <div class="card-body ">
                    <form action="./includes/apiculture.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Apiculture</b></span>
                            <!-- <div class="form-group col-md-6">
                                    <label for="codeactivite">code Activite</label>
                                    <input name="codeactivite" type="text" class="form-control" id="codeactivite" placeholder="code Activite">
                                </div> -->
                            <div class="form-group col-md-12">
                                <label for="annee">Annee Activite </label>
                                <input type="month" class="form-control" id="annee" name="annee" min="2019-07" value="2018-07" placeholder="annee d'activite">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombrepratiquant">Nombre pratiquant</label>
                                <input name="nombrepratiquant" type="number" class="form-control" id="nombrepratiquant" placeholder="nombrepratiquant">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="rendement">Rendement (Kg)</label>
                                <input name="rendement" type="number" class="form-control" id="rendement" placeholder="Rendement">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nombreruches">nombreruches</label>
                                <input name="nombreruches" type="text" class="form-control" id="nombreruches" placeholder="nombreruches">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="douar">douar</label>
                                <select name="douar" id="douar" class="form-control">
                                    <option value="">--Choissisez l'identifiant de douar--</option>
                                    <option value="Larjam">Larjam(1)</option>
                                    <option value="Sidi Boulafdail">Sidi Boulafdail(2)</option>
                                    <option value="Aghrimaz">Aghrimaz(3)</option>
                                    <option value="Sidi Binzaren">Sidi Binzaren(4)</option>
                                    <option value="Sidi Oussay">Sidi Oussay(5)</option>
                                    <option value="Sidi R'bat">Sidi Rbat(6)</option>
                                    <option value="Ifaryane">Ifaryane(7)</option>
                                    <option value="Douira">Douira(8)</option>
                                    <option value="Tifnit">Tifnit(9)</option>
                                    <option value="Sidi Toualnon">Sidi Toualnon(10)</option>
                                </select>
                            </div>

                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn text-white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                    </form>
                    <br>
                    
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table-striped bg-white">
                <thead class="table-success">
                    <tr class="">
                        <th>code Activite</th>
                        <th>Annee Activite</th>
                        <th>Nombre pratiquant</th>
                        <th>Rendement</th>
                        <th>nombreruches</th>
                        <th>Douar</th>
                        <th>Commentaire</th>
                        <th>Editer</th>
                        <th>Effacer</th>
                    </tr>
                </thead>
                <tbody id="circuitTable" class="text-dark border">
                    <!-- Table rows will be dynamically added here -->
                    <?php
                    // Assuming you already have the database connection established ($pdo)
                    $query = "SELECT * FROM apiculture";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                    ?>

                    <!-- Add this inside the table body -->
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= $row['codeactivite'] ?></td>
                            <td><?= $row['annee'] ?></td>
                            <td><?= $row['nombrepratiquant'] ?></td>
                            <td><?= $row['rendement'] ?></td>
                            <td><?= $row['nombreruches'] ?></td>
                            <td><?= $row['douar'] ?></td>
                            <td><?= $row['commentaire'] ?></td>
                            <td>
                                <a href="apiculture-edit.php?id=<?= $row['codeactivite'] ?>"><button name="edit_apiculture" class="edit-btn btn"  style="background-color:rgb(61,131,97,1);" data-id="<?= $row['codeactivite'] ?>">Editer</button></a>
                            </td>
                            <td>
                                <!-- Delete form -->
                                <form style="border:0px; padding:0px;" action="./deletion/apiculture-delete.php" method="POST">
                                    <!-- Hidden input field to include codeactivite -->
                                    <input type="hidden" name="codeactivite" value="<?= $row['codeactivite'] ?>">
                                    <!-- Delete button -->
                                    <button name="delete_apiculture" class="delete-btn text-white" style="background-color:rgb(61,131,97,1);" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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