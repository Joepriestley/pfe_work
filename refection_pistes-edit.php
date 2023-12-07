<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';


if (isset($_GET['id'])) {
    $id_ref_piste = $_GET['id'];
    $query = "SELECT * FROM refection_pistes WHERE id_refection_piste = :id_ref_piste";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id_ref_piste', $id_ref_piste , PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_OBJ);

    // You might want to print specific properties of $result, not the entire object
    if ($result) {
        // echo "record found.";
    } else {
        echo "No record found.";
    }
} 


?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Elements Amenagement</b>
                    </div>
                    <div class="card-body">
                  
                        <form action="./includes/ref_piste-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b> Refection Piste</b></span>

                                <div class="form-group col-md-6">
                                    <label for="id_refection_piste">ID Pistes </label>
                                    <input name="id_refection_piste"  value="<?=$result->id_refection_piste; ?>"  type="text" class="form-control" id="id_refection_piste" placeholder="id_refection_piste" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_refection">date_refection</label>
                                    <input name="date_refection"  value="<?=$result->date_refection; ?>"  type="number" class="form-control" id="date_refection" placeholder="date_refection">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="executeur">executeur</label>
                                    <input name="executeur"  value="<?=$result->executeur; ?>"  type="text" class="form-control" id="executeur" placeholder="executeur">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_amengt">Cout_Amenagement</label>
                                    <input name="cout_amengt"  value="<?=$result->cout_amengt; ?>"  type="text" class="form-control" id="cout_amengt" placeholder="cout_amengt">
                                </div>
                               
                                <input type="hidden" value="<?=$result->id_refection_piste; ?>"  name="id_refection_piste" >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="etat">etat</label>
                                <input name="etat" type="text"  value="<?=$result->etat; ?>"  class="form-control" id="etat" placeholder="etat">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nom_piste">Nom Piste</label>
                                <input name="nom_piste" type="text"  value="<?=$result->nom_piste; ?>"  class="form-control" id="nom_piste" placeholder="nom_piste">
                            </div>
                            <!-- <div class="form-group col-md-12">
                                <label for="id_amengt">Id_amenagement</label>
                                <input name="id_amengt" type="date"  value="<?=$result->id_amengt; ?>"  class="form-control" id="id_amengt" placeholder="id_amengt">
                            </div> -->
                            
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">       
            </div>
            </div>
        </div>
    </div>


<?php
   include_once 'footer.php';
   
   ?>














