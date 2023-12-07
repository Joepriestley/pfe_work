<?php

$pdo = require_once './includes/dbConnect.php';


include_once 'header.php';
?>
<div class="container-fluid pt-5" style="margin-top: 70px;">
    <div class="row">
        <div class="col-5">
            <div class="card">
                <div class="card-header text-white" style="background-color:rgb(61,131,97,1);">
                    <b>Amenagement</b>
                </div>
                <div class="card-body">
                    <form action="./includes/amenagement.inc.php" id="circuittouristForm" style="background-color: rgb(201, 216, 214);" method="post">
                        <?php if (isset($_GET['message'])) { ?>
                            <p class="message"><?php echo $_GET['message']; ?></p>
                        <?php } ?>
                        <div class="form-row">
                            <span class="form-control text-center bg-dark text-white"><b>Amenagement</b></span>
                            <!-- <div class="form-group col-md-6">
                                <label for="codeamenagement">Code Amenagement</label>
                                <input type="text" name="codeamenagement" class="form-control" id="codeamenagement" placeholder="codeamenagement">
                            </div> -->
                            <div class="form-group col-md-12">
                                <label for="type">Type Amenagement</label>
                                <input type="text" class="form-control" id="type" name="type" placeholder="type">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="element_amenage">Element Amenagement</label>
                                <select name="element_amenage" id="element_amenage" class="form-control">
                                    <option value="">Selectionner un element à amenager</option>
                                    <option value="piste">piste</option>
                                    <option value="point_eau">point_eau</option>
                                    <option value="cloture">cloture</option>
                                    <option value="amenagement_touristique">amenagement_touristique</option>
                                </select>
                            </div>
                            <div id="container-form">
                           
                            </div>
                            <div class="input-group col-md-12">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Commentaire</span>
                                </div>
                                <textarea name="commentaire" class="form-control" id="commentaire" aria-label="commentaire" rows="7" cols="" placeholder="Entrer un commentaire /description de l'especes"></textarea>
                            </div>
                        </div>
                        <div class="form-row">
                        </div>
                        <div class="form-row">
                        </div>
                        <button type="submit" name="submit" class="btn text-white" style="background-color:rgb(61,131,97,1);">Inserer</button>
                        
                    </form>
                   
                    
                    <div class="form-group row pt-2 mb-auto ml-auto">
                        <a href="refection_pistes.php" class="ml-1 pt-2"><button class="btn btn-success " id="nav-profile-tab"  href="amenagement.php" title="Visualiser la table de donnees sur les pistes">Voir Table Pistes</button></a>
                        <a href="ref_amenagementtouristique.php" class="ml-1 pt-2"><button class="btn btn-success " id="nav-profile-tab"  href="amenagement.php"  title="Visualiser la table de donnees sur les Amenagement Touristique">Voir Table Amen.Touristique</button></a>
                        <a href="ref_point_eau.php" class="ml-1 pt-2"><button class="nav-item nav-link btn btn-success " href="#nav-home"  title="Visualiser la table de donnees sur les Points Eaux">Voir Table Point Eau</button></a>
                        <a href="refection_cloture.php" class="ml-1 pt-2"><button class="nav-item nav-link btn btn-success " href="#nav-home"  title="Visualiser la table de donnees sur les Clotures">Voir Table Cloture</button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <table class="table table-striped bg-white">
                <thead class="table-success">
                    <tr>
                        <th>Code_Amenagement</th>
                        <th> Element Amenagement</th>
                        <th>Commentaire</th>
                        <th>Editer</th>
                        <th>Effacer</th>
                    </tr>
                </thead>
                <tbody id="circuitTable">
                    <!-- Table rows will be dynamically added here -->
                    <?php
                    // Assuming you already have the database connection established ($pdo)
                    $query = "SELECT * FROM amenagement";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute();
                    $results = $stmt->fetchall(PDO::FETCH_ASSOC);
                    ?>

                    <!-- Add this inside the table body -->
                    <?php foreach ($results as $row) : ?>
                        <tr>
                            <td><?= $row['codeamenagement'] ?></td>
                            <td><?= $row['element_amenage'] ?></td>
                            <td><?= $row['commentaire'] ?></td>
                            <td>
                                <a href="amenagement-edit.php?id=<?= $row['codeamenagement'] ?>"><button name="edit_amenagement" class="edit-btn btn" style="background-color:rgb(61,131,97,1);">Editer</button></a>

                            </td>
                            <td>

                                <!-- Delete form -->
                                <form style="border:0px; padding:0px;" action="./deletion/amenagement-delete.php" method="POST">
                                    <!-- Hidden input field to include codeamenagement -->
                                    <input type="hidden" name="codeamenagement" value="<?= $row['codeamenagement'] ?>">
                                    <!-- Delete button -->
                                    <button name="delete_amenagement" class="delete-btn" style="background-color:rgb(61,131,97,1);" onclick="return confirm('Etes vous d\'effacer cette ligne?');">Effacer</button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .col-5 {
    -ms-flex: 0 0 41.666667%;
    flex: 0 0 41.666667%;
    max-width: 59.666667%;
}
</style>
<script>
    const selectElement = document.getElementById('element_amenage');
    const selectedValueElement = document.getElementById('container-form');

    // Adding an event listener to the selected element 
    selectElement.addEventListener('change', function() {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const selectValue = selectedOption.value; // Corrected from selectedOption.setFormHTML
        const selectedText = selectedOption.text;

        const piste = `<div class="col-12">
                <div class="card">
                    <div class="card-body ">
                        <div style="background-color: rgb(201, 216, 214);">
                            <div class="form-row ml-3">
                                <span class="form-control text-center bg-dark text-white"><b>Piste</b></span>
                                <div class="form-group col-md-12">
                                <label for="_nom_piste">Nom Piste</label>
                                <input name="_nom_piste" type="text" class="form-control" id="_nom_piste" placeholder="_nom_piste">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="longueur">Longueur (km)</label>
                                    <input name="longueur" type="number" class="form-control" id="longueur" placeholder="longueur">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cout_creation">Cout_Installation (dhs)</label>
                                    <input name="cout_creation" type="number" class="form-control" id="cout_creation" placeholder="cout_creation">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="accessibilite">Accessibilite</label>
                                    <input name="accessibilite" type="text" class="form-control" id="accessibilite" placeholder="accessibilite">
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="date_creation">Date Creation</label>
                                <input name="date_creation" type="date" class="form-control" id="date_creation" placeholder="date_creation">
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;



// ++++++ start: Pint_eau form+++++++++

        const point_eau = ` <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="background-color: rgb(201, 216, 214);">
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Point Eau</b></span>
                                <div class="form-group col-md-12">
                                <label for="nom_point_eau">Nom_point_Eau</label>
                                <input name="nom_point_eau" type="text" class="form-control" id="nom_point_eau" placeholder="nom_point_eau">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="profondeur">Profondeur (m)</label>
                                    <input name="profondeur" type="number" class="form-control" id="profondeur" placeholder="profondeur">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nature">Nature</label>
                                    <input name="nature" type="text" class="form-control" id="nature" placeholder="la nature d'eau">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_installation">Cout Installation</label>
                                    <input name="cout_installation" type="number" class="form-control" id="cout_installation" placeholder="le cout de l'action">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="date_installation">Date Installation</label>
                                    <input name="date_installation" type="date" class="form-control" id="date_installation" placeholder="la date de creation ">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="localisation">Localisation</label>
                                    <input name="localisation" type="text" class="form-control" id="localisation" placeholder="localisation">
                             </div>
                             <div class="form-group col-md-12">
                                    <label for="importance">Importance</label>
                                    <input name="importance" type="text" class="form-control" id="importance" placeholder="les importance du point d'eau">
                                </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            </div>`;
            // ++++++ End: Pint_eau form+++++++++


            // ++++++ Start: Amenagement touristique form+++++++++


        const amenagement_touristique = ` <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="background-color: rgb(201, 216, 214);" >
                            <div class="form-row ">
                                <span class="form-control text-center bg-dark text-white"><b>Amenagement Touristique</b></span>
                                <div class="form-group col-md-12">
                                <label for="nom_amenagttour">Nom Amenagement Touristique</label>
                                <input name="nom_amenagttour" type="text" class="form-control" id="nom_amenagttour" placeholder="nom_amenagttour">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="responsable">Responsable Amenagement Touristique</label>
                                    <input name="responsable" type="text" class="form-control" id="responsable" placeholder="responsable de l'amenagement touristique">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="date_cree">Date_Creation</label>
                                    <input name="date_cree" type="date" class="form-control" id="date_cree" placeholder="date_cree de gestion">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="periode">Periode</label>
                                    <input name="periode" type="text" class="form-control" id="periode" placeholder="Periode de gestion">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="cout_creaction">Cout Creation</label>
                                    <input name="cout_creaction" type="text" class="form-control" id="cout_creaction" placeholder="Saissir le cout de gestion">
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>`;


            const cloture =`<div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div style="background-color: rgb(201, 216, 214);" 
                            <div class="form-row">
                                <span class="form-control text-center bg-dark text-white"><b>Cloture</b></span>
                                <div class="form-group col-md-12">
                                <label for="nom_cloture">Nom Cloture</label>
                                <input name="nom_cloture" type="text" class="form-control" id="nom_cloture" placeholder="nom_cloture">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="date_cloture">Date_Cloture</label>
                                    <input name="date_cloture" type="date" class="form-control" id="date_cloture" placeholder="date_cloture">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cout_creation">Cout_Creation</label>
                                    <input name="cout_creation" type="number" class="form-control" id="cout_creation" placeholder="cout_creation">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="nature">Nature</label>
                                    <input name="nature" type="text" class="form-control" id="nature" placeholder="nature">
                                </div>
                                <div class="form-group col-md-12">
                                <label for="duree">Duree (Ans)</label>
                                <input name="duree" type="type" class="form-control" id="duree" placeholder="duree">
                            </div>
                            </div>  
                    </div>
                </div>
            </div>`;

             // ++++++ End: Amenagement touristique form+++++++++

        // Function to set the HTML content of selectedValueElement
        function setFormHTML(html) {
            selectedValueElement.innerHTML = html;
        }

        // Set the HTML form based on the selected value 
        switch (selectValue) {

            case 'piste':
                setFormHTML(piste);
                break;

            case 'point_eau':
                setFormHTML(point_eau);
                break;
            case 'amenagement_touristique':
                setFormHTML(amenagement_touristique);
                break;
            case 'cloture':
                setFormHTML(cloture);
                break;
            default:
                setFormHTML('Select an element of amenagement form ');
                break;
        }

        // Updating 
        // selectedValueElement.textContent = `Selected Value : ${selectedText} (${selectValue})`;
    });
</script>


<?php include_once 'footer.php'; ?>