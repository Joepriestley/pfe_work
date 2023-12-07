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
                            $id_amengttour = $_GET['id'];
                            $query = "SELECT * FROM amenagement_touristiques WHERE id_amengttour= :id_amengttour";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':id_amengttour', $id_amengttour, PDO::PARAM_STR);
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
                        <form action="./includes/amenagementtouristique-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Amenagement Touristique</b></span>
                                <div class="form-group col-md-6">
                                    <label for="type">Type Amenagement Touristique</label>
                                    <input name="type" type="number" value="<?=$result->type; ?>" class="form-control" id="type" name="type" placeholder="type">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="responsable">Responsable Amenagement Touristique</label>
                                    <input name="responsable" type="text" value="<?=$result->responsable; ?>" class="form-control" id="responsable" placeholder="responsable">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="periode">Periode</label>
                                    <input name="periode" type="text" value="<?=$result->periode; ?>" class="form-control" id="periode" placeholder="periode de gestion">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_amengttour">ID Amenagement Touristique </label>
                                    <input name="id_amengttour"  type="text" value="<?=$result->id_amengttour; ?>" class="form-control" id="id_amengttour" placeholder="Donnerr un numero d'identifiant" disabled="disabaled">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="responsable">Responsable</label>
                                    <input name="responsable" type="text" value="<?=$result->responsable; ?>" class="form-control" id="responsable" placeholder="responsable">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="periode">Periode</label>
                                    <input name="periode" type="text"  value="<?=$result->periode; ?>"class="form-control" id="periode" placeholder="periode">
                                </div>
                                </div>
                                <input type="hidden" value="<?=$result->id_amengttour; ?>"  name="id_amengttour" >
                            </div>
                            </div>
                            <div class="form-group col-md-12">
                                    <label for="id_amenagement">Cout Amenagement</label>
                                    <input name="cout_amengt" type="text"  value="<?=$result->cout_amengt; ?>" class="form-control" id="cout_amengt"  placeholder="Saissir le cout de gestion">
                                </div>
                            <!-- <div class="form-group col-md-12">
                                    <label for="id_amenagement">ID Amenagement</label>
                                    <input name="id_amenagement" type="text"  value="<?=$result->id_amenagement; ?>" class="form-control" id="id_amenagement"  placeholder="Saissir l'identifiant d'amenagement">
                                </div>
                             -->
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    
                    <tbody id="circuitTable" >
                        <!-- Table rows will be dynamically added here -->

                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php
   include_once 'footer.php';
   
   ?>













