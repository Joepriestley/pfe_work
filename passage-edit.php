<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';
?>

<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                        <b> Le Passage d'circuit</b>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['id'])) {
                            $passage_id = $_GET['id'];
                            $query = "SELECT * FROM passe WHERE datepassage = :passage_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':passage_id', $passage_id, PDO::PARAM_STR);
                            $stmt->execute();

                            $result = $stmt->fetch(PDO::FETCH_OBJ);

                            if ($result) {
                                echo "Record found.";
                            } else {
                                echo "No record found.";
                            }
                        }
                        ?>

                        <form action="./includes/passage-edit.inc.php" id="circuittouristForm"
                            style="background-color: rgb(201, 216, 214);" method="post">
                            <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                            <?php } ?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b> Le Passage de Circuit</b></span>
                                <div class="form-group col-md-6">
                                    <label for="datepassage">Date Passee</label>
                                    <input type="date" name="datepassage" class="form-control" id="datepassage"
                                        value="<?= $result->datepassage; ?>" placeholder="datepassage" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree_Passage</label>
                                    <input type="text" class="form-control" id="duree" name="duree"
                                        value="<?= $result->duree; ?>" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_circuittour">Id_Circuit</label>
                                    <input type="text" class="form-control" name="id_circuittour" id="id_circuittour"
                                        value="<?= $result->id_circuittour; ?>" placeholder="id_circuittour">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_touriste">Id_touriste</label>
                                    <input type="text" class="form-control" name="id_touriste" id="id_touriste"
                                        value="<?= $result->id_touriste; ?>" placeholder="id_touriste">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="en_groupe">En_groupe</label>
                                    <select name="en_groupe" id="en_groupe" class="form-control">
                                        <option value="">En groupe ?</option>
                                        <option value="oui" <?php if ($result->en_groupe === 'oui') echo 'selected'; ?>>oui
                                        </option>
                                        <option value="non" <?php if ($result->en_groupe === 'non') echo 'selected'; ?>>
                                            non</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" value="<?=$result->datepassage; ?>"  name="datepassage" >
                            <div class="form-row">
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
            </div>
        </div>
    </div>

    <?php
    include_once 'footer.php';
    ?>
</body>
