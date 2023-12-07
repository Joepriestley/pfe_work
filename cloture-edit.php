<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

if (isset($_GET['id'])) {
    $id_cloture = $_GET['id'];
    $query = "SELECT * FROM clotures WHERE id_cloture = :id_cloture";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_cloture', $id_cloture, PDO::PARAM_INT);
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
                <div class="card-body" >
                    <form action="./includes/pistes-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                        <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Piste</b></span>
                            <div class="form-group col-md-12">
                                <label for="id_cloture">ID_Cloture</label>
                                <input type="text" class="form-control" id="id_cloture" name="id_cloture" placeholder="id_cloture" value="<?= $result->id_cloture; ?>" disabled="disabled">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nom_cloture">Nom_Cloture</label>
                                <input type="text" class="form-control" id="nom_cloture" name="nom_cloture" placeholder="nom_cloture" value="<?= $result->nom_cloture; ?>" disabled="disabled">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date_cloture">Date_Cloture</label>
                                <input type="date" class="form-control" id="date_cloture" name="date_cloture" placeholder="date_cloture" value="<?= $result->date_cloture; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="cout_creation">Cout_Creation</label>
                                <input type="number" class="form-control" id="cout_creation" name="cout_creation" placeholder="cout_creation" value="<?= $result->cout_creation; ?>">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nature">Nature</label>
                                <input type="text" class="form-control" id="nature" name="nature" placeholder="nature" value="<?= $result->nature; ?>">
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="duree">Duree</label>
                            <input type="text" class="form-control" id="duree" name="duree" placeholder="duree" value="<?= $result->duree; ?>">
                        </div>
                       
                        <input type="hidden" name="id_cloture" value="<?= $result->id_cloture; ?>">
                        <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                    </form>
                    <br>
                    
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
