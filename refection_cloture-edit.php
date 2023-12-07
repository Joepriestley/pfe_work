    <?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Elements Amenagement</b>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_GET['id'])) {
                            $ref_cloture = $_GET['id'];
                            $query = "SELECT * FROM refection_cloture  WHERE id_refection = :ref_cloture";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':ref_cloture', $ref_cloture , PDO::PARAM_STR);
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
                        <form action="./includes/ref_cloture-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Cloture</b></span>
                               
                                <div class="form-group col-md-6">
                                    <label for="id_refection">id_refection</label>
                                    <input name="id_refection"  value="<?=$result->id_refection; ?>" type="text" class="form-control" id="id_refection" placeholder="id_refection" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nom_cloture">nom_cloture</label>
                                    <input name="nom_cloture"  value="<?=$result->nom_cloture; ?>" type="text" class="form-control" id="nom_cloture" placeholder="nom_cloture" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_refection">date_refection</label>
                                    <input name="date_refection" value="<?=$result->date_refection;?>" type="date" class="form-control" id="date_refection" placeholder="date_refection">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="coutamengt">coutamengt</label>
                                    <input name="coutamengt" value="<?=$result->coutamengt; ?>" type="number" class="form-control" id="coutamengt" placeholder="coutamengt">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nature">Nature</label>
                                    <input name="nature" value="<?=$result->nature; ?>"  type="text" class="form-control" id="nature" placeholder="nature">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="etat">etat (Ans)</label>
                                <input name="etat"  value="<?=$result->etat; ?>" type="text" class="form-control" id="etat" placeholder="etat">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="executeur">executeur (Ans)</label>
                                <input name="executeur" value="<?=$result->executeur; ?>"  type="text" class="form-control" id="executeur" placeholder="executeur">
                            </div>
                            <input type="hidden" value="<?=$result->id_refection; ?>" name="id_refection" >
                            <div class="form-group col-md-12">
                                <label for="id_cloture">id_cloture</label>
                                <input name="id_cloture" type="text" class="form-control" id="id_cloture" placeholder="id_cloture">
                            </div>
                            
                            <button type="submit"name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                   
                    <tbody id="circuitTable" class="table table-white bg-white text-dark table-striped" >
                        <!-- Table rows will be dynamically added here -->
                         <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM refection_cloture";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['id_refection'] ?></td>
                                <td><?= $row['nom_cloture'] ?></td>
                                <td><?= $row['date_refection'] ?></td>
                                <td><?= $row['coutamengt'] ?></td>
                                <td><?= $row['nature'] ?></td>
                                <td><?= $row['etat'] ?></td>  
                                <td>
                                    <a href="cloture-edit.php?id=<?= $row['id_refection'] ?>"><button name="edit_cloture" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_refection'] ?>">Editer</button></a>
                                </td>
                                <td>

                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/cloture-delete.php" method="POST">
                                        <!-- Hidden input field to include id_piste -->
                                        <input type="hidden" name="id_refection" value="<?= $row['id_refection'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_cloture" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['id_refection'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

<?php
   include_once 'footer.php';
   
   ?>















