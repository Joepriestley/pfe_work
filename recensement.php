<?php

include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>

<body style="background-color: darksalmon;">
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                        <b>Recensement Sur Les especes Animales</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/recensement.inc.php" id="actionForm" style="background-color: rgb(201, 216, 214);" method="post">
                            <?php if (isset($_GET["message"])) { ?>
                                <p class="message"><?php echo $_GET["message"]; ?></p>
                            <?php } ?>


                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Recensement</b></span>
                                <div class="form-group col-md-6">
                                    <label for="effectifmales">Effectif males</label>
                                    <input name="effectifmales" type="number" class="form-control" id="effectifmales" placeholder="Id action">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="effectiffemelles">Effecti Femmelles </label>
                                    <input name="effectiffemelles" type="number" class="form-control" id="effectiffemelles" placeholder="effectiffemelles">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="effectifjeunes">Effectif Jeunes</label>
                                    <input name="effectifjeunes" type="number" class="form-control" id="effectifjeunes" placeholder="effectifjeunes">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="effectiftotal">Effectif Total </label>
                                    <input name="effectiftotal" type="number" class="form-control" id="effectiftotal" placeholder="Lieu ou l'action se passe">
                                </div>
                            </div>
                            <span class="form-control text-center bg-dark text-white"><b>Comportement</b></span>
                            <div>

                                <div class="form-group col-md-12">
                                    <label for="vitessedeplacement">Vitesse_Deplacement </label>
                                    <input name="vitessedeplacement" type="text" class="form-control" id="vitessedeplacement" placeholder="Vitesse_Deplacement">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="espece_animale">Espece Animaale </label>
                                    <input name="espece_animale" type="text" class="form-control" id="espece_animale" placeholder="especes animale">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="id_faune_suivi"">Identiant Suivi</label>
                                <input name=" id_faune_suivi" type="text" class="form-control" id="id_faune_suivi"" placeholder=" identifiant">
                                </div>
                                <div class="form-row">
                                    <div class="input-group col-md-12">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Commentaire</span>
                                        </div>
                                        <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'espece"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="id_recensement"">Id_Recensement</label>
                                <input name=" id_recensement" type="number" class="form-control" id="id_recensement"" placeholder=" identifiant">
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6 ">
                <table class="table table-striped">
                    <thead class="table-primary">
                        <tr>
                            <th>Effectif Males</th>
                            <th>Effectif Femmelles</th>
                            <th>Effectif Jeunes</th>
                            <th>Effectif Total</th>
                            <th>Vitesse Deplacement</th>
                            <th>Commentaire</th>
                            <th>Espece Animaale</th>
                            <th>Identiant Suivi</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="actionTable" class="table table-white text-dark bg-white table-striped">
                        <!-- Table rows will be dynamically added here -->
                        <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM recensement";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['effectifmales'] ?></td>
                                <td><?= $row['effectiffemelles'] ?></td>
                                <td><?= $row['effectifjeunes'] ?></td>
                                <td><?= $row['effectiftotal'] ?></td>
                                <td><?= $row['vitessedeplacement'] ?></td>
                                <td><?= $row['commentaire'] ?></td>
                                <td><?= $row['espece_animale'] ?></td>
                                <td><?= $row['id_faune_suivi'] ?></td>
                                <td>
                                    <?php
                                    $espece_animale = $row['espece_animale'];
                                    $id_faune_suivi = $row['id_faune_suivi'];
                                    $editLink = "recensement-edit.php?espece_animale=$espece_animale&id_faune_suivi=$id_faune_suivi";
                                    ?>
                                    <a href="<?= $editLink ?>"><button name="edit_recensement" class="edit-btn btn" style="background-color:rgb(61,131,97,1);">Editer</button></a>
                                </td>


                                <td>

                                    <form style="border:0px; padding:0px;" action="./deletion/recensement-delete.php" method="POST">
                                        <!-- Hidden input fields to include espece_animale and id_faune_suivi -->
                                        <input type="hidden" name="espece_animale" value="<?= $row['espece_animale'] ?>">
                                        <input type="hidden" name="id_faune_suivi" value="<?= $row['id_faune_suivi'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_recensement" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['espece_animale'] . '_' . $row['id_faune_suivi'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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