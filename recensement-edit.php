<?php

include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>

<body style="background-color: darksalmon;">
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card"> 
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                        <b>Recensement Sur Les especes Animales</b>
                    </div>
                    <div class="card-body">

                    <?php
                        if (isset($_GET['espece_animale']) && isset($_GET['id_faune_suivi'])) {
                            $espece_animale = $_GET['espece_animale'];
                            $id_faune_suivi = $_GET['id_faune_suivi'];
                            
                            $query = "SELECT * FROM recensement WHERE espece_animale = :espece_animale AND id_faune_suivi = :id_faune_suivi";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':espece_animale', $espece_animale, PDO::PARAM_STR);
                            $stmt->bindParam(':id_faune_suivi', $id_faune_suivi, PDO::PARAM_STR);
                            $stmt->execute();
                            
                            $result = $stmt->fetch(PDO::FETCH_OBJ);

                            if ($result) {
                                echo "Record found.";
                            } else {
                                echo "No record found.";
                            }
                            } 
                        ?>

                        <form action="./includes/recensement-edit.inc.php" id="actionForm" style="background-color: rgb(201, 216, 214);" method="post">
                            <?php if (isset($_GET["message"])) { ?>
                                <p class="message"><?php echo $_GET["message"]; ?></p>
                            <?php } ?>


                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Recensement</b></span>
                                <div class="form-group col-md-6">
                                    <label for="effectifmales">Effectif males</label>
                                    <input name="effectifmales" type="number" value="<?=$result->effectifmales; ?>" class="form-control" id="effectifmales" placeholder="Id action">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="effectiffemelles">Effecti Femmelles </label>
                                    <input name="effectiffemelles" type="number" value="<?=$result->effectiffemelles; ?>" class="form-control" id="effectiffemelles" placeholder="effectiffemelles">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="effectifjeunes">Effectif Jeunes</label>
                                    <input name="effectifjeunes" type="number" value="<?=$result->effectifjeunes; ?>" class="form-control" id="effectifjeunes" placeholder="effectifjeunes">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="effectiftotal">Effectif Total </label>
                                    <input name="effectiftotal" type="number" value="<?=$result->effectiftotal; ?>" class="form-control" id="effectiftotal" placeholder="Lieu ou l'action se passe">
                                </div>
                            </div>
                            <span class="form-control text-center bg-dark text-white"><b>Comportement</b></span>
                            <div>

                                <div class="form-group col-md-12">
                                    <label for="vitessedeplacement">Vitesse_Deplacement </label>
                                    <input name="vitessedeplacement" type="text" value="<?=$result->vitessedeplacement; ?>" class="form-control" id="vitessedeplacement" placeholder="Vitesse_Deplacement">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="espece_animale">Espece Animaale </label>
                                    <input name="espece_animale" type="text" value="<?=$result->espece_animale; ?>" class="form-control" id="espece_animale" placeholder="especes animale" disabled="disabled">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="id_faune_suivi"">Identiant Suivi</label>
                                <input name="id_faune_suivi" type="text" value="<?=$result->id_faune_suivi; ?>"  class="form-control" id="id_faune_suivi"" placeholder=" identifiant" disabled="disabled">
                                </div>
                                <div class="form-row">
                                    <div class="input-group col-md-12">
                                        <div class="input-group-prepend">
                                            <span  class="input-group-text">Commentaire</span>
                                        </div>
                                        <textarea name="commentaire" value="<?=$result->commentaire; ?>" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'espece"></textarea>
                                    </div>
                                    <input type="hidden" value="<?=$result->espece_animale; ?>"  name="espece_animale" >
                                    <input type="hidden" value="<?=$result->id_faune_suivi; ?>"  name="id_faune_suivi" >
                                </div>
    
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="col-md-6 bg-light">

            </div>
        </div>
    </div>

    <?php
    include_once 'footer.php';

    ?>