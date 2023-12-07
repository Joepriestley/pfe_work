<?php
include_once 'header.php';

if ($_SESSION['role'] === 'admin') {
?>
    <div class="mb-3 pt-5" style="margin-top: 150px;">

        <div class="row "></div>
        <div class="col-md-3  ml-5  " style="left: 40rem; ">
            <div class="card">
                <div class="card-header  text-white" style="background-color:rgb(61,131,97,0.75);">
                    <h2 class="text-center">S'enregistrer</h2>
                </div>
                <div class="card-body" style="background-color: rgb(200, 216, 214);">

                    <?php
                    // Check if an error or success message is set in the session
                    if (isset($_GET['error_message'])) {
                        echo '<div class="error-message">' . $_GET['error_message'] . '</div>';
                    }

                    if (isset($_GET['success_message'])) {
                        echo '<div class="success-message">' . $_GET['success_message'] . '</div>';
                        // Clear the success message after displaying it
                    }
                    ?>

                    <form action="./includes/signup.inc.php" style="background-color: rgb(200, 216, 214);" method="POST">
                        <div class="form-group">
                            <label class="pl-2" for="nom"> Nom:</label>
                            <input type="text" class="form-control" id="nom" name="nom" required placeholder="Votre Nom">
                        </div>
                        <div class="form-group">
                            <label class="pl-2 font-weight-700" for="prenom">Prenom:</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" required  placeholder="Votre Prenom">
                        </div>
                        <div class="form-group">
                            <label class="pl-2" for="mot_de_passe">Mot de Passe:</label>
                            <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" required placeholder="Mot de passe">
                        </div>
                        <div class="form-group">
                            <label class="pl-2" for="email"> Adresse Email:</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="Votre Adresse Email">
                        </div>

                        <div class="form-group">
                            <label class="pl-2" for="role">Role:</label>
                            <select class="form-control" id="role" name="role">
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-block text-white" style="background-color:rgb(61,131,97,0.7);">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>




<?php
include_once 'footer.php';
?>