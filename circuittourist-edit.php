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
                      <b>Circuit Touristique</b>
                    </div>
                    <div class="card-body">
                    <?php
                        if (isset($_GET['id'])) {
                            $circuit_id = $_GET['id'];
                            $query = "SELECT * FROM circuit_touristique WHERE nomcircuit = :circuit_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':circuit_id', $circuit_id, PDO::PARAM_STR);
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
                        <form action="./includes/circuittourist-edit.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) 
                        { ?>
                                 <p class="message"><?php echo html_entity_decode($_GET['message']); ?></p> <?php }?>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Identification Circuit</b></span>
                                <div class="form-group col-md-6">
                                    <label for="nomcircuit">Nom_Circuit</label>
                                    <input name="nomcircuit" type="text" value="<?=$result->nomcircuit; ?>" class="form-control" id="nomcircuit" placeholder="Nom_Circuit" disabled="disabled">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="categoriecircuit">Categorie </label>
                                    <input name="categoriecircuit" type="text" value="<?=$result->categoriecircuit; ?>" class="form-control" id="categoriecircuit" placeholder="categorie du circuit">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pointdepart">PointDepart</label>
                                    <input name="pointdepart" type="text" value="<?=$result->pointdepart; ?>" class="form-control" id="pointdepart" placeholder="pointdepart">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="longeur">Longueur</label>
                                    <input name="longeur" type="text" value="<?=$result->longeur; ?>" class="form-control" id="longeur" placeholder="Longueur">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="pointarrivee">PointArrivee</label>
                                    <input name="pointarrivee" type="text" value="<?=$result->pointarrivee; ?>" class="form-control" id="pointarrivee" placeholder="pointarrivee">
                                </div>
                                <input type="hidden" value="<?=$result->nomcircuit; ?>"  name="nomcircuit">
                            </div>
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Sites Traversés</b></span>
                                <div class="form-group col-md-6">
                                    <label for="nomsite">Nom_Site</label>
                                    <select name="nomsite" id="nomsite" value="<?=$result->nomsite; ?>" class="form-control">
                                        <option value="">--Choissisez le nom de site --</option>
                                        <option value="zone_arrouais">Zone Arrouais</option>
                                        <option value="zone_rokein">Zone Rokein</option>
                                        <option value="tifnit">Tifnit</option>
                                        <option value="taghazout">Taghazout</option>
                                        <option value="sidi_rbat">Sidi R'bat</option>
                                        <option value="Sidi_wassay">Sidi Wassay</option>
                                        <option value="kasbah_tizourgane">Kasbah Tizourgane</option>
                                        <option value="tata">Tata</option>
                                        <option value="kasbah_tizourgane">Kasbah Tizourgane</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_douar">Id_Douar</label>
                                    <select name="id_douar" id="id_douar" value="<?=$result->id_douar; ?>" class="form-control">
                                        <option value="">--Choissisez l'identifiant de douar--</option>
                                        <option value='1'>Larjam => 1 </option>
                                        <option value='2'>Sdi Boulafdail => 2 </option>
                                        <option value="3">Aghrimaz => 3 </option>
                                        <option value="4">Sidi Binzaren => 4</option>
                                        <option value="5">Sidi Oussay => 5</option>
                                        <option value="6">Sidi Rbat => 6</option>
                                        <option value="7">Ifaryane => 7</option>
                                        <option value="8">Douira => 8</option>
                                        <option value="9">Tifnit => 9</option>
                                        <option value="10">Sidi Toualnon =>10</option>
                                    </select>
                                </div>
                                <div class="input-group col-md-12">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Commentaire</span>
                                    </div>
                                    <textarea name="commentaire" value="<?=$result->commentaire; ?>" class="form-control" id="commentaire" aria-label="commentaire" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn" style="background-color:rgb(61,131,97,1);">UPDATE</button>
                        </form>
                        <br>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                   
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















