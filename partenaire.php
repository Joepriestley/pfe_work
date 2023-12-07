<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>
<div class="container-fluid  pt-5" style="margin-top: 90px;">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                    <b> Les Partenaires Du PNSM</b>
                </div>
                <div class="card-body">
                    <form action="./includes/partenaire.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>

                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Les Partenatriat</b></span>
                            <div class="form-group col-md-6">
                                <label for="responsable">Responsable</label>
                                <input type="text" name="responsable" class="form-control" id="responsable" placeholder="Responsable_Partenariat">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="objectifpartenariat">Objectif_Partenariat </label>
                                <input type="text" class="form-control" id="objectifpartenariat" name="objectifpartenariat" placeholder="objectifpartenariat">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="adresse">Adresse_Partenaire</label>
                                <input type="text" class="form-control" name="adresse" id="adresse" placeholder="Adresse_Partenaire">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telephone">Tel_Partenaire </label>
                                <input type="tel" class="form-control" name="telephone" id="telephone"  placeholder="123-456-7890">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="fax">Fax_Partenaire </label>
                                <input type="tel" class="form-control" id="fax" name="fax" placeholder="123-456-7890">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="datesignpart">Date_Signature_Partenariat</label>
                                <input type="date" class="form-control" id="datesignpart" name="datesignpart" placeholder="Date de Signature de Partenariat">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nompartenaire">Nom_Partenaire</label>
                                <select name="nompartenaire" id="nompartenaire" class="form-control">
                                    <option value="">**Choissisez un Organisme**</option>
                                    <option value="GTZ" title="Deutsche Gesellschaft für Internationale Zusammenarbeit">GTZ</option>
                                    <option value="NPS" title="National Park Service">NPS</option>
                                    <option value="BirdLife" title="BirdLife International">BirdLife</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nationalite">Nationalite_Partenaire</label>
                                <select name="nationalite" id="nationalite" class="form-control">
                                    <option value="">**Choissisez une Nationalite**</option>
                                    <option value="Allemande">Allemande</option>
                                    <option value="U S A" title="Etats Unies d'Ameriques">U S A</option>
                                    <option value="Cambridge" title="Cambridge de UK">Cambridge</option>
                                </select>
                            </div>

                        </div>
                        <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table-striped">
                <thead class="table table-success">
                    <tr>
                        <th>Nom Partenaire</th>
                        <th>Nationalite Partenaire</th>
                        <th>Responsable</th>
                        <th>Adresse Partenaire</th>
                        <th>Tel Partenaire</th>
                        <th>Objectif Partenariat</th>
                        <th>Date Signature</th>
                        <th>Fax Partenaire</th>
                        <th>Editer</th>
                        <th>Effacer</th>
                    </tr>
                </thead>
                <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                    <!-- Table rows will be dynamically added here -->
                    <?php
                    // Assuming you already have the database connection established ($pdo)
                    $query = "SELECT * FROM partenaire";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                    ?>

                    <!-- Add this inside the table body -->
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= $row['nompartenaire'] ?></td>
                            <td><?= $row['nationalite'] ?></td>
                            <td><?= $row['responsable'] ?></td>
                            <td><?= $row['adresse'] ?></td>
                            <td><?= $row['telephone'] ?></td>
                            <td><?= $row['objectifpartenariat'] ?></td>
                            <td><?= $row['datesignpart'] ?></td>
                            <td><?= $row['fax'] ?></td>
                            <td>
                                <a href="partenaire-edit.php?id=<?= $row['nompartenaire'] ?>"><button name="edit_partenaire" class="edit-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['nompartenaire'] ?>">Editer</button></a>
                            </td>
                            <td>

                                <!-- Delete form -->
                                <form style="border:0px; padding:0px;" action="./deletion/partenaire-delete.php" method="POST">
                                    <!-- Hidden input field to include nompartenaire -->
                                    <input type="hidden" name="nompartenaire" value="<?= $row['nompartenaire'] ?>">
                                    <!-- Delete button -->
                                    <button name="delete_partenaire" class="delete-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['nompartenaire'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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