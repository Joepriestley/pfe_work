<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>

    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Suivi de Faune</b>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_GET['id'])) {
                            $suivi_faune_id = $_GET['id'];
                            $query = "SELECT * FROM suivi_faune WHERE id_suivi = :suivi_faune_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':suivi_faune_id', $suivi_faune_id, PDO::PARAM_STR);
                            $stmt->execute();
                        
                            $result = $stmt->fetch(PDO::FETCH_OBJ);

                            // You might want to print specific properties of $result, not the entire object
                            if ($result) {
                                echo "record found.";
                            } else {
                                echo "No record found.";
                            }
                        } 

                    ?>
                        <form action="./includes/suivi_faune-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Suivi Faune</b></span>
                                <div class="form-group col-md-6">
                                    <label for="id_suivi">Identifiant_Suivi</label>
                                    <input name="id_suivi" type="text" value="<?=$result->id_suivi; ?>" class="form-control" id="id_suivi" placeholder="id_suivi" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lieu">Lieu</label>
                                    <input name="lieu" type="text" value="<?=$result->lieu; ?>" class="form-control" id="lieu" placeholder="lieu">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datesable">Responsable</label>
                                    <input name="responsable" type="text"value="<?=$result->responsable; ?>" class="form-control" name="responsable" id="responsable" placeholder="responsable">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="typeobsuivi">Date Suivi </label>
                                    <input name="datesuivi" type="date" value="<?=$result->datesuivi; ?>"class="form-control" id="datesuivi" name="datesuivi" min="2005-01-01" max="2030-12-31" placeholder="date de suivi de faune">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="responservation">Type d'Observation </label>
                                    <input name="typeobservation" type="tel" value="<?=$result->typeobservation; ?>" class="form-control" name="typeobservation" id="typeobservation"  placeholder="Observation">
                                </div>
                                <input type="hidden" value="<?=$result->id_suivi; ?>"  name="id_suivi" >
                            </div>
                            <div class="form-row">
                    
                                
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7 bg-light">
               
            </div>
        </div>
    </div>

    


<?php
   include_once'footer.php';
   
   ?>














