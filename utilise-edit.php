<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>
<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header  text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Utilisation d'Infrastructure Touristique</b>
                    </div>
                    <div class="card-body">

                    <?php
                        if (isset($_GET['id_infrastructure']) && isset($_GET['id_touriste'])) {
                            $id_infrastructure = $_GET['id_infrastructure'];
                            $id_touriste = $_GET['id_touriste'];
                            
                            $query = "SELECT * FROM utilise WHERE id_infrastructure = :id_infrastructure AND id_touriste = :id_touriste";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':id_infrastructure', $id_infrastructure, PDO::PARAM_STR);
                            $stmt->bindParam(':id_touriste', $id_touriste, PDO::PARAM_STR);
                            $stmt->execute();
                            
                            $result = $stmt->fetch(PDO::FETCH_OBJ);

                            if ($result) {
                                echo "Record found.";
                            } else {
                                echo "No record found.";
                            }
                            } 
                        ?>
                        <form action="./includes/utilise-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Utilisation</b></span>
                                <div class="form-group col-md-6">
                                    <label for="dateutilisation">Date Utilisee</label>
                                    <input type="date" name="dateutilisation" value="<?=$result->dateutilisation; ?>" class="form-control" id="dateutilisation" placeholder="dateutilisation">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree </label>
                                    <input type="text" value="<?=$result->duree; ?>" class="form-control" id="duree" name="duree" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appreciation">Appreciation</label>
                                    <input type="text" value="<?=$result->appreciation; ?>" class="form-control" name="appreciation" id="appreciation" placeholder="appreciation_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_infrastructure">Id_Infrastructure </label>
                                    <input type="number" value="<?=$result->id_infrastructure; ?>" class="form-control" name="id_infrastructure" id="id_infrastructure" placeholder="id_infrastructure" disabled="disabled">
                                </div>
            
                                <div class="form-group col-md-6">
                                    <label for="id_touriste">Id_Touriste</label>
                                    <input type="text" value="<?=$result->id_touriste; ?>" class="form-control" id="id_touriste"  name="id_touriste" placeholder="appreciation_Partenaire" disabled="disabled">
                                </div>
                                <input type="hidden" value="<?=$result->id_infrastructure; ?>"  name="id_infrastructure">
                                <input type="hidden" value="<?=$result->id_touriste; ?>"  name="id_touriste">
                            </div>
                            <div class="form-row">
                               
                                
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
               
            </div>
        </div>
    </div>

<?php
include_once 'footer.php';

?>














