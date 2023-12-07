<?php 
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php'; 

//codeamenagement
if (isset($_GET['id'])) {
    $codeamenagement = $_GET['id'];
    $query = "SELECT * FROM amenagement WHERE codeamenagement = :codeamenagement";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':codeamenagement', $codeamenagement, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);
} else {
    // Handle the case when 'id' is not set, e.g., redirect to an error page or display a message.
    echo "No record ID provided.";
}

?>
<div class="container-fluid mt-auto pt-5">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                    <b>Amenagement</b>
                </div>
                <div class="card-body">
                    <form action="./includes/amenagement-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                        <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Amenagement</b></span>
                            <div class="form-group col-md-6">
                                <label for="codeamenagement">Code_Amenagement</label>
                                <input type="text" name="codeamenagement" value="<?= $result->codeamenagement; ?>" class="form-control" id="codeamenagement" placeholder="codeamenagement" disabled="disabled">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="type">Type_Amenagement</label>
                                <input type="text" value="<?= $result->type; ?>" class="form-control" id="type" name="type" placeholder="type">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="element_amenage">Element_Amenagement</label>
                                <input type="text" class="form-control" id="element_amenage" name="element_amenage" placeholder="element amenage">
                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire" value="<?=$result->commentaire; ?>" class="form-control" id="commentaire" aria-label="commentaire" rows="10" cols="" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
                            <div>
                                <input name="codeamenagement" type="hidden" value="<?= $result->codeamenagement; ?>">
                            </div>
                        </div>
                        <div class="form-row">
                        </div>
                        <div class="form-row">
                        </div>
                        <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7>
          <table class="">
            
              
            </table
        </div>
    </div>
</div>
<?php include_once 'footer.php'; ?>

    















