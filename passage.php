<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';
?>

<body>
    <div class="container-fluid pt-5" style="margin-top: 100px;">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                        <b> Le Passage d'circuit</b>
                    </div>
                    <div class="card-body">
                       <br> <form action="./includes/passage.inc.php" id="circuittouristForm"
                            style="background-color: rgb(201, 216, 214);" method="post">
                            <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                            <div class="form-row">
                               <br><br> <span class="form-control text-center bg-dark text-white"><b> Le Passage de Circuit</b></span>
                               <br><br> <div class="form-group col-md-6">
                                    <label for="datepassage">Date Passee</label>
                                    <input type="date" name="datepassage" class="form-control" id="datepassage"
                                        placeholder="datepassage">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree_Passage</label>
                                    <input type="text" class="form-control" id="duree" name="duree" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_circuittour">Id_Circuit</label>
                                    <input type="text" class="form-control" name="id_circuittour" id="id_circuittour"
                                        placeholder="id_circuittour">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_touriste">Id_touriste</label>
                                    <input type="text" class="form-control" name="id_touriste" id="id_touriste"
                                        placeholder="id_touriste">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="en_groupe">En_groupe</label>
                                    <select name="en_groupe" id="en_groupe" class="form-control">
                                        <option value="">En groupe ?</option>
                                        <option value="oui">oui</option>
                                        <option value="non">non</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                            </div>
                           <br><br> <button type="submit" name="submit" class="btn text-white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Date Passee</th>
                            <th>Duree_Passage</th>
                            <th>En_groupe</th>
                            <th>id_touriste</th>
                            <th>Id_Circuit</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="passageTable" class="table table-white bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->
                        <?php
                        $query = "SELECT * FROM passe";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['datepassage'] ?></td>
                                <td><?= $row['duree'] ?></td>
                                <td><?= $row['en_groupe'] ?></td>
                                <td><?= $row['id_touriste'] ?></td>
                                <td><?= $row['id_circuittour'] ?></td>
                                <td>
                                    <a href="passage-edit.php?id=<?= $row['datepassage'] ?>"><button name="edit_passage" class="edit-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['datepassage'] ?>">Editer</button></a>
                                </td>
                                <td>
                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/passage-delete.php" method="POST">
                                        <!-- Hidden input field to include datepassage -->
                                        <input type="hidden" name="datepassage" value="<?= $row['datepassage'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_passage" class="delete-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['datepassage'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
</body>
