<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';



?>

<body>
    <div class="container-fluid  pt-5" style="margin-top: 50px;">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                        <b> Le Sol du PNSM</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/sol.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                            <?php if (isset($_GET['message'])) { ?>
                                <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Les Sols</b></span>
                                <div class="form-group col-md-6">
                                    <label for="codemunsell">Code Munsell</label>
                                    <input type="text" name="codemunsell" class="form-control" id="codemunsell" placeholder="codemunsell_Partenariat">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomsol">Nom Sol </label>
                                    <input type="text" class="form-control" id="nomsol" name="nomsol" placeholder="nomsol">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="groupe">Groupe_Sol</label>
                                    <input type="text" class="form-control" name="groupe" id="groupe" placeholder="groupe_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="couleur">Couleur </label>
                                    <input type="text" class="form-control" name="couleur" id="couleur" placeholder="couleur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="classe">Classe_Sol </label>
                                    <input type="text" class="form-control" id="classe" name="classe" placeholder="classe">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sousclasse">Sous_classe</label>
                                    <input type="text" class="form-control" id="sousclasse" name="sousclasse" placeholder="groupe_Partenaire">
                                </div>
                            </div>
                            <div class="form-row">

                            </div>
                            <button type="submit" name="submit" class="btn text-white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>codemunsell</th>
                            <th>nomsol </th>
                            <th>Groupe_Sol</th>
                            <th>Couleur du Sol</th>
                            <th>classe du Sol</th>
                            <th>Sousclasse</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->
                        <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM sol";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['codemunsell'] ?></td>
                                <td><?= $row['nomsol'] ?></td>
                                <td><?= $row['groupe'] ?></td>
                                <td><?= $row['couleur'] ?></td>
                                <td><?= $row['classe'] ?></td>
                                <td><?= $row['sousclasse'] ?></td>
                                <td>
                                    <a href="sol-edit.php?id=<?= $row['codemunsell'] ?>"><button name="edit_sol" class="edit-btn btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['codemunsell'] ?>">Editer</button></a>
                                </td>
                                <td>

                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/sol-delete.php" method="POST">
                                        <!-- Hidden input field to include codemunsell -->
                                        <input type="hidden" name="codemunsell" value="<?= $row['codemunsell'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_sol" class="delete-btn text-white" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['codemunsell'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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