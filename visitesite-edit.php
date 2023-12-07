<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';
?>
<body>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                      <b>Visite d'un Site</b>
                    </div>
                    <div class="card-body">

                    <?php
                        if (isset($_GET['id_sitetouristique']) && isset($_GET['id_touriste'])) {
                            $id_sitetouristique = $_GET['id_sitetouristique'];
                            $id_touriste = $_GET['id_touriste'];
                            
                            $query = "SELECT * FROM utilise WHERE id_sitetouristique = :id_sitetouristique AND id_touriste = :id_touriste";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':id_sitetouristique', $id_sitetouristique, PDO::PARAM_STR);
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
                        <form  action="./includes/visitesite-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message']))  { ?>
                                 <p class="message"><?php echo $_GET['message']; ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Visite</b></span>
                                <div class="form-group col-md-6">
                                    <label for="datevisite">Date_Viste </label>
                                    <input name="datevisite" type="date" value="<?=$result->datevisite; ?>" class="form-control" id="datevisite" placeholder="datevisite">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="duree">Duree</label>
                                    <input type="text" value="<?=$result->duree; ?>" class="form-control" id="duree" name="duree" placeholder="duree">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="visiteengroupe">Visit_Groupe</label>
                                    <input type="text" value="<?=$result->visiteengroupe; ?>" class="form-control" name="visiteengroupe" id="visiteengroupe" placeholder="visiteengroupe_Partenaire">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="id_sitetouristique">Id_Site_Touristique</label>
                                    <input type="number" value="<?=$result->id_sitetouristique; ?>"  class="form-control" name="id_sitetouristique" id="id_sitetouristique" placeholder="id_sitetouristique" disabled="disabled">
                                </div>
                                
                                <div class="form-group col-md-6">
                                    <label for="id_touriste">id_touriste</label>
                                    <input type="text" value="<?=$result->id_touriste; ?>" class="form-control" id="id_touriste"  name="id_touriste" placeholder="visiteengroupe_Partenaire" disabled="disabled">
                                </div>
                                <input type="hidden" value="<?=$result->id_sitetouristique; ?>"  name="id_sitetouristique">
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














