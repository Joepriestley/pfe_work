<?php
// Include your database connection code here if needed
$pdo = require_once 'dbConnect.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Server-side data validation
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Retrieve form data and validate it
    $nom = validate($_POST['nom']);
    $prenom = validate($_POST['prenom']);
    $mot_de_passe = validate($_POST['mot_de_passe']);
    // $mot_de_passe_repete = validate($_POST['mot_de_passe_repete']);
    $email = validate($_POST['email']);
    $role = validate($_POST['role']);

    // Perform additional validation if needed (e.g., check if email is unique)




    // Insert the data into the database (adapt this part to your database structure)
    try {

        /* we have to first check if the person who is signing up has signed up before 
        to prevent multiple sign ups
        */
        $query = "SELECT COUNT(*) FROM users WHERE nom =:nom and prenom=:prenom and email=:email";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        // $rowCount = $stmt->rowCount();
        $userExists = $stmt->fetchColumn();
        if ($userExists) {
            // User with the same email already exists, show an error message
            //echo "Error: Email address is already registered.";
            // redirect the user the sign up page  
            // add the sing page link here 
            // session_start();
            // $_SESSION['error_message'] = "l\'adresse email est deja utilise";
            header('Location:  ../sign-up.php?error_message=l\'adresse email est deja utilise');
        } else {
            $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (nom, prenom, mot_de_passe, email, role) VALUES (:nom, :prenom, :mot_de_passe, :email, :role)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt->bindParam(':mot_de_passe', $hashedPassword, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':role', $role, PDO::PARAM_STR);
    
            $result = $stmt->execute();
    
            if ($result) {
                // Redirect to a success page or perform other actions 
                // change this to send to send the user a particular page when the sign up is successful
                // session_start();
                // $_SESSION['success_message']= "Inscription réussie.";
                header('Location: ../login.php?success_message=Inscription réussie');
                exit();
            } else {
                // Handle the case where the insertion failed redirect the user the sign up page to imput the data againe
                // echo "Error: Failed to insert data into the database.";
                //session_start();
                // $_SESSION['error_message']='Inscription échouée';
                header('Location:  ../sign-up.php?error_message=Inscription réussie');
                exit();
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
