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
                <div class="card-body ">
                    <?php
                    if (isset($_GET['id'])) {
                        $projet_id = $_GET['id'];
                        $query = "SELECT * FROM projet WHERE  codeprojet = :projet_id";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(':projet_id', $projet_id, PDO::PARAM_STR);
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
                    <form action="./includes/projet-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p> <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Projet</b></span>
                            <div class="form-group col-md-6">
                                <label for="codeprojet">Code Projet</label>
                                <input type="number" value="<?= $result->codeprojet; ?>" class="form-control" id="codeprojet" placeholder="codeprojet" disabled="disabled">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nomprojet">Nom_Projet</label>
                                <input type="text" value="<?= $result->nomprojet; ?>" class="form-control" id="nomprojet" name="nomprojet" placeholder="nomprojet">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_association">Id_Association</label>
                                <input type="text" value="<?= $result->id_association; ?>" class="form-control" name="id_association" id="id_association" placeholder="Adresse_Partenaire">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="objectif">Objectif </label>
                                <input type="text" value="<?= $result->objectif; ?>" class="form-control" name="objectif" id="objectif" placeholder="Objectif">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="datedebut">datedebut_Partenaire </label>
                                <input type="date" value="<?= $result->datedebut; ?>" class="form-control" id="datedebut" name="datedebut" placeholder="datedebut">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="duree">Duree </label>
                                <input type="text" value="<?= $result->duree; ?>" class="form-control" id="duree" name="duree" placeholder="Duree">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="budget">Budget</label>
                                <input name="budget" type="text" value="<?= $result->budget; ?>" class="form-control" id="budget" placeholder="budget">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="categoriepayment"> Categorie_payement</label>
                                <input name="categoriepayment" type="text" value="<?= $result->categoriepayment; ?>" class="form-control" id="categoriepayment" placeholder="categoriepayment">
                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire" value="<?= $result->commentaire; ?>" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
                            <input type="hidden" value="<?= $result->codeprojet; ?>" name="codeprojet">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Mettre a jour</button>
                    </form>
                    <br>
                    <a href="#" class="btn btn-primary">Nouveau</a>
                </div>
            </div>
        </div>
        <div class="col-md-7">




            </table>
        </div>
    </div>
</div>



<?php
include_once 'footer.php';

?>