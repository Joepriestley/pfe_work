<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

if (isset($_GET['id'])) {
    $id_piste = $_GET['id'];
    $query = "SELECT * FROM pistes WHERE id_piste = :id_piste";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_piste', $id_piste, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$result) {
        echo "No record found.";
    }
}
?>

<div class="container-fluid mt-4 pt-5">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                    <b> Elements Amenagement</b>
                </div>
                <div class="card-body">
                    <form action="./includes/pistes-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                        <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Piste</b></span>
                            <div class="form-group col-md-12">
                                <label for="id_piste">Id_Piste</label>
                                <input type="text" class="form-control" id="id_piste" name="id_piste" placeholder="id_piste" value="<?= $result->id_piste; ?>" disabled="disabled">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="longueur">longueur</label>
                                <input type="number" class="form-control" id="longueur" name="longueur" placeholder="longueur" value="<?= $result->longueur; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cout_amengt">cout_amengt</label>
                                <input type="number" class="form-control" id="cout_amengt" name="cout_amengt" placeholder="cout_amengt" value="<?= $result->cout_amengt; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="accessibilite">accessibilite</label>
                                <input type="text" class="form-control" id="accessibilite" name="accessibilite" placeholder="accessibilite" value="<?= $result->accessibilite; ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="dateouverture">dateouverture</label>
                            <input type="date" class="form-control" id="dateouverture" name="dateouverture" placeholder="dateouverture" value="<?= $result->dateouverture; ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="id_amengt">Id_Amenagement</label>
                            <input type="number" class="form-control" id="id_amengt" name="id_amengt" placeholder="id_amengt" value="<?= $result->id_amengt; ?>">
                        </div>
                        <input type="hidden" name="id_piste" value="<?= $result->id_piste; ?>">
                        <button type="submit" name="submit" class="btn btn-primary">UPDATE</button>
                    </form>
                    <br>
                    <a href="#" class="btn btn-primary">Nouveau</a>
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
