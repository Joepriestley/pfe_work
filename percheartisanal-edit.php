<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

if (isset($_GET['id'])) {
    $perche_id = $_GET['id'];
    $query = "SELECT * FROM perche_artisanal WHERE codeactivite = :perche_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':perche_id', $perche_id, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);

    // You might want to print specific properties of $result, not the entire object
    if (!$result) {
        echo "No record found.";
    }
}
?>

<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                        <b>Les Activites</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/percheartisanal-edit.inc.php" id="percheartisanalForm" style="background-color: rgb(201, 216, 214);" method="post">
                            <?php if (isset($_GET['message'])) { ?>
                                <p class="message"><?php echo $_GET['message']; ?></p>
                            <?php } ?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Perche Artisanal</b></span>
                                <div class="form-group col-md-6">
                                    <label for="codeactivite">Code Activite</label>
                                    <input name="codeactivite" type="text" class="form-control" id="codeactivite" value="<?= $result->codeactivite; ?>" placeholder="Code Activite">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="annee">Annee Activite</label>
                                    <input type="month" class="form-control" id="annee" name="annee" min="2019-07" value="<?= $result->annee; ?>" placeholder="Annee Activite">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nombrepratiquant">Nombre pratiquant</label>
                                    <input name="nombrepratiquant" type="number" class="form-control" id="nombrepratiquant" value="<?= $result->nombrepratiquant; ?>" placeholder="Nombre pratiquant">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="rendement">Rendement</label>
                                    <input name="rendement" type="number" class="form-control" id="rendement" value="<?= $result->rendement; ?>" placeholder="Rendement">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nomperche_art">Nom perche</label>
                                    <input name="nomperche_art" type="text" class="form-control" id="nomperche_art" value="<?= $result->nomperche_art; ?>" placeholder="Nom perche">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="douar">Id Douar</label>
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
                                    <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"><?= $result->commentaire; ?></textarea>
                                </div>
                            </div>
                            <button type="submit" name="update_perche" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <!-- Add any display elements for the edited record here -->
            </div>
        </div>
    </div>
    <?php
    include_once 'footer.php';
    ?>
</body>