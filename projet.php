<?php
include_once 'header.php';

$pdo = require_once './includes/dbConnect.php';

?>

    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b> Les Projets Du PNSM</b>
                    </div>
                    <div class="card-body">
                        <form action="./includes/projet.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Projet</b></span>
                                <div class="form-group col-md-6">
                                    <label for="codeprojet">Code Projet</label>
                                    <input type="number" class="form-control" id="codeprojet" placeholder="codeprojet">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nomprojet">Nom du Projet</label>
                                    <input type="text" class="form-control" id="nomprojet" name="nomprojet" placeholder="nomprojet">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_association">ID Association</label>
                                    <input type="text" class="form-control" name="id_association" id="id_association" placeholder="Adresse_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="objectif">Objectif </label>
                                    <input type="text" class="form-control" name="objectif" id="objectif"  placeholder="Objectif">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datedebut">Date Debut de Partenariat </label>
                                    <input type="date" class="form-control" id="datedebut" name="datedebut"  placeholder="datedebut">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree </label>
                                    <input type="text" class="form-control" id="duree"  name="duree" placeholder="Duree">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="budget">Budget</label>
                                    <input name="budget" type="text" class="form-control" id="budget" placeholder="budget">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="categoriepayment"> Categorie de payement</label>
                                    <input  name="categoriepayment" type="text" class="form-control" id="categoriepayment" placeholder="categoriepayment">
                                </div>
                                <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
                               
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table-success">
                        <tr>
                            <th>Code Projet</th>
                            <th>Projet</th>
                            <th>Objectif</th>
                            <th>Date Debut</th>
                            <th>Duree </th>
                            <th>Budget</th>
                            <th>Categorie payement</th>
                            <th>Comm.</th>
                            <th>Association</th>
                            <th>Editer</th>
                            <th>Effacer</th>
                           
                            
                            
                        </tr>
                    </thead>
                    <tbody id="circuitTable" class="table table-whit bg-white text-dark table-striped">
                        <!-- Table rows will be dynamically added here -->
                        <?php
                        // Assuming you already have the database connection established ($pdo)
                        $query = "SELECT * FROM projet";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();
                        $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Add this inside the table body -->
                        <?php foreach ($results as $row) : ?>
                            <tr>
                                <td><?= $row['codeprojet'] ?></td>
                                <td><?= $row['nomprojet'] ?></td>
                                <td><?= $row['objectif'] ?></td>
                                <td><?= $row['datedebut'] ?></td>
                                <td><?= $row['duree'] ?></td>
                                <td><?= $row['budget'] ?></td>
                                <td><?= $row['categoriepayment'] ?></td>
                                <td><?= $row['commentaire'] ?></td>
                                <td><?= $row['id_association'] ?></td>
                                <td>
                                    <a href="projet-edit.php?id=<?= $row['codeprojet'] ?>"><button name="edit_projet" class="edit-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['codeprojet'] ?>">Editer</button></a>
                                </td>
                                <td>

                                    <!-- Delete form -->
                                    <form style="border:0px; padding:0px;" action="./deletion/projet-delete.php" method="POST">
                                        <!-- Hidden input field to include codeprojet -->
                                        <input type="hidden" name="codeprojet" value="<?= $row['codeprojet'] ?>">
                                        <!-- Delete button -->
                                        <button name="delete_projet" class="delete-btn btn" style="background-color:rgb(61,131,97,1);" data-id="<?= $row['codeprojet'] ?>" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
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
   include_once'footer.php';
   
   ?>














