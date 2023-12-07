<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Elements Amenagement</b>amenttour_id
                    </div>
                    <div class="card-body">

                    <?php
                        if (isset($_GET['id'])) {
                            $amenttour_id = $_GET['id'];
                            $query = "SELECT * FROM ref_amenagement_touristique WHERE id_ref_amengt_tour = :amenttour_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':amenttour_id', $amenttour_id , PDO::PARAM_STR);
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
                        <form action="./includes/ref_amenagementtour-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b> Refection Amenagement Touristique</b></span>
                               
                                <div class="form-group col-md-12">
                                    <label for="nom_amenagementtour">Nom Amenage. Touristique</label>
                                    <input name="nom_amenagementtour" value="<?=$result->nom_amenagementtour; ?>" type="text" class="form-control" id="nom_amenagementtour" placeholder="">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="responsable">Responsable Amenagement Touristique</label>
                                    <input name="responsable" value="<?=$result->responsable; ?>" type="text" class="form-control" id="responsable" placeholder="responsable de l'amenagement touristique">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="id_ref_amengt_tour">ID Amenagement Touristique </label>
                                    <input name="id_ref_amengt_tour" value="<?=$result->id_ref_amengt_tour;?>" type="text" class="form-control" id="id_ref_amengt_tour" placeholder="Donnerr un numero d'identifiant" disabled="disabled">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nature">Nature</label>
                                    <input name="nature" value="<?=$result->nature;?>" type="text" class="form-control" id="nature" placeholder="nature de gestion">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="date_refection">Date Refection</label>
                                    <input name="date_refection" value="<?=$result->date_refection;?>" type="date" class="form-control" id="date_refection" placeholder="date_refection de gestion">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_amengt">Cout Amenagement</label>
                                    <input name="cout_amengt" value="<?=$result->cout_amengt;?>" type="text" class="form-control" id="cout_amengt" placeholder="Saissir le cout de gestion">
                                </div>
                                <input type="hidden" value="<?=$result->id_ref_amengt_tour; ?>" name="id_ref_amengt_tour">
                               
                            </div>
                            
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













