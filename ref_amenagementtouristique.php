<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

$query = "SELECT id_amengttour,nom_amenagttour FROM amenagement_touristiques";
$stmt = $pdo->query($query);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
json_encode($data);
?>
<div class="container-fluid pt-5" style="margin-top: 50px;">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                    <b> Elements Amenagement</b>
                </div>
                <div class="card-body">
                    <form action="./includes/ref_amenagementtour.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b> Refection Amenagement Touristique</b></span>

                            <div class="form-group col-md-12">
                                <label for="nom_amenagementtour">Nom Amenage. Touristique</label>
                                <select name="nom_amenagementtour" type="text" class="form-control" id="nom_amenagementtour_select">
                                    <?php

                                    foreach ($data as $data) {
                                        echo "<option value=\"{$data['id_amengttour']}\">{$data['nom_amenagttour']}</option>";
                                    }
                                    ?>
                                </select>
                                <?php ?>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="responsable">Responsable Amenagement Touristique</label>
                                <input name="responsable" type="text" class="form-control" id="responsable" placeholder="responsable de l'amenagement touristique">
                            </div>
                            <div id="id_input" class="form-group col-md-12">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nature">Nature</label>
                                <input name="nature" type="text" class="form-control" id="nature" placeholder="nature de gestion">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date_refection">Date Refection</label>
                                <input name="date_refection" type="date" class="form-control" id="date_refection" placeholder="date_refection de gestion">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cout_amengt">Cout Amenagement</label>
                                <input name="cout_amengt" type="text" class="form-control" id="cout_amengt" placeholder="Saissir le cout de gestion">
                            </div>

                        </div>

                        <button type="submit" name="submit" class="btn text-white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-7">


            <div class="col-md-12" style="margin-top: 30px;">
           
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-item nav-link active btn text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true" title="Table Amenagement Touristique"> Amen.Tour.</button>
                        <button class="nav-item nav-link  btn text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="true" title="Table de Refection Amenagement Touristique">Refection Amen.Tour.</button>

                        <a href="amenagement.php"><button class="nav-item nav-link  btn  text-white" style="background-color:rgb(61,131,97,0.7);" id="nav-profile-tab" href="#nav-profile" title="Aller au formuliare de saisir de donnees amenagement touristique">Saisir Donnees de Amen.Touristique</button></a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <table class="table table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>identifiant</th>
                                    <th>Type</th>
                                    <th>Responsable </th>
                                    <th>Periode</th>
                                    <th>Date_Creation</th>
                                    <th>Cout_Creation</th>
                                    <th>Editer</th>
                                    <th>Effacer</th>
                                </tr>
                            </thead>
                            <tbody id="circuitTable">
                                <!-- Table rows will be dynamically added here -->

                                <?php
                                // Assuming you already have the database connection established ($pdo)
                                $query = "SELECT * FROM amenagement_touristiques";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                                ?>

                                <!-- Add this inside the table body -->
                                <?php foreach ($results as $row) : ?>
                                    <tr>
                                        <td><?= $row['id_amengttour'] ?></td>
                                        <td><?= $row['type'] ?></td>
                                        <td><?= $row['responsable'] ?></td>
                                        <td><?= $row['periode'] ?></td>
                                        <td><?= $row['date_cree'] ?></td>
                                        <td><?= $row['cout_creaction'] ?></td>
                                        <td>
                                            <a href="amenagementtouristique-edit.php?id=<?= $row['id_amengttour'] ?>"><button name="edit_amenagementtour" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_amengttour'] ?>">Editer</button></a>
                                        </td>
                                        <td>
                                            <button name="delete_amenagementtour" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_amengttour'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
                                    <th>identifiant</th>
                                    <th>Nature</th>
                                    <th>Responsable </th>
                                    <th>Periode</th>
                                    <th>Cout_Creation</th>
                                    <th>Nom Amenagement Touristique</th>
                                    <th>Editer</th>
                                    <th>Effacer</th>
                                </tr>
                            </thead>
                            <tbody id="circuitTable">
                                <!-- Table rows will be dynamically added here -->

                                <?php
                                // Assuming you already have the database connection established ($pdo)
                                $query = "SELECT * FROM ref_amenagement_touristique";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute();
                                $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                                ?>

                                <!-- Add this inside the table body -->
                                <?php foreach ($results as $row) : ?>
                                    <tr>
                                        <td><?= $row['id_ref_amengt_tour'] ?></td>
                                        <td><?= $row['nature'] ?></td>
                                        <td><?= $row['responsable'] ?></td>
                                        <td><?= $row['date_refection'] ?></td>
                                        <td><?= $row['cout_amengt'] ?></td>
                                        <td><?= $row['nom_amenagementtour'] ?></td>
                                        <td>
                                            <a href="ref_amenagementtouristique-edit.php?id=<?= $row['id_ref_amengt_tour'] ?>"><button name="edit_amenagementtour" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_ref_amengt_tour'] ?>">Editer</button></a>
                                        </td>
                                        <td>
                                            <!-- Delete form -->
                                            <form style="border:0px; padding:0px;" action="./deletion/ref_amenagementtour-delete.php" method="POST">
                                                <!-- Hidden input field to include id_piste -->
                                                <input type="hidden" name="id_ref_amengt_tour" value="<?= $row['id_ref_amengt_tour'] ?>">
                                                <!-- Delete button -->
                                                <button name="delete_amenagementtour" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_ref_amengt_tour'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
    const selectElement = document.getElementById('nom_amenagementtour_select');
    const idInputDiv = document.getElementById('id_input');

    // Adding an event listener to the selected element 
    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectValue = selectedOption.value; // Corrected from selectedOption.setFormHTML
        const selectedText = selectedOption.text;

        const id_elt = `

            <label for="id_ref_amengt_tour">ID Amenagement Touristique </label>
            <input name="id_ref_amengt_tour" type="text"  value="` + selectValue + `|` + selectedText + `" class="form-control" id="id_ref_amengt_tour" placeholder="Donnerr un numero d'identifiant" readonly>
        `
        idInputDiv.innerHTML = id_elt;
    })
</script>


<?php
include_once 'footer.php';

?>