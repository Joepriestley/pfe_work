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
                            $query = "SELECT * FROM point_eau WHERE id_point_eau = :point_eau_id";
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
                                <span class="form-control text-center bg-dark text-white"><b>Point  Eau</b></span>

                                <div class="form-group col-md-6">
                                    <label for="id_point_eau">Id Point Eau</label>
                                    <input name="id_point_eau"  value="<?=$result->id_point_eau; ?>"  type="text" class="form-control" id="id_point_eau" placeholder="id_point_eau" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nom_point_eau">Id Point Eau</label>
                                    <input name="nom_point_eau"  value="<?=$result->nom_point_eau; ?>"  type="text" class="form-control" id="nom_point_eau" placeholder="nom_point_eau" disabled="disabled">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="profondeur">Profondeur</label>
                                    <input name="profondeur"  value="<?=$result->profondeur; ?>"  type="number" class="form-control" id="profondeur" placeholder="profondeur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nature">Nature</label>
                                    <input name="nature"  value="<?=$result->nature; ?>"  type="text" class="form-control" id="nature" placeholder="nature">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_installation">Cout_Installation</label>
                                    <input name="cout_installation"  value="<?=$result->cout_installation; ?>"  type="text" class="form-control" id="cout_installation" placeholder="cout_installation">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="localisation">Localisation</label>
                                    <input name="localisation"  value="<?=$result->localisation; ?>"  type="text" class="form-control" id="localisation" placeholder="localisation">
                                </div>
                                <input type="hidden" value="<?=$result->id_point_eau; ?>"  name="id_point_eau" >
                            </div>
                            <div class="form-group col-md-12">
                                <label for="importance">importance</label>
                                <input name="importance" type="text"  value="<?=$result->importance; ?>"  class="form-control" id="importance" placeholder="importance">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date_installation">Date Installation</label>
                                <input name="date_installation" type="date"  value="<?=$result->date_installation; ?>"  class="form-control" id="date_installation" placeholder="date_installation">
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
    </div>


<?php
   include_once 'footer.php';
   
   ?>














