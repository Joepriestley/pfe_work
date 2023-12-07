<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

$query = "SELECT id_point_eau, nom_point_eau FROM point_eau";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
json_encode($data);
?>



<div class="container-fluid pt-5" style="margin-top:90px;">
    <div class="row">
        <div class="col-5">
            <div class="card">

                <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                    <b> Elements Amenagement</b>
                </div>
                <div class="card-body">
                    <form action="./includes/ref_point_eau.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                        <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Refection de Point Eau</b></span>
                            <div class="form-group col-md-12">
                                <label for="nom_point_eau">Nom Point Eau</label>
                                <select name="nom_point_eau" class="form-control" id="nom_point_eau_select">

                                    <?php

                                    foreach ($data as $data) {
                                        echo "<option value=\"{$data['id_point_eau']}\">{$data['nom_point_eau']}</option>";
                                    }
                                    ?>
                                </select>
                                <?php ?>
                            </div>


                            <div id="id_input" class="form-group col-md-12">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="date_refection">Date_Refection</label>
                                <input name="date_refection" type="date" class="form-control" id="date_refection" placeholder="Date de la réfection">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="executeur">Executeur</label>
                                <input name="executeur" type="text" class="form-control" id="executeur" placeholder="L'exécuteur de l'eau">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="cout_amengt">Cout Amenagement</label>
                                <input name="cout_amengt" type="number" class="form-control" id="cout_amengt" placeholder="Le coût de l'action">
                            </div>

                        </div>

                        <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>

                    </form>

                </div>
            </div>
        </div>
        <div class="col-md-7">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-item nav-link active btn btn-success text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Table Point Eau</button>
                    <button class="nav-item nav-link  btn btn-success text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true">Table Refection Point Eau</button>

                    <a href="amenagement.php"><button class="nav-item nav-link  btn btn-secondary text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-profile-tab" href="#nav-profile">Saisir Donnees de Point Eau</button></a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <table class="table table-striped">
                        <thead class="table-success">
                            <tr>
                                <th>ID Point Eau</th>
                                <th>Profondeur (m)</th>
                                <th>Date Installation</th>
                                <th>Nature</th>
                                <th>Cout Installation (dhs)</th>
                                <th>Localisation</th>
                                <th>Importance</th>
                                <th>Editer</th>
                                <th>Effacer</th>
                            </tr>
                        </thead>
                        <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                            <!-- Table rows will be dynamically added here -->
                            <?php
                            // Assuming you already have the database connection established ($pdo)
                            $query = "SELECT * FROM point_eau";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                            ?>
                            <!-- Add this inside the table body -->
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?= $row['id_point_eau'] ?></td>
                                    <td><?= $row['profondeur'] ?></td>
                                    <td><?= $row['date_installation'] ?></td>
                                    <td><?= $row['nature'] ?></td>
                                    <td><?= $row['cout_installation'] ?></td>
                                    <td><?= $row['localisation'] ?></td>
                                    <td><?= $row['importance'] ?></td>
                                    <td>
                                        <a href="point_eau-edit.php?id=<?= $row['id_point_eau'] ?>"><button name="edit_point_eau" class="edit-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_point_eau'] ?>">Editer</button></a>
                                    </td>
                                    <td>
                                        <!-- Delete form -->
                                        <form style="border:0px; padding:0px;" action="./deletion/point_eau-delete.php" method="POST">
                                            <!-- Hidden input field to include id_point_eau  -->
                                            <input type="hidden" name="id_point_eau" value="<?= $row['id_point_eau'] ?>">
                                            <!-- Delete button -->
                                            <button name="delete_point_eau" class="delete-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_point_eau'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
                                <th>ID Point Eau</th>
                                <th>date_refection</th>
                                <th>executeur</th>
                                <th>Cout Amenagement</th>
                                <th>Nom Point Eau</th>
                                <th>Editer</th>
                                <th>Effacer</th>
                            </tr>
                        </thead>
                        <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                            <!-- Table rows will be dynamically added here -->
                            <?php
                            // Assuming you already have the database connection established ($pdo)
                            $query = "SELECT * FROM ref_point_eau";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                            ?>
                            <!-- Add this inside the table body -->
                            <?php foreach ($results as $row) : ?>
                                <tr>
                                    <td><?= $row['id_ref_point_eau'] ?></td>
                                    <td><?= $row['date_refection'] ?></td>
                                    <td><?= $row['executeur'] ?></td>
                                    <td><?= $row['cout_amengt'] ?></td>
                                    <td><?= $row['nom_point_eau'] ?></td>
                                    <td>
                                        <a href="refection_point_eau-edit.php?id=<?= $row['id_ref_point_eau'] ?>"><button name="edit_point_eau" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_ref_point_eau'] ?>">Editer</button></a>
                                    </td>
                                    <td>
                                        <!-- Delete form -->
                                        <form style="border:0px; padding:0px;" action="./deletion/ref_point_eau-delete.php" method="POST">
                                            <!-- Hidden input field to include id_ref_point_eau  -->
                                            <input type="hidden" name="id_ref_point_eau" value="<?= $row['id_ref_point_eau'] ?>">
                                            <!-- Delete button -->
                                            <button name="delete_ref_point_eau" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_ref_point_eau'] ?>" onclick="return confirm('Etes vous sur d\'effacer cette ligne?');">Effacer</button>
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
    const selectElement = document.getElementById('nom_point_eau_select');
    const idInputDiv = document.getElementById('id_input');

    // Adding an event listener to the selected element 
    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectValue = selectedOption.value; // Corrected from selectedOption.setFormHTML
        const selectedText = selectedOption.text;

        const id_elt = `
            <label for="id_ref_point_eau">ID Point Eau</label>
            <input name="id_ref_point_eau" type="text" value="` + selectValue + `|` + selectedText + `" class="form-control" id="id_ref_point_eau" placeholder="Saisir l'identifiant du point eau" readonly>
        `
        idInputDiv.innerHTML = id_elt;
    })
</script>


<?php
include_once 'footer.php';

?>