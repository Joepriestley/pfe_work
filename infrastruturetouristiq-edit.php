<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white"  style="background-color:rgb(61,131,97,1);">
                      <b>Infrastructures Touristique</b>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_GET['id'])) {
                            $infrastrature_id_id = $_GET['id'];
                            $query = "SELECT * FROM infrastructure_touristique WHERE id_infrastructure = :infrastrature_id_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':infrastrature_id_id', $infrastrature_id_id, PDO::PARAM_STR);
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
                        <form action="./includes/infrastruturetouristiq-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Infrastructures Touristique</b></span>
                                <div class="form-group col-md-6">
                                    <label for="id_infrastructure">Id_Infrastructure</label>
                                    <input type="number" value="<?=$result->id_infrastructure; ?>" class="form-control" id="id_infrastructure" name="id_infrastructure" placeholder="date de gestion" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nominfra">Nom Infrastructures </label>
                                    <input type="text" name="nominfra"value="<?=$result->nominfra; ?>" class="form-control" id="nominfra" placeholder="nominfra">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="typeinfra">Type Infrastructure</label>
                                    <input type="text" name="typeinfra" value="<?=$result->typeinfra; ?>" class="form-control" id="typeinfra" placeholder="typeinfra">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="etatinfra">Etat Infrastructure </label>
                                    <input type="text" name="etatinfra" value="<?=$result->etatinfra; ?>" class="form-control" id="etatinfra" placeholder="etatinfra">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="localisation">Localisation</label>
                                    <input type="text" name="localisation"  value="<?=$result->localisation; ?>"class="form-control" id="localisation" placeholder="localisation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datecontruction">Date Construction </label>
                                    <input type="date" name="datecontruction" class="form-control" id="datecontruction" placeholder="Date Construction">
                                </div>
                                <input type="hidden" value="<?=$result->id_infrastructure; ?>"  name="id_infrastructure" >
                            </div>
                            <div class="form-row">
                                
                    
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Commentaire</span>
                                    </div>
                                    <textarea name="commentaire"value="<?=$result->commentaire; ?>"  class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn"  style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr >
                            <th>Id Infra</th>
                            <th>Nom Infra</th>
                            <th>Type Infra</th>
                            <th>Etat Infra</th>
                            <th>Localisation</th>
                            <th>Date Const.</th>
                            <th>Commentaire</th>
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














