<?php
$pdo = require_once './includes/dbConnect.php';
include_once 'header.php';

?>
<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b>   Le Sol du PNSM</b>
                    </div>
                    <div class="card-body text-center">
                    <?php
                        if (isset($_GET['id'])) {
                            $sol_id = $_GET['id'];
                            $query = "SELECT * FROM sol WHERE codemunsell= :sol_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':sol_id', $sol_id, PDO::PARAM_STR);
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
                        <form action="./includes/sol-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php 
                            if (isset($_GET['message'])) 
                            { 
                        ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                            
                        <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Les Sols</b></span>
                                <div class="form-group col-md-6">
                                    <label for="codemunsell">Code Munsell</label>
                                    <input type="text" name="id" disabled="disabled" value="<?=$result->codemunsell; ?>" class="form-control" id="codemunsell" placeholder="codemunsell">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomsol">Nom Sol </label>
                                    <input type="text" class="form-control" id="nomsol" value="<?=$result->nomsol; ?>" name="nomsol" placeholder="nomsol">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="groupe">Groupe_Sol</label>
                                    <input type="text" class="form-control"  value="<?=$result->groupe; ?>"  name="groupe" id="groupe" placeholder="groupe">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="couleur">Couleur </label>
                                    <input type="text" class="form-control"  value="<?=$result->couleur; ?>" name="couleur" id="couleur" placeholder="couleur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="classe">Classe_Sol </label>
                                    <input type="text" class="form-control" id="classe" value="<?=$result->classe; ?>" name="classe" placeholder="classe">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="sousclasse">Sous_classe</label>
                                    <input type="text" class="form-control" id="sousclasse" value="<?=$result->sousclasse; ?>"  name="sousclasse" placeholder="sousclasse">
                                </div>
                                <input type="hidden" value="<?=$result->codemunsell; ?>"  name="codemunsell" >
                            </div>
                            <div class="form-row">
                                   
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                        <br>
                        
                        <div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <?php
include_once 'footer.php';

?>


   













