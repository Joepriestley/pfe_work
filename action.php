<?php
$pdo = require_once './includes/dbConnect.php';

include_once 'header.php';
?>

<div class="container-fluid pt-5" style="margin-top: 85px;">
    <div class="row">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-white" style="background-color: rgb(61, 131, 97);">
                    <b>Les Actions du projet</b>
                </div>
                <div class="card-body" style="background-color: rgb(200, 216, 214);">
                    <form action="./includes/action.inc.php" id="actionForm" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                        <?php } ?>
                        <div class="form-group">
                            <label for="id_action">Id_Action</label>
                            <input name="id_action" type="text" class="form-control" id="id_action" placeholder="Id action">
                        </div>
                        <div class="form-group">
                            <label for="id_projet">Id_Projet</label>
                            <input name="id_projet" type="text" class="form-control" id="id_projet" placeholder="Id_Projet">
                        </div>
                        <div class="form-group">
                            <label for="duree">Duree</label>
                            <input name="duree" type="text" class="form-control" id="duree" placeholder="Duree">
                        </div>
                        <div class="form-group">
                            <label for="lieu">Lieu</label>
                            <input name="lieu" type="text" class="form-control" id="lieu" placeholder="Lieu où l'action se passe">
                        </div>
                        <div class="form-group">
                            <label for="commentaire">Commentaire</label>
                            <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire / description de l'espèce"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn" style="background-color: rgb(61, 131, 97);">Inserer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Id_Action</th>
                        <th>Id_Projet</th>
                        <th>Duree (hrs)</th>
                        <th>Lieu</th>
                        <th>Commentaire</th>
                        <th>Editer</th>
                        <th>Effacer</th>
                    </tr>
                </thead>
                <tbody id="actionTable">
                    <!-- Table rows will be dynamically added here -->
                    <?php
                    $query = "SELECT * FROM actions";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= $row['id_action'] ?></td>
                            <td><?= $row['id_projet'] ?></td>
                            <td><?= $row['duree'] ?></td>
                            <td><?= $row['lieu'] ?></td>
                            <td><?= $row['commentaire'] ?></td>
                            <td>
                                <a href="action-edit.php?id=<?= $row['id_action'] ?>"><button name="edit_action" class="edit-btn btn" style="background-color: rgb(61, 131, 97);" data-id="<?= $row['id_action'] ?>">Editer</button></a>
                            </td>
                            <td>
                                <form action="./deletion/action-delete.php" method="POST" onsubmit="return confirm('Etes vous d\'accord pour effacer cette ligne?');">
                                    <input type="hidden" name="id_action" value="<?= $row['id_action'] ?>">
                                    <button name="delete_action" class="delete-btn btn" style="background-color: rgb(61, 131, 97);" data-id="<?= $row['id_action'] ?>">Effacer</button>
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
