<?php
$pdo = require_once './includes/dbConnect.php';

include_once 'header.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Les Actions du projet</b>
                    </div>
                    <div class="card-body bg-dark">
                    <?php
                        if (isset($_GET['id'])) {
                            $id_action = $_GET['id'];
                            $query = "SELECT * FROM actions WHERE id_action= :id_action";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':id_action', $id_action, PDO::PARAM_STR);
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

                        <form action="./includes/action-edit.inc.php" id="actionForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])){ ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Les Actions du Projet</b></span>
                                <div class="form-group col-md-6">
                                    <label for="id_action">Id_Action</label>
                                    <input name="id_action" type="text" value="<?=$result->id_action; ?>" class="form-control" id="id_action" placeholder="Id action" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_projet">Id_Projet </label>
                                    <input name="id_projet" type="text" value="<?=$result->id_projet; ?>" class="form-control" id="id_projet" placeholder="Id_Projet">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree</label>
                                    <input name="duree" type="text" value="<?=$result->duree; ?>" class="form-control" id="duree" placeholder="Duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="lieu">Lieu </label>
                                    <input name="lieu" type="text" value="<?=$result->lieu; ?>" class="form-control" id="lieu" placeholder="Lieu ou l'action se passe">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Commentaire</span>
                                    </div>
                                    <textarea name="commentaire" value="<?=$result->commentaire; ?>" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'espece"></textarea>
                                </div>
                                </div>
                                <input type="hidden" value="<?=$result->id_action; ?>"  name="id_action">
                            </div>
                            </div>
                            <button type="submit" name="submit" class="btn "style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Id_Action</th>
                            <th>Id_Projet</th>
                            <th>Duree (hrs)</th>
                            <th>Lieu</th>
                            <th>Commentaire</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                        </tr>
                    </thead>
                    <tbody id="actionTable">
                        <!-- Table rows will be dynamically added here -->
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
include_once 'footer.php';

?>
