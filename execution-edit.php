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
                      <b>Execution du Projet</b>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_GET['id'])) {
                            $execution_id = $_GET['id'];
                            $query = "SELECT * FROM execut WHERE activite= :execution_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':execution_id', $execution_id, PDO::PARAM_STR);
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
                        <form action="./includes/execution-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Execution</b></span>
                                
                                <div class="form-group col-md-6">
                                    <label for="activite">activite </label>
                                    <input name="activite" type="text" value="<?=$result->activite; ?>"  class="form-control" id="activite" name="activite" placeholder="activite" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_executeur"></label>
                                    <input name="id_executeur" type="text" value="<?=$result->id_executeur; ?>"  class="form-control" name="id_executeur" id="id_executeur" placeholder="id_executeur">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="id_action">id_action </label>
                                    <input name="id_action" type="number" value="<?=$result->id_action; ?>"  class="form-control" name="id_action" id="id_action" placeholder="id_action">
                                </div>
                                <input type="hidden" value="<?=$result->activite; ?>"  name="activite" >
                            </div>
                            <div class="form-row">
                               
                                
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Date Utilisee</th>
                            <th>activite </th>
                            <th>id_action</th>
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















