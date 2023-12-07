<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Executeur du Projet</b>
                    </div>
                    <div class="card-body ">
                    <?php
                        if (isset($_GET['id'])) {
                            $executeur_id = $_GET['id'];
                            $query = "SELECT * FROM executeur WHERE numerocin= :executeur_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':executeur_id', $executeur_id, PDO::PARAM_STR);
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
                        <form action="./includes/executeur-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Executeur</b></span>
                                <div class="form-group col-md-6">
                                    <label for="numerocin">Numero_CIN</label>
                                    <input name="numerocin" type="text" value="<?=$result->numerocin; ?>" class="form-control" id="numerocin" placeholder="numerocin" disabled="disabaled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomexecuteur">Nom_Executeur</label>
                                    <input name="nomexecuteur" type="text" value="<?=$result->nomexecuteur; ?>" class="form-control" id="nomexecuteur" name="nomexecuteur" placeholder="nomexecuteur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="prenomexecuteur">Prenom_Executeur</label>
                                    <input name="prenomexecuteur" type="text"value="<?=$result->prenomexecuteur; ?>" class="form-control" name="prenomexecuteur" id="prenomexecuteur" placeholder="prenomexecuteur_Partenaire">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="qualiteexecuteur">Quality_Executeur </label>
                                    <input name="qualiteexecuteur" type="text" value="<?=$result->qualiteexecuteur; ?>" class="form-control" name="qualiteexecuteur" id="qualiteexecuteur" placeholder="qualiteexecuteur">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="adresse">Adresse</label>
                                    <input name="adresse" type="text" value="<?=$result->adresse; ?>" class="form-control" id="adresse"  name="adresse" placeholder="prenomexecuteur_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telephone">Telephone</label>
                                    <input name="telephone" type="tel" value="<?=$result->telephone; ?>" class="form-control" id="telephone" name="telephone" placeholder="telephone">
                                </div>
                                <input type="hidden" value="<?=$result->numerocin; ?>"  name="numerocin" >
                            </div>
                            <div class="form-row">
                               
                                
                            </div>
                            <button type="submit" name="submit" class="btn " style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Numero Cin</th>
                            <th>Nom Executeur</th>
                            <th>Prenom Executeur</th>
                            <th>Qualite Executeur</th>
                            <th>adresse</th>
                            <th>Telephone</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-dark text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
include_once 'footer.php';

?>














