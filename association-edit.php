<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<div class="container-fluid mt-4 pt-5">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                    <b>Les Associaions</b>
                </div>
                <div class="card-body">

                <?php
                        if (isset($_GET['id'])) {
                            $association_id = $_GET['id'];
                            $query = "SELECT * FROM association WHERE nomassociation= :association_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':association_id', $association_id, PDO::PARAM_STR);
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
                    <form action="./includes/association-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Identification Circuit</b></span>
                            <div class="form-group col-md-6">
                                <label for="nomassociation">Nom_Association</label>
                                <input name="nomassociation" type="text" value="<?=$result->nomassociation; ?>" class="form-control" id="nomassociation" placeholder="Nom_Circuit" disabled="disabled">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nompresident">President </label>
                                <input name="nompresident" type="text"  value="<?=$result->nompresident; ?>"  class="form-control" id="nompresident" placeholder="categorie du circuit">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="adresse">Adresse</label>
                                <input name="adresse" type="text"  value="<?=$result->adresse; ?>"  class="form-control" id="adresse" placeholder="adresse">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="objectif">Objectif_Association</label>
                                <input name="objectif" type="text"  value="<?=$result->objectif; ?>"  class="form-control" id="objectif" placeholder="Objectif association">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="id_douar">Id_douar</label>
                                <input name="id_douar" type="text"  value="<?=$result->id_douar; ?>"  class="form-control" id="id_douar" placeholder="id_douar">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="moyens">Moyens</label>
                                <input name="moyens" type="text"  value="<?=$result->moyens; ?>"  class="form-control" id="moyens" placeholder="moyens">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="datecreation">Date_Creation</label>
                                <input name="datecreation" type="date"  value="<?=$result->datecreation; ?>"  class="form-control" id="datecreation" placeholder="datecreation">
                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire"  value="<?=$result->commentaire; ?>"  class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
                            </div>
                                <input type="hidden" value="<?=$result->nomassociation; ?>"  name="nomassociation" >
                            </div>
                        </div>
                        <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-md-7 bg-light">
            
                    <!-- Table rows will be dynamically added here -->

                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include_once 'footer.php';

?>