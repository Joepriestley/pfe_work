<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Elements Amenagement</b>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_GET['id'])) {
                            $point_eau_id = $_GET['id'];
                            $query = "SELECT * FROM ref_point_eau WHERE id_ref_point_eau = :point_eau_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':point_eau_id', $point_eau_id , PDO::PARAM_STR);
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
                        <form action="./includes/point_eau-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b> Refection Point  Eau</b></span>

                                <div class="form-group col-md-6">
                                    <label for="id_ref_point_eau">ID_Point_Eau </label>
                                    <input name="id_ref_point_eau"  value="<?=$result->id_ref_point_eau; ?>"  type="text" class="form-control" id="id_ref_point_eau" placeholder="id_ref_point_eau" disabled="disabled">
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
                               
                                <input type="hidden" value="<?=$result->id_ref_point_eau; ?>"  name="id_ref_point_eau" >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="id_pointeau">id_pointeau</label>
                                <input name="id_pointeau" type="text"  value="<?=$result->id_pointeau; ?>"  class="form-control" id="id_pointeau" placeholder="id_pointeau">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="nom_point_eau">Nom_Point_Eau</label>
                                <input name="nom_point_eau" type="text"  value="<?=$result->nom_point_eau; ?>"  class="form-control" id="nom_point_eau" placeholder="nom_point_eau">
                            </div>
                            <!-- <div class="form-group col-md-12">
                                <label for="id_amengt">Id_amenagement</label>
                                <input name="id_amengt" type="date"  value="<?=$result->id_amengt; ?>"  class="form-control" id="id_amengt" placeholder="id_amengt">
                            </div> -->
                            
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);" >UPDATE</button>
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














