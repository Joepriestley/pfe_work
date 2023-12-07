<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

$query = "SELECT id_piste,_nom_piste FROM pistes";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
json_encode($data);

?>
<div class="container-fluid  pt-5" style="margin-top: 70px;">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                    <b> Elements Amenagement</b>
                </div>
                <div class="card-body">
                    <form action="./includes/ref_piste.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Refection Piste</b></span>

                            <div class="form-group col-md-12">
                                <label for="nom_piste">Nom_Piste</label>
                                <select name="nom_piste" type="text" class="form-control" id="nom_piste_select">
                                    <?php
                                    foreach ($data as $data) {
                                        echo "<option value=\"{$data['id_piste']}\">{$data['_nom_piste']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="id_input" class="form-group col-md-12">

                            </div>

                            <div class="form-group col-md-6">
                                <label for="date_refection">Date_Refection</label>
                                <input name="date_refection" type="date" class="form-control" id="date_refection" placeholder="date_refection">

                            </div>
                            <div class="form-group col-md-6">
                                <label for="cout_amengt">Cout_Amenagement (dhs)</label>
                                <input name="cout_amengt" type="number" class="form-control" id="cout_amengt" placeholder="cout_amengt">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="etat">etat</label>
                                <input name="etat" type="text" class="form-control" id="etat" placeholder="etat">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="executeur">Executeur</label>
                            <input name="executeur" type="text" class="form-control" id="executeur" placeholder="executeur">
                        </div>

                       <br><br> <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);" href="#nav-profile">Inserer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">



            <div class="col-md-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-item nav-link active btn text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Voir Table Piste</button>
                        <button class="nav-item nav-link btn text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Voir Refection Table Piste</button>
                        <a href="amenagement.php"><button class="btn text-white" style="background-color:rgb(61,131,97,0.7);">Saisir des Donnees de Piste</button></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">


                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>Id_Piste</th>
                                    <th>Longueur (km)</th>
                                    <th>Cout Creation(dhs)</th>
                                    <th>Accessibilite</th>
                                    <th>Date ouverture</th>
                                    <th>Id_Amenagement</th>
                                    <th>Editer</th>
                                    <th>Effacer</th>
                                </tr>
                            </thead>
                            <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                                <!-- Table rows will be dynamically added here -->
                                <?php
                                // Assuming you already have the database connection established ($pdo)
                                $query = "SELECT * FROM pistes";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                                ?>

                                <!-- Add this inside the table body -->
                                <?php foreach ($results as $row) : ?>
                                    <tr>
                                        <td><?= $row['id_piste'] ?></td>
                                        <td><?= $row['longueur'] ?></td>
                                        <td><?= $row['cout_creation'] ?></td>
                                        <td><?= $row['accessibilite'] ?></td>
                                        <td><?= $row['date_creation'] ?></td>
                                        <td><?= $row['_nom_piste'] ?></td>
                                        <td>
                                            <a href="pistes-edit.php?id=<?= $row['id_piste'] ?>"><button name="edit_pistes" class="edit-btn btn btn-warning" data-id="<?= $row['id_piste'] ?>">Editer</button></a>
                                        </td>
                                        <td>

                                            <!-- Delete form -->
                                            <form style="border:0px; padding:0px;" action="./deletion/pistes-delete.php" method="POST">
                                                <!-- Hidden input field to include id_piste -->
                                                <input type="hidden" name="id_piste" value="<?= $row['id_piste'] ?>">
                                                <!-- Delete button -->
                                                <button name="delete_piste" class="delete-btn btn btn-danger" data-id="<?= $row['id_piste'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
                                            </form>

                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>Id_Piste</th>
                                    <th>INom</th>
                                    <th>date_Refection</th>
                                    <th>Cout Amenagement (dhs)</th>
                                    <th>etat</th>
                                    <th>Executeur</th>
                                    <th>Editer</th>
                                    <th>Effacer</th>
                                </tr>
                            </thead>
                            <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                                <!-- Table rows will be dynamically added here -->
                                <?php
                                // Assuming you already have the database connection established ($pdo)
                                $query = "SELECT * FROM refection_pistes";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                                ?>

                                <!-- Add this inside the table body -->
                                <?php foreach ($results as $row) : ?>
                                    <tr>
                                        <td><?= $row['id_refection_piste'] ?></td>
                                        <td><?= $row['nom_piste'] ?></td>
                                        <td><?= $row['date_refection'] ?></td>
                                        <td><?= $row['cout_amengt'] ?></td>
                                        <td><?= $row['etat'] ?></td>
                                        <td><?= $row['executeur'] ?></td>
                                        <td>
                                            <a href="refection_pistes-edit.php?id=<?= $row['id_refection_piste'] ?>"><button name="edit_pistes" class="edit-btn btn btn-warning" data-id="<?= $row['id_refection_piste'] ?>">Editer</button></a>
                                        </td>
                                        <td>

                                            <!-- Delete form -->
                                            <form style="border:0px; padding:0px;" action="./deletion/pistes-delete.php" method="POST">
                                                <!-- Hidden input field to include id_refection_piste -->
                                                <input type="hidden" name="id_refection_piste" value="<?= $row['id_refection_piste'] ?>">
                                                <!-- Delete button -->
                                                <button name="delete_piste" class="delete-btn btn btn-danger" data-id="<?= $row['id_refection_piste'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
    </div>
</div>

<script>
    const selectElement = document.getElementById('nom_piste_select');
    const idInputDiv = document.getElementById('id_input');

    //adding an event listener t the selected element
    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectValue = selectedOption.value;
        const selectedText = selectedOption.text;

        const id_elt = `
        <label for="id_refection_piste">Id_Piste</label>
        <input name="id_refection_piste" type="text" value="` + selectValue + `|` + selectedText + `" class="form-control" id="id_refection_piste" placeholder="id_refection_piste" disabled>
           `
        idInputDiv.innerHTML = id_elt;

    })
</script>


<?php
include_once 'footer.php';

?>