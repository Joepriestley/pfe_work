<?php
include_once 'header.php';
$pdo = require_once './includes/dbConnect.php';

?>
    <div class="container-fluid mt-4 pt-5">
        <div class="row">
            <div class="col-5">
                <div class="card">
                    <div class="card-header text-white"  style="background-color:rgb(61,131,97,1);">
                      <b> Les Partenaires Du PNSM</b>
                    </div>
                    <div class="card-body">

                    <?php
                        if (isset($_GET['id'])) {
                            $patenaire_id = $_GET['id'];
                            $query = "SELECT * FROM partenaire WHERE nompartenaire= :patenaire_id";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':patenaire_id', $patenaire_id, PDO::PARAM_STR);
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
                        <form action="./includes/partenaire-edit.inc.php" id="circuittouristForm"  style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                                 <p  class="message"><?php echo $_GET['message']; ?></p> <?php }?>

                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Les Partenatriat</b></span>
                                <div class="form-group col-md-6">
                                    <label for="responsable">Responsable</label>
                                    <input type="text"  name="responsable" value="<?=$result->responsable; ?>" class="form-control" id="responsable" placeholder="Responsable_Partenariat">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="objectifpartenariat">Objectif_Partenariat </label>
                                    <input type="text" value="<?=$result->objectifpartenariat; ?>" class="form-control" id="objectifpartenariat" name="objectifpartenariat" placeholder="objectifpartenariat">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="adresse">Adresse_Partenaire</label>
                                    <input type="text" value="<?=$result->adresse; ?>" class="form-control" name="adresse" id="adresse" placeholder="Adresse_Partenaire">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telephone">Tel_Partenaire </label>
                                    <input type="tel" value="<?=$result->telephone; ?>" class="form-control" name="telephone" id="telephone"  placeholder="123-456-7890">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="fax">Fax_Partenaire </label>
                                    <input type="tel" value="<?=$result->fax; ?>" class="form-control" id="fax" name="fax"  placeholder="123-456-7890">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="datesignpart">Date_Signature_Partenariat</label>
                                    <input type="date" value="<?=$result->datesignpart; ?>" class="form-control" id="datesignpart"  name="datesignpart" placeholder="Date de Signature de Partenariat">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nompartenaire">Nom_Partenaire</label>
                                    <select name="nompartenaire" id="nompartenaire" value="<?=$result->nompartenaire; ?>" class="form-control" disabled="disabled">
                                            <option value="">**Choissisez un Organisme**</option>
                                            <option value="GTZ" title="Deutsche Gesellschaft für Internationale Zusammenarbeit">GTZ</option>
                                            <option value="NPS" title="National Park Service">NPS</option>
                                            <option value="BirdLife" title="BirdLife International">BirdLife</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nationalite">Nationalite_Partenaire</label>
                                    <select name="nationalite" id="nationalite" value="<?=$result->nationalite; ?>" class="form-control">
                                        <option value="">**Choissisez une Nationalite**</option>
                                        <option value="Allemande">Allemande</option>
                                        <option value="U S A"title="Etats Unies d'Ameriques">U S A</option>
                                        <option value="Cambridge" title="Cambridge de UK">Cambridge</option>
                                    </select>
                                </div>
                                <input type="hidden" value="<?=$result->nompartenaire; ?>"  name="nompartenaire" >
                                
                            </div>
                            <button type="submit" name="submit" class="btn"  style="background-color:rgb(61,131,97,1);">Inserer</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <table class="table table-striped">
                    <thead class="table table-primary">
                        
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













